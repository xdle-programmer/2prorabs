<?
  require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
  $APPLICATION->SetTitle('Главная');
  CModule::IncludeModule("iblock");
  die();
?>

<?


  $el = new CIBlockElement;

  $arSelect = ["ID", "IBLOCK_ID"];
  $arFilter = ["IBLOCK_ID"=>1,"ACTIVE"=>"Y",];
  $res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
  while($ob = $res->Fetch())
  {
    $arItems[$ob['ID']] = $ob['ID'];
  }

?>

<?
  $smPhoto = CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH.'/assets/src/images/product-card/small-image-2.png');
  $title = 'Эксклюзивные люстры и светильники Vitaluce';
  $text = 'Эксклюзивные люстры и светильники Vitaluce гармонично сочетаются с любым интерьером и наполняют дом неповторимой атмосферой комфорта и уюта. Продукция Vitaluce уверенно занимает лидирующее место на рынке декоративного освещения, благодаря высокому качеству, интересному дизайну и приемлемым ценам, пользуется популярностью у потребителей в России, странах СНГ и Восточной Европы. Покупателям предлагается как уже полюбившиеся коллекции светильников и люстр, так и вновь разработанные с учетом новейших тенденций и направлений дизайна в области декоративного света, решенные в разных стилях и богатой цветовой гамме. Широкая линейка продукции Vitaluce позволяет каждому покупателю найти для себя оптимальную модель.'?>
<?foreach ($arItems as $key => $arItem){
  $PROP = array();
  $PROP['CHARS'] = array("VALUE" => array("TYPE" =>"TEXT","TEXT" => $text),'DESCRIPTION' =>$title);
  $PROP['REVIEWS'] =array("VALUE" => array("TYPE" =>"TEXT","TEXT" => $text),'DESCRIPTION' =>$title);
  $PROP['GALLERY'] = [
    'n0'=>$smPhoto,
    'n1'=>$smPhoto,
    'n2'=>$smPhoto,
    'n3'=>$smPhoto,
  ];
  $PROP['REVIEWS_CNT'] = rand(10,30);
  $PROP['BYE_WIDTH'] = [$arItems[array_rand($arItems)],$arItems[array_rand($arItems)],$arItems[array_rand($arItems)],$arItems[array_rand($arItems)],$arItems[array_rand($arItems)],$arItems[array_rand($arItems)],$arItems[array_rand($arItems)]];

  $arLoadProductArray = Array(
    "PREVIEW_TEXT"   => $title,
    "DETAIL_TEXT"    => $text,
    "DETAIL_PICTURE" => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH.'/assets/src/images/product-card/main-image.png')
  );
  global $USER;
  if($USER->IsAdmin())\Bitrix\Main\Diag\Debug::dump($PROP['BYE_WIDTH']);
  $PRODUCT_ID = $arItem;
  $res = $el->Update($PRODUCT_ID, $arLoadProductArray);
  foreach ($PROP as $key => $prop) {
    CIBlockElement::SetPropertyValuesEx($arItem, 1, array($key => $prop));
  }

}?>



