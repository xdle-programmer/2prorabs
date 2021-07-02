<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (empty($arResult['ITEMS'])) {
    return;
}
?>
<div class="product-reviews">
    <? foreach ($arResult['ITEMS'] as $review): ?>
        <div class="product-review">
            <div>
                <span class="product-review__name"><?=$review['NAME']?></span>,
                <span class="product-review__date"><?=ConvertDateTime($review['DATE_CREATE'], 'DD.MM.YYYY')?></span>
            </div>
            <div class="product-review__text"><?=$review['DETAIL_TEXT']?></div>
        </div>
    <? endforeach; ?>
</div>
