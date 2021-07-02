<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Application,
    Bitrix\Main\Loader,
    \Bitrix\Iblock\Component\Tools,
    Bitrix\Sale,
    Bitrix\Main\Context,
    Bitrix\Currency\CurrencyManager,
    Bitrix\Sale\Order,
    Bitrix\Sale\Basket,
    Bitrix\Sale\Delivery,
    Bitrix\Sale\PaySystem,
    Bitrix\Iblock\ElementTable,
    Bitrix\Sale\Fuser,
    Bitrix\Sale\DiscountCouponsManager,
    Bitrix\Main\Engine\ActionFilter\Authentication,
    Bitrix\Main\Engine\ActionFilter,
    Bitrix\Main\UserTable,
    Bitrix\Main\Web\HttpClient;

Loader::includeModule('iblock');
Loader::includeModule('sale');


use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Sale\Discount;
use Bitrix\Sale\Location\LocationTable;
use Bitrix\Sale\PaySystem\Manager;

CJSCore::Init(["fx", "ajax"]);

class tqOrder extends CBitrixComponent implements Controllerable
{

    /**
     * @var Basket
     */
    private $order;

    private $delivery_id = 2;

    private $payment = 3;

    private $componentPage;

    private $arRequiredFields = [
        'delivery' => [
            'delivery_id' => 'Доставка',
            'NAME' => 'Имя',
            'PHONE' => 'Телефон',
            'POINT' => 'Пункт самовывоза',
            'CITY' => 'Город',
            'STREET' => 'Улица',
            'HOUSE' => 'Дом',
            'APARTMENT' => 'Квартира',
            'LOCATION' => 'Город получения'
        ],
        'payment' => [
            'payment' => 'Способ оплаты'
        ]
    ];

    protected $userProfile;

    const DEFAULT_PERSON_TYPE = 1;

    public function configureActions()
    {
        return [
            'getDeliveryPrice' => [ // Ajax-метод
                'prefilters' => [],
            ],
            'updatePrice' => [ // Ajax-метод
                'prefilters' => [],
            ],
            'saveForm' => [ // Ajax-метод
                'prefilters' => [],
            ],
            'createOrder' => [ // Ajax-метод
                'prefilters' => [],
            ],
        ];
    }

    public function updatePriceAction($payment_id)
    {
        $this->getSavedFields();
        global $USER;
        Loader::includeModule('catalog');
        Loader::includeModule('sale');
        $basket = Basket::loadItemsForFUser(Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());
        $order = Order::create(SITE_ID, $USER->GetId() ?: CSaleUser::GetAnonymousUserID());
        $order->setPersonTypeId(1);
        $order->setBasket($basket);

        $shipmentCollection = $order->getShipmentCollection();

        $delivery = \Bitrix\Sale\Delivery\Services\Manager::getObjectById($this->delivery_id);
        $shipment = $shipmentCollection->createItem($delivery);
        $shipmentItemCollection = $shipment->getShipmentItemCollection();

        foreach ($basket as $basketItem) {
            $item = $shipmentItemCollection->createItem($basketItem);
            $item->setQuantity($basketItem->getQuantity());
        }

        $paymentCollection = $order->getPaymentCollection();
        $payment = $paymentCollection->createItem();
        $paySystemService = Manager::getObjectById($payment_id);

        $payment->setFields([
            'PAY_SYSTEM_ID' => $paySystemService->getField("PAY_SYSTEM_ID"),
            'PAY_SYSTEM_NAME' => $paySystemService->getField("NAME"),
            'SUM' => $order->getPrice()
        ]);

        $result = [
            'basket_sum' => CCurrencyLang::CurrencyFormat($basket->getPrice(), $basketItem->getCurrency(), true),
            'delivery_price' => $order->getDeliveryPrice() ? CCurrencyLang::CurrencyFormat($order->getDeliveryPrice(), $basketItem->getCurrency(),
                true) : 'Бесплатно',
            'total' => CCurrencyLang::CurrencyFormat($order->getPrice(), $basketItem->getCurrency(), true),
            'delivery' => $order->getDeliveryPrice()
        ];
        return $result;
    }

    private function getSavedFields()
    {
        $this->arResult['SAVED'] = $_SESSION['ORDER_FIELDS'];

        if (!empty($_SESSION['ORDER_FIELDS']['delivery'])) {
            if (empty($_SESSION['ORDER_FIELDS']['delivery']['data'])) {
                $_SESSION['ORDER_FIELDS']['delivery']['data'] = 'N';
            }
            if (empty($_SESSION['ORDER_FIELDS']['delivery']['NEWS'])) {
                $_SESSION['ORDER_FIELDS']['delivery']['NEWS'] = 'N';
            }
        }
        $this->delivery_id = $this->arResult['SAVED']['delivery']['delivery_id'] ?: $this->delivery_id;
        $this->payment = $this->arResult['SAVED']['payment']['payment'] ?: $this->delivery_id;
        return $this->arResult['SAVED'];
    }

    public function createOrderAction()
    {
        $siteId = SITE_ID;
        global $USER;
        Bitrix\Main\Loader::includeModule("sale");
        Bitrix\Main\Loader::includeModule("catalog");
        $arSaved = $this->getSavedFields();

        foreach ($arSaved as $arTab) {
            foreach ($arTab as $key => $value) {
                $props[$key] = $value;
            }
        }

        if (!empty($this->request->get('comment'))) {
            $props['comment'] = $this->request->get('comment');
        }

        //$personType = !empty($props['payer']) ? $props['payer'] : 1;
        $personType = static::DEFAULT_PERSON_TYPE;
        $db_props = CSaleOrderProps::GetList(["SORT" => "ASC"], ["PERSON_TYPE_ID" => $personType, 'ACTIVE' => 'Y'], false, false, []);
        $properties = [];

        while ($prop = $db_props->GetNext()) {
            $properties[$prop['CODE']] = $prop;
        }

        $rsUser = CUser::GetByID($USER->GetId());
        $arUser = $rsUser->Fetch();
        //$props['PHONE'] = $arUser['PERSONAL_PHONE'];
        $props['EMAIL'] = $arUser['EMAIL'];

        $deliveryID = intval($props['delivery_id']);
        $paymentID = intval($props['payment']);
        $arResult['ERROR'] = [];

        // Apply default value for location because it's hidden in the form
        if (empty($props['LOCATION'])) {
            $props['LOCATION'] = $properties['LOCATION']['DEFAULT_VALUE'];
        }

        foreach ($properties as $key => $property) {
            if ($property['REQUIED'] == 'Y' && empty($props[$property['CODE']])) {
                $arResult['ERROR'][] = 'Заполните поле "' . $property['NAME'] . '" <br>';
            }
        }

        if (empty($deliveryID)) {
            $arResult['ERROR'][] = "Выберите Доставку <br>";
        }

        if (empty($paymentID)) {
            $arResult['ERROR'][] = "Выберите систему оплаты <br>";
        }


        if (!$USER->isAuthorized()) {
            $arResult['ERROR'][] = 'Для оформления заказа необходима авторизация';
        }

        if (!empty($arResult['ERROR'])) {
            return ["STATUS" => "ERROR", "HTML" => $arResult['ERROR'], 'STEP' => $arResult['ERROR_PAGE']];
        }

        $this->order = $order = Order::create($siteId, $USER->GetID());
        $order->setPersonTypeId(!empty($personType) ? $personType : 1);

        $basket = Bitrix\Sale\Basket::loadItemsForFUser(Bitrix\Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());
        $order->setBasket($basket);

        $shipmentCollection = $order->getShipmentCollection();
        $shipment = $shipmentCollection->createItem();

        if (!empty($deliveryID)) {
            $service = Delivery\Services\Manager::getById($deliveryID);
        } else {
            $service = Delivery\Services\Manager::getById(Delivery\Services\EmptyDeliveryService::getEmptyDeliveryServiceId());
        }

        $shipment->setFields([
            'DELIVERY_ID' => $service['ID'],
            'DELIVERY_NAME' => $service['NAME'],
        ]);

        $paymentCollection = $order->getPaymentCollection();
        $payment = $paymentCollection->createItem();
        $paySystemService = Manager::getObjectById($paymentID);
        $deliveryPrice = 0;

        if (!empty($deliveryID)) {
            $deliveryPrice = $this->getdeliverypriceAction($deliveryID)['delivery'];
        }

        $payment->setFields([
            'PAY_SYSTEM_ID' => $paySystemService->getField("PAY_SYSTEM_ID"),
            'PAY_SYSTEM_NAME' => $paySystemService->getField("NAME"),
            'SUM' => $basket->getPrice() + $deliveryPrice
        ]);

        $shipment->setField("BASE_PRICE_DELIVERY", $deliveryPrice);
        $shipment->setField("CUSTOM_PRICE_DELIVERY", "Y");


        if ($props['comment'] || $props['comment_mob']) {
            $order->setField('USER_DESCRIPTION', $props['comment'] ?: $props['comment_mob']); // Устанавливаем поля комментария покупателя
        }
        if ($props['POINT']) {
            $res = CIBlockElement::GetByID($props['POINT']);

            if ($ar_res = $res->GetNext()) {
                $props['POINT'] = $ar_res['NAME'];
            }
        }

        $propertyCollection = $order->getPropertyCollection();
        $propertyCollection->getPhone()->setValue($props['PHONE']);
        $propertyCollection->getPayerName()->setValue($props['NAME']);
        $propertyCollection->getUserEmail()->setValue($props['EMAIL']);

        foreach ($properties as $key => $property) {
            $propertyCollection->getItemByOrderPropertyId($property['ID'])->setValue($props[$key]);
        }

        if ($props['LOCATION']) {
            $propertyCollection->getDeliveryLocation()->setValue(CSaleLocation::getLocationCODEbyID($props['LOCATION']));
        }

        $order->doFinalAction(true);
        $result = $order->save();
        $orderId = $order->getId();

        if ($orderId > 0) {
            $this->saveProfileData();

            unset($_SESSION['ORDER_FIELDS']);
            $_SESSION['SALE_ORDER_ID'][] = $orderId;
            DiscountCouponsManager::clear(true);
            return $orderId;
        } else {
            $arResult['ERROR'][] = "Вонзиникла неизвестная ошибка, попробуйте оформить заказ снова <br>";
            return ["STATUS" => "ERROR", "HTML" => $arResult['ERROR']];

        }
    }

    public function getDeliveryPriceAction($deliveryId)
    {
        global $USER;

        Loader::includeModule('catalog');
        Loader::includeModule('sale');
        $basket = Basket::loadItemsForFUser(Fuser::getId(),
            Bitrix\Main\Context::getCurrent()->getSite());
        $order = Order::create(SITE_ID, $USER->GetId() ?: CSaleUser::GetAnonymousUserID());
        $order->setPersonTypeId(1);
        $order->setBasket($basket);

        $shipmentCollection = $order->getShipmentCollection();

        $delivery = \Bitrix\Sale\Delivery\Services\Manager::getObjectById($deliveryId);
        $shipment = $shipmentCollection->createItem($delivery);
        $shipmentItemCollection = $shipment->getShipmentItemCollection();

        foreach ($basket as $basketItem) {
            $item = $shipmentItemCollection->createItem($basketItem);
            $item->setQuantity($basketItem->getQuantity());
        }

        $result = [
            'basket_sum' => CCurrencyLang::CurrencyFormat($basket->getPrice(), $basketItem->getCurrency(), true),
            'delivery_price' => $order->getDeliveryPrice() ? CCurrencyLang::CurrencyFormat($order->getDeliveryPrice(), $basketItem->getCurrency(),
                true) : 'Бесплатно',
            'total' => CCurrencyLang::CurrencyFormat($order->getPrice(), $basketItem->getCurrency(), true),
            'delivery' => $order->getDeliveryPrice()
        ];
        return $result;
    }

    public function saveFormAction($data, $tab)
    {
        $props = [];

        foreach ($data as $input) {
            $props[$input['name']] = $input['value'];
        }

        if ($props) {
            foreach ($this->arRequiredFields[$tab] as $key => $field) {
                if (isset($props[$key]) && empty($props[$key]))
                    $arErrors[] = sprintf('Обязательное поле: %s', $field);
            }

            if ($arErrors) {
                return ['STATUS' => 'ERROR', 'MESSAGE' => implode('<br>', $arErrors)];
            } else {
                unset($_SESSION['ORDER_FIELDS'][$tab]);
                $_SESSION['ORDER_FIELDS'][$tab] = $props;
                return ['STATUS' => 'SUCCESS'];
            }
        } else {
            return ['STATUS' => 'ERROR', 'MESSAGE' => 'Не заполнены поля'];
        }
    }

    public function executeComponent()
    {
        global $USER;
        if (!$USER->IsAuthorized()) LocalRedirect('/basket/');
        $this->getSavedFields();
        if ($this->arParams["SEF_MODE"] == "Y") {
            global $APPLICATION;
            $arComponentVariables = [];
            $arVariables = [];
            $arDefaultUrlTemplates404 = [
                "basket" => "",
                "delivery" => "delivery/",
                "payment" => "payment/",
            ];
            $arDefaultVariableAliases404 = [];
            $arUrlTemplates = CComponentEngine::makeComponentUrlTemplates($arDefaultUrlTemplates404,
                $this->arParams["SEF_URL_TEMPLATES"]);
            $arVariableAliases = CComponentEngine::makeComponentVariableAliases($arDefaultVariableAliases404,
                $this->arParams["VARIABLE_ALIASES"]);

            $engine = new CComponentEngine($this);
            if (CModule::IncludeModule('iblock')) {
                $engine->addGreedyPart("#SECTION_CODE_PATH#");
                $engine->setResolveCallback(["CIBlockFindTools", "resolveComponentEngine"]);
            }
            $componentPage = $engine->guessComponentPath(
                $this->arParams["SEF_FOLDER"],
                $arUrlTemplates,
                $arVariables
            );

            $b404 = false;
            if (!$componentPage) {
                $componentPage = "delivery";
                $b404 = true;
            }


            if ($b404 && CModule::IncludeModule('iblock')) {
                $folder404 = str_replace("\\", "/", $this->arParams["SEF_FOLDER"]);
                if ($folder404 != "/") {
                    $folder404 = "/" . trim($folder404, "/ \t\n\r\0\x0B") . "/";
                }
                if (substr($folder404, -1) == "/") {
                    $folder404 .= "index.php";
                }

                if ($folder404 != $APPLICATION->GetCurPage(true)) {
                    Tools::process404(
                        ""
                        , ($this->arParams["SET_STATUS_404"] === "Y")
                        , ($this->arParams["SET_STATUS_404"] === "Y")
                        , ($this->arParams["SHOW_404"] === "Y")
                        , $this->arParams["FILE_404"]
                    );
                }
            }

            CComponentEngine::initComponentVariables($componentPage, $arComponentVariables, $arVariableAliases,
                $arVariables);


            $this->arResult['SEF'] = [
                "FOLDER" => $this->arParams["SEF_FOLDER"],
                "URL_TEMPLATES" => $arUrlTemplates,
                "VARIABLES" => $arVariables,
                "ALIASES" => $arVariableAliases,
            ];
            $this->arResult['TABS'] = [
                [
                    'NAME' => 'Доставка',
                    'URL' => sprintf('%s%s', $this->arResult['SEF']['FOLDER'], $this->arResult['SEF']['FOLDER']),
                    'ACTIVE' => $componentPage == 'delivery',
                    'ENABLED' => true,
                ],
                [
                    'NAME' => 'Оплата',
                    'URL' => sprintf('%s%s', $this->arResult['SEF']['FOLDER'], $this->arResult['SEF']['URL_TEMPLATES']['payment']),
                    'ACTIVE' => $componentPage == 'payment',
                    'ENABLED' => !empty($this->arResult['SAVED']['delivery']),
                ],
                [
                    'NAME' => 'Подтверждение',
                    'URL' => sprintf('%s%s', $this->arResult['SEF']['FOLDER'], $this->arResult['SEF']['URL_TEMPLATES']['confirm_order']),
                    'ACTIVE' => $componentPage == 'confirm_order',
                    'ENABLED' => true,
                ]
            ];
            $this->componentPage = $componentPage;
        }

        $this->setOrder();
        $this->getPage();

        $this->getCities();
        $this->includeComponentTemplate($this->componentPage);

    }

    private function setOrder()
    {
        global $USER;
        $result = null;
        Loader::includeModule('catalog');
        Loader::includeModule('sale');
        $basket = Basket::loadItemsForFUser(Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());
        $this->order = Order::create(SITE_ID, $USER->GetId() ?: CSaleUser::GetAnonymousUserID());
        $this->order->setPersonTypeId(static::DEFAULT_PERSON_TYPE);
        $this->order->setBasket($basket);

        if ($this->arResult['SAVED']['delivery']['delivery_id']) {
            $shipmentCollection = $this->order->getShipmentCollection();
            $delivery = \Bitrix\Sale\Delivery\Services\Manager::getObjectById($this->arResult['SAVED']['delivery']['delivery_id']);
            $shipment = $shipmentCollection->createItem($delivery);
            $shipmentItemCollection = $shipment->getShipmentItemCollection();

            foreach ($basket as $basketItem) {
                $item = $shipmentItemCollection->createItem($basketItem);
                $item->setQuantity($basketItem->getQuantity());
            }
        }
        $paymentCollection = $this->order->getPaymentCollection();

        if ($this->componentPage !== 'delivery' && $this->payment) {
            $payment = $paymentCollection->createItem();
            $paySystemService = Manager::getObjectById($this->payment);
            $payment->setFields([
                'PAY_SYSTEM_ID' => $paySystemService->getField("PAY_SYSTEM_ID"),
                'PAY_SYSTEM_NAME' => $paySystemService->getField("NAME"),
                'SUM' => $this->order->getPrice()
            ]);
        } else {
            $payment = $paymentCollection->createItem();
            $payment->setField("SUM", $this->order->getPrice());
        }

        $arPaySystemServiceAll = Manager::getListWithRestrictions($payment);


        foreach ($arPaySystemServiceAll as &$item) {
            if ($item["ACTION_FILE"] == 'inner') {
                continue;
            }
            if ($item['ID'] == $this->payment) {
                $item['CHECKED'] = 'Y';
            }
            $this->arResult['PAYMENT'][$item['ID']] = $item;
        }
        unset($item);

        $this->arResult['INFO_ORDER'] = [
            'BASKET_SUM' => $basket->getPrice(),
            'FORMATED_BASKET_SUM' => CCurrencyLang::CurrencyFormat($basket->getPrice(), $this->order->getCurrency(), true),
            'SUM' => $this->order->getPrice(),
            'FORMATED_SUM' => CCurrencyLang::CurrencyFormat($this->order->getPrice(), $this->order->getCurrency(), true),
            'DISCOUNT_PERCENT' => $basket->getBasePrice() == $this->order->getPrice() ? 0 : ceil(($basket->getBasePrice() - $this->order->getPrice()) / $basket->getBasePrice() * 100),
            'DISCOUNT_PRICE' => $basket->getBasePrice() - $this->order->getPrice(),
            'FORMATED_DISCOUNT_PRICE' => CCurrencyLang::CurrencyFormat($basket->getBasePrice() - $this->order->getPrice(), $this->order->getCurrency(), true),
            'DELIVERY_PRICE' => $this->order->getDeliveryPrice(),
            'FORMATED_DELIVERY_PRICE' => $this->order->getDeliveryPrice() ? CCurrencyLang::CurrencyFormat(floatval($this->order->getDeliveryPrice()), $this->order->getCurrency(), true) : 'Бесплатно',
            'BASE_PRICE' => $basket->getBasePrice(),
            'FORMATED_BASE_PRICE' => CCurrencyLang::CurrencyFormat(floatval($basket->getBasePrice()), $this->order->getCurrency(), true),
            'CURRENCY' => $this->order->getCurrency(),
            'WEIGHT' => $basket->getWeight() / 1000,
        ];

        $propertyCollection = $this->order->getPropertyCollection();
        $arProps = $propertyCollection->getArray();

        foreach ($arProps['properties'] as $arProp) {
            if ($arProp['CODE'] == 'LOCATION') {
                continue;
            }

            $this->arResult['PROPERTIES'][$arProp['PROPS_GROUP_ID']][] = $arProp;
        }


        $this->initUserProfiles($this->order);

        if ($this->userProfile) {
            $profileProperties = Sale\OrderUserProperties::getProfileValues((int)$this->userProfile['ID']);

            foreach ($this->arResult['PROPERTIES'][1] as $prop) {
                if (empty($profileProperties[$prop['ID']])) {
                    continue;
                }

                if (!empty($this->arResult['SAVED']['delivery'][$prop['CODE']])) {
                    continue;
                }

                $this->arResult['SAVED']['delivery'][$prop['CODE']] = $profileProperties[$prop['ID']];
            }
        }
    }

    private function getPage()
    {
        $this->getDeliveries();
        $this->arResult['ITEMS'] = $this->getBasketItems();
        $request = Application::getInstance()->getContext()->getRequest();

        if ($request->get('ORDER_ID') > 0) {
            $this->arResult['ORDER'] = $this->getOrderInfo($request->get('ORDER_ID'));
            $this->componentPage = 'confirm';
        } else {
            if (empty($this->arResult['ITEMS'])) {
                $this->componentPage = 'empty';
                LocalRedirect('/basket/');
            }
        }

        global $USER;
        global $APPLICATION;

        if ($USER->IsAuthorized()) {
            $rsUser = CUser::GetByID($USER->GetID());
            $arUser = $rsUser->Fetch();
            $this->arResult['USER_INFO'] = $arUser;
        }

        $this->arResult['TITLE'] = $APPLICATION->GetTitle();
    }

    private function getDeliveries()
    {
        $shipmentCollection = $this->order->getShipmentCollection();
        $shipment = $shipmentCollection->createItem();
        $shipmentItemCollection = $shipment->getShipmentItemCollection();
        $shipment->setField('CURRENCY', $this->order->getCurrency());

        foreach ($this->order->getBasket() as $item) {
            $shipmentItem = $shipmentItemCollection->createItem($item);
            $shipmentItem->setQuantity($item->getQuantity());
        }

        $arRestricted = Delivery\Services\Manager::getRestrictedObjectsList($shipment);

        $arStores = $this->getStores();

        foreach ($arRestricted as $arItem) {
            $price = $arItem->getConfig()['MAIN']['ITEMS']['PRICE']['VALUE'];

            $this->arResult['DELIVERIES'][$arItem->getId()] = [
                'ID' => $arItem->getId(),
                'NAME' => $arItem->getName(),
                'PRICE' => $price,
                'PRICE_FORMATED' => $price == 0 ? 'Бесплатно' : sprintf('От %s', CCurrencyLang::CurrencyFormat($price, 'KGS', true)),
                'DESCRIPTION' => $arItem->getDescription(),
                'STORES' => $arItem->getId() == 2 ? $arStores : '',
                'CHECKED' => $this->delivery_id == $arItem->getId() ? 'Y' : 'N'
            ];
        }
    }

    protected function getStores(): array
    {
        $res = \CIBlockElement::GetList(['SORT' => 'ASC', 'NAME' => 'DESC'], [
            'ACTIVE' => 'Y',
            'IBLOCK_ID' => \Site\STORE_IBLOCK_ID,
        ], false, false, ['ID', 'IBLOCK_ID', 'NAME', 'DATE_ACTIVE_FROM', 'PREVIEW_TEXT']);

        $arStores = [];

        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $arFields['PROPERTIES'] = $ob->GetProperties();
            $arFields['UNAVAILABLE_PRODUCTS'] = [];
            $arStores[$arFields['ID']] = $arFields;
        }

        $products = [];

        /** @var Sale\BasketItem $basketItem */
        foreach ($this->order->getBasket()->getOrderableItems() as $basketItem) {
            $products[$basketItem->getProductId()] = [
                'ID' => $basketItem->getProductId(),
                'NAME' => $basketItem->getField('NAME'),
                'QUANTITY' => $basketItem->getQuantity(),
                'AVAILABLE_QUANTITY' => [],
            ];
        }
        if (empty($products)) {
            return $arStores;
        }

        $iterator = \CIBlockElement::GetList([], [
            'IBLOCK_ID' => \Site\AMOUNT_IBLOCK_ID,
            '=PROPERTY_PRODUCT_ID' => array_keys($products),
        ], false, false, ['PROPERTY_PRODUCT_ID', 'PROPERTY_STORAGE_ID', 'PROPERTY_QUANTITY']);

        while ($amount = $iterator->Fetch()) {
            $productId = $amount['PROPERTY_PRODUCT_ID_VALUE'];
            $storeId = $amount['PROPERTY_STORAGE_ID_VALUE'];
            $availableQuantity = $amount['PROPERTY_QUANTITY_VALUE'];

            $products[$amount['PROPERTY_PRODUCT_ID_VALUE']]['AVAILABLE_QUANTITY'][$storeId] = $availableQuantity;
        }

        foreach ($arStores as &$arStore) {
            $store1cId = $arStore['PROPERTIES']['STORE_1C']['VALUE'];

            foreach ($products as $product) {
                if ($product['AVAILABLE_QUANTITY'][$store1cId] < $product['QUANTITY']) {
                    $arStore['UNAVAILABLE_PRODUCTS'][$product['ID']] = [
                        'NAME' => $products[$product['ID']]['NAME'],
                        'AVAILABLE' => (float) $product['AVAILABLE_QUANTITY'][$store1cId],
                    ];
                }
            }
        }

        unset($arStore);

        return $arStores;
    }

    private function getBasketItems()
    {
        $result = [];
        $basket = Basket::loadItemsForFUser(Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());
        $context = new Discount\Context\Fuser($basket->getFUserId());
        $discounts = Discount::buildFromBasket($basket, $context);

        if ($discounts) {
            $r = $discounts->calculate();
            $resdisk = $r->getData();

            if (isset($resdisk['BASKET_ITEMS'])) {
                $basket->applyDiscount($resdisk['BASKET_ITEMS']);
            }
        }

        $basketItems = $basket->getBasketItems();

        foreach ($basketItems as $basketItem) {
            $arProducts[] = $basketItem->getProductId();

            $mxResult = CCatalogSku::GetProductInfo(
                $basketItem->getProductId()
            );

            if (is_array($mxResult)) {
                $mainID = $mxResult['ID'];
            } else {
                $mainID = '';
            }

            $result[$basketItem->getProductId()] = [
                'ID' => $basketItem->getId(),
                'PRODUCT_ID' => $basketItem->getProductId(),
                'PRICE' => $basketItem->getPrice(),
                'PRICE_FORMATED' => CCurrencyLang::CurrencyFormat($basketItem->getPrice(), $basketItem->getCurrency(), true),
                'BASE_PRICE' => $basketItem->getBasePrice(),
                'BASE_PRICE_FORMATED' => CCurrencyLang::CurrencyFormat($basketItem->getBasePrice(), $basketItem->getCurrency(), true),
                'DISCOUNT_PRICE' => $basketItem->getDiscountPrice(),
                'DISCOUNT_PRICE_FORMATED' => CCurrencyLang::CurrencyFormat($basketItem->getDiscountPrice(), $basketItem->getCurrency(), true),
                'QUANTITY' => $basketItem->getQuantity(),
                'SUM_WITHOUT_DISCOUNT' => $basketItem->getBasePrice() * $basketItem->getQuantity(),
                'SUM_WITHOUT_DISCOUNT_FORMATED' => CCurrencyLang::CurrencyFormat($basketItem->getBasePrice() * $basketItem->getQuantity(), $basketItem->getCurrency(), true),
                'SUM' => $basketItem->getFinalPrice(),
                'SUM_FORMATED' => CCurrencyLang::CurrencyFormat($basketItem->getFinalPrice(), $basketItem->getCurrency(), true),
                'NAME' => $basketItem->getField('NAME'),
                'CURRENCY' => $basketItem->getField('CURRENCY'),
                'MEASURE_NAME' => $basketItem->getField('MEASURE_NAME'),
                'MAIN_PRODUCT_ID' => $mainID
            ];
        }

        if ($result) {
            $arSelect = [
                "ID",
                "IBLOCK_ID",
                'DETAIL_PAGE_URL',
                "NAME",
                "DATE_ACTIVE_FROM",
                "PROPERTY_SIZE",
                'PROPERTY_ARTICUL'
            ];

            $arFilter = ['=ID' => array_keys($result)];
            $res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);

            while ($el = $res->GetNext()) {
                if ($el['PREVIEW_PICTURE']) {
                    $result[$el['ID']]['PREVIEW_PICTURE'] = CFile::ResizeImageGet($el['PREVIEW_PICTURE'], ["width" => 'auto', "height" => 184], BX_RESIZE_IMAGE_PROPORTIONAL);
                } else {
                    $result[$el['ID']]['PREVIEW_PICTURE']['src'] = sprintf('%s/img/no-image.png', SITE_TEMPLATE_PATH);
                }
                $result[$el['ID']]['DETAIL_PAGE_URL'] = $el['DETAIL_PAGE_URL'];
                $result[$el['ID']]['PROPERTY_ARTICLE_VALUE'] = $el['PROPERTY_ARTICUL_VALUE'];
                $result[$el['ID']]['PROPERTY_SIZE_VALUE'] = $el['PROPERTY_SIZE_VALUE'];
            }

            $filter = ['=ID' => array_keys($result)];

            $obProducts = ElementTable::getList([
                'select' => ['PREVIEW_PICTURE', 'ID'],
                'filter' => $filter,
            ]);

            while ($el = $obProducts->fetch()) {
                if ($el['PREVIEW_PICTURE']) {
                    $result[$el['ID']]['PREVIEW_PICTURE'] = CFile::ResizeImageGet($el['PREVIEW_PICTURE'], ["width" => 'auto', "height" => 184], BX_RESIZE_IMAGE_PROPORTIONAL);
                } else {
                    $result[$el['ID']]['PREVIEW_PICTURE']['src'] = sprintf('%s/img/no-image.png', SITE_TEMPLATE_PATH);
                }
            }
        }

        return $result;
    }

    private function getOrderInfo($orderID)
    {
        global $USER;
        $result = [];

        $order = Order::load($orderID);

        if (!in_array($orderID, $_SESSION['SALE_ORDER_ID']) && $order->getUserId() != $USER->GetID()) {
            return ['STATUS' => 'ERROR', 'MESSAGE' => 'Заказ не пренадлежит пользователю'];
        }

        $result['ORDER_ID'] = $orderID;
        $result['ORDER_SUM'] = $order->getPrice();
        $result['ORDER_DISCOUNT_PRICE'] = $order->getDiscountPrice();
        $result['DELIVERY_PRICE'] = $order->getDeliveryPrice();
        $result['CURRENCY'] = $order->getCurrency();
        $basket = $order->getBasket();
        $result['BASKET_SUM'] = $basket->getPrice();
        $result['BASKET_FULL_PRICE'] = $basket->getBasePrice();
        $basketItems = $basket->getBasketItems();

        foreach ($basketItems as $basketItem) {
            $arProducts[] = $basketItem->getProductId();

            $mxResult = CCatalogSku::GetProductInfo(
                $basketItem->getProductId()
            );

            if (is_array($mxResult)) {
                $mainID = $mxResult['ID'];
                $arProducts[] = $mainID;
            } else {
                $mainID = '';
            }

            $result['ITEMS'][] = [
                'ID' => $basketItem->getId(),
                'PRODUCT_ID' => $basketItem->getProductId(),
                'PRICE' => $basketItem->getPrice(),
                'BASE_PRICE' => $basketItem->getBasePrice(),
                'DISCOUNT_PRICE' => $basketItem->getDiscountPrice(),
                'QUANTITY' => $basketItem->getQuantity(),
                'SUM' => $basketItem->getFinalPrice(),
                'NAME' => $basketItem->getField('NAME'),
                'MAIN_PRODUCT_ID' => $mainID,
            ];

        }

        if (!empty($arProducts)) {
            $select = ['ID', 'IBLOCK_ID', 'NAME', 'PREVIEW_PICTURE', 'PROPERTY_PREVIEW_PICTURE_2X'];
            $filter = ['ID' => $arProducts];
            $res = CIBlockElement::GetList([], $filter, false, false, $select);
            while ($ob = $res->Fetch()) {
                $arProductsInfo[$ob['ID']] = $ob;

            }
        }

        foreach ($result['ITEMS'] as &$arItem) {
            if (!empty($arProductsInfo[$arItem['PRODUCT_ID']])) {
                $arItem['PRODUCT_INFO'] = $arProductsInfo[$arItem['PRODUCT_ID']];
                if (!empty($arItem['MAIN_PRODUCT_ID'])) {
                    $arItem['MAIN_PRODUCT_INFO'] = $arProductsInfo[$arItem['MAIN_PRODUCT_ID']];
                }
            }
        }

        $this->arResult['ITEMS'] = $result['ITEMS'];
        $this->arResult['INFO_ORDER'] = [
            'BASKET_SUM' => $basket->getPrice(),
            'FORMATED_BASKET_SUM' => CCurrencyLang::CurrencyFormat($basket->getPrice(), $order->getCurrency(), true),
            'SUM' => $order->getPrice(),
            'FORMATED_SUM' => CCurrencyLang::CurrencyFormat($order->getPrice(), $order->getCurrency(), true),
            'DISCOUNT_PERCENT' => $basket->getBasePrice() == $order->getPrice() ? 0 : ceil(($basket->getBasePrice() - $order->getPrice()) / $basket->getBasePrice() * 100),
            'DISCOUNT_PRICE' => $basket->getBasePrice() - $order->getPrice(),
            'FORMATED_DISCOUNT_PRICE' => CCurrencyLang::CurrencyFormat($basket->getBasePrice() - $order->getPrice(), $order->getCurrency(), true),
            'DELIVERY_PRICE' => $order->getDeliveryPrice(),
            'FORMATED_DELIVERY_PRICE' => $order->getDeliveryPrice() ? CCurrencyLang::CurrencyFormat(floatval($order->getDeliveryPrice()), $order->getCurrency(), true) : 'Бесплатно',
            'BASE_PRICE' => $basket->getBasePrice(),
            'FORMATED_BASE_PRICE' => CCurrencyLang::CurrencyFormat(floatval($basket->getBasePrice()), $order->getCurrency(), true),
            'CURRENCY' => $order->getCurrency(),
            'WEIGHT' => $basket->getWeight() / 1000,
        ];

        return $result;
    }

    private function getCities()
    {
        $res = LocationTable::getList([
            'filter' => ['=NAME.LANGUAGE_ID' => LANGUAGE_ID, 'TYPE_CODE' => 'CITY'],
            'select' => ['*', 'NAME_RU' => 'NAME.NAME', 'TYPE_CODE' => 'TYPE.CODE']
        ]);

        while ($item = $res->fetch()) {
            $this->arResult['CITIES'][] = $item;
        }
    }

    protected function initUserProfiles(Order $order)
    {
        $dbUserProfiles = CSaleOrderUserProps::GetList(
            ['DATE_UPDATE' => 'DESC'],
            [
                'PERSON_TYPE_ID' => $order->getPersonTypeId(),
                'USER_ID' => $order->getUserId(),
            ]
        );

        $this->userProfile = $dbUserProfiles->GetNext();
    }

    protected function saveProfileData()
    {
        $arResult =& $this->arResult;
        $profileId = $this->userProfile ? $this->userProfile['ID'] : null;
        $profileName = '';
        $properties = [];

        $propertyCollection = $this->order->getPropertyCollection();

        if (!empty($propertyCollection)) {
            if ($profileProp = $propertyCollection->getProfileName()) {
                $profileName = $profileProp->getValue();
            }

            /** @var Sale\PropertyValue $property */
            foreach ($propertyCollection as $property) {
                $properties[$property->getField('ORDER_PROPS_ID')] = $property->getValue();
            }
        }

        $error = null;

        \CSaleOrderUserProps::DoSaveUserProfile(
            $this->order->getUserId(),
            $profileId,
            $profileName,
            $this->order->getPersonTypeId(),
            $properties,
            $error
        );
    }
}
