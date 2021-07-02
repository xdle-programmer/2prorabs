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

?>

<div class="modal-overlay"></div>
<div class="modal-position">
    <div class="reset-password">
        <div class="reset-password__close"><img src="<?=SITE_TEMPLATE_PATH?>/assets/src/blocks/modals/reset-password/assets/img/close.svg"></div>
        <div class="reset-password__title">Восстановление пароля</div>
        <div class="reset-password__text">Введите свой e-mail, система автоматически сгенерирует новый пароль для вашей учетной записи и вышлет в письме</div>
        <form class="reset-password__box" id="forgot_form">
            <div class="input-styled">
                <label class="input-styled__label" for="input-forgot-email">Ваш e-mail</label>
                <input class="input-styled__input" type="email" id="input-forgot-email" name="EMAIL" required>
            </div>
            <div class="tq_error"></div>
            <button class="button button--red button--red-width reset-password__button">Восстановить пароль</button>
            <div class="reset-password__checkbox">
                <div class="checkbox checkbox--align">
                    <input class="checkbox__input" type="checkbox" required value="Y">
                    <div class="checkbox__square"></div>
                    <div class="checkbox__text checkbox__text--grey-small">Я даю согласие на обработку своих персональных данных согласно<a class="checkbox__right-link" href="#">политике конфиденциальности</a></div>
                </div>
            </div>
        </form>
    </div>
</div>
