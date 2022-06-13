<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class SertemModel extends CI_Model {

    public function get_sertem_glow(){
        $this->db->select('barang_masuk.*, detail_barang_masuk_msglow.id_detail_barang_masuk_msglow');
        $this->db->join('detail_barang_masuk_msglow', 'barang_masuk.id_barang_masuk = detail_barang_masuk_msglow.id_barang_masuk', 'left');
        $this->db->group_by('barang_masuk.id_barang_masuk');
        return $this->db->get('barang_masuk');
    }

    public function get_sertem_id($id){
        $this->db->where('id_barang_masuk', $id);
        return $this->db->get('barang_masuk');
    }

    public function get_sertem_oem(){
        return $this->db->get('barang_masuk');
    }

    public function get_final_sum($id){
		$this->db->select('SUM(subtotal_qty_masuk_msglow) AS total_subtotal');
		$this->db->where('id_detail_barang_masuk_msglow', $id);
		return $this->db->get('detail_barang_masuk_msglow');
	}

    public function get_sum_qty($id){
		$this->db->select('SUM(qty_masuk_msglow) AS total_qty_masuk');
		$this->db->where('id_barang_masuk', $id);
		// $this->db->where('id_produk_msglow', $id_produk);
		// $this->db->group_by('id_produk_msglow');
		return $this->db->get('detail_barang_masuk_msglow');
	}

    public function get_sum_subtotal_glow($id_sertem, $id_produk){
		$this->db->select('SUM(subtotal_qty_masuk_msglow) AS total_subtotal_masuk');
		$this->db->where('id_barang_masuk', $id_sertem);
		$this->db->where('id_produk_msglow', $id_produk);
		$this->db->group_by('id_produk_msglow');
		return $this->db->get('detail_barang_masuk_msglow');
	}

    public function get_detail_sertem_glow($id){
        $this->db->select('produk_msglow.*,detail_barang_masuk_msglow.*');
        $this->db->join('produk_msglow', 'produk_msglow.id_produk_msglow = detail_barang_masuk_msglow.id_produk_msglow', 'inner');
		$this->db->where('id_barang_masuk', $id);
        $this->db->order_by('produk_msglow.id_produk_msglow', 'asc');
		return $this->db->get('detail_barang_masuk_msglow');
    }

    public function get_detail_group_glow($id){
        $this->db->select('produk_msglow.*,detail_barang_masuk_msglow.*,SUM(subtotal_qty_masuk_msglow) AS total_subtotal_masuk');
        $this->db->join('produk_msglow', 'produk_msglow.id_produk_msglow = detail_barang_masuk_msglow.id_produk_msglow', 'inner');
		$this->db->where('id_barang_masuk', $id);
        // $this->db->order_by('produk_msglow.id_produk_msglow', 'asc');
        $this->db->group_by('detail_barang_masuk_msglow.id_produk_msglow');
		return $this->db->get('detail_barang_masuk_msglow');
    }

    public function get_detail_batch_glow($id){
        $this->db->where('id_detail_barang_masuk_msglow', $id);
		return $this->db->get('detail_batch_masuk_msglow');
    }

    public function save_sertem($data){
        $this->db->insert('barang_masuk', $data);
        return $this->db->insert_id();
    }

    public function save_detail_sertem($data){
        $this->db->insert('detail_barang_masuk_msglow', $data);
        return $this->db->insert_id();
    }

    public function save_batch_sertem($data){
        return $this->db->insert('detail_batch_masuk_msglow', $data);
    }

    public function delete_sertem($id){
        $this->db->where('id_barang_masuk', $id);
        return $this->db->delete('barang_masuk');
    }

}

/* End of file SertemModel.php */
