<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$this->setFrameMode(true);
if (count($arResult['ITEMS']) > 0) {
    ?>
	<div class="return-conditions__advantages">
		<div class="container">
			<div class="return-conditions__advantages-inner">

                <? foreach ($arResult["ITEMS"] as $arItem): ?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                        CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                        CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                        array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
					<div class="return-conditions__advantages-item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                        <? if ($arItem['PROPERTIES']['SVG']['VALUE']) { ?>
							<div class="return-conditions__advantages-icon">
								<img src="<?= CFile::GetPath($arItem['PROPERTIES']['SVG']['VALUE']); ?>">
							</div>
                        <? } ?>
						<div class="return-conditions__advantages-title"><?= $arItem['NAME']; ?></div>
                        <? if ($arItem['~PREVIEW_TEXT']) {
                            echo $arItem['~PREVIEW_TEXT'];
                        } ?>
					</div>
                <? endforeach; ?>
			</div>
		</div>
	</div>
<? } ?>