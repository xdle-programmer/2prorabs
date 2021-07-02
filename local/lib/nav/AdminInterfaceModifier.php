<?
namespace nav;

class AdminInterfaceModifier {
    static public function initHandlers()
    {
        $eventManager = \Bitrix\Main\EventManager::getInstance();

        if (strpos($_SERVER['REQUEST_URI'], '/bitrix/admin') !== false) {
            $eventManager->addEventHandlerCompatible('main', 'OnEndBufferContent', [static::class, 'onEndBufferContent']);
            $eventManager->addEventHandlerCompatible('main', 'OnProlog', [\nav\AdminInterfaceModifier::class, 'onProlog']);
        }

        $eventManager->addEventHandlerCompatible('main', 'OnAdminTabControlBegin', [static::class, 'showElementExtraInfo']);
    }

    static public function onProlog()
    {
        $url = $GLOBALS['APPLICATION']->GetCurPage();

        if (strpos($url, '/bitrix/admin') === false) {
            return;
        }

        $filename = substr($url, strlen('/bitrix/admin/'));

        switch ($filename) {
            case 'iblock_section_edit.php':
            case 'cat_section_edit.php':
                //static::sectionEditPropertiesReplaceSelect();
                break;
        }
    }

    static public function onEndBufferContent(&$content)
    {
        $url = $GLOBALS['APPLICATION']->GetCurPage();

        if (strpos($url, '/bitrix/admin') === false) {
            return;
        }

        $filename = substr($url, strlen('/bitrix/admin/'));

        switch ($filename) {
            case 'iblock_section_edit.php':
                break;
        }
    }

    static public function addJs()
    {
        global $APPLICATION;

        $url = $APPLICATION->GetCurPage();


        if (strpos($url, '/bitrix/admin') === false) {
            return;
        }

        $filename = substr($url, strlen('/bitrix/admin/'));

        switch ($filename) {
            case 'sale_order.php':
                break;
        }
    }

    static public function showElementExtraInfo($form)
    {
        $curPage = $GLOBALS['APPLICATION']->GetCurPage();

        if (strpos($curPage, 'cat_product_edit.php') !== false) {
            $isPublic = true;
        } elseif (strpos($curPage, 'iblock_element_edit.php') !== false) {
            $isAdmin = true;
        } else {
            return;
        }

        if (!empty($_REQUEST['ID'])) {
            $arItem = \CIBlockElement::GetByID((int) $_REQUEST['ID'])->GetNext();
        }

        $rs = \CIBlockProperty::GetList(array(), array('IBLOCK_ID' => $arItem['IBLOCK_ID']));

        while ($arProp = $rs->Fetch()) {
            if (empty($form->arFields['PROPERTY_' . $arProp['ID']])) {
                continue;
            }

            $form->arFields['PROPERTY_' . $arProp['ID']]['custom_html'] = preg_replace('#<tr id[^>]*>\s*<td#siU', '$0 title="ID: ' . $arProp['ID'] . '&#13;Код: ' . $arProp['CODE'] . '"', $form->arFields['PROPERTY_' . $arProp['ID']]['custom_html']);
        }
    }
}
