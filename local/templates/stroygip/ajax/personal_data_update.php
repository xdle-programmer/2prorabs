<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
global $USER;
CModule::IncludeModule("iblock");
CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");
switch ($_REQUEST['action']) {
    case 'update_data':
        foreach ($_POST as $key => $value) {
            $fields[$key] = htmlentities($value);
        }
        $user = new CUser;
        $user->Update($USER->GetID(), $fields);
        break;
    case 'address_add':
        $el = new CIBlockElement;
        $PROP = array();

        foreach ($_POST as $key => $value) {
            $PROP[$key] = htmlentities($value);
        }

        $arLoadProductArray = Array(
            "IBLOCK_ID"      => IBLOCK_PERSONAL_ADDRESSES,
            "PROPERTY_VALUES"=> $PROP,
            "NAME"           => 'город ' . $PROP['CITY'] . ', улица ' . $PROP['STREET'] . ', ' . $PROP['HOUSE'],
            "ACTIVE"         => "Y",
        );

        $id = $el->Add($arLoadProductArray);

        $user = new CUser;
        $filter = Array
        (
            "ID" => $USER->GetID(),
        );
        $select = [
            'FIELDS' => ['ID'],
            'SELECT' => ['UF_ADDRESSES']
        ];
        $rsUsers = CUser::GetList(($by="name"), ($order="acs"), $filter, $select);
        while($res = $rsUsers->Fetch()) :
            $addresses = $res['UF_ADDRESSES'];
        endwhile;
        $addresses[] = $id;
        $user->Update($USER->GetID(), ['UF_ADDRESSES' => $addresses]);
        break;

    case 'address_delete':
        CIBlockElement::Delete($_REQUEST['id']);
        break;

}


require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");