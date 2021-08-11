<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

$isAjax = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $isAjax = (
        (isset($_POST['ajax_action']) && $_POST['ajax_action'] == 'Y')
        || (isset($_POST['compare_result_reload']) && $_POST['compare_result_reload'] == 'Y')
    );
}

$templateData = array(
    'TEMPLATE_THEME' => $this->GetFolder() . '/themes/' . $arParams['TEMPLATE_THEME'] . '/style.css',
    'TEMPLATE_CLASS' => 'bx_' . $arParams['TEMPLATE_THEME']
);

?>

<section class="section section--gray">
	<div class="layout">
		<div class="breadcrumb">
			<a class="breadcrumb__item" href="/">Главная</a>
			<svg class="breadcrumb__separator">
				<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#arrow"></use>
			</svg>
			<div class="breadcrumb__item breadcrumb__item--active">Сравнение товаров</div>
		</div>
		
		<?if( is_array($arResult['ITEMS']) && count($arResult['ITEMS'])>0 ){?>
		<div class="compare">
			<?if( $arResult['SECTIONS'] ){?>
			<div class="compare__menu">
				<div class="compare__menu-title">Категории</div>
				<div class="compare__menu-items">
				
					<?foreach( $arResult['SECTIONS'] as $key1=>$arSection ){?>	
						<?if( $arSection['ACTIVE'] == 'Y' ){?>
							<div class="compare__menu-item compare__menu-item--active">
								<?=$arSection['NAME']?>
							</div>
						<?}else{?>
							<a href="<?=$arSection['LINK']?>" class="compare__menu-item">
								<?=$arSection['NAME']?>
							</a>
						<?}?>
					<?}?>
					
				</div>
			</div>
			<?}?>
			
			<div class="compare__slider">
				<div class="compare__slider-header">
					<div class="compare__slider-header-title">Все товары (<?echo count($arResult['ITEM_IDS']);?> шт.)</div>
					<div class="compare__slider-header-button" onclick="clearCompare('<?=implode('/', $arResult['ITEM_IDS'])?>')">
						<svg class="compare__slider-header-button-icon">
							<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#close"></use>
						</svg>
						<div class="compare__slider-header-button-text">Очистить список</div>
					</div>
				</div>
				<div class="compare__slider-nav">
					<div class="compare__slider-nav-button compare__slider-nav-button--prev">
						<svg class="compare__slider-nav-button-icon">
							<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#arrow"></use>
						</svg>
					</div>
					<div class="compare__slider-nav-button compare__slider-nav-button--next">
						<svg class="compare__slider-nav-button-icon">
							<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#arrow"></use>
						</svg>
					</div>
				</div>
				
				<div class="compare__slider-items-wrapper">
					<div class="compare__slider-items">
						
						<?foreach( $arResult['ITEMS'] as $key1=>$arCompareItem ){?>
						<div class="compare__slider-item compare_<?=$arCompareItem['ID']?>_item">
							<div class="compare__slider-item-inner">
								<div class="compare__slider-item-inner-main">
									<img class="compare__slider-item-img" src="<?=$arCompareItem['PREVIEW_PICTURE'] ? $arCompareItem['PREVIEW_PICTURE']['SRC'] : SITE_TEMPLATE_PATH . '/img/no-image.png'?>">
									<div class="compare__slider-item-price"><?=number_format($arCompareItem['CATALOG_PRICE_1'], 0, '', ' ')?> Сом</div>
									<a class="compare__slider-item-name" href="<?=$arCompareItem['DETAIL_PAGE_URL']?>"><?=$arCompareItem['NAME']?></a>
									<div class="compare__slider-item-buttons">
										<div onclick="fc_product_del('COMPARE', <?=$arCompareItem['ID']?>)" class="compare__slider-item-button-del">
											<svg class="compare__slider-item-button-del-icon">
												<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#close"></use>
											</svg>
										</div>
										<div data-id="<?=$arCompareItem['ID']?>" onclick="fc_basket_add(<?=$arCompareItem['ID']?>)" class="compare__slider-item-button">В корзину</div>
									</div>
								</div>
								<div class="compare__slider-item-options zzz123">
									<?foreach( $arCompareItem['PROPERTIES'] as $key2 => $arProperty ){?>
										<?if( !in_array($key2, $arResult['PROPS_NOT_SHOW']) ){?>
											<?if( strlen(trim($arProperty['VALUE']))>0 && $arProperty['VALUE'] != "–" && $arProperty['VALUE'] != "0" && $arProperty['VALUE'] != "false" ){?>
											<div class="compare__slider-item-option">
												<div class="compare__slider-item-option-name"><?=$arProperty["NAME"]?></div>
												<div class="compare__slider-item-option-value">
												<?=!empty($arProperty['VALUE']) ? $arProperty['VALUE'] : '&ndash;'?>
												</div>
											</div>
											<?}?>
										<?}?>
									<?}?>
								</div>
							</div>
						</div>
						<?}?>
						
					</div>
				</div>
			</div>
		</div>
		<?}?>
	</div>
</section>
