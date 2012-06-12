<?php
class Point_model extends MY_Model {
	
	function __construct(){
		parent::__construct("points");
	}
	
	function get_structure() {
		return array(
				"id" => array(
					'name' => 'id',
					'type' => 'text',
					'rule' => array('numeric'),
				),
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
				"image" => array(
					'name' => '画像',
					'type' => 'text',
					'rule' => array('file_allowed_type[image]')
				),
		);
	}
	
	function get_row($wheres, $fields = array()) {
		$data = parent::get_row($wheres, $fields);
		$data["image"] = $this->_image_parse($data["image"]);
		return $data;
	}
	
	function get_route($id) {
		$sql = "SELECT points.*".
			" FROM points, routes".
			" WHERE points.id = routes.point_id".
			" AND  schedule_id = ?".
			" ORDER BY sort ASC";
		$rows = array();
		$query = $this->db->query($sql, $id);
		foreach($query->result_array() as $row) {
			$row["image"] = $this->_image_parse($row["image"]);
			$rows[] = $row;
		}
		return $rows;
	}
	
	private function _image_parse($image) {
		if ($image) {
			return unserialize($image);
		} else {
			return null;
		}
	}
	
	function insert($input) {
		if (!$user_info = $this->phpsession->get("user_info")) {
			return array();
		}
		$data = array(
			"owner"			=> $user_info["id"],
			"name"			=> $input["name"],
			"description"	=> $input["description"],
			"stay_time"		=> $input["stay_time"],
			"x"				=> $input["x"],
			"y"				=> $input["y"],
			"like_count"	=> 0,
			"category"		=> $input["category"],
			"tags"			=> $input["tags"],
			"status"		=> POINT_STATUS_ENABLED
		);
		if ($input["image"]["tmp"]) {
			unset($input["image"]["tmp"]["file_path"]);
			unset($input["image"]["tmp"]["full_path"]);
			$data["image"] = serialize($input["image"]["tmp"]);
		}
		return parent::insert($data);
	}
	
	function update($input, $id) {
		$data = array(
			"name"			=> $input["name"],
			"description"	=> $input["description"],
			"stay_time"		=> $input["stay_time"],
			"x"				=> $input["x"],
			"y"				=> $input["y"],
			"like_count"	=> 0,
			"category"		=> $input["category"],
			"tags"			=> $input["tags"],
			"status"		=> POINT_STATUS_ENABLED
		);
		if (!isset($input["image"])) {
			$data["image"] = "";
		} elseif ($input["image"]["tmp"]) {
			unset($input["image"]["tmp"]["file_path"]);
			unset($input["image"]["tmp"]["full_path"]);
			$data["image"] = serialize($input["image"]["tmp"]);
		}
		return $this->updates($data, array("id" => $id));
	}
}