<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estimasi extends CI_Controller {

    public function __construct(){
		parent::__construct();
		if (empty($this->session->userdata('login'))) {
			redirect('Login/index','refresh');
		}

		$array = array(
			'active' => 'estimasi' 
		);

		$this->session->set_userdata( $array );
	}

    public function index($request){
		if (!empty($request)) {
			$start = date('Y-m-d');
			$end = date( "Y-m-d", strtotime( "$start +7 day" ) );
            $result['kategori'] = ucfirst($request);
			$result['data'] = $this->OrderModel->get_estimasi_all($start, $end, ucfirst($request))->result();
			$this->load->view('order/estimasi_datang', $result, FALSE);
		}
	}

	public function cari(){
		$start = $this->input->post('start_date');
		$end = $this->input->post('end_date');
		$kategori = $this->input->post('kategori');
		$result['data'] = $this->OrderModel->get_estimasi_all($start, $end, $kategori)->result();
		$result['kategori'] = $kategori;
		$result['start'] = date('d/m/Y', strtotime($start));
		$result['end'] = date('d/m/Y', strtotime($end));
		$result['mulai'] = $start;
		$result['akhir'] = $end;
		$this->load->view('order/cari_estimasi', $result, FALSE);
	}

}

/* End of file Estimasi.php */
