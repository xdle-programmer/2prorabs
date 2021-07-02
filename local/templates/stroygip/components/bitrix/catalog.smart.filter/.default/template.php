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

<div class="catalog-category__bar">
    <?if($arResult['PARENT_SECTION']['NAME']){?>
    <div class="catalog-category__bar-title"><?= $arResult['PARENT_SECTION']['NAME']?></div>
    <?}?>
    <div class="catalog-category__category-title"><?= $arResult['CURRENT_SECTION']['NAME']?></div>
    <?if($arResult['SECT']){?>
        <?foreach ($arResult['SECT'] as $arSection){?>
            <?if($arSection['CHILD']){?>
        <div class="catalog-category__category-name"><?=$arSection['NAME']?>
            <div class="catalog-category__category-arrow"></div>
        </div>
        <div class="catalog-category__category-content">
            <?foreach ($arSection['CHILD'] as $arChild){?>
            <a class="catalog-category__category-link" href="<?=$arChild['SECTION_PAGE_URL']?>"><?=$arChild['NAME']?></a>
                    <?}?>
        </div>
                <?}else{?>
                <a class="catalog-category__category-name" href="<?=$arSection['SECTION_PAGE_URL']?>"><?=$arSection['NAME']?></a>
                <?}?>
            <?}?>
    <?}?>
    <form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
        <?foreach($arResult["HIDDEN"] as $arItem):?>
            <input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
        <?endforeach;?>

            <?foreach($arResult["ITEMS"] as $key=>$arItem)//prices
            {
                $key = $arItem["ENCODED_ID"];
                if(isset($arItem["PRICE"])):
                    if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
                        continue;

                    $step_num = 4;
                    $step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / $step_num;
                    $prices = array();
                    if (Bitrix\Main\Loader::includeModule("currency"))
                    {
                        for ($i = 0; $i < $step_num; $i++)
                        {
                            $prices[$i] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MIN"]["VALUE"] + $step*$i, $arItem["VALUES"]["MIN"]["CURRENCY"], false);
                        }
                        $prices[$step_num] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MAX"]["VALUE"], $arItem["VALUES"]["MAX"]["CURRENCY"], false);
                    }
                    else
                    {
                        $precision = $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0;
                        for ($i = 0; $i < $step_num; $i++)
                        {
                            $prices[$i] = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step*$i, $precision, ".", "");
                        }
                        $prices[$step_num] = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
                    }
                    ?>
                    <div class="catalog-category__category-title catalog-category__category-price">Цена</div>
                    <div class="catalog-category__range-slider">
                        <!--<input class="js-range-slider" type="text" name="my_range" value="">-->
                        <div class="catalog-category__range-container">
                            <div class="catalog-category__range-box">
                                <input class="catalog-category__range-input"
                                       type="text"
                                       value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
                                       name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
                                       id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
                                       onkeyup="smartFilter.keyup(this)">
                                <p class="catalog-category__range-text">От</p>
                                <div class="catalog-category__range-reset"><img src="<?=SITE_TEMPLATE_PATH?>/assets/src/images/icons/reset.svg"></div>
                            </div>
                            <div class="catalog-category__range-box">
                                <input class="catalog-category__range-input"
                                       type="text"
                                       value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
                                       name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
                                       id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
                                       onkeyup="smartFilter.keyup(this)">
                                <p class="catalog-category__range-text">До</p>
                                <div class="catalog-category__range-reset"><img src="<?=SITE_TEMPLATE_PATH?>/assets/src/images/icons/reset.svg"></div>
                            </div>
                        </div>
                    </div>
                <?endif;
            }

            //not prices
            foreach($arResult["ITEMS"] as $key=>$arItem)
            {
                if(
                    empty($arItem["VALUES"])
                    || isset($arItem["PRICE"])
                )
                    continue;

                if (
                    $arItem["DISPLAY_TYPE"] == "A"
                    && (
                        $arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0
                    )
                )
                    continue;
                ?>
                <div class="catalog-category__category-title catalog-category__category-price"><?=$arItem['NAME']?></div>

                            <?
                            $arCur = current($arItem["VALUES"]);
                            switch ($arItem["DISPLAY_TYPE"])
                            {
                            default://CHECKBOXES
                                if($arItem['CODE']=='COLOR'){
                                    $cnt = 0;
                                    $arFirstColors = [];
                                    $arSecColors = [];
                                    foreach ($arItem["VALUES"] as $val => $ar) {
                                        $cnt++;
                                        if($cnt<=6)
                                            $arFirstColors[] = $ar;
                                        else
                                            $arSecColors[] = $ar;
                                    }
                                    $arFirstColors = array_chunk($arFirstColors,ceil(count($arFirstColors)/2));
                                    $arSecColors = array_chunk($arSecColors,ceil(count($arSecColors)/2));

                                    ?>
                                    <div class="catalog-category__color-box">
                                        <?foreach ($arFirstColors as $arFirstColor){?>
                                            <div class="catalog-category__select-color">
                                                <?foreach ($arFirstColor as $ar){?>
                                                    <div class="catalog-category__checkbox-box">
                                                        <input
                                                                class="catalog-category__checkbox-input"
                                                                type="checkbox"
                                                                value="<? echo $ar["HTML_VALUE"] ?>"
                                                                name="<? echo $ar["CONTROL_NAME"] ?>"
                                                                id="<? echo $ar["CONTROL_ID"] ?>"
                                                            <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                                                onclick="smartFilter.click(this)"
                                                        />
                                                        <label class="catalog-category__checkbox-label" for="<? echo $ar["CONTROL_ID"] ?>"><span class="catalog-category__color catalog-category__color--<?=$ar['URL_ID']?>"></span><?=$ar["VALUE"];?></label>
                                                    </div>
                                            <?}?>
                                            </div>
                                        <?}?>
                                    </div>
                                   <?if($arSecColors){?>
                                    <div class="catalog-category__box-hidden">
                                        <div class="catalog-category__color-box">
                                            <?foreach ($arSecColors as $arSecColor){?>
                                                <div class="catalog-category__select-color">
                                                    <?foreach ($arSecColor as $ar){?>
                                                        <div class="catalog-category__checkbox-box">
                                                            <input
                                                                    class="catalog-category__checkbox-input"
                                                                    type="checkbox"
                                                                    value="<? echo $ar["HTML_VALUE"] ?>"
                                                                    name="<? echo $ar["CONTROL_NAME"] ?>"
                                                                    id="<? echo $ar["CONTROL_ID"] ?>"
                                                                <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                                                    onclick="smartFilter.click(this)"
                                                            />
                                                            <label class="catalog-category__checkbox-label" for="<? echo $ar["CONTROL_ID"] ?>"><span class="catalog-category__color catalog-category__color--<?=$ar['URL_ID']?>"></span><?=$ar["VALUE"];?></label>
                                                        </div>
                                                    <?}?>
                                                </div>
                                            <?}?>
                                        </div>
                                    </div>
                                        <a class="catalog-category__see-all">Посмотреть все<img class="catalog-category__see-arrow" src="<?=SITE_TEMPLATE_PATH?>/assets/src/images/icons/select-bottom.svg"></a>
                                    <?}?>

                                    <?
                                }else{?>
                                    <?$cnt = 0;
                                    foreach ($arItem["VALUES"] as $ar){
                                        $cnt++;?>
                                    <div class="catalog-category__checkbox-box">
                                        <input
                                                class="catalog-category__checkbox-input"
                                                type="checkbox"
                                                value="<? echo $ar["HTML_VALUE"] ?>"
                                                name="<? echo $ar["CONTROL_NAME"] ?>"
                                                id="<? echo $ar["CONTROL_ID"] ?>"
                                            <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                                onclick="smartFilter.click(this)"
                                        />
                                        <label class="catalog-category__checkbox-label" for="<? echo $ar["CONTROL_ID"] ?>"><?=$ar["VALUE"];?></label>
                                    </div>
                                        <?if($cnt==3)break;
                                    }
                                    if(count($arItem["VALUES"])>3){
                                        ?>
                                        <div class="catalog-category__box-hidden">
                                            <?$cnt = 0;
                                            foreach ($arItem["VALUES"] as $val => $ar){
                                            $cnt++;
                                                if($cnt<=3)continue;?>
                                            <div class="catalog-category__checkbox-box">
                                                <input
                                                        class="catalog-category__checkbox-input"
                                                        type="checkbox"
                                                        value="<? echo $ar["HTML_VALUE"] ?>"
                                                        name="<? echo $ar["CONTROL_NAME"] ?>"
                                                        id="<? echo $ar["CONTROL_ID"] ?>"
                                                    <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                                        onclick="smartFilter.click(this)"
                                                />
                                                <label class="catalog-category__checkbox-label" for="<? echo $ar["CONTROL_ID"] ?>"><?=$ar["VALUE"];?></label>
                                            </div>
                                            <?
                                            }?>
                                        </div>
                                        <a class="catalog-category__see-all">Посмотреть все<img class="catalog-category__see-arrow" src="<?=SITE_TEMPLATE_PATH?>/assets/src/images/icons/select-bottom.svg"></a>
                                        <?}
                                }?>

                            <?}?>

                <?
            }
            ?>

        <div class="catalog-category__filter-buttons">
            <input
                    class="button button--red catalog-category__filter-button"
                    type="submit"
                    id="set_filter"
                    name="set_filter"
                    value="Применить"
            />
            <input
                    class="button button--light-blue catalog-category__filter-button"
                    type="submit"
                    id="del_filter"
                    name="del_filter"
                    value="Очистить"
            />
        </div>

    </form>
</div>



<script type="text/javascript">
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>