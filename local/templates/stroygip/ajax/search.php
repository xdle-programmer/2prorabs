<?
define("NO_KEEP_STATISTIC", true);
require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"; 

global $USER;
CModule::IncludeModule('iblock');
CModule::IncludeModule("main");

//print_r($_POST);
if( is_array($_POST) ){
	
	if( $_POST["action"] == "clearValue" && strlen($_POST["param1"])>=1 ){
		$value_to_del = $_POST["param1"];
		
		$historyArray = array();
		
		$history_string = "";
		if( isset($_COOKIE["SearchHistory4"]) && count($_COOKIE["SearchHistory4"])>0 ){
			$query_pieces = explode(";", $_COOKIE["SearchHistory4"]);
			foreach( $query_pieces as $key=>$value){
				if( $value != $value_to_del ){
					$historyArray[] = $value;
					
					if( count($historyArray)>=3 ){
						break;
					}
				}
			}
		}
		
		$history_string = implode(";", $historyArray);
		setcookie("SearchHistory4", $history_string, 2147483647, "/", "2proraba.kg", 1);
	}
	
	echo "ok";
	
}

require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php";
?>
