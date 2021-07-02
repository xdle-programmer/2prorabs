<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arResult['ITEMS_COUNT'] = count($arResult['ITEMS']);

$this->getComponent()->setResultCacheKeys(['ITEMS_COUNT']);