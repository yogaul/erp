<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grafik extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (empty($this->session->userdata('login'))) {
			redirect('Login/index','refresh');
		}
		$array = array(
			'active' => 'grafik'
		);
		$this->session->set_userdata( $array );
	}

	public function index(){
		$result['baku'] = $this->OrderModel->get_count_order('Baku');
		$result['kemas'] = $this->OrderModel->get_count_order('Kemas');
		$result['teknik'] = $this->OrderModel->get_count_order('Teknik');
		$this->load->view('approval/grafik_view', $result, FALSE);
		// echo json_encode($result);
	}

	public function sample(){
		$this->load->view('marketing/sample_awal/grafik_awal', FALSE);
	} 

	public function acc(){
		$this->load->view('marketing/sample/grafik_acc', FALSE);
	}

	public function qc($request){
		if (!empty($request)) {
			$result['kategori'] = $request;
			$result['start_date'] = date('Y-m-01'); 
			$result['last_date'] = date('Y-m-t');
			$this->load->view('qc/validasi/grafik_validasi', $result, FALSE);
		}
	}

	public function lead($request){
		if (!empty($request)) {
			$result['kategori'] = $request;
			$result['start_date'] = date('Y-m-01'); 
			$result['last_date'] = date('Y-m-t');
			$this->load->view('order/grafik_lead', $result, FALSE);
		}
	}

}

/* End of file Grafik.php */
/* Location: ./application/controllers/Grafik.php */