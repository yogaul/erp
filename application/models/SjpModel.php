<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SjpModel extends CI_Model {

	public function get_sjp($id){
		$this->db->where('id_spp', $id);
		return $this->db->get('sjp');
	}

	public function get_all_sjp(){
		return $this->db->get('sjp');
	}

	public function get_sjp_by_id($id){
		$this->db->where('id_sjp', $id);
		return $this->db->get('sjp');
	}

	public function get_detail_sjp($id){
		$this->db->select('sample_acc.id_sample_acc,nama_produk_acc,detail_sjp.*');
		$this->db->join('sample_acc', 'sample_acc.id_sample_acc = detail_sjp.id_sample_acc', 'inner');
		$this->db->where('id_sjp', $id);
		$this->db->order_by('detail_sjp.id_sample_acc', 'asc');
		return $this->db->get('detail_sjp');
	}

	public function get_detail_sjp_glow($id){
		$this->db->select('produk_msglow.id_produk_msglow,nama_produk_msglow,kode_produk_msglow,detail_sjp_glow.*');
		$this->db->join('produk_msglow', 'produk_msglow.id_produk_msglow = detail_sjp_glow.id_produk_msglow', 'inner');
		$this->db->where('id_sjp', $id);
		$this->db->order_by('detail_sjp_glow.id_produk_msglow', 'asc');
		return $this->db->get('detail_sjp_glow');
	}

	public function get_detail_group_glow($id){
        $this->db->select('produk_msglow.*,detail_sjp_glow.*,SUM(subtotal_produk_glow) AS total_subtotal_keluar');
        $this->db->join('produk_msglow', 'produk_msglow.id_produk_msglow = detail_sjp_glow.id_produk_msglow', 'inner');
		$this->db->where('id_sjp', $id);
        // $this->db->order_by('produk_msglow.id_produk_msglow', 'asc');
        $this->db->group_by('detail_sjp_glow.id_produk_msglow');
		return $this->db->get('detail_sjp_glow');
    }

	public function get_detail_batch($id){
		$this->db->where('id_detail_sjp', $id);
		return $this->db->get('detail_batch_sjp');
	}

	public function get_detail_batch_glow($id){
		$this->db->where('id_detail_sjp_glow', $id);
		return $this->db->get('detail_batch_msglow');
	}

	public function get_total_qty($id_sjp,$id_produk){
		$this->db->select('SUM(subtotal_qty_sjp) AS subtotal');
		$this->db->where('id_sample_acc', $id_produk);
		$this->db->where('id_sjp', $id_sjp);
		return $this->db->get('detail_sjp');
	}

	public function get_total_karton($id_sjp,$id_produk){
		$this->db->select('SUM(qty_produk_sjp) AS jumlah');
		$this->db->where('id_sample_acc', $id_produk);
		$this->db->where('id_sjp', $id_sjp);
		return $this->db->get('detail_sjp');
	}

	public function save_sjp($data){
		return $this->db->insert('sjp', $data);
	}

	public function save_detail_sjp($data){
		$this->db->insert('detail_sjp', $data);
		return $this->db->insert_id();
	}

	public function save_detail_sjp_glow($data){
		$this->db->insert('detail_sjp_glow', $data);
		return $this->db->insert_id();
	}

	public function save_detail_batch($data){
		return $this->db->insert('detail_batch_sjp', $data);
	}

	public function save_detail_batch_glow($data){
		return $this->db->insert('detail_batch_msglow', $data);
	}

	public function delete_sjp($id){
		$this->db->where('id_sjp', $id);
		return $this->db->delete('sjp');
	}

	public function delete_detail_sjp($id){
		$this->db->where('id_detail_sjp', $id);
		return $this->db->delete('detail_sjp');
	}

	public function get_sjp_glow(){
		$this->db->where('id_spp', NULL);
		return $this->db->get('sjp');
	}

	public function get_final_sum($id){
		$this->db->select('SUM(subtotal_produk_glow) AS total_subtotal, SUM(qty_produk_glow) AS total_qty');
		$this->db->where('id_sjp', $id);
		return $this->db->get('detail_sjp_glow');
	}

	public function get_sum_qty($id_sjp){
		$this->db->select('SUM(qty_produk_glow) AS total_qty_karton');
		$this->db->where('id_sjp', $id_sjp);
		return $this->db->get('detail_sjp_glow');
	}

	public function get_sum_subtotal_glow($id_sjp, $id_produk){
		$this->db->select('SUM(subtotal_produk_glow) AS total_subtotal_sjp');
		$this->db->where('id_sjp', $id_sjp);
		$this->db->where('id_produk_msglow', $id_produk);
		return $this->db->get('detail_sjp_glow');
	}

	public function update_sjp($id, $data){
		$this->db->where('id_sjp', $id);
		return $this->db->update('sjp', $data);
	}

	public function get_sjp_api($start, $end){
		return $this->db->query("select * from sjp where tanggal_sjp between '$start' and '$end' and metode = 'Scan'");
	}

	public function get_sjp_gcp($data){
		$mgcp = $this->load->database('gcp', TRUE); 
		return $mgcp->query("SELECT
								a.Serialisasi,
								COUNT(DISTINCT b.Serialisasi) AS box, 
								COUNT(DISTINCT d.Serialisasi) AS bottle
								FROM data_print AS a
								INNER JOIN data_print AS b ON b.Parent_ID = a.Data_Print_ID AND b.station_name = a.station_name
								INNER JOIN data_print AS c ON c.Parent_ID = b.Data_Print_ID AND c.station_name = b.station_name
								INNER JOIN data_print AS d ON d.Parent_ID = c.Data_Print_ID AND d.station_name = c.station_name
								WHERE a.serialisasi = '$data'
								AND b.Serial_Level = 3
								AND c.Serial_Level = 2
								AND d.Serial_Level = 1
								AND a.Scanned IS NOT NULL
								AND b.Scanned IS NOT NULL
								AND c.Scanned IS NOT NULL
								AND d.Scanned IS NOT NULL");
	}

	public function get_barcode_failed(){
		$this->db->where('status_simpan', '0');
		return $this->db->get('temp_qr_sjp');
	}

	public function get_sjp_refresh(){
		return $this->db->query("SELECT sjp.id_sjp, temp_qr_sjp.status_simpan from sjp 
								inner join temp_qr_sjp on sjp.id_sjp = temp_qr_sjp.id_sjp
								where sjp.id_spp IS NULL and temp_qr_sjp.status_simpan = '0'
								group by sjp.id_sjp");
	}

}

/* End of file SjpModel.php */
/* Location: ./application/models/SjpModel.php */