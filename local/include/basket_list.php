<?
use \Bitrix\Sale;

unset($_SESSION["BASKET_PRODUCTS"]);

$basketStorage1 = \Bitrix\Sale\Basket\Storage::getInstance(
    \Bitrix\Sale\Fuser::getId(), 
    \Bitrix\Main\Context::getCurrent()->getSite()
);
$basket1 = $basketStorage1->getOrderableBasket();
foreach ($basket1 as $user_basket_item1) {
	$arr_product = $user_basket_item1->getFieldValues();
	$_SESSION["BASKET_PRODUCTS"][$arr_product["PRODUCT_ID"]] = intval($arr_product["QUANTITY"]);
}
?>
