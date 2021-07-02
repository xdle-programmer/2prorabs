<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

if (\nav\PageState::get('comparisonListEmpty') === false) {
    return;
}
?>
<div class="basket-empty__inner">
    <div class="title basket-empty__title">В сравнении пока ничего нет</div><img class="basket-empty__img" src="<?=SITE_TEMPLATE_PATH?>/assets/dist/src/blocks/basket-empty/assets/img/empty-box.png">
    <div class="basket-empty__text">Воспользуйтесь поиском, чтобы найти нужный товар или<a class="basket-empty__link" href="/catalog/">перейдите в каталог.</a></div>
</div>
<style>.container p > .notetext { display: none; }</style>