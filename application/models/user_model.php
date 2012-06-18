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
	
	/**
	 * Enter description here ...
	 * @param unknown_type $type
	 * @param unknown_type $user_profile
	 * @return Ambigous <multitype:, boolean, multitype:unknown string , multitype:unknown Ambigous <> >
	 */
	function oauth_login($type, $user_profile) {
		$user_info = array();
		if ($type == "facebook") {
			$auth["facebook_id"] = $user_profile["id"];
			if (!$user_info = $this->get_user_info($auth)) {
				// 初回の認証
				$data = array(
					"login_id"	=> md5(uniqid()),
					"name"		=> $user_profile["name"],
					"email"		=> $user_profile["email"],
					"password"	=> md5(uniqid()),
				);
				$user_info = $this->signup($data);
				$this->set_facebook($user_profile["id"], $user_info["id"]);
			}
		}
		return $user_info;
	}
	
	function set_facebook($facebook_id, $id) {
		$data["facebook_id"] = $facebook_id;
		$this->update($data, $id);
	}
	
	function signup($input) {
		$result = false;
		$data = array(
			"login_id"		=> $input["login_id"],
			"name"			=> $input["name"],
			"email"			=> $input["email"],
			"password"	=> $this->hash_password($input["password"]),
			"status"	=> USER_STATUS_APPROVAL,
		);
		if ($id = parent::insert($data)) {
			$result = array(
				"id"			=> $id,
				"login_id"		=> $input["login_id"],
				"facebook_id"	=> $input["facebook_id"],
				"name"			=> $input["name"],
 				"email"			=> $input["email"]
			);
		}
		return $result;
	}
	
	function login($login_id, $password) {
		$user_info = $this->get_row(array("login_id" => $login_id, "status" => USER_STATUS_APPROVAL));
		if ($user_info["password"] === $this->hash_password($password)) {
			return array(
					"id"			=> $user_info["id"],
					"login_id"		=> $user_info["login_id"],
					"facebook_id"	=> $user_info["facebook_id"],
					"name"			=> $user_info["name"],
					"email"			=> $user_info["email"]
			);
		} else {
			log_message('debug', print_r(array($user_info,$this->hash_password($password)), true));
			return FALSE;
		}
	}
	
	function get_user_info($auth) {
		$auth = array_merge($auth, array("status" => USER_STATUS_APPROVAL));
		$result = array();
		if ($user_info = $this->get_row($auth)) {
			$result = array(
				"id"			=> $user_info["id"],
				"login_id"		=> $user_info["login_id"],
				"facebook_id"	=> $user_info["facebook_id"],
				"name"			=> $user_info["name"],
				"email"			=> $user_info["email"]
				);
		}
		return $result;
	}
}