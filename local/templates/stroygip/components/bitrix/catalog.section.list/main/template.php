<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="catalog">
    <div class="catalog__container container">
        <div class="catalog__inner">
            <div class="catalog__button">
                <div class="catalog__button-icon"></div>
                <div class="catalog__button-text">Весь каталог</div>
            </div>
            <div class="catalog__list">

                <? foreach ($arResult["DEPTH_LEVEL_1"] as $arMain) { ?>
                <a href="<?= $arMain['SECTION_PAGE_URL'] ?>" class="catalog__list-item">
                    <? if ($arMain['SVG']) { ?>
                    <div class="catalog__list-item-icon <? if ($arMain['CODE'] == 'aktsii') { ?>catalog__list-item-icon--stock<? } ?>" <? if ($arMain['CODE'] !='aktsii' ){ ?>style="mask: url(<?= $arMain['SVG'] ?> );-webkit-mask: url(<?= $arMain['SVG'] ?>)
                        <? } ?>;">
                    </div>
                    <? } ?>
                    <div class="catalog__list-item-text"><?= $arMain['NAME'] ?></div>
                    <? if ($arResult['DEPTH_LEVEL_2'][$arMain['ID']]) { ?>
                    <div class="catalog__submenu">
                        <div class="catalog__submenu-inner container">
                            <? foreach ($arResult['DEPTH_LEVEL_2'][$arMain['ID']] as $key => $arSubSecond) { ?>
                            <div class="catalog__submenu-item">
                                <a class="catalog__submenu-item-title" href="<?= $arSubSecond['SECTION_PAGE_URL'] ?>"><?= $arSubSecond['NAME'] ?></a>
                                <? foreach ($arResult['DEPTH_LEVEL_3'][$arSubSecond['ID']] as $arSubThree) { ?>
                                <a class="catalog__submenu-item-link" href="<?= $arSubThree['SECTION_PAGE_URL'] ?>"><?= $arSubThree['NAME'] ?></a>
                                <? } ?>
                            </div>
                            <? } ?>
                        </div>
                    </div>
                    <? } ?>
                </a>
                <? } ?>
                <div class="catalog__list-item stock-item" onclick="location.href='/catalog/sale/'">
                    <div class="stock-sublist">
                        <a href="/stock/" class="stock-sublist__link">Выгодные предложения</a>
                        <a href="/catalog/sale/" class="stock-sublist__link">Товары со скидкой</a>
                    </div>
                    <div class="catalog__list-item-icon catalog__list-item-icon--stock"></div>
                    <div class="catalog__list-item-text">Акции</div>
                </div>
            </div>
        </div>
    </div>

    <div class="catalog-menu">
        <div class="catalog-menu__box container desk">
            <? $counter = 0;
            foreach ($arResult["MAIN_SECTIONS"] as $arMain) { ?>
            <div class="catalog-menu__item <?= $counter == 0 ? 'catalog-menu__item--open' : '' ?>">
                <a class="catalog-menu__item-link" href="<?= $arMain['SECTION_PAGE_URL'] ?>"><?= $arMain['NAME'] ?>
                    <div class="catalog-menu__item-link-icon" style="mask: url(<?= $arMain['SVG'] ?> );-webkit-mask: url(<?= $arMain['SVG'] ?>)"></div>
                </a>
                <div class="catalog-menu__item-button"></div>
                <div class="catalog-menu__submenu">
                    <? if ($arMain['PIC']) { ?>
                    <img class="catalog-menu__submenu-img" src="<?= $arMain['PIC'] ?>">
                    <? } ?>
                    <? if ($arResult['SUB_SECTIONS'][$arMain['ID']]) { ?>
                    <div class="catalog-menu__submenu-box">
                        <? foreach ($arResult['SUB_SECTIONS'][$arMain['ID']] as $arSubSecond) { ?>
                        <div class="catalog-menu__submenu-item"><a class="catalog-menu__submenu-item-link" href="<?= $arSubSecond['SECTION_PAGE_URL'] ?>"><?= $arSubSecond['NAME'] ?></a>

                            <div class="catalog-menu__submenu-item-button"></div>
                            <? if ($arResult['SUB_SECTIONS'][$arSubSecond['ID']]) { ?>
                            <div class="catalog-menu__submenu-inner">
                                <? foreach ($arResult['SUB_SECTIONS'][$arSubSecond['ID']] as $arSubThree) { ?>
                                <a class="catalog-menu__submenu-inner-link" href="<?= $arSubThree['SECTION_PAGE_URL'] ?>"><?= $arSubThree['NAME'] ?></a>
                                <? } ?>
                            </div>
                            <? } ?>
                        </div>
                        <? } ?>
                    </div>
                    <? } ?>
                </div>
            </div>
            <? $counter++;
            } ?>
        </div>
        <div class="catalog-menu__box container mobile">
            <div class="catalog-mob">
                <div class="catalog-mob__buttons">
                    <div class="catalog-mob__btn btn1 active">Каталог</div>
                    <div class="catalog-mob__btn btn2">Меню</div>
                </div>
            </div>
            <div class="catalog-item1">
                <div class="catalog-menu__item">
                    <a href="#" class="catalog-menu__item-link">
                        Акции
                        <div class="catalog-menu__item-link-icon mask"></div>
                    </a>
                    <div class="catalog-menu__item-button"></div>
                    <div class="catalog-menu__submenu">
                        <div class="catalog-menu__submenu-box">
                            <div class="catalog-menu__submenu-item">
                                <a href="/stock/" class="catalog-menu__submenu-item-link">Выгодные предложения</a>
                                <a href="/catalog/sale/" class="catalog-menu__submenu-item-link">Товары со скидкой</a>
                            </div>
                        </div>
                    </div>
                </div>
                <? $counter = 0;
                foreach ($arResult["MAIN_SECTIONS"] as $arMain) { ?>
                <div class="catalog-menu__item <?= $counter == 0 ? 'catalog-menu__item--open' : '' ?>">
                    <a class="catalog-menu__item-link" href="<?= $arMain['SECTION_PAGE_URL'] ?>"><?= $arMain['NAME'] ?>
                        <div class="catalog-menu__item-link-icon" style="mask: url(<?= $arMain['SVG'] ?> );-webkit-mask: url(<?= $arMain['SVG'] ?>)"></div>
                    </a>
                    <div class="catalog-menu__item-button"></div>
                    <div class="catalog-menu__submenu">
                        <? if ($arMain['PIC']) { ?>
                        <img class="catalog-menu__submenu-img" src="<?= $arMain['PIC'] ?>">
                        <? } ?>
                        <? if ($arResult['SUB_SECTIONS'][$arMain['ID']]) { ?>
                        <div class="catalog-menu__submenu-box">
                            <? foreach ($arResult['SUB_SECTIONS'][$arMain['ID']] as $arSubSecond) { ?>
                            <div class="catalog-menu__submenu-item"><a class="catalog-menu__submenu-item-link" href="<?= $arSubSecond['SECTION_PAGE_URL'] ?>"><?= $arSubSecond['NAME'] ?></a>

                                <div class="catalog-menu__submenu-item-button"></div>
                                <? if ($arResult['SUB_SECTIONS'][$arSubSecond['ID']]) { ?>
                                <div class="catalog-menu__submenu-inner">
                                    <? foreach ($arResult['SUB_SECTIONS'][$arSubSecond['ID']] as $arSubThree) { ?>
                                    <a class="catalog-menu__submenu-inner-link" href="<?= $arSubThree['SECTION_PAGE_URL'] ?>"><?= $arSubThree['NAME'] ?></a>
                                    <? } ?>
                                </div>
                                <? } ?>
                            </div>
                            <? } ?>
                        </div>
                        <? } ?>
                    </div>
                </div>
                <? $counter++;
                } ?>
            </div>
            <div class="catalog-item2" hidden>
                <div class="catalog-menu__item">
                    <a href="/about/" class="catalog-menu__item-link">О нас</a>
                    <div class="catalog-menu__item-button"></div>
                    <div class="catalog-menu__submenu s-mnu">
                        <div class="catalog-menu__submenu-box">
                            <div class="catalog-menu__submenu-item">
                                <a href="/vacancy/" class="catalog-menu__submenu-item-link">Вакансии</a>
                                <a href="/contacts/" class="catalog-menu__submenu-item-link">Контакты</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="catalog-menu__item">
                    <a href="/delivery-payment/" class="catalog-menu__item-link">Доставка и оплата</a>
                    <div class="catalog-menu__item-button"></div>
                    <div class="catalog-menu__submenu s-mnu">
                        <div class="catalog-menu__submenu-box">
                            <div class="catalog-menu__submenu-item">
                                <a href="/return/" class="catalog-menu__submenu-item-link">Условия обмена и возврата</a>
                                <a href="/oferta/" class="catalog-menu__submenu-item-link">Права потребителей</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="catalog-menu__item">
                    <a href="/clients/" class="catalog-menu__item-link">Корпоративным клиентам</a>
                </div>
                <div class="catalog-menu__item">
                    <a href="/suppliers/" class="catalog-menu__item-link">Поставщикам</a>
                </div>
                <div class="catalog-menu__item">
                    <a href="/services/" class="catalog-menu__item-link">Услуги</a>
                </div>
                <div class="catalog-menu__item">
                    <a href="/news/" class="catalog-menu__item-link">Новости</a>
                </div>
            </div>
        </div>
    </div>
</div>