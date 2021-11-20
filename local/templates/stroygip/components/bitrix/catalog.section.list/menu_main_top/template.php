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

if (0 < $arResult["SECTIONS_COUNT"])
{
	foreach ($arResult['SECTIONS'] as &$arSection)
	{
		if (false === $arSection['PICTURE'])
			$arSection['PICTURE'] = array(
				'SRC' => $arCurView['EMPTY_IMG'],
				'ALT' => (
					'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
					? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
					: $arSection["NAME"]
				),
				'TITLE' => (
					'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
					? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
					: $arSection["NAME"]
				)
			);
			// $arSection['PICTURE']['SRC'];
			?>
			<div class="header__catalog-slider-item" data-url="<?=$arSection['SECTION_PAGE_URL']?>" data-menu-target="category-<?=$arSection['ID']?>">
				<div class="header__catalog-slider-item-inner"><? echo $arSection['NAME']; ?></div>
			</div>
		<?
	}
}
?>
