<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var array $arResult */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
?>
<div class="basket-products__grid">
    <form class="basket-products__container" id="tq_order" data-tab="payment" data-next="<?= $arResult['TABS']['2']['URL'] ?>">
        <div class="basket-products__title"><?=$APPLICATION->ShowTitle(false)?></div>
        <?include 'tabs.php';?>
        <div class="basket-products__title basket-products__title--medium-center basket-products__title--mb">Оплата</div>
        <div class="basket-products__registration-inner">
            <div class="basket-products__registration-title basket-products__registration-title--mb">Выберите способ оплаты</div>
            <?foreach ($arResult['PAYMENT'] as $arPayment){?>
                <div class="basket-products__radio-box">
                    <div class="basket-products__radio-inner">
                        <input class="basket-products__radio-input" type="radio" name="payment" value="<?=$arPayment['ID']?>" name="payment"<?if($arPayment['CHECKED']=='Y')echo ' checked'?>>
                        <div class="basket-products__radio-circle"></div>
                        <div class="basket-products__radio-text"><?=$arPayment['NAME']?></div>
                    </div>
                    <div class="basket-products__radio-info">
                        <?=$arPayment['DESCRIPTION']?>
                    </div>
                </div>

            <?}?>


        </div>
        <button class="basket-products__next-button">Далее
            <div class="basket-products__next-button-icon"></div>
        </button>
        <div class="tq_errors"></div>

    </form>
    <?include 'order_info.php'?>
</div>

