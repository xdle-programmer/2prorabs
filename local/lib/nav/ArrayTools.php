<?php
namespace nav;

use Bitrix\Main\Entity\Base;

class ArrayTools
{
    /**
     * Recursively converts keys of array items to camel case
     *
     * @param array $items
     * @return array
     */
    public static function keysSnakeToCamel(array $items)
    {
        $new = [];

        foreach ($items as $key => $value) {
            if (is_int($key)) {
                $newKey = $key;
            } else {
                $newKey = lcfirst(Base::snake2camel($key));
            }

            if (is_array($value)) {
                $newValue = static::keysSnakeToCamel($value);
            } else {
                $newValue = $value;
            }

            $new[$newKey] = $newValue;
        }

        return $new;
    }

    /**
     * Creates new array with keys equal to $item[$key]
     *
     * @param array $array
     * @param string $key
     * @param bool $flat Relation 1:1 (true), when key value contains a element, or 1:N (false), when key value contains array of elements
     * @return array
     */
    public static function rebuildByKey(array $array, $key, $flat = true)
    {
        $newArray = [];

        foreach ($array as $item) {
            $newKey = $item[$key];

            if ($flat == true) {
                $newArray[$newKey] = $item;
            } else {
                if (!is_array($newArray[$newKey])) {
                    $newArray[$newKey] = [];
                }

                $newArray[$newKey][] = $item;
            }
        }

        return $newArray;
    }

    /**
     * Escape array for template
     *
     * @param array $array
     * @return array
     */
    public static function escape(array $array)
    {
        array_walk_recursive($array, function (&$value, $key) {
            $value = htmlspecialcharsEx($value);
        });

        return $array;
    }

    /**
     * Return new array with required keys
     *
     * @param array $array
     * @param array $keys
     * @return array
     */
    public static function filterKeys(array $array, array $keys)
    {
        return array_intersect_key($array, array_flip($keys));
    }

    /**
     * Makes array of arrays to access to items by their properties.
     * Can be used with cache, if cache engine respects references.
     *
     * @param array $array
     * @param array $keys
     * @return array
     */
    public static function makeLinks(array $array, array $keys)
    {
        $result = [];

        foreach ($array as $index => &$item) {
            foreach ($keys as $key) {
                $result[$key][$item[$key]] = &$item;
            }
        }

        unset($item);

        return $result;
    }

    /**
     * Pick value by $key from each item and return array of the values
     *
     * @param array $array
     * @param string $key
     * @return array
     */
    public static function pickByKey(array $array, string $key): array
    {
        return array_map(function (array $item) use ($key) { return $item[$key]; }, $array);
    }
}