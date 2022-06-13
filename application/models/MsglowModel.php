<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class MsglowModel extends CI_Model {

    private $tableName = "produk_msglow";

    public function get_msglow(){
        return $this->db->get($this->tableName);
    }

    public function get_msglow_bom($id){
        $this->db->where('id_produk_msglow', $id);
        return $this->db->get('bom_produk_jadi');
    }

    public function get_msglow_bom_id($id){
        $this->db->select('produk_msglow.nama_produk_msglow,volume_produk_msglow,bom_produk_jadi.*');
        $this->db->join('produk_msglow', 'produk_msglow.id_produk_msglow = bom_produk_jadi.id_produk_msglow', 'inner');
        $this->db->where('bom_produk_jadi.id_bom_produk_jadi', $id);
        return $this->db->get('bom_produk_jadi');
    }

    public function get_detail_bom_msglow($id){
        $this->db->select('produk.nama_produk,kode_produk,stok,detail_bom_produk.*');
        $this->db->join('produk', 'produk.id_produk = detail_bom_produk.id_produk', 'inner');
        $this->db->where('detail_bom_produk.id_bom_produk_jadi', $id);
        $this->db->order_by('produk.id_produk', 'asc');
        return $this->db->get('detail_bom_produk');
    }

    public function save_msglow($data){
        return $this->db->insert($this->tableName, $data);
    }

    public function save_bom_msglow($data){
        $this->db->insert('bom_produk_jadi', $data);
        return $this->db->insert_id();
    }

    public function save_detail_bom_msglow($data){
        return $this->db->insert('detail_bom_produk', $data);
    }

    public function update_msglow($id, $data){
        $this->db->where('id_produk_msglow', $id);
        return $this->db->update($this->tableName, $data);
    }

    public function get_msglow_id($id){
        $this->db->where('id_produk_msglow', $id);
        return $this->db->get($this->tableName);
    }

    public function delete_msglow($id){
        $this->db->where('id_produk_msglow', $id);
        return $this->db->delete($this->tableName);
    }

    public function delete_bom_msglow($id){
        $this->db->where('id_bom_produk_jadi', $id);
        return $this->db->delete('bom_produk_jadi');
    }

}

/* End of file MsglowModel.php */
