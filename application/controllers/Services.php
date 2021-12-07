<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Services extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_data');
	}
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function DataKecamatan()
	{
		echo json_encode($this->model_data->DataKecamatan());
	}
	public function DataKecamatanByVariabel()
	{
		$input = $this->input->post('IdVariabel');
		echo json_encode($this->model_data->DataKecamatanByVariabel(
			$input
		));
	}
}
