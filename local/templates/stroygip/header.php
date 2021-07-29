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
	$arr_ntu = array("/", "/basket/", "/order/", "/order/payment/", "/order/confirm_order/");
	$arr_ntu_clear = array("/basket/", "/order/", "/order/payment/", "/order/confirm_order/");
	
    if ( !in_array($APPLICATION->GetCurPage(), $arr_ntu) && strpos($APPLICATION->GetCurDir(), '/catalog/') === false ) {
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
	}


    Asset::getInstance()->addString('<meta name="viewport" content="width=device-width, initial-scale=1.0">');

    Asset::getInstance()->addJs('https://www.google.com/recaptcha/api.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/costume.js");
    ?>

    <? $APPLICATION->ShowHead(); ?>
    <title><? $APPLICATION->ShowTitle(); ?></title>

    <link href="<?= SITE_TEMPLATE_PATH ?>/ts/main.css" rel="stylesheet">
</head>

<body <?if( in_array($APPLICATION->GetCurPage(), $arr_ntu_clear) ):?>class="clear-page"<? endif; ?>>
<div id="panel">
    <?$APPLICATION->ShowPanel();?>
</div>


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

					<a class="menu__category-item menu__category-item--small" href="/">
						<svg class="menu__category-icon menu__category-icon--small">
							<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#user"></use>
						</svg>
						<div class="menu__category">
							<div class="menu__category-title">Вход</div>
							<div class="menu__mobile-desc">Вход в аккаунт для доступа к истории заказов и персональным скидкам</div>
						</div>
					</a>
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
									<a class="header__user-button" href="#" data-modal-open='login'>
										<svg class="header__user-button-icon">
											<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#user"></use>
										</svg>
										<span class="header__user-button-text">Вход</span>
									</a>
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
						</div>
					</div>
				</div>
				<div class="header__catalog-wrapper">
					<div class="header__catalog-block layout preload__area">
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
		
		
	</div>
	
	
	<? if ($APPLICATION->GetCurPage() == "/"){?>
	<div class="preload <? if ($APPLICATION->GetCurPage() == "/"): ?>preload--not-ready<? endif; ?>" id="natural-group">
	<?}?>
	
<?}?>
		