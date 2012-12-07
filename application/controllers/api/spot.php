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
			"ne_lat"	=> $this->input->get("ne_lat"),
			"sw_lat"	=> $this->input->get("sw_lat"),
			"ne_lng"	=> $this->input->get("ne_lng"),
			"sw_lng"	=> $this->input->get("sw_lng"),
			"category"	=> $this->input->get("category"),
			"keyword"	=> $this->input->get("keyword"),
		);
		$owner		= $this->input->get("owner");
		$page 		= $this->input->get("page");
		$limit		= $this->input->get("limit");
		$sort		= $this->input->get("sort");
		$sort_type	= $this->input->get("sort_type");
		if ($owner) {
			switch ($owner) {
				case "mydata":
					if ($user_info = $this->phpsession->get("user_info")) {
						$request["owner"] = $user_info["id"];
					}
					break;
			}
		}
		
		if (!$limit) $limit = 20;
		if (!$page) $page = 1;
		if (!in_array($sort, array("created_time", "like_count", "name"))) $sort = "created_time";
		$offset = ($page - 1) * $limit;
		$request["tags"] = $this->Tag_model->tag_keys(array($condition["keyword"]));
		$spot = $this->Spot_model->search($request, $offset, $limit, null, $sort, $sort_type);
		if ($spot["list"]) {
			$spot["relation"]["categories"] = $this->Category_model->get_names($spot["relation"]["categories"]);
			$spot["relation"]["tags"] 		= $this->Tag_model->tag_values($spot["relation"]["tags"]);
		}
		print json_encode($spot);
	}
}