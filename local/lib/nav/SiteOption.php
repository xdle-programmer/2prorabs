<?php
namespace nav;

use Bitrix\Main\Config\Option;

class SiteOption
{
    const DELIVERY_NORMAL_PRICE = 'delivery_normal_price';
    const DELIVERY_NORMAL_MIN_SUM = 'delivery_normal_min_sum';
    const DELIVERY_HEAVY_PRICE = 'delivery_heavy_price';
    const DELIVERY_HEAVY_MIN_SUM = 'delivery_heavy_min_sum';

    const MAIN_SLIDER_LOOP = 'main_slider_loop';
    const MAIN_SLIDER_AUTOPLAY = 'main_slider_autoplay';
    const MAIN_SLIDER_AUTOPLAY_TIMEOUT = 'main_slider_autoplay_timeout';

    public static function get(string $optionName, ?string $default = ''): string
    {
        return Option::get('nav.site', $optionName, $default ?? '');
    }

    public static function set(string $optionName, $value): void
    {
        Option::set('nav.site', $optionName, $value);
    }
}