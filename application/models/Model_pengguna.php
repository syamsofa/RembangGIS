<?php

class Model_pengguna extends CI_Model
{
	public function __construct()
	{
		// $this->load->library('lib');
		// $this->load->library('lib_security');
		$this->load->model('model_role');
		// $this->load->model('email_model');
		//call function
		// Your own constructor code
	}
	public function read_pengguna()
	{
		$query = $this->db->query("select a.*,b.OpsiLogin,c.Nama as NamaSatker,d.Nama as NamaOrganisasi 
		from pengguna a left join opsi_login b on a.OpsiLoginId=b.RecId
		left join satker c on c.RecId=a.SatkerId
		left join organisasi d on d.RecId=a.OrganisasiId;
		", array());
		$data = array();


		return $query->result_array();
	}


	public function create_pengguna($data)
	{
		$this->db->query("insert into  pengguna (OpsiLoginId, Email,Nama,UrlPicture) values (?,?,?,?)  ", array($data['OpsiLoginId'], $data['Email'], $data['Nama'], $data['UrlPicture']));
		$afftectedRows = $this->db->affected_rows();
		if ($afftectedRows == 1) {
			$this->db->query("insert into role_pengguna (RoleId, PenggunaId) values (?,?)  ", array(2, $this->db->insert_id()));
			$data['RecId'] = $this->db->insert_id();

			$data['dataRolePengguna'] = $this->model_role->read_role_pengguna_by_id_pengguna(array("PenggunaId" => $data['RecId']));

			return array(
				'sukses' => true,
				'data' => $data
			);
		} else
			return array(
				'sukses' => false,
				'data' => $data
			);
	}

	public function cek_pengguna($data)
	{
		$query = $this->db->query("select * from pengguna where OpsiLoginId=? and Email=?  ", array($data['OpsiLoginId'], $data['Email']));
		if ($query->num_rows() > 0) {

			$dataPengguna = $query->result_array()[0];
			$dataRolePengguna = $this->model_role->read_role_pengguna_by_id_pengguna(array("PenggunaId" => $dataPengguna['RecId']));
			$dataPengguna['RolePengguna'] = $dataRolePengguna;
			return array(
				'sukses' => true,
				'data' => $dataPengguna
			);
		} else
			return array(
				'sukses' => false,
				'data' => null

			);
	}
	public function edit_url_picture($dataInput)
	{
		$this->db->query("update pengguna set UrlPicture=? where RecId=? ", array($dataInput['UrlPicture'], $dataInput['RecId']));

		$afftectedRows = $this->db->affected_rows();
		if ($afftectedRows == 1) {
			return array(
				'sukses' => true,
				'data' => $dataInput
			);
		} else
			return array(
				'sukses' => false,
				'data' => $dataInput
			);
	}
}
