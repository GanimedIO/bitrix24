<?php


use Bitrix\Main\EventManager;
use Bitrix\Main\Page\Asset;

$eventManager = EventManager::getInstance();
$asset	= Asset::getInstance();


// Обработка события   OnAfterCrmDealUpdate. При обновлении цены в сделке изменяется цена в Заявке
$eventManager->addEventHandler("crm", "OnAfterCrmDealUpdate", Array("MyClassFields", "СhangePriceAfterDealUpdate"));

Class MyClassFields
{
	public static function СhangePriceAfterDealUpdate(&$arFields)
	{
		//ваш код
			                                           // file_put_contents( __DIR__ . '/../task24/log_events/'. time() . '.txt', "вызывается метод класса при изменени сделки"); 			
			                                           // file_put_contents( __DIR__ . '/../task24/log_events/' . time() . '.txt', var_export($arFields, true)	);  // содержимое массива $arFields
		$PriceDeal = $arFields['OPPORTUNITY'];             //file_put_contents( __DIR__ . '/../task24/log_events/' . time() . '.txt', var_export($PriceDeal, true)	);  // содержимое массива $arFields
		$DealId = $arFields['ID']; 	
		
		$IB_ID = 21;

		
		//ищем ID Заявки в ИБ по ID сделки из события
		$arSelect = Array("ID","IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_SDELKA_ID", "PROPERTY_SUMMA", "PROPERTY_OTVETSTVENNYY");  
		$arFilter = Array("IBLOCK_ID"=>$IBLOCK_ID, "ACTIVE_DATE"=>"Y");  
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
		while ($element = $res->GetNext()) {
		if ($element['PROPERTY_SDELKA_ID_VALUE'] == $DealId){
	    		$Zayavka_ID = $element['ID'];
			}
		}

		CIBlockElement::SetPropertyValuesEx($Zayavka_ID, false, array("SUMMA" => $PriceDeal));
	}

}


// Обработка события   OnAfterIBlockElementUpdate. При обновлении цены в заявке изменяется цена в сделке


$eventManager = EventManager::getInstance();
$eventManager->addEventHandler("iblock", "OnAfterIBlockElementUpdate", Array("MyClassFieldsIB", "СhangePriceAfterZayavkaUpdate"));	


Class MyClassFieldsIB
{
	public static function СhangePriceAfterZayavkaUpdate(&$arFields)
	{
		$IDZayvka = $arFields['ID'];          //  'ID' => 64,
		$IB_ID = $arFields['IBLOCK_ID'];      //  'IBLOCK_ID' => '21'  


		$arSelect = Array("ID","IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_SDELKA_ID", "PROPERTY_SUMMA", "PROPERTY_OTVETSTVENNYY");  
		$arFilter = Array("IBLOCK_ID"=>$IB_ID, 'ID'=>$IDZayvka, "ACTIVE_DATE"=>"Y");  
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
		while ($element = $res->GetNext()) {
			$ZayavkaSUMMA = $element['PROPERTY_SUMMA_VALUE'];    // '988|RUB'
			$idSdelka = $element['PROPERTY_SDELKA_ID_VALUE'];
		} 








	$PriceZ = substr($ZayavkaSUMMA, 0, -4);

	
	$fieldsSdelka = array(
	    "OPPORTUNITY" => $PriceZ
	);


	$oDeal = new CCrmDeal(false);              // или new CCrmDeal(true); // Создаем объект CCrmDeal. Если нужно, чтобы учитывались права доступа, передаем true.
	$oDeal->Update($idSdelka, $fieldsSdelka);
		
 //file_put_contents( __DIR__ . '/../task24/log_events/' . time() . '.txt', var_export($idSdelka, true)	); 

	}
}

	