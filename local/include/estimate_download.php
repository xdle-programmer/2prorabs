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