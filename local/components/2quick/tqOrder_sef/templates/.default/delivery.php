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

$sd = date('d m', strtotime("+" . $arItem["PROPERTIES"]["DELIVERY_DAY"]["VALUE"] . " day"));
?>


<!--b><?print_r($arResult);?></b-->
<form class="basket form-check" id="order-1">
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
					<label class="order-form__radio form-check__field" data-elem="input" data-rule="radio-required">
						<input class="order-form__radio-input" type="radio" name="delivery_id" value="2">
						<span class="order-form__radio-button">
							<span class="order-form__radio-button-icon"></span>
							<span class="order-form__radio-button-text">Забрать из магзина</span>
						</span>
					</label>
					<label class="order-form__radio form-check__field" data-elem="input" data-rule="radio-required">
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
				<div class="order-form__store">
					<svg class="order-form__store-icon">
						<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#map-pointer"></use>
					</svg>
					<div class="order-form__store-desc">
						<div class="order-form__store-desc-name"><?=$arItem["NAME"]?>
							<div class="order-form__store-desc-hint"><?=$arItem["PREVIEW_TEXT"]?></div>
						</div>
						<div class="order-form__store-desc-time">Магазин работает с <?=$arItem["PROPERTIES"]["WORK_TIME"]["VALUE"]?></div>
						<div class="order-form__store-desc-take">Можно забрать во вторник, <?echo date('d m', strtotime("+" . $arItem["PROPERTIES"]["DELIVERY_DAY"]["VALUE"] . " day"));?></div>
					</div>
				</div>
						<?}?>
					<?}?>
				<?}?>
			</div>
			<div class="order-form__group order-form__group--hide" data-delivery="3">
				<div class="order-form__address">
					<div class="order-form__address-input">
						<div class="placeholder">
							<input class="input placeholder__input" placeholder="Адрес">
							<div class="placeholder__item">Адрес</div>
						</div>
					</div>
					<div class="order-form__address-button" data-modal-open="delivery-map">Отметить на карте для расчета доставки</div>
					<div class="order-form__address-price">
						<div class="order-form__address-price-item">
							<div class="order-form__address-price-item-name">Доставка до 200 кг:</div>
							<div class="order-form__address-price-item-number">100</div>
							<div class="order-form__address-price-item-currency">сом</div>
						</div>
						<div class="order-form__address-price-item">
							<div class="order-form__address-price-item-name">Доставка свыше 200 кг:</div>
							<div class="order-form__address-price-item-number">100</div>
							<div class="order-form__address-price-item-currency">сом</div>
						</div>
					</div>
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
						<div class="basket__order-desc-row-item">Товары 10 шт.</div>
						<div class="basket__order-desc-row-value">76 625 сом</div>
					</div>
					<div class="basket__order-desc-row">
						<div class="basket__order-desc-row-item">Вес заказа</div>
						<div class="basket__order-desc-row-value">0 кг</div>
					</div>
					<div class="basket__order-desc-row basket__order-desc-row--result">
						<div class="basket__order-desc-row-item">Общая стоимость</div>
						<div class="basket__order-desc-row-value">75 625 сом</div>
					</div>
				</div>
			</div>
		</div>
		<div class="basket__order-actions-main-button form-check__button">Далее</div>
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
			  <input class="input input--small placeholder__input" placeholder="Кликните на карту">
			  <div class="placeholder__item">Кликните на карту</div>
			</div>
		  </div>
		  <div class="delivery-map__form-button-save form-check__button">Сохранить</div>
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
	
	
<?/*
<div class="basket-products__grid">
    <form class="basket-products__container" id="tq_order" data-tab="delivery" data-next="<?= $arResult['TABS']['1']['URL'] ?>">
        <div class="basket-products__title"><?= $APPLICATION->ShowTitle(false) ?></div>
        <? include 'tabs.php'; ?>
        <div class="basket-products__title basket-products__title--medium-center basket-products__title--mb">Доставка</div>
        <div class="basket-products__registration-inner">
            <div class="basket-products__registration-title">Получатель</div>
            <div class="basket-products__registration-forms">
                <div class="basket-products__registration-input-box basket-products__registration-input-box--mr">
                    <? $value = $arResult['SAVED']['delivery']['NAME'] ?>
                    <label class="basket-products__registration-label <? if ($value): ?>basket-products__registration-label-active<? endif; ?>">ФИО</label>
                    <input
                        class="basket-products__registration-input <? if ($value): ?>basket-products__registration-label-active<? endif; ?>"
                        type="text"
                        name="NAME"
                       value="<?=$value?>"
                    />
                </div>

                <div class="basket-products__registration-input-box">
                    <? $value = $arResult['SAVED']['delivery']['PHONE']; ?>
                    <label class="basket-products__registration-label <? if ($value): ?>basket-products__registration-label-active<? endif; ?>">Телефон получателя</label>
                    <input
                        class="basket-products__registration-input <? if ($value): ?>basket-products__registration-label-active<? endif; ?>"
                        type="text"
                        name="PHONE"
                        value="<?=$value?>"
                        data-phone-mask
                    />
                </div>
            </div>
            <!--div class="basket-products__registration-forms">
                        <div class="basket-products__registration-input-box basket-products__registration-input-box--mr">
                            <label class="basket-products__registration-label">Телефон</label>
                            <input class="basket-products__registration-input" type="text" name="PHONE" value="<?=$arResult['SAVED']['delivery']['PHONE']?>">
                        </div>
                        <div class="basket-products__registration-input-box">
                            <label class="basket-products__registration-label">E-mail</label>
                            <input class="basket-products__registration-input" type="text" name="EMAIL" value="<?=$arResult['SAVED']['delivery']['EMAIL']?>">
                        </div>
                    </div-->
            <div style="display: none" class="basket-products__registration-title">Город получения</div>
            <div class="basket-products__select">
                <div class="ui-widget ui-widget--mb">
                    <!--                            <select id="combobox" name="LOCATION"></select>-->
                </div>
            </div>
            <div class="basket-products__registration-title">Выберите способ получения заказа</div>
            <div class="basket-products__container-tabs">
                <div class="basket-products__delivery-buttons">
                    <? foreach ($arResult['DELIVERIES'] as $arDelivery) { ?>
                        <label class="basket-products__delivery-button<? if ($arDelivery['CHECKED'] == 'Y') echo ' basket-products__delivery-button--active' ?>">
                            <input type="radio" hidden name="delivery_id" value="<?= $arDelivery['ID'] ?>"<? if ($arDelivery['CHECKED'] == 'Y') echo ' checked' ?>>
                            <div class="basket-products__delivery-button-title"><?= $arDelivery['NAME'] ?></div>
                            <!--                                <div class="basket-products__delivery-button-text">--><? //=$arDelivery['PRICE_FORMATED']?><!--</div>-->
                        </label>
                    <? } ?>
                </div>
                <? foreach ($arResult['DELIVERIES'] as $arDelivery) { ?>
                    <div class="basket-products__content<? if ($arDelivery['CHECKED'] == 'Y') echo ' basket-products__content--active' ?>" data-delivery="<?= $arDelivery['ID'] ?>">
                        <?
                        if ($arDelivery['STORES']) {
                            ?>
                            <div class="basket-products__registration-title basket-products__registration-title--mb-small">Пункты самовывоза</div>
                            <div class="basket-products__delivery-points">
                                <? foreach ($arDelivery['STORES'] as $arItem) {
                                    ?>
                                    <div class="basket-products__delivery-point">
                                        <div class="basket-products__delivery-point-container">
                                            <div class="basket-products__delivery-point-position"><?=$arItem['NAME']?></div>
                                            <div class="basket-products__delivery-point-time">
                                                <? if ($arItem['PROPERTIES']['WORK_TIME']['VALUE']): ?>
                                                    График работы: <?=$arItem['PROPERTIES']['WORK_TIME']['VALUE']?> <br>
                                                <? endif; ?>

                                                <? if ($arItem['PROPERTIES']['DELIVERY_DAY']['VALUE']): ?>
                                                    <?
                                                    $date = new DateTime(date('d.m.Y'));
                                                    $date->add(new DateInterval('P' . intval($arItem['PROPERTIES']['DELIVERY_DAY']['VALUE']) . 'D'));
                                                    $day = FormatDate('l', MakeTimeStamp($date->format('d.m.Y h:i:s')))
                                                    ?>
                                                    Можно забрать <? if ($day == 'Вторник') echo 'во'; else echo 'в' ?> <?= strtolower($day) ?>, <?= FormatDate(' d F', MakeTimeStamp($date->format('d.m.Y h:i:s'))) ?>
                                                <? endif; ?>
                                            </div>
                                            <div class="basket-products__delivery-pay-method"><?= $arItem['PREVIEW_TEXT'] ?></div>

                                            <? if (count($arItem['UNAVAILABLE_PRODUCTS']) > 0): ?>
                                                <div class="checkout__unavailable-products-text">
                                                    На этом складе недостаточное количество следующих товаров (указан актуальный остаток):
                                                </div>
                                                <? foreach ($arItem['UNAVAILABLE_PRODUCTS'] as $product): ?>
                                                    <div class="checkout__unavailable-product">
                                                        <?=$product['NAME']?> &mdash; <?=$product['AVAILABLE']?> шт.
                                                    </div>
                                                <? endforeach; ?>
                                            <? endif; ?>
                                        </div>
                                        <input class="tq_radio" type="radio" name="POINT" value="<?= $arItem['ID'] ?>" hidden
                                               id="point-<?= $arItem['ID'] ?>"<? if ($arDelivery['CHECKED'] != 'Y') echo ' disabled' ?> <? if ($arResult['SAVED']['delivery']['POINT'] == $arItem['ID']) echo ' checked' ?>>
                                        <label class="basket-products__delivery-point-button" for="point-<?= $arItem['ID'] ?>">Выбрать</label>
                                    </div>
                                <? } ?>

                            </div>
                        <? } else {
                            ?>
                            <div class="basket-products__tk">
                                <div class="basket-products__registration-title basket-products__registration-title--mb-small">
                                    <? if ($arDelivery['ID'] == '4') echo 'Введите адрес пункта ТК'; else echo 'Введите адрес доставки заказа' ?>
                                </div>
                                <? if ($arDelivery['DESCRIPTION']) {
                                    ?>
                                    <div class="basket-products__warning">
                                        <div class="basket-products__warning-close"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/src/blocks/basket-products/assets/img/close.svg">
                                        </div>
                                        <div class="basket-products__warning-title">Внимание!</div>
                                        <div class="basket-products__warning-text">
                                            <?= $arDelivery['DESCRIPTION'] ?>
                                        </div>
                                    </div>
                                <? } ?>
                                <div class="basket-products__registration-forms basket-products__registration-forms--mb">
                                    <div class="basket-products__registration-input-box basket-products__registration-input-box--mr basket-products__registration-input-box--address-1">
                                        <? $value = $arResult['SAVED']['delivery']['CITY']; ?>
                                        <label class="basket-products__registration-label <? if ($value): ?>basket-products__registration-label-active<? endif; ?>">Адрес</label>
                                        <input class="basket-products__registration-input <? if ($value): ?>basket-products__registration-label-active<? endif; ?>" type="text"
                                               name="CITY"<? if ($arDelivery['CHECKED'] != 'Y') echo ' disabled' ?> value="<?= $value ?>">
                                    </div>
                                    <div class="basket-products__registration-input-box basket-products__registration-input-box--address-2">
                                        <div class="basket-products__registration-input-button open-basket-map">Указать на карте</div>
                                    </div>

                                    <div class="basket-products__registration-input-box" style="display: none">
                                        <label class="basket-products__registration-label">Улица</label>
                                        <input class="basket-products__registration-input" type="text" name="STREET"<? if ($arDelivery['CHECKED'] != 'Y') echo ' disabled' ?>
                                               value="&nbsp;<?= $arResult['SAVED']['delivery']['STREET'] ?>">
                                    </div>
                                </div>
                                <div class="basket-delivery">
                                    <div class="basket-products__registration-forms basket-products__registration-forms--mb">
                                        <div class="basket-products__registration-title basket-products__registration-title--mb-small">Стоимость доставки до 200 кг:&nbsp;</div>
                                        <div class="basket-products__registration-title basket-products__registration-title--mb-small price-small-delivery"></div>
                                        <div class="basket-products__registration-title basket-products__registration-title--mb-small">&nbsp;Сом</div>
                                    </div>
                                    <div class="basket-products__registration-forms basket-products__registration-forms--mb">
                                        <div class="basket-products__registration-title basket-products__registration-title--mb-small">Стоимость доставки свыше 200 кг:&nbsp;</div>
                                        <div class="basket-products__registration-title basket-products__registration-title--mb-small price-big-delivery"></div>
                                        <div class="basket-products__registration-title basket-products__registration-title--mb-small">&nbsp;Сом</div>
                                    </div>
                                </div>

                                <div class="basket-products__registration-forms">
                                    <div class="basket-products__registration-input-box basket-products__registration-input-box--mr" style="display: none">
                                        <label class="basket-products__registration-label">Дом</label>
                                        <input class="basket-products__registration-input" type="text" name="HOUSE"<? if ($arDelivery['CHECKED'] != 'Y') echo ' disabled' ?>
                                               value="&nbsp;<?= $arResult['SAVED']['delivery']['HOUSE'] ?>">
                                    </div>
                                    <div class="basket-products__registration-input-box" style="display: none">
                                        <label class="basket-products__registration-label">Квартира</label>
                                        <input class="basket-products__registration-input" type="text" name="APARTMENT"<? if ($arDelivery['CHECKED'] != 'Y') echo ' disabled' ?>
                                               value="&nbsp;<?= $arResult['SAVED']['delivery']['APARTMENT'] ?>">
                                    </div>
                                </div>
                            </div>
                        <? } ?>
                    </div>
                <? } ?>
            </div>
        </div>
        <button class="basket-products__next-button">Далее
            <div class="basket-products__next-button-icon"></div>
        </button>
        <div class="tq_errors"></div>

    </form>
    <? include 'order_info.php' ?>
</div>
*/?>