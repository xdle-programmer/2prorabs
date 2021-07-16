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
<!--b><?print_r($arResult);?></b-->
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
								<svg class="rating__star rating__star--active">
									<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
								</svg>
								<svg class="rating__star rating__star--active">
									<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
								</svg>
								<svg class="rating__star rating__star--active">
									<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
								</svg>
								<svg class="rating__star rating__star--active">
									<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
								</svg>
								<svg class="rating__star">
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
								<svg class="rating__star rating__star--active">
									<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
								</svg>
								<svg class="rating__star rating__star--active">
									<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
								</svg>
								<svg class="rating__star rating__star--active">
									<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
								</svg>
								<svg class="rating__star rating__star--active">
									<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
								</svg>
								<svg class="rating__star">
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
								<div class="product-page__desc-reviews-line-item" style="width:80%"></div>
							</div>
							<div class="product-page__desc-reviews-line-count">5 отзывов</div>
						</div>
						<div class="product-page__desc-reviews-line-wrapper">
							<div class="product-page__desc-reviews-line-name">4 звезды</div>
							<div class="product-page__desc-reviews-line">
								<div class="product-page__desc-reviews-line-item" style="width:10%"></div>
							</div>
							<div class="product-page__desc-reviews-line-count">5 отзывов</div>
						</div>
						<div class="product-page__desc-reviews-line-wrapper">
							<div class="product-page__desc-reviews-line-name">3 звезды</div>
							<div class="product-page__desc-reviews-line">
								<div class="product-page__desc-reviews-line-item" style="width:20%"></div>
							</div>
							<div class="product-page__desc-reviews-line-count">5 отзывов</div>
						</div>
						<div class="product-page__desc-reviews-line-wrapper">
							<div class="product-page__desc-reviews-line-name">2 звезды</div>
							<div class="product-page__desc-reviews-line">
								<div class="product-page__desc-reviews-line-item" style="width:0%"></div>
							</div>
							<div class="product-page__desc-reviews-line-count">0 отзывов</div>
						</div>
						<div class="product-page__desc-reviews-line-wrapper">
							<div class="product-page__desc-reviews-line-name">1 звезда</div>
							<div class="product-page__desc-reviews-line">
								<div class="product-page__desc-reviews-line-item" style="width:40%"></div>
							</div>
							<div class="product-page__desc-reviews-line-count">5 отзывов</div>
						</div>
					</div>
					<div class="product-page__desc-reviews-subtitle">Отзывы</div>
					<div class="product-page__desc-reviews-item">
						<div class="product-page__desc-reviews-list">
							<div class="product-page__desc-reviews-list-item">
								<div class="product-page__desc-reviews-list-item-name">Владимир К.</div>
								<div class="product-page__desc-reviews-list-item-stars">
									<div class="rating">
										<div class="rating__stars">
											<svg class="rating__star rating__star--active">
												<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
											</svg>
											<svg class="rating__star rating__star--active">
												<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
											</svg>
											<svg class="rating__star rating__star--active">
												<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
											</svg>
											<svg class="rating__star rating__star--active">
												<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
											</svg>
											<svg class="rating__star rating__star--active">
												<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
											</svg>
										</div>
									</div>
								</div>
								<div class="product-page__desc-reviews-list-item-text">Отличный товар</div>
							</div>
							<div class="product-page__desc-reviews-list-item">
								<div class="product-page__desc-reviews-list-item-name">Владимир К.</div>
								<div class="product-page__desc-reviews-list-item-stars">
									<div class="rating">
										<div class="rating__stars">
											<svg class="rating__star rating__star--active">
												<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
											</svg>
											<svg class="rating__star">
												<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
											</svg>
											<svg class="rating__star">
												<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
											</svg>
											<svg class="rating__star">
												<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
											</svg>
											<svg class="rating__star">
												<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#star"></use>
											</svg>
										</div>
									</div>
								</div>
								<div class="product-page__desc-reviews-list-item-text">Ужасный товар ужасный товар ужасный товар ужасный товар ужасный товар ужасный товар ужасный товар ужасный товар ужасный товар ужасный товар</div>
							</div>
						</div>
					</div>
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



<?/*		  
<div class="product-card__item">
    <div class="product-card__main-product">
        <div class="product-card__box">
            <? if ($arResult['PROPERTIES']['GALLERY']['VALUE']) { ?>
                <div class="product-card__slides">
                    <div class="product-card__slides-wrapper">
                        <div class="product-card__slides-inner owl-carousel">
                            <? foreach ($arResult["GALLERY"] as $photo): ?>
                                <div class="product-card__slide-small"><img src="<?=$photo['THUMBNAIL']?>" data-big="<?=$photo['BIG']?>"></div>
                            <? endforeach; ?>
                        </div>
                    </div>
                </div>
            <? } ?>
            <div class="product-card__preview">
                <div class="product-card__preview-header">
                    <div id="product_rating_placeholder" class="rating">
                        <div class="rating__star"></div>
                        <div class="rating__star"></div>
                        <div class="rating__star"></div>
                        <div class="rating__star"></div>
                        <div class="rating__star"></div>
                    </div>

                    <div class="product-card__reviews-counter"><?\nav\UncachedArea::show('productReviewsCount')?></div>

                    <div class="product-card__select-button <?= $fav_act ?>"
                         data-action="<?= $fav_action ?>" data-id="<?= $arResult['ID'] ?>"
                         data-add="FAVORITES">
                        <div class="product-card__select-button-icon product-card__select-button-icon--favourites"></div>
                        <span><?= $fav_text; ?></span>

                    </div>
                    <div class="product-card__select-button <?= $comp_act ?>"
                         data-action="<?= $comp_action ?>" data-id="<?= $arResult['ID'] ?>"
                         data-add="COMPARE">
                        <div class="product-card__select-button-icon product-card__select-button-icon--comparison"></div>
                        <span><?= $comp_text; ?></span>
                    </div>
                </div>
                <div class="product-card__main-image-box">
                    <? if ($arResult['DETAIL_PICTURE']['URL']) { ?>
                        <a href="<?= $arResult['DETAIL_PICTURE']['URL'] ?>" data-lightbox="preview" class="product-card__main-image-box-link">
                            <img class="product-card__main-image" src="<?= $arResult['DETAIL_PICTURE']['URL'] ?>">
                        </a>

                    <? } elseif ($arResult['PREVIEW_PICTURE']['URL']) { ?>
                        <a href="<?= $arResult['PREVIEW_PICTURE']['URL'] ?>" data-lightbox="preview" class="product-card__main-image-box-link">
                            <img class="product-card__main-image" src="<?= $arResult['PREVIEW_PICTURE']['URL'] ?>">
                        </a>
                    <? } else { ?>
                        <img class="product-card__main-image" src="<?= SITE_TEMPLATE_PATH ?>/img/no-image.png">
                    <? } ?>
                    <? if ($arResult['MIN_PRICE']["DISCOUNT_DIFF_PERCENT"] > 0) { ?>
                        <div class="product-card__mark">
                            <img class="product-card__mark-icon"
                                 src="<?= SITE_TEMPLATE_PATH ?>/assets/src/images/icons/sale.svg">Скидка <?= $arResult['MIN_PRICE']["DISCOUNT_DIFF_PERCENT"] ?>
                            %
                        </div>
                    <? } ?>
                </div>
            </div>
        </div>
        <div class="product-card__about tqWrap">
            <div class="product-card__title"><?= $arResult['NAME'] ?></div>
            <? if ($arResult['PROPERTIES']['ART_NUMBER']['VALUE']) { ?>
                <div class="product-card__subtitle product-card__article">
                    Артикул: <?= $arResult['PROPERTIES']['ART_NUMBER']['VALUE'] ?></div>
            <? } ?>
            <? if ($arResult["PROPERTIES"]['COLOR']['VALUE']) { ?>
                <div class="product-card__subtitle product-card__color">Цвет:<span
                            class="product-card__text"><?= $arResult["PROPERTIES"]['COLOR']['VALUE'] ?></span></div>
            <? } ?>
            <div class="product-card__radio-container">
                <? if ($arResult["PROPERTIES"]['COLOR']['VALUE']) { ?>
                    <div class="product-card__radio-box">
                        <input class="product-card__radio-input" type="radio" id="color-2" name="color">
                        <label class="product-card__radio-label product-card__radio-label--indent" for="color-2"><span
                                    class="product-card__color-palette product-card__color-palette--<?= $arResult["PROPERTIES"]['COLOR']['VALUE_XML_ID'] ?>"></span></label>
                    </div>
                <? } ?>
            </div>

            <div class="product-card__amount-box">
                <div class="product-card__subtitle">Количество:</div>
                <a class="product-card__calculator" href="#">
                    <div class="product-card__calculator-icon"></div>
                    Рассчитать расход материалов</a>
            </div>
            <div class="product-card__sum">
                <div class="product-card__sum-icon dds-minus">-</div>
                <input class="product-card__sum-input ddsQuantity" id="calculatorSum" type="text" value="1"
                       data-price='<?= $price ?>' data-discount-price='<?= $price_discount ?>'
                       data-currency="<?= CURRENCY ?>"
                       data-step="<?= $arResult['CATALOG_MEASURE_RATIO'] ?: 1; ?>"
                >
                <div class="product-card__sum-icon dds-plus">+</div>
            </div>
            <div class="product-card__price-box">
                <? if (!empty($arResult['PROPERTIES']["OLD_PRICE"]['VALUE']) && $arResult['PROPERTIES']["OLD_PRICE"]['VALUE'] != $arResult['MIN_PRICE']["VALUE"]) { ?>
                    <div class="product-card__discount"><?= $arResult['PROPERTIES']["OLD_PRICE"]['VALUE'] ?><span
                                class="product-card__discount-prefix"><?= CURRENCY; ?></span>
                    </div>
                    <div class="product-card__price"><?= $arResult['MIN_PRICE']["DISCOUNT_VALUE"] ?><span
                                class="product-card__price-prefix"><?= CURRENCY; ?></span>
                    </div>
                <? } else { ?>
                    <div class="product-card__price"><?= $arResult['MIN_PRICE']["DISCOUNT_VALUE"]; ?><span
                                class="product-card__price-prefix"><?= CURRENCY; ?></span>
                    </div>
                <? } ?>
            </div>
            <? if ($arResult['MIN_PRICE']["DISCOUNT_DIFF"] > 0) { ?>
                <div class="product-card__nds"><?= $arResult['MIN_PRICE']["DISCOUNT_VALUE"] ?>
                    &nbsp;<?= CURRENCY; ?>/<?= $arResult['ITEM_MEASURE']['TITLE'] ?>
                </div>
            <? } else { ?>
                <div class="product-card__nds"><?= $arResult['MIN_PRICE']["VALUE"] ?>
                    &nbsp;<?= CURRENCY; ?>/<?= $arResult['ITEM_MEASURE']['TITLE'] ?>
                </div>
            <? } ?>
            <div class="product-card__buttons">
                <a class="button button--red button--medium-style product-card__button" href="javascript:void(0)" data-action="add2basket" data-id="<?= $arResult['ID'] ?>">В
                    корзину</a>
                <a class="product-card__fast-order button button--white-red button--medium-style" href="#">Быстрый заказ</a>
            </div>
            <div class="product-card__availability-box">
                <? if (count($arResult['BALANCE']) > 0) { ?>
                    <div class="product-card__item-availability">
                        <div class="product-card__item-availability-icon"><img
                                    src="<?= SITE_TEMPLATE_PATH ?>/assets/src/images/icons/availability.svg"></div>
                        В наличии:<a class="product-card__item-availability-link"
                                     href="#storages">в <?= count($arResult['BALANCE']); ?> <?= $shopDeclension->get(count($arResult['BALANCE'])); ?></a>
                    </div>
                <? } else { ?>
                    <div class="product-card__item-availability">
                        Нет в наличии
                    </div>
                <? } ?>
                <div class="product-card__item-availability">
                    <div class="product-card__item-availability-icon"><img
                                src="<?= SITE_TEMPLATE_PATH ?>/assets/src/images/icons/courier.svg"></div>
                    Доставка:<a class="product-card__item-availability-courier">от 120 сом</a>
                </div>
            </div>
            <div class="custorm-text-notify">Внешний вид товара может отличаться от представленного на фотографии</div>
        </div>
    </div>
</div>


<section class="product-description">
    <div class="container">
        <div class="product-description__grid">
            <div class="product-description__container">
                <div class="product-description__tabs">
                    <div class="product-description__tab product-description__tab--active">Описание</div>
                    <div class="product-description__tab">Характеристики</div>
                    <div class="product-description__tab">
                        Отзывы
                    </div>
                </div>
                <div class="product-description__box">
                    <div class="product-description__content-box product-description__content-box--active">
                        <div class="product-description__description-text"><?= (mb_strlen($arResult['DETAIL_TEXT']) > 10 ? $arResult['DETAIL_TEXT'] : $arResult['NAME']) ?></div>
                    </div>
                    <div class="product-description__content-box">
                        <div class="product-description__description-text">
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
                                <div class="product-description__property">
                                    <span class="product-description__property-name"><?=$property['NAME']?></span>
                                    <span class="product-description__property-value"><?=$value?></span>
                                </div>
                            <? endforeach; ?>
                        </div>
                    </div>
                    <div class="product-description__content-box">
                        <?$APPLICATION->IncludeComponent("nav:form", "product_review", [
                            "PRODUCT_ID" => $arResult['ID'],
                        ])?>

                        <?\nav\UncachedArea::show('productReviews')?>
                    </div>
                </div>
            </div>

            <div class="product-description__container">
                <div class="product-description__tabs">
                    <div class="product-description__tab product-description__tab--active" id="storages">По городу</div>
                    <!--				<div class="product-description__tab">Область</div>-->
                </div>
                <div class="product-description__box">
                    <div class="product-description__content-box product-description__content-box--active">
                        <div class="product-description__input-block">
                            <label class="product-description__label" for="input-city">Ваш город</label>
                            <input class="product-description__input" type="text" id="input-city">
                            <div class="product-description__input-reset">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/src/images/icons/reset.svg">
                            </div>
                        </div>
                        <div class="product-description__title-medium product-description__pickup-title">Самовывоз из магазинов:</div>
                        <? if ($arResult['BALANCE']) { ?>
                            <div class="product-description__availability">
                                <span class="product-description__in-stock-text">В наличии: </span>
                                <? foreach ($arResult['BALANCE'] as $balance) { ?>
                                    <a class="product-description__pickup-link" href="javascript:void(0)">
                                        <div class="product-description__pickup-icon"></div>
                                        Склад <?= $arResult['STORAGES'][$balance['PROPERTY_STORAGE_ID_VALUE']] ?>
                                    </a>
                                <? } ?>
                            </div>
                        <? } ?>
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/local/include/" . SITE_ID . "/card/delivery.php"
                            )
                        ); ?>
                        <div class="product-description__pickup-link product-description__delivery-link" href="#">
                            <div class="product-description__pickup-icon product-description__pickup-icon--delivery-icon"></div>
                            Условия доставки</div>
                    </div>
                    <!--				<div class="product-description__content-box">-->
                    <!--					<div class="product-description__input-block">-->
                    <!--						<label class="product-description__label" for="input-city2">Ваш город</label>-->
                    <!--						<input class="product-description__input" type="text" id="input-city2">-->
                    <!--						<div class="product-description__input-reset"><img-->
                    <!--									src="--><? //= SITE_TEMPLATE_PATH ?><!--/assets/src/images/icons/reset.svg"></div>-->
                    <!--					</div>-->
                    <!--					<div class="product-description__title-medium product-description__pickup-title">Самовывоз из-->
                    <!--						магазинов:-->
                    <!--					</div>-->
                    <!--                    --><? // $APPLICATION->IncludeComponent(
                    //                        "bitrix:main.include",
                    //                        "",
                    //                        Array(
                    //                            "AREA_FILE_SHOW" => "file",
                    //                            "AREA_FILE_SUFFIX" => "inc",
                    //                            "EDIT_TEMPLATE" => "",
                    //                            "PATH" => "/local/include/" . SITE_ID . "/card/delivery_region.php"
                    //                        )
                    //                    ); ?>
                    <!--					<a class="product-description__pickup-link product-description__delivery-link" href="#">-->
                    <!--						<div class="product-description__pickup-icon product-description__pickup-icon--delivery-icon"></div>-->
                    <!--						Условия доставки</a>-->
                    <!--				</div>-->
                </div>
            </div>
        </div>
    </div>
</section>
*/?>