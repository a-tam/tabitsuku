<?php
class Tag extends MY_Controller {
	
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
	
	function top() {
		$this->render_view("admin/tag/index");
	}
}