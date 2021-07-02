<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}


$arResult['SECTIONS_LIST'] = \Bitrix\Iblock\SectionTable::getList([
    'filter' => [
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        'ACTIVE' => 'Y'
    ],
    'select' => ['NAME', 'ID']
])->fetchAll();


foreach ($arResult['ITEMS'] as $item)
{
    $arResult['SECTION_ITEM'][$item['IBLOCK_SECTION_ID']][] = $item;
}

