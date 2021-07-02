<?php
if(!defined('B_PROLOG_INCLUDED')||B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

$arComponentDescription = [
    'NAME' => Loc::getMessage('PROJECT_NAME'),
    'DESCRIPTION' => Loc::getMessage('PROJECT_NAME_DESCRIPTION'),
    'SORT' => 10,
    'PATH' => [
        'ID' => 'project',
        'NAME' => Loc::getMessage('PROJECT'),
        'SORT' => 10,
        'CHILD' => [
            'ID' => 'project_cmp',
            'NAME' => Loc::getMessage('PROJECT_COMP'),
            'SORT' => 10
        ]
    ]
];