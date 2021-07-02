<?php
if(!defined('B_PROLOG_INCLUDED')||B_PROLOG_INCLUDED!==true)die();
/**
* @var array $arCurrentValues
 **/
use Bitrix\Main\Localization\Loc;
if(!CModule::IncludeModule("iblock"))
    return;
Loc::loadMessages(__FILE__);

$arComponentParameters = [
    "GROUPS" => [],
    "PARAMETERS" => [
        "AJAX_MODE" => [],
        "SEF_MODE" => Array(
            "payment" => array(
                "NAME" => 'Оплата',
                "DEFAULT" => "",
                "VARIABLES" => array(),
            ),
            "confirm_order" => array(
                "NAME" => 'Подтверждение',
                "DEFAULT" => "",
                "VARIABLES" => array(),
            ),
        ),
        "CACHE_TIME"  =>  ["DEFAULT"=>86400],
    ]
];
CIBlockParameters::Add404Settings($arComponentParameters, $arCurrentValues);