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
            $nilaiCurrent = $this->SumDesaByKecamatan(substr($row['Kode'], 0, 7), $input);
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
    public function DataKecamatanByVariabelByTahun($IdVariabel, $Tahun)
    {

        print_r($IdVariabel, $Tahun);
        $query = $this->db->query("select * from wilayah where Level=?
		", array(3));
        $data = array();

        $nilaiMaks = 0;
        $nilaiMin = 0;
        foreach ($query->result_array() as $row) {
            $nilaiCurrent = $this->SumDesaByKecamatanByTahun(substr($row['Kode'], 0, 7), $IdVariabel, $Tahun);
            if ($nilaiMin > $nilaiCurrent)
                $nilaiMin = $nilaiCurrent;


            if ($nilaiMaks < $nilaiCurrent)
                $nilaiMaks = $nilaiCurrent;

            $row['SumDesaByKecamatan'] = $nilaiCurrent;


            $nilaiNonAgregat = $this->NonAgregatKecamatanByTahun(substr($row['Kode'], 0, 7), $IdVariabel, $Tahun);

            $row['NonAgregat'] = $nilaiNonAgregat;
            $data[] = $row;
        }

        return (array(
            'Sukses' => true,
            'Data' => [
                "Variabel" => $this->model_variabel->ReadVariabelById($IdVariabel),
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
    public function DaftarKecamatan()
    {
        $query = $this->db->query("select * from wilayah where level=3
		");
        return $query->result_array();
    }

    public function DataDesaByKecamatanByVariabelByTahun($KodeKecamatan, $IdVariabel, $Tahun)
    {

        $query = $this->db->query("select * from wilayah where Level=? and substr(Kode,1,7)=?
		", array(4, substr($KodeKecamatan, 0, 7)));
        $data = array();

        $nilaiMaks = 0;
        $nilaiMin = 0;
        foreach ($query->result_array() as $row) {
            $nilaiCurrent = $this->SumDesaByDesaByTahun($row['Kode'], $IdVariabel, $Tahun);
            if ($nilaiMin > $nilaiCurrent)
                $nilaiMin = $nilaiCurrent;


            if ($nilaiMaks < $nilaiCurrent)
                $nilaiMaks = $nilaiCurrent;

            $row['SumDesa'] = $nilaiCurrent;


            $nilaiNonAgregat = $this->NonAgregatKecamatanByTahun(substr($row['Kode'], 0, 7), $IdVariabel, $Tahun);

            $row['NonAgregat'] = $nilaiNonAgregat;
            $data[] = $row;
        }

        return (array(
            'Sukses' => true,
            'Data' => [
                "Variabel" => $this->model_variabel->ReadVariabelById($IdVariabel),
                "NilaiMaksimal" => $nilaiMaks,
                "NilaiMinimal" => $nilaiMin,
                'DataDesa' => $data
            ]
        ));
    }
    public function DataVariabel()
    {
        $query = $this->db->query("select * from variabel");
        $data = array();

        foreach ($query->result_array() as $row) {


            $data[] = $row;
        }

        return array(
            'sukses' => true,
            'data' => $data
        );
    }

    public function SumDesaByKecamatan($KdWilayah, $IdVariabel)
    {

        $query = $this->db->query("select sum(Nilai) as Nilai from datas a where SUBSTRING(a.KodeWilayah,1,7)=? and IdVariabel=?", [$KdWilayah, $IdVariabel]);


        return $query->result_array()[0]['Nilai'];
    }
    public function SumDesaByKecamatanByTahun($KdWilayah, $IdVariabel, $Tahun)
    {

        $query = $this->db->query("select sum(Nilai) as Nilai from datas a where SUBSTRING(a.KodeWilayah,1,7)=? and SUBSTRING(a.KodeWilayah,8,3)<>'000' and IdVariabel=? and Tahun=?", [$KdWilayah, $IdVariabel, $Tahun]);


        return $query->result_array()[0]['Nilai'];
    }
    public function SumDesaByDesaByTahun($KdWilayah, $IdVariabel, $Tahun)
    {

        $query = $this->db->query("select sum(Nilai) as Nilai from datas a where a.KodeWilayah=? and IdVariabel=? and Tahun=?", [$KdWilayah, $IdVariabel, $Tahun]);


        return $query->result_array()[0]['Nilai'];
    }
    public function NonAgregatKecamatanByTahun($KdWilayah, $IdVariabel, $Tahun)
    {


        $return = '';
        $query = $this->db->query("select sum(Nilai) as Nilai from datas a where SUBSTRING(a.KodeWilayah,1,7)=? and SUBSTRING(a.KodeWilayah,8,3)='000' and IdVariabel=? and Tahun=?", [$KdWilayah, $IdVariabel, $Tahun]);

        if ($query->result_array())

            $return = $query->result_array()[0]['Nilai'];

        return $return;
    }
    public function UbahData($input)
    {
        print_r($input);

        $return = '';
        $this->db->query("update datas set Nilai=? where KodeWilayah=? and Tahun=? and IdVariabel=?", [$input['Nilai'], $input['KodeWilayah'], $input['Tahun'], $input['IdVariabel']]);

        // if ($query->result_array());
        if ($this->db->affected_rows() == 0)
            $this->db->query("insert datas (Nilai, KodeWilayah,Tahun,IdVariabel) values (?,?,?,?)", [$input['Nilai'], $input['KodeWilayah'], $input['Tahun'], $input['IdVariabel']]);
    }
    public function UbahDataDesa($input)
    {
        print_r($input);

        $return = '';
        $this->db->query("update datas set Nilai=? where KodeWilayah=? and Tahun=? and IdVariabel=?", [$input['Nilai'], $input['KodeWilayah'], $input['Tahun'], $input['IdVariabel']]);

        // if ($query->result_array());
        if ($this->db->affected_rows() == 0)
            $this->db->query("insert datas (Nilai, KodeWilayah,Tahun,IdVariabel) values (?,?,?,?)", [$input['Nilai'], $input['KodeWilayah'], $input['Tahun'], $input['IdVariabel']]);
    }
}
