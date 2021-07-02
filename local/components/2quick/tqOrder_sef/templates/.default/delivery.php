<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var array $arResult */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
?>
<div class="basket-products__grid">
    <form class="basket-products__container" id="tq_order" data-tab="delivery" data-next="<?= $arResult['TABS']['1']['URL'] ?>">
        <div class="basket-products__title"><?= $APPLICATION->ShowTitle(false) ?></div>
        <? include 'tabs.php'; ?>
        <div class="basket-products__title basket-products__title--medium-center basket-products__title--mb">Доставка</div>
        <div class="basket-products__registration-inner">
            <div class="basket-products__registration-title">Получатель</div>
            <div class="basket-products__registration-forms">
                <div class="basket-products__registration-input-box basket-products__registration-input-box--mr">
                    <? $value = $arResult['SAVED']['delivery']['NAME'] ?>
                    <label class="basket-products__registration-label <? if ($value): ?>basket-products__registration-label-active<? endif; ?>">ФИО</label>
                    <input
                        class="basket-products__registration-input <? if ($value): ?>basket-products__registration-label-active<? endif; ?>"
                        type="text"
                        name="NAME"
                       value="<?=$value?>"
                    />
                </div>

                <div class="basket-products__registration-input-box">
                    <? $value = $arResult['SAVED']['delivery']['PHONE']; ?>
                    <label class="basket-products__registration-label <? if ($value): ?>basket-products__registration-label-active<? endif; ?>">Телефон получателя</label>
                    <input
                        class="basket-products__registration-input <? if ($value): ?>basket-products__registration-label-active<? endif; ?>"
                        type="text"
                        name="PHONE"
                        value="<?=$value?>"
                        data-phone-mask
                    />
                </div>
            </div>
            <? /*<div class="basket-products__registration-forms">
                        <div class="basket-products__registration-input-box basket-products__registration-input-box--mr">
                            <label class="basket-products__registration-label">Телефон</label>
                            <input class="basket-products__registration-input" type="text" name="PHONE" value="<?=$arResult['SAVED']['delivery']['PHONE']?>">
                        </div>
                        <div class="basket-products__registration-input-box">
                            <label class="basket-products__registration-label">E-mail</label>
                            <input class="basket-products__registration-input" type="text" name="EMAIL" value="<?=$arResult['SAVED']['delivery']['EMAIL']?>">
                        </div>
                    </div>*/ ?>
            <div style="display: none" class="basket-products__registration-title">Город получения</div>
            <div class="basket-products__select">
                <div class="ui-widget ui-widget--mb">
                    <!--                            <select id="combobox" name="LOCATION"></select>-->
                </div>
            </div>
            <div class="basket-products__registration-title">Выберите способ получения заказа</div>
            <div class="basket-products__container-tabs">
                <div class="basket-products__delivery-buttons">
                    <? foreach ($arResult['DELIVERIES'] as $arDelivery) { ?>
                        <label class="basket-products__delivery-button<? if ($arDelivery['CHECKED'] == 'Y') echo ' basket-products__delivery-button--active' ?>">
                            <input type="radio" hidden name="delivery_id" value="<?= $arDelivery['ID'] ?>"<? if ($arDelivery['CHECKED'] == 'Y') echo ' checked' ?>>
                            <div class="basket-products__delivery-button-title"><?= $arDelivery['NAME'] ?></div>
                            <!--                                <div class="basket-products__delivery-button-text">--><? //=$arDelivery['PRICE_FORMATED']?><!--</div>-->
                        </label>
                    <? } ?>
                </div>
                <? foreach ($arResult['DELIVERIES'] as $arDelivery) { ?>
                    <div class="basket-products__content<? if ($arDelivery['CHECKED'] == 'Y') echo ' basket-products__content--active' ?>" data-delivery="<?= $arDelivery['ID'] ?>">
                        <?
                        if ($arDelivery['STORES']) {
                            ?>
                            <div class="basket-products__registration-title basket-products__registration-title--mb-small">Пункты самовывоза</div>
                            <div class="basket-products__delivery-points">
                                <? foreach ($arDelivery['STORES'] as $arItem) {
                                    ?>
                                    <div class="basket-products__delivery-point">
                                        <div class="basket-products__delivery-point-container">
                                            <div class="basket-products__delivery-point-position"><?=$arItem['NAME']?></div>
                                            <div class="basket-products__delivery-point-time">
                                                <? if ($arItem['PROPERTIES']['WORK_TIME']['VALUE']): ?>
                                                    График работы: <?=$arItem['PROPERTIES']['WORK_TIME']['VALUE']?> <br>
                                                <? endif; ?>

                                                <? if ($arItem['PROPERTIES']['DELIVERY_DAY']['VALUE']): ?>
                                                    <?
                                                    $date = new DateTime(date('d.m.Y'));
                                                    $date->add(new DateInterval('P' . intval($arItem['PROPERTIES']['DELIVERY_DAY']['VALUE']) . 'D'));
                                                    $day = FormatDate('l', MakeTimeStamp($date->format('d.m.Y h:i:s')))
                                                    ?>
                                                    Можно забрать <? if ($day == 'Вторник') echo 'во'; else echo 'в' ?> <?= strtolower($day) ?>, <?= FormatDate(' d F', MakeTimeStamp($date->format('d.m.Y h:i:s'))) ?>
                                                <? endif; ?>
                                            </div>
                                            <div class="basket-products__delivery-pay-method"><?= $arItem['PREVIEW_TEXT'] ?></div>

                                            <? if (count($arItem['UNAVAILABLE_PRODUCTS']) > 0): ?>
                                                <div class="checkout__unavailable-products-text">
                                                    На этом складе недостаточное количество следующих товаров (указан актуальный остаток):
                                                </div>
                                                <? foreach ($arItem['UNAVAILABLE_PRODUCTS'] as $product): ?>
                                                    <div class="checkout__unavailable-product">
                                                        <?=$product['NAME']?> &mdash; <?=$product['AVAILABLE']?> шт.
                                                    </div>
                                                <? endforeach; ?>
                                            <? endif; ?>
                                        </div>
                                        <input class="tq_radio" type="radio" name="POINT" value="<?= $arItem['ID'] ?>" hidden
                                               id="point-<?= $arItem['ID'] ?>"<? if ($arDelivery['CHECKED'] != 'Y') echo ' disabled' ?> <? if ($arResult['SAVED']['delivery']['POINT'] == $arItem['ID']) echo ' checked' ?>>
                                        <label class="basket-products__delivery-point-button" for="point-<?= $arItem['ID'] ?>">Выбрать</label>
                                    </div>
                                <? } ?>

                            </div>
                        <? } else {
                            ?>
                            <div class="basket-products__tk">
                                <div class="basket-products__registration-title basket-products__registration-title--mb-small">
                                    <? if ($arDelivery['ID'] == '4') echo 'Введите адрес пункта ТК'; else echo 'Введите адрес доставки заказа' ?>
                                </div>
                                <? if ($arDelivery['DESCRIPTION']) {
                                    ?>
                                    <div class="basket-products__warning">
                                        <div class="basket-products__warning-close"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/src/blocks/basket-products/assets/img/close.svg">
                                        </div>
                                        <div class="basket-products__warning-title">Внимание!</div>
                                        <div class="basket-products__warning-text">
                                            <?= $arDelivery['DESCRIPTION'] ?>
                                        </div>
                                    </div>
                                <? } ?>
                                <div class="basket-products__registration-forms basket-products__registration-forms--mb">
                                    <div class="basket-products__registration-input-box basket-products__registration-input-box--mr basket-products__registration-input-box--address-1">
                                        <? $value = $arResult['SAVED']['delivery']['CITY']; ?>
                                        <label class="basket-products__registration-label <? if ($value): ?>basket-products__registration-label-active<? endif; ?>">Адрес</label>
                                        <input class="basket-products__registration-input <? if ($value): ?>basket-products__registration-label-active<? endif; ?>" type="text"
                                               name="CITY"<? if ($arDelivery['CHECKED'] != 'Y') echo ' disabled' ?> value="<?= $value ?>">
                                    </div>
                                    <div class="basket-products__registration-input-box basket-products__registration-input-box--address-2">
                                        <div class="basket-products__registration-input-button open-basket-map">Указать на карте</div>
                                    </div>

                                    <div class="basket-products__registration-input-box" style="display: none">
                                        <label class="basket-products__registration-label">Улица</label>
                                        <input class="basket-products__registration-input" type="text" name="STREET"<? if ($arDelivery['CHECKED'] != 'Y') echo ' disabled' ?>
                                               value="&nbsp;<?= $arResult['SAVED']['delivery']['STREET'] ?>">
                                    </div>
                                </div>
                                <div class="basket-delivery">
                                    <div class="basket-products__registration-forms basket-products__registration-forms--mb">
                                        <div class="basket-products__registration-title basket-products__registration-title--mb-small">Стоимость доставки до 200 кг:&nbsp;</div>
                                        <div class="basket-products__registration-title basket-products__registration-title--mb-small price-small-delivery"></div>
                                        <div class="basket-products__registration-title basket-products__registration-title--mb-small">&nbsp;Сом</div>
                                    </div>
                                    <div class="basket-products__registration-forms basket-products__registration-forms--mb">
                                        <div class="basket-products__registration-title basket-products__registration-title--mb-small">Стоимость доставки свыше 200 кг:&nbsp;</div>
                                        <div class="basket-products__registration-title basket-products__registration-title--mb-small price-big-delivery"></div>
                                        <div class="basket-products__registration-title basket-products__registration-title--mb-small">&nbsp;Сом</div>
                                    </div>
                                </div>

                                <div class="basket-products__registration-forms">
                                    <div class="basket-products__registration-input-box basket-products__registration-input-box--mr" style="display: none">
                                        <label class="basket-products__registration-label">Дом</label>
                                        <input class="basket-products__registration-input" type="text" name="HOUSE"<? if ($arDelivery['CHECKED'] != 'Y') echo ' disabled' ?>
                                               value="&nbsp;<?= $arResult['SAVED']['delivery']['HOUSE'] ?>">
                                    </div>
                                    <div class="basket-products__registration-input-box" style="display: none">
                                        <label class="basket-products__registration-label">Квартира</label>
                                        <input class="basket-products__registration-input" type="text" name="APARTMENT"<? if ($arDelivery['CHECKED'] != 'Y') echo ' disabled' ?>
                                               value="&nbsp;<?= $arResult['SAVED']['delivery']['APARTMENT'] ?>">
                                    </div>
                                </div>
                            </div>
                        <? } ?>
                    </div>
                <? } ?>
            </div>
        </div>
        <button class="basket-products__next-button">Далее
            <div class="basket-products__next-button-icon"></div>
        </button>
        <div class="tq_errors"></div>

    </form>
    <? include 'order_info.php' ?>
</div>