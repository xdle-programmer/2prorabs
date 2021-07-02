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
$bxajaxid = CAjax::GetComponentID($component->__name, $component->__template->__name, $component->arParams['AJAX_OPTION_ADDITIONAL']);
?>
<? if ($arResult['ITEMS']) { ?>
    <div class="news__inner">
        <div class="news__tabs">
            <? foreach ($arResult["SECTIONS"] as $key => $arSection) { ?>
                <div data-id='<?= $arSection['ID'] ?>'
                     class="news__tab tqTabs <? if ($arSection['ID'] == $arParams['PARENT_SECTION']) { ?>news__tab--active<? } ?>"> <?= $arSection['NAME'] ?></div>
            <? } ?>
        </div>
        <div class="news__content news__content--active">
            <div class="news__grid">
                <? foreach ($arResult["ITEMS"] as $arItem) { ?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="news__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">

                        <a class="news__image-box" href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
                            <img class="news__image" src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>">
                        </a>

                        <div class="news__item-inner">
                            <div class="news__date"><?= $arItem['DISPLAY_ACTIVE_FROM'] ?><a class="news__name" href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= $arItem['NAME'] ?></a>
                                <div class="news__description">
                                    <?= TruncateText($arItem['PREVIEW_TEXT'], 140); ?>
                                </div>
                                <a class="news__button" href="<?= $arItem['DETAIL_PAGE_URL'] ?>">Подробнее
                                    <div class="news__button-arrow"></div>
                                </a>
                            </div>
                        </div>
                    </div>
                <? } ?>
            </div>
            <? if ($arResult["NAV_RESULT"]->nEndPage > 1 && $arResult["NAV_RESULT"]->NavPageNomer < $arResult["NAV_RESULT"]->nEndPage): ?>
                <div class="news__button-all" id="btn_<?= $bxajaxid ?>">
                    <a class="button button-all" data-ajax-id="<?= $bxajaxid ?>" href="javascript:void(0)" data-show-more="<?= $arResult["NAV_RESULT"]->NavNum ?>"
                       data-next-page="<?= ($arResult["NAV_RESULT"]->NavPageNomer + 1) ?>" data-max-page="<?= $arResult["NAV_RESULT"]->nEndPage ?>">Показать еще</a>
                </div>

                <div class="news__pagination">
                    <? if ($arParams["DISPLAY_BOTTOM_PAGER"]) { ?>
                        <?= $arResult["NAV_STRING"] ?>
                    <? } ?>
                </div>

            <? endif ?>

        </div>
    </div>
<? } ?>