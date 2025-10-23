<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
/*Файл обработчик который получает request из ajax формирует массив и добавляет строку и ИБ Бронирование*/


//Получение текущего запроса
$request = Bitrix\Main\Context::getCurrent()->getRequest();

//Проверка, является ли запрос POST
if ($request->isPost()){
	//Получение данных из POST-запроса
	$postData = $request->getPostList()->toArray();
	
	\Bitrix\Main\Loader::includeModule('iblock');
	
	$el = new CIBlockElement();
	
	$newDate = str_replace('T', ' ', $postData['TIME']) . ":00";
	
	$prop = [
		'PROC_IDS' => $postData['PROC_ID'],
		'DATE'=>$newDate,
		'PATIENT_NAME' => $postData['NAME'],
		'DOCTOR' => $postData['DOCTOR_ID'],
	];
	
	$arLoadProductArray = [
		'IBLOCK_ID' => 24,                     //ID инфоблока Бронирование
		'PROPERTY_VALUES' => $prop,
		'NAME' => $postData['NAME'],
		'ACTIVE' => 'Y', //активен
	];
	
	if($element_id = $el->Add($arLoadProductArray)) {
		echo 'New IDs: '.$element_id;
	} else {
		echo 'Error: ' .$el->LAST_ERROR;
	}
	
}
	
die();