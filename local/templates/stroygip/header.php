<?

use Bitrix\Main\Page\Asset;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

global $USER;
/*$GLOBALS['sectionsFilter']['UF_SHOW_IN_MAIN'] = '1';*/

\nav\AppData::add([
    'userId' => (int)$USER->GetID(),
    'sessid' => bitrix_sessid(),
]);
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?
	//"/order/confirm_order/"
	$arr_ntu = array("/", "/basket/", "/order/", "/order/payment/", "/order/confirm_order/", "/personal/orders/", "/personal/credentials/", "/personal/viewed/", "/personal/estimates/", "/compare/", "/favorites/");
	$arr_ntu_clear = array("/basket/", "/order/", "/order/payment/", "/order/confirm_order/");
	$arr_ntu_lk = array("/personal/orders/", "/personal/credentials/", "/personal/viewed/", "/personal/estimates/", "/compare/", "/favorites/");

    /*if ( !in_array($APPLICATION->GetCurPage(), $arr_ntu) && strpos($APPLICATION->GetCurDir(), '/catalog/') === false ) {
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/dist/libs.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/dist/style.css");

        // This stylesheet should become main
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/index.css");
    }


	if ( !in_array($APPLICATION->GetCurPage(), $arr_ntu) && strpos($APPLICATION->GetCurDir(), '/catalog/') === false ) {
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/plugins/owl-carousel/dist/assets/owl.carousel.min.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/plugins/owl-carousel/dist/assets/owl.theme.default.min.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/plugins/select2/dist/css/select2.min.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/plugins/fancybox-master/dist/jquery.fancybox.min.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/plugins/range-slider/css/ion.rangeSlider.min.css");

		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/dist/lightbox.min.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/costume.css");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/dist/libs.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/dist/main.js");
		Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/dist/lightbox.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/plugins/jquery.inputmask.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/dist/style.js");
	}*/


    Asset::getInstance()->addString('<meta name="viewport" content="width=device-width, initial-scale=1.0">');

	//Asset::getInstance()->addJs("https://maps.googleapis.com/maps/api/js?sensor=false");

    Asset::getInstance()->addJs('https://www.google.com/recaptcha/api.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/costume.js");
    ?>

    <?$APPLICATION->ShowHead();?>
    <title><? $APPLICATION->ShowTitle(); ?></title>

    <link href="<?=SITE_TEMPLATE_PATH?>/ts/main.css" rel="stylesheet">
</head>

<body <?if( in_array($APPLICATION->GetCurPage(), $arr_ntu_clear) ):?>class="clear-page"<? endif; ?>>
<div id="panel">
    <?$APPLICATION->ShowPanel();?>
</div>

<?
if( CModule::IncludeModule("search") ){
	$arExistedPhrases = array();
	if( is_array($_SESSION["searchPopular"]) && count($_SESSION["searchPopular"])>0 ){
		$arExistedPhrases = $_SESSION["searchPopular"];
	}else{
		$dbStatistic = \CSearchStatistic::GetList(['RESULT_COUNT' => 'DESC'], false, false, false);
		$dbStatistic->NavStart(50);
		while ($arStatistic = $dbStatistic->Fetch()) {
			if( strlen($arStatistic["PHRASE"])>=3 && !in_array(trim($arStatistic["PHRASE"]), $arExistedPhrases) ){
				$pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
				if( !preg_match($pattern, $arStatistic["PHRASE"]) ){
					$arExistedPhrases[] = trim($arStatistic["PHRASE"]);
				}
			} 
		}
		
		$_SESSION["searchPopular"] = $arExistedPhrases;
	}
}

if( CModule::IncludeModule('iblock') ){
	$arPPSections = array();
	
	if( isset($_SESSION["productsPopular"]) && strlen($_SESSION["productsPopular"])>0 ){
		$arPopularJson = $_SESSION["productsPopular"];
		$arPopularSectJson = $_SESSION["sectionsPopular"];
	}else{
		$arPopularJson = "[]";
		$arPopularProducts = array();
		$arPPSelect = Array('ID', 'NAME', 'IBLOCK_ID', 'IBLOCK_SECTION_ID', 'PRICE_1', 'DETAIL_PAGE_URL', 'AVAILABLE', 'PREVIEW_PICTURE', 'DETAIL_PICTURE');
		$arPPFilter = Array("IBLOCK_ID"=>1, "ACTIVE"=>"Y", 'AVAILABLE'=>'Y');
		$res = CIBlockElement::GetList(Array("show_counter"=>"desc"), $arPPFilter, false, Array("nPageSize"=>10), $arPPSelect);
		while($ob = $res->GetNextElement()){
			$arFields = $ob->GetFields();
			
			if( count($arPPSections)<=10 ){
				$arPPSections[$arFields["IBLOCK_SECTION_ID"]] = $arFields["IBLOCK_SECTION_ID"];
			}
	
			$arItem = array(
				"id" => $arFields["ID"],
				"img" => "",
				"name" => $arFields["NAME"],
				"link" => $arFields["DETAIL_PAGE_URL"],
				"price" => intval($arFields["PRICE_1"]),
			);

			if( strlen($arFields["PREVIEW_PICTURE"])>0 ){
				$file = CFile::ResizeImageGet($arFields['PREVIEW_PICTURE'], array('width'=>60, 'height'=>60), BX_RESIZE_IMAGE_PROPORTIONAL, true);
				$arItem["img"] = $file["src"];
			}
			if( empty($arItem["img"]) && strlen($arFields["DETAIL_PICTURE"])>0 ){
				$file = CFile::ResizeImageGet($arFields['DETAIL_PICTURE'], array('width'=>60, 'height'=>60), BX_RESIZE_IMAGE_PROPORTIONAL, true);
				$arItem["img"] = $file["src"];
			}
			if( empty($arItem["img"]) ){
				$arItem["img"] = "/local/templates/stroygip/img/no-image.png";
			}
			
			$arPopularProducts[] = $arItem;
		}
		
		if( count($arPopularProducts)>0 ){
			$arPopularJson = json_encode($arPopularProducts);
		}
		$_SESSION["productsPopular"] = $arPopularJson;
		
		
		$arPopularSectJson = "[]";
		$arMainCategories = array();
		$arTmpCats = array();
		foreach( $arPPSections as $key1=>$sect_id ){
			$list = CIBlockSection::GetNavChain(1, $sect_id, array(), true);
			
			if( !in_array($list[0]["CODE"], $arTmpCats) ){
				$arSectItem = array(
					"name" => $list[0]["NAME"],
					"link" => "/catalog/".$list[0]["CODE"]."/",
				);
				$arMainCategories[] = $arSectItem;
				
				$arTmpCats[] = $list[0]["CODE"];
			}
			
			if( count($arMainCategories)>=3 ){
				break;
			}
		}
		
		if( count($arMainCategories)>0 ){
			$arPopularSectJson = json_encode($arMainCategories);
		}
		$_SESSION["sectionsPopular"] = $arPopularSectJson;
	}
}
?>
 
<script>
window.searchHintInitData = {
    products: <?=$arPopularJson?>,
    history: [
		<?
		if( isset($_COOKIE["SearchHistory4"]) && count($_COOKIE["SearchHistory4"])>0 ){
			$query_pieces = explode(";", $_COOKIE["SearchHistory4"]);
			foreach( $query_pieces as $key=>$value){
				echo "{";
				echo "name: '".$value."',";
				echo "link: '/catalog/?q=".$value."',";
				echo "},";
			}
		}
		?>
    ],
    popular: [
		<?
		if( count($arExistedPhrases)>0 ){
			foreach( $arExistedPhrases as $key=>$value){
				echo "{";
				echo "name: '".$value."',";
				echo "link: '/catalog/?q=".$value."',";
				echo "},";
				
				if( $key >= 3 ){
					break;
				}
			}
		}
		?>
    ],
    category: <?=$arPopularSectJson?>,
};
window.searchHintUrl = '/local/include/main_search.php';

window.currentLangCenter = [42.86330569498411, 74.61784422778682];
</script>

<?include $_SERVER['DOCUMENT_ROOT']."/local/include/basket_list.php";?>

<?if( in_array($APPLICATION->GetCurPage(), $arr_ntu_clear) ):?>
	<div class="header-clear layout layout--small">
		<a class="header-clear__logo" href="/">
			<img class="header-clear__logo-img" src="/local/templates/stroygip/ts/images/logo/logo-black.svg">
		</a>
		<div class="header-clear__title"><?$APPLICATION->ShowTitle(false);?></div>
	</div>

	<section class="section">
		<div class="layout layout--small">
<?endif;?>


<?if( !in_array($APPLICATION->GetCurPage(), $arr_ntu_clear) ){?>
	<div class="menu">
		<div class="menu__wrapper layout">
			<div class="menu__header">
				<a class="menu__logo" href="/">
					<img class="menu__logo-img" src="<?= SITE_TEMPLATE_PATH ?>/ts/images/logo/logo-black.svg">
				</a>
				<div class="menu__close">
					<svg class="menu__close-icon">
						<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#close"></use>
					</svg>
				</div>
			</div>
			<div class="menu__block" data-menu-name="mobile-menu">
				<div class="menu__items">
					<div class="menu__category-item menu__category-item--small">
						<svg class="menu__category-icon menu__category-icon--small">
							<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#catalog"></use>
						</svg>
						<div class="menu__category">
							<div class="menu__category-title" data-menu-target="main">Каталог</div>
							<div class="menu__mobile-desc" data-menu-target="main">Удобный каталог 45 000 лучших товаров магазинов 2прораба
								<div class="menu__mobile-button" data-menu-target="main">
									<svg class="menu__mobile-button-icon">
										<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#arrow"></use>
									</svg>
								</div>
							</div>
						</div>
					</div>


					<a class="menu__category-item menu__category-item--small" href="/catalog/sale/">
						<svg class="menu__category-icon menu__category-icon--small">
							<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#sale"></use>
						</svg>
						<div class="menu__category">
							<div class="menu__category-title">Акции</div>
							<div class="menu__mobile-desc">Лучшие и самые выгодные акции в магазинах</div>
						</div>
					</a>
					<a class="menu__category-item menu__category-item--small" href="/compare/">
						<svg class="menu__category-icon menu__category-icon--small">
							<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#compare"></use>
						</svg>
						<div class="menu__category">
							<div class="menu__category-title">Сравнение</div>
							<div class="menu__mobile-desc">Удобное сравнение товаров по характеристикам</div>
						</div>
					</a>
					<a class="menu__category-item menu__category-item--small" href="/favorites/">
						<svg class="menu__category-icon menu__category-icon--small">
							<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#favorite"></use>
						</svg>
						<div class="menu__category">
							<div class="menu__category-title">Избранное</div>
							<div class="menu__mobile-desc">Избранные товары, которые вы не хотели бы потерять</div>
						</div>
					</a>
					<a class="menu__category-item menu__category-item--not-mobile-icon" href="/about/">
						<div class="menu__category">
							<div class="menu__category-title">О компании</div>
						</div>
					</a>
					<a class="menu__category-item menu__category-item--not-mobile-icon" href="/delivery-payment/">
						<div class="menu__category">
							<div class="menu__category-title">Доставка и оплата</div>
						</div>
					</a>
					<a class="menu__category-item menu__category-item--not-mobile-icon" href="/services/">
						<div class="menu__category">
							<div class="menu__category-title">Услуги</div>
						</div>
					</a>
					<a class="menu__category-item menu__category-item--not-mobile-icon" href="/vacancy/">
						<div class="menu__category">
							<div class="menu__category-title">Вакансии</div>
						</div>
					</a>
					<a class="menu__category-item menu__category-item--not-mobile-icon" href="/clients/">
						<div class="menu__category">
							<div class="menu__category-title">Сотрудничество</div>
						</div>
					</a>
				</div>
			</div>


			<div class="menu__block preload preload--not-ready" data-menu-name="main">
				<div class="menu__inner">
					<div class="menu__inner-name">Каталог</div>
				</div>
				<div class="menu__items">

					<? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "menu_main_cat2", array(
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
						"SECTION_ID" => $_REQUEST["SECTION_STMMID"],    // ID раздела
						"SECTION_URL" => "",    // URL, ведущий на страницу с содержимым раздела
						"SECTION_USER_FIELDS" => array(    // Свойства разделов
							0 => "",
							1 => "",
						),
						"SHOW_PARENT_NAME" => "Y",    // Показывать название раздела
						"TOP_DEPTH" => "2",    // Максимальная отображаемая глубина разделов
						"VIEW_MODE" => "LIST",    // Вид списка подразделов
					),
						false
					); ?>

				</div>
			</div>


			<? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "menu_main_items1", array(
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
				"SECTION_ID" => $_REQUEST["SECTION_STMMID"],    // ID раздела
				"SECTION_URL" => "",    // URL, ведущий на страницу с содержимым раздела
				"SECTION_USER_FIELDS" => array(    // Свойства разделов
					0 => "",
					1 => "",
				),
				"SHOW_PARENT_NAME" => "Y",    // Показывать название раздела
				"TOP_DEPTH" => "3",    // Максимальная отображаемая глубина разделов
				"VIEW_MODE" => "LIST",    // Вид списка подразделов
			),
				false
			); ?>

		</div>
	</div>


	<div class="preload <? if ($APPLICATION->GetCurPage() == "/"): ?>preload--not-ready<? endif; ?>" id="main-group">
		<?if( $APPLICATION->GetCurPage() == "/" ){?>
		<div class="section">
		<?}?>

			<div class="mobile-header">
				<div class="mobile-header__block layout preload__area">
					<div class="mobile-header__button" data-menu-target="mobile-menu">
						<svg class="mobile-header__button-icon">
							<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#menu"></use>
						</svg>
					</div>
					
					<div class="mobile-header__search" data-search-hints-open="banner-search">
						<svg class="mobile-header__search-icon">
						  <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#search"></use>
						</svg>
					</div>
					
					<div class="mobile-header__catalog-button" data-menu-target="main">
						<svg class="mobile-header__catalog-button-icon">
							<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#mobile-catalog"></use>
						</svg>
						<div class="mobile-header__catalog-button-text">Каталог</div>
					</div>

					<a class="mobile-header__basket" href="/basket/">
						<svg class="mobile-header__basket-icon">
							<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#basket"></use>
						</svg>
						<? $APPLICATION->IncludeComponent(
							"bitrix:sale.basket.basket.line",
							"small-basket-mobile",
							array(
								"HIDE_ON_BASKET_PAGES" => "N",
								"PATH_TO_AUTHORIZE" => "",
								"PATH_TO_BASKET" => SITE_DIR . "personal/cart/",
								"PATH_TO_ORDER" => SITE_DIR . "personal/order/make/",
								"PATH_TO_PERSONAL" => SITE_DIR . "personal/",
								"PATH_TO_PROFILE" => SITE_DIR . "personal/",
								"PATH_TO_REGISTER" => SITE_DIR . "login/",
								"POSITION_FIXED" => "N",
								"SHOW_AUTHOR" => "N",
								"SHOW_EMPTY_VALUES" => "Y",
								"SHOW_NUM_PRODUCTS" => "Y",
								"SHOW_PERSONAL_LINK" => "N",
								"SHOW_PRODUCTS" => "N",
								"SHOW_REGISTRATION" => "N",
								"SHOW_TOTAL_PRICE" => "N",
								"COMPONENT_TEMPLATE" => "small-basket"
							),
							false
						); ?>
					</a>

                    <? if ($USER->IsAuthorized()): ?>
                        <a class="header__user-button header__user-button--exit" href="<?=$APPLICATION->GetCurPageParam("logout=yes", array("login","logout","register","forgot_password","change_password"));?>">
                            <svg class="header__user-button-icon">
                                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#logout"></use>
                            </svg>
                            <span class="header__user-button-text">Выход</span>
                        </a>

                    <? else: ?>
                    <div class="header__user-button header__user-button--exit" data-modal-open="login">
                        <svg class="header__user-button-icon">
                            <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#user"></use>
                        </svg>
                        <span class="header__user-button-text">Войти</span>
                    </div>

                    <? endif; ?>
				</div>
			</div>
			<header class="header">
				<div class="header__main-wrapper">
					<div class="header__main-block layout preload__area">
						<div class="header__main-menu">
							<a class="header__main-menu-item" href="/contacts/">Контакты</a>
							<a class="header__main-menu-item" href="/about/">О компании</a>
							<a class="header__main-menu-item" href="/delivery-payment/">Доставка и оплата</a>
							<a class="header__main-menu-item" href="/services/">Услуги</a>
							<a class="header__main-menu-item" href="/vacancy/">Вакансии</a>
							<a class="header__main-menu-item" href="/clients/">Сотрудничество</a>
						</div>

						<div class="header__buttons">
							<a class="header__button header__button--sale" href="/catalog/sale/">
								<svg class="header__button-icon">
									<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#sale"></use>
								</svg>
								<span class="header__button-text">Акции</span>
							</a>
							<a class="header__button header__button--compare" href="/compare/">
								<svg class="header__button-icon">
									<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#compare"></use>
								</svg>
								<span class="header__button-text">Сравнение</span>
								<span class="header__user-button-count"><?if( is_array($_SESSION["COMPARE"]) ): echo count($_SESSION["COMPARE"]); else: echo "0"; endif;?></span>
							</a>
							<a class="header__button header__button--favorits" href="/favorites/">
								<svg class="header__button-icon">
									<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#favorite"></use>
								</svg>
								<span class="header__button-text">Избранное</span>
								<span class="header__user-button-count"><?if( is_array($_SESSION["FAVORITES"]) ): echo count($_SESSION["FAVORITES"]); else: echo "0"; endif;?></span>
							</a>
							<div class="header__user-group">
								<? if (!$USER->IsAuthorized()): ?>
									<div class="header__user-button" href="#" data-modal-open='login'>
										<svg class="header__user-button-icon">
											<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#user"></use>
										</svg>
										<span class="header__user-button-text">Вход</span>
									</div>
								<? else: ?>
									<a class="header__user-button" href="/personal/orders/">
										<svg class="header__user-button-icon">
											<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#user"></use>
										</svg>
										<span class="header__user-button-text">Профиль</span>
									</a>
								<? endif; ?>

								<a class="header__user-button" href="/basket/">
									<svg class="header__user-button-icon">
										<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#basket"></use>
									</svg>
									<? $APPLICATION->IncludeComponent(
										"bitrix:sale.basket.basket.line",
										"small-basket",
										array(
											"HIDE_ON_BASKET_PAGES" => "N",
											"PATH_TO_AUTHORIZE" => "",
											"PATH_TO_BASKET" => SITE_DIR . "personal/cart/",
											"PATH_TO_ORDER" => SITE_DIR . "personal/order/make/",
											"PATH_TO_PERSONAL" => SITE_DIR . "personal/",
											"PATH_TO_PROFILE" => SITE_DIR . "personal/",
											"PATH_TO_REGISTER" => SITE_DIR . "login/",
											"POSITION_FIXED" => "N",
											"SHOW_AUTHOR" => "N",
											"SHOW_EMPTY_VALUES" => "Y",
											"SHOW_NUM_PRODUCTS" => "Y",
											"SHOW_PERSONAL_LINK" => "N",
											"SHOW_PRODUCTS" => "N",
											"SHOW_REGISTRATION" => "N",
											"SHOW_TOTAL_PRICE" => "N",
											"COMPONENT_TEMPLATE" => "small-basket"
										),
										false
									); ?>
								</a>
							</div>

                            <? if ($USER->IsAuthorized()): ?>
                                <a class="header__user-button header__user-button--exit" href="<?=$APPLICATION->GetCurPageParam("logout=yes", array("login","logout","register","forgot_password","change_password"));?>">
                                    <svg class="header__user-button-icon">
                                        <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#logout"></use>
                                    </svg>
                                    <span class="header__user-button-text">Выход</span>
                                </a>
                            <? endif; ?>
						</div>
					</div>
				</div>
				<div class="header__catalog-wrapper">
					<div class="header__catalog-block <?if( $APPLICATION->GetCurPage() !== "/" ){?>header__catalog-block--with-search<?}?> layout preload__area">
						<a class="header__logo" href="/">
							<img class="header__logo-img" src="<?= SITE_TEMPLATE_PATH ?>/ts/images/logo/logo-black.svg">
						</a>
						<div class="header__catalog">
							<div class="header__catalog-button" data-menu-target="main">
								<svg class="header__catalog-button-icon">
									<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#catalog"></use>
								</svg>
								<div class="header__catalog-button-text">Все товары</div>
							</div>
							<div class="header__catalog-slider-wrapper">
								<div class="header__catalog-slider-wrapper-plug"></div>
								<div class="header__catalog-slider">
									<? $APPLICATION->IncludeComponent(
										"bitrix:catalog.section.list",
										"menu_main_top",
										array(
											"ADD_SECTIONS_CHAIN" => "N",
											"CACHE_FILTER" => "N",
											"CACHE_GROUPS" => "Y",
											"CACHE_TIME" => "36000000",
											"CACHE_TYPE" => "A",
											"COUNT_ELEMENTS" => "N",
											"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
											"FILTER_NAME" => "sectionsFilter",
											"IBLOCK_ID" => "1",
											"IBLOCK_TYPE" => "catalog",
											"SECTION_CODE" => "",
											"SECTION_FIELDS" => array("", ""),
											"SECTION_ID" => $_REQUEST["SECTION_STMMID"],
											"SECTION_URL" => "",
											"SECTION_USER_FIELDS" => array("", ""),
											"SHOW_PARENT_NAME" => "Y",
											"TOP_DEPTH" => "1",
											"VIEW_MODE" => "LINE"
										)
									); ?>
								</div>
							</div>
							<div class="header__catalog-slider-button">
								<svg class="header__catalog-slider-button-icon">
									<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#arrow"></use>
								</svg>
							</div>
						</div>
			
						<?if( $APPLICATION->GetCurPage() !== "/" ){?>
						<div class="header__search">
							<div class="search-hints search-hints--header" id="header-search">
								<div class="search-hints__wrapper">
									<div class="search-hints__input-row">
										<div class="search-hints__close-button" data-search-hints-close>
											<svg class="search-hints__close-button-icon">
												<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#close"></use>
											</svg>
										</div>
										<div class="search-hints__input-block">
											<input id="headerSearchInput" class="search-hints__input input input--search" placeholder="Поиск товара">
										</div>
										<div class="search-hints__input-button">
											<svg class="search-hints__input-button-icon">
												<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#search"></use>
											</svg>
										</div>
									</div>
									<div class="search-hints__hints-wrapper">
										<template data-search-hints-products-item>
											<div class="search-hints__product">
												<div class="search-hints__product-img-wrapper">
													<img class="search-hints__product-img" src="">
												</div>
												<div class="search-hints__product-desc">
													<a class="search-hints__product-desc-name"></a>
													<div class="search-hints__product-desc-control">
														<div class="search-hints__product-desc-control-price">
															<div class="search-hints__product-desc-control-price-number"></div>
															<div class="search-hints__product-desc-control-price-currency">сом</div>
														</div>
														<div class="search-hints__product-desc-control-buy">
															<svg class="search-hints__product-desc-control-buy-icon">
																<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#basket"></use>
															</svg>
														</div>
													</div>
												</div>
											</div>
										</template>
										<template data-search-hints-history-item>
										<div class="search-hints__hints-results-row search-hints__hints-results-row--delete">
											<a class="search-hints__hints-results-row-link"></a>
											<div class="search-hints__hints-results-row-del">
												<svg class="search-hints__hints-results-row-del-icon">
													<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#close"></use>
												</svg>
											</div>
										</div>
										</template>
										<template data-search-hints-popular-item>
											<div class="search-hints__hints-results-row">
												<a class="search-hints__hints-results-row-link"></a>
											</div>
										</template>
										<template data-search-hints-category-item>
											<div class="search-hints__hints-results-row">
												<a class="search-hints__hints-results-row-link"></a>
											</div>
										</template>
										<div class="search-hints__hints-block">
											<div class="search-hints__hints-results">
												<div class="search-hints__hints-results-item">
													<div class="search-hints__hints-results-item-title">История запросов</div>
													<div class="search-hints__hints-results-item-list" data-search-hints-history></div>
												</div>
												<div class="search-hints__hints-results-item">
													<div class="search-hints__hints-results-item-title">Частые запросы</div>
													<div class="search-hints__hints-results-item-list" data-search-hints-popular></div>
												</div>
												<div class="search-hints__hints-results-item">
													<div class="search-hints__hints-results-item-title">Категории</div>
													<div class="search-hints__hints-results-item-list" data-search-hints-category></div>
												</div>
											</div>
											<div class="search-hints__products">
												<div class="search-hints__products-title">Товары</div>
												<div class="search-hints__products-list" data-search-hints-products></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?}?>
			
					</div>
				</div>
			</header>


			<?if( $APPLICATION->GetCurPage() == "/" ){?>
				<div class="main-banner layout preload__area">
					<? $APPLICATION->IncludeComponent("bitrix:news.detail", "main-banner1", array(
						"ACTIVE_DATE_FORMAT" => "d.m.Y",    // Формат показа даты
						"ADD_ELEMENT_CHAIN" => "N",    // Включать название элемента в цепочку навигации
						"ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
						"AJAX_MODE" => "N",    // Включить режим AJAX
						"AJAX_OPTION_ADDITIONAL" => "",    // Дополнительный идентификатор
						"AJAX_OPTION_HISTORY" => "N",    // Включить эмуляцию навигации браузера
						"AJAX_OPTION_JUMP" => "N",    // Включить прокрутку к началу компонента
						"AJAX_OPTION_STYLE" => "N",    // Включить подгрузку стилей
						"BROWSER_TITLE" => "-",    // Установить заголовок окна браузера из свойства
						"CACHE_GROUPS" => "Y",    // Учитывать права доступа
						"CACHE_TIME" => "36000000",    // Время кеширования (сек.)
						"CACHE_TYPE" => "A",    // Тип кеширования
						"CHECK_DATES" => "Y",    // Показывать только активные на данный момент элементы
						"DETAIL_URL" => "",    // URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
						"DISPLAY_BOTTOM_PAGER" => "N",    // Выводить под списком
						"DISPLAY_DATE" => "N",    // Выводить дату элемента
						"DISPLAY_NAME" => "N",    // Выводить название элемента
						"DISPLAY_PICTURE" => "Y",    // Выводить детальное изображение
						"DISPLAY_PREVIEW_TEXT" => "N",    // Выводить текст анонса
						"DISPLAY_TOP_PAGER" => "N",    // Выводить над списком
						"ELEMENT_CODE" => "",    // Код новости
						"ELEMENT_ID" => "329015",    // ID новости
						"FIELD_CODE" => array(    // Поля
							0 => "",
							1 => "",
						),
						"IBLOCK_ID" => "47",    // Код информационного блока
						"IBLOCK_TYPE" => "information",    // Тип информационного блока (используется только для проверки)
						"IBLOCK_URL" => "",    // URL страницы просмотра списка элементов (по умолчанию - из настроек инфоблока)
						"INCLUDE_IBLOCK_INTO_CHAIN" => "N",    // Включать инфоблок в цепочку навигации
						"MESSAGE_404" => "",    // Сообщение для показа (по умолчанию из компонента)
						"META_DESCRIPTION" => "-",    // Установить описание страницы из свойства
						"META_KEYWORDS" => "-",    // Установить ключевые слова страницы из свойства
						"PAGER_BASE_LINK_ENABLE" => "N",    // Включить обработку ссылок
						"PAGER_SHOW_ALL" => "N",    // Показывать ссылку "Все"
						"PAGER_TEMPLATE" => ".default",    // Шаблон постраничной навигации
						"PAGER_TITLE" => "Страница",    // Название категорий
						"PROPERTY_CODE" => array(    // Свойства
							0 => "",
							1 => "",
						),
						"SET_BROWSER_TITLE" => "N",    // Устанавливать заголовок окна браузера
						"SET_CANONICAL_URL" => "N",    // Устанавливать канонический URL
						"SET_LAST_MODIFIED" => "N",    // Устанавливать в заголовках ответа время модификации страницы
						"SET_META_DESCRIPTION" => "N",    // Устанавливать описание страницы
						"SET_META_KEYWORDS" => "N",    // Устанавливать ключевые слова страницы
						"SET_STATUS_404" => "N",    // Устанавливать статус 404
						"SET_TITLE" => "N",    // Устанавливать заголовок страницы
						"SHOW_404" => "N",    // Показ специальной страницы
						"STRICT_SECTION_CHECK" => "N",    // Строгая проверка раздела для показа элемента
						"USE_PERMISSIONS" => "N",    // Использовать дополнительное ограничение доступа
						"USE_SHARE" => "N",    // Отображать панель соц. закладок
					),
						false
					); ?>
					<div class="main-banner__search">
						<? $APPLICATION->IncludeComponent(
							"bitrix:search.form",
							"search2",
							array(
								'QUERY' => $_REQUEST['q'],
								"PAGE" => "#SITE_DIR#catalog/",
								"USE_SUGGEST" => "N"
							)
						); ?>
					</div>
				</div>
				<div class="partners layout preload__area">
					<? $APPLICATION->IncludeComponent(
						"bitrix:news.list",
						"best-product2",
						array(
							"TITLE" => "Выбираем качественную продукцию
	лучших производителей",
							"ACTIVE_DATE_FORMAT" => "",
							"ADD_SECTIONS_CHAIN" => "N",
							"AJAX_MODE" => "N",
							"AJAX_OPTION_ADDITIONAL" => "",
							"AJAX_OPTION_HISTORY" => "N",
							"AJAX_OPTION_JUMP" => "N",
							"AJAX_OPTION_STYLE" => "Y",
							"CACHE_FILTER" => "N",
							"CACHE_GROUPS" => "Y",
							"CACHE_TIME" => "36000000",
							"CACHE_TYPE" => "A",
							"CHECK_DATES" => "Y",
							"DETAIL_URL" => "",
							"DISPLAY_BOTTOM_PAGER" => "Y",
							"DISPLAY_DATE" => "Y",
							"DISPLAY_NAME" => "Y",
							"DISPLAY_PICTURE" => "Y",
							"DISPLAY_PREVIEW_TEXT" => "Y",
							"DISPLAY_TOP_PAGER" => "N",
							"FIELD_CODE" => array(
								0 => "",
								1 => "",
							),
							"FILTER_NAME" => "",
							"HIDE_LINK_WHEN_NO_DETAIL" => "N",
							"IBLOCK_ID" => "4",
							"IBLOCK_TYPE" => "information",
							"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
							"INCLUDE_SUBSECTIONS" => "Y",
							"MESSAGE_404" => "",
							"NEWS_COUNT" => "25",
							"PAGER_BASE_LINK_ENABLE" => "N",
							"PAGER_DESC_NUMBERING" => "N",
							"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
							"PAGER_SHOW_ALL" => "N",
							"PAGER_SHOW_ALWAYS" => "N",
							"PAGER_TEMPLATE" => ".default",
							"PAGER_TITLE" => "Новости",
							"PARENT_SECTION" => "",
							"PARENT_SECTION_CODE" => "",
							"PREVIEW_TRUNCATE_LEN" => "",
							"PROPERTY_CODE" => array(
								0 => "",
								1 => "SVG",
								2 => "",
							),
							"SET_BROWSER_TITLE" => "N",
							"SET_LAST_MODIFIED" => "N",
							"SET_META_DESCRIPTION" => "N",
							"SET_META_KEYWORDS" => "N",
							"SET_STATUS_404" => "N",
							"SET_TITLE" => "N",
							"SHOW_404" => "N",
							"SORT_BY1" => "SORT",
							"SORT_BY2" => "SORT",
							"SORT_ORDER1" => "ASC",
							"SORT_ORDER2" => "ASC",
							"STRICT_SECTION_CHECK" => "N",
							"COMPONENT_TEMPLATE" => "best-product"
						),
						false
					); ?>

				</div>
			<?}?>


		<? if ($APPLICATION->GetCurPage() == "/"){?>
		</div>
		<?}?>

	<?if( !in_array($APPLICATION->GetCurPage(), $arr_ntu_lk) ){?>
	</div>
	<?}?>

	<? if ($APPLICATION->GetCurPage() == "/"){?>
	<div class="preload <? if ($APPLICATION->GetCurPage() == "/"): ?>preload--not-ready<? endif; ?>" id="natural-group">
	<?}?>

<?}?>
