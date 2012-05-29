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
						'rule' => array('required', 'db_unique[users.login_id]', 'email'),
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
}