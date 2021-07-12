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

<div class="catalog-category__filter">
	<div class="catalog-category__filter-header">
		<div class="catalog-category__filter-title">Фильтры</div>
		<div class="catalog-category__filter-close">
			<svg class="catalog-category__filter-close-icon">
				<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#close"></use>
			</svg>
		</div>
	</div> 
	<div class="catalog-category__filter-items catalog-category__filter-items--only-mobile">
		<select class="custom-select">
			<option selected disabled hidden>Сортировка</option>
			<option>Значение сортировки 1</option>
			<option>Значение сортировки 2</option>
			<option>Значение сортировки 3</option>
			<option>Значение сортировки 4</option>
			<option>Значение сортировки 5</option>
			<option>Значение сортировки 6</option>
		</select>
	</div>
	<div class="catalog-category__filter-items catalog-category__filter-items--only-mobile">
		<select class="custom-select">
			<option selected>Показать по 16</option>
			<option>Показать по 24</option>
			<option>Показать по 48</option>
		</select>
	</div>
	
	<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
	    <?foreach($arResult["HIDDEN"] as $arItem):?>
            <input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
        <?endforeach;?>
		
		<?foreach($arResult["ITEMS"] as $key=>$arItem):?>
			<?
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
		<div class="catalog-category__filter-items">
			<div class="catalog-category__filter-items-title">Цена</div>
			<div class="catalog-category__filter-items-range">
				<div class="catalog-category__filter-items-range-item">
					<div class="placeholder placeholder--small">
						<input class="input input--small placeholder__input" 
						placeholder="От"                                        
						type="text" 
						value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>" 
						name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>" 
						id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>" 
						onkeyup="smartFilter.keyup(this)">
						<div class="placeholder__item">От</div>
					</div>
				</div>
				<div class="catalog-category__filter-items-range-separator"></div>
				<div class="catalog-category__filter-items-range-item">
					<div class="placeholder placeholder--small">
						<input class="input input--small placeholder__input" 
						placeholder="До" 
						type="text" 
						value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>" 
						name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>" 
						id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>" 
						onkeyup="smartFilter.keyup(this)">
						<div class="placeholder__item">До</div>
					</div>
				</div>
			</div>
		</div>
			<?endif;?>
		<?endforeach;?>
		
	
		<?if($arResult['SECT']){?>
		<div class="catalog-category__filter-items">
			<div class="catalog-category__filter-items-button">
				<div class="catalog-category__filter-items-button-text"><?=$arResult['CURRENT_SECTION']['NAME']?></div>
				<svg class="catalog-category__filter-items-button-icon">
					<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#arrow"></use>
				</svg>
			</div>
			<div class="catalog-category__filter-list">
			<?foreach ($arResult['SECT'] as $arSection){?>
				<a class="catalog-category__filter-list-item" href="<?=$arSection['SECTION_PAGE_URL']?>"><?=$arSection['NAME']?></a>
			<?}?>
			</div>
		</div>
		<?}?>
		
		
		<?foreach($arResult["ITEMS"] as $key=>$arItem):?>
			<?
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
			
			<?
			$arCur = current($arItem["VALUES"]);
			if( $arItem['CODE'] == 'COLOR' ){
				echo "&nbsp;";
			}else{
				$cnt = 0;
			?>
		<div class="catalog-category__filter-items">
			<div class="catalog-category__filter-items-button">
				<div class="catalog-category__filter-items-button-text"><?=$arItem['NAME']?></div>
				<svg class="catalog-category__filter-items-button-icon">
					<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#arrow"></use>
				</svg>
			</div>
			<div class="catalog-category__filter-list">
			
			
			<?foreach ($arItem["VALUES"] as $ar):?>
				<?
				$cnt++;
				?>
				<label class="checkbox">
					<input class="checkbox__input" 
						type="checkbox"
						value="<? echo $ar["HTML_VALUE"] ?>"
						name="<? echo $ar["CONTROL_NAME"] ?>"
						id="<? echo $ar["CONTROL_ID"] ?>"
						<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
						onclick="smartFilter.click(this)"
					>
					<span class="checkbox__item">
						<svg class="checkbox__icon">
							<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#check"></use>
						</svg>
						<span class="checkbox__text"><?=$ar["VALUE"];?></span>
					</span>
				</label>
			<?endforeach;?>


			</div>
		</div>
			<?}?>
		<?endforeach;?>
		


		<div class="catalog-category__filter-footer">
			<input class="catalog-category__filter-footer-button button button--small button--fill button--gray button--invert" 
			    type="submit"
                id="del_filter"
                name="del_filter"
                value="Очистить"
			>
			<input class="catalog-category__filter-footer-button button button--small button--fill button--gray"
			    type="submit"
                id="set_filter"
                name="set_filter"
                value="Применить"
			>
		</div>
		
	</form>
</div>


<script type="text/javascript">
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>
