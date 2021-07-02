<?php
namespace nav\Component;
\CBitrixComponent::includeComponentClass("nav:component");

class ProductReviews extends \nav\Component\Component
{
    protected $modules = ['iblock'];

    public function prepareData()
    {
        if (empty($this->arParams['PRODUCT_ID'])) {
            return;
        }

        $iterator = \CIBlockElement::GetList(['ID' => 'DESC'], [
            'IBLOCK_ID' => \Site\PRODUCT_REVIEW_IBLOCK_ID,
            'ACTIVE' => 'Y',
            '=PROPERTY_PRODUCT' => $this->arParams['PRODUCT_ID'],
        ], false, false, ['ID', 'NAME', 'DETAIL_TEXT', 'PROPERTY_EMAIL', 'DATE_CREATE']);

        $this->arResult['ITEMS'] = [];

        while ($arItem = $iterator->GetNext()) {
            $this->arResult['ITEMS'][] = $arItem;
        }
    }
}
