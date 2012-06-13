<?php
class Tour extends MY_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model("Tour_model");
	}
	
	function index() {
		$data = $this->Tour_model->select();
		$result["count"] = $data->num_rows();
		$result["list"] = array();
		if ($data->num_rows() > 0) {
			foreach($data->result_array() as $row)
			$result["list"][] = $row;
		}
		print json_encode($result);
	}
}