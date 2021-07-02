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
  \Bitrix\Main\Loader::includeModule('sale');
  $arUser = CUser::GetByID($USER->GetID())->fetch();
  if($arUser['ID']) {
    $arResult['SCORE'] = CSaleUserAccount::GetByUserID($arUser['ID'], "RUB");
  }

$arSelect = Array("ID", "NAME", "IBLOCK_SECTION_ID", "PROPERTY_URL", "CODE");
$arFilter = Array("IBLOCK_ID"=>IntVal(IBLOCK_PERSONAL_MENU), "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->Fetch())
{
    $items[] = $ob;
    if ($ob['IBLOCK_SECTION_ID']) {
        $sectionsID[] = $ob['IBLOCK_SECTION_ID'];
    }

}

$arFilter = Array('IBLOCK_ID'=>IBLOCK_PERSONAL_MENU, 'ID' => $sectionsID);
$arSelect = ['ID', 'NAME'];
$db_list = CIBlockSection::GetList(Array('sort'=>'asc'), $arFilter, false, $arSelect);
while($ar_result = $db_list->Fetch())
{
    $arResult['SECTIONS'][$ar_result['ID']] = $ar_result['NAME'];
}

foreach ($items as $item) {
    $arResult['ITEMS'][$item['IBLOCK_SECTION_ID']][] = $item;
}




