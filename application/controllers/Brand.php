<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (empty($this->session->userdata('login'))) {
			redirect('Login/index','refresh');
		}
		$array = array(
			'active' => 'brand'
		);
		$this->session->set_userdata( $array );
	}

	public function index(){
		$level = $this->session->userdata('level');
		if ($level == 'marketing' || $level == 'direktur') {
			$result['customer'] = $this->CustomerModel->get_customer()->result();
			$result['brand'] = $this->BrandModel->get_brand()->result();
		}elseif ($level == 'tim_marketing') {
			$id = $this->session->userdata('id_user');
			$result['customer'] = $this->CustomerModel->get_customer_tim($id)->result();
			$result['brand'] = $this->BrandModel->get_brand_tim($id)->result();
		}
		$this->load->view('marketing/brand/data_brand', $result, FALSE);
	}

	public function simpan(){
		$nama_brand = $this->input->post('nama_brand');
		$id_customer = $this->input->post('customer');
		$id_brand = $this->input->post('id_brand');
		$aksi = $this->input->post('aksi');

		$arr_brand = [
			'id_customer' => $id_customer,
			'nama_brand_produk' => $nama_brand
		];

		if ($aksi == 'tambah') {
			$this->BrandModel->save_brand($arr_brand);
		}elseif ($aksi == 'edit') {
			$this->BrandModel->update_brand($id_brand,$arr_brand);
		}

		redirect('brand','refresh');
	}

	public function hapus($id){
		$this->BrandModel->delete_brand($id);
		redirect('brand','refresh');
	}

	public function get_json_brand(){
		$id = $this->input->post('id');
		$result= $this->BrandModel->get_brand_id($id)->row();
		echo json_encode($result);
	}

	public function get_json_brand_customer(){
		$id = $this->input->post('id');
		$result = $this->BrandModel->get_brand_customer($id)->result();
		echo json_encode($result);
	}

}

/* End of file BrandController.php */
/* Location: ./application/controllers/BrandController.php */