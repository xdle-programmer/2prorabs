<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (isset($arParams['STATUS'])) {
    foreach ($arResult['ORDERS'] as $order) {
        if ($order['ORDER']['STATUS_ID'] == $arParams['STATUS']) {
            $arr[] = $order;
        }
    }
}


$arResult['USER']['FULL_NAME'] = $USER->GetFullName();
$filter = Array
(
    "ID" => $USER->GetID(),
);
$select = [
    'FIELDS' => ['EMAIL', 'PERSONAL_PHONE']
];
$rsUsers = CUser::GetList(($by="name"), ($order="asc"), $filter, $select);
while($res = $rsUsers->Fetch()) :
    $arResult['USER']['PHONE'] = $res['PERSONAL_PHONE'];
    $arResult['USER']['EMAIL'] = $res['EMAIL'];
endwhile;

if ($arParams['STATUS']) {
    $arResult['NEW_ORDERS'] = $arr;
} else {
    $arResult['NEW_ORDERS'] = $arResult['ORDERS'];
}

foreach ($arResult['NEW_ORDERS'] as $order) {
    $ordersID[] = $order['ORDER']['ID'];
    foreach ($order['BASKET_ITEMS'] as $item) {
        $itemsID[] = $item['PRODUCT_ID'];
    }
}

$arSelect = Array("ID", "PROPERTY_ART_NUMBER", 'PREVIEW_PICTURE');
$arFilter = Array("IBLOCK_ID"=>IBLOCK_ID_CATALOG, 'ID' => $itemsID);
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->Fetch())
{
    $arResult['BASKET_ITEMS'][$ob['ID']] = $ob;
}

$db_props = CSaleOrderPropsValue::GetOrderProps($ordersID);
while ($res = $db_props->Fetch()) {
    $orderProps[$res['ORDER_ID']][$res['CODE']] = $res;
}

foreach ($orderProps as $orderID => $group) {
    if ($group['POINT']['VALUE']) {
        $arResult['ORDERS_PROPS'][$orderID]['ADDRESS'] = $group['POINT']['VALUE'];
    } else {
        $arResult['ORDERS_PROPS'][$orderID]['ADDRESS'] = 'Город ' . $group['CITY']['VALUE'];
        if ($group['CITY']['STREET']) {
            $arResult['ORDERS_PROPS'][$orderID]['ADDRESS'] .= ', улица ' . $group['CITY']['STREET'];
        }
        if ($group['HOUSE']['VALUE']) {
            $arResult['ORDERS_PROPS'][$orderID]['ADDRESS'] .= ', дом ' . $group['HOUSE']['VALUE'];
        }
        if ($group['APARTMENT']['VALUE']) {
            $arResult['ORDERS_PROPS'][$orderID]['ADDRESS'] .= ', кв. ' . $group['APARTMENT']['VALUE'];
        }
    }

    if ($group['DELIVERY_DATE']['VALUE']) {
        $arResult['ORDERS_PROPS'][$orderID]['DELIVERY_DATE'] = $group['DELIVERY_DATE']['VALUE'];
    }
}


$result = \Bitrix\Sale\Internals\OrderChangeTable::getList(array(
    'order'=>['DATE_CREATE'=>'DESC','ID'=>'DESC'],
    'filter'=>['ORDER_ID'=>$ordersID],
    'select' => ['ID', 'TYPE', 'DATA', 'DATE_CREATE', 'ORDER_ID'],
));

while($historyItem = $result->fetch()) {
    $historyInfo = \CSaleOrderChange::GetRecordDescription($historyItem["TYPE"], $historyItem["DATA"]);
    $historyInfo['DATE'] = FormatDate('d.m.Y H:i', strtotime($historyItem['DATE_CREATE']->toString()));
    $arResult['ORDERS_PROPS'][$historyItem['ORDER_ID']]['PATH'][] = $historyInfo;
}

CModule::IncludeModule("sale");
$res = CSaleUserTransact::GetList(Array("ID" => "DESC"), array('ORDER_ID' => $ordersID, 'USER_ID' => $USER->GetID()));
while ($arFields = $res->Fetch()) {
    $arResult['ORDERS_PROPS'][$arFields['ORDER_ID']]['BONUSES'] = (int)$arFields['AMOUNT'];
}

