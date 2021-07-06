<? 
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

foreach ($arResult['ITEMS'] as $key=>$item) {
    if( isset($item['PROPERTIES']['FILE']['VALUE']) && strlen($item['PROPERTIES']['FILE']['VALUE'])>0 ){
		$arResult["ITEMS"][$key]["PROPERTIES"]['FILE']["ARR"] = CFile::GetFileArray($item['PROPERTIES']['FILE']['VALUE']);
	}
}
?>
