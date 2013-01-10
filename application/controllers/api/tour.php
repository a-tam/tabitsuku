<?php
class Tour extends MY_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model("Tour_model");
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
			"spot_id"	=> $this->input->get("spot_id"),
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
	
	function fb_event_add() {
		try {
			log_message('error', print_r($this->input->post(), true));
	      	$access_token = $this->facebook->getAccessToken();
	      	$privacy = "SECRET";
	      	switch (strtolower($this->input->post("privacy"))) {
	      		case "open":
	      			$privacy = "OPEN";
	      			break;
	      		case "friends":
	      			$privacy = "FRIENDS";
	      			break;
	      		case "secret":
	      			$privacy = "SECRET";
	      			break;
	      	}
	      	$id = $this->input->post("tour_id");
	      	$data = $this->Tour_model->row($id);
	      	$data["category_names"]	= $this->Category_model->get_names($data["category_keys"]);
	      	$data["tag_names"]		= $this->Tag_model->tag_values($data["tags"]);
	      	$data["routes"] = $this->Spot_model->get_route($id);
	      	log_message("error", print_r($data, true));
	      	$description = $this->input->post("description");
	      	$description .= "\n".base_url("tour/show/".$id);
	      	
			$event_param = array(
					"access_token"	=> $access_token,
					"name" 			=> $this->input->post("name"),
					"description"	=> $description,
					"start_time" 	=> date("c", strtotime($this->input->post("start_time"))),
					"end_time" 		=> date("c", strtotime($this->input->post("end_time"))),
					"privacy_type"	=> $privacy,
			);
	      	log_message("error", print_r($event_param, true));
			$ret_obj = $this->facebook->api('/me/events', "POST", $event_param);
			$ret = array(
					"status" => "success",
					"result" => $ret_obj["id"]
			);
			log_message("error", print_r($ret, true));
			echo json_encode($ret);
		} catch (FacebookApiException $e) {
	      	if ($e->getType() == "OAuthException") {
				$ret = array(
					"status" => "error",
					"result" => "permission"
				);
	      	}
			echo json_encode($ret);
//	      	header("Location: ".$login_url);
		}
	}
}