<?$APPLICATION->IncludeComponent(
    "DBdev:main.feedback",
    "vacancy",
    Array(
        "AJAX_MODE" => "Y",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "COMPONENT_TEMPLATE" => "feedback",
        "EMAIL_TO" => "idoomp@mail.ru",
        "EVENT_MESSAGE_ID" => array(0=>"54",),
        "INFOBLOCKADD" => "Y",
        "INFOBLOCKID" => "41",
        "OK_TEXT" => "Спасибо, ваше сообщение принято.",
        "REQUIRED_FIELDS" => array(0=>"NONE",),
        "USE_CAPTCHA" => "N",
        "MULTI_FILES"=>"Y",
        "FILE_SEND"=>"Y",
	    "PRODUCT_ID" => $arResult['ID'],
	    "PRODUCT_NAME" => $arResult['NAME'],
	    "DEFAULT_NAME" => 'Отклик на вакансию '.$arResult['NAME'],
    )
);?>

</div>
</div>
</div>