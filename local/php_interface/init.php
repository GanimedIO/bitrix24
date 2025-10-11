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


