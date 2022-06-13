<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KosmeprodukModel extends CI_Model {

	public function get_kosme_produk(){
		$this->db->select('produk_kosme.*, kategori_produk_kosme.nama_kategori_produk_kosme');
		$this->db->join('kategori_produk_kosme', 'kategori_produk_kosme.id_kategori_produk_kosme = produk_kosme.id_kategori_produk_kosme', 'inner');
		$this->db->order_by('id_produk_kosme', 'desc');
		return $this->db->get('produk_kosme');
	}

	public function get_kosmeproduk_by_id($id){
		$this->db->select('produk_kosme.*, kategori_produk_kosme.nama_kategori_produk_kosme');
		$this->db->join('kategori_produk_kosme', 'kategori_produk_kosme.id_kategori_produk_kosme = produk_kosme.id_kategori_produk_kosme', 'inner');
		$this->db->where('id_produk_kosme', $id);
		return $this->db->get('produk_kosme');
	}

	public function insert_kosmeproduk($data){
		return $this->db->insert('produk_kosme', $data);
	}

	public function update_kosmeproduk($id,$data){
		$this->db->where('id_produk_kosme', $id);
		return $this->db->update('produk_kosme', $data);
	}

	public function delete_kosmeproduk($id){
		$this->db->where('id_produk_kosme', $id);
		return $this->db->delete('produk_kosme');
	}	
}

/* End of file KosmeprodukModel.php */
/* Location: ./application/models/KosmeprodukModel.php */