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
		<div class="order-status">
			<a class="order-status__item order-status__item--fill" href="/order/">
				<div class="order-status__item-number">1</div>
				<div class="order-status__item-name">Доставка</div>
			</a>
			<svg class="order-status__separator">
				<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#long-arrow"></use>
			</svg>
			<a class="order-status__item order-status__item--fill" href="/order/payment/">
				<div class="order-status__item-number">2</div>
				<div class="order-status__item-name">Оплата</div>
			</a>
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
						<div class="order-form__result-item-desc-text">
						<?=sprintf('%s %s',$arResult['SAVED']['delivery']['LAST_NAME'],$arResult['SAVED']['delivery']['NAME'])?>, 
						<?=$arResult['SAVED']['delivery']['PHONE']? sprintf('Тел.: %s<br>',$arResult['SAVED']['delivery']['PHONE']):''?>
                        <?=$arResult['SAVED']['delivery']['EMAIL']? sprintf('E-mail.: %s<br>',$arResult['SAVED']['delivery']['EMAIL']):''?>
						</div>
						<a class="order-form__result-item-desc-button" href="/order/">Изменить</a>
					</div>
				</div>
				<div class="order-form__result-item">
					<div class="order-form__result-item-title">Доставка</div>
					<div class="order-form__result-item-desc">
				
					<?if($arResult['DELIVERIES'][$arResult['SAVED']['delivery']['delivery_id']]){?>
						
						<div class="order-form__result-item-desc-text">
						<?if($arResult['DELIVERIES'][$arResult['SAVED']['delivery']['delivery_id']]['STORES'][$arResult['SAVED']['delivery']['POINT']]){?>
						
							<?=$arResult['DELIVERIES'][$arResult['SAVED']['delivery']['delivery_id']]["NAME"]?>
							<br/>
							<?if($arResult['DELIVERIES'][$arResult['SAVED']['delivery']['delivery_id']]['STORES'][$arResult['SAVED']['delivery']['POINT']]['PROPERTIES']['DELIVERY_DAY']['VALUE']){
								$date = new DateTime(date('d.m.Y'));
								$date->add(new DateInterval('P'.intval($arResult['DELIVERIES'][$arResult['SAVED']['delivery']['delivery_id']]['STORES'][$arResult['SAVED']['delivery']['POINT']]['PROPERTIES']['DELIVERY_DAY']['VALUE']).'D'));
								$day = FormatDate('l',MakeTimeStamp($date->format('d.m.Y h:i:s')))
								?>
								
								<?=$arResult['DELIVERIES'][$arResult['SAVED']['delivery']['delivery_id']]['STORES'][$arResult['SAVED']['delivery']['POINT']]['NAME']?>
								<br/>
								
								Можно забрать 
								<?if($day == 'Вторник')echo 'во';else echo 'в'?> <?=strtolower($day)?>, 
								<?=FormatDate(' d F',MakeTimeStamp($date->format('d.m.Y h:i:s')))?> 
								<?//=$arResult['DELIVERIES'][$arResult['SAVED']['delivery']['delivery_id']]['PRICE_FORMATED']?>
							<?}?>
							
						<?}else{?>
							<?=$arResult['DELIVERIES'][$arResult['SAVED']['delivery']['delivery_id']]["NAME"]?>
							<br/>
							<?=$arResult['SAVED']['delivery']['STREET']? sprintf('Адрес: %s<br>',$arResult['SAVED']['delivery']['STREET']):''?>
						<?}?>
						</div>
					<?}?>
					
						<a class="order-form__result-item-desc-button" href="/order/">Изменить</a>
					</div>
				</div>
				<div class="order-form__result-item">
					<div class="order-form__result-item-title">Способ оплаты</div>
					<div class="order-form__result-item-desc">
						<div class="order-form__result-item-desc-text"><?=$arResult['PAYMENT'][$arResult['SAVED']['payment']['payment']]['NAME']?></div>
						<a class="order-form__result-item-desc-button" href="/order/payment/">Изменить</a>
					</div>
				</div>
			</div>
			<div class="order-form__comment">
				<div class="placeholder form-check__field" data-elem="textarea" data-rule="input-empty">
					<textarea name="comment" class="input input--textarea placeholder__input" placeholder="Комментарий к заказу"></textarea>
					<div class="placeholder__item">Комментарий к заказу</div>
				</div>
			</div>
			<div id="tq_errors"></div>
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
						<div class="basket__order-desc-row-value"><?=$arResult["INFO_ORDER"]["FORMATED_BASE_PRICE"]?></div>
					</div>
				</div>
			</div>
		</div>
		<div onclick="submitOrderForm3();" class="basket__order-actions-main-button form-check__button">Оплатить</div>
	</div>
</form>
