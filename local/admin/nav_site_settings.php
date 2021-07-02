<?php
use nav\SiteOption;

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_before.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/prolog.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_after.php');

if (!$USER->CanDoOperation('edit_php')) {
    $APPLICATION->AuthForm(GetMessage('ACCESS_DENIED'));
    return;
}

ClearVars();

// vars
$moduleId = 'nav.site';
$pageTitle = '2proraba.kg - Настройки';
$context = \Bitrix\Main\Application::getInstance()->getContext();
$request = $context->getRequest();
$currentPage = $request->getRequestedPage();
$backUrl = $request->get('back_url');

$allOptions = [
    'main' => [
        'NAME' => 'Главная',
        'ITEMS' => [
            [
                'TYPE' => 'header',
                'NAME' => 'Слайдер',
            ],
            SiteOption::MAIN_SLIDER_LOOP => [
                'TYPE' => 'checkbox',
                'NAME' => 'Зацикленный показ',
            ],
            SiteOption::MAIN_SLIDER_AUTOPLAY => [
                'TYPE' => 'checkbox',
                'NAME' => 'Автопереключение',
            ],
            SiteOption::MAIN_SLIDER_AUTOPLAY_TIMEOUT => [
                'TYPE' => 'int',
                'NAME' => 'Время показа слайда (для автопереключения), мс',
            ],
        ],
    ],
    'delivery' => [
        'NAME' => 'Доставка',
        'ITEMS' => [
            SiteOption::DELIVERY_NORMAL_PRICE => [
                'TYPE' => 'int',
                'NAME' => 'Цена 1км, до 200 кг',
                'DEFAULT' => 0,
            ],
            SiteOption::DELIVERY_NORMAL_MIN_SUM => [
                'TYPE' => 'int',
                'NAME' => 'Минимальная стоимость, до 200 кг',
            ],
            SiteOption::DELIVERY_HEAVY_PRICE => [
                'TYPE' => 'int',
                'NAME' => 'Цена 1км, от 200 кг',
            ],
            SiteOption::DELIVERY_HEAVY_MIN_SUM => [
                'TYPE' => 'int',
                'NAME' => 'Минимальная стоимость, от 200 кг',
            ],
        ],
    ],
];

$tabs = [];

foreach ($allOptions as $tabId => $tabData) {
    $tabs[] = [
        'DIV' => $tabId,
        'TAB' => $tabData['NAME'],
        'ICON' => '',
    ];
}

$tabControl = new \CAdmintabControl('tabControl', $tabs);

if (!empty($request->getPost('save')) && check_bitrix_sessid()) {
    foreach ($allOptions as $tabId => $tabData) {
        foreach ($tabData['ITEMS'] as $optionId => $option) {
            switch ($option['TYPE']) {
                case 'header':
                    continue 2;
                    break;

                case 'int':
                    $value = (int) $request->get($optionId);
                    break;

                case 'checkbox':
                    $value = $request->get($optionId) === 'Y' ? 'Y' : 'N';
                    break;

                default:
                    $value = '';
                    break;
            }

            \Bitrix\Main\Config\Option::set($moduleId, $optionId, $value);
        }
    }

    LocalRedirect($currentPage . '?lang=' . LANGUAGE_ID . '&' . $tabControl->ActiveTabParam() . (!empty($backUrl) ? '&back_url=' . urlencode($backUrl) : ''));
}

$APPLICATION->SetTitle($pageTitle);
?>
<?/*echo BeginNote();
echo $Option[2];
echo EndNote();*/?>
<form method="post" action="<?=$currentPage?>?lang=<?=LANG?><?=(!empty($backUrl) ? '&back_url=' . urlencode($backUrl) : '')?>">
    <?
    print bitrix_sessid_post();
    $tabControl->Begin();
    ?>
    <? foreach ($allOptions as $tab => $tabData): ?>
        <?
        $tabControl->BeginNextTab();
        ?>
        <? foreach ($tabData['ITEMS'] as $optionId => $option): ?>
            <? if ($option['TYPE'] === 'header'): ?>
                <tr class="heading">
                    <td colspan="2">
                        <?=$option['NAME']?>
                    </td>
                </tr>
            <? else: ?>
                <?
                $currentValue = \nav\SiteOption::get($optionId, $option['DEFAULT']);
                ?>
                <tr>
                    <td valign="top" width="40%">
                        <label for="option_<?=$optionId?>"><?=$option['NAME']?>:</label>
                    </td>
                    <td valign="middle" width="60%">
                        <? switch ($option['TYPE']):
                            case 'checkbox': ?>
                                <input
                                    type="checkbox"
                                    id="option_<?=$optionId?>"
                                    name="<?=$optionId?>"
                                    value="Y"
                                    <? if ($currentValue === 'Y'): ?>checked<? endif; ?>
                                />
                                <? break; ?>
                            <? case 'int': ?>
                                <input
                                    type="text"
                                    id="option_<?=$optionId?>"
                                    name="<?=$optionId?>"
                                    size="5"
                                    maxlength="10"
                                    value="<?=$currentValue?>"
                                />
                                <? break; ?>
                            <? default: ?>
                                <input
                                    type="text"
                                    id="option_<?=$optionId?>"
                                    name="<?=$optionId?>"
                                    size="32"
                                    maxlength="255"
                                    value="<?=$currentValue?>"
                                />
                                <? break; ?>
                        <? endswitch; ?>
                    </td>
                </tr>
            <? endif; ?>
        <? endforeach; ?>
    <? endforeach; ?>
    <?
    $tabControl->Buttons();
    ?>
    <input type="submit" name="save" value="Сохранить" title="Сохранить" />
    <?$tabControl->End();?>
</form>
<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_admin.php');
?>