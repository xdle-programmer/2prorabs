<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 */

$this->setFrameMode(true);
if($arResult['ITEMS']){
foreach ($arResult['ITEMS'] as $ITEM) {
    $ITEMS_ID[$ITEM["ID"]] = $ITEM["ID"];
}

\nav\Catalog\Sort::setFromRequest();
$currentSort1 = \nav\Catalog\Sort::getCurrent();


$GLOBALS['viewFilter']['=ID'] =$ITEMS_ID;
$APPLICATION->IncludeComponent(
  "bitrix:catalog.section",
  "personal-viewed",
  Array(
    "TITLE"=>$arParams['TITLE'],
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
    "BASKET_URL" => "/personal/basket.php",
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
    "ELEMENT_SORT_FIELD" => $currentSort1['FIELD'][0],
    "ELEMENT_SORT_ORDER" => $currentSort1['ORDER'][0],
    "ELEMENT_SORT_FIELD2" => "",
    "ELEMENT_SORT_ORDER2" => "",
    "ENLARGE_PRODUCT" => "STRICT",
    "FILTER_NAME" => "viewFilter",
    "HIDE_NOT_AVAILABLE" => "N",
    "HIDE_NOT_AVAILABLE_OFFERS" => "N",
    "IBLOCK_ID" => "1",
    "IBLOCK_TYPE" => "catalog",
    "INCLUDE_SUBSECTIONS" => "Y",
    "LABEL_PROP" => array("COLOR", "RECOMEND", "MAIN", "BENEFITS", "BEST_PRICE", "BESTSELLER"),
    "LABEL_PROP_MOBILE" => array("COLOR", "RECOMEND", "MAIN", "BENEFITS", "BEST_PRICE", "BESTSELLER"),
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
    "PAGE_ELEMENT_COUNT" => 10,
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
    "SECTION_ID" => "",
    "SECTION_ID_VARIABLE" => "SECTION_ID",
    "SECTION_URL" => "",
    "SECTION_USER_FIELDS" => array("UF_SVG", ""),
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
);
}