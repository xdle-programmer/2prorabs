<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);
?>
<div class="special-conditions__inner">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="special-conditions__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="special-conditions__title">
			<div class="special-conditions__title-icon"><img src="<?= SITE_TEMPLATE_PATH;?>/assets/src/blocks/special-conditions/assets/img/productadded.svg"></div><?= $arItem['NAME'];?>
		</div>
	</div>
<?endforeach;?>

</div>