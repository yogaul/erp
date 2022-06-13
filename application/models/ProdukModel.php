<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProdukModel extends CI_Model {

	private $tableName = 'produk';
	public $id_produk;
	public $kode_produk;
	public $id_mitra;
	public $nama_produk;
	public $jenis_harga;
	public $harga_bahan;
	public $moq_bahan;
	public $kategori_produk;
	public $deskripsi_produk;
	// public $kuantitas;
	//public $unit;
	// public $harga_beli;
	public $foto_produk = 'default.jpg';
	public $label_halal;

	public function get_produk($request){
		$this->db->select('produk.*,mitra.no_mitra,nama_mitra,tipe_mitra');
		$this->db->join('mitra', 'mitra.id_mitra = produk.id_mitra', 'inner');
		if ($request == 'Baku') {
			$this->db->where('kategori_produk', 'Baku');
		}elseif ($request == 'Kemas') {
			$this->db->where('kategori_produk', 'Kemas');
		}elseif ($request == 'Teknik') {
			$this->db->where('kategori_produk', 'Teknik');
		}
		$this->db->order_by('produk.kode_produk', 'asc');
		return $this->db->get($this->tableName);
	}

	public function get_all_produk(){
		$this->db->select('id_produk,kode_produk,nama_produk,kategori_produk,stok,mitra.id_mitra,no_mitra,nama_mitra');
		$this->db->join('mitra', 'mitra.id_mitra = produk.id_mitra', 'inner');
		$this->db->order_by('produk.kode_produk', 'asc');
		return $this->db->get('produk');
	}

	public function get_produk_limit(){
		$where = "produk.stok <= produk.limit_stok";
		$this->db->select('produk.*,mitra.no_mitra,nama_mitra,tipe_mitra');
		$this->db->join('mitra', 'mitra.id_mitra = produk.id_mitra', 'inner');
		$this->db->where($where);
		$this->db->order_by('produk.kode_produk', 'asc');
		return $this->db->get($this->tableName);
	}

	public function get_produk_exp(){
		return $this->db->query("SELECT detail_order.id_po,produk.kode_produk,produk.nama_produk,bahan_datang.expired_date,bahan_datang.sisa_stok_kedatangan ,
								detail_qr_kedatangan.qr_kedatangan,detail_qr_kedatangan.id_detail_qr_kedatangan FROM detail_order 
								inner join produk on produk.id_produk = detail_order.id_produk 
								inner join bahan_datang on bahan_datang.id_detail_order = detail_order.id_Detail_order 
								inner join detail_kedatangan on bahan_datang.id_bahan_datang = detail_kedatangan.id_bahan_datang
								inner join detail_qr_kedatangan on detail_kedatangan.id_detail_kedatangan = detail_qr_kedatangan.id_detail_kedatangan
								where bahan_datang.sisa_stok_kedatangan is not null and bahan_datang.sisa_stok_kedatangan != 0 and 
								bahan_datang.expired_date between (CURDATE() - INTERVAL 90 DAY) and CURDATE()
								group by detail_order.id_detail_order");
	}

	public function get_produk_exp_monthly($month){
		return $this->db->query("SELECT detail_order.id_po,mitra.nama_mitra,produk.kode_produk,produk.nama_produk,bahan_datang.expired_date,
								bahan_datang.sisa_stok_kedatangan ,detail_qr_kedatangan.id_detail_qr_kedatangan 
								FROM detail_order inner join produk on produk.id_produk = detail_order.id_produk 
								inner join bahan_datang on bahan_datang.id_detail_order = detail_order.id_detail_order 
								inner join detail_kedatangan on bahan_datang.id_bahan_datang = detail_kedatangan.id_bahan_datang 
								inner join detail_qr_kedatangan on detail_kedatangan.id_detail_kedatangan = detail_qr_kedatangan.id_detail_kedatangan 
								inner join `order` on `order`.id_po = detail_order.id_po 
								inner join mitra on mitra.id_mitra = `order`.id_mitra 
								where bahan_datang.sisa_stok_kedatangan is not null and bahan_datang.sisa_stok_kedatangan != 0 and  bahan_datang.expired_date 
								between (CURDATE() - INTERVAL 365 DAY) and (CURDATE() + INTERVAL 90 DAY) 
								and MONTH(bahan_datang.expired_date) = '$month' AND YEAR(bahan_datang.expired_date) = YEAR(NOW())
								group by detail_order.id_detail_order");
	}

	public function get_count_produk(){
		return $this->db->get($this->tableName)->num_rows();
	}

	public function get_produk_id($id){
		// $this->db->select('produk.*,kategori.nama_kategori');
		// $this->db->join('kategori', 'kategori.id_kategori = produk.id_kategori', 'inner');
		$this->db->where('id_produk', $id);
		return $this->db->get($this->tableName);
	}

	public function get_nomor($request){
		if ($request == 'Baku') {
			$this->db->where('kategori_produk', 'Baku');
		}elseif ($request == 'Kemas') {
			$this->db->where('kategori_produk', 'Kemas');
		}elseif ($request == 'Teknik') {
			$this->db->where('kategori_produk', 'Teknik');
		}
		$this->db->order_by('kode_produk', 'desc');
		return $this->db->get('produk', 1, 0);
	}

	public function rules()
    {
        return [
            ['field' => 'kode_produk',
            'label' => 'kode_produk',
            'rules' => 'required'],

            ['field' => 'nama_produk',
            'label' => 'nama_produk',
            'rules' => 'required']
        ];
    }

	public function insert(){
		$this->kode_produk = $this->input->post('kode_produk');
		$this->nama_produk = $this->input->post('nama_produk');
		$this->jenis_harga = $this->input->post('jenis_harga');
		$this->harga_bahan = $this->input->post('harga_bahan');
		$this->moq_bahan = $this->input->post('moq_bahan');
		$this->deskripsi_produk = $this->input->post('deskripsi_produk');
		$this->id_mitra = $this->input->post('supplier');
		$this->foto_produk = $this->_upload_image();
		$this->kategori_produk = $this->uri->segment(3);
		$this->label_halal = "Belum";
		$this->db->insert($this->tableName, $this);
	}

	private function _upload_image(){
		$config['upload_path']          = './uploads/produk/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['file_name']            = $this->kode_produk;
		$config['overwrite']			= true;
		$config['max_size']             = 1024; // 1MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$image_path = base_url().'uploads/produk/';

		if ($this->upload->do_upload('foto_produk')) {
			$upload_data = $this->upload->data("file_name");
			return $image_path.$upload_data;
		}else{
			return $image_path."default.jpg";
		}	
	}

	private function _delete_image($id){
		$produk = $this->get_produk_id($id)->result();
	    foreach ($produk as $value) {
	    	$foto_parts = pathinfo($value->foto_produk);
	    	$foto = $foto_parts['basename'];
	    	if ($foto != "default.jpg") {
			    $filename = explode(".", $foto)[0];
				return array_map('unlink', glob(FCPATH."uploads/produk/$filename.*"));
		    }
	    }
	}

	public function update(){
		$this->id_produk = $this->input->post('id_produk');
		$this->kode_produk = $this->input->post('kode_produk');
		$this->nama_produk = $this->input->post('nama_produk');
		$this->jenis_harga = $this->input->post('jenis_harga');
		$this->harga_bahan = $this->input->post('harga_bahan');
		$this->moq_bahan = $this->input->post('moq_bahan');
		$this->id_mitra = $this->input->post('supplier');
		$this->deskripsi_produk = $this->input->post('deskripsi_produk');

		if (!empty($_FILES["foto_produk"]["name"])) {
			$this->foto_produk = $this->_upload_image();
		}else {
		    $this->foto_produk = $this->input->post('old_image');
		}
		
		$data_update = array(
			'kode_produk' => $this->kode_produk,
			'nama_produk' => $this->nama_produk,
			'id_mitra' => $this->id_mitra,
			'deskripsi_produk' => $this->deskripsi_produk,
			'jenis_harga' => $this->jenis_harga,
			'harga_bahan' => $this->harga_bahan,
			'moq_bahan' => $this->moq_bahan,
			'foto_produk' => $this->foto_produk
		);
		$this->db->update($this->tableName, $data_update, array('id_produk' => $this->id_produk));
	}

	public function delete($id){
		$this->_delete_image($id);
		return $this->db->delete($this->tableName,array('id_produk' => $id));
	}

	public function get_bahan_ekspor($request){
		$this->db->select('produk.*,mitra.id_mitra,no_mitra,nama_mitra');
		$this->db->join('mitra', 'mitra.id_mitra = produk.id_mitra', 'inner');
		$this->db->where('produk.kategori_produk', $request);
		return $this->db->get($this->tableName);
	}

	public function update_stok($id,$data){
		$this->db->where('id_produk', $id);
		return $this->db->update($this->tableName, $data);
	}

	public function get_produk_by_kode($kode){
		$this->db->where('kode_produk', $kode);
		return $this->db->get($this->tableName);
	}

	public function get_in_produk($id, $bulan, $tahun){
		return $this->db->query("SELECT SUM(in_log) AS jumlah_masuk FROM log_bahan WHERE id_produk = '$id' AND deskripsi_log LIKE '%PENGEMBALIAN%'
								AND MONTH(tanggal_log) = '$bulan' AND YEAR(tanggal_log) = '$tahun'");
	}

	public function get_datang_produk($id, $bulan, $tahun){
		return $this->db->query("SELECT SUM(in_log) AS jumlah_datang FROM log_bahan WHERE id_produk = '$id' AND deskripsi_log NOT LIKE '%PENGEMBALIAN%'
								AND MONTH(tanggal_log) = '$bulan' AND YEAR(tanggal_log) = '$tahun'");
	}

	public function get_out_produk($id, $bulan, $tahun){
		return $this->db->query("SELECT SUM(out_log) AS jumlah_keluar FROM log_bahan WHERE id_produk = '$id' AND MONTH(tanggal_log) = '$bulan'
								AND YEAR(tanggal_log) = '$tahun'");
	}

}

/* End of file ProdukModel.php */
/* Location: ./application/models/ProdukModel.php */