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
        'showRecordFieldList' => 'title,start,stop,players,rounds,amount_rounds,amount_teams,winner,teams',
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
                'renderType' => 'selectMultipleSideBySide',
                'size' => 10,
                'maxitems' => 9999,
                'foreign_table' => 'fe_users',
                'wizards' => [
                    'suggest' => [
                        'type' => 'suggest',
                    ],
                ],
            ],
        ],
        'teams' => [
            'label' => 'LLL:EXT:tippgame/Resources/Private/Language/locallang.xlf:tournament.teams',
            'exclude' => true,
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'size' => 10,
                'maxitems' => 9999,
                'foreign_table' => 'tx_tippgame_domain_model_team',
                'wizards' => [
                    'suggest' => [
                        'type' => 'suggest',
                    ],
                ],
            ],
        ],
        'amount_teams' => [
            'label' => 'LLL:EXT:tippgame/Resources/Private/Language/locallang.xlf:tournament.amount_teams',
            'exclude' => true,
            'config' => [
                'type' => 'input',
            ],
        ],
        'amount_rounds' => [
            'label' => 'LLL:EXT:tippgame/Resources/Private/Language/locallang.xlf:tournament.amount_rounds',
            'exclude' => true,
            'config' => [
                'type' => 'input',
            ],
        ],
        'winner' => [
            'label' => 'LLL:EXT:tippgame/Resources/Private/Language/locallang.xlf:tournament.winner',
            'exclude' => true,
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingleBox',
                'maxitems' => 1,
                'size' => 1,
                'foreign_table' => 'tx_tippgame_domain_model_team',
            ],
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => 'title,start,stop,amount_rounds,amount_teams,
            --div--;LLL:EXT:tippgame/Resources/Private/Language/locallang.xlf:tab_rounds, rounds,
            --div--;LLL:EXT:tippgame/Resources/Private/Language/locallang.xlf:tab_players, players,
            --div--;LLL:EXT:tippgame/Resources/Private/Language/locallang.xlf:tab_teams, teams,winner,
            --div--;LLL:EXT:lang/locallang_tca.xlf:be_users.tabs.access, starttime,endtime,hidden,
            --div--;LLL:EXT:lang/locallang_tca.xlf:be_users.tabs.extended',
        ],
    ],
];
