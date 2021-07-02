<?php
namespace nav\Component;

use \Bitrix\Main\Engine\ActionFilter;

\CBitrixComponent::includeComponentClass("nav:component");

class OrganizationAdd extends \nav\Component\Component implements \Bitrix\Main\Engine\Contract\Controllerable
{
    protected $modules = ['iblock'];

    public function configureActions(): array
    {
        return [
            'submit' => [
                'prefilters' => [
                    new ActionFilter\Authentication(),
                    new ActionFilter\HttpMethod([ActionFilter\HttpMethod::METHOD_POST]),
                    new ActionFilter\Csrf(),
                ],
            ],
        ];
    }

    public function prepareData()
    {
    }

    public function submitAction(): array
    {
        $this->checkModules();

        $el = new \CIBlockElement;

        $arFields = [
            'IBLOCK_ID' => \Site\ORGANIZATION_IBLOCK_ID,
            'ACTIVE' => 'Y',
            'NAME' => trim($this->request->get('NAME')),
            'PROPERTY_VALUES' => [
                'USER' => $GLOBALS['USER']->GetID(),
            ],
        ];

        $requestFields = ['INN', 'JUR_ADDRESS', 'DELIVERY_ADDRESS', 'OGRN', 'HEAD', 'ACCOUNT', 'BANK_BIK', 'CORP_ACCOUNT', 'BANK_NAME'];

        foreach ($requestFields as $fieldName) {
            $arFields['PROPERTY_VALUES'][$fieldName] = $this->request->get($fieldName);
        }

        if ($el->Add($arFields) === false) {
            return [
                'status' => 'error',
                'error' => $el->LAST_ERROR,
            ];
        }

        return ['status' => 'ok'];
    }
}
