<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
use Bitrix\Main\Application,
    Bitrix\Main\Loader,
    Bitrix\Main\Engine\ActionFilter\Authentication,
    Bitrix\Main\Engine\ActionFilter,
    Bitrix\Main\Engine\Contract\Controllerable,
    \Bitrix\Main\Web\HttpClient;
CJSCore::Init(array("fx", "ajax"));
class tq_reg_code extends \CBitrixComponent implements Controllerable
{
    private  $componentPage = '';

    public function configureActions()
    {
        // Сбрасываем фильтры по-умолчанию (ActionFilter\Authentication и ActionFilter\HttpMethod)
        // Предустановленные фильтры находятся в папке /bitrix/modules/main/lib/engine/actionfilter/
        return [
            'checkCode' => [ // Ajax-метод
                'prefilters' => [],
            ],
            'Auth' => [ // Ajax-метод
                'prefilters' => [],
            ],
            'sendCodeReg' => [ // Ajax-метод
                'prefilters' => [],
            ],
            'sendCodeAuth' => [ // Ajax-метод
                'prefilters' => [],
            ],
            'RepeatCode' => [ // Ajax-метод
                'prefilters' => [],
            ],
            'register' => [ // Ajax-метод
                'prefilters' => [],
            ],
        ];
    }

    public function RepeatCodeAction(){
        if(time() - $_SESSION['CHECK_PHONE_TIME'] >=60 || !$_SESSION['CHECK_PHONE_CODE']){
             $smsResult = $this->SendSMS($_SESSION['PHONE']);
            /*$smsResult['CODE'] = 1234;
            $smsResult['STATUS'] = 'SUCCESS';*/

            if($smsResult['STATUS']=='SUCCESS'){
                $_SESSION['CHECK_PHONE_CODE'] = $smsResult['CODE'];
                $_SESSION['CHECK_PHONE_TIME'] = time();
                if(time()-$_SESSION['CHECK_PHONE_TIME'] <=0 )
                    $time = 60;
                else
                    $time = 60 - (time()-$_SESSION['CHECK_PHONE_TIME']);
                $formattime = $time>=10?$time:sprintf('0%s',$time);
                $result = ['STATUS'=>'SUCCESS','TIME_FORMAT'=>$formattime,'TIME'=>$time,];
            }else{
                $result = ['STATUS'=>'ERROR','MESSAGE'=>$smsResult['MESSAGE']];
            }
        }else{
            $result = ['STATUS'=>'ERROR','MESSAGE'=>'Код уже был отправлен'];
        }



        return $result;
    }


    private function SendSMS($phone){

        $login = "2Proraba";
        $password = "WCvcTk12";
        $transactionId = time();
        $sender_id = "2PRORABA.KG";

        $formatedphone = str_replace(array('(',')',' ','-'),'',$phone);
        if($formatedphone){
            $code = randString(4,['0123456789']);

            $sms_text = sprintf('Код подтверждения %s',$code); // Текст сообщения

            $options = array(
                "redirect" => true, // true, если нужно выполнять редиректы
                "redirectMax" => 5, // Максимальное количество редиректов
                "waitResponse" => true, // true - ждать ответа, false - отключаться после запроса
                "socketTimeout" => 30, // Таймаут соединения, сек
                "streamTimeout" => 60, // Таймаут чтения ответа, сек, 0 - без таймаута
                "version" => HttpClient::HTTP_1_0, // версия HTTP (HttpClient::HTTP_1_0 или HttpClient::HTTP_1_1)
                "proxyHost" => "", // адрес
                "proxyPort" => "", // порт
                "proxyUser" => "", // имя
                "proxyPassword" => "", // пароль
                "compress" => false, // true - принимать gzip (Accept-Encoding: gzip)
                "charset" => "", // Кодировка тела для POST и PUT
                "disableSslVerification" => false, // true - отключить проверку ssl (с 15.5.9)
            );
            $url = $url = "http://smspro.nikita.kg/api/message";

            $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>".
                "<message>".
                "<login>" . $login . "</login>".
                "<pwd>" . $password . "</pwd>".
                "<id>" . $transactionId . "</id>".
                "<sender>" . $sender_id . "</sender>".
                "<text>" . $sms_text . "</text>".
                "<phones>".
                "<phone>" . $formatedphone . "</phone>".
                "</phones>".
                "</message>";
            $httpClient = new HttpClient($options);
            $httpClient->query('POST', $url, $xml);
            $sms =  $httpClient->getResult(); // текст ответа
            $objXML = new CDataXML();
            $objXML->LoadString($sms);
            $arData = $objXML->GetArray();

            if ($arData['response']['#']['status'][0]['#'] == 0) { // Запрос выполнен успешно
                $result = ['STATUS'=>'SUCCESS','FORMATED_PHONE'=>$formatedphone,'CODE'=>$code];
            } else {
                $result = ['STATUS'=>'ERROR','MESSAGE'=>'При отправке СМС произошла ошибка, проверьте правильность введенного номера','ERROR_CODE'=>$arData['response']];
            }
        }else{
            $result = ['STATUS'=>'ERROR','MESSAGE'=>'Номер телефона введен некоректно'];
        }


        return $result;
    }

    public function register($data)
    {
        if($_SESSION['FORMATED_PHONE']){
            global $USER;
            $password =  randString(8);
            COption::SetOptionString("main","captcha_registration","N");
            $arResult = $USER->Register($data['PERSONAL_PHONE'], '', '', $password, $password, '');
            COption::SetOptionString("main","captcha_registration","Y");
            if ($arResult['ID']) {
                $validData = [
                    'PERSONAL_PHONE' => $data['PERSONAL_PHONE'],
                ];
                $user = new \CUser;
                $user->Update($arResult['ID'], $validData);
                $result = ['STATUS'=>'SUCCESS','TYPE'=>'NEW_USER','MESSAGE'=>'Пользователь успешно зарегистрирован'];
            }else{
                $result = ['STATUS'=>'ERROR','MESSAGE'=>$arResult['MESSAGE']." Error"];
            }



        }else{
            $result = ['STATUS'=>'ERROR','MESSAGE'=>'Номер телефона не найден'];
        }

        return $result;
    }
    private function recaptchaCheck($code)
    {
        $bRet = FALSE;

        $sCaptchaResponse = $code;
        if($sCaptchaResponse)
        {
            $aParams = [
                'secret' => '6LdOWNYZAAAAAOzpUsWHVvzyaXgOg3NaeteK0e46', // секретный_код_google
                'response' => $sCaptchaResponse,
            ];

            $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $aParams);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $response = curl_exec($ch);
            if($response)
            {
                $oResponse = json_decode($response);
                $bRet = $oResponse->success;
            }
        }

        return $oResponse;
    }
    public function AuthAction($email,$password,$captcha_word){
        $arErrors = [];

        /*if (strlen($captcha_word) > 0 )
        {
            if (!$this->recaptchaCheck($captcha_word)){
                $arErrors[] = 'Код защиты от автоматических сообщений введен не верно';

            }
        }
        else{
            $arErrors[] = 'Не введен код защиты от автоматических сообщений';
        }
        if($arErrors){
            // htmlspecialcharsbx($APPLICATION->CaptchaGetCode())
            $captcha ='';
            return['STATUS'=>'ERROR','MESSAGE'=>implode('<br>',$arErrors),'CAPTCHA_CODE'=>$captcha,'CAPTCHA_IMG'=>sprintf('/bitrix/tools/captcha.php?captcha_sid=%s',$captcha)];
        }*/

        global $USER;
        if (!is_object($USER))
            $USER = new CUser;
            $arAuthResult = $USER->Login($email, $password, "Y");
            if($arAuthResult === true){
                $result = ['STATUS' => 'SUCCESS','MESSAGE'=>'Вы успешно авторизованы'];
            }else{
                $captcha = '';
                $result = ['STATUS' => 'ERROR','MESSAGE'=>$arAuthResult['MESSAGE'],'CAPTCHA_CODE'=>$captcha,'CAPTCHA_IMG'=>sprintf('/bitrix/tools/captcha.php?captcha_sid=%s',$captcha)];
            }

        return $result;

    }

    public function checkCodeAction($code)
    {
        global $USER;
        $arResult = [];
        if($_SESSION['CHECK_PHONE_CODE'] == $code){
            $_SESSION['TRUE_CODE'] = true;
            $filter = Array("PERSONAL_PHONE" => $_SESSION['PHONE']);
            $by = "NAME";
            $order = "desc";
            $rsUsers = CUser::GetList($by, $order, $filter);
            $arUser = $rsUsers->Fetch();
            if($_SESSION['ACTION'] == 'AUTH' ){
                if ($arUser) {
                    $USER->Authorize($arUser['ID']);
                    $arResult = ['STATUS'=>'SUCCESS','MESSAGE'=>'Пользователь авторизован','TYPE'=>'AUTHORIZED', 'BACK_URL'=>$_SESSION['back_url']];

                }else{
                    $arResult = ['STATUS'=>'ERROR','MESSAGE'=>'Пользователь не найден','TYPE'=>'OPEN_FORM','ID'=>'#tq_auth_phone'];
                }
            }elseif ($_SESSION['ACTION'] == 'REGISTER'){
                $arProps = $_SESSION['FORM'];
                $validData = [
                    'NAME' => $arProps['NAME'],
                    'EMAIL' => $arProps['EMAIL'],
                    'LOGIN' => $arProps['EMAIL'],
                    'PERSONAL_PHONE' => $arProps['PERSONAL_PHONE'],
                    'WORK_COMPANY' => $arProps['WORK_COMPANY'],
                    'WORK_STREET' => $arProps['WORK_STREET'],
                    'UF_INN' => $arProps['UF_INN'],
                    'UF_PRORAB' => $arProps['UF_PRORAB'],
                    'PASSWORD' => $arProps['PASSWORD'],
                    'CONFIRM_PASSWORD' => $arProps['PASSWORD']
                ];
                $result = $this->userRegister($validData);
                if($result['STATUS']=='SUCCESS'){
                    $arEventFields = ['USER_ID'=>$result['ID']]+$validData;
                    CEvent::Send("NEW_USER", 's1', $arEventFields);
                    $arResult = ['STATUS'=>'SUCCESS','MESSAGE'=>'Пользователь зарегистрирован','TYPE'=>'AUTHORIZED','BACK_URL'=>$arProps['back_url']];

                }else{
                    $arResult = ['STATUS'=>'ERROR','MESSAGE'=>$result['MESSAGE'],'TYPE'=>'OPEN_FORM','ID'=>'#tq_form_registration'];
                }

            }

            unset($_SESSION['CHECK_PHONE_CODE'],$_SESSION['CHECK_PHONE_TIME'],$_SESSION['PHONE'],$_SESSION['FORMATED_PHONE'],$_SESSION['ACTION'],$_SESSION['FORM'],$_SESSION['back_url']);
        } else {
            $arResult = ['STATUS'=>'ERROR','MESSAGE'=>'Неверный код подтверждения.'];
        }

        return $arResult;
    }

    public function sendCodeAuthAction($phone,$captcha_word,$back_url)
    {
        $arErrors = [];
        global $APPLICATION;
        if (strlen($captcha_word) > 0 )
        {
            if (!$this->recaptchaCheck($captcha_word)){
                $arErrors[] = 'Код защиты от автоматических сообщений введен не верно';

            }
        }
        else{
            $arErrors[] = 'Не введен код защиты от автоматических сообщений';
        }

        $filter = Array("PERSONAL_PHONE" => $phone);
        $by = "NAME";
        $order = "desc";
        $rsUsers = CUser::GetList($by, $order, $filter);
        $arUser = $rsUsers->Fetch();
        if (!$arUser) {
            $arErrors[] = 'Пользователь не найден';
        }
        if($arErrors){
            $captcha = htmlspecialcharsbx($APPLICATION->CaptchaGetCode());
            return['STATUS'=>'ERROR','MESSAGE'=>implode('<br>',$arErrors),'CAPTCHA_CODE'=>$captcha,'CAPTCHA_IMG'=>sprintf('/bitrix/tools/captcha.php?captcha_sid=%s',$captcha)];
        }

        $smsResult = $this->SendSMS($phone);

        //$smsResult['CODE'] = 1234;
        //$smsResult['STATUS'] = 'SUCCESS';
       // $smsResult['FORMATED_PHONE'] = normalizePhone($phone);
        $captcha = htmlspecialcharsbx($APPLICATION->CaptchaGetCode());
        if($smsResult['STATUS']=='SUCCESS'){
            $_SESSION['CHECK_PHONE_CODE'] = $smsResult['CODE'];
            $_SESSION['CHECK_PHONE_TIME'] = time();
            $_SESSION['PHONE'] = $phone;
            $_SESSION['FORMATED_PHONE'] = $smsResult['FORMATED_PHONE'];
            $_SESSION['ACTION'] = 'AUTH';
            $_SESSION['back_url'] = $back_url;
            if(time()-$_SESSION['CHECK_PHONE_TIME'] <=0 )
                $time = 60;
            else
                $time = 60 - (time()-$_SESSION['CHECK_PHONE_TIME']);
            $formattime = $time>=10?$time:sprintf('0%s',$time);

            $result = ['STATUS'=>'SUCCESS','PHONE'=>$phone,'MESSAGE'=>'SMS с кодом подтверждения отправлено','TIME_FORMAT'=>$formattime,'TIME'=>$time,'CAPTCHA_CODE'=>$captcha,'CAPTCHA_IMG'=>sprintf('/bitrix/tools/captcha.php?captcha_sid=%s',$captcha)];
        }else{
            $result = ['STATUS'=>'ERROR','MESSAGE'=>$smsResult['MESSAGE'],'CAPTCHA_CODE'=>$captcha,'CAPTCHA_IMG'=>sprintf('/bitrix/tools/captcha.php?captcha_sid=%s',$captcha)];
        }


    return  $result;
    }

    public function sendCodeRegAction()
    {
        global $USER;
        global $APPLICATION;
        \Bitrix\Main\Loader::includeModule('iblock');

        $formData = $this->request->getPostList()->toArray();
        $captcha_word = $this->request->get('captcha_word');

        $arProps = $formData;

        $phone = $arProps['PERSONAL_PHONE'];
        $arErrors = [];

        if (strlen($captcha_word) > 0) {
            if (!$this->recaptchaCheck($captcha_word)) {
                $arErrors[] = 'Код защиты от автоматических сообщений введен не верно';

            }
        } else {
            $arErrors[] = 'Не введен код защиты от автоматических сообщений';
        }

        if (!normalizePhone($phone, 11)) {
            $arErrors[] = 'Введите корректный номер телефона';
        }

        if ($arProps['confirm'] != 1) {
            $arErrors[] = 'Вы должны дать согласие на обработку персональных данных';
        }

        $validData = [
            'NAME' => $arProps['NAME'],
            'EMAIL' => $arProps['EMAIL'],
            'LOGIN' => $arProps['EMAIL'],
            'PERSONAL_PHONE' => $arProps['PERSONAL_PHONE'],
            //'WORK_COMPANY' => $arProps['ORG_NAME'],
            //'WORK_STREET' => $arProps['ORG_JUR_ADDRESS'],
            //'UF_INN' => $arProps['ORG_INN'],
            //'UF_PRORAB' => $arProps['UF_PRORAB'],
            'PASSWORD' => $arProps['PASSWORD'],
            'CONFIRM_PASSWORD' => $arProps['PASSWORD']
        ];

        $check = $USER->CheckFields($validData);


        if (is_object($APPLICATION)) {
            $APPLICATION->ResetException();
        }

        if (!$check) {
            $arErrors[] = $USER->LAST_ERROR;
        }

        if ($arErrors) {
            $captcha = htmlspecialcharsbx($APPLICATION->CaptchaGetCode());
            return ['STATUS' => 'ERROR', 'MESSAGE' => implode('<br>', $arErrors), 'CAPTCHA_CODE' => $captcha, 'CAPTCHA_IMG' => sprintf('/bitrix/tools/captcha.php?captcha_sid=%s', $captcha)];
        }

        $result = $this->userRegister($validData);

        print_r($result);

        if ($result['STATUS'] != 'SUCCESS') {
            return [
                'STATUS' => 'ERROR',
                'MESSAGE' => $result['MESSAGE'],
                'TYPE' => 'OPEN_FORM',
                'ID' => '#tq_form_registration'
            ];
        }

        $arEventFields = ['USER_ID' => $result['ID']] + $validData;
        CEvent::Send("NEW_USER", 's1', $arEventFields);

        $el = new \CIBlockElement;

        if (!empty($formData['ORG_NAME'])) {

	        $arOrgFields = [
		        'ACTIVE' => 'Y',
		        'IBLOCK_ID' => \Site\ORGANIZATION_IBLOCK_ID,
		        'NAME' => trim($formData['ORG_NAME']),
		        'PROPERTY_VALUES' => [
			        'USER' => $result['ID'],
		        ],
	        ];

	        $allowedFields = [
		        'NAME', 'INN', 'JUR_ADDRESS', 'DELIVERY_ADDRESS', 'OGRN',
		        'HEAD', 'ACCOUNT', 'BANK_BIK', 'CORP_ACCOUNT', 'BANK_NAME'
	        ];

	        foreach ($allowedFields as $field) {
		        if (empty($formData['ORG_' . $field])) {
			        continue;
		        }

		        $arOrgFields['PROPERTY_VALUES'][$field] = trim($formData['ORG_' . $field]);
	        }

	        if (!$el->Add($arOrgFields)) {
		        return [
			        'STATUS' => 'ERROR',
			        'MESSAGE' => $el->LAST_ERROR,
			        'TYPE' => 'OPEN_FORM',
			        'ID' => '#tq_form_registration'
		        ];
	        }
        }

        $result = ['STATUS' => 'SUCCESS', 'MESSAGE' => 'Пользователь зарегистрирован', 'TYPE' => 'AUTHORIZED', 'BACK_URL' => $arProps['back_url']];

        /*$smsResult = $this->SendSMS($phone);

        if($smsResult['STATUS']=='SUCCESS'){
            $_SESSION['CHECK_PHONE_CODE'] = $smsResult['CODE'];
            $_SESSION['CHECK_PHONE_TIME'] = time();
            $_SESSION['PHONE'] = $phone;
            $_SESSION['FORMATED_PHONE'] = $smsResult['FORMATED_PHONE'];
            $_SESSION['ACTION'] = 'REGISTER';
            $_SESSION['FORM'] = $arProps;
            if(time()-$_SESSION['CHECK_PHONE_TIME'] <=0 )
                $time = 60;
            else
                $time = 60 - (time()-$_SESSION['CHECK_PHONE_TIME']);
            $formattime = $time>=10?$time:sprintf('0%s',$time);
            $captcha = htmlspecialcharsbx($APPLICATION->CaptchaGetCode());
            $result = ['STATUS'=>'SUCCESS','PHONE'=>$phone,'MESSAGE'=>'SMS с кодом подтверждения отправлено','TIME_FORMAT'=>$formattime,'TIME'=>$time,'CAPTCHA_CODE'=>$captcha,'CAPTCHA_IMG'=>sprintf('/bitrix/tools/captcha.php?captcha_sid=%s',$captcha)];
        }else{
            $result = ['STATUS'=>'ERROR','MESSAGE'=>$smsResult['MESSAGE']];
        }*/


        return $result;
    }

    private function userRegister($data){
        global $USER;
        $user = new \CUser;
        $def_group = \COption::GetOptionString("main", "new_user_registration_def_group", "");
        if($def_group != "")
            $data["GROUP_ID"] = explode(",", $def_group);
        $ID = $user->Add($data);
        if (intval($ID) > 0){
            $USER->Authorize($ID);
            return ['STATUS' => 'SUCCESS', 'MESSAGE' => 'Регистрация завершена','ID'=>intval($ID)];
        }
        else
            return ['STATUS' => 'ERROR', 'MESSAGE' => $user->LAST_ERROR."error register"];
    }

private function getPage(){
    global $APPLICATION;
        $this->arResult["CAPTCHA_CODE"] =  htmlspecialcharsbx($APPLICATION->CaptchaGetCode());
}


public function executeComponent()
{
    $this->getPage();
    $this->includeComponentTemplate( $this->componentPage);

}

}
