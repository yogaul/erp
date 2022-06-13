<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mlog extends CI_Controller {

    public function __construct(){
		parent::__construct();
		if (empty($this->session->userdata('login'))) {
			redirect('Login/index','refresh');
		}
	
		$array = array(
			'active' => 'produk'
		);
		$this->session->set_userdata( $array );
	}

    public function index($request){
        if(!empty($request)){
            $result['kategori'] = ucfirst($request);
            $result['data_log'] = $this->LogModel->get_log_produk(ucfirst($request))->result();
            $this->load->view('gudang/log_bahan/data_log_bahan', $result, FALSE);
        }
    }

    public function cari(){
        $start = $this->input->post('start_date');
        $end = $this->input->post('end_date');
        $id = $this->input->post('id_produk');

        $data = $this->ProdukModel->get_produk_id($id)->row();

        $result['id_produk'] = $data->id_produk;	
        $result['kode_produk'] = $data->kode_produk;	
		$result['nama_produk'] = $data->nama_produk;
        $result['start'] = date('d/m/Y', strtotime($start));
        $result['end'] = date('d/m/Y', strtotime($end));
        $result['data_log'] = $this->LogModel->get_log_produk_range($start, $end, $id)->result();
        $result['in_log'] = $this->LogModel->get_sum_log($start, $end, $id)->row()->masuk;
        $result['out_log'] = $this->LogModel->get_sum_log($start, $end, $id)->row()->keluar;
        
        $this->load->view('produk/cari_log_mutasi', $result, FALSE);
    }

    public function cari_msglow(){
        $array = array(
			'active' => 'glow'
		);
		$this->session->set_userdata( $array );

        $start = $this->input->post('start_date');
        $end = $this->input->post('end_date');
        $id = $this->input->post('id_produk');

        $data = $this->MsglowModel->get_msglow_id($id)->row();

        $result['id_produk'] = $data->id_produk_msglow;	
		$result['nama'] = $data->nama_produk_msglow;
        $result['start'] = date('d/m/Y', strtotime($start));
        $result['end'] = date('d/m/Y', strtotime($end));
        $result['data_log'] = $this->LogModel->get_log_msglow_range($start, $end, $id)->result();
        $result['in_log'] = $this->LogModel->get_sum_log_msglow($start, $end, $id)->row()->masuk;
        $result['out_log'] = $this->LogModel->get_sum_log_msglow($start, $end, $id)->row()->keluar;
        
        $this->load->view('gudang/log_msglow/cari_log_msglow', $result, FALSE);
    }

}

/* End of file Mlog.php */
