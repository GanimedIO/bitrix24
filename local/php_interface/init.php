<?php
//австолоадер проекта - дл€ подключени€ кастомных классов
include_once __DIR__ . '/../app/autoload.php';


 CModule::AddAutoloadClasses(
        '', // не указываем им€ модул€
        array(
           // ключ - им€ класса, значение - путь относительно корн€ сайта к файлу с классом
                'App\Debug\Log' => '/local/App/Debug/Log.php',
		//'App\Models\Lists' => '/local/App/Models/Lists/DoctorsPropertyValuesTable.php'
               
        )
);




//вывод данных
function pr($var, $type = false) {
	echo '<pre style="font-size:10px; border:1px solid #000; background: #FFF; text-align:left; color:#000;">';
	if ($type)
		var_dump($var);
	else
		print_r($var);
	echo '</pre>';

};

//task9
include_once __DIR__ . '/../task9/AuthorTable.php';
include_once __DIR__ . '/../task9/BookTable.php';




// астомные событи€
include_once __DIR__ . '/../task24/events.php';

//свои методы REST
include_once __DIR__ . '/../task30/OriginalContactsDataTable.php';
include_once __DIR__ . '/../task30/events.php';


//task16
//include_once __DIR__ . '/modules/task16/Crmcustomtab/Orm/AuthorTable.php';
//include_once __DIR__ . '/modules/task16/Crmcustomtab/Orm/BookTable.php';


//task18
//include_once __DIR__ . '/../app/UserTypes/IBLink.php';
//include_once __DIR__ . '/../app/UserTypes/CUserTypeOnlineRecord.php

use Bitrix\Main\EventManager;            //„ерез обработчик подключаем наш класс который будет описывать наш кастомны тип данных
$eventManager = EventManager::getInstance();

//пользовательский тип дл€ UF
$eventManager->AddEventHandler(
	'main',
	'OnUserTypeBuildList',
	[
		'UserTypes\FormatTelegramLink',     //  класс обработчик пользовательского типа UF пол€
		'GetUserTypeDescription'
	]
);



// пользовательский тип дл€ свойства инфоблока
$eventManager->AddEventHandler(
	'iblock',
	'OnIBlockPropertyBuildList',
	[
		'UserTypes\IBLink',                // класс обработчик пользовательского типа свойства
		'GetUserTypeDescription'
	]
);


// событие происходит когда отрисовываетс€ когда формируетс€ список типов дл€ свойства элемента инфоблока


$eventManager->AddEventHandler(  
	'iblock',
	'OnIBlockPropertyBuildList',
	[
		'UserTypes\CUserTypeOnlineRecord',
		'GetUserTypeDescription'
	]
);

