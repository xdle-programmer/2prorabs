<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
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

$bxajaxid = CAjax::GetComponentID($component->__name, $component->__template->__name,
    $component->arParams['AJAX_OPTION_ADDITIONAL']);
?>
<div class="stock__grid">
    <? foreach ($arResult["ITEMS"] as $arItem) {
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
            CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
            CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
            array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        $arFileTmp = CFile::ResizeImageGet(
            $arItem['PREVIEW_PICTURE']['ID'],
            ['width' => 368, 'height' => 152],
            BX_RESIZE_IMAGE_PROPORTIONAL
        );
        ?>
		<div class="stock__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
			<div class="stock__image-box">
				<img class="stock__image" src="<?= $arFileTmp['src']; ?>">
			</div>
			<div class="stock__inner">
                <? if (!empty($arItem['PROPERTIES']['SELL_OUT']['VALUE'])) { ?>
					<div class="stock__discount">
						<div class="stock__discount-icon"></div>
						<div class="stock__discount-text"><?= $arItem['PROPERTIES']['SELL_OUT']['VALUE']; ?></div>
					</div>
                <? } ?>
				<div class="stock__title"><?= $arItem['NAME']; ?></div>
				<div class="stock__description"><?= $arItem['PREVIEW_TEXT']; ?></div>
				<div class="stock__discount-time">
					<div class="stock__discount-time-icon"></div>
					<div class="stock__discount-time-text">Акция действует до <?= date('d.m.Y',
                            strtotime($arItem['DATE_ACTIVE_TO'])); ?></div>
				</div>
				<div class="stock__buttons">
					<div class="button button-more stock__button"
					     onclick="location.href='<?= $arItem['DETAIL_PAGE_URL']; ?>'">Подробнее
						<div class="button-more__arrow"></div>
					</div>
					<a class="button button--red button--red-width stock__button" href="/catalog/">В каталог</a>
				</div>
			</div>
		</div>
    <? }; ?>
</div>
<? if ($arResult["NAV_RESULT"]->nEndPage > 1 && $arResult["NAV_RESULT"]->NavPageNomer < $arResult["NAV_RESULT"]->nEndPage): ?>

<div class="stock__button-all" id="btn_<?= $bxajaxid ?>">
		<a class="button button-all" data-ajax-id="<?= $bxajaxid ?>" href="javascript:void(0)"
		   data-show-more="<?= $arResult["NAV_RESULT"]->NavNum ?>"
		   data-next-page="<?= ($arResult["NAV_RESULT"]->NavPageNomer + 1) ?>"
		   data-max-page="<?= $arResult["NAV_RESULT"]->nEndPage ?>">Показать еще</a>


</div>
<? endif ?>

<? if ($arResult["NAV_RESULT"]->nEndPage > 1 && $arResult["NAV_RESULT"]->NavPageNomer < $arResult["NAV_RESULT"]->nEndPage): ?>

    <div class="stock__pagination">
            <br/><?= $arResult["NAV_STRING"] ?>
        </div>
    <? endif; ?>





