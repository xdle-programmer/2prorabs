<div class="consumer-rights__inner">
    <div class="consumer-rights__information">
        <div class="consumer-rights__information-title">
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => ".index_inc/main.php",
                    "EDIT_TEMPLATE" => ""
                ),
                false
            );?>
        </div>
        <div class="consumer-rights__right-title">
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => ".index_inc/link.php",
                    "EDIT_TEMPLATE" => ""
                ),
                false
            );?>
        </div>
        <div class="consumer-rights__right-description">
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => ".index_inc/additional.php",
                    "EDIT_TEMPLATE" => ""
                ),
                false
            );?>
        </div>
    </div>
    <div class="consumer-rights__image-box">
        <img class="consumer-rights__image" src="/upload/etc/oferta_preview.jpg">
    </div>
</div>
</div><!-- /.container in header -->
</div><!-- /.consumer-rights in header -->


<?$APPLICATION->IncludeComponent("nav:form", "oferta_questions", Array(), false);?>

<div><!-- For closing .container in footer -->
<div><!-- For closing .consumer-rights in footer -->
