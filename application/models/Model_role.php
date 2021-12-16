<?php

class Model_role extends CI_Model
{
	public function __construct()
	{
		// parent::__construct();
		// $this->load->library('lib');
		// $this->load->library('lib_security');
		// $this->load->model('role_model');
		// $this->load->model('email_model');
		//call function
		// Your own constructor code
	}
	public function read_role_pengguna_by_id_pengguna($inputData)
	{
		$query = $this->db->query("select * from role_pengguna a left join role b on a.RoleId=b.RecId  where a.PenggunaId=?",array($inputData['PenggunaId']));
		$data = array();

		foreach ($query->result_array() as $row) {
			$data[] = $row;
		}

		return array(
			'sukses' => true,
			'data' => $data
		);
	}
	public function read_bulan_by_id($RecId)
	{
		$query = $this->db->query("select * from bulan where RecId=?
		", array($RecId));
		$data = array();

		foreach ($query->result_array() as $row) {
			$data = $row;
		}

		return array(
			'sukses' => true,
			'data' => $data
		);
	}
}
