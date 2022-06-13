<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class TujuanModel extends CI_Model {

    public $tableName = 'tujuan_pengiriman';

	public function get_tujuan(){
		return $this->db->get($this->tableName);
	}

	public function get_tujuan_id($id){
		$this->db->where('id_tujuan_pengiriman', $id);
		return $this->db->get($this->tableName);
	}

	public function save_tujuan($data){
		return $this->db->insert($this->tableName, $data);
	}

	public function update_tujuan($id,$data){
		$this->db->where('id_tujuan_pengiriman', $id);
		return $this->db->update($this->tableName, $data);
	}

	public function delete_tujuan($id){
		$this->db->where('id_tujuan_pengiriman', $id);
		return $this->db->delete($this->tableName);
	}

}

/* End of file TujuanModel.php */
