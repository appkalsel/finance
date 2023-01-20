<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('login')) {
			redirect(base_url('Welcome'));
		}
	}

	public function index()
	{
		$this->load->view('fin_home');
	}
}
