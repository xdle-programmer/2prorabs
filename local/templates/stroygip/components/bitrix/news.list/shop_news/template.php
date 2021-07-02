<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
<div class="shop-news">
    <div class="container">
        <div class="shop-news__item"><img src="<?=SITE_TEMPLATE_PATH?>/assets/src/images/news-shop.png">
            <div class="shop-news__carousel owl-carousel owl-theme">
                <?foreach ($arResult["ITEMS"] as $arItem){?>
                    <div class="shop-news__about">
                        <div class="shop-news__title"><?=$arItem['NAME']?></div>
                        <div class="shop-news__text"><?=$arItem['PREVIEW_TEXT']?></div>
                    </div>
                <?}?>
            </div>
            <div class="shop-news__help">
                <div class="shop-news__help-title">Остались вопросы?</div>
                <div class="shop-news__help-text">
                  <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                      "AREA_FILE_SHOW" => "file",
                      "AREA_FILE_SUFFIX" => "inc",
                      "EDIT_TEMPLATE" => "",
                      "PATH" =>"/local/include/".SITE_ID."/index/phone.php"
                    )
                  );?>
                </div>
            </div>
        </div>
    </div>
</div>
