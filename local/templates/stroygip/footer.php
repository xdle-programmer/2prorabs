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
                <img class="footer__company-logo" src="<?= SITE_TEMPLATE_PATH ?>/ts/images/logo/logo-white.svg">
            </a>
            <div class="footer__social">
                <div class="footer__social-title">Мы в социальных сетях</div>
                <div class="footer__social-items">
                    <a class="footer__social-item" href="#">
                        <svg class="footer__social-item-icon">
                            <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#fb"></use>
                        </svg>
                    </a>
                    <a class="footer__social-item" href="#">
                        <svg class="footer__social-item-icon">
                            <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#it"></use>
                        </svg>
                    </a>
                    <a class="footer__social-item" href="#">
                        <svg class="footer__social-item-icon">
                            <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#tt"></use>
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

            <? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "menu_main_footer", array(
                "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
                "CACHE_FILTER" => "N",    // Кешировать при установленном фильтре
                "CACHE_GROUPS" => "Y",    // Учитывать права доступа
                "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
                "CACHE_TYPE" => "A",    // Тип кеширования
                "COUNT_ELEMENTS" => "N",    // Показывать количество элементов в разделе
                "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",    // Показывать количество
                "FILTER_NAME" => "sectionsFilter",    // Имя массива со значениями фильтра разделов
                "IBLOCK_ID" => "1",    // Инфоблок
                "IBLOCK_TYPE" => "catalog",    // Тип инфоблока
                "SECTION_CODE" => "",    // Код раздела
                "SECTION_FIELDS" => array(    // Поля разделов
                    0 => "",
                    1 => "",
                ),
                "SECTION_ID" => $_REQUEST["SECTION_STMMID3"],    // ID раздела
                "SECTION_URL" => "",    // URL, ведущий на страницу с содержимым раздела
                "SECTION_USER_FIELDS" => array(    // Свойства разделов
                    0 => "",
                    1 => "",
                ),
                "SHOW_PARENT_NAME" => "Y",    // Показывать название раздела
                "TOP_DEPTH" => "1",    // Максимальная отображаемая глубина разделов
                "VIEW_MODE" => "LIST",    // Вид списка подразделов
            ),
                false
            ); ?>

            <div class="footer__menu-contacts">
                <div class="footer__menu-contacts-item">
                    <div class="footer__menu-contacts-title">Контакты</div>
                    <?
                    $APPLICATION->IncludeFile("/local/include/" . SITE_ID . "/footer/footer_contacts.php", array(), array(
                            "MODE" => "html",
                            "NAME" => "блок",
                            "TEMPLATE" => ""
                        )
                    );
                    ?>
                </div>
                <div class="footer__menu-contacts-item">
                    <div class="footer__menu-contacts-title">Мы принимаем</div>
                    <div class="footer__menu-contacts-payments">
                        <img class="footer__menu-contacts-payments-img footer__menu-contacts-payments-img--visa" src="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/visa.svg">
                        <img class="footer__menu-contacts-payments-img footer__menu-contacts-payments-img--mastercard"
                             src="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/mastercard.svg">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

</div> <!-- natural-group -->



<? if (!$USER->IsAuthorized()) { ?>
    <? $APPLICATION->IncludeComponent(
        "2quick:tq_auth",
        "",
        array(),
        false
    ); ?>
    <?/* $APPLICATION->IncludeComponent(
        "2quick:tq_forgot",
        "",
        array()
    ); */?>
<? } ?>


<script src="<?= SITE_TEMPLATE_PATH ?>/ts/main.js"></script>

<div class="modal-overlay"></div>
<? \nav\AppData::show() ?>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (m, e, t, r, i, k, a) {
        m[i] = m[i] || function () {
            (m[i].a = m[i].a || []).push(arguments);
        };
        m[i].l = 1 * new Date();
        k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a);
    })
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(61269028, "init", {
        clickmap: true,
        trackLinks: true,
        accurateTrackBounce: true,
        webvisor: true,
        ecommerce: "dataLayer"
    });
</script>
<noscript>
    <div><img src="https://mc.yandex.ru/watch/61269028" style="position:absolute; left:-9999px;" alt=""/></div>
</noscript>
<!-- /Yandex.Metrika counter -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-160628157-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', 'UA-160628157-1');
</script>

</body>
</html>
