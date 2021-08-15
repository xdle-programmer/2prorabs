<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
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

$bxajaxid = CAjax::GetComponentID($component->__name, $component->__template->__name,
    $component->arParams['AJAX_OPTION_ADDITIONAL']);
?>



<section class="section section--gray">
<div class="layout">
  <div class="breadcrumb">
  <a class="breadcrumb__item" href="/">Главная</a>
	<svg class="breadcrumb__separator">
	  <use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#arrow"></use>
	</svg>
	<div class="breadcrumb__item breadcrumb__item--active">Вакансии</div>
  </div>
  <div class="static-page">
	<div class="static-page__title">Вакансии</div>
	<div class="static-page__vacancies">
	
	<?foreach($arResult["ITEMS"] as $key=>$arItem){?>
	  <div class="static-page__vacancy">
		<div class="static-page__vacancy-header">
		  <div class="static-page__vacancy-title"><?=$arItem["NAME"]?></div>
		  <div class="static-page__vacancy-price"><?=$arItem["PROPERTIES"]["PRICE"]["VALUE"]?></div>
		</div>
		<div class="static-page__vacancy-advantages">
		<?foreach($arItem["PROPERTIES"]["ADVANTAGES"]["VALUE"] as $key1=>$val1){?>
		  <div class="static-page__vacancy-advantages-item">
			<div class="static-page__vacancy-advantages-item-icon-wrapper">
			  <svg class="static-page__vacancy-advantages-item-icon">
				<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#check"></use>
			  </svg>
			</div>
			<div class="static-page__vacancy-advantages-item-text"><?=$val1?></div>
		  </div>
		<?}?>
		</div>
		<div class="static-page__vacancy-about-wrapper">
		  <div class="static-page__vacancy-about">
			<div class="static-page__vacancy-about-title">Описание вакансии</div>
			<div class="static-page__vacancy-about-desc">
			  <div class="static-page__vacancy-about-desc-item"><?=$arItem["PREVIEW_TEXT"]?></div>
			</div>
		  </div>
		  <div class="static-page__vacancy-about">
			<div class="static-page__vacancy-about-title">Требования</div>
			<div class="static-page__vacancy-about-desc">
			<?foreach($arItem["PROPERTIES"]["REQUIRMENTS"]["VALUE"] as $key1=>$val1){?>
			  <div class="static-page__vacancy-about-desc-item"><?=$val1?></div>
			<?}?>
			</div>
		  </div>
		  <div class="static-page__vacancy-about">
			<div class="static-page__vacancy-about-title">Приветствуется</div>
			<div class="static-page__vacancy-about-desc">
			<?foreach($arItem["PROPERTIES"]["WELCOMED"]["VALUE"] as $key1=>$val1){?>
			  <div class="static-page__vacancy-about-desc-item"><?=$val1?></div>
			<?}?>
			</div>
		  </div>
		  <div class="static-page__vacancy-about">
			<div class="static-page__vacancy-about-title">Условия</div>
			<div class="static-page__vacancy-about-desc">
			  <?foreach($arItem["PROPERTIES"]["TERMS"]["VALUE"] as $key1=>$val1){?>
			  <div class="static-page__vacancy-about-desc-item"><?=$val1?></div>
			  <?}?>
			</div>
		  </div>
		  <div class="static-page__vacancy-about">
			<div class="static-page__vacancy-about-title">Адрес места работы</div>
			<div class="static-page__vacancy-about-desc">
			  <div class="static-page__vacancy-about-desc-item">Город: Бишкек ул.Льва Толстого 36к</div>
			  <div class="static-page__vacancy-about-desc-item">
			  Телефоны: 
			  <?foreach($arItem["PROPERTIES"]["PHONES"]["VALUE"] as $key1=>$val1){?>
			  <?=$val1?>
			  <?}?>
			  </div>
			  <div class="static-page__vacancy-about-desc-item">
			  Режим работы: 
			  <?foreach($arItem["PROPERTIES"]["WORK_TIME"]["VALUE"] as $key1=>$val1){?>
			  <?=$val1?>
			  <?}?>
			  </div>
			  <div class="static-page__vacancy-about-desc-item">E-Mail:
			  <?foreach($arItem["PROPERTIES"]["EMAILS"]["VALUE"] as $key1=>$val1){?>
			  <?=$val1?>
			  <?}?>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	<?}?>
	  
	</div>
  </div>
</div>
</section>

