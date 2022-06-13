<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mitra extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (empty($this->session->userdata('login'))) {
			redirect('Login/index','refresh');
		}
		$array = array(
			'active' => ($this->session->userdata('level') == 'spv_purchasing') ? 'dashboard' : 'mitra' 
		);
		$this->session->set_userdata( $array );
	}

	public function index(){
		$request = $this->uri->segment(3);
		if (!empty($request)) {
			$result['data_mitra'] = $this->MitraModel->get_mitra($request)->result();
			$this->load->view('mitra/data_mitra', $result, FALSE);
		}else{
			redirect('dashboard/index','refresh');
		}
	}

	public function tambah_mitra(){
		$tipe_mitra = $this->uri->segment(3);
		if (!empty($tipe_mitra)) {
			$kode_mitra = $this->MitraModel->get_nomor()->result();
			if (empty($kode_mitra)) {
				$kode = 'SPP0001';
			}else{
				foreach ($kode_mitra as $value) {
					$kodeawal = substr($value->no_mitra,3,4)+1;
					if($kodeawal<10){
					  	$kode = substr($value->no_mitra, 0, -1).$kodeawal;
					}elseif($kodeawal > 9 && $kodeawal <= 99){
						$kode = substr($value->no_mitra, 0, -2).$kodeawal;
					}elseif ($kodeawal >= 100 && $kodeawal <= 999) {
						$kode = substr($value->no_mitra, 0, -3).$kodeawal;
					}else{
						$kode = substr($value->no_mitra, 0, -4).$kodeawal;
					}
				}
			}
			$result['kode'] = $kode;
			$this->load->view('mitra/tambah_mitra', $result, FALSE);
		}else{
			redirect('dashboard/index','refresh');
		}
	}

	public function simpan_mitra(){
		$tipe_mitra = $this->input->post('tipe_mitra');
		$no_mitra = $this->input->post('no_mitra');
		$badan_usaha = $this->input->post('badan_usaha');
		$nama_mitra = $this->input->post('nama_mitra');
		$email_mitra = $this->input->post('email_mitra');
		$telepon = $this->input->post('telp_mitra');
		$seluler = $this->input->post('telp_seluler');
		$web = $this->input->post('web_mitra');
		$catatan = $this->input->post('catatan_mitra');
		$virtual = $this->input->post('kode_virtual');
		$alamat_satu = $this->input->post('alamat_satu');
		$alamat_dua = $this->input->post('alamat_dua');
		$kota = $this->input->post('kota_mitra');
		$provinsi = $this->input->post('provinsi');
		$pos = $this->input->post('kode_pos');
		$negara = $this->input->post('negara');

		$arr_new_mitra = array(
			'tipe_mitra' => $tipe_mitra, 
			'no_mitra' => $no_mitra, 
			'badan_usaha' => $badan_usaha, 
			'nama_mitra' => $nama_mitra, 
			'email_mitra' => $email_mitra, 
			'telp_mitra' => $telepon, 
			'seluler_mitra' => $seluler, 
			'web_mitra' => $web, 
			'catatan_mitra' => $catatan, 
			'virtual_mitra' => $virtual, 
			'alamat_baris_1' => $alamat_satu, 
			'alamat_baris_2' => $alamat_dua, 
			'kota_mitra' => $kota, 
			'provinsi_mitra' => $provinsi, 
			'pos_mitra' => $pos, 
			'negara_mitra' => $negara
		);

		$do_insert = $this->MitraModel->add($arr_new_mitra);
		if ($do_insert == TRUE) {
			$request = ($tipe_mitra == 'Bahan Baku') ? 'Baku' : $tipe_mitra;
			redirect("Mitra/index/$request",'refresh');
		}else{
			echo "Gagal menambah data mitra baru.";
		}
	}

	public function hapus_mitra(){
		$id_mitra = $this->uri->segment(3);
		if (!empty($id_mitra)) {
			$data_mitra = $this->MitraModel->select_mitra($id_mitra)->row();
			$request = $data_mitra->tipe_mitra;
			$tipe = ($request == 'Bahan Baku') ? 'Baku' : $data_mitra->tipe_mitra;
			$do_delete = $this->MitraModel->delete($id_mitra);
			redirect("mitra/index/$tipe",'refresh');
		}else{
			redirect('Mitra/index/Baku','refresh');
		}	
	}

	public function detail_mitra(){
		$id_mitra = $this->uri->segment(3);
		if (!empty($id_mitra)) {
			$result['detail_mitra'] = $this->MitraModel->select_mitra($id_mitra)->result();
			$this->load->view('mitra/detail_mitra', $result, FALSE);
		}else{
			redirect('Mitra/index/Baku','refresh');
		}
	}

	public function edit_info_mitra(){
		$id_mitra = $this->uri->segment(3);
		if (!empty($id_mitra)) {
			$result['detail_mitra'] = $this->MitraModel->select_mitra($id_mitra)->result();
			$this->load->view('mitra/edit_info_mitra', $result, FALSE);
		}else{
			redirect('Mitra/index','refresh');
		}
	}

	public function update_mitra(){
		$id_mitra = $this->input->post('id_mitra');
		$tipe_mitra = $this->input->post('tipe_mitra');
		$no_mitra = $this->input->post('no_mitra');
		$badan_usaha = $this->input->post('badan_usaha');
		$nama_mitra = $this->input->post('nama_mitra');
		$email_mitra = $this->input->post('email_mitra');
		$telepon = $this->input->post('telp_mitra');
		$seluler = $this->input->post('telp_seluler');
		$web = $this->input->post('web_mitra');
		$catatan = $this->input->post('catatan_mitra');
		$virtual = $this->input->post('kode_virtual');
		$alamat_satu = $this->input->post('alamat_satu');
		$alamat_dua = $this->input->post('alamat_dua');
		$kota = $this->input->post('kota_mitra');
		$provinsi = $this->input->post('provinsi');
		$pos = $this->input->post('kode_pos');
		$negara = $this->input->post('negara');

		$arr_update_mitra = array(
			'tipe_mitra' => $tipe_mitra, 
			'no_mitra' => $no_mitra, 
			'badan_usaha' => $badan_usaha, 
			'nama_mitra' => $nama_mitra, 
			'email_mitra' => $email_mitra, 
			'telp_mitra' => $telepon, 
			'seluler_mitra' => $seluler, 
			'web_mitra' => $web, 
			'catatan_mitra' => $catatan, 
			'virtual_mitra' => $virtual, 
			'alamat_baris_1' => $alamat_satu, 
			'alamat_baris_2' => $alamat_dua, 
			'kota_mitra' => $kota, 
			'provinsi_mitra' => $provinsi, 
			'pos_mitra' => $pos, 
			'negara_mitra' => $negara
		);

		$update_mitra = $this->MitraModel->update($id_mitra,$arr_update_mitra);
		if ($update_mitra == TRUE) {
			$request = ($tipe_mitra == 'Bahan Baku') ? 'Baku' : $tipe_mitra;
			redirect("Mitra/index/$request",'refresh');
		}else{
			echo "Gagal mengubah data mitra.";
		}
	}

	public function get_json_mitra(){
		$id = $this->input->post('id');
		$data_mitra = $this->MitraModel->mitra_json($id)->result();
		echo json_encode($data_mitra);
	}

}

/* End of file Mitra.php */
/* Location: ./application/controllers/Mitra.php */