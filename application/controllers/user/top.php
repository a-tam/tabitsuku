<?php
class Top extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->ns = md5(__FILE__);
		$this->load->model("User_model");
		$this->load->model("Category_model");
		$this->form_data = $this->User_model->get_structure();
	}
	
	function index()
	{
		if (!$this->auth()) return $this->login_form();
		$this->render_view("user/top");
	}
	
	function spot() {
		if (!$this->auth()) return $this->login_form();
		$this->render_view("user/spot");
	}
	
	function user_edit() {
		if (!$this->auth()) return $this->login_form();
		$this->load->view("user/edit", $data);
	}
	
	function signup() {
		$this->_set_validation($this->form_data);
		if ($this->form_validation->run() == FALSE) {
			return $this->login_form();
		}
		$user_info = $this->User_model->signup($this->input->post());
		$this->phpsession->set("user_info", $user_info);
		redirect("user/top", $data);
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
	
	/**
	 * facebook ログイン
	 *
	 */
	function fb_auth($redirect = "") {
		$user = $this->facebook->getUser();
		if ($user) {
			try {
				$user_profile = $this->facebook->api('/me');
				if (isset($user_profile["id"])) {
					$user_info = $this->User_model->oauth_login("facebook", $user_profile);
					$this->phpsession->set("user_info", $user_info);
					switch ($redirect) {
						case "tour":
							redirect("user/tour/form");
							break;
							
						case "spot":
							redirect("user/spot/form");
							break;
							
						case "mypage":
							redirect("user/top");
							break;
							
						default:
							redirect("top");
					}
				}
			} catch (FacebookApiException $e) {
				$user = null;
			}
		} else {
			// ログイン画面
			$this->login_form();
		}
	}
}