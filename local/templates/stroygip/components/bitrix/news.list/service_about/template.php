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
<?if($arResult['ITEMS']){?>
<div class="static-page">
	<div class="static-page__title"><?=$arResult['DESCRIPTION']?></div>
	<div class="static-page__advantages">
	<?foreach($arResult["ITEMS"] as $arItem){?>
	<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
		<div class="static-page__advantages-item">
			<?if( strlen($arItem['PROPERTIES']['SVG']['VALUE'])>0 ){?>
			<div class="static-page__advantages-item-img-wrapper">	
				<img class="static-page__advantages-item-img" src="<?=CFile::GetPath($arItem['PROPERTIES']['SVG']['VALUE'])?>">
			</div>
			<?}?>
			<div class="static-page__advantages-item-desc">
				<div class="static-page__advantages-item-desc-title"><?=$arItem['NAME']?></div>
				<div class="static-page__advantages-item-desc-text"><?=$arItem['PREVIEW_TEXT']?></div>
			</div>
		</div>
	<?}?>
	</div>
</div>
<?}?>
