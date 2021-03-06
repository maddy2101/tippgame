<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}


ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'admin',
	'Tippgame Admin View'
);

ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Tippgame');
