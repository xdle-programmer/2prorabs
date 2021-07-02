<?php

define("NO_KEEP_STATISTIC", "Y");
define("NO_AGENT_STATISTIC","Y");
define("NOT_CHECK_PERMISSIONS", true);

$HTTP_ACCEPT_ENCODING = "";
$_SERVER["HTTP_ACCEPT_ENCODING"] = "";
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$cpt = new CCaptcha();

if (isset($_GET["captcha_sid"]))
{
	$csid = strrev(substr($_GET["captcha_sid"], 6, strlen($_GET["captcha_sid"]) - 6 - 11));
	if ($cpt->InitCode($csid))
		$cpt->Output();
	else
		$cpt->OutputError();
}
else
{
	$cpt->OutputError();
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");

?>