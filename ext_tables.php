<?php

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'player',
	'Tippgame Player View'
);

ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'admin',
	'Tippgame Admin View'
);