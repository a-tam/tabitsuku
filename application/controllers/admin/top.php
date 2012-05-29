<?php
class Top extends MY_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		if ($this->admin_auth() === FALSE) {
			$this->render_view("admin/login");
		} else {
			$this->top();
		}
	}
	
	
	function login() {
		$this->load->model("Admin_model");
		$admin_id = $this->input->post("admin_id");
		$admin_pw = $this->input->post("admin_pw");
		if ($this->Admin_model->login($admin_id, $admin_pw)) {
			$this->phpsession->set("admin_info", "admin");
			$this->admin_info = "admin";
			$this->top();
		} else {
			$this->render_view("admin/login");
		}
	}
	
	function logout() {
		$this->phpsession->clear("admin_info");
		$this->render_view("admin/login");
	}

	function top() {
		$this->render_view("admin/top");
	}
	
}