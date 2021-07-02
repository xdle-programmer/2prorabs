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

<form id="main_banner_search" action="<?=$arResult["FORM_ACTION"]?>">
	<svg class="main-banner__search-icon" onclick="document.getElementById('main_banner_search').submit()">
		<use xlink:href="<?=SITE_TEMPLATE_PATH?>/ts/images/icons/icons-sprite.svg#search"></use>
	</svg>
	<div class="placeholder">
		<input class="input input--search placeholder__input" name="q" placeholder="Поиск товара">
		<div class="placeholder__item">Поиск товара</div>
	</div>
</form>