<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$this->setFrameMode(true);
if (count($arResult["ITEMS"]) > 0) {
?>
<section class="find-us find-us--light-blue">
	<div class="container">
		<div class="find-us__title find-us__title--black">Узнайте о нас больше</div>
		<div class="find-us__carousel owl-carousel owl-theme find-us__carousel--blue">
            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                    CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                    CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                    array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                if ($arItem['PROPERTIES']['VIDEO']['VALUE']) {
                ?>
				<div class="find-us__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
					<div class="find-us__overlay" id="overlay"></div>
					<video class="find-us__video" id="video">
						<source src="<?= CFile::GetPath($arItem['PROPERTIES']['VIDEO']['VALUE']); ?>">
					</video>
				</div>
            <? }
                endforeach; ?>
		</div>
	</div>
</section>
<?}?>