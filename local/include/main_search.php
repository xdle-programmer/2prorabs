<?
define("NO_KEEP_STATISTIC", true);
require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"; 

global $USER;
CModule::IncludeModule('iblock');
CModule::IncludeModule("main");
CModule::IncludeModule('search');

print_r($_POST);

$arRes = array();
$arRes["products"] = array();



if( isset($_POST["request"]) && strlen(trim($_POST["request"]))>=3 ){
	$user_query = trim($_POST["request"]);
	
	$module_id = "iblock";
	$param1 = 'catalog';
	$param2 = 1;
	$obSearch = new CSearch($user_query, LANG, $module_id, false, $param1, $param2);
	while($arSearchObj = $obSearch->GetNext()){
		$arItem = array(
			"img" => "https://2proraba.kg/upload/resize_cache/iblock/abd/400_400_1/abd01f963019125fbeeeec4e50063156.png",
			"name" => $arSearchObj["TITLE"],
			"link" => $arSearchObj["URL"],
			"price" => "555",
		);
		
		$arRes["products"][] = $arItem;
	}
}

//print_r(json_encode($arRes));


require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php";
?>
