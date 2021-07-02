<?php
if(!defined('B_PROLOG_INCLUDED')||B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

$arComponentDescription = [
    'NAME' => 'Авторизация/Регистрация',
    'DESCRIPTION' => 'Авторизация/Регистрация',
    'SORT' => 10,
    "COMPLEX" => "Y",
    'PATH' => [
        'ID' => 'project',
        'NAME' => 'Компоненты 2Quick',
        'SORT' => 10,
    ]
];