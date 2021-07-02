<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");
?><?$APPLICATION->IncludeComponent(
	"2quick:tqOrder_sef",
	"",
	Array(
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_TIME" => "86400",
		"CACHE_TYPE" => "A",
		"MESSAGE_404" => "",
		"SEF_FOLDER" => "/order/",
		"SEF_MODE" => "Y",
		"SEF_URL_TEMPLATES" => Array("confirm"=>"confirm/","confirm_order"=>"confirm_order/","payment"=>"payment/"),
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"TEXT" => ""
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>