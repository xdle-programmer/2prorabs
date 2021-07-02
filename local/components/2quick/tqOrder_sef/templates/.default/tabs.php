<?
/**
*@var array $arResult
 **/
?>

<div class="basket-products__steps">
    <?$active = false;
    foreach ($arResult['TABS'] as $key=>  $arTab){
        if($arTab['ACTIVE'])$active = true?>
        <?if($key !=0){?>
        <div class="basket-products__step-arrow"></div>
            <?}?>
        <div class="basket-products__step-item<?if($active && !$arTab['ACTIVE'])echo ' basket-products__step-item--disable';elseif(!$active || $arResult['ORDER']['ORDER_ID'])echo ' basket-products__step-item--active'?>">
            <div class="basket-products__step-icon"><?=$key+1?></div>
            <div class="basket-products__step-text"><?=$arTab['NAME']?></div>
        </div>
    <?}?>
</div>

