<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

if (\nav\PageState::get('comparisonListEmpty') === false) {
    return;
}
?>
<section class="section section--gray">
	<div class="layout">
		<div class="breadcrumb">
			<a class="breadcrumb__item" href="/">Главная</a>
			<svg class="breadcrumb__separator">
				<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#arrow"></use>
			</svg>
			<div class="breadcrumb__item breadcrumb__item--active">Сравнение товаров</div>
		</div>

<div class="compare-empty__inner">
    <div class="title compare-empty__title">В сравнении пока ничего нет</div>
	<img class="compare-empty__img" src="<?=SITE_TEMPLATE_PATH?>/assets/dist/src/blocks/basket-empty/assets/img/empty-box.png">
    <div class="compare-empty__text">
		Воспользуйтесь поиском, чтобы найти нужный товар или 
		<a class="compare-empty__link" href="/catalog/">перейдите в каталог.</a>
	</div>
</div>
<style>
font.notetext{ display: none; }
</style>

	</div>
</section>
