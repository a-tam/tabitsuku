<?php
class Home extends Controller {

	function Home()
	{
		parent::Controller();
		$this->load->plugin('facebook');
	}

	function index()
	{
		$this->load->view('example');
	}
}