<?php
class User_model extends MY_Model {
	
	function __construct(){
		parent::__construct("users");
	}
	
	function get_structure() {
		return array(
				"login_id" => array(
						'name' => 'ユーザーID',
						'type' => 'text',
						'rule' => array('required', 'is_unique[users.login_id]', 'email'),
				),
				"name" => array(
						'name' => '名前',
						'type' => 'text',
						'rule' => array('required'),
				),
				"email" => array(
						'name' => 'Eメール',
						'type' => 'email',
						'attr' => array(
								'size' => 50
						),
						'rule' => array('email'),
				),
				"password" => array(
						'name' => 'パスワード',
						'type' => 'password',
						'rule' => array('required', 'min_length[8]'),
				),
		);
	}
	
	function signup($input) {
		$result = false;
		$data = array(
			"login_id"	=> $input["login_id"],
			"name"		=> $input["name"],
//			"email"		=> $input["email"],
			"password"	=> $this->hash_password($input["password"]),
			"status"	=> USER_STATUS_APPROVAL,
		);
		if ($id = parent::insert($data)) {
			$result = array(
				"id"		=> $id,
				"login_id"	=> $input["login_id"],
	 			"name"		=> $input["name"],
// 				"email"		=> $input["email"]
			);
		}
		return $result;
	}
	
	function login($login_id, $password) {
		$user_info = $this->get_row(array("login_id" => $login_id, "status" => USER_STATUS_APPROVAL));
		if ($user_info["password"] === $this->hash_password($password)) {
			return array(
					"id"		=> $user_info["id"],
					"login_id"	=> $user_info["login_id"],
					"name"		=> $user_info["name"],
					"email"		=> $user_info["email"]
			);
		} else {
			log_message('debug', print_r(array($user_info,$this->hash_password($password)), true));
			return FALSE;
		}
	}
}