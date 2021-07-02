<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
?>
<div class="product-review-form">
    <form class="product-review-form__form">
        <div class="product-review-form__row1 gui-form-row">
            <div class="product-review-form__control-wrapper">
                <input type="text" class="gui-input" value="" name="name" placeholder="Имя" required/>
            </div>
            <div class="product-review-form__control-wrapper">
                <input type="email" class="gui-input" value="" name="email" placeholder="Email" required/>
            </div>
        </div>
        <div class="product-review-form__row2 gui-form-row">
            <textarea class="product-review-form__textarea gui-textarea" name="text" placeholder="Текст отзыва" required></textarea>
        </div>
        <div class="product-review-form__actions">
            <button class="product-review-form__submit gui-button" type="submit">Оставить отзыв</button>
        </div>
    </form>
    <div class="product-review-form__success hidden">Спасибо за отзыв! Мы проверим его и обязательно опубликуем.</div>
</div>
