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
<div class="static-page__title">Наши магазины</div>
<?if($arResult['ITEMS']){?>
  <?foreach($arResult["ITEMS"] as $arItem){?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>

	<div class="static-page__stores">
		<div class="static-page__stores-items">
			<div class="static-page__stores-item static-page__stores-item--active" data-store-target="1">
				<div class="static-page__stores-item-title"><?=$arItem['NAME']?></div>
				<div class="static-page__stores-info">
					<div class="static-page__stores-info-item">
						<div class="static-page__stores-info-item-title">
							<svg class="static-page__stores-info-item-title-icon">
								<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#address"></use>
							</svg>
							<div class="static-page__stores-info-item-title-text">Адрес:</div>
						</div>
						<div class="static-page__stores-info-item-value"><?=$arItem['PROPERTIES']['ADRES']['VALUE']?></div>
					</div>
					<div class="static-page__stores-info-item">
						<div class="static-page__stores-info-item-title">
							<svg class="static-page__stores-info-item-title-icon">
								<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#time"></use>
							</svg>
							<div class="static-page__stores-info-item-title-text">Режим работы:</div>
						</div>
						<div class="static-page__stores-info-item-value"><?=$arItem['PROPERTIES']['TIME']['VALUE']?></div>
					</div>
					<div class="static-page__stores-info-item">
						<div class="static-page__stores-info-item-title">
							<svg class="static-page__stores-info-item-title-icon">
								<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#phone"></use>
							</svg>
							<div class="static-page__stores-info-item-title-text">Телефон:</div>
						</div>
						<div class="static-page__stores-info-item-value"><?=$arItem['PROPERTIES']['PHONE']['VALUE']?></div>
					</div>
					<div class="static-page__stores-info-item">
						<div class="static-page__stores-info-item-title">
							<svg class="static-page__stores-info-item-title-icon">
								<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#mail"></use>
							</svg>
							<div class="static-page__stores-info-item-title-text">E-mail:</div>
						</div>
						<div class="static-page__stores-info-item-value"><?=$arItem['PROPERTIES']['EMAIL']['VALUE']?></div>
					</div>
				</div>
			</div>
		</div>
		<div class="static-page__stores-maps">
			<div class="static-page__stores-map static-page__stores-map--active" data-store="1">
				<?=$arItem['PROPERTIES']['MAP']['~VALUE']['TEXT']?>
			</div>
		</div>
	</div>

    <?}?>
<?}?>