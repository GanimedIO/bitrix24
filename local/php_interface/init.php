<?php
//����������� ������� - ��� ����������� ��������� �������
include_once __DIR__ . '/../app/autoload.php';


 CModule::AddAutoloadClasses(
        '', // �� ��������� ��� ������
        array(
           // ���� - ��� ������, �������� - ���� ������������ ����� ����� � ����� � �������
                'App\Debug\Log' => '/local/App/Debug/Log.php',
		//'App\Models\Lists' => '/local/App/Models/Lists/DoctorsPropertyValuesTable.php'
               
        )
);




//����� ������
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




//��������� �������
include_once __DIR__ . '/../task24/events.php';

//���� ������ REST
include_once __DIR__ . '/../task30/OriginalContactsDataTable.php';
include_once __DIR__ . '/../task30/events.php';


