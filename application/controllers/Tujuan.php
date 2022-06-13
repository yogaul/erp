<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Tujuan extends CI_Controller {

    public function __construct(){
		parent::__construct();
		if (empty($this->session->userdata('login'))) {
			redirect('login','refresh');
		}
		$this->load->library('form_validation');
		$array = array(
			'active' => 'tujuan'
		);
		$this->session->set_userdata( $array );
	}

    public function index(){
        $result['tujuan'] = $this->TujuanModel->get_tujuan()->result();    
        $this->load->view('gudang/tujuan_pengiriman/tujuan_pengiriman', $result, FALSE);   
    }

    public function simpan(){
		$nama = $this->input->post('nama_tujuan');
		$telp = $this->input->post('telp_tujuan');
		$alamat = $this->input->post('alamat_tujuan');
		$aksi = $this->input->post('aksi');

		$arr_tujuan = array(
			'nama_tujuan_pengiriman' => $nama,
			'no_telp_pengiriman' => $telp,
			'alamat_pengiriman' => $alamat
		);

		if ($aksi == 'tambah') {
			$this->TujuanModel->save_tujuan($arr_tujuan);
		}elseif ($aksi == 'edit') {
            $id_tujuan = $this->input->post('id_tujuan');
			$this->TujuanModel->update_tujuan($id_tujuan,$arr_tujuan);
		}

		redirect('tujuan','refresh');
    }

    public function hapus($id){
		if (!empty($id)) {
			$this->TujuanModel->delete_tujuan($id);
			redirect('tujuan','refresh');
		}else{
			echo 'Gagal hapus.';
		}
	}

    public function json_tujuan_pengiriman(){
        $id = $this->input->post('id');
        $result = $this->TujuanModel->get_tujuan_id($id)->row();
        echo json_encode($result);
    }

}

/* End of file Tujuan.php */
