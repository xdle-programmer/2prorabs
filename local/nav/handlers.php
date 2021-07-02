<?php
namespace nav\Handler;

\nav\AdminInterfaceModifier::initHandlers();

$eventManager = \Bitrix\Main\EventManager::getInstance();

$eventManager->addEventHandler('sale', 'OnSaleOrderSaved', [\Site\OrderExport::class, 'exportOnSave']);

