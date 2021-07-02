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

<?
if (0 < $arResult["SECTIONS_COUNT"])
{
	$intCurrentDepth = 1;
	$boolFirst = true;
	foreach ($arResult['SECTIONS'] as $key=>&$arSection)
	{
		?>
		
		<?if( $arSection['DEPTH_LEVEL'] == "1" ):?>
		<div class="menu__category-item preload__area">
			<img class="preload__item menu__category-icon" data-src="<?=$arSection['PICTURE']['SRC']?>">
			<div class="menu__category">
				<div class="menu__category-title" data-menu-target="category-<?=$arSection['ID']?>"><? echo $arSection["NAME"];?></div>
		
				<?if( is_array($arResult['SECTIONS_TREE'][$arSection['ID']]) && count($arResult['SECTIONS_TREE'][$arSection['ID']])>0 ):?>
					<?foreach( $arResult['SECTIONS_TREE'][$arSection['ID']] as $key1=>$arSection1 ):?>
						<div class="menu__category-subtitle" data-menu-target="subcategory-<?=$arSection1['ID']?>"><? echo $arSection1["NAME"];?></div>
						<?
						if( $key1 >= 2 ){
							break;
						}
						?>
					<?endforeach;?>
					
					<?if( intval($arSection["COUNT"]) > 3 ):?>
					<div class="menu__category-more-link" data-menu-target="category-<?=$arSection['ID']?>">Еще <? echo ( intval($arSection["COUNT"]) - 3); ?></div>
					<?endif;?>
				
				<?endif;?>
				

				

				<div class="menu__mobile-desc" data-menu-target="category-<?=$arSection['ID']?>">
					<? echo $arSection["NAME"];?>
					
					<?if( intval($arSection["COUNT"]) > 3 ):?>
					Еще <? echo ( intval($arSection["COUNT"]) - 3); ?>
					<?endif;?>
					
					<div class="menu__mobile-button" data-menu-target="category-<?=$arSection['ID']?>">
						<svg class="menu__mobile-button-icon">
							<use xlink:href="<?=SITE_TEMPLATE_PATH?>/ts/images/icons/icons-sprite.svg#arrow"></use>
						</svg>
					</div>
				</div>
			</div>
        </div>
		<?endif;?>
		
		<?
	}
}
?>
