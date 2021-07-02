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

<?if(!empty($arResult["ERROR_MESSAGE"]))
{
	foreach($arResult["ERROR_MESSAGE"] as $v)
		ShowError($v);
}
if(strlen($arResult["OK_MESSAGE"]) > 0)
{
	?>
	<script>
        $('.thanks__close, .modal-overlay').click(function (){
            modalThanks.hide();
        });

        $('.modal-overlay, .modal-position, .feedback_thanks').show();
        $(".feedback-area__input").focus(function() {
            $(this).siblings(".feedback-area__label").addClass("feedback-area__label-color");
        });
        $(".feedback-area__input").blur(function() {

            let $this = $(this),
                val = $this.val();

            if(val.length >= 1){
                $(this).siblings(".feedback-area__label").removeClass("feedback-area__label-color");
                $(this).siblings(".feedback-area__label").addClass("feedback-area__label-active");
            }else {
                $(this).siblings(".feedback-area__label").removeClass("feedback-area__label-color");
                $(this).siblings(".feedback-area__label").removeClass("feedback-area__label-active");
            }
        });
	</script>
	<?
}
?>

<div class="container">
	<div class="clearance-problem__item">
		<div class="clearance-problem__item-title">Свяжитесь с нами по вопросу возврата и обмена товара</div>
		<div class="clearance-problem__item-text">Напишите и мы свяжемся с вами в ближайшее время, чтобы ответить на все ваши вопросы</div>
		<form class="feedback-area" action="<?=POST_FORM_ACTION_URI?>" method="post">
            <?=bitrix_sessid_post()?>
			<div class="feedback-area__box feedback-area__box--mb">
				<label class="feedback-area__label" for="input-name">Ваше имя</label>
				<input class="feedback-area__input" type="text" id="input-name" name="NAME" required>
			</div>
			<div class="feedback-area__box">
				<label class="feedback-area__label" for="input-phone">Телефон</label>
				<input class="feedback-area__input" type="text" id="input-phone" name="PHONE" required>
			</div>
			<div class="feedback-area__item-button">
				<button class="button" type="submit">Оставить заявку</button>
			</div>
			<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
			<input type="hidden" name="submit" value="Y">
		</form>
		<div class="feedback-area__checkbox-box">
			<input class="feedback-area__checkbox-input" type="checkbox" id="feedback-area1" required>
			<div class="feedback-area__square"></div>
			<label class="feedback-area__checkbox-label" for="feedback-area1">Я даю согласие на обработку своих персональных данных согласно <a class="feedback-area__checkbox-link" href="/privacy-policy/" target="_blank"> политике конфиденциальности </a></label>
		</div>
	</div>
</div>