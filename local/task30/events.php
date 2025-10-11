<?php
namespace local\task30;


use Bitrix\Main\EventManager;
use Bitrix\Rest\RestException;
use Bitrix\Main\Event;
use Bitrix\Main\Engine\CurrentUser;

use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

$eventManager = EventManager::getInstance();
$eventManager->addEventHandlerCompatible('rest', 'OnRestServiceBuildDescription', ['local\task30\Events', 'OnRestServiceBuildDescriptionHandler']);




class Events
{
    /**
     * Register rest methods
     * Clear scope cache after register
     * Bitrix\Main\Data\Cache::clearCache(true, '/rest/scope/');
     * @return array[]
     */
    public static function OnRestServiceBuildDescriptionHandler()
    {
        Loc::getMessage('REST_SCOPE_TASK30.ORIGINALCONTACTSDATA');


        return [
            'task30.originalcontactsdata' => [
                'task30.originalcontactsdata.add' => [__CLASS__, 'add'],
		'task30.originalcontactsdata.del' => [__CLASS__, 'del'],
                'task30.originalcontactsdata.upd' => [__CLASS__, 'upd'],
		'task30.originalcontactsdata.read' => [__CLASS__, 'read'],

                \CRestUtil::EVENTS => [
                    //код в списке событий
                    'onAfterOOCDAdd' => [
                        'main', //модуль события
                        'onAfterTask30OriginalContactsDataAdd', //название события
                        [__CLASS__, 'prepareEventData'] //обработчик
                    ]
                ]
            ],
        ];
    }

    /**
     * Add element
     * @param $arParams - request params
     * @param $navStart - default start parameter (start from POST-data)
     * @param \CRestServer $server - server data
     * @return mixed
     * @throws RestException
     */
    public static function add ($arParams, $navStart, \CRestServer $server)
    {
	     	file_put_contents(__DIR__ . '/logs/' . time() . '.txt', 'PARAMS: '.var_export($arParams, true).PHP_EOL, FILE_APPEND);
	     	file_put_contents(__DIR__ . '/logs/' . time() . '.txt', 'NAV: '.var_export($navStart, true).PHP_EOL, FILE_APPEND);
		file_put_contents(__DIR__ . '/logs/' . time() . '.txt', 'SERVER: '.var_export($server, true).PHP_EOL, FILE_APPEND);

        $originDataStoreResult = OriginalContactsDataTable::add($arParams);
        if ($originDataStoreResult->isSuccess())
        {
            $id = $originDataStoreResult->getId();
            $arParams['ID'] = $id;
            $event = new Event('main', 'onAftertask30OriginalContactsDataAdd', $arParams);
            $event->send();

            return $id;
        }
        else
        {
            throw new RestException(
                json_encode($originDataStoreResult->getErrorMessages(), JSON_UNESCAPED_UNICODE),
                RestException::ERROR_ARGUMENT,
                \CRestServer::STATUS_OK
            );
        }
    }

    public static function del ($ID)   //значение первичного ключа
    {
      
	$result = OriginalContactsDataTable::delete($ID);

	return ($ID);
	
    }

 public static function upd ($arParams, $navStart, \CRestServer $server)
   
    {
	
file_put_contents(__DIR__ . '/logs/' . time() . '.txt', 'arParams: '.var_export($arParams, true).PHP_EOL, FILE_APPEND);



     $ID=$arParams['ID'];
	$result = OriginalContactsDataTable::update($ID, array(
			'ENTITY_ID' =>	$arParams['ENTITY_ID'],
			'ELEMENT_ID' => $arParams['ELEMENT_ID'],
			'TYPE_ID' => 	$arParams['TYPE_ID'],
			'VALUE_TYPE' => $arParams['VALUE_TYPE'],
			'VALUE' => 	$arParams['VALUE'],
			'NEW_VALUE' => 	$arParams['NEW_VALUE']
	));

//'NEW_VALUE' => 	new Type\String('NEW_VALUE')
	return ($ID);
	
    }


  public static function read ($arParams)   
    {
      
	$result = OriginalContactsDataTable::getList(array('select' =>array('ID', 'ENTITY_ID', 'ELEMENT_ID'), 'order'=>array('ELEMENT_ID'=>'asc')));
	
	//$result = BookTable::getList($parameters);
	$rows = $result->fetchAll();

	return ($rows);
	
    }

















    /**
     * Prepare data
     * @param $arguments - data
     * @param $handler - handler
     * @return mixed
     */
    public static function prepareEventData($arguments, $handler)
    {
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/logRestEvent.txt', 'A: '.var_export($arguments, true).PHP_EOL, FILE_APPEND);
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/logRestEvent.txt', 'H: '.var_export($handler, true).PHP_EOL, FILE_APPEND);

        /** @var Event $event */
        $event = reset($arguments);
        $response = $event->getParameters();

        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/logRestEvent.txt', 'R: '.var_export($response, true).PHP_EOL, FILE_APPEND);

        return $response;
    }
}