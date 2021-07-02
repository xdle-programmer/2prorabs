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
<section class="cooperation">
    <div class="container">
        <div class="cooperation__box">
            <div class="cooperation__tabs cooperation__tabs--mb">
              <?foreach($arResult["ITEMS"] as $key => $arItem){?>
                <div class="cooperation__button <?if($key == 1){?>active<?}?>"><?=$arItem['NAME']?></div>
              <?}?>
            </div>
          <?foreach($arResult["ITEMS"] as $keyblock=>$arItem){?>
          <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
          ?>
            <div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="cooperation__content <?if($keyblock == 1){?>active<?}?>"><?=$arItem['PREVIEW_TEXT']?></div>
          <?}?>
        </div>
    </div>
</section>
<?}?>