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
<div class="department-contacts">
    <div class="container">
        <div class="title">Контакты отдела по работе с партнерами</div>
        <div class="department-contacts__inner">
            <div class="department-contacts__image-box">
                <?if($arResult['PREVIEW_PICTURE']['SRC']){?>
                    <img class="department-contacts__image" src="<?=$arResult['PREVIEW_PICTURE']['SRC']?>">
                <?}?>
            </div>
            <div class="department-contacts__information">
                <div class="department-contacts__name"><?=$arResult['NAME']?></div>
                <div class="department-contacts__position"><?=$arResult['PROPERTIES']['POSITION']['VALUE']?></div>
                <div class="department-contacts__contacts">
                    <div class="department-contacts__tel department-contacts__tel">
                        <?foreach ($arResult['PROPERTIES']['PHONES']['VALUE'] as $phone){?>
                          <?if(strlen($phone)>0){?>
                            <p>Тел. <?=$phone?></p>
                          <?}?>
                        <?}?>
                    </div>
                    <?if($arResult['PROPERTIES']['EMAIL']['VALUE']){?>
                        <a class="department-contacts__mail" href="mailto:<?=$arResult['PROPERTIES']['EMAIL']['VALUE']?>"><?=$arResult['PROPERTIES']['EMAIL']['VALUE']?></a>
                    <?}?>
                </div>
            </div>
        </div>
    </div>
</div>
