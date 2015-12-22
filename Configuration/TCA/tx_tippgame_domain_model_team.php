<?php
return [
    'ctrl' => [
        'label' => 'name',
        'tstamp' => 'tstamp',
        'title' => 'LLL:EXT:tippgame/Resources/Private/Language/locallang.xlf:team',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'delete' => 'deleted',
        'adminOnly' => 0, // Only admin users can edit
        'rootLevel' => 0,
        'default_sortby' => 'ORDER BY name ASC',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'iconfile' => 'EXT:tippgame/Resources/Public/Icons/tx_tippgame_team.png',
        'useColumnsForDefaultValues' => 'name',
        'versioningWS_alwaysAllowLiveEdit' => true,
        'searchFields' => 'name',
    ],
    'interface' => [
        'showRecordFieldList' => 'name',
    ],
    'columns' => [
        'name' => [
            'label' => 'LLL:EXT:tippgame/Resources/Private/Language/locallang.xlf:team.name',
            'config' => [
                'type' => 'input',
                'size' => '20',
                'max' => '200',
                'eval' => 'trim',
            ],
        ],
        'starttime' => [
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'size' => '13',
                'eval' => 'datetime',
                'default' => '0',
            ],
        ],
        'endtime' => [
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'size' => '13',
                'eval' => 'datetime',
                'default' => '0',
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038),
                ],
            ],
        ],
        'hidden' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:tippgame/Resources/Private/Language/locallang.xlf:team.hidden',
            'config' => [
                'type' => 'check',
                'default' => '0',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.hidden_checkbox_1_formlabel',
                    ],
                ],
            ],
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => 'name,
            --div--;LLL:EXT:lang/locallang_tca.xlf:be_users.tabs.access, starttime,endtime,hidden,
            --div--;LLL:EXT:lang/locallang_tca.xlf:be_users.tabs.extended',
        ],
    ],
];
