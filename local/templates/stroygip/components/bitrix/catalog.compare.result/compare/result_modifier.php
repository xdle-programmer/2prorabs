<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @global array $arParams */
use Bitrix\Main\Type\Collection;

$arParams['TEMPLATE_THEME'] = (string)($arParams['TEMPLATE_THEME']);
if ($arParams['TEMPLATE_THEME'] != '')
{
	$arParams['TEMPLATE_THEME'] = preg_replace('/[^a-zA-Z0-9_\-\(\)\!]/', '', $arParams['TEMPLATE_THEME']);
	if ($arParams['TEMPLATE_THEME'] == 'site')
	{
		$templateId = COption::GetOptionString("main", "wizard_template_id", "eshop_bootstrap", SITE_ID);
		$templateId = (preg_match("/^eshop_adapt/", $templateId)) ? "eshop_adapt" : $templateId;
		$arParams['TEMPLATE_THEME'] = COption::GetOptionString('main', 'wizard_'.$templateId.'_theme_id', 'blue', SITE_ID);
	}
	if ($arParams['TEMPLATE_THEME'] != '')
	{
		if (!is_file($_SERVER['DOCUMENT_ROOT'].$this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css'))
			$arParams['TEMPLATE_THEME'] = '';
	}
}
if ($arParams['TEMPLATE_THEME'] == '')
	$arParams['TEMPLATE_THEME'] = 'blue';

$arResult['ALL_FIELDS'] = array();
$existShow = !empty($arResult['SHOW_FIELDS']);
$existDelete = !empty($arResult['DELETED_FIELDS']);
if ($existShow || $existDelete)
{
	if ($existShow)
	{
		foreach ($arResult['SHOW_FIELDS'] as $propCode)
		{
			$arResult['SHOW_FIELDS'][$propCode] = array(
				'CODE' => $propCode,
				'IS_DELETED' => 'N',
				'ACTION_LINK' => str_replace('#CODE#', $propCode, $arResult['~DELETE_FEATURE_FIELD_TEMPLATE']),
				'SORT' => $arResult['FIELDS_SORT'][$propCode]
			);
		}
		unset($propCode);
		$arResult['ALL_FIELDS'] = $arResult['SHOW_FIELDS'];
	}
	if ($existDelete)
	{
		foreach ($arResult['DELETED_FIELDS'] as $propCode)
		{
			$arResult['ALL_FIELDS'][$propCode] = array(
				'CODE' => $propCode,
				'IS_DELETED' => 'Y',
				'ACTION_LINK' => str_replace('#CODE#', $propCode, $arResult['~ADD_FEATURE_FIELD_TEMPLATE']),
				'SORT' => $arResult['FIELDS_SORT'][$propCode]
			);
		}
		unset($propCode, $arResult['DELETED_FIELDS']);
	}
	Collection::sortByColumn($arResult['ALL_FIELDS'], array('SORT' => SORT_ASC));
}

$arResult['ALL_PROPERTIES'] = array();
$existShow = !empty($arResult['SHOW_PROPERTIES']);
$existDelete = !empty($arResult['DELETED_PROPERTIES']);
if ($existShow || $existDelete)
{
	if ($existShow)
	{
		foreach ($arResult['SHOW_PROPERTIES'] as $propCode => $arProp)
		{
			$arResult['SHOW_PROPERTIES'][$propCode]['IS_DELETED'] = 'N';
			$arResult['SHOW_PROPERTIES'][$propCode]['ACTION_LINK'] = str_replace('#CODE#', $propCode, $arResult['~DELETE_FEATURE_PROPERTY_TEMPLATE']);
		}
		$arResult['ALL_PROPERTIES'] = $arResult['SHOW_PROPERTIES'];
	}
	unset($arProp, $propCode);
	if ($existDelete)
	{
		foreach ($arResult['DELETED_PROPERTIES'] as $propCode => $arProp)
		{
			$arResult['DELETED_PROPERTIES'][$propCode]['IS_DELETED'] = 'Y';
			$arResult['DELETED_PROPERTIES'][$propCode]['ACTION_LINK'] = str_replace('#CODE#', $propCode, $arResult['~ADD_FEATURE_PROPERTY_TEMPLATE']);
			$arResult['ALL_PROPERTIES'][$propCode] = $arResult['DELETED_PROPERTIES'][$propCode];
		}
		unset($arProp, $propCode, $arResult['DELETED_PROPERTIES']);
	}
	Collection::sortByColumn($arResult["ALL_PROPERTIES"], array('SORT' => SORT_ASC, 'ID' => SORT_ASC));
}

$arResult["ALL_OFFER_FIELDS"] = array();
$existShow = !empty($arResult["SHOW_OFFER_FIELDS"]);
$existDelete = !empty($arResult["DELETED_OFFER_FIELDS"]);
if ($existShow || $existDelete)
{
	if ($existShow)
	{
		foreach ($arResult["SHOW_OFFER_FIELDS"] as $propCode)
		{
			$arResult["SHOW_OFFER_FIELDS"][$propCode] = array(
				"CODE" => $propCode,
				"IS_DELETED" => "N",
				"ACTION_LINK" => str_replace('#CODE#', $propCode, $arResult['~DELETE_FEATURE_OF_FIELD_TEMPLATE']),
				'SORT' => $arResult['FIELDS_SORT'][$propCode]
			);
		}
		unset($propCode);
		$arResult['ALL_OFFER_FIELDS'] = $arResult['SHOW_OFFER_FIELDS'];
	}
	if ($existDelete)
	{
		foreach ($arResult['DELETED_OFFER_FIELDS'] as $propCode)
		{
			$arResult['ALL_OFFER_FIELDS'][$propCode] = array(
				"CODE" => $propCode,
				"IS_DELETED" => "Y",
				"ACTION_LINK" => str_replace('#CODE#', $propCode, $arResult['~ADD_FEATURE_OF_FIELD_TEMPLATE']),
				'SORT' => $arResult['FIELDS_SORT'][$propCode]
			);
		}
		unset($propCode, $arResult['DELETED_OFFER_FIELDS']);
	}
	Collection::sortByColumn($arResult['ALL_OFFER_FIELDS'], array('SORT' => SORT_ASC));
}

$arResult['ALL_OFFER_PROPERTIES'] = array();
$existShow = !empty($arResult["SHOW_OFFER_PROPERTIES"]);
$existDelete = !empty($arResult["DELETED_OFFER_PROPERTIES"]);
if ($existShow || $existDelete)
{
	if ($existShow)
	{
		foreach ($arResult['SHOW_OFFER_PROPERTIES'] as $propCode => $arProp)
		{
			$arResult["SHOW_OFFER_PROPERTIES"][$propCode]["IS_DELETED"] = "N";
			$arResult["SHOW_OFFER_PROPERTIES"][$propCode]["ACTION_LINK"] = str_replace('#CODE#', $propCode, $arResult['~DELETE_FEATURE_OF_PROPERTY_TEMPLATE']);
		}
		unset($arProp, $propCode);
		$arResult['ALL_OFFER_PROPERTIES'] = $arResult['SHOW_OFFER_PROPERTIES'];
	}
	if ($existDelete)
	{
		foreach ($arResult['DELETED_OFFER_PROPERTIES'] as $propCode => $arProp)
		{
			$arResult["DELETED_OFFER_PROPERTIES"][$propCode]["IS_DELETED"] = "Y";
			$arResult["DELETED_OFFER_PROPERTIES"][$propCode]["ACTION_LINK"] = str_replace('#CODE#', $propCode, $arResult['~ADD_FEATURE_OF_PROPERTY_TEMPLATE']);
			$arResult['ALL_OFFER_PROPERTIES'][$propCode] = $arResult["DELETED_OFFER_PROPERTIES"][$propCode];
		}
		unset($arProp, $propCode, $arResult['DELETED_OFFER_PROPERTIES']);
	}
	Collection::sortByColumn($arResult['ALL_OFFER_PROPERTIES'], array('SORT' => SORT_ASC, 'ID' => SORT_ASC));
}
if($arResult['ITEMS']){
    $arResult['SECTIONS'] = [];
    $ids = [];
    $arSectionTrue = [];
    foreach ($arResult['ITEMS'] as $key=> $arItem){
        $arCats = [];
        if(!$ids[$arItem['IBLOCK_SECTION_ID']]){
                $nav = CIBlockSection::GetNavChain(false,$arItem['IBLOCK_SECTION_ID'],['ID','NAME']);
                while($arSectionPath = $nav->GetNext()){
                    $arCats[] = $arSectionPath;

                }
            $arResult['SECTIONS'][$arCats[0]['ID']] = $arCats[0];
            $ids[$arItem['IBLOCK_SECTION_ID']] = $arItem['IBLOCK_SECTION_ID'];
            $arSectionTrue[$arItem['IBLOCK_SECTION_ID']] = $arCats[0]['ID'];
            }

    }
    if($arResult['SECTIONS']){
        array_unshift($arResult['SECTIONS'], ['NAME' => 'Все товары', 'LINK' => $APPLICATION->GetCurPage()]);
        foreach ($arResult['SECTIONS'] as &$arSection){
            if($arParams['SECTION_ID'] == $arSection['ID']){
                $arSection['ACTIVE'] = 'Y';
                $arResult['CURRENT_SECTION'] = $arSection;
            }if($arSection['ID'])
                $arSection['LINK'] = sprintf('?section_id=%s',$arSection['ID']);

        }
    }
    if($arResult['CURRENT_SECTION']['ID'])
    foreach ($arResult['ITEMS'] as $key=> $arItem){
        if($arSectionTrue[$arItem['IBLOCK_SECTION_ID']] !=$arResult['CURRENT_SECTION']['ID'])
            unset($arResult['ITEMS'][$key]);
    }
    foreach ($arResult['ITEMS'] as $key=> $arItem){
       $arResult['ITEM_IDS'][] = $arItem['ID'];
    }

    foreach ($arResult['SHOW_PROPERTIES'] as $key => $arPropertyToShow) {
        $show = false;
        foreach ($arResult['ITEMS'] as $arItem){
            if(!empty($arItem['PROPERTIES'][$key]['VALUE']))
            $show = true;
        }
        if($show)
        $arResult['PROPERTIES_TO_SHOW'][$key] = $arPropertyToShow['NAME'];
    }
	
	$arResult['PROPERTIES_TO_SHOW']['MANUFACTURER'] = 'Страна производитель';

	$arResult['PROPS_NOT_SHOW'] = array(
		"MARK",
		"BRAND",
		"RATING2",
		"RECOMEND",
		"MAIN",
		"BENEFITS",
		"BEST_PRICE",
		"BESTSELLER",
		"CHARS",
		"REVIEWS",
		"GALLERY",
		"BYE_WIDTH",
		"REVIEWS_CNT",
		"REF",
		"CODE",
		"_",
		"OLD_PRICE",
		"VIDNOMENKLATURY",
		"BAZOVAYAEDINITSAIZMERENIYA",
		"OSNOVNAYAEDINITSAIZMERENIYA",
		"STAVKANDS",
		"SROKKHRANENIYATOVARA",
		"ZAKRYTA",
		"MENEDZHER",
		"AVTOR",
		"DATA",
		"TIPNOMENKLATURY",
		"OTDEL",
		"KATEGORIYANOMENKLATURYSAYTA",
		"TSENA",
		"NOMENKLATURA_STRANA_PROIS",
		"NOMENKLATURA_TOVARNAYA_MAR",
		"OSTATOK",
		"SHT",
		"FRACTIONAL_PRODUCT",
		"ARTIKUL",
		"NOMENKLATURA_OSNOVNAYA_EDI",
		"vote_count",
		"vote_sum",
		"rating",
		"ITOG",
		"KON_OST",
		"NOMENKLATURA_GLUBINA",
		"NOMENKLATURA_VYSOTA",
		"NOMENKLATURA_SHIRINA",
		"NOMENKLATURA_VES_TOVARA_",
		"PROIZVODITEL",
		"HIDDEN_1C",
	);
}