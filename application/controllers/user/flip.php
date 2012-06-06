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
	
	function add() {
		$this->_set_validation($this->form_data);
		if ($this->form_validation->run() == FALSE) {
			return $this->render_view("user/flip/form");
		}
		$data = $this->input->post();
		$config['upload_path'] = FCPATH.'uploads/flip/origin/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['encrypt_name'] = true;
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload("image")) {
			$error = array('error' => $this->upload->display_errors());
			return $this->render_view("user/flip/form");
		} else {
			$data["image"] = $this->upload->data();
 			$this->load->library('image_lib');
			// アプリ用にリサイズ
			$img_config = array(
				'image_library'		=> 'gd2',
//				'image_library'		=> 'imagemagick', 'library_path' => '/opt/local/bin/',
				'source_image'		=> $data["image"]["full_path"],
				'new_image'			=> FCPATH.'uploads/flip/middle/',
				'maintain_ratio'	=> TRUE,
				'width'				=> 1000,
				'height'			=> 700
				);
			$this->image_lib->initialize($img_config);
			$this->image_lib->resize();
			// サムネイル
			$img_config['source_image']	= $data["image"]["full_path"];
 			$img_config['new_image']	= FCPATH.'uploads/flip/thumb/';
			$img_config['width']		= 110;
			$img_config['height']		= 81;
			$this->image_lib->initialize($img_config);
			$this->image_lib->resize();
		}
		$tags = $this->Tag_model->tag_keys(json_decode($data["tags"]));
		$data["tags"] = implode(",", $tags);
		$this->Point_model->insert($data);
		redirect("user/top");
	}
	
	function update() {
		$this->render_view("user/flip/form");
	}
	
	function delete() {
		
	}
}