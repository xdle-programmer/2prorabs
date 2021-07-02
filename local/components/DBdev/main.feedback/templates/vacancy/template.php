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
<form class="inside__respond" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
    <?=bitrix_sessid_post()?>
	<div class="inside__respond-title">Откликнуться на вакансию</div>
	<div class="inside__respond-text">
		Прикрепите резюме <br>
		и наш HR свяжется с вами
	</div>
	<div class="inside__file-block">
		<input class="inside__inputfile" type="file" name="file[]" id="file"
		       data-multiple-caption="{count} files selected" multiple>
		<label class="inside__inputfile-text" for="file">
			<div class="inside__inputfile-icon"></div>
			<span>Прикрепить резюме</span>
		</label>
		<div class="inside__inputfile-delete">
			<div class="inside__inputfile-delete-icon"></div>
			Удалить
		</div>
	</div>
	<div class="input-styled inside__respond-input">
		<label class="input-styled__label" for="input-phone">Номер телефона</label>
		<input class="input-styled__input" name="PHONE" required type="tel" id="input-phone">
	</div>
	<div class="checkbox checkbox--align inside__checkbox">
		<input class="checkbox__input" name="policy" value="Y" type="checkbox" required>
		<div class="checkbox__square"></div>
		<div class="checkbox__text checkbox__text--grey-small">Я даю согласие на обработку своих
			персональных данных согласно<a class="checkbox__right-link" href="/privacy-policy/">политике
				конфиденциальности</a>
		</div>
	</div>
	<button type="submit" class="button button--red button--red-width inside__respond-button">Откликнуться</button>
	<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
	<input type="hidden" name="submit" value="Y">
	<input type="hidden" name="PRODUCT" value="<?=$arParams['PRODUCT_ID'];?>">
	<input type="hidden" name="PRODUCT_NAME" value="<?=$arParams['PRODUCT_NAME'];?>">
	<input type="hidden" value="Y" name="submit">
</form>
