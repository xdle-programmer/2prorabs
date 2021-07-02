<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Localization\Loc;
use Bitrix\Main\Grid\Declension;


/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */
$Declension = new Declension('отзыв', 'отзыва', 'отзывов');
$this->setFrameMode(true);

$arResult['MIN_PRICE']['DISCOUNT_VALUE'] = round($arResult['MIN_PRICE']['DISCOUNT_VALUE'], 0, PHP_ROUND_HALF_UP);
$arResult['MIN_PRICE']['VALUE'] = round($arResult['MIN_PRICE']['VALUE'], 0, PHP_ROUND_HALF_UP);
$price = $arResult['PROPERTIES']["OLD_PRICE"]['VALUE'] ?: $arResult['MIN_PRICE']["DISCOUNT_VALUE"];
$price_discount = $arResult['MIN_PRICE']["DISCOUNT_VALUE"];


if (in_array($arResult['ID'], $arParams['FAVORITES'])) {
    $fav_action = 'compfavdelete';
    $fav_act = ' compfavactive';
    $fav_text = ' Из избранного';
} else {
    $fav_action = 'compfav';
    $fav_text = ' В избранное';
    $fav_act = '';
}
if (in_array($arResult['ID'], $arParams['COMPARE'])) {
    $comp_action = 'compfavdelete';
    $comp_act = ' compfavactive';
    $comp_text = ' Из сравнения';
} else {
    $comp_action = 'compfav';
    $comp_text = ' В сравнение';
    $comp_act = '';
}

$shopDeclension = new Declension('магазине', 'магазинах', 'магазинах');

$hiddenProperties = [
    'BENEFITS',
    'BESTSELLER',
    'BEST_PRICE',
    'CODE',
    'GALLERY',
    'HIDDEN_1C',
    'MAIN',
    'MARK',
    'OLD_PRICE',
    'RECOMEND',
    'REF',
    'REVIEWS',
    'REVIEWS_CNT',
    'rating',
    'vote_count',
    'vote_sum',

    'ARTIKUL',
    'ART_NUMBER',
    'AVTOR',
    'BAZOVAYAEDINITSAIZMERENIYA',
    'BYE_WIDTH',
    'CHARS',
    'DATA',
    'FRACTIONAL_PRODUCT',
    'ITOG',
    'KATEGORIYANOMENKLATURYSAYTA',
    'KON_OST',
    'MENEDZHER',
    'NOMENKLATURA_OSNOVNAYA_EDI',
    'NOMENKLATURA_STRANA_PROIS',
    'NOMENKLATURA_TOVARNAYA_MAR',
    'OSNOVNAYAEDINITSAIZMERENIYA',
    'OSTATOK',
    'OTDEL',
    'PROIZVODITEL',
    'RATING2',
    'SHT',
    'SROKKHRANENIYATOVARA',
    'STAVKANDS',
    'TIPNOMENKLATURY',
    'TIP_TOVARA',
    'TSENA',
    'VIDNOMENKLATURY',
    'VESHAETSYANAKRYUCHOK',
    'ZAKRYTA',
    '_',
];

?>

<div class="product-card__item">
    <div class="product-card__main-product">
        <div class="product-card__box">
            <? if ($arResult['PROPERTIES']['GALLERY']['VALUE']) { ?>
                <div class="product-card__slides">
                    <div class="product-card__slides-wrapper">
                        <div class="product-card__slides-inner owl-carousel">
                            <? foreach ($arResult["GALLERY"] as $photo): ?>
                                <div class="product-card__slide-small"><img src="<?=$photo['THUMBNAIL']?>" data-big="<?=$photo['BIG']?>"></div>
                            <? endforeach; ?>
                        </div>
                    </div>
                </div>
            <? } ?>
            <div class="product-card__preview">
                <div class="product-card__preview-header">
                    <div id="product_rating_placeholder" class="rating">
                        <div class="rating__star"></div>
                        <div class="rating__star"></div>
                        <div class="rating__star"></div>
                        <div class="rating__star"></div>
                        <div class="rating__star"></div>
                    </div>

                    <div class="product-card__reviews-counter"><?\nav\UncachedArea::show('productReviewsCount')?></div>

                    <div class="product-card__select-button <?= $fav_act ?>"
                         data-action="<?= $fav_action ?>" data-id="<?= $arResult['ID'] ?>"
                         data-add="FAVORITES">
                        <div class="product-card__select-button-icon product-card__select-button-icon--favourites"></div>
                        <span><?= $fav_text; ?></span>

                    </div>
                    <div class="product-card__select-button <?= $comp_act ?>"
                         data-action="<?= $comp_action ?>" data-id="<?= $arResult['ID'] ?>"
                         data-add="COMPARE">
                        <div class="product-card__select-button-icon product-card__select-button-icon--comparison"></div>
                        <span><?= $comp_text; ?></span>
                    </div>
                </div>
                <div class="product-card__main-image-box">
                    <? if ($arResult['DETAIL_PICTURE']['URL']) { ?>
                        <a href="<?= $arResult['DETAIL_PICTURE']['URL'] ?>" data-lightbox="preview" class="product-card__main-image-box-link">
                            <img class="product-card__main-image" src="<?= $arResult['DETAIL_PICTURE']['URL'] ?>">
                        </a>

                    <? } elseif ($arResult['PREVIEW_PICTURE']['URL']) { ?>
                        <a href="<?= $arResult['PREVIEW_PICTURE']['URL'] ?>" data-lightbox="preview" class="product-card__main-image-box-link">
                            <img class="product-card__main-image" src="<?= $arResult['PREVIEW_PICTURE']['URL'] ?>">
                        </a>
                    <? } else { ?>
                        <img class="product-card__main-image" src="<?= SITE_TEMPLATE_PATH ?>/img/no-image.png">
                    <? } ?>
                    <? if ($arResult['MIN_PRICE']["DISCOUNT_DIFF_PERCENT"] > 0) { ?>
                        <div class="product-card__mark">
                            <img class="product-card__mark-icon"
                                 src="<?= SITE_TEMPLATE_PATH ?>/assets/src/images/icons/sale.svg">Скидка <?= $arResult['MIN_PRICE']["DISCOUNT_DIFF_PERCENT"] ?>
                            %
                        </div>
                    <? } ?>
                </div>
            </div>
        </div>
        <div class="product-card__about tqWrap">
            <div class="product-card__title"><?= $arResult['NAME'] ?></div>
            <? if ($arResult['PROPERTIES']['ART_NUMBER']['VALUE']) { ?>
                <div class="product-card__subtitle product-card__article">
                    Артикул: <?= $arResult['PROPERTIES']['ART_NUMBER']['VALUE'] ?></div>
            <? } ?>
            <? if ($arResult["PROPERTIES"]['COLOR']['VALUE']) { ?>
                <div class="product-card__subtitle product-card__color">Цвет:<span
                            class="product-card__text"><?= $arResult["PROPERTIES"]['COLOR']['VALUE'] ?></span></div>
            <? } ?>
            <div class="product-card__radio-container">
                <? if ($arResult["PROPERTIES"]['COLOR']['VALUE']) { ?>
                    <div class="product-card__radio-box">
                        <input class="product-card__radio-input" type="radio" id="color-2" name="color">
                        <label class="product-card__radio-label product-card__radio-label--indent" for="color-2"><span
                                    class="product-card__color-palette product-card__color-palette--<?= $arResult["PROPERTIES"]['COLOR']['VALUE_XML_ID'] ?>"></span></label>
                    </div>
                <? } ?>
            </div>

            <div class="product-card__amount-box">
                <div class="product-card__subtitle">Количество:</div>
                <a class="product-card__calculator" href="#">
                    <div class="product-card__calculator-icon"></div>
                    Рассчитать расход материалов</a>
            </div>
            <div class="product-card__sum">
                <div class="product-card__sum-icon dds-minus">-</div>
                <input class="product-card__sum-input ddsQuantity" id="calculatorSum" type="text" value="1"
                       data-price='<?= $price ?>' data-discount-price='<?= $price_discount ?>'
                       data-currency="<?= CURRENCY ?>"
                       data-step="<?= $arResult['CATALOG_MEASURE_RATIO'] ?: 1; ?>"
                >
                <div class="product-card__sum-icon dds-plus">+</div>
            </div>
            <div class="product-card__price-box">
                <? if (!empty($arResult['PROPERTIES']["OLD_PRICE"]['VALUE']) && $arResult['PROPERTIES']["OLD_PRICE"]['VALUE'] != $arResult['MIN_PRICE']["VALUE"]) { ?>
                    <div class="product-card__discount"><?= $arResult['PROPERTIES']["OLD_PRICE"]['VALUE'] ?><span
                                class="product-card__discount-prefix"><?= CURRENCY; ?></span>
                    </div>
                    <div class="product-card__price"><?= $arResult['MIN_PRICE']["DISCOUNT_VALUE"] ?><span
                                class="product-card__price-prefix"><?= CURRENCY; ?></span>
                    </div>
                <? } else { ?>
                    <div class="product-card__price"><?= $arResult['MIN_PRICE']["DISCOUNT_VALUE"]; ?><span
                                class="product-card__price-prefix"><?= CURRENCY; ?></span>
                    </div>
                <? } ?>
            </div>
            <? if ($arResult['MIN_PRICE']["DISCOUNT_DIFF"] > 0) { ?>
                <div class="product-card__nds"><?= $arResult['MIN_PRICE']["DISCOUNT_VALUE"] ?>
                    &nbsp;<?= CURRENCY; ?>/<?= $arResult['ITEM_MEASURE']['TITLE'] ?>
                </div>
            <? } else { ?>
                <div class="product-card__nds"><?= $arResult['MIN_PRICE']["VALUE"] ?>
                    &nbsp;<?= CURRENCY; ?>/<?= $arResult['ITEM_MEASURE']['TITLE'] ?>
                </div>
            <? } ?>
            <div class="product-card__buttons">
                <a class="button button--red button--medium-style product-card__button" href="javascript:void(0)" data-action="add2basket" data-id="<?= $arResult['ID'] ?>">В
                    корзину</a>
                <a class="product-card__fast-order button button--white-red button--medium-style" href="#">Быстрый заказ</a>
            </div>
            <div class="product-card__availability-box">
                <? if (count($arResult['BALANCE']) > 0) { ?>
                    <div class="product-card__item-availability">
                        <div class="product-card__item-availability-icon"><img
                                    src="<?= SITE_TEMPLATE_PATH ?>/assets/src/images/icons/availability.svg"></div>
                        В наличии:<a class="product-card__item-availability-link"
                                     href="#storages">в <?= count($arResult['BALANCE']); ?> <?= $shopDeclension->get(count($arResult['BALANCE'])); ?></a>
                    </div>
                <? } else { ?>
                    <div class="product-card__item-availability">
                        Нет в наличии
                    </div>
                <? } ?>
                <div class="product-card__item-availability">
                    <div class="product-card__item-availability-icon"><img
                                src="<?= SITE_TEMPLATE_PATH ?>/assets/src/images/icons/courier.svg"></div>
                    Доставка:<a class="product-card__item-availability-courier">от 120 сом</a>
                </div>
            </div>
            <div class="custorm-text-notify">Внешний вид товара может отличаться от представленного на фотографии</div>
        </div>
    </div>
</div>

</div>
</section>
<section class="product-description">
    <div class="container">
        <div class="product-description__grid">
            <div class="product-description__container">
                <div class="product-description__tabs">
                    <div class="product-description__tab product-description__tab--active">Описание</div>
                    <div class="product-description__tab">Характеристики</div>
                    <div class="product-description__tab">
                        Отзывы
                    </div>
                </div>
                <div class="product-description__box">
                    <div class="product-description__content-box product-description__content-box--active">
                        <div class="product-description__description-text"><?= (mb_strlen($arResult['DETAIL_TEXT']) > 10 ? $arResult['DETAIL_TEXT'] : $arResult['NAME']) ?></div>
                    </div>
                    <div class="product-description__content-box">
                        <div class="product-description__description-text">
                            <? foreach ($arResult['PROPERTIES'] as $property): ?>
                                <?
                                if (in_array($property['CODE'], $hiddenProperties)) {
                                    continue;
                                }

                                if (empty($property['VALUE'])) {
                                    continue;
                                }

                                if (!empty($property['LINK_ELEMENT_VALUE'])) {
                                    $value = reset($property['LINK_ELEMENT_VALUE']);
                                    $value = $value['NAME'];
                                } else {
                                    $value = $property['VALUE'];
                                }
                                ?>
                                <div class="product-description__property">
                                    <span class="product-description__property-name"><?=$property['NAME']?></span>
                                    <span class="product-description__property-value"><?=$value?></span>
                                </div>
                            <? endforeach; ?>
                        </div>
                    </div>
                    <div class="product-description__content-box">
                        <?$APPLICATION->IncludeComponent("nav:form", "product_review", [
                            "PRODUCT_ID" => $arResult['ID'],
                        ])?>

                        <?\nav\UncachedArea::show('productReviews')?>
                    </div>
                </div>
            </div>

            <div class="product-description__container">
                <div class="product-description__tabs">
                    <div class="product-description__tab product-description__tab--active" id="storages">По городу</div>
                    <!--				<div class="product-description__tab">Область</div>-->
                </div>
                <div class="product-description__box">
                    <div class="product-description__content-box product-description__content-box--active">
                        <div class="product-description__input-block">
                            <label class="product-description__label" for="input-city">Ваш город</label>
                            <input class="product-description__input" type="text" id="input-city">
                            <div class="product-description__input-reset">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/src/images/icons/reset.svg">
                            </div>
                        </div>
                        <div class="product-description__title-medium product-description__pickup-title">Самовывоз из магазинов:</div>
                        <? if ($arResult['BALANCE']) { ?>
                            <div class="product-description__availability">
                                <span class="product-description__in-stock-text">В наличии: </span>
                                <? foreach ($arResult['BALANCE'] as $balance) { ?>
                                    <a class="product-description__pickup-link" href="javascript:void(0)">
                                        <div class="product-description__pickup-icon"></div>
                                        Склад <?= $arResult['STORAGES'][$balance['PROPERTY_STORAGE_ID_VALUE']] ?>
                                    </a>
                                <? } ?>
                            </div>
                        <? } ?>
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/local/include/" . SITE_ID . "/card/delivery.php"
                            )
                        ); ?>
                        <div class="product-description__pickup-link product-description__delivery-link" href="#">
                            <div class="product-description__pickup-icon product-description__pickup-icon--delivery-icon"></div>
                            Условия доставки</div>
                    </div>
                    <!--				<div class="product-description__content-box">-->
                    <!--					<div class="product-description__input-block">-->
                    <!--						<label class="product-description__label" for="input-city2">Ваш город</label>-->
                    <!--						<input class="product-description__input" type="text" id="input-city2">-->
                    <!--						<div class="product-description__input-reset"><img-->
                    <!--									src="--><? //= SITE_TEMPLATE_PATH ?><!--/assets/src/images/icons/reset.svg"></div>-->
                    <!--					</div>-->
                    <!--					<div class="product-description__title-medium product-description__pickup-title">Самовывоз из-->
                    <!--						магазинов:-->
                    <!--					</div>-->
                    <!--                    --><? // $APPLICATION->IncludeComponent(
                    //                        "bitrix:main.include",
                    //                        "",
                    //                        Array(
                    //                            "AREA_FILE_SHOW" => "file",
                    //                            "AREA_FILE_SUFFIX" => "inc",
                    //                            "EDIT_TEMPLATE" => "",
                    //                            "PATH" => "/local/include/" . SITE_ID . "/card/delivery_region.php"
                    //                        )
                    //                    ); ?>
                    <!--					<a class="product-description__pickup-link product-description__delivery-link" href="#">-->
                    <!--						<div class="product-description__pickup-icon product-description__pickup-icon--delivery-icon"></div>-->
                    <!--						Условия доставки</a>-->
                    <!--				</div>-->
                </div>
            </div>
        </div>
    </div>
</section>