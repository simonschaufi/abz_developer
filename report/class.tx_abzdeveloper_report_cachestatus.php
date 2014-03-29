<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 Peter Kraume <peter.kraume@gmx.de>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/


/**
 * Provides an status report about which checks if the clear cache function
 * of abz_developer is active
 *
 * @author	Peter Kraume <peter.kraume@gmx.de>
 * @package	TYPO3
 * @subpackage	abz_developer
 */
class tx_abzdeveloper_report_CacheStatus implements tx_reports_StatusProvider {
	/**
	 * Constructor for class tx_abzdeveloper_report_CacheStatus
	 */
	public function __construct() {
			$GLOBALS['LANG']->includeLLFile('EXT:abz_developer/report/locallang.xml');
	}

	/**
	 * checks if keep cache empty is enabled or disabled in abz_developer
	 *
	 * @see typo3/sysext/reports/interfaces/tx_reports_StatusProvider::getStatus()
	 * @return array
	 */
	public function getStatus() {
		$confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['abz_developer']);
		$reports = array();

		if ($confArr['emptyFECache']) {
			$status = t3lib_div::makeInstance('tx_reports_reports_status_Status',
				$GLOBALS['LANG']->getLL('keep_cache_empty'),
				$GLOBALS['LANG']->getLL('enabled'),
				$GLOBALS['LANG']->getLL('message_error'),
				tx_reports_reports_status_Status::ERROR
			);
			$reports[] = $status;
		}
		else {
			$status = t3lib_div::makeInstance('tx_reports_reports_status_Status',
				$GLOBALS['LANG']->getLL('keep_cache_empty'),
				$GLOBALS['LANG']->getLL('disabled'),
				'',
				tx_reports_reports_status_Status::OK
			);
			$reports[] = $status;
		}

		return $reports;
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/abz_developer/report/class.tx_abzdeveloper_report_cachestatus.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/abz_developer/report/class.tx_abzdeveloper_report_cachestatus.php']);
}
?>