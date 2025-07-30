<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
/** @global $APPLICATION */
$APPLICATION->SetTitle('Врачи');
$APPLICATION->SetAdditionalCSS('/doctors/style.css');

//модели работающие с инфоблоками
use Models\Lists\DoctorsPropertyValuesTable as DoctorsTable;
use Models\Lists\ProcsPropertyValuesTable as ProcsTable;


//массивы для сохранения полученных данных

$doctors = [];
$doctor = [];
$procs = [];

$path = trim($_GET['path'], '/');
$action = '';
$doctor_name = '';


if (!empty($path)) {
	$path_parts = explode('/', $path);
	
	
	if (sizeof($path_parts) < 3) { 	
		if (sizeof($path_parts) == 2 && $path_parts[0] == 'edit') {
			$action = 'edit';
			$doctor_name = $path_parts[1];		
		} else if (sizeof($path_parts) == 1 && in_array($path_parts[0],['new', 'newproc'])
			) {
			   $action = $path_parts[0];
			} else $doctor_name = $path_parts[0];   
	
	}
	
}


if (!empty($doctor_name)) {
	$doctor = DoctorTable::query()
		->setSelect([
			'*',
			'NAME' => 'ELEMENT.NAME',
			'PROC_IDS_MULTI',
			'ID' => 'ELEMENT.ID'
		])
		->where("NAME", $doctor_name)
		->fetch();
		
	if (is_array($doctor)) { 
	
		if($doctor['PROC_IDS_MULTI']) { //������� ������ �������
			$procs = ProcsTable::query()
				->setSelect(['NAME' => 'ELEMENT.NAME'])
				->where("ELEMENT.ID", "in", $doctor['PROC_IDS_MULTI'])
				->fetchAll();
		}
	}
	 else {
		header("Location: /doctors");
		exit();
	}

}


//���� �� ������ ������ � ���
//������� ���� ��������


if (empty($doctor_name) && empty($action)) {
	$doctors = DoctorsTable::query()
		->setSelect(['*', 'NAME' => "ELEMENT.NAME", "ID" => "ELEMENT.ID"])
		->fetchAll();		
}





?>

