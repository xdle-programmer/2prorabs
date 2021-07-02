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
<div class="section">
	<div class="layout">
		<div class="title">
			<div class="title__text">Выгодное предложение месяца</div>
			<div class="title__desc">Товар ограничен!</div>
		</div>
	
		<div class="previews-slider">
			<div class="previews-slider__nav">
				<div class="previews-slider__nav-button previews-slider__nav-button--prev">
					<svg class="previews-slider__nav-button-icon">
						<use xlink:href="<?=SITE_TEMPLATE_PATH?>/ts/images/icons/icons-sprite.svg#arrow"></use>
					</svg>
				</div>
				<div class="previews-slider__nav-button previews-slider__nav-button--next">
					<svg class="previews-slider__nav-button-icon">
						<use xlink:href="<?=SITE_TEMPLATE_PATH?>/ts/images/icons/icons-sprite.svg#arrow"></use>
					</svg>
				</div>
			</div>
			
			<div class="previews-slider__wrapper">
			<?foreach ($arResult["ITEMS"] as $key=>$arElement){?>
				<?
				$arElement['MIN_PRICE']['DISCOUNT_VALUE'] = round($arElement['MIN_PRICE']['DISCOUNT_VALUE'],0,PHP_ROUND_HALF_UP);
				$arElement['MIN_PRICE']['VALUE'] = round($arElement['MIN_PRICE']['VALUE'],0,PHP_ROUND_HALF_UP);
				
				if (in_array($arElement['ID'], $arParams['FAVORITES'])) {
					$fav_action = 'compfavdelete';
					$fav_act = ' compfavactive';
				} else {
					$fav_action = 'compfav';
					$fav_act = '';
				}
				if (in_array($arElement['ID'], $arParams['COMPARE'])) {
					$comp_action = 'compfavdelete';
					$comp_act = ' compfavactive';
				} else {
					$comp_action = 'compfav';
					$comp_act = '';
				}
				?>
				<div class="previews-slider__item product-cart preload__area">
					<div class="product-cart__block">
						<div class="product-cart__name">
							<a href="<?=$arElement["DETAIL_PAGE_URL"]?>">
								<?=$arElement["NAME"]?>
							</a>
						</div>
						<div class="product-cart__reviews">
							<div class="rating">
								<div class="rating__stars">
									<svg class="rating__star">
										<use xlink:href="<?=SITE_TEMPLATE_PATH?>/ts/images/icons/icons-sprite.svg#star"></use>
									</svg>
									<svg class="rating__star">
										<use xlink:href="<?=SITE_TEMPLATE_PATH?>/ts/images/icons/icons-sprite.svg#star"></use>
									</svg>
									<svg class="rating__star">
										<use xlink:href="<?=SITE_TEMPLATE_PATH?>/ts/images/icons/icons-sprite.svg#star"></use>
									</svg>
									<svg class="rating__star">
										<use xlink:href="<?=SITE_TEMPLATE_PATH?>/ts/images/icons/icons-sprite.svg#star"></use>
									</svg>
									<svg class="rating__star">
										<use xlink:href="<?=SITE_TEMPLATE_PATH?>/ts/images/icons/icons-sprite.svg#star"></use>
									</svg>
								</div>
								<div class="rating__text">Нет отзывов</div>
							</div>
						</div>
						<img class="product-cart__img preload__item" data-src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>">
						<div class="product-cart__price">
							<div class="product-cart__price-number"><?echo number_format($arElement['MIN_PRICE']['VALUE'], 0, '.', ' ');?></div>
							<div class="product-cart__price-currency">сом</div>
						</div>
						<div class="product-cart__code">Артикул: <?=$arElement['PROPERTIES']['ART_NUMBER']['VALUE']?></div>
						<div class="product-cart__counter">
							<div class="product-cart__counter-button product-cart__counter-button--minus"></div>
							<div class="product-cart__counter-value imp-item-quantity-value" data-id="<?=$arElement['ID']?>" data-action="add">1</div>
							<div class="product-cart__counter-button product-cart__counter-button--plus"></div>
						</div>
						<div class="product-cart__buttons">
							<div class="product-cart__button" data-action="<?=$comp_action?>" data-id="<?=$arElement['ID']?>" data-add="COMPARE">
								<svg class="product-cart__button-img product-cart__button-img--compare">
									<use xlink:href="<?=SITE_TEMPLATE_PATH?>/ts/images/icons/icons-sprite.svg#compare"></use>
								</svg>
							</div>
							<div class="product-cart__button" data-action="<?=$fav_action?>" data-id="<?=$arElement['ID']?>" data-add="FAVORITES">
								<svg class="product-cart__button-img product-cart__button-img--favorite">
									<use xlink:href="<?=SITE_TEMPLATE_PATH?>/ts/images/icons/icons-sprite.svg#favorite"></use>
								</svg>
							</div>
							<div class="product-cart__button product-cart__button--basket" data-action="add2basket" data-id="<?=$arElement['ID']?>">
								<svg class="product-cart__button-img product-cart__button-img--basket">
									<use xlink:href="<?=SITE_TEMPLATE_PATH?>/ts/images/icons/icons-sprite.svg#basket"></use>
								</svg>
							</div>
						</div>
					</div>
				</div>
				
			<?}?>
			</div>
		</div>
	</div>
</div>
<?}?>
