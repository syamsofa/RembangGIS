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
			"daftarVariabel" => $this->model_variabel->ReadVariabel()
		];
		$this->load->view('site', $data);
	}
	public function peta_kab_by_kec()
	{

		$data = [
			"menu" => $this->menuPilih,
			"judulMenu" => "Peta Tematik Kab Rembang By Kecamatan",
			"daftarVariabel" => $this->model_variabel->ReadVariabel()
		];
		// print_r($data);
		$this->load->view('site', $data);
	}
	public function non_tematik()
	{

		$data = [
			"menu" => $this->menuPilih,
			"judulMenu" => "Non Tematik",
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
			"daftarVariabel" => $this->model_variabel->ReadVariabel()
		];
		// print_r($data);
		$this->load->view('site', $data);
	}
	function tes()
	{
		print_r($this->model_variabel->ReadVariabel());
	}
}
