<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

$isAjax = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $isAjax = (
        (isset($_POST['ajax_action']) && $_POST['ajax_action'] == 'Y')
        || (isset($_POST['compare_result_reload']) && $_POST['compare_result_reload'] == 'Y')
    );
}

$templateData = array(
    'TEMPLATE_THEME' => $this->GetFolder() . '/themes/' . $arParams['TEMPLATE_THEME'] . '/style.css',
    'TEMPLATE_CLASS' => 'bx_' . $arParams['TEMPLATE_THEME']
);

?>

<div class="title"><?= $APPLICATION->GetTitle(false) ?></div>
<div class="favorites__grid">
    <div class="favorites__aside">
        <? if ($arResult['SECTIONS']) { ?>
            <div class="favorites__category-title">Категории</div>
            <? foreach ($arResult['SECTIONS'] as $arSection) { ?>
                <a class="favorites__category<? if ($arSection['ACTIVE'] == 'Y') echo ' favorites__category--active' ?>"
                   href="<?= $arSection['LINK'] ?>"><?= $arSection['NAME'] ?></a>
            <?
            }
        } ?>
    </div>
    <div class="favorites__box">
        <div class="favorites__inner">
            <div class="favorites__header">
                <? if ($arResult['CURRENT_SECTION']) { ?>
                    <div class="title favorites__title"><?= $arResult['CURRENT_SECTION']['NAME'] ?>
                        <div class="favorites__title-value"><?= count($arResult['ITEMS']) ?> шт.</div>
                    </div>
                <? } ?>
                <a class="favorites__button-clear" href="javascript:void(0)" data-action="clearCompare" data-id="<?= implode('/', $arResult['ITEM_IDS']) ?>">
                    <div class="favorites__button-clear-icon"></div>
                    Очистить список</a>
            </div>

            <div class="favorites__carousel-box">
                <div class="favorites__carousel-items owl-carousel">
                    <? foreach ($arResult['ITEMS'] as $arCompareItem) {
                        if (in_array($arCompareItem['ID'], $arParams['FAVORITES'])) {
                            $fav_action = 'compfavdelete';
                            $fav_act = ' compfavactive';
                        } else {
                            $fav_action = 'compfav';
                            $fav_act = '';
                        }
                        ?>
                        <div class="favorites__carousel-item">
                            <div class="catalog-category__item catalog-category__item--height">
                                <div class="catalog-category__button catalog-category__button--show">
                                    <a class="button button--red" href="javascript:void(0)" data-action="add2basket" data-id="<?= $arCompareItem['ID'] ?>">В корзину</a>
                                </div>
                                <a class="catalog-category__image-box" href="<?= $arCompareItem['DETAIL_PAGE_URL'] ?>">
                                    <img class="catalog-category__image" src="<?=$arCompareItem['PREVIEW_PICTURE'] ? $arCompareItem['PREVIEW_PICTURE']['SRC'] : SITE_TEMPLATE_PATH . '/img/no-image.png'?>">
                                    <div class="catalog-category__icon-box">
                                        <div class="catalog-category__icon catalog-category__icon-favorite catalog-category__icon--show">
                                            <div class="catalog-category__icon-image catalog-category__icon-image--favourite<?= $fav_act ?>" data-add="FAVORITES"
                                                 data-action="<?= $fav_action ?>" data-id="<?= $arCompareItem['ID'] ?>"></div>
                                        </div>
                                        <div class="catalog-category__icon catalog-category__icon--show">
                                            <div class="catalog-category__icon-image catalog-category__icon-image--comparison" data-action="clearCompare"
                                                 data-id="<?= $arCompareItem['ID'] ?>"></div>
                                        </div>
                                    </div>
                                </a>
                                <div class="catalog-category__price-box">
                                    <div class="catalog-category__price"><?= number_format($arCompareItem['CATALOG_PRICE_1'], 0, '', ' ') ?><span
                                                class="catalog-category__price-span">com</span></div>
                                </div>
                                <a class="catalog-category__name" href="<?= $arCompareItem['DETAIL_PAGE_URL'] ?>"><?= $arCompareItem['NAME'] ?></a>
                                <div class="catalog-category__container catalog-category__container--show">
                                    <div class="rating">
                                        <? for ($i = 1; $i <= $arCompareItem['PROPERTIES']['RATING']['VALUE']; $i++) { ?>
                                            <div class="rating__star active"></div>
                                        <? } ?>
                                        <? for ($i = $arCompareItem['PROPERTIES']['RATING']['VALUE']; $i < 5; $i++) { ?>
                                            <div class="rating__star"></div>
                                        <? } ?>
                                    </div>
                                    <div class="catalog-category__article">Арт. <?= $arCompareItem['PROPERTIES']['ART_NUMBER']['VALUE'] ?></div>
                                </div>
                            </div>
                        </div>
                    <? } ?>
                </div>
            </div>
            <div class="favorites__characteristics">
                <? foreach ($arResult['PROPERTIES_TO_SHOW'] as $key => $arProperty) { ?>
                    <div class="favorites__characteristics-item">
                        <div class="favorites__characteristics-title"><?= $arProperty ?></div>
                        <div class="favorites__characteristics-row">
                            <? foreach ($arResult['ITEMS'] as $arItem) { ?>
                                <div class="favorites__characteristics-box">
                                    <div class="favorites__characteristics-text"><?= !empty($arItem['PROPERTIES'][$key]['VALUE']) ? $arItem['PROPERTIES'][$key]['VALUE'] : '&ndash;' ?></div>
                                </div>
                            <? } ?>
                        </div>
                    </div>
                <? } ?>
            </div>
        </div>
    </div>
</div>
