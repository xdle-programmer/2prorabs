<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
  global $USER;
  if (!$USER->IsAuthorized()) {
    LocalRedirect(SITE_DIR);
  } else {
    LocalRedirect('/personal/orders/');
  }
?>
<?$APPLICATION->IncludeComponent(
  "2quick:wrap",
  "personal",
  array(
  ),
  false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>