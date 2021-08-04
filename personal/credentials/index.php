<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Учётные данные");
global $USER;
if (!$USER->IsAuthorized()) {
    LocalRedirect(SITE_DIR);
}
?>
<?$APPLICATION->IncludeComponent(
    "2quick:wrap",
    "personalData",
    array(
    ),
    false
);?>

<?/*
	<!--Modal-->
<div class="modal" id="modalAddAddress">
		<div class="modal__overlay"></div>
		<div class="modal__position">
            <?$APPLICATION->IncludeComponent(
                "2quick:wrap",
                "personalAddressAdd",
                array(
                ),
                false
            );?>

		</div>
	</div>

<div class="modal-position">
	<div class="thanks" id="dataUpdated">
		<div class="thanks__close"><img src="<?= SITE_TEMPLATE_PATH;?>/assets/src/blocks/modals/thanks/assets/img/close.svg"></div>
		<div class="thanks__title">Ваши данные обновлены</div>
	</div>
</div>
<div class="modal-overlay" style="display: none;"></div>
*/?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>