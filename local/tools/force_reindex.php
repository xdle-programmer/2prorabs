<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$lastId = $_GET['id'] ?? 0;

\Bitrix\Main\Loader::includeModule('iblock');
$iterator = \CIBlockElement::GetList(['ID' => 'ASC'], ['IBLOCK_ID' => \Site\CATALOG_IBLOCK_ID, '>ID' => $lastId], false, ['nTopCount' => 5000], ['ID', 'NAME']);

while ($arItem = $iterator->Fetch()) {
    $el = new \CIBlockElement;
    //$el->Update($arItem['ID'], ['NAME' => $arItem['NAME']]);
    $el->UpdateSearch($arItem['ID'], true);
    $lastId = $arItem['ID'];
}

if ($iterator->SelectedRowsCount() === 0) {
    print 'end';
} else {
    print '<html><body><script>document.location.href = "force_reindex.php?id=' . $lastId . '";</script></body></html>';
}