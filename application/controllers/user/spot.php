<?php
class Spot extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->ns = md5(__FILE__);
		$this->load->model("Spot_model");
		$this->load->model("Tag_model");
		$this->load->library('user_agent');
		$this->load->model("Category_model");
		$this->form_data = $this->Spot_model->get_structure();
	}

	function form($id = "") {
		if (!$this->auth()) return $this->login_form();
		if (!$id) {
			$data = array(
				"tags"	=> array()
			);
		} else {
			$data = $this->Spot_model->row($id);
		}
		$data["category_names"] = $this->Category_model->get_names($data["category_keys"]);
		$data["tags"]["name"] = $this->Tag_model->tag_values($data["tags"]);
		
		$this->phpsession->set("point", $data, $this->ns);
		$this->_set_validation($this->form_data);
		/*
		if ($smartphone = $this->agent->is_smartphone()) {
		  $this->load->view("user/spot/smartphone", $data);
		} else {
		  $this->render_view("user/spot/form", $data);
		}
		*/
		$this->render_view("user/spot/form", $data);
	}
	
	function add() {
		if (!$this->auth()) return $this->login_form();
		$this->_set_validation($this->form_data);
		$data = $this->phpsession->set_post($this->ns, "point", $this->form_data);
		if ($this->form_validation->run() == FALSE) {
			if ($data["category"]) {
				$category_keys = array();
				foreach ($data["category"] as $category_path) {
					preg_match_all("/\d+/", $category_path, $cateogry);
					$category_keys = array_merge($category_keys, $cateogry[0]);
				}
				$data["category_names"] = $this->Category_model->get_names($category_keys);
			}
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
			$img_config['width']		= 320;
			$img_config['height']		= 240;
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

		$this->phpsession->clear($this->ns, "point");
		$this->phpsession->flashsave("saved", $data["name"]);
		
// 		if ($data["id"]) {
// 			redirect("user/spot/form/".$data["id"]);

// 		} else {
			redirect("user/spot/form?_lat=".$data["lat"]."&_lng=".$data["lng"]."&_zoom=".$data["zoom"]);
				
// 		}
	}
	
	function update() {
		if (!$this->auth()) return $this->login_form();
		$this->render_view("user/spot/form");
	}
	
	function delete($id) {
		if (!$this->auth()) return $this->login_form();
		$this->Spot_model->delete($id);
		redirect("spot/search");
	}
	
	function like_plus() {
		$user_id = $this->input->post("user_id");
		$spot_id = $this->input->post("spot_id");
		log_message("error", $spot_id);
		$this->Spot_model->like_plus($spot_id);
		print json_encode("success");
	}
	
	function like_minus() {
		$user_id = $this->input->post("user_id");
		$spot_id = $this->input->post("spot_id");
		log_message("error", $spot_id);
		$this->Spot_model->like_minus($spot_id);
		print json_encode("success");
	}
}