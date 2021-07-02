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
<section class="benefit benefit2">
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
								<div class="imp-item-txtblock">
									<div class="imp-item-header">
										<a class="imp-item-name" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
									</div>
						
									<div class="imp-item-price">
										<?if($arItem['MIN_PRICE']['DISCOUNT_DIFF']>0){?><?=$arItem['MIN_PRICE']['DISCOUNT_VALUE']?>
										<?}else{?>
										<?=$arItem['MIN_PRICE']['VALUE']?>
										<?}?>
										&nbsp;сом
									</div>
									
									<div class="imp-item-button">
										<div class="imp-item-button-quantity">
											<span data-id="<?=$arItem['ID']?>" data-action="minus" class="imp-item-quantity-minus">-</span>
											<span data-id="<?=$arItem['ID']?>" data-action="add" data-qnt="1" class="imp-item-quantity-value">1</span>
											<span data-id="<?=$arItem['ID']?>" data-action="plus" class="imp-item-quantity-plus">+</span>
										</div>
										<div data-action="<?=$fav_action?>" data-id="<?=$arItem['ID']?>" data-add="FAVORITES" class="buy-item__icon buy-item__icon--favorite<?=$fav_act?> imp-item-button-fcb imp-item-button-favorite"></div>
										<div data-action="<?=$comp_action?>" data-id="<?=$arItem['ID']?>" data-add="COMPARE" class="buy-item__icon buy-item__icon--comparison<?=$comp_act?> imp-item-button-fcb imp-item-button-compare"></div>
										<div data-action="add2basket" data-id="<?=$arItem['ID']?>" class="imp-item-button-fcb imp-item-button-tobasket"></div>
									</div>
								</div>
								
								<?if($arItem["PREVIEW_PICTURE"]){?>
								<div class="imp-item-imgblock">
                                    <div class="imp-item-img">
										<img class="imp-item-image-large" src="<?=CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"],['width' => 456, 'height' => 168],BX_RESIZE_IMAGE_PROPORTIONAL)['src']?>">
									</div>
								</div>
                                <?}?>	
                            </div>
                        <?}else{?>
                            <?if($counter>3){
                                $counter = 2;
                            }?>
                            <div class="buy-item buy-item--small-grid-<?=$counter?> buy-item--small-grid-23 element-item-desktop">
							
								<div class="imp-item-txtblock">
									<div class="imp-item-header">
										<a class="imp-item-name" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
									</div>
									
									<div class="imp-item-price">
										<?if($arItem['MIN_PRICE']['DISCOUNT_DIFF']>0){?><?=$arItem['MIN_PRICE']['DISCOUNT_VALUE']?>
										<?}else{?>
										<?=$arItem['MIN_PRICE']['VALUE']?>
										<?}?>
										&nbsp;сом
									</div>
									
									<div class="imp-item-button">
										<div class="imp-item-button-quantity">
											<span data-id="<?=$arItem['ID']?>" data-action="minus" class="imp-item-quantity-minus">-</span>
											<span data-id="<?=$arItem['ID']?>" data-action="add" data-qnt="1" class="imp-item-quantity-value">1</span>
											<span data-id="<?=$arItem['ID']?>" data-action="plus" class="imp-item-quantity-plus">+</span>
										</div>
									</div>
								</div>
								
								<div class="imp-item-imgblock">
									<div class="imp-item-button">
										<div data-action="add2basket" data-id="<?=$arItem['ID']?>" class="imp-item-button-fcb imp-item-button-tobasket"></div>
										<div data-action="<?=$comp_action?>" data-id="<?=$arItem['ID']?>" data-add="COMPARE" class="buy-item__icon buy-item__icon--comparison<?=$comp_act?> imp-item-button-fcb imp-item-button-compare"></div>
										<div data-action="<?=$fav_action?>" data-id="<?=$arItem['ID']?>" data-add="FAVORITES" class="buy-item__icon buy-item__icon--favorite<?=$fav_act?> imp-item-button-fcb imp-item-button-favorite"></div>
									</div>
									
									<?if($arItem["PREVIEW_PICTURE"]){?>
                                    <div class="imp-item-img">
										<img class="buy-item__image-small" src="<?=CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"],['width' => 125, 'height' => 102],BX_RESIZE_IMAGE_PROPORTIONAL)['src']?>">
									</div>
									<?}?>
								</div>
								
                            </div>
							
							
							<div class="best-price__item element-item-mobile">
								<div class="best-price__item-image-box">
									<img class="best-price__item-image" src="<?=CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"],['width' => 248, 'height' => 224],BX_RESIZE_IMAGE_PROPORTIONAL)['src']?>">
								</div>
								
								<div class="best-price__item-icons">
									<div class="best-price__item-select">
										<div class="imp-item-button-fcb imp-item-button-favorite"  data-action="<?=$fav_action?>" data-id="<?=$arItem['ID']?>" data-add="FAVORITES"></div>
									</div>
									<div class="best-price__item-select">
										<div class="imp-item-button-fcb imp-item-button-compare" data-action="<?=$comp_action?>" data-id="<?=$arItem['ID']?>" data-add="COMPARE"></div>
									</div>
									<div class="best-price__item-select">
										<div class="imp-item-button-fcb imp-item-button-tobasket" data-action="add2basket" data-id="<?=$arItem['ID']?>"></div>
									</div>
								</div>
								
								<div class="imp-item-price">
									<?=$arItem['MIN_PRICE']['VALUE']?> &nbsp;сом
								</div>
								
								<div class="imp-item-button">
									<div class="imp-item-button-quantity">
										<span data-id="<?=$arItem['ID']?>" data-action="minus" class="imp-item-quantity-minus">-</span>
										<span data-id="<?=$arItem['ID']?>" data-action="add" data-qnt="1" class="imp-item-quantity-value">1</span>
										<span data-id="<?=$arItem['ID']?>" data-action="plus" class="imp-item-quantity-plus">+</span>
									</div>
								</div>
								
								<div class="imp-item-name-bottom">
									<a class="imp-item-name" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
								</div>
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