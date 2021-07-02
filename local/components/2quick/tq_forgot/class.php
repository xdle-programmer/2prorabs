<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Application,
    Bitrix\Main\Loader,
    Bitrix\Main\Engine\ActionFilter\Authentication,
    Bitrix\Main\Engine\ActionFilter,
    Bitrix\Main\Engine\Contract\Controllerable;

CJSCore::Init(array("fx", "ajax"));

class tq_registration extends \CBitrixComponent implements Controllerable
{
    private $componentPage = '';

    public function configureActions()
    {
        return [
            'sendPass' => [ // Ajax-метод
                'prefilters' => [],
            ],
        ];
    }

    public function sendPassAction($email)
    {
        $filter = ['=EMAIL' => $email];
        $obUser = \Bitrix\Main\UserTable::getList([
            'select' => ['ID', 'NAME', 'EMAIL'],
            'filter' => $filter,
        ]);
        $User = $obUser->fetch();
        if (!$User) {
            $result = ['STATUS' => 'ERROR', 'MESSAGE' => 'Пользователь не найден'];
        } else {
            $password = randString(7);
            $text = sprintf('Пароль выслан на почту: <br>%s', $email);
            $result = ['STATUS' => 'SUCCESS', 'MESSAGE' => $text];

            $user = new \CUser;
            $ID = $user->Update($User['ID'], ['PASSWORD' => $password]);
            $arEventFields = [
                'PASSWORD' => $password,
                'NAME' => $User['NAME'],
                'EMAIL' => $User['EMAIL'],
                'USER_ID' => $User['ID']
            ];
            CEvent::Send("MY_FORGOT_PASSWORD", 's1', $arEventFields);

        }


        return $result;
    }



    public function executeComponent()
    {
        $this->includeComponentTemplate($this->componentPage);

    }

}
