<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$arResult['CATALOG_ITEM_ID'] = [];
foreach ($arResult['ITEMS'] as $item) {
    if (empty($item['PROPERTIES']['ITEM']['VALUE'])) continue;
    $arResult['CATALOG_ITEM_ID'][$item['PROPERTIES']['ITEM']['VALUE']] = $item['PROPERTIES']['ITEM']['VALUE'];

}


if (!empty($item['PROPERTIES']['ITEM']['VALUE'])) {
    CModule::IncludeModule('sale');
    CModule::IncludeModule('catalog');
    $arSelect = Array("ID", "IBLOCK_ID", "DETAIL_PAGE_URL", 'NAME', 'PROPERTY_ART_NUMBER', 'PROPERTY_RATING', 'PROPERTY_MODEL', 'PREVIEW_PICTURE');
    $arFilter = Array("IBLOCK_ID" => IBLOCK_ID_CATALOG, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y",'=ID'=>$item['PROPERTIES']['ITEM']['VALUE']);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNext()) {
        if (!empty($ob['PREVIEW_PICTURE'])) {

            $ob['PREVIEW_PICTURE'] = CFile::ResizeImageGet($ob['PREVIEW_PICTURE'],['width' => 184, 'height' => 184], BX_RESIZE_IMAGE_PROPORTIONAL )['src'];
        }
        $ob['PRICE'] = CCatalogProduct::GetOptimalPrice($ob['ID'], 1, $USER->GetUserGroupArray());
        $arResult['CATALOG_ITEM'][$ob['ID']] = $ob;
    }
}
