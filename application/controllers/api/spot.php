<?php
class Spot extends MY_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model("Spot_model");
		$this->load->model("Tag_model");
		$this->load->model("Category_model");
	}
		
	function index() {
		$request = array(
				"ne_x"		=> $this->input->get("ne_x"),
				"sw_x"		=> $this->input->get("sw_x"),
				"ne_y"		=> $this->input->get("ne_y"),
				"sw_y"		=> $this->input->get("sw_y"),
				"category"	=> $this->input->get("category"),
				"keyword"	=> $this->input->get("keyword"),
		);
		$page 		= $this->input->get("page");
		$limit		= $this->input->get("limit");
		$sort		= $this->input->get("sort");
		$sort_type	= $this->input->get("sort_type");
		
		if (!$limit) $limit = 20;
		if (!$page) $page = 1;
		$offset = ($page - 1) * $limit;
		$request["tags"] = $this->Tag_model->tag_keys(array($condition["keyword"]));
		$spot = $this->Spot_model->search($request, $offset, $limit, null, $sort, $sort_type);
		if ($spot["list"]) {
			$spot["relation"]["categories"] = $this->Category_model->get_names($spot["relation"]["categories"]);
			$spot["relation"]["tags"] 		= $this->Tag_model->tag_values($spot["relation"]["tags"]);
		}
// 		print "<pre>";
// 		print_r($spot);
		print json_encode($spot);
	}
}