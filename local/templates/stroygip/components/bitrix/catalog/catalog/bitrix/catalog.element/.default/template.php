<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Localization\Loc;
use Bitrix\Main\Grid\Declension;


/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */
$Declension = new Declension('отзыв', 'отзыва', 'отзывов');
$this->setFrameMode(true);

$arResult['MIN_PRICE']['DISCOUNT_VALUE'] = round($arResult['MIN_PRICE']['DISCOUNT_VALUE'], 0, PHP_ROUND_HALF_UP);
$arResult['MIN_PRICE']['VALUE'] = round($arResult['MIN_PRICE']['VALUE'], 0, PHP_ROUND_HALF_UP);
$price = $arResult['PROPERTIES']["OLD_PRICE"]['VALUE'] ?: $arResult['MIN_PRICE']["DISCOUNT_VALUE"];
$price_discount = $arResult['MIN_PRICE']["DISCOUNT_VALUE"];


if (in_array($arResult['ID'], $arParams['FAVORITES'])) {
    $fav_action = 'compfavdelete';
    $fav_act = ' compfavactive';
    $fav_text = ' Из избранного';
} else {
    $fav_action = 'compfav';
    $fav_text = ' В избранное';
    $fav_act = '';
}
if (in_array($arResult['ID'], $arParams['COMPARE'])) {
    $comp_action = 'compfavdelete';
    $comp_act = ' compfavactive';
    $comp_text = ' Из сравнения';
} else {
    $comp_action = 'compfav';
    $comp_text = ' В сравнение';
    $comp_act = '';
}

$shopDeclension = new Declension('магазине', 'магазинах', 'магазинах');

$hiddenProperties = [
    'BENEFITS',
    'BESTSELLER',
    'BEST_PRICE',
    'CODE',
    'GALLERY',
    'HIDDEN_1C',
    'MAIN',
    'MARK',
    'OLD_PRICE',
    'RECOMEND',
    'REF',
    'REVIEWS',
    'REVIEWS_CNT',
    'rating',
    'vote_count',
    'vote_sum',

    'ARTIKUL',
    'ART_NUMBER',
    'AVTOR',
    'BAZOVAYAEDINITSAIZMERENIYA',
    'BYE_WIDTH',
    'CHARS',
    'DATA',
    'FRACTIONAL_PRODUCT',
    'ITOG',
    'KATEGORIYANOMENKLATURYSAYTA',
    'KON_OST',
    'MENEDZHER',
    'NOMENKLATURA_OSNOVNAYA_EDI',
    'NOMENKLATURA_STRANA_PROIS',
    'NOMENKLATURA_TOVARNAYA_MAR',
    'OSNOVNAYAEDINITSAIZMERENIYA',
    'OSTATOK',
    'OTDEL',
    'PROIZVODITEL',
    'RATING2',
    'SHT',
    'SROKKHRANENIYATOVARA',
    'STAVKANDS',
    'TIPNOMENKLATURY',
    'TIP_TOVARA',
    'TSENA',
    'VIDNOMENKLATURY',
    'VESHAETSYANAKRYUCHOK',
    'ZAKRYTA',
    '_',
];

?>
<div class="product-page">
	<div class="product-page__main-product">
		<div class="product-page__main-product-mobile-title">
			<div class="product-page__title"><?=$arResult['NAME']?></div>
			<div class="product-page__code">Артикул: <?=$arResult['PROPERTIES']['ART_NUMBER']['VALUE']?></div>
		</div>
		<div class="product-page__preview-wrapper">
			<div class="product-page__preview">
				<div class="product-page__preview-header">
					<div class="product-page__rating-box">
						<div class="rating">
							<div class="rating__stars">
								<svg class="rating__star<?if( intval($arResult["REVIEWS_DATA_NUM"]["AVERAGE"]) > 0 ):?> rating__star--active<?endif;?>">
									<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
								</svg>
								<svg class="rating__star<?if( intval($arResult["REVIEWS_DATA_NUM"]["AVERAGE"]) > 1 ):?> rating__star--active<?endif;?>">
									<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
								</svg>
								<svg class="rating__star<?if( intval($arResult["REVIEWS_DATA_NUM"]["AVERAGE"]) > 2 ):?> rating__star--active<?endif;?>">
									<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
								</svg>
								<svg class="rating__star<?if( intval($arResult["REVIEWS_DATA_NUM"]["AVERAGE"]) > 3 ):?> rating__star--active<?endif;?>">
									<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
								</svg>
								<svg class="rating__star<?if( intval($arResult["REVIEWS_DATA_NUM"]["AVERAGE"]) > 4 ):?> rating__star--active<?endif;?>">
									<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
								</svg>
							</div>
							<div class="rating__text"><?\nav\UncachedArea::show('productReviewsCount')?></div>
						</div>
					</div>
					<div class="product-page__slider-wrapper">
						<div class="product-page__slider-nav">
							<div class="product-page__slider-nav-button product-page__slider-nav-button--prev">
								<svg class="product-page__slider-nav-button-icon product-page__slider-nav-button-icon--prev">
								<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#arrow"></use>
								</svg>
							</div>
							<div class="product-page__slider-nav-button product-page__slider-nav-button--next">
								<svg class="product-page__slider-nav-button-icon product-page__slider-nav-button-icon--next">
									<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#arrow"></use>
								</svg>
							</div>
						</div>
						<div class="product-page__slider-items">
						<?
						$images_string = "";
						$main_image_string = "";
						?>
						
						<?if( is_array($arResult["GALLERY"]) && count($arResult["GALLERY"])>0 ){?>
							<?foreach ($arResult["GALLERY"] as $key=>$photo):?>
								<?
								$images_string .= $photo['BIG'].",";
								if( $key == 0 ):
									$main_image_string = $photo['BIG'];
								endif;
								?>
								<div class="product-page__slider-item<?if( $key == 0 ):?> product-page__slider-item--active<?endif;?>" data-preview="<?=$photo['BIG']?>" data-active-number-target="<?echo $key;?>">
									<img class="product-page__slider-item-img" src="<?=$photo['THUMBNAIL']?>">
								</div>
							<?endforeach;?>
							<?$images_string = substr($images_string, 0, -1);?>
						<?
						}else{
							$main_image_string = SITE_TEMPLATE_PATH."/img/no-image.png";
							$images_string = $main_image_string;
						}
						?>
						</div>
					</div>
				</div>
				<div class="product-page__main-image-box">
					<img 
						class="product-page__main-image" 
						src="<?=$main_image_string?>" 
						data-active-number="0" 
						data-images-array="<?=$images_string?>"
					>
					
					<?if( $arResult['MIN_PRICE']["DISCOUNT_DIFF_PERCENT"] > 0 ){?>
					<div class="product-page__mark">
						<svg class="product-page__mark-icon">
							<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#sale"></use>
						</svg>
						<div class="product-page__mark-text">Скидка <?= $arResult['MIN_PRICE']["DISCOUNT_DIFF_PERCENT"]?>%</div>
					</div>
                    <?}?>
				</div>
			</div>
		</div>
		<div class="product-page__about">
			<div class="product-page__title product-page__title--mobile-hidden"><?=$arResult['NAME']?></div>
			<div class="product-page__code product-page__code--mobile-hidden">Артикул: <?=$arResult['PROPERTIES']['ART_NUMBER']['VALUE']?></div>
			<div class="product-page__buttons product-cart__buttons">
				<div class="product-cart__button product-cart__button--compare" onclick="catalogAction('COMPARE', <?=$arResult['ID']?>)" data-id="<?=$arResult['ID']?>">
					<svg class="product-cart__button-img product-cart__button-img--compare">
						<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#compare"></use>
					</svg>
				</div>
				<div class="product-cart__button product-cart__button--favorite" onclick="catalogAction('FAVORITES', <?=$arResult['ID']?>)" data-id="<?=$arResult['ID']?>" data-action="FAVORITES">
					<svg class="product-cart__button-img product-cart__button-img--favorite">
						<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#favorite"></use>
					</svg>
				</div>
			</div>
			<div class="product-page__price-block">
				<div class="product-page__price-block-item">
					<div class="product-page__price-number">
					<? if ($arResult['MIN_PRICE']["DISCOUNT_DIFF"] > 0) { ?>
						<?=$arResult['MIN_PRICE']["DISCOUNT_VALUE"]?>
					<? } else { ?>
						<?=$arResult['MIN_PRICE']["VALUE"]?>
					<? } ?>
					</div>
					<div class="product-page__price-currency">сом/шт.</div>
				</div>
				<div class="product-page__price-block-count">
					<div class="product-page__counter" data-counter-max="<?=$arResult["PRODUCT"]["QUANTITY"]?>" data-price="<?echo ( $arResult['MIN_PRICE']["DISCOUNT_DIFF"] > 0 ? intval($arResult['MIN_PRICE']["DISCOUNT_VALUE"]) : intval($arResult['MIN_PRICE']["VALUE"]) );?>">
						<div class="product-page__counter-button product-page__counter-button--minus"></div>
						<div class="product-page__counter-value" id="item_<?=$arResult['ID']?>_qnt">1</div>
						<div class="product-page__counter-button product-page__counter-button--plus"></div>
					</div>
					<div class="product-page__price-block-count-price">
						<div class="product-page__price-block-count-price-number">
						<? if ($arResult['MIN_PRICE']["DISCOUNT_DIFF"] > 0) { ?>
							<?= $arResult['MIN_PRICE']["DISCOUNT_VALUE"] ?>
						<? } else { ?>
							<?= $arResult['MIN_PRICE']["VALUE"] ?>
						<? } ?>
						</div>
						<div class="product-page__price-block-count-price-currency">сом</div>
					</div>
				</div>
			</div>
			<div class="product-page__buy-buttons">
				<div class="product-page__buy-button product-page__buy-button--main button product-cart__button--basket" onclick="catalogAction('add2basket', <?=$arResult['ID']?>)" data-id="<?=$arResult['ID']?>" data-action="add2basket">В корзину</div>
				<div class="product-page__buy-button product-page__buy-button--natural button" data-modal-open="fastOrderModal">Быстрый заказ</div>
			</div>
			<div class="product-page__delivery">
				<div class="product-page__delivery-store">
				<?if( intval($arResult["PRODUCT"]["QUANTITY"]) > 0 ):?>
					В наличии <?=$arResult["PRODUCT"]["QUANTITY"]?> шт.
				<?else:?>
					Нет в наличии
				<?endif;?>
				</div>
			</div>
			<div class="product-page__delivery-price">
				<svg class="product-page__delivery-price-icon">
					<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#delivery"></use>
				</svg>
				<div class="product-page__delivery-price-text">Доставка по городу: от 120 Сом, доставка ежедневно с 09:00 до 21:00</div>
			</div>
			<div class="product-page__delivery-price">
				<svg class="product-page__delivery-price-icon">
					<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#info"></use>
				</svg>
				<div class="product-page__delivery-price-text">Внешний вид товара может отличаться от фотографии.</div>
			</div>
		</div>
	</div>
	
	<div class="product-page__desc">
		<div class="product-page__desc-item">
			<div class="product-page__desc-item-title">Описание и характеристики</div>
			<div class="product-page__desc-item-desc">
				<div class="product-page__desc-item-desc-text">
				<?=$arResult['DETAIL_TEXT'];?>
				</div>
				<div class="product-page__desc-item-characteristics">
					<? if ($arResult["PROPERTIES"]['COLOR']['VALUE']) { ?>
					<div class="product-page__desc-item-characteristics-item">
						<div class="product-page__desc-item-characteristics-item-name">Цвет</div>
						<div class="product-page__desc-item-characteristics-item-value"><?=$arResult["PROPERTIES"]['COLOR']['VALUE']?></div>
					</div>
					<? } ?>

					<? foreach ($arResult['PROPERTIES'] as $property): ?>
						<?
						if (in_array($property['CODE'], $hiddenProperties)) {
							continue;
						}

						if (empty($property['VALUE'])) {
							continue;
						}

						if (!empty($property['LINK_ELEMENT_VALUE'])) {
							$value = reset($property['LINK_ELEMENT_VALUE']);
							$value = $value['NAME'];
						} else {
							$value = $property['VALUE'];
						}
						?>
						<div class="product-page__desc-item-characteristics-item">
							<div class="product-page__desc-item-characteristics-item-name"><?=$property['NAME']?></div>
							<div class="product-page__desc-item-characteristics-item-value"><?=$value?></div>
						</div>
					<? endforeach; ?>

				</div>
			</div>
		</div>
		<div class="product-page__desc-item">
			<div class="product-page__desc-item-title">Отзывы</div>
			<div class="product-page__desc-item-desc">
				<div class="product-page__desc-reviews">
					<div class="product-page__desc-reviews-subtitle">Средняя оценка</div>
					<div class="product-page__desc-reviews-item">
						<div class="rating">
							<div class="rating__stars">
								<svg class="rating__star<?if( intval($arResult["REVIEWS_DATA_NUM"]["AVERAGE"]) > 0 ):?> rating__star--active<?endif;?>">
									<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
								</svg>
								<svg class="rating__star<?if( intval($arResult["REVIEWS_DATA_NUM"]["AVERAGE"]) > 1 ):?> rating__star--active<?endif;?>">
									<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
								</svg>
								<svg class="rating__star<?if( intval($arResult["REVIEWS_DATA_NUM"]["AVERAGE"]) > 2 ):?> rating__star--active<?endif;?>">
									<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
								</svg>
								<svg class="rating__star<?if( intval($arResult["REVIEWS_DATA_NUM"]["AVERAGE"]) > 3 ):?> rating__star--active<?endif;?>">
									<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
								</svg>
								<svg class="rating__star<?if( intval($arResult["REVIEWS_DATA_NUM"]["AVERAGE"]) > 4 ):?> rating__star--active<?endif;?>">
									<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
								</svg>
							</div>
							<div class="rating__text"><?\nav\UncachedArea::show('productReviewsCount')?></div>
						</div>
					</div>
					<div class="product-page__desc-reviews-subtitle">Рейтинг</div>
					<div class="product-page__desc-reviews-item">
						<div class="product-page__desc-reviews-line-wrapper">
							<div class="product-page__desc-reviews-line-name">5 звезд</div>
							<div class="product-page__desc-reviews-line">
								<div class="product-page__desc-reviews-line-item" style="width:<?echo ($arResult["REVIEWS_DATA_NUM"]["STARS_STAT"]["5"] ? $arResult["REVIEWS_DATA_NUM"]["STARS_STAT"]["5"] : "0");?>%"></div>
							</div>
							<div class="product-page__desc-reviews-line-count">
								<?echo ($arResult["REVIEWS_DATA_STARS"]["5"] ? count($arResult["REVIEWS_DATA_STARS"]["5"]) : "0");?> отзывов
							</div>
						</div>
						<div class="product-page__desc-reviews-line-wrapper">
							<div class="product-page__desc-reviews-line-name">4 звезды</div>
							<div class="product-page__desc-reviews-line">
								<div class="product-page__desc-reviews-line-item" style="width:<?echo ($arResult["REVIEWS_DATA_NUM"]["STARS_STAT"]["4"] ? $arResult["REVIEWS_DATA_NUM"]["STARS_STAT"]["4"] : "0");?>%"></div>
							</div>
							<div class="product-page__desc-reviews-line-count">
								<?echo ($arResult["REVIEWS_DATA_STARS"]["4"] ? count($arResult["REVIEWS_DATA_STARS"]["4"]) : "0");?> отзывов
							</div>
						</div>
						<div class="product-page__desc-reviews-line-wrapper">
							<div class="product-page__desc-reviews-line-name">3 звезды</div>
							<div class="product-page__desc-reviews-line">
								<div class="product-page__desc-reviews-line-item" style="width:<?echo ($arResult["REVIEWS_DATA_NUM"]["STARS_STAT"]["3"] ? $arResult["REVIEWS_DATA_NUM"]["STARS_STAT"]["3"] : "0");?>%"></div>
							</div>
							<div class="product-page__desc-reviews-line-count">
								<?echo ($arResult["REVIEWS_DATA_STARS"]["3"] ? count($arResult["REVIEWS_DATA_STARS"]["3"]) : "0");?> отзывов
							</div>
						</div>
						<div class="product-page__desc-reviews-line-wrapper">
							<div class="product-page__desc-reviews-line-name">2 звезды</div>
							<div class="product-page__desc-reviews-line">
								<div class="product-page__desc-reviews-line-item" style="width:<?echo ($arResult["REVIEWS_DATA_NUM"]["STARS_STAT"]["2"] ? $arResult["REVIEWS_DATA_NUM"]["STARS_STAT"]["2"] : "0");?>%"></div>
							</div>
							<div class="product-page__desc-reviews-line-count">
								<?echo ($arResult["REVIEWS_DATA_STARS"]["2"] ? count($arResult["REVIEWS_DATA_STARS"]["2"]) : "0");?> отзывов
							</div>
						</div>
						<div class="product-page__desc-reviews-line-wrapper">
							<div class="product-page__desc-reviews-line-name">1 звезда</div>
							<div class="product-page__desc-reviews-line">
								<div class="product-page__desc-reviews-line-item" style="width:<?echo ($arResult["REVIEWS_DATA_NUM"]["STARS_STAT"]["1"] ? $arResult["REVIEWS_DATA_NUM"]["STARS_STAT"]["1"] : "0");?>%"></div>
							</div>
							<div class="product-page__desc-reviews-line-count">
								<?echo ($arResult["REVIEWS_DATA_STARS"]["1"] ? count($arResult["REVIEWS_DATA_STARS"]["1"]) : "0");?> отзывов
							</div>
						</div>
					</div>
					
					<?if( is_array($arResult["REVIEWS_DATA"]) && count($arResult["REVIEWS_DATA"])>0 ):?>
					<div class="product-page__desc-reviews-subtitle">Отзывы</div>
					<div class="product-page__desc-reviews-item">
						<div class="product-page__desc-reviews-list">
							<?foreach( $arResult["REVIEWS_DATA"] as $key=>$arReview ):?>
							<div class="product-page__desc-reviews-list-item">
								<div class="product-page__desc-reviews-list-item-name"><?=$arReview["NAME"]?></div>
								<div class="product-page__desc-reviews-list-item-stars">
									<div class="rating">
										<div class="rating__stars">
											<svg class="rating__star<?if( intval($arReview["PROPERTY_RAITING_VALUE"]) > 0 ):?> rating__star--active<?endif;?>">
												<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
											</svg>
											<svg class="rating__star<?if( intval($arReview["PROPERTY_RAITING_VALUE"]) > 1 ):?> rating__star--active<?endif;?>">
												<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
											</svg>
											<svg class="rating__star<?if( intval($arReview["PROPERTY_RAITING_VALUE"]) > 2 ):?> rating__star--active<?endif;?>">
												<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
											</svg>
											<svg class="rating__star<?if( intval($arReview["PROPERTY_RAITING_VALUE"]) > 3 ):?> rating__star--active<?endif;?>">
												<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
											</svg>
											<svg class="rating__star<?if( intval($arReview["PROPERTY_RAITING_VALUE"]) > 4 ):?> rating__star--active<?endif;?>">
												<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
											</svg>
										</div>
									</div>
								</div>
								<div class="product-page__desc-reviews-list-item-text"><?=$arReview["DETAIL_TEXT"]?></div>
							</div>
							<?endforeach;?>
						</div>
					</div>
					<?endif;?>
					
					<!--.product-page__desc-reviews-subtitle Оставить отзыв-->
					<div class="product-page__desc-reviews-hidden-form-wrapper">
						<div class="product-page__desc-reviews-hidden-form-button button">Оставить отзыв</div>
						<div class="product-page__desc-reviews-hidden-form">
							<?$APPLICATION->IncludeComponent("nav:form", "product_review", [
								"PRODUCT_ID" => $arResult['ID'],
							])?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal" id="fastOrderModal">
	<div class="modal__content form-check">
		<div class="modal__header">
			<div class="modal__header-title">Оставьте заявку для быстрого заказа</div>
			<div class="modal__header-close" data-modal-close>
				<svg class="modal__header-close-icon">
					<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#close"></use>
				</svg>
			</div>
		</div>
		<div class="modal__content-items">
			<div class="modal__content-item">
				<div class="placeholder form-check__field" data-elem="input" data-rule="input-empty">
					<input class="input placeholder__input" placeholder="Имя" type="text" id="input_fo_name" name="name" required>
					<div class="placeholder__item" for="input_fo_name">Имя</div>
				</div>
			</div>
			<div class="modal__content-item">
				<div class="placeholder form-check__field" data-elem="input" data-rule="input-empty">
					<input class="input placeholder__input" placeholder="Телефон" type="text" id="input_fo_phone" name="phone" required>
					<div class="placeholder__item" for="input_fo_phone">Телефон</div>
				</div>
			</div>
			<div class="tq_error tq_error_auth"></div>
			<div class="modal__content-item">
				<div class="modal__one-buttons">
					<div onclick="buttonFastOrder(<?=$arResult['ID']?>)" class="modal__button button button--invert form-check__button">Заказать</div>
				</div>
			</div>
		</div>
	</div>
</div>
