<?php

class Model_data extends CI_Model
{
    public function __construct()
    {
        $this->load->model('model_data');
        $this->load->model('model_variabel');
    }
    public function DataKecamatanByVariabel($input)
    {

        $query = $this->db->query("select * from wilayah where Level=?
		", array(3));
        $data = array();

        $nilaiMaks = 0;
        $nilaiMin = 0;
        foreach ($query->result_array() as $row) {
            $nilaiCurrent = $this->SumDesaByKecamatan(substr($row['Kode'], 0, 7),$input);
            if ($nilaiMin > $nilaiCurrent)
                $nilaiMin = $nilaiCurrent;


            if ($nilaiMaks < $nilaiCurrent)
                $nilaiMaks = $nilaiCurrent;

            $row['SumDesaByKecamatan'] = $nilaiCurrent;
            $data[] = $row;
        }

        return (array(
            'Sukses' => true,
            'Data' => [
                "Variabel" => $this->model_variabel->ReadVariabelById($input),
                "NilaiMaksimal" => $nilaiMaks,
                "NilaiMinimal" => $nilaiMin,
                'DataKecamatan' => $data
            ]
        ));
    }
    public function DataKecamatan()
    {
        $query = $this->db->query("select * from wilayah where level=3
		");
        $data = array();

        foreach ($query->result_array() as $row) {

            $row['Nilai'] = $this->SumDesaByKecamatan(substr($row['Kode'], 0, 7));
            $data[] = $row;
        }

        return array(
            'sukses' => true,
            'data' => $data
        );
    }
    public function SumDesaByKecamatan($KdWilayah,$IdVariabel)
    {

        $query = $this->db->query("select sum(Nilai) as Nilai from datas a where SUBSTRING(a.KodeWilayah,1,7)=? and IdVariabel=?", [$KdWilayah,$IdVariabel]);


        return $query->result_array()[0]['Nilai'];
    }
}
