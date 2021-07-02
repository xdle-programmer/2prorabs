<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Бонусы");
  global $USER;
  if (!$USER->IsAuthorized()) {
    LocalRedirect(SITE_DIR);
  }
?>
<?$APPLICATION->IncludeComponent(
  "2quick:wrap",
  "personalBonuses",
  array(
  ),
  false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>