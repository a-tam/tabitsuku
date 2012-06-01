<?php
class Top extends MY_Controller {

	function __construct()
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
	
	function signup() {
		$this->_set_validation($this->form_data);
		if ($this->form_validation->run() == FALSE) {
			return $this->login_form();
		}
		$user_info = $this->User_model->signup($this->input->post());
		$this->phpsession->set("user_info", $user_info);
		redirect("user/top");
	}
	
	function login() {
		$login_id = $this->input->post("login_id");
		$password = $this->input->post("password");
		if (!$user_info = $this->User_model->login($login_id, $password)) {
			return $this->login_form();
		}
		$this->phpsession->set("user_info", $user_info);
		redirect("user/top");
	}
	
	function logout() {
		$this->phpsession->clear("user_info");
		redirect("top");
	}
}