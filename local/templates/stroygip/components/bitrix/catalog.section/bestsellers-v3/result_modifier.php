<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$res = CIBlockElement::GetByID(329212);
if($ar_res = $res->GetNext()){
	$arResult['BLOCK_GRID'] = $ar_res['PREVIEW_TEXT'];
}



