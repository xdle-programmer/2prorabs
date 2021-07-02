<?php
namespace nav\Component;
use \Bitrix\Main;
use \Bitrix\Main\SystemException as SystemException;

class Component extends \CBitrixComponent
{
    protected $items = array();
    protected $filter = array();
    /** @var \Bitrix\Main\DB\Result */
    protected $rs;

    /** @var string Requested ajax method */
    protected $ajaxMethod = '';

    /** @var string Requested action (normal request) */
    protected $action = '';

    /** @var array Allowed ajax methods */
    protected $allowedAjaxMethods = array();

    /** @var array Allowed request actions */
    protected $allowedActions = array();

    /** @var array List of modules for including */
    protected $modules = array();

    /** @var array Default component params */
    protected $defaultParams = array();

    /** @var string Cache directory of last called $this->getDataCache() */
    protected $dataCacheDir;

    /** @var string Cache ID of last called $this->getDataCache() */
    protected $dataCacheId;

    /** @var \CPHPCache */
    protected $obDataCache;

    /** @var Main\HttpRequest */
    protected $request;

    protected static $adminMenuButtonId;

    protected $templatePage;

    /**
     * Prepares component params
     */
    public function onPrepareComponentParams($params)
    {
        foreach ($this->defaultParams as $paramName => $paramValue) {
            if (!empty($params[$paramName])) {
                continue;
            }

            $params[$paramName] = $paramValue;
        }

        return $params;
    }

    public function executeComponent()
    {
        global $APPLICATION;

        try {
            $this->request = \Bitrix\Main\Context::getCurrent()->getRequest();
            $this->checkModules();
            $this->beforeProcessRequest();
            $this->processRequest();

            if (!$this->extractCache()) {
                if ($this->prepareData() === false) {
                    return;
                }

                $this->formatResult();

                if ($this->arParams['_DELAYED'] !== 'Y') {
                    if ($this->isAjaxMethodAllowed()) {
                        ob_start();
                    }

                    $this->includeComponentTemplate($this->templatePage);
                    $this->afterRender();

                    if ($this->isAjaxMethodAllowed()) {
                        $contents = ob_get_flush();
                        $APPLICATION->RestartBuffer();

                        print json_encode(array_merge(array(
                            'content' => $contents
                        ), (array) $this->arResult['JSON_RESPONSE']));

                        exit;
                    }
                } else {
                    $APPLICATION->AddBufferContent(array($this, 'showDelayed'));
                    \Bitrix\Main\Page\Asset::getInstance()->addJs($this->getPath() . '/templates/'. ($this->getTemplateName() ?: '.default') . '/script.js');
                }

                $this->commitCache();
            }
        } catch (\Exception $e) {
            $this->abortCache();

            if ($this->isAjaxRequest()) {
                $this->sendJsonError($e->getMessage() . (defined('\nav\DEBUG') && \nav\DEBUG === true ? "\n" . $e->getTraceAsString() : ''));
                die();
            } else {
                if ($e instanceof Exception) {
                    ShowError($e->getMessage() . (defined('\nav\DEBUG') && \nav\DEBUG === true ? "\n" . $e->getTraceAsString() : ''));
                } else {
                    throw $e;
                }
            }
        }
    }

    /**
     * Checks required modules
     */
    protected function checkModules()
    {
        foreach ($this->modules as $module) {
            if (!\Bitrix\Main\Loader::includeModule($module)) {
                throw new SystemException('Can\'t include module ' . $module);
            }
        }

        return true;
    }

    /**
     * Extracts data from cache. No action by default.
     * @return bool
     */
    protected function extractCache()
    {
        return false;
    }

    protected function commitCache()
    {
    }

    protected function abortCache()
    {
        $this->abortResultCache();
    }

    /**
     * Extracts data from cache
     * @param int $time
     * @param string $cacheDir Starts with /
     * @param string $cacheId
     * @return array|bool
     * @throws Main\LoaderException
     */
    protected function getCachedData($time, $cacheDir, $cacheId = null)
    {
        global $CACHE_MANAGER;

        $this->obDataCache = new \CPHPCache;
        $this->dataCacheDir = $cacheDir;

        if ($cacheId === null) {
            $this->dataCacheId = $this->getCacheKey();
        } else {
            $this->dataCacheId = $cacheId;
        }

        if ($this->obDataCache->InitCache($time, $this->dataCacheId, $this->dataCacheDir)) {
            return $this->obDataCache->GetVars();
        } else {
            $this->obDataCache->StartDataCache();
            $CACHE_MANAGER->StartTagCache($this->dataCacheDir);
            return false;
        }
    }

    /**
     * @param array $data
     * @return string
     */
    protected function getCacheKey($data = null)
    {
        return $data === null ? 'data' : md5(serialize($data));
    }

    /**
     * Saves data to cache
     * @param array $data
     */
    protected function saveCachedData($data)
    {
        global $CACHE_MANAGER;

        $CACHE_MANAGER->EndTagCache();

        $this->obDataCache->EndDataCache($data);
    }

    protected function abortCachedData()
    {
        $this->obDataCache->AbortDataCache();
    }

    protected function registerCacheTag($tag)
    {
        global $CACHE_MANAGER;
        $CACHE_MANAGER->RegisterTag($tag);
    }

    protected function isAjaxMethodAllowed()
    {
        if ($this->request->getQuery('ajax') == 'Y' && in_array($this->request->getQuery('method'), $this->allowedAjaxMethods)) {
            $this->ajaxMethod = $this->request->getQuery('method');
        } elseif ($this->request->getPost('ajax') == 'Y' && in_array($this->request->getPost('method'), $this->allowedAjaxMethods)) {
            $this->ajaxMethod = $this->request->getPost('method');
        }

        return !empty($this->ajaxMethod);
    }

    protected function isAjaxRequest()
    {
        $isAjax = false;

        if ($this->request->getQuery('ajax') == 'Y' && $this->request->getQuery('method') != null) {
            $isAjax = true;
        } elseif ($this->request->getPost('ajax') == 'Y' && $this->request->getPost('method') != null) {
            $isAjax = true;
        }

        return $isAjax;
    }

    /**
     * Processes incoming request.
     * @return void
     */
    protected function processRequest()
    {
        $queryData = $this->request->getQueryList();
        $postData = $this->request->getPostList();

        if ($this->isAjaxMethodAllowed()) {
            $this->processAjaxRequest();
        } else {
            $this->action = !empty($queryData['action']) ? $queryData['action'] : (!empty($postData['action']) ? $postData['action'] : null);

            if (!empty($this->action) && in_array($this->action, $this->allowedActions)) {
                $this->processOrdinaryRequest();
            }
        }
    }

    protected function beforeProcessRequest()
    {
    }

    protected function processOrdinaryRequest()
    {
        if (!$this->action) {
            return;
        }

        $this->checkSession();

        if (!method_exists($this, $this->action . 'Action')) {
            throw new Exception('Неизвестное действие');
        }

        call_user_func(array($this, $this->action . 'Action'), false);
    }

    protected function processAjaxRequest()
    {
        if (!$this->isAjaxMethodAllowed()) {
            return;
        }

        $this->checkSession();

        if (strpos($this->ajaxMethod, '.') !== false) {
            $method = substr($this->ajaxMethod, strpos($this->ajaxMethod, '.') + 1);
        } else {
            $method = $this->ajaxMethod;
        }

        if (!method_exists($this, $method . 'Action')) {
            throw new Exception('Неизвестное действие');
        }

        $result = call_user_func(array($this, $method . 'Action'), true);

        if ($result instanceof AjaxTemplateResult) {
            // Continue work - obtain data and render template as usual
            return;
        } else {
            $this->sendJson($result);
        }
    }

    protected function prepareData()
    {
    }

    /**
     * Prepares data to render.
     * @return void
     */
    protected function formatResult()
    {
    }

    /**
     * Post-rendering actions
     */
    protected function afterRender()
    {
    }

    /**
     * Sends data in json format and die
     * @param array $data
     */
    public function sendJson($data = array())
    {
        $GLOBALS['APPLICATION']->RestartBuffer();

        if ($data === null) {
            $data = array();
        }

        if (empty($data['status'])) {
            $data['status'] = 'ok';
        }

        print json_encode($data);
        exit;
    }

    /**
     * Sends error in json format and die
     * @param string $text
     */
    public function sendJsonError($text)
    {
        $this->sendJson(array(
            'status' => 'error',
            'error' => $text,
        ));
    }

    /**
     * @return bool
     * @throws Exception
     */
    protected function checkSession()
    {
        if (!check_bitrix_sessid()) {
            throw new Exception('Неверный идентификатор сессии. Обновите страницу и попробуйте ещё раз.');
        }

        return true;
    }

    public function addTopPanelLink($args)
    {
        static $counter;
        global $APPLICATION, $USER;

        if (!$USER->IsAdmin()) {
            return;
        }

        if (!isset($counter)) {
            $counter = 9000;
        }
        /*$arSubMenu = array();

        $arSubMenu = array(
            array(
                "TEXT"		=>GetMessage("top_panel_templ_edit"),
                "TITLE"		=>GetMessage("top_panel_templ_edit_title"),
                "ICON"		=>"icon-edit",
                "ACTION"	=> "jsUtils.Redirect([], '/bitrix/admin/template_edit.php?lang=".LANGUAGE_ID."&ID=".$encSiteTemplateId."')",
                "DEFAULT"	=> false,
            ),

            array(
                "TEXT"		=> GetMessage("top_panel_templ_site"),
                "TITLE"		=> GetMessage("top_panel_templ_site_title"),
                "ICON"		=> "icon-edit",
                "ACTION"	=> "jsUtils.Redirect([], '/bitrix/admin/site_edit.php?lang=".LANGUAGE_ID."&LID=".SITE_ID."')",
                "DEFAULT"	=> false,
            ),
        );

        $APPLICATION->AddPanelButton(Array(
            "ICON" => "bx-panel-menu-icon",
            'ACTION' => '/aaa/',
            "TEXT" => 'Разное',
            "MAIN_SORT" => "9000",
            "SORT" => 9000,
            "MENU" => $arSubMenu
        ));*/
        $arButton = array(
            "ICON" => "bx-panel-iblock-icon",
            "TEXT" => $args['TEXT'],
            "MAIN_SORT" => ++$counter,
            "SORT" => $counter,
        );

        if (empty($args['IBLOCK_ID']) && !empty($args['ID'])) {
            $arElement = \CIBlockElement::GetByID($args['ID'])->Fetch();
            $args['IBLOCK_ID'] = $arElement['IBLOCK_ID'];
            $args['IBLOCK_TYPE_ID'] = $arElement['IBLOCK_TYPE_ID'];
        }

        if (!empty($args['IBLOCK_ID'])) {
            if (empty($args['IBLOCK_TYPE_ID'])) {
                $arIblock = \CIBlock::GetByID($args['IBLOCK_ID'])->Fetch();
                $args['IBLOCK_TYPE_ID'] = $arIblock['IBLOCK_TYPE_ID'];
            }

            $arButton['HREF'] = "javascript:BX.util.popup('/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=" . $args['IBLOCK_ID'] . "&type=" . $args['IBLOCK_TYPE_ID'] . "&ID="  . $args['ID'] . "&lang=ru&find_section_section=-1&WF=Y')";
        } else {
        }
        $APPLICATION->AddPanelButton($arButton);
    }

    protected function methodNotAllowed()
    {
        \Bitrix\Main\Context::getCurrent()->getResponse()->setStatus(405);
        throw new Exception('Вызов метода не поддерживается.');
    }

    protected function makeUrl($template, $replaces)
    {
        return str_replace(array_keys($replaces), array_values($replaces), $template);
    }

    public function showDelayed()
    {
        global $APPLICATION;

        if (!$APPLICATION->buffer_manual) {
            return null;
        }

        ob_start();
        $this->includeComponentTemplate();
        return ob_get_clean();
    }

    public function show404($message = null)
    {
        \Bitrix\Iblock\Component\Tools::process404($message, true, true, false, '');
    }

    /**
     * @return string
     */
    public static function getGeneralAdminMenuButtonId()
    {
        global $APPLICATION;

        if (static::$adminMenuButtonId) {
            return static::$adminMenuButtonId;
        }

        static::$adminMenuButtonId = 'nav_component';

        $APPLICATION->AddPanelButton(array(
            "HREF" => '',
            "ID" => static::$adminMenuButtonId,
            "ICON" => "bx-panel-menu-icon",
            //"ALT" => GetMessage('MAIN_MENU_TOP_PANEL_BUTTON_ALT')
            //    .($bDefaultItem ? ' '.'"'.(isset($arMenuTypes[$menuType]) ? $arMenuTypes[$menuType]:$menuType).'"' : ''),
            "TEXT" => 'Разное',
            "MAIN_SORT"	=> "1000",
            "SORT" => 900,
            "RESORT_MENU" => true,
            "HINT" => array(
                "TITLE" => 'Разное',
                "TEXT" => 'Вспомогательные функции и быстрые действия',
            ),
        ), false);

        return static::$adminMenuButtonId;
    }

    public static function addItemToGeneralAdminMenu($button)
    {
        global $APPLICATION;
        $APPLICATION->AddPanelButtonMenu(static::getGeneralAdminMenuButtonId(), $button);
    }

    public function setTemplatePage($page)
    {
        $this->templatePage = $page;
    }
}

class AjaxTemplateResult {}

class Exception extends \Exception {}

