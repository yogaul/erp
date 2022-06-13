<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (empty($this->session->userdata('login'))) {
			redirect('Login/index','refresh');
		}
	}

	public function index(){
		$result['kategori'] = $this->KategoriModel->get_kategori()->result();
		$this->load->view('kategori/data_kategori', $result, FALSE);
	}

	public function tambah_kategori(){
		$this->load->view('kategori/tambah_kategori', FALSE);
	}

	public function simpan(){
		$nama_kategori = $this->input->post('nama_kategori');
		$kategori_induk = $this->input->post('kategori_induk');
		$deskripsi_kategori = $this->input->post('deskripsi_kategori');

		$kategori_baru = array(
			'nama_kategori' => $nama_kategori,
			'kategori_induk' => $kategori_induk,
			'deskripsi_kategori' => $deskripsi_kategori
		);

		$insert_kategori = $this->KategoriModel->insert($kategori_baru);
		if ($insert_kategori == TRUE) {
			redirect('Kategori/index','refresh');
		}else{
			echo 'gagal menambah kategori baru';
		}
	}

	public function edit_kategori(){
		$id = $this->uri->segment(3);
		if (!empty($id)) {
			$result['kategori'] = $this->KategoriModel->get_kategori_id($id)->result();
			$this->load->view('kategori/edit_kategori', $result, FALSE);
		}else{
			redirect('Kategori/index','refresh');
		}
	}

	public function ubah(){
		$id_kategori = $this->input->post('id_kategori');
		$nama_kategori = $this->input->post('nama_kategori');
		$kategori_induk = $this->input->post('kategori_induk');
		$deskripsi_kategori = $this->input->post('deskripsi_kategori');

		$kategori_update = array(
			'nama_kategori' => $nama_kategori,
			'kategori_induk' => $kategori_induk,
			'deskripsi_kategori' => $deskripsi_kategori
		);

		$update_kategori = $this->KategoriModel->update($id_kategori,$kategori_update);
		if ($update_kategori == TRUE) {
			redirect('Kategori/index','refresh');
		}else{
			echo 'gagal mengubah data kategori';
		}
	}

	public function hapus(){
		$id = $this->uri->segment(3);
		if (!empty($id)) {
			$do_delete = $this->KategoriModel->delete($id);
			if ($do_delete == TRUE) {
				redirect('Kategori/index','refresh');
			}else{
				echo 'gagal menghapus kategori';
			}
		}else{
			redirect('Kategori/index','refresh');
		}
	}

}

/* End of file Kategori.php */
/* Location: ./application/controllers/Kategori.php */