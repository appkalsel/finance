<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('login')) {
			redirect(base_url('Welcome'));
		}
		$this->load->model('m_fin');
	}

	public function index()
	{
		$id_users = $this->session->userdata('ses_id_users');
		$data['data'] = $this->m_fin->load_tr($id_users);
		$this->load->view('fin_transaction', $data);
	}

	public function add_tr()
	{
		$table = 'fin_transaction';
		$data = array(
			'id_users' => $this->session->userdata('ses_id_users'),
			'title' => $this->input->post('title'),
			'deb' => str_replace(".", "", $this->input->post('deb')),
			'cre' => str_replace(".", "", $this->input->post('cre')),
			'desc' => $this->input->post('desc'),
			'date' => $this->input->post('date'),
		);

		if ($this->m_fin->insert($table, $data)) {
			$this->session->set_flashdata('alert', 'add');
			redirect('Transaction');
		} else {
			$this->session->set_flashdata('alert', 'error');
			redirect('Transaction');
		}
	}

	public function edit_tr()
	{
		$id = $this->input->post('id');
		if ($id) {
			$where = array(
				'id' => $id
			);

			$data = array(
				'title' => $this->input->post('title'),
				'deb' => str_replace(".", "", $this->input->post('deb')),
				'cre' => str_replace(".", "", $this->input->post('cre')),
				'desc' => $this->input->post('desc'),
				'date' => $this->input->post('date'),
			);

			$table = 'fin_transaction';

			if ($this->m_fin->update($where, $data, $table)) {
				$this->session->set_flashdata('alert', 'edit');
				redirect('Transaction');
			} else {
				$this->session->set_flashdata('alert', 'error');
				redirect('Transaction');
			}
		} else {
			$this->session->set_flashdata('alert', 'error');
			redirect('Transaction');
		}
	}

	public function get_tr()
	{
		$id = $this->input->post('id');

		if ($id == '') {
			exit;
		} else {
			$data = $this->m_fin->load_tr(NULL, $id);
			echo json_encode($data);
		}
	}

	public function delete_tr($id)
	{
		$where = array(
			'id' => $id
		);
		$table = 'fin_transaction';
		if ($this->m_fin->delete($where, $table)) {
			$this->session->set_flashdata('alert', 'hapus');
			redirect('Transaction');
		} else {
			$this->session->set_flashdata('alert', 'error');
			redirect('Transaction');
		}
	}
}
