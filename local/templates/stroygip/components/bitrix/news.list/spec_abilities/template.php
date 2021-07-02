<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$this->setFrameMode(true);
if (count($arResult["ITEMS"]) > 0) {

?>
<div class="title"><?= $arResult['NAME'];?></div>
<?if ($arResult['~DESCRIPTION']) {?>
	<div class="payment-features__subtitle"><?= $arResult['~DESCRIPTION'];?></div>
<?}?>
<div class="<?= $arParams['CONTAINER_CLASS'];?>">
    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
            CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
            CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
            array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
		<div class="<?= $arParams['ITEM_CLASS'];?>" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
			<?if ($arItem['PROPERTIES']['SVG']['VALUE']) {?>
			<div class="<?= $arParams['ICON_CLASS'];?>">
				<img src="<?= CFile::GetPath($arItem['PROPERTIES']['SVG']['VALUE']);?>">
			</div>
			<?}?>
			<div class="<?= $arParams['TITLE_CLASS'];?>"><?= $arItem['NAME']; ?></div>
		</div>
    <? endforeach; ?>
</div>
<?}?>