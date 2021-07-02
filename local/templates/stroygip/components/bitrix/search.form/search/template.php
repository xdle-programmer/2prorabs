<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$this->setFrameMode(true);?>

<form class="search-panel" action="<?=$arResult["FORM_ACTION"]?>">
    <div class="search-panel__icon"></div>
    <input name="q" class="search-panel__input" type="text" value="<?=$arParams['QUERY']?>">
    <button type="submit"  class="search-panel__button">Найти</button>
</form>