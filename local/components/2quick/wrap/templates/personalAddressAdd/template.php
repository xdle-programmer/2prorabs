<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<form action="" id="personalAddressAdd">
	<input type="hidden" name="action" value="address_add">
	<div class="modal__block">
		<div class="modal__title">Добавьте адрес</div>
		<div class="modal__close">
			<img src="<?= SITE_TEMPLATE_PATH;?>/assets/src/blocks/modals/assets/img/close.svg"></div>
		<div class="modal__inner">
			<div class="modal__box">
				<div class="input-styled__container">
					<div class="input-styled input-styled--indent">
						<label class="input-styled__label" for="input-city">Город</label>
						<input class="input-styled__input" type="text" id="input-city" name="CITY" required>
					</div>
					<div class="input-styled input-styled--indent">
						<label class="input-styled__label" for="input-town">Улица</label>
						<input class="input-styled__input" type="text" id="input-town" name="STREET" required>
					</div>
				</div>
				<div class="input-styled__row-style">
					<div class="input-styled input-styled--mr-indent">
						<label class="input-styled__label" for="input-house">Дом/стр.</label>
						<input class="input-styled__input" type="text" id="input-house" name="HOUSE" required>
					</div>
					<div class="input-styled">
						<label class="input-styled__label" for="input-apartment">Корп.</label>
						<input class="input-styled__input" type="text" id="input-apartment" name="HOUSING">
					</div>
				</div>
			</div>
			<div class="modal__checkbox">
				<div class="checkbox">
					<input class="checkbox__input" type="checkbox" required>
					<div class="checkbox__square"></div>
					<div class="checkbox__text checkbox__text--grey-small">Я даю согласие на обработку своих персональных данных согласно<a class="checkbox__right-link" href="/privacy-policy/" target="_blank">политике конфиденциальности</a>
					</div>
				</div>
			</div>
			<input type="submit" class="button button--red button--red-width modal__button" value="Добавить">
		</div>
	</div>
</form>