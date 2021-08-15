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
$this->setFrameMode(true);
?>
<div class="static-page__title">Услуги</div>
<div class="static-page__services">
<? $counter =0;
 foreach($arResult["ITEMS"] as $arItem){?>
  <div class="static-page__services-item">
    <?foreach ($arItem['PROPERTIES']['PHOTO']['VALUE'] as $img_key=>$photo){?>
        <img class="static-page__services-img" src="<?=CFile::GetPath($photo)?>">
		<?
		if( $img_key == 0 ){
			break;
		}
		?>
    <?}?>
	<div class="static-page__services-desc">
	  <div class="static-page__services-desc-title"><?=$arItem['NAME']?></div>
	  <div class="static-page__services-desc-text"><?=$arItem['PREVIEW_TEXT']?></div>
	</div>
  </div>
  <?}?>
</div>
