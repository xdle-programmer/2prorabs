<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
<?if($arResult['ITEMS']){?>
    <div class="for-you">
        <div class="container">
            <div class="title"><?=$arResult['DESCRIPTION']?></div>
            <div class="for-you__grid">
                <div class="for-you__row">
                    <div class="for-you__item-box">
                        <?foreach($arResult["ITEMS"] as $arItem){?>
                          <?
                          $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                          $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                          ?>
                            <div class="for-you__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                <div class="for-you__icon-box"><img src="<?=CFile::GetPath($arItem['PROPERTIES']['SVG']['VALUE'])?>"></div>
                                <div class="for-you__item-title"><?=$arItem['NAME']?></div>
                                <div class="for-you__item-text"><?=$arItem['PREVIEW_TEXT']?></div>
                            </div>
                        <?}?>
                    </div>
					<?/*
                    <div class="for-you__image-box"><img class="for-you__image" src="<?=SITE_TEMPLATE_PATH?>/assets/src/blocks/for-you/assets/img/group.png"></div>
					*/?>
                </div>
            </div>
        </div>
    </div>
<?}?>