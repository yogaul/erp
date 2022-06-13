<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class KalkulatorModel extends CI_Model {

	private $tableName = 'mps_kalkulator';
    
    public function get_kalkulator(){
        $this->db->select('mps_kalkulator.*, bom_produk_jadi.*, produk_msglow.id_produk_msglow,nama_produk_msglow');
        $this->db->join('bom_produk_jadi', 'bom_produk_jadi.id_bom_produk_jadi = mps_kalkulator.id_bom_produk_jadi', 'inner');
        $this->db->join('produk_msglow', 'produk_msglow.id_produk_msglow = bom_produk_jadi.id_produk_msglow', 'inner');
        $this->db->order_by('mps_kalkulator.tanggal_mps_kalkulator', 'desc');
        return $this->db->get($this->tableName);
    }

    public function get_kalkulator_id($id){
        $this->db->select('mps_kalkulator.*, bom_produk_jadi.*, produk_msglow.id_produk_msglow,nama_produk_msglow,volume_produk_msglow');
        $this->db->join('bom_produk_jadi', 'bom_produk_jadi.id_bom_produk_jadi = mps_kalkulator.id_bom_produk_jadi', 'inner');
        $this->db->join('produk_msglow', 'produk_msglow.id_produk_msglow = bom_produk_jadi.id_produk_msglow', 'inner');
        $this->db->where('mps_kalkulator.id_mps_kalkulator', $id);
        return $this->db->get($this->tableName);
    }

    public function get_detail_mps_id($id){
        $this->db->select('bom_produk_jadi.kode_formula_produk, detail_mps_kalkulator.*,produk.nama_produk,kode_produk');
        $this->db->join('mps_kalkulator', 'mps_kalkulator.id_mps_kalkulator = detail_mps_kalkulator.id_mps_kalkulator', 'inner');
        $this->db->join('bom_produk_jadi', 'bom_produk_jadi.id_bom_produk_jadi = mps_kalkulator.id_bom_produk_jadi', 'inner');
        $this->db->join('produk', 'produk.id_produk = detail_mps_kalkulator.id_produk', 'inner');
        $this->db->where('detail_mps_kalkulator.id_mps_kalkulator', $id);    
        $this->db->order_by('produk.id_produk', 'asc');
        return $this->db->get('detail_mps_kalkulator');
    }

    public function save_kalkulator($data){ 
        $this->db->insert($this->tableName, $data);
        return $this->db->insert_id();
    }

    public function save_detail_kalkulator($data){ 
        return $this->db->insert('detail_mps_kalkulator', $data);
    }

    public function update_kalkulator($id, $data){ 
        $this->db->where('id_mps_kalkulator', $id);
        return $this->db->update($this->tableName, $data);
    }

    public function delete_kalkulator($id){ 
        $this->db->where('id_mps_kalkulator', $id);
        return $this->db->delete($this->tableName);
    }
}

/* End of file KalkulatorModel.php */
