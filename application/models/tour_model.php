<?php
class Tour_model extends MY_Model {
	
	function __construct(){
		parent::__construct("tours");
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

	function get_row($wheres, $fields = array()) {
		$data = parent::get_row($wheres, $fields);
		preg_match_all("/\d+/", $data["category"], $cateogry);
		$data["category_keys"] = $cateogry[0];
		$data["category"] = explode(",", $data["category"]);
		$data["tags"] = explode(",", $data["tags"]);
		return $data;
	}
	
	function insert($_data) {
		if (!$user_info = $this->phpsession->get("user_info")) {
			return array();
		}
		$data = array(
			"name"			=> $_data["name"],
			"description"	=> $_data["description"],
			"start_time"	=> $_data["start_time"],
			"category"		=> implode(",", $_data["category"]),
			"tags"			=> implode(",", $_data["tags"]),
			"owner"			=> $user_info["id"],
			"like_count"	=> 0,
			"status"		=> SCHEDULE_STATUS_ENABLED
		);
		if ($area = $this->get_route_area($_data["route"])) {
			$data["lat_min"] = $area["lat_min"];
			$data["lat_max"] = $area["lat_max"];
			$data["lng_min"] = $area["lng_min"];
			$data["lng_max"] = $area["lng_max"];
		}
		log_message("error", $data);
		return parent::insert($data);
	}
	
	function update($_data, $id) {
		if (!$user_info = $this->phpsession->get("user_info")) {
			return array();
		}
		$data = array(
			"name"			=> $_data["name"],
			"description"	=> $_data["description"],
			"start_time"	=> $_data["start_time"],
			"category"		=> implode(",", $_data["category"]),
			"tags"			=> implode(",", $_data["tags"]),
		);
		if ($area = $this->get_route_area($_data["route"])) {
			$data["lat_min"] = $area["lat_min"];
			$data["lat_max"] = $area["lat_max"];
			$data["lng_min"] = $area["lng_min"];
			$data["lng_max"] = $area["lng_max"];
		}
		return parent::update($data, $id);
	}
	
	/**
	 * ルートの範囲取得
	 * @param unknown_type $route
	 * @return boolean|multitype:unknown
	 */
	private function get_route_area($route) {
		log_message('error', $route);
		$lat_min = null;
		$lat_max = null;
		$lng_min = null;
		$lng_max = null;
		foreach ($route as $spot) {
			if ($spot["id"] > 0) {
				if (is_null($lat_min)) {
					$lat_min = $spot["lat"];
					$lat_max = $spot["lat"];
					$lng_min = $spot["lng"];
					$lng_max = $spot["lng"];
				}
				if ($lat_min > $spot["lat"]) $lat_min = $spot["lat"];
				if ($lat_max < $spot["lat"]) $lat_max = $spot["lat"];
				if ($lng_min > $spot["lng"]) $lng_min = $spot["lng"];
				if ($lng_max < $spot["lng"]) $lng_max = $spot["lng"];
			}
		}
		if (is_null($lat_min)) {
			return false;
		} else {
			return array(
				"lat_min" => $lat_min,
				"lat_max" => $lat_max,
				"lng_min" => $lng_min,
				"lng_max" => $lng_max,
			);
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
		// 地図検索
		if ($condition["ne_lng"] && $condition["sw_lng"] && $condition["ne_lat"] && $condition["sw_lat"]) {
			$wheres[] = "lng_max > ".$condition["sw_lng"];
			$wheres[] = "lng_min < ".$condition["ne_lng"];
			$wheres[] = "lat_max > ".$condition["sw_lat"];
			$wheres[] = "lat_min < ".$condition["ne_lat"];
		}
		// カテゴリ検索
		if ($condition["category"]) {
			$wheres[] = "category like '%".mysql_real_escape_string($condition["category"])."%'";
		}
		// ユーザ検索
		if ($condition["owner"]) {
			$wheres[] = "owner = '".mysql_real_escape_string($condition["owner"])."'";
		}
		// キーワード、タグ検索
		if (trim($condition["keyword"])) {
			if ($condition["tags"]) {
				$_cond[] = "tags IN (".implode(",", $condition["tag"]).")";
			}
			$_cond[] = "name LIKE '%".$condition["keyword"]."%'";
			$wheres[] = implode(" OR ", $_cond);
		}
		// 特集検索
		if (trim($condition["topic"])) {
			$wheres[] = "topic LIKE '".$condition["topic"]."'";
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
	
	function get_routes($tour_ids) {
		$routes = array();
		$sql = "SELECT routes.tour_id".
			", routes.spot_id".
			", spots.*".
			", routes.stay_time".
			", routes.info".
			" FROM routes LEFT JOIN spots".
			" ON routes.spot_id = spots.id".
			" WHERE routes.tour_id IN (".implode(",", $tour_ids).")".
			" ORDER BY routes.sort";
		$routes_query = $this->Tour_model->db->query($sql);
		foreach ($routes_query->result_array() as $row) {
			if ($row["image"]) {
				$row["image"] = unserialize($row["image"]);
			}
			$routes[$row["tour_id"]][] = $row;
		}
		return $routes;
	}
}