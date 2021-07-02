<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();
$arResult['MARKS'] = \nav\ArrayTools::rebuildByKey(DDS\HL::HLGetlist(HL_BLOCK_MARKS), 'UF_XML_ID');

