<?php
class Tour extends MY_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model("Tour_model");
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
		$page		= $this->input->get("page");
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
		
		$offset = ($page - 1) * $limit;
		$request["tags"] = $this->Tag_model->tag_keys(array($condition["keyword"]));
		$tour = $this->Tour_model->search($request, $offset, $limit, null, $sort, $sort_type);
		if ($tour["list"]) {
			$routes = $this->Tour_model->get_routes(array_keys($tour["list"]));
			foreach ($routes as $tour_id => $route) {
				$tour["list"][$tour_id]["routes"] = $route;
			}
			$tour["relation"]["categories"] = $this->Category_model->get_names($tour["relation"]["categories"]);
			$tour["relation"]["tags"] 		= $this->Tag_model->tag_values($tour["relation"]["tags"]);
		}
		print json_encode($tour);
	}
}