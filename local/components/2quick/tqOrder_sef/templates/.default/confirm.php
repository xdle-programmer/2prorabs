<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
use Bitrix\Sale;
use Bitrix\Sale\PaySystem;
use Bitrix\Main\Localization\Loc;

if($arResult['ORDER']['ORDER_ID']){

$order = Sale\Order::load($arResult['ORDER']['ORDER_ID']);

$propertyCollection = $order->getPropertyCollection();
$namePropValue  = $propertyCollection->getPayerName();
$paymentCollection = $order->getPaymentCollection();
$ar = $propertyCollection->getArray();
if($paymentCollection[0])
$paymentName = $paymentCollection[0]->getPaymentSystemName();

if (!empty($namePropValue)) $payerName = $namePropValue->getValue();
$payerLocation = $ar['properties'][3]['VALUE'][0];

$arSelect = Array("ID", "IBLOCK_ID", "CODE", "DATE_ACTIVE_FROM","PROPERTY_*");
$arFilter = Array("ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y",'IBLOCK_ID'=>5);
$res = CIBlockElement::GetList(Array('SORT'=>'asc'), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement()){
    $arFields = $ob->GetFields();
    $arFields['PROPERTIES'] = $ob->GetProperties();
    $arSoc[] = $arFields;
}
    $arResult["ORDER"]["IS_ALLOW_PAY"] = $order->isAllowPay()? 'Y' : 'N';
    $arResult["PAYMENT"] = array();
    if ($order->isAllowPay())
    {
        $paymentCollection = $order->getPaymentCollection();
        /** @var Payment $payment */
        foreach ($paymentCollection as $payment)
        {
            $arResult["PAYMENT"][$payment->getId()] = $payment->getFieldValues();

            if (intval($payment->getPaymentSystemId()) > 0 && !$payment->isPaid())
            {
                $paySystemService = PaySystem\Manager::getObjectById($payment->getPaymentSystemId());
                if (!empty($paySystemService))
                {
                    $arPaySysAction = $paySystemService->getFieldsValues();

                    if ($paySystemService->getField('NEW_WINDOW') === 'N' || $paySystemService->getField('ID') == PaySystem\Manager::getInnerPaySystemId())
                    {
                        /** @var PaySystem\ServiceResult $initResult */
                        $initResult = $paySystemService->initiatePay($payment, null, PaySystem\BaseServiceHandler::STRING);
                        if ($initResult->isSuccess())
                            $arPaySysAction['BUFFERED_OUTPUT'] = $initResult->getTemplate();
                        else
                            $arPaySysAction["ERROR"] = $initResult->getErrorMessages();
                    }

                    $arResult["PAYMENT"][$payment->getId()]['PAID'] = $payment->getField('PAID');

                    $arOrder['PAYMENT_ID'] = $payment->getId();
                    $arOrder['PAY_SYSTEM_ID'] = $payment->getPaymentSystemId();
                    $arPaySysAction["NAME"] = htmlspecialcharsEx($arPaySysAction["NAME"]);
                    $arPaySysAction["IS_AFFORD_PDF"] = $paySystemService->isAffordPdf();

                    if ($arPaySysAction > 0)
                        $arPaySysAction["LOGOTIP"] = CFile::GetFileArray($arPaySysAction["LOGOTIP"]);

                    if ($this->arParams['COMPATIBLE_MODE'] == 'Y' && !$payment->isInner())
                    {
                        // compatibility
                        \CSalePaySystemAction::InitParamArrays($order->getFieldValues(), $order->getId(), '', array(), $payment->getFieldValues());
                        $map = CSalePaySystemAction::getOldToNewHandlersMap();
                        $oldHandler = array_search($arPaySysAction["ACTION_FILE"], $map);
                        if ($oldHandler !== false && !$paySystemService->isCustom())
                            $arPaySysAction["ACTION_FILE"] = $oldHandler;

                        if (strlen($arPaySysAction["ACTION_FILE"]) > 0 && $arPaySysAction["NEW_WINDOW"] != "Y")
                        {
                            $pathToAction = Main\Application::getDocumentRoot().$arPaySysAction["ACTION_FILE"];

                            $pathToAction = str_replace("\\", "/", $pathToAction);
                            while (substr($pathToAction, strlen($pathToAction) - 1, 1) == "/")
                                $pathToAction = substr($pathToAction, 0, strlen($pathToAction) - 1);

                            if (file_exists($pathToAction))
                            {
                                if (is_dir($pathToAction) && file_exists($pathToAction."/payment.php"))
                                    $pathToAction .= "/payment.php";

                                $arPaySysAction["PATH_TO_ACTION"] = $pathToAction;
                            }
                        }

                        $arResult["PAY_SYSTEM"] = $arPaySysAction;
                    }

                    $arResult["PAY_SYSTEM_LIST"][$payment->getPaymentSystemId()] = $arPaySysAction;
                    $arResult["PAY_SYSTEM_LIST_BY_PAYMENT_ID"][$payment->getId()] = $arPaySysAction;
                }
                else
                    $arResult["PAY_SYSTEM_LIST"][$payment->getPaymentSystemId()] = array('ERROR' => true);
            }
        }
    }
    $emailPropValue = $propertyCollection->getUserEmail()->getValue();


	$APPLICATION->SetTitle('Подтверждение заказа');
?>

<div class="order-result">
	<?if( !empty($arResult["ORDER"]) ){?>
	<div class="order-result__icon-wrapper">
		<svg class="order-result__icon">
			<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#check"></use>
		</svg>
	</div>
	<div class="order-result__desc">
		<div class="order-result__desc-title">Ваш заказ №<?=$arResult['ORDER']['ORDER_ID']?> успешно оформлен!</div>
		<div class="order-result__desc-text">На вашу электронную почту отправлены данные по заказу. Как только заказ будет отгружен, вам придет уведомление.</div>
		<a href="/personal/orders/" class="order-result__desc-button">Отслеживать статус заказа</a>
		
		<?
        if ($arResult["ORDER"]["IS_ALLOW_PAY"] === 'Y')
        {
            if (!empty($arResult["PAYMENT"]))
            {
                foreach ($arResult["PAYMENT"] as $payment)
                {
                    if ($payment["PAID"] != 'Y')
                    {
                        if (!empty($arResult['PAY_SYSTEM_LIST'])
                            && array_key_exists($payment["PAY_SYSTEM_ID"], $arResult['PAY_SYSTEM_LIST'])
                        )
                        {
                            $arPaySystem = $arResult['PAY_SYSTEM_LIST_BY_PAYMENT_ID'][$payment["ID"]];

                            if (empty($arPaySystem["ERROR"]))
                            {
                                ?>
                                <br /><br />
								<? if (strlen($arPaySystem["ACTION_FILE"]) > 0 && $arPaySystem["NEW_WINDOW"] == "Y" && $arPaySystem["IS_CASH"] != "Y"): ?>
									<?
									$orderAccountNumber = urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]));
									$paymentAccountNumber = $payment["ACCOUNT_NUMBER"];
									?>
									<script>
										window.open('<?=$arParams["PATH_TO_PAYMENT"]?>?ORDER_ID=<?=$orderAccountNumber?>&PAYMENT_ID=<?=$paymentAccountNumber?>');
									</script>
									<?=Loc::getMessage("SOA_PAY_LINK", array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".$orderAccountNumber."&PAYMENT_ID=".$paymentAccountNumber))?>
									<?/* if (CSalePdf::isPdfAvailable() && $arPaySystem['IS_AFFORD_PDF']): ?>
										<br/>
										<?=Loc::getMessage("SOA_PAY_PDF", array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".$orderAccountNumber."&pdf=1&DOWNLOAD=Y"))?>
									<? endif; */?>
								
								<? else: ?>
									<?=$arPaySystem["BUFFERED_OUTPUT"]?>
								<? endif ?>
								
                                <?
                            }
                            else
                            {
                                ?>
                                <span style="color:red;"><?=Loc::getMessage("SOA_ORDER_PS_ERROR")?></span>
                                <?
                            }
                        }
                        else
                        {
                            ?>
                            <span style="color:red;"><?=Loc::getMessage("SOA_ORDER_PS_ERROR")?></span>
                            <?
                        }
                    }
                }
            }
        }
        else
        {
            ?>
            <br /><strong><?=$arParams['MESS_PAY_SYSTEM_PAYABLE_ERROR']?></strong>
            <?
        }
        ?>
		
	</div>
	<?}else{ ?>
	
		<div class="order-result__icon-wrapper order-result__icon-wrapper--red">
			<svg class="order-result__icon order-result__icon--red">
				<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#close"></use>
			</svg>
		</div>
		<div class="order-result__desc">
			<div class="order-result__desc-title"><?=Loc::getMessage("SOA_ERROR_ORDER")?></div>
			<div class="order-result__desc-text">
				<?=Loc::getMessage("SOA_ERROR_ORDER_LOST", ["#ORDER_ID#" => htmlspecialcharsbx($arResult["ACCOUNT_NUMBER"])])?>
                <?=Loc::getMessage("SOA_ERROR_ORDER_LOST1")?>
			</div>
		</div>
		
	<?}?>
</div>

<?}else{?>
	<div class="order-result">

		<div class="order-result__icon-wrapper order-result__icon-wrapper--red">
			<svg class="order-result__icon order-result__icon--red">
				<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#close"></use>
			</svg>
		</div>
		<div class="order-result__desc">
			<div class="order-result__desc-title">Заказ не найден</div>
			<div class="order-result__desc-text">
				<?=Loc::getMessage("SOA_ERROR_ORDER_LOST", ["#ORDER_ID#" => htmlspecialcharsbx($arResult["ACCOUNT_NUMBER"])])?>
				<?=Loc::getMessage("SOA_ERROR_ORDER_LOST1")?>
			</div>
			<a href="/catalog/" class="order-result__desc-button">Перейти в каталог</a>
		</div>

	</div>
<?}?>

