<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (empty($this->session->userdata('login'))) {
			redirect('Login/index','refresh');
		}
		$this->load->library('form_validation');
		$array = array(
			'active' => 'approval'
		);
		$this->session->set_userdata( $array );
	}

	public function index($request){
		$akses = $this->session->userdata('level');
		$kode = "";

		if ($request == 'baku') {
			$kode = 'BHB';
		}elseif ($request == 'kemas') {
			$kode = 'KMS';
		}elseif ($request == 'teknik') {
			$kode = 'TKP';
		}

		$result['kode'] = $request;
		$result['list_po'] = $this->OrderModel->get_order_acc($akses,$kode)->result();
		$this->load->view('approval/data_approval', $result, FALSE);
	}

	public function acc_all(){
		// $message = "Daftar PO Yang Disetujui Tanggal ".date('d/m/Y',strtotime(date('Y-m-d')))." : <br>";
		$akses = $this->session->userdata('level');
		$request = $this->input->post('kategori');

		$kode = "";

		if ($request == 'baku') {
			$kode = 'BHB';
		}elseif ($request == 'kemas') {
			$kode = 'KMS';
		}elseif ($request == 'teknik') {
			$kode = 'TKP';
		}

		if ($akses == 'spv_purchasing') {
			$data_update = [
				'acc_spv' => 'Sudah',
				'catatan_spv' => 'Disetujui',
				'tanggal_acc_spv' => date('Y-m-d')
			];
		}elseif ($akses == 'direktur') {
			$data_update = [
				'status_po' => 'Sudah',
				'catatan_approve' => 'Disetujui',
				'tanggal_approve' => date('Y-m-d')
			];
		}
		$this->OrderModel->update_acc_all($akses,$data_update,$kode);
		// $data_acc = $this->OrderModel->get_order_acc()->result();
		// foreach ($data_acc as $value) {
		// 	$message .= $value->no_po."<br>";
		// }
		// $this->send_email($message);
		// echo $message;
		redirect("approval/index/$request",'refresh');
	}

	public function acc_selected(){
		$id = $this->input->post('id_po');
		$kategori = $this->input->post('kategori');
		$akses = $this->session->userdata('level');
		// $message = "Daftar PO Yang Disetujui Tanggal ".date('d/m/Y',strtotime(date('Y-m-d')))." : \r\n";
		if (!empty($id)) {
			if ($akses == 'spv_purchasing') {
				$data_update = [
					'acc_spv' => 'Sudah',
					'catatan_spv' => 'Disetujui',
					'tanggal_acc_spv' => date('Y-m-d')
				];
			}elseif ($akses == 'direktur') {
				$data_update = [
					'status_po' => 'Sudah',
					'catatan_approve' => 'Disetujui',
					'tanggal_approve' => date('Y-m-d')
				];
			}
			foreach ($id as $index => $value) {
				$this->OrderModel->update_acc($value,$data_update);
				// $list_no_po = $this->OrderModel->get_no_po($value)->result();
				// foreach ($list_no_po as $value) {
				// 	$message .= $value->no_po."\r\n";
				// }
			}
			// $this->send_email($message);
		}else{
			echo "<script type='text/javascript'>alert('Anda belum memilih PO !');</script>";
		}	
		redirect("approval/index/$kategori",'refresh');
	}

	public function tolak(){	
		$id = $this->uri->segment(3);
		if (!empty($id)) {
			$tipe = $this->OrderModel->get_tipe_order($id)->row();
			$result['detail_po'] = $this->OrderModel->get_detail_order($id)->row();
			$result['detail_bahan'] = $this->OrderModel->get_bahan_detail($id)->result();
			$result['tipe'] = $tipe->tipe_mitra;
			$this->load->view('approval/tolak_order', $result, FALSE);
		}else{
			redirect('Approval/index','refresh');
		}
	}

	public function simpan_tolak(){
		$id_po = $this->input->post('id_po');
		$status_po = 'Ditolak';
		$keterangan = $this->input->post('keterangan');
		$data_update = [
			'status_po' => $status_po,
			'catatan_approve' => $keterangan
		];
		$this->OrderModel->update_acc($id_po,$data_update);
		redirect('Approval/index','refresh');
	}

	public function get_json_tolak(){
		$id = $this->input->post('id_po');
		$akses = $this->session->userdata('level');
		// $message = "Daftar PO Yang Ditolak Tanggal ".date('d/m/Y',strtotime(date('Y-m-d')))." : \r\n";
		if ($akses == 'direktur') {
			$data_update = [
				'status_po' => 'Ditolak',
				'catatan_approve' => '-',
				'tanggal_approve' => date('Y-m-d')
			];
		}elseif ($akses == 'spv_purchasing') {
			$data_update = [
				'acc_spv' => 'Ditolak',
				'catatan_spv' => '-',
				'tanggal_acc_spv' => date('Y-m-d')
			];
		}
		foreach ($id as $index => $value) {
			$this->OrderModel->update_acc($value,$data_update);
			// $list_no_po = $this->OrderModel->get_no_po($value)->result();
			// foreach ($list_no_po as $value) {
			// 	$message .= $value->no_po."\r\n";
			// }
		}
		// $this->send_email($message);
		echo json_encode('sukses');
	}

	// private function send_email($message){
	// 	$this->load->library('email');
	// 	$this->email->from('fatihkosme@gmail.com', 'PURCHASING');
	// 	$this->email->to('purchasing.kosme@gmail.com');
	// 	$this->email->subject('INFO APPROVAL PO');
	// 	$this->email->message($message);
	// 	$this->email->send();
	// }


}

/* End of file Approval.php */
/* Location: ./application/controllers/Approval.php */