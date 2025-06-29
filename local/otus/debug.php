<?php

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("debug.php");

$date_time = date("Y-m-d H:i:s");
Bitrix\Main\Diag\Debug::writeToFile($date_time, $varName = '$date_time', $fileName = 'local/logs/exceptions.log');

$hh = 1/0;   //���������� ���������� �� �������� � ���� exceptions.log  �������� ������ �������������� ���������������� ������� � .sittings_extra.php













//1. ����� ������� �������� (�������� � ���������)
/*
print_r('<pre>');
print_r('$_SERVER: ');
print_r($_SERVER);
print_r('</pre>');
*/


//2. ������������� ������� ���� ���������
/*
print_r('<pre>');
print_r('var_dimp($_SERVER): ');
print_r(var_dump($_SERVER));
print_r('</pre>');
*/

//3. dump(); - ����������  �� sumphony � ����� �������� ������� � �������
/*
dump($_SERVER);

*/


//4. sage(); - ����������  �� sage � ����� �������� ������� � �������
/*
sage($_SERVER);

*/


//4. sagetrace(); - ����������  �� sage � ��������� ������ � ����� ��� ��������� ������
/*
sagetrace($_SERVER);

*/


//5. region ����������� - ��������� ���
/*
\App\Debug\Log::addLog('������� �������� /otus/debug/debug.php');
*/

//������� �����������

Bitrix\Main\Diag\Debug::writeToFile($_SERVER, $varName = '$_SERVER', $fileName = '');
Bitrix\Main\Diag\Debug::dumpToFile($_SERVER, $varName = '$_SERVER', $fileName = '');



//6. region �������������� (������������ ������� ���������� ����)
/*
Bitrix\Main\Diag\Debug::startTimeLabel('SomeLabel1');
//sleep(2);      //����� 2 �������    sleep - ������� � �������� 
usleep(500000);  //����� 0,5 �������  usleep - ������� � �������������
Bitrix\Main\Diag\Debug::endTimeLabel('SomeLabel1');
//Bitrix\Main\Diag\Debug::writeToFile(Bitrix\Main\Diag\Debug::getTimeLabels());
print_r('<pre>');
print_r('Bitrix\Main\Diag\Debug::getTimeLabels(): ');
print_r(Bitrix\Main\Diag\Debug::getTimeLabels());
print_r('</pre>');
*/



//7. region �������
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




//8. region ������� SQL
/*
use Bitrix\Main\Loader;
use Bitrix\Main\Application;

if (!Loader::includeModule('iblock'))
{
	return false;
}


$IBLOCK_ID = 7;

//��������� �������
$arEntityDataParams = [
	'select' => ['ID', 'NAME'],
	'filter' => ['IBLOCK_ID' => $IBLOCK_ID, 'ACTIVE' => 'Y'],
	'limit'  => 5
	];

//�������� ������� SQL
$connection = Application::getConnection();
$connection->startTracker();

//��������� ������
$query = \Bitrix\Iblock\ElementTable::getList($arEntityDataParams);
$result = $query->fetchAll();  //����� ��� featch � �����

// ��������� ������
$connection->stopTracker();


// �������� SQL ������
$sql = $query->getTrackerQuery()->getSql();

//�����
echo "<pre>";
print_r($result);
echo "SQL ������:\n" . $sql;
echo "</pre>";


*/


























require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');

