<?php
return [
    'formId' => 'product_review',
    'iblockId' => \Site\PRODUCT_REVIEW_IBLOCK_ID,
    'captcha' => false,
    'protectString' => 'XJuQ52GmKW',
    'fields' => [
        'name' => [
            'field' => 'NAME',
            'required' => true,
            'caption' => 'Имя',
        ],
        'email' => [
            'field' => 'PROPERTY_EMAIL',
            'required' => true,
            'caption' => 'Email',
        ],
        'productId' => [
            'field' => 'PROPERTY_PRODUCT',
            'required' => true,
            'caption' => 'Товар',
        ],
        'text' => [
            'field' => 'DETAIL_TEXT',
            'required' => true,
            'caption' => 'Отзыв',
        ],
		'raiting' => [
            'field' => 'PROPERTY_RAITING',
            'required' => true,
            'caption' => 'Рейтинг',
        ],
    ],
    'defaults' => [
        'ACTIVE' => 'N',
        'DATE_ACTIVE_FROM' => strftime('%d.%m.%Y %H:%M:%S'),
    ],
    'eventName' => 'NAV_PRODUCT_REVIEW',
];
