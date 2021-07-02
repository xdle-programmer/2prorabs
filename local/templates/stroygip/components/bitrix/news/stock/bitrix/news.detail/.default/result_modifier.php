<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;

$cp = $this->__component; // объект компонента

if (is_object($cp))
{
    $cp->arResult['OTHER_SHARES'] = $arResult['PROPERTIES']['OTHER_SHARES']['VALUE'];
    $cp->SetResultCacheKeys(array('OTHER_SHARES'));
}

?>