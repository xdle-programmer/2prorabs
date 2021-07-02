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

$arSelect =["IBLOCK_ID","NAME","ID",'IBLOCK_SECTION_ID'];
$arFilter = ['IBLOCK_ID'=>$arParams["IBLOCK_ID"], 'ACTIVE'=>'Y'];
  $db_list = CIBlockSection::GetList([], $arFilter, false,$arSelect,false);
  while($ar_result = $db_list->GetNext())
  {
    if($ar_result['IBLOCK_SECTION_ID']) {
      $arResult['SUB'][$ar_result['IBLOCK_SECTION_ID']][$ar_result['ID']] = $ar_result;
    }else {
      $arResult['MAIN'][$ar_result['ID']] = $ar_result;
    }
  }
  foreach ($arResult['ITEMS'] as $arItem) {
    if($arItem['IBLOCK_SECTION_ID']){
      $arResult['SORTED_ITEMS'][$arItem['IBLOCK_SECTION_ID']][] = $arItem;
    }
  }
