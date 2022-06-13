<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KomplainModel extends CI_Model {

	private $tableName = 'customer_response';

	public function save_komplain($data){
		return $this->db->insert($this->tableName, $data);
	}	

	public function get_komplain(){
		return $this->db->get($this->tableName);
	}

	public function get_data_daily($tanggal){
		return $this->db->query("select count(id_customer_response) as jumlah from customer_response where DATE(tanggal_komplain) = '$tanggal' AND YEAR(tanggal_komplain) = YEAR(NOW())");
	}

	public function get_range_daily($start, $end){
		return $this->db->query("select DATE(tanggal_komplain) as tanggal, count(tanggal_komplain) as jumlah from customer_response where tanggal_komplain >= '$start' AND tanggal_komplain <= '$end' group by DATE(tanggal_komplain)");
	}

	public function get_data_weekly($num){
		return $this->db->query("SELECT CONCAT(FLOOR(((DAY(`tanggal_komplain`) - 1) / 7) + 1)) `month & week`, COUNT(`tanggal_komplain`) AS `value` FROM customer_response WHERE CONCAT(FLOOR(((DAY(`tanggal_komplain`) - 1) / 7) + 1)) = $num AND MONTH(`tanggal_komplain`) = MONTH(NOW()) AND YEAR(`tanggal_komplain`) = YEAR(NOW()) GROUP BY `month & week` ORDER BY MONTH(`tanggal_komplain`), `month & week`");
	}

	public function get_weekly_range($num, $bulan, $tahun){
		return $this->db->query("SELECT CONCAT(FLOOR(((DAY(`tanggal_komplain`) - 1) / 7) + 1)) `month & week`, COUNT(`tanggal_komplain`) AS `value` FROM customer_response WHERE CONCAT(FLOOR(((DAY(`tanggal_komplain`) - 1) / 7) + 1)) = $num AND MONTH(`tanggal_komplain`) = '$bulan' AND YEAR(`tanggal_komplain`) = '$tahun' GROUP BY `month & week` ORDER BY MONTH(`tanggal_komplain`), `month & week`");
	}

	public function get_monthly_chart($bulan){
		return $this->db->query("select count(id_customer_response) as jumlah from customer_response where MONTH(tanggal_komplain) = '$bulan' AND YEAR(tanggal_komplain) = YEAR(NOW())");
	}

	public function get_monthly_range($bulan, $tahun){
		return $this->db->query("select count(id_customer_response) as jumlah from customer_response where MONTH(tanggal_komplain) = '$bulan' AND YEAR(tanggal_komplain) = '$tahun'");
	}

}

/* End of file KomplainModel.php */
/* Location: ./application/models/KomplainModel.php */