<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->load->view('login_new', FALSE);
	}

	public function auth(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$cek = $this->UserModel->get_by_email($email)->num_rows();
		if ($cek > 0) {
			$user_info = $this->UserModel->get_by_email($email)->row();
			$id = $user_info->id_user;
			$nama = $user_info->nama_user;
			$level = $user_info->level;
			$password_db = $user_info->password;

			if (password_verify($password, $password_db)) {
				$session_array = array(
					'login' => 'true', 
					'id_user' => $id,
					'email_user' => $email, 
					'nama_user' => $nama, 
					'level' => $level,
					'active' => 'dashboard',
					'kategori' => 'Baku'
				);	
				$this->session->set_userdata($session_array);
				redirect('dashboard');
			}else{
				echo "<script language='javascript'>alert('Email/password anda salah !');</script>";
				redirect('login','refresh');
			}
			
		}else{
			echo "<script language='javascript'>alert('Email anda salah !');</script>";
			redirect('login','refresh');
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('login','refresh');
	}

	public function ubah_password(){
		$email = $this->session->userdata('email_user');
		$password_now = $this->input->post('password_sekarang');
		$password_baru = $this->input->post('password_baru');
		$konfirmasi_password = $this->input->post('konfirmasi_password');

		$data_user = $this->UserModel->get_by_email($email)->row();
		$password_db = $data_user->password;
		if (password_verify($password_now, $password_db)) {
			if ($password_baru != $konfirmasi_password) {
				echo "<script language='javascript'>alert('Konfirmasi password baru anda salah!');</script>";
			}else{
				$new_hash = password_hash($konfirmasi_password, PASSWORD_DEFAULT);
				$data_update = array('password' => $new_hash);
				$this->UserModel->update($email,$data_update);
				echo "<script language='javascript'>alert('Password anda berhasil diubah.');</script>";
			}
		}else{
			echo "<script language='javascript'>alert('Password anda salah!');</script>";
		}
		redirect('Dashboard/index','refresh');
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */