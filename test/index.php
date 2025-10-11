<?php

$arSelect = Array("ID","IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_SDELKA_ID", "PROPERTY_SUMMA", "PROPERTY_OTVETSTVENNYY");  
		$arFilter = Array("IBLOCK_ID"=>21, "ID"=>64, "ACTIVE_DATE"=>"Y");  
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
		while ($element = $res->GetNext()) {
			$ttt = $element['PROPERTY_SUMMA'];
	
		}

print_r($ttt);

?>