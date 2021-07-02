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
<a class="button button--red-width button button--red special-conditions__button js-registration-popup" href="#">Зарегистрироваться</a>
</div><!-- /.container in header -->
</div><!-- /.special-conditions in header -->
<div class="watch-video">
    <div class="title title--white">Посмотрите видео о нашей компании</div>
    <div class="watch-video__video-box">
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => ".index_inc/company_video.php",
                "EDIT_TEMPLATE" => ""
            ),
            false
        );?>
    </div>
</div>
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
        <div class="feedback-now feedback-now--mt">
            <div class="feedback-now__inner feedback-now__inner--padding">
                <div class="feedback-now__container">
                    <div class="feedback-now__title">Воспользуйтесь специальными возможностями <br> личного кабинета</div>
                    <div class="feedback-now__text">Откройте для себя дополнительные возможности личного кабинета.</div>
                </div>
                <div class="feedback-now__button"><a class="button" href="#">Зарегистрироваться</a></div>
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
<section class="find-us find-us--light-blue">
    <div class="container">
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "clients_more",
            Array(
                "VIDEO_URL" => Array(
                    0 => "/local/templates/stroygip/assets/dist/src/videos/video.mp4",
                    1 => "/local/templates/stroygip/assets/dist/src/videos/video.mp4",
                    2 => "/local/templates/stroygip/assets/dist/src/videos/video.mp4",
                ),
                "AREA_FILE_SHOW" => "file",
                "PATH" => ".index_inc/more.php",
                "EDIT_TEMPLATE" => ""
            ),
            false
        );?>
    </div>
</section>

<div><!-- For closing .container in footer -->
    <div><!-- For closing .special-conditions in footer -->
