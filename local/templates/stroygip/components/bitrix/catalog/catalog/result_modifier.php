<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

  foreach ($arResult['PROPERTIES']['GALLERY']['VALUE'] as $ph) {
    $arResult['GALLERY'][$ph] = CFile::ResizeImageGet($ph,['width' => 136, 'height' => 144],BX_RESIZE_IMAGE_EXACT)['src'];
}
  $arResult['DETAIL_PICTURE']['URL'] = CFile::ResizeImageGet($arResult['DETAIL_PICTURE']['ID'],['width' => 576, 'height' => 464],BX_RESIZE_IMAGE_PROPORTIONAL)['src'];

