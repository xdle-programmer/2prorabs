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

<?
  $arClasses = ['buy-item--grid-1','buy-item--grid-col-4-6-row-1-3','buy-item--grid-col-6-8','buy-item--grid-col-6-8','buy-item--grid-col-1-3-row-2-4','buy-item--grid-col-4-6','buy-item--grid-col-4-6'];
  $ratingParams = [false,false,true,true,false,true,true];
  $pictureSizes = [['width' => 455, 'height' => 216],['width' => 216, 'height' => 240],['width' => 141, 'height' => 112],['width' => 141, 'height' => 112],['width' => 216, 'height' => 240],['width' => 141, 'height' => 112],['width' => 141, 'height' => 112]];
?>
<?if($arResult['ITEMS']){?>
<section class="bestsellers">
    <div class="container">
        <div class="title-box">
            <div class="title-box__title">Сезонные товары</div>
            <div class="title-box__notification"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/src/images/icons/fire.svg">TOP</div>
        </div>
        <div class="bestsellers__carousel owl-carousel"></div>
        <div class="best-price__grid-bestprice">
            <?foreach ($arResult["ITEMS"] as $key => &$arItem){
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
              if($key != 7){?>
            <div class="buy-item <?= $arClasses[$key] ?>">
                <div class="buy-item__header">
					<a class="buy-item__name" href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= $arItem['NAME'] ?></a>
                </div>
                <div class="buy-item__inner">
                    <div class="buy-item__box">
                        <div class="buy-item__series"><?= $arItem['PROPERTIES']['MODEL']['VALUE'] ?></div>
                        <div class="buy-item__rating <?if($ratingParams[$key]){?>buy-item__rating--hidden<?}?>">
                            <?
                                  for ($i = 1; $i <= 5; $i++) {?>
                            <div class="buy-item__star <?if($i<=$arItem['PROPERTIES']['RATING']['VALUE']){?>active<?}?>"></div>
                            <?}
                                ?>
                        </div>
						
						<div class="<?if( $key == "0" ):?>buy-item__cost1<?else:?>buy-item__cost<?endif;?>">
							<?if($arItem['MIN_PRICE']['DISCOUNT_DIFF']>0){?><?= $arItem['MIN_PRICE']['DISCOUNT_VALUE'] ?>
							<?}else{?><?= $arItem['MIN_PRICE']['VALUE'] ?>
							<?}?>&nbsp;<span><?= CURRENCY; ?></span>
							<!--<img class="buy-item__cost-img" src="<?/*=SITE_TEMPLATE_PATH*/?>/assets/src/images/icons/combined-shape.svg"></img>-->
						</div>
					
                        <div class="buy-item__button"><a class="button button--red" href="javascript:void(0)" data-action="add2basket" data-id="<?= $arItem['ID'] ?>">В корзину</a></div>
                    </div>
                    <div class="buy-item__icons">
                        <div class="buy-item__icon-item">
                            <div class="buy-item__icon buy-item__icon--favorite<?= $fav_act ?>" data-action="<?= $fav_action ?>" data-id="<?= $arItem['ID'] ?>" data-add="FAVORITES"></div>
                        </div>
                        <div class="buy-item__icon-item">
                            <div class="buy-item__icon buy-item__icon--comparison<?= $comp_act ?>" data-action="<?= $comp_action ?>" data-id="<?= $arItem['ID'] ?>" data-add="COMPARE"></div>
                        </div>
                    </div>
                </div>
                <div class="buy-item__img"><img src="<?= CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], $pictureSizes[$key], BX_RESIZE_IMAGE_PROPORTIONAL)['src'] ?>"></div>
            </div>
            <?}else{?>
            <div class="bestsellers-item bestsellers-item--grid-6-8-row-3-5">
                <div class="bestsellers-item__header">
					<a class="bestsellers-item__name" href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= $arItem['NAME'] ?></a>
                </div>
                <div class="bestsellers-item__icons">
                    <div class="bestsellers-item__icon-item">
                        <div class="bestsellers-item__icon bestsellers-item__icon--favorite"></div>
                    </div>
                    <div class="bestsellers-item__icon-item">
                        <div class="bestsellers-item__icon bestsellers-item__icon--comparison"></div>
                    </div>
                </div>
                <div class="bestsellers-item__characteristics"><?= $arItem['PROPERTIES']['MODEL']['VALUE'] ?></div>
                <div class="bestsellers-item__rating">
                    <?
                              for ($i = 1; $i <= 5; $i++) {?>
                    <div class="bestsellers-item__star <?if($i<=$arItem['PROPERTIES']['RATING']['VALUE']){?>active<?}?>"></div>
                    <?}
                            ?>
                </div>
				
				<div class="bestsellers-item__cost">
					<?if($arItem['MIN_PRICE']['DISCOUNT_DIFF']>0){?><?= $arItem['MIN_PRICE']['DISCOUNT_VALUE'] ?>
					<?}else{?><?= $arItem['MIN_PRICE']['VALUE'] ?>
					<?}?>&nbsp;<span><?= CURRENCY; ?></span>
					<!--<img src="<?/*=SITE_TEMPLATE_PATH*/?>/assets/src/images/icons/combined-shape.svg"></img>-->
				</div>
					
                <div class="bestsellers-item__button"><a class="button" href="#">В корзину</a></div>
                <div class="bestsellers-item__decor"></div>
                <div class="bestsellers-item__img-box"><img class="bestsellers-item__image" src="<?= CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], ['width' => 420, 'height' => 339], BX_RESIZE_IMAGE_PROPORTIONAL)['src'] ?>"></div>
            </div>
            <?}
                if($key>7){
                  continue;
                }
            }?>
            <?unset($arItem)?>
        </div>
        <!-- кнопка  "Ещё", на случай если нужна будет подгрузка большего количество блоков -->
        <!-- <div class="more-bestprice">
            <button>Ещё</button>
        </div> -->
    </div>
</section>
<?}?>