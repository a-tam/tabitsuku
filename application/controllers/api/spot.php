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
			"name"		=> $this->input->get("name"),
			"tag"		=> $this->input->get("tag"),
			"keyword"	=> $this->input->get("keyword"),
			"owner"		=> "",
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
		$request["tags"] = $this->Tag_model->tag_keys(array($request["keyword"]));
		$spot = $this->Spot_model->search($request, $offset, $limit, null, $sort, $sort_type);
		
		if ($spot["list"]) {
			$spot["relation"]["categories"] = $this->Category_model->get_names($spot["relation"]["categories"]);
			$spot["relation"]["tags"] 		= $this->Tag_model->tag_values($spot["relation"]["tags"]);
		}
		print json_encode($spot);
	}
	
	function get($id) {
		
	}
	
	function add() {
		if (!$this->auth()) return $this->login_form();
		$this->_set_validation($this->form_data);
		$data = $this->phpsession->set_post($this->ns, "point", $this->form_data);
		if ($this->form_validation->run() == FALSE) {
			return $this->render_view("user/spot/form", $data);
		}
		if ($data["image"]["tmp"]) {
			$this->load->library('image_lib');
			// アプリ用にリサイズ
			$img_config = array(
					'image_library'		=> 'gd2',
					//	'image_library'		=> 'imagemagick', 'library_path' => '/opt/local/bin/',
					'source_image'		=> $data["image"]["tmp"]["full_path"],
					'new_image'			=> FCPATH.'uploads/spot/middle/',
					'maintain_ratio'	=> TRUE,
					'width'				=> 1000,
					'height'			=> 700
			);
			$this->image_lib->initialize($img_config);
			$this->image_lib->resize();
			// サムネイル
			$img_config['source_image']	= $data["image"]["tmp"]["full_path"];
			$img_config['new_image']	= FCPATH.'uploads/spot/thumb/';
			$img_config['width']		= 110;
			$img_config['height']		= 81;
			$this->image_lib->initialize($img_config);
			$this->image_lib->resize();
			// オリジナルデータを移動
			rename($data["image"]["tmp"]["full_path"], FCPATH.'uploads/spot/origin/'.$data["image"]["tmp"]["file_name"]);
		}
		$tags = $this->Tag_model->tag_keys($data["tags"]["name"]);
		$data["tags"] = implode(",", $tags);
		if ($data["id"]) {
			$this->Spot_model->update($data, $data["id"]);
		} else {
			$this->Spot_model->insert($data, $this->user_info["id"]);
		}
	}
}