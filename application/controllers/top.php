<?php
class Top extends MY_Controller {
	
	function __construct() {
		parent::__construct();
		$this->auth();
	}
	
	function index() {
		$this->render_view('guest/top');
	}
	
	function login() {
		$this->render_view('guest/login');
	}
	
	function tour_search() {
		$this->render_view('guest/tour_search');
	}

	function spot_search() {
		$this->render_view('guest/spot_search');
	}
	
	function phpinfo() {
		phpinfo();
	}
}