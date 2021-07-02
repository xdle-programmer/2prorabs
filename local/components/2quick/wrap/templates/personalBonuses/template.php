<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<div class="personal-area__block">
    <div class="personal-area__block-inner">
        <div class="personal-area__block-title">Ваши бонусы</div>
        <div class="personal-area__bonuses-value">
            <div class="personal-area__bonuses-value-title">Бонусные баллы:</div>
            <div class="personal-area__bonuses-value-text"><?=round($arResult['SCORE']['CURRENT_BUDGET'], 0, PHP_ROUND_HALF_UP)?></div>
        </div>
        <div class="personal-area__text-small"><?=$arResult['SCORE']['NOTES']?></div>
        <div class="personal-area__title-small">Как использовать бонусы</div>
        <div class="personal-area__text-small personal-area__text-small--mb-large">
          <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
              "AREA_FILE_SHOW" => "file",
              "AREA_FILE_SUFFIX" => "inc",
              "EDIT_TEMPLATE" => "",
              "PATH" =>"/local/include/personal/bonuses/subtitle.php"
            )
          );?>
        </div>
        <?if($arResult['ORDERS']){?>
        <div class="personal-area__title-small">История бонусов</div>
        <div class="personal-area__tab-history-block">
            <div class="personal-area__tab-history">
                <div class="personal-area__tab-history-head">
                    <div class="personal-area__bonuses-head-row">
                        <div class="personal-area__tab-history-col">
                            <div class="personal-area__tab-history-title">Дата:</div>
                        </div>
                        <div class="personal-area__tab-history-col">
                            <div class="personal-area__tab-history-title">Номер заказа:</div>
                        </div>
                        <div class="personal-area__tab-history-col">
                            <div class="personal-area__tab-history-title">Сумма заказа:</div>
                        </div>
                        <div class="personal-area__tab-history-col">
                            <div class="personal-area__tab-history-title">Статус баллов:</div>
                        </div>
                    </div>
                </div>
                <div class="personal-area__tab-history-inner">
                    <?foreach ($arResult["ORDERS"] as $key => $arOrder){?>
                        <div class="personal-area__tab-history-row">
                            <div class="personal-area__tab-history-col">
                                <div class="personal-area__tab-history-text"><?=FormatDate("d.m.Y", MakeTimeStamp($arOrder["DATE_INSERT"]))?></div>
                            </div>
                            <div class="personal-area__tab-history-col">
                                <div class="personal-area__tab-history-text">№ <?=$arOrder['ID']?></div>
                            </div>
                            <div class="personal-area__tab-history-col">
                                <div class="personal-area__tab-history-text"><?=$arOrder['PRICE']?> <?=$arOrder['CURRENCY']?></div>
                            </div>
                            <div class="personal-area__tab-history-col">
                                <div class="personal-area__bonuses-amount <?=($arOrder['TRANSACTION']['DEBIT'] =='Y' ? '' : 'personal-area__bonuses-amount--red')?>"><?=($arOrder['TRANSACTION']['DEBIT'] =='Y' ? '+' : '-')?><?=round($arOrder['TRANSACTION']['AMOUNT'], 0, PHP_ROUND_HALF_UP)?></div>
                            </div>
                        </div>
                    <?}?>
                </div>
            </div>
        </div>
        <?}else{?>
            <div class="personal-area__title-small">История бонусов пуста</div>
        <?}?>
    </div>
</div>