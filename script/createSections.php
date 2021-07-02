<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Главная');
CModule::IncludeModule("iblock");

$lvl2 = ['Ландшафтный дизайн','Газовые шланги и комплектующие','Отделочный инструмент','Полив и орошения','Ландшафтный дизайн2','Газовые шланги и комплектующие2','Отделочный инструмент2','Полив и орошения2',];
$lvl3 = ['Капельный полив и орошение','Емкости для полива','Катушки для шланга','Опрыскиватели','Полиэтиленовые трубы и фитинги','Разбрызгиватели и наконечники','Шланги для полива'];

/*$arSelect =["IBLOCK_ID","NAME","ID"];
$arFilter = ['IBLOCK_ID'=>1, 'ACTIVE'=>'Y'];
  $db_list = CIBlockSection::GetList([], $arFilter, false,$arSelect,false);
  while($ar_result = $db_list->Fetch())
  {
    $SECTIONS[] = $ar_result;
  }

  $bs = new CIBlockSection;
  foreach ($SECTIONS as $SECTION) {
    foreach ($lvl2 as $lv2SName) {

      $arFields = Array(
        "ACTIVE" => 'Y',
        "IBLOCK_SECTION_ID" => $SECTION['ID'],
        "IBLOCK_ID" => 1,
        "NAME" => $lv2SName,
        "SORT" => 500,
        'CODE'=>randString(10)
        );
      $ID = $bs->Add($arFields);
      if($ID>0) {
        foreach ($lvl3 as $lvl3SName) {
          $arFields3 = Array(
            "ACTIVE" => 'Y',
            "IBLOCK_SECTION_ID" => $ID,
            "IBLOCK_ID" => 1,
            "NAME" => $lvl3SName,
            "SORT" => 500,
            'CODE'=>randString(10)
          );
          $ID3 = $bs->Add($arFields3);
        }
      }else {
        echo $bs->LAST_ERROR;
      }
    }
  }*/



require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
