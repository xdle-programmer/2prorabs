<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

$filter = Array
(
    "ID" => $USER->GetID(),
);
$select = [
    'FIELDS' => ['ID', 'NAME', 'LAST_NAME', 'SECOND_NAME', 'PERSONAL_BIRTHDAY', 'PERSONAL_PHONE', 'EMAIL', 'PERSONAL_GENDER', 'PERSONAL_CITY'],
    'SELECT' => ['UF_ORGANIZATIONS', 'UF_PHONE_APPROVED', 'UF_ADDRESSES']
];
$rsUsers = CUser::GetList(($by = "name"), ($order = "asc"), $filter, $select);
while ($res = $rsUsers->Fetch()) :
    $arResult['USER_INFO'] = $res;
endwhile;

if ($arResult['USER_INFO']['UF_ADDRESSES']) {
    CModule::IncludeModule("iblock");
    $arSelect = Array("ID", "NAME");
    $arFilter = Array("IBLOCK_ID" => IBLOCK_PERSONAL_ADDRESSES, "ACTIVE"=>"Y", 'ID' => $arResult['USER_INFO']['UF_ADDRESSES']);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while($ob = $res->Fetch())
    {
        $arResult['USER_ADDRESSES'][] = $ob;
    }
}
