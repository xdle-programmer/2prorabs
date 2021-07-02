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
<div class="inside__inner">
	<div class="inside__vacancies-pay"><?= $arResult['PROPERTIES']['PRICE']['VALUE']; ?></div>
	<a class="inside__back-link" href="/vacancy/">
		<div class="inside__back-icon"></div>
		Назад</a>
	<div class="inside__inner-inside">
		<div class="inside__title"><?= $arResult['NAME']; ?></div>
		<div class="inside__box">
            <? foreach ($arResult['ADVANTAGES'] as $arCol) { ?>
				<div class="inside__col">
                    <? foreach ($arCol as $arAdv) { ?>
						<div class="inside__advantages">
							<div class="inside__advantages-icon">
								<img src="<?= SITE_TEMPLATE_PATH ?>/assets/src/blocks/inside/assets/img/check.svg">
							</div>
                            <?= $arAdv; ?>
						</div>
                    <? } ?>
				</div>
            <? } ?>
		</div>
        <? if (!empty($arResult['DETAIL_TEXT'])) { ?>
			<div class="inside__row">
				<div class="inside__paragraph">Описание вакансии</div>
				<div class="inside__description">
                    <?= $arResult['DETAIL_TEXT']; ?>
				</div>
			</div>
        <? } ?>
		<div class="inside__block">
			<div class="inside__block-inner">
                <? if (!empty($arResult['PROPERTIES']['REQUIRMENTS']['VALUE'])) { ?>
					<div class="inside__row">
						<div class="inside__paragraph"><?= $arResult['PROPERTIES']['REQUIRMENTS']['NAME']; ?></div>
						<ul class="inside__list">
                            <? foreach ($arResult['PROPERTIES']['REQUIRMENTS']['VALUE'] as $val) { ?>
								<li class="inside__demands"><?= $val; ?></li>
                            <? } ?>
						</ul>
					</div>
                <? } ?>
                <? if (!empty($arResult['PROPERTIES']['DUTIES']['VALUE'])) { ?>
					<div class="inside__row">
						<div class="inside__paragraph"><?= (!empty($arResult['PROPERTIES']['DUTIES_TITLE']['VALUE']) ? $arResult['PROPERTIES']['DUTIES_TITLE']['VALUE'] : 'Обязанности') ?></div>
						<ul class="inside__list">
                            <? foreach ($arResult['PROPERTIES']['DUTIES']['VALUE'] as $val) { ?>
								<li class="inside__demands"><?= $val; ?></li>
                            <? } ?>
						</ul>
					</div>
                <? } ?>
                <? if (!empty($arResult['PROPERTIES']['WELCOMED']['VALUE'])) { ?>
					<div class="inside__row">
						<div class="inside__paragraph"><?= $arResult['PROPERTIES']['WELCOMED']['NAME']; ?></div>
						<ul class="inside__list">
                            <? foreach ($arResult['PROPERTIES']['WELCOMED']['VALUE'] as $val) { ?>
								<li class="inside__demands"><?= $val; ?></li>
                            <? } ?>
						</ul>
					</div>
                <? } ?>
                <? if (!empty($arResult['PROPERTIES']['TERMS']['VALUE'])) { ?>
					<div class="inside__row">
						<div class="inside__paragraph"><?= $arResult['PROPERTIES']['TERMS']['NAME']; ?></div>
						<ul class="inside__list">
                            <? foreach ($arResult['PROPERTIES']['TERMS']['VALUE'] as $val) { ?>
								<li class="inside__demands"><?= $val; ?></li>
                            <? } ?>
						</ul>
					</div>
                <? } ?>

				<div class="inside__row">
					<div class="inside__address-row">
						<div class="inside__address--about">
                            <? if (!empty($arResult['PROPERTIES']['CITYS']['DESCRIPTION']) || !empty($arResult['PROPERTIES']['CITYS']['VALUE']['TEXT'])) { ?>
								<div class="inside__paragraph">Адрес места работы</div>
								<div class="inside__title-small">Город:</div>
                            <? } ?>
                            <? if (!empty($arResult['PROPERTIES']['CITYS']['DESCRIPTION'])) { ?>
								<div class="inside__text"><?= $arResult['PROPERTIES']['CITYS']['DESCRIPTION']; ?></div>
                            <? } ?>
                            <? if (!empty($arResult['PROPERTIES']['CITYS']['~VALUE']['TEXT'])) { ?>
								<a class="inside__route" href="#">
									<div class="inside__route-icon"></div>
									Построить маршрут</a>
                            <? } ?>
                            <? if (!empty($arResult['PROPERTIES']['PHONES']['VALUE'])) { ?>
								<div class="inside__address-box">
									<div class="inside__title-small"><?= $arResult['PROPERTIES']['PHONES']['NAME']; ?>:</div>
                                    <? foreach ($arResult['PROPERTIES']['PHONES']['VALUE'] as $val) { ?>
										<div class="inside__text"><?= $val; ?></div>
                                    <? } ?>
								</div>
                            <? } ?>
                            <? if (!empty($arResult['PROPERTIES']['WORK_TIME']['VALUE'])) { ?>
							<div class="inside__address-box">
								<div class="inside__title-small"><?=$arResult['PROPERTIES']['WORK_TIME']['NAME'];?>:</div>
                                <? foreach ($arResult['PROPERTIES']['WORK_TIME']['VALUE'] as $val) { ?>
									<div class="inside__text"><?= $val; ?></div>
                                <? } ?>
							</div>
                            <? } ?>
                            <? if (!empty($arResult['PROPERTIES']['EMAILS']['VALUE'])) { ?>
							<div class="inside__address-box">
								<div class="inside__title-small"><?=$arResult['PROPERTIES']['EMAILS']['NAME']?>:</div>
                                <? foreach ($arResult['PROPERTIES']['EMAILS']['VALUE'] as $val) { ?>
									<div class="inside__text"><?= $val; ?></div>
                                <? } ?>
							</div>
                            <? } ?>
						</div>
                        <?= $arResult['PROPERTIES']['CITYS']['~VALUE']['TEXT']; ?>
					</div>
				</div>
			</div>

