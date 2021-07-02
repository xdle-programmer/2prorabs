<?php
namespace nav;

class PageState
{
    protected static $data = [];
    protected static $titleParts = [];

    /**
     * @param string $param
     * @param mixed $value
     */
    public static function set($param, $value)
    {
        static::$data[$param] = $value;
    }

    /**
     * @param string $param
     * @param mixed $defaultValue
     * @return null
     */
    public static function get($param, $defaultValue = null)
    {
        return isset(static::$data[$param]) ? static::$data[$param] : $defaultValue;
    }

    /**
     * @return array
     */
    public static function getAll()
    {
        return static::$data;
    }

    /**
     * @param string $title
     */
    public static function pushTitlePart($title)
    {
        static::$titleParts[] = $title;
    }

    public static function getTitleParts()
    {
        return static::$titleParts;
    }
}