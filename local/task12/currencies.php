<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Валюта");

?>



<?$APPLICATION->IncludeComponent(
	"task12:currency.rates", 
	"template1", 
	[
		"CACHE_TIME" => "86400",
		"CACHE_TYPE" => "Y",
		"CURRENCY_BASE" => "RUB",
		"RATE_DAY" => "",
		"SHOW_CB" => "N",
		"arrCURRENCY_FROM" => [
			0 => "BYN",
		],
		"COMPONENT_TEMPLATE" => "template1"
	],
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>