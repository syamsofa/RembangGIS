<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Site extends CI_Controller
{
	public $menuPilih;
	public function __construct()
	{

		parent::__construct();
		$this->load->model('model_data');
		$this->load->model('model_variabel');
		$this->menuPilih = $this->uri->segment(2);
	}
	public function index()
	{
		redirect('site/dashboard');
	}
	public function dashboard()
	{
		$data = [
			"menu" => $this->menuPilih,
			"judulMenu" => "Index",
			"daftarVariabel" => $this->model_variabel->ReadVariabel(),
			"daftarKecamatan" => $this->model_data->DaftarKecamatan()
	
		];
		$this->load->view('site', $data);
	}
	public function peta_kab_by_kec()
	{

		$data = [
			"menu" => $this->menuPilih,
			"judulMenu" => "Peta Tematik Kab Rembang By Kecamatan",
			"daftarVariabel" => $this->model_variabel->ReadVariabel(),
			"daftarKecamatan" => $this->model_data->DaftarKecamatan()
		];
		// print_r($data);
		$this->load->view('site', $data);
	}
	public function non_tematik()
	{

		$data = [
			"menu" => $this->menuPilih,
			"judulMenu" => "Non Tematik",
			"daftarKecamatan" => $this->model_data->DaftarKecamatan(),
			"daftarVariabel" => $this->model_variabel->ReadVariabel()
		];
		// print_r($data);
		$this->load->view('site', $data);
	}
	public function variabel()
	{

		$data = [
			"menu" => $this->menuPilih,
			"judulMenu" => "Variabel",
			"daftarKecamatan" => $this->model_data->DaftarKecamatan(),
			"daftarVariabel" => $this->model_variabel->ReadVariabel()
		];
		// print_r($data);
		$this->load->view('site', $data);
	}
	public function input_data()
	{

		$data = [
			"menu" => $this->menuPilih,
			"judulMenu" => "Input Data",
			"daftarVariabel" => $this->model_variabel->ReadVariabel(),
			"daftarKecamatan" => $this->model_data->DaftarKecamatan()
			
		];
		// print_r($data);
		$this->load->view('site', $data);
	}
	public function login()
	{

		$data = [
			"menu" => $this->menuPilih,
			"judulMenu" => "Login",
			"daftarVariabel" => $this->model_variabel->ReadVariabel(),
			"daftarKecamatan" => $this->model_data->DaftarKecamatan()
			
		];
		// print_r($data);
		$this->load->view('site', $data);
	}
}
