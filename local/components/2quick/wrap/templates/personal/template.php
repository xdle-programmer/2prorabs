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
<div class="personal-area__container">
    <div class="personal-area__who-you-grid">
        <div class="personal-area__who-you">
            <div class="personal-area__who-you-title">Стали прорабом?</div>
            <div class="personal-area__who-you-text">
              <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                  "AREA_FILE_SHOW" => "file",
                  "AREA_FILE_SUFFIX" => "inc",
                  "EDIT_TEMPLATE" => "",
                  "PATH" =>"/local/include/personal/prorab.php"
                )
              );?>
        </div>
        <div class="personal-area__who-you">
            <div class="personal-area__who-you-title">Вы представитель организации?</div>
            <div class="personal-area__who-you-text">
              <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                  "AREA_FILE_SHOW" => "file",
                  "AREA_FILE_SUFFIX" => "inc",
                  "EDIT_TEMPLATE" => "",
                  "PATH" =>"/local/include/personal/jurface.php"
                )
              );?>
            </div>
        </div>
    </div>
    <div class="personal-area__cards-grid">
        <div class="personal-area__card">
            <div class="personal-area__card-icon"><img class="personal-area__card-icon-img" src="<?=SITE_TEMPLATE_PATH?>/assets/src/blocks/personal-area/assets/img/bonuses-1.svg"></div>
            <div class="personal-area__card-inner">
                <div class="personal-area__card-title">Ваши баллы:</div>
                <div class="personal-area__card-scores"><?=round($arResult['SCORE']['CURRENT_BUDGET'], 0, PHP_ROUND_HALF_UP)?></div>
            </div>
        </div>
        <div class="personal-area__card">
            <div class="personal-area__card-icon"><img class="personal-area__card-icon-img" src="<?=SITE_TEMPLATE_PATH?>/assets/src/blocks/personal-area/assets/img/bonuses-2.svg"></div>
            <div class="personal-area__card-inner">
              <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                  "AREA_FILE_SHOW" => "file",
                  "AREA_FILE_SUFFIX" => "inc",
                  "EDIT_TEMPLATE" => "",
                  "PATH" =>"/local/include/personal/bonuses_url.php"
                )
              );?>
            </div>
        </div>
      <?$APPLICATION->IncludeComponent(
        "2quick:wrap",
        "personalPromocode",
        array(
        ),
        false
      );?>
    </div>
    <div class="personal-area__bonuses-item">
        <div class="personal-area__bonuses-inner">
          <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
              "AREA_FILE_SHOW" => "file",
              "AREA_FILE_SUFFIX" => "inc",
              "EDIT_TEMPLATE" => "",
              "PATH" =>"/local/include/personal/bonuses_url_banner.php"
            )
          );?>
        </div>
    </div>
</div>
</div>