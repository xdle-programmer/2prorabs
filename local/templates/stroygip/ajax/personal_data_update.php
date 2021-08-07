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
	case 'update_org_data':
        foreach ($_POST as $key => $value) {
            $fields[$key] = htmlentities($value);
        }
		
		if( isset($fields["id"]) && intval($fields["id"])>0 ){
			$ORG_ID = $fields["id"];
			
			if( isset($fields["IIN"]) && strlen($fields["IIN"])>0 ){
				CIBlockElement::SetPropertyValues($ORG_ID, 14, $fields["IIN"], "INN");
			}
			if( isset($fields["ADDRESS"]) && strlen($fields["ADDRESS"])>0 ){
				CIBlockElement::SetPropertyValues($ORG_ID, 14, $fields["ADDRESS"], "JUR_ADDRESS");
			}
			
			$el = new CIBlockElement;

			$arLoadProductArray = Array(
			  "NAME"   => $fields["NAME"],
			  "ACTIVE" => "Y",
			);

			$res = $el->Update($ORG_ID, $arLoadProductArray);
		}elseif( isset($fields["NAME"]) && isset($fields["IIN"])>0 ){
			
			$el = new CIBlockElement;
			
			$PROP = array();
			$PROP[37] = $fields["IIN"];
			$PROP[38] = $fields["ADDRESS"];
			$PROP[45] = Array("VALUE" => "13");
			$PROP[464] = $USER->GetID();

			$arLoadProductArray = Array(
				"IBLOCK_ID"       => 14,
				"PROPERTY_VALUES" => $PROP,
				"NAME"            => $fields["NAME"],
				"ACTIVE"          => "Y",
			);

			$id = $el->Add($arLoadProductArray);
		}
		
		
		
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
		
	case 'estimate_add':
		if( count($_REQUEST['productid'])>0 ){
			$el = new CIBlockElement;
			$PROP = array();
			$PROP[786] = $USER->GetID();
			$PROP[787] = $_REQUEST['productid'];
			$PROP[788] = $_REQUEST['quantity'];
			
			$el_name = $USER->GetID()."-".implode("-", $_REQUEST['productid']);

			$arLoadProductArray = Array(
				"IBLOCK_ID"      => 49,
				"PROPERTY_VALUES"=> $PROP,
				"NAME"           => $el_name,
				"ACTIVE"         => "Y",
			);

			$element_id = $el->Add($arLoadProductArray);
		}
        break;

}


require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");