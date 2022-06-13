<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerModel extends CI_Model {

	public function get_customer(){
		$this->db->order_by('id_customer', 'desc');
		return $this->db->get('customer');
	}

	public function get_customer_tim($id){
		$this->db->select('customer.*,sample_awal.id_sample_awal,user.id_user');
		$this->db->join('sample_awal', 'customer.id_customer = sample_awal.id_customer', 'inner');
		$this->db->join('user', 'user.id_user = sample_awal.id_user', 'inner');
		$this->db->where('user.id_user', $id);
		$this->db->order_by('customer.nama_customer', 'asc');
		return $this->db->get('customer');
	}

	public function get_log_customer($id){
		$this->db->where('id_customer', $id);
		return $this->db->get('log_customer');
	}

	public function get_customer_by_id($id){
		$this->db->where('id_customer', $id);
		return $this->db->get('customer');
	}

	public function get_kode_customer(){
		$this->db->select('kode_customer');
		$this->db->order_by('kode_customer', 'desc');
		return $this->db->get('customer', 1);
	}

	public function get_customer_by_brand($id){
		$this->db->select('customer.*,brand_produk.id_brand_produk');
		$this->db->join('brand_produk', 'customer.id_customer = brand_produk.id_customer', 'inner');
		$this->db->where('brand_produk.id_brand_produk', $id);
		return $this->db->get('customer');
	}

	public function insert_customer($data){
		return $this->db->insert('customer', $data);
	}

	public function insert_log_customer($data){
		return $this->db->insert('log_customer', $data);
	}

	public function update_customer($id,$data){
		$this->db->where('id_customer', $id);
		return $this->db->update('customer', $data);
	}

	public function delete_customer($id){
		$this->db->where('id_customer', $id);
		return $this->db->delete('customer');
	}

}

/* End of file CustomerModel.php */
/* Location: ./application/models/CustomerModel.php */