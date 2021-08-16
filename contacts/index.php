<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?>
<section class="section section--gray">
	<div class="layout">
	  <div class="breadcrumb">
	  <a class="breadcrumb__item" href="/">Главная</a>
		<svg class="breadcrumb__separator">
		  <use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#arrow"></use>
		</svg>
		<div class="breadcrumb__item breadcrumb__item--active">Контакты</div>
	  </div>
	  <div class="static-page">
		<div class="static-page__title">Контакты</div>
		
      <?$APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "contacts_data",
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
          "FILTER_NAME" => "",
          "HIDE_LINK_WHEN_NO_DETAIL" => "N",
          "IBLOCK_ID" => "27",
          "IBLOCK_TYPE" => "office",
          "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
          "INCLUDE_SUBSECTIONS" => "Y",
          "MESSAGE_404" => "",
          "NEWS_COUNT" => "20",
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
          "PROPERTY_CODE" => array("EMAIL", "PHONES", ""),
          "SET_BROWSER_TITLE" => "N",
          "SET_LAST_MODIFIED" => "N",
          "SET_META_DESCRIPTION" => "N",
          "SET_META_KEYWORDS" => "N",
          "SET_STATUS_404" => "N",
          "SET_TITLE" => "N",
          "SHOW_404" => "N",
          "SORT_BY1" => "SORT",
          "SORT_BY2" => "ID",
          "SORT_ORDER1" => "DESC",
          "SORT_ORDER2" => "ASC",
          "STRICT_SECTION_CHECK" => "N"
        )
      );?>
		
	  </div>
	</div>
</section>
<section class="section">
	<div class="layout">
	  <div class="static-page">
      <?$APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "shops_data",
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
          "FILTER_NAME" => "",
          "HIDE_LINK_WHEN_NO_DETAIL" => "N",
          "IBLOCK_ID" => "50",
          "IBLOCK_TYPE" => "office",
          "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
          "INCLUDE_SUBSECTIONS" => "Y",
          "MESSAGE_404" => "",
          "NEWS_COUNT" => "20",
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
          "PROPERTY_CODE" => array("ADRES", "TIME", "PHONE", "EMAIL", "MAP"),
          "SET_BROWSER_TITLE" => "N",
          "SET_LAST_MODIFIED" => "N",
          "SET_META_DESCRIPTION" => "N",
          "SET_META_KEYWORDS" => "N",
          "SET_STATUS_404" => "N",
          "SET_TITLE" => "N",
          "SHOW_404" => "N",
          "SORT_BY1" => "SORT",
          "SORT_BY2" => "ID",
          "SORT_ORDER1" => "DESC",
          "SORT_ORDER2" => "ASC",
          "STRICT_SECTION_CHECK" => "N"
        )
      );?>
	  </div>
	</div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>