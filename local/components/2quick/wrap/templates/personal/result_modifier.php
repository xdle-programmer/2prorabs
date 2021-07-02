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
  $transactions = CSaleUserTransact::GetList(Array(), array("USER_ID" => $arUser['ID'],'!ORDER_ID'=>false));
while ($arFields = $transactions->Fetch()) {
  $arResult['TRANSACTIONS'][$arFields['ORDER_ID']] = $arFields;
  $arResult['ORDERS_ID'][$arFields['ORDER_ID']] = $arFields['ORDER_ID'];
}
}
if($arResult['ORDERS_ID'] && $arUser['ID']) {
  $arOrders = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), ['=ID'=>$arResult['ORDERS_ID'],'USER_ID'=>$arUser['ID']]);
  while ($arOrder = $arOrders->Fetch())
  {
    $arResult['ORDERS'][$arOrder['ID']] = $arOrder;
    $arResult['ORDERS'][$arOrder['ID']]['TRANSACTION'] = $arResult['TRANSACTIONS'][$arOrder['ID']];
  }
}
