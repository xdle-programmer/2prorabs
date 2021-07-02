<?
include_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404", "Y");

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

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