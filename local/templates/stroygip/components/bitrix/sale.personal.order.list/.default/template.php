<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main,
	Bitrix\Main\Localization\Loc,
	Bitrix\Main\Page\Asset;


Loc::loadMessages(__FILE__);

$statuses = [
		'W' => 'В работе',
		'N' => 'Ожидают оплаты',
		'F' => 'Полученные',
		'CN' => 'Отменённые',
];

?>

<section class="section section--min-content section--gray">
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
			<div class="breadcrumb__item breadcrumb__item--active">Мои заказы</div>
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
					<a href="#" class="account__header-button">
						<div class="account__header-button-inner">
							<svg class="account__header-button-icon">
								<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#user"></use>
							</svg>
							<div class="account__header-button-text">Личные данные</div>
						</div>
					</a>
					<a href="/personal/orders/" class="account__header-button account__header-button--active">
						<div class="account__header-button-inner">
							<svg class="account__header-button-icon">
								<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#order"></use>
							</svg>
							<div class="account__header-button-text">Мои заказы</div>
						</div>
					</a>
					<a href="#" class="account__header-button">
						<div class="account__header-button-inner">
							<svg class="account__header-button-icon">
								<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#eye"></use>
							</svg>
							<div class="account__header-button-text">Просмотренные товары</div>
						</div>
					</a>
					<a href="#" class="account__header-button">
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
				<div class="account__order-types">
					<a class="account__order-type <?if (!$arParams['STATUS']){?>account__order-type--active<?}?>" href="/personal/orders/">Все</a>
					<?foreach($statuses as $statusKey => $name):?>
					<a class="account__order-type <?if ($arParams['STATUS'] == $statusKey){?>account__order-type--active<?}?>" href="/personal/orders/?status=<?=$statusKey;?>"><?=$name?></a>
					<?endforeach;?>
				</div>
				
				<?foreach( $arResult['NEW_ORDERS'] as $key=>$order ){?>
				<div class="account__order">
					<div class="account__order-header">
						<div class="account__order-header-info">
							<div class="account__order-header-info-text">Заказ #<?=$order['ORDER']['ID']?> от <?=FormatDate('d F Y', strtotime($order['ORDER']['DATE_INSERT']->toString()));?>,</div>
							<div class="account__order-header-info-price"><?=$order['ORDER']['FORMATED_PRICE'];?></div>
						</div>
						<div class="account__order-header-status account__order-header-status--<?if($order['ORDER']['STATUS_ID'] == "F"):?>green<?else:?>yellow<?endif;?>">
							<?=$arResult['INFO']['STATUS'][$order['ORDER']['STATUS_ID']]['NAME'];?>
						</div>
						<div class="account__order-header-buttons">
							<div class="account__order-header-button account__order-header-button--history">
								<div class="account__order-header-button-text">История заказа</div>
								<svg class="account__order-header-button-icon">
									<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#history"></use>
								</svg>
								<div class="account__order-history">
									<div class="account__order-history-close">
										<svg class="account__order-history-close-icon">
											<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#close"></use>
										</svg>
									</div>
									<?foreach ($arResult['ORDERS_PROPS'][$order['ORDER']['ID']]['PATH'] as $pathItem) {?>
									<div class="account__order-history-item">
										<div class="account__order-history-item-date"><?=$pathItem['NAME'];?></div>
										<div class="account__order-history-item-text"><?=$pathItem['DATE'];?></div>
									</div>
									<?}?>
								</div>
							</div>
							<div class="account__order-header-button account__order-header-button--toggle">
								<div class="account__order-header-button-text">Детали заказа</div>
								<svg class="account__order-header-button-icon">
									<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#arrow-bottom"></use>
								</svg>
							</div>
						</div>
					</div>
					
					<div class="account__order-items">
						<?
						$basketItemsPrice = 0;
						foreach( $order['BASKET_ITEMS'] as $arItem ) {
							$basketItemsPrice += $arItem['PRICE'];
							if( strlen($arItem['PRODUCT_ID']['PREVIEW_PICTURE'])>0 ){
								$picture = CFile::ResizeImageGet($arResult['BASKET_ITEMS'][$arItem['PRODUCT_ID']]['PREVIEW_PICTURE'], ['width' => 136, 'height' => 120], BX_RESIZE_IMAGE_EXACT)['src'];
							}else{
								$picture = "/local/templates/stroygip/img/no-image.png";
							}
						?>
						<div class="account__order-item <?/*account__order-item--disabled*/?>">
							<div class="account__order-item-img-wrapper">
								<img class="account__order-item-img" src="<?=$picture;?>">
							</div>
							<div class="account__order-item-desc">
								<div class="account__order-item-desc-title">
									<a class="account__order-item-desc-title-item" href="<?=$arItem['DETAIL_PAGE_URL'];?>"><?=$arItem['NAME'];?></a>
									<div class="account__order-item-desc-title-count">
										<div class="account__order-item-desc-title-count-text">На складе:</div>
										<div class="account__order-item-desc-title-count-number"><?=$arResult['BASKET_ITEMS'][$arItem['PRODUCT_ID']]['QUANTITY']?> шт.</div>
									</div>
								</div>
								<div class="account__order-item-desc-price">
									<div class="account__order-item-desc-price-number"><?=number_format((float)$arItem['PRICE'], 2, '.', ' ');?></div>
									<div class="account__order-item-desc-price-currency">сом</div>
								</div>
							</div>
						</div>
						<?}?>
					</div>
					
					<div class="account__order-footer">
						<div class="account__order-footer-items">
							<div class="account__order-footer-item">
								<div class="account__order-footer-item-title">Получатель:</div>
								<div class="account__order-footer-item-row"><?=$arResult['USER']['FULL_NAME'];?></div>
								<div class="account__order-footer-item-row"><?=$arResult['USER']['PHONE']?></div>
								<div class="account__order-footer-item-row"><?=$arResult['USER']['EMAIL'];?></div>
							</div>
							<div class="account__order-footer-item">
								<div class="account__order-footer-item-title">Доставка:</div>
								<div class="account__order-footer-item-row">Способ доставки: <?=$order['SHIPMENT'][0]['DELIVERY_NAME']?></div>
								<div class="account__order-footer-item-row">Адрес: <?=$arResult['ORDERS_PROPS'][$order['ORDER']['ID']]['ADDRESS'];?></div>
							</div>
							<div class="account__order-footer-item">
								<div class="account__order-footer-item-title">Оплата:</div>
								<div class="account__order-footer-item-row"><?=$order['PAYMENT'][0]['PAY_SYSTEM_NAME'];?></div>
								<div class="account__order-footer-item-row">Сумма: <?=$order['ORDER']['FORMATED_PRICE'];?></div>
							</div>
							<div class="account__order-footer-item">
								<div class="account__order-footer-button">
									<svg class="account__order-footer-button-icon">
										<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#repeat"></use>
									</svg>
									<a class="account__order-footer-button-text" href="/order/?ID=<?=$order['ORDER']['ID']?>_ORDER=Y">Повторить заказ</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?}?>
				
				<?if( strlen($arResult["NAV_STRING"]) > 0 && count($arResult['NEW_ORDERS'])>$arParams['ORDERS_PER_PAGE'] ){?>
				<div class="personal-area__pagination">
					<?=$arResult["NAV_STRING"];?>
				</div>
				<?}?>
		
			</div>
		</div>
	</div>
</section>
