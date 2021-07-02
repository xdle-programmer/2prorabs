<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

if (method_exists($this, 'setFrameMode')) {
	$this->setFrameMode(true);
}

if ($arResult['ACTION']['status']=='error') {
	ShowError($arResult['ACTION']['message']);
} elseif ($arResult['ACTION']['status']=='ok') {
	ShowNote($arResult['ACTION']['message']);
}
?>
<section class="subscribe-mailing">
    <div class="container">
        <div class="subscribe-mailing__inner">
            <div class="subscribe-mailing__title">Подпишитесь на нашу еженедельную <br> e-mail рассылку</div>
            <div class="subscribe-mailing__box">
                <form class="feedback-area" action="<?= POST_FORM_ACTION_URI?>" method="post" id="asd_subscribe_form">
                  <?= bitrix_sessid_post()?>

                    <input type="hidden" name="asd_subscribe" value="Y" />
                    <input type="hidden" name="charset" value="<?= SITE_CHARSET?>" />
                    <input type="hidden" name="site_id" value="<?= SITE_ID?>" />
                    <input type="hidden" name="asd_rubrics" value="<?= $arParams['RUBRICS_STR']?>" />
                    <input type="hidden" name="asd_format" value="<?= $arParams['FORMAT']?>" />
                    <input type="hidden" name="asd_show_rubrics" value="<?= $arParams['SHOW_RUBRICS']?>" />
                    <input type="hidden" name="asd_not_confirm" value="<?= $arParams['NOT_CONFIRM']?>" />
                    <input type="hidden" name="asd_key" value="<?= md5($arParams['JS_KEY'].$arParams['RUBRICS_STR'].$arParams['SHOW_RUBRICS'].$arParams['NOT_CONFIRM'])?>" />

                    <div class="feedback-area__box">
                        <label class="feedback-area__label" for="input-mail">Почта</label>
                        <input class="feedback-area__input" type="email" id="input-mail" name="asd_email">
                    </div>
                    <div class="feedback-area__item-button">
                        <button type="submit" name="asd_submit" id="asd_subscribe_submit" value="<?=GetMessage("ASD_SUBSCRIBEQUICK_PODPISATQSA")?>" class="button">Оставить заявку</button>
                    </div>
                </form>
                <div class="clearance-problem__checkbox-box">
                    <input class="feedback-area__checkbox-input" type="checkbox" id="feedback-area-email" required form="asd_subscribe_form">
                    <label class="feedback-area__checkbox-label" for="feedback-area-email">
                        Я даю согласие на обработку своих персональных данных согласно<a class="feedback-area__checkbox-link" href="#"> политике конфиденциальности </a></label>
                </div>
                <br>
                <div id="asd_subscribe_res" style="display: none; color: white;"></div>
            </div>
        </div>
    </div>
</section>
