<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
?>
<section class="clearance-problem">
    <div class="container">
        <div class="clearance-problem__item">
            <div class="clearance-problem__item-title">Остались вопросы?</div>
            <div class="clearance-problem__item-text">Напишите и мы свяжемся с вами в ближайшее время, чтобы ответить на все ваши вопросы</div>
            <form class="feedback-area">
                <div class="feedback-area__box feedback-area__box--mb">
                    <label class="feedback-area__label" for="input-name">Ваше имя</label>
                    <input class="feedback-area__input" type="text" id="input-name" name="name" required>
                </div>
                <div class="feedback-area__box">
                    <label class="feedback-area__label" for="input-phone">Телефон</label>
                    <input class="feedback-area__input" type="text" id="input-phone" name="phone" required>
                </div>
                <div class="feedback-area__item-button">
                    <button class="button">Оставить заявку</button>
                </div>
            </form>
            <div class="feedback-area__checkbox-box">
                <input class="feedback-area__checkbox-input" type="checkbox" id="feedback-area" name="accept">
                <div class="feedback-area__square"></div>
                <label class="feedback-area__checkbox-label" for="feedback-area">Я даю согласие на обработку своих персональных данных согласно <a class="feedback-area__checkbox-link" href="/privacy-policy/"> политике конфиденциальности </a></label>
            </div>
        </div>
    </div>
</section>
