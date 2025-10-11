<?php
require_once (__DIR__.'/crest.php');

$result = CRest::installApp();


$result = CRest::call('event.unbind',
    [
        'event' => 'onCrmActivityAdd',
        'handler' => 'https://cm88995.tw1.ru/local/task27/handler.php'
    ]);

$result = CRest::call('event.bind',
    [
        'event' => 'onCrmActivityAdd',
        'handler' => 'https://cm88995.tw1.ru/local/task27/handler.php'
    ]);








