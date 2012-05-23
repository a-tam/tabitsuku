<?php
class Home extends CI_Controller {

	function Home()
	{
		parent::__construct();
		$this->load->helper('facebook');
	}

	function index()
	{
		$this->load->view('example');
	}
}