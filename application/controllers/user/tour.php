<?php
class Tour extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->ns = md5(__FILE__);
		$this->load->model("Spot_model");
		$this->load->model("Tour_model");
		$this->load->model("Route_model");
		$this->load->model("Tag_model");
		$this->form_data = $this->Tour_model->get_structure();
	}
	
	/**
	 * 検索
	 *
	 */
	function index() {
		
	}
	
	function copy($id) {
		if (!$this->auth()) return $this->login_form();
		$default = $this->Tour_model->row($id);
		$default["routes"] = $this->Spot_model->get_route($id);
		$default["start_time"] = date("H:i", strtotime($default["start_time"]));
		$tags = $this->Tag_model->tag_values($default["tags"]);
		$default["tags"] = $tags;
		unset($default["id"]);
		$this->phpsession->set("tour", $default, $this->ns);
		$this->_set_validation($this->form_data);
		return $this->render_view("user/tour/form", $default);
	}
	
	/**
	 * 登録フォーム
	 *
	 */
	function form($id = "") {
		if (!$this->auth()) return $this->login_form();
		if (!$id) {
			$default = array(
				"name"			=> "",
				"description"	=> "",
				"tags"			=> "",
				"start_time"	=> "10:00",
				"routes"		=> array()
			);
		} else {
			$default = $this->Tour_model->row($id);
			$default["routes"] = $this->Spot_model->get_route($id);
			$default["start_time"] = date("H:i", strtotime($default["start_time"]));
		}
		$tags = $this->Tag_model->tag_values($default["tags"]);
		$default["tags"] = $tags;

		$this->phpsession->set("tour", $default, $this->ns);
		$this->_set_validation($this->form_data);
		return $this->render_view("user/tour/form", $default);
	}
	
	function add() {
		$valid_rule = $this->Tour_model->get_structure();
		$this->_set_validation($valid_rule);
		if ($this->form_validation->run() == FALSE) {
			return print json_encode(false);
		}
		$tour_id		= $this->input->post("id");
		$name			= $this->input->post("name");
		$description	= $this->input->post("description");
		$route			= $this->input->post("route");
		$category		= $this->input->post("category");
		$start_time		= $this->input->post("start_time");
		$tags 			= $this->Tag_model->tag_keys($this->input->post("tags"));
		$data = array(
			"name"			=> $name,
			"description"	=> $description,
			"start_time"	=> $start_time,
			"category"		=> $category,
			"tags"			=> $tags,
			"route"			=> $route
		);
		if ($tour_id) {
			$this->Tour_model->update($data, $tour_id);
		} else {
			$tour_id = $this->Tour_model->insert($data);
		}
		// ルート情報
		$this->input->post("description");
		$route_ids = $this->Route_model->update_all($tour_id, $route);
		print json_encode(array("tour_id" => $tour_id, "route_ids" => $route_ids));
	}
	
	function query() {
		$result;
		$ne_lat		= $this->input->get("ne_lat");
		$sw_lat		= $this->input->get("sw_lat");
		$ne_lng		= $this->input->get("ne_lng");
		$sw_lng		= $this->input->get("sw_lng");
		$limit		= $this->input->get("limit");
		$sort		= $this->input->get("sort");
		$category	= $this->input->get("category");
		$keyword	= $this->input->get("keyword");
		
		if (!$limit) {
			$limit = 20;
		}
		$page = $this->input->get("page");
		if (!$page) {
			$page = 1;
		}
		$offset = ($page - 1) * $limit;
		switch ($sort) {
			case "like_count":
			case "name":
				break;
			default:
				$sort = "name";
		}
		
		$rows = array();
		$sql = "SELECT * FROM ".$this->Spot_model->table;
		$where = " WHERE".
				" lat < ?".
			" AND lat > ?".
			" AND lng < ?".
			" AND lng > ?";
		$values = array(
			$ne_lat,
			$sw_lat,
			$ne_lng,
			$sw_lng
		);
		if (trim($keyword)) {
			$tag_keys = $this->Tag_model->tag_keys(array($keyword));
			$where .= " AND ( tags IN (".implode(",", $tag_keys).") OR name LIKE ? )";
			array_push($values, "%".$keyword."%");
		}
		if (trim($category)) {
			$where .= " AND category like ?";
			array_push($values, "%".$category."%");
		}
		$sql .= $where." ORDER BY ".$sort." LIMIT ".$offset.", ".$limit;
		$point_list = $this->Spot_model->db->query($sql, $values);
		foreach ($point_list->result_array() as $row) {
			$row["image"] = ($row["image"]) ? unserialize($row["image"]) : null;
			$rows[$row["id"]] = $row;
		}
		$sql = "SELECT COUNT(id) as cnt FROM ".$this->Spot_model->table.$where;
		$count_rs = $this->Spot_model->db->query($sql, $values);
		$row = $count_rs->row_array(1);
		$count = $row["cnt"];
		$result["count"] = $count;
		$result["list"] = $rows;
		print json_encode($result);
	}
	
	/**
	 * 更新
	 *
	 */
	function update() {
		if (!$this->auth()) return $this->login_form();
		$this->render_view("user/tour/form");
	}
	
	/**
	 * 削除
	 *
	 */
	function delete() {
		if (!$this->auth()) return $this->login_form();
	}
	
}
