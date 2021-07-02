<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Новый раздел");
?>

<?
$export = new Site\OrderExport(119);

$export->export();
$export->upload();
?>

<?
$arFilter = [
	"ID" => 119,
];

$arSelect = [
	'ID',
	'PAY_SYSTEM_ID',
	'DELIVERY_ID',
	'PERSON_TYPE_ID',
	'USER_ID',
	'PRICE',
	'CURRENCY',
	'DATE_STATUS',
	'PRICE_DELIVERY',
	'DISCOUNT_VALUE',
	'SUM_PAID',
	'COMMENTS',
	'XML_ID',
	'CREATED_BY',
	'ADDRESS',
	'PROPERTY_VAL_BY_CODE_LOCATION',
	'PROPERTY_VAL_BY_CODE_NAME',
	//'PROPERTY_VAL_BY_CODE_LAST_NAME',
	'PROPERTY_VAL_BY_CODE_CITY',
	'PROPERTY_VAL_BY_CODE_STREET',
	'PROPERTY_VAL_BY_CODE_HOUSE',
	'PROPERTY_VAL_BY_CODE_APARTMENT',
	'PROPERTY_VAL_BY_CODE_POINT',
	'PROPERTY_VAL_BY_CODE_PHONE',
	'STATUS_ID',
];
print_r($id);
$db_sales = CSaleOrder::GetList(["SORT" => "ASC"], $arFilter, false, false, $arSelect);
$tmp = $db_sales->Fetch();
//pre($this->getStatus($tmp["STATUS_ID"]));
//pre($db_sales->Fetch());
print_r($tmp);
//return $db_sales->Fetch();
$arOrder = CSaleOrder::GetByID(119);
echo "<pre>";
print_r($arOrder);
echo "</pre>";



?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>