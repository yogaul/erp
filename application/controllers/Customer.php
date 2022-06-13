<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (empty($this->session->userdata('login'))) {
			redirect('Login/index','refresh');
		}
		$array = array(
			'active' => 'customer' 
		);
		$this->session->set_userdata( $array );
	}

	public function index(){
		$level = $this->session->userdata('level');
		if ($level == 'marketing' || $level == 'direktur') {
			$result['customer'] = $this->CustomerModel->get_customer()->result();
		}elseif ($level == 'tim_marketing') {
			$id = $this->session->userdata('id_user');
			$result['customer'] = $this->CustomerModel->get_customer_tim($id)->result();
		}
		$this->load->view('marketing/customer/data_customer', $result, FALSE);
	}

	public function ubah_simpan(){
		$id = $this->input->post('id_customer');
		$nama = $this->input->post('nama_customer');
		$perusahaan = $this->input->post('nama_perusahaan');
		$jabatan = $this->input->post('jabatan_customer');
		$alamat = $this->input->post('alamat_perusahaan');
		$alamat_cust = $this->input->post('alamat_pengiriman');
		$telp = $this->input->post('telp_customer');
		$telp_perusahaan = $this->input->post('telp_perusahaan');
		$aksi = $this->input->post('aksi');

		if ($aksi == 'tambah') {
			// $this->CustomerModel->insert_customer($arr_customer);
		}elseif ($aksi == 'edit') {
			$ubahan = "perubahan";
			$data = $this->CustomerModel->get_customer_by_id($id)->row();

			$arr_customer = [
				'nama_customer' 			=> $nama,
				'nama_perusahaan_customer' 	=> $perusahaan,
				'jabatan_customer' 			=> $jabatan,
				'alamat_cust' 				=> $alamat_cust,
				'alamat_perusahaan_kirim' 	=> $alamat,
				'telp_customer' 			=> $telp,
				'telp_perusahaan_customer' 	=> $telp_perusahaan,
				'verifikasi' 				=> $this->validasi($telp)
			];
			
			if ($nama != $data->nama_customer) {
				$ubahan .= " nama $data->nama_customer menjadi $nama,";
			}else if ($perusahaan != $data->nama_perusahaan_customer) {
				$ubahan .= " perusahaan $data->nama_perusahaan_customer menjadi $perusahaan,";
			}else if ($jabatan != $data->jabatan_customer) {
				$ubahan .= " jabatan $data->jabatan_customer menjadi $jabatan,";
			}else if ($alamat_cust != $data->alamat_cust) {
				$ubahan .= " alamat pengiriman $data->alamat_cust menjadi $alamat_cust,";
			}else if ($alamat != $data->alamat_perusahaan_kirim) {
				$ubahan .= " alamat perusahaan $data->alamat_perusahaan_kirim menjadi $alamat,";
			}else if ($telp != $data->telp_customer) {
				$ubahan .= " telepon customer $data->telp_customer menjadi $telp,";
			}else if ($telp_perusahaan != $data->telp_perusahaan_customer) {
				$ubahan .= " telepon customer $data->telp_perusahaan_customer menjadi $telp_perusahaan,";
			}
			
			if ($ubahan != 'perubahan') {
				$arr_log = [
					'id_customer'			=> $id,
					'tanggal_log_customer'	=> date('Y-m-d H:i:s'),
					'user_log_customer'		=> $this->session->userdata('nama_user'),
					'deskripsi_log_customer'=> rtrim($ubahan,',')
				];
				$this->CustomerModel->insert_log_customer($arr_log);
			}

			$this->CustomerModel->update_customer($id,$arr_customer);
		}

		redirect('customer','refresh');
	}
	
	public function verifikasi($id = null){
		if (!is_null($id)) {
			$data = $this->CustomerModel->get_customer_by_id($id)->row();

			$arr_customer = [
				'verifikasi' => $this->validasi($data->telp_customer)
			];

			$this->CustomerModel->update_customer($id, $arr_customer);
			
			redirect('customer','refresh');
		}
	}

	private function validasi($nomor){
		$data = array(
			'number' 	=> $nomor,
			'message' 	=> 'Terimakasih telah melakukan verifikasi nomor WhatsApp anda, Silahkan klik link dibawah ini untuk informasi lebih lengkap https://kosme.co.id'
		);

		$headers = [
			'Content-Type: application/json'
		];
		
	
		$url = "http://167.99.76.22:3200/validate";

		$ch = curl_init( $url );
		curl_setopt( $ch, CURLOPT_POST, true);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt( $ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
	
		$response = curl_exec( $ch );
		return $response;
	}

	public function hapus(){
		$id = $this->uri->segment(3);
		if (!empty($id)) {
			$this->CustomerModel->delete_customer($id);
		}
		redirect('customer','refresh');
	}

	public function get_json_customer(){
		$id = $this->input->post('id');
		$result = $this->CustomerModel->get_customer_by_id($id)->result();
		echo json_encode($result);
	}

	public function get_json_kode(){
		$kode = $this->CustomerModel->get_kode_customer()->row();
		if (empty($kode)) {
			$kode_akhir = 'CST0001';
		}else{
			$kode_akhir = substr($kode->kode_customer, 3,4)+1;
			if($kode_akhir<10){
			  	$kode_cust = substr($kode->kode_customer, 0, -1).$kode_akhir;
			}elseif($kode_akhir > 9 && $kode_akhir <= 99){
				$kode_cust = substr($kode->kode_customer, 0, -2).$kode_akhir;
			}else{
				$kode_cust = substr($kode->kode_customer, 0, -2).$kode_akhir;
			}
		}
		echo json_encode($kode_cust);
	}

	public function json_customer_brand(){
		$id_brand = $this->input->post('id');
		$result = $this->CustomerModel->get_customer_by_brand($id_brand)->row();
		echo json_encode($result);
	}

	public function json_log_customer(){
		$id = $this->input->post('id');
		$result = $this->CustomerModel->get_log_customer($id)->result();
		echo json_encode($result);
	}

}

/* End of file Customer.php */
/* Location: ./application/controllers/Customer.php */