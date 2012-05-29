<?php
class Category extends MY_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model("Category_model");
	}
	
	function test() {
		$a = 1;
		$b = 100000000;
		for ($i = 1; $i < 100; $i++) {
			$b = ($a + $b) / 2;
			print $i.":".$b."<br />";
		}
	}
	
	function index($id = "") {
		if (!$this->admin_auth()) return $this->admin_login_form();
		$this->category_id = $id;
		$this->category = $this->Category_model->get_node($id);
		$this->list = $this->Category_model->get_list($id);
		$this->render_view("admin/category/top");
	}
	
	function add() {
		if (!$this->admin_auth()) return $this->admin_login_form();
		$category_id = $this->input->post("parent_id");
		$data = $this->input->post();
		$id = $this->Category_model->insert($data);
		redirect('admin/category/'.$category_id);
	}
	
	function update() {
		if (!$this->admin_auth()) return $this->admin_login_form();
		$update_value =  $this->input->post("update_value");
		$id =  $this->input->post("id");
		$this->Category_model->update(array("name" => $update_value), $id);
		print $update_value;
	}
	
	function delete($id) {
		if (!$this->admin_auth()) return $this->admin_login_form();
		$parent_id = $this->Category_model->one($id, "parent_id");
		$this->Category_model->disable($id);
		redirect('admin/category/'.$parent_id);
	}
	
	function move() {
		if (!$this->admin_auth()) return $this->admin_login_form();
		log_message('debug', print_r($this->input->post(), true));
	}
	
	function sort() {
		if (!$this->admin_auth()) return $this->admin_login_form();
		$parent_id = $this->input->post("parent_id");
		$orders = $this->input->post("orders");
		$this->Category_model->sort($parent_id, $orders);
	}
}