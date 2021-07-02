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
<div class="goods-services">
    <div class="container">
        <div class="title"><?=$arResult['NAME']?>:</div>
        <div class="goods-services__inner">
          <? foreach ($arResult['ITEMS'] as $arItem){?>
          <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
          ?>
            <div class="goods-services__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <?if($arItem['PROPERTIES']['SVG']['VALUE']){?>
                    <div class="goods-services__item-icon"><img src="<?= CFile::GetPath($arItem['PROPERTIES']['SVG']['VALUE']) ?>"></div>
                <?}?>
                <div class="goods-services__item-title"><?= $arItem['NAME'] ?></div>
            </div>
          <?}?>
        </div>
    </div>
</div>
