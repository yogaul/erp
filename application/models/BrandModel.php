<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BrandModel extends CI_Model {

	private $tableName = 'brand_produk';

	public function save_brand($data){
		return $this->db->insert($this->tableName, $data);
	}

	public function update_brand($id,$data){
		$this->db->where('id_brand_produk', $id);
		return $this->db->update($this->tableName, $data);
	}

	public function get_brand(){
		$this->db->select('brand_produk.*,customer.nama_customer,nama_perusahaan_customer');
		$this->db->join('customer', 'customer.id_customer = brand_produk.id_customer', 'inner');
		$this->db->order_by('brand_produk.id_brand_produk', 'desc');
		return $this->db->get($this->tableName);
	}

	public function get_brand_tim($id){
		$this->db->select('brand_produk.*,customer.nama_customer,nama_perusahaan_customer,sample_awal.id_sample_awal,id_user');
		$this->db->join('customer', 'customer.id_customer = brand_produk.id_customer', 'inner');
		$this->db->join('sample_awal', 'customer.id_customer = sample_awal.id_customer', 'inner');
		$this->db->where('sample_awal.id_user', $id);
		$this->db->order_by('brand_produk.id_brand_produk', 'desc');
		return $this->db->get($this->tableName);
	}

	public function get_brand_customer($id){
		$this->db->where('id_customer', $id);
		return $this->db->get($this->tableName);
	}

	public function get_brand_id($id){
		$this->db->where('id_brand_produk', $id);
		return $this->db->get($this->tableName);
	}

	public function delete_brand($id){
		$this->db->where('id_brand_produk', $id);
		return $this->db->delete($this->tableName);
	}

}

/* End of file BrandModel.php */
/* Location: ./application/models/BrandModel.php */