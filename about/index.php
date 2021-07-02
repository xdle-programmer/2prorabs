<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О нас");
?>
<?$APPLICATION->IncludeComponent(
  "2quick:wrap",
  "about",
  array(
  ),
  false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>