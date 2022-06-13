<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Scan extends CI_Controller {

    public function __construct(){
		parent::__construct();
		if (empty($this->session->userdata('login'))) {
			redirect('login','refresh');
		}
		$array = array(
			'active' => 'scan'
		);
		$this->session->set_userdata( $array );
	}

    public function index(){
        $this->load->view('produk/scan_produk', FALSE);
    }

    public function json_scan_bahan(){
        $id = $this->input->post('id');
        $result = $this->OrderModel->get_qr_datang_mutasi($id)->row();
        echo json_encode($result);
    }

}

/* End of file Scan.php */
