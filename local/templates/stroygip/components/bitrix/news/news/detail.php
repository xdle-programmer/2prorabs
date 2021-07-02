<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="news">
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
		<div class="title"><?$APPLICATION->ShowTitle(false)?></div>
		<?$ElementID = $APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"",
	Array(
		"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
		"DISPLAY_NAME" => $arParams["DISPLAY_NAME"],
		"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"META_KEYWORDS" => $arParams["META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["META_DESCRIPTION"],
		"BROWSER_TITLE" => $arParams["BROWSER_TITLE"],
		"SET_CANONICAL_URL" => $arParams["DETAIL_SET_CANONICAL_URL"],
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"MESSAGE_404" => $arParams["MESSAGE_404"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"SHOW_404" => $arParams["SHOW_404"],
		"FILE_404" => $arParams["FILE_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
		"ACTIVE_DATE_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		"DISPLAY_TOP_PAGER" => $arParams["DETAIL_DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["DETAIL_PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => $arParams["DETAIL_PAGER_TEMPLATE"],
		"PAGER_SHOW_ALL" => $arParams["DETAIL_PAGER_SHOW_ALL"],
		"CHECK_DATES" => $arParams["CHECK_DATES"],
		"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
		"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
		"USE_SHARE" => $arParams["USE_SHARE"],
		"SHARE_HIDE" => $arParams["SHARE_HIDE"],
		"SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
		"SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
		"SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
		"SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
		"ADD_ELEMENT_CHAIN" => (isset($arParams["ADD_ELEMENT_CHAIN"]) ? $arParams["ADD_ELEMENT_CHAIN"] : ''),
		'STRICT_SECTION_CHECK' => (isset($arParams['STRICT_SECTION_CHECK']) ? $arParams['STRICT_SECTION_CHECK'] : ''),
	),
	$component
);?>
	</div>
</div>
<?if($ElementID){

    $cur_element = CIBlockElement::GetList([], ["IBLOCK_ID"=>$arParams["IBLOCK_ID"],"ACTIVE"=>"Y",'=ID'=>$ElementID], false, false, [])->GetNextElement();
    $cur_element_fields =$cur_element->GetFields();
    $cur_element_props =$cur_element->GetProperties();
    $arFilter = ["IBLOCK_ID"=>$arParams["IBLOCK_ID"],"ACTIVE"=>"Y",'=SECTION_ID'=>$cur_element_fields['IBLOCK_SECTION_ID'],'!ID'=>$ElementID];
    $res = CIBlockElement::GetList([], $arFilter, false, false, ["ID"]);
    while($ob = $res->Fetch())
    {
        $GLOBALS['similarFilter']['=ID'][] = $ob['ID'];
    }
    ?>

 <?$APPLICATION->IncludeComponent(
  "bitrix:news.list",
  "similar_news",
  Array(
    "ACTIVE_DATE_FORMAT" => "d.m.Y",
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
    "DISPLAY_BOTTOM_PAGER" => "N",
    "DISPLAY_DATE" => "Y",
    "DISPLAY_NAME" => "Y",
    "DISPLAY_PICTURE" => "Y",
    "DISPLAY_PREVIEW_TEXT" => "Y",
    "DISPLAY_TOP_PAGER" => "N",
    "FIELD_CODE" => array("", ""),
    "FILTER_NAME" => "similarFilter",
    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
    "INCLUDE_SUBSECTIONS" => "N",
    "MESSAGE_404" => "",
    "NEWS_COUNT" => "10",
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
    "PROPERTY_CODE" => array("", ""),
    "SET_BROWSER_TITLE" => "N",
    "SET_LAST_MODIFIED" => "N",
    "SET_META_DESCRIPTION" => "N",
    "SET_META_KEYWORDS" => "N",
    "SET_STATUS_404" => "N",
    "SET_TITLE" => "N",
    "SHOW_404" => "N",
    "SORT_BY1" => "ACTIVE_FROM",
    "SORT_BY2" => "SORT",
    "SORT_ORDER1" => "DESC",
    "SORT_ORDER2" => "ASC",
    "STRICT_SECTION_CHECK" => "N"
  )
);?>
  <?if($cur_element_props['PRODUCTS']['VALUE']){
      $GLOBALS['byerFilter']['=ID'] = $cur_element_props['PRODUCTS']['VALUE']?>
    <section class="similar-products similar-products--background-blue similar-products--padding">
  <?$APPLICATION->IncludeComponent(
    "bitrix:catalog.section",
    "recomends_card",
    Array(
      "TITLE"=>'Лучшие предложения для ремонта',
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
      "ELEMENT_SORT_FIELD" => "sort",
      "ELEMENT_SORT_FIELD2" => "id",
      "ELEMENT_SORT_ORDER" => "asc",
      "ELEMENT_SORT_ORDER2" => "desc",
      "ENLARGE_PRODUCT" => "STRICT",
      "FILTER_NAME" => "byerFilter",
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
  );?>
</section>
  <?}?>
<?}?>