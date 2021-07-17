<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$res = CIBlockElement::GetByID(329212);
if($ar_res = $res->GetNext()){
	$arResult['BLOCK_GRID'] = $ar_res['PREVIEW_TEXT'];
}


$arElementIDs = array();
if( is_array($arResult['ITEMS']) && count($arResult['ITEMS'])>0 ){
	foreach ($arResult["ITEMS"] as $key => $arElement) {
		$arElementIDs[] = $arElement["ID"];
	}
}


$arSelect = ["ID", "NAME", "DETAIL_TEXT", "PROPERTY_PRODUCT", "PROPERTY_RAITING"];
$arFilter = ["IBLOCK_ID" => 46, "ACTIVE" => "Y", 'PROPERTY_PRODUCT' => $arElementIDs];
$res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
while ($ob = $res->Fetch()) {	
	$arResult['REVIEWS_DATA'][$ob["PROPERTY_PRODUCT_VALUE"]][] = $ob;
}

foreach ($arResult["ITEMS"] as $key => $arElement) {
	if( is_array($arResult['REVIEWS_DATA'][$arElement["ID"]]) ){
		$rating_count = 0;
		$rating_sum = 0;

		foreach ($arResult["REVIEWS_DATA"][$arElement["ID"]] as $key1 => $arReview) {
			
			if( intval($arReview["PROPERTY_RAITING_VALUE"])>0 ){
				$arResult["REVIEWS_DATA_STARS"][$arElement["ID"]][$arReview["PROPERTY_RAITING_VALUE"]][] = $arReview["ID"];
				
				$rating_count++; 
				$rating_sum += $arReview["PROPERTY_RAITING_VALUE"];
			}
			
			$arResult["REVIEWS_DATA_NUM"][$arElement["ID"]]["COUNT"] = $rating_count;
			$arResult["REVIEWS_DATA_NUM"][$arElement["ID"]]["SUMM"] = $rating_sum;
			$arResult["REVIEWS_DATA_NUM"][$arElement["ID"]]["AVERAGE"] = round($rating_sum/$rating_count);
			
			if( $rating_count == 1 ){
				$arResult["REVIEWS_DATA_NUM"][$arElement["ID"]]["COUNT_TEXT"] = $rating_count." отзыв";
			}elseif( $rating_count > 1 && $rating_count < 5 ){
				$arResult["REVIEWS_DATA_NUM"][$arElement["ID"]]["COUNT_TEXT"] = $rating_count." отзыва";
			}else{
				$arResult["REVIEWS_DATA_NUM"][$arElement["ID"]]["COUNT_TEXT"] = $rating_count." отзывов";
			}
			
		}
		
	}
}
