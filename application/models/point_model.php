<?php
class Point_model extends MY_Model {
	
	function __construct(){
		parent::__construct("points");
	}
	
	function get_structure() {
		return array(
				"x" => array(
					'name' => '経度',
					'type' => 'text',
					'rule' => array('required', 'numeric'),
				),
				"y" => array(
					'name' => '緯度',
					'type' => 'text',
					'rule' => array('required', 'numeric'),
				),
				"address" => array(
					'name' => '住所',
					'type' => 'text',
					'rule' => array('required'),
				),
				"name" => array(
					'name' => 'Eメール',
					'type' => 'text',
					'attr' => array(
							'size' => 50
					),
					'rule' => array('required'),
				),
				"stay_time" => array(
					'name' => '滞在時間',
					'type' => 'text',
					'rule' => array('required', 'integer'),
				),
				"description" => array(
					'name' => '説明',
					'type' => 'textarea',
					'rule' => array('required', 'min_length[10]'),
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
				"image" => array(
					'name' => '画像',
					'type' => 'text',
					'rule' => array('required', 'file_allowed_type[image]')
				),
		);
	}
	
	function insert($input) {
		if (!$user_info = $this->phpsession->get("user_info")) {
			return array();
		}
		$data = array(
			"owner"			=> $user_info["id"],
			"name"			=> $input["name"],
			"image"			=> $input["image"]["file_name"],
			"description"	=> $input["description"],
			"stay_time"		=> $input["stay_time"],
			"x"				=> $input["x"],
			"y"				=> $input["y"],
			"like_count"	=> 0,
			"category_ids"	=> $input["category"],
			"tags"			=> $input["tags"],
			"status"		=> POINT_STATUS_ENABLED
		);
		return parent::insert($data);
	}
}