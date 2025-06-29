<?php

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("debug.php");

$date_time = date("Y-m-d H:i:s");
Bitrix\Main\Diag\Debug::writeToFile($date_time, $varName = '$date_time', $fileName = 'local/logs/exceptions.log');

$hh = 1/0;   //генерируем исключение на странице в файл exceptions.log  выпадает ошибка сгенерировання переопределенным классом в .sittings_extra.php













//1. Вывод простых массивов (проблема с рекурсией)
/*
print_r('<pre>');
print_r('$_SERVER: ');
print_r($_SERVER);
print_r('</pre>');
*/


//2. Дополнительно выводит типы элементов
/*
print_r('<pre>');
print_r('var_dimp($_SERVER): ');
print_r(var_dump($_SERVER));
print_r('</pre>');
*/

//3. dump(); - библиотека  от sumphony с более красивым выводом и поиском
/*
dump($_SERVER);

*/


//4. sage(); - библиотека  от sage с более красивым выводом и поиском
/*
sage($_SERVER);

*/


//4. sagetrace(); - библиотека  от sage с указанием местав в файле где произошла ошибка
/*
sagetrace($_SERVER);

*/


//5. region логирование - кастомный лог
/*
\App\Debug\Log::addLog('Открыта страница /otus/debug/debug.php');
*/

//Штатное логирование

Bitrix\Main\Diag\Debug::writeToFile($_SERVER, $varName = '$_SERVER', $fileName = '');
Bitrix\Main\Diag\Debug::dumpToFile($_SERVER, $varName = '$_SERVER', $fileName = '');



//6. region Профилирование (отслеживание времени исполнения кода)
/*
Bitrix\Main\Diag\Debug::startTimeLabel('SomeLabel1');
//sleep(2);      //пауза 2 секунды    sleep - считает в секундах 
usleep(500000);  //пауза 0,5 секунды  usleep - считает в миллисекуднах
Bitrix\Main\Diag\Debug::endTimeLabel('SomeLabel1');
//Bitrix\Main\Diag\Debug::writeToFile(Bitrix\Main\Diag\Debug::getTimeLabels());
print_r('<pre>');
print_r('Bitrix\Main\Diag\Debug::getTimeLabels(): ');
print_r(Bitrix\Main\Diag\Debug::getTimeLabels());
print_r('</pre>');
*/



//7. region Отладка
/*
$backTrace = \Bitrix\Main\Diag\Helper::getBackTrace($limit = 0, $options = null);

print_r('<pre>');
print_r('$backTrace: ');
print_r($backTrace);
print_r('</pre>');

print_r('<pre>');
print_r('debug_print_backtrace(): ');
print_r(\debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
print_r('</pre>');

*/




//8. region Отладка SQL
/*
use Bitrix\Main\Loader;
use Bitrix\Main\Application;

if (!Loader::includeModule('iblock'))
{
	return false;
}


$IBLOCK_ID = 7;

//Параметры выборки
$arEntityDataParams = [
	'select' => ['ID', 'NAME'],
	'filter' => ['IBLOCK_ID' => $IBLOCK_ID, 'ACTIVE' => 'Y'],
	'limit'  => 5
	];

//Включаем трекинг SQL
$connection = Application::getConnection();
$connection->startTracker();

//Выполняем запрос
$query = \Bitrix\Iblock\ElementTable::getList($arEntityDataParams);
$result = $query->fetchAll();  //Можно или featch в цыкле

// Отключаем трекер
$connection->stopTracker();


// Получаем SQL запрос
$sql = $query->getTrackerQuery()->getSql();

//Вывод
echo "<pre>";
print_r($result);
echo "SQL запрос:\n" . $sql;
echo "</pre>";


*/


























require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');

