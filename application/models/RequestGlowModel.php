<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class RequestGlowModel extends CI_Model {

    private $tableName = "msglow_request";

    public function get_request_kosme(){
        return $this->db->query("SELECT msglow_request.*, 
                            YEAR(tanggal_request) AS tahun_request, MONTH(tanggal_request) AS bulan_request, DAY(tanggal_request) AS hari_request,
                            YEAR(target_launching) AS tahun_launching, MONTH(target_launching) AS bulan_launching, DAY(target_launching) AS hari_launching
                            FROM msglow_request");
    }

    public function get_request_msglow(){
        return $this->db->query("SELECT msglow_request.*, 
                            YEAR(tanggal_request) AS tahun_request, MONTH(tanggal_request) AS bulan_request, DAY(tanggal_request) AS hari_request,
                            YEAR(target_launching) AS tahun_launching, MONTH(target_launching) AS bulan_launching, DAY(target_launching) AS hari_launching
                            FROM msglow_request WHERE kategori_request = 'MS Glow'");
    }

    public function get_request_msglow_status($status){
        $this->db->where('status_request_msglow', $status);
        return $this->db->get($this->tableName);
    }

    public function get_request_rnd(){
        $this->db->where('acc_kci', 'Sudah');
        $this->db->where('acc_kgi', 'Sudah');
        return $this->db->get($this->tableName);
    }

    public function save_request_msglow($data){
        $this->db->insert($this->tableName, $data);
        return $this->db->insert_id();
    }

    public function update_request_msglow($id, $data){
        $this->db->where('id_msglow_request', $id);
        return $this->db->update($this->tableName, $data);
    }

    public function update_all_acc_kci($status, $data){
        $this->db->where('acc_kci', $status);
        return $this->db->update($this->tableName, $data);
    }

    public function update_all_acc_kgi($status, $data){
        $this->db->where('acc_kgi', $status);
        return $this->db->update($this->tableName, $data);
    }

    public function get_request_msglow_id($id){
        return $this->db->query("SELECT msglow_request.*, 
                                YEAR(tanggal_request) AS tahun_request, MONTH(tanggal_request) AS bulan_request, DAY(tanggal_request) AS hari_request,
                                YEAR(target_launching) AS tahun_launching, MONTH(target_launching) AS bulan_launching, DAY(target_launching) AS hari_launching,
                                YEAR(start_formula) AS tahun_start_formula, MONTH(start_formula) AS bulan_start_formula, DAY(start_formula) AS hari_start_formula,
                                YEAR(end_formula) AS tahun_end_formula, MONTH(end_formula) AS bulan_end_formula, DAY(end_formula) AS hari_end_formula,
                                YEAR(start_panelis) AS tahun_start_panelis, MONTH(start_panelis) AS bulan_start_panelis, DAY(start_panelis) AS hari_start_panelis,
                                YEAR(end_panelis) AS tahun_end_panelis, MONTH(end_panelis) AS bulan_end_panelis, DAY(end_panelis) AS hari_end_panelis,
                                YEAR(start_scale) AS tahun_start_scale, MONTH(start_scale) AS bulan_start_scale, DAY(start_scale) AS hari_start_scale,
                                YEAR(end_scale) AS tahun_end_scale, MONTH(end_scale) AS bulan_end_scale, DAY(end_scale) AS hari_end_scale,
                                YEAR(start_kemasan) AS tahun_start_kemasan, MONTH(start_kemasan) AS bulan_start_kemasan, DAY(start_kemasan) AS hari_start_kemasan,
                                YEAR(end_kemasan) AS tahun_end_kemasan, MONTH(end_kemasan) AS bulan_end_kemasan, DAY(end_kemasan) AS hari_end_kemasan,
                                YEAR(start_bpom) AS tahun_start_bpom, MONTH(start_bpom) AS bulan_start_bpom, DAY(start_bpom) AS hari_start_bpom,
                                YEAR(end_bpom) AS tahun_end_bpom, MONTH(end_bpom) AS bulan_end_bpom, DAY(end_bpom) AS hari_end_bpom,
                                YEAR(start_mps) AS tahun_start_mps, MONTH(start_mps) AS bulan_start_mps, DAY(start_mps) AS hari_start_mps,
                                YEAR(end_mps) AS tahun_end_mps, MONTH(end_mps) AS bulan_end_mps, DAY(end_mps) AS hari_end_mps,
                                YEAR(start_po) AS tahun_start_po, MONTH(start_po) AS bulan_start_po, DAY(start_po) AS hari_start_po,
                                YEAR(end_po) AS tahun_end_po, MONTH(end_po) AS bulan_end_po, DAY(end_po) AS hari_end_po,
                                YEAR(start_inbound) AS tahun_start_inbound, MONTH(start_inbound) AS bulan_start_inbound, DAY(start_inbound) AS hari_start_inbound,
                                YEAR(end_inbound) AS tahun_end_inbound, MONTH(end_inbound) AS bulan_end_inbound, DAY(end_inbound) AS hari_end_inbound,
                                YEAR(start_produksi) AS tahun_start_produksi, MONTH(start_produksi) AS bulan_start_produksi, DAY(start_produksi) AS hari_start_produksi,
                                YEAR(end_produksi) AS tahun_end_produksi, MONTH(end_produksi) AS bulan_end_produksi, DAY(end_produksi) AS hari_end_produksi,
                                YEAR(start_wh) AS tahun_start_wh, MONTH(start_wh) AS bulan_start_wh, DAY(start_wh) AS hari_start_wh,
                                YEAR(end_wh) AS tahun_end_wh, MONTH(end_wh) AS bulan_end_wh, DAY(end_wh) AS hari_end_wh
                                FROM msglow_request 
                                WHERE id_msglow_request = '$id'");
    }

    public function get_request_kci($status){
        $this->db->where('acc_kci', $status);
        $this->db->where('kategori_request', 'MS Glow');
        return $this->db->get($this->tableName);
    }

    public function get_request_kgi($status){
        $this->db->where('acc_kgi', $status);
        return $this->db->get($this->tableName);
    }

    public function delete_request_msglow($id){
        $this->db->where('id_msglow_request', $id);
        return $this->db->delete($this->tableName);
    }

    public function get_formula($id){
        return $this->db->query("SELECT formula_request_msglow.*, 
                                YEAR(tanggal_formula_msglow) AS tahun_start_formula, MONTH(tanggal_formula_msglow) AS bulan_start_formula, 
                                DAY(tanggal_formula_msglow) AS hari_start_formula
                                FROM formula_request_msglow WHERE id_msglow_request = '$id'");
    }

    public function get_formula_id($id){
        $this->db->where('id_formula_msglow', $id);
        return $this->db->get('formula_request_msglow');
    }

    public function get_detail_formula($id){
        $this->db->select('produk.kode_produk,nama_produk,stok, detail_formula_request.*');
        $this->db->join('produk', 'produk.id_produk = detail_formula_request.id_produk', 'inner');
        $this->db->where('detail_formula_request.id_formula_msglow', $id);
        return $this->db->get('detail_formula_request');
    }

    public function save_formula($data){
        $this->db->insert('formula_request_msglow', $data);
        return $this->db->insert_id();
    }

    public function save_detail_formula($data){
        return $this->db->insert('detail_formula_request', $data);
    }

    public function update_formula($id, $data){
        $this->db->where('id_formula_msglow', $id);
        return $this->db->update('formula_request_msglow', $data);
    }

    public function get_panelis($id){
        $this->db->where('id_formula_msglow', $id);
        return $this->db->get('panelis_formula_msglow');
    }

    public function save_panelis($data){
        return $this->db->insert('panelis_formula_msglow', $data);
    }

    public function get_scale($id){
        $this->db->where('id_formula_msglow', $id);
        return $this->db->get('scale_formula_msglow');
    }

    public function save_scale($data){
        return $this->db->insert('scale_formula_msglow', $data);
    }

    public function get_review($id){
        $this->db->where('id_formula_msglow', $id);
        return $this->db->get('feedback_formula_msglow');
    }

    public function save_review($data){
        return $this->db->insert('feedback_formula_msglow', $data);
    }

    public function get_sample($id){
        $this->db->where('id_formula_msglow', $id);
        return $this->db->get('sample_formula_msglow');
    }

    public function get_sample_id($id){
        $this->db->where('id_sample_msglow', $id);
        return $this->db->get('sample_formula_msglow');
    }

    public function update_sample($id, $data){
        $this->db->where('id_sample_msglow', $id);
        return $this->db->update('sample_formula_msglow',$data);
    }

    public function save_sample($data){
        return $this->db->insert('sample_formula_msglow', $data);
    }

    public function save_log($data){
        return $this->db->insert('log_request_msglow', $data);
    }

    public function get_log_request($id){
        $this->db->where('id_msglow_request', $id);
        $this->db->order_by('id_log_request_msglow', 'desc');
        return $this->db->get('log_request_msglow');
    }

    public function save_bpom($data){
        $this->db->insert('bpom_request_msglow', $data);
        return $this->db->insert_id();
    }

    public function get_bpom_id($id){
        $this->db->where('id_bpom_msglow', $id);
        return $this->db->get('bpom_request_msglow');
    }

    public function update_bpom($id, $data){
        $this->db->where('id_bpom_msglow', $id);
        return $this->db->update('bpom_request_msglow',$data);
    }

    public function save_log_bpom($data){
        return $this->db->insert('log_bpom_msglow', $data);
    }

    public function get_log_bpom($id){
        $this->db->where('id_bpom_msglow', $id);
        return $this->db->get('log_bpom_msglow');
    }

    public function get_bpom_request($id){
        return $this->db->query("SELECT bpom_request_msglow.*, 
                                YEAR(tanggal_bpom_msglow) AS tahun_start_bpom, MONTH(tanggal_bpom_msglow) AS bulan_start_bpom, 
                                DAY(tanggal_bpom_msglow) AS hari_start_bpom
                                FROM bpom_request_msglow WHERE id_msglow_request = '$id'");
    }

    public function save_log_deadline($data){
        return $this->db->insert('log_deadline_msglow', $data);
    }

    public function get_log_deadline($id){
        $this->db->where('id_msglow_request', $id);
        return $this->db->get('log_deadline_msglow');
    }

    public function get_pr_request($id){
        $this->db->where('id_msglow_request', $id);
        return $this->db->get('pr_msglow_request');
    }

    public function save_pr_request($data){
        return $this->db->insert('pr_msglow_request', $data);
    }

    public function get_po_request($id){
        return $this->db->query("SELECT po_msglow_request.*, 
                                YEAR(tanggal_po_msglow) AS tahun_start_po, MONTH(tanggal_po_msglow) AS bulan_start_po, 
                                DAY(tanggal_po_msglow) AS hari_start_po
                                FROM po_msglow_request WHERE id_msglow_request = '$id'");
    }

    public function save_po_request($data){
        return $this->db->insert('po_msglow_request', $data);
    }

    public function get_mps_request($id){
        return $this->db->query("SELECT mps_msglow_request.*, formula_request_msglow.kode_formula_msglow, msglow_request.id_msglow_request,usulan_nama_produk,
                                YEAR(mps_msglow_request.tanggal_mps_msglow) AS tahun_start_mps, MONTH(mps_msglow_request.tanggal_mps_msglow) AS bulan_start_mps, 
                                DAY(mps_msglow_request.tanggal_mps_msglow) AS hari_start_mps
                                FROM mps_msglow_request
                                INNER JOIN formula_request_msglow ON formula_request_msglow.id_formula_msglow = mps_msglow_request.id_formula_msglow
                                INNER JOIN msglow_request ON msglow_request.id_msglow_request = formula_request_msglow.id_msglow_request
                                WHERE msglow_request.id_msglow_request = '$id'");
    }

    public function get_mps_request_id($id){
        $this->db->select('mps_msglow_request.*, formula_request_msglow.kode_formula_msglow, msglow_request.usulan_nama_produk,spesifikasi_volume');
        $this->db->join('formula_request_msglow', 'formula_request_msglow.id_formula_msglow = mps_msglow_request.id_formula_msglow', 'inner');
        $this->db->join('msglow_request', 'msglow_request.id_msglow_request = formula_request_msglow.id_msglow_request', 'inner');
        $this->db->where('mps_msglow_request.id_mps_msglow', $id);
        return $this->db->get("mps_msglow_request");
    }

    public function get_detail_mps_id($id){
        $this->db->where('id_mps_msglow', $id);
        return $this->db->get("detail_mps_request");
    }

    public function save_mps_request($data){
        $this->db->insert('mps_msglow_request', $data);
        return $this->db->insert_id();
    }

    public function save_detail_mps($data){
        return $this->db->insert('detail_mps_request', $data);
    }

    public function get_kedatangan_request($id){
        return $this->db->query("SELECT kedatangan_msglow_request.*, 
                                YEAR(tanggal_kedatangan_msglow) AS tahun_start_kedatangan, MONTH(tanggal_kedatangan_msglow) AS bulan_start_kedatangan, 
                                DAY(tanggal_kedatangan_msglow) AS hari_start_kedatangan
                                FROM kedatangan_msglow_request WHERE id_msglow_request = '$id'");
    }

    public function save_kedatangan_request($data){
        return $this->db->insert('kedatangan_msglow_request', $data);
    }

    public function get_batch_request($id){
        $this->db->where('id_msglow_request', $id);
        return $this->db->get('batch_msglow_request');
    }

    public function save_batch_request($data){
        return $this->db->insert('batch_msglow_request', $data);
    }

    public function get_produksi_request($id){
        return $this->db->query("SELECT produksi_msglow_request.*, 
                                YEAR(tanggal_produksi_msglow) AS tahun_start_produksi, MONTH(tanggal_produksi_msglow) AS bulan_start_produksi, 
                                DAY(tanggal_produksi_msglow) AS hari_start_produksi
                                FROM produksi_msglow_request WHERE id_msglow_request = '$id'");
    }

    public function save_produksi_request($data){
        return $this->db->insert('produksi_msglow_request', $data);
    }

    public function get_pengiriman_request($id){
        return $this->db->query("SELECT pengiriman_msglow_request.*, 
                                YEAR(tanggal_pengiriman_msglow) AS tahun_start_pengiriman, MONTH(tanggal_pengiriman_msglow) AS bulan_start_pengiriman, 
                                DAY(tanggal_pengiriman_msglow) AS hari_start_pengiriman
                                FROM pengiriman_msglow_request WHERE id_msglow_request = '$id'");
    }

    public function save_pengiriman_request($data){
        return $this->db->insert('pengiriman_msglow_request', $data);
    }

    public function get_kemasan_request($id){
        return $this->db->query("SELECT * FROM kemasan_msglow_request WHERE id_msglow_request = '$id'");
    }

    public function save_kemasan_request($data){
        return $this->db->insert('kemasan_msglow_request', $data);
    }  
    
    public function update_kemasan_request($id, $data){
        $this->db->where('id_kemasan_msglow', $id);
        return $this->db->update('kemasan_msglow_request', $data);
    }   

    public function get_kemasan_request_id($id){
        $this->db->where('id_kemasan_msglow', $id);
        return $this->db->get('kemasan_msglow_request');
    }   

    public function get_lain_request($id){
        $this->db->where('id_msglow_request', $id);
        return $this->db->get('other_msglow_request');
    }

    public function save_other_request($data){
        return $this->db->insert('other_msglow_request', $data);
    }

}

/* End of file RequestGlowModel.php */
