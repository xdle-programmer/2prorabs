<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (empty($arResult)) {
    return;
}

$menu = new \nav\BitrixMenu($arResult);
?>
<? foreach($menu->getRootItems() as $index => $arItem): ?>
    <?
    $children = $menu->getItemsByParent($index);
    ?>
    <div class="nav__links">
        <a class="nav__links-item" href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?></a>
        <? if (count($children)): ?>
            <div class="nav__links-submenu">
                <? foreach ($children as $child): ?>
                    <a href="<?=$child['LINK']?>" class="nav__links-submenu-item"><?=$child['TEXT']?></a>
                <? endforeach; ?>
            </div>
        <? endif; ?>
    </div>
<? endforeach; ?>
