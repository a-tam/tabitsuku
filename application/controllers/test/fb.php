<?php
class Fb extends CI_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		print 1;
	}
	
	function html5() {
		$this->load->view("test/fb_html5");
	}
	
	function iframe() {
		$this->load->view("test/fb_iframe");
	}
	
	function xfbml() {
		$this->load->view("test/fb_xfbml");
	}
}