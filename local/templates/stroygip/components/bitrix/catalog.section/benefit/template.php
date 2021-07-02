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
<section class="benefit">
    <div class="container">
        <div class="title">Выгодные предложения</div>
        <div class="benefit__carousel owl-carousel owl-theme">
            <?foreach (array_chunk($arResult["ITEMS"],5) as $arBlock){?>
                <div class="buy-item__grid-benefit">
                    <?$counter = 2?>
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
                        if($key ==0){?>
                            <div class="buy-item buy-item--grid-1 xxx">
                                <div class="buy-item__header">
									<a class="buy-item__name" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
                                </div>
                                <div class="buy-item__inner">
                                    <div class="buy-item__box">
                                        <div class="buy-item__series"><?=$arItem['PROPERTIES']['MODEL']['VALUE']?></div>
                                        <div class="buy-item__rating">
                                            <?
                                            for ($i = 1; $i <= 5; $i++) {?>
                                                <div class="buy-item__star <?if($i<=$arItem['PROPERTIES']['RATING']['VALUE']){?>active<?}?>"></div>
                                            <?}
                                            ?>
                                        </div>
										
										<div class="buy-item__cost1">
											<?if($arItem['MIN_PRICE']['DISCOUNT_DIFF']>0){?><?=$arItem['MIN_PRICE']['DISCOUNT_VALUE']?>
											<?}else{?>
											<?=$arItem['MIN_PRICE']['VALUE']?>
											<?}?>
											
											&nbsp;<span><?= CURRENCY;?></span> 
											<!--<img class="buy-item__cost-img" src="<?/*=SITE_TEMPLATE_PATH*/?>/assets/src/images/icons/combined-shape.svg"></img>-->
										</div>
										
                                        <div class="buy-item__button"><a class="button button--red" href="javascript:void(0)" data-action="add2basket" data-id="<?=$arItem['ID']?>">В корзину</a></div>
                                    </div>
									
								
                                    <div class="buy-item__icons">
                                        <div class="buy-item__icon-item">
                                            <div class="buy-item__icon buy-item__icon--favorite<?=$fav_act?>" data-action="<?=$fav_action?>" data-id="<?=$arItem['ID']?>" data-add="FAVORITES"></div>
                                        </div>
                                        <div class="buy-item__icon-item">
                                            <div class="buy-item__icon buy-item__icon--comparison<?=$comp_act?>" data-action="<?=$comp_action?>" data-id="<?=$arItem['ID']?>" data-add="COMPARE"></div>
                                        </div>
                                        <div class="buy-item__icon-item buy-item__icon-item--hidden">
                                            <div class="buy-item__icon buy-item__icon--add-cart" data-action="add2basket" data-id="<?=$arItem['ID']?>"></div>
                                        </div>
                                    </div>
                                </div>
                                <?if($arItem["PREVIEW_PICTURE"]){?>
                                    <div class="buy-item__img"><img class="buy-item__image-large" src="<?=CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"],['width' => 456, 'height' => 168],BX_RESIZE_IMAGE_PROPORTIONAL)['src']?>"></div>
                                <?}?>
							
                            </div>
                        <?}else{?>
                            <?if($counter>3){
                                $counter = 2;
                            }?>
                            <div class="buy-item buy-item--small-grid-<?=$counter?>">
                                <div class="buy-item__header"><a class="buy-item__name" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
                                    <div class="buy-item__cost">
										<?if($arItem['MIN_PRICE']['DISCOUNT_DIFF']>0){?><?=$arItem['MIN_PRICE']['DISCOUNT_VALUE']?>
										<?}else{?>
										<?=$arItem['MIN_PRICE']['VALUE']?>
										<?}?>&nbsp;
										<span><?=CURRENCY;?></span>
										<!--<img class="buy-item__cost-img" src="<?/*=SITE_TEMPLATE_PATH*/?>/assets/src/images/icons/combined-shape.svg"></img>--></div>
                                </div>
                                <div class="buy-item__inner">
                                    <div class="buy-item__box">
                                        <div class="buy-item__series"><?=$arItem['PROPERTIES']['MODEL']['VALUE']?></div>
                                        <div class="buy-item__rating buy-item__rating--hidden">
                                            <?
                                            for ($i = 1; $i <= 5; $i++) {?>
                                                <div class="buy-item__star <?if($i<=$arItem['PROPERTIES']['RATING']['VALUE']){?>active<?}?>"></div>
                                            <?}
                                            ?>
                                        </div>
                                        <div class="buy-item__button buy-item__button--position">
                                            <a class="button button--red button--red-small" href="javascript:void(0)" data-action="add2basket" data-id="<?=$arItem['ID']?>">В корзину</a>
                                        </div>
                                    </div>
                                    <div class="buy-item__icons">
                                        <div class="buy-item__icon-item">
                                            <div class="buy-item__icon buy-item__icon--favorite<?=$fav_act?>" data-action="<?=$fav_action?>" data-id="<?=$arItem['ID']?>" data-add="FAVORITES"></div>
                                        </div>
                                        <div class="buy-item__icon-item">
                                            <div class="buy-item__icon buy-item__icon--comparison<?=$comp_act?>" data-action="<?=$comp_action?>" data-id="<?=$arItem['ID']?>" data-add="COMPARE"></div>
                                        </div>
                                        <div class="buy-item__icon-item buy-item__icon-item--hidden">
                                            <div class="buy-item__icon buy-item__icon--add-cart" data-action="add2basket" data-id="<?=$arItem['ID']?>"></div>
                                        </div>
                                    </div>
                                </div>
                                <?if($arItem["PREVIEW_PICTURE"]){?>
                                    <div class="buy-item__img buy-item__img--position"><img class="buy-item__image-small" src="<?=CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"],['width' => 125, 'height' => 102],BX_RESIZE_IMAGE_PROPORTIONAL)['src']?>"></div>
                                <?}?>
                            </div>
                            <?$counter++?>
                        <?}?>
                    <?}?>
                    <?unset($arItem)?>
                </div>
            <?}?>
        </div>
    </div>
</section>
<?}?>