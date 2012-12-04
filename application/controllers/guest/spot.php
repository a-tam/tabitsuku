<?php
class Spot extends MY_Controller {
	
	function __construct() {
		parent::__construct();
		$this->auth();
		$this->load->model("Category_model");
		$this->load->model("Spot_model");
		$this->load->model("Tag_model");
		$this->load->model("Tour_model");
	}
	
	function map() {
		$this->render_view('guest/spot/map', $data);
	}
}