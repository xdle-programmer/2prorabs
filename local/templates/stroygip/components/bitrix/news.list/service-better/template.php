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
<section class="improvement-service">
    <div class="container">
        <div class="title improvement-service__title"><?=GetMessage('CT_TITLE_SERVICE')?></div>
        <div class="improvement-service__inner">
            <? foreach ($arResult['ITEMS'] as $arItem): ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
                <div class="improvement-service__item"  id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <div class="improvement-service__item-icon">
                        <?if(!empty($arItem['PROPERTIES']['SVG']['VALUE'])):?>
                            <img src="<?=CFile::GetPath($arItem['PROPERTIES']['SVG']['VALUE']);?>">
                        <?endif;?>
                    </div>
                    <div class="improvement-service__item-text"><?=$arItem['NAME']?></div>
                </div>
            <?endforeach;?>
        </div>
    </div>
</section>
