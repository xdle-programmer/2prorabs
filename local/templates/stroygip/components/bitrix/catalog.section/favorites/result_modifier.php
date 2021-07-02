<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

foreach ($arResult['ITEMS'] as $arItem) {
    $sectionsID[$arItem['IBLOCK_SECTION_ID']] = $arItem['IBLOCK_SECTION_ID'];
}

$arFilter = Array('IBLOCK_ID'=>$arParams['IBLOCK_ID'], 'ID' => $sectionsID);
$db_list = CIBlockSection::GetList(Array('name'=>'asc'), $arFilter, false, ['ID']);
while($ar_result = $db_list->Fetch())
{
    $nav = CIBlockSection::GetNavChain(false,$ar_result['ID'], ['ID', 'NAME', 'DEPTH_LEVEL']);
    while($arSectionPath = $nav->Fetch()){
        if ($arSectionPath['DEPTH_LEVEL'] == 1) {
            $arResult['MAIN_SECTIONS'][$arSectionPath['ID']] = $arSectionPath['NAME'];
            $sections[$ar_result['ID']] = $arSectionPath['ID'];
        }
    }
}

if (!empty($arParams['FAV_SECTION'])) {
    foreach ($arResult['ITEMS'] as $arItem) {
        if ($sections[$arItem['IBLOCK_SECTION_ID']] == $arParams['FAV_SECTION']) {
            $arResult['NEW_ITEMS'][] = $arItem;
        }
    }
} else {
    $arResult['NEW_ITEMS'] = $arResult['ITEMS'];
}

