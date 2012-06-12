<?php
class Schedule_model extends MY_Model {
	
	function __construct(){
		parent::__construct("schedules");
	}
	
	function get_structure() {
		return array(
				"name" => array(
						'name' => '名称',
						'type' => 'text',
						'rule' => array('required'),
				),
				"description" => array(
						'name' => '説明',
						'type' => 'text',
						'rule' => array('required'),
				),
				"category" => array(
					'name' => 'カテゴリ',
					'type' => 'category',
					'rule' => array('required'),
				),
				"tag" => array(
					'name' => 'タグ',
					'type' => 'text',
					'rule' => array(),
				),
		);
	}
	
	function insert($data) {
		if (!$user_info = $this->phpsession->get("user_info")) {
			return array();
		}
		$data["owner"]		= $user_info["id"];
		$data["like_count"]	= 0;
		$data["status"]		= SCHEDULE_STATUS_ENABLED;
		return parent::insert($data);
	}
}