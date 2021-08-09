<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);

$bxajaxid = CAjax::GetComponentID($component->__name, $component->__template->__name, false);
$showMoreText = $arResult['NAV_RESULT']->NavRecordCount - $arResult["NAV_RESULT"]->NavPageSize * $arResult["NAV_RESULT"]->NavPageNomer < $arParams['PAGE_ELEMENT_COUNT'] ? $arResult['NAV_RESULT']->NavRecordCount - $arResult["NAV_RESULT"]->NavPageSize * $arResult["NAV_RESULT"]->NavPageNomer : $arParams['PAGE_ELEMENT_COUNT'];
?>

<section class="section section--gray">
	<div class="layout">
		<div class="breadcrumb">
			<a class="breadcrumb__item" href="/">Главная</a>
			<svg class="breadcrumb__separator">
				<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#arrow"></use>
			</svg>
			<div class="breadcrumb__item breadcrumb__item--active">Избранное</div>
		</div>
		
		<div class="favorites">
			<?if( $arResult['MAIN_SECTIONS'] ){?>
			<div class="favorites__menu">
				<div class="favorites__menu-title">Категории</div>
				<div class="favorites__menu-items">
					<a class="favorites__menu-item <?if (empty($arParams['FAV_SECTION'])) { echo 'favorites__menu-item--active';} ?>" href="/favorites/">
						Все товары
					</a>
					<?foreach( $arResult['MAIN_SECTIONS'] as $sectionID => $sectionName ){ ?>
					<a href="/favorites/?section=<?=$sectionID;?>" class="favorites__menu-item <?if( $arParams['FAV_SECTION'] == $sectionID ){?>favorites__menu-item--active<?}?>">
						<?=$sectionName;?>
					</a>
					<?}?>
				</div>
			</div>
			<?}?>
			
			<div class="favorites__slider">
				<div class="favorites__slider-header">
					<div class="favorites__slider-header-title">Все товары (<?echo count($arResult['NEW_ITEMS']);?> шт.)</div>
					<div class="favorites__slider-header-button">
						<svg class="favorites__slider-header-button-icon">
							<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#close"></use>
						</svg>
						<a href="/favorites/?clear=yes" class="favorites__slider-header-button-text">Очистить список</a>
					</div>
				</div>
				
				<div class="favorites__grid">
					<div class="catalog-category__items-grid">
					
						<?foreach( $arResult['NEW_ITEMS'] as $key1=>$arItem ){?>
							<?
							if( $arItem['PREVIEW_PICTURE']['ID'] ){
								$preview_picture = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']["ID"],
									array("width" => 240, "height" => 208), BX_RESIZE_IMAGE_PROPORTIONAL)['src'];
							} else {
								$preview_picture = sprintf('%s/img/no-image.png', SITE_TEMPLATE_PATH);
							}
							?>
						<div class="catalog-category__items-grid-item">
							<div class="previews-slider__item product-cart preload__area">
								<div class="product-cart__block">
									<a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="product-cart__name"><?=$arItem['NAME']?></a>
									<div class="product-cart__reviews">
										<div class="rating">
											<div class="rating__stars">
												<svg class="rating__star">
													<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
												</svg>
												<svg class="rating__star">
													<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
												</svg>
												<svg class="rating__star">
													<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
												</svg>
												<svg class="rating__star">
													<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
												</svg>
												<svg class="rating__star">
													<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
												</svg>
											</div>
											<div class="rating__text">Нет отзывов</div>
										</div>
									</div>
									<img class="product-cart__img preload__item" src="<?=$preview_picture?>">
									<div class="product-cart__price">
										<div class="product-cart__price-number">
										<?
										if( $arItem['MIN_PRICE']['DISCOUNT_DIFF'] > 0 ){
											$arItem['MIN_PRICE']['VALUE'] = $arItem['MIN_PRICE']['DISCOUNT_VALUE'];
										}
										?>
										<?=$arItem['MIN_PRICE']['DISCOUNT_DIFF'] == 0 ? number_format($arItem['MIN_PRICE']['DISCOUNT_VALUE'],'0', ',', ' ') : number_format($arItem['MIN_PRICE']['VALUE'], '0', ',', ' ');?>
										</div>
										<div class="product-cart__price-currency">сом</div>
									</div>
									<div class="product-cart__code">Артикул: <?=$arItem['PROPERTIES']['ART_NUMBER']['VALUE']?></div>
									<div class="product-cart__counter" data-counter-max="<?=$arItem['PRODUCT']['QUANTITY']?>">
										<div class="product-cart__counter-button product-cart__counter-button--minus"></div>
										<div id="item_<?=$arItem['ID']?>_qnt" class="product-cart__counter-value">1</div>
										<div class="product-cart__counter-button product-cart__counter-button--plus"></div>
									</div>
									<div class="product-cart__buttons">
										<div onclick="catalogAction('COMPARE', <?=$arItem['ID']?>)" class="product-cart__button product-cart__button--compare" data-id="<?=$arItem['ID']?>" data-action="COMPARE">
											<svg class="product-cart__button-img product-cart__button-img--compare">
												<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#compare"></use>
											</svg>
										</div>
										<div onclick="catalogAction('FAVORITES', <?=$arItem['ID']?>)" class="product-cart__button product-cart__button--favorite" data-id="<?=$arItem['ID']?>" data-action="FAVORITES">
											<svg class="product-cart__button-img product-cart__button-img--favorite">
												<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#favorite"></use>
											</svg>
										</div>
										<div onclick="catalogAction('add2basket', <?=$arItem['ID']?>)" class="product-cart__button product-cart__button--basket" data-id="<?=$arItem['ID']?>" data-action="add2basket">
											<svg class="product-cart__button-img product-cart__button-img--basket">
												<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#basket"></use>
											</svg>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?}?>
						
					</div>
					
					<?if( count($arResult['NEW_ITEMS'])>16 ){?>
					<div id="btn_<?=$bxajaxid?>" class="catalog-category__items-footer">
						<?if( $arResult["NAV_RESULT"]->nEndPage > 1 && $arResult["NAV_RESULT"]->NavPageNomer < $arResult["NAV_RESULT"]->nEndPage ):?>
						<div class="catalog-category__items-footer-more">
							<a class="button" 
								data-ajax-id="<?=$bxajaxid?>" href="javascript:void(0)"
								data-show-more-catalog="<?=$arResult["NAV_RESULT"]->NavNum ?>"
								data-next-page="<?=($arResult["NAV_RESULT"]->NavPageNomer + 1) ?>"
								data-max-page="<?=$arResult["NAV_RESULT"]->nEndPage?>" 
								onclick="dataShowMore()" 
								id="catalogSectionShowMore" 
							>Показать еще <?=$showMoreText?></a>
						</div>
						<?endif;?>
						
						<div class="catalog-category__items-footer-pagination">
							<?=$arResult["NAV_STRING"]?>
						</div>
					</div>
					<?}?>
					
				</div>
			</div>
		</div>
	</div>
</section>
