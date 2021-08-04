<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

CModule::IncludeModule("iblock");

$filter = Array
(
    "ID" => $USER->GetID(),
);
$select = [
    'FIELDS' => ['ID', 'NAME', 'LAST_NAME', 'SECOND_NAME', 'PERSONAL_BIRTHDAY', 'PERSONAL_PHONE', 'EMAIL', 'PERSONAL_GENDER', 'PERSONAL_CITY', 'PERSONAL_NOTES'],
    'SELECT' => ['UF_ORGANIZATIONS', 'UF_PHONE_APPROVED', 'UF_ADDRESSES']
];
$rsUsers = CUser::GetList(($by = "name"), ($order = "asc"), $filter, $select);
while ($res = $rsUsers->Fetch()) :
    $arResult['USER_INFO'] = $res;
endwhile;

if ($arResult['USER_INFO']['UF_ADDRESSES']) {
    $arSelect = Array("ID", "NAME");
    $arFilter = Array("IBLOCK_ID" => IBLOCK_PERSONAL_ADDRESSES, "ACTIVE"=>"Y", 'ID' => $arResult['USER_INFO']['UF_ADDRESSES']);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while($ob = $res->Fetch())
    {
        $arResult['USER_ADDRESSES'][] = $ob;
    }
}


$arSelect1 = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_USER", "PROPERTY_INN", "PROPERTY_JUR_ADDRESS");
$arFilter1 = Array("IBLOCK_ID" => 14, "ACTIVE"=>"Y", 'PROPERTY_USER' => $USER->GetID());
$res1 = CIBlockElement::GetList(Array(), $arFilter1, false, false, $arSelect1);
while($ob1 = $res1->Fetch()){
	$arResult['USER_ORGANIZATION'][] = $ob1;
}
