<?
include_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/urlrewrite.php');

$actual_link = explode("/", $_SERVER["REQUEST_URI"]);
end($actual_link);
$element_code = prev($actual_link); 

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404", "Y");

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$new_element_link = "";
if( isset($element_code) && strlen($element_code)>3 ){
	$arNLESelect = Array("ID", "IBLOCK_ID", "CODE", "DETAIL_PAGE_URL");
	$arNLEFilter = Array("IBLOCK_ID"=>1, "CODE"=>$element_code );
	$resNL_Element = CIBlockElement::GetList(Array(), $arNLEFilter, false, Array("nPageSize"=>1), $arNLESelect);
	while($obNLE = $resNL_Element->GetNextElement()){ 
		$arNLEFields = $obNLE->GetFields();  
		$new_element_link = $arNLEFields["DETAIL_PAGE_URL"];
	}
}

if( strlen($new_element_link)>0 ){
	LocalRedirect( $new_element_link, false, "301 Moved permanently");
}

$APPLICATION->SetTitle("404 Not Found");
?>

	
	<div class="error">
		<div class="error__title">
			404! <br>
			Ой, похоже такой страницы нет.
		</div>
		<div class="error__text">
			Но у нас есть интересные предложения для вас. <br>
			Вернитесь на главную страницу или перейдите в каталог для поиска нужного товара.
		</div>
		<a class="error__link" href="/catalog/">В каталог
			<div class="error__link-arrow"></div>
		</a>
		<div class="error__image-box">
			<img class="error__image" src="<?=SITE_TEMPLATE_PATH?>/assets/src/blocks/error/assets/img/404.png">
		</div>
	</div>
<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>