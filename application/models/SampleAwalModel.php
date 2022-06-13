<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SampleAwalModel extends CI_Model {

	private $tableName = 'sample_awal';
	public $id_sample_awal;
	public $nama_customer_awal;
	public $telp_customer_awal;
	public $alamat_customer_awal;
	public $tanggal_request_awal;
	public $permintaan_sample_awal;
	public $spesifikasi_sample_awal;
	public $target_harga_awal;
	public $foto_sample_awal = 'default.jpg';

	public function rules()
    {
        return [
            ['field' => 'nama_cust',
            'label' => 'Nama Customer',
            'rules' => 'required'],

            ['field' => 'telp_cust',
            'label' => 'Nomor Telepon',
            'rules' => 'required'],

            ['field' => 'alamat_cust',
            'label' => 'Alamat Lengkap',
            'rules' => 'required'],

            ['field' => 'permintaan_sample',
            'label' => 'Permintaan Sample',
            'rules' => 'required'],

            ['field' => 'spesifikasi',
            'label' => 'Spesifikasi (Tekstur, Warna, Aroma)',
            'rules' => 'required']
        ];
    }

	public function save($data){
		return $this->db->insert($this->tableName, $data);
	}

	public function save_acc($data){
		return $this->db->insert('sample_acc', $data);
	}

	public function save_briefing($data){
		return $this->db->insert('briefing_logo', $data);
	}

	public function save_bom_awal($data){
		$this->db->insert('bom_sample', $data);
		return $this->db->insert_id();
	}

	public function save_detail_bom_awal($data){
		return $this->db->insert('detail_bom_sample', $data);
	}

	public function delete($id){
		return $this->db->delete($this->tableName,array('id_sample_awal' => $id));
	}

	public function get_sample_awal(){
		$this->db->select('sample_awal.id_sample_awal,tanggal_request_awal,customer.*,user.id_user,nama_user');
		$this->db->join('customer', 'customer.id_customer = sample_awal.id_customer', 'inner');
		$this->db->join('user', 'user.id_user = sample_awal.id_user', 'left');
		$this->db->group_by('customer.id_customer');
		$this->db->order_by('sample_awal.tanggal_request_awal', 'desc');
		return $this->db->get($this->tableName);
	}

	public function get_sample_by_customer($id){
		$this->db->where('id_customer', $id);
		return $this->db->get('sample_awal');
	}

	public function get_sample_awal_tim($id){
		$this->db->select('sample_awal.id_sample_awal,tanggal_request_awal,customer.*,user.id_user,nama_user');
		$this->db->join('customer', 'customer.id_customer = sample_awal.id_customer', 'inner');
		$this->db->join('user', 'user.id_user = sample_awal.id_user', 'left');
		$this->db->where('user.id_user', $id);
		$this->db->group_by('customer.id_customer');
		$this->db->order_by('sample_awal.tanggal_request_awal', 'ASC');
		return $this->db->get($this->tableName);
	}

	public function get_sample_awal_rnd(){
		$this->db->select('sample_awal.id_sample_awal,tanggal_request_awal,customer.*,user.id_user,nama_user');
		$this->db->join('customer', 'customer.id_customer = sample_awal.id_customer', 'inner');
		$this->db->join('user', 'user.id_user = sample_awal.id_user', 'left');
		$this->db->where('sample_awal.tanggal_request_rnd !=', '0000-00-00 00:00:00');
		$this->db->group_by('customer.id_customer');
		$this->db->order_by('sample_awal.tanggal_request_awal', 'ASC');
		return $this->db->get($this->tableName);
	}

	public function get_list_revisi($id){
		$this->db->where('id_sample_awal', $id);
		$this->db->order_by('tanggal_revisi', 'ASC');
		return $this->db->get('revisi_sample_awal');
	}

	public function get_sample_awal_revisi($id){
		$this->db->select('sample_awal.nama_customer_awal,permintaan_sample_awal,revisi_sample_awal.id_revisi_sample_awal');
		$this->db->join('revisi_sample_awal', 'sample_awal.id_sample_awal = revisi_sample_awal.id_revisi_sample_awal', 'inner');
		return $this->db->get($this->tableName, 1);
	}

	public function get_sample_awal_id($id){
		$this->db->where('id_sample_awal', $id);
		return $this->db->get($this->tableName);
	}

	public function save_revisi($data){
		return $this->db->insert('revisi_sample_awal', $data);
	}

	public function update_revisi($id,$data){
		$this->db->where('id_revisi_sample_awal', $id);
		return $this->db->update('revisi_sample_awal', $data);
	}

	public function update_sample_awal($id,$data){
		$this->db->where('id_sample_awal', $id);
		return $this->db->update($this->tableName, $data);
	}

	public function get_revisi_id($id){
		$this->db->where('id_revisi_sample_awal', $id);
		return $this->db->get('revisi_sample_awal');
	}

	public function get_sample_by_revisi($id){
		$this->db->join('revisi_sample_awal', 'sample_awal.id_sample_awal = revisi_sample_awal.id_sample_awal', 'inner');
		$this->db->where('id_revisi_sample_awal', $id);
		return $this->db->get('sample_awal');
	}

	public function delete_revisi($id){
		$this->db->where('id_revisi_sample_awal', $id);
		return $this->db->delete('revisi_sample_awal');
	}

	public function get_list_request($id){
		$this->db->where('sample_awal.id_customer', $id);
		return $this->db->get($this->tableName);
	}

	public function get_list_request_rnd($id){
		$this->db->where('sample_awal.id_customer', $id);
		$this->db->where('sample_awal.tanggal_request_rnd !=', '0000-00-00 00:00:00');
		return $this->db->get($this->tableName);
	}

	public function get_sample_acc(){
		$this->db->select('customer.nama_customer,brand_produk.nama_brand_produk,user.nama_user,sample_acc.id_sample_acc,nama_produk_acc,volume_produk_acc,target_launching_acc');
		$this->db->join('brand_produk', 'brand_produk.id_brand_produk = sample_acc.id_brand_produk', 'inner');
		$this->db->join('user', 'user.id_user = sample_acc.id_user', 'inner');
		$this->db->join('customer', 'customer.id_customer = brand_produk.id_customer', 'inner');
		return $this->db->get('sample_acc');
	}

	public function get_sample_acc_tim($id){
		$this->db->select('customer.nama_customer,brand_produk.nama_brand_produk,user.nama_user,sample_acc.id_sample_acc,nama_produk_acc,volume_produk_acc,target_launching_acc');
		$this->db->join('brand_produk', 'brand_produk.id_brand_produk = sample_acc.id_brand_produk', 'inner');
		$this->db->join('user', 'user.id_user = sample_acc.id_user', 'inner');
		$this->db->join('customer', 'customer.id_customer = brand_produk.id_customer', 'inner');
		$this->db->where('user.id_user', $id);
		return $this->db->get('sample_acc');
	}

	public function get_detail_sample_acc($id){
		$this->db->select('user.nama_user,customer.*,brand_produk.nama_brand_produk,sample_acc.*');
		$this->db->join('user', 'user.id_user = sample_acc.id_user', 'inner');
		$this->db->join('brand_produk', 'brand_produk.id_brand_produk = sample_acc.id_brand_produk', 'inner');
		$this->db->join('customer', 'customer.id_customer = brand_produk.id_customer', 'inner');
		$this->db->where('sample_acc.id_sample_acc', $id);
		return $this->db->get('sample_acc');
	}

	public function get_acc_by_brand($id){
		$this->db->select('sample_acc.id_sample_acc,nama_produk_acc,volume_produk_acc');
		$this->db->join('brand_produk', 'brand_produk.id_brand_produk = sample_acc.id_brand_produk', 'inner');
		$this->db->where('sample_acc.id_brand_produk', $id);
		return $this->db->get('sample_acc');
	}

	public function get_acc_design_by_brand($id){
		$this->db->select('sample_acc.id_sample_acc,nama_produk_acc,volume_produk_acc,acc_design.id_acc_design');
		$this->db->join('brand_produk', 'brand_produk.id_brand_produk = sample_acc.id_brand_produk', 'inner');
		$this->db->join('acc_design', 'sample_acc.id_sample_acc = acc_design.id_sample_acc', 'inner');
		$this->db->where('sample_acc.id_brand_produk', $id);
		return $this->db->get('sample_acc');
	}

	public function get_acc_by_id($id){
		$this->db->where('id_sample_acc', $id);
		return $this->db->get('sample_acc');
	}

	public function delete_sample_acc($id){
		$this->db->where('id_sample_acc', $id);
		return $this->db->delete('sample_acc');
	}

	public function get_briefing_logo(){
		$this->db->select('customer.nama_customer,briefing_logo.*');
		$this->db->join('customer', 'customer.id_customer = briefing_logo.id_customer', 'inner');
		$this->db->order_by('tanggal_briefing_logo', 'asc');
		return $this->db->get('briefing_logo');
	}

	public function get_briefing_logo_tim($id){
		$this->db->select('customer.nama_customer,briefing_logo.*,sample_awal.id_sample_awal,id_user');
		$this->db->join('customer', 'customer.id_customer = briefing_logo.id_customer', 'inner');
		$this->db->join('sample_awal', 'customer.id_customer = sample_awal.id_customer', 'inner');
		$this->db->where('sample_awal.id_user', $id);
		$this->db->order_by('briefing_logo.tanggal_briefing_logo', 'asc');
		return $this->db->get('briefing_logo');
	}

	public function delete_awal($id){
		$this->db->where('id_customer', $id);
		return $this->db->delete('sample_awal');
	}

	public function delete_briefing($id){
		$this->db->where('id_briefing_logo', $id);
		return $this->db->delete('briefing_logo');
	}

	public function save_log($data){
		return $this->db->insert('log', $data);
	}

	public function get_data_daily($tanggal){
		return $this->db->query("select count(id_sample_awal) as jumlah from sample_awal where DATE(tanggal_request_awal) = '$tanggal' AND YEAR(tanggal_request_awal) = YEAR(NOW())");
	}

	public function get_data_daily_acc($tanggal){
		return $this->db->query("select count(id_sample_acc) as jumlah from sample_acc where DATE(tanggal_sample_acc) = '$tanggal' AND YEAR(tanggal_sample_acc) = YEAR(NOW())");
	}

	public function get_range_daily($start, $end){
		return $this->db->query("select DATE(tanggal_request_awal) as tanggal, count(tanggal_request_awal) as jumlah from sample_awal where tanggal_request_awal >= '$start' AND tanggal_request_awal <= '$end' group by DATE(tanggal_request_awal)");
	}

	public function get_data_weekly($num){
		return $this->db->query("SELECT CONCAT(FLOOR(((DAY(`tanggal_request_awal`) - 1) / 7) + 1)) `month & week`, COUNT(`tanggal_request_awal`) AS `value` FROM sample_awal WHERE CONCAT(FLOOR(((DAY(`tanggal_request_awal`) - 1) / 7) + 1)) = $num AND MONTH(`tanggal_request_awal`) = MONTH(NOW()) AND YEAR(`tanggal_request_awal`) = YEAR(NOW()) GROUP BY `month & week` ORDER BY MONTH(`tanggal_request_awal`), `month & week`");
	}

	public function get_data_weekly_acc($num){
		return $this->db->query("SELECT CONCAT(FLOOR(((DAY(`tanggal_sample_acc`) - 1) / 7) + 1)) `month & week`, COUNT(`tanggal_sample_acc`) AS `value` FROM sample_acc WHERE CONCAT(FLOOR(((DAY(`tanggal_sample_acc`) - 1) / 7) + 1)) = $num AND MONTH(`tanggal_sample_acc`) = MONTH(NOW()) AND YEAR(`tanggal_sample_acc`) = YEAR(NOW()) GROUP BY `month & week` ORDER BY MONTH(`tanggal_sample_acc`), `month & week`");
	}

	public function get_weekly_range($num, $bulan, $tahun){
		return $this->db->query("SELECT CONCAT(FLOOR(((DAY(`tanggal_request_awal`) - 1) / 7) + 1)) `month & week`, COUNT(`tanggal_request_awal`) AS `value` FROM sample_awal WHERE CONCAT(FLOOR(((DAY(`tanggal_request_awal`) - 1) / 7) + 1)) = $num AND MONTH(`tanggal_request_awal`) = '$bulan' AND YEAR(`tanggal_request_awal`) = '$tahun' GROUP BY `month & week` ORDER BY MONTH(`tanggal_request_awal`), `month & week`");
	}

	public function get_weekly_range_acc($num, $bulan, $tahun){
		return $this->db->query("SELECT CONCAT(FLOOR(((DAY(`tanggal_sample_acc`) - 1) / 7) + 1)) `month & week`, COUNT(`tanggal_sample_acc`) AS `value` FROM sample_acc WHERE CONCAT(FLOOR(((DAY(`tanggal_sample_acc`) - 1) / 7) + 1)) = $num AND MONTH(`tanggal_sample_acc`) = '$bulan' AND YEAR(`tanggal_sample_acc`) = '$tahun' GROUP BY `month & week` ORDER BY MONTH(`tanggal_sample_acc`), `month & week`");
	}

	public function get_monthly_chart($bulan){
		return $this->db->query("select count(id_sample_awal) as jumlah from sample_awal where MONTH(tanggal_request_awal) = '$bulan' AND YEAR(tanggal_request_awal) = YEAR(NOW())");
	}

	public function get_monthly_chart_acc($bulan){
		return $this->db->query("select count(id_sample_acc) as jumlah from sample_acc where MONTH(tanggal_sample_acc) = '$bulan' AND YEAR(tanggal_sample_acc) = YEAR(NOW())");
	}

	public function get_monthly_range($bulan, $tahun){
		return $this->db->query("select count(id_sample_awal) as jumlah from sample_awal where MONTH(tanggal_request_awal) = '$bulan' AND YEAR(tanggal_request_awal) = '$tahun'");
	}

	public function get_monthly_range_acc($bulan, $tahun){
		return $this->db->query("select count(id_sample_acc) as jumlah from sample_acc where MONTH(tanggal_sample_acc) = '$bulan' AND YEAR(tanggal_sample_acc) = '$tahun'");
	}

	public function get_detail_sample_awal(){
		$this->db->select('sample_awal.*,customer.*,user.id_user,nama_user');
		$this->db->join('customer', 'customer.id_customer = sample_awal.id_customer', 'inner');
		$this->db->join('user', 'user.id_user = sample_awal.id_user', 'left');
		$this->db->order_by('sample_awal.tanggal_request_awal', 'desc');
		return $this->db->get($this->tableName);
	}

	public function get_bom_sample($id){
		$this->db->select('sample_awal.permintaan_sample_awal,bom_sample.*');
		$this->db->join('sample_awal', 'sample_awal.id_sample_awal = bom_sample.id_sample_awal', 'inner');
		$this->db->where('bom_sample.id_sample_awal', $id);
		return $this->db->get('bom_sample');
	}

	public function get_bom_sample_active($id){
		$this->db->select('sample_awal.permintaan_sample_awal,bom_sample.*');
		$this->db->join('sample_awal', 'sample_awal.id_sample_awal = bom_sample.id_sample_awal', 'inner');
		$this->db->where('bom_sample.id_sample_awal', $id);
		$this->db->where('bom_sample.status_bom_sample', '1');
		return $this->db->get('bom_sample');
	}

	public function update_bom_sample($id,$data){
		$this->db->where('id_bom_sample', $id);
		return $this->db->update('bom_sample', $data);
	}

	public function update_active_bom_sample($status,$data){
		$this->db->where('status_bom_sample', $status);
		return $this->db->update('bom_sample', $data);
	}

	public function get_bom_sample_id($id){
		$this->db->select('sample_awal.*,bom_sample.*');
		$this->db->join('sample_awal', 'sample_awal.id_sample_awal = bom_sample.id_sample_awal', 'inner');
		$this->db->where('bom_sample.id_bom_sample', $id);
		return $this->db->get('bom_sample');
	}

	public function get_detail_bom_awal($id){
        $this->db->select('produk.kode_produk,nama_produk,stok, detail_bom_sample.*');
        $this->db->join('produk', 'produk.id_produk = detail_bom_sample.id_produk', 'inner');
        $this->db->where('detail_bom_sample.id_bom_sample', $id);
        return $this->db->get('detail_bom_sample');
    }

}

/* End of file ProdukModel.php */
/* Location: ./application/models/ProdukModel.php */