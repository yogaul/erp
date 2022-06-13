<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lampiran extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (empty($this->session->userdata('login'))) {
			redirect('Login/index','refresh');
		}
		$this->load->library('form_validation');
	}

	public function tambah(){
		$id = $this->uri->segment(3);
		if (!empty($id)) {
			$this->load->view('biaya/lampiran_biaya', FALSE);
		}else{
			redirect('Biaya/index','refresh');
		}
	}

	public function simpan(){
		$lampiran = $this->LampiranModel;
        $validation = $this->form_validation;
        $validation->set_rules($lampiran->rules());

        if ($validation->run()) {
            $lampiran->insert();
            redirect('Biaya/index','refresh');
        }else{
        	echo 'gagal upload file';
        }
        
	}

	public function hapus(){
		$id = $this->uri->segment(3);
		if (!empty($id)) {
			$do_delete = $this->LampiranModel->delete($id);
			if ($do_delete == TRUE) {
				redirect('Lampiran/index','refresh');
			}else{
				echo 'gagal menghapus produk';
			}
		}else{
			redirect('Lampiran/index','refresh');
		}
	}

}

/* End of file Lampiran.php */
/* Location: ./application/controllers/Lampiran.php */