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
	
	/**
	 * 追加
	 *
	 */
	function form($id = "") {
		if (!$this->auth()) return $this->login_form();
		if (!$id) {
			$default = array(
				"name" => "",
				"description" => "",
				"tags" => "",
				"routes" => array()
			);
		} else {
			$default = $this->Tour_model->row($id);
			$default["routes"] = $this->Spot_model->get_route($id);
		}
		$tags = $this->Tag_model->tag_values($default["tags"]);
		$default["tags"] = json_encode($tags);

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
		$tags 			= $this->Tag_model->tag_keys(json_decode($this->input->post("tags")));
		$data = array(
			"name"			=> $name,
			"description"	=> $description,
			"category"		=> $category,
			"tags"			=> implode(",", $tags),
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
		$rows = array();
		$wheres = array(
			"x < " => $this->input->get("ne_x"),
			"x > " => $this->input->get("sw_x"),
			"y < " => $this->input->get("ne_y"),
			"y > " => $this->input->get("sw_y"),
		);
		$limit = $this->input->get("limit");
		if (!$limit) $limit = 20;
		$page = $this->input->get("page");
		if (!$page) $page = 1;
		$offset = ($page - 1) * $limit;
		$point_list	= $this->Spot_model->select(array(), $wheres, $limit, $offset);
		$count		= $this->Spot_model->count($wheres);
		if ($count > 0) {
			foreach ($point_list->result_array() as $row) {
				$row["image"] = ($row["image"]) ? unserialize($row["image"]) : null;
				$rows[] = $row;
			}
		}
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
