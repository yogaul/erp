<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BiayaModel extends CI_Model {

	private $tableName = 'biaya';
	public $id_biaya;
	public $akun_keuangan;
	public $nama_biaya;
	public $vendor;
	public $akun_beban;
	public $tanggal;
	public $kategori;
	public $jumlah;
	public $keterangan;

	public function get_biaya(){
		$this->db->select('biaya.*,COUNT(lampiran.id_lampiran) AS jumlah_lampiran');
		$this->db->join('lampiran', 'biaya.id_biaya = lampiran.id_biaya', 'left');
		$this->db->group_by('biaya.nama_biaya');
		$this->db->order_by('biaya.id_biaya', 'asc');
		return $this->db->get($this->tableName);
	}

	public function get_biaya_id($id){
		$this->db->where('id_biaya', $id);
		return $this->db->get($this->tableName);
	}

	public function insert($data){
		return $this->db->insert($this->tableName, $data);
	}

	public function update($id,$data){
		$this->db->where('id_biaya', $id);
		return $this->db->update($this->tableName, $data);
	}

	public function delete($id){
		$this->db->where('id_biaya', $id);
		return $this->db->delete($this->tableName);
	}

}

/* End of file BiayaModel.php */
/* Location: ./application/models/BiayaModel.php */