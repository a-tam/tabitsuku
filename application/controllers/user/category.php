<?php
class Category extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model("Category_model");
	}
	
	function index() {
	}
	
	function test() {
		$id = $this->input->get("id", true);
		$this->list = $this->Category_model->get_list($id);
		$data = array();
		foreach($this->list->result_array() as $row) {
			$data[] = array(
				"attr" => array(
					"id" => "node_".$row["id"],
					"rel" => "default"
				),
				"data" => $row["name"],
				"state" => ($row["child_cnt"] > 0) ? "closed" : ""
			);
		}
		print json_encode($data);
	}
	
	function node() {
	}
}