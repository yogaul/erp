<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LampiranModel extends CI_Model {

	private $tableName = 'lampiran';
	public $id_biaya;
	public $no_lampiran;
	public $keterangan_lampiran;
	public $file;

	public function rules(){
        return [
        	['field' => 'no_lampiran',
            'label' => 'no_lampiran',
            'rules' => 'required'], 

            ['field' => 'keterangan_lampiran',
            'label' => 'keterangan_lampiran',
            'rules' => 'required']          
        ];
    }

    public function insert(){
    	$this->id_biaya = $this->input->post('id_biaya');
    	$this->no_lampiran = $this->input->post('no_lampiran');
    	$this->keterangan_lampiran = $this->input->post('keterangan_lampiran');
    	$this->file = $this->_upload_file();
    	$this->db->insert($this->tableName, $this);
    }

    private function _upload_file(){
		$config['upload_path']          = './uploads/lampiran/';
		$config['allowed_types']        = 'gif|jpg|png|pdf|csv';
		$config['file_name']            = $this->no_lampiran;
		$config['overwrite']			= true;
		$config['max_size']             = 2000; // 2MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$image_path = base_url().'uploads/lampiran/';

		if ($this->upload->do_upload('file')) {
			$upload_data = $this->upload->data("file_name");
			return $image_path.$upload_data;
		}else{
			return 'kosong';
		}	
	}

	private function _delete_file($id){
		$produk = $this->get_produk_id($id)->result();
	    foreach ($produk as $value) {
	    	$foto_parts = pathinfo($value->foto_produk);
	    	$foto = $foto_parts['basename'];
	    	if ($foto != "default.jpg") {
			    $filename = explode(".", $foto)[0];
				return array_map('unlink', glob(FCPATH."uploads/produk/$filename.*"));
		    }
	    }
	}

}

/* End of file LampiranModel.php */
/* Location: ./application/models/LampiranModel.php */