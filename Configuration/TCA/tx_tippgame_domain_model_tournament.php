<?php
return [
    'ctrl' => [
        'label' => 'title',
        'tstamp' => 'tstamp',
        'title' => 'LLL:EXT:tippgame/Resources/Private/Language/locallang.xlf:tournament',
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
        'iconfile' => 'EXT:tippgame/Resources/Public/Icons/tx_tippgame_tournament.png',
        'useColumnsForDefaultValues' => 'title,start,stop',
        'versioningWS_alwaysAllowLiveEdit' => true,
        'searchFields' => 'title',
    ],
    'interface' => [
        'showRecordFieldList' => 'title,start,stop,players,rounds',
    ],
    'columns' => [
        'title' => [
            'label' => 'LLL:EXT:tippgame/Resources/Private/Language/locallang.xlf:tournament.title',
            'config' => [
                'type' => 'input',
                'size' => '20',
                'max' => '50',
                'eval' => 'trim,unique,required',
            ],
        ],
        'start' => [
            'label' => 'LLL:EXT:tippgame/Resources/Private/Language/locallang.xlf:tournament.start',
            'config' => [
                'type' => 'input',
                'size' => '13',
                'eval' => 'datetime',
                'default' => '0',
            ],
        ],
        'stop' => [
            'label' => 'LLL:EXT:tippgame/Resources/Private/Language/locallang.xlf:tournament.stop',
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
            'label' => 'LLL:EXT:tippgame/Resources/Private/Language/locallang.xlf:tournament.hidden',
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
        'rounds' => [
            'label' => 'LLL:EXT:tippgame/Resources/Private/Language/locallang.xlf:tournament.rounds',
            'exclude' => true,
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_tippgame_domain_model_round',
                'foreign_field' => 'tournament',
                'appearance' => [
                    'expandSingle' => true,
                    'newRecordLinkTitle' => 'LLL:EXT:tippgame/Resources/Private/Language/locallang.xlf:link.tournament.newRound',
                    'useSortable' => true,
                ],
            ],
        ],
        'players' => [
            'label' => 'LLL:EXT:tippgame/Resources/Private/Language/locallang.xlf:tournament.players',
            'exclude' => true,
            'config' => [
                'type' => 'select',
                'size' => 10,
                'maxitems' => 9999,
                'foreign_table' => 'fe_users',
                'foreign_table_where' => ' AND fe_users.pid = 28 AND fe_users.usergroup = 2'
            ],
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => 'title,start,stop,
            --div--;LLL:EXT:tippgame/Resources/Private/Language/locallang.xlf:tab_rounds, rounds,
            --div--;LLL:EXT:tippgame/Resources/Private/Language/locallang.xlf:tab_players, players,
            --div--;LLL:EXT:lang/locallang_tca.xlf:be_users.tabs.access, starttime,endtime,hidden,
            --div--;LLL:EXT:lang/locallang_tca.xlf:be_users.tabs.extended',
        ],
    ],
];
