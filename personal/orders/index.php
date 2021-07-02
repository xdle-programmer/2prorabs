<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Мои заказы");
global $USER;
if (!$USER->IsAuthorized()) {
    LocalRedirect(SITE_DIR);
}
?>
<?$APPLICATION->IncludeComponent(
    "bitrix:sale.personal.order",
    "personal_orders",
    Array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "3600",
        "CACHE_TYPE" => "A",
        "CUSTOM_SELECT_PROPS" => array(""),
        "DETAIL_HIDE_USER_INFO" => array("0"),
        "DISALLOW_CANCEL" => "N",
        "HISTORIC_STATUSES" => array(''),
        "NAV_TEMPLATE" => "",
        "ORDERS_PER_PAGE" => "20",
        "ORDER_DEFAULT_SORT" => "STATUS",
        "PATH_TO_BASKET" => "/personal/cart",
        "PATH_TO_CATALOG" => "/catalog/",
        "PATH_TO_PAYMENT" => "/personal/order/payment/",
        "PROP_1" => array(),
        "REFRESH_PRICES" => "N",
        "RESTRICT_CHANGE_PAYSYSTEM" => array("0"),
        "SAVE_IN_SESSION" => "Y",
        "SEF_MODE" => "N",
        "SET_TITLE" => "N",
        "STATUS_COLOR_F" => "gray",
        "STATUS_COLOR_N" => "green",
        "STATUS_COLOR_OP" => "gray",
        "STATUS_COLOR_PSEUDO_CANCELLED" => "red"
    )
);?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>