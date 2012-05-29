<?php
class Admin_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function login($user_id, $password) {
		if ($user_id == "admin" && $password == "pass") {
			return true;
		} else {
			return false;
		}
// 		$user_info = $this->get_row(array("login_id" => $login_id, "status" => USER_STATUS_APPROVAL));
// 		if ($user_info["password"] === $this->hash_password($password)) {
// 			return array(
// 					"id"		=> $user_info["id"],
// 					"login_id"	=> $user_info["login_id"],
// 					"name"		=> $user_info["name"],
// 					"email"		=> $user_info["email"]
// 			);
// 		} else {
// 			return FALSE;
// 		}
	}
}