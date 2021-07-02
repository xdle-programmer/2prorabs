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

<div class="news__inner">
    <div class="news__tabs">
        <div class="news__tab"> Свежее</div>
        <div class="news__tab news__tab--active"> Лайфхаки</div>
        <div class="news__tab"> Новинки</div>
        <div class="news__tab"> Обзоры</div>
        <div class="news__tab"> Интересное</div>
        <div class="news__tab"> Тенденции</div>
    </div>
    <div class="news__inside"><a class="news__back" href="<?=$arResult['LIST_PAGE_URL']?>">
            <div class="news__back-arrow"></div>Назад</a>
        <div class="news__inside-inner">
            <div class="news__post-date"><?=$arResult['DISPLAY_ACTIVE_FROM']?></div>
            <div class="news__post-title"><?=$arResult['NAME']?></div>
            <div class="news__post-image-block">
                <?if($arResult['DETAIL_PICTURE']['SRC']){?>
                    <img class="news__post-image" src="<?=$arResult['DETAIL_PICTURE']['SRC']?>">
                <?}?>
            </div>
            <?=$arResult['DETAIL_TEXT']?>
        </div>
    </div>
</div>