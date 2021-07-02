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
if($arResult['ITEMS']) {
  $db_list = CIBlockSection::GetList(['SORT'=>'DESC'], ['IBLOCK_ID'=>$arParams["IBLOCK_ID"], 'ACTIVE'=>'Y', ], false,["NAME","ID",'SORT','IBLOCK_ID'],false);
  while($ar_result = $db_list->GetNext())
  {
    $arResult['SECTIONS'][] = $ar_result;
  }
}

