<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("task5");
?>

<?
//$APPLICATION->SetTitle('Вывод связанных полей');

use Bitrix\Main\Loader;
use Bitrix\Iblock\Iblock;
Loader::includeModule('iblock');


$iblockId = 16;
//$iblockElementId = 32;

//Old API
$arFilter = ['IBLOCK_ID' => $iblockId, 'ACTIVE' => 'Y'];
$arSelect = ['ID', 'NAME', 'CODE'];  //, 'PROPERTY_MODEL'
$res = CIBlockElement::GetList([], $arFilter, false, [], $arSelect);
while($arFields = $res->fetch()){
	pr($arFields);
}



?>





































<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>