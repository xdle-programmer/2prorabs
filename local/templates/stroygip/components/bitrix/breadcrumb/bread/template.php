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
$strReturn .= '<div class="breadcrumbs"><div class="breadcrumbs__inner">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	$arrow = ($index > 0? '<div class="breadcrumbs__separator"></div>' : '');

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= $arrow.'<a class="breadcrumbs__link" href="'.$arResult[$index]["LINK"].'">'.$title.'</a>';
	}
	else
	{
        $strReturn .= $arrow.'<a class="breadcrumbs__link active" href="'.$arResult[$index]["LINK"].'">'.$title.'</a>';
	}
}

$strReturn .= '</div></div>';

return $strReturn;
