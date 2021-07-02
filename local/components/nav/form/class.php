<?php
namespace nav\Component;
use \Bitrix\Main;

\CBitrixComponent::includeComponentClass("nav:component");

class Form extends \nav\Component\Component implements \Bitrix\Main\Engine\Contract\Controllerable
{
    /** @var string $storage */
    protected $storage;
    
    /** @var array $postData */
    protected $postData;
    
    /** @var array $params */
    protected $params;
    
    /** @var string $entityClass */
    protected $entityClass;

    /** @var array $element */
    protected $element;

    protected $errors = [];

    public function configureActions()
    {
        return [
            'submit' => [
                'prefilters' => [
                    //new Main\Engine\ActionFilter\Authentication(),
                    new Main\Engine\ActionFilter\HttpMethod([Main\Engine\ActionFilter\HttpMethod::METHOD_POST]),
                    new Main\Engine\ActionFilter\Csrf(),
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function onPrepareComponentParams($params): array
    {
        $this->params = $params['PARAMS'];
        $this->prepareStorage();

        return $params;
    }

    public function prepareStorage(): void
    {
        if (isset($this->params['iblockId'])) {
            $this->storage = 'iblock';
        } elseif (isset($this->params['hlblockId'])) {
            $this->storage = 'hlblock';
        } elseif (isset($this->params['entityClass'])) {
            $this->storage = 'orm';
            $this->entityClass = $this->params['entityClass'];
        } else {
            $this->storage = null;
        }
    }

    /**
     * Checks required modules
     */
    protected function checkModules(): bool
    {
        switch ($this->storage) {
            case 'iblock':
                \Bitrix\Main\Loader::includeModule('iblock');
                break;
            
            case 'hlblock':
                \Bitrix\Main\Loader::includeModule('highloadblock');
                break;
        }

        return true;
    }

    /**
     * @return bool
     */
    protected function isFormIdValid(): bool
    {
        $context = Main\Context::getCurrent();
        $result = false;

        if (empty($this->params['formId'])) {
            return false;
        }

        if ($context->getRequest()->getQuery('ajax') == 'Y' && $context->getRequest()->getQuery('formId') === $this->params['formId']) {
            $result = true;
        } elseif ($context->getRequest()->getPost('ajax') == 'Y' && $context->getRequest()->getPost('formId') === $this->params['formId']) {
            $result = true;
        }

        return !empty($result);
    }

    /**
     * @return bool
     */
    protected function isAjaxRequest(): bool
    {
        $context = Main\Context::getCurrent();
        $result = false;

        if ($context->getRequest()->getQuery('ajax') == 'Y') {
            $result = true;
        } elseif ($context->getRequest()->getPost('ajax') == 'Y') {
            $result = true;
        }

        return !empty($result);
    }

    /**
     * Processes incoming request.
     * @return void
     * @throws Exception
     * @throws FormException
     * @throws \Exception
     */
    protected function processRequest(): void
    {
        $this->postData = \Bitrix\Main\Context::getCurrent()->getRequest()->getPostList()->toArray();

        if (!$this->isFormIdValid()) {
            return;
        }

        $this->checkSession();

        if ($this->processSubmittedForm() !== true) {
            $this->sendJsonError(implode("\n", $this->errors));
        }

        $this->sendJson();
    }

    public function submitAction()
    {
        $this->postData = $this->request->getPostList()->toArray();
        $formId = preg_replace('#[^a-z0-9_]*#smiu', '', $this->postData['formId']);

        if ($this->loadConfig($formId) === false) {
            return [
                'status' => 'error',
                'error' => 'Неизвестный код формы',
            ];
        }

        $result = null;

        try {
            $result = $this->processSubmittedForm();
        } catch (FormException $e) {
            $this->errors[] = $e->getMessage();
        }

        if ($result !== true) {
            return [
                'status' => 'error',
                'error' => implode("\n", $this->errors),
            ];
        }

        return [
            'status' => 'ok',
        ];
    }

    protected function processSubmittedForm(): bool
    {
        $this->errors = [];

        $this->checkSpam();

        switch ($this->storage) {
            case 'iblock':
                $arNewFields = array(
                    'IBLOCK_ID' => $this->params['iblockId'],
                    'PROPERTY_VALUES' => array(),
                );
                break;

            default:
                $arNewFields = array();
                break;
        }

        $arNewFields = array_merge($arNewFields, $this->params['defaults']);
        $errors = array();

        foreach ($this->params['fields'] as $formFieldCode => $fieldParams) {
            if (is_string($fieldParams)) {
                $fieldParams = array(
                    'field' => $fieldParams,
                );
            }

            $value = $this->postData[$formFieldCode];

            if ($fieldParams['required'] && empty($value)) {
                $errors[] = array(
                    'field' => $formFieldCode,
                    'text' => 'Поле «' . $fieldParams['caption'] . '» обязательно для заполнения',
                );

                continue;
            }

            if (isset($fieldParams['prepare']) && is_callable($fieldParams['prepare'])) {
                $value = call_user_func_array($fieldParams['prepare'], array($value, $fieldParams));
            }

            if ($this->storage === 'iblock' && strpos($fieldParams['field'], 'PROPERTY_') === 0) {
                $propertyCode = substr($fieldParams['field'], 9);
                $arNewFields['PROPERTY_VALUES'][$propertyCode] = $value;
            } else {
                $arNewFields[$fieldParams['field']] = $value;
            }
        }

        if (count($errors) > 0) {
            $this->errors = array_map(function ($item) { return $item['text']; }, $errors);
            return false;
            //$this->sendJsonError(implode("\n", array_map(function ($item) { return $item['text']; }, $errors)));
        }

        $elementId = $this->save($arNewFields);
        $this->obtainNewElement($elementId);
        $this->notify();

        if (is_callable($this->params['onSuccess'])) {
            call_user_func_array($this->params['onSuccess'], $this->element);
        }

        return true;
    }

    /**
     * @return bool
     * @throws FormException
     */
    protected function checkSpam()
    {
        if ($this->postData['_protect'] !== $this->params['protectString']) {
            throw new FormException('Сообщение похоже на спам. Попробуйте обновить страницу и повторить отправку');
        }

        return true;
    }

    /**
     * @param $arFields
     * @return int
     * @throws FormException
     * @throws \Exception
     */
    protected function save($arFields)
    {
        switch ($this->storage) {
            case 'iblock':
                return $this->saveIblockElement($arFields);
                break;
            
            case 'hlblock':
                return $this->saveHighloadBlockElement($arFields);
                break;
            
            case 'orm':
                return $this->saveOrmElement($arFields);
                break;
            
            default:
                throw new FormException('Unknown storage');
                break;
        }
    }

    /**
     * @param array $arFields
     * @return int
     * @throws FormException
     */
    protected function saveIblockElement($arFields)
    {
        $el = new \CIBlockElement;
        $newElementId = $el->Add($arFields);

        if ($newElementId == false) {
            throw new FormException('Произошла ошибка при сохранении: ' . $el->LAST_ERROR);
        }
        
        return $newElementId;
    }

    /**
     * @param array $arFields
     * @return int
     * @throws FormException
     * @throws Main\SystemException
     * @throws \Exception
     */
    protected function saveHighloadBlockElement($arFields)
    {
        $this->prepareHLEntityClass();
        return $this->saveOrmElement($arFields);
    }

    /**
     * Compiles highloadblock class
     * 
     * @throws Main\SystemException
     */
    protected function prepareHLEntityClass()
    {
        $hlBlock = \Bitrix\Highloadblock\HighloadBlockTable::getById($this->params['hlblockId'])->fetch();

        if (empty($hlBlock)) {
            $this->sendJsonError('Не найден HL-блок ' . $this->params['hlblockId']);
            exit;
        }

        $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlBlock);
        $this->entityClass = $entity->getDataClass();
    }

    /**
     * @param array $arFields
     * @return int
     * @throws FormException
     * @throws \Exception
     */
    protected function saveOrmElement($arFields)
    {
        /** @var Main\Entity\DataManager $entityClass */
        $entityClass = $this->entityClass;
        $result = $entityClass::add($arFields);

        if (!$result->isSuccess()) {
            throw new FormException('Произошла ошибка при сохранении: ' . implode("\n", $result->getErrorMessages()));
        }

        return $result->getId();
    }

    /**
     * Fetches just created element
     * 
     * @param int $elementId
     */
    protected function obtainNewElement($elementId)
    {
        switch ($this->storage) {
            case 'iblock':
                $obElement = \CIBlockElement::GetByID($elementId)->GetNextElement();
                $arFields = $obElement->GetFields();
                $arProperties = $obElement->GetProperties();
                $this->element = array_merge($arFields, array('PROPERTIES' => $arProperties));
                break;

            default:
                /** @var Main\Entity\DataManager $entityClass */
                $entityClass = $this->entityClass;
                $this->element = $entityClass::getById($elementId)->fetch();
                break;
        }
    }

    /**
     * @return bool
     */
    protected function notify()
    {
        if (empty($this->params['eventName'])) {
            return false;
        }
        
        switch ($this->storage) {
            case 'iblock':
                $arEventFields = $this->prepareIblockElementNotificationFields($this->element);
                break;
            
            default:
                $arEventFields = $this->prepareOrmElementNotificationFields($this->element);
                break;
        }

        if (is_callable($this->params['beforeSend'])) {
            call_user_func_array($this->params['beforeSend'], array($this->element, &$arEventFields));
        }

        $event = new \CEvent;
        $event->Send($this->params['eventName'], SITE_ID, $arEventFields);
        
        return true;
    }

    /**
     * @param array $arFields
     * @return array
     */
    protected function prepareIblockElementNotificationFields($arFields)
    {
        $arIblock = \CIBlock::GetByID($this->params['iblockId'])->Fetch();

        $arEventFields = array(
            'ID' => $arFields['ID'],
            'NAME' => $arFields['NAME'],
            'DETAIL_TEXT' => $arFields['DETAIL_TEXT'],
            'PREVIEW_TEXT' => $arFields['PREVIEW_TEXT'],
            'CODE' => $arFields['CODE'],
            'ADMIN_LINK' => 'http://' . SITE_SERVER_NAME . '/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=' . $this->params['iblockId'] . '&type=' . $arIblock['IBLOCK_TYPE_ID'] . '&ID=' . $arFields['ID'] . '&lang=ru&find_section_section=-1&WF=Y',
        );

        $arEventFields['LINK'] = 'http://' . SITE_SERVER_NAME . $arFields['DETAIL_PAGE_URL'];
        $arProperties = $arFields['PROPERTIES'];

        foreach ($arProperties as $arProp) {
            $arEventFields['PROPERTY_' . $arProp['CODE']] = $arProp['VALUE'];

            if ($arProp['MULTIPLE'] == 'Y') {
                $arEventFields['PROPERTY_' . $arProp['CODE']] = implode(', ', $arEventFields['PROPERTY_' . $arProp['CODE']]);
            }

            switch ($arProp['PROPERTY_TYPE']) {
                case 'L':
                    $arEventFields['PROPERTY_' . $arProp['CODE'] . '_VALUE_ID'] = $arProp['VALUE_ENUM_ID'];
                    $arEventFields['PROPERTY_' . $arProp['CODE'] . '_XML_ID'] = $arProp['VALUE_XML_ID'];

                    if ($arProp['MULTIPLE'] == 'Y') {
                        $arEventFields['PROPERTY_' . $arProp['CODE'] . '_VALUE_ID'] = implode(', ', $arEventFields['PROPERTY_' . $arProp['CODE'] . '_VALUE_ID']);
                        $arEventFields['PROPERTY_' . $arProp['CODE'] . '_XML_ID'] = implode(', ', $arEventFields['PROPERTY_' . $arProp['CODE'] . '_XML_ID']);
                    }

                    break;

                case 'E':
                    $arEventFields['PROPERTY_' . $arProp['CODE'] . '_ID'] = $arProp['VALUE'];

                    if ($arProp['MULTIPLE'] == 'Y') {
                        $arEventFields['PROPERTY_' . $arProp['CODE'] . '_ID'] = implode(', ', $arEventFields['PROPERTY_' . $arProp['CODE'] . '_ID']);
                    }

                    if (!empty($arProp['VALUE'])) {
                        $rsTmp = \CIBlockElement::GetList(array(), array('ID' => $arProp['VALUE']));

                        if (is_array($arProp['VALUE']) && count($arProp['VALUE']) > 1) {
                            $arEventFields['PROPERTY_' . $arProp['CODE']] = array();

                            while ($arLinkElement = $rsTmp->Fetch()) {
                                $arEventFields['PROPERTY_' . $arProp['CODE']][] = $arLinkElement['NAME'];
                            }

                            $arEventFields['PROPERTY_' . $arProp['CODE']] = implode(', ', $arEventFields['PROPERTY_' . $arProp['CODE']]);
                        } else {
                            $arLinkElement = $rsTmp->GetNext();
                            $arEventFields['PROPERTY_' . $arProp['CODE']] = $arLinkElement['NAME'];
                            $arEventFields['PROPERTY_' . $arProp['CODE'] . '_LINK'] = $arLinkElement['DETAIL_PAGE_URL'];
                            $arEventFields['PROPERTY_' . $arProp['CODE'] . '_CODE'] = $arLinkElement['CODE'];
                            \nav\Debug\Debug::var_dump($arEventFields);
                        }
                    } else {
                        $arEventFields['PROPERTY_' . $arProp['CODE']] = '';
                    }


                    break;
            }
        }

        return $arEventFields;
    }

    /**
     * @param array $entry
     * @return array
     */
    protected function prepareOrmElementNotificationFields($entry)
    {
        $arEventFields = array(
            'ID' => $entry['ID'],
            'ADMIN_LINK' => 'http://' . \SITE_SERVER_NAME . '/bitrix/admin/',
        );

        foreach ($entry as $code => $value) {
            $arEventFields[$code] = $value;

            if (is_array($value)) {
                $arEventFields[$code] = implode(', ', $value);
            }
        }

        return $arEventFields;
    }

    protected function loadConfig(string $formId): bool
    {
        $file = __DIR__ . '/config/' . $formId . '.php';

        if (!file_exists($file)) {
            return false;
        }

        $this->params = include($file);
        $this->prepareStorage();

        return true;
    }
}

class FormException extends \Exception {}

