<?
define("NO_KEEP_STATISTIC", true);
require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"; 

global $USER;
CModule::IncludeModule('iblock');
CModule::IncludeModule("main");
\Bitrix\Main\Loader::includeModule("catalog");
\Bitrix\Main\Loader::includeModule("sale");


echo "qwe1<br>";

/*
$arFilter = Array('IBLOCK_ID'=>1, 'UF_EXTERNAL_CODE'=>"4fc2ef11-c383-11eb-80ee-00505687f371");
$db_list = CIBlockSection::GetList( Array(), $arFilter, false, Array("ID", "IBLOCK_ID", "NAME", "UF_EXTERNAL_CODE") );
while($ar_result = $db_list->GetNext())
{
	echo $ar_result['ID'].' '.$ar_result['NAME'].': '.$ar_result['UF_EXTERNAL_CODE'].'<br>';
}
*/



// proverka na vydachu neaktivnih razdelov
/*
$arFilter = Array('IBLOCK_ID'=>1 );
$db_list = CIBlockSection::GetList( Array("id"=>"asc"), $arFilter, false, Array("ID", "CODE", "IBLOCK_ID", "UF_EXTERNAL_CODE") );
while($ar_result = $db_list->GetNext())
{
	echo $ar_result['ID'].' - code:'.$ar_result['CODE'].' - external_code:'.$ar_result['UF_EXTERNAL_CODE'].'<br>';
}
*/



/*
$bs = new \CIBlockSection;

$xmlSection_CODE = \Cutil::translit('Люк', 'ru', ['replace_space' => '-', 'replace_other' => '-']);

$arFields = [
	"ACTIVE" => 'Y',
	"IBLOCK_ID" => 1,
	"NAME" => 'Люк',
	"SORT" => 500,
	"CODE" => $xmlSection_CODE,
	"UF_EXTERNAL_CODE" => '4fc2ef11-c383-11eb-80ee-00505687f371',
	"UF_PARENT_CODE" => '2beecec3-c382-11eb-80ee-00505687f371',
	"XML_ID" => '4fc2ef11-c383-11eb-80ee-00505687f371',
];

$ID = $bs->Add($arFields);

if (empty($ID)) {
	print "Ошибка создания раздела\n" . $bs->LAST_ERROR . "\n";
}else{
	echo $ID;
}
*/

/*
$existingProductId = "a98c4c55-1ada-11e9-80cf-000c291f9830";
$value = "142";
\CPrice::SetBasePrice($existingProductId, (float) $value, 'KGS');
*/

//Уровень Total mini spirit level 22.5cm tmt2235
/*
$existingProductId = "274425";
$value = "142";
$set_price = \CPrice::SetBasePrice($existingProductId, (float) $value, 'KGS');
var_dump($set_price);
*/

/*
$xml_data = simplexml_load_file($_SERVER["DOCUMENT_ROOT"].'/about/new_import1.xml');
$already_updated_items = array();

foreach ($xml_data as $key => $item) {
	//if ($item->tagName !== 'InformationRegisterRecordSet.ЦеныДляСайта') {
	//	continue;
	//}

	$arr = (array) $item->Records;
	foreach ($arr['Record'] as $key1=>$data) {
		//echo $key1."<br/>";
		//var_dump($data);
		
		
		if( !isset($data->Номенклатура) ){
			//var_dump($arr['Record']);
			
			if( !in_array($arr['Record']->Номенклатура, $already_updated_items) ){
				echo "<br/>";
				echo $arr['Record']->Номенклатура." - ".$arr['Record']->Цена."<br/>";
				echo "<br/>";
			}
			
			$already_updated_items[] = $arr['Record']->Номенклатура;
			
		}else{
			echo $data->Номенклатура." - ".$data->Цена."<br/>";
		}
		
		
	}
}
*/

$period1 = str_replace("T", " ", "2021-04-21T13:04:52");
$period2 = str_replace("T", " ", "2019-08-16T12:36:36");

echo $period1." - ".$period2;

$date1 = strtotime($period1);
$date2 = strtotime($period2);

echo "<br/><br/><br/>";

if( $date1 > $date2 ){
	echo "new last date";
}else{
	echo "date is past";
}

require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php";
?>
