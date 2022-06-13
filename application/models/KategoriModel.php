<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KategoriModel extends CI_Model {

	public $tableName = 'kategori';

	public function get_kategori(){
		return $this->db->get($this->tableName);
	}

	public function get_kategori_id($id){
		$this->db->where('id_kategori', $id);
		return $this->db->get($this->tableName);
	}

	public function insert($data){
		return $this->db->insert($this->tableName, $data);
	}

	public function update($id,$data){
		$this->db->where('id_kategori', $id);
		return $this->db->update($this->tableName, $data);
	}

	public function delete($id){
		$this->db->where('id_kategori', $id);
		return $this->db->delete($this->tableName);
	}
}

/* End of file KategoriModel.php */
/* Location: ./application/models/KategoriModel.php */