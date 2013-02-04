<?php
class Category extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model("Category_model");
	}
	
	function index() {
	}
	
	function test() {
// 		print '<html lang="ja">';
// 		print '<head><meta http-equiv="content-type" content="text/html; charset=utf-8"></head><body><pre>';
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
// 		print_r($data);
		header("Content-Type: text/json");
		print json_encode($data);
	}
	
	function tree($id) {
// 		print '<html lang="ja">';
// 		print '<head><meta http-equiv="content-type" content="text/html; charset=utf-8"></head><body><pre>';
		$node = $this->input->get("id", true);
		if ($node) {
			$this->test();
		} else {
			$tree = $this->Category_model->get_tree($id);
// 			print_r($tree);
			header("Content-Type: text/json");
			print json_encode($tree);
		}
	}
	
	function node($id = "") {
		$rows = array();
		if ($id) {
			$rs = $this->Category_model->get_list($id);
			foreach($rs->result_array() as $row) {
				$rows[$row["id"]] = $row["name"];
			}
		}
		header("Content-Type: text/json");
		print json_encode($rows);
	}
}