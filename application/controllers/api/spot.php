<?php
class Spot extends MY_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model("Spot_model");
	}
		
	function index() {
		$fields = array();
		$wheres = array();
		$limit = 20;
		$page = 1;
		$offset = ($page - 1 ) * $limit;
		$sorts = array();
		
		$data = $this->Spot_model->select($fields, $wheres, $limit, $offset, $sorts);
		$result["count"] = $data->num_rows();
		$result["list"] = array();
		if ($data->num_rows() > 0) {
			foreach($data->result_array() as $row)
			$result["list"][] = $row;
		}
		print json_encode($result);
	}
}