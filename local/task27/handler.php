<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Quick start. Local server-side application</title>
</head>
<body>
	<div id="name">
		<?php
		require_once (__DIR__.'/crest.php');

	/*	$result = CRest::call('user.current');
		echo $result['result']['NAME'].' '.$result['result']['LAST_NAME'];*/
	
	
		 file_put_contents(
		    __DIR__ . '/log_handler/' . time() . '.txt',
		    var_export($_REQUEST, true)
		);
			
		
	

/*Получаем всю информацию о деле по идентификатору  ID дела */		
		$deloinf = CRest::call(
		    'crm.activity.get',
		    [
		        'id' => $_REQUEST['data']['FIELDS']['ID']
		    ]
		);
	
	
	
	    /* $ownerID = $deloinf['result']['OWNER_ID'];*/
		
	
/*Получаем поля контакта - ищем поле "Дата последней коммуникации"  UF_CRM_1758367071504*/	
	$contactInf = CRest::call(
    'crm.contact.get',
    [
        'ID' => $deloinf['result']['OWNER_ID']
    ]
);
	
/*	$dateComunik = $contactInf['result']['UF_CRM_1758367071504'];*/
/*	$dateComunik = '2025-01-01T03:00:00+03:00';  */
	


	$dateComunik = date('Y-m-d H:i:s', $_REQUEST['ts']);
	
	
/*Заполняем поле UF_CRM_1758367071504 датой из   $_REQUEST['ts']  */
	
	$result = CRest::call(
    'crm.contact.update',
    [
        'ID' => $deloinf['result']['OWNER_ID'],
        'FIELDS' => [
            'UF_CRM_1758489094499' => $dateComunik
        ]
    ]
);
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	 file_put_contents(
		    __DIR__ . '/log_handler1/' . time() . '.txt',
		    var_export($contactInf, true)
		);
	
	
	
	
	
	
	
	
	
		
	/*
	,"result":{"result":{"ID":"56","OWNER_ID":"4","OWNER_TYPE_ID":"3","TYPE_ID":"6","PROVIDER_ID":"CRM_TODO
		echo '<PRE>';
		print_r($result);
		echo '</PRE>';

	*/
	
		
		?>
	</div>
	

	
</body>
</html>


