<?php
namespace nav\Misc;
/**
 * Add button to top admin panel
 *
 * @param array $args ID - element id (required), TEXT - button caption (required). IBLOCK_ID is optional
 */
function addTopAdminPanelIblockElementLink($args)
{
    static $counter;
    global $APPLICATION, $USER;

    if (!$USER->IsAdmin()) {
        return;
    }

    if (!isset($counter)) {
        $counter = 9000;
    }

    $arButton = array(
        "ICON" => "bx-panel-iblock-icon",
        "TEXT" => $args['TEXT'],
        "MAIN_SORT" => 9000,//++$counter,
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
    }

    $APPLICATION->AddPanelButton($arButton);
}
