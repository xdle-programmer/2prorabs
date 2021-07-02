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
<?if($arResult['ITEMS']){?>
    <section class="cooperation">
    <div class="container">
        <div class="cooperation__box">
            <div class="cooperation__tabs cooperation__tabs--mb cooperation__tabs--width">
                <?$main =0;
                  foreach ($arResult["MAIN"] as $arMain){?>
                    <div class="cooperation__button <?if($main ==0){?>active<?}$main++?>"><?=$arMain['NAME']?></div>
                <?}?>
            </div>
          <?$main =0;
            foreach ($arResult["MAIN"] as $arMain){?>
            <div class="cooperation__content <?if($main ==0){?>active<?}$main++?>">
                <div class="cooperation__delivery-grid">
                    <?foreach ($arResult["SUB"][$arMain['ID']] as $arSub){?>
                        <div class="cooperation__delivery-col">
                            <div class="title title--start cooperation__content-title cooperation__content-title--mb"><?=$arSub['NAME']?></div>
                            <?foreach ($arResult["SORTED_ITEMS"][$arSub['ID']] as $key => $arItem){?>
                              <?
                              $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                              $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                              ?>
                                <div class="cooperation__information" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                    <div class="cooperation__header cooperation__header--money">
                                        <?=htmlspecialchars_decode($arItem['NAME'])?>
                                    </div>
                                    <?=$arItem['PREVIEW_TEXT']?>
                                </div>
                            <?}?>
                        </div>
                    <?}?>
                </div>
            </div>
            <?}?>
        </div>
    </div>
</section>
<?}?>
