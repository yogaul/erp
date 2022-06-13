<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DesignModel extends CI_Model {

	private $tableName = "acc_design";

	public function save_design($data){
		return $this->db->insert($this->tableName, $data);
	}

	public function get_design(){
		$this->db->select('acc_design.*,sample_acc.nama_produk_acc,volume_produk_acc,brand_produk.nama_brand_produk,customer.nama_customer');
		$this->db->join('sample_acc', 'sample_acc.id_sample_acc = acc_design.id_sample_acc', 'inner');
		$this->db->join('brand_produk', 'brand_produk.id_brand_produk = sample_acc.id_brand_produk', 'inner');
		$this->db->join('customer', 'customer.id_customer = brand_produk.id_customer', 'inner');
		$this->db->order_by('acc_design.tanggal_acc_design', 'acc');
		return $this->db->get($this->tableName);
	}

	public function get_design_tim($id){
		$this->db->select('acc_design.*,sample_acc.nama_produk_acc,volume_produk_acc,brand_produk.nama_brand_produk,customer.nama_customer');
		$this->db->join('sample_acc', 'sample_acc.id_sample_acc = acc_design.id_sample_acc', 'inner');
		$this->db->join('brand_produk', 'brand_produk.id_brand_produk = sample_acc.id_brand_produk', 'inner');
		$this->db->join('customer', 'customer.id_customer = brand_produk.id_customer', 'inner');
		$this->db->where('sample_acc.id_user', $id);
		$this->db->order_by('acc_design.tanggal_acc_design', 'acc');
		return $this->db->get($this->tableName);
	}

	public function get_design_id($id){
		$this->db->where('id_acc_design', $id);
		return $this->db->get($this->tableName);
	}

	public function delete_design($id){
		$this->db->where('id_acc_design', $id);
		return $this->db->delete($this->tableName);
	}

}

/* End of file DesignModel.php */
/* Location: ./application/models/DesignModel.php */