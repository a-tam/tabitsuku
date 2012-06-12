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
	
	function phpinfo() {
		phpinfo();
	}
}