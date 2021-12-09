<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$this->setFrameMode(true);?>

<div class="main-banner__search-mobile" data-search-hints-open="banner-search">
	<svg class="main-banner__search-mobile-icon">
		<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#search"></use>
	</svg>
	<div class="main-banner__search-mobile-text">Поиск товара</div>
</div>
<div class="search-hints search-hints--banner" id="banner-search">
	<div class="search-hints__wrapper">
		<div class="search-hints__input-row">
			<div class="search-hints__close-button" data-search-hints-close>
				<svg class="search-hints__close-button-icon">
					<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#close"></use>
				</svg>
			</div>
			<div class="search-hints__input-block">
				<input class="search-hints__input input input--search" placeholder="Поиск товара">
			</div>
			<div class="search-hints__input-button">
				<svg class="search-hints__input-button-icon">
					<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#search"></use>
				</svg>
			</div>
		</div>
		<div class="search-hints__hints-wrapper">
			<template data-search-hints-products-item>
				<div class="search-hints__product">
					<div class="search-hints__product-img-wrapper"><img class="search-hints__product-img" src=""></div>
					<div class="search-hints__product-desc"><a class="search-hints__product-desc-name"></a>
						<div class="search-hints__product-desc-control">
							<div class="search-hints__product-desc-control-price">
								<div class="search-hints__product-desc-control-price-number"></div>
								<div class="search-hints__product-desc-control-price-currency">сом</div>
							</div>
							<div class="search-hints__product-desc-control-buy">
								<svg class="search-hints__product-desc-control-buy-icon">
									<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#basket"></use>
								</svg>
							</div>
						</div>
					</div>
				</div>
			</template>
			<template data-search-hints-history-item>
				<div class="search-hints__hints-results-row search-hints__hints-results-row--delete"><a class="search-hints__hints-results-row-link"></a>
				  <div class="search-hints__hints-results-row-del">
					<svg class="search-hints__hints-results-row-del-icon">
					  <use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#close"></use>
					</svg>
				  </div>
				</div>
			</template>
			<template data-search-hints-popular-item>
				<div class="search-hints__hints-results-row"><a class="search-hints__hints-results-row-link"></a></div>
			</template>
			<template data-search-hints-category-item>
				<div class="search-hints__hints-results-row"><a class="search-hints__hints-results-row-link"></a></div>
			</template>
			<div class="search-hints__hints-block">
				<div class="search-hints__hints-results">
					<div class="search-hints__hints-results-item">
						<div class="search-hints__hints-results-item-title">История запросов</div>
						<div class="search-hints__hints-results-item-list" data-search-hints-history></div>
					</div>
					<div class="search-hints__hints-results-item">
						<div class="search-hints__hints-results-item-title">Частые запросы</div>
						<div class="search-hints__hints-results-item-list" data-search-hints-popular></div>
					</div>
					<div class="search-hints__hints-results-item">
						<div class="search-hints__hints-results-item-title">Категории</div>
						<div class="search-hints__hints-results-item-list" data-search-hints-category></div>
					</div>
				</div>
				<div class="search-hints__products">
					<div class="search-hints__products-title">Товары</div>
					<div class="search-hints__products-list" data-search-hints-products></div>
				</div>
			</div>
		</div>
	</div>
</div>
