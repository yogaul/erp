<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('register_user');
	}

	public function save_user(){
		$nama = $this->input->post('nama_user');
		$email = $this->input->post('email_user');
		$password = $this->input->post('password_user');

		$user_data = array('nama_user' => $nama, 'email_user' => $email, 'password' => $password);
		$do_insert = $this->RegisterModel->tambah($user_data);

		if ($do_insert == TRUE) {
			redirect('login');
		}else{
			echo "Anda gagal register !";
		}
	}
}
