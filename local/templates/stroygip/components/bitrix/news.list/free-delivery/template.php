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

<section class="delivery">
    <div class="container">
        <div class="delivery__inner">
            <div class="delivery__title">
                <?=$arParams['LABEL_PRIMARY']?>
            </div>
            <div class="delivery__subtitle"><?=$arParams['LABEL_2']?></div>
            <div class="delivery__instruction-title"><?=$arParams['LABEL_3']?></div>
            <div class="delivery__container-items">
                <? foreach ($arResult['ITEMS'] as $arItem): ?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="delivery__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                        <div class="delivery__item-icon">       <? if (!empty($arItem['PROPERTIES']['SVG']['VALUE'])): ?>
                                <img src="<?= CFile::GetPath($arItem['PROPERTIES']['SVG']['VALUE']) ?>">
                            <? endif; ?></div>
                        <div class="delivery__item-text"><?= $arItem['NAME'] ?></div>
                    </div>
                <? endforeach; ?>

            </div>
        </div>
    </div>
</section>
