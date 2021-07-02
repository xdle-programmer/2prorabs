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
<div class="footer__icons-box">
    <div class="footer__icons-title">Мы в социальных сетях:</div>
    <div class="footer__icons">
      <?foreach($arResult["ITEMS"] as $arItem){?>
      <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
      ?>
        <a id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="footer__icon" target="_blank" href="<?=$arItem['PROPERTIES']['URL']['VALUE']?>"><img src="<?=CFile::GetPath($arItem["PROPERTIES"]['ICON']['VALUE'])?>"></a>
      <?}?>
    </div>
</div>
