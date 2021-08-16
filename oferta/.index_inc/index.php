<div class="section section--min-content">
    <div class="layout">
        <div class="consumer-rights__inner">
            <div class="consumer-rights__information">
                <div class="consumer-rights__information-title">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => ".index_inc/main.php",
                            "EDIT_TEMPLATE" => ""
                        ),
                        false
                    ); ?>
                </div>
                <div class="consumer-rights__right-title">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => ".index_inc/link.php",
                            "EDIT_TEMPLATE" => ""
                        ),
                        false
                    ); ?>
                </div>
                <div class="consumer-rights__right-description">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => ".index_inc/additional.php",
                            "EDIT_TEMPLATE" => ""
                        ),
                        false
                    ); ?>
                </div>
            </div>
            <div class="consumer-rights__image-box">
                <img class="consumer-rights__image" src="/upload/etc/oferta_preview.jpg">
            </div>
        </div>


<!--        --><?// $APPLICATION->IncludeComponent("nav:form", "oferta_questions", array(), false); ?>


    </div>
</div>