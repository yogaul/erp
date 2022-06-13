<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (empty($this->session->userdata('login'))) {
			redirect('Login/index','refresh');
		}
		$this->load->library('form_validation');
	}

	public function index(){
		$this->load->view('invoice/data_invoice', FALSE);
	}

	public function buat(){
		$result['mitra'] = $this->MitraModel->get_mitra()->result();
		$result['produk'] = $this->ProdukModel->get_produk()->result();
		$this->load->view('invoice/buat_invoice', $result, FALSE);
	}

}

/* End of file Invoice.php */
/* Location: ./application/controllers/Invoice.php */