<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderModel extends CI_Model {

	public function simpan_order($data){
		return $this->db->insert('order', $data);
	}

	public function simpan_detail_order($data){
		return $this->db->insert('detail_order', $data);
	}

	public function save_kedatangan($data){
		return $this->db->insert('bahan_datang', $data);
	}

	public function save_detail_datang($data){
		$this->db->insert('detail_kedatangan', $data);
		return $this->db->insert_id();
	}

	public function save_qr_datang($data){
		return $this->db->insert('detail_qr_kedatangan', $data);
	}

	public function save_cetak_proses($data){
		return $this->db->insert('cetak_proses', $data);
	}

	public function save_qr_temp($data){
		return $this->db->insert('temp_qr_sjp', $data);
	}

	public function get_qr_datang_mutasi($id){
		$this->db->select('detail_qr_kedatangan.*,detail_kedatangan.id_detail_kedatangan,satuan_kedatangan,bahan_datang.id_bahan_datang,kode_kedatangan,detail_order.id_detail_order,produk.id_produk,nama_produk,kode_produk,kategori_produk');
		$this->db->join('detail_kedatangan', 'detail_kedatangan.id_detail_kedatangan = detail_qr_kedatangan.id_detail_kedatangan', 'inner');
		$this->db->join('bahan_datang', 'bahan_datang.id_bahan_datang = detail_kedatangan.id_bahan_datang', 'inner');
		$this->db->join('detail_order', 'detail_order.id_detail_order = bahan_datang.id_detail_order', 'inner');
		$this->db->join('produk', 'produk.id_produk = detail_order.id_produk', 'inner');
		$this->db->where('id_detail_qr_kedatangan', $id);
		return $this->db->get('detail_qr_kedatangan');
	}

	public function update_qr_datang($id, $data){
		$this->db->where('id_detail_qr_kedatangan', $id);
		return $this->db->update('detail_qr_kedatangan', $data);
	}

	public function get_all_qr_temp(){
		$this->db->where('temp_total_karton', 0);
		$this->db->where('temp_total_pcs', 0);
		return $this->db->get('temp_qr_sjp');
	}

	public function get_qr_temp($id){
		$this->db->where('id_sjp', $id);
		return $this->db->get('temp_qr_sjp');
	}

	public function get_qr_temp_failed($id){
		$this->db->where('id_sjp', $id);
		$this->db->where('status_simpan', '0');
		return $this->db->get('temp_qr_sjp');
	}

	public function update_qr_temp($id, $data){
		$this->db->where('id_temp_qr_sjp', $id);
		return $this->db->update('temp_qr_sjp', $data);
	}

	public function get_serialisasi_qr($id){
		return $this->db->query("SELECT temp_qr_sjp.*,RIGHT(temp_qr_code,12) AS `serialisasi`,
								IF(status_simpan = '1','berhasil','gagal') 
								AS status_simpan FROM temp_qr_sjp WHERE id_sjp='$id' GROUP BY temp_qr_code");
	}

	public function get_cetak_proses(){
		$hari = date('d');
		$bulan = date('m');
		$tahun = date('Y');

		$this->db->like('kode_cetak', $hari, 'BOTH');
		$this->db->like('kode_cetak', $bulan, 'BOTH');
		$this->db->like('kode_cetak', $tahun, 'BOTH');
		return $this->db->get('cetak_proses');
	}

	public function get_daftar_order($request){
		if ($request == 'Baku') {
			$kode = 'BHB';
		}elseif ($request == 'Kemas') {
			$kode = 'KMS';
		}elseif ($request == 'Teknik') {
			$kode = 'TKP';
		}
		$this->db->select('mitra.nama_mitra,order.*,user.id_user,nama_user');
		$this->db->join('mitra', 'mitra.id_mitra = order.id_mitra', 'inner');
		$this->db->join('user', 'user.id_user = order.id_user', 'inner');
		$this->db->like('order.no_po', $kode, 'BOTH');
		$this->db->not_like('order.no_po', 'DUMMY', 'BOTH');
		return $this->db->get('order');
	}

	public function get_tipe_order($id){
		$this->db->select('order.id_po,mitra.tipe_mitra');
		$this->db->join('mitra', 'mitra.id_mitra = order.id_mitra', 'inner');
		$this->db->where('order.id_po', $id);
		return $this->db->get('order');
	}

	public function get_order_ekspor($request){
		if ($request == 'Baku') {
			$kode = 'BHB';
		}elseif ($request == 'Kemas') {
			$kode = 'KMS';
		}elseif ($request == 'Teknik') {
			$kode = 'TKP';
		}
		$this->db->select('produk.kode_produk,nama_produk,order.*,mitra.nama_mitra,detail_order.*,user.id_user,nama_user');
		$this->db->join('user', 'user.id_user = order.id_user', 'inner');
		$this->db->join('mitra', 'mitra.id_mitra = order.id_mitra', 'inner');
		$this->db->join('detail_order', 'order.id_po = detail_order.id_po', 'inner');
		$this->db->join('produk', 'produk.id_produk = detail_order.id_produk', 'inner');
		$this->db->like('order.no_po', $kode, 'BOTH');
		$this->db->not_like('order.no_po', 'DUMMY', 'BOTH');
		return $this->db->get('order');
	}

	public function delete_order($id){
		$this->db->where('id_po', $id);
		$this->db->delete('order');
	}

	public function get_detail_order($id){
		$this->db->select('mitra.*,order.*,user.nama_user');
		$this->db->join('mitra', 'mitra.id_mitra = order.id_mitra', 'inner');
		$this->db->join('user', 'user.id_user = order.id_user', 'inner');
		$this->db->where('order.id_po', $id);
		return $this->db->get('order');
	}

	public function get_bahan_detail($id){
		$this->db->select('produk.id_produk,kode_produk,nama_produk,deskripsi_produk,detail_order.*,order.catatan,subtotal,jenis_pajak,pajak,total_harga');
		$this->db->join('order', 'order.id_po = detail_order.id_po', 'inner');
		$this->db->join('produk', 'produk.id_produk = detail_order.id_produk', 'inner');
		$this->db->where('detail_order.id_po', $id);
		return $this->db->get('detail_order');
	}

	public function get_count_acc($request){
		if ($request == 'Baku') {
			$kode = 'BHB';
		}elseif ($request == 'Kemas') {
			$kode = 'KMS';
		}elseif ($request == 'Teknik') {
			$kode = 'TKP';
		}
		$this->db->where('status_po', 'Belum');
		$this->db->like('no_po', $kode, 'BOTH');
		return $this->db->get('order')->num_rows();
	}

	public function get_acc_by_date($bulan,$tahun,$request){
		$where = "status_po = 'Belum' AND (SELECT MONTH(order.tanggal_po) = '$bulan' AND YEAR(order.tanggal_po) = '$tahun')";
		if ($request == 'Baku') {
			$kode = 'BHB';
		}elseif ($request == 'Kemas') {
			$kode = 'KMS';
		}elseif ($request == 'Teknik') {
			$kode = 'TKP';
		}
		$this->db->where($where);
		$this->db->like('no_po', $kode, 'BOTH');
		return $this->db->get('order');
	}

	public function get_count_pending($request){
		if ($request == 'Baku') {
			$query = "SELECT `order`.no_po,produk.kode_produk,nama_produk,detail_order.* FROM detail_order INNER JOIN `order` ON `order`.id_po = detail_order.id_po INNER JOIN produk ON produk.id_produk = detail_order.id_produk WHERE `order`.status_po = 'Sudah' AND detail_order.status = 'Belum' AND `order`.no_po LIKE '%BHB%'";
		}elseif ($request == 'Kemas') {
			$query = "SELECT `order`.no_po,produk.kode_produk,nama_produk,detail_order.* FROM detail_order INNER JOIN `order` ON `order`.id_po = detail_order.id_po INNER JOIN produk ON produk.id_produk = detail_order.id_produk WHERE `order`.status_po = 'Sudah' AND detail_order.status = 'Belum' AND `order`.no_po LIKE '%KMS%'";
		}elseif ($request == 'Teknik') {
			$query = "SELECT `order`.no_po,produk.kode_produk,nama_produk,detail_order.* FROM detail_order INNER JOIN `order` ON `order`.id_po = detail_order.id_po INNER JOIN produk ON produk.id_produk = detail_order.id_produk WHERE `order`.status_po = 'Sudah' AND detail_order.status = 'Belum' AND `order`.no_po LIKE '%TKP%'";
		}
		return $this->db->query($query)->num_rows();
	}

	public function get_count_reminder($request){
		if ($request == 'Baku') {
			$kode = 'BHB';
		}elseif ($request == 'Kemas') {
			$kode = 'KMS';
		}elseif ($request == 'Teknik') {
			$kode = 'TKP';
		}
		$this->db->select('order.id_po,lead_time,detail_order.datang');
		$this->db->join('detail_order', 'order.id_po = detail_order.id_po', 'inner');
		$this->db->where('order.status_po', 'Sudah');
		$this->db->where('detail_order.status','Belum');
		$this->db->where("DATEDIFF(order.lead_time,NOW()) <=", '3');
		$this->db->like('order.no_po', $kode, 'BOTH');
		$this->db->group_by('order.id_po');
		return $this->db->get('order')->num_rows();
	}

	public function get_count_terlambat($request){
		if ($request == 'Baku') {
			$kode = 'BHB';
		}elseif ($request == 'Kemas') {
			$kode = 'KMS';
		}elseif ($request == 'Teknik') {
			$kode = 'TKP';
		}
		$this->db->select('order.id_po,lead_time,detail_order.datang');
		$this->db->join('detail_order', 'order.id_po = detail_order.id_po', 'inner');
		$this->db->where('order.status_po', 'Sudah');
		$this->db->where('detail_order.status','Belum');
		$this->db->where('order.lead_time < NOW()');
		$this->db->like('order.no_po', $kode, 'BOTH');
		$this->db->group_by('order.id_po');
		return $this->db->get('order')->num_rows();
	}

	public function get_order_acc($akses,$request){
		$where = "";
		if ($akses == 'direktur') {
			$where = "order.status_po = 'Belum' AND order.acc_spv = 'Sudah'";
		}elseif ($akses == 'spv_purchasing') {
			$where = "order.acc_spv = 'Belum'";
		}
		$this->db->select('mitra.nama_mitra,order.id_po,no_po,status_po,tanggal_po,total_harga');
		$this->db->join('mitra', 'mitra.id_mitra = order.id_mitra', 'inner');
		$this->db->where($where);
		$this->db->like('order.no_po', $request, 'BOTH');
		return $this->db->get('order');
	}

	public function get_count_parsial($request){
		if ($request == 'Baku') {
			$kode = 'BHB';
		}elseif ($request == 'Kemas') {
			$kode = 'KMS';
		}elseif ($request == 'Teknik') {
			$kode = 'TKP';
		}
		$this->db->select('order.no_po,detail_order.*');
		$this->db->join('order', 'order.id_po = detail_order.id_po', 'inner');
		$this->db->where('detail_order.status', 'Partial');
		$this->db->like('order.no_po', $kode, 'BOTH');
		return $this->db->get('detail_order')->num_rows();
	}

	public function get_count_datang($request){
		if ($request == 'Baku') {
			$kode = 'BHB';
		}elseif ($request == 'Kemas') {
			$kode = 'KMS';
		}elseif ($request == 'Teknik') {
			$kode = 'TKP';
		}
		$this->db->select('order.no_po,detail_order.*');
		$this->db->join('order', 'order.id_po = detail_order.id_po', 'inner');
		$this->db->where('detail_order.status', 'Sudah');
		$this->db->like('order.no_po', $kode, 'BOTH');
		return $this->db->get('detail_order')->num_rows();
	}

	public function get_count_order($request){
		if ($request == 'Baku') {
			$kode = 'BHB';
		}elseif ($request == 'Kemas') {
			$kode = 'KMS';
		}elseif ($request == 'Teknik') {
			$kode = 'TKP';
		}
		$this->db->like('no_po', $kode, 'BOTH');
		return $this->db->get('order')->num_rows();
	}

	public function get_count_bahan($request){
		if ($request == 'Baku') {
			$kode = 'BHB';
		}elseif ($request == 'Kemas') {
			$kode = 'KMS';
		}elseif ($request == 'Teknik') {
			$kode = 'TKP';
		}
		$this->db->select('order.id_po,status_po');
		$this->db->join('order', 'order.id_po = detail_order.id_po', 'inner');
		$this->db->where('status_po', 'Sudah');
		$this->db->like('order.no_po', $kode, 'BOTH');
		return $this->db->get('detail_order')->num_rows();
	}

	public function get_bahan_order($request){
		if ($request == 'Baku') {
			$kode = 'BHB';
		}elseif ($request == 'Kemas') {
			$kode = 'KMS';
		}elseif ($request == 'Teknik') {
			$kode = 'TKP';
		}
		$query = "SELECT `order`.no_po,produk.kode_produk,nama_produk,detail_order.* FROM detail_order INNER JOIN `order` ON `order`.id_po = detail_order.id_po INNER JOIN produk ON produk.id_produk = detail_order.id_produk WHERE `order`.status_po = 'Sudah' AND `order`.no_po LIKE '%$kode%'";
		return $this->db->query($query);
	}

	public function get_kedatangan($request,$tipe){
		$query = "";
		$kategori = "";
		if ($tipe == 'Baku') {
			$kode = 'BHB';
		}elseif ($tipe == 'Kemas') {
			$kode = 'KMS';
		}elseif ($tipe == 'Teknik') {
			$kode = 'TKP';
		}
		$kategori = $kode;

			if ($request == 'Belum') {
				$query = "SELECT `order`.no_po,mitra.nama_mitra,produk.kode_produk,nama_produk,kategori_produk,detail_order.* FROM detail_order INNER JOIN `order` ON `order`.id_po = detail_order.id_po INNER JOIN mitra ON mitra.id_mitra = `order`.id_mitra INNER JOIN produk ON produk.id_produk = detail_order.id_produk WHERE `order`.status_po = 'Sudah' AND detail_order.datang = 0 AND `order`.no_po LIKE '%$kategori%'";
			}elseif ($request == 'Parsial') {
				$query = "SELECT `order`.no_po,mitra.nama_mitra,produk.kode_produk,nama_produk,kategori_produk,detail_order.* FROM detail_order INNER JOIN `order` ON `order`.id_po = detail_order.id_po INNER JOIN mitra ON mitra.id_mitra = `order`.id_mitra INNER JOIN produk ON produk.id_produk = detail_order.id_produk WHERE detail_order.datang < detail_order.kuantitas AND detail_order.datang != 0 AND `order`.no_po LIKE '%$kategori%'";
			}elseif ($request == 'Sudah') {
				$query = "SELECT `order`.no_po,mitra.nama_mitra,produk.kode_produk,nama_produk,kategori_produk,detail_order.* FROM detail_order INNER JOIN `order` ON `order`.id_po = detail_order.id_po INNER JOIN mitra ON mitra.id_mitra = `order`.id_mitra INNER JOIN produk ON produk.id_produk = detail_order.id_produk WHERE detail_order.datang = detail_order.kuantitas AND `order`.no_po LIKE '%$kategori%'";
			}else{
				$query = null;
			}

		return $this->db->query($query);
	}
	
	public function update_all($data){
		return $this->db->update('order', $data);
	}

	public function update_acc($id,$data){
		$this->db->where('id_po', $id);
		return $this->db->update('order', $data);
	}

	public function update_acc_all($akses,$data,$request){
		if ($akses == 'direktur') {
			$where = "status_po = 'Belum' AND acc_spv = 'Sudah'";
		}elseif ($akses == 'spv_purchasing') {
			$where = "acc_spv = 'Belum'";
		}
		$this->db->where($where);
		$this->db->like('no_po', $request, 'BOTH');
		return $this->db->update('order', $data);
	}

	public function update_order($id,$data){
		$this->db->where('id_po', $id);
		return $this->db->update('order', $data);
	}

	public function delete_detail_order($id){
		$this->db->where('id_po', $id);
		return $this->db->delete('detail_order');
	}

	public function get_order_datang($request){
		if ($request == 'Baku') {
			$kode = 'BHB';
		}elseif ($request == 'Kemas') {
			$kode = 'KMS';
		}elseif ($request == 'Teknik') {
			$kode = 'TKP';
		}
		$this->db->select('mitra.nama_mitra,order.id_po,no_po,tanggal_po,lead_time,tanggal_pengiriman,total_harga');
		$this->db->join('mitra', 'mitra.id_mitra = order.id_mitra', 'inner');
		$this->db->where('order.status_po', 'Sudah');
		$this->db->like('order.no_po', $kode, 'BOTH');
		return $this->db->get('order');
	}

	public function get_list_bahan($request){
		if ($request == 'Baku') {
			$kode = 'BHB';
		}elseif ($request == 'Kemas') {
			$kode = 'KMS';
		}elseif ($request == 'Teknik') {
			$kode = 'TKP';
		}else{
			$kode = '';
		}
		$this->db->select('order.no_po,produk.kode_produk,nama_produk,mitra.nama_mitra,detail_order.*');
		$this->db->join('order', 'order.id_po = detail_order.id_po', 'inner');
		$this->db->join('produk', 'produk.id_produk = detail_order.id_produk', 'inner');
		$this->db->join('mitra', 'mitra.id_mitra = produk.id_mitra', 'left');
		$this->db->where('order.status_po', 'Sudah');
		$this->db->like('order.no_po', $kode, 'BOTH');
		return $this->db->get('detail_order');
	}

	public function get_bahan_gudang($id){
		$this->db->select('order.no_po,produk.id_produk,kode_produk,nama_produk,mitra.nama_mitra,detail_order.*');
		$this->db->join('order', 'order.id_po = detail_order.id_po', 'inner');
		$this->db->join('produk', 'produk.id_produk = detail_order.id_produk', 'inner');
		$this->db->join('mitra', 'mitra.id_mitra = produk.id_mitra', 'left');
		$this->db->where('order.status_po', 'Sudah');
		$this->db->where('order.id_po', $id);
		return $this->db->get('detail_order');
	}

	public function detail_by_id($id){
		$this->db->select('order.id_po,produk.kode_produk,nama_produk,kategori_produk,detail_order.id_detail_order,kuantitas,datang,(SELECT MAX(bahan_datang.kode_kedatangan)) AS kode');
		$this->db->join('order', 'order.id_po = detail_order.id_po', 'inner');
		$this->db->join('produk', 'produk.id_produk = detail_order.id_produk', 'inner');
		$this->db->join('bahan_datang', 'detail_order.id_detail_order = bahan_datang.id_detail_order', 'left');
		$this->db->where('detail_order.id_detail_order', $id);
		return $this->db->get('detail_order');
	}

	public function update_detail_datang($id,$data){
		$this->db->where('id_detail_order', $id);
		return $this->db->update('detail_order', $data);
	}

	public function update_bahan_datang($id,$data){
		$this->db->where('id_bahan_datang', $id);
		return $this->db->update('bahan_datang', $data);
	}

	public function get_order_by_status($status,$tipe){
		$request_tipe = "";
		if ($tipe == 'Baku') {
			$kode = 'BHB';
		}elseif ($tipe == 'Kemas') {
			$kode = 'KMS';
		}elseif ($tipe == 'Teknik') {
			$kode = 'TKP';
		}

		$request_tipe = $kode;
		if ($status == 'Pending') {
			$this->db->select('user.id_user,nama_user,mitra.nama_mitra,order.*,detail_order.kuantitas,datang');
			$this->db->join('user', 'user.id_user = order.id_user', 'inner');
			$this->db->join('mitra', 'mitra.id_mitra = order.id_mitra', 'inner');
			$this->db->join('detail_order', 'order.id_po = detail_order.id_po', 'inner');
			$this->db->where('order.status_po', 'Sudah');
			$this->db->where('detail_order.datang','0');
			$this->db->like('order.no_po', $request_tipe, 'BOTH');
			$this->db->group_by('order.id_po');
		}else if ($status == 'Reminder') {
			$this->db->select('user.id_user,nama_user,mitra.nama_mitra,order.*,detail_order.kuantitas,datang');
			$this->db->join('user', 'user.id_user = order.id_user', 'inner');
			$this->db->join('mitra', 'mitra.id_mitra = order.id_mitra', 'inner');
			$this->db->join('detail_order', 'order.id_po = detail_order.id_po', 'inner');
			$this->db->where('order.status_po', 'Sudah');
			$this->db->where('detail_order.datang','0');
			$this->db->where("DATEDIFF(order.lead_time,NOW()) <=", '3');
			$this->db->like('order.no_po', $request_tipe, 'BOTH');
			$this->db->group_by('order.id_po');
		}else if ($status == 'Terlambat') {
			$this->db->select('user.id_user,nama_user,mitra.nama_mitra,order.*,detail_order.kuantitas,datang');
			$this->db->join('user', 'user.id_user = order.id_user', 'inner');
			$this->db->join('mitra', 'mitra.id_mitra = order.id_mitra', 'inner');
			$this->db->join('detail_order', 'order.id_po = detail_order.id_po', 'inner');
			$this->db->where('order.status_po', 'Sudah');
			$this->db->where('detail_order.datang','0');
			$this->db->where('order.lead_time < NOW()');
			$this->db->like('order.no_po', $request_tipe, 'BOTH');
			$this->db->group_by('order.id_po');
		}else if ($status == 'Belum') {
			$this->db->select('user.id_user,nama_user,mitra.nama_mitra,order.*');
			$this->db->join('user', 'user.id_user = order.id_user', 'inner');
			$this->db->join('mitra', 'mitra.id_mitra = order.id_mitra', 'inner');
			$this->db->where('order.status_po', 'belum');
			$this->db->like('order.no_po', $request_tipe, 'BOTH');
		}else{
			return;
		}
		return $this->db->get('order');
	}

	public function get_ekspor_by_status($status,$tipe){
		$request_tipe = "";
		if ($tipe == 'Baku') {
			$kode = 'BHB';
		}elseif ($tipe == 'Kemas') {
			$kode = 'KMS';
		}elseif ($tipe == 'Teknik') {
			$kode = 'TKP';
		}

		$request_tipe = $kode;
		if ($status == 'Pending') {
			$this->db->select('user.id_user,nama_user,produk.kode_produk,nama_produk,order.*,mitra.nama_mitra,detail_order.*');
			$this->db->join('user', 'user.id_user = order.id_user', 'inner');
			$this->db->join('mitra', 'mitra.id_mitra = order.id_mitra', 'inner');
			$this->db->join('detail_order', 'order.id_po = detail_order.id_po', 'inner');
			$this->db->join('produk', 'produk.id_produk = detail_order.id_produk', 'inner');
			$this->db->where('order.status_po', 'Sudah');
			$this->db->where('detail_order.status','Belum');
			$this->db->like('order.no_po', $request_tipe, 'BOTH');
			$this->db->group_by('order.id_po');
		}else if ($status == 'Reminder') {
			$this->db->select('user.id_user,nama_user,produk.kode_produk,nama_produk,order.*,mitra.nama_mitra,detail_order.*');
			$this->db->join('user', 'user.id_user = order.id_user', 'inner');
			$this->db->join('mitra', 'mitra.id_mitra = order.id_mitra', 'inner');
			$this->db->join('detail_order', 'order.id_po = detail_order.id_po', 'inner');
			$this->db->join('produk', 'produk.id_produk = detail_order.id_produk', 'inner');
			$this->db->where('order.status_po', 'Sudah');
			$this->db->where('detail_order.status','Belum');
			$this->db->where("DATEDIFF(order.lead_time,NOW()) <=", '3');
			$this->db->like('order.no_po', $request_tipe, 'BOTH');
			$this->db->group_by('order.id_po');
		}else if ($status == 'Terlambat') {
			$this->db->select('user.id_user,nama_user,produk.kode_produk,nama_produk,order.*,mitra.nama_mitra,detail_order.*');
			$this->db->join('user', 'user.id_user = order.id_user', 'inner');
			$this->db->join('mitra', 'mitra.id_mitra = order.id_mitra', 'inner');
			$this->db->join('detail_order', 'order.id_po = detail_order.id_po', 'inner');
			$this->db->join('produk', 'produk.id_produk = detail_order.id_produk', 'inner');
			$this->db->where('order.status_po', 'Sudah');
			$this->db->where('detail_order.status','Belum');
			$this->db->where('order.lead_time < NOW()');
			$this->db->like('order.no_po', $request_tipe, 'BOTH');
			$this->db->group_by('order.id_po');
		}else if ($status == 'Belum') {
			$this->db->select('user.id_user,nama_user,produk.kode_produk,nama_produk,order.*,mitra.nama_mitra,detail_order.*');
			$this->db->join('user', 'user.id_user = order.id_user', 'inner');
			$this->db->join('mitra', 'mitra.id_mitra = order.id_mitra', 'inner');
			$this->db->join('detail_order', 'order.id_po = detail_order.id_po', 'inner');
			$this->db->join('produk', 'produk.id_produk = detail_order.id_produk', 'inner');
			$this->db->where('order.status_po', 'belum');
			$this->db->like('order.no_po', $request_tipe, 'BOTH');
		}else{
			return;
		}
		return $this->db->get('order');
	}

	public function get_reminder_by_date($bulan,$tahun,$tipe){
		if ($tipe == 'Baku') {
			$kode = 'BHB';
		}elseif ($tipe == 'Kemas') {
			$kode = 'KMS';
		}elseif ($tipe == 'Teknik') {
			$kode = 'TKP';
		}

		$where = "order.status_po = 'Sudah' AND detail_order.status = 'Belum' AND DATEDIFF(order.lead_time,NOW()) <= 3 AND (SELECT MONTH(order.tanggal_po) = '$bulan' AND YEAR(order.tanggal_po) = '$tahun')";

		$this->db->select('produk.kode_produk,nama_produk,order.*,mitra.nama_mitra,detail_order.*');
		$this->db->join('mitra', 'mitra.id_mitra = order.id_mitra', 'inner');
		$this->db->join('detail_order', 'order.id_po = detail_order.id_po', 'inner');
		$this->db->join('produk', 'produk.id_produk = detail_order.id_produk', 'inner');
		$this->db->where($where);
		$this->db->like('order.no_po', $kode, 'BOTH');
		$this->db->group_by('order.id_po');
		return $this->db->get('order');
	}

	public function get_late_by_date($bulan,$tahun,$tipe){

		if ($tipe == 'Baku') {
			$kode = 'BHB';
		}elseif ($tipe == 'Kemas') {
			$kode = 'KMS';
		}elseif ($tipe == 'Teknik') {
			$kode = 'TKP';
		}

		$where = "order.status_po = 'Sudah' AND detail_order.status = 'Belum' AND order.lead_time < NOW() AND (SELECT MONTH(order.tanggal_po) = '$bulan' AND YEAR(order.tanggal_po) = '$tahun')";

		$this->db->select('produk.kode_produk,nama_produk,order.*,mitra.nama_mitra,detail_order.*');
		$this->db->join('mitra', 'mitra.id_mitra = order.id_mitra', 'inner');
		$this->db->join('detail_order', 'order.id_po = detail_order.id_po', 'inner');
		$this->db->join('produk', 'produk.id_produk = detail_order.id_produk', 'inner');
		$this->db->where($where);
		$this->db->like('order.no_po', $kode, 'BOTH');
		$this->db->group_by('order.id_po');
		return $this->db->get('order');
	}


	public function get_count_kode($request){
		$bulan = date('m');
		$tahun = date('Y');

		if ($request == 'Baku') {
			$kode = 'BHB';
		}elseif ($request == 'Kemas') {
			$kode = 'KMS';
		}elseif ($request == 'Teknik') {
			$kode = 'TKP';
		}

		$this->db->where('MONTH(tanggal_po)', $bulan);
		$this->db->where('YEAR(tanggal_po)', $tahun);
		$this->db->like('no_po', $kode, 'BOTH');
		return $this->db->get('order');
	}

	public function get_no_po($id){
		$this->db->select('no_po');
		$this->db->where('id_po', $id);
		return $this->db->get('order');
	}

	public function get_no_po_by_detail($id){
		$this->db->select('produk.kategori_produk,order.no_po,detail_order.no_surat_jalan,no_urut_surat_jalan,keterangan_surat_jalan');
		$this->db->join('order', 'order.id_po = detail_order.id_po', 'inner');
		$this->db->join('produk', 'produk.id_produk = detail_order.id_produk', 'inner');
		$this->db->where('id_detail_order', $id);
		return $this->db->get('detail_order');
	}

	public function get_id_po_detail($id){
		$this->db->select('id_po');
		$this->db->where('id_detail_order', $id);
		return $this->db->get('detail_order', 1);
	}

	public function get_bahan_validasi($request){
		$this->db->select('produk.kode_produk,nama_produk,mitra.nama_mitra,order.no_po,detail_order.id_detail_order,bahan_datang.*');
		$this->db->join('produk', 'produk.id_produk = detail_order.id_produk', 'inner');
		$this->db->join('order', 'order.id_po = detail_order.id_po', 'inner');
		$this->db->join('mitra', 'mitra.id_mitra = order.id_mitra', 'inner');
		$this->db->join('bahan_datang', 'detail_order.id_detail_order = bahan_datang.id_detail_order', 'inner');
		$this->db->where('bahan_datang.acc_qc', 'Belum');
		$this->db->where('produk.kategori_produk', $request);
		$this->db->order_by('bahan_datang.tanggal_kedatangan', 'desc');
		return $this->db->get('detail_order');
	}

	public function get_history_validasi($status,$kategori){
		$this->db->select('produk.kode_produk,nama_produk,mitra.nama_mitra,order.no_po,detail_order.id_detail_order,bahan_datang.*');
		$this->db->join('produk', 'produk.id_produk = detail_order.id_produk', 'inner');
		$this->db->join('order', 'order.id_po = detail_order.id_po', 'inner');
		$this->db->join('mitra', 'mitra.id_mitra = order.id_mitra', 'inner');
		$this->db->join('bahan_datang', 'detail_order.id_detail_order = bahan_datang.id_detail_order', 'inner');
		$this->db->where('bahan_datang.acc_qc', $status);
		$this->db->where('produk.kategori_produk', $kategori);
		$this->db->order_by('bahan_datang.tanggal_kedatangan', 'desc');
		return $this->db->get('detail_order');
	}

	public function get_detail($id){
		$this->db->select('produk.id_produk,stok,detail_order.temp_stok');
		$this->db->join('produk', 'produk.id_produk = detail_order.id_produk', 'inner');
		$this->db->where('id_detail_order', $id);
		return $this->db->get('detail_order');
	}

	public function get_proses_id($id){
		$this->db->select('produk.nama_produk,detail_order.id_detail_order');
		$this->db->join('produk', 'produk.id_produk = detail_order.id_produk', 'inner');
		$this->db->where('id_detail_order', $id);
		return $this->db->get('detail_order');
	}

	public function get_riwayat_datang($id){
		$this->db->select('produk.kode_produk,nama_produk,detail_order.id_detail_order,bahan_datang.*');
		$this->db->join('produk', 'produk.id_produk = detail_order.id_produk', 'inner');
		$this->db->join('bahan_datang', 'detail_order.id_detail_order = bahan_datang.id_detail_order', 'inner');
		$this->db->order_by('bahan_datang.tanggal_kedatangan', 'asc');
		$this->db->where('detail_order.id_detail_order', $id);
		return $this->db->get('detail_order');
	}

	public function get_detail_kedatangan($id){
		$this->db->select('order.no_po,produk.id_produk,kode_produk,nama_produk,detail_order.*,bahan_datang.*');
		$this->db->join('detail_order', 'detail_order.id_detail_order = bahan_datang.id_detail_order', 'inner');
		$this->db->join('order', 'order.id_po = detail_order.id_po', 'inner');
		$this->db->join('produk', 'produk.id_produk = detail_order.id_produk', 'inner');
		$this->db->where('bahan_datang.id_bahan_datang', $id);
		return $this->db->get('bahan_datang');
	}

	public function get_penerimaan_produk($id){
		$this->db->select('produk.kode_produk,nama_produk,kategori_produk,label_halal,mitra.nama_mitra,order.no_po,detail_order.id_detail_order,bahan_datang.*');
		$this->db->join('detail_order', 'detail_order.id_detail_order = bahan_datang.id_detail_order', 'inner');
		$this->db->join('produk', 'produk.id_produk = detail_order.id_produk', 'inner');
		$this->db->join('mitra', 'mitra.id_mitra = produk.id_mitra', 'inner');
		$this->db->join('order', 'order.id_po = detail_order.id_po', 'inner');
		$this->db->where('bahan_datang.id_bahan_datang', $id);
		return $this->db->get('bahan_datang');
	}

	public function get_user_penerimaan($id){
		$this->db->select('user.*,bahan_datang.*');
		$this->db->join('user', 'user.id_user = bahan_datang.id_user', 'inner');
		$this->db->where('bahan_datang.id_bahan_datang', $id);
		return $this->db->get('bahan_datang');
	}

	public function get_komplain_produk($id){
		$this->db->select('produk.kode_produk,nama_produk,kategori_produk,label_halal,mitra.nama_mitra,alamat_baris_1,order.no_po,detail_order.id_detail_order,bahan_datang.*,komplain_datang.*');
		$this->db->join('komplain_datang', 'bahan_datang.id_bahan_datang = komplain_datang.id_bahan_datang', 'inner');
		$this->db->join('detail_order', 'detail_order.id_detail_order = bahan_datang.id_detail_order', 'inner');
		$this->db->join('produk', 'produk.id_produk = detail_order.id_produk', 'inner');
		$this->db->join('mitra', 'mitra.id_mitra = produk.id_mitra', 'inner');
		$this->db->join('order', 'order.id_po = detail_order.id_po', 'inner');
		$this->db->where('bahan_datang.id_bahan_datang', $id);
		return $this->db->get('bahan_datang');
	}

	public function get_detail_penerimaan($id){
		$this->db->where('id_bahan_datang', $id);
		return $this->db->get('detail_kedatangan');
	}

	public function get_retur(){
		return $this->db->get('retur_datang');
	}

	public function get_retur_by_kedatangan($id){
		$this->db->where('id_bahan_datang', $id);
		$this->db->order_by('id_retur_datang', 'desc');
		return $this->db->get('retur_datang');
	}

	public function save_retur($data){
		return $this->db->insert('retur_datang',$data);
	}

	public function get_history_kedatangan($request, $tanggal){
		$this->db->select('bahan_datang.*,detail_order.id_detail_order,produk.nama_produk,kategori_produk,order.no_po,mitra.nama_mitra');
		$this->db->join('detail_order', 'detail_order.id_detail_order = bahan_datang.id_detail_order', 'inner');
		$this->db->join('produk', 'produk.id_produk = detail_order.id_produk', 'inner');
		$this->db->join('order', 'order.id_po = detail_order.id_po', 'inner');
		$this->db->join('mitra', 'mitra.id_mitra = order.id_mitra', 'inner');
		$this->db->where('produk.kategori_produk', $request);
		$this->db->where('bahan_datang.tanggal_kedatangan', $tanggal);
		$this->db->order_by('bahan_datang.id_bahan_datang', 'desc');
		return $this->db->get('bahan_datang');
	}

	public function get_history_kedatangan_gudang($request, $tanggal){
		$this->db->select('bahan_datang.*,detail_order.id_detail_order,produk.nama_produk,kategori_produk,order.no_po,mitra.nama_mitra');
		$this->db->join('detail_order', 'detail_order.id_detail_order = bahan_datang.id_detail_order', 'inner');
		$this->db->join('produk', 'produk.id_produk = detail_order.id_produk', 'inner');
		$this->db->join('order', 'order.id_po = detail_order.id_po', 'inner');
		$this->db->join('mitra', 'mitra.id_mitra = order.id_mitra', 'inner');
		$this->db->where('produk.kategori_produk', $request);
		$this->db->where('bahan_datang.tanggal_kedatangan >=', $tanggal);
		$this->db->where('bahan_datang.tanggal_kedatangan <=', date('Y-m-d'));
		$this->db->order_by('bahan_datang.id_bahan_datang', 'desc');
		return $this->db->get('bahan_datang');
	}

	public function get_history_range($start, $end, $request){
		$this->db->select('bahan_datang.*,detail_order.id_detail_order,produk.nama_produk,kategori_produk,order.no_po,mitra.nama_mitra');
		$this->db->join('detail_order', 'detail_order.id_detail_order = bahan_datang.id_detail_order', 'inner');
		$this->db->join('produk', 'produk.id_produk = detail_order.id_produk', 'inner');
		$this->db->join('order', 'order.id_po = detail_order.id_po', 'inner');
		$this->db->join('mitra', 'mitra.id_mitra = order.id_mitra', 'inner');
		$this->db->where('produk.kategori_produk', $request);
		$this->db->where('bahan_datang.tanggal_kedatangan >=', $start);
		$this->db->where('bahan_datang.tanggal_kedatangan <=', $end);
		$this->db->order_by('bahan_datang.tanggal_kedatangan', 'desc');
		return $this->db->get('bahan_datang');
	}

	public function get_history_ekspor($bulan,$tahun,$kategori){
		$where = "produk.kategori_produk = '$kategori' AND (SELECT MONTH(bahan_datang.tanggal_kedatangan) = '$bulan' AND YEAR(bahan_datang.tanggal_kedatangan) = '$tahun')";
		$this->db->select('bahan_datang.*,detail_order.id_detail_order,produk.nama_produk,kategori_produk,order.no_po,mitra.nama_mitra');
		$this->db->join('detail_order', 'detail_order.id_detail_order = bahan_datang.id_detail_order', 'inner');
		$this->db->join('produk', 'produk.id_produk = detail_order.id_produk', 'inner');
		$this->db->join('order', 'order.id_po = detail_order.id_po', 'inner');
		$this->db->join('mitra', 'mitra.id_mitra = order.id_mitra', 'inner');
		$this->db->where($where);
		$this->db->order_by('bahan_datang.tanggal_kedatangan', 'desc');
		return $this->db->get('bahan_datang');
	}

	public function get_kedatangan_by_id($id){
		$this->db->select('produk.nama_produk,kode_produk,kategori_produk,detail_order.*,bahan_datang.*');
		$this->db->join('produk', 'produk.id_produk = detail_order.id_produk', 'inner');
		$this->db->join('bahan_datang', 'detail_order.id_detail_order = bahan_datang.id_detail_order', 'inner');
		$this->db->where('bahan_datang.id_bahan_datang', $id);
		return $this->db->get('detail_order');
	}

	public function get_detail_release($id){
		$this->db->where('id_bahan_datang', $id);
		return $this->db->get('detail_kedatangan');
	}

	public function get_detail_qr_release($id){
		$this->db->select('bahan_datang.id_bahan_datang,detail_kedatangan.*,detail_qr_kedatangan.*');
		$this->db->join('detail_kedatangan', 'detail_kedatangan.id_detail_kedatangan = detail_qr_kedatangan.id_detail_kedatangan', 'inner');
		$this->db->join('bahan_datang', 'bahan_datang.id_bahan_datang = detail_kedatangan.id_bahan_datang', 'inner');
		$this->db->where('bahan_datang.id_bahan_datang', $id);
		return $this->db->get('detail_qr_kedatangan');
	}

	public function delete_detail_datang($id){
		$this->db->where('id_bahan_datang', $id);
		return $this->db->delete('detail_kedatangan');
	}

	public function delete_bahan_datang($id){
		$this->db->where('id_bahan_datang', $id);
		return $this->db->delete('bahan_datang');
	}

	public function get_validasi_status($request){
		$this->db->select('bahan_datang.*,detail_order.id_detail_order,produk.nama_produk,kategori_produk,order.no_po,mitra.nama_mitra');
		$this->db->join('detail_order', 'detail_order.id_detail_order = bahan_datang.id_detail_order', 'inner');
		$this->db->join('produk', 'produk.id_produk = detail_order.id_produk', 'inner');
		$this->db->join('order', 'order.id_po = detail_order.id_po', 'inner');
		$this->db->join('mitra', 'mitra.id_mitra = order.id_mitra', 'inner');
		if ($request == 'Selesai') {
			$this->db->where('bahan_datang.no_urut_surat_jalan !=', '');
			$this->db->where('bahan_datang.acc_qc', 'Release');
		}elseif ($request == 'Baku' || $request == 'Kemas') {
			$this->db->where('produk.kategori_produk', $request);
			$this->db->where('bahan_datang.no_urut_surat_jalan', '');
			$this->db->where('bahan_datang.acc_qc', 'Belum');
		}
		$this->db->order_by('bahan_datang.tanggal_kedatangan', 'desc');
		return $this->db->get('bahan_datang');
	}

	public function get_validasi_departemen($dept, $request){
		$this->db->select('bahan_datang.*,detail_order.id_detail_order,produk.nama_produk,kategori_produk,order.no_po,mitra.nama_mitra');
		$this->db->join('detail_order', 'detail_order.id_detail_order = bahan_datang.id_detail_order', 'inner');
		$this->db->join('produk', 'produk.id_produk = detail_order.id_produk', 'inner');
		$this->db->join('order', 'order.id_po = detail_order.id_po', 'inner');
		$this->db->join('mitra', 'mitra.id_mitra = order.id_mitra', 'inner');
		$this->db->where('produk.kategori_produk', $request);
		if ($dept == 'purchasing') {
			$this->db->where('bahan_datang.no_urut_surat_jalan', '');
		}elseif ($dept == 'qc') {
			$this->db->where('bahan_datang.acc_qc', 'Belum');
		}
		$this->db->order_by('bahan_datang.tanggal_kedatangan', 'desc');
		return $this->db->get('bahan_datang');
	}

	public function get_daily_validasi($tanggal, $kategori, $status){
		return $this->db->query("select count(id_bahan_datang) as jumlah from bahan_datang inner join detail_order on detail_order.id_detail_order = bahan_datang.id_detail_order inner join produk on produk.id_produk = detail_order.id_produk where bahan_datang.tanggal_kedatangan = '$tanggal' AND bahan_datang.acc_qc = '$status' AND YEAR(bahan_datang.tanggal_kedatangan) = YEAR(NOW()) AND produk.kategori_produk = '$kategori'");
	}

	public function get_weekly_validasi($num, $kategori, $status){
		return $this->db->query("SELECT CONCAT(FLOOR(((DAY(`tanggal_kedatangan`) - 1) / 7) + 1)) `month & week`, COUNT(`tanggal_kedatangan`) AS `value` FROM bahan_datang inner join detail_order on detail_order.id_detail_order = bahan_datang.id_detail_order inner join produk on produk.id_produk = detail_order.id_produk WHERE CONCAT(FLOOR(((DAY(`tanggal_kedatangan`) - 1) / 7) + 1)) = $num AND MONTH(`tanggal_kedatangan`) = MONTH(NOW()) AND YEAR(`tanggal_kedatangan`) = YEAR(NOW()) AND bahan_datang.acc_qc = '$status' AND produk.kategori_produk = '$kategori' GROUP BY `month & week` ORDER BY MONTH(`tanggal_kedatangan`), `month & week`");
	}

	public function get_weekly_validasi_range($num, $kategori, $status, $bulan, $tahun){
		return $this->db->query("SELECT CONCAT(FLOOR(((DAY(`tanggal_kedatangan`) - 1) / 7) + 1)) `month & week`, COUNT(`tanggal_kedatangan`) AS `value` FROM bahan_datang inner join detail_order on detail_order.id_detail_order = bahan_datang.id_detail_order inner join produk on produk.id_produk = detail_order.id_produk WHERE CONCAT(FLOOR(((DAY(`tanggal_kedatangan`) - 1) / 7) + 1)) = $num AND MONTH(`tanggal_kedatangan`) = '$bulan' AND YEAR(`tanggal_kedatangan`) = '$tahun' AND bahan_datang.acc_qc = '$status' AND produk.kategori_produk = '$kategori' GROUP BY `month & week` ORDER BY MONTH(`tanggal_kedatangan`), `month & week`");
	}

	public function get_monthly_validasi($bulan, $kategori, $status){
		return $this->db->query("SELECT COUNT(bahan_datang.id_bahan_datang) as jumlah FROM bahan_datang inner join detail_order on detail_order.id_detail_order = bahan_datang.id_detail_order inner join produk on produk.id_produk = detail_order.id_produk WHERE MONTH(`tanggal_kedatangan`) = '$bulan' AND YEAR(tanggal_kedatangan) = YEAR(NOW()) AND bahan_datang.acc_qc = '$status' AND produk.kategori_produk = '$kategori'");
	}

	public function get_monthly_validasi_range($bulan, $kategori, $status, $tahun){
		return $this->db->query("SELECT COUNT(bahan_datang.id_bahan_datang) as jumlah FROM bahan_datang inner join detail_order on detail_order.id_detail_order = bahan_datang.id_detail_order inner join produk on produk.id_produk = detail_order.id_produk WHERE MONTH(`tanggal_kedatangan`) = '$bulan' AND YEAR(tanggal_kedatangan) = '$tahun' AND bahan_datang.acc_qc = '$status' AND produk.kategori_produk = '$kategori'");
	}

	public function get_daily_lead($tanggal, $kategori){
		$kode = "";

		if ($kategori == 'baku') {
			$kode = 'BHB';
		}elseif ($kategori == 'kemas') {
			$kode = 'KMS';
		}elseif ($kategori == 'teknik') {
			$kode = 'TKP';
		}

		return $this->db->query("select count(id_po) as jumlah from `order` where lead_time = '$tanggal' AND YEAR(lead_time) = YEAR(NOW()) AND no_po LIKE '%$kode%' AND status_po = 'Sudah'");
	}

	public function get_weekly_lead($num, $kategori){
		$kode = "";

		if ($kategori == 'baku') {
			$kode = 'BHB';
		}elseif ($kategori == 'kemas') {
			$kode = 'KMS';
		}elseif ($kategori == 'teknik') {
			$kode = 'TKP';
		}

		return $this->db->query("SELECT CONCAT(FLOOR(((DAY(`lead_time`) - 1) / 7) + 1)) `month & week`, COUNT(`lead_time`) AS `value` FROM `order` WHERE CONCAT(FLOOR(((DAY(`lead_time`) - 1) / 7) + 1)) = $num AND MONTH(`lead_time`) = MONTH(NOW()) AND YEAR(`lead_time`) = YEAR(NOW()) AND no_po LIKE '%$kode%' AND status_po = 'Sudah' GROUP BY `month & week` ORDER BY MONTH(`lead_time`), `month & week`");
	}

	public function get_weekly_lead_range($num, $kategori, $bulan, $tahun){
		$kode = "";

		if ($kategori == 'baku') {
			$kode = 'BHB';
		}elseif ($kategori == 'kemas') {
			$kode = 'KMS';
		}elseif ($kategori == 'teknik') {
			$kode = 'TKP';
		}

		return $this->db->query("SELECT CONCAT(FLOOR(((DAY(`lead_time`) - 1) / 7) + 1)) `month & week`, COUNT(`lead_time`) AS `value` FROM `order` WHERE CONCAT(FLOOR(((DAY(`lead_time`) - 1) / 7) + 1)) = $num AND MONTH(`lead_time`) = '$bulan' AND YEAR(`lead_time`) = '$tahun' AND no_po LIKE '%$kode%' AND status_po = 'Sudah' GROUP BY `month & week` ORDER BY MONTH(`lead_time`), `month & week`");
	}

	public function get_monthly_lead($bulan, $kategori){
		$kode = "";

		if ($kategori == 'baku') {
			$kode = 'BHB';
		}elseif ($kategori == 'kemas') {
			$kode = 'KMS';
		}elseif ($kategori == 'teknik') {
			$kode = 'TKP';
		}

		return $this->db->query("SELECT COUNT(id_po) as jumlah FROM `order` WHERE MONTH(lead_time) = '$bulan' AND YEAR(lead_time) = YEAR(NOW()) AND status_po = 'Sudah' AND no_po LIKE '%$kode%'");

	}

	public function get_monthly_lead_range($bulan, $kategori, $tahun){
		$kode = "";

		if ($kategori == 'baku') {
			$kode = 'BHB';
		}elseif ($kategori == 'kemas') {
			$kode = 'KMS';
		}elseif ($kategori == 'teknik') {
			$kode = 'TKP';
		}

		return $this->db->query("SELECT COUNT(id_po) as jumlah FROM `order` WHERE MONTH(lead_time) = '$bulan' AND YEAR(lead_time) = '$tahun' AND status_po = 'Sudah' AND no_po LIKE '%$kode%'");

	}

	public function get_max_kode(){
		return $this->db->query("SELECT kode_kedatangan FROM bahan_datang WHERE kode_kedatangan != '' OR kode_kedatangan != '-' OR kode_kedatangan != NULL ORDER BY id_bahan_datang DESC LIMIT 1");
	}

	public function get_lead_time($id){
		$this->db->select('detail_order.*, lead_time_datang.*');
		$this->db->join('detail_order', 'detail_order.id_detail_order = lead_time_datang.id_detail_order', 'inner');
		$this->db->where('lead_time_datang.id_detail_order', $id);
		$this->db->order_by('id_lead_time_datang', 'desc');
		return $this->db->get('lead_time_datang');
	}

	public function get_lead_time_verifikasi($id_detail_order, $tanggal){
		$this->db->select('detail_order.*, lead_time_datang.*');
		$this->db->join('detail_order', 'detail_order.id_detail_order = lead_time_datang.id_detail_order', 'inner');
		$this->db->where('lead_time_datang.id_detail_order', $id_detail_order);
		$this->db->where('lead_time_datang.tgl_lead_time', $tanggal);	
		return $this->db->get('lead_time_datang');
	}

	public function get_lead_time_id($id){
		$this->db->where('id_lead_time_datang', $id);
		return $this->db->get('lead_time_datang');
		
	}

	public function save_lead_time($data){
		return $this->db->insert('lead_time_datang', $data);
	}

	public function update_lead_time($id, $data){
		$this->db->where('id_lead_time_datang', $id);
		return $this->db->update('lead_time_datang', $data);
	}

	public function delete_lead_time($id){
		$this->db->where('id_lead_time_datang', $id);
		return $this->db->delete('lead_time_datang');
	}

	public function delete_lead_time_verifikasi($id_detail, $tgl_lead){
		$this->db->where('id_detail_order', $id_detail);
		$this->db->where('tgl_lead_time', $tgl_lead);
		return $this->db->delete('lead_time_datang');
	}


	public function get_estimasi_all($start, $end, $kategori){
		return $this->db->query("SELECT lead_time_datang.*,`order`.*,mitra.*, detail_order.*,produk.* FROM lead_time_datang INNER JOIN detail_order 
									ON detail_order.id_detail_order = lead_time_datang.id_detail_order INNER JOIN `order` 
									ON `order`.id_po = detail_order.id_po INNER JOIN mitra ON mitra.id_mitra = `order`.id_mitra INNER JOIN produk 
									ON produk.id_produk = detail_order.id_produk 
									WHERE produk.kategori_produk = '$kategori' AND lead_time_datang.tgl_lead_time >= '$start' AND lead_time_datang.tgl_lead_time <= '$end'");
	}

	public function get_history_pembelian($id){
		$this->db->select('order.no_po,tanggal_po,mitra.nama_mitra,detail_order.*');
		$this->db->join('order', 'order.id_po = detail_order.id_po', 'inner');
		$this->db->join('mitra', 'mitra.id_mitra = order.id_mitra', 'inner');
		$this->db->where('detail_order.id_produk', $id);
		$this->db->order_by('order.tanggal_po', 'desc');
		return $this->db->get('detail_order');
	}

	public function get_kedatangan_by_kode($kode){
		$this->db->where('kode_kedatangan', $kode);
		return $this->db->get('bahan_datang');
	}

	public function save_komplain($data){
		return $this->db->insert('komplain_datang', $data);
	}

	public function get_komplain(){
		return $this->db->get('komplain_datang');
	}

	public function get_komplain_by_month(){
		$this->db->where('MONTH(tanggal_komplain)', date('m'));
		$this->db->where('YEAR(tanggal_komplain)', date('Y'));
		return $this->db->get('komplain_datang');
	}

	public function get_komplain_by_year(){
		$this->db->where('YEAR(tanggal_komplain)', date('Y'));
		return $this->db->get('komplain_datang');
	}

}

/* End of file OrderModel.php */
/* Location: ./application/models/OrderModel.php */