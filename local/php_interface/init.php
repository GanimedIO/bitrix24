<?php


 CModule::AddAutoloadClasses(
        '', // не указываем им€ модул€
        array(
           // ключ - им€ класса, значение - путь относительно корн€ сайта к файлу с классом
                'App\Debug\Log' => '/local/App/Debug/Log.php',
		
               
        )
);