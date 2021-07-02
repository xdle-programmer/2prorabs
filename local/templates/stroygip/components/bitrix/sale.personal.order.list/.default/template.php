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

	<div class="personal-area__block">
	<div class="personal-area__block-inner">
	<div class="personal-area__block-title">Здесь хранится история ваших заказов.</div>
	<div class="personal-area__text personal-area__text--mb">Вы можете просмотреть их, распечатать чек и повторить.</div>
	<div class="personal-area__list-box">
	<div class="personal-area__tabs">
		<a href="/personal/orders/" class="personal-area__tab <?if (!$arParams['STATUS']){?>personal-area__tab--active<?}?>">Все</a>
		<?foreach ($statuses as $statusKey => $name) {?>
		<a class="personal-area__tab <?if ($arParams['STATUS'] == $statusKey){?>personal-area__tab--active<?}?>" href="/personal/orders/?status=<?= $statusKey;?>"><?= $name;?></a>
		<?}?>
	</div>
	<div class="personal-area__select-box">
		<fieldset>
			<select name="speed" id="selectArea">
				<option selected="selected" disabled>Сначала новые</option>
				<option>Option 1</option>
				<option>Option 2</option>
			</select>
		</fieldset>
	</div>
<?
if (!empty($arResult['ERRORS']['FATAL']))
{
	foreach($arResult['ERRORS']['FATAL'] as $error)
	{
		ShowError($error);
	}
	$component = $this->__component;
	if ($arParams['AUTH_FORM_IN_TEMPLATE'] && isset($arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED]))
	{
		$APPLICATION->AuthForm('', false, false, 'N', false);
	}

}
else
{
	if (!empty($arResult['ERRORS']['NONFATAL']))
	{
		foreach($arResult['ERRORS']['NONFATAL'] as $error)
		{
			ShowError($error);
		}
	}
	if (!count($arResult['NEW_ORDERS']))
	{
		if ($_REQUEST["filter_history"] == 'Y')
		{
			if ($_REQUEST["show_canceled"] == 'Y')
			{
				?>
				<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_CANCELED_ORDER')?></h3>
				<?
			}
			else
			{
				?>
				<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_HISTORY_ORDER_LIST')?></h3>
				<?
			}
		}
		else
		{
			?>
			<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_ORDER_LIST')?></h3>
			<?
		}
	}

	?>
				<div class="personal-area__list">
					<?

					foreach ($arResult['NEW_ORDERS'] as $order) {
						?>
						<!--<pre><?/*var_dump($order);*/?></pre>-->
					<div class="personal-area__list-item nsOrderItem">
						<div class="personal-area__list-header">
							<div class="personal-area__list-header-box">
								<div class="personal-area__list-order-date">Заказ от <?= FormatDate('d F Y', strtotime($order['ORDER']['DATE_INSERT']->toString()));?></div>
								<div class="personal-area__list-header-text">
									<div class="personal-area__list-header-status"></div><?= $arResult['INFO']['STATUS'][$order['ORDER']['STATUS_ID']]['NAME'];?>
								</div>
							</div>
							<div class="personal-area__list-header-detail">Детали заказа
								<div class="personal-area__list-detail-arrow"></div>
							</div>
						</div>
						<div class="personal-area__list-inner">
							<?if ($arResult['ORDERS_PROPS'][$order['ORDER']['ID']]['PATH']) {?>
							<div class="personal-area__history">
								<div class="personal-area__history-icon"></div>История заказа
								<div class="personal-area__history-list">
									<div class="personal-area__history-list-title">История заказа</div>
									<?foreach ($arResult['ORDERS_PROPS'][$order['ORDER']['ID']]['PATH'] as $pathItem) {?>
									<div class="personal-area__history-list-info">
										<div class="personal-area__history-notification"><img class="personal-area__history-notification-icon" src="<?= SITE_TEMPLATE_PATH;?>/assets/src/blocks/personal-area/assets/img/check-2.svg"></div>
										<div class="personal-area__history-status">
											<div class="personal-area__history-status-title"><?= $pathItem['NAME'];?></div>
											<div class="personal-area__history-status-text"><?= $pathItem['INFO'];?></div>
										</div>
										<div class="personal-area__history-date"><?= $pathItem['DATE'];?></div>
									</div>
									<?}?>

									<!--<div class="personal-area__history-list-info personal-area__history-list-info--disable">
										<div class="personal-area__history-notification"><img class="personal-area__history-notification-icon" src="../../src/blocks/personal-area/assets/img/check-2.svg"></div>
										<div class="personal-area__history-status">
											<div class="personal-area__history-status-title">Получено</div>
											<div class="personal-area__history-status-text">Оставьте отзыв о товарах</div>
										</div>
										<div class="personal-area__history-date">24.05.2020  13:05</div>
									</div>-->
								</div>
							</div>
							<?}?>
							<div class="personal-area__list-row">
								<?if ($arResult['ORDERS_PROPS'][$order['ORDER']['ID']]['DELIVERY_DATE']) {?>
								<div class="personal-area__list-container">
									<div class="personal-area__list-title">Дата доставки:</div>
									<div class="personal-area__list-text"><?= $arResult['ORDERS_PROPS'][$order['ORDER']['ID']]['DELIVERY_DATE'];?></div>
								</div>
								<?}?>
								<div class="personal-area__list-container">
									<div class="personal-area__list-title">Номер заказа:</div>
									<div class="personal-area__list-text">№ <?= $order['ORDER']['ID'];?></div>
								</div>
								<div class="personal-area__list-container">
									<div class="personal-area__list-title">Сумма:</div>
									<div class="personal-area__list-text"><?= $order['ORDER']['FORMATED_PRICE'];?></div>
								</div>
								<?if ($arResult['ORDERS_PROPS'][$order['ORDER']['ID']]['BONUSES']) {?>
								<div class="personal-area__list-container">
									<div class="personal-area__list-title">Начислено баллов:</div>
									<div class="personal-area__list-text"><?= $arResult['ORDERS_PROPS'][$order['ORDER']['ID']]['BONUSES'];?></div>
								</div>
								<?}?>
							</div>
							<div class="personal-area__history-box">
								<div class="personal-area__history-items-container">
									<?
									$basketItemsPrice = 0;
									foreach ($order['BASKET_ITEMS'] as $arItem) {
										$basketItemsPrice += $arItem['PRICE'];
										$picture = CFile::ResizeImageGet($arResult['BASKET_ITEMS'][$arItem['PRODUCT_ID']]['PREVIEW_PICTURE'],
										            ['width' => 136, 'height' => 120],
										            BX_RESIZE_IMAGE_EXACT
										        )['src'];

										if (in_array($arItem['PRODUCT_ID'], $arParams['FAVORITES'])) {
											$fav_act = 'compfavdelete';
											$fav_class = 'compfavactive';
                                        } else {
                                            $fav_act = 'compfav';
                                            $fav_class = '';
                                        }
                                        if (in_array($arItem['PRODUCT_ID'], $arParams['COMPARE'])) {
                                            $com_act = 'compfavdelete';
                                            $com_class = 'compfavactive';
                                        } else {
                                            $com_act = 'compfav';
                                            $com_class = '';
                                        }
										?>
									<div class="personal-area__history-item">
										<?if ($picture) {?>
										<a class="personal-area__history-image-box" href="<?= $arItem['DETAIL_PAGE_URL'];?>">
											<img class="personal-area__history-img" src="<?= $picture;?>">
										</a>
										<?}?>
										<div class="personal-area__history-item-about"><a class="personal-area__history-item-name" href="<?= $arItem['DETAIL_PAGE_URL'];?>"><?= $arItem['NAME'];?></a>
											<?if ($arResult['BASKET_ITEMS'][$arItem['PRODUCT_ID']]['PROPERTY_ART_NUMBER_VALUE']) {?>
											<div class="personal-area__history-item-article">Артикул: <?= $arResult['BASKET_ITEMS'][$arItem['PRODUCT_ID']]['PROPERTY_ART_NUMBER_VALUE'];?></div>
											<?}?>
											<div class="personal-area__history-item-icons">
												<a class="personal-area__history-item-icon personal-area__history-item-icon--favourites <?= $fav_class;?>" href="javascript:void(0)" data-action="<?= $fav_act;?>" data-add="FAVORITES" data-id="<?= $arItem['PRODUCT_ID'];?>"></a>
												<a class="personal-area__history-item-icon personal-area__history-item-icon--comparison <?= $com_class;?>" href="javascript:void(0)" data-action="<?= $com_act;?>" data-add="COMPARE" data-id="<?= $arItem['PRODUCT_ID'];?>"></a>
												<a class="personal-area__history-item-icon personal-area__history-item-icon--basket" href="javascript:void(0)" data-action="add2basket" data-id="<?= $arItem['PRODUCT_ID'];?>"></a>
											</div>
										</div>
										<div class="personal-area__history-name-box">
											<div class="personal-area__history-item-name"><?= $arItem['QUANTITY'];?> <?= $arItem['MEASURE_TEXT'];?></div>
										</div>
										<div class="personal-area__history-name-box">
											<div class="personal-area__history-item-name"><?= number_format((float)$arItem['PRICE'], 2, '.', ' ')?> Сом</div>
										</div>
									</div>
									<?}?>
								</div>
								<div class="personal-area__info">
									<div class="personal-area__info-col">
										<div class="personal-area__info-title">Получатель:</div>
										<div class="personal-area__info-text">
											<?= $arResult['USER']['FULL_NAME'];?>
											<?if ($arResult['USER']['PHONE']) {?>
											<br>
											<?= $arResult['USER']['PHONE']?>
											<?}?>
                                            <?if ($arResult['USER']['EMAIL']) {?>
											<br>
											<?= $arResult['USER']['EMAIL'];?>
                                            <?}?>
										</div>
									</div>
									<div class="personal-area__info-col">
										<div class="personal-area__info-title">Доставка:</div>
										<div class="personal-area__info-text">Способ доставки: <?= $order['SHIPMENT'][0]['DELIVERY_NAME']?></div>
										<?if ($arResult['ORDERS_PROPS'][$order['ORDER']['ID']]['DELIVERY_DATE']) {?>
										<div class="personal-area__info-text">Дата и время: <?= $arResult['ORDERS_PROPS'][$order['ORDER']['ID']]['DELIVERY_DATE'];?></div>
										<?}?>
										<div class="personal-area__info-text">Адрес: <?= $arResult['ORDERS_PROPS'][$order['ORDER']['ID']]['ADDRESS'];?></div>
									</div>
									<div class="personal-area__info-col">
										<div class="personal-area__info-title">Оплата:</div>
										<div class="personal-area__info-text"><?= $order['PAYMENT'][0]['PAY_SYSTEM_NAME'];?></div>
										<div class="personal-area__info-text">Товары: <?= CurrencyFormat($basketItemsPrice, "SOM");?></div>
										<div class="personal-area__info-text">Доставка: <?= $order['SHIPMENT'][0]['FORMATED_DELIVERY_PRICE'];?></div>
										<div class="personal-area__info-text personal-area__info-text--bold">Итого: <?= $order['ORDER']['FORMATED_PRICE'];?></div>
									</div>
								</div>
								<div class="personal-area__info-buttons nsDisplayNone">
									<a class="button button--white-small personal-area__info-button" href="/order/?ID=<?= $order['ORDER']['ID']?>_ORDER=Y">Повторить заказ</a>
									<a class="personal-area__print-button nsOrderPrint" href="javascript:void(0)">
										<div class="personal-area__print-icon"></div>Распечатать</a>
                                </div>
							</div>
						</div>
					</div>
					<?}?>
				</div>
			</div>
		</div>
		<?if (strlen($arResult["NAV_STRING"]) > 0 && count($arResult['NEW_ORDERS'])>$arParams['ORDERS_PER_PAGE']){?>
			<div class="personal-area__pagination">
				<?= $arResult["NAV_STRING"];?>
			</div>
		<?}?>
	</div>



	<?
}
	?>