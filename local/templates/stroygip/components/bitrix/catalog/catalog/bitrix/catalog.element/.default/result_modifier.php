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
        'BIG' => $arResult['DETAIL_PICTURE']['SRC'],
    ];
} elseif (!empty($arResult['PREVIEW_PICTURE'])) {
    $arResult['GALLERY'][] = [
        'THUMBNAIL' => CFile::ResizeImageGet($arResult['PREVIEW_PICTURE']['ID'], ['width' => 136, 'height' => 144], BX_RESIZE_IMAGE_EXACT)['src'],
        'BIG' => $arResult['PREVIEW_PICTURE']['SRC'],
    ];
}

foreach ($arResult['PROPERTIES']['GALLERY']['VALUE'] as $ph) {
	$arGalleryFile = CFile::GetFileArray($ph);
    $arResult['GALLERY'][] = [
        'THUMBNAIL' => CFile::ResizeImageGet($ph, ['width' => 136, 'height' => 144], BX_RESIZE_IMAGE_EXACT)['src'],
        'BIG' => $arGalleryFile['SRC'],
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


$rating_count = 0;
$rating_sum = 0;
$arSelect = ["ID", "NAME", "DETAIL_TEXT", "PROPERTY_PRODUCT", "PROPERTY_RAITING"];
$arFilter = ["IBLOCK_ID" => 46, "ACTIVE" => "Y", 'PROPERTY_PRODUCT' => $arResult['ID']];
$res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
while ($ob = $res->Fetch()) {
    $arResult['REVIEWS_DATA'][] = $ob;
	
	if( intval($ob["PROPERTY_RAITING_VALUE"])>0 ){
		$arResult["REVIEWS_DATA_STARS"][$ob["PROPERTY_RAITING_VALUE"]][] = $ob["ID"];
		
		$rating_count++; 
		$rating_sum += $ob["PROPERTY_RAITING_VALUE"];
	}
	
	$arResult["REVIEWS_DATA_NUM"]["COUNT"] = $rating_count;
	$arResult["REVIEWS_DATA_NUM"]["SUMM"] = $rating_sum;
	$arResult["REVIEWS_DATA_NUM"]["AVERAGE"] = round($rating_sum/$rating_count);
}

if( is_array($arResult["REVIEWS_DATA_STARS"]) && count($arResult["REVIEWS_DATA_STARS"])>0 ){
	foreach( $arResult["REVIEWS_DATA_STARS"] as $star=>$reviews ){
		$arResult["REVIEWS_DATA_NUM"]["STARS_STAT"][$star] = round( (100*count($reviews))/$arResult["REVIEWS_DATA_NUM"]["COUNT"] );
	}
}