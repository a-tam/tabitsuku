<?php
class Top extends MY_Controller {
	
	function index() {
		$this->render_view('guest/top');
	}
	
	function login() {
		$this->render_view('guest/login');
	}
}