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
<section class="clearance-problem">
    <div class="container">
        <div class="clearance-problem__item">
            <div class="clearance-problem__item-title">Возникли проблемы с оформлением заказа?</div>
            <div class="clearance-problem__item-text">Напишите и мы свяжемся с вами в ближайшее время, чтобы ответить на все ваши вопросы</div>
              <?if(!empty($arResult["ERROR_MESSAGE"]))
              {
                foreach($arResult["ERROR_MESSAGE"] as $v)
                  ShowError($v);
              }
                if(strlen($arResult["OK_MESSAGE"]) > 0)
                {
                  ?><div class="mf-ok-text"><?=$arResult["OK_MESSAGE"]?></div><?
                }
              ?>
            <form class="feedback-area" action="<?=POST_FORM_ACTION_URI?>" method="POST" id="mf-index">
              <?=bitrix_sessid_post()?>
                <input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
                <div class="feedback-area__box">
                    <label class="feedback-area__label" for="input-name">Ваше имя</label>
                    <input name="NAME" class="feedback-area__input" type="text" id="input-name" required>
                </div>
                <div class="feedback-area__box">
                    <label class="feedback-area__label" for="input-phone">Телефон</label>
                    <input name="PHONE" class="feedback-area__input" type="phone" id="input-phone" required>
                </div>
                <div class="feedback-area__item-button">
                    <button value="Y" name="submit" type="submit" class="button">Оставить заявку</button>
                </div>
            </form>
            <div class="feedback-area__checkbox-box">
                <input class="feedback-area__checkbox-input" type="checkbox" id="feedback-area" required form="mf-index">
                <label class="feedback-area__checkbox-label" for="feedback-area">
                    Я даю согласие на обработку своих персональных данных согласно<a class="feedback-area__checkbox-link" href="/privacy-policy/"> политике конфиденциальности </a></label>
            </div>
        </div>
    </div>
</section>