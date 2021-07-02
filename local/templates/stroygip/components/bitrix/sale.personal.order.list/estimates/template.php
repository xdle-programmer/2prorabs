<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
require_once ($_SERVER["DOCUMENT_ROOT"] . '/local/include/phpexcel/PHPExcel.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/local/include/phpexcel/PHPExcel/Writer/Excel2007.php');
use Bitrix\Main,
	Bitrix\Main\Localization\Loc,
	Bitrix\Main\Page\Asset;


Loc::loadMessages(__FILE__);

?>


<?
if (!empty($arResult['ERRORS']['FATAL']))
{
	foreach($arResult['ERRORS']['FATAL'] as $error)
	{
		ShowError($error);
	}
	$component = $this->__component;
	if ($arParams['AUTH_FORM_IN_TEMPLATE'] && isset($arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED]))
	{
		$APPLICATION->AuthForm('', false, false, 'N', false);
	}

}
else
{
	if (!empty($arResult['ERRORS']['NONFATAL']))
	{
		foreach($arResult['ERRORS']['NONFATAL'] as $error)
		{
			ShowError($error);
		}
	}
	if (!count($arResult['ORDERS']))
	{
		if ($_REQUEST["filter_history"] == 'Y')
		{
			if ($_REQUEST["show_canceled"] == 'Y')
			{
				?>
				<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_CANCELED_ORDER')?></h3>
				<?
			}
			else
			{
				?>
				<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_HISTORY_ORDER_LIST')?></h3>
				<?
			}
		}
		else
		{
			?>
			<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_ORDER_LIST')?></h3>
			<?
		}
	}

	?>
	<div class="personal-area__block">
		<div class="personal-area__block-inner">

            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => SITE_TEMPLATE_PATH . "/include/estimates/preview.php"
                )
            );?>

			<div class="personal-area__title-small">История смет</div>
			<div class="personal-area__tab-history-block">
				<div class="personal-area__tab-history">
					<div class="personal-area__tab-history-head">
						<div class="personal-area__bonuses-head-row">
							<div class="personal-area__tab-history-col">
								<div class="personal-area__tab-history-title">Дата:</div>
							</div>
							<div class="personal-area__tab-history-col">
								<div class="personal-area__tab-history-title">Номер заказа:</div>
							</div>
							<div class="personal-area__tab-history-col">
								<div class="personal-area__tab-history-title">Сумма заказа:</div>
							</div>
							<div class="personal-area__tab-history-col personal-area__tab-history-col--width">
								<div class="personal-area__tab-history-title">Файл сметы:</div>
							</div>
						</div>
					</div>
					<div class="personal-area__tab-history-inner">
						<?foreach ($arResult['ORDERS'] as $order) {?>
						<div class="personal-area__tab-history-row">
							<div class="personal-area__tab-history-col">
								<div class="personal-area__tab-history-text"><?= FormatDate('d F Y', strtotime($order['ORDER']['DATE_INSERT']->toString()));?></div>
							</div>
							<div class="personal-area__tab-history-col">
								<div class="personal-area__tab-history-text">№ <?= $order['ORDER']['ID']?></div>
							</div>
							<div class="personal-area__tab-history-col">
								<div class="personal-area__tab-history-text"><?= $order['ORDER']['FORMATED_PRICE'];?></div>
							</div>
							<div class="personal-area__tab-history-col personal-area__tab-history-col--width">
								<div class="personal-area__estimate-row">
									<form action="/local/include/estimate_download.php" method="POST">
									<a href="javascript:void(0)" class="personal-area__estimate-file" data-id="" onclick="$(this).parents('form').submit();">Скачать
										<div class="personal-area__estimate-file-icon"></div>
									</a>
										<input type="hidden" name="estimate" value="<?= $order['ORDER']['ID'];?>">
									</form>

										<a class="personal-area__btn-repeat-order" href="/order/?ID=<?= $order['ORDER']['ID']?>_ORDER=Y">Повторить заказ</a>
								</div>
							</div>
						</div>
						<?}?>
					</div>
				</div>
			</div>
		</div>
	</div>



	<?
}
	?>