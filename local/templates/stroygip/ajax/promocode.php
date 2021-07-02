<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Application;
use Bitrix\Main\Loader;

global $USER;
$request = Application::getInstance()->getContext()->getRequest();
$arResult =[];
if($request->isPost()) {
    $promocode = $request->getPost('promocode');
    if(strlen($promocode)>0) {

      $user = $USER->GetID();
      $IBLOCK_PROMOCODE_ID  = IBLOCK_PROMOCODE_ID;
      $IBLOCK_HISTORY_ID  = IBLOCK_HISTORY_ID;
      \Bitrix\Main\Loader::includeModule('iblock');
      \Bitrix\Main\Loader::includeModule('sale');
      $el = new CIBlockElement;

      $arSelect = ["ID", "NAME",'PROPERTY_POINTS','PROPERTY_PROMOCODE_COUNT'];
      $arFilter = ["IBLOCK_ID"=>$IBLOCK_PROMOCODE_ID,"ACTIVE"=>"Y",'=NAME'=>$promocode];
      $res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
      while($ob = $res->Fetch())
      {
        $element = $ob;
      }
      if($element['ID']) {
        if (!CSaleUserAccount::UpdateAccount($user,$element['PROPERTY_POINTS_VALUE'],"RUB","Активация промокода")) {
          $arResult = ['STATUS'=>'ERROR','MSG'=>'В процессе зачисления баллов возникли технические ошибки, обратитесь к администрации сайта'];
        } else {
          $promocode_count =(int)$element['PROPERTY_PROMOCODE_COUNT_VALUE']-1;
          $active ='Y';
          if($promocode_count == 0) {
            $active ='N';
          }
          if($el->Update($element['ID'], ['ACTIVE'=>$active,'PROPERTY_VALUES'=>['PROMOCODE_COUNT'=>$promocode_count,'POINTS'=>$element['PROPERTY_POINTS_VALUE']]])) {
            $el->Add(['NAME'=>'Активация промокода '.$element['NAME'].' от '.ConvertTimeStamp(),'PROPERTY_VALUES'=>['PROMOCODE'=>$element['ID'],'USER'=>$user,'PROMOCODE_COUNT'=>$promocode_count],'ACTIVE'=>'Y','IBLOCK_ID'=>$IBLOCK_HISTORY_ID]);
          }
          $arResult =['STATUS'=>'SUCCSESS','MSG'=>'Промокод применен','POINTS'=>$element['PROPERTY_POINTS_VALUE']];
        }
      } else {
        $arResult = ['STATUS'=>'ERROR','MSG'=>'Не найдено таких промокодов  либо промокод уже был израсходован'];
      }
    }else {
      $arResult = ['STATUS'=>'ERROR','MSG'=>'Введите данные и нажмите применить для того что бы использовать промокод'];
    }
} else {
 $arResult = ['STATUS'=>'ERROR','MSG'=>'Сервис в данный момент не доступен , обратитесь к администрации сайта'];
}
echo json_encode($arResult);

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");