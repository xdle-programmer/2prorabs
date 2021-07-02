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
?>

<div class="owl-carousel owl-theme main-owl-carousel">
    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        $link = false;

        if (!empty($arItem['PROPERTIES']['LINK']['VALUE'])) {
            $link = true;
        }

        ?>

        <div id="<?= $this->GetEditAreaId($arItem['ID']); ?>">

            <? if ($link): ?>
                <a href="<?= $arItem['PROPERTIES']['LINK']['VALUE'] ?>" class="main-item__slide"
                   style="background: url(<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>)"></a>
                <a href="<?= $arItem['PROPERTIES']['LINK']['VALUE'] ?>" class="main-item__slide-mobile"
                   style="background: url(<?= $arItem['DETAIL_PICTURE']['SRC'] ?>)"></a>
            <? else: ?>
                <div class="main-item__slide" style="background: url(<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>)"></div>
                <div class="main-item__slide-mobile"
                     style="background: url(<?= $arItem['DETAIL_PICTURE']['SRC'] ?>)"></div>
            <? endif; ?>
        </div>

    <? endforeach; ?>

</div>