<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О нас");
?>

   <section class="section section--video">
        <video class="section__video-item" autoplay muted>
          <source src="/local/templates/stroygip/ts/images/static-images/videoplayback.mp4">
        </video>
      </section>
      <section class="section">
        <div class="layout">
          <div class="static-page">
            <div class="static-page__title">У нас есть всё для ремонта и строительства!</div>
            <div class="static-page__advantages">
              <div class="static-page__advantages-item">
                <div class="static-page__advantages-item-img-wrapper"><img class="static-page__advantages-item-img" src="/local/templates/stroygip/ts/images/static-images/about-1.svg"></div>
                <div class="static-page__advantages-item-desc">
                  <div class="static-page__advantages-item-desc-title">Без наценки</div>
                  <div class="static-page__advantages-item-desc-text">Собственная логистика и 3 склада позволяют нам сохранять оптовые цены</div>
                </div>
              </div>
              <div class="static-page__advantages-item">
                <div class="static-page__advantages-item-img-wrapper"><img class="static-page__advantages-item-img" src="/local/templates/stroygip/ts/images/static-images/about-2.svg"></div>
                <div class="static-page__advantages-item-desc">
                  <div class="static-page__advantages-item-desc-title">Офлайн-магазины</div>
                  <div class="static-page__advantages-item-desc-text">Все товары можно выбрать и купить вживую в наших магазинах</div>
                </div>
              </div>
              <div class="static-page__advantages-item">
                <div class="static-page__advantages-item-img-wrapper"><img class="static-page__advantages-item-img" src="/local/templates/stroygip/ts/images/static-images/about-3.svg"></div>
                <div class="static-page__advantages-item-desc">
                  <div class="static-page__advantages-item-desc-title">Быстрая доставка</div>
                  <div class="static-page__advantages-item-desc-text">Доставляем в день заказа. Сроки доставки в другие города индивидуальны</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="section section--gray">
        <div class="layout">
          <div class="static-page">
            <div class="static-page__title">Специальные условия сотрудничества</div>
            <div class="static-page__special">
              <div class="static-page__special-header">
                <div class="static-page__special-header-item static-page__special-header-item--active" data-target="1">Для физических лиц</div>
                <div class="static-page__special-header-item" data-target="2">Для юридических лиц</div>
              </div>
              <div class="static-page__special-items">
                <div class="static-page__special-item static-page__special-item--active" data-name="1">
                  <div class="static-page__special-list">
                    <div class="static-page__special-list-item">
                      <div class="static-page__special-list-item-img-wrapper"><img class="static-page__special-list-item-img" src="/local/templates/stroygip/ts/images/static-images/about-spec-1.svg"></div>
                      <div class="static-page__special-list-item-desc">
                        <div class="static-page__special-list-item-desc-title">Акции каждый день</div>
                        <div class="static-page__special-list-item-desc-text">Каждый день добавляются акционные товары. Удобный поиск поможет Вам подобрать оптимальные, а так же выделены специальным элементом.</div>
                      </div>
                    </div>
                    <div class="static-page__special-list-item">
                      <div class="static-page__special-list-item-img-wrapper"><img class="static-page__special-list-item-img" src="/local/templates/stroygip/ts/images/static-images/about-spec-2.svg"></div>
                      <div class="static-page__special-list-item-desc">
                        <div class="static-page__special-list-item-desc-title">Возможность сохранять адреса доставки</div>
                        <div class="static-page__special-list-item-desc-text">Не нужно постоянно вводить адреса доставки, добавляйте новые адреса в личном кабинете и выбирайте их в 1 клик при оформлении заказа.</div>
                      </div>
                    </div>
                    <div class="static-page__special-list-item">
                      <div class="static-page__special-list-item-img-wrapper"><img class="static-page__special-list-item-img" src="/local/templates/stroygip/ts/images/static-images/about-spec-3.svg"></div>
                      <div class="static-page__special-list-item-desc">
                        <div class="static-page__special-list-item-desc-title">Выгрузка сметы</div>
                        <div class="static-page__special-list-item-desc-text">Выгружайте и повторяйте свои заказы в 1 клик.  Вы также можете сохранить смету и направить ее другому ответственному лицу на проверку.</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="static-page__special-item" data-name="2">
                  <div class="static-page__special-list">
                    <div class="static-page__special-list-item">
                      <div class="static-page__special-list-item-img-wrapper"><img class="static-page__special-list-item-img" src="/local/templates/stroygip/ts/images/static-images/about-spec-1.svg"></div>
                      <div class="static-page__special-list-item-desc">
                        <div class="static-page__special-list-item-desc-title">Оформляйте не выходя из офиса</div>
                        <div class="static-page__special-list-item-desc-text">Удобная система регистрации для юридических лиц. Возможность сохранить компанию. Лучший поиск для мониторинга товаров и цен.</div>
                      </div>
                    </div>
                    <div class="static-page__special-list-item">
                      <div class="static-page__special-list-item-img-wrapper"><img class="static-page__special-list-item-img" src="/local/templates/stroygip/ts/images/static-images/about-spec-2.svg"></div>
                      <div class="static-page__special-list-item-desc">
                        <div class="static-page__special-list-item-desc-title">Отдельная касса</div>
                        <div class="static-page__special-list-item-desc-text">Персональный менеджер и отдельная касса для юридических лиц. Совершайте покупки без ожидании и очередей. Индивидуальное отношение каждому клиенту.</div>
                      </div>
                    </div>
                    <div class="static-page__special-list-item">
                      <div class="static-page__special-list-item-img-wrapper"><img class="static-page__special-list-item-img" src="/local/templates/stroygip/ts/images/static-images/about-spec-3.svg"></div>
                      <div class="static-page__special-list-item-desc">
                        <div class="static-page__special-list-item-desc-title">Строгая форма отчетности</div>
                        <div class="static-page__special-list-item-desc-text">Документация к каждому заказу. Выписываем счет фактуру онлайн так и оффлайн. Сертификация каждого товара.</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="section">
        <div class="layout">
          <div class="static-page">
            <div class="static-page__title">Реквизиты</div>
            <div class="static-page__info-block">
              <div class="static-page__info-block-desc">
                <div class="static-page__info-block-desc-text">
                  <div class="static-page__info-block-text-small">ОсОО «Строительный гипермаркет «Два прораба»</div>
                  <div class="static-page__info-block-text-small">Юридический адрес: Кыргызская Республика, г. Бишкек, ул. Л.Толстого, 36к</div>
                  <div class="static-page__info-block-text-small">Код ОКПО: 29998545</div>
                  <div class="static-page__info-block-text-small">ИНН: 00407201710214</div>
                  <div class="static-page__info-block-text-small">УГНС по Свердловскому р-ну г. Бишкек, код 003</div>
                  <div class="static-page__info-block-text-small">р/счет: 1299003131324919 (KGS)</div>
                  <div class="static-page__info-block-text-small">Банк: ОАО «РСК Банк»</div>
                  <div class="static-page__info-block-text-small">БИК: 129001</div>
                </div>
                <div class="static-page__info-block-desc-img-wrapper"><img class="static-page__info-block-desc-img" src="/local/templates/stroygip/ts/images/static-images/contract.svg"></div>
              </div>
            </div>
          </div>
        </div>
      </section>
	  
	  
<?/*$APPLICATION->IncludeComponent(
  "2quick:wrap",
  "about",
  array(
  ),
  false
);*/?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>