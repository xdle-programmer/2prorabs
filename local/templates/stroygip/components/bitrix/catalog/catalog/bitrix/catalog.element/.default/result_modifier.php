<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$arResult['GALLERY'] = [];

if (!empty($arResult['DETAIL_PICTURE'])) {
    $arResult['GALLERY'][] = [
        'THUMBNAIL' => CFile::ResizeImageGet($arResult['DETAIL_PICTURE']['ID'], ['width' => 136, 'height' => 144], BX_RESIZE_IMAGE_EXACT)['src'],
        'BIG' => CFile::ResizeImageGet($arResult['DETAIL_PICTURE']['ID'], ['width' => 576, 'height' => 464], BX_RESIZE_IMAGE_PROPORTIONAL)['src'],
    ];
} elseif (!empty($arResult['PREVIEW_PICTURE'])) {
    $arResult['GALLERY'][] = [
        'THUMBNAIL' => CFile::ResizeImageGet($arResult['PREVIEW_PICTURE']['ID'], ['width' => 136, 'height' => 144], BX_RESIZE_IMAGE_EXACT)['src'],
        'BIG' => CFile::ResizeImageGet($arResult['PREVIEW_PICTURE']['ID'], ['width' => 576, 'height' => 464], BX_RESIZE_IMAGE_PROPORTIONAL)['src'],
    ];
}

foreach ($arResult['PROPERTIES']['GALLERY']['VALUE'] as $ph) {
    $arResult['GALLERY'][] = [
        'THUMBNAIL' => CFile::ResizeImageGet($ph, ['width' => 136, 'height' => 144], BX_RESIZE_IMAGE_EXACT)['src'],
        'BIG' => CFile::ResizeImageGet($ph, ['width' => 576, 'height' => 464], BX_RESIZE_IMAGE_PROPORTIONAL)['src'],
    ];
}

$arResult['DETAIL_PICTURE']['URL'] = CFile::ResizeImageGet($arResult['DETAIL_PICTURE']['ID'], ['width' => 576, 'height' => 464], BX_RESIZE_IMAGE_PROPORTIONAL)['src'];
$arResult['PREVIEW_PICTURE']['URL'] = CFile::ResizeImageGet($arResult['PREVIEW_PICTURE']['ID'], ['width' => 576, 'height' => 464], BX_RESIZE_IMAGE_PROPORTIONAL)['src'];

$component->arResult['ID'] = $arResult['ID'];
$component->SetResultCacheKeys(['ID']);


$arSelect = ["ID", "NAME"];
$arFilter = ["IBLOCK_ID" => IntVal(IBLOCK_STORAGES), "ACTIVE" => "Y"];
$res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);

while ($ob = $res->Fetch()) {
    $arResult['STORAGES'][$ob['ID']] = $ob['NAME'];
}

$arSelect = ["ID", "PROPERTY_PRODUCT_ID", "PROPERTY_STORAGE_ID", "PROPERTY_QUANTITY"];
$arFilter = ["IBLOCK_ID" => IntVal(IBLOCK_BALANCE), "ACTIVE" => "Y", 'PROPERTY_PRODUCT_ID' => $arResult['ID']];
$res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);

while ($ob = $res->Fetch()) {
    $arResult['BALANCE'][] = $ob;
}

if (!empty($arResult['PROPERTIES']['BRAND']['VALUE'])) {
    $arResult['PROPERTIES']['BRAND'] = \CIBlockFormatProperties::GetDisplayValue($arResult, $arResult['PROPERTIES']['BRAND'], 'catalog_out');
}

\nav\Misc\addTopAdminPanelIblockElementLink([
    'ID' => $arResult['ID'],
    'IBLOCK_ID' => $arParams['IBLOCK_ID'],
    'IBLOCK_TYPE_ID' => $arParams['IBLOCK_TYPE_ID'],
    'TEXT' => 'Товар',
]);
