<?
use \Bitrix\Sale;

//unset($_SESSION["BASKET_PRODUCTS"]);

$user_basket_storage = \Bitrix\Sale\Basket\Storage::getInstance(\Bitrix\Sale\Fuser::getId(), SITE_ID);
$user_basket = $user_basket_storage->getBasket();

$basket = \Bitrix\Sale\Basket::loadItemsForFUser(
   \Bitrix\Sale\Fuser::getId(), 
   \Bitrix\Main\Context::getCurrent()->getSite()
);

foreach ($user_basket as $user_basket_item) {
	$arr_product = $user_basket_item->getFieldValues();
	$_SESSION["BASKET_PRODUCTS"][$arr_product["PRODUCT_ID"]] = intval($arr_product["QUANTITY"]);
}
?>