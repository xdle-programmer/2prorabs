<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */

?>

<div class="personal-area__menu-button-container">
	<a class="personal-area__menu-button">
		<img src="<?=SITE_TEMPLATE_PATH?>/assets/src/blocks/personal-area/assets/img/catalog.svg">
	</a>
	<div class="personal-area__panel-container personal-area__panel-container--mobile">
        <?foreach ($arResult['ITEMS'] as $key => $group) {?>
            <?if (strlen($key) == 0) {?>
		        <?foreach ($group as $arItem) {?>
		        <a class="personal-area__panel-item personal-area__panel-item-home <?if ($arParams['CUR_PAGE'] == $arItem['PROPERTY_URL_VALUE']) {?>personal-area__panel-item--active<?}?>" href="<?= $arItem['PROPERTY_URL_VALUE'];?>">
			        <div class="personal-area__panel-icon <?if ($arItem['CODE']) {?>personal-area__panel-icon--<?= $arItem['CODE'];?><?}?>"></div>
			        <div class="personal-area__panel-text"><?= $arItem['NAME']?></div>
		        </a>
		        <?}?>
            <?} else {?>
		        <div class="personal-area__panel-title"><?= $arResult['SECTIONS'][$key];?></div>
		        <?foreach ($group as $arItem) {?>
		        <div class="personal-area__panel-items-box">
			        <a class="personal-area__panel-item <?if ($arParams['CUR_PAGE'] == $arItem['PROPERTY_URL_VALUE']) {?>personal-area__panel-item--active<?}?>" href="<?= $arItem['PROPERTY_URL_VALUE'];?>" >
				        <div class="personal-area__panel-icon <?if ($arItem['CODE']) {?>personal-area__panel-icon--<?= $arItem['CODE'];?><?}?>"></div>
				        <div class="personal-area__panel-text"><?= $arItem['NAME'];?></div>
				        <?if ($arItem['NAME'] == 'Бонусы') {?>
                            <?if(round($arResult['SCORE']['CURRENT_BUDGET'], 0, PHP_ROUND_HALF_UP) !=0){?>
						        <div class="personal-area__bonuses-notification">
							        <div class="personal-area__bonuses-notification-text "><?=round($arResult['SCORE']['CURRENT_BUDGET'], 0, PHP_ROUND_HALF_UP)?></div>
							        <div class="personal-area__bonuses-notification-icon"><img src="<?=SITE_TEMPLATE_PATH?>/assets/src/blocks/personal-area/assets/img/bonus-star.svg"></div>
						        </div>
                            <?}?>
			            <?}?>
			        </a>
		        </div>
		        <?}?>
	        <?}?>
        <?}?>
	</div>
</div>

<div class="personal-area__panel-container">
    <?foreach ($arResult['ITEMS'] as $key => $group) {
    	?>
	    <?if (strlen($key) == 0) {?>
		    <?foreach ($group as $arItem) {?>
			<a class="personal-area__panel-item personal-area__panel-item-home <?if ($arParams['CUR_PAGE'] == $arItem['PROPERTY_URL_VALUE']) {?>personal-area__panel-item--active<?}?>" href="<?= $arItem['PROPERTY_URL_VALUE'];?>">
				<div class="personal-area__panel-icon <?if ($arItem['CODE']) {?>personal-area__panel-icon--<?= $arItem['CODE'];?><?}?>"></div>
				<div class="personal-area__panel-text"><?= $arItem['NAME'];?></div>
			</a>
			<?}?>
		<?} else {?>
		    <div class="personal-area__panel-title"><?= $arResult['SECTIONS'][$key];?></div>
            <?foreach ($group as $arItem) {?>
			    <div class="personal-area__panel-items-box">
				    <a class="personal-area__panel-item <?if ($arParams['CUR_PAGE'] == $arItem['PROPERTY_URL_VALUE']) {?>personal-area__panel-item--active<?}?>" href="<?= $arItem['PROPERTY_URL_VALUE'];?>">
					    <div class="personal-area__panel-icon <?if ($arItem['CODE']) {?>personal-area__panel-icon--<?= $arItem['CODE'];?><?}?>"></div>
					    <div class="personal-area__panel-text"><?= $arItem['NAME'];?></div>
					    <?if ($arItem['NAME'] == 'Бонусы'){?>
						    <div class="personal-area__bonuses-notification">
                                <?if(round($arResult['SCORE']['CURRENT_BUDGET'], 0, PHP_ROUND_HALF_UP) !=0){?>
								    <div class="personal-area__bonuses-notification-text"><?=round($arResult['SCORE']['CURRENT_BUDGET'], 0, PHP_ROUND_HALF_UP)?></div>
								    <div class="personal-area__bonuses-notification-icon"><img src="<?=SITE_TEMPLATE_PATH?>/assets/src/blocks/personal-area/assets/img/bonus-star.svg">
								    </div>
                                <?}?>
						    </div>
				        <?}?>
				    </a>
			    </div>
			<?}?>
		<?}?>
	<?}?>

	<a class="personal-area__panel-item" href="/?logout=yes">
		<div class="personal-area__panel-icon personal-area__panel-icon--exit"></div>
		<div class="personal-area__panel-text">Выход</div>
	</a>
</div>