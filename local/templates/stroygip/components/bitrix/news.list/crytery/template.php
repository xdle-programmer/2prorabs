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
<div class="supplier-criteria">
    <div class="container">
        <div class="title"><?=htmlspecialchars_decode($arResult['NAME'])?></div>
        <div class="supplier-criteria__inner">
            <div class="supplier-criteria__information">
                <?=htmlspecialchars_decode($arResult['DESCRIPTION'])?>
            </div>
            <div class="supplier-criteria__image-box"><img class="supplier-criteria__image" src="/local/templates/stroygip/assets/src/blocks/supplier-criteria/assets/img/car.png"></div>
        </div>
    </div>
</div>
<div class="supplier-criteria__guid container">
  <?foreach($arResult["ITEMS"] as $arItem){?>
  <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
  ?>
    <div class="supplier-criteria__guid-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <div class="supplier-criteria__guid-title"><?=$arItem['NAME']?></div>
        <div class="supplier-criteria__guid-text"><?=$arItem['PREVIEW_TEXT']?></div>
        <?if($arItem['PROPERTIES']['URL']['VALUE']){?>
            <a class="supplier-criteria__guid-link" target="_blank" href="<?=$arItem['PROPERTIES']['URL']['VALUE']?>">Подробнее
            <div class="supplier-criteria__guid-link-arrow"></div></a>
        <?}?>
    </div>
  <?}?>
</div>
