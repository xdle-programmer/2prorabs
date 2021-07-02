<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"DISPLAY_DATE" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_DATE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_NAME" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_NAME"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_PICTURE" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_PICTURE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_PREVIEW_TEXT" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_TEXT"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
    "LABEL_PRIMARY" => array(
        "PARENT" => "ADDITIONAL_SETTINGS",
        "NAME" => 'Заголовок',
        "TYPE" => "STRING",
        "DEFAULT" => "",
    ),
    "LABEL_2" => array(
        "PARENT" => "ADDITIONAL_SETTINGS",
        "NAME" => 'Надпись под заголовком',
        "TYPE" => "STRING",
        "DEFAULT" => "",
    ),
    "LABEL_3" => array(
        "PARENT" => "ADDITIONAL_SETTINGS",
        "NAME" => 'Текст перед элементами',
        "TYPE" => "STRING",
        "DEFAULT" => "",
    ),
);
?>
