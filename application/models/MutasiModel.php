<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MutasiModel extends CI_Model {

	public function get_mutasi($request){
		$this->db->join('detail_mutasi', 'mutasi.id_mutasi = detail_mutasi.id_mutasi', 'inner');
		$this->db->join('produk', 'produk.id_produk = detail_mutasi.id_produk', 'inner');
		$this->db->where('produk.kategori_produk', $request);
		$this->db->group_by('mutasi.id_mutasi');
		return $this->db->get('mutasi');
	}

	public function get_mutasi_lain(){
		return $this->db->get('mutasi_lain');
	}

	public function get_mutasi_lain_range($start,$end){
		$this->db->where('tanggal_mutasi_lain >=', $start);
		$this->db->where('tanggal_mutasi_lain <=', $end);
		return $this->db->get('mutasi_lain');
	}

	public function get_mutasi_penjualan_range($start,$end){
		$this->db->select('mutasi_penjualan.*,tujuan_pengiriman.*');
		$this->db->join('tujuan_pengiriman', 'tujuan_pengiriman.id_tujuan_pengiriman = mutasi_penjualan.id_tujuan_pengiriman', 'inner');
		$this->db->where('mutasi_penjualan.tanggal_mutasi_penjualan >=', $start);
		$this->db->where('mutasi_penjualan.tanggal_mutasi_penjualan <=', $end);
		return $this->db->get('mutasi_penjualan');
	}

	public function get_mutasi_id($id){
		$this->db->where('id_mutasi', $id);
		return $this->db->get('mutasi');
	}

	public function get_mutasi_lain_id($id){
		$this->db->where('id_mutasi_lain', $id);
		return $this->db->get('mutasi_lain');
	}

	public function get_batch_by_id($id){
		$this->db->where('id_mutasi', $id);
		return $this->db->get('batch_mutasi');
	}

	public function get_mutasi_bahan_status($bahan,$status){
		$this->db->join('detail_mutasi', 'mutasi.id_mutasi = detail_mutasi.id_mutasi', 'inner');
		$this->db->join('produk', 'produk.id_produk = detail_mutasi.id_produk', 'inner');
		$this->db->where('produk.kategori_produk', $bahan);
		$this->db->where('mutasi.status_mutasi', $status);
		$this->db->group_by('mutasi.id_mutasi');
		return $this->db->get('mutasi');
	}

	public function save($tableName,$data){
		$this->db->insert($tableName, $data);
		return $this->db->insert_id();
	}	

	public function delete_mutasi($id){
		$this->db->where('id_mutasi', $id);
		return $this->db->delete('mutasi');
	}

	public function delete_mutasi_lain($id){
		$this->db->where('id_mutasi_lain', $id);
		return $this->db->delete('mutasi_lain');
	}

	public function delete_batch($id){
		$this->db->where('id_mutasi', $id);
		return $this->db->delete('batch_mutasi');
	}

	public function delete_detail($id){
		$this->db->where('id_mutasi', $id);
		return $this->db->delete('detail_mutasi');
	}

	public function delete_detail_lain($id){
		$this->db->where('id_mutasi_lain', $id);
		return $this->db->delete('detail_mutasi_lain');
	}

	public function update($id,$data,$tableName){
		if ($tableName == 'mutasi') {
			$this->db->where('id_mutasi', $id);
		}elseif ($tableName == 'batch_mutasi') {
			$this->db->where('id_batch_mutasi', $id);
		}elseif ($tableName == 'detail_mutasi') {
			$this->db->where('id_detail_mutasi', $id);
		}
		return $this->db->update($tableName, $data);
	}

	public function update_mutasi($id,$data){
		$this->db->where('id_mutasi', $id);
		return $this->db->update('mutasi', $data);
	}

	public function update_mutasi_lain($id,$data){
		$this->db->where('id_mutasi_lain', $id);
		return $this->db->update('mutasi_lain', $data);
	}

	public function get_tipe_mutasi($id){
		$this->db->select('kategori_produk');
		$this->db->join('detail_mutasi', 'produk.id_produk = detail_mutasi.id_produk', 'inner');
		$this->db->where('id_mutasi', $id);
		return $this->db->get('produk', 1);
	}

	public function get_batch_mutasi($id){
		$this->db->where('id_mutasi', $id);
		return $this->db->get('batch_mutasi');
	}

	public function get_detail_mutasi($id){
		$this->db->select('produk.id_produk,nama_produk,stok,detail_mutasi.*');
		$this->db->join('detail_mutasi', 'produk.id_produk = detail_mutasi.id_produk', 'inner');
		$this->db->where('id_mutasi', $id);
		return $this->db->get('produk');
	}

	public function get_detail_mutasi_lain($id){
		$this->db->select('produk.id_produk,nama_produk,stok,detail_mutasi_lain.*');
		$this->db->join('detail_mutasi_lain', 'produk.id_produk = detail_mutasi_lain.id_produk', 'inner');
		$this->db->where('id_mutasi_lain', $id);
		return $this->db->get('produk');
	}

	public function get_detail_mutasi_cetak($id){
		$this->db->select('produk.id_produk,nama_produk,kode_produk,kategori_produk,mitra.nama_mitra,detail_mutasi_lain.*,detail_order.id_detail_order,bahan_datang.id_bahan_datang,kode_kedatangan,detail_qr_kedatangan.id_detail_qr_kedatangan');
		$this->db->join('mitra', 'mitra.id_mitra = produk.id_mitra', 'inner');
		$this->db->join('detail_order', 'produk.id_produk = detail_order.id_produk', 'inner');
		$this->db->join('bahan_datang', 'detail_order.id_detail_order = bahan_datang.id_detail_order', 'inner');
		$this->db->join('detail_kedatangan', 'bahan_datang.id_bahan_datang = detail_kedatangan.id_bahan_datang', 'inner');
		$this->db->join('detail_qr_kedatangan', 'detail_kedatangan.id_detail_kedatangan = detail_qr_kedatangan.id_detail_kedatangan', 'inner');
		$this->db->join('detail_mutasi_lain', 'detail_qr_kedatangan.id_detail_qr_kedatangan = detail_mutasi_lain.id_detail_qr_kedatangan', 'inner');
		$this->db->where('detail_mutasi_lain.id_mutasi_lain', $id);
		return $this->db->get('produk');
	}

	public function get_mutasi_by_status($request){
		$this->db->where('status_mutasi', $request);
		return $this->db->get('mutasi');
	}

	public function get_mutasi_lain_status($request){
		$this->db->where('status_mutasi_lain', $request);
		return $this->db->get('mutasi_lain');
	}

	public function get_mutasi_by_kategori($request){
		$this->db->select('mutasi.id_mutasi');
		$this->db->join('detail_mutasi', 'mutasi.id_mutasi = detail_mutasi.id_mutasi', 'inner');
		$this->db->join('produk', 'produk.id_produk = detail_mutasi.id_produk', 'inner');
		$this->db->where('produk.kategori_produk', $request);
		$this->db->group_by('mutasi.id_mutasi');
		return $this->db->get('mutasi');
	}

	public function cek_status_mutasi($id){
		$this->db->select('mutasi.id_mutasi,detail_mutasi.dikembalikan');
		$this->db->join('detail_mutasi', 'mutasi.id_mutasi = detail_mutasi.id_mutasi', 'inner');
		$this->db->where('mutasi.id_mutasi', $id);
		$this->db->where('detail_mutasi.dikembalikan', '');
		return $this->db->get('mutasi');
	}

	public function cek_status_mutasi_lain($id){
		$this->db->select('mutasi_lain.id_mutasi_lain,detail_mutasi_lain.dikembalikan');
		$this->db->join('detail_mutasi_lain', 'mutasi_lain.id_mutasi_lain = detail_mutasi_lain.id_mutasi_lain', 'inner');
		$this->db->where('mutasi_lain.id_mutasi_lain', $id);
		$this->db->where('detail_mutasi_lain.dikembalikan', '');
		return $this->db->get('mutasi_lain');
	}

	public function get_mutasi_ekspor($request){
		$this->db->select('mutasi.*,produk.kode_produk,nama_produk,stok,detail_mutasi.*');
		$this->db->join('mutasi', 'mutasi.id_mutasi = detail_mutasi.id_mutasi', 'inner');
		$this->db->join('produk', 'produk.id_produk = detail_mutasi.id_produk', 'inner');
		$this->db->where('produk.kategori_produk', $request);
		return $this->db->get('detail_mutasi');
	}

	public function get_mutasi_lain_ekspor(){
		$this->db->select('mutasi_lain.*,produk.kode_produk,nama_produk,stok,detail_mutasi_lain.*,detail_qr_kedatangan.id_detail_qr_kedatangan,detail_kedatangan.id_detail_kedatangan,bahan_datang.id_bahan_datang,detail_order.id_detail_order');
		$this->db->join('mutasi_lain', 'mutasi_lain.id_mutasi_lain = detail_mutasi_lain.id_mutasi_lain', 'inner');
		$this->db->join('detail_qr_kedatangan', 'detail_qr_kedatangan.id_detail_qr_kedatangan = detail_mutasi_lain.id_detail_qr_kedatangan', 'inner');
		$this->db->join('detail_kedatangan', 'detail_kedatangan.id_detail_kedatangan = detail_qr_kedatangan.id_detail_kedatangan', 'inner');
		$this->db->join('bahan_datang', 'bahan_datang.id_bahan_datang = detail_kedatangan.id_bahan_datang', 'inner');
		$this->db->join('detail_order', 'detail_order.id_detail_order = bahan_datang.id_detail_order', 'inner');
		$this->db->join('produk', 'produk.id_produk = detail_order.id_produk', 'inner');
		return $this->db->get('detail_mutasi_lain');
	}

	public function get_mutasi_penjualan(){
		$this->db->select('mutasi_penjualan.*,tujuan_pengiriman.*');
		$this->db->join('tujuan_pengiriman', 'tujuan_pengiriman.id_tujuan_pengiriman = mutasi_penjualan.id_tujuan_pengiriman', 'inner');
		$this->db->order_by('mutasi_penjualan.id_mutasi_penjualan', 'desc');
		return $this->db->get('mutasi_penjualan');
	}

	public function get_mutasi_penjualan_ekspor(){
		$this->db->select('tujuan_pengiriman.*,mutasi_penjualan.*,produk.kode_produk,nama_produk,stok,detail_mutasi_penjualan.*,detail_qr_kedatangan.id_detail_qr_kedatangan,detail_kedatangan.id_detail_kedatangan,bahan_datang.id_bahan_datang,detail_order.id_detail_order');
		$this->db->join('mutasi_penjualan', 'mutasi_penjualan.id_mutasi_penjualan = detail_mutasi_penjualan.id_mutasi_penjualan', 'inner');
		$this->db->join('tujuan_pengiriman', 'tujuan_pengiriman.id_tujuan_pengiriman = mutasi_penjualan.id_tujuan_pengiriman', 'inner');
		$this->db->join('detail_qr_kedatangan', 'detail_qr_kedatangan.id_detail_qr_kedatangan = detail_mutasi_penjualan.id_detail_qr_kedatangan', 'inner');
		$this->db->join('detail_kedatangan', 'detail_kedatangan.id_detail_kedatangan = detail_qr_kedatangan.id_detail_kedatangan', 'inner');
		$this->db->join('bahan_datang', 'bahan_datang.id_bahan_datang = detail_kedatangan.id_bahan_datang', 'inner');
		$this->db->join('detail_order', 'detail_order.id_detail_order = bahan_datang.id_detail_order', 'inner');
		$this->db->join('produk', 'produk.id_produk = detail_order.id_produk', 'inner');
		return $this->db->get('detail_mutasi_penjualan');
	}

	public function get_mutasi_penjualan_id($id){
		$this->db->select('mutasi_penjualan.*,tujuan_pengiriman.*');
		$this->db->join('tujuan_pengiriman', 'tujuan_pengiriman.id_tujuan_pengiriman = mutasi_penjualan.id_tujuan_pengiriman', 'inner');
		$this->db->where('mutasi_penjualan.id_mutasi_penjualan', $id);
		return $this->db->get('mutasi_penjualan');
	}

	public function get_detail_mutasi_penjualan($id){
		$this->db->select('produk.id_produk,nama_produk,kode_produk,mitra.nama_mitra,detail_mutasi_penjualan.*,detail_order.id_detail_order,bahan_datang.id_bahan_datang,kode_kedatangan,detail_qr_kedatangan.id_detail_qr_kedatangan');
		$this->db->join('mitra', 'mitra.id_mitra = produk.id_mitra', 'inner');
		$this->db->join('detail_order', 'produk.id_produk = detail_order.id_produk', 'inner');
		$this->db->join('bahan_datang', 'detail_order.id_detail_order = bahan_datang.id_detail_order', 'inner');
		$this->db->join('detail_kedatangan', 'bahan_datang.id_bahan_datang = detail_kedatangan.id_bahan_datang', 'inner');
		$this->db->join('detail_qr_kedatangan', 'detail_kedatangan.id_detail_kedatangan = detail_qr_kedatangan.id_detail_kedatangan', 'inner');
		$this->db->join('detail_mutasi_penjualan', 'detail_qr_kedatangan.id_detail_qr_kedatangan = detail_mutasi_penjualan.id_detail_qr_kedatangan', 'inner');
		$this->db->where('detail_mutasi_penjualan.id_mutasi_penjualan', $id);
		return $this->db->get('produk');
	}

	public function get_data_daily($tanggal){
		return $this->db->query("select count(id_mutasi_lain) as jumlah from mutasi_lain where DATE(tanggal_mutasi_lain) = '$tanggal' AND YEAR(tanggal_mutasi_lain) = YEAR(NOW())");
	}

	public function get_range_daily($start, $end){
		return $this->db->query("select DATE(tanggal_mutasi_lain) as tanggal, count(tanggal_mutasi_lain) as jumlah from mutasi_lain where tanggal_mutasi_lain >= '$start' AND tanggal_mutasi_lain <= '$end' group by DATE(tanggal_mutasi_lain)");
	}

	public function get_data_weekly($num){
		return $this->db->query("SELECT CONCAT(FLOOR(((DAY(`tanggal_mutasi_lain`) - 1) / 7) + 1)) `month & week`, COUNT(`tanggal_mutasi_lain`) AS `value` FROM mutasi_lain WHERE CONCAT(FLOOR(((DAY(`tanggal_mutasi_lain`) - 1) / 7) + 1)) = $num AND MONTH(`tanggal_mutasi_lain`) = MONTH(NOW()) AND YEAR(`tanggal_mutasi_lain`) = YEAR(NOW()) GROUP BY `month & week` ORDER BY MONTH(`tanggal_mutasi_lain`), `month & week`");
	}

	public function get_weekly_range($num, $bulan, $tahun){
		return $this->db->query("SELECT CONCAT(FLOOR(((DAY(`tanggal_mutasi_lain`) - 1) / 7) + 1)) `month & week`, COUNT(`tanggal_mutasi_lain`) AS `value` FROM mutasi_lain WHERE CONCAT(FLOOR(((DAY(`tanggal_mutasi_lain`) - 1) / 7) + 1)) = $num AND MONTH(`tanggal_mutasi_lain`) = '$bulan' AND YEAR(`tanggal_mutasi_lain`) = '$tahun' GROUP BY `month & week` ORDER BY MONTH(`tanggal_mutasi_lain`), `month & week`");
	}

	public function get_monthly_chart($bulan){
		return $this->db->query("select count(id_mutasi_lain) as jumlah from mutasi_lain where MONTH(tanggal_mutasi_lain) = '$bulan' AND YEAR(tanggal_mutasi_lain) = YEAR(NOW())");
	}

	public function get_monthly_range($bulan, $tahun){
		return $this->db->query("select count(id_mutasi_lain) as jumlah from mutasi_lain where MONTH(tanggal_mutasi_lain) = '$bulan' AND YEAR(tanggal_mutasi_lain) = '$tahun'");
	}
}

/* End of file MutasiModel.php */
/* Location: ./application/models/MutasiModel.php */