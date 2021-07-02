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
<?if($arResult['ITEMS']){?>
    <section class="read-blogs read-blogs--white">
    <div class="container">
        <div class="title">Похожие статьи</div>
        <div class="item-owl-container">
            <div class="read-blogs__carousel owl-carousel owl-theme owl-carousel-style">
              <?foreach($arResult["ITEMS"] as $arItem){?>
              <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
              ?>
                <div class="read-blogs__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <div class="read-blogs__item-image read-blogs__item-image-news">
                        <?if($arItem['PREVIEW_PICTURE']['SRC']){?>
                            <img class="read-blogs__img read-blogs__img--size" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>">
                        <?}?>
                    </div>
                    <div class="read-blogs__date"><?=$arItem['DISPLAY_ACTIVE_FROM']?></div>
                    <div class="read-blogs__item-title"><?=$arItem['NAME']?></div>
                    <div class="read-blogs__item-text"><?=TruncateText($arItem['PREVIEW_TEXT'], 140);?></div>
                    <a class="read-blogs__item-button" href="<?=$arItem['DETAIL_PAGE_URL']?>">Подробнее
                        <div class="read-blogs__item-button-icon"></div>
                    </a>
                </div>
              <?}?>
            </div>
        </div>
    </div>
</section>
<?}?>