<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 *
 *  _________________________________________________________________________
 * |    Attention!
 * |    The following comments are for system use
 * |    and are required for the component to work correctly in ajax mode:
 * |    <!-- items-container -->
 * |    <!-- pagination-container -->
 * |    <!-- component-end -->
 */

$this->setFrameMode(true); ?>
<div class="owl-carousel owl-theme main-owl-carousel">

    <?foreach ($arResult["ITEMS"] as $key => $arItem){?>
        <?/*
        <div class="main-item">
            <div class="main-item__inner">
                <div class="main-item__about">
                    <div class="main-item__title"><?=$arItem['NAME']?></div>
                    <div class="main-item__name"><?=$arItem['PROPERTIES']['MODEL']['VALUE']?></div>
                    <div class="main-item__might"><?=$arItem['PROPERTIES']['SIZE']['VALUE']?></div>
                    <div class="main-item__button"><a class="button" href="<?=$arItem['DETAIL_PAGE_URL']?>">Смотреть товар</a></div>
                </div>
                <?if($arItem['PREVIEW_PICTURE']['SRC']){?>
                    <div class="main-item__img">
                        <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>">
                    </div>
                <?}?>
                <div class="main-item__price">
                    <?if($arItem['MIN_PRICE']['DISCOUNT_DIFF']>0){?>
                        <div class="main-item__discount"><?=$arItem['MIN_PRICE']['VALUE']?></div>
                        <div class="main-item__cost">
                          <?=$arItem['MIN_PRICE']['DISCOUNT_VALUE']?>
                            <span><?=CURRENCY;?><span>
                        </div>
                    <?}else{?>
                        <div class="main-item__cost">
                          <?=$arItem['MIN_PRICE']['VALUE']?>
                            <span><?=CURRENCY;?><span>
                        </div>
                    <?}?>
                </div>
            </div>
        </div>
*/?>
	<?}?>
    <? foreach ($arResult["ITEMS"] as $key => $arItem) { ?>
        <div>
            <a href="#" class="main-item__slide" style="background: url(/upload/total_brand-web.jpg)"></a>
            <a href="#" class="main-item__slide-mobile" style="background: url(/upload/total_brand-web.jpg)"></a>
        </div>
    <? } ?>
</div>
