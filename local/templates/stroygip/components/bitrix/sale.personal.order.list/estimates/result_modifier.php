<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arSelect = Array("ID", "NAME", "IBLOCK_ID", "DATE_CREATE", "PROPERTY_USER", "PROPERTY_PRODUCTS");
$arFilter = Array("IBLOCK_ID"=>49, "ACTIVE"=>"Y", "PROPERTY_USER"=>$USER->GetID());
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement()){
	$arFields = $ob->GetFields();
	$arFields["PROPS"] = $ob->GetProperties();

	$arResult['FROM_BASKET'][$arFields["ID"]] = $arFields;
}
