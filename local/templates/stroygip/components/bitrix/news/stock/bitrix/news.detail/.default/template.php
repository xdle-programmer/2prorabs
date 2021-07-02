<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="stock__inside-inner">
	<div class="stock__post-title">Колеровка бесплатно</div>
	<div class="stock__row">
		<div class="stock__container">
            <? if (!empty($arResult['PROPERTIES']['SELL_OUT']['VALUE'])) { ?>
				<div class="stock__discount stock__discount--indent">
					<div class="stock__discount-icon"></div>
					<div class="stock__discount-text"><?= $arResult['PROPERTIES']['SELL_OUT']['VALUE']; ?></div>
				</div>
            <? } ?>
			<div class="stock__discount-time">
				<div class="stock__discount-time-icon"></div>
				<div class="stock__discount-time-text">Акция действует до <?= date('d.m.Y',
                        strtotime($arResult['DATE_ACTIVE_TO'])); ?></div>
			</div>
		</div>
		<div class="stock__discount-timer">
			<div class="stock__discount-timer-title">До конца акции осталось:</div>
			<div class="stock__discount-timer-row">
				<!--.stock__discount-timer-item-->
				<!--    img(src="/src/blocks/stock/assets/img/timer.png")-->
				<div class="timer" id="timer">
					<div class="timer__number">
						<div id="days"></div>
					</div>
					<div class="timer__number">
						<div id="hours"></div>
					</div>
					<div class="timer__number">
						<div id="minutes"></div>
					</div>
					<div class="timer__number">
						<div id="seconds"></div>
					</div>
				</div>
				<a class="button button--red button--red-width stock__discount-timer-button" href="/catalog/">Перейти в
					каталог</a>
			</div>
		</div>
	</div>
	<div class="stock__preview-img-box">
		<img class="stock__preview-img" src="<?= $arResult['DETAIL_PICTURE']['SRC'] ?>">
	</div>
	<div class="stock__post-paragraph">Условия акции</div>
    <?= $arResult['DETAIL_TEXT']; ?>
</div>