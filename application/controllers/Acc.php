<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Acc extends CI_Controller {

    public function __construct(){
		parent::__construct();
		if (empty($this->session->userdata('login'))) {
			redirect('login','refresh');
		}
		$array = array(
			'active' => 'acc'
		);
		$this->session->set_userdata( $array );
	}

    public function index(){
        $akses = $this->session->userdata('level');
        $model = $this->RequestGlowModel;
        if ($akses == 'direktur') {
            $result['request'] = $model->get_request_kgi('Belum')->result();
            $this->load->view('msglow/approval_request', $result, FALSE);
        }else if ($akses == 'kci') {
            $result['request'] = $model->get_request_kci('Belum')->result();
            $this->load->view('msglow/approval_request', $result, FALSE);
        }else{
            redirect('dashboard','refresh');
        }
    }

    public function acc_all(){
        $akses = $this->session->userdata('level');
        $model = $this->RequestGlowModel;
        if ($akses == 'direktur') {
            $data_kgi = $model->get_request_kgi('Belum')->result();
            foreach ($data_kgi as $value) {
                $arr = [
                    'acc_kgi' => 'Sudah',
                    'tanggal_acc_kgi' => date('Y-m-d H:i:s')
                 ];

                $model->update_request_msglow($value->id_msglow_request, $arr);
                $this->simpan_log($value->id_msglow_request,'NPD APPROVED','Permintaan produk disetujui oleh KGI');
                 
                 if ($value->acc_kci == 'Sudah') {
                     $arr_status = [
                         'status_request_msglow' => 'NPD APPROVED'
                     ];
                    $model->update_request_msglow($value->id_msglow_request, $arr_status);
                 }
            }
            redirect('acc','refresh');
        }else if ($akses == 'kci') {
            $data_kci = $model->get_request_kci('Belum')->result();
            foreach ($data_kci as $value) {
                $arr = [
                    'acc_kci' => 'Sudah',
                    'tanggal_acc_kci' => date('Y-m-d H:i:s')
                 ];

                $model->update_request_msglow($value->id_msglow_request, $arr);
                $this->simpan_log($value->id_msglow_request,'NPD APPROVED','Permintaan produk disetujui oleh KCI');
                 
                 if ($value->acc_kgi == 'Sudah') {
                     $arr_status = [
                         'status_request_msglow' => 'NPD APPROVED'
                     ];
                    $model->update_request_msglow($value->id_msglow_request, $arr_status);
                 }
            }
            redirect('acc','refresh');
        }else{
            redirect('dashboard','refresh');
        }
    }

    public function acc_selected(){
        $akses = $this->session->userdata('level');
        $model = $this->RequestGlowModel;
        $id = $this->input->post('id_request');

        if ($akses == 'direktur') {
            foreach ($id as $key => $value) {
                $arr = [
                    'acc_kgi' => 'Sudah',
                    'tanggal_acc_kgi' => date('Y-m-d H:i:s')
                 ];
                 $model->update_request_msglow($value, $arr);

                $this->simpan_log($value,'NPD APPROVED','Permintaan produk disetujui oleh KGI');

                $dataku = $model->get_request_msglow_id($value)->row();
                if ($dataku->acc_kci == 'Sudah') {
                    $arr_status = [
                        'status_request_msglow' => 'NPD APPROVED'
                    ];
                   $model->update_request_msglow($value, $arr_status);
                }

            }
            redirect('acc','refresh');
        }else if ($akses == 'kci') {
            foreach ($id as $key => $value) {
                $arr = [
                    'acc_kci' => 'Sudah',
                    'tanggal_acc_kci' => date('Y-m-d H:i:s')
                 ];
                 $model->update_request_msglow($value, $arr);

                 $this->simpan_log($value,'NPD APPROVED','Permintaan produk disetujui oleh KCI');

                 $dataku = $model->get_request_msglow_id($value)->row();
                 if ($dataku->acc_kgi == 'Sudah') {
                     $arr_status = [
                         'status_request_msglow' => 'NPD APPROVED'
                     ];
                    $model->update_request_msglow($value, $arr_status);
                 }
            }
            redirect('acc','refresh');
        }else{
            redirect('dashboard','refresh');
        }
    }

    public function get_json_tolak(){
        $akses = $this->session->userdata('level');
        $model = $this->RequestGlowModel;
        $id = $this->input->post('id');
        $response = array();

        if ($akses == 'direktur') {
            foreach ($id as $key => $value) {
                $arr = [
                    'acc_kgi' => 'Ditolak',
                    'tanggal_acc_kgi' => date('Y-m-d H:i:s')
                 ];
                 $model->update_request_msglow($value, $arr);

                 $this->simpan_log($value,'NPD CANCELED','Permintaan produk dibatalkan oleh KGI');

                 $dataku = $model->get_request_msglow_id($value)->row();
                 if ($dataku->acc_kci == 'Ditolak') {
                     $arr_status = [
                         'status_request_msglow' => 'NPD CANCELED'
                     ];
                    $model->update_request_msglow($value, $arr_status);
                 }
            }
            $response['status'] = '1';
        }else if ($akses == 'kci') {
            foreach ($id as $key => $value) {
                $arr = [
                    'acc_kci' => 'Ditolak',
                    'tanggal_acc_kci' => date('Y-m-d H:i:s')
                 ];
                 $model->update_request_msglow($value, $arr);

                 $this->simpan_log($value,'NPD CANCELED','Permintaan produk dibatalkan oleh KCI');

                 $dataku = $model->get_request_msglow_id($value)->row();
                 if ($dataku->acc_kgi == 'Ditolak') {
                     $arr_status = [
                         'status_request_msglow' => 'NPD CANCELED'
                     ];
                    $model->update_request_msglow($value, $arr_status);
                 }
            }
            $response['status'] = '1';
        }else{
            $response['status'] = '0';
        }
        echo json_encode($response);
    }

    private function simpan_log($id_request = null, $aksi = null, $desc = null){
		if (!is_null($id_request)) {
			$model = $this->RequestGlowModel;
			$arr_log = [
				'id_msglow_request' => $id_request,
				'tanggal_log_msglow' => date('Y-m-d H:i:s'),
				'user_log_msglow' => $this->session->userdata('nama_user'),
				'aksi_log_msglow' => $aksi,
				'deskripsi_log_msglow' => $desc
			];
			$model->save_log($arr_log);
		}
		
	}

}

/* End of file Acc.php */
