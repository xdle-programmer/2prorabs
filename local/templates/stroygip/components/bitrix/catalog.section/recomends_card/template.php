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


$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
$elementDeleteParams = array('CONFIRM' => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));
if ($arResult['ITEMS']) {
    ?>
	<div class="layout">
	    <div class="title">
            <div class="title__text"><?=$arParams['TITLE']?></div>
        </div>
		<div class="previews-slider previews-slider--self-initial">
			<div class="previews-slider__nav">
				<div class="previews-slider__nav-button previews-slider__nav-button--prev">
					<svg class="previews-slider__nav-button-icon">
						<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#arrow"></use>
					</svg>
				</div>
				<div class="previews-slider__nav-button previews-slider__nav-button--next">
					<svg class="previews-slider__nav-button-icon">
						<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#arrow"></use>
					</svg>
				</div>
            </div>
			<div class="previews-slider__wrapper">
            <? foreach ($arResult['ITEMS'] as $arItem) {
                if ($arItem['PREVIEW_PICTURE']['ID']) {
                    $preview_picture = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']["ID"],
                        array("width" => 240, "height" => 208), BX_RESIZE_IMAGE_PROPORTIONAL)['src'];
                } else {
                    $preview_picture = sprintf('%s/img/no-image.png', SITE_TEMPLATE_PATH);
                }
                ?>
				
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
						<img class="product-cart__img preload__item" src="<?=$preview_picture?>">
						<div class="product-cart__price">
							<div class="product-cart__price-number">
							<?=$arItem['MIN_PRICE']['DISCOUNT_DIFF'] == 0 ? number_format($arItem['MIN_PRICE']['VALUE'], '0', ',', ' ') : number_format($arItem['MIN_PRICE']['DISCOUNT_VALUE'], '0', ',', ' ')?>
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
							<div onclick="catalogAction('add2basket', <?=$arItem['ID']?>)" class="product-cart__button product-cart__button--basket<?if( array_key_exists($arItem['ID'], $_SESSION['BASKET_PRODUCTS']) ):?> product-cart__button--active<?endif;?>" data-id="<?=$arItem['ID']?>" data-action="add2basket">
								<svg class="product-cart__button-img product-cart__button-img--basket">
									<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#basket"></use>
								</svg>
							</div>
						</div>
					</div>
				</div>
            <? } ?>
			</div>
		</div>
	</div>
<? } ?>
