<?php
namespace nav\Catalog;

use Bitrix\Main\Context;
use Bitrix\Main\HttpRequest;
use Bitrix\Main\Web\Uri;

class PageSize {
    protected static $default = 16;

    /**
     * Possible values
     *
     * @return array
     */
    protected static function getAvailable(): array
    {
        return [16, 32, 48];
    }

    /**
     * All available options
     *
     * @return array
     */
    protected static function getDefaultTemplateData(): array
    {
        $currentValue = static::getCurrent();
        $result = [];

        $uri = new Uri(Context::getCurrent()->getRequest()->getRequestUri());
        $uri->deleteParams(HttpRequest::getSystemParameters());
        // Legacy param
        $uri->deleteParams(['pageSize']);

        foreach (static::getAvailable() as $pageSize) {
            $uri->addParams(['pageSize' => $pageSize]);

            $pageSizeParams = [
                'NAME' => $pageSize,
                'CODE' => $pageSize,
                'URL' => $uri->getUri(),
            ];

            if ($pageSize == $currentValue) {
                $pageSizeParams['ACTIVE'] = 'Y';
            }

            $result[] = $pageSizeParams;
        }

        return $result;
    }

    /**
     * Returns array of available methods with urls
     *
     * @param int|null $mode
     * @return array
     */
    public static function getTemplateData(?int $mode = null): array
    {
        return static::getDefaultTemplateData();
    }

    /**
     * Returns current setting
     */
    public static function getCurrent(): int
    {
        $availablePageSizes = static::getAvailable();

        if (!in_array($_SESSION['catalogPageSize'], $availablePageSizes)) {
            return static::$default;
        } else {
            return (int) $_SESSION['catalogPageSize'];
        }
    }

    /**
     * Updates current page size
     *
     * @return bool
     */
    public static function setFromRequest(): ?bool
    {
        $request = Context::getCurrent()->getRequest();
        $pageSize = $request->get('pageSize');

        if (empty($pageSize)) {
            $pageSize = $request->getCookie('pageSize');
            $setCookie = false;
        } else {
            $setCookie = true;
        }

        if (!in_array($pageSize, static::getAvailable())) {
            return null;
        }

        if ($setCookie === true) {
            setcookie('pageSize', $pageSize, time() + 365 * 86400, '/');
        }

        $_SESSION['catalogPageSize'] = $pageSize;

        return true;
    }
}