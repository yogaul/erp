<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SalesOrderModel extends CI_Model {

	private $tableName = "sales_order";

	public function save_so($data){
		return $this->db->insert($this->tableName, $data);
	}

	public function save_detail_so($data){
		return $this->db->insert('detail_sales_order', $data);
	}

	public function get_list_so(){
		$this->db->select('sales_order.id_sales_order,tanggal_sales_order,catatan_sales_order,customer.nama_customer,nama_perusahaan_customer,brand_produk.nama_brand_produk, (select sum(detail_sales_order.harga_item_so)) as jumlah');
		$this->db->join('brand_produk', 'brand_produk.id_brand_produk = sales_order.id_brand_produk', 'inner');
		$this->db->join('customer', 'customer.id_customer = brand_produk.id_customer', 'inner');
		$this->db->join('detail_sales_order', 'sales_order.id_sales_order = detail_sales_order.id_sales_order', 'inner');
		$this->db->group_by('detail_sales_order.id_sales_order');
		$this->db->order_by('sales_order.tanggal_sales_order', 'asc');
		return $this->db->get($this->tableName);
	}

	public function get_list_so_tim($id){
		$this->db->select('sales_order.id_sales_order,tanggal_sales_order,catatan_sales_order,customer.nama_customer,nama_perusahaan_customer,brand_produk.nama_brand_produk,detail_sales_order.id_sample_acc,(select sum(detail_sales_order.harga_item_so)) as jumlah,sample_acc.id_user');
		$this->db->join('brand_produk', 'brand_produk.id_brand_produk = sales_order.id_brand_produk', 'inner');
		$this->db->join('customer', 'customer.id_customer = brand_produk.id_customer', 'inner');
		$this->db->join('detail_sales_order', 'sales_order.id_sales_order = detail_sales_order.id_sales_order', 'inner');
		$this->db->join('sample_acc', 'sample_acc.id_sample_acc = detail_sales_order.id_sample_acc', 'inner');
		$this->db->where('sample_acc.id_user', $id);
		$this->db->group_by('detail_sales_order.id_sales_order');
		$this->db->order_by('sales_order.tanggal_sales_order', 'asc');
		return $this->db->get($this->tableName);
	}

	public function get_so_id($id){
		$this->db->select('sales_order.*,customer.nama_customer,nama_perusahaan_customer, brand_produk.nama_brand_produk');
		$this->db->join('brand_produk', 'brand_produk.id_brand_produk = sales_order.id_brand_produk', 'inner');
		$this->db->join('customer', 'customer.id_customer = brand_produk.id_customer', 'inner');
		$this->db->where('sales_order.id_sales_order', $id);
		return $this->db->get($this->tableName);
	}

	public function get_user_so_cetak($id){
		$this->db->select('sales_order.*, detail_sales_order.id_detail_sales_order,sample_acc.id_sample_acc,user.nama_user');
		$this->db->join('detail_sales_order', 'sales_order.id_sales_order = detail_sales_order.id_sales_order', 'inner');
		$this->db->join('sample_acc', 'sample_acc.id_sample_acc = detail_sales_order.id_sample_acc', 'inner');
		$this->db->join('user', 'user.id_user = sample_acc.id_user', 'inner');
		$this->db->where('sales_order.id_sales_order', $id);
		return $this->db->get($this->tableName);
	}

	public function get_detail_so_id($id){
		$this->db->select('sales_order.id_sales_order,sample_acc.id_sample_acc,nama_produk_acc,volume_produk_acc,detail_sales_order.*');
		$this->db->join('detail_sales_order', 'sales_order.id_sales_order = detail_sales_order.id_sales_order', 'inner');
		$this->db->join('sample_acc', 'sample_acc.id_sample_acc = detail_sales_order.id_sample_acc', 'inner');
		$this->db->where('sales_order.id_sales_order', $id);
		return $this->db->get($this->tableName);
	}

	public function update_so($id,$data){
		$this->db->where('id_sales_order', $id);
		return $this->db->update($this->tableName, $data);
	}

	public function update_detail_so($id,$data){
		$this->db->where('id_detail_sales_order', $id);
		return $this->db->update('detail_sales_order', $data);
	}

	public function delete_so($id){
		$this->db->where('id_sales_order', $id);
		return $this->db->delete($this->tableName);
	}

	public function delete_detail_so($id){
		$this->db->where('id_sales_order', $id);
		return $this->db->delete('detail_sales_order');
	}

}

/* End of file SalesOrderModel.php */
/* Location: ./application/models/SalesOrderModel.php */