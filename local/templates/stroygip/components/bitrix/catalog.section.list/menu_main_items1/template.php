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
	foreach ($arResult['SECTIONS'] as $key=>&$arSection)
	{
		if (false === $arSection['PICTURE'])
			$arSection['PICTURE'] = array(
				'SRC' => $arCurView['EMPTY_IMG'],
				'ALT' => (
					'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
					? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
					: $arSection["NAME"]
				),
				'TITLE' => (
					'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
					? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
					: $arSection["NAME"]
				)
			);
			// $arSection['PICTURE']['SRC'];
			?>
			
			<?if( $arSection['DEPTH_LEVEL'] == "1" ):?>
			<div class="menu__block preload preload--not-ready" data-menu-name="category-<?=$arSection['ID']?>">
				<div class="menu__inner">
					<div class="menu__inner-back-link" data-menu-target="main">Каталог</div>
					<svg class="menu__inner-separator">
					<use xlink:href="<?=SITE_TEMPLATE_PATH?>/ts/images/icons/icons-sprite.svg#arrow"></use>
					</svg>
					<div class="menu__inner-name"><? echo $arSection['NAME']; ?></div>
				</div>	
				<div class="menu__items">
				
				<?if( is_array($arResult['SECTIONS_TREE'][$arSection['ID']]) && count($arResult['SECTIONS_TREE'][$arSection['ID']])>0 ):?>
					<?foreach( $arResult['SECTIONS_TREE'][$arSection['ID']] as $key1=>$arSection1 ):?>
					<div class="menu__category-item preload__area">
						<img class="preload__item menu__category-icon" data-src="<?=$arSection['PICTURE']['SRC']?>">
						<div class="menu__category">
							<div class="menu__category-title" data-menu-target="subcategory-<?=$arSection1['ID']?>"><? echo $arSection1["NAME"];?></div>
							
							<?if( is_array($arResult['SECTIONS_TREE_2'][$arSection1['ID']]) && count($arResult['SECTIONS_TREE_2'][$arSection1['ID']])>0 ):?>
								<?foreach( $arResult['SECTIONS_TREE_2'][$arSection1['ID']] as $key2=>$arSection2 ):?>
								<a class="menu__category-subtitle" href="<? echo $arSection2["SECTION_PAGE_URL"];?>"><? echo $arSection2["NAME"];?></a>
								
								<?
								if( $key2 >= 5 ){
									break;
								}
								?>
								<?endforeach;?>
							<?endif;?>
							
							<?if( intval($arResult['SUB_SECTIONS_NUM'][$arSection1['ID']]["COUNT"]) > 6 ):?>
							<div class="menu__category-more-link qweqwe" data-menu-target="subcategory-<?=$arSection1['ID']?>">
								Еще <? echo ( intval($arResult['SUB_SECTIONS_NUM'][$arSection1['ID']]["COUNT"]) - 6); ?>
							</div>
							<?endif;?>
							
							<div class="menu__mobile-desc" data-menu-target="subcategory-<?=$arSection1['ID']?>">
								<? echo $arSection1["NAME"];?>
								
								<?if( intval($arResult['SUB_SECTIONS_NUM'][$arSection1['ID']]["COUNT"]) > 6 ):?>
								Еще <? echo ( intval($arResult['SUB_SECTIONS_NUM'][$arSection1['ID']]["COUNT"]) - 6); ?>
								<?endif;?>
					
								<div class="menu__mobile-button" data-menu-target="subcategory-<?=$arSection1['ID']?>">
									<svg class="menu__mobile-button-icon">
									<use xlink:href="<?=SITE_TEMPLATE_PATH?>/ts/images/icons/icons-sprite.svg#arrow"></use>
									</svg>
								</div>
							</div>
						</div>
					</div>
					<?endforeach;?>
				<?endif;?>

				</div>
			</div>
			<?endif;?>

		<?
	}
	
	
	
	foreach ($arResult['SECTIONS'] as $key=>&$arSection1)
	{
	?>
		<?if( $arSection1['DEPTH_LEVEL'] == "2" ):?>
		<div class="menu__block preload preload--not-ready" data-menu-name="subcategory-<?=$arSection1['ID']?>">
			<div class="menu__inner">
				<div class="menu__inner-back-link" data-menu-target="main">Каталог</div>
				<svg class="menu__inner-separator">
					<use xlink:href="<?=SITE_TEMPLATE_PATH?>/ts/images/icons/icons-sprite.svg#arrow"></use>
				</svg>
				<div class="menu__inner-back-link" data-menu-target="category-<?=$arResult['SECTIONS_TREE_MAIN'][$arSection1['IBLOCK_SECTION_ID']]['ID']?>"><?=$arResult['SECTIONS_TREE_MAIN'][$arSection1['IBLOCK_SECTION_ID']]['NAME']?></div>
				<svg class="menu__inner-separator">
					<use xlink:href="<?=SITE_TEMPLATE_PATH?>/ts/images/icons/icons-sprite.svg#arrow"></use>
				</svg>
				<div class="menu__inner-name"><?=$arSection1['NAME']?></div>
			</div>
			<div class="menu__items">
			
			<?if( is_array($arResult['SECTIONS_TREE_2'][$arSection1['ID']]) && count($arResult['SECTIONS_TREE_2'][$arSection1['ID']])>0 ):?>
				<?foreach( $arResult['SECTIONS_TREE_2'][$arSection1['ID']] as $key2=>$arSubSection ):?>
				
					<?if( $key2 == 0 || $key2%4 == 0 ):?>
					<div class="menu__category-item">
						<div class="menu__category-icon"></div>
						<div class="menu__category">
					<?endif;?>
					
						<a class="menu__category-subtitle menu__category-subtitle--mobile" href="<? echo $arSubSection["SECTION_PAGE_URL"];?>">
							<?=$arSubSection['NAME']?>
						</a>
						
					<?if( ($key2+1)%4 == 0 || !isset($arResult['SECTIONS_TREE_2'][$arSection1['ID']][$key2+1]['ID']) ):?>
						</div>
					</div>
					<?endif;?>
					
				<?endforeach;?>
			<?endif;?>
				
			</div>
		</div>
		<?endif;?>
	<?
	}
	
}
?>
