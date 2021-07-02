<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

if (isset($arParams["TEMPLATE_THEME"]) && !empty($arParams["TEMPLATE_THEME"])) {
    $arAvailableThemes = array();
    $dir = trim(preg_replace("'[\\\\/]+'", "/", dirname(__FILE__) . "/themes/"));
    if (is_dir($dir) && $directory = opendir($dir)) {
        while (($file = readdir($directory)) !== false) {
            if ($file != "." && $file != ".." && is_dir($dir . $file)) {
                $arAvailableThemes[] = $file;
            }
        }
        closedir($directory);
    }

    if ($arParams["TEMPLATE_THEME"] == "site") {
        $solution = COption::GetOptionString("main", "wizard_solution", "", SITE_ID);
        if ($solution == "eshop") {
            $templateId = COption::GetOptionString("main", "wizard_template_id", "eshop_bootstrap", SITE_ID);
            $templateId = (preg_match("/^eshop_adapt/", $templateId)) ? "eshop_adapt" : $templateId;
            $theme = COption::GetOptionString("main", "wizard_" . $templateId . "_theme_id", "blue", SITE_ID);
            $arParams["TEMPLATE_THEME"] = (in_array($theme, $arAvailableThemes)) ? $theme : "blue";
        }
    } else {
        $arParams["TEMPLATE_THEME"] = (in_array($arParams["TEMPLATE_THEME"],
            $arAvailableThemes)) ? $arParams["TEMPLATE_THEME"] : "blue";
    }
} else {
    $arParams["TEMPLATE_THEME"] = "blue";
}

$arParams["FILTER_VIEW_MODE"] = (isset($arParams["FILTER_VIEW_MODE"]) && toUpper($arParams["FILTER_VIEW_MODE"]) == "HORIZONTAL") ? "HORIZONTAL" : "VERTICAL";
$arParams["POPUP_POSITION"] = (isset($arParams["POPUP_POSITION"]) && in_array($arParams["POPUP_POSITION"],
        array("left", "right"))) ? $arParams["POPUP_POSITION"] : "left";

if ($arParams['SECTION_ID']) {
   /* $arResult['CURRENT_SECTION'] = CIBlockSection::GetByID($arParams['SECTION_ID'])->Fetch();
    if ($arResult['CURRENT_SECTION']['IBLOCK_SECTION_ID']) {
        $arResult['PARENT_SECTION'] = CIBlockSection::GetByID($arResult['CURRENT_SECTION']['IBLOCK_SECTION_ID'])->Fetch();
    }
        $arFilter = array(
            'IBLOCK_ID' => $arParams["IBLOCK_ID"],
            '!ID' => $arResult['PARENT_SECTION']['ID'],
            'LEFT_MARGIN' => $arResult['PARENT_SECTION']['LEFT_MARGIN'],
            'RIGHT_MARGIN' => $arResult['PARENT_SECTION']['RIGHT_MARGIN']
        );
        $rsSections = CIBlockSection::GetList(array('LEFT_MARGIN' => 'ASC'), $arFilter);
        while ($arSection = $rsSections->GetNext()) {
            if ($arResult['SECT'][$arSection['IBLOCK_SECTION_ID']]) {
                $arResult['SECT'][$arSection['IBLOCK_SECTION_ID']]['CHILD'][$arSection['ID']] = $arSection;
            } else {
                $arResult['SECT'][$arSection['ID']] = $arSection;
            }
        }*/
    $arResult['CURRENT_SECTION'] = CIBlockSection::GetByID($arParams['SECTION_ID'])->Fetch();
    if ($arResult['CURRENT_SECTION']['IBLOCK_SECTION_ID']) {
        $arResult['PARENT_SECTION'] = CIBlockSection::GetByID($arResult['CURRENT_SECTION']['IBLOCK_SECTION_ID'])->Fetch();
    }
    $arFilter = array('IBLOCK_ID' => $arParams["IBLOCK_ID"],
        '>LEFT_MARGIN'=> $arResult['CURRENT_SECTION']['LEFT_MARGIN'],
        '<RIGHT_MARGIN'=> $arResult['CURRENT_SECTION']['RIGHT_MARGIN'],
        '>DEPTH_LEVEL' => $arResult['CURRENT_SECTION']['DEPTH_LEVEL'],
        'ACTIVE' => 'Y'
    );
    $rsSections = CIBlockSection::GetList(array('LEFT_MARGIN' => 'ASC'), $arFilter);
    while ($arSection = $rsSections->GetNext())
    {
        if($arSection['IBLOCK_SECTION_ID'] == $arResult['CURRENT_SECTION']['ID'])
        $arResult['SECT'][$arSection['ID']] = $arSection;
        elseif ($arResult['SECT'][$arSection['IBLOCK_SECTION_ID']])
            $arResult['SECT'][$arSection['IBLOCK_SECTION_ID']]['CHILD'][$arSection['ID']] = $arSection;
    }


}else{
    $arResult['CURRENT_SECTION']['NAME'] = $APPLICATION->GetTitle(false);
    $arFilter = array('IBLOCK_ID' => $arParams["IBLOCK_ID"],
        '<=DEPTH_LEVEL' => 2,
        'ACTIVE' => 'Y'
    );
    $rsSections = CIBlockSection::GetList(array('LEFT_MARGIN' => 'ASC'), $arFilter);
    while ($arSection = $rsSections->GetNext())
    {
        if(!$arSection['IBLOCK_SECTION_ID'])
            $arResult['SECT'][$arSection['ID']] = $arSection;
        elseif ($arResult['SECT'][$arSection['IBLOCK_SECTION_ID']])
            $arResult['SECT'][$arSection['IBLOCK_SECTION_ID']]['CHILD'][$arSection['ID']] = $arSection;
    }
}

