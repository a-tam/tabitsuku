<?php
class Flip extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->ns = md5(__FILE__);
		$this->load->model("Point_model");
		$this->form_data = $this->Point_model->get_structure();
	}
	
	function index() {
		
	}
	
	function add() {
		$this->_set_validation($this->form_data);
		if ($this->form_validation->run() == FALSE) {
			return $this->render_view("user/flip/form");
		}
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload("image"))
		{
			$error = array('error' => $this->upload->display_errors());
			die("エラー");
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			die("成功");
			$this->load->view('upload_success', $data);
		}
		redirect ("user/");
	}
	
	function update() {
		$this->render_view("user/flip/form");
	}
	
	function delete() {
		
	}
}