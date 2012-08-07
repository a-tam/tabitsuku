<?php
class Top extends MY_Controller {
	
	function __construct() {
		parent::__construct();
		$this->auth();
		$this->load->model("Category_model");
		$this->load->model("Spot_model");
		$this->load->model("Tag_model");
		$this->load->model("Tour_model");
	}
	
	function index() {
		//
		$request	= array();
		$offset		= 0;
		$limit		= 10;
		$sort		= "created_time";
		$sort_type	= "desc";

		// ツアー一覧
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
		$data["tours"] = $tour;

		// スポット一覧
		$limit		= 20;
		$sort		= "created_time";
		$sort_type	= "desc";
		$offset = 0;
		$request["tags"] = $this->Tag_model->tag_keys(array($condition["keyword"]));
		$spot = $this->Spot_model->search($request, $offset, $limit, null, $sort, $sort_type);
		if ($spot["list"]) {
			$spot["relation"]["categories"] = $this->Category_model->get_names($spot["relation"]["categories"]);
			$spot["relation"]["tags"] 		= $this->Tag_model->tag_values($spot["relation"]["tags"]);
		}
		$data["spots"] = $spot;
		
		$topics = array();
		// ツアー一覧
		$request["topic"] = "宮沢賢治特集";
		$topics = $this->Tour_model->search($request, $offset, $limit, null, $sort, $sort_type);
		if ($topics["list"]) {
			$routes = $this->Tour_model->get_routes(array_keys($topics["list"]));
			foreach ($routes as $tour_id => $route) {
				$topics["list"][$tour_id]["routes"] = $route;
			}
			$topics["relation"]["categories"] = $this->Category_model->get_names($topics["relation"]["categories"]);
			$topics["relation"]["tags"] 		= $this->Tag_model->tag_values($topics["relation"]["tags"]);
		}
		$data["topics"] = $topics;
		$this->render_view('guest/top', $data);
	}
	
	function login() {
		$this->render_view('guest/login');
	}
	
	function tour_search() {
		$this->render_view('guest/tour/search');
	}

	function spot_search() {
		$this->render_view('guest/spot/search');
	}
	
	function tour_show($id) {
		$data = $this->Tour_model->row($id);
		preg_match_all("/\d+/", $data["category"], $cateogry);
		$data["category_names"]	= $this->Category_model->get_names($cateogry[0]);
		$data["tag_names"]		= $this->Tag_model->tag_values(explode(",", $data["tags"]));
		$data["routes"] = $this->Spot_model->get_route($id);
		$this->render_view("guest/tour/show", $data);
	}
	
	
	function spot_show($id) {
		$data = $this->Spot_model->row($id);
		$data["category_names"]	= $this->Category_model->get_names($data["category_keys"]);
		$data["tag_names"]		= $this->Tag_model->tag_values($data["tags"]);
		$this->render_view("guest/spot/show", $data);
	}
	
	function phpinfo() {
		phpinfo();
	}
}