<?
define("NO_KEEP_STATISTIC", true);
require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"; 


if( isset($_POST["name"]) && isset($_POST["mail_phone"]) ){
	$user_name = trim($_POST["name"]);
	$user_contact = trim($_POST["mail_phone"]);
	
	$arEventFields = array(
		"NAME"    => $user_name,
		"CONTACT" => $user_contact,
    );
	$MID = CEvent::Send("ORDER_HELP_FORM", array("s1"), $arEventFields);
	
	if( $MID > 0 ){
		echo "ok";
	}
	
}

require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php";
?>
