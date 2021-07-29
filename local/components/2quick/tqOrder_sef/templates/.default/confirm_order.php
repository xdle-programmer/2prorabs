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

<form class="basket form-check" id="order-3">
	<div class="basket__products">
		<div class="order-status"><a class="order-status__item order-status__item--fill" href="#">
			<div class="order-status__item-number">1</div>
			<div class="order-status__item-name">Доставка</div></a>
			<svg class="order-status__separator">
			<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#long-arrow"></use>
			</svg><a class="order-status__item order-status__item--fill" href="#">
			<div class="order-status__item-number">2</div>
			<div class="order-status__item-name">Оплата</div></a>
			<svg class="order-status__separator">
			<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#long-arrow"></use>
			</svg>
			<div class="order-status__item order-status__item--active">
			<div class="order-status__item-number">3</div>
			<div class="order-status__item-name">Подтверждение</div>
			</div>
		</div>
		<div class="order-form">
		<div class="order-form__result">
		<div class="order-form__result-item">
		<div class="order-form__result-item-title">Получатель</div>
		<div class="order-form__result-item-desc">
		<div class="order-form__result-item-desc-text">Устинов Юрий Викторович, +996 (559) 950 725</div><a class="order-form__result-item-desc-button" href="#">Изменить</a>
		</div>
		</div>
		<div class="order-form__result-item">
		<div class="order-form__result-item-title">Доставка</div>
		<div class="order-form__result-item-desc">
		<div class="order-form__result-item-desc-text">Курьерская доставка</div><a class="order-form__result-item-desc-button" href="#">Изменить</a>
		</div>
		</div>
		<div class="order-form__result-item">
		<div class="order-form__result-item-title">Способ оплаты</div>
		<div class="order-form__result-item-desc">
		<div class="order-form__result-item-desc-text">Электронной картой онлайн</div><a class="order-form__result-item-desc-button" href="#">Изменить</a>
		</div>
		</div>
		</div>
		<div class="order-form__comment">
		<div class="placeholder form-check__field" data-elem="textarea" data-rule="input-empty">
		<textarea class="input input--textarea placeholder__input" placeholder="Комментарий к заказу"></textarea>
		<div class="placeholder__item">Комментарий к заказу</div>
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
	<div class="basket__order-actions-main-button form-check__button">Оплатить</div>
	</div>
</form>

		
<?/*
<div class="basket-products__grid">
    <form class="basket-products__container" id="save_order">
        <div class="basket-products__title"><?=$APPLICATION->ShowTitle(false)?></div>
        <?include 'tabs.php';?>
        <div class="basket-products__title basket-products__title--medium-center basket-products__title--mb">Подтверждение</div>
        <div class="basket-products__registration-inner">
            <div class="basket-products__registration-title basket-products__registration-title--mb">Проверьте правильность оформления</div>
            <div class="basket-products__confirmation-item">
                <div class="basket-products__confirmation-title">Получатель:</div>
                <div class="basket-products__confirmation-data">
                    <div class="basket-products__confirmation-text">
                        <?=sprintf('%s %s',$arResult['SAVED']['delivery']['LAST_NAME'],$arResult['SAVED']['delivery']['NAME'])?> <br>
                        <?=$arResult['SAVED']['delivery']['PHONE']? sprintf('Тел.: %s<br>',$arResult['SAVED']['delivery']['PHONE']):''?>
                        <?=$arResult['SAVED']['delivery']['EMAIL']? sprintf('E-mail.: %s<br>',$arResult['SAVED']['delivery']['EMAIL']):''?>
                    </div><a class="basket-products__confirmation-link" href="<?= $arResult['TABS']['0']['URL'] ?>">Изменить</a>
                </div>
            </div>

            <div class="basket-products__confirmation-item">
                <div class="basket-products__confirmation-title">Способ доставки:</div>
                <div class="basket-products__confirmation-data">
                    <?if($arResult['DELIVERIES'][$arResult['SAVED']['delivery']['delivery_id']]){?>
                    <div class="basket-products__confirmation-text"><?=$arResult['DELIVERIES'][$arResult['SAVED']['delivery']['delivery_id']]['NAME']?> <br>
                        <?if($arResult['DELIVERIES'][$arResult['SAVED']['delivery']['delivery_id']]['STORES'][$arResult['SAVED']['delivery']['POINT']]){?>
                        <div class="basket-products__confirmation-address"><?=$arResult['DELIVERIES'][$arResult['SAVED']['delivery']['delivery_id']]['STORES'][$arResult['SAVED']['delivery']['POINT']]['NAME']?></div>
                            <?if($arResult['DELIVERIES'][$arResult['SAVED']['delivery']['delivery_id']]['STORES'][$arResult['SAVED']['delivery']['POINT']]['PROPERTIES']['DELIVERY_DAY']['VALUE']){
                                $date = new DateTime(date('d.m.Y'));
                                $date->add(new DateInterval('P'.intval($arResult['DELIVERIES'][$arResult['SAVED']['delivery']['delivery_id']]['STORES'][$arResult['SAVED']['delivery']['POINT']]['PROPERTIES']['DELIVERY_DAY']['VALUE']).'D'));
                                $day = FormatDate('l',MakeTimeStamp($date->format('d.m.Y h:i:s')))
                                ?>
                                Можно забрать <?if($day == 'Вторник')echo 'во';else echo 'в'?> <?=strtolower($day)?>, <?=FormatDate(' d F',MakeTimeStamp($date->format('d.m.Y h:i:s')))?>, <?=$arResult['DELIVERIES'][$arResult['SAVED']['delivery']['delivery_id']]['PRICE_FORMATED']?>
                            <?}?>
                        <div class="basket-products__confirmation-pay"><?=$arResult['DELIVERIES'][$arResult['SAVED']['delivery']['delivery_id']]['STORES'][$arResult['SAVED']['delivery']['POINT']]['PREVIEW_TEXT']?></div>
                        <?}else{?>
                            <?=$arResult['SAVED']['delivery']['CITY']? sprintf('Адрес: %s<br>',$arResult['SAVED']['delivery']['CITY']):''?>
                            <?//=$arResult['SAVED']['delivery']['STREET']? sprintf('Улица.: %s<br>',$arResult['SAVED']['delivery']['STREET']):''?>
                            <?//=$arResult['SAVED']['delivery']['HOUSE']? sprintf('Дом.: %s<br>',$arResult['SAVED']['delivery']['HOUSE']):''?>
                            <?//=$arResult['SAVED']['delivery']['APARTMENT']? sprintf('Квартира.: %s<br>',$arResult['SAVED']['delivery']['APARTMENT']):''?>
                        <?}?>
                    </div>
                    <?}?>
                    <a class="basket-products__confirmation-link" href="<?= $arResult['TABS']['0']['URL'] ?>">Изменить</a>
                </div>
            </div>

            <div class="basket-products__confirmation-item">
                <div class="basket-products__confirmation-title">Способ оплаты:</div>
                <div class="basket-products__confirmation-data">
                    <div class="basket-products__confirmation-text"><?=$arResult['PAYMENT'][$arResult['SAVED']['payment']['payment']]['NAME']?>
                        <div class="basket-products__confirmation-pay"><?=$arResult['PAYMENT'][$arResult['SAVED']['payment']['payment']]['DESCRIPTION']?></div>
                    </div><a class="basket-products__confirmation-link" href="<?= $arResult['TABS']['1']['URL'] ?>">Изменить</a>
                </div>
            </div>

            <div class="basket-products__confirmation-item">
                <div class="basket-products__confirmation-title">Комментарий к заказу:</div>
                <div class="basket-products__confirmation-data">
                    <div class="basket-products__confirmation-text">
                        <textarea class="checkout__comment-textarea" rows="4" name="comment"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <button class="basket-products__next-button">Подтвердить
            <div class="basket-products__next-button-icon"></div>
        </button>
        <div class="tq_errors"></div>

    </form>
    <?include 'order_info.php'?>
</div>
*/?>