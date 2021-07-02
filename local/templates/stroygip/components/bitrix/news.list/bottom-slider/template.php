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
$this->setFrameMode(true);
?>
<div class="section">
	<div class="layout">
		<div class="natural-banner preload__area">
			<div class="natural-banner__nav">
				<div class="natural-banner__nav-button natural-banner__nav-button--prev">
					<svg class="natural-banner__nav-button-icon">
						<use xlink:href="<?=SITE_TEMPLATE_PATH?>/ts/images/icons/icons-sprite.svg#arrow"></use>
					</svg>
				</div>
				<div class="natural-banner__nav-button natural-banner__nav-button--next">
					<svg class="natural-banner__nav-button-icon">
						<use xlink:href="<?=SITE_TEMPLATE_PATH?>/ts/images/icons/icons-sprite.svg#arrow"></use>
					</svg>
				</div>
			</div>
			<div class="natural-banner__wrapper">
				<?foreach($arResult["ITEMS"] as $arItem):?>
				<div class="natural-banner__item">
					<img class="natural-banner__img preload__item" data-src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>">
					<div class="natural-banner__desc">
						<a class="natural-banner__desc-title" href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>"><?echo $arItem["NAME"]?></a>
						<a class="natural-banner__desc-link" href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>">Подробнее</a>
					</div>
				</div>
				<?endforeach;?>
			</div>
		</div>
	</div>
</div>

