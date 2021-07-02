<?

use Bitrix\Main\Page\Asset;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

global $USER;
/*$GLOBALS['sectionsFilter']['UF_SHOW_IN_MAIN'] = '1';*/

\nav\AppData::add([
    'userId' => (int) $USER->GetID(),
    'sessid' => bitrix_sessid(),
]);
?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/plugins/owl-carousel/dist/assets/owl.carousel.min.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/plugins/owl-carousel/dist/assets/owl.theme.default.min.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/plugins/select2/dist/css/select2.min.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/plugins/fancybox-master/dist/jquery.fancybox.min.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/plugins/range-slider/css/ion.rangeSlider.min.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/dist/libs.css");

        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/dist/style.css");

        // This stylesheet should become main
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/index.css");

        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/dist/lightbox.min.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/costume.css");
        Asset::getInstance()->addString('<meta name="viewport" content="width=device-width, initial-scale=1.0">');
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/dist/libs.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/dist/main.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/dist/lightbox.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/plugins/jquery.inputmask.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/dist/style.js");
        Asset::getInstance()->addJs('https://www.google.com/recaptcha/api.js');
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/costume.js");
        ?>

        <? if ($_SERVER['REMOTE_ADDR'] !== '37.193.179.101'): ?>
            <style>#bx-panel { position: fixed !important; left: 0; bottom: 0; }</style>
        <? endif; ?>

        <? $APPLICATION->ShowHead(); ?>
        <title><? $APPLICATION->ShowTitle(); ?></title>
        <!-- Yandex.Metrika counter -->
        <script type="text/javascript" >
           (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
           m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
           (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

           ym(61269028, "init", {
                clickmap:true,
                trackLinks:true,
                accurateTrackBounce:true,
                webvisor:true,
                ecommerce:"dataLayer"
           });
        </script>
        <noscript><div><img src="https://mc.yandex.ru/watch/61269028" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
        <!-- /Yandex.Metrika counter -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-160628157-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-160628157-1');
</script>
    </head>
<body>
    <div id="panel">
        <? $APPLICATION->ShowPanel(); ?>
    </div>
    <header class="header">
    	<!-- <div class="preloader">
    		<div class="center">
    			<div class="down">
    				<div class="up">
    					<div class="squeeze">
    						<div class="rotate-in">
    							<div class="rotate-out">
    								<div class="square" align="center">
    								</div>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>
    			<div class="shadow"></div>
    		</div>
    	</div> -->
        <div class="container">
            <div class="header__inner">
                <a class="your-country" href="/contacts/">
                    <img class="your-country__img" src="<?= SITE_TEMPLATE_PATH ?>/assets/src/images/icons/maps.svg">Адреса магазинов</a>

                <nav class="nav">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "top",
                        array(
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "left",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "2",
                            "MENU_CACHE_GET_VARS" => array(""),
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "ROOT_MENU_TYPE" => "top",
                            "USE_EXT" => "N"
                        )
                    ); ?>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/local/include/" . SITE_ID . "/header/phone.php"
                        )
                    ); ?>
                    <div class="switch-language">
                        <div class="switch-language__container">
                            <input class="switch-language__switch" type="radio" name="radio" value="1" id="radio-1" checked>
                            <label class="switch-language__label" for="radio-1"><span class="switch-language__name">Kg</span></label>
                            <input class="switch-language__switch" type="radio" name="radio" value="2" id="radio-2">
                            <label class="switch-language__label" for="radio-2"><span class="switch-language__name">Ru</span></label>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <div class="scroll-panel">
        <div class="information-panel">
            <div class="container">
                <div class="information-panel__inner">
                    <div class="information-panel__box">

                        <a href="<?=SITE_DIR?>" class="information-panel__logo-link">
                            <div class="logo" src="<?= SITE_TEMPLATE_PATH ?>/assets/src/images/icons/logotip.png"></div>
                        </a>

                        <div class="information-panel__search">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:search.form",
                                "search",
                                array(
                                    'QUERY' => $_REQUEST['q'],
                                    "PAGE" => "#SITE_DIR#catalog/",
                                    "USE_SUGGEST" => "N"
                                )
                            ); ?>

                        </div>
                    </div>

                    <div class="information-panel__user-panel">


                        <? $APPLICATION->IncludeComponent(
                            "bitrix:sale.basket.basket.line",
                            "header",
                            array(
                                "COMPONENT_TEMPLATE" => "header",
                                "PATH_TO_BASKET" => SITE_DIR . "basket/",
                                "PATH_TO_ORDER" => SITE_DIR . "order/",
                                "SHOW_NUM_PRODUCTS" => "Y",
                                "SHOW_TOTAL_PRICE" => "Y",
                                "SHOW_EMPTY_VALUES" => "Y",
                                "SHOW_PERSONAL_LINK" => "Y",
                                "PATH_TO_PERSONAL" => SITE_DIR . "personal/",
                                "SHOW_AUTHOR" => "N",
                                "PATH_TO_AUTHORIZE" => "",
                                "SHOW_REGISTRATION" => "Y",
                                "PATH_TO_REGISTER" => SITE_DIR . "login/",
                                "PATH_TO_PROFILE" => SITE_DIR . "personal/",
                                "SHOW_PRODUCTS" => "N",
                                "POSITION_FIXED" => "N",
                                "HIDE_ON_BASKET_PAGES" => "Y"
                            ),
                            false
                        ); ?>

                    </div>
                </div>
            </div>
        </div>


        <? $APPLICATION->IncludeComponent(
            "bitrix:catalog.section.list",
            "main",
            array(
                "ADD_SECTIONS_CHAIN" => "N",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "COUNT_ELEMENTS" => "Y",
                "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
                "FILTER_NAME" => "sectionsFilter",
                "IBLOCK_ID" => "1",
                "IBLOCK_TYPE" => "catalog",
                "SECTION_CODE" => "",
                "SECTION_FIELDS" => array(
                    0 => "UF_ICON",
                    1 => "PICTURE",
                ),
                "SECTION_ID" => "",
                "SECTION_URL" => "",
                "SECTION_USER_FIELDS" => array(
                    0 => "UF_SVG",
                    1 => "UF_ICON",
                    2 => "UF_SHOW_IN_MAIN",
                ),
                "SHOW_PARENT_NAME" => "Y",
                "TOP_DEPTH" => "4",
                "VIEW_MODE" => "LIST",
                "COMPONENT_TEMPLATE" => "main"
            ),
            false
        ); ?>


    </div>

    <? if ($APPLICATION->GetProperty('bread') == 'Y') { ?>
        <div class="<?=$APPLICATION->getProperty('class')?:'basket-products'?>">
        <div class="container">
        <? $APPLICATION->IncludeComponent(
            "bitrix:breadcrumb",
            "bread",
            array(
                "PATH" => "",
                "SITE_ID" => "s1",
                "START_FROM" => "0",
                "COMPONENT_TEMPLATE" => "bread"
            ),
            false
        ); ?>
    <? } ?>

<? if ($APPLICATION->GetProperty('personal_menu') === 'Y'): ?>
    <div class="container">
        <div class="personal-area__grid">
            <? $APPLICATION->IncludeComponent(
                "2quick:wrap",
                "personalMenu",
                array(),
                false
            ); ?>
<? endif; ?>