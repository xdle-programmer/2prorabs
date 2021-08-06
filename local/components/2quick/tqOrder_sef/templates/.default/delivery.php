<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var array $arResult */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
?>
<script>
deliveryPrice = {
	bigDeliveryKm: 20,
	bigDeliveryKmMinimal: 200,
	smallDeliveryKm: 10,
	smallDeliveryKmMinimal: 100,
}
</script>

<?
$arr_month = [
  'января',
  'февраля',
  'марта',
  'апреля',
  'мая',
  'июня',
  'июля',
  'августа',
  'сентября',
  'октября',
  'ноября',
  'декабря'
];
?>

<form class="basket form-check" id="order-1" data-tab="delivery" data-next="<?=$arResult['TABS']['1']['URL']?>">
	<div class="basket__products">
		<div class="order-status">
			<div class="order-status__item order-status__item--active">
				<div class="order-status__item-number">1</div>
				<div class="order-status__item-name">Доставка</div>
			</div>
			<svg class="order-status__separator">
				<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#long-arrow"></use>
			</svg>
			<div class="order-status__item order-status__item--unactive">
				<div class="order-status__item-number">2</div>
				<div class="order-status__item-name">Оплата</div>
			</div>
			<svg class="order-status__separator">
				<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#long-arrow"></use>
			</svg>
			<div class="order-status__item order-status__item--unactive">
				<div class="order-status__item-number">3</div>
				<div class="order-status__item-name">Подтверждение</div>
			</div>
		</div>
		<div class="order-form">
			<div class="order-form__group">
				<div class="order-form__group-title">Получатель</div>
				<div class="order-form__group-item order-form__group-item--two-col">
					<div class="placeholder form-check__field" data-elem="input" data-rule="input-empty">
						<input class="input placeholder__input" placeholder="ФИО" type="text" name="NAME" value="<?=$arResult['SAVED']['delivery']['NAME']?>">
						<div class="placeholder__item">ФИО</div>
					</div>
					<div class="placeholder form-check__field" data-elem="input" data-rule="input-empty">
						<input class="input placeholder__input" placeholder="Телефон получателя" type="text" name="PHONE" value="<?=$arResult['SAVED']['delivery']['PHONE']?>">
						<div class="placeholder__item">Телефон получателя</div>
					</div>
				</div>
			</div>
			<div class="order-form__group">
				<div class="order-form__group-title">Способ доставки</div>
				<div class="order-form__group-item order-form__group-item--flex">
					<label class="order-form__radio form-check__field" data-elem="input" data-rule="radio-required" onclick="setOrderDelivery(2);">
						<input class="order-form__radio-input" type="radio" name="delivery_id" value="2">
						<span class="order-form__radio-button">
							<span class="order-form__radio-button-icon"></span>
							<span class="order-form__radio-button-text">Забрать из магзина</span>
						</span>
					</label>
					<label class="order-form__radio form-check__field" data-elem="input" data-rule="radio-required" onclick="setOrderDelivery(3);">
						<input class="order-form__radio-input" type="radio" name="delivery_id" value="3">
						<span class="order-form__radio-button">
							<span class="order-form__radio-button-icon"></span>
							<span class="order-form__radio-button-text">Курьерская доставка</span>
						</span>
					</label>
				</div>
			</div>
			<div class="order-form__group order-form__group--hide" data-delivery="2">
				<?foreach( $arResult['DELIVERIES'] as $key=>$arDelivery ){?>
					<?if( $arDelivery['STORES'] ){?>
						<? foreach( $arDelivery['STORES'] as $key1=>$arItem ){?>
							<?if( $arItem["ID"] == "235" ){?>
							
				<div class="order-form__store">
					<svg class="order-form__store-icon">
						<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#map-pointer"></use>
					</svg>
					<div class="order-form__store-desc">
						<div class="order-form__store-desc-name"><?=$arItem["NAME"]?>
							<div class="order-form__store-desc-hint"><?=$arItem["PREVIEW_TEXT"]?></div>
						</div>
						<div class="order-form__store-desc-time">Магазин работает с <?=$arItem["PROPERTIES"]["WORK_TIME"]["VALUE"]?></div>
						<div class="order-form__store-desc-take">
							Можно забрать во вторник, <?echo date('d', strtotime("+" . $arItem["PROPERTIES"]["DELIVERY_DAY"]["VALUE"] . " day"))." ".$arr_month[ date('m', strtotime("+" . $arItem["PROPERTIES"]["DELIVERY_DAY"]["VALUE"] . " day")) - 1 ];?>
						</div>
					</div>
					
					
					<?/*if( count($arItem['UNAVAILABLE_PRODUCTS']) > 0 ):?>
						<div class="checkout__unavailable-products-text">
							На этом складе недостаточное количество следующих товаров (указан актуальный остаток):
						</div>
						<?foreach( $arItem['UNAVAILABLE_PRODUCTS'] as $product ):?>
							<div class="checkout__unavailable-product">
								<?=$product['NAME']?> &mdash; <?=$product['AVAILABLE']?> шт.
							</div>
						<?endforeach;?>
					<?endif;
					
					<input class="tq_radio" type="radio" name="POINT" value="<?= $arItem['ID'] ?>" hidden
						   id="point-<?=$arItem['ID']?>"
						   <?// if ($arDelivery['CHECKED'] != 'Y') echo ' disabled' ?> 
						   <? if ($arResult['SAVED']['delivery']['POINT'] == $arItem['ID']) echo ' checked' ?>
					>
					<label class="basket-products__delivery-point-button" for="point-<?= $arItem['ID'] ?>">Выбрать</label>
					*/?>
				</div>
				
							<?}?>
						<?}?>
					<?}?>
				<?}?>
				
				<input type="radio" name="POINT" value="235" hidden checked>
			</div>
			<div class="order-form__group order-form__group--hide" data-delivery="3">
				<div class="order-form__address">
					<div class="order-form__address-input">
						<div class="placeholder">
							<input id="user_delivery_address" name="STREET" class="input placeholder__input" placeholder="Адрес">
							<div class="placeholder__item">Адрес</div>
						</div>
					</div>
					
					<div class="order-form__address-button" data-modal-open="delivery-map">Отметить на карте для расчета доставки</div>
					<div class="order-form__address-price">
						<!--div class="order-form__address-price-item">
							<div class="order-form__address-price-item-name">Доставка до 200 кг:</div>
							<div class="order-form__address-price-item-number">100</div>
							<div class="order-form__address-price-item-currency">сом</div>
						</div>
						<div class="order-form__address-price-item">
							<div class="order-form__address-price-item-name">Доставка свыше 200 кг:</div>
							<div class="order-form__address-price-item-number">100</div>
							<div class="order-form__address-price-item-currency">сом</div>
						</div-->
					</div>
					
					<div id="tq_errors"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="basket__order">
		<div class="basket__order-wrapper">
			<div class="basket__order-main">
				<div class="basket__order-title">Заказ:</div>
				<div class="basket__order-desc">
					<div class="basket__order-desc-row">
						<div class="basket__order-desc-row-item">Товары <?echo count($_SESSION["BASKET_LIST"]);?> шт.</div>
						<div class="basket__order-desc-row-value"><?=$arResult["INFO_ORDER"]["FORMATED_BASKET_SUM"]?></div>
					</div>
					<div class="basket__order-desc-row">
						<div class="basket__order-desc-row-item">Вес заказа</div>
						<div class="basket__order-desc-row-value"><?=$arResult["INFO_ORDER"]["WEIGHT"]?> г</div>
					</div>
					<div class="basket__order-desc-row basket__order-desc-row--result">
						<div class="basket__order-desc-row-item">Общая стоимость</div>
						<div id="basket__order-total-sum" class="basket__order-desc-row-value"><?=$arResult["INFO_ORDER"]["FORMATED_BASE_PRICE"]?></div>
					</div>
				</div>
			</div>
		</div>
		<div id="orderNextTab" onclick="submitOrderForm();" data-tab="delivery" data-next="/order/payment/" class="basket__order-actions-main-button form-check__button">Далее</div>
	</div>
</form>


<div class="modal modal--map" id="delivery-map">
  <div class="modal__content form-check">
	<div class="modal__header">
	  <div class="modal__header-title">Кликните на карту</div>
	  <div class="modal__header-close" data-modal-close>
		<svg class="modal__header-close-icon">
		  <use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#close"></use>
		</svg>
	  </div>
	</div>
	<div class="modal__content-items">
	  <div class="delivery-map">
		<div class="delivery-map__item"></div>
		<div class="delivery-map__form">
		  <div class="delivery-map__form-input">
			<div class="placeholder form-check__field" data-elem="input" data-rule="input-empty">
			  <input id="user_selected_adress" class="input input--small placeholder__input" placeholder="Кликните на карту">
			  <div class="placeholder__item">Кликните на карту</div>
			</div>
		  </div>
		  <div onclick="setAdress()" class="delivery-map__form-button-save form-check__button">Сохранить</div>
		  <div class="delivery-map__form-button-cancel">
			<svg class="delivery-map__form-button-cancel-icon">
			  <use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#close"></use>
			</svg>
		  </div>
		</div>
	  </div>
	</div>
  </div>
</div>
