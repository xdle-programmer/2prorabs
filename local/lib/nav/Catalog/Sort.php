<?php
namespace nav\Catalog;

use Bitrix\Main\Context;
use Bitrix\Main\HttpRequest;
use Bitrix\Main\Web\Uri;

class Sort {
    protected static $default = 'popular_desc';

    const TEMPLATE_DEFAULT = 1;
    const TEMPLATE_MIN_GROUPED = 2;

    /**
     * Possible sorts
     *
     * @return array
     */
    protected static function getAvailable(): array
    {
        return [
            'popular_desc' => [
                'FIELD' => ['PROPERTY_POPULARITY'],
                'ORDER' => ['DESC'],
                'CODE' => 'popular_desc',
                'NAME' => 'По популярности',
            ],
            'price_asc' => [
                'FIELD' => ['CATALOG_PRICE_1'],
                'ORDER' => ['ASC,nulls'],
                'CODE' => 'price_asc',
                'NAME' => 'По цене (возрастание)',
            ],
            'price_desc' => [
                'FIELD' => ['CATALOG_PRICE_1'],
                'ORDER' => ['DESC,nulls'],
                'CODE' => 'price_desc',
                'NAME' => 'По цене (убывание)',
            ],
            'name_asc' => [
                'FIELD' => ['NAME'],
                'ORDER' => ['ASC'],
                'CODE' => 'name_asc',
                'NAME' => 'По названию',
            ],
        ];
    }

    /**
     * All available sort options
     *
     * @return array
     */
    protected static function getDefaultTemplateData(): array
    {
        $currentSort = static::getCurrent();
        $result = [];

        $uri = new Uri(Context::getCurrent()->getRequest()->getRequestUri());
        $uri->deleteParams(HttpRequest::getSystemParameters());
        // Legacy param
        $uri->deleteParams(['order']);

        foreach (static::getAvailable() as $sortCode => $sortParams) {
            $uri->addParams(['sort' => $sortCode]);

            $sortParams['URL'] = $uri->getUri();

            if ($sortCode == $currentSort['CODE']) {
                $sortParams['ACTIVE'] = 'Y';
            }

            $result[] = $sortParams;
        }

        return $result;
    }

    /**
     * Groups sort by first part of code and leave first inactive option
     *
     * @return array
     */
    protected static function getMinGroupedTemplateData(): array
    {
        $currentSort = static::getCurrent();
        $result = [];

        $uri = new Uri(Context::getCurrent()->getRequest()->getRequestUri());
        $uri->deleteParams(HttpRequest::getSystemParameters());
        // Legacy param
        $uri->deleteParams(['order']);
        $groups = [];

        foreach (static::getAvailable() as $sortCode => $sortParams) {
            if ($sortCode == $currentSort['CODE']) {
                $sortParams['ACTIVE'] = 'Y';
            }

            $groupName = substr($sortCode, 0, strpos($sortCode, '_'));
            $groups[$groupName][] = $sortParams;
        }

        foreach ($groups as $groupName => $groupItems) {
            if ($groupItems[0]['ACTIVE'] === 'Y') {
                $item = $groupItems[1] ?? $groupItems[0];
                $item['ACTIVE_GROUP'] = 'Y';
            } elseif ($groupItems[1]['ACTIVE'] === 'Y') {
                $item = $groupItems[0];
                $item['ACTIVE_GROUP'] = 'Y';
            } else {
                // If group isn't active, use first sort option
                $item = $groupItems[0];
            }

            $uri->addParams(['sort' => $item['CODE']]);
            $item['URL'] = $uri->getUri();

            $result[] = $item;
        }

        return $result;
    }

    /**
     * Returns array of available sort methods with urls
     *
     * @param int|null $mode
     * @return array
     */
    public static function getTemplateData(?int $mode = null): array
    {
        switch ($mode) {
            case static::TEMPLATE_MIN_GROUPED:
                return static::getMinGroupedTemplateData();
                break;

            default:
                return static::getDefaultTemplateData();
                break;
        }
    }

    /**
     * Returns current sort
     */
    public static function getCurrent(): array
    {
        $availableSort = static::getAvailable();

        if (empty($availableSort[$_SESSION['catalogSort']])) {
            return $availableSort[static::$default];
        } else {
            return $availableSort[$_SESSION['catalogSort']];
        }
    }

    /**
     * Updates current sort
     *
     * @return bool
     */
    public static function setFromRequest(): ?bool
    {
        $request = Context::getCurrent()->getRequest();
        $sort = $request->get('sort');

        if (empty($sort)) {
            $sort = $request->getCookie('sort');
            $setCookie = false;
        } else {
            $setCookie = true;
        }

        $availableSort = static::getAvailable();

        if (empty($availableSort[$sort])) {
            return null;
        }

        if ($setCookie === true) {
            setcookie('sort', $sort, time() + 365 * 86400, '/');
        }

        $_SESSION['catalogSort'] = $sort;
        return true;
    }
}