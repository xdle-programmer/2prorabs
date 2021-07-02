<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Grid\Declension;
$orgDeclension = new Declension('организация', 'организации', 'организаций');
$this->setFrameMode(true);
?>

<?if (count($arResult['ITEMS']) === 0): ?>
    <div class="personal-area__block-title personal-area__block-title--indent-bottom">У вас пока нет организаций</div>
    <? return; ?>
<? endif; ?>

<div class="personal-area__block-title personal-area__block-title--indent-bottom">У вас <?= count($arResult['ITEMS'])?> <?= $orgDeclension->get(count($arResult['ITEMS']));?></div>
<div class="personal-area__organizations-items-block">
    <?foreach($arResult["ITEMS"] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="personal-area__organizations-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="personal-area__organizations-head">
	            <div class="personal-area__organizations-head-title"><?= $arItem['NAME'];?></div>
	            <div class="personal-area__organizations-checkbox">
		            <input class="personal-area__organizations-input" type="checkbox" name="main_org">Сделать основной
		            <div class="personal-area__organizations-input-square"></div>
		            <div class="personal-area__organizations-hint">
			            Адреса и контакты основной компании будут использоваться по умолчанию при оформлении заказа. <br>
			            Вы сможете изменить контакты и адреса на другие во время оформления заказа.
		            </div>
	            </div>
            </div>
            <div class="personal-area__organizations-inner">
	            <?foreach ($arItem['PROPERTIES'] as $prop) {
                    if (!empty($prop['VALUE']) && $prop['CODE'] != 'ACTIVE' && $prop['CODE'] != 'USER') { ?>
			            <div class="personal-area__organizations-row">
				            <div class="personal-area__organizations-title"><?= $prop['NAME'];?></div>
				            <div class="personal-area__organizations-text"><?= $prop['VALUE'];?></div>
			            </div>
                    <?
                    }
                }?>

	            <div class="personal-area__organizations-icons">
		            <div class="personal-area__organizations-icon personal-area__organizations-icon--edit"></div>
		            <div class="personal-area__organizations-icon personal-area__organizations-icon--delete"></div>
	            </div>
            </div>
        </div>
    <?endforeach;?>
</div>