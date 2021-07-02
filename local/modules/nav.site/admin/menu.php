<?php
if (!$USER->IsAdmin()) {
    return;
}

$aMenuSettings = [
    'parent_menu' => 'global_menu_services',
    'section' => 'nav_site',
    'sort' => 1,
    'text' => '2proraba.kz',
    'title' => '2proraba.kz',
    'url' => 'nav_site_settings.php?lang=' . LANG,
    'icon' => 'sys_menu_icon',
    //'page_icon' => 'fileman_sticker_icon_sections',
    'items_id' => 'menu_nav_site_settings',
    'more_url' => [
        'nav_site_settings.php'
    ],
    'items' => []
];

$aMenu = [
    $aMenuSettings
];

return $aMenu;
?>