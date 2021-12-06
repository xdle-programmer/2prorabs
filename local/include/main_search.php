<?
define("NO_KEEP_STATISTIC", true);
require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"; 

global $USER;
CModule::IncludeModule('iblock');
CModule::IncludeModule("main");
CModule::IncludeModule('search');

//print_r($_POST);

$request_body = file_get_contents('php://input');
$data1 = json_decode($request_body);
$user_query = trim($data1->request);

$arRes = array();
$arRes["products"] = array();



if( strlen(trim($user_query))>=3 ){
	$module_id = "iblock";
	$param1 = 'catalog';
	$param2 = 1;
	$obSearch = new CSearch($user_query, LANG, $module_id, false, $param1, $param2);
	while($arSearchObj = $obSearch->GetNext()){
		
		$res_item = \CIBlockElement::GetList(
		   array(),
		   array('IBLOCK_ID' => 1, '=AVAILABLE'=>'Y', '=ID'=>$arSearchObj["ITEM_ID"]),
		   false,
		   false,
		   array('ID', 'NAME', 'IBLOCK_ID', 'PRICE_1', 'AVAILABLE', 'PREVIEW_PICTURE', 'DETAIL_PICTURE')
		);
		if($ar_res = $res_item->GetNext()){
			
			$arItem = array(
				"id" => $arSearchObj["ITEM_ID"],
				"img" => "",
				"name" => $arSearchObj["TITLE"],
				"link" => $arSearchObj["URL"],
				"price" => intval($ar_res["PRICE_1"]),
			);
		
			if( strlen($ar_res["PREVIEW_PICTURE"])>0 ){
				$file = CFile::ResizeImageGet($ar_res['PREVIEW_PICTURE'], array('width'=>60, 'height'=>60), BX_RESIZE_IMAGE_PROPORTIONAL, true);
				$arItem["img"] = $file["src"];
			}
			if( empty($arItem["img"]) && strlen($ar_res["DETAIL_PICTURE"])>0 ){
				$file = CFile::ResizeImageGet($ar_res['DETAIL_PICTURE'], array('width'=>60, 'height'=>60), BX_RESIZE_IMAGE_PROPORTIONAL, true);
				$arItem["img"] = $file["src"];
			}
			if( empty($arItem["img"]) ){
				$arItem["img"] = "/local/templates/stroygip/img/no-image.png";
			}
			
		}
		
		if( intval($arItem["price"])>0 ){
			$arRes["products"][] = $arItem;	
		}
		
		
		if( count($arRes["products"])>= 20 ){
			break;
		}
	}
}

print_r(json_encode($arRes));


require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php";
?>
