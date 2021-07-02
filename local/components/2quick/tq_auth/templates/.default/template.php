<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Page\Asset;

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

Asset::getInstance()->addCss($templateFolder . "/style.css");
Asset::getInstance()->addJs($templateFolder . "/script.js");
?>
<div class="modal-overlay"></div>
<div class="modal-position">
    <div class="modal-registration-container">
        <div class="modal-registration" id="tq_register_container">
            <div class="modal-registration__close"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/src/blocks/modals/modal-registration/assets/img/close-mod.svg"></div>
            <div class="modal-registration__inner">
                <div class="modal-registration__tabs">
                    <div class="modal-registration__tab authTab modal-registration__tab--active">Вход</div>
                    <div class="modal-registration__tab regTab">Регистрация</div>
                </div>
                <div class="modal-registration__box modal-registration__box--active">
                    <?/*
<form class="modal-registration__sign-block modal-registration__sign-block--active" id="tq_auth_phone">
                        <input type="hidden" name="back_url" value="">
                        <div class="modal-registration__sign-text">Мы пришлем SMS с кодом для подтверждения на ваш номер телефона</div>
                        <div class="modal-registration__inner">
                            <div class="input-styled ">
                                <label class="input-styled__label" for="input-phone">Введите ваш телефон</label>
                                <input class="input-styled__input" type="tel" name="PHONE" id="input-phone" required>
                            </div>
                            <?if($arResult["CAPTCHA_CODE"]):?>
                    <div class="modal-registration__captcha">
                        <input type="hidden" name="captcha_sid" value="<?echo $arResult[" CAPTCHA_CODE"]?>"/>
                        <div class="modal-registration__captcha-text input-styled--indent">Подтвердите, что вы не робот</div>
                        <div class="input-styled--indent"><img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult[" CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /></div>
                        <div class="input-styled--indent"><input class="input-styled__input" type="text" required name="captcha_word" maxlength="50" value="" size="15" /></div>
                    </div>
                    <?endif;?>
                    <div class="tq_error"></div>
                    <button class="button button--red button--red-width modal-registration__button-red">Получить код</button>
                    <a class="modal-registration__sign-link" href="#" id="signEmail">Войти по почте</a>
                </div>
                </form>*/?>
                <div class="modal-registration__sign-block modal-registration__sign-block--active">
                    <div class="modal-registration__sign-text">Только для зарегистрированных пользователей</div>
                    <form class="modal-registration__inner" id="tq_auth_email">
                        <input type="hidden" name="back_url" value="">
                        <div class="input-styled input-styled--indent">
                            <label class="input-styled__label" for="input-email">Ваш e-mail</label>
                            <input class="input-styled__input" type="email" id="input-email" name="EMAIL" required>
                        </div>
                        <div class="input-styled__password-block">
                            <div class="input-styled input-styled--indent">
                                <label class="input-styled__label" for="input-phone4">Пароль</label>
                                <input class="input-styled__input" type="password" id="input-phone4" name="PASSWORD" required>
                                <div class="input-styled__pass-icon"></div>
                            </div><a class="input-styled__remember-password" href="javascript:void(0)" id="buttonReset">Забыли пароль?</a>
                        </div>
                        <div class="input-styled input-styled--indent">
                            <div class="g-recaptcha" data-sitekey="6LdOWNYZAAAAAHiY6FC-IrK-hDGYlekgyVq3MLoj"></div>
                        </div>
                        <?/*if($arResult["CAPTCHA_CODE"]):?>
                        <div class="modal-registration__captcha">
                            <input type="hidden" name="captcha_sid" value="<?echo $arResult[" CAPTCHA_CODE"]?>"/>
                            <div class="modal-registration__captcha-text input-styled--indent">Подтвердите, что вы не робот</div>
                            <div class="input-styled--indent"><img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult[" CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /></div>
                            <div class="input-styled--indent"><input class="input-styled__input" type="text" required name="captcha_word" maxlength="50" value="" size="15" /></div>
                        </div>
                        <?endif;*/?>
                        <div class="tq_error"></div>
                        <button class="button button--red button--red-width modal-registration__button-red">Войти</button>
                        <?/* <a class="modal-registration__sign-link" href="#" id="signTel">Войти по номеру телефона</a>*/?>
                    </form>
                </div>
            </div>
            <form class="modal-registration__box" id="tq_form_registration">
                <input type="hidden" name="back_url" value="">
                <div class="modal-registration__input-box">
                    <div class="input-styled input-styled__reg">
                        <label class="input-styled__label" for="input-reg-name">Ваше ФИО</label>
                        <input class="input-styled__input" type="text" id="input-reg-name" name="NAME" value="" required>
                    </div>
                    <div class="input-styled input-styled__reg">
                        <label class="input-styled__label" for="input-reg-phone">Телефон</label>
                        <input class="input-styled__input" type="tel" name="PERSONAL_PHONE" id="input-reg-phone" data-phone-mask required>
                    </div>
                    <div class="input-styled input-styled__reg">
                        <label class="input-styled__label" for="input-reg-email">E-mail</label>
                        <input class="input-styled__input" type="email" name="EMAIL" id="input-reg-email" required>
                    </div>
                    <div class="input-styled input-styled__reg">
                        <label class="input-styled__label" for="input-reg-password">Пароль</label>
                        <input class="input-styled__input" type="password" name="PASSWORD" id="input-reg-password" required>
                        <div class="input-styled__pass-icon"></div>
                    </div>
                </div>
                <?/*<div class="modal-registration__checkbox">
                        <div class="checkbox">
                            <input class="checkbox__input" type="checkbox" name="UF_PRORAB" value="1">
                            <div class="checkbox__square"></div>
                            <div class="checkbox__text">Я прораб</div>
                        </div>
                    </div>*/?>
                 <div class="modal-registration__organization-container"></div>

                <div class="input-styled input-styled--indent">
                    <div class="g-recaptcha" data-sitekey="6LdOWNYZAAAAAHiY6FC-IrK-hDGYlekgyVq3MLoj"></div>
                </div>
                <?/*if($arResult["CAPTCHA_CODE"]):?>
                <div class="modal-registration__captcha">
                    <input type="hidden" name="captcha_sid" value="<?echo $arResult[" CAPTCHA_CODE"]?>"/>
                    <div class="modal-registration__captcha-text input-styled--indent">Подтвердите, что вы не робот</div>
                    <div class="input-styled--indent"><img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult[" CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /></div>
                    <div class="input-styled--indent"><input class="input-styled__input" type="text" required name="captcha_word" maxlength="50" value="" size="15" /></div>
                </div>
                <?endif;*/?>
                <div class="modal-registration__checkbox-rights">
                    <div class="checkbox">
                        <input class="checkbox__input" type="checkbox" required name="confirm" value="1">
                        <div class="checkbox__square"></div>
                        <div class="checkbox__text checkbox__text--grey-small">Я даю согласие на обработку своих персональных данных согласно<a class="checkbox__right-link" href="#">политике конфиденциальности</a></div>
                    </div>
                </div>
                <div class="tq_error"></div>
                <button class="button button--red button--red-width modal-registration__button-red">Зарегистрироваться</button>
            </form>

            <div class="modal-registration__organization-hidden-container hidden">
                <div class="modal-registration__add-company-block" style="display: block;">
                    <div class="input-styled input-styled__reg">
                        <label class="input-styled__label" for="input-company-name">Название</label>
                        <input class="input-styled__input" type="text" id="input-company-name" name="ORG_NAME" required>
                    </div>

                    <div class="input-styled input-styled__reg">
                        <label class="input-styled__label" for="reg-inn">ИНН</label>
                        <input class="input-styled__input" type="text" id="reg-inn" name="ORG_INN" required>
                    </div>

                    <div class="input-styled input-styled__reg">
                        <label class="input-styled__label" for="reg-jur-addr">Адрес</label>
                        <input class="input-styled__input" type="text" id="reg-jur-addr" name="ORG_JUR_ADDRESS" required>
                    </div>

                    <div class="input-styled input-styled__reg">
                        <label class="input-styled__label" for="reg-delivery-addr">Адрес доставки</label>
                        <input class="input-styled__input" type="text" id="reg-delivery-addr" name="ORG_DELIVERY_ADDRESS" required>
                    </div>

                    <div class="input-styled input-styled__reg">
                        <label class="input-styled__label" for="reg-orgn">ОГРН</label>
                        <input class="input-styled__input" type="text" id="reg-ogrn" name="ORG_OGRN" required>
                    </div>

                    <div class="input-styled input-styled__reg">
                        <label class="input-styled__label" for="reg-head">Директор</label>
                        <input class="input-styled__input" type="text" id="reg-head" name="ORG_HEAD" required>
                    </div>

                    <div class="input-styled input-styled__reg">
                        <label class="input-styled__label" for="reg-account">Расчётный счёт</label>
                        <input class="input-styled__input" type="text" id="reg-account" name="ORG_ACCOUNT" required>
                    </div>

                    <div class="input-styled input-styled__reg">
                        <label class="input-styled__label" for="reg-bik">БИК банка</label>
                        <input class="input-styled__input" type="text" id="reg-bik" name="ORG_BANK_BIK" required>
                    </div>

                    <div class="input-styled input-styled__reg">
                        <label class="input-styled__label" for="reg-corp-account">Корр. счёт</label>
                        <input class="input-styled__input" type="text" id="reg-bik" name="ORG_CORP_ACCOUNT" required>
                    </div>

                    <div class="input-styled input-styled__reg">
                        <label class="input-styled__label" for="reg-bank-name">Наименование банка</label>
                        <input class="input-styled__input" type="text" id="reg-bank-name" name="ORG_BANK_NAME" required>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?/* <div class="modal-registration__code" id="tq_confirm_code">
            <div class="modal-registration__code-inner">
                <div class="modal-registration__code-title">Введите код</div>
                <div class="modal-registration__code-text">Мы отправили код подтверждения на номер <br> <span id="sended_phone"></span></div>
                <div class="modal-registration__code-container">
                    <input class="modal-registration__code-input" type="text" value="">
                </div>
                <div class="tq_error"></div>
                <div class="modal-registration__code-timer">Получить новый код можно через <span id="tq_timer"></span></div>
                <div id="repeat_send"></div>
            </div>
        </div>*/?>
</div>
</div>