<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
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
use Bitrix\Main\Localization\Loc;
$APPLICATION->AddViewContent('body', 'cart-page');
include 'tabs.php';
?>
<div class="steps-cart" id="tq_order">
<div class="bx-soa-empty-cart-container" >
    <div class="bx-soa-empty-cart-image">
        <img src="/bitrix/components/bitrix/sale.basket.basket/templates/.default/images/empty_cart.svg" alt="">
    </div>
    <div class="bx-sbb-empty-cart-text">Ваша корзина пуста</div>
    <div class="bx-sbb-empty-cart-desc">
        <a href="/">Нажмите здесь</a>, чтобы продолжить покупки		</div>
</div>
</div>