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
<div class="personal-area__block">
	<div class="personal-area__block-inner">
		<div class="personal-area__block-title personal-area__block-title--indent-bottom"><?= $arResult['USER_INFO']['NAME'] . ' ' . $arResult['USER_INFO']['LAST_NAME']?></div>
		<div class="personal-area__personal-data-container">
			<form action="" id="personalDataUpdate" method="POST">
				<div class="personal-area__title-small">Учетные данные</div>
				<div class="input-styled__row input-styled__row--mb-indent">
					<div class="input-styled input-styled--mr">
						<label class="input-styled__label <?if ($arResult['USER_INFO']['LAST_NAME']) {?>input-styled__label-active<?}?>" for="input-text">Фамиилия</label>
						<input class="input-styled__input" type="text" id="input-text" name="LAST_NAME" value="<?= $arResult['USER_INFO']['LAST_NAME']?>">
					</div>
					<div class="input-styled">
						<label class="input-styled__label <?if ($arResult['USER_INFO']['NAME']) {?>input-styled__label-active<?}?>" for="input-text2">Имя</label>
						<input class="input-styled__input" type="text" id="input-text2" value="<?= $arResult['USER_INFO']['NAME']?>" name="NAME">
					</div>
				</div>
				<div class="input-styled__row">
					<div class="input-styled input-styled--mr">
						<label class="input-styled__label <?if ($arResult['USER_INFO']['SECOND_NAME']) {?>input-styled__label-active<?}?>" for="input-text3">Отчество</label>
						<input class="input-styled__input" type="text" id="input-text3" value="<?= $arResult['USER_INFO']['SECOND_NAME']?>" name="SECOND_NAME">
					</div>
					<div class="input-styled">
						<label class="input-styled__label <?if ($arResult['USER_INFO']['PERSONAL_BIRTHDAY']) {?>input-styled__label-active<?}?>" for="input-text4">Дата рождения</label>
						<input class="input-styled__input" type="text" id="input-text4" value="<?= $arResult['USER_INFO']['PERSONAL_BIRTHDAY'];?>" name="PERSONAL_BIRTHDAY">
					</div>
				</div>
				<div class="personal-area__gender-select">
					<div class="personal-area__gender-title">Пол:</div>
					<div class="radio-styled__row">
						<div class="radio-styled radio-styled--mr-indent">
							<input class="radio-styled__input" type="radio" name="PERSONAL_GENDER" <?if ($arResult['USER_INFO']['PERSONAL_GENDER'] == 'M'){?>checked<?}?> value="M">
							<div class="radio-styled__circle"></div>
							<div class="radio-styled__text">Мужской</div>
						</div>
						<div class="radio-styled">
							<input class="radio-styled__input" type="radio" name="PERSONAL_GENDER" <?if ($arResult['USER_INFO']['PERSONAL_GENDER'] == 'F'){?>checked<?}?> value="F">
							<div class="radio-styled__circle"></div>
							<div class="radio-styled__text">Женский</div>
						</div>
					</div>
				</div>
				<div class="input-styled__row">
					<div class="input-styled input-styled--mr">
						<label class="input-styled__label <?if ($arResult['USER_INFO']['PERSONAL_PHONE']) {?>input-styled__label-active<?}?>" for="input-phone">Номер телефона</label>
						<input class="input-styled__input" type="phone" id="input-phone" name="PERSONAL_PHONE" value="<?= $arResult['USER_INFO']['PERSONAL_PHONE'];?>">
					</div>
					<div class="input-styled">
						<label class="input-styled__label <?if ($arResult['USER_INFO']['EMAIL']) {?>input-styled__label-active<?}?>" for="input-email">E-mail</label>
						<input class="input-styled__input" type="email" id="input-email" value="<?= $arResult['USER_INFO']['EMAIL'];?>" name="EMAIL">
					</div>
				</div>
				<?if ($arResult['USER_INFO']['UF_PHONE_APPROVED']) {?>
				<div class="personal-area__tel-notification">
					<div class="personal-area__tel-notification-icon">
						<img src="<?= SITE_TEMPLATE_PATH;?>/assets/src/blocks/personal-area/assets/img/check-3.svg">
					</div>Номер подтвержден
				</div>
				<?}?>
				<input type="submit" class="button button--red button--red-width personal-area__btn-personal-data" value="Обновить данные">
				<input type="hidden" name="action" value="update_data">
			</form>

			
			<div class="personal-area__personal-data-row">
				<div class="personal-area__personal-data-box">
					<div class="personal-area__who-you-title personal-area__who-you-title--mb">Стали прорабом?</div>
					<div class="personal-area__who-you-text"><a class="personal-area__who-you-link" href="#">Подтвердите лицензию</a>и получайте <br> дополнительные скидки!</div>
				</div>
				<div class="personal-area__personal-data-box">
					<div class="personal-area__who-you-title personal-area__who-you-title--mb">Вы представитель организации?</div>
					<div class="personal-area__who-you-text"><a class="personal-area__who-you-link" href="#">Добавьте юридическое лицо</a>и получите доступ к специальным ценам в нашем магазине!</div>
				</div>
			</div>

			<div class="personal-area__title-small">Сохраненные адреса доставки</div>
			<?if ($arResult['USER_INFO']['PERSONAL_CITY']) {?>
			<div class="personal-area__address">Ваш город<a class="personal-area__address-link" href="#"><?= $arResult['USER_INFO']['PERSONAL_CITY'];?></a></div>
			<?}?>
			<?if ($arResult['USER_ADDRESSES']) {?>
			<div class="personal-area__select-country-box">
				<?foreach ($arResult['USER_ADDRESSES'] as $address) {?>
				<div class="select-country">
					<div class="select-country__title"><?= $address['NAME'];?></div>
					<div class="select-country__icons">
						<div class="select-country__icon select-country__icon--edit"></div>
						<div class="select-country__icon select-country__icon--delete" data-address="<?= $address['ID']?>" data-action="address_delete"></div>
					</div>
					<div class="select-country__status">
						<img class="select-country__status-image" src="<?= SITE_TEMPLATE_PATH;?>/assets/src/blocks/select-country/assets/img/ok.svg">
					</div>
					<input type="hidden">
				</div>
				<?}?>
				<a class="personal-area__select-country" href="javascript:void(0)" id="btnAddAddress">
					<div class="personal-area__select-country-icon"></div>Добавить новый адрес</a>
			</div>
			<?}?>
		</div>
	</div>
</div>
