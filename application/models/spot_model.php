<?php
class Spot_model extends MY_Model {
	
	function __construct(){
		parent::__construct("spots");
	}
	
	function get_structure() {
		return array(
				"id" => array(
					'name' => 'id',
					'type' => 'text',
					'rule' => array('numeric'),
				),
				"lat" => array(
					'name' => '緯度',
					'type' => 'text',
					'rule' => array('required', 'numeric'),
				),
				"lng" => array(
					'name' => '経度',
					'type' => 'text',
					'rule' => array('required', 'numeric'),
				),
				"address" => array(
					'name' => '住所',
					'type' => 'text',
					'rule' => array('required'),
				),
				"name" => array(
					'name' => 'スポット',
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
				"keyword" => array(
					'name' => 'キーワード',
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
		preg_match_all("/\d+/", $data["category"], $cateogry);
		$data["category_keys"] = $cateogry[0];
		$data["category"] = explode(",", $data["category"]);
		$data["tags"] = explode(",", $data["tags"]);
		return $data;
	}
	
	function get_route($id) {
		$sql = "SELECT spots.id".
			", spots.name".
			", spots.image".
			", spots.description".
			", spots.stay_time AS defalut_time".
			", spots.lat".
			", spots.lng".
			", spots.like_count".
			", spots.category".
			", spots.tags".
			", spots.keyword".
			", routes.stay_time".
			", routes.info".
			" FROM routes".
			" LEFT JOIN spots ON spots.id = routes.spot_id".
			" WHERE tour_id = ?".
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
	
	function search($condition, $offset, $limit, $columns = array(), $sort = "created_time", $sort_type = "desc") {
		// init
		$list			= array();
		$category_keys	= array();
		$tag_keys 		= array();

		// select
		if ($columns) {
			foreach ($columns as $field) {
				$this->db->select($field);
			}
		}
		
		// from
		$this->db->from($this->table);
		
		// where
		$wheres = array();
		if ($condition["ne_lat"] && $condition["sw_lat"] && $condition["ne_lng"] && $condition["sw_lng"]) {
			$wheres[] = "lat < ".$condition["ne_lat"];
			$wheres[] = "lat > ".$condition["sw_lat"];
			$wheres[] = "lng < ".$condition["ne_lng"];
			$wheres[] = "lng > ".$condition["sw_lng"];
		}
		if ($condition["owner"]) {
			$wheres[] = "owner = '".mysql_real_escape_string($condition["owner"])."'";
		}
		if ($condition["category"]) {
			$wheres[] = "category like '%".mysql_real_escape_string($condition["category"])."%'";
		}
		if (trim($condition["keyword"])) {
			if ($condition["tags"]) {
				$_cond[] = "tags IN (".implode(",", $condition["tag"]).")";
			}
			$_cond[] = "name LIKE '%".$condition["keyword"]."%'";
			$wheres[] = implode(" OR ", $_cond);
		}
		if (trim($category)) {
			$wheres[] = "category like '%".$category."%'";
		}
		if ($wheres) {
			$this->db->where(implode(" AND ", $wheres));
		}
		
		// sort
		switch (strtolower($sort)) {
			case "like_count":
			case "name":
				break;
			default:
				$sort = "name";
		}
		$sort_type = (strtolower($sort_type) == "desc") ? "desc" : "asc";
		$this->db->order_by($sort, $sort_type);
		
		// limit
		if (is_numeric($limit)) {
			$this->db->limit($limit, $offset);
		}
		$query = $this->db->get();
		foreach($query->result_array() as $row) {
			preg_match_all("/\d+/", $row["category"], $cateogry);
			$category_keys = array_merge($category_keys, $cateogry[0]);
			preg_match_all("/\d+/", $row["tags"], $tags);
			$tag_keys = array_merge($tag_keys, $tags[0]);
			unset($row["addition"]);
			$row["image"] = unserialize($row["image"]);
			$list[$row["id"]] = $row;
		}
		
		// count
		$this->db->select("COUNT(*) AS cnt");
		$this->db->from($this->table);
		if ($wheres) {
			$this->db->where(implode(" AND ", $wheres));
		}
		$query = $this->db->get();
		$row = $query->row_array(1);
		$count = $row["cnt"];
		return (
			array(
				"relation" => array(
					"categories"	=> array_unique($category_keys),
					"tags"			=> array_unique($tag_keys),
				),
				"count"			=> $count,
				"list"			=> $list
				)
			);
	}
	
	function insert($input, $owner_id) {
		if (!$user_info = $this->phpsession->get("user_info")) {
			return array();
		}
		$data = array(
			"owner"			=> $user_info["id"],
			"name"			=> $input["name"],
			"description"	=> $input["description"],
			"stay_time"		=> $input["stay_time"],
			"lat"			=> $input["lat"],
			"lng"			=> $input["lng"],
			"like_count"	=> 0,
			"category"		=> implode(",", $input["category"]),
			"tags"			=> $input["tags"],
			"keyword"		=> $input["keyword"],
			"addition"		=> serialize($input["addition"]),
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
			"lat"			=> $input["lat"],
			"lng"			=> $input["lng"],
			"like_count"	=> 0,
			"category"		=> implode(",", array_filter($input["category"])),
			"tags"			=> $input["tags"],
			"keyword"		=> $input["keyword"],
			"addition"		=> serialize($input["addition"]),
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
	
	function like_plus($id) {
		$sql = "UPDATE  ". $this->table. " SET like_count =  like_count + 1 WHERE id = ?";
		$this->db->query($sql, $id);
	}
	
	function like_minus($id) {
		$sql = "UPDATE  ". $this->table. " SET like_count =  like_count - 1 WHERE id = ?";
		$this->db->query($sql, $id);
	}
}