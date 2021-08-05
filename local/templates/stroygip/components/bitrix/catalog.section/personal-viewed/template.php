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

\nav\Catalog\Sort::setFromRequest();
$currentSort = \nav\Catalog\Sort::getCurrent();
$sortItems = \nav\Catalog\Sort::getTemplateData();

\nav\Catalog\PageSize::setFromRequest();
$currentPageSize = \nav\Catalog\PageSize::getCurrent();
$pageSizeItems = \nav\Catalog\PageSize::getTemplateData();
?>

<section class="section section--gray">
    <div class="layout">
		<div class="breadcrumb">
			<a class="breadcrumb__item" href="/">Главная</a>
			<svg class="breadcrumb__separator">
				<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#arrow"></use>
			</svg>
			<a class="breadcrumb__item" href="/personal/credentials/">Профиль</a>
			<svg class="breadcrumb__separator">
				<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#arrow"></use>
			</svg>
			<div class="breadcrumb__item breadcrumb__item--active">Просмотренные товары</div>
		</div>
		<div class="account">
			<div class="account__header">
				<div class="account__header-nav">
					<div class="account__header-nav-button account__header-nav-button--prev">
						<svg class="account__header-nav-button-icon">
							<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#arrow"></use>
						</svg>
					</div>
					<div class="account__header-nav-button account__header-nav-button--next">
						<svg class="account__header-nav-button-icon">
							<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#arrow"></use>
						</svg>
					</div>
				</div>
				<div class="account__header-buttons">
					<a href="/personal/credentials/" class="account__header-button">
						<div class="account__header-button-inner">
							<svg class="account__header-button-icon">
								<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#user"></use>
							</svg>
							<div class="account__header-button-text">Личные данные</div>
						</div>
					</a>
					<a href="/personal/orders/" class="account__header-button">
						<div class="account__header-button-inner">
							<svg class="account__header-button-icon">
								<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#order"></use>
							</svg>
							<div class="account__header-button-text">Мои заказы</div>
						</div>
					</a>
					<a href="/personal/viewed/" class="account__header-button account__header-button--active">
						<div class="account__header-button-inner">
							<svg class="account__header-button-icon">
								<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#eye"></use>
							</svg>
							<div class="account__header-button-text">Просмотренные товары</div>
						</div>
					</a>
					<a href="/personal/estimates/" class="account__header-button">
						<div class="account__header-button-inner">
							<svg class="account__header-button-icon">
								<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#outlay"></use>
							</svg>
							<div class="account__header-button-text">Сметы</div>
						</div>
					</a>
				</div>
			</div>
			
<? if ($arResult['ITEMS']) { ?>
			<div class="account__block">
				<div class="catalog-category__items">
				
					<div class="catalog-category__items-header">
						<div class="catalog-category__items-header-title">Просмотренные товары</div>
						<div class="catalog-category__items-header-filter">
							<svg class="catalog-category__items-header-filter-icon">
								<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#settings"></use>
							</svg>
						</div>
						<div class="catalog-category__items-header-options">
							<form class="catalog-category__select-form" action="#">
								<div class="catalog-category__items-header-options-item">
									<select onchange="catalogSort()" id="catalog-sort-select" class="custom-select" name="sort">
										<option selected disabled hidden>Сортировка</option>
										<? foreach ($sortItems as $item): ?>
										<option value="<?=$item['CODE']?>" <?if ($item['ACTIVE'] === 'Y'):?>selected="selected"<?endif;?>><?=$item['NAME']?></option>
										<? endforeach; ?>
									</select>
								</div>
								<div class="catalog-category__items-header-options-item">
									<select onchange="catalogPageSize()" id="catalog-pagesize-select" class="custom-select" name="pageSize">
										<? foreach ($pageSizeItems as $item): ?>
										<option value="<?=$item['CODE']?>" <? if ($item['ACTIVE'] === 'Y'): ?>selected="selected"<? endif; ?>>Показать по <?=$item['NAME']?></option>
										<? endforeach; ?>
									</select>
								</div>
							</form>					
						</div>
					</div>
					

					<div class="catalog-category__items-grid catalog-category__items-grid--big">
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
					<div onclick="catalogAction('add2basket', <?=$arItem['ID']?>)" class="product-cart__button product-cart__button--basket<?if( array_key_exists($arItem['ID'], $_SESSION['BASKET_PRODUCTS']) ):?> product-cart__button--active<?endif;?>" data-id="<?=$arItem['ID']?>" data-action="add2basket">
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

<?/*
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
*/?>

					
				</div>
			</div>
			
<? } else { ?>
	<div class="catalog-category__title">Данный раздел пуст</div>
<? } ?>

		</div>
	</div>
</section>

