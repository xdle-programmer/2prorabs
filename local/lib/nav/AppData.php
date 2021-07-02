<?php
namespace nav;

class AppData {
    protected static $data = [];

    /**
     * Adds data to app json object.
     *
     * @param string|array $key
     * @param string $value Optional
     * @param bool $merge Merge values with same keys instead of replacing
     */
    public static function add($key, $value = null, $merge = false)
    {
        if (!is_array($key) && !is_null($value)) {
            $data = [$key => $value];
        } else {
            $data = $key;
        }

        if ($merge) {
            static::$data = array_replace_recursive(static::$data, $data);
        } else {
            static::$data = array_merge_recursive(static::$data, $data);
        }
    }

    /**
     * @return array
     */
    public static function get()
    {
        return static::$data;
    }

    /**
     * Prints json object app. It uses delayed function
     */
    public static function show()
    {
        // Workaround with bitrix bug for classic bitrix ajax components
        if (!empty($_REQUEST['bxajaxid'])) {
            return;
        }

        $GLOBALS['APPLICATION']->AddBufferContent(function () {
            $event = new \Bitrix\Main\Event('main', 'nav:onAppDataShow');
            $event->send();

            return '<script>var app = ' . json_encode(static::$data) . ';</script>' . "\n";
        });

    }
}