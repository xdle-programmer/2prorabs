<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
require_once ($_SERVER["DOCUMENT_ROOT"] . '/local/include/phpexcel/PHPExcel.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/local/include/phpexcel/PHPExcel/Writer/Excel2007.php');
global $USER;
CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");
if ($_REQUEST['estimate']) {
    $arFilter = Array(
        "USER_ID" => $USER->GetID(),
        "ORDER_ID" => $_REQUEST['estimate'],
    );

    $db_sales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
    if  ($ar_sales = $db_sales->Fetch())
    {
        $dbItemsInOrder = CSaleBasket::GetList(
            array("ID" => "ASC"),
            array("ORDER_ID" => $_REQUEST['order_id']),
            false,
            false,
            ['ID', 'NAME', 'PRICE', 'QUANTITY']
        );
        while ($res = $dbItemsInOrder->Fetch()) {
            $basketItems[] = $res;
        }

        $xls = new PHPExcel();

        $xls->setActiveSheetIndex(0);

        $sheet = $xls->getActiveSheet();

        $sheet->setCellValue('A1', 'Товар');
        $sheet->setCellValue('B1', 'Количество, шт.');
        $sheet->setCellValue('C1', 'Стоимость за еденицу, руб');
        $cnt = 2;
        foreach ($basketItems as $item) {
            $sheet->setCellValue('A' . $cnt, $item['NAME']);
            $sheet->setCellValue('B' . $cnt, $item['QUANTITY']);
            $sheet->setCellValue('C' . $cnt, $item['PRICE']);
			$cnt++;
        }

        header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
        header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
        header ( "Cache-Control: no-cache, must-revalidate" );
        header ( "Pragma: no-cache" );
        header ( "Content-type: application/vnd.ms-excel" );
        header ( "Content-Disposition: attachment; filename=estimate.xls" );


        $objWriter = new PHPExcel_Writer_Excel2007($xls);

        $objWriter->save('php://output');
    }



}elseif ( isset($_REQUEST['estimate_id']) && intval($_REQUEST['estimate_id'])>0 && $_REQUEST['from_basket'] == "Y" ) {
	
	$arProducts = array();
	$arQuantity = array();
	$arSelect = Array("ID", "IBLOCK_ID", "PROPERTY_PRODUCTS", "PROPERTY_QUANTITY");
	$arFilter = Array("IBLOCK_ID"=>49, "ID"=>$_REQUEST['estimate_id']);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($ob = $res->GetNextElement()){
		$arFields = $ob->GetFields();
		$arFields["PROPS"] = $ob->GetProperties();

		$arProducts[$_REQUEST['estimate_id']] = $arFields["PROPS"]["PRODUCTS"]["VALUE"];
		$arQuantity[$_REQUEST['estimate_id']] = $arFields["PROPS"]["QUANTITY"]["VALUE"];
	}


	if( count($arProducts[$_REQUEST['estimate_id']])>0 ){
		$basketItems = array();
		
		$arSelect = Array("ID", "NAME", "IBLOCK_ID", "PRICE_1");
		$arFilter = Array("IBLOCK_ID"=>1, "ID"=>$arProducts[$_REQUEST['estimate_id']]);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ob = $res->GetNextElement()){
			$arFields = $ob->GetFields();

			$basketItems[] = $arFields;
		}
		
		$xls = new PHPExcel();

        $xls->setActiveSheetIndex(0);

        $sheet = $xls->getActiveSheet();

        $sheet->setCellValue('A1', 'Товар');
        $sheet->setCellValue('B1', 'Количество, шт.');
        $sheet->setCellValue('C1', 'Стоимость за еденицу, руб');
        $cnt = 2;
        foreach ($basketItems as $key=>$item) {
            $sheet->setCellValue('A' . $cnt, $item['NAME']);
            $sheet->setCellValue('B' . $cnt, $arQuantity[$_REQUEST['estimate_id']][$key]);
            $sheet->setCellValue('C' . $cnt, $item['PRICE_1']);
			$cnt++;
        }

        header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
        header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
        header ( "Cache-Control: no-cache, must-revalidate" );
        header ( "Pragma: no-cache" );
        header ( "Content-type: application/vnd.ms-excel" );
        header ( "Content-Disposition: attachment; filename=estimate.xls" );


        $objWriter = new PHPExcel_Writer_Excel2007($xls);

        $objWriter->save('php://output');
		
	}

}