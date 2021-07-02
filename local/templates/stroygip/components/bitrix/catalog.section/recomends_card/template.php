<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 */

$this->setFrameMode(true);


$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
$elementDeleteParams = array('CONFIRM' => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));
if ($arResult['ITEMS']) {
    ?>
	<div class="container">
		<div class="title"><?= $arParams['TITLE'] ?></div>
		<div class="owl-carousel owl-theme owl-carousel-style recommends-owl-carousel">
            <? foreach ($arResult['ITEMS'] as $arItem) {

                if (in_array($arItem['ID'], $arParams['FAVORITES'])) {
                    $fav_action = 'compfavdelete';
                    $fav_act = ' compfavactive';
                } else {
                    $fav_action = 'compfav';
                    $fav_act = '';
                }
                if (in_array($arItem['ID'], $arParams['COMPARE'])) {
                    $comp_action = 'compfavdelete';
                    $comp_act = ' compfavactive';
                } else {
                    $comp_action = 'compfav';
                    $comp_act = '';
                }

                $uniqueId = $arItem['ID'] . '_' . md5($this->randString() . $component->getAction());
                $areaIds[$arItem['ID']] = $this->GetEditAreaId($uniqueId);
                $this->AddEditAction($uniqueId, $arItem['EDIT_LINK'], $elementEdit);
                $this->AddDeleteAction($uniqueId, $arItem['DELETE_LINK'], $elementDelete, $elementDeleteParams);
                if ($arItem['PREVIEW_PICTURE']['ID']) {
                    $preview_picture = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']["ID"],
                        array("width" => 240, "height" => 208), BX_RESIZE_IMAGE_PROPORTIONAL)['src'];
                } else {
                    $preview_picture = sprintf('%s/img/no-image.png', SITE_TEMPLATE_PATH);
                }
                ?>
				<div class="catalog-category__item" id="<?= $areaIds[$arItem['ID']]; ?>">
					<div class="catalog-category__button">
						<a class="button button--red" href="javascript:void(0)" data-action="add2basket"
						   data-id="<?= $arItem['ID'] ?>">В корзину</a></div>
					<a class="catalog-category__image-box" href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
						<img class="catalog-item__image" src="<?= $preview_picture ?>">
                        <? if ($arResult['MARKS'][$arItem['PROPERTIES']['MARK']['VALUE']]) {
                            ?>
							<div class="catalog-category__mark">
                                <? if ($arResult['MARKS'][$arItem['PROPERTIES']['MARK']['VALUE']]['UF_FILE']['SRC']) {
                                    ?>
									<img class="catalog-category__mark-icon"
									     src="<?= $arResult['MARKS'][$arItem['PROPERTIES']['MARK']['VALUE']]['UF_FILE']['SRC'] ?>">
                                <? } ?>
								<div class="catalog-category__mark-text"><?= $arResult['MARKS'][$arItem['PROPERTIES']['MARK']['VALUE']]['UF_NAME'] ?></div>
							</div>
                        <? } ?>
						<div class="catalog-category__icon-box">
							<div class="catalog-category__icon">
								<div class="catalog-category__icon-image catalog-category__icon-image--favourite<?= $fav_act ?>"
								     data-action="<?= $fav_action ?>" data-id="<?= $arItem['ID'] ?>"
								     data-add="FAVORITES"></div>
							</div>
							<div class="catalog-category__icon">
								<div class="catalog-category__icon-image catalog-category__icon-image--comparison<?= $comp_act ?>"
								     data-action="<?= $comp_action ?>" data-id="<?= $arItem['ID'] ?>"
								     data-add="COMPARE"></div>
							</div>
						</div>
					</a>
					<div class="catalog-category__price-box">
                        <? if ($arItem['MIN_PRICE']['DISCOUNT_DIFF'] > 0) {
                            ?>
							<div class="catalog-category__discount"><?= number_format($arItem['MIN_PRICE']['VALUE'],
                                    '0', ',', ' ') ?><span
										class="catalog-category__discount-span"><?= CURRENCY; ?></span>
							</div>
                        <? } ?>
						<div class="catalog-category__price"><?= $arItem['MIN_PRICE']['DISCOUNT_DIFF'] == 0 ? number_format($arItem['MIN_PRICE']['VALUE'],
                                '0', ',', ' ') : number_format($arItem['MIN_PRICE']['DISCOUNT_VALUE'], '0', ',', ' ') ?>
							<span class="catalog-category__price-span"><?= CURRENCY; ?></span>
						</div>
					</div>
                    <? if ($arItem['PROPERTIES']['SIZE']['VALUE']) {
                        ?>
						<div class="catalog-category__size"><?= $arItem['PROPERTIES']['SIZE']['VALUE'] ?></div>
                    <? } ?>
					<a class="catalog-category__name"
					   href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= $arItem['NAME'] ?></a>
					<div class="catalog-category__container">
						<div class="rating">
                            <? for ($i = 1; $i <= 5; $i++) {
                                ?>
								<div class="rating__star<? if ($i <= $arItem['PROPERTIES']['RATING']['VALUE']) echo ' active' ?>"></div>
                            <? } ?>
						</div>
                        <? if ($arItem['PROPERTIES']['ART_NUMBER']['VALUE']) {
                            ?>
							<div class="catalog-category__article">
								Арт. <?= $arItem['PROPERTIES']['ART_NUMBER']['VALUE'] ?></div>
                        <? } ?>
					</div>
				</div>
            <? } ?>

		</div>
	</div>
<? } ?>
