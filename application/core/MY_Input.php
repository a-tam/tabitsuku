<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class MY_Input extends CI_Input {
	
	function __construct() {
		parent::__construct();
	}
	
	function post_all($xss_clean = FALSE) {
		if ($xss_clean === TRUE) {
			foreach ($_POST as $i => $post) {
				$posts[$i] = $this->post($i, $xss_clean);
			}
			return $posts;
		} else {
			return $_POST;
		}
	}
	
	function clear_post() {
		$_POST = array();
	}
}
