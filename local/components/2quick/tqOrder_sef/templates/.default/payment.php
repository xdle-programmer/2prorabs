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

<!--b><?print_r($arResult);?></b-->
<form class="basket form-check" id="order-2" data-tab="payment" data-next="<?=$arResult['TABS']['2']['URL']?>">
	<div class="basket__products">
		<div class="order-status">
			<a class="order-status__item order-status__item--fill" href="#">
				<div class="order-status__item-number">1</div>
				<div class="order-status__item-name">Доставка</div>
			</a>
			<svg class="order-status__separator">
				<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#long-arrow"></use>
			</svg>
			<div class="order-status__item order-status__item--active">
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
				<div class="order-form__payment">
				<?foreach ($arResult['PAYMENT'] as $arPayment){?>
					<label class="order-form__radio order-form__radio--big form-check__field" data-elem="input" data-rule="radio-required">
						<input class="order-form__radio-input" type="radio" value="<?=$arPayment['ID']?>" name="payment"<?if($arPayment['CHECKED']=='Y')echo ' checked'?>>
						<span class="order-form__radio-button">
							<span class="order-form__radio-button-icon"></span>
							<span class="order-form__radio-button-text">
								<?=$arPayment['NAME']?>
								
								<span class="order-form__radio-button-desc">
								<?=$arPayment['DESCRIPTION']?>
								</span>
							</span>
						</span>
					</label>
				<?}?>
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
						<div class="basket__order-desc-row-value"><?=$arResult["INFO_ORDER"]["FORMATED_BASE_PRICE"]?></div>
					</div>
				</div>
			</div>
		</div>
		<a href="/order/confirm_order/" class="basket__order-actions-main-button form-check__button">Далее</a>
	</div>
</form>
		
		
<?/*
<div class="basket-products__grid">
    <form class="basket-products__container" id="tq_order" data-tab="payment" data-next="<?= $arResult['TABS']['2']['URL'] ?>">
        <div class="basket-products__title"><?=$APPLICATION->ShowTitle(false)?></div>
        <?include 'tabs.php';?>
        <div class="basket-products__title basket-products__title--medium-center basket-products__title--mb">Оплата</div>
        <div class="basket-products__registration-inner">
            <div class="basket-products__registration-title basket-products__registration-title--mb">Выберите способ оплаты</div>
            <?foreach ($arResult['PAYMENT'] as $arPayment){?>
                <div class="basket-products__radio-box">
                    <div class="basket-products__radio-inner">
                        <input class="basket-products__radio-input" type="radio" name="payment" value="<?=$arPayment['ID']?>" name="payment"<?if($arPayment['CHECKED']=='Y')echo ' checked'?>>
                        <div class="basket-products__radio-circle"></div>
                        <div class="basket-products__radio-text"><?=$arPayment['NAME']?></div>
                    </div>
                    <div class="basket-products__radio-info">
                        <?=$arPayment['DESCRIPTION']?>
                    </div>
                </div>

            <?}?>


        </div>
        <button class="basket-products__next-button">Далее
            <div class="basket-products__next-button-icon"></div>
        </button>
        <div class="tq_errors"></div>

    </form>
    <?include 'order_info.php'?>
</div>
*/?>
