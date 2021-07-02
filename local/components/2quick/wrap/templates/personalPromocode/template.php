<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */

?>

<div class="personal-area__card personal-area__card--column">
    <div class="personal-area__card-title personal-area__card-title--mb">Использовать промокод</div>
    <div class="personal-area__card-input-box">
        <div class="show_messages"></div>
        <div class="input-styled">
            <label class="input-styled__label" for="input-bonuses">Введите промокод</label>
            <input class="input-styled__input" type="text" id="input-bonuses">
        </div>
    </div>
    <div class="button button--red button--red-width personal-area__card-button" id="sendPromocode">Применить</div>
</div>