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

<div class="modal" id="remember">
	<form id="forgot_form">
		<div class="modal__content form-check">
			<input type="hidden" name="back_url" value="">
			<div class="modal__header">
				<div class="modal__header-title">Восстановление пароля</div>
				<div class="modal__header-close" data-modal-close>
					<svg class="modal__header-close-icon">
						<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#close"></use>
					</svg>
				</div>
			</div>
			<div class="modal__content-items">
				<div class="modal__content-item">
					<div class="placeholder form-check__field" data-elem="input" data-rule="input-empty">
						<input id="input-forgot-email" name="EMAIL" class="input placeholder__input" placeholder="Ваш e-mail" type="email" required>
						<div class="placeholder__item" for="input-auth-email">Ваш e-mail</div>
					</div>
				</div>
				<div class="tq_error tq_error_forgotpass"></div>
				<div class="modal__content-item">
					<div onclick="modalForgotPass()" class="modal__button button form-check__button  modal-registration__button-red">Выслать новый пароль</div>
				</div>
			</div>
			<div class="modal__footer">
				<a href="/privacy-policy/" class="modal__link">Политика конфиденцальности</a>
			</div>
		</div>
	</form>
</div>
