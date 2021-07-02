<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

foreach ($arResult['SECTIONS'] as &$SECTION) {
  if($SECTION['IBLOCK_SECTION_ID']) {
      $arResult['SUB_SECTIONS'][$SECTION['IBLOCK_SECTION_ID']][] = $SECTION;
  } else {
      $SECTION['PIC'] = CFile::ResizeImageGet($SECTION["PICTURE"]["ID"],['width' => 264, 'height' => 164],BX_RESIZE_IMAGE_EXACT)['src'];
      $SECTION['SVG'] = CFile::GetPath($SECTION["UF_SVG"]);
      $arResult['MAIN_SECTIONS'][] = $SECTION;
  }
}
unset($SECTION);
foreach ($arResult['SECTIONS'] as &$SECTION) {
    if($SECTION['IBLOCK_SECTION_ID']) {
        $arResult['DEPTH_LEVEL_' . $SECTION['DEPTH_LEVEL']][$SECTION['IBLOCK_SECTION_ID']][] = $SECTION;
    } else {
      if($SECTION['UF_SHOW_IN_MAIN']) {
        $SECTION['PIC'] = CFile::ResizeImageGet($SECTION["PICTURE"]["ID"],['width' => 264, 'height' => 164],BX_RESIZE_IMAGE_EXACT)['src'];
        $SECTION['SVG'] = CFile::GetPath($SECTION["UF_SVG"]);
        $arResult['DEPTH_LEVEL_1'][] = $SECTION;
      }
    }
}
unset($SECTION);
