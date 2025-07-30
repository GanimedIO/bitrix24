<?php
//австолоадер проекта - для подключения кастомных классов
include_once __DIR__ . '/../app/autoload.php';


 CModule::AddAutoloadClasses(
        '', // не указываем имя модуля
        array(
           // ключ - имя класса, значение - путь относительно корня сайта к файлу с классом
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

}