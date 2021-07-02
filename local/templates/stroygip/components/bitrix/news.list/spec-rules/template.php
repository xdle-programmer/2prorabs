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
$this->setFrameMode(true);
?>


<section class="cooperation">
    <div class="container">
        <div class="title"><?=GetMessage('RULES_TITLE')?></div>
        <div class="cooperation__box">
            <div class="cooperation__tabs">
                <?foreach ($arResult['SECTIONS_LIST'] as $key => $item):?>
                    <div class="cooperation__button <?if($key == 0):?> active <?endif;?>"><?=$item['NAME']?></div>
                <?endforeach;?>
            </div>
            <?foreach ($arResult['SECTIONS_LIST'] as $key => $item):?>
                <div class="cooperation__content <?if($key == 0):?> active <?endif;?>">
                <div class="cooperation__info">
                    <? foreach ($arResult['SECTION_ITEM'][$item['ID']] as $arItem): ?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="cooperation__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                        <div class="cooperation__icon">
                            <?if(!empty($arItem['PROPERTIES']['SVG']['VALUE'])):?>
                                <img src="<?=CFile::GetPath($arItem['PROPERTIES']['SVG']['VALUE'])?>">
                            <?endif;?>
                        </div>
                        <div class="cooperation__title"><?=$arItem['NAME']?></div>
                        <div class="cooperation__text"><?=$arItem['PREVIEW_TEXT']?></div>
                    </div>
                    <? endforeach; ?>
                </div>
            </div>
            <?endforeach;?>
        </div>
        <?if(!$USER->IsAuthorized()){?>
            <div class="feedback-now feedback-now--mt">
                <div class="container">
                    <div class="feedback-now__inner">
                        <div class="feedback-now__container">
                            <div class="feedback-now__title"><?=GetMessage('REGISTER_TITLE')?></div>
                            <div class="feedback-now__text"><?=GetMessage('REGISTER_TEXT')?></div>
                        </div>
                        <div class="feedback-now__button"><a class="button regButton" href="<?=GetMessage('REGISTER_LINK')?>"><?=GetMessage('REGISTER_NAME')?></a></div>
                    </div>
                </div>
            </div>
        <?}?>
    </div>
</section>
