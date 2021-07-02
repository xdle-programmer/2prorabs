<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$APPLICATION->IncludeComponent('nav:form', '.default', [
    'PARAMS' => [
        'formId' => 'fast_order',
        'iblockId' => \Site\FAST_ORDER_IBLOCK_ID,
        'captcha' => false,
        'protectString' => 'XJuQ52GmKW',
        'fields' => [
            'name' => [
                'field' => 'NAME',
                'required' => true,
                'caption' => 'Имя',
            ],
            'phone' => [
                'field' => 'PROPERTY_PHONE',
                'required' => true,
                'caption' => 'Телефон',
            ],
            'productId' => [
                'field' => 'PROPERTY_PRODUCT',
                'required' => true,
                'caption' => 'Товар',
            ],
        ],
        'defaults' => [
            'ACTIVE' => 'N',
            'DATE_ACTIVE_FROM' => strftime('%d.%m.%Y %H:%M:%S'),
        ],
        'eventName' => 'NAV_FAST_ORDER',
    ],
], ['HIDE_ICONS' => 'Y']);