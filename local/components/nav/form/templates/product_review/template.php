<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
?>
<div class="product-page__desc-reviews-list-form form-check" id="review-form">
	<div class="product-page__desc-reviews-list-form-rating form-check__field" data-elem="input" data-rule="input-empty">
		<div class="rating rating--editable">
			<div class="rating__stars">
				<svg class="rating__star">
					<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
				</svg>
				<svg class="rating__star">
					<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
				</svg>
				<svg class="rating__star">
					<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
				</svg>
				<svg class="rating__star">
					<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
				</svg>
				<svg class="rating__star">
					<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
				</svg>
				<input id="input_rv_stars" type="hidden" value="-1">
			</div>
		</div>
	</div>
	<div class="product-page__desc-reviews-list-form-name">
		<div class="placeholder form-check__field" data-elem="input" data-rule="input-empty">
			<input id="input_rv_name" class="input placeholder__input" placeholder="Имя" type="text" value="" name="name">
			<div class="placeholder__item">Имя</div>
		</div>
	</div>
	<div class="product-page__desc-reviews-list-form-contact">
		<div class="placeholder form-check__field" data-elem="input" data-rule="input-empty">
			<input id="input_rv_contact" class="input placeholder__input" placeholder="Телефон или емейл" type="text" name="email">
			<div class="placeholder__item">Телефон или емейл</div>
		</div>
	</div>
	<div class="product-page__desc-reviews-list-form-text">
		<div class="placeholder form-check__field" data-elem="textarea" data-rule="input-empty">
			<textarea id="input_rv_text" class="input input--textarea placeholder__input" placeholder="Отзыв" name="text"></textarea>
			<div class="placeholder__item">Отзыв</div>
		</div>
	</div>
	<div class="product-page__desc-reviews-list-form-button-block">
		<div onclick="buttonSendReview(<?=$arParams['PRODUCT_ID']?>)" class="product-page__desc-reviews-list-form-button form-check__button button">Отправить</div>
	</div>
	<div id="product-review-form-success" class="hidden">Спасибо за отзыв! Мы проверим его и обязательно опубликуем.</div>
</div>
