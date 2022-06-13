<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (empty($this->session->userdata('login'))) {
			redirect('login','refresh');
		}
		$array = array(
			'active' => 'dashboard'
		);
		$this->session->set_userdata( $array );
	}

	public function index(){
		$level = $this->session->userdata('level');
		if ($level == 'purchasing' || $level == 'direktur' || $level == 'spv_purchasing') {
			$request = $this->session->userdata('kategori');
			if ($request == 'glow') {
				$model = $this->RequestGlowModel;
				$result['acc_kgi'] = $model->get_request_kgi('Belum')->num_rows();
				$result['acc_kci'] = $model->get_request_kci('Belum')->num_rows();
				$result['approved'] = $model->get_request_rnd()->num_rows();
				$result['canceled'] = $model->get_request_msglow_status('NPD CANCELED')->num_rows();
				$result['sending'] = $model->get_request_msglow_status('Sample Sent to KCI')->num_rows();
				$result['received'] = $model->get_request_msglow_status('Sample Received by KCI')->num_rows();
				$result['progress'] = $model->get_request_msglow_status('FORMULA ON PROGRESS')->num_rows();
				$result['development'] = $model->get_request_msglow_status('Development Formula')->num_rows();
				$result['total'] = $model->get_request_msglow()->num_rows();
				$result['perubahan'] = $model->get_request_msglow_status('Perubahan Spesifikasi')->num_rows();
			}else{
				$result['pending'] = $this->OrderModel->get_kedatangan('Belum',$request)->num_rows();
				$result['acc'] = $this->OrderModel->get_count_acc($request);
				$result['reminder'] = $this->OrderModel->get_ekspor_by_status('Reminder',$request)->num_rows();
				$result['terlambat'] = $this->OrderModel->get_ekspor_by_status('Terlambat',$request)->num_rows();
				$result['parsial'] = $this->OrderModel->get_kedatangan('Parsial',$request)->num_rows();
				$result['datang'] = $this->OrderModel->get_kedatangan('Sudah',$request)->num_rows();
				$result['order'] = $this->OrderModel->get_count_order($request);
				$result['supplier'] = $this->MitraModel->get_count_mitra($request);
				$result['karantina'] = $this->OrderModel->get_history_validasi('Karantina',$request)->num_rows();
				$result['validasi_reject'] = $this->OrderModel->get_history_validasi('Reject',$request)->num_rows();
				$result['validasi_release'] = $this->OrderModel->get_history_validasi('Release',$request)->num_rows();
				$result['validasi_belum'] = $this->OrderModel->get_validasi_departemen('purchasing',$request)->num_rows();
			}
			
			$this->load->view('dashboard', $result, FALSE);
		}elseif ($level == 'rnd') {
			redirect('dashboard/ms');
		}elseif ($level == 'marketing' || $level == 'tim_marketing') {
			$model = $this->RequestGlowModel;
			$result['request'] = $model->get_request_kosme()->result();
			if ($level == 'marketing') {
				$result['start_date'] = date('Y-m-01'); 
				$result['last_date'] = date('Y-m-t');
				$result['col_size'] = 3; 
				$result['count_so'] = $this->SalesOrderModel->get_list_so()->num_rows();
				$result['count_produk'] = $this->SampleAwalModel->get_sample_acc()->num_rows();
				$result['count_survey'] = $this->SurveyModel->get()->num_rows();
				$result['count_customer'] = $this->CustomerModel->get_customer()->num_rows();	
			}elseif ($level == 'tim_marketing') {
				$id = $this->session->userdata('id_user');
				$result['col_size'] = 4; 
				$result['count_so'] = $this->SalesOrderModel->get_list_so_tim($id)->num_rows();
				$result['count_produk'] = $this->SampleAwalModel->get_sample_acc_tim($id)->num_rows();
				$result['count_survey'] = $this->SurveyModel->get()->num_rows();
				$result['count_customer'] = $this->CustomerModel->get_customer_tim($id)->num_rows();
			}
			$this->load->view('dashboard_marketing', $result, FALSE);
		}elseif ($level == 'gudang' || $level == 'admin_gudang_sier' || $level == 'ppic') {
			$request = $this->session->userdata('kategori');
			$result['pending'] = $this->OrderModel->get_kedatangan('Belum',$request)->num_rows();
			$result['parsial'] = $this->OrderModel->get_kedatangan('Parsial',$request)->num_rows();
			$result['datang'] = $this->OrderModel->get_kedatangan('Sudah',$request)->num_rows();
			$result['start_date'] = date('Y-m-01'); 
			$result['last_date'] = date('Y-m-t');
			$result['mutasi_baku'] = $this->MutasiModel->get_mutasi_by_kategori('Baku')->num_rows();
			$result['mutasi_kemas'] = $this->MutasiModel->get_mutasi_by_kategori('Kemas')->num_rows();
			$result['mutasi_lain'] = $this->MutasiModel->get_mutasi_lain()->num_rows();
			$result['limit_stok'] = $this->ProdukModel->get_produk_limit()->num_rows();
			$result['exp'] = $this->ProdukModel->get_produk_exp()->num_rows();
			$result['validasi_qc'] = $this->OrderModel->get_validasi_departemen('qc',$request)->num_rows();
			$result['validasi_reject'] = $this->OrderModel->get_history_validasi('Reject',$request)->num_rows();
			$result['validasi_release'] = $this->OrderModel->get_history_validasi('Release',$request)->num_rows();
			$result['validasi_karantina'] = $this->OrderModel->get_history_validasi('Karantina',$request)->num_rows();
			$result['spp'] = $this->SppModel->get_spp()->num_rows();
			$this->load->view('dashboard_gudang', $result, FALSE);
		}elseif ($level == 'spv_qc' || $level == 'qc') {
			$this->load->view('dashboard_qc', FALSE);
		}elseif ($level == 'ms_glow' || $level == 'kci') {
			redirect('dashboard/ms');
		}elseif ($level == 'produksi') {
			redirect('glow/permintaan');
		}else{
			redirect('login/logout','refresh');
		}
	}

	public function ms(){
		$model = $this->RequestGlowModel;
		if ($this->session->userdata('level') == 'ms_glow' || $this->session->userdata('level') == 'kci') {
			$result['request'] = $model->get_request_msglow()->result();
		}else{
			$result['request'] = $model->get_request_kosme()->result();
		}
		$this->load->view('dashboard_new_ms', $result, FALSE);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */