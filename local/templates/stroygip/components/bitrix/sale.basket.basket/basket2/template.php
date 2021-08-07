<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
/** @var CBitrixBasketComponent $component */
use Bitrix\Main;
?>

<?
if( empty($arResult["ERROR_MESSAGE"]) ){
?>
<div id="basket_ajax_template" class="basket">
	<div class="basket__products">
		<div class="basket__products-title">Товары в корзине: <?=$arResult["ORDERABLE_BASKET_ITEMS_COUNT"]?></div>
		<div class="basket__products-items">	
		
		    <?foreach ($arResult['ITEMS']['AnDelCanBuy'] as $key=>$arItem){
				if($arItem['PREVIEW_PICTURE']){
					$preview_picture = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'],array("width" => 214, "height" => 160),BX_RESIZE_IMAGE_PROPORTIONAL)['src'];
				}else{
					$preview_picture = sprintf('%s/img/no-image.png',SITE_TEMPLATE_PATH);
				}
			?>
			<div class="basket__products-item" id="basket_<?=$arItem['PRODUCT_ID']?>_item">
				<div class="basket__products-item-img-wrapper">
					<img class="basket__products-item-img" src="<?=$preview_picture?>">
				</div>
				<div class="basket__products-item-desc">
					<div class="basket__products-item-desc-title">
						<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="basket__products-item-desc-title-item">
							<?=$arItem['NAME']?>
						</a>
						<div class="basket__products-item-desc-title-count">
							<div class="basket__products-item-desc-title-count-text">На складе:</div>
							<div class="basket__products-item-desc-title-count-number"><?=$arItem['AVAILABLE_QUANTITY']?> шт.</div>
						</div>
					</div>
					<div class="basket__products-item-desc-count" data-counter-max="<?=$arItem['AVAILABLE_QUANTITY']?>">
						<div class="basket__products-item-desc-count-button basket__products-item-desc-count-button--minus" onclick="basketUpdate(<?=$arItem['ID']?>, 'minus')"></div>
						<div id="basket_<?=$arItem['ID']?>_qnt" data-maxqnt="<?=$arItem['AVAILABLE_QUANTITY']?>" class="basket__products-item-desc-count-value"><?=$arItem['QUANTITY']?></div>
						<div class="basket__products-item-desc-count-button basket__products-item-desc-count-button--plus" onclick="basketUpdate(<?=$arItem['ID']?>, 'plus')"></div>
					</div>
					<div class="basket__products-item-desc-price">
						<div class="basket__products-item-desc-price-number"><?=$arItem['SUM_FULL_PRICE_FORMATED']?></div>
						<div class="basket__products-item-desc-price-currency">сом</div>
					</div>
					<div class="basket__products-item-desc-del" onclick="catalogAction('delete_basket_item', <?=$arItem['PRODUCT_ID']?>)" data-action="delete" data-productid="<?=$arItem['PRODUCT_ID']?>" data-id="<?=$arItem['ID']?>">
						<svg class="basket__products-item-desc-del-icon">
							<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#trash"></use>
						</svg>
					</div>
				</div>
			</div>
			<?}?>

		</div>
	</div>
	<div class="basket__order">
		<div class="basket__order-wrapper">
			<div class="basket__order-main">
				<div class="basket__order-title">Заказ:</div>
				<div class="basket__order-desc">
					<div class="basket__order-desc-row">
						<div class="basket__order-desc-row-item">Товары <?=$arResult["ORDERABLE_BASKET_ITEMS_COUNT"]?> шт.</div>
						<div class="basket__order-desc-row-value"><?=$arResult["allSum_FORMATED"]?></div>
					</div>
					<div class="basket__order-desc-row">
						<div class="basket__order-desc-row-item">Вес заказа</div>
						<div class="basket__order-desc-row-value"><?=$arResult['allWeight_FORMATED']?></div>
					</div>
					<div class="basket__order-desc-row basket__order-desc-row--result">
						<div class="basket__order-desc-row-item">Общая стоимость</div>
						<div class="basket__order-desc-row-value"><?=$arResult["allSum_FORMATED"]?></div>
					</div>
				</div>
			</div>
			<div class="basket__order-actions">
				<div class="basket__order-actions-buttons">
					<div onclick="addEstimate()" class="basket__order-actions-button basket__order-actions-button--bill basket-products__save-us">
						<svg class="basket__order-actions-button-icon">
							<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#bill"></use>
						</svg>
						<span class="basket__order-actions-button-text user_save_estimate">Сохранить как смету</span>
					</div>
					<div class="basket__order-actions-button basket__order-actions-button--print" onclick="window.print()">
						<svg class="basket__order-actions-button-icon">
							<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#print"></use>
						</svg>
						<span class="basket__order-actions-button-text">Версия для печати</span>
					</div>
				</div>
			</div>
		</div>
		<a <?if( !$USER->IsAuthorized() ):?>data-modal-open='login'<?else:?>href="/order/"<?endif;?> class="basket__order-actions-main-button">Перейти к оформлению заказа</a>
	</div>
</div>
<?
}elseif( $arResult['EMPTY_BASKET'] ){
	include(Main\Application::getDocumentRoot().$templateFolder.'/empty.php');
}else{
	ShowError($arResult['ERROR_MESSAGE']);
}
?>