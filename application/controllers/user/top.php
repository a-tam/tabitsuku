<?php
class Top extends MY_Controller {

	function Top()
	{
		parent::__construct();
		$this->ns = md5(__FILE__);
		$this->load->model("User_model");
		$this->form_data = $this->User_model->get_structure();
	}
	
	function index()
	{
		if (!$this->auth()) return $this->login_form();
		$this->render_view("user/top");
	}
	
	function singup() {
		$this->_set_validation($this->form_data);
		if ($this->form_validation->run() == FALSE) {
			return $this->login_form();
		}
		$this->User_model->insert($this->input->post());
	}
	
	function singout() {
		
	}
}