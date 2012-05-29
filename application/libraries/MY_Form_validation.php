<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

	public function __construct()
	{
		parent::__construct();
		$this->CI =& get_instance();
	}
	
	/**
	 * 重複チェック
	 * http://uniquemethod.com/unique-method-for-codeigniters-form-validation-class
	 * @param unknown_type $str
	 * @param unknown_type $val
	 * @return boolean
	 */
	function db_unique($str, $val) {
		list($table, $column) = explode('.', $val, 2);
		$query = $this->CI->db->query("SELECT NULL FROM $table WHERE $column = '$str'");
		return ($query->row()) ? FALSE : TRUE;
	}
}
