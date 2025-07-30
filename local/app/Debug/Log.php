<?php

namespace App\Debug;

/* 
 *  \Debug\Log::addLog('OnBeforeHLEAdd');
 */

use Bitrix\Main\Diag\ExceptionHandlerFormatter;
use Bitrix\Main\Diag\FileExceptionHandlerLog;

class Log extends FileExceptionHandlerLog
{
	private $level;

	public static function addLog($message, bool $clear = false, string $fileName = 'custom'): void
	{
		$logFile = $_SERVER["DOCUMENT_ROOT"] . '/local/logs/' . $fileName . '_' . date(format: "d.m.Y") . '.log';
		
		$_message = date(format: "d.m.Y H:i:s");
		$_message .= "\n";
		$_message .= print_r($message, return: true);
		$_message .= "\n";
		$_message .= "---";
		$_message .= "\n";
	
/*
		// ѕ–ќ¬≈–я≈ћ  кака€ цепочка методов и классов была вызвана до addLog
		$backTrace = \Bitrix\Main\Diag\Helper::getBackTrace($limit = 0, $options = null);

		print_r('<pre>');
		print_r('$backTrace: ');
		print_r($backTrace);
		print_r('</pre>');
	
		print_r('<pre>');
		print_r('debug_print_backtrace(): ');
		print_r(\debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
		print_r('</pre>');
		exit;
		// ѕ–ќ¬≈–я≈ћ  backTrace
*/




		if ($clear)
		{
			file_put_contents($logFile, $_message);
		}
		else
		{
			file_put_contents($logFile, $_message, flags: FILE_APPEND);
		}	

	}



}