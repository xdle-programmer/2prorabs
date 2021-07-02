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

<div class="footer__menu-list">
<?
if (0 < $arResult["SECTIONS_COUNT"])
{
	foreach ($arResult['SECTIONS'] as &$arSection)
	{
	?>
		<a class="footer__menu-link" href="<? echo $arSection['SECTION_PAGE_URL']; ?>">
			<? echo $arSection['NAME']; ?>
		</a>
	<?
	}
}
?>
</div>