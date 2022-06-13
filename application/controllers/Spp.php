<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spp extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (empty($this->session->userdata('login'))) {
			redirect('Login/index','refresh');
		}
		$array = array(
			'active' => 'spp'
		);
		$this->session->set_userdata( $array );
	}

	public function index(){
		$level = $this->session->userdata('level');
		if ($level == 'marketing' || $level == 'direktur') {
			$result['list_spp'] = $this->SppModel->get_spp()->result();
		}elseif ($level == 'tim_marketing') {
			$result['list_spp'] = array();
		}
		$this->load->view('marketing/spp/data_spp', $result, FALSE);
	}

	public function buat_spp(){
		$level = $this->session->userdata('level');
		if ($level == 'marketing') {
			$result['brand'] = $this->BrandModel->get_brand()->result();
		}elseif ($level == 'tim_marketing') {
			$id = $this->session->userdata('id_user');
			$result['brand'] = $this->BrandModel->get_brand_tim($id)->result();
		}
		$this->load->view('marketing/spp/buat_spp', $result, FALSE);
	}

	public function simpan_spp(){
		$id_spp = "SPP-".date('YmdHis');
		$no_spp = $this->input->post('no_spp');
		$tgl_spp = date('Y-m-d H:i:s');
		$id_brand = $this->input->post('brand_so');
		$no_telp_spp = $this->input->post('no_telp_pengiriman');
		$alamat_spp = $this->input->post('alamat_pengiriman');
		$catatan_spp = $this->input->post('catatan_spp');

		$arr_spp = [
			'id_spp' => $id_spp,
			'id_brand_produk' => $id_brand,
			'tanggal_spp' => $tgl_spp,
			'nomor_spp' => $no_spp,
			'no_telp_spp' => $no_telp_spp,
			'alamat_pengiriman_spp' => $alamat_spp,
			'catatan_spp' => $catatan_spp
		];

		$this->SppModel->save_spp($arr_spp);

		$id_sample_acc = $this->input->post('id_produk');
		$quantity_spp = $this->input->post('quantity');
		$tgl_kirim_spp = $this->input->post('tanggal_kirim_spp');

		foreach ($id_sample_acc as $key => $value) {
			$arr_detail_spp = [
				'id_spp' => $id_spp,
				'id_sample_acc' => $value,
				'quantity_spp' => $quantity_spp[$key],
				'tanggal_kirim_spp' => $tgl_kirim_spp[$key]
			];
			$this->SppModel->save_detail_spp($arr_detail_spp);
		}
		redirect('spp','refresh');
	}

	public function ubah($id){
		if (!empty($id)) {
			$level = $this->session->userdata('level');
			if ($level == 'marketing') {
				$result['brand'] = $this->BrandModel->get_brand()->result();
			}elseif ($level == 'tim_marketing') {
				$id_user = $this->session->userdata('id_user');
				$result['brand'] = $this->BrandModel->get_brand_tim($id_user)->result();
			}
			$result['data_spp'] = $this->SppModel->get_spp_id($id)->row();
			$result['detail_spp'] = $this->SppModel->get_detail_spp_id($id)->result();
			$this->load->view('marketing/spp/edit_spp', $result, FALSE);
		}
	}

	public function ubah_spp(){
		$id_spp = $this->input->post('id_spp');
		$no_spp = $this->input->post('no_spp');
		$id_brand_temp = $this->input->post('brand_spp_temp');
		$id_brand = $this->input->post('brand_so');
		$brand_update = ($id_brand_temp == $id_brand) ? $id_brand : $id_brand_temp;
		$no_telp_spp = $this->input->post('no_telp_pengiriman');
		$alamat_spp = $this->input->post('alamat_pengiriman');
		$catatan_spp = $this->input->post('catatan_spp');

		$arr_update_spp = [
			'id_brand_produk' => $brand_update,
			'nomor_spp' => $no_spp,
			'no_telp_spp' => $no_telp_spp,
			'alamat_pengiriman_spp' => $alamat_spp,
			'catatan_spp' => $catatan_spp
		];

		$this->SppModel->update_spp($id_spp,$arr_update_spp);
		$this->SppModel->delete_detail_spp($id_spp);

		$id_sample_acc = $this->input->post('id_produk');
		$quantity_spp = $this->input->post('quantity');
		$tgl_kirim_spp = $this->input->post('tanggal_kirim_spp');

		foreach ($id_sample_acc as $key => $value) {
			$arr_detail_spp = [
				'id_spp' => $id_spp,
				'id_sample_acc' => $value,
				'quantity_spp' => $quantity_spp[$key],
				'tanggal_kirim_spp' => $tgl_kirim_spp[$key]
			];
			$this->SppModel->save_detail_spp($arr_detail_spp);
		}
		redirect('spp','refresh');
	}

	public function detail($id){
		if (!empty($id)) {
			if ($this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier') {
				$array = array(
					'active' => 'sjp'
				);
				$this->session->set_userdata( $array );
			}elseif ($this->session->userdata('level') == 'ppic') {
				$array = array(
					'active' => 'dashboard'
				);
				$this->session->set_userdata( $array );
			}
			$result['id'] = $id;
			$result['data_spp'] = $this->SppModel->get_spp_id($id)->row();
			$result['detail_spp'] = $this->SppModel->get_detail_spp_id($id)->result();
			$this->load->view('marketing/spp/detail_spp', $result, FALSE);
		}
	}

	public function cetak($id){
		if (!empty($id)) {
			$file_name = "SPP-".date('dmY');
			$result['data_spp'] = $this->SppModel->get_spp_id($id)->row();
			$result['detail_spp'] = $this->SppModel->get_detail_spp_id($id)->result();
			$this->pdf->setPaper('A4','potrait');
			$this->pdf->filename = "$file_name";
			$this->pdf->load_view('marketing/spp/spp_pdf',$result);
		}
	}

	public function hapus($id){
		if (!empty($id)) {
			$this->SppModel->delete_spp($id);
			redirect('spp','refresh');
		}
	}
}

/* End of file Spp.php */
/* Location: ./application/controllers/Spp.php */