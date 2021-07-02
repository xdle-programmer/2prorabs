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
<section class="choice-buyers">
    <div class="container">
        <div class="title"><?=GetMessage('BUYERS_CHOSE_TITLE')?></div>
        <div class="choice-buyers__carousel owl-carousel owl-theme">
            <? foreach ($arResult['ITEMS'] as $arItem): ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

            $catalogItem =  $arResult['CATALOG_ITEM'][$arItem['PROPERTIES']['ITEM']['VALUE']];

            if(empty($catalogItem)) continue;

            ?>
            <div class="choice-buyers__carousel-box" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <div class="choice-buyers__item">
                    <div class="choice-buyers__product">
                        <div class="choice-buyers__product-head">
                            <div class="choice-buyers__product-title"><?=$catalogItem['NAME']?></div>
                            <div class="choice-buyers__product-price">
                                <?if(!empty($catalogItem['PRICE']["RESULT_PRICE"]["DISCOUNT"])):?>
                                    <div class="choice-buyers__product-discount"><?=round($catalogItem['PRICE']["RESULT_PRICE"]["BASE_PRICE"],0,PHP_ROUND_HALF_UP)?>&nbsp;<?= CURRENCY;?><!--<img src="<?/*=SITE_TEMPLATE_PATH*/?>/assets/src/images/icons/combined-shape.svg">--></div>
                                <?endif;?>
                                <div class="choice-buyers__product-cost"><?=round($catalogItem['PRICE']["RESULT_PRICE"]["DISCOUNT_PRICE"],0,PHP_ROUND_HALF_UP)?>&nbsp;<?= CURRENCY;?><!--<img src="<?/*=SITE_TEMPLATE_PATH*/?>/assets/src/images/icons/combined-shape.svg">--></div>
                            </div>
                        </div>
                        <?if(!empty($catalogItem['PROPERTY_MODEL_VALUE'])):?>
                            <div class="choice-buyers__product-model"><?=GetMessage('BUYERS_CHOSE_MODELS')?> <?=$catalogItem['PROPERTY_MODEL_VALUE']?></div>
                        <?endif;?>
                        <?if(!empty($catalogItem['PROPERTY_ART_NUMBER_VALUE'])):?>
                            <div class="choice-buyers__product-article"><?=GetMessage('BUYERS_CHOSE_ART')?> <?=$catalogItem['PROPERTY_ART_NUMBER_VALUE']?></div>
                        <?endif;?>
                        <div class="choice-buyers__product-reviews">
                            <?for ($i = 1; $i > 5; $i++):?>
                                <div class="choice-buyers__product-icon <?if($catalogItem['PROPERTY_RATING_VALUE'] > $i):?>active<?endif;?>"></div>
                            <?endfor;?>

                        </div>
                        <div class="choice-buyers__product-button"><a class="button button--red" href="<?=$catalogItem['DETAIL_PAGE_URL']?>"><?=GetMessage('BUYERS_CHOSE_BASKET')?></a></div>
                        <div class="choice-buyers__product-img">
                            <?if(!empty($catalogItem['PREVIEW_PICTURE'])):?>
                                <img src="<?=$catalogItem['PREVIEW_PICTURE'];?>">
                            <?endif;?>
                        </div>
                    </div>
                    <div class="choice-buyers__reviews">
                        <div class="choice-buyers__head">
                            <div class="choice-buyers__name"><?=$arItem['NAME']?></div>
                            <div class="choice-buyers__date"><?=$arItem['DISPLAY_ACTIVE_FROM']?></div>
                        </div>
                        <div class="choice-buyers__text"><?=$arItem['PREVIEW_TEXT']?>
                            <div class="choice-buyers__button"><a class="button button--small" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=GetMessage('BUYERS_CHOSE_MORE')?></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <? endforeach; ?>

        </div>
    </div>
</section>


