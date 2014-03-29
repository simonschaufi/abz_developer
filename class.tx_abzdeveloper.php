<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2006-2009 Franz Ripfel (franz.ripfel@abezet.de)
*  All rights reserved
*
*  This script is part of the Typo3 project. The Typo3 project is
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
 *
 * This Script aims to provide help to team developers

 * usage like t3lib_utility_Debug::debug()
 * tx_abzdeveloper::debug('fr',$var, 'mydebug');
 * tx_abzdeveloper::debug('fr',$var);
 *
 *
 * @author	Franz Kugelmann <franz.Kugelmann@elementare-teilchen.de>
 */

/**
 * helper class for development stuff
 */
class tx_abzdeveloper {

	/**
	 * wrap normal debug with check for personal initials.
	 * therefore developer get only the output he chose in localconf,
	 * no need to comment all debugs in versioning system during development
	 *
	 * @param string $initials your initials or nickname
	 * @param string $var variable to debug
	 * @param string $header additional header to show
	 * @param string $group group info
	 * @return void
	 * @see t3lib_utility_Debug::debug()
	 */
	function debug($initials='', $var = '', $header = '', $group = 'Debug') {
		$extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['abz_developer']);
		if (t3lib_div::inList($extConf['initials'], $initials)) {
			t3lib_utility_Debug::debug($var, $header, $group);
		}
	}
}