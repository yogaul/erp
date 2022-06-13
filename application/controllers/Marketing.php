<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marketing extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (empty($this->session->userdata('login'))) {
			redirect('Login/index','refresh');
		}
		$array = array(
			'active' => 'marketing'
		);
		$this->session->set_userdata( $array );
	}

	public function index(){
		$result['marketing'] = $this->UserModel->get_marketing()->result();
		$this->load->view('marketing/marketing/data_marketing', $result, FALSE);
	}

	public function ubah_simpan(){
		$id = $this->input->post('id_marketing');
		$nama = $this->input->post('nama_marketing');
		$telp = $this->input->post('telp_marketing');
		$email = $this->input->post('email_marketing');
		$aksi = $this->input->post('aksi');

		if ($aksi == 'tambah') {
			
			$data_marketing = [
				'nama_user' => $nama,
				'telp_user' => $telp,
				'email_user' => $email,
				'password' => password_hash('kosme1234', PASSWORD_DEFAULT),
				'level' => 'tim_marketing'
			];

			$this->UserModel->insert_marketing($data_marketing);

		}elseif ($aksi == 'edit') {
			
			$data_marketing = [
				'nama_user' => $nama,
				'telp_user' => $telp,
				'email_user' => $email
			];

			$this->UserModel->update_marketing($id,$data_marketing);

		}

		redirect('marketing','refresh');
	}

	public function hapus($id){
		$this->UserModel->delete_marketing($id);
		redirect('marketing','refresh');
	}

	public function get_json_marketing(){
		$id = $this->input->post('id');
		$result = $this->UserModel->get_marketing_by_id($id)->row();
		echo json_encode($result);
	}

	public function get_json_marketing_all(){
		$result = $this->UserModel->get_marketing()->result();
		echo json_encode($result);
	}

}

/* End of file Marketing.php */
/* Location: ./application/controllers/Marketing.php */