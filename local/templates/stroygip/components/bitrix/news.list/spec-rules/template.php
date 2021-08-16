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
<div class="static-page__title"><?=GetMessage('RULES_TITLE')?></div>
<div class="static-page__special">
	<div class="static-page__special-header">
		<?foreach ($arResult['SECTIONS_LIST'] as $key => $item):?>
		<div class="static-page__special-header-item <?if($key == 0):?>static-page__special-header-item--active<?endif;?>" data-target="<?=$key+1?>">
		<?=$item['NAME']?>
		</div>
		<?endforeach;?>
	</div>
	<div class="static-page__special-items">
		<?foreach ($arResult['SECTIONS_LIST'] as $key => $item):?>
		<div class="static-page__special-item <?if($key == 0):?>static-page__special-item--active<?endif;?>" data-name="<?=$key+1?>">
			<div class="static-page__special-list">
				<? foreach ($arResult['SECTION_ITEM'][$item['ID']] as $arItem): ?>
				<div class="static-page__special-list-item">
					<?if(!empty($arItem['PROPERTIES']['SVG']['VALUE'])):?>
					<div class="static-page__special-list-item-img-wrapper">
					  <img class="static-page__special-list-item-img" src="<?=CFile::GetPath($arItem['PROPERTIES']['SVG']['VALUE'])?>">
					</div>
					<?endif;?>
					<div class="static-page__special-list-item-desc">
						<div class="static-page__special-list-item-desc-title"><?=$arItem['NAME']?></div>
						<div class="static-page__special-list-item-desc-text"><?=$arItem['PREVIEW_TEXT']?></div>
					</div>
				</div>
				<? endforeach; ?>
		    </div>
		</div>
		<?endforeach;?>
	</div>
</div>
