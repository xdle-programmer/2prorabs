<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();
$arResult['MARKS'] = \nav\ArrayTools::rebuildByKey(DDS\HL::HLGetlist(HL_BLOCK_MARKS), 'UF_XML_ID');

foreach ($arResult['ITEMS'] as &$arItem) {
    if (!empty($arItem['PROPERTIES']['OLD_PRICE']['VALUE']) && ($arItem['PROPERTIES']['OLD_PRICE']['VALUE'] - $arItem['MIN_PRICE']['VALUE']) > 0.1) {
        $arItem['MIN_PRICE']['DISCOUNT_DIFF'] = $arItem['PROPERTIES']['OLD_PRICE']['VALUE'] - $arItem['MIN_PRICE']['VALUE'];
        $arItem['MIN_PRICE']['VALUE'] = $arItem['PROPERTIES']['OLD_PRICE']['VALUE'];
    }
}

unset($arItem);

