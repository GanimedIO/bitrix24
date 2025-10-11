<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');

use Bitrix\Main\Loader;
use Bitrix\Main\Entity\Query;
use local\task9\BookTable;

if (!Loader::includeModule('iblock')) {
    return;
}

$q = new Query(BookTable::class);
$q->setSelect([
    'ID',
    'TITLE',
    'YEAR',
    'PUBLISH_DATE',
    'PAGES',
    'DOCTOR_NAME' => 'DOCTOR_RECOMMENDS.NAME',

]);


$result = $q->exec();

/*
while ($arItem = $result->Fetch()){
pr($arItem);
}
*/


$books = [];
$doctors = [];
while ($arItem = $result->Fetch()){
	 if (!isset($doctors[$arItem['ID']])) {
       	     $books[$arItem['ID']] = [
 	        'TITLE' => $arItem['TITLE'],
        	'YEAR' => $arItem['YEAR'],
            	'PUBLISH_DATE' => $arItem['PUBLISH_DATE'],
            	'PAGES' => $arItem['PAGES'],
        ];
    }
    $doctors[$arItem['ID']][] = $arItem['DOCTOR_NAME'];
}

foreach ($books as $bookId => &$book){
	$book['DOCTORS'] = $doctors[$bookId];
}


pr($books);
pr($arItem);




require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');