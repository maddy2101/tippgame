<?php
return [
    'ctrl' => [
        'label' => 'title',
        'tstamp' => 'tstamp',
        'title' => 'LLL:EXT:tippgame/Resources/Private/Language/locallang.xlf:round',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'delete' => 'deleted',
        'adminOnly' => 0, // Only admin users can edit
        'rootLevel' => 0,
        'default_sortby' => 'ORDER BY start ASC',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'iconfile' => 'EXT:tippgame/Resources/Public/Icons/tx_tippgame_round.png',
        'useColumnsForDefaultValues' => 'title,start,stop,tournament',
        'versioningWS_alwaysAllowLiveEdit' => true,
        'searchFields' => 'title',
    ],
    'interface' => [
        'showRecordFieldList' => 'title,start,stop,tournament',
    ],
    'columns' => [
        'title' => [
            'label' => 'LLL:EXT:tippgame/Resources/Private/Language/locallang.xlf:round.title',
            'config' => [
                'type' => 'input',
                'size' => '20',
                'max' => '50',
                'eval' => 'trim,unique,required',
            ],
        ],
        'start' => [
            'label' => 'LLL:EXT:tippgame/Resources/Private/Language/locallang.xlf:round.start',
            'config' => [
                'type' => 'input',
                'size' => '13',
                'eval' => 'datetime',
                'default' => '0',
            ],
        ],
        'stop' => [
            'label' => 'LLL:EXT:tippgame/Resources/Private/Language/locallang.xlf:round.stop',
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
            'label' => 'LLL:EXT:tippgame/Resources/Private/Language/locallang.xlf:round.hidden',
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
        'tournament' => [
            'label' => 'LLL:EXT:tippgame/Resources/Private/Language/locallang.xlf:round.tournament',
            'exclude' => true,
            'config' => [
                'type' => 'select',
                'renderMode' => 'singlebox',
                'items' => [
                    '0' => [
                        '0' => 'LLL:EXT:tippgame/Resources/Private/Language/locallang.xlf:empty_item',
                        '1' => '0'
                    ]
                ],
                'maxitems' => 1,
                'foreign_table' => 'tx_tippgame_domain_model_tournament',
                'foreign_field' => 'rounds',
            ],
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => 'title,start,stop,tournament,
            --div--;LLL:EXT:lang/locallang_tca.xlf:be_users.tabs.access, starttime,endtime,hidden,
            --div--;LLL:EXT:lang/locallang_tca.xlf:be_users.tabs.extended',
        ],
    ],
];