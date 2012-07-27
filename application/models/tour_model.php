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
	
	function insert($data) {
		if (!$user_info = $this->phpsession->get("user_info")) {
			return array();
		}
		$data["owner"]		= $user_info["id"];
		$data["like_count"]	= 0;
		$data["status"]		= SCHEDULE_STATUS_ENABLED;
		return parent::insert($data);
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
		/*
		if ($condition["ne_x"] && $condition["sw_x"] && $condition["ne_y"] && $condition["sw_y"]) {
			$wheres[] = "x < ".$condition["ne_x"];
			$wheres[] = "x > ".$condition["sw_x"];
			$wheres[] = "y < ".$condition["ne_y"];
			$wheres[] = "y > ".$condition["sw_y"];
		}
		*/
		if ($condition["category"]) {
			$wheres[] = "category like '%".mysql_real_escape_string($condition["category"])."%'";
		}
		if ($condition["owner"]) {
			$wheres[] = "owner = '".mysql_real_escape_string($condition["owner"])."'";
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