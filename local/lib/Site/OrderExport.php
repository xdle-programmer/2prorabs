<?php

namespace Site;

class OrderExport
{
    /**
     * @var int
     */
    protected $orderId;

    /**
     * @var \DomDocument
     */
    protected $dom;

    /**
     * @var string
     */
    protected $filename;

    public function __construct(int $orderId)
    {
        $this->orderId = $orderId;

        \Bitrix\Main\Loader::includeModule('iblock');
        \Bitrix\Main\Loader::includeModule('sale');
        \Bitrix\Main\Loader::includeModule('catalog');
    }

    public function export()
    {
        $iblockCatalogID = 1;

        $arOrder = $this->getOrderData($this->orderId);

        $arPaySystem = $this->getPaySystem($arOrder['PAY_SYSTEM_ID']);
        $orderProducts = $this->getOrderProducts($this->orderId);
        $arCatalogProducts = $this->getCatalogProductInfo(array_keys($orderProducts));
        $arDelivery = $this->getDelivery($arOrder['DELIVERY_ID']);
        $arMeasures = $this->getMeasuresRatio();
        $moreProducts = $this->getProductsInfo(array_keys($orderProducts), $iblockCatalogID);
        $arPrice = $this->getPricesType(\Site\PRICE_TYPE_ID);
        $arUser = $this->getUserInfo($arOrder['PERSON_TYPE_ID']);

        foreach ($moreProducts as $key => &$product) {
            if ($orderProducts[$key]) {
                $product = array_merge($product, $orderProducts[$key]);
            }
            if ($arCatalogProducts[$key]) {
                $product = array_merge($product, $arCatalogProducts[$key]);
            }
        }
        unset($product);

        $order = [
	        'СайтНомерДокумента' => $arOrder['XML_ID'],
            'Date' => FormatDate(('Y-m-d\TG:i:s'), strtotime($arOrder['DATE_STATUS'])),
            'Number' => $arOrder['ID'],
            'Комментарий' => $arOrder['COMMENTS'],
            'Контрагент' => $arUser['XML_ID'],
            'ТипЦен' => $arPrice['XML_ID'],
            'СуммаДокумента' => $arOrder['PRICE'],
            'ВидОплаты' => $arPaySystem['NAME'],
            'СуммаСкидкиНаДокумент' => $arOrder['DISCOUNT_VALUE'],
            'ВидДоставки' => $arDelivery['XML_ID'],
            'СуммаДоставки' => $arOrder['PRICE_DELIVERY'],
	        'СайтСтатусДокумента' => $this->getStatus($arOrder['STATUS_ID']),
        ];

        foreach ($moreProducts as $product) {
            $vat = $this->getVat($product['VAT_ID']);
            $order['Товары'][] = [
                'Номенклатура' => $product['XML_ID'],
                'Количество' => $product['QUANTITY'],
                'Резерв' => $product['QUANTITY_RESERVED'],
                'ЕдиницаИзмерения' => $product['CATALOG_MEASURE'],
                'Коэффициент' => $arMeasures[$product['PRODUCT_ID']]['RATIO'],
                'Цена' => (float) $product['PRICE'],
                'Сумма' => (float) $product['PRICE'] * (int) $product['QUANTITY'],
                'ПроцентСкидки' => (float) $product['DISCOUNT_PRICE'] / (float) $product['PRICE'],
                'СтавкаНДС' => $vat['RATE'],
                'СуммаНДС' => (float) $vat['RATE'] / 100 * (float) $product['PRICE'],
                'СуммаВсего' => (float) $product['PRICE'] * (int) $product['QUANTITY'],
                'МестоРазмещения' => $arOrder['PROPERTY_VAL_BY_CODE_LOCATION'],
                'КоличествоБазовое' => $product['CATALOG_QUANTITY'],
            ];
        }

        $body = [
            'v8msg:Message' => [
                'v8msg:Header' => [
                    'v8msg:ExchangePlan' => 'bz_ОбменИнтернетМагазин',
                    'v8msg:To' => 'SS',
                    'v8msg:From' => 'ЦБ',
                    'v8msg:ReceivedNo' => '0'
                ],
                'v8msg:Body' => [
                    'DocumentObject.ЗаказПокупателя' => $order,
                ]
            ]
        ];

        $orderProperties = [
            'Телефон' => [
                'Filter' => [
                    'Объект' => $arUser['XML_ID'],
                    'Тип' => 'Телефон',
                    'Вид' => '19d20506-d011-4762-992a-ec9859d7a53b',
                ],
                'Records' => [
                    'Record' => [
                        'Объект' => $arUser['XML_ID'],
                        'Тип' => 'Телефон',
                        'Вид' => '19d20506-d011-4762-992a-ec9859d7a53b',
                        'ЗначениеПоУмолчанию' => 'true',
                        'Комментарий' => '',
                        'Поле1' => '',
                        'Поле2' => '',
                        'Поле3' => $arOrder['PROPERTY_VAL_BY_CODE_PHONE'],
                        'Поле4' => '',
                        'Поле5' => '',
                        'Поле6' => '',
                        'Поле7' => '',
                        'Поле8' => '',
                        'Поле9' => '',
                        'Поле10' => '',
                        'Поле11' => '',
                        'Поле12' => '',
                    ]
                ]
            ],
            'Имя' => [
                'Filter' => [
                    'Объект' => $arUser['XML_ID'],
                    'Тип' => 'Имя',
                    'Вид' => '00000000-0000-0000-0000-000000000000',
                ],
                'Records' => [
                    'Record' => [
                        'Объект' => $arUser['XML_ID'],
                        'Тип' => 'Имя',
                        'Вид' => '00000000-0000-0000-0000-000000000000',
                        'ЗначениеПоУмолчанию' => 'true',
                        'Комментарий' => '',
                        'Поле1' => $arOrder['PROPERTY_VAL_BY_CODE_NAME'],
                        'Поле2' => '',
                        'Поле3' => '',
                        'Поле4' => '',
                        'Поле5' => '',
                        'Поле6' => '',
                        'Поле7' => '',
                        'Поле8' => '',
                        'Поле9' => '',
                        'Поле10' => '',
                        'Поле11' => '',
                        'Поле12' => '',
                    ]
                ]
            ],
            'Фамилия' => [
                'Filter' => [
                    'Объект' => $arUser['XML_ID'],
                    'Тип' => 'Фамилия',
                    'Вид' => '00000000-0000-0000-0000-000000000000',
                ],
                'Records' => [
                    'Record' => [
                        'Объект' => $arUser['XML_ID'],
                        'Тип' => 'Фамилия',
                        'Вид' => '00000000-0000-0000-0000-000000000000',
                        'ЗначениеПоУмолчанию' => 'true',
                        'Комментарий' => '',
                        'Поле1' => $arOrder['PROPERTY_VAL_BY_CODE_LAST_NAME'],
                        'Поле2' => '',
                        'Поле3' => '',
                        'Поле4' => '',
                        'Поле5' => '',
                        'Поле6' => '',
                        'Поле7' => '',
                        'Поле8' => '',
                        'Поле9' => '',
                        'Поле10' => '',
                        'Поле11' => '',
                        'Поле12' => '',
                    ]
                ]
            ],
            'ГородПолучения' => [
                'Filter' => [
                    'Объект' => $arUser['XML_ID'],
                    'Тип' => 'ГородПолучения',
                    'Вид' => '00000000-0000-0000-0000-000000000000',
                ],
                'Records' => [
                    'Record' => [
                        'Объект' => $arUser['XML_ID'],
                        'Тип' => 'ГородПолучения',
                        'Вид' => '00000000-0000-0000-0000-000000000000',
                        'ЗначениеПоУмолчанию' => 'true',
                        'Комментарий' => '',
                        'Поле1' => $arOrder['PROPERTY_VAL_BY_CODE_LOCATION'],
                        'Поле2' => '',
                        'Поле3' => '',
                        'Поле4' => '',
                        'Поле5' => '',
                        'Поле6' => '',
                        'Поле7' => '',
                        'Поле8' => '',
                        'Поле9' => '',
                        'Поле10' => '',
                        'Поле11' => '',
                        'Поле12' => '',
                    ]
                ]
            ],
        ];

        if ($arOrder['DELIVERY_ID'] == 1) {
            $orderProperties['ПунктСамовывоза'] = [
                'Filter' => [
                    'Объект' => $arUser['XML_ID'],
                    'Тип' => 'ПунктСамовывоза',
                    'Вид' => '00000000-0000-0000-0000-000000000000',
                ],
                'Records' => [
                    'Record' => [
                        'Объект' => $arUser['XML_ID'],
                        'Тип' => 'ПунктСамовывоза',
                        'Вид' => '00000000-0000-0000-0000-000000000000',
                        'ЗначениеПоУмолчанию' => 'true',
                        'Комментарий' => '',
                        'Поле1' => $arOrder['PROPERTY_VAL_BY_CODE_POINT'],
                        'Поле2' => '',
                        'Поле3' => '',
                        'Поле4' => '',
                        'Поле5' => '',
                        'Поле6' => '',
                        'Поле7' => '',
                        'Поле8' => '',
                        'Поле9' => '',
                        'Поле10' => '',
                        'Поле11' => '',
                        'Поле12' => '',
                    ]
                ]
            ];
        } else {
            $orderProperties['Город'] = [
                'Filter' => [
                    'Объект' => $arUser['XML_ID'],
                    'Тип' => 'Город',
                    'Вид' => '00000000-0000-0000-0000-000000000000',
                ],
                'Records' => [
                    'Record' => [
                        'Объект' => $arUser['XML_ID'],
                        'Тип' => 'Город',
                        'Вид' => '00000000-0000-0000-0000-000000000000',
                        'ЗначениеПоУмолчанию' => 'true',
                        'Комментарий' => '',
                        'Поле1' => $arOrder['PROPERTY_VAL_BY_CODE_CITY'],
                        'Поле2' => '',
                        'Поле3' => '',
                        'Поле4' => '',
                        'Поле5' => '',
                        'Поле6' => '',
                        'Поле7' => '',
                        'Поле8' => '',
                        'Поле9' => '',
                        'Поле10' => '',
                        'Поле11' => '',
                        'Поле12' => '',
                    ]
                ]
            ];
            $orderProperties['Дом'] = [
                'Filter' => [
                    'Объект' => $arUser['XML_ID'],
                    'Тип' => 'Дом',
                    'Вид' => '00000000-0000-0000-0000-000000000000',
                ],
                'Records' => [
                    'Record' => [
                        'Объект' => $arUser['XML_ID'],
                        'Тип' => 'Дом',
                        'Вид' => '00000000-0000-0000-0000-000000000000',
                        'ЗначениеПоУмолчанию' => 'true',
                        'Комментарий' => '',
                        'Поле1' => $arOrder['PROPERTY_VAL_BY_CODE_HOUSE'],
                        'Поле2' => '',
                        'Поле3' => '',
                        'Поле4' => '',
                        'Поле5' => '',
                        'Поле6' => '',
                        'Поле7' => '',
                        'Поле8' => '',
                        'Поле9' => '',
                        'Поле10' => '',
                        'Поле11' => '',
                        'Поле12' => '',
                    ]
                ]
            ];
            $orderProperties['Улица'] = [
                'Filter' => [
                    'Объект' => $arUser['XML_ID'],
                    'Тип' => 'Улица',
                    'Вид' => '00000000-0000-0000-0000-000000000000',
                ],
                'Records' => [
                    'Record' => [
                        'Объект' => $arUser['XML_ID'],
                        'Тип' => 'Улица',
                        'Вид' => '00000000-0000-0000-0000-000000000000',
                        'ЗначениеПоУмолчанию' => 'true',
                        'Комментарий' => '',
                        'Поле1' => $arOrder['PROPERTY_VAL_BY_CODE_STREET'],
                        'Поле2' => '',
                        'Поле3' => '',
                        'Поле4' => '',
                        'Поле5' => '',
                        'Поле6' => '',
                        'Поле7' => '',
                        'Поле8' => '',
                        'Поле9' => '',
                        'Поле10' => '',
                        'Поле11' => '',
                        'Поле12' => '',
                    ]
                ]
            ];
            $orderProperties['Квартира'] = [
                'Filter' => [
                    'Объект' => $arUser['XML_ID'],
                    'Тип' => 'Улица',
                    'Вид' => '00000000-0000-0000-0000-000000000000',
                ],
                'Records' => [
                    'Record' => [
                        'Объект' => $arUser['XML_ID'],
                        'Тип' => 'Улица',
                        'Вид' => '00000000-0000-0000-0000-000000000000',
                        'ЗначениеПоУмолчанию' => 'true',
                        'Комментарий' => '',
                        'Поле1' => $arOrder['PROPERTY_VAL_BY_CODE_STREET'],
                        'Поле2' => '',
                        'Поле3' => '',
                        'Поле4' => '',
                        'Поле5' => '',
                        'Поле6' => '',
                        'Поле7' => '',
                        'Поле8' => '',
                        'Поле9' => '',
                        'Поле10' => '',
                        'Поле11' => '',
                        'Поле12' => '',
                    ]
                ]
            ];
        }

        $cnt = 0;
        /*foreach ($orderProperties as $group) {
            $body['v8msg:Message']['v8msg:Body']['InformationRegisterRecordSet' . $cnt] = $group;
            $cnt++;
        }*/

	    if ($arOrder['PROPERTY_VAL_BY_CODE_CITY']) {
	    	$addres = $arOrder['PROPERTY_VAL_BY_CODE_CITY'];
	    } else {
		    $addres = $arOrder['PROPERTY_VAL_BY_CODE_POINT'];
	    }

        $body['v8msg:Message']['v8msg:Body']['CatalogObject.КлиентыИнтернетМагазина'] = [
            'Ref' => $arUser['ID'],
            'Имя' => $arUser['NAME'],
            'Фамилия' => $arUser['LAST_NAME'],
            'Отчество' => $arUser['SECOND_NAME'],
            'Description' => 'Физическое лицо',
            'НаименованиеПолное' => 'Физическое лицо',
            'Телефоны' => $arUser['PERSONAL_PHONE'],
            'ИНН' => $arUser['UF_INN'],
            'ДатаРождения' => FormatDate(('Y-m-d\TG:i:s'), strtotime($arUser['PERSONAL_BIRTHDAY'])),
            'Пол' => $arUser['PERSONAL_GENDER'] == 'F' ? 'Женский' : 'Мужской',
            'Email' => $arUser['EMAIL'],
	        'Адрес' => $addres,
        ];



        $this->dom = new \DomDocument('1.0', 'UTF-8');
        $this->dom->formatOutput = true;
        $xml = $this->createXml($body);
        $this->filename = 'order_' . $arOrder['ID'] . '.xml';
        $this->dom->save($_SERVER['DOCUMENT_ROOT'] . '/upload/orders/' . $this->filename);
    }

    public function upload()
    {
        try {
            $conn = $this->createFtpConnection();
        } catch (\Exception $e) {
            return false;
        }

        $result = ftp_put($conn, \Site\FTP_ORDERS_DIR . $this->filename, $_SERVER['DOCUMENT_ROOT'] . '/upload/orders/' . $this->filename, FTP_BINARY);

        if ($result === false) {
            return false;
        }

        $this->closeFtpConnection($conn);
        return true;
    }

    /**
     * Event: sale:OnSaleOrderSaved
     * @param \Bitrix\Main\Event $event
     */
    public static function exportOnSave(\Bitrix\Main\Event $event)
    {
        /** @var \Bitrix\Sale\Order $order */
        $order = $event->getParameter('ENTITY');
        $export = new static($order->getId());
        $export->export();
        $export->upload();
    }

    protected function getPaySystem($systemID)
    {
        $select = ['ID', 'NAME'];
        $db_ptype = \CSalePaySystem::GetList(["SORT" => "ASC"], ["ID" => $systemID], false, false, $select);
        return $db_ptype->Fetch();
    }

    protected function  getStatus($statusID)
    {
    	$select = ['ID', 'NAME'];
    	return \CSaleStatus::GetByID($statusID)["NAME"];
    }

    protected function getOrderProducts($orderID)
    {
        $arFilter = [
            "ORDER_ID" => $orderID,
        ];
        $arSelect = [
            'ID',
            'PRODUCT_ID',
            'PRICE',
            'CURRENCY',
            'QUANTITY',
            'DISCOUNT_PRICE',
            'NOTES',
        ];

        $dbBasketItems = \CSaleBasket::GetList(["SORT" => "ASC"], $arFilter, false, false, $arSelect);
        $items = [];

        while ($arItem = $dbBasketItems->Fetch()) {
            $items[$arItem['PRODUCT_ID']] = $arItem;
        }

        return $items;
    }

    protected function getCatalogProductInfo($productsID)
    {
        $select = ['ID', 'QUANTITY_RESERVED'];
        $db_ptype = \CCatalogProduct::GetList(["SORT" => "ASC"], ["ID" => $productsID], false, false, $select);
        $res = [];

        while ($ptype = $db_ptype->Fetch()) {
            $res[$ptype['ID']] = $ptype;
        }

        return $res;
    }

    protected function getDelivery($deliveryID)
    {
        $select = ['ID', 'XML_ID'];
        $db_ptype = \CSaleDelivery::GetList(["SORT" => "ASC"], ["ID" => $deliveryID], false, false, $select);
        return $db_ptype->Fetch();
    }

    protected function getMeasuresRatio()
    {
        $res = \CCatalogMeasureRatio::getList([], [], false, false, []);
        while ($ob = $res->Fetch()) {
            $measures[$ob['PRODUCT_ID']] = $ob;
        }

        return $measures;
    }

    protected function getProductsInfo($productsID, $iblockID)
    {
        $arSelect = ["ID", "XML_ID", 'CATALOG_PRICE_1', 'PROPERTY_'];
        $arFilter = ["IBLOCK_ID" => IntVal($iblockID), 'ID' => $productsID];
        $res = \CIBlockElement::GetList([], $arFilter, false, ["nPageSize" => 50], $arSelect);
        while ($ob = $res->Fetch()) {
            $items[$ob['ID']] = $ob;
        }
        return $items;
    }

    protected function getPricesType($priceTypeID)
    {
        $filter = ['ID' => $priceTypeID];

        $select = [
            'ID',
            'XML_ID'
        ];

        $dbPriceType = \CCatalogGroup::GetList(
            ["SORT" => "ASC"],
            $filter,
            false,
            false,
            $select
        );

        return $dbPriceType->Fetch();
    }

    protected function getUserInfo($userID)
    {
        $filter = [
            "ID" => $userID,
        ];

        $select = [
            'SELECT' => [
                'UF_INN'
            ],
            'FIELDS' => [
                'ID',
                'XML_ID',
                'NAME',
                'LAST_NAME',
                'SECOND_NAME',
                'PERSONAL_GENDER',
                'EMAIL',
                'PERSONAL_PHONE',
            ]
        ];

        $by = 'name';
        $order = 'asc';
        $rsUsers = \CUser::GetList($by, $order, $filter, $select);
        $arUser = $rsUsers->Fetch();

        return $arUser;
    }

    protected function getVat($vatID)
    {
        $select = ['ID', 'RATE'];
        $db_ptype = \CCatalogVat::GetListEx(["SORT" => "ASC"], ["ID" => $vatID], false, false, $select);
        while ($ptype = $db_ptype->Fetch()) {
            $vat[$ptype['ID']] = $ptype;
        }

        return $vat;
    }

    protected function createXml($data, $parent = false)
    {
        foreach ($data as $tagName => $value) {
            if (is_numeric($tagName)) $tagName = 'Row';
            if (preg_match('RegisterRecordSet', $tagName)) $tagName = 'InformationRegisterRecordSet.КонтактнаяИнформация';
            if (is_array($value)) {
                if (!$parent) {
                    $subParent = $this->dom->appendChild($this->dom->createElement($tagName));
                } else {
                    $subParent = $parent->appendChild($this->dom->createElement($tagName));
                }
                $this->createXml($value, $subParent);
            } else {
                $tag = $parent->appendChild($this->dom->createElement($tagName));
                $tag->appendChild($this->dom->createTextNode($value));
            }
        }
        if ($parent) {
            return $parent;
        } else {
            return $this->dom->saveXML();
        }
    }

    protected function getOrderData($id)
    {
        $arFilter = [
            "ID" => $id,
        ];

        $arSelect = [
            'ID',
            'PAY_SYSTEM_ID',
            'DELIVERY_ID',
            'PERSON_TYPE_ID',
            'USER_ID',
            'PRICE',
            'CURRENCY',
            'DATE_STATUS',
            'PRICE_DELIVERY',
            'DISCOUNT_VALUE',
            'SUM_PAID',
            'COMMENTS',
            'XML_ID',
	        'CREATED_BY',
	        'ADDRESS',
            'PROPERTY_VAL_BY_CODE_LOCATION',
            'PROPERTY_VAL_BY_CODE_NAME',
            //'PROPERTY_VAL_BY_CODE_LAST_NAME',
            'PROPERTY_VAL_BY_CODE_CITY',
            'PROPERTY_VAL_BY_CODE_STREET',
            'PROPERTY_VAL_BY_CODE_HOUSE',
            'PROPERTY_VAL_BY_CODE_APARTMENT',
            'PROPERTY_VAL_BY_CODE_POINT',
            'PROPERTY_VAL_BY_CODE_PHONE',
	        'STATUS_ID',
        ];
	    //pre($id);
        $db_sales = \CSaleOrder::GetList(["SORT" => "ASC"], $arFilter, false, false, $arSelect);
        $tmp = $db_sales->Fetch();
        //pre($this->getStatus($tmp["STATUS_ID"]));
        //pre($db_sales->Fetch());
	    //pre($tmp);
        //return $db_sales->Fetch();

	    return $tmp;
    }

    /**
     * @return false|resource
     * @throws \Exception
     */
    protected function createFtpConnection()
    {
        $conn = ftp_connect(\Site\FTP_SERVER);
        $result = ftp_login($conn, \Site\FTP_LOGIN, \Site\FTP_PASSWORD);

        if ($result === false) {
            throw new \Exception('Couldn\'t connect to FTP server');
        }

        ftp_pasv($conn, true);
        ftp_set_option($conn, FTP_TIMEOUT_SEC, 300);

        return $conn;
    }

    protected function closeFtpConnection($conn): void
    {
        ftp_close($conn);
    }
}

function pre($arr)
{
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
}