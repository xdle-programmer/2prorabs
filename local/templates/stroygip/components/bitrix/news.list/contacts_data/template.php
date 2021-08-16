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
<div class="static-page__contacts">
  <?foreach($arResult["ITEMS"] as $arItem){?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <div class="static-page__contacts-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="static-page__contacts-item-img-wrapper">
			<?if($arItem['PROPERTIES']['SVG']['VALUE']){?>
			<img class="static-page__contacts-item-img" src="<?=CFile::GetPath($arItem['PROPERTIES']['SVG']['VALUE'])?>">
			<?}?>
		</div>
		<div class="static-page__contacts-item-desc">
			<div class="static-page__contacts-item-desc-title"><?=$arItem['NAME']?></div>
			<div class="static-page__contacts-item-desc-items">
				<?if($arItem['PROPERTIES']['PHONES']['VALUE']){?>
					<?foreach ($arItem['PROPERTIES']['PHONES']['VALUE'] as $phone){?>
				<div class="static-page__contacts-item-desc-item">
					<svg class="static-page__contacts-item-desc-item-icon">
						<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#phone"></use>
					</svg>
					<div class="static-page__contacts-item-desc-item-text"><?=$phone?></div>
				</div>
					<?}?>
				<?}?>
				
				<?if($arItem['PROPERTIES']['EMAIL']['VALUE']){?>
				<div class="static-page__contacts-item-desc-item">
					<svg class="static-page__contacts-item-desc-item-icon">
						<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#mail"></use>
					</svg>
					<div class="static-page__contacts-item-desc-item-text"><?=$arItem['PROPERTIES']['EMAIL']['VALUE']?></div>
				</div>
				<?}?>
			</div>
		</div>
    </div>
    <?}?>
</div>
<?}?>