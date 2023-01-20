<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		// if ($this->session->userdata('login')) {
		// redirect(base_url('Home'));
		// }
		$this->load->model('m_auth');
	}

	public function index()
	{
		$this->load->view('auth_login');
	}

	public function login()
	{
		$email = htmlspecialchars($this->input->post('email', TRUE));
		$password = htmlspecialchars($this->input->post('pw', TRUE));

		$data = $this->m_auth->auth($email);
		// var_dump($cek['pw']);
		if ($data) {
			# code...
			if (password_verify($password, $data['pw'])) {
				if ($data['is_active'] != 2) {
					$this->session->set_flashdata('alert', 'error');
					redirect('Welcome');
				} else {
					$this->session->set_userdata('login', TRUE);
					if ($data['id_role'] === '1') { //Akses SUPER ADMIN
						$this->session->set_userdata('ses_id_users', $data['id']);
						$this->session->set_userdata('ses_nama', $data['name']);
						$this->session->set_userdata('ses_email', $data['email']);
						$this->session->set_userdata('ses_foto', $data['image']);
					} elseif ($data['id_role'] === '2') { //akses USERS
						$this->session->set_userdata('ses_id_users', $data['id']);
						$this->session->set_userdata('ses_nama', $data['name']);
						$this->session->set_userdata('ses_email', $data['email']);
						$this->session->set_userdata('ses_foto', $data['image']);
					}
					$this->session->set_flashdata('alert', 'login');
					redirect('Home');
				}
			} else {
				$this->session->set_flashdata('alert', 'error');
				redirect('Auth');
			}
		} else {
			$this->session->set_flashdata('alert', 'error');
			redirect('Auth');
		}
	}

	public function logout()
	{
		session_destroy();
		redirect(base_url());
	}
}
