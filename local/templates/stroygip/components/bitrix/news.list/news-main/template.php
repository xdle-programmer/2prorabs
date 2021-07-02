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
$arResult['CHUNKED_ITEM'] = array_chunk($arResult['ITEMS'], 4);
?>
<section class="read-blogs">
    <div class="container">
        <div class="title"><?= GetMessage('CT_TITLE') ?></div>
        <div class="item-owl-container">
            <div class="read-blogs__carousel owl-carousel owl-theme owl-carousel-style">
                <? foreach ($arResult['CHUNKED_ITEM'] as $item): ?>
                    <? foreach ($item as $arItem): ?>
                        <?
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        ?>
                        <div class="read-blogs__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                            <div class="read-blogs__item-image">
                                <? if (!empty($arItem['PREVIEW_PICTURE']['SRC'])): ?>
                                    <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><img class="read-blogs__img" src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>"></a>
                                <? endif; ?>
                            </div>
                            <div class="read-blogs__item-title"><?= $arItem['NAME'] ?></div>
                            <div class="read-blogs__item-text"><?= $arItem['PREVIEW_TEXT'] ?></div>
                            <a class="read-blogs__item-button" href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= GetMessage('CT_MORE') ?>
                                <div class="read-blogs__item-button-icon"></div>
                            </a>
                        </div>
                    <? endforeach; ?>
                <? endforeach; ?>
            </div>
        </div>
    </div>
</section>