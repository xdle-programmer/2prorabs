<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<section class="section section--min-content section--gray">
	<div class="layout">
		<div class="breadcrumb">
			<a class="breadcrumb__item" href="/">Главная</a>
			<svg class="breadcrumb__separator">
				<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#arrow"></use>
			</svg>
			<div class="breadcrumb__item breadcrumb__item--active">Профиль</div>
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
					<a href="/personal/credentials/" class="account__header-button account__header-button--active">
						<div class="account__header-button-inner">
							<svg class="account__header-button-icon">
								<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#user"></use>
							</svg>
							<div class="account__header-button-text">Личные данные</div>
						</div>
					</a>
					<a href="/personal/orders/" class="account__header-button">
						<div class="account__header-button-inner">
							<svg class="account__header-button-icon">
								<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#order"></use>
							</svg>
							<div class="account__header-button-text">Мои заказы</div>
						</div>
					</a>
					<a class="account__header-button">
						<div class="account__header-button-inner">
							<svg class="account__header-button-icon">
								<use xlink:href="/local/templates/stroygip/ts/images/icons/icons-sprite.svg#eye"></use>
							</svg>
							<div class="account__header-button-text">Просмотренные товары</div>
						</div>
					</a>
					<a class="account__header-button">
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
				<div class="account__form-wrapper">
					<form action="" id="personalDataUpdate" method="POST" class="account__form form-check">
						<div class="account__form-title">Личные данные</div>
						<div class="account__form-item">
							<div class="placeholder form-check__field" data-elem="input" data-rule="input-empty">
								<input id="user_fl_name" class="input placeholder__input" name="NAME" value="<?=$arResult['USER_INFO']['NAME']?>" placeholder="ФИО">
								<div class="placeholder__item">ФИО</div>
							</div>
						</div>
						<div class="account__form-item">
							<div class="placeholder form-check__field" data-elem="input" data-rule="input-empty">
								<input id="user_fl_phone" class="input placeholder__input" name="PERSONAL_PHONE" value="<?=$arResult['USER_INFO']['PERSONAL_PHONE'];?>" placeholder="Телефон">
								<div class="placeholder__item">Телефон</div>
							</div>
						</div>
						<div class="account__form-item">
							<div class="placeholder form-check__field" data-elem="input" data-rule="input-empty">
								<input id="user_fl_address" class="input placeholder__input" placeholder="Адрес" value="<?=$arResult['USER_INFO']['PERSONAL_NOTES'];?>">
								<div class="placeholder__item">Адрес</div>
							</div>
						</div>
						<div class="account__form-item">
							<div onclick="personalFLUpdate();" class="account__button form-check__button">Сохранить</div>
						</div>
					</form>
					
					<form action="" id="orgDataUpdate" method="POST" class="account__form form-check">
						<input id="user_org_id" type="hidden" value="<?=$arResult['USER_ORGANIZATION']['0']['ID']?>">
						<div class="account__form-title">Юридическое лицо</div>
						<div class="account__form-item">
							<div class="placeholder form-check__field" data-elem="input" data-rule="input-empty">
								<input id="user_org_name" class="input placeholder__input" value="<?=$arResult['USER_ORGANIZATION']['0']['NAME']?>" placeholder="Название юр.лица">
								<div class="placeholder__item">Название юр.лица</div>
							</div>
						</div>
						<div class="account__form-item">
							<div class="placeholder form-check__field" data-elem="input" data-rule="input-empty">
								<input id="user_org_iin" class="input placeholder__input" value="<?=$arResult['USER_ORGANIZATION']['0']['PROPERTY_INN_VALUE']?>" placeholder="ИНН">
								<div class="placeholder__item">ИНН</div>
							</div>
						</div>
						<div class="account__form-item">
							<div class="placeholder form-check__field" data-elem="input" data-rule="input-empty">
								<input id="user_org_address" class="input placeholder__input" value="<?=$arResult['USER_ORGANIZATION']['0']['PROPERTY_JUR_ADDRESS_VALUE']?>" placeholder="Юридический адрес">
								<div class="placeholder__item">Юридический адрес</div>
							</div>
						</div>
						<div class="account__form-item">
							<div onclick="personalORGUpdate();" class="account__button form-check__button">Сохранить</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
