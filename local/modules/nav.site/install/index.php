<?php
use Bitrix\Main\Localization\Loc;

if (class_exists('nav_site')) return;

Loc::loadMessages(__FILE__);

class nav_site extends CModule
{
    var $MODULE_ID = 'nav.site';
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_CSS;
    var $PARTNER_NAME = 'Andrey Neyman';
    var $PARTNER_URI = '';

    function nav_site()
    {
        include __DIR__ . '/version.php';

        $this->MODULE_VERSION = NAV_SITE_VERSION;
        $this->MODULE_VERSION_DATE = NAV_SITE_VERSION_DATE;
        $this->MODULE_NAME = Loc::getMessage('NAV_SITE_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('NAV_SITE_MODULE_DESCRIPTION');
    }

    function DoInstall()
    {
        RegisterModule($this->MODULE_ID);
        $this->InstallFiles();
    }

    function DoUninstall()
    {
        UnRegisterModule($this->MODULE_ID);
        $this->UninstallFiles();
    }

    function InstallFiles()
    {
        CopyDirFiles($_SERVER['DOCUMENT_ROOT'] . '/local/modules/nav.site/install/admin', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin', true);
        return true;
    }

    function UnInstallFiles()
    {
        DeleteDirFiles($_SERVER['DOCUMENT_ROOT'] . '/local/modules/nav.site/install/admin/', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin');

        return true;
    }
}