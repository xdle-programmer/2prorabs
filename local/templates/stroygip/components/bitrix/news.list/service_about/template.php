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
<section class="improvement-service">
    <div class="container">
        <div class="title improvement-service__title"><?=$arResult['DESCRIPTION']?></div>
        <div class="improvement-service__inner improvement-service__inner--direction">
          <?foreach($arResult["ITEMS"] as $arItem){?>
          <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
          ?>
            <div class="improvement-service__item improvement-service__item--indent improvement-service__item--width" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="improvement-service__item-icon"><img src="<?=CFile::GetPath($arItem['PROPERTIES']['SVG']['VALUE'])?>"></div>
                <div class="improvement-service__item-text"><?=$arItem['NAME']?></div>
                <div class="improvement-service__text"><?=$arItem['PREVIEW_TEXT']?></div>
            </div>
          <?}?>
        </div>
    </div>
</section>
<?}?>
