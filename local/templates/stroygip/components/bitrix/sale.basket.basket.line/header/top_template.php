<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/**
 * @global array $arParams
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @global string $cartId
 */
$compositeStub = (isset($arResult['COMPOSITE_STUB']) && $arResult['COMPOSITE_STUB'] == 'Y');
?>
<div class="users-panel">

    <a href="<?=SITE_DIR?>" class="mobile-logo"></a>


    <div class="users-panel__item" onclick="location.href='/favorites/'">
        <div class="users-panel__icon users-panel__icon--heart"></div>
        <div class="users-panel__text">Избранное</div>
        <?if(count($_SESSION['FAVORITES']) > 0):?>
         <div class="users-panel__notification"><?=count($_SESSION['FAVORITES'])?></div>
        <?endif;?>
    </div>
    <div class="users-panel__item" onclick="location.href='/compare/'">
        <div class="users-panel__icon users-panel__icon--stat"></div>
        <div class="users-panel__text">Сравнение</div>
        <?if(count($_SESSION['COMPARE']) > 0):?>
            <div class="users-panel__notification"><?=count($_SESSION['COMPARE'])?></div>
        <?endif;?>
    </div>
    <div class="users-panel__item" onclick="location.href='<?= $arParams['PATH_TO_BASKET'] ?>'">
        <div class="users-panel__icon users-panel__icon--basket"></div>
        <div class="users-panel__text">Корзина</div>
        <div class="users-panel__notification"><?= $arResult['NUM_PRODUCTS'] ?></div>
    </div>

    <? if ($USER->IsAuthorized()) { ?>
        <div class="users-panel__item" onclick="location.href='<?= $arParams['PATH_TO_PROFILE'] ?>'">
            <div class="users-panel__icon users-panel__icon--user"></div>
            <div class="users-panel__text">Мой профиль</div>
        </div>
    <? } else { ?>
        <div class="users-panel__item" id="buttonReg">
            <!--            <a class="button button--red" id="buttonReg">Авторизация</a>-->

            <div class="users-panel__icon users-panel__icon--user"></div>
            <div class="users-panel__text">Войти</div>
        </div>
    <? } ?>

<!--    <div class="catalog-menu-button"></div>-->
    <div class="burger-menu"></div>


</div>
