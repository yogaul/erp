<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Biaya extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (empty($this->session->userdata('login'))) {
			redirect('Login/index','refresh');
		}
	}

	public function index(){
		$result['biaya'] = $this->BiayaModel->get_biaya()->result();
		$this->load->view('biaya/data_biaya', $result, FALSE);
	}

	public function edit_biaya(){
		$id = $this->uri->segment(3);
		if (!empty($id)) {
			$result['biaya'] = $this->BiayaModel->get_biaya_id($id)->result();
			$this->load->view('biaya/edit_biaya', $result, FALSE);
		}else{
			redirect('Biaya/index','refresh');
		}
	}

	public function tambah_biaya(){
		$this->load->view('biaya/tambah_biaya', FALSE);
	}

	public function simpan(){
		$akun_keuangan = $this->input->post('akun_keuangan');
		$nama_biaya = $this->input->post('nama_biaya');
		$vendor = $this->input->post('vendor');
		$akun_beban = $this->input->post('akun_beban');
		$tanggal = $this->input->post('tanggal');
		$kategori = $this->input->post('kategori');
		$jumlah = $this->input->post('jumlah');
		$keterangan = $this->input->post('keterangan');

		$biaya_baru = array(
			'akun_keuangan' => $akun_keuangan,
			'nama_biaya' => $nama_biaya,
			'vendor' => $vendor,
			'akun_beban' => $akun_beban,
			'tanggal' => $tanggal,
			'kategori' => $kategori,
			'jumlah' => $jumlah,
			'keterangan' => $keterangan
		);

		$insert_biaya = $this->BiayaModel->insert($biaya_baru);
		if ($insert_biaya == TRUE) {
			redirect('Biaya/index','refresh');
		}else{
			echo 'Gagal menambah biaya baru';
		}
	}

	public function ubah(){
		$id_biaya = $this->input->post('id_biaya');
		$akun_keuangan = $this->input->post('akun_keuangan');
		$nama_biaya = $this->input->post('nama_biaya');
		$vendor = $this->input->post('vendor');
		$akun_beban = $this->input->post('akun_beban');
		$tanggal = $this->input->post('tanggal');
		$kategori = $this->input->post('kategori');
		$jumlah = $this->input->post('jumlah');
		$keterangan = $this->input->post('keterangan');

		$biaya_update = array(
			'akun_keuangan' => $akun_keuangan,
			'nama_biaya' => $nama_biaya,
			'vendor' => $vendor,
			'akun_beban' => $akun_beban,
			'tanggal' => $tanggal,
			'kategori' => $kategori,
			'jumlah' => $jumlah,
			'keterangan' => $keterangan
		);

		$update_biaya = $this->BiayaModel->update($id_biaya,$biaya_update);
		if ($update_biaya == TRUE) {
			redirect('Biaya/index','refresh');
		}else{
			echo 'Gagal mengubah biaya';
		}
	}

	public function hapus(){
		$id = $this->uri->segment(3);
		if (!empty($id)) {
			$do_delete = $this->BiayaModel->delete($id);
			if ($do_delete == TRUE) {
				redirect('Biaya/index','refresh');
			}else{
				echo 'gagal menghapus biaya';
			}
		}else{
			redirect('Biaya/index','refresh');
		}
	}
}

/* End of file Biaya.php */
/* Location: ./application/controllers/Biaya.php */