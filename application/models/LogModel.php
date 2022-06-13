<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class LogModel extends CI_Model {

    public function save_log_produk($data){
        return $this->db->insert('log_bahan', $data);
    }

    public function get_log_produk($request){
        $this->db->select('produk.id_produk, nama_produk , log_bahan.*');
        $this->db->join('produk', 'produk.id_produk = log_bahan.id_produk', 'inner');
        $this->db->where('produk.kategori_produk', $request);
        $this->db->order_by('log_bahan.tanggal_log', 'asc');
        return $this->db->get('log_bahan');
    }

    public function get_log_produk_id($id){
        $this->db->select('produk.id_produk, nama_produk , log_bahan.*');
        $this->db->join('produk', 'produk.id_produk = log_bahan.id_produk', 'inner');
        $this->db->where('produk.id_produk', $id);
        $this->db->order_by('log_bahan.id_log_bahan', 'desc');
        return $this->db->get('log_bahan');
    }

    // public function get_log_produk_range($start, $end, $request){
    //     $this->db->select('produk.id_produk, nama_produk , log_bahan.*');
    //     $this->db->join('produk', 'produk.id_produk = log_bahan.id_produk', 'inner');
    //     $this->db->where('produk.kategori_produk', $request);
    //     $this->db->where('log_bahan.tanggal_log >=', $start);
    //     $this->db->where('log_bahan.tanggal_log <=', $end);
    //     $this->db->order_by('log_bahan.tanggal_log', 'asc');
    //     return $this->db->get('log_bahan');
    // }

    public function get_log_produk_range($start, $end, $id){
        $this->db->select('produk.id_produk, nama_produk , log_bahan.*');
        $this->db->join('produk', 'produk.id_produk = log_bahan.id_produk', 'inner');
        $this->db->where('log_bahan.id_produk', $id);
        $this->db->where('log_bahan.tanggal_log >=', $start);
        $this->db->where('log_bahan.tanggal_log <=', $end);
        $this->db->order_by('log_bahan.id_log_bahan', 'desc');
        return $this->db->get('log_bahan');
    }

    public function get_sum_log($start, $end, $id){
        $this->db->select("SUM(in_log) AS masuk, SUM(out_log) AS keluar");
        $this->db->where('log_bahan.id_produk', $id);
        $this->db->where('log_bahan.tanggal_log >=', $start);
        $this->db->where('log_bahan.tanggal_log <=', $end);
        $this->db->order_by('log_bahan.tanggal_log', 'asc');
        return $this->db->get('log_bahan');
    }

    // log produk msglow

    public function save_log_msglow($data){
        return $this->db->insert('log_msglow', $data);
    }

    public function get_log_msglow($id){
        $this->db->select('produk_msglow.*,log_msglow.*');
        $this->db->join('produk_msglow', 'produk_msglow.id_produk_msglow = log_msglow.id_produk_msglow', 'inner');
        $this->db->where('log_msglow.id_produk_msglow', $id);
        $this->db->order_by('log_msglow.tanggal_log_msglow', 'desc');
        $this->db->order_by('log_msglow.id_log_msglow', 'desc');
        return $this->db->get('log_msglow');
    }

    public function get_log_msglow_range($start, $end, $id){
        $this->db->select('produk_msglow.* , log_msglow.*');
        $this->db->join('produk_msglow', 'produk_msglow.id_produk_msglow = log_msglow.id_produk_msglow', 'inner');
        $this->db->where('log_msglow.id_produk_msglow', $id);
        $this->db->where('log_msglow.tanggal_log_msglow >=', $start);
        $this->db->where('log_msglow.tanggal_log_msglow <=', $end);
        $this->db->order_by('log_msglow.tanggal_log_msglow', 'asc');
        return $this->db->get('log_msglow');
    }

    public function get_sum_log_msglow($start, $end, $id){
        $this->db->select("SUM(in_log_msglow) AS masuk, SUM(out_log_msglow) AS keluar");
        $this->db->where('log_msglow.id_produk_msglow', $id);
        $this->db->where('log_msglow.tanggal_log_msglow >=', $start);
        $this->db->where('log_msglow.tanggal_log_msglow <=', $end);
        $this->db->order_by('log_msglow.tanggal_log_msglow', 'asc');
        return $this->db->get('log_msglow');
    }

}

/* End of file LogModel.php */
