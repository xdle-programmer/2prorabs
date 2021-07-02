<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
$_SERVER['DOCUMENT_ROOT'] = realpath(__DIR__ . '/../../');
define('NO_KEEP_STATISTIC', true);
define('NO_AGENT_STATISTIC', true);
define('NO_AGENT_CHECK', true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
\Bitrix\Main\Application::getConnection('set session wait_timeout=28800');
$DB->Query('set session wait_timeout=28800');

for ($i = ob_get_level(); $i > 0; $i--) {
    ob_end_flush();
}

if (\CUtil::translit('тест', 'ru') !== 'test') {
    print 'Enable mbstring.func_overload = 2 or make sure that translit is working' . "\n";
    exit;
}

$import = new \Site\Import();
$import->test = true;
$filename = '/upload/import_archive/' . $argv[1];

if (strpos($argv[1], '_partial') !== false) {
    $dataMode = \Site\Import::DATA_MODE_PARTIAL;
} else {
    $dataMode = \Site\Import::DATA_MODE_FULL;
}

if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $filename)) {
    print "XML file not found\n";
    exit;
}

$import->setDstFile($filename, $dataMode);

/*if ($import->download() === false) {
    exit;
}*/

$import->run();
//$import->deleteRemoteFile();

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");