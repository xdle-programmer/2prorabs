<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Главная');

CModule::IncludeModule("catalog");
CModule::IncludeModule("iblock");
CModule::IncludeModule("sale");


  /*$bs = new CIBlockElement;
  $obPrice = new CPrice();

  for ($i = 1; $i <= 30; $i++) {
    $PROP['ART_NUMBER'] = randString(6, array("0123456789"));
    $PROP['RATING'] = rand ( 0 , 5 );
    $PROP['MODEL'] = randString(3, array("ABCDEFGHIJKLNMOPQRSTUVWXYZ")).randString(3, array("0123456789"));
    $arFields = Array(
      "ACTIVE" => 'Y',
      "IBLOCK_SECTION_ID" => 210,
      "IBLOCK_ID" => 1,
      "NAME" => 'Товар'.randString(3),
      "SORT" => 500,
      'CODE'=>randString(10),
      'PREVIEW_PICTURE'=>CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/assets/src/images/sthil-1.png"),
      'DETAIL_PICTURE'=>CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/assets/src/images/sthil-1.png"),
      "PROPERTY_VALUES"=> $PROP,
    );
    $ID = $bs->Add($arFields);

    if($ID>0) {
      $arProd =
        array(
        "ID" => $ID,
        "TYPE" => 1,
        'QUANTITY'=>10
      );
      if(!CCatalogProduct::Add($arProd)) {
        if ($ex = $APPLICATION->GetException())
          echo '<br>Ошибка создания товара: '.$ex->GetString();
        else
          echo '<br>Неизвестная ошибка при создании товара';
        unset($ex);
      }else {
        $obPrice->SetBasePrice($ID,rand ( 100 , 5000 ),"RUB",false,false,false);
      }
    }else {
      echo $bs->LAST_ERROR;
    }
  }*/


require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
