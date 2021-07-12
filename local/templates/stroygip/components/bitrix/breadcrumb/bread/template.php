<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '';

//we can't use $APPLICATION->SetAdditionalCSS() here because we are inside the buffered function GetNavChain()
$strReturn .= '<div class="breadcrumb">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	$arrow = ($index > 0? '<div class="breadcrumbs__separator"></div>' : '');

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= '<a class="breadcrumb__item" href="'.$arResult[$index]["LINK"].'">'.$title.'</a>
		<svg class="breadcrumb__separator">
            <use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#arrow"></use>
        </svg>';
	}
	else
	{
        $strReturn .= '<div class="breadcrumb__item breadcrumb__item--active">'.$title.'</div>';
	}
}

$strReturn .= '</div>';

return $strReturn;
