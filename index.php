<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Строительный гипермаркет 2Прораба');
?>
<?$APPLICATION->IncludeComponent(
  "bitrix:main.include",
  "",
  Array(
    "AREA_FILE_SHOW" => "file",
    "AREA_FILE_SUFFIX" => "inc",
    "EDIT_TEMPLATE" => "",
    "PATH" =>"/local/include/general/index/globalFiltres.php"
  ),
  false,
  ["HIDE_ICONS"=>"Y"]
);?>



<?
$GLOBALS['bestPriceFilter']['>CATALOG_PRICE_1'] = 0;
$APPLICATION->IncludeComponent(
  "bitrix:catalog.section",
  "best-price-v3",
  Array(
    "ACTION_VARIABLE" => "action",
    "ADD_PICT_PROP" => "-",
    "ADD_PROPERTIES_TO_BASKET" => "Y",
    "ADD_SECTIONS_CHAIN" => "N",
    "ADD_TO_BASKET_ACTION" => "ADD",
    "AJAX_MODE" => "N",
    "AJAX_OPTION_ADDITIONAL" => "",
    "AJAX_OPTION_HISTORY" => "N",
    "AJAX_OPTION_JUMP" => "N",
    "AJAX_OPTION_STYLE" => "Y",
    "BACKGROUND_IMAGE" => "-",
    "BASKET_URL" => "/basket/",
    "BROWSER_TITLE" => "-",
    "CACHE_FILTER" => "N",
    "CACHE_GROUPS" => "Y",
    "CACHE_TIME" => "36000000",
    "CACHE_TYPE" => "A",
    "COMPATIBLE_MODE" => "Y",
    "CONVERT_CURRENCY" => "N",
    "CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
    "DETAIL_URL" => "",
    "DISABLE_INIT_JS_IN_COMPONENT" => "N",
    "DISPLAY_BOTTOM_PAGER" => "N",
    "DISPLAY_COMPARE" => "N",
    "DISPLAY_TOP_PAGER" => "N",
    "ELEMENT_SORT_FIELD" => "sort",
    "ELEMENT_SORT_FIELD2" => "id",
    "ELEMENT_SORT_ORDER" => "asc",
    "ELEMENT_SORT_ORDER2" => "desc",
    "ENLARGE_PRODUCT" => "STRICT",
    "FILTER_NAME" => "bestPriceFilter",
    "HIDE_NOT_AVAILABLE" => "N",
    "HIDE_NOT_AVAILABLE_OFFERS" => "N",
    "IBLOCK_ID" => "1",
    "IBLOCK_TYPE" => "catalog",
    "INCLUDE_SUBSECTIONS" => "Y",
    "LABEL_PROP" => array("COLOR", "RECOMEND", "MAIN"),
    "LABEL_PROP_MOBILE" => array("COLOR", "RECOMEND", "MAIN"),
    "LABEL_PROP_POSITION" => "top-left",
    "LAZY_LOAD" => "N",
    "LINE_ELEMENT_COUNT" => "3",
    "LOAD_ON_SCROLL" => "N",
    "MESSAGE_404" => "",
    "MESS_BTN_ADD_TO_BASKET" => "В корзину",
    "MESS_BTN_BUY" => "Купить",
    "MESS_BTN_DETAIL" => "Подробнее",
    "MESS_BTN_SUBSCRIBE" => "Подписаться",
    "MESS_NOT_AVAILABLE" => "Нет в наличии",
    "META_DESCRIPTION" => "-",
    "META_KEYWORDS" => "-",
    "OFFERS_LIMIT" => "5",
    "PAGER_BASE_LINK_ENABLE" => "N",
    "PAGER_DESC_NUMBERING" => "N",
    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
    "PAGER_SHOW_ALL" => "N",
    "PAGER_SHOW_ALWAYS" => "N",
    "PAGER_TEMPLATE" => ".default",
    "PAGER_TITLE" => "Товары",
    "PAGE_ELEMENT_COUNT" => "40",
    "PARTIAL_PRODUCT_PROPERTIES" => "N",
    "PRICE_CODE" => array("BASE"),
    "PRICE_VAT_INCLUDE" => "Y",
    "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
    "PRODUCT_ID_VARIABLE" => "id",
    "PRODUCT_PROPS_VARIABLE" => "prop",
    "PRODUCT_QUANTITY_VARIABLE" => "quantity",
    "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
    "PRODUCT_SUBSCRIPTION" => "Y",
    "PROPERTY_CODE_MOBILE" => array("ART_NUMBER", "MARK", "RATING"),
    "RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
    "RCM_TYPE" => "personal",
    "SECTION_CODE" => "",
    "SECTION_ID" => $_REQUEST["SECTION_ID"],
    "SECTION_ID_VARIABLE" => "SECTION_ID",
    "SECTION_URL" => "",
    "SECTION_USER_FIELDS" => array("", ""),
    "SEF_MODE" => "N",
    "SET_BROWSER_TITLE" => "N",
    "SET_LAST_MODIFIED" => "N",
    "SET_META_DESCRIPTION" => "N",
    "SET_META_KEYWORDS" => "N",
    "SET_STATUS_404" => "N",
    "SET_TITLE" => "N",
    "SHOW_404" => "N",
    "SHOW_ALL_WO_SECTION" => "N",
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
    "USE_MAIN_ELEMENT_SECTION" => "N",
    "USE_PRICE_COUNT" => "N",
    "USE_PRODUCT_QUANTITY" => "N"
  )
);?>



<?
$GLOBALS['bestsellersFilter']['>CATALOG_PRICE_1'] = 0;
$APPLICATION->IncludeComponent(
  "bitrix:catalog.section",
  "bestsellers-v3",
  Array(
    "ACTION_VARIABLE" => "action",
    "ADD_PICT_PROP" => "-",
    "ADD_PROPERTIES_TO_BASKET" => "Y",
    "ADD_SECTIONS_CHAIN" => "N",
    "ADD_TO_BASKET_ACTION" => "ADD",
    "AJAX_MODE" => "N",
    "AJAX_OPTION_ADDITIONAL" => "",
    "AJAX_OPTION_HISTORY" => "N",
    "AJAX_OPTION_JUMP" => "N",
    "AJAX_OPTION_STYLE" => "Y",
    "BACKGROUND_IMAGE" => "-",
    "BASKET_URL" => "/basket/",
    "BROWSER_TITLE" => "-",
    "CACHE_FILTER" => "N",
    "CACHE_GROUPS" => "Y",
    "CACHE_TIME" => "36000000",
    "CACHE_TYPE" => "A",
    "COMPATIBLE_MODE" => "Y",
    "CONVERT_CURRENCY" => "N",
    "CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
    "DETAIL_URL" => "",
    "DISABLE_INIT_JS_IN_COMPONENT" => "N",
    "DISPLAY_BOTTOM_PAGER" => "N",
    "DISPLAY_COMPARE" => "N",
    "DISPLAY_TOP_PAGER" => "N",
    "ELEMENT_SORT_FIELD" => "sort",
    "ELEMENT_SORT_FIELD2" => "id",
    "ELEMENT_SORT_ORDER" => "asc",
    "ELEMENT_SORT_ORDER2" => "desc",
    "ENLARGE_PRODUCT" => "STRICT",
    "FILTER_NAME" => "bestsellersFilter",
    "HIDE_NOT_AVAILABLE" => "N",
    "HIDE_NOT_AVAILABLE_OFFERS" => "N",
    "IBLOCK_ID" => "1",
    "IBLOCK_TYPE" => "catalog",
    "INCLUDE_SUBSECTIONS" => "Y",
    "LABEL_PROP" => array("COLOR", "RECOMEND", "MAIN"),
    "LABEL_PROP_MOBILE" => array("COLOR", "RECOMEND", "MAIN"),
    "LABEL_PROP_POSITION" => "top-left",
    "LAZY_LOAD" => "N",
    "LINE_ELEMENT_COUNT" => "3",
    "LOAD_ON_SCROLL" => "N",
    "MESSAGE_404" => "",
    "MESS_BTN_ADD_TO_BASKET" => "В корзину",
    "MESS_BTN_BUY" => "Купить",
    "MESS_BTN_DETAIL" => "Подробнее",
    "MESS_BTN_SUBSCRIBE" => "Подписаться",
    "MESS_NOT_AVAILABLE" => "Нет в наличии",
    "META_DESCRIPTION" => "-",
    "META_KEYWORDS" => "-",
    "OFFERS_LIMIT" => "5",
    "PAGER_BASE_LINK_ENABLE" => "N",
    "PAGER_DESC_NUMBERING" => "N",
    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
    "PAGER_SHOW_ALL" => "N",
    "PAGER_SHOW_ALWAYS" => "N",
    "PAGER_TEMPLATE" => ".default",
    "PAGER_TITLE" => "Товары",
    "PAGE_ELEMENT_COUNT" => "8",
    "PARTIAL_PRODUCT_PROPERTIES" => "N",
    "PRICE_CODE" => array("BASE"),
    "PRICE_VAT_INCLUDE" => "Y",
    "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
    "PRODUCT_ID_VARIABLE" => "id",
    "PRODUCT_PROPS_VARIABLE" => "prop",
    "PRODUCT_QUANTITY_VARIABLE" => "quantity",
    "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
    "PRODUCT_SUBSCRIPTION" => "Y",
    "PROPERTY_CODE_MOBILE" => array("ART_NUMBER", "MARK", "RATING"),
    "RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
    "RCM_TYPE" => "personal",
    "SECTION_CODE" => "",
    "SECTION_ID" => $_REQUEST["SECTION_ID"],
    "SECTION_ID_VARIABLE" => "SECTION_ID",
    "SECTION_URL" => "",
    "SECTION_USER_FIELDS" => array("", ""),
    "SEF_MODE" => "N",
    "SET_BROWSER_TITLE" => "N",
    "SET_LAST_MODIFIED" => "N",
    "SET_META_DESCRIPTION" => "N",
    "SET_META_KEYWORDS" => "N",
    "SET_STATUS_404" => "N",
    "SET_TITLE" => "N",
    "SHOW_404" => "N",
    "SHOW_ALL_WO_SECTION" => "N",
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
    "USE_MAIN_ELEMENT_SECTION" => "N",
    "USE_PRICE_COUNT" => "N",
    "USE_PRODUCT_QUANTITY" => "N"
  )
);?>

<?$APPLICATION->IncludeComponent("bitrix:news.list", "bottom-slider", Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "N",	// Включить подгрузку стилей
		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
		"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
		"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
		"DISPLAY_DATE" => "N",	// Выводить дату элемента
		"DISPLAY_NAME" => "Y",	// Выводить название элемента
		"DISPLAY_PICTURE" => "N",	// Выводить изображение для анонса
		"DISPLAY_PREVIEW_TEXT" => "N",	// Выводить текст анонса
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"FIELD_CODE" => array(	// Поля
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",	// Фильтр
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
		"IBLOCK_ID" => "48",	// Код информационного блока
		"IBLOCK_TYPE" => "information",	// Тип информационного блока (используется только для проверки)
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
		"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
		"NEWS_COUNT" => "50",	// Количество новостей на странице
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
		"PAGER_TITLE" => "Новости",	// Название категорий
		"PARENT_SECTION" => "",	// ID раздела
		"PARENT_SECTION_CODE" => "",	// Код раздела
		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
		"PROPERTY_CODE" => array(	// Свойства
			0 => "LINK",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
		"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"SHOW_404" => "N",	// Показ специальной страницы
		"SORT_BY1" => "SORT",	// Поле для первой сортировки новостей
		"SORT_BY2" => "NAME",	// Поле для второй сортировки новостей
		"SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
		"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
		"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>


<?
$GLOBALS['benefitFilter']['>CATALOG_PRICE_1'] = 0;
$APPLICATION->IncludeComponent(
  "bitrix:catalog.section",
  "benefit-v3",
  Array(
    'FAVORITES' =>$_SESSION['FAVORITES'],
    'COMPARE' =>$_SESSION['COMPARE'],
    "ACTION_VARIABLE" => "action",
    "ADD_PICT_PROP" => "-",
    "ADD_PROPERTIES_TO_BASKET" => "Y",
    "ADD_SECTIONS_CHAIN" => "N",
    "ADD_TO_BASKET_ACTION" => "ADD",
    "AJAX_MODE" => "N",
    "AJAX_OPTION_ADDITIONAL" => "",
    "AJAX_OPTION_HISTORY" => "N",
    "AJAX_OPTION_JUMP" => "N",
    "AJAX_OPTION_STYLE" => "Y",
    "BACKGROUND_IMAGE" => "-",
    "BASKET_URL" => "/basket/",
    "BROWSER_TITLE" => "-",
    "CACHE_FILTER" => "N",
    "CACHE_GROUPS" => "Y",
    "CACHE_TIME" => "36000000",
    "CACHE_TYPE" => "A",
    "COMPATIBLE_MODE" => "Y",
    "CONVERT_CURRENCY" => "N",
    "CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
    "DETAIL_URL" => "",
    "DISABLE_INIT_JS_IN_COMPONENT" => "N",
    "DISPLAY_BOTTOM_PAGER" => "N",
    "DISPLAY_COMPARE" => "N",
    "DISPLAY_TOP_PAGER" => "N",
    "ELEMENT_SORT_FIELD" => "sort",
    "ELEMENT_SORT_FIELD2" => "id",
    "ELEMENT_SORT_ORDER" => "asc",
    "ELEMENT_SORT_ORDER2" => "desc",
    "ENLARGE_PRODUCT" => "STRICT",
    "FILTER_NAME" => "benefitFilter",
    "HIDE_NOT_AVAILABLE" => "N",
    "HIDE_NOT_AVAILABLE_OFFERS" => "N",
    "IBLOCK_ID" => "1",
    "IBLOCK_TYPE" => "catalog",
    "INCLUDE_SUBSECTIONS" => "Y",
    "LABEL_PROP" => array("COLOR", "RECOMEND", "MAIN"),
    "LABEL_PROP_MOBILE" => array("COLOR", "RECOMEND", "MAIN"),
    "LABEL_PROP_POSITION" => "top-left",
    "LAZY_LOAD" => "N",
    "LINE_ELEMENT_COUNT" => "3",
    "LOAD_ON_SCROLL" => "N",
    "MESSAGE_404" => "",
    "MESS_BTN_ADD_TO_BASKET" => "В корзину",
    "MESS_BTN_BUY" => "Купить",
    "MESS_BTN_DETAIL" => "Подробнее",
    "MESS_BTN_SUBSCRIBE" => "Подписаться",
    "MESS_NOT_AVAILABLE" => "Нет в наличии",
    "META_DESCRIPTION" => "-",
    "META_KEYWORDS" => "-",
    "OFFERS_LIMIT" => "5",
    "PAGER_BASE_LINK_ENABLE" => "N",
    "PAGER_DESC_NUMBERING" => "N",
    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
    "PAGER_SHOW_ALL" => "N",
    "PAGER_SHOW_ALWAYS" => "N",
    "PAGER_TEMPLATE" => ".default",
    "PAGER_TITLE" => "Товары",
    "PAGE_ELEMENT_COUNT" => "40",
    "PARTIAL_PRODUCT_PROPERTIES" => "N",
    "PRICE_CODE" => array("BASE"),
    "PRICE_VAT_INCLUDE" => "Y",
    "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
    "PRODUCT_ID_VARIABLE" => "id",
    "PRODUCT_PROPS_VARIABLE" => "prop",
    "PRODUCT_QUANTITY_VARIABLE" => "quantity",
    "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
    "PRODUCT_SUBSCRIPTION" => "Y",
    "PROPERTY_CODE_MOBILE" => array("ART_NUMBER", "MARK", "RATING"),
    "RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
    "RCM_TYPE" => "personal",
    "SECTION_CODE" => "",
    "SECTION_ID" => $_REQUEST["SECTION_ID"],
    "SECTION_ID_VARIABLE" => "SECTION_ID",
    "SECTION_URL" => "",
    "SECTION_USER_FIELDS" => array("", ""),
    "SEF_MODE" => "N",
    "SET_BROWSER_TITLE" => "N",
    "SET_LAST_MODIFIED" => "N",
    "SET_META_DESCRIPTION" => "N",
    "SET_META_KEYWORDS" => "N",
    "SET_STATUS_404" => "N",
    "SET_TITLE" => "N",
    "SHOW_404" => "N",
    "SHOW_ALL_WO_SECTION" => "N",
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
    "USE_MAIN_ELEMENT_SECTION" => "N",
    "USE_PRICE_COUNT" => "N",
    "USE_PRODUCT_QUANTITY" => "N"
  )
);?>


<div class="section">
	<div class="layout">
		<div class="title">
			<div class="title__text">Возникли проблемы с оформлением заказа?</div>
		</div>
		<div class="lead">
			<div class="lead__form form-check">
				<div class="lead__form-input-block">
					<div class="placeholder form-check__field" data-elem="input" data-rule="input-empty">
						<input id="ohf_name" class="input placeholder__input" placeholder="Имя" value="">
						<div class="placeholder__item">Имя</div>
					</div>
				</div>
				<div class="lead__form-input-block">
					<div class="placeholder form-check__field" data-elem="input" data-rule="input-empty">
						<input id="ohf_mailphone" class="input placeholder__input" placeholder="Телефон или емейл" value="">
						<div class="placeholder__item">Телефон или емейл</div>
					</div>
				</div>
				<div onclick="orderHelpCall()" id="order_help_call" class="lead__form-input-block">
					<div id="order_help_button" class="lead__form-button form-check__button">Отправить</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>