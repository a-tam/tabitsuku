<?php
class Tag extends MY_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model("Tag_model");
	}
	
	function index() {
		
	}
	
	function search() {
		$term = $this->input->get("term");
		$result = $this->Tag_model->like($term);
		print json_encode($result);
	}
}