<?php
/** @noinspection PhpFullyQualifiedNameUsageInspection */

namespace site;

/**
 * Custom Import from 1C
 * Based on spaghetti code version from previous developer
 * and deeply refactored
 */
class Import
{
    protected $ftpServer = \Site\FTP_SERVER;

    protected $ftpLogin = \Site\FTP_LOGIN;

    protected $ftpPassword = \Site\FTP_PASSWORD;

    /**
     * Path to XML file from ftp root
     */
    protected $ftpDir = \Site\FTP_CATALOG_DIR;

    protected $ftpFileNamePrefix = 'Message';

    protected $dstFile = '/upload/new_import.xml';

    /**
     * @var string
     */
    protected $dataMode;

    /**
     * @var string
     */
    protected $srcFilePath;

    /**
     * @var string
     */
    protected $localFilePath;

    protected $iblockID = 1;
    protected $storageIblockID = 21;
    protected $brandIblockID = 23;
    protected $balanceIblockID = 22;

    /**
     * @var array
     */
    protected $availableProps;

    /**
     * @var array
     */
    protected $availableStorageProps;

    /**
     * @var array
     */
    protected $availableBrandsProps;

    /**
     * @var array
     */
    protected $availableSections;
	
	/**
     * @var array
     */
    protected $availableSectionsCode;

    /**
     * @var array
     */
    protected $availableBalance;

    /**
     * @var array
     */
    protected $availableItems;

    /**
     * @var array
     */
    protected $availableStorages;

    /**
     * @var array
     */
    protected $availableBrands;

    /**
     * @var \DOMXPath
     */
    protected $xpath;

    /**
     * @var \DOMNodeList
     */
    protected $xmlItems;

    /**
     * @var array
     */
    protected $updateSections;

    /**
     * @var array
     */
    protected $deleted1cProducts = [];

    public $test = false;

    const DATA_MODE_FULL = 'full';
    const DATA_MODE_PARTIAL = 'partial';

    public function __construct()
    {
        \Bitrix\Main\Loader::includeModule("iblock");
        \Bitrix\Main\Loader::includeModule("catalog");
        \Bitrix\Main\Loader::includeModule("sale");

        $this->compileLocalFilePath();
    }

    protected function compileLocalFilePath(): void
    {
        $this->localFilePath = $_SERVER["DOCUMENT_ROOT"] . $this->dstFile;
    }

    /**
     * @param string $dstFile
     * @param string $mode Data mode
     */
    public function setDstFile(string $dstFile, string $mode): void
    {
        $this->dstFile = $dstFile;
        $this->compileLocalFilePath();
        $this->dataMode = $mode === static::DATA_MODE_PARTIAL ? static::DATA_MODE_PARTIAL : static::DATA_MODE_FULL;
    }

    public function download(): bool
    {
        $conn = $this->createFtpConnection();
        $fileList = ftp_nlist($conn, $this->ftpDir);
        $this->srcFilePath = null;

        foreach ($fileList as $entry) {
            if (strpos($entry, $this->ftpDir . $this->ftpFileNamePrefix) === 0 && substr($entry, -4) === '.xml') {
                $this->srcFilePath = $entry;
                $this->dataMode = strpos(basename($this->srcFilePath), '_UPDATES') !== false ? static::DATA_MODE_PARTIAL : static::DATA_MODE_FULL;
                break;
            }
        }

        if (empty($this->srcFilePath)) {
            print "No file to download\n";
            return false;
        }

        print "Download file\n";

        if (ftp_get($conn, $this->localFilePath, $this->srcFilePath, FTP_BINARY)) {
            print "Done: " . $this->localFilePath . "\n";
        } else {
            throw new \Exception('Couldn\'t download XML file');
        }

        $this->closeFtpConnection($conn);

        return true;
    }

    public function archiveFile()
    {
        $archiveDir = $_SERVER['DOCUMENT_ROOT'] . '/upload/import_archive';
        copy($this->localFilePath, $archiveDir . '/' . strftime('%Y%m%d_%H%M%S') . '_' . $this->dataMode . '.xml');

        foreach (glob($archiveDir . '/*') as $filename) {
            if (filemtime($filename) < time() - 7 * 86400) {
                unlink($filename);
            }
        }
    }

    /**
     * @return false|resource
     * @throws \Exception
     */
    protected function createFtpConnection()
    {
        $conn = ftp_connect($this->ftpServer);
        $result = ftp_login($conn, $this->ftpLogin, $this->ftpPassword);

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

    public function getLocalFilePath(): string
    {
        return $this->localFilePath;
    }

    /**
     * Should be refactored in the future
     */
    public function run(): void
    {
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $dom->load($this->getLocalFilePath());
        $ns_prefix = 'v8msg';
        $ns_uri = 'http://v8.1c.ru/messages';
        $this->xpath = $xpath = new \DOMXPath($dom);
        $reg = $xpath->registerNamespace($ns_prefix, $ns_uri);
        $body = $xpath->query('/v8msg:Message/v8msg:Body')->item(0);
        $this->xmlItems = $items_obj = $this->xpath->query('/v8msg:Message/v8msg:Body/*');

        $this->loadProductProperties();
        $this->loadStorageProps();
        $this->loadBrandProps();
        $this->loadSections();
        $this->loadCurrentStoreAmount();
        $this->loadExistingProducts();
        $this->loadStorages();
        $this->loadBrands();

        if ($this->test === false) {
            $this->importStores();
            $this->importSections();
            $this->importProducts();
            $this->importProductProperties();
            $this->importPhotos();
            $this->importBrands();
            $this->importPrices();
            $this->importManufacturers();
            $this->importNomenclature();
            $this->importStoreAmount();
            $this->recalculateCatalogAvailability();
        } else {
            $this->importProducts();
            $this->recalculateCatalogAvailability();
        }

        echo 'Импорт завершён';
    }

    protected function loadProductProperties()
    {
        $this->availableProps = [];

        //Текущие свойства инфоблока "Каталог" (сейчас "Выгрузка")
        $iterator = \CIBlockProperty::GetList(Array("sort" => "asc", "name" => "asc"), Array("IBLOCK_ID" => $this->iblockID));

        while ($prop_fields = $iterator->GetNext()) {
            $this->availableProps[$prop_fields['CODE']] = $prop_fields['ID'];
        }
    }

    protected function loadStorageProps()
    {
        //Текущие свойства инфоблока "Склады" (сейчас "Выгрузка")
        $iterator = \CIBlockProperty::GetList(Array("sort" => "asc", "name" => "asc"), Array("IBLOCK_ID" => $this->storageIblockID));
        $this->availableStorageProps = [];

        while ($prop_fields = $iterator->GetNext()) {
            $this->availableStorageProps[$prop_fields['CODE']] = $prop_fields['ID'];
        }
    }

    protected function loadBrandProps()
    {
        //Текущие свойства инфоблока "Бренды"
        $properties = \CIBlockProperty::GetList(Array("sort" => "asc", "name" => "asc"), Array("IBLOCK_ID" => $this->brandIblockID));
        $this->availableBrandsProps = [];

        while ($prop_fields = $properties->GetNext()) {
            $this->availableBrandsProps[$prop_fields['CODE']] = $prop_fields['ID'];
        }
    }

    protected function loadSections()
    {
        //Текущие разделы
        $arFilter = Array('IBLOCK_ID' => $this->iblockID);
        $iterator = \CIBlockSection::GetList(Array('sort' => 'name'), $arFilter, false, ['ID', 'CODE', 'UF_EXTERNAL_CODE']);
        $this->availableSections = [];
		$this->availableSectionsCode = [];

        while ($ar_result = $iterator->Fetch()) {
            $this->availableSections[$ar_result['UF_EXTERNAL_CODE']] = $ar_result['ID'];
			$this->availableSectionsCode[$ar_result['UF_EXTERNAL_CODE']] = $ar_result['CODE'];
        }
    }

    protected function loadCurrentStoreAmount()
    {
        //Текущие остатки
        $arFilter = Array('IBLOCK_ID' => $this->balanceIblockID);
        $iterator = \CIBlockElement::GetList(Array('sort' => 'name'), $arFilter, false, false, ['ID', 'PROPERTY_PRODUCT_ID', 'PROPERTY_STORAGE_ID']);
        $this->availableBalance = [];

        while ($ar_result = $iterator->Fetch()) {
            $this->availableBalance[$ar_result['PROPERTY_PRODUCT_ID_VALUE'] . '_' . $ar_result['PROPERTY_STORAGE_ID_VALUE']] = $ar_result['ID'];
        }
    }

    protected function loadExistingProducts()
    {
        //Текущие элементы
        $arFilter = Array('IBLOCK_ID' => $this->iblockID);
        $iterator = \CIBlockElement::GetList(Array('sort' => 'name'), $arFilter, false, false, ['ID', 'PROPERTY_REF']);
        $this->availableItems = [];

        while ($ar_result = $iterator->Fetch()) {
            $this->availableItems[$ar_result['PROPERTY_REF_VALUE']] = $ar_result['ID'];
        }
    }

    protected function loadStorages()
    {
        //Текущие склады
        $arFilter = Array('IBLOCK_ID' => $this->storageIblockID);
        $iterator = \CIBlockElement::GetList(Array('sort' => 'name'), $arFilter, false, false, ['ID', 'PROPERTY_REF']);
        $this->availableStorages = [];

        while ($ar_result = $iterator->Fetch()) {
            $this->availableStorages[$ar_result['PROPERTY_REF_VALUE']] = $ar_result['ID'];
        }
    }

    protected function loadBrands()
    {
        //Текущие бренды
        $arFilter = Array('IBLOCK_ID' => $this->brandIblockID);
        $iterator = \CIBlockElement::GetList(Array('sort' => 'name'), $arFilter, false, false, ['ID', 'PROPERTY_REF']);
        $this->availableBrands = [];

        while ($ar_result = $iterator->Fetch()) {
            $this->availableBrands[$ar_result['PROPERTY_REF_VALUE']] = $ar_result['ID'];
        }
    }

    protected function importStores(): void
    {
        print "Import stores\n";

        //Добавление/обновление складов
        foreach ($this->xmlItems as $key => $item) {
            if ($item->tagName == 'CatalogObject.СкладыКомпании') {
                $arr = (array)simplexml_import_dom($item);
                $storageCode = $arr['Ref'];
                if (!array_key_exists($storageCode, $this->availableStorages)) {
                    $PROP = array();
                    $name = trim($arr['Description']);
                    $arParams = array("replace_space" => "-", "replace_other" => "-");
                    $trans = \Cutil::translit($name, "ru", $arParams);
                    $arLoadProductArray = Array(
                        "IBLOCK_ID" => $this->storageIblockID,
                        "NAME" => $name,
                        "CODE" => $trans,
                        "ACTIVE" => "Y",
                    );

                    $el = new \CIBlockElement;

                    if ($STORAGE_ID = $el->Add($arLoadProductArray)) {
                        $arParams = array("replace_space" => "_", "replace_other" => "_", "change_case" => 'U');
                        foreach ($arr as $propertyName => $propertyValue) {
                            $trans = \Cutil::translit(trim($propertyName), "ru", $arParams);
                            if (!array_key_exists($trans, $this->availableStorageProps)) {
                                $arFields = Array(
                                    "NAME" => $propertyName,
                                    "ACTIVE" => "Y",
                                    "SORT" => "500",
                                    "CODE" => $trans,
                                    "PROPERTY_TYPE" => "S",
                                    "IBLOCK_ID" => $this->storageIblockID,
                                );
                                $obProp = new \CIBlockProperty;
                                $PropertyID = $obProp->Add($arFields);
                                $this->availableStorageProps[$trans] = $PropertyID;
                            }
                            $PROP[$trans] = $propertyValue;
                        }
                        $this->availableStorages[$arr['Ref']] = $STORAGE_ID;
                        \CIBlockElement::SetPropertyValuesEx($STORAGE_ID, $this->storageIblockID, $PROP);
                    }

                } else {
                    $PROP = array();
                    $arParams = array("replace_space" => "_", "replace_other" => "_", "change_case" => 'U');
                    foreach ($arr as $propertyName => $propertyValue) {
                        $trans = \Cutil::translit(trim($propertyName), "ru", $arParams);
                        if (!array_key_exists($trans, $this->availableStorageProps)) {
                            $arFields = Array(
                                "NAME" => $propertyName,
                                "ACTIVE" => "Y",
                                "SORT" => "500",
                                "CODE" => $trans,
                                "PROPERTY_TYPE" => "S",
                                "IBLOCK_ID" => $this->storageIblockID,
                            );
                            $obProp = new \CIBlockProperty;
                            $PropertyID = $obProp->Add($arFields);
                            $this->availableStorageProps[$trans] = $PropertyID;
                        }
                        $PROP[$trans] = $propertyValue;
                    }
                    \CIBlockElement::SetPropertyValuesEx($this->availableStorages[$arr['Ref']], $this->storageIblockID, $PROP);
                }
            }
        }
    }

    protected function importSections(): void
    {
        print "Import sections\n";

        foreach ($this->xmlItems as $key => $item) {
            if ($item->tagName !== 'CatalogObject.КатегорииНоменклатурыСайта') {
                continue;
            }

            $arr = (array) simplexml_import_dom($item);

            $xmlSection = [
                'NAME' => trim($arr['Description']),
                'PARENT_SECTION' => $arr['Parent'],
                'XML_ID' => $arr['Ref'],
                'DELETED' => $arr['DeletionMark'] === 'true',
            ];

            $xmlSection['CODE'] = \Cutil::translit($xmlSection['NAME'], 'ru', ['replace_space' => '-', 'replace_other' => '-']);
			
			if ( in_array($xmlSection['CODE'], $this->availableSectionsCode) ) {
				$randomNumber = rand(1,99);
				$xmlSection['CODE'] = $xmlSection['CODE']."_".$randomNumber;
			}

            if (!array_key_exists($xmlSection['XML_ID'], $this->availableSections)) {
                if ($xmlSection['DELETED'] === true) {
                    // Don't create a section if it has been already deleted in 1C
                    continue;
                }

                $bs = new \CIBlockSection;

                $arFields = [
                    "ACTIVE" => 'Y',
                    "IBLOCK_ID" => $this->iblockID,
                    "NAME" => $xmlSection['NAME'],
                    "SORT" => 500,
                    "CODE" => $xmlSection['CODE'],
                    "UF_EXTERNAL_CODE" => $xmlSection['XML_ID'],
                    "UF_PARENT_CODE" => $xmlSection['PARENT_SECTION'],
                    "XML_ID" => $xmlSection['XML_ID'],
                ];

                $ID = $bs->Add($arFields);

                if (empty($ID)) {
                    print "Ошибка создания раздела\n" . $bs->LAST_ERROR . "\n";
                    var_dump($xmlSection, $arFields);
                    continue;
                }

                $this->availableSections[$xmlSection['XML_ID']] = $ID;
            } else {
                $arFields = [
                    'ACTIVE' => $xmlSection['DELETED'] ? 'N' : 'Y',
                    'NAME' => $xmlSection['NAME'],
                    'UF_PARENT_CODE' => $xmlSection['PARENT_SECTION'],
                    'XML_ID' => $xmlSection['XML_ID'],
                ];

                $bs = new \CIBlockSection;
                $bs->Update($this->availableSections[$xmlSection['XML_ID']], $arFields);
            }
        }

        // Привязка разделов к своим родительским
        $arFilter = ['IBLOCK_ID' => $this->iblockID];
        $db_list = \CIBlockSection::GetList(['sort' => 'name'], $arFilter, false,
            ['ID', 'CODE', 'UF_EXTERNAL_CODE', 'UF_PARENT_CODE']);
        $this->updateSections = [];

        while ($ar_result = $db_list->Fetch()) {
            $this->updateSections[$ar_result['UF_EXTERNAL_CODE']] = $ar_result;
        }

        foreach ($this->updateSections as $section) {
            $bs = new \CIBlockSection;
            $arFields = [
                "IBLOCK_ID" => $this->iblockID,
                "IBLOCK_SECTION_ID" => $this->updateSections[$section['UF_PARENT_CODE']]['ID'],
            ];

            $bs->Update($section['ID'], $arFields);
        }
    }

    protected function importProducts()
    {
        print "Import products\n";

        $this->deleted1cProducts = [];

        $importParams = [
            'Ref' => 'N',
            'Code' => 'N',
            'Description' => 'PREVIEW_TEXT',
            'НаименованиеПолное' => 'NAME',
            'Артикул' => 'PROPERTY_ART_NUMBER',
            'ВидНоменклатуры' => 'N',
            'БазоваяЕдиницаИзмерения' => 'N',
            'ОсновнаяЕдиницаИзмерения' => 'N',
            'СтавкаНДС' => 'N',
            'СтранаПроисхождения' => 'PROPERTY_MANUFACTURER',
            'СрокХраненияТовара' => 'N',
            'Закрыта' => 'N',
            'Менеджер' => 'N',
            'Ширина' => 'N',
            'Высота' => 'N',
            'Глубина' => 'N',
            'КоличествоВВысоту' => 'N',
            'ВешаетсяНаКрючок' => 'N',
            'Производитель' => 'N',
            'Автор' => 'N',
            'Дата' => 'N',
            'ТипНоменклатуры' => 'N',
            'Отдел' => 'N',
            'КатегорияНоменклатурыСайта' => 'N',
            'Бренд' => 'PROPERTY_BRAND',
        ];

        //Добавление/обновление элементов
        foreach ($this->xmlItems as $key => $item) {
            if ($item->tagName !== 'CatalogObject.Номенклатура') {
                continue;
            }

            $arr = (array) simplexml_import_dom($item);
            $itemCode = $arr['Ref'];

			/*if( $itemCode == "7d58874b-90ae-11e9-80da-000c291f9830" ){
				$f = fopen ($_SERVER['DOCUMENT_ROOT']."/about/arres4.php", "a+");
				fwrite ($f, mydump($arr));
				fwrite ($f, mydump($this->availableSections));
				fwrite ($f, mydump($this->availableSectionsCode));
				fwrite ($f, "------------------------");
				fwrite ($f, "------------------------");
				fwrite ($f, "------------------------");
				fclose($f);
			}*/
			/*
			if( $itemCode == "f72f4e00-baec-11eb-80ec-00505687f371" ){
				$f = fopen ($_SERVER['DOCUMENT_ROOT']."/about/arres2.php", "a+");
				fwrite ($f, mydump($arr));
				fwrite ($f, mydump($this->availableSections));
				fwrite ($f, "------------------------");
				fwrite ($f, "------------------------");
				fwrite ($f, "------------------------");
				fclose($f);
			}*/
			
            if ($this->test) {
                /*if ($itemCode !== '09005d10-e1a6-11e9-80e2-000c291f9830') {
                    continue;
                } else {
                    var_dump($arr);
                }*/
            }

            if (!empty($arr['НаименованиеДляСайта'])) {
                $name = trim($arr['НаименованиеДляСайта']);
            } else {
                $name = trim($arr['НаименованиеПолное']);
            }

            $xmlProduct = [
                'NAME' => $name,
                'CODE' => \Cutil::translit($name, "ru", array("replace_space" => "-", "replace_other" => "-")),
                'DELETED' => $arr['DeletionMark'] === 'true',
                'XML_ID' => $itemCode,
            ];

            $parentSection = $arr['КатегорияНоменклатурыСайта'];

            $arLoadProductArray = array(
                'IBLOCK_ID' => $this->iblockID,
                'NAME' => $name,
                //'ACTIVE' => 'Y',
                'PREVIEW_TEXT' => $arr['Description'],
                'DETAIL_TEXT' => trim($arr['ОписаниеДляСайта']),
                'DETAIL_TEXT_TYPE' => 'text',
                'IBLOCK_SECTION_ID' => $this->availableSections[$parentSection],
                'XML_ID' => $itemCode,
            );

            if (!array_key_exists($itemCode, $this->availableItems)) {
                // Don't create new product if it should be hidden
                if ($arr['СкрытьНаСайте'] === 'true') {
                    continue;
                }

                // Don't created a product if it has been already deleted
                if ($xmlProduct['DELETED']) {
                    continue;
                }

                $PROP = array();

                $picture = \CFile::MakeFileArray($arr['IMG_URL']);
                $isPic = \CFile::CheckImageFile($picture);

                $arLoadProductArray['CODE'] = $xmlProduct['CODE'];

                if (strlen($isPic) == 0) {
                    $arLoadProductArray['PREVIEW_PICTURE'] = $picture;
                }

                $el = new \CIBlockElement;

                if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
                    $arFields = array(
                        "ID" => $PRODUCT_ID,
                    );

                    \CCatalogProduct::Add($arFields);

                    foreach ($importParams as $xmlPropertyName => $type) {
                        $value = $arr[$xmlPropertyName];

                        if ($type == 'N') {
                            $arParams = array("replace_space" => "_", "replace_other" => "_", "change_case" => 'U');
                            $pr_trans = \Cutil::translit(trim($xmlPropertyName), "ru", $arParams);

                            if (!array_key_exists($pr_trans, $this->availableProps)) {
                                $arFields = Array(
                                    "NAME" => $xmlPropertyName,
                                    "ACTIVE" => "Y",
                                    "SORT" => "500",
                                    "CODE" => $pr_trans,
                                    "PROPERTY_TYPE" => "S",
                                    "IBLOCK_ID" => $this->iblockID,
                                );
                                $iblockProperty = new \CIBlockProperty;
                                $PropertyID = $iblockProperty->Add($arFields);
                                $this->availableProps[$pr_trans] = $PropertyID;
                            }
                            $PROP[$pr_trans] = $value;
                        } elseif (preg_match('~PROPERTY_(.+)~', $type, $matches)) {
                            $PROP[$matches[1]] = $value;
                        } elseif (preg_match('~CATALOG_(.+)~', $type, $matches)) {
                            if ($matches[1] == 'PRICE') {
                                \CPrice::SetBasePrice($PRODUCT_ID, (float)$value, 'KGS');
                            } else {
                                $arFields = array(
                                    "ID" => $PRODUCT_ID,
                                    $matches[1] => $value,
                                );

                                \CCatalogProduct::Add($arFields);
                            }
                        }
                    }

                    // The property is processed in separate method
                    /* @see static::importManufacturers() */
                    unset($PROP['MANUFACTURER']);
                    unset($PROP['BRAND']);
                    $PROP['HIDDEN_1C'] = $arr['СкрытьНаСайте'] === 'true' ? 'Y' : 'N';

                    \CIBlockElement::SetPropertyValuesEx($PRODUCT_ID, $this->iblockID, $PROP);
                    $this->availableItems[$arr['Ref']] = $PRODUCT_ID;
                } else {
                    print "Error: " . $el->LAST_ERROR . "\n";
                    print  'Ref: ' . $itemCode . "\n";
                    var_dump($arLoadProductArray);
                    print "\n";
                    continue;
                }
            } else {
                // Update existing
                $existingProductId = (int) $this->availableItems[$itemCode];
                $PROP = [];

                foreach ($importParams as $xmlPropertyName => $type) {
                    $value = $arr[$xmlPropertyName];

                    if ($type == 'N') {
                        $arParams = array("replace_space" => "_", "replace_other" => "_", "change_case" => 'U');
                        $pr_trans = \Cutil::translit($xmlPropertyName, "ru", $arParams);

                        // Create new property
                        if (!array_key_exists($pr_trans, $this->availableProps)) {
                            $arFields = Array(
                                "NAME" => $xmlPropertyName,
                                "ACTIVE" => "Y",
                                "SORT" => "500",
                                "CODE" => $pr_trans,
                                "PROPERTY_TYPE" => "S",
                                "IBLOCK_ID" => $this->iblockID,
                            );
                            $iblockProperty = new \CIBlockProperty;
                            $PropertyID = $iblockProperty->Add($arFields);
                            $this->availableProps[$pr_trans] = $PropertyID;
                        }
                        $PROP[$pr_trans] = $value;
                    } elseif (preg_match('~PROPERTY_(.+)~', $type, $matches)) {
                        $PROP[$matches[1]] = $value;
                    } elseif (preg_match('~CATALOG_(.+)~', $type, $matches)) {
                        if ($matches[1] == 'PRICE') {
                            \CPrice::SetBasePrice($existingProductId, (float) $value, 'KGS');
                        } else {
                            $arFields = array(
                                "ID" => $existingProductId,
                                $matches[1] => $value,
                            );
                            \CCatalogProduct::Add($arFields);
                        }
                    }
                }

                // The property is processed in separate method
                /* @see static::importManufacturers() */
                unset($PROP['MANUFACTURER']);
                unset($PROP['BRAND']);

                $updateFields = $arLoadProductArray;
                $updateFields['ACTIVE'] = $arr['СкрытьНаСайте'] === 'true' || $xmlProduct['DELETED'] ? 'N' : 'Y';

                $picture = \CFile::MakeFileArray($arr['IMG_URL']);
                $isPic = \CFile::CheckImageFile($picture);

                if (strlen($isPic) == 0) {
                    $updateFields['PREVIEW_PICTURE'] = $picture;
                }

                $el = new \CIBlockElement;
                $el->Update($existingProductId, $updateFields);

                $PROP['MARK'] = '';
                $PROP['OLD_PRICE'] = '';
                $PROP['HIDDEN_1C'] = $arr['СкрытьНаСайте'] === 'true' ? 'Y' : 'N';

                if (count($PROP) > 0) {
                    \CIBlockElement::SetPropertyValuesEx($existingProductId, $this->iblockID, $PROP);
                }

                if ($xmlProduct['DELETED']) {
                    $this->deleted1cProducts[$existingProductId] = true;
                }
            }
        }
    }

    protected function importProductProperties(): void
    {
        print "Import product properties\n";

        // Обновление свойств элементов
        $itemProperties = [];

        foreach ($this->xmlItems as $key => $item) {
            if ($item->tagName !== 'InformationRegisterRecordSet.ЗначенияСвойствНоменклатурыСайта') {
                continue;
            }

            $arr = (array)simplexml_import_dom($item)->Records->Record;
            $productRef = $arr['Номенклатура'];
            $propertyRef = $arr['СправочноеЗначение'];
            $propertyValue = $arr['ЧисловоеЗначение'];

            $itemProperties[$arr['Номенклатура']][] = [
                'PRODUCT_REF' => $arr['Номенклатура'],
                'PROPERTY_REF' => $arr['СправочноеЗначение'],
                'PROPERTY_VALUE' => $arr['ЧисловоеЗначение'],
                'PROPERTY_NAME_REF' => $arr['СвойствоНоменклатурыСайта'],
            ];
        }

        foreach ($this->xmlItems as $key => $item) {
            if ($item->tagName == 'CatalogObject.СправочныеЗначенияСвойств') {
                $arr = (array) simplexml_import_dom($item);
                $referenceValues[$arr['Ref']] = $arr['Description'];
            }
        }

        $referenceNames = [];

        foreach ($this->xmlItems as $key => $item) {
            if ($item->tagName !== 'CatalogObject.СвойстваНоменклатурыСайта') {
                continue;
            }

            $arr = (array) simplexml_import_dom($item);
            $referenceNames[$arr['Ref']] = $arr['Description'];
            $arParams = array("replace_space" => "_", "replace_other" => "_", "change_case" => 'U');
            $trans = \Cutil::translit(trim($arr['Description']), "ru", $arParams);

            if (!array_key_exists($trans, $this->availableProps)) {
                $arFields = array(
                    "NAME" => $arr['Description'],
                    "ACTIVE" => "Y",
                    "SORT" => "500",
                    "CODE" => $trans,
                    "PROPERTY_TYPE" => "S",
                    "IBLOCK_ID" => $this->iblockID,
                );
                $iblockproperty = new \CIBlockProperty;
                $PropertyID = $iblockproperty->Add($arFields);
                $this->availableProps[$trans] = $PropertyID;
            }
        }

        foreach ($itemProperties as $itemProps) {
            $PROP = [];

            foreach ($itemProps as $property) {
                if ($this->availableItems[$property['PRODUCT_REF']]) {
                    $propName = $referenceNames[$property['PROPERTY_NAME_REF']];

                    $arParams = array("replace_space" => "_", "replace_other" => "_", "change_case" => 'U');
                    $trans = \Cutil::translit(trim($propName), "ru", $arParams);
                    $PROP[$trans] = $property['PROPERTY_REF'] == '00000000-0000-0000-0000-000000000000' ? $property['PROPERTY_VALUE'] : $referenceValues[$property['PROPERTY_REF']];
                }
            }

            \CIBlockElement::SetPropertyValuesEx($this->availableItems[$property['PRODUCT_REF']], $this->iblockID, $PROP);

        }
    }

    protected function importPhotos()
    {
        //Загрузка/обновление картинок
        print "Import photos\n";

        $picturesToAdd = [];

        foreach ($this->xmlItems as $key => $item) {
            if ($item->tagName !== 'InformationRegisterRecordSet.ФотографииДляСайта') {
                continue;
            }

            $arr = (array) simplexml_import_dom($item)->Records;

            foreach ($arr as $ar) {
                $data = (array) $ar;
                $picture = \CFile::MakeFileArray($data['IMG_URL']);
                $isPic = \CFile::CheckImageFile($picture);

                if (strlen($isPic) == 0) {
                    $picturesToAdd[$data['Номенклатура']][] = [
                        'VALUE' => $picture,
                        'DESCRIPTION' => $picture['name'],
                    ];
                }
            }
        }

        foreach ($picturesToAdd as $itemCode => $group) {
            \CIBlockElement::SetPropertyValuesEx($this->availableItems[$itemCode], $this->iblockID, ['GALLERY' => $group]);
        }
    }

    protected function importBrands(): void
    {
        // Добавление/обновление брендов
        print "Import brands\n";

        foreach ($this->xmlItems as $key => $item) {
            if ($item->tagName !== 'CatalogObject.Бренды') {
                continue;
            }

            $arr = (array) simplexml_import_dom($item);

            if (!array_key_exists($arr['Ref'], $this->availableBrands)) {
                $PROP = [];
                $PROP['REF'] = $arr['Ref'];
                $arParams = ["replace_space" => "-", "replace_other" => "-"];
                $trans = \Cutil::translit(trim($arr['Description']), "ru", $arParams);

                $arLoadProductArray = [
                    "IBLOCK_ID" => $this->brandIblockID,
                    "NAME" => $arr['Description'],
                    "CODE" => $trans,
                    "ACTIVE" => "Y",
                    'PROPERTY_VALUES' => $PROP
                ];

                $el = new \CIBlockElement;
                $brandID = $el->Add($arLoadProductArray);
                $this->availableBrands[$arr['Ref']] = $brandID;
            } else {
                $PROP = array();
                $PROP['REF'] = $arr['Ref'];
                \CIBlockElement::SetPropertyValuesEx($this->availableBrands[$arr['Ref']], $this->brandIblockID, $PROP);
            }
        }
    }

    protected function importPrices(): void
    {
        // Обновление цен в каталоге
        print "Import prices\n";
		

        foreach ($this->xmlItems as $key => $item) {
            if ($item->tagName !== 'InformationRegisterRecordSet.Цены') {
                continue;
            }

            $arr = (array) simplexml_import_dom($item)->Records;

            foreach ($arr['Record'] as $itemPrice) {
                $priceInfo = (array) $itemPrice;
                \CPrice::SetBasePrice($this->availableItems[$priceInfo['Номенклатура']], (float)$priceInfo['Цена'], 'KGS');
            }
        }
		
		
		$product_price_period = [];
		$product_price_tmp = [];
		
		$f1 = fopen ($_SERVER['DOCUMENT_ROOT']."/about/arr1.php", "w+");
		fwrite ($f1, "qwe1");
		fclose($f1);

        //Обновление цен
        foreach ($this->xmlItems as $key => $item) {
            if ($item->tagName !== 'InformationRegisterRecordSet.ЦеныДляСайта') {
                continue;
            }

            $arr = (array) simplexml_import_dom($item)->Records;

            foreach ($arr['Record'] as $data) {
                $data = (array)$data;
                if ($this->availableItems[$data['Номенклатура']]) {
					
					
					
					
					$period1 = str_replace("T", " ", $data['Period']);
					
					if( isset($product_price_period[$data['Номенклатура']]) && strlen($product_price_period[$data['Номенклатура']])>0 ){
						$period2 = $product_price_period[$data['Номенклатура']];
						
						$element_date1 = strtotime($period1);
						$element_date2 = strtotime($period2);
						
						if( $element_date1 > $element_date2 ){							
							\CPrice::SetBasePrice($this->availableItems[$data['Номенклатура']], (float)$data['Цена'], 'KGS');
							
							$product_price_period[$data['Номенклатура']] = $period1;
							
							$product_price_tmp[$data['Номенклатура']] = $period1;
						}
					}else{
						\CPrice::SetBasePrice($this->availableItems[$data['Номенклатура']], (float)$data['Цена'], 'KGS');
						
						$product_price_period[$data['Номенклатура']] = $period1;
					}
					
					
					
					
                }else{
					
					$second_nomenklature = trim($arr['Record']->Номенклатура);
					$second_nomenklature_price = (float) $arr['Record']->Цена;
					$second_nomenklature_period = $arr['Record']->Period;
					if( strlen($second_nomenklature)>0 && $this->availableItems[$second_nomenklature] && $second_nomenklature_price > 1 ){
						
						$period1 = str_replace("T", " ", $second_nomenklature_period);
						
						if( isset($product_price_period[$second_nomenklature]) && strlen($product_price_period[$second_nomenklature])>0 ){
							$period2 = $product_price_period[$second_nomenklature];
							
							$element_date1 = strtotime($period1);
							$element_date2 = strtotime($period2);
							
							if( $element_date1 > $element_date2 ){
								\CPrice::SetBasePrice($this->availableItems[$second_nomenklature], $second_nomenklature_price, 'KGS');
								
								$product_price_period[$second_nomenklature] = $period1;
								
								$product_price_tmp[$second_nomenklature] = $period1;
							}
						}else{
							\CPrice::SetBasePrice($this->availableItems[$second_nomenklature], $second_nomenklature_price, 'KGS');
							
							$product_price_period[$second_nomenklature] = $period1;
						}
						
					}
					
				}
            }
        }
		
		
		$f3 = fopen ($_SERVER['DOCUMENT_ROOT']."/about/arr3.php", "w+");
		fwrite ($f3, "qwe3");
		fclose($f3);
		
		

        //Обновление акционных цен
        foreach ($this->xmlItems as $key => $item) {
            if ($item->tagName !== 'InformationRegisterRecordSet.СкидкиДляСайта') {
                continue;
            }

            $arr = (array) simplexml_import_dom($item)->Records;

            foreach ($arr['Record'] as $data) {
                $data = (array) $data;

                $date = new \DateTime($data['КонецДействия']);
                $cur_date = date('Y-m-d');
                $end_date = date_format($date, 'Y-m-d');

                if ($end_date > $cur_date) {
                    \CPrice::SetBasePrice($this->availableItems[$data['Номенклатура']], (float)$data['АкционнаяЦена'], 'KGS');

                    \CIBlockElement::SetPropertyValuesEx($this->availableItems[$data['Номенклатура']], $this->iblockID, [
                        'OLD_PRICE' => $data['ОбычнаяЦена'],
                        'MARK' => 'promo',
                    ]);
                } else {
                    \CPrice::SetBasePrice($this->availableItems[$data['Номенклатура']], (float)$data['ОбычнаяЦена'], 'KGS');
                }
            }
        }
    }

    protected function importManufacturers()
    {
        //Страна производитель
        print "Import manufacturers\n";

        $countries = [];

        foreach ($this->xmlItems as $key => $item) {
            if ($item->tagName !== 'CatalogObject.КлассификаторСтранМира') {
                continue;
            }

            $arr = (array) simplexml_import_dom($item);
            $countries[$arr['Ref']] = $arr['НаименованиеПолное'];
        }

        foreach ($this->xmlItems as $key => $item) {
            if ($item->tagName !== 'CatalogObject.Номенклатура') {
                continue;
            }

            $arr = (array) simplexml_import_dom($item);

            $PROPS = [];

            if ($countries[$arr['СтранаПроисхождения']]) {
                $PROPS['MANUFACTURER'] = $countries[$arr['СтранаПроисхождения']];
            }

            if ($this->availableBrands[$arr['Бренд']]) {
                $PROPS['BRAND'] = $this->availableBrands[$arr['Бренд']];
            }


            if (!empty($PROPS)) {
                \CIBlockElement::SetPropertyValuesEx($this->availableItems[$arr['Ref']], $this->iblockID, $PROPS);
            }
        }
    }

    protected function importNomenclature(): void
    {
        //Запись типа номенклатуры и установка единиц измерения
        print "Import nomenclature\n";

        $measures = [
            '2ac9a296-ca9f-11e7-80bf-000c291f9830' => 6,
            '97eaf00b-d5a8-11e7-80c1-000c291f9830' => 7,
            '7acb4966-dd7c-11e7-80c2-000c291f9830' => 8,
            '4a669dbc-e3dc-11e7-80c4-000c291f9830' => 9,
            '17915ff9-476e-11e8-80c7-000c291f9830' => 10,
            '82621cd5-51b5-11e8-80c8-000c291f9830' => 11,
            'f942abac-156c-11e9-80cf-000c291f9830' => 12,
            '05d94e57-6e38-11e9-80d1-000c291f9830' => 13,
            '5df60f65-7683-11e7-9df0-000c29020da5' => 5,
            '5df60f66-7683-11e7-9df0-000c29020da5' => 4,
            '5df60f67-7683-11e7-9df0-000c29020da5' => 1,
        ];

        $nomenclature = [];

        foreach ($this->xmlItems as $key => $item) {
            if ($item->tagName !== 'CatalogObject.ТипыНоменклатуры') {
                continue;
            }

            $arr = (array) simplexml_import_dom($item);
            $nomenclature[$arr['Ref']] = $arr['Весовой'];
        }

        foreach ($this->xmlItems as $key => $item) {
            if ($item->tagName !== 'CatalogObject.Номенклатура') {
                continue;
            }

            $arr = (array) simplexml_import_dom($item);
            $PROPS = [];

            if ($nomenclature[$arr['ТипНоменклатуры']] == 'true') {
                $this->measureUpdate($this->availableItems[$arr['Ref']], 0.1);
                $PROPS['FRACTIONAL_PRODUCT'] = 18;
            } else {
                $PROPS['FRACTIONAL_PRODUCT'] = false;
                $this->measureUpdate($this->availableItems[$arr['Ref']], 1);
            }

            \CIBlockElement::SetPropertyValuesEx($this->availableItems[$arr['Ref']], $this->iblockID, $PROPS);
            \CCatalogProduct::Update($this->availableItems[$arr['Ref']], ['MEASURE' => $measures[$arr['БазоваяЕдиницаИзмерения']]]);
        }
    }

    protected function measureUpdate($productID, $rate): void
    {
        $res = \Bitrix\Catalog\MeasureRatioTable::getlist([
            'filter' => ['PRODUCT_ID' => $productID]
        ])->fetch();

        if (!empty($res)) {
            \Bitrix\Catalog\MeasureRatioTable::update($res['ID'], [
                'RATIO' => $rate,
                'IS_DEFAULT' => 'Y'
            ]);
        } else {
            \Bitrix\Catalog\MeasureRatioTable::add([
                'RATIO' => $rate,
                'IS_DEFAULT' => 'Y',
                'PRODUCT_ID' => $productID
            ]);
        }
    }

    protected function importStoreAmount(): void
    {
        // Добавление/обновление остатков в отдельный инфоблок
        print "Import store amount\n";

        foreach ($this->xmlItems as $key => $item) {
            if ($item->tagName == 'InformationRegisterRecordSet.ОстаткиДляСайта') {
                $arr = (array) simplexml_import_dom($item)->Records->Record;

                if (isset($arr['Количество']) && $this->availableItems[$arr['Номенклатура']] && $this->availableStorages[$arr['Склад']]) {
                    $productID = $this->availableItems[$arr['Номенклатура']];
                    $storageID = $this->availableStorages[$arr['Склад']];

                    $PROP = array();
                    $PROP['PRODUCT_ID'] = $productID;
                    $PROP['STORAGE_ID'] = $storageID;
                    $PROP['QUANTITY'] = $arr['Количество'];

                    if ($this->availableBalance[$productID . '_' . $storageID]) {
                        \CIBlockElement::SetPropertyValuesEx($this->availableBalance[$productID . '_' . $storageID], false, $PROP);
                    } else {
                        $name = 'Количество товара с ID = ' . $productID . ' на складе с ID = ' . $storageID;
                        $arLoadProductArray = Array(
                            "IBLOCK_ID" => $this->balanceIblockID,
                            "NAME" => $name,
                            "ACTIVE" => "Y",
                            "PROPERTY_VALUES" => $PROP
                        );
                        $el = new \CIBlockElement;
                        $id = $el->Add($arLoadProductArray);
                        $this->availableBalance[$productID . '_' . $storageID] = $id;
                    }
                }
            }
        }
    }

    protected function recalculateCatalogAvailability(): void
    {
        $iterator = \CIBlockElement::GetList(['ID' => 'ASC'], [
            'IBLOCK_ID' => \Site\CATALOG_IBLOCK_ID
        ], false, false, ['ID', 'ACTIVE', 'PROPERTY_HIDDEN_1C', 'CATALOG_GROUP_' . \Site\PRICE_TYPE_ID]);

        while ($arItem = $iterator->Fetch()) {
            $basePrice = (float) $arItem['CATALOG_PRICE_' . \Site\PRICE_TYPE_ID];
            $totalQuantity = 0;

            // Could be a problem in the future, if there would be unused stores in the iblock
            $amountIterator = \CIBlockElement::GetList([], [
                'IBLOCK_ID' => \Site\AMOUNT_IBLOCK_ID,
                '=PROPERTY_PRODUCT_ID' => $arItem['ID'],
            ], false, false, ['PROPERTY_QUANTITY']);

            while ($entry = $amountIterator->Fetch()) {
                $totalQuantity += (int) $entry['PROPERTY_QUANTITY_VALUE'];
            }

            \Bitrix\Catalog\Model\Product::update($arItem['ID'], ['QUANTITY' => $totalQuantity]);
            $newActiveValue = null;

            if (isset($this->deleted1cProducts[(int) $arItem['ID']])) {
                // If the product was marked as deleted in 1c, deactivate it
                $newActiveValue = 'N';
            } else {
                if ($arItem['PROPERTY_HIDDEN_1C_VALUE'] === 'Y') {
                    $newActiveValue = 'N';
                } else {
                    $isValid = $totalQuantity > 0 && $basePrice > 0.01;
                    $newActiveValue = $isValid ? 'Y' : 'N';
                }
            }

            if ($newActiveValue !== $arItem['ACTIVE']) {
                $el = new \CIblockElement;
                $el->Update($arItem['ID'], ['ACTIVE' => $newActiveValue]);
            }
        }
    }

    public function deleteRemoteFile(): void
    {
        print "Delete remote file\n";
        $conn = $this->createFtpConnection();
        ftp_delete($conn, $this->srcFilePath);
        $this->closeFtpConnection($conn);
    }
}