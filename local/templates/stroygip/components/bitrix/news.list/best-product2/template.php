<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
$this->setFrameMode(true);
?>
<div class="partners__nav">
	<div class="partners__nav-button partners__nav-button--prev">
		<svg class="partners__nav-button-icon">
		<use xlink:href="<?=SITE_TEMPLATE_PATH?>/ts/images/icons/icons-sprite.svg#arrow"></use>
		</svg>
	</div>
	<div class="partners__nav-button partners__nav-button--next">
		<svg class="partners__nav-button-icon">
		<use xlink:href="<?=SITE_TEMPLATE_PATH?>/ts/images/icons/icons-sprite.svg#arrow"></use>
		</svg>
	</div>
</div>
<div class="partners__slider">
<?foreach ($arResult['ITEMS'] as $arItem): 
	if(empty($arItem['PREVIEW_PICTURE']['SRC'])) continue; ?>
	<div class="partners__slider-item-wrapper">
		<div class="partners__slider-item">
			<img class="partners__slider-item-img preload__item" data-src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>">
		</div>
	</div>
<?endforeach;?>
</div>
