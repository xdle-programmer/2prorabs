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

<div id="tq_register_container">
    <div class="modal" id="login">
        <form id="tq_auth_email">
            <div class="modal__content form-check">

                <input type="hidden" name="back_url" value="">
                <div class="modal__header">
                    <div class="modal__header-title">Вход</div>
                    <div class="modal__header-close" data-modal-close>
                        <svg class="modal__header-close-icon">
                            <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#close"></use>
                        </svg>
                    </div>
                </div>
                <div class="modal__content-items">
                    <div class="modal__content-item">
                        <div class="placeholder form-check__field" data-elem="input" data-rule="input-empty">
                            <input class="input placeholder__input" placeholder="Ваш e-mail" type="email" id="input-auth-email" name="EMAIL" required>
                            <div class="placeholder__item" for="input-auth-email">Ваш e-mail</div>
                        </div>
                    </div>
                    <div class="modal__content-item">
                        <div class="placeholder form-check__field" data-elem="input" data-rule="input-empty">
                            <input class="input placeholder__input" placeholder="Пароль" type="password" id="input-auth-password" name="PASSWORD" required>
                            <div class="placeholder__item" for="input-auth-password">Пароль</div>
                        </div>
                    </div>
                    <? /*
					<div class="input-styled input-styled--indent">
						<div class="g-recaptcha" data-sitekey="6LdOWNYZAAAAAHiY6FC-IrK-hDGYlekgyVq3MLoj"></div>
					</div>
					*/ ?>
                    <div class="tq_error tq_error_auth"></div>

                    <div class="modal__content-item">
                        <div onclick="modalUserAuth()" class="modal__button button form-check__button  modal-registration__button-red">Войти</div>
                    </div>
                    <div class="modal__content-item">
                        <div class="modal__button button button--invert" data-modal-open='register'>Зарегистрироваться</div>
                    </div>

                </div>
                <div class="modal__footer">
                    <div class="modal__content-item">
                        <div class="modal__link">Не помню пароль</div>
                    </div>
                    <a href="/privacy-policy/" class="modal__link">Политика конфиденцальности</a>
                </div>
            </div>
        </form>
    </div>


    <div class="modal" id="register">
        <form id="tq_form_registration">

            <input type="hidden" name="back_url" value="">
            <div class="modal__content form-check">
                <div class="modal__header">
                    <div class="modal__header-title">Регистрация</div>
                    <div class="modal__header-close" data-modal-close>
                        <svg class="modal__header-close-icon">
                            <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#close"></use>
                        </svg>
                    </div>
                </div>
                <div class="modal__content-items">
                    <div class="modal__content-item">
                        <div class="placeholder form-check__field" data-elem="input" data-rule="input-empty">
                            <input class="input placeholder__input" placeholder="Имя" id="input-reg-name" name="NAME" value="" required>
                            <div class="placeholder__item" for="input-reg-name">Имя</div>
                        </div>
                    </div>
                    <div class="modal__content-item">
                        <div class="placeholder form-check__field" data-elem="input" data-rule="input-empty">
                            <input class="input placeholder__input" placeholder="Телефон" type="tel" name="PERSONAL_PHONE" id="input-reg-phone" required>
                            <div class="placeholder__item" for="input-reg-phone">Телефон</div>
                        </div>
                    </div>
                    <div class="modal__content-item">
                        <div class="placeholder form-check__field" data-elem="input" data-rule="input-empty">
                            <input class="input placeholder__input" placeholder="E-mail" type="email" name="EMAIL" id="input-reg-email" required>
                            <div class="placeholder__item" for="input-reg-email">E-mail</div>
                        </div>
                    </div>
                    <div class="modal__content-item">
                        <div class="placeholder form-check__field" data-elem="input" data-rule="input-empty">
                            <input class="input placeholder__input" placeholder="Пароль" type="password" name="PASSWORD" id="input-reg-password" required>
                            <div class="placeholder__item" for="input-reg-password">Пароль</div>
                        </div>
                    </div>
                    <div class="modal__content-item">
                        <div class="modal__content-item-captcha">
                            <div class="modal__content-item-captcha-item">
                        <div class="g-recaptcha" data-sitekey="6LdOWNYZAAAAAHiY6FC-IrK-hDGYlekgyVq3MLoj"></div>
                        </div>
                        </div>
                    </div>
                    <div class="tq_error tq_error_reg"></div>
                    <div class="modal__content-item">
                        <label class="checkbox">
                            <input class="checkbox__input" type="checkbox" name="confirm" value="1">
                            <span class="checkbox__item">
								<svg class="checkbox__icon">
								  <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#check"></use>
								</svg>
								<span class="checkbox__text">Я согласен на обработку Персональных данных</span>
							</span>
                        </label>
                    </div>
                    <div class="modal__content-item">
                        <div onclick="modalUserReg()" class="modal__button button button--invert form-check__button modal-registration__button-red">Зарегистрироваться</div>
                    </div>
                </div>
                <div class="modal__footer">
                    <a href="/privacy-policy/" class="modal__link">Политика конфиденцальности</a>
                </div>
            </div>
        </form>
    </div>
</div>
