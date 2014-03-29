<?php
if (!defined ("TYPO3_MODE")) 	die ("Access denied.");

require_once(t3lib_extMgm::extPath('abz_developer').'class.tx_abzdeveloper.php');

$confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['abz_developer']);
if ($confArr['emptyFECache']) {
		//hook to delete all caches before generating page
	$TYPO3_CONF_VARS['SC_OPTIONS']['tslib/index_ts.php']['preBeUser'][] = 'EXT:abz_developer/hooks/index_ts.php:tx_abzdeveloper_cache->clearCache';
}
if ($confArr['activateDebug']) {
		//override setting from Install Tool, remember: use this extension only for development
	$TYPO3_CONF_VARS['SYS']['sqlDebug'] = '1';
	$TYPO3_CONF_VARS['SYS']['enable_DLOG'] = '1';
}
?>