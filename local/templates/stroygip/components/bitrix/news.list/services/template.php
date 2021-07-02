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
<div class="services__inner">
    <div class="services__tabs" style="display: none">
      <? $counter =0;
        foreach($arResult["ITEMS"] as $arItem){?>
        <div class="services__tab <?if($counter ==0){?>active<?}$counter++;?>"><?=$arItem['NAME']?></div>
      <?}?>
    </div>
  <? $counter =0;
    foreach($arResult["ITEMS"] as $arItem){?>
  <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
  ?>
    <div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="services__content <?if($counter ==0){?>active<?}$counter++;?>">
        <div class="services__subtitle"><?=$arItem['NAME']?>
            <div class="services__description">
              <?=$arItem['PREVIEW_TEXT']?>
            </div>
            <?if($arItem['PROPERTIES']['PHOTO']['VALUE']){?>
            <div class="services__carousel owl-carousel owl-theme owl-carousel-style">
                <?foreach ($arItem['PROPERTIES']['PHOTO']['VALUE'] as $photo){?>
                    <div class="services__item"><img src="<?=CFile::GetPath($photo)?>"></div>
                <?}?>
            </div>
            <?}?>
        </div>
    </div>
  <?}?>
</div>
