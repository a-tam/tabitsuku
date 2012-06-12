<?php
class Flip extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->ns = md5(__FILE__);
		$this->load->model("Point_model");
		$this->load->model("Tag_model");
		$this->form_data = $this->Point_model->get_structure();
	}
	
	function form($id = "") {
		if (!$this->auth()) return $this->login_form();
		if (!$id) {
			$default = array(
				"x" => 35.6894875,
				"y" => 139.69170639999993,
				"tags" => array()
			);
		} else {
			$default = $this->Point_model->row($id);
		}
		$tags = $this->Tag_model->tag_values($default["tags"]);
		$default["tags"] = json_encode($tags);
		
		$this->phpsession->set("point", $default, $this->ns);
		$this->_set_validation($this->form_data);
		$this->render_view("user/flip/form", $default);
	}
	
	function add() {
		if (!$this->auth()) return $this->login_form();
		$this->_set_validation($this->form_data);
		$data = $this->phpsession->set_post($this->ns, "point", $this->form_data);
		if ($this->form_validation->run() == FALSE) {
			return $this->render_view("user/flip/form", $data);
		}
		if ($data["image"]["tmp"]) {
 			$this->load->library('image_lib');
			// アプリ用にリサイズ
			$img_config = array(
				'image_library'		=> 'gd2',
				//	'image_library'		=> 'imagemagick', 'library_path' => '/opt/local/bin/',
				'source_image'		=> $data["image"]["tmp"]["full_path"],
				'new_image'			=> FCPATH.'uploads/flip/middle/',
				'maintain_ratio'	=> TRUE,
				'width'				=> 1000,
				'height'			=> 700
				);
			$this->image_lib->initialize($img_config);
			$this->image_lib->resize();
			// サムネイル
			$img_config['source_image']	= $data["image"]["tmp"]["full_path"];
 			$img_config['new_image']	= FCPATH.'uploads/flip/thumb/';
			$img_config['width']		= 110;
			$img_config['height']		= 81;
			$this->image_lib->initialize($img_config);
			$this->image_lib->resize();
			// オリジナルデータを移動
			rename($data["image"]["tmp"]["full_path"], FCPATH.'uploads/flip/origin/'.$data["image"]["tmp"]["file_name"]);
		}
		$tags = $this->Tag_model->tag_keys(json_decode($data["tags"]));
		$data["tags"] = implode(",", $tags);
		if ($data["id"]) {
			$this->Point_model->update($data, $data["id"]);
		} else {
			$this->Point_model->insert($data);
		}
		$this->phpsession->clear($this->ns, "point");
		redirect("user/top");
	}
	
	function update() {
		if (!$this->auth()) return $this->login_form();
		$this->render_view("user/flip/form");
	}
	
	function delete() {
		if (!$this->auth()) return $this->login_form();
		
	}
}