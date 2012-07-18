<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Log extends CI_Log {

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Write Log File
	 *
	 * Generally this function will be called using the global log_message() function
	 *
	 * @param	string	the error level
	 * @param	string	the error message
	 * @param	bool	whether the error is a native PHP error
	 * @return	bool
	 */
	public function write_log($level = 'error', $msg, $php_error = FALSE)
	{
		if ($this->_enabled === FALSE)
		{
			return FALSE;
		}

		$level = strtoupper($level);

		if ( ! isset($this->_levels[$level]) OR ($this->_levels[$level] > $this->_threshold))
		{
			return FALSE;
		}

		$filepath = $this->_log_path.'log-'.date('Y-m-d').'.php';
		$message  = '';

		if ( ! file_exists($filepath))
		{
			$message .= "<"."?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?".">\n\n";
		}

		if ( ! $fp = @fopen($filepath, FOPEN_WRITE_CREATE))
		{
			return FALSE;
		}
		
		if (is_array($msg)) {
			$msg = print_r($msg, true);
		}

		$bt = debug_backtrace();
		$callback = $bt[1];
		$message .= date($this->_date_fmt).' ['.$level.'] '.(($level == 'INFO') ? ' -' : '-').' '.
				$callback["file"]." - ".$callback["function"]." - ".$callback["line"] . " \n ".$msg."\n";

		flock($fp, LOCK_EX);
		fwrite($fp, $message);
		flock($fp, LOCK_UN);
		fclose($fp);

		@chmod($filepath, FILE_WRITE_MODE);
		return TRUE;
	}

}
// END Log Class

/* End of file Log.php */
/* Location: ./system/libraries/Log.php */