<?php
namespace nav;

require_once(__DIR__ . '/settings.php');

spl_autoload_register(function ($class) {
    $file = \Bitrix\Main\Application::getDocumentRoot() . '/local/lib/' . str_replace('\\', '/', $class) . '.php';

    if (file_exists($file)) {
        include($file);
    }
});

\CModule::AddAutoloadClasses('', [
    'dBug' => '/local/lib/ext/dBug.php',
]);

require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/misc.php');
require_once(__DIR__ . '/handlers.php');

\nav\UncachedArea::init();

if (class_exists('\nav\Debug\Debug')) {
    \nav\Debug\Debug::getInstance()->setConnectionParams('37.193.179.101', 37890);

    \nav\Debug\Debug::getInstance()->setRestriction(function () {
        return $_SERVER['REMOTE_ADDR'] == '37.193.179.101';
    });
}
