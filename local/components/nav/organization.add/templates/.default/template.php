<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arResult */
?>
<div class="modal-position">
    <div class="organization-add-popup modal-registration-container">
        <div class="modal-registration" id="organizationAddPopup">
            <div class="modal-registration__close">
                <img src="<?=SITE_TEMPLATE_PATH?>/assets/src/blocks/modals/modal-registration/assets/img/close-mod.svg">
            </div>
            <div class="modal-registration__box modal-registration__box--active">
                <div class="modal-registration__sign-block modal-registration__sign-block--active">
                    <div class="modal-registration__sign-text" style="font-size: 22px; font-weight: bolder">Добавление компании</div>
                    <form class="modal-registration__inner organization-add-popup__form" id="addCompany">
                        <div class="input-styled input-styled__reg">
                            <label class="input-styled__label" for="input-reg-name">Название</label>
                            <input class="input-styled__input" type="text" id="input-reg-name" name="NAME" value="" required>
                        </div>
                        <div class="input-styled input-styled__reg">
                            <label class="input-styled__label" for="input-reg-inn">ИНН</label>
                            <input class="input-styled__input" type="text" id="input-reg-inn" name="INN" value="" required>
                        </div>
                        <div class="input-styled input-styled__reg">
                            <label class="input-styled__label" for="input-reg-jur-address">Юридичечкий адрес</label>
                            <input class="input-styled__input" type="text" id="input-reg-jur-address" name="JUR_ADDRESS" value="" required>
                        </div>
                        <div class="input-styled input-styled__reg">
                            <label class="input-styled__label" for="input-reg-address">Фактический адрес</label>
                            <input class="input-styled__input" type="text" id="input-reg-address" name="DELIVERY_ADDRESS" value="" required>
                        </div>
                        <div class="input-styled input-styled__reg">
                            <label class="input-styled__label" for="input-reg-ogrn">ОКПО</label>
                            <input class="input-styled__input" type="text" id="input-reg-ogrn" name="OGRN" value="" required>
                        </div>
                        <div class="input-styled input-styled__reg">
                            <label class="input-styled__label" for="input-reg-head">Директор</label>
                            <input class="input-styled__input" type="text" id="input-reg-head" name="HEAD" value="" required>
                        </div>
                        <div class="input-styled input-styled__reg">
                            <label class="input-styled__label" for="input-reg-account">Расчетный счет</label>
                            <input class="input-styled__input" type="text" id="input-reg-account" name="ACCOUNT" value="" required>
                        </div>
                        <div class="input-styled input-styled__reg">
                            <label class="input-styled__label" for="input-reg-bik">БИК банка</label>
                            <input class="input-styled__input" type="text" id="input-reg-bik" name="BANK_BIK" value="" required>
                        </div>
                        <div class="input-styled input-styled__reg">
                            <label class="input-styled__label" for="input-reg-cor-account">Корр. счет</label>
                            <input class="input-styled__input" type="text" id="input-reg-cor-account" name="CORP_ACCOUNT" value="" required>
                        </div>
                        <div class="input-styled input-styled__reg">
                            <label class="input-styled__label" for="input-reg-bank-name">Наименование банка</label>
                            <input class="input-styled__input" type="text" id="input-reg-bank-name" name="BANK_NAME" value="" required>
                        </div>
                        <input type="hidden" value="addCompany" name="action">
                        <button class="button button--red button--red-width modal-registration__button-red">Добавить</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
