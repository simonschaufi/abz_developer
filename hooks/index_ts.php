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
 * Clear all caching tables with brute force to be sure they are definitely empty
 * This might not be the smartest way but it is the simple and always working way :)

 * @author	Franz Kugelmann <franz.kugelmann@elementare-teilchen.de>
 */
class tx_abzdeveloper_cache {

	/**
	 * @param $params
	 * @param $ref
	 * @return bool
	 */
	function clearCache(&$params, &$ref) {
			// directly clear cache tables for this page to be sure to have no caching while developing:
		$typoVersion =
			class_exists('t3lib_utility_VersionNumber') ?
			t3lib_utility_VersionNumber::convertVersionNumberToInteger(TYPO3_version) :
			t3lib_div::int_from_ver(TYPO3_version);
		if ($GLOBALS['TYPO3_CONF_VARS']['SYS']['useCachingFramework'] || $typoVersion >= 4006000) {
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('cf_cache_hash','');
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('cf_cache_hash_tags','');
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('cf_cache_pages','');
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('cf_cache_pagesection','');
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('cf_cache_pagesection_tags','');
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('cf_cache_pages_tags','');
		} elseif ($GLOBALS['TYPO3_CONF_VARS']['SYS']['useCachingFramework']) {
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('cachingframework_cache_hash','');
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('cachingframework_cache_hash_tags','');
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('cachingframework_cache_pages','');
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('cachingframework_cache_pagesection','');
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('cachingframework_cache_pagesection_tags','');
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('cachingframework_cache_pages_tags','');
		} else {
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('cache_pages','');
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('cache_hash','');
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('cache_pagesection', '');// Originally, cache_pagesection was not cleared with cache_pages!
		}

			//if realurl is installed, clear caches there also
		if (t3lib_extMgm::isLoaded('realurl')) {
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('tx_realurl_chashcache','');
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('tx_realurl_pathcache','');
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('tx_realurl_urldecodecache', '');
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('tx_realurl_urlencodecache', '');
		}

		t3lib_div::devLog('clearCache','index_ts.php',0,$params);
		return true;
	}
}