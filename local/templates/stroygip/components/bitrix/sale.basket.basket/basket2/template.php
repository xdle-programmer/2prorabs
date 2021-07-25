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

<!--b><?print_r($arResult);?></b-->
<?
if( empty($arResult["ERROR_MESSAGE"]) ){
    $fullPrice = 0;
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
			<?
				$fullPrice += $arItem['SUM_FULL_PRICE'];
			}
			?>

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
					<div class="basket__order-actions-button basket__order-actions-button--bill">
						<svg class="basket__order-actions-button-icon">
							<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#bill"></use>
						</svg><span class="basket__order-actions-button-text">Сохранить как смету</span>
					</div>
					<div class="basket__order-actions-button basket__order-actions-button--print" onclick="window.print()">
						<svg class="basket__order-actions-button-icon">
							<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#print"></use>
						</svg><span class="basket__order-actions-button-text">Версия для печати</span>
					</div>
				</div>
			</div>
		</div>
		<a  href="/order/" class="basket__order-actions-main-button">Перейти к оформлению заказа</a>
	</div>
</div>
<?
}elseif( $arResult['EMPTY_BASKET'] ){
	include(Main\Application::getDocumentRoot().$templateFolder.'/empty.php');
}else{
	ShowError($arResult['ERROR_MESSAGE']);
}
?>

    <?/*if(empty($arResult["ERROR_MESSAGE"])){
        $fullPrice = 0;?>
        <div class="basket-products__grid">
            <!-- First container-->
            <div class="basket-products__container">
                <div class="basket-products__header">
                    <div class="basket-products__title">Корзина</div>
                    <div class="basket-products__in-basket">Товары в корзине:<span class="basket-products__in-basket-text"><?=count($arResult['ITEMS']['AnDelCanBuy'])?></span></div>
                </div>
                <div class="basket-products__subtitle">Товары:</div>
                <?foreach ($arResult['ITEMS']['AnDelCanBuy'] as $arItem){
                    if($arItem['PREVIEW_PICTURE']){
                        $preview_picture = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'],array("width" => 214, "height" => 160),BX_RESIZE_IMAGE_PROPORTIONAL)['src'];
                    }else{
                        $preview_picture = sprintf('%s/img/no-image.png',SITE_TEMPLATE_PATH);
                    }
                    if (in_array($arItem['ID'], $arParams['FAVORITES'])) {
                            $fav_action = 'compfavdelete';
                            $fav_act = ' active';
                            $fav_text = 'В избранном';
                        } else {
                            $fav_action = 'compfav';
                            $fav_act = '';
                            $fav_text = 'В избранное';
                        }
                    ?>
                <div class="basket-products__item-container">
                    <div class="basket-products__item">
                        <div class="basket-products__item-inner">
                            <div class="basket-products__image-box">
                                <img class="basket-products__image" src="<?=$preview_picture?>">
                            </div>
                            <div class="basket-products__information">
                                <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="basket-products__name"><?=$arItem['NAME']?></a>
                                <?if($arItem['PROPERTY_ART_NUMBER_VALUE']){?>
                                    <div class="basket-products__article">Артикул: <?=$arItem['PROPERTY_ART_NUMBER_VALUE']?></div>
                                <?}?>
                                <div class="basket-products__stock">
                                    На складе:<span class="basket-products__stock-amount">
                                   <?=$arItem['AVAILABLE_QUANTITY']?> <?=$arItem['MEASURE_TEXT']?>
                               </span>
                                </div>
                            </div>
                        </div>
                        <div class="basket-products__item-box">
                            <div class="basket-products__amount-container">
                                <div class="basket-products__title-small">Количество:</div>
                                <div class="basket-products__amount-input">
                                    <div class="amount-input__sum">
                                        <div class="amount-input__sum-icon tq_dec">-</div>
                                        <input class="amount-input__sum-input" data-id="<?=$arItem['ID']?>" type="text" value="<?=$arItem['QUANTITY']?>" max="<?=$arItem['AVAILABLE_QUANTITY']?>">
                                        <div class="amount-input__sum-icon tq_inc">+</div>
                                    </div>
                                </div>
                            </div>
                            <div class="basket-products__sum-container">
                                <div class="basket-products__title-small">Сумма:</div>
                                <div class="basket-products__final-cost"><?=number_format($arItem['SUM_VALUE'],'0','.',' ')?><span class="basket-products__final-cost-text"><?=strtolower(CURRENCY)?></span></div>
                                <?if($arItem['SUM_DISCOUNT_PRICE']){?>
                                    <div class="basket-products__old-price"><?=number_format($arItem['SUM_FULL_PRICE'],'0','.',' ')?><span class="basket-products__old-price-text"><?=strtolower(CURRENCY)?></span></div>
                                    <div class="basket-products__your-discount">Скидка составила <?=$arItem['DISCOUNT_PRICE_PERCENT_FORMATED']?>, экономия <?=$arItem['SUM_DISCOUNT_PRICE']?> <?=strtolower(CURRENCY)?></div>
                                <?}?>
                            </div>
                        </div>
                    </div>
                    <div class="basket-products__panel">
                        <a class="basket-products__panel-item<?=$fav_act?>" href="javascript:void(0)" data-action="<?=$fav_action?>" data-id="<?=$arItem['PRODUCT_ID']?>" data-add="FAVORITES">
                            <div class="basket-products__panel-icon basket-products__panel-icon--favourites"></div>
                            <div class="basket-products__panel-text"><?=$fav_text?></div></a>
                        <a class="basket-products__panel-item" href="javascript:void(0)" data-action="delete" data-productid="<?=$arItem['PRODUCT_ID']?>" data-id="<?=$arItem['ID']?>">
                            <div class="basket-products__panel-icon basket-products__panel-icon--remove"></div>
                            <div class="basket-products__panel-text">Удалить</div></a>
                    </div>
                </div>
                <?
                    $fullPrice += $arItem['SUM_FULL_PRICE'];
                }?>
            </div>
            <!-- Second container-->
            <div class="basket-products__container">
                <div class="basket-products__document-box">
<!--                    <a class="basket-products__document-item" href="javascript:void(0)">-->
<!--                        <div class="basket-products__document-icon basket-products__document-icon--download"></div>-->
<!--                        <div class="basket-products__document-text">Загрузить смету</div>-->
<!--                    </a>-->
                    <a class="basket-products__document-item" href="javascript:void(0)" onClick = "window.print ()">
                        <div class="basket-products__document-icon basket-products__document-icon--printer"></div>
                        <div class="basket-products__document-text">Версия для печати</div>
                    </a>
                </div>
                <?if($arParams['DELIVERY_FREE'] && $arParams['DELIVERY_FREE']>$arResult['allSum']){
                    $free_delivery = $arParams['DELIVERY_FREE']- $arResult['allSum']?>
                <div class="basket-products__free-delivery">
                    <div class="basket-products__free-delivery-icon"></div>
                    <div class="basket-products__free-delivery-text">Наличие и окончательную стоимость товара возможно будут отличаться просьба уточнить у менеджера</div>
                </div>
                <?}?>
                <div class="basket-products__title-medium basket-products__title-medium--mb">Ваша корзина:</div>
                <div class="basket-products__row">
                    <div class="basket-products__row-name">Товары <?=count($arResult['ITEMS']['AnDelCanBuy'])?> шт.</div>
                    <div class="basket-products__row-info"><?=number_format($arResult['allSum'], 0, '', ' ')?> <?= CURRENCY;?></div>
                </div>
                <div class="basket-products__row">
                    <div class="basket-products__row-name">Вес заказа</div>
                    <div class="basket-products__row-info"><?=$arResult['allWeight']/1000?> кг</div>
                </div>
                <?if($arResult['DISCOUNT_PRICE_ALL']>0){
                    $discount_percent = ceil($arResult['DISCOUNT_PRICE_ALL']/$fullPrice*100);
                    ?>
                <div class="basket-products__row">
                    <div class="basket-products__row-name">Скидка <?=$discount_percent?>%</div>
                    <div class="basket-products__row-info basket-products__row-info--red">-<?=$arResult['DISCOUNT_PRICE_ALL_FORMATED']?></div>
                </div>
                <?}?>
				
                <?if($arParams['DELIVERY_PRICE'] || $arResult['allSum']>= $arParams['DELIVERY_FREE']){?>
                <div class="basket-products__row">
                    <div class="basket-products__row-name">Доставка от 120 Cом</div>
                </div>
                <?}?>
				
<!--                <div class="basket-products__checkbox-box">-->
<!--                    <div class="basket-products__checkbox-item">-->
<!--                        <div class="checkbox">-->
<!--                            <input class="checkbox__input" type="checkbox">-->
<!--                            <div class="checkbox__square"></div>-->
<!--                            <div class="checkbox__text">Бонусы</div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="basket-products__checkbox-item">-->
<!--                        <div class="checkbox">-->
<!--                            <input class="checkbox__input" type="checkbox">-->
<!--                            <div class="checkbox__square"></div>-->
<!--                            <div class="checkbox__text">Промокод</div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
                <div class="basket-products__total-cost">
                    <div class="basket-products__total-cost-row">
                        <div class="basket-products__total-cost-name">Общая стоимость:</div>
                        <div class="basket-products__total-cost-amount"><?=number_format($arResult['allSum'],'0',',',' ')?> <?=CURRENCY?></div>
                    </div>
                </div>
                <?if(!$USER->IsAuthorized()){?>
                    <a class="button button--red button--red-width basket-products__button-red" id="buttonRegBasket">Перейти к оформлению заказа</a>
                <?}else{?>
                    <a class="button button--red button--red-width basket-products__button-red" href="<?=$arParams['PATH_TO_ORDER']?>">Перейти к оформлению заказа</a>
                <?}?>
                <a class="basket-products__save-us" href="#">Сохранить как смету</a>

            </div>
        </div>

    <?}elseif ($arResult['EMPTY_BASKET'])
{
	include(Main\Application::getDocumentRoot().$templateFolder.'/empty.php');
}
else
{
	ShowError($arResult['ERROR_MESSAGE']);
}
*/
?>


