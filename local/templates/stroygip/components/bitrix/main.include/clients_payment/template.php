<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */
/** @var CBitrixComponent $component */
?>
<div class="payment-features__item-icon">
    <img src="<?=$arParams['ICON_URL']?>">
</div>
<div class="payment-features__item-title">
    <? if ($arResult["FILE"] != ''): ?>
        <? include($arResult["FILE"]); ?>
    <? endif; ?>
</div>
