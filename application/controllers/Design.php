<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Design extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (empty($this->session->userdata('login'))) {
			redirect('Login/index','refresh');
		}
		$array = array(
			'active' => 'design'
		);
		$this->session->set_userdata( $array );
	}

	public function index(){
		$level = $this->session->userdata('level');
		if ($level == 'marketing' || $level == 'direktur') {
			$result['list_design'] = $this->DesignModel->get_design()->result();
			$result['brand'] = $this->BrandModel->get_brand()->result();
		}elseif ($level == 'tim_marketing') {
			$id = $this->session->userdata('id_user');
			$result['list_design'] = $this->DesignModel->get_design_tim($id)->result();
			$result['brand'] = $this->BrandModel->get_brand_tim($id)->result();
		}
		$this->load->view('marketing/acc_design/data_design', $result, FALSE);
	}

	public function simpan(){
		$id_acc_design = 'DSGN-'.date('YmdHis');
		$id_sample_acc = $this->input->post('produk_acc_design');
		$tanggal_acc_design = date('Y-m-d');
		$keterangan_acc = $this->input->post('keterangan_acc_design');

		$arr_design = [
			'id_sample_acc' => $id_sample_acc,
			'tanggal_acc_design' => $tanggal_acc_design,
			'foto_acc_design' => $this->upload_image($id_acc_design),
			'keterangan_acc_design' => $keterangan_acc
		];

		$this->DesignModel->save_design($arr_design);
		redirect('design/index','refresh');
	}

	private function upload_image($filename){
		$config['upload_path']          = './uploads/design_acc/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg|pdf';
		$config['file_name']            = $filename;
		$config['overwrite']			= true;
		$config['max_size']             = 3000; 

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$image_path = base_url().'uploads/design_acc/';

		if ($this->upload->do_upload('dokumen_design')) {
			$upload_data = $this->upload->data("file_name");
			return $image_path.$upload_data;
		}else{
			return $image_path."default.jpg";
		}	
	}

	public function hapus($id){
		$this->delete_image($id);
		$this->DesignModel->delete_design($id);
		redirect('design','refresh');
	}

	private function delete_image($id){
		$acc_design = $this->DesignModel->get_design_id($id)->row();
    	$foto_parts = pathinfo($acc_design->foto_acc_design);
    	$foto = $foto_parts['basename'];
    	if ($foto != "default.jpg") {
		    $filename = explode(".", $foto)[0];
			return array_map('unlink', glob(FCPATH."uploads/design_acc/$filename.*"));
	    }
	}

}

/* End of file Design.php */
/* Location: ./application/controllers/Design.php */