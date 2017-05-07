<?php
	require_once 'defs.php';

	/**
	 *
	 * Some constants you can use with the bookshelf_log function to set the log level
	 *
	 */
	define('_LOG_LEVEL_INFO', 0);
	define('_LOG_LEVEL_DEBUG', 1);
	define('_LOG_LEVEL_WARNING', 2);
	define('_LOG_LEVEL_ERROR', 3);

	define('_ERROR_TYPES', array('INFO','DEBUG','WARNING','ERROR'));

	/**
	 *
	 * Log function. It saves logs to the log file. See _MY_BOOKSHELF_LOG_FILE
	 * log_level				->				int, log level
	 * message					->				string, message to log
	 * <output_buffer>			->				<optional> bool, true = Print the message to the output buffer | false = Do not print the message in the output buffer. Default = false
	 * 
	 */
	function MB_LOG($log_level, $message, $output_buffer = false){
		if(($log_level >= count(_ERROR_TYPES)) || empty($message)){
			error_log(_ERROR_TYPES[_LOG_LEVEL_ERROR]."|Invalid error type specified or log message empty",_MY_BOOKSHELF_LOG_FILE);
		}else{
			if((($log_level == _LOG_LEVEL_DEBUG) && _DEBUG) || ($log_level != _LOG_LEVEL_DEBUG)){
				$log_message = _ERROR_TYPES[$log_level]."|".$message."\n";
				
				error_log($log_message, 3, _MY_BOOKSHELF_LOG_FILE);

				if($output_buffer)	print_r($log_message);
			}
		}
	}