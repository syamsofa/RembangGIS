<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Servicespengguna extends CI_Controller
{
    public $jatengAuthUrl = "https://jatengklik.us.to/auth/do_login";
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_pengguna');

        // Your own constructor code
    }
    public function read_pengguna()
    {
        $output = $this->model_pengguna->read_pengguna();

        echo json_encode($output);
    }

    public function LoginJatengklik()
    {


        $dataInput = $this->input->post();

        $curl = curl_init($this->jatengAuthUrl);
        curl_setopt($curl, CURLOPT_URL, $this->jatengAuthUrl);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Content-Type: application/x-www-form-urlencoded",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $data = "username=" . $dataInput['username'] . "&password=" . $dataInput['password'];

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $resp = curl_exec($curl);

        curl_close($curl);
        // var_dump($resp);
        $resp = json_decode($resp);

        // print_r($resp);

        if (isset($resp) and $resp->login == 1) {
            $dataCek = [
                "OpsiLoginId" => 3,
                "Email" => $resp->email,
                "Nama" => $resp->nama,
                'UrlPicture' => $resp->avatar
            ];
            $cekUser = $this->model_pengguna->cek_pengguna($dataCek);
            if ($cekUser['sukses'] == false) {

                $output = $this->model_pengguna->create_pengguna($dataCek);
                if ($output['sukses'] == true) {
                    $this->session->set_userdata($output['data']);
                    $this->session->set_userdata('RoleIdAktif', 2);
                    $this->session->set_userdata('RoleAktif', 'Pengguna Biasa');

                    $responService = [
                        "sukses" => true,
                        "pesan" => "Pengguna berhasil didaftarkan"
                    ];
                } else

                    $responService = [
                        "sukses" => false,
                        "pesan" => "Pengguna tidak berhasil didaftarkan"
                    ];
            } else {
                $output = $cekUser['data'];
                //   print_r($resp);
                $output['UrlPicture'] = $resp->avatar;
                $this->model_pengguna->edit_url_picture($output);
                $this->session->set_userdata($output);
                $this->session->set_userdata('RoleIdAktif', 2);
                $this->session->set_userdata('RoleAktif', 'Pengguna Biasa');

                $responService = [
                    "sukses" => true,
                    "pesan" => "Pengguna sudah terdaftar"
                ];
            }
        } else {
            $responService = [
                "sukses" => false,
                "pesan" => "Pengguna dengan akun tersebut tidak ditemukan di service jateng klik."
            ];
        }
        echo json_encode($responService);
    }
}
