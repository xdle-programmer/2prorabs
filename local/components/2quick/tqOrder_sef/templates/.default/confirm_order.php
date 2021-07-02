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
    <form class="basket-products__container" id="save_order">
        <div class="basket-products__title"><?=$APPLICATION->ShowTitle(false)?></div>
        <?include 'tabs.php';?>
        <div class="basket-products__title basket-products__title--medium-center basket-products__title--mb">Подтверждение</div>
        <div class="basket-products__registration-inner">
            <div class="basket-products__registration-title basket-products__registration-title--mb">Проверьте правильность оформления</div>
            <div class="basket-products__confirmation-item">
                <div class="basket-products__confirmation-title">Получатель:</div>
                <div class="basket-products__confirmation-data">
                    <div class="basket-products__confirmation-text">
                        <?=sprintf('%s %s',$arResult['SAVED']['delivery']['LAST_NAME'],$arResult['SAVED']['delivery']['NAME'])?> <br>
                        <?=$arResult['SAVED']['delivery']['PHONE']? sprintf('Тел.: %s<br>',$arResult['SAVED']['delivery']['PHONE']):''?>
                        <?=$arResult['SAVED']['delivery']['EMAIL']? sprintf('E-mail.: %s<br>',$arResult['SAVED']['delivery']['EMAIL']):''?>
                    </div><a class="basket-products__confirmation-link" href="<?= $arResult['TABS']['0']['URL'] ?>">Изменить</a>
                </div>
            </div>

            <div class="basket-products__confirmation-item">
                <div class="basket-products__confirmation-title">Способ доставки:</div>
                <div class="basket-products__confirmation-data">
                    <?if($arResult['DELIVERIES'][$arResult['SAVED']['delivery']['delivery_id']]){?>
                    <div class="basket-products__confirmation-text"><?=$arResult['DELIVERIES'][$arResult['SAVED']['delivery']['delivery_id']]['NAME']?> <br>
                        <?if($arResult['DELIVERIES'][$arResult['SAVED']['delivery']['delivery_id']]['STORES'][$arResult['SAVED']['delivery']['POINT']]){?>
                        <div class="basket-products__confirmation-address"><?=$arResult['DELIVERIES'][$arResult['SAVED']['delivery']['delivery_id']]['STORES'][$arResult['SAVED']['delivery']['POINT']]['NAME']?></div>
                            <?if($arResult['DELIVERIES'][$arResult['SAVED']['delivery']['delivery_id']]['STORES'][$arResult['SAVED']['delivery']['POINT']]['PROPERTIES']['DELIVERY_DAY']['VALUE']){
                                $date = new DateTime(date('d.m.Y'));
                                $date->add(new DateInterval('P'.intval($arResult['DELIVERIES'][$arResult['SAVED']['delivery']['delivery_id']]['STORES'][$arResult['SAVED']['delivery']['POINT']]['PROPERTIES']['DELIVERY_DAY']['VALUE']).'D'));
                                $day = FormatDate('l',MakeTimeStamp($date->format('d.m.Y h:i:s')))
                                ?>
                                Можно забрать <?if($day == 'Вторник')echo 'во';else echo 'в'?> <?=strtolower($day)?>, <?=FormatDate(' d F',MakeTimeStamp($date->format('d.m.Y h:i:s')))?>, <?=$arResult['DELIVERIES'][$arResult['SAVED']['delivery']['delivery_id']]['PRICE_FORMATED']?>
                            <?}?>
                        <div class="basket-products__confirmation-pay"><?=$arResult['DELIVERIES'][$arResult['SAVED']['delivery']['delivery_id']]['STORES'][$arResult['SAVED']['delivery']['POINT']]['PREVIEW_TEXT']?></div>
                        <?}else{?>
                            <?=$arResult['SAVED']['delivery']['CITY']? sprintf('Адрес: %s<br>',$arResult['SAVED']['delivery']['CITY']):''?>
                            <?/*=$arResult['SAVED']['delivery']['STREET']? sprintf('Улица.: %s<br>',$arResult['SAVED']['delivery']['STREET']):''?>
                            <?=$arResult['SAVED']['delivery']['HOUSE']? sprintf('Дом.: %s<br>',$arResult['SAVED']['delivery']['HOUSE']):''?>
                            <?=$arResult['SAVED']['delivery']['APARTMENT']? sprintf('Квартира.: %s<br>',$arResult['SAVED']['delivery']['APARTMENT']):''*/?>
                        <?}?>
                    </div>
                    <?}?>
                    <a class="basket-products__confirmation-link" href="<?= $arResult['TABS']['0']['URL'] ?>">Изменить</a>
                </div>
            </div>

            <div class="basket-products__confirmation-item">
                <div class="basket-products__confirmation-title">Способ оплаты:</div>
                <div class="basket-products__confirmation-data">
                    <div class="basket-products__confirmation-text"><?=$arResult['PAYMENT'][$arResult['SAVED']['payment']['payment']]['NAME']?>
                        <div class="basket-products__confirmation-pay"><?=$arResult['PAYMENT'][$arResult['SAVED']['payment']['payment']]['DESCRIPTION']?></div>
                    </div><a class="basket-products__confirmation-link" href="<?= $arResult['TABS']['1']['URL'] ?>">Изменить</a>
                </div>
            </div>

            <div class="basket-products__confirmation-item">
                <div class="basket-products__confirmation-title">Комментарий к заказу:</div>
                <div class="basket-products__confirmation-data">
                    <div class="basket-products__confirmation-text">
                        <textarea class="checkout__comment-textarea" rows="4" name="comment"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <button class="basket-products__next-button">Подтвердить
            <div class="basket-products__next-button-icon"></div>
        </button>
        <div class="tq_errors"></div>

    </form>
    <?include 'order_info.php'?>
</div>