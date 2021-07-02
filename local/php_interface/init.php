<?
$arLibs = [
    $_SERVER['DOCUMENT_ROOT'].'/local/php_interface/include/defines.php',
    $_SERVER['DOCUMENT_ROOT'].'/local/nav/include.php',
];

CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");
CModule::IncludeModule("iblock");

$lcur = CCurrency::GetList(($by="name"), ($order="asc"), LANGUAGE_ID);
while($lcur_res = $lcur->Fetch())
{
    if ($lcur_res['BASE'] == 'Y') $currency = $lcur_res['FULL_NAME'];
}
define('CURRENCY', $currency);


foreach($arLibs as $lib){
    if(file_exists($lib)){
        require_once($lib);
    }
}

spl_autoload_register(function ($class) {
    $file = \Bitrix\Main\Application::getDocumentRoot() . '/local/lib/' . str_replace('\\', '/', $class) . '.php';

    if (file_exists($file)) {
        /** @noinspection PhpIncludeInspection */
        include($file);
    }
});

\Bitrix\Main\Loader::registerAutoLoadClasses(null, [
    'DDS\\Tools' => '/local/php_interface/include/DDSShopAPI/classes/tools.php',
    'DDS\\Basketclass' => '/local/php_interface/include/DDSShopAPI/classes/basket.php',
    'DDS\\Bonus' => '/local/php_interface/include/DDSShopAPI/classes/bonus.php',
    'DDS\\Date' => '/local/php_interface/include/DDSShopAPI/classes/date.php',
    'DDS\\HL' => '/local/php_interface/include/DDSShopAPI/classes/HL.php',
]);

AddEventHandler("sale", "OnOrderSave", array("OrderHandler", "orderAdd"));
AddEventHandler("sale", "OnSaleStatusOrder", array("OrderHandler", "orderStatusUpdate"));

//AddEventHandler("sale", "OnOrderSave", array("XmlFileHandler", "xmlInit"));

class OrderHandler
{
    function orderStatusUpdate($ID, $arFields)
    {
        //Изменения статуса
        if ($arFields == "F") {
            $add = (new DDS\Tools\Bonus())->addBonus(array("UF_ID" => $ID));
        }

    }

}
