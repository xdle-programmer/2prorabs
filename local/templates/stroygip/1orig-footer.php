<?

use nav\SiteOption;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
$page = $APPLICATION->GetCurPage();
?>

<? if ($APPLICATION->GetProperty('bread') == 'Y') { ?>
    </div>
    </div>
<? } ?>

<? if ($APPLICATION->GetProperty('personal_menu') == 'Y'): ?>
    </div><!-- /.personal-area__grid -->
    </div><!-- /.container -->
<? endif; ?>

</div>
</div>
</div>
<? if ($page == '/personal/') { ?>
    <section class="recently-viewed recently-viewed--white">
        <? $APPLICATION->IncludeComponent(
            "bitrix:catalog.products.viewed",
            "",
            array(
                'TITLE' => 'Вы недавно смотрели',
                "ACTION_VARIABLE" => "action_cpv",
                "ADDITIONAL_PICT_PROP_1" => "-",
                "ADD_PROPERTIES_TO_BASKET" => "Y",
                "ADD_TO_BASKET_ACTION" => "ADD",
                "BASKET_URL" => "/personal/basket.php",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "3600",
                "CACHE_TYPE" => "A",
                "CONVERT_CURRENCY" => "N",
                "DEPTH" => "2",
                "DISPLAY_COMPARE" => "N",
                "ENLARGE_PRODUCT" => "STRICT",
                "HIDE_NOT_AVAILABLE" => "N",
                "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                "IBLOCK_ID" => "1",
                "IBLOCK_MODE" => "single",
                "IBLOCK_TYPE" => "catalog",
                "LABEL_PROP_1" => array(),
                "LABEL_PROP_POSITION" => "top-left",
                "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                "MESS_BTN_BUY" => "Купить",
                "MESS_BTN_DETAIL" => "Подробнее",
                "MESS_BTN_SUBSCRIBE" => "Подписаться",
                "MESS_NOT_AVAILABLE" => "Нет в наличии",
                "PAGE_ELEMENT_COUNT" => "9",
                "PARTIAL_PRODUCT_PROPERTIES" => "N",
                "PRICE_CODE" => array("BASE"),
                "PRICE_VAT_INCLUDE" => "Y",
                "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
                "PRODUCT_ID_VARIABLE" => "id",
                "PRODUCT_PROPS_VARIABLE" => "prop",
                "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
                "PRODUCT_SUBSCRIPTION" => "Y",
                "SECTION_CODE" => "",
                "SECTION_ELEMENT_CODE" => "",
                "SECTION_ELEMENT_ID" => $GLOBALS["CATALOG_CURRENT_ELEMENT_ID"],
                "SECTION_ID" => $GLOBALS["CATALOG_CURRENT_SECTION_ID"],
                "SHOW_CLOSE_POPUP" => "N",
                "SHOW_DISCOUNT_PERCENT" => "N",
                "SHOW_FROM_SECTION" => "N",
                "SHOW_MAX_QUANTITY" => "N",
                "SHOW_OLD_PRICE" => "N",
                "SHOW_PRICE_COUNT" => "1",
                "SHOW_SLIDER" => "Y",
                "SLIDER_INTERVAL" => "3000",
                "SLIDER_PROGRESS" => "N",
                "TEMPLATE_THEME" => "blue",
                "USE_ENHANCED_ECOMMERCE" => "N",
                "USE_PRICE_COUNT" => "N",
                "USE_PRODUCT_QUANTITY" => "N"
            )
        ); ?>
    </section>
<? } ?>


<div class="modal-region" id="modal-region">
    <div class="modal-region__title">Ваш город Бишкек?</div>
    <div class="modal-region__buttons"><a class="modal-region__button" href="#">Да</a><a class="modal-region__button modal-region__button--white" href="#">Изменить</a></div>
</div>

<footer class="footer" style="overflow: hidden">
    <div class="container">
        <div class="footer__inner">
            <div class="footer__box">

                <div class="footer__col footer__col--mr footer__col--hidden">
                    <img class="footer__logo" src="<?= SITE_TEMPLATE_PATH ?>/assets/src/images/icons/logo-white.png">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/local/include/" . SITE_ID . "/footer/info.php"
                        )
                    ); ?>
                </div>
                <div class="footer__col footer__col--pt">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/local/include/" . SITE_ID . "/footer/menuFCol.php"
                        )
                    ); ?>
                    <div class="footer__right-links">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/local/include/" . SITE_ID . "/footer/menuDCol.php"
                            )
                        ); ?>
                    </div>
                </div>
                <div class="footer__col footer__col--pt footer__col--hidden">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/local/include/" . SITE_ID . "/footer/menuTCol.php"
                        )
                    ); ?>

                </div>
            </div>
            <div class="footer__col-info">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/local/include/" . SITE_ID . "/footer/contacts.php"
                    )
                ); ?>
                <? $APPLICATION->IncludeComponent("bitrix:news.list", "social", array(
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",    // Формат показа даты
                    "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
                    "AJAX_MODE" => "N",    // Включить режим AJAX
                    "AJAX_OPTION_ADDITIONAL" => "",    // Дополнительный идентификатор
                    "AJAX_OPTION_HISTORY" => "N",    // Включить эмуляцию навигации браузера
                    "AJAX_OPTION_JUMP" => "N",    // Включить прокрутку к началу компонента
                    "AJAX_OPTION_STYLE" => "Y",    // Включить подгрузку стилей
                    "CACHE_FILTER" => "N",    // Кешировать при установленном фильтре
                    "CACHE_GROUPS" => "Y",    // Учитывать права доступа
                    "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
                    "CACHE_TYPE" => "A",    // Тип кеширования
                    "CHECK_DATES" => "Y",    // Показывать только активные на данный момент элементы
                    "DETAIL_URL" => "",    // URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
                    "DISPLAY_BOTTOM_PAGER" => "N",    // Выводить под списком
                    "DISPLAY_DATE" => "Y",    // Выводить дату элемента
                    "DISPLAY_NAME" => "Y",    // Выводить название элемента
                    "DISPLAY_PICTURE" => "Y",    // Выводить изображение для анонса
                    "DISPLAY_PREVIEW_TEXT" => "Y",    // Выводить текст анонса
                    "DISPLAY_TOP_PAGER" => "N",    // Выводить над списком
                    "FIELD_CODE" => array(    // Поля
                        0 => "",
                        1 => "",
                    ),
                    "FILTER_NAME" => "",    // Фильтр
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",    // Скрывать ссылку, если нет детального описания
                    "IBLOCK_ID" => "12",    // Код информационного блока
                    "IBLOCK_TYPE" => "office",    // Тип информационного блока (используется только для проверки)
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",    // Включать инфоблок в цепочку навигации
                    "INCLUDE_SUBSECTIONS" => "Y",    // Показывать элементы подразделов раздела
                    "MESSAGE_404" => "",    // Сообщение для показа (по умолчанию из компонента)
                    "NEWS_COUNT" => "5",    // Количество новостей на странице
                    "PAGER_BASE_LINK_ENABLE" => "N",    // Включить обработку ссылок
                    "PAGER_DESC_NUMBERING" => "N",    // Использовать обратную навигацию
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",    // Время кеширования страниц для обратной навигации
                    "PAGER_SHOW_ALL" => "N",    // Показывать ссылку "Все"
                    "PAGER_SHOW_ALWAYS" => "N",    // Выводить всегда
                    "PAGER_TEMPLATE" => ".default",    // Шаблон постраничной навигации
                    "PAGER_TITLE" => "Новости",    // Название категорий
                    "PARENT_SECTION" => "",    // ID раздела
                    "PARENT_SECTION_CODE" => "",    // Код раздела
                    "PREVIEW_TRUNCATE_LEN" => "",    // Максимальная длина анонса для вывода (только для типа текст)
                    "PROPERTY_CODE" => array(    // Свойства
                        0 => "URL",
                        1 => "ICON",
                        2 => "",
                    ),
                    "SET_BROWSER_TITLE" => "N",    // Устанавливать заголовок окна браузера
                    "SET_LAST_MODIFIED" => "N",    // Устанавливать в заголовках ответа время модификации страницы
                    "SET_META_DESCRIPTION" => "N",    // Устанавливать описание страницы
                    "SET_META_KEYWORDS" => "N",    // Устанавливать ключевые слова страницы
                    "SET_STATUS_404" => "N",    // Устанавливать статус 404
                    "SET_TITLE" => "N",    // Устанавливать заголовок страницы
                    "SHOW_404" => "N",    // Показ специальной страницы
                    "SORT_BY1" => "ACTIVE_FROM",    // Поле для первой сортировки новостей
                    "SORT_BY2" => "SORT",    // Поле для второй сортировки новостей
                    "SORT_ORDER1" => "DESC",    // Направление для первой сортировки новостей
                    "SORT_ORDER2" => "ASC",    // Направление для второй сортировки новостей
                    "STRICT_SECTION_CHECK" => "N",    // Строгая проверка раздела для показа списка
                ),
                    false
                ); ?>
            </div>
        </div>
    </div>
</footer>
<? /*<div class="modal-overlay"></div>
<div class="modal-position">
    <div class="modal-registration-container">
        <div class="modal-registration">
            <div class="modal-registration__close"><img src="<?= SITE_TEMPLATE_PATH;?>/assets/src/blocks/modals/modal-registration/assets/img/close-mod.svg"></div>
            <div class="modal-registration__inner">
                <div class="modal-registration__tabs">
                    <div class="modal-registration__tab modal-registration__tab--active">Вход</div>
                    <div class="modal-registration__tab">Регистрация</div>
                </div>
                <div class="modal-registration__box modal-registration__box--active">

                    <!--<div class="modal-registration__sign-block modal-registration__sign-block--active">
						<div class="modal-registration__sign-text">Мы пришлем SMS с кодом для подтверждения на ваш номер телефона</div>
						<div class="modal-registration__inner">
							<div class="input-styled">
								<label class="input-styled__label" for="input-phone">Введите ваш телефон</label>
								<input class="input-styled__input" type="phone" id="input-phone">
							</div>
							<div class="modal-registration__captcha">
								<div class="modal-registration__captcha-text">Подтвердите, что вы не робот</div>
							</div><a class="button button--red button--red-width modal-registration__button-red" href="#">Получить код</a><a class="modal-registration__sign-link" href="#" id="signEmail">Войти по почте</a>
						</div>
					</div>-->
                    <div class="modal-registration__sign-block  modal-registration__sign-block--active">
                        <div class="modal-registration__sign-text">Только для зарегистрированных пользователей</div>
                        <div class="modal-registration__inner">
                            <div class="input-styled input-styled--indent">
                                <label class="input-styled__label" for="input-email">Ваш e-mail</label>
                                <input class="input-styled__input" type="email" id="input-email">
                            </div>
                            <div class="input-styled__password-block">
                                <div class="input-styled input-styled--indent">
                                    <label class="input-styled__label" for="input-phone4">Пароль</label>
                                    <input class="input-styled__input" type="password" id="input-phone4">
                                    <div class="input-styled__pass-icon"></div>
                                </div><a class="input-styled__remember-password" href="#">Забыли пароль?</a>
                            </div>
                            <div class="modal-registration__captcha">
                                <div class="modal-registration__captcha-text">Подтвердите, что вы не робот</div>
                            </div>


                            <a class="button button--red button--red-width modal-registration__button-red" href="#">Войти</a>

                           <!-- <a class="modal-registration__sign-link" href="#" id="signTel">Войти по номеру телефона</a>-->


                        </div>
                    </div>
                </div>
                <div class="modal-registration__box">
                    <div class="modal-registration__input-box">
                        <div class="input-styled input-styled__reg">
                            <label class="input-styled__label" for="input-phone">Введите Имя по паспорту</label>
                            <input class="input-styled__input" type="text" id="input-phone">
                        </div>
                        <div class="input-styled input-styled__reg">
                            <label class="input-styled__label" for="input-phone2">Телефон</label>
                            <input class="input-styled__input" type="phone" id="input-phone2">
                        </div>
                        <div class="input-styled input-styled__reg">
                            <label class="input-styled__label" for="input-phone3">E-mail</label>
                            <input class="input-styled__input" type="email" id="input-phone3">
                        </div>
                        <div class="input-styled input-styled__reg">
                            <label class="input-styled__label" for="input-phone4">Пароль</label>
                            <input class="input-styled__input" type="password" id="input-phone4">
                            <div class="input-styled__pass-icon"></div>
                        </div>
                    </div>

                    <!--<div class="modal-registration__checkbox">
                        <div class="checkbox">
                            <input class="checkbox__input" type="checkbox">
                            <div class="checkbox__square"></div>
                            <div class="checkbox__text">Я прораб</div>
                        </div>
                    </div>-->

                    <div class="modal-registration__text">С вами свяжется менеджер для подтверждения.</div><a class="modal-registration__button" href="#" id="addCompany">
                        <div class="modal-registration__button-icon"></div>Добавить Компанию</a>
                    <div class="modal-registration__add-company-block">
                        <div class="input-styled input-styled__reg">
                            <label class="input-styled__label" for="input-phone">Название</label>
                            <input class="input-styled__input" type="text" id="input-phone">
                        </div>
                        <div class="input-styled input-styled__reg">
                            <label class="input-styled__label" for="text2">ИНН</label>
                            <input class="input-styled__input" type="text" id="text2">
                        </div>
                        <div class="input-styled input-styled__reg">
                            <label class="input-styled__label" for="text3">Адрес</label>
                            <input class="input-styled__input" type="text" id="text3">
                        </div>
                    </div>
                    <div class="modal-registration__text">Добавить можно позднее в личном кабинете.</div>
                    <div class="modal-registration__checkbox-rights">
                        <div class="checkbox">
                            <input class="checkbox__input" type="checkbox">
                            <div class="checkbox__square"></div>
                            <div class="checkbox__text checkbox__text--grey-small">Я даю согласие на обработку своих персональных данных согласно<a class="checkbox__right-link" href="#">политике конфиденциальности</a></div>
                        </div>
                    </div>

                    <a class="button button--red button--red-width modal-registration__button-red" href="#">Зарегистрироваться</a>


                </div>
            </div>
        </div>

		<!--<div class="modal-registration__code">
			<div class="modal-registration__code-inner">
				<div class="modal-registration__code-title">Введите код</div>
				<div class="modal-registration__code-text">Мы отправили код подтверждения на номер <br> +7 (926) 546-00-83</div>
				<div class="modal-registration__code-container">
					<input class="modal-registration__code-input" type="text" value="1">
				</div>
				<div class="modal-registration__code-timer">Получить новый код можно через 00:56</div>
			</div>
		</div>-->

    </div>
</div>*/ ?>


<? if (!$USER->IsAuthorized()) { ?>
    <? $APPLICATION->IncludeComponent(
        "2quick:tq_auth",
        "",
        array(),
        false
    ); ?>
    <? $APPLICATION->IncludeComponent(
        "2quick:tq_forgot",
        "",
        array()
    ); ?>
<? } ?>

<div class="modal-position">
    <div class="modal-map">
        <div class="thanks__close">
            <img src="<?= SITE_TEMPLATE_PATH; ?>/assets/src/blocks/modals/thanks/assets/img/close.svg">
        </div>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAUTKfNeQ5DFQP-g_N8Rg0ulxwWPnyVJq0&libraries=geometry"></script>
        <script>
        var deliveryPrice = {
            bigDeliveryKm: <?=(int) SiteOption::get(SiteOption::DELIVERY_HEAVY_PRICE)?>,
            bigDeliveryKmMinimal: <?=(int) SiteOption::get(SiteOption::DELIVERY_HEAVY_MIN_SUM)?>,
            smallDeliveryKm: <?=(int) SiteOption::get(SiteOption::DELIVERY_NORMAL_PRICE)?>,
            smallDeliveryKmMinimal: <?=(int) SiteOption::get(SiteOption::DELIVERY_NORMAL_MIN_SUM)?>,
        }

        var sliderOptions = {
            loop: <?=(SiteOption::get(SiteOption::MAIN_SLIDER_LOOP) === 'Y' ? 'true' : 'false')?>,
            autoplay: <?=(SiteOption::get(SiteOption::MAIN_SLIDER_AUTOPLAY) === 'Y' ? 'true' : 'false')?>,
            autoplayTimeout: <?=(int) SiteOption::get(SiteOption::MAIN_SLIDER_AUTOPLAY_TIMEOUT)?>,
        }
        </script>


        <div id="address-map"></div>

        <div class="modal-map__button-wrapper">

            <input class="modal-map__input basket-products__registration-input" placeholder="Адрес">
            <div class="modal-map__button-cancel button button--red">Отмена</div>
            <div class="modal-map__button button button--red">Сохранить</div>


            <!--            $origin = $_POST['o']; $destination = $_POST['d'];-->
            <!--            $api = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&language=ru&origins=".$origin."&destinations=".$destination."&key=YOUR_API_KEY");-->
            <!--            $data = json_decode($api);-->


        </div>
    </div>
</div>

<div class="modal-position">
    <div class="modal-delivery">
        <div class="thanks__close">
            <img src="<?= SITE_TEMPLATE_PATH; ?>/assets/src/blocks/modals/thanks/assets/img/close.svg">
        </div>


        <div class="container">
            <div class="title">Стоимость доставки по габаритам</div>
            <div class="cost-size__tab">
                <div class="cost-size__box">
                    <div class="cost-size__header">Вес (объем) заказа</div>
                    <div class="cost-size__row">до 300 кг (до 2м3)</div>
                    <div class="cost-size__row">От 300 кг до 500 кг (до 3м3)</div>
                    <div class="cost-size__row">От 500 кг до 1,0 тонн (до 6м3)</div>
                    <div class="cost-size__row">От 1,0 тонн до 1,5 тонн (до 10м3)</div>
                </div>
                <div class="cost-size__box">
                    <div class="cost-size__header">Цена, Сом</div>
                    <div class="cost-size__row">350</div>
                    <div class="cost-size__row">500</div>
                    <div class="cost-size__row">600</div>
                    <div class="cost-size__row">700</div>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="modal-position">
    <div class="thanks feedback_thanks">
        <div class="thanks__close">
            <img src="<?= SITE_TEMPLATE_PATH; ?>/assets/src/blocks/modals/thanks/assets/img/close.svg">
        </div>
        <div class="thanks__image-box"><img src="<?= SITE_TEMPLATE_PATH; ?>/assets/src/blocks/modals/thanks/assets/img/order.svg"></div>
        <div class="thanks__title">Спасибо за обращение</div>
        <div class="thanks__text">
            Наши менеджеры свяжутся с Вами.
        </div>
    </div>
</div>

<div class="modal-position">
    <div class="fast-call">
        <div class="fast-call__close"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/dist/src/blocks/modals/fast-call/assets/img/close.svg"></div>
        <div class="fast-call__img-box">
            <img class="fast-call__img" src="<?= SITE_TEMPLATE_PATH ?>/assets/dist/src/blocks/modals/fast-call/assets/img/call.svg"></div>
        <div class="fast-call__title">Оставьте заявку для быстрого заказа</div>
        <div class="fast-call__input-box">
            <div class="input-styled input-styled--indent">
                <label class="input-styled__label" for="input-fast1">Ваше имя</label>
                <input class="input-styled__input" type="text" id="input-fast1" name="name">
            </div>
            <div class="input-styled">
                <label class="input-styled__label" for="input-fast2">Введите ваш телефон</label>
                <input class="input-styled__input" type="phone" id="input-fast2" name="phone">
            </div>
            <a class="button button--red button--red-width fast-call__button" href="#">Заказать</a>
        </div>
    </div>
</div>

<div class="modal-position">
    <div class="feedback-modal">
        <div class="feedback-modal__close"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/dist/src/blocks/modals/fast-call/assets/img/close.svg"></div>
        <div class="feedback-modal__img-box">
            <img class="feedback-modal__img" src="<?= SITE_TEMPLATE_PATH ?>/assets/dist/src/blocks/modals/fast-call/assets/img/call.svg"></div>
        <div class="feedback-modal__title">Напишите нам</div>

        <div class="feedback-modal__input-box">
            <div class="input-styled input-styled--indent">
                <label class="input-styled__label" for="input-feedback1">Ваше имя</label>
                <input class="input-styled__input" type="text" id="input-feedback1" name="name">
            </div>

            <div class="input-styled input-styled--indent">
                <label class="input-styled__label" for="input-feedback2">Ваш телефон</label>
                <input class="input-styled__input" type="phone" id="input-feedback2" name="phone">
            </div>

            <div class="input-styled input-styled--indent">
                <label class="input-styled__label" for="input-feedback3">Email</label>
                <input class="input-styled__input" type="email" id="input-feedback3" name="email">
            </div>

            <div class="input-styled">
                <label class="input-styled__label" for="input-feedback4">Комментарий</label>
                <textarea class="input-styled__input" id="input-feedback4" name="text"></textarea>
            </div>
            <a class="button button--red button--red-width feedback-modal__button" href="#">Отправить</a>
        </div>
    </div>
</div>

<div class="modal-overlay"></div>
<? \nav\AppData::show() ?>
</body>
</html>
