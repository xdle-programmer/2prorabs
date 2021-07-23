<div class="title special-conditions__head-title">
    <?$APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        Array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => ".index_inc/special_title.php",
            "EDIT_TEMPLATE" => ""
        ),
        false
    );?>
</div>
<div class="special-conditions__inner">
    <div class="special-conditions__item">
        <div class="special-conditions__title">
            <div class="special-conditions__title-icon">
                <img src="<?=SITE_TEMPLATE_PATH?>/assets/dist/src/blocks/special-conditions/assets/img/productadded.svg">
            </div>
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => ".index_inc/special_1.php",
                    "EDIT_TEMPLATE" => ""
                ),
                false
            );?>
        </div>
    </div>
    <div class="special-conditions__item">
        <div class="special-conditions__title">
            <div class="special-conditions__title-icon">
                <img src="<?=SITE_TEMPLATE_PATH?>/assets/dist/src/blocks/special-conditions/assets/img/productadded.svg">
            </div>
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => ".index_inc/special_2.php",
                    "EDIT_TEMPLATE" => ""
                ),
                false
            );?>
        </div>
    </div>
    <div class="special-conditions__item">
        <div class="special-conditions__title">
            <div class="special-conditions__title-icon">
                <img src="<?=SITE_TEMPLATE_PATH?>/assets/dist/src/blocks/special-conditions/assets/img/productadded.svg">
            </div>
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => ".index_inc/special_3.php",
                    "EDIT_TEMPLATE" => ""
                ),
                false
            );?>
        </div>
    </div>
</div>

</div><!-- /.container in header -->
</div><!-- /.special-conditions in header -->

<div class="special-abilities">
    <div class="container">
        <div class="title special-abilities__title">
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => ".index_inc/ability_title.php",
                    "EDIT_TEMPLATE" => ""
                ),
                false
            );?>
        </div>
        <div class="special-abilities__row">
            <div class="special-abilities__item">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "clients_ability",
                    Array(
                        "ICON_URL" => SITE_TEMPLATE_PATH . "/assets/dist/src/blocks/special-abilities/assets/img/storage.svg",
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => ".index_inc/ability_1.php",
                        "EDIT_TEMPLATE" => ""
                    ),
                    false
                );?>
            </div>
            <div class="special-abilities__item">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "clients_ability",
                    Array(
                        "ICON_URL" => SITE_TEMPLATE_PATH . "/assets/dist/src/blocks/special-abilities/assets/img/doc.svg",
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => ".index_inc/ability_2.php",
                        "EDIT_TEMPLATE" => ""
                    ),
                    false
                );?>
            </div>
            <div class="special-abilities__item">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "clients_ability",
                    Array(
                        "ICON_URL" => SITE_TEMPLATE_PATH . "/assets/dist/src/blocks/special-abilities/assets/img/storage.svg",
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => ".index_inc/ability_3.php",
                        "EDIT_TEMPLATE" => ""
                    ),
                    false
                );?>
            </div>
        </div>

    </div>
</div>

<div class="payment-features">
    <div class="container">
        <div class="title">
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => ".index_inc/payment_title.php",
                    "EDIT_TEMPLATE" => ""
                ),
                false
            );?>
        </div>
        <div class="payment-features__subtitle">
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => ".index_inc/payment_subtitle.php",
                    "EDIT_TEMPLATE" => ""
                ),
                false
            );?>
        </div>
        <div class="payment-features__items-box">
            <div class="payment-features__item">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "clients_ability",
                    Array(
                        "ICON_URL" => SITE_TEMPLATE_PATH . "/assets/dist/src/blocks/payment-features/assets/img/cashier.svg",
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => ".index_inc/payment_1.php",
                        "EDIT_TEMPLATE" => ""
                    ),
                    false
                );?>
            </div>
            <div class="payment-features__item">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "clients_payment",
                    Array(
                        "ICON_URL" => SITE_TEMPLATE_PATH . "/assets/dist/src/blocks/payment-features/assets/img/card.svg",
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => ".index_inc/payment_2.php",
                        "EDIT_TEMPLATE" => ""
                    ),
                    false
                );?>
            </div>
            <div class="payment-features__item">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "clients_payment",
                    Array(
                        "ICON_URL" => SITE_TEMPLATE_PATH . "/assets/dist/src/blocks/payment-features/assets/img/transfer.svg",
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => ".index_inc/payment_3.php",
                        "EDIT_TEMPLATE" => ""
                    ),
                    false
                );?>
            </div>
        </div>
    </div>
</div>

<div class="delivery-features">
    <div class="container">
        <div class="title">
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => ".index_inc/delivery_title.php",
                    "EDIT_TEMPLATE" => ""
                ),
                false
            );?>
        </div>
        <div class="delivery-features__subtitle">
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => ".index_inc/delivery_subtitle.php",
                    "EDIT_TEMPLATE" => ""
                ),
                false
            );?>
        </div>
        <div class="delivery-features__inner">
            <div class="delivery-features__advantages">
                <div class="delivery-features__advantages-item">
                    <div class="delivery-features__advantages-item-icon">
                        <img src="<?=SITE_TEMPLATE_PATH?>/assets/dist/src/blocks/delivery-features/assets/img/productadded.svg">
                    </div>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => ".index_inc/delivery_1.php",
                            "EDIT_TEMPLATE" => ""
                        ),
                        false
                    );?>
                </div>
                <div class="delivery-features__advantages-item">
                    <div class="delivery-features__advantages-item-icon">
                        <img src="<?=SITE_TEMPLATE_PATH?>/assets/dist/src/blocks/delivery-features/assets/img/productadded.svg">
                    </div>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => ".index_inc/delivery_2.php",
                            "EDIT_TEMPLATE" => ""
                        ),
                        false
                    );?>
                </div>
            </div>
            <div class="delivery-features__image-box">
                <img class="delivery-features__image" src="<?=SITE_TEMPLATE_PATH?>/assets/dist/src/blocks/delivery-features/assets/img/car.svg"></div>
        </div>
    </div>
</div>

<div><!-- For closing .container in footer -->
    <div><!-- For closing .special-conditions in footer -->
