<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 */

$this->setFrameMode(true);

$bxajaxid = CAjax::GetComponentID($component->__name, $component->__template->__name, false);
$showMoreText = $arResult['NAV_RESULT']->NavRecordCount - $arResult["NAV_RESULT"]->NavPageSize * $arResult["NAV_RESULT"]->NavPageNomer < $arParams['PAGE_ELEMENT_COUNT'] ? $arResult['NAV_RESULT']->NavRecordCount - $arResult["NAV_RESULT"]->NavPageSize * $arResult["NAV_RESULT"]->NavPageNomer : $arParams['PAGE_ELEMENT_COUNT'];
?>

<? if ($arResult['ITEMS']) { ?>
<div class="catalog-category__items-grid">
	<? foreach ($arResult['ITEMS'] as $key=>$arItem) {?>
	<div class="catalog-category__items-grid-item">
		<div class="previews-slider__item product-cart preload__area">
			<div class="product-cart__block">
				<a class="product-cart__name" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
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
				<?
				if ($arItem['PREVIEW_PICTURE']['ID']) {
                    $preview_picture = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']["ID"],
                        array("width" => 400, "height" => 400), BX_RESIZE_IMAGE_PROPORTIONAL)['src'];
                } else {
                    $preview_picture = "/local/templates/stroygip/img/no-image.png";
                }
				?>
				<img class="product-cart__img preload__item" src="<?=$preview_picture?>">
				<div class="product-cart__price">
					<div class="product-cart__price-number">
						<?
						if ($arItem['MIN_PRICE']['DISCOUNT_DIFF'] > 0): 
						$arItem['MIN_PRICE']['VALUE'] = $arItem['MIN_PRICE']['DISCOUNT_VALUE']; 
						endif;
						?>
						<?= $arItem['MIN_PRICE']['DISCOUNT_DIFF'] == 0 ? number_format($arItem['MIN_PRICE']['DISCOUNT_VALUE'], '0', ',', ' ') : number_format($arItem['MIN_PRICE']['VALUE'], '0', ',', ' ') ?>
					</div>
					<div class="product-cart__price-currency">сом</div>
				</div>
				<div class="product-cart__code">Артикул: <?=$arItem['PROPERTIES']['ART_NUMBER']['VALUE']?></div>
				<div class="product-cart__counter" data-counter-max="<?=$arItem["PRODUCT"]["QUANTITY"]?>">
					<div class="product-cart__counter-button product-cart__counter-button--minus"></div>
					<div id="item_<?=$arItem['ID']?>_qnt" class="product-cart__counter-value">1</div>
					<div class="product-cart__counter-button product-cart__counter-button--plus"></div>
				</div>
				<div class="product-cart__buttons">
					<div onclick="catalogAction('COMPARE', <?=$arItem['ID']?>)" class="product-cart__button product-cart__button--compare<?if( in_array($arItem['ID'], $_SESSION['COMPARE']) ):?> product-cart__button--active<?endif;?>" data-id="<?=$arItem['ID']?>" data-action="COMPARE">
						<svg class="product-cart__button-img product-cart__button-img--compare">
							<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#compare"></use>
						</svg>
					</div>
					<div onclick="catalogAction('FAVORITES', <?=$arItem['ID']?>)" class="product-cart__button product-cart__button--favorite<?if( in_array($arItem['ID'], $_SESSION['FAVORITES']) ):?> product-cart__button--active<?endif;?>" data-id="<?=$arItem['ID']?>" data-action="FAVORITES">
						<svg class="product-cart__button-img product-cart__button-img--favorite">
							<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#favorite"></use>
						</svg>
					</div>
					<div onclick="catalogAction('add2basket', <?=$arItem['ID']?>)" class="product-cart__button product-cart__button--basket<?if( in_array($arItem['ID'], $_SESSION['BASKET_LIST']) ):?> product-cart__button--active<?endif;?>" data-id="<?=$arItem['ID']?>" data-action="add2basket">
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


<div id="btn_<?= $bxajaxid ?>" class="catalog-category__items-footer">
	<?if ($arResult["NAV_RESULT"]->nEndPage > 1 && $arResult["NAV_RESULT"]->NavPageNomer < $arResult["NAV_RESULT"]->nEndPage):?>
	<div class="catalog-category__items-footer-more">
		<a class="button" 
			data-ajax-id="<?=$bxajaxid?>" href="javascript:void(0)"
			data-show-more-catalog="<?= $arResult["NAV_RESULT"]->NavNum ?>"
			data-next-page="<?= ($arResult["NAV_RESULT"]->NavPageNomer + 1) ?>"
			data-max-page="<?= $arResult["NAV_RESULT"]->nEndPage ?>" 
			onclick="dataShowMore()" 
			id="catalogSectionShowMore" 
		>Показать еще <?= $showMoreText ?></a>
	</div>
	<?endif;?>
	
	<div class="catalog-category__items-footer-pagination">
		<?=$arResult["NAV_STRING"]?>
	</div>
</div>
<? } else { ?>
	<div class="catalog-category__title">Данный раздел пуст</div>
<? } ?>

