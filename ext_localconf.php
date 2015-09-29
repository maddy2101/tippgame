<?php
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

ExtensionUtility::configurePlugin(
	'ABS.' . $_EXTKEY,
	'player',
	[
		'Tournament' => 'list',
	],
	[]
);

ExtensionUtility::configurePlugin(
	'ABS.' . $_EXTKEY,
	'admin',
	[
		'Administration' => 'list',
	],
	[]
);
