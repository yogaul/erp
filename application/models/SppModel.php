<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SppModel extends CI_Model {

	private $tableName = 'spp';

	public function get_spp(){
		$this->db->select('spp.*,customer.nama_customer,brand_produk.nama_brand_produk');
		$this->db->join('brand_produk', 'brand_produk.id_brand_produk = spp.id_brand_produk', 'inner');
		$this->db->join('customer', 'customer.id_customer = brand_produk.id_customer', 'inner');
		$this->db->order_by('spp.tanggal_spp', 'asc');
		return $this->db->get($this->tableName);
	}

	public function get_spp_tim($id){

	}

	public function get_spp_id($id){
		$this->db->select('spp.*,customer.*, brand_produk.nama_brand_produk');
		$this->db->join('brand_produk', 'brand_produk.id_brand_produk = spp.id_brand_produk', 'inner');
		$this->db->join('customer', 'customer.id_customer = brand_produk.id_customer', 'inner');
		$this->db->where('spp.id_spp', $id);
		return $this->db->get($this->tableName);
	}

	public function get_detail_spp_id($id){
		$this->db->select('spp.id_spp,sample_acc.id_sample_acc,nama_produk_acc,volume_produk_acc,detail_spp.*');
		$this->db->join('detail_spp', 'spp.id_spp = detail_spp.id_spp', 'inner');
		$this->db->join('sample_acc', 'sample_acc.id_sample_acc = detail_spp.id_sample_acc', 'inner');
		$this->db->where('spp.id_spp', $id);
		return $this->db->get($this->tableName);
	}

	public function save_spp($data){
		return $this->db->insert($this->tableName, $data);
	}

	public function save_detail_spp($data){
		return $this->db->insert('detail_spp', $data);
	}

	public function update_spp($id,$data){
		$this->db->where('id_spp', $id);
		return $this->db->update($this->tableName, $data);
	}

	public function delete_detail_spp($id){
		$this->db->where('id_spp', $id);
		return $this->db->delete('detail_spp');
	}

	public function delete_spp($id){
		$this->db->where('id_spp', $id);
		return $this->db->delete($this->tableName);
	}

}

/* End of file SppModel.php */
/* Location: ./application/models/SppModel.php */