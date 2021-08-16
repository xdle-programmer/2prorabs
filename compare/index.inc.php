<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

if (\nav\PageState::get('comparisonListEmpty') === false) {
    return;
}
?>
<section class="section">
	<div class="layout layout--small">

		<div class="basket basket--empty">
			<div class="basket__empty">
				<svg class="basket__empty-icon">
					<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#empty-box"></use>
				</svg>
				<div class="basket__empty-text-box">
					<div class="basket__empty-text">Список сравнения пуст. Вы можете выбрать товары в</div>
					<a class="basket__empty-text-link" href="/catalog/">&nbsp;каталоге</a>
				</div>
			</div>
		</div>

<style>
font.notetext{ display: none; }
</style>

	</div>
</section>
