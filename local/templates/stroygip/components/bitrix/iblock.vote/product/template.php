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

CJSCore::Init(array("ajax"));
//Let's determine what value to display: rating or average ?

if ($arParams["DISPLAY_AS_RATING"] == "vote_avg") {
    if ($arResult["PROPERTIES"]["vote_count"]["VALUE"])
        $displayValue = round($arResult["PROPERTIES"]["vote_sum"]["VALUE"] / $arResult["PROPERTIES"]["vote_count"]["VALUE"], 2);
    else
        $displayValue = 0;
} else {
    $displayValue = (float) $arResult["PROPERTIES"]["rating"]["VALUE"];
}

if ($arResult["VOTED"] || $arParams["READ_ONLY"] === "Y") {
    $onClick = null;
} else {
    $onClick = "voteScript.do_vote(this, 'vote_" . $arResult["ID"] . "', " . $arResult["AJAX_PARAMS"] . ")";
}
?>
<div class="rating product-rating <? if (empty($onClick)): ?>rating--readonly<? endif; ?>" id="vote_<?echo $arResult["ID"]?>" <? if (empty($_GET['AJAX_CALL'])): ?>style="display: none;"<? endif; ?>>
    <? foreach ($arResult["VOTE_NAMES"] as $index => $name): ?>
        <div
            id="vote_<?=$arResult['ID'] . '_' . $index?>"
            class="rating__star <?=($index < $displayValue ? 'active' : '')?>"
            <? if ($onClick): ?>onclick="<?=$onClick?>"<? endif; ?>
        ></div>
    <? endforeach; ?>
</div>
<script type="text/javascript">
if(!window.voteScript) window.voteScript =
{
	trace_vote: function(div, flag)
	{
		var my_div;
		var r = div.id.match(/^vote_(\d+)_(\d+)$/);
		for(var i = r[2]; i >= 0; i--)
		{
			my_div = document.getElementById('vote_'+r[1]+'_'+i);
			if(my_div)
			{
				if(flag)
				{
					if(!my_div.saved_class)
						my_div.saved_className = my_div.className;
					if(my_div.className!='star-active star-over')
						my_div.className = 'star-active star-over';
				}
				else
				{
					if(my_div.saved_className && my_div.className != my_div.saved_className)
						my_div.className = my_div.saved_className;
				}
			}
		}
		i = r[2]+1;
		while(my_div = document.getElementById('vote_'+r[1]+'_'+i))
		{
			if(my_div.saved_className && my_div.className != my_div.saved_className)
				my_div.className = my_div.saved_className;
			i++;
		}
	},
	do_vote: function(div, parent_id, arParams)
	{
		var r = div.id.match(/^vote_(\d+)_(\d+)$/);

		var vote_id = r[1];
		var vote_value = r[2];

		function __handler(data)
		{
			var obContainer = document.getElementById(parent_id);
			if (obContainer)
			{
				var obResult = document.createElement("DIV");
				obResult.innerHTML = data;
				obContainer.parentNode.replaceChild(obResult.firstChild, obContainer);
			}
		}

		//BX('wait_' + parent_id).innerHTML = BX.message('JS_CORE_LOADING');
		arParams['vote'] = 'Y';
		arParams['vote_id'] = vote_id;
		arParams['rating'] = vote_value;
		BX.ajax.post(
			'/bitrix/components/bitrix/iblock.vote/component.php',
			arParams,
			__handler
		);
	}
}
</script>
