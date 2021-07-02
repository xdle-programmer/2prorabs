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
<div class="happy-help">
    <div class="container">
        <div class="title"><?=$arResult['DESCRIPTION']?></div>
        <div class="happy-help__carousel owl-carousel owl-theme owl-carousel-style">
          <?foreach($arResult["ITEMS"] as $arItem){?>
          <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
          ?>
            <div class="happy-help__item">
                <div class="happy-help__image-box">
                    <?if($arItem['PREVIEW_PICTURE']['SRC']){?>
                        <img class="happy-help__image" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>">
                    <?}?>
                </div>
                <div class="happy-help__title"><?=$arItem['NAME']?></div>
                <div class="happy-help__text"><?=$arItem['PROPERTIES']['POSITION']['VALUE']?></div>
            </div>
          <?}?>
        </div>
    </div>
</div>
<?}?>