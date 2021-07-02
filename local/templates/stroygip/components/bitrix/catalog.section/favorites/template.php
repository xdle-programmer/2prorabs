<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);


?>

<div class="favorites__grid">
    <? if ($arResult['MAIN_SECTIONS']) { ?>
		<div class="favorites__aside">
			<div class="favorites__category-title">Категории</div>
			<a class="favorites__category <? if (empty($arParams['FAV_SECTION'])) {
                echo 'favorites__category--active';
            } ?>" href="/favorites/">Все товары</a>
            <? foreach ($arResult['MAIN_SECTIONS'] as $sectionID => $sectionName) { ?>
				<a class="favorites__category <? if ($arParams['FAV_SECTION'] == $sectionID) { ?>favorites__category--active<? } ?>"
				   href="/favorites/?section=<?= $sectionID; ?>"><?= $sectionName; ?></a>
            <? } ?>
		</div>
    <? } ?>
	<div class="favorites__box">
		<div class="favorites__inner">
			<div class="favorites__header">
				<div class="title favorites__title"><?= $arParams['FAV_SECTION'] ? $arResult['MAIN_SECTIONS'][$arParams['FAV_SECTION']] : 'Все товары'; ?>
					<div class="favorites__title-value"><?= count($arResult['NEW_ITEMS']); ?> шт.</div>
				</div>
				<a class="favorites__button-clear" href="/favorites/?clear=yes">
					<div class="favorites__button-clear-icon"></div>
					Очистить список
				</a>
			</div>
			<div class="favorites__text">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "page",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => ""
                    )
                ); ?>

			</div>


            <? /*

			<div class="favorites__select-box">
				<fieldset>
					<select class="favorites__select" name="speed" id="selectArea">
						<option selected="selected" disabled>Сначала новые</option>
						<option>Option 1</option>
						<option>Option 2</option>
					</select>
				</fieldset>
			</div>*/ ?>

			<div class="favorites__grid-items">
                <? foreach ($arResult['NEW_ITEMS'] as $arItem) {
                    if ($arItem['PREVIEW_PICTURE']['ID']) {
                        $preview_picture = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']["ID"],
                            array("width" => 240, "height" => 208), BX_RESIZE_IMAGE_PROPORTIONAL)['src'];
                    } else {
                        $preview_picture = sprintf('%s/img/no-image.png', SITE_TEMPLATE_PATH);
                    }

                    if (in_array($arItem['ID'], $arParams['FAVORITES'])) {
                        $fav_action = 'compfavdelete';
                        $fav_act = ' compfavactive';
                        $fav_text = 'Удалить из Избранного';
                    } else {
                        $fav_action = 'compfav';
                        $fav_text = 'Добавить в Избранное';
                        $fav_act = '';
                    }
                    if (in_array($arItem['ID'], $arParams['COMPARE'])) {
                        $comp_action = 'compfavdelete';
                        $comp_act = ' compfavactive';
                    } else {
                        $comp_action = 'compfav';
                        $comp_act = '';
                    }
                    ?>
					<div class="catalog-category__item catalog-category__item--height">
						<div class="catalog-category__button catalog-category__button--show">
							<a class="button button--red" href="javascript:void(0)" data-action="add2basket"
							   data-id="<?= $arItem['ID'] ?>">В корзину</a>
						</div>
						<a class="catalog-category__image-box" href="<?= $arItem['DETAIL_PAGE_URL']; ?>">
							<img class="catalog-category__image" src="<?= $preview_picture; ?>">
							<div class="catalog-category__icon-box">
								<div class="catalog-category__icon catalog-category__icon-favorite catalog-category__icon--show<?= $fav_act ?>"
								     data-action="<?= $fav_action ?>" data-id="<?= $arItem['ID'] ?>"
								     data-add="FAVORITES">
									<div class="catalog-category__icon-image catalog-category__icon-image--favourite"></div>
									<div class="catalog-category__favorite-notification"><?= $fav_text; ?></div>
								</div>
								<div class="catalog-category__icon catalog-category__icon--show<?= $comp_act ?>"
								     data-action="<?= $comp_action ?>" data-id="<?= $arItem['ID'] ?>"
								     data-add="COMPARE">
									<div class="catalog-category__icon-image catalog-category__icon-image--comparison"></div>
								</div>
							</div>
						</a>
						<div class="catalog-category__price-box">
                            <?
                            $currency = false;
                            if ($arItem['MIN_PRICE']['DISCOUNT_DIFF'] > 0) {
                                ?>
								<div class="catalog-category__discount"><?= number_format($arItem['MIN_PRICE']['VALUE'],
                                        '0', ',', ' ') ?><span
											class="catalog-category__discount-span"><?= CURRENCY; ?></span>
								</div>
                            <?

                                $arItem['MIN_PRICE']['VALUE'] = $arItem['MIN_PRICE']['DISCOUNT_VALUE'];
                            } ?>
							<div class="catalog-category__price"><?= $arItem['MIN_PRICE']['DISCOUNT_DIFF'] == 0 ? number_format($arItem['MIN_PRICE']['DISCOUNT_VALUE'],
                                    '0', ',', ' ') : number_format($arItem['MIN_PRICE']['VALUE'], '0', ',', ' ') ?><span
										class="catalog-category__price-span"><?= CURRENCY; ?></span>
							</div>

						</div>
						<a class="catalog-category__name"
						   href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= $arItem['NAME'] ?></a>
						<div class="catalog-category__container catalog-category__container--show">
							<div class="rating">
                                <? for ($i = 1; $i <= 5; $i++) { ?>
									<div class="rating__star<? if ($i <= $arItem['PROPERTIES']['RATING']['VALUE']) echo ' active' ?>"></div>
                                <? } ?>
							</div>
                            <? if ($arItem['PROPERTIES']['ART_NUMBER']['VALUE']) { ?>
								<div class="catalog-category__article">
									Арт. <?= $arItem['PROPERTIES']['ART_NUMBER']['VALUE'] ?></div>
                            <? } ?>
						</div>
					</div>
                <? } ?>
			</div>
		</div>
	</div>
</div>
