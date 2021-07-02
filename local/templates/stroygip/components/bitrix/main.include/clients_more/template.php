<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */
/** @var CBitrixComponent $component */
?>
<div class="find-us__title find-us__title--black">
    <? if ($arResult["FILE"] != ''): ?>
    <? include($arResult["FILE"]); ?>
    <? endif; ?>
</div>
<div class="find-us__carousel owl-carousel owl-theme find-us__carousel--blue">
    <? foreach ($arParams['VIDEO_URL'] as $index => $url): ?>
    <div class="find-us__item">
        <div class="find-us__overlay" id="overlay_<?= $index ?>"></div>
        <!-- <video class="find-us__video" id="video_<?= $index ?>">
                <source src="<?= $url ?>">
            </video> -->
        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/I68dnEgVHe4?controls=0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    <? endforeach; ?>
</div>