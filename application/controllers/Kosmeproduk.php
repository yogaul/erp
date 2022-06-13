<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kosmeproduk extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (empty($this->session->userdata('login'))) {
			redirect('Login/index','refresh');
		}
		$array = array(
			'active' => 'kosmeproduk' 
		);
		$this->session->set_userdata( $array );
	}

	public function index(){
		$result['produkkosme'] = $this->KosmeprodukModel->get_kosme_produk()->result();
		$this->load->view('marketing/kosme_produk/data_kosme_produk', $result, FALSE);
	}

	public function ubah_simpan(){
		$id = $this->input->post('id_produk_kosme');
		$id_kategori = $this->input->post('kategori_produk_kosme');
		$kode = $this->input->post('kode_produk_kosme');
		$nama = $this->input->post('nama_produk_kosme');
		$volume = $this->input->post('berat_produk_kosme');
		$satuan = $this->input->post('satuan_produk_kosme');
		$harga_min = $this->input->post('harga_min');
		$harga_avg = $this->input->post('harga_avg');
		$harga_max = $this->input->post('harga_max');
		$moq1 = $this->input->post('moq_1');
		$harga_moq1 = $this->input->post('harga_moq1');
		$moq2 = $this->input->post('moq_2');
		$harga_moq2 = $this->input->post('harga_moq2');
		$moq3 = $this->input->post('moq_3');
		$aksi = $this->input->post('aksi');

		$data_produk_kosme = [
			'id_kategori_produk_kosme' => $id_kategori,
			'kode_produk_kosme' => $kode,
			'nama_produk_kosme' => $nama,
			'volume_produk_kosme' => $volume,
			'satuan_produk_kosme' => $satuan,
			'harga_min' => $harga_min,
			'harga_avg' => $harga_avg,
			'harga_max' => $harga_max,
			'moq_1' => $moq1,
			'harga_moq_1' => $harga_moq1,
			'moq_2' => $moq2,
			'harga_moq_2' => $harga_moq2,
			'moq_3' => $moq3,
		];

		if ($aksi == 'tambah') {
			$this->KosmeprodukModel->insert_kosmeproduk($data_produk_kosme);
		}elseif ($aksi == 'edit') {
			$this->KosmeprodukModel->update_kosmeproduk($id,$data_produk_kosme);
		}
		redirect('kosmeproduk','refresh');
	}

	public function hapus($id){
		$this->KosmeprodukModel->delete_kosmeproduk($id);
		redirect('kosmeproduk','refresh');
	}

	public function get_json_produk_kosme(){
		$id = $this->input->post('id');
		$result = $this->KosmeprodukModel->get_kosmeproduk_by_id($id)->result();
		echo json_encode($result);
	}

}

/* End of file Kosmeproduk.php */
/* Location: ./application/controllers/Kosmeproduk.php */