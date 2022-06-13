<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BomModel extends CI_Model {
	
	private $tableName = "bom";


	public function save_bom($data){
		return $this->db->insert($this->tableName, $data);
	}

	public function save_detail_bom($data){
		return $this->db->insert('detail_bom', $data);
	}

	public function get_list_bom(){
		$this->db->select('bom.*,customer.nama_customer,brand_produk.nama_brand_produk');
		$this->db->join('brand_produk', 'brand_produk.id_brand_produk = bom.id_brand_produk', 'inner');
		$this->db->join('customer', 'customer.id_customer = brand_produk.id_customer', 'inner');
		$this->db->order_by('bom.tanggal_bom', 'asc');
		return $this->db->get($this->tableName);
	}

	public function get_list_bom_tim($id){
		$this->db->select('bom.*,customer.nama_customer,brand_produk.nama_brand_produk,sample_acc.id_user');
		$this->db->join('brand_produk', 'brand_produk.id_brand_produk = bom.id_brand_produk', 'inner');
		$this->db->join('customer', 'customer.id_customer = brand_produk.id_customer', 'inner');
		$this->db->join('sample_acc', 'brand_produk.id_brand_produk = sample_acc.id_brand_produk', 'inner');
		$this->db->where('sample_acc.id_user', $id);
		$this->db->order_by('bom.tanggal_bom', 'asc');
		return $this->db->get($this->tableName);
	}

	public function get_bom_id($id){
		$this->db->select('bom.*, customer.nama_customer,nama_perusahaan_customer, brand_produk.nama_brand_produk');
		$this->db->join('brand_produk', 'brand_produk.id_brand_produk = bom.id_brand_produk', 'inner');
		$this->db->join('customer', 'customer.id_customer = brand_produk.id_customer', 'inner');
		$this->db->where('bom.id_bom', $id);
		return $this->db->get($this->tableName);
	}

	public function get_detail_bom($id){
		$this->db->select('bom.id_bom,sample_acc.id_sample_acc,nama_produk_acc,volume_produk_acc,detail_bom.*');
		$this->db->join('detail_bom', 'bom.id_bom = detail_bom.id_bom', 'inner');
		$this->db->join('sample_acc', 'sample_acc.id_sample_acc = detail_bom.id_sample_acc', 'inner');
		$this->db->where('bom.id_bom', $id);
		return $this->db->get($this->tableName);
	}

	public function get_img_detail($id){
		$this->db->select('foto_desain_bom');
		$this->db->where('id_detail_bom', $id);
		return $this->db->get('detail_bom');
	}

}

/* End of file BomModel.php */
/* Location: ./application/models/BomModel.php */