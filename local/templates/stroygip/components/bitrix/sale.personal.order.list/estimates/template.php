<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
require_once ($_SERVER["DOCUMENT_ROOT"] . '/local/include/phpexcel/PHPExcel.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/local/include/phpexcel/PHPExcel/Writer/Excel2007.php');
use Bitrix\Main,
	Bitrix\Main\Localization\Loc,
	Bitrix\Main\Page\Asset;


Loc::loadMessages(__FILE__);

?>
<section class="section section--gray">
	<div class="layout">
		<div class="breadcrumb">
			<a class="breadcrumb__item" href="/">Главная</a>
			<svg class="breadcrumb__separator">
				<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#arrow"></use>
			</svg>
			<a class="breadcrumb__item" href="/personal/credentials/">Профиль</a>
			<svg class="breadcrumb__separator">
				<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#arrow"></use>
			</svg>
			<div class="breadcrumb__item breadcrumb__item--active">Сметы</div>
		</div>
		
		<div class="account">
			<div class="account__header">
				<div class="account__header-nav">
					<div class="account__header-nav-button account__header-nav-button--prev">
						<svg class="account__header-nav-button-icon">
							<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#arrow"></use>
						</svg>
					</div>
					<div class="account__header-nav-button account__header-nav-button--next">
						<svg class="account__header-nav-button-icon">
							<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#arrow"></use>
						</svg>
					</div>
				</div>
				<div class="account__header-buttons">
					<a href="/personal/credentials/" class="account__header-button">
						<div class="account__header-button-inner">
							<svg class="account__header-button-icon">
								<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#user"></use>
							</svg>
							<div class="account__header-button-text">Личные данные</div>
						</div>
					</a>
					<a href="/personal/orders/" class="account__header-button">
						<div class="account__header-button-inner">
							<svg class="account__header-button-icon">
								<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#order"></use>
							</svg>
							<div class="account__header-button-text">Мои заказы</div>
						</div>
					</a>
					<a href="/personal/viewed/" class="account__header-button">
						<div class="account__header-button-inner">
							<svg class="account__header-button-icon">
								<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#eye"></use>
							</svg>
							<div class="account__header-button-text">Просмотренные товары</div>
						</div>
					</a>
					<a href="/personal/estimates/" class="account__header-button account__header-button--active">
						<div class="account__header-button-inner">
							<svg class="account__header-button-icon">
								<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#outlay"></use>
							</svg>
							<div class="account__header-button-text">Сметы</div>
						</div>
					</a>
				</div>
			</div>
				
			<div class="account__block">
				<div class="account__outlay-items">
				
					<?foreach( $arResult['ORDERS'] as $key=>$order ){?>
					<div class="account__outlay-item">
						<img class="account__outlay-item-icon" src="/local/templates/stroygip/ts/images/icons/xls.svg">
						<div class="account__outlay-item-name">
							Смета #<?=$order['ORDER']['ID'];?> от <?=FormatDate('d F Y', strtotime($order['ORDER']['DATE_INSERT']->toString()));?> 
							(
							<?
							$basket_items_number = intval( count($order['BASKET_ITEMS']) );
							echo $basket_items_number;
							if( $basket_items_number <= 1 ){
								echo " товар";
							}elseif( $basket_items_number > 1 &&  $basket_items_number < 5 ){
								echo " товара";
							}else{
								echo " товаров";
							}
							?> 
							)
							</div>
						<div class="account__outlay-item-buttons">
							<form id="smeta_form_<?=$order['ORDER']['ID'];?>" action="/local/include/estimate_download.php" method="POST" class="account__outlay-item-button">
								<svg class="account__outlay-item-button-icon">
									<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#download"></use>
								</svg>
								<div class="personal-area__estimate-file account__outlay-item-button-text" data-id="" onclick="document.getElementById('smeta_form_<?=$order['ORDER']['ID'];?>').submit();">Скачать</div>
								<input type="hidden" name="estimate" value="<?=$order['ORDER']['ID'];?>">
								<input type="hidden" name="order_id" value="<?=$order['ORDER']['ID'];?>">
							</form>
							<div class="account__outlay-item-button account__outlay-item-button--del">
								<svg class="account__outlay-item-button-icon">
									<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#close"></use>
								</svg>
								<div class="account__outlay-item-button-text">Удалить</div>
							</div>
						</div>
					</div>
					<?}?>

				</div>
			</div>
		</div>
	</div>
</section>
