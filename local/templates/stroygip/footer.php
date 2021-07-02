<?

use nav\SiteOption;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
$page = $APPLICATION->GetCurPage();
?>


<? if ($page == '/personal/') { ?>
    <section class="recently-viewed recently-viewed--white">
        <? $APPLICATION->IncludeComponent(
            "bitrix:catalog.products.viewed",
            "",
            array(
                'TITLE' => 'Вы недавно смотрели',
                "ACTION_VARIABLE" => "action_cpv",
                "ADDITIONAL_PICT_PROP_1" => "-",
                "ADD_PROPERTIES_TO_BASKET" => "Y",
                "ADD_TO_BASKET_ACTION" => "ADD",
                "BASKET_URL" => "/personal/basket.php",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "3600",
                "CACHE_TYPE" => "A",
                "CONVERT_CURRENCY" => "N",
                "DEPTH" => "2",
                "DISPLAY_COMPARE" => "N",
                "ENLARGE_PRODUCT" => "STRICT",
                "HIDE_NOT_AVAILABLE" => "N",
                "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                "IBLOCK_ID" => "1",
                "IBLOCK_MODE" => "single",
                "IBLOCK_TYPE" => "catalog",
                "LABEL_PROP_1" => array(),
                "LABEL_PROP_POSITION" => "top-left",
                "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                "MESS_BTN_BUY" => "Купить",
                "MESS_BTN_DETAIL" => "Подробнее",
                "MESS_BTN_SUBSCRIBE" => "Подписаться",
                "MESS_NOT_AVAILABLE" => "Нет в наличии",
                "PAGE_ELEMENT_COUNT" => "9",
                "PARTIAL_PRODUCT_PROPERTIES" => "N",
                "PRICE_CODE" => array("BASE"),
                "PRICE_VAT_INCLUDE" => "Y",
                "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
                "PRODUCT_ID_VARIABLE" => "id",
                "PRODUCT_PROPS_VARIABLE" => "prop",
                "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
                "PRODUCT_SUBSCRIPTION" => "Y",
                "SECTION_CODE" => "",
                "SECTION_ELEMENT_CODE" => "",
                "SECTION_ELEMENT_ID" => $GLOBALS["CATALOG_CURRENT_ELEMENT_ID"],
                "SECTION_ID" => $GLOBALS["CATALOG_CURRENT_SECTION_ID"],
                "SHOW_CLOSE_POPUP" => "N",
                "SHOW_DISCOUNT_PERCENT" => "N",
                "SHOW_FROM_SECTION" => "N",
                "SHOW_MAX_QUANTITY" => "N",
                "SHOW_OLD_PRICE" => "N",
                "SHOW_PRICE_COUNT" => "1",
                "SHOW_SLIDER" => "Y",
                "SLIDER_INTERVAL" => "3000",
                "SLIDER_PROGRESS" => "N",
                "TEMPLATE_THEME" => "blue",
                "USE_ENHANCED_ECOMMERCE" => "N",
                "USE_PRICE_COUNT" => "N",
                "USE_PRODUCT_QUANTITY" => "N"
            )
        ); ?>
    </section>
<? } ?>



    <footer class="footer">
		<div class="layout footer__block">
			<div class="footer__company">
				<a class="footer__company-logo" href="#">
					<img class="footer__company-logo" src="<?=SITE_TEMPLATE_PATH?>/ts/images/logo/logo-white.svg">
				</a>
				<div class="footer__social">
					<div class="footer__social-title">Мы в социальных сетях</div>
					<div class="footer__social-items">
						<a class="footer__social-item" href="#">
							<svg class="footer__social-item-icon">
								<use xlink:href="<?=SITE_TEMPLATE_PATH?>/ts/images/icons/icons-sprite.svg#fb"></use>
							</svg>
						</a>
						<a class="footer__social-item" href="#">
							<svg class="footer__social-item-icon">
								<use xlink:href="<?=SITE_TEMPLATE_PATH?>/ts/images/icons/icons-sprite.svg#it"></use>
							</svg>
						</a>
						<a class="footer__social-item" href="#">
							<svg class="footer__social-item-icon">
								<use xlink:href="<?=SITE_TEMPLATE_PATH?>/ts/images/icons/icons-sprite.svg#tt"></use>
							</svg>
						</a>
					</div>
				</div>
				<div class="footer__copyright">
					<div class="footer__copyright-text">2прораба 2021</div>
					<div class="footer__copyright-text">Все права защищены</div>
				</div>
			</div>
			<div class="footer__menu">
				<div class="footer__menu-main">
					<a class="footer__menu-link" href="/contacts/">Контакты</a>
					<a class="footer__menu-link" href="/about/">О компании</a>
					<a class="footer__menu-link" href="/delivery-payment/">Доставка и оплата</a>
					<a class="footer__menu-link" href="/services/">Услуги</a>
					<a class="footer__menu-link" href="/vacancy/">Вакансии</a>
					<a class="footer__menu-link" href="/clients/">Сотрудничество</a>
					<a class="footer__menu-link footer__menu-link--small" href="/privacy-policy/">Политика конфиденциальности</a>
					<a class="footer__menu-link footer__menu-link--small" href="/oferta/">Договор оферты</a>
				</div>

<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "menu_main_footer", Array(
	"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
		"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",	// Показывать количество
		"FILTER_NAME" => "sectionsFilter",	// Имя массива со значениями фильтра разделов
		"IBLOCK_ID" => "1",	// Инфоблок
		"IBLOCK_TYPE" => "catalog",	// Тип инфоблока
		"SECTION_CODE" => "",	// Код раздела
		"SECTION_FIELDS" => array(	// Поля разделов
			0 => "",
			1 => "",
		),
		"SECTION_ID" => $_REQUEST["SECTION_STMMID3"],	// ID раздела
		"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
		"SECTION_USER_FIELDS" => array(	// Свойства разделов
			0 => "",
			1 => "",
		),
		"SHOW_PARENT_NAME" => "Y",	// Показывать название раздела
		"TOP_DEPTH" => "1",	// Максимальная отображаемая глубина разделов
		"VIEW_MODE" => "LIST",	// Вид списка подразделов
	),
	false
);?>

				<div class="footer__menu-contacts">
					<div class="footer__menu-contacts-item">
						<div class="footer__menu-contacts-title">Контакты</div>
<?
$APPLICATION->IncludeFile("/local/include/" . SITE_ID . "/footer/footer_contacts.php", Array(), Array(
    "MODE"      => "html",
    "NAME"      => "блок",
    "TEMPLATE"  => ""
    )
);
?>
					</div>
					<div class="footer__menu-contacts-item">
						<div class="footer__menu-contacts-title">Мы принимаем</div>
						<div class="footer__menu-contacts-payments">
							<img class="footer__menu-contacts-payments-img footer__menu-contacts-payments-img--visa" src="<?=SITE_TEMPLATE_PATH?>/ts/images/icons/visa.svg">
							<img class="footer__menu-contacts-payments-img footer__menu-contacts-payments-img--mastercard" src="<?=SITE_TEMPLATE_PATH?>/ts/images/icons/mastercard.svg">
						</div>
					</div>
				</div>
			</div>
		</div>
    </footer>

</div> <!-- natural-group -->



<?if( $APPLICATION->GetCurPage() != "/" ){?>
<div class="modal-region" id="modal-region">
    <div class="modal-region__title">Ваш город Бишкек?</div>
    <div class="modal-region__buttons"><a class="modal-region__button" href="#">Да</a><a class="modal-region__button modal-region__button--white" href="#">Изменить</a></div>
</div>
<?}?>



<? if (!$USER->IsAuthorized()) { ?>
    <? $APPLICATION->IncludeComponent(
        "2quick:tq_auth",
        "",
        array(),
        false
    ); ?>
    <? $APPLICATION->IncludeComponent(
        "2quick:tq_forgot",
        "",
        array()
    ); ?>
<? } ?>


<?if( $APPLICATION->GetCurPage() != "/" ){?>
<div class="modal-position">
    <div class="modal-map">
        <div class="thanks__close">
            <img src="<?= SITE_TEMPLATE_PATH; ?>/assets/src/blocks/modals/thanks/assets/img/close.svg">
        </div>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAUTKfNeQ5DFQP-g_N8Rg0ulxwWPnyVJq0&libraries=geometry"></script>
        <script>
        var deliveryPrice = {
            bigDeliveryKm: <?=(int) SiteOption::get(SiteOption::DELIVERY_HEAVY_PRICE)?>,
            bigDeliveryKmMinimal: <?=(int) SiteOption::get(SiteOption::DELIVERY_HEAVY_MIN_SUM)?>,
            smallDeliveryKm: <?=(int) SiteOption::get(SiteOption::DELIVERY_NORMAL_PRICE)?>,
            smallDeliveryKmMinimal: <?=(int) SiteOption::get(SiteOption::DELIVERY_NORMAL_MIN_SUM)?>,
        }

        var sliderOptions = {
            loop: <?=(SiteOption::get(SiteOption::MAIN_SLIDER_LOOP) === 'Y' ? 'true' : 'false')?>,
            autoplay: <?=(SiteOption::get(SiteOption::MAIN_SLIDER_AUTOPLAY) === 'Y' ? 'true' : 'false')?>,
            autoplayTimeout: <?=(int) SiteOption::get(SiteOption::MAIN_SLIDER_AUTOPLAY_TIMEOUT)?>,
        }
        </script>


        <div id="address-map"></div>

        <div class="modal-map__button-wrapper">

            <input class="modal-map__input basket-products__registration-input" placeholder="Адрес">
            <div class="modal-map__button-cancel button button--red">Отмена</div>
            <div class="modal-map__button button button--red">Сохранить</div>


            <!--            $origin = $_POST['o']; $destination = $_POST['d'];-->
            <!--            $api = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&language=ru&origins=".$origin."&destinations=".$destination."&key=YOUR_API_KEY");-->
            <!--            $data = json_decode($api);-->


        </div>
    </div>
</div>

<div class="modal-position">
    <div class="modal-delivery">
        <div class="thanks__close">
            <img src="<?= SITE_TEMPLATE_PATH; ?>/assets/src/blocks/modals/thanks/assets/img/close.svg">
        </div>


        <div class="container">
            <div class="title">Стоимость доставки по габаритам</div>
            <div class="cost-size__tab">
                <div class="cost-size__box">
                    <div class="cost-size__header">Вес (объем) заказа</div>
                    <div class="cost-size__row">до 300 кг (до 2м3)</div>
                    <div class="cost-size__row">От 300 кг до 500 кг (до 3м3)</div>
                    <div class="cost-size__row">От 500 кг до 1,0 тонн (до 6м3)</div>
                    <div class="cost-size__row">От 1,0 тонн до 1,5 тонн (до 10м3)</div>
                </div>
                <div class="cost-size__box">
                    <div class="cost-size__header">Цена, Сом</div>
                    <div class="cost-size__row">350</div>
                    <div class="cost-size__row">500</div>
                    <div class="cost-size__row">600</div>
                    <div class="cost-size__row">700</div>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="modal-position">
    <div class="thanks feedback_thanks">
        <div class="thanks__close">
            <img src="<?= SITE_TEMPLATE_PATH; ?>/assets/src/blocks/modals/thanks/assets/img/close.svg">
        </div>
        <div class="thanks__image-box"><img src="<?= SITE_TEMPLATE_PATH; ?>/assets/src/blocks/modals/thanks/assets/img/order.svg"></div>
        <div class="thanks__title">Спасибо за обращение</div>
        <div class="thanks__text">
            Наши менеджеры свяжутся с Вами.
        </div>
    </div>
</div>

<div class="modal-position">
    <div class="fast-call">
        <div class="fast-call__close"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/dist/src/blocks/modals/fast-call/assets/img/close.svg"></div>
        <div class="fast-call__img-box">
            <img class="fast-call__img" src="<?= SITE_TEMPLATE_PATH ?>/assets/dist/src/blocks/modals/fast-call/assets/img/call.svg"></div>
        <div class="fast-call__title">Оставьте заявку для быстрого заказа</div>
        <div class="fast-call__input-box">
            <div class="input-styled input-styled--indent">
                <label class="input-styled__label" for="input-fast1">Ваше имя</label>
                <input class="input-styled__input" type="text" id="input-fast1" name="name">
            </div>
            <div class="input-styled">
                <label class="input-styled__label" for="input-fast2">Введите ваш телефон</label>
                <input class="input-styled__input" type="phone" id="input-fast2" name="phone">
            </div>
            <a class="button button--red button--red-width fast-call__button" href="#">Заказать</a>
        </div>
    </div>
</div>

<div class="modal-position">
    <div class="feedback-modal">
        <div class="feedback-modal__close"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/dist/src/blocks/modals/fast-call/assets/img/close.svg"></div>
        <div class="feedback-modal__img-box">
            <img class="feedback-modal__img" src="<?= SITE_TEMPLATE_PATH ?>/assets/dist/src/blocks/modals/fast-call/assets/img/call.svg"></div>
        <div class="feedback-modal__title">Напишите нам</div>

        <div class="feedback-modal__input-box">
            <div class="input-styled input-styled--indent">
                <label class="input-styled__label" for="input-feedback1">Ваше имя</label>
                <input class="input-styled__input" type="text" id="input-feedback1" name="name">
            </div>

            <div class="input-styled input-styled--indent">
                <label class="input-styled__label" for="input-feedback2">Ваш телефон</label>
                <input class="input-styled__input" type="phone" id="input-feedback2" name="phone">
            </div>

            <div class="input-styled input-styled--indent">
                <label class="input-styled__label" for="input-feedback3">Email</label>
                <input class="input-styled__input" type="email" id="input-feedback3" name="email">
            </div>

            <div class="input-styled">
                <label class="input-styled__label" for="input-feedback4">Комментарий</label>
                <textarea class="input-styled__input" id="input-feedback4" name="text"></textarea>
            </div>
            <a class="button button--red button--red-width feedback-modal__button" href="#">Отправить</a>
        </div>
    </div>
</div>
<?}?>


<script src="<?=SITE_TEMPLATE_PATH?>/ts/main.2719122dbda8af010857.js"></script>

<div class="modal-overlay"></div>
<? \nav\AppData::show() ?>
</body>
</html>
