<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MitraModel extends CI_Model {

	public $tableName = 'mitra';

	public function get_mitra($request){
		if ($request == 'Baku') {
			$this->db->where('tipe_mitra', 'Bahan Baku');
		}elseif ($request == 'Kemas') {
			$this->db->where('tipe_mitra', 'Kemas');
		}elseif ($request == 'Teknik') {
			$this->db->where('tipe_mitra', 'Teknik');
		}elseif ($request == 'all') {
			return $this->db->get($this->tableName);
		}
		return $this->db->get($this->tableName);
	}

	public function get_nomor(){
		$this->db->order_by('no_mitra', 'desc');
		return $this->db->get($this->tableName, 1, 0);
	}

	public function select_mitra($id){
		$this->db->where('id_mitra', $id);
		return $this->db->get($this->tableName);
	}

	public function mitra_json($id){
		$this->db->select('mitra.id_mitra,nama_mitra');
		$this->db->join('produk', 'mitra.id_mitra = produk.id_mitra', 'inner');
		$this->db->where('id_produk', $id);
		return $this->db->get($this->tableName);
	}

	public function add($data){
		return $this->db->insert($this->tableName, $data);
	}

	public function delete($id){
		$this->db->where('id_mitra', $id);
		return $this->db->delete($this->tableName);
	}

	public function update($id,$data){
		$this->db->where('id_mitra', $id);
		return $this->db->update($this->tableName, $data);
	}

	public function get_count_mitra($request){
		if ($request == 'Baku') {
			$this->db->where('tipe_mitra', 'Bahan Baku');
		}elseif ($request == 'Kemas') {
			$this->db->where('tipe_mitra', 'Kemas');
		}elseif ($request == 'Teknik') {
			$this->db->where('tipe_mitra', 'Teknik');
		}
		return $this->db->get($this->tableName)->num_rows();
	}

}

/* End of file MitraModel.php */
/* Location: ./application/models/MitraModel.php */