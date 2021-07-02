<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Главная');
CModule::IncludeModule("iblock");

/*$arSelect =["IBLOCK_ID","NAME","ID",'DESCRIPTION'];
$arFilter = ['IBLOCK_ID'=>1, 'ACTIVE'=>'Y'];
  $db_list = CIBlockSection::GetList([], $arFilter, false,$arSelect,false);
  while($ar_result = $db_list->GetNext())
  {
    $SECTION[] = $ar_result;
  }
  $text ='
    <div class="title title--mb">Керамическая плитка в гипермаркетах Два прораба</div>
    <div class="description-text__container">
      <div class="text description-text__text">Керамическая плитка и другие товары можно приобрести в Два прораба по низким ценам. Подберите интересующий товар на сайте и купите его в нашем интернет-магазине. Ассортимент товаров, представленных в каталоге, чрезвычайно широк. Среди них наверняка найдется подходящая по всем параметрам позиция.</div>
      <div class="text">Все представленные в разделе «Керамическая плитка» изделия выпускаются известными и отлично зарекомендовавшими себя высоким качеством своей продукции компаниями.</div>
      <div class="title title--medium description-text__title-medium">Быстрая доставка</div>
      <div class="text">Вы всегда можете сделать заказ и оплатить его онлайн на официальном сайте Два прораба в Киргизии. Для жителей Киргизии у нас не только низкие цены на товары категории "Керамическая плитка", но и быстрая доставка в такие города, как Бишкек, Баткен, Айдаркен, Бишкек, Балыкчы, Баткен, Джалал-Абад, Исфана, Кант, Кара-Балта, Кара-Куль, Кара-Суу, Каракол, Кёк-Джангак, Кербен, Кочкор-Ата, Кызыл-Кия, Майлуу-СууЧ…</div>
    </div>
  ';
  $bs = new CIBlockSection;
  foreach ($SECTION as $sec) {

    $arFields = Array(
      "DESCRIPTION" => $text,
      "DESCRIPTION_TYPE" => 'html'
    );
      $res = $bs->Update($sec['ID'], $arFields);
  }*/



require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
