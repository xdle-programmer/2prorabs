<?
/**
*@var array $arResult
 **/
?>

<div class="basket-products__container basket-products__container--pb">
    <div class="basket-products__title-medium basket-products__title-medium--mb">Ваш заказ:</div>
    <div class="basket-products__row">
        <div class="basket-products__row-name">Товары <?=count($arResult['ITEMS'])?> шт.</div>
        <div class="basket-products__row-info"><?=$arResult['INFO_ORDER']['FORMATED_BASKET_SUM']?></div>
    </div>
    <div class="basket-products__row">
        <div class="basket-products__row-name">Вес заказа</div>
        <div class="basket-products__row-info"><?=$arResult['INFO_ORDER']['WEIGHT']?> кг</div>
    </div>
    <?/*if($arResult['INFO_ORDER']['DISCOUNT_PERCENT']){?>
        <div class="basket-products__row">
            <div class="basket-products__row-name">Скидка <?=$arResult['INFO_ORDER']['DISCOUNT_PERCENT']?>%</div>
            <div class="basket-products__row-info basket-products__row-info--red">-<?=$arResult['INFO_ORDER']['FORMATED_DISCOUNT_PRICE']?></div>
        </div>
    <?}*/?>
    <?/*<div class="basket-products__row">
        <div class="basket-products__row-name">Доставка</div>
        <div class="basket-products__row-info" id="total_delivery">От 120 сомов<?//=$arResult['INFO_ORDER']['FORMATED_DELIVERY_PRICE']?></div>
    </div>*/?>
    <div class="basket-products__total-cost">
        <div class="basket-products__total-cost-row">
            <div class="basket-products__total-cost-name">Общая стоимость:</div>
            <div class="basket-products__total-cost-amount" id="total_order"><?=$arResult['INFO_ORDER']['FORMATED_SUM']?></div>
        </div>
    </div>
</div>

