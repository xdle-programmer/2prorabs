<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Sale;

global $USER;
$request = Application::getInstance()->getContext()->getRequest();
$arResult = array();
$arOutput = array();
if($request->isPost()) {
    $action = $request->getPost('action');
    switch($action)
    {
        case 'add2basket':
            $id = $request->getPost('id');
            $quantity = $request->getPost('quantity');
            $result = \DDS\Basketclass::add2basket($id,$quantity);
			
			$_SESSION["BASKET_LIST"][$id] = $id;
			echo count($_SESSION["BASKET_LIST"]);
			
            //echo json_encode('Y');
            break;
        case 'updatebasket':
            $id = $request->getPost('id');
            $quantity = $request->getPost('quantity');
            $result = \DDS\Basketclass::updatebasket($id,$quantity);
            echo json_encode($result);
            break;
        case 'delete':
            $id = $request->getPost('id');
            $result = \DDS\Basketclass::delete($id);
			
			$product_id = $request->getPost('productid');
			unset($_SESSION["BASKET_LIST"][$product_id]);
			
            echo json_encode($result);
            break;
		case 'delete_basket_item':
			$product_id = $request->getPost('productid');
			
			$basket_id = "";
			$basket_storage = \Bitrix\Sale\Basket\Storage::getInstance(\Bitrix\Sale\Fuser::getId(), SITE_ID);
			$basket = $basket_storage->getBasket();

			foreach ($basket as $basket_item) {
				$arr_product = $basket_item->getFieldValues();
				if( $product_id == $arr_product["PRODUCT_ID"] ){
					$basket_id = $arr_product["ID"];
				}
			}

			if( $basket_id > 0 ){
				$result = \DDS\Basketclass::delete($basket_id);
				unset($_SESSION["BASKET_LIST"][$product_id]);
				
				echo count($_SESSION["BASKET_LIST"]);
				//echo json_encode($result);
			}
            
            break;
        case 'clear_basket':
            $result = \DDS\Basketclass::clearBasket();
			
			unset($_SESSION["BASKET_LIST"]);
			
            echo json_encode($result);
            break;
        case 'changeOffer':
            CModule::IncludeModule('catalog');
            $id = $request->getPost('id');
            $result = CCatalogProduct::GetOptimalPrice($id, 1, $USER->GetUserGroupArray());
            echo json_encode(number_format($result['DISCOUNT_PRICE'],0,' ',' ').' Р');
            break;
        case 'registration':
            $validData = [
                'NAME' => $_REQUEST['NAME'],
                'LAST_NAME' => $_REQUEST['LAST_NAME'],
                'PERSONAL_PHONE' => $_REQUEST['PERSONAL_PHONE'],
                'EMAIL' => $_REQUEST['EMAIL'],
                'LOGIN' => $_REQUEST['EMAIL'],
                'PASSWORD' => $_REQUEST['PASSWORD'],
                'CONFIRM_PASSWORD' => $_REQUEST['CONFIRM_PASSWORD']
            ];
            $result = \DDS\Tools::userRegister($validData);
            echo json_encode($result);
            break;
        case 'login':
            global $USER;
            $login = $request->getPost('LOGIN');
            $password = $request->getPost('PASSWORD');
            $arAuthResult = $USER->Login($login, $password, "Y");
            $APPLICATION->arAuthResult = $arAuthResult;
            echo json_encode($arAuthResult);
            break;
        case 'user_info':
            $id=$USER->GetId();
            $validData = [
                'NAME' => $_REQUEST['NAME'],
                'LAST_NAME' => $_REQUEST['LAST_NAME'],
                'PERSONAL_PHONE' => $_REQUEST['PERSONAL_PHONE'],
                'EMAIL' => $_REQUEST['EMAIL'],
                'UF_ADDRES'=>$_REQUEST['UF_ADDRES'],

            ];
            $result = \DDS\Tools::userUpdate($id,$validData);
            echo json_encode($result);
            break;
        case 'password_change':
            $id=$USER->GetId();
            $password=$request->getPost('OLD_PASSWORD');
            $password_NEW=$request->getPost('PASSWORD');
            $password_NEW_CONFIRM=$request->getPost('CONFIRM_PASSWORD');
            $result = \DDS\Tools::savePasswordCheckOld($password,$password_NEW,$password_NEW_CONFIRM,$id);
            echo json_encode($result);
            break;
        case 'compfav':
            $result = \DDS\Tools::compfav($request);
			
			$arOutput["FAV"] = count($_SESSION['FAVORITES']);
			$arOutput["COMP"] = count($_SESSION['COMPARE']);
			echo json_encode($arOutput);

			//echo json_encode($result);
            break;
        case 'compfavdelete':
            $result = \DDS\Tools::compfavdelete($request);
			
			$arOutput["FAV"] = count($_SESSION['FAVORITES']);
			$arOutput["COMP"] = count($_SESSION['COMPARE']);
			echo json_encode($arOutput);
			
            //echo json_encode($result);
            break;
        case 'clearCompare':
            $ids = explode('/',$request->getPost('id'));
            if($ids)
                foreach ($ids as $id){
                    unset($_SESSION['COMPARE'][$id]);
                }

            echo json_encode(true);
            break;
        case 'countfavcomp':
            echo json_encode(array('FAV'=>count($_SESSION['FAVORITES']),'COMP'=>count($_SESSION['COMPARE'])));
            break;
        case 'q_sort':
            $count=$request->getPost('count');
            $_SESSION['quantity']=$count;
            echo json_encode($_SESSION['quantity']);
            break;
        case 'sort':
            $sort=$request->getPost('sort');
            $_SESSION['sort']=$sort;
            echo json_encode($_SESSION['sort']);
            break;
        case 'setCoupon':
            $coupon = $request->getPost('coupon');
            $result = \DDS\Basketclass::setCoupon($coupon);
            echo json_encode($result);
            break;
        case 'getCouponList';
            $result = \DDS\Basketclass::getCouponInfoCustom();
              echo json_encode($result);
            break;
        case 'oneclick':
            $id = $request->getPost('id');
            $result = \DDS\Tools::oneclick($id);
            echo json_encode($result);
            break;
        case 'addCompany':
            $el = new CIBlockElement;
            $PROP = array();
            foreach ($_REQUEST as $key => $val) {
                $PROP[$key] = $val;
            }
            $arLoadProductArray = Array(
                "MODIFIED_BY"    => $USER->GetID(),
                "IBLOCK_SECTION_ID" => false,
                "IBLOCK_ID"      => 14,
                "PROPERTY_VALUES"=> $PROP,
                "NAME"           => $_REQUEST['NAME'],
                "ACTIVE"         => "Y",
            );
            if($PRODUCT_ID = $el->Add($arLoadProductArray)){
                $result = true;
            } else {
                $result = $el->LAST_ERROR;
            }
            echo $result;
            break;
    }
}

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");