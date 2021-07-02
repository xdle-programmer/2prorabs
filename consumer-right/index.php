<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Права потребителей");
?><div class="consumer-rights">
	<div class="container">
		 <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"bread",
	Array(
		"COMPONENT_TEMPLATE" => "bread",
		"PATH" => "",
		"SITE_ID" => "s1",
		"START_FROM" => "0"
	)
);?>
		<div class="title">
			<?$APPLICATION->ShowTitle(false)?>
		</div>
		<div class="consumer-rights__inner">
			<div class="consumer-rights__information">
				 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => "/local/include/consumer/mainInfo.php"
	)
);?>
			</div>
			<div class="consumer-rights__image-box">
			</div>
		</div>
	</div>
</div>
    <?$APPLICATION->IncludeComponent(
	"tqComponents:main.feedback",
	"",
	Array(
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"COMPONENT_TEMPLATE" => "",
		"EMAIL_TO" => "",
		"EVENT_MESSAGE_ID" => array(0=>"",),
		"FILE_SEND" => "N",
		"INFOBLOCKADD" => "Y",
		"INFOBLOCKID" => "8",
		"MULTI_FILES" => "N",
		"OK_TEXT" => "Спасибо, ваше сообщение отправлено",
		"REQUIRED_FIELDS" => array(0=>"NONE",),
		"USE_CAPTCHA" => "N"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>