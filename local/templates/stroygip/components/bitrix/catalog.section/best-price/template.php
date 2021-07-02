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
 * |	Attention!
 * |	The following comments are for system use
 * |	and are required for the component to work correctly in ajax mode:
 * |	<!-- items-container -->
 * |	<!-- pagination-container -->
 * |	<!-- component-end -->
 */

$this->setFrameMode(true);?>
<?if($arResult['ITEMS']){?>
<section class="best-price">
    <div class="container">
        <div class="title-box">
            <div class="title-box__title">Лучшие цены недели</div>
            <div class="title-box__notification"><img src="<?=SITE_TEMPLATE_PATH?>/assets/src/images/icons/stopwatch.svg">Товар ограничен!</div>
        </div>
        <div class="best-price__carousel owl-carousel owl-theme">
          <?foreach (array_chunk($arResult["ITEMS"],4) as $arBlock){?>
            <div class="best-price__carousel-box">

                <div class="best-price__grid">
                    <?foreach ($arBlock as $key => &$arItem){
                        if (in_array($arItem['ID'], $arParams['FAVORITES'])) {
                            $fav_action = 'compfavdelete';
                            $fav_act = ' compfavactive';
                        } else {
                            $fav_action = 'compfav';
                            $fav_act = '';
                        }
                        if (in_array($arItem['ID'], $arParams['COMPARE'])) {
                            $comp_action = 'compfavdelete';
                            $comp_act = ' compfavactive';
                        } else {
                            $comp_action = 'compfav';
                            $comp_act = '';
                        }
                      $arItem['MIN_PRICE']['DISCOUNT_VALUE'] =round($arItem['MIN_PRICE']['DISCOUNT_VALUE'],0,PHP_ROUND_HALF_UP);
                      $arItem['MIN_PRICE']['VALUE'] = round($arItem['MIN_PRICE']['VALUE'],0,PHP_ROUND_HALF_UP);
                      if($key == 0){?>
                            <div class="best-price__buy-now best-price__buy-now--mobile-hidden"><a class="best-price__title" href="javascript:void(0)" data-action="add2basket" data-id="<?=$arItem['ID']?>">Купи сейчас</a>
                                <a class="best-price__name-product" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=htmlspecialchars_decode($arItem['NAME'])?></a>
                                <div class="best-price__cost"><?if($arItem['MIN_PRICE']['DISCOUNT_DIFF']>0){?><?=$arItem['MIN_PRICE']['DISCOUNT_VALUE']?><?}else{?><?=$arItem['MIN_PRICE']['VALUE']?><?}?>&nbsp;<span><?=CURRENCY;?></span></div>
                                <div class="best-price__button"><a class="button" href="javascript:void(0)" data-action="add2basket" data-id="<?=$arItem['ID']?>">В корзину</a></div>
                                <div class="best-price__img"><img src="<?=CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"],['width' => 388, 'height' => 425],BX_RESIZE_IMAGE_PROPORTIONAL)['src']?>"></div>
                                <div class="best-price__item-icons">
                                    <div class="best-price__item-select">
                                        <div class="best-price__item-icon best-price__item-icon--favourite"></div>
                                    </div>
                                    <div class="best-price__item-select">
                                        <div class="best-price__item-icon best-price__item-icon--comparison"></div>
                                    </div>
                                    <div class="best-price__item-select best-price__item-select--hidden">
                                        <div class="best-price__item-icon best-price__item-icon--add-cart"></div>
                                    </div>
                                </div>
                            </div>
                      <?}else{?>
                            <div class="best-price__item">
                                <div class="best-price__item-image-box"><img class="best-price__item-image" src="<?=CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"],['width' => 248, 'height' => 224],BX_RESIZE_IMAGE_PROPORTIONAL)['src']?>"></div>
                                <div class="best-price__item-icons">
                                    <div class="best-price__item-select">
                                        <div class="best-price__item-icon best-price__item-icon--favourite<?=$fav_act?>"  data-action="<?=$fav_action?>" data-id="<?=$arItem['ID']?>" data-add="FAVORITES"></div>
                                    </div>
                                    <div class="best-price__item-select">
                                        <div class="best-price__item-icon best-price__item-icon--comparison<?=$comp_act?>" data-action="<?=$comp_action?>" data-id="<?=$arItem['ID']?>" data-add="COMPARE"></div>
                                    </div>
                                </div>
                              <?if($arItem['MIN_PRICE']['DISCOUNT_DIFF']>0){?>
                                  <div class="best-price__item-discount-percent">-<?=$arItem['MIN_PRICE']['DISCOUNT_DIFF_PERCENT']?>%</div>
                              <?}?>
                                <div class="best-price__item-button"><a class="button button--red" href="javascript:void(0)" data-action="add2basket" data-id="<?=$arItem['ID']?>">В корзину</a></div>
                                <div class="best-price__item-container">
                                  <?if($arItem['MIN_PRICE']['DISCOUNT_DIFF']>0){?>
                                      <div class="best-price__item-discount"><?=$arItem['MIN_PRICE']['VALUE']?>&nbsp;<?=CURRENCY?></div>
                                      <div class="best-price__item-cost"><?=$arItem['MIN_PRICE']['DISCOUNT_VALUE']?> <span><?=CURRENCY?></span></div>
                                  <?}else{?>
                                      <div class="best-price__item-cost"><?=$arItem['MIN_PRICE']['VALUE']?> <span><?=CURRENCY?></span></div>
                                  <?}?>
                                </div><a class="best-price__item-name" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
                            </div>
                      <?}?>
                    <?}?>
                  <?unset($arItem)?>
                </div>
            </div>
          <?}?>
        </div>
    </div>
</section>
<?}?>