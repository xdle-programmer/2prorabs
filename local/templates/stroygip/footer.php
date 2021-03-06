<?

use nav\SiteOption;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
$page = $APPLICATION->GetCurPage();
?>

<?if( in_array($APPLICATION->GetCurPage(), $arr_ntu_clear) ):?>
		</div>
    </section>
<?endif;?>


<?if( !in_array($APPLICATION->GetCurPage(), $arr_ntu_clear) ):?>

	<footer class="footer">
		<div class="layout footer__block">
			<div class="footer__company">
				<a class="footer__company-logo" href="#">
					<img class="footer__company-logo" src="<?= SITE_TEMPLATE_PATH ?>/ts/images/logo/logo-white.svg">
				</a>
				<div class="footer__social">
					<div class="footer__social-title">Мы в социальных сетях</div>
					<div class="footer__social-items">
						<a class="footer__social-item" href="#">
							<svg class="footer__social-item-icon">
								<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#fb"></use>
							</svg>
						</a>
						<a class="footer__social-item" href="https://www.instagram.com/2proraba_kg/" target="_blank">
							<svg class="footer__social-item-icon">
								<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#it"></use>
							</svg>
						</a>
						<a class="footer__social-item" href="#">
							<svg class="footer__social-item-icon">
								<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/icons-sprite.svg#tt"></use>
							</svg>
						</a>
					</div>
				</div>
				<div class="footer__copyright">
					<div class="footer__copyright-text">2прораба 2021</div>
					<div class="footer__copyright-text">Все права защищены</div>
				</div>
			</div>
			<div class="footer__menu">
				<div class="footer__menu-main">
					<a class="footer__menu-link" href="/contacts/">Контакты</a>
					<a class="footer__menu-link" href="/about/">О компании</a>
					<a class="footer__menu-link" href="/delivery-payment/">Доставка и оплата</a>
					<a class="footer__menu-link" href="/services/">Услуги</a>
					<a class="footer__menu-link" href="/vacancy/">Вакансии</a>
					<a class="footer__menu-link" href="/clients/">Сотрудничество</a>
					<a class="footer__menu-link footer__menu-link--small" href="/privacy-policy/">Политика конфиденциальности</a>
					<a class="footer__menu-link footer__menu-link--small" href="/oferta/">Договор оферты</a>
				</div>

				<? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "menu_main_footer", array(
					"ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
					"CACHE_FILTER" => "N",    // Кешировать при установленном фильтре
					"CACHE_GROUPS" => "Y",    // Учитывать права доступа
					"CACHE_TIME" => "36000000",    // Время кеширования (сек.)
					"CACHE_TYPE" => "A",    // Тип кеширования
					"COUNT_ELEMENTS" => "N",    // Показывать количество элементов в разделе
					"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",    // Показывать количество
					"FILTER_NAME" => "sectionsFilter",    // Имя массива со значениями фильтра разделов
					"IBLOCK_ID" => "1",    // Инфоблок
					"IBLOCK_TYPE" => "catalog",    // Тип инфоблока
					"SECTION_CODE" => "",    // Код раздела
					"SECTION_FIELDS" => array(    // Поля разделов
						0 => "",
						1 => "",
					),
					"SECTION_ID" => $_REQUEST["SECTION_STMMID3"],    // ID раздела
					"SECTION_URL" => "",    // URL, ведущий на страницу с содержимым раздела
					"SECTION_USER_FIELDS" => array(    // Свойства разделов
						0 => "",
						1 => "",
					),
					"SHOW_PARENT_NAME" => "Y",    // Показывать название раздела
					"TOP_DEPTH" => "1",    // Максимальная отображаемая глубина разделов
					"VIEW_MODE" => "LIST",    // Вид списка подразделов
				),
					false
				); ?>

				<div class="footer__menu-contacts">
					<div class="footer__menu-contacts-item">
						<div class="footer__menu-contacts-title">Контакты</div>
						<?
						$APPLICATION->IncludeFile("/local/include/" . SITE_ID . "/footer/footer_contacts.php", array(), array(
								"MODE" => "html",
								"NAME" => "блок",
								"TEMPLATE" => ""
							)
						);
						?>
					</div>
					<div class="footer__menu-contacts-item">
						<div class="footer__menu-contacts-title">Мы принимаем</div>
						<div class="footer__menu-contacts-payments">
							<img class="footer__menu-contacts-payments-img footer__menu-contacts-payments-img--visa" src="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/visa.svg">
							<img class="footer__menu-contacts-payments-img footer__menu-contacts-payments-img--mastercard"
								 src="<?= SITE_TEMPLATE_PATH ?>/ts/images/icons/mastercard.svg">
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<? if ($APPLICATION->GetCurPage() == "/"){?>
	</div> <!-- natural-group -->
	<?}?>
	
<? endif; ?>

<?if( !in_array($APPLICATION->GetCurPage(), $arr_ntu_lk) ){?>
</div>
<?}?>


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


<script src="<?= SITE_TEMPLATE_PATH ?>/ts/main.js"></script>

<div class="modal-overlay"></div>
<? \nav\AppData::show() ?>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (m, e, t, r, i, k, a) {
        m[i] = m[i] || function () {
            (m[i].a = m[i].a || []).push(arguments);
        };
        m[i].l = 1 * new Date();
        k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a);
    })
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(61269028, "init", {
        clickmap: true,
        trackLinks: true,
        accurateTrackBounce: true,
        webvisor: true,
        ecommerce: "dataLayer"
    });
</script>
<noscript>
    <div><img src="https://mc.yandex.ru/watch/61269028" style="position:absolute; left:-9999px;" alt=""/></div>
</noscript>
<!-- /Yandex.Metrika counter -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-160628157-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', 'UA-160628157-1');
</script>

</body>
</html>
