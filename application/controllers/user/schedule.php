<?php
class Schedule extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model("Point_model");
		$this->load->model("Schedule_model");
		$this->load->model("Route_model");
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
	function form() {
		return $this->render_view("user/schedule/form");
	}
	
	function add() {
		$valid_rule = $this->Schedule_model->get_structure();
		$this->_set_validation($valid_rule);
		if ($this->form_validation->run() == FALSE) {
			return print json_encode(false);
		}
		$name			= $this->input->post("name");
		$description	= $this->input->post("description");
		$route			= $this->input->post("route");
		$data = array(
			"name" => $name,
			"description" => $description,
		);
		$schedule_id = $this->Schedule_model->insert($data);
		$this->input->post("description");
		$route_ids = $this->Route_model->update_all($schedule_id, $route);
		print json_encode(array("schedule_id" => $schedule_id, "route_ids" => $route_ids));
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
		$point_list	= $this->Point_model->select(array(), $wheres, $limit, $offset);
		$count		= $this->Point_model->count($wheres);
		if ($count > 0) {
			foreach ($point_list->result_array() as $row) {
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
		$this->render_view("user/schedule/form");
	}
	
	/**
	 * 削除
	 *
	 */
	function delete() {
	}
	
}
