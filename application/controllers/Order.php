<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		if (empty($this->session->userdata('login'))) {
			redirect('Login/index','refresh');
		}

		$this->load->library('form_validation');

		$array = array(
			'active' => ($this->session->userdata('level') == 'spv_purchasing') ? 'dashboard' : 'order' 
		);

		$this->session->set_userdata( $array );
	}

	public function index(){
		$request = $this->uri->segment(3);
		if (!empty($request)) {
			$result['list_po'] = $this->OrderModel->get_daftar_order($request)->result();
			$this->load->view('order/data_order', $result, FALSE);
		}else{
			redirect('Dashboard/index','refresh');
		}
	}

	public function buat(){
		$request = $this->uri->segment(3);
		if (!empty($request)) {
			if ($request == 'Baku') {
				$kode = 'BHB';
			}elseif ($request == 'Kemas') {
				$kode = 'KMS';
			}elseif ($request == 'Teknik') {
				$kode = 'TKP';
			}

			$nomor = $this->OrderModel->get_count_kode($request)->num_rows();
			if (empty($nomor)) {
				$kode_awal = '001';
			}else{
				$kode_akhir = $nomor+1;
				if ($nomor < 10) {
					$kode_awal = "00".$kode_akhir;
				}elseif ($nomor < 100) {
					$kode_awal = "0".$kode_akhir;
				}elseif ($nomor >= 100) {
					$kode_awal = $kode_akhir;
				}
			}
			$result['produk'] = $this->ProdukModel->get_produk($request)->result();
			$result['kode'] = $kode;
			$result['nomor'] = $kode_awal;
			$this->load->view('order/buat_order', $result, FALSE);
		}else{
			redirect('Dashboard/index','refresh');
		}
	}

	function validation(){
		$this->form_validation->set_rules('tgl_order', 'Tanggal Order', 'required');
		$this->form_validation->set_rules('no_po', 'No. Purchase Order', 'required');
		$this->form_validation->set_rules('tgl_loading', 'Lead Time', 'required');
		$this->form_validation->set_rules('tgl_pengiriman', 'Tgl. Pengiriman', 'required');
	}

	public function simpan(){
		$request = $this->uri->segment(3);
		if (!empty($request)) {
			$this->validation();
			if ($this->form_validation->run() == FALSE) {
				redirect("Order/index/$request");
			} else {
				$id_po = "PO-".date("Ymdhis");
				$dataOrder = [
					'id_po' => $id_po,
					'id_user' => $this->session->userdata('id_user'),
					'id_mitra'=> $this->input->post('mitra', true),
					'tanggal_po'=> $this->input->post('tgl_order', true),
					'no_po'=> $this->input->post('no_po', true),
					'tujuan'=> $this->input->post('tujuan', true),
					'lead_time'=> $this->input->post('tgl_loading', true),
					'tanggal_pengiriman'=> $this->input->post('tgl_pengiriman', true),
					'catatan'=> $this->input->post('catatan', true),
					'subtotal'=> $this->input->post('subtotal', true),
					'jenis_pajak'=> $this->input->post('pilih_pajak', true),
					'pajak'=> $this->input->post('pajak', true),
					'total_harga'=> $this->input->post('total_keseluruhan', true),
					'status_po'=> 'Belum',
					'catatan_approve'=> '',
					'tanggal_approve'=> '',
					'acc_spv'=> 'Belum',
					'catatan_spv'=> '',
					'tanggal_acc_spv'=> ''
				];
				$this->OrderModel->simpan_order($dataOrder);
				
				$id_produk= $this->input->post('id_produk', true);
				$kuantitas= $this->input->post('kuantitas', true);
				$satuan= $this->input->post('satuan', true);
				$mata_uang= $this->input->post('mata_uang', true);
				$harga= $this->input->post('harga', true);
				$kurs= $this->input->post('kurs', true);
				$jumlah= $this->input->post('jumlah', true);

				foreach ($id_produk as $index => $value) {
					$dataDetailOrder = [
						'id_po'=> $id_po,
						'id_produk'=> $value,
						'kuantitas'=> $kuantitas[$index],
						'satuan'=> $satuan[$index],
						'mata_uang'=> $mata_uang[$index],
						'harga'=> $harga[$index],
						'kurs'=> $kurs[$index],
						'jumlah'=> $jumlah[$index],
						'status'=> 'Belum'
					];	
					$this->OrderModel->simpan_detail_order($dataDetailOrder);
				}
				redirect("Order/index/$request",'refresh');	
			}
		}else{
			redirect('dashboard/index','refresh');
		}
	}

	public function hapus(){
		$id = $this->uri->segment(3);
		if (!empty($id)) {
			$tipe = $this->OrderModel->get_tipe_order($id)->row();
			if ($tipe->tipe_mitra == 'Bahan Baku') {
				$request = 'Baku';
			}elseif ($tipe->tipe_mitra == 'Kemas') {
				$request = 'Kemas';
			}elseif ($tipe->tipe_mitra == 'Teknik') {
				$request = 'Teknik';
			}
			$this->OrderModel->delete_order($id);
			redirect("Order/index/$request",'refresh');
		}else{
			redirect("Dashboard/index",'refresh');
		}
	}

	public function detail(){
		$id = $this->uri->segment(3);
		if (!empty($id)) {
			$tipe = $this->OrderModel->get_tipe_order($id)->row();
			if ($tipe->tipe_mitra == 'Bahan Baku') {
				$request = 'Baku';
			}elseif ($tipe->tipe_mitra == 'Kemas') {
				$request = 'Kemas';
			}elseif ($tipe->tipe_mitra == 'Teknik') {
				$request = 'Teknik';
			}
			$result['detail_po'] = $this->OrderModel->get_detail_order($id)->row();
			$result['detail_bahan'] = $this->OrderModel->get_bahan_detail($id)->result();
			$result['mitra'] = $this->MitraModel->get_mitra($request)->result();
			$result['produk'] = $this->ProdukModel->get_produk($request)->result();
			$result['tipe'] = $tipe->tipe_mitra;
			$this->load->view('order/detail_order', $result, FALSE);
		}else{
			redirect('Dashboard/index','refresh');
		}
	}

	public function edit(){
		$id = $this->uri->segment(3);
		if (!empty($id)) {
			$tipe = $this->OrderModel->get_tipe_order($id)->row();
			if ($tipe->tipe_mitra == 'Bahan Baku') {
				$request = 'Baku';
			}elseif ($tipe->tipe_mitra == 'Kemas') {
				$request = 'Kemas';
			}elseif ($tipe->tipe_mitra == 'Teknik') {
				$request = 'Teknik';
			}
			$result['detail_po'] = $this->OrderModel->get_detail_order($id)->result();
			$result['detail_bahan'] = $this->OrderModel->get_bahan_detail($id)->result();
			$result['mitra'] = $this->MitraModel->get_mitra($request)->result();
			$result['produk'] = $this->ProdukModel->get_produk($request)->result();
			$result['request'] = $request;
			$this->load->view('order/edit_order', $result, FALSE);
		}else{
			redirect('Dashboard/index','refresh');
		}
	}

	public function update(){
		$request = $this->input->post('request');
		$this->validation();
		if ($this->form_validation->run() == FALSE) {
			redirect("Order/index/$request");
		} else {
			$id_po = $this->input->post('id_po');
			$id_mitra = $this->input->post('mitra');
			if (empty($id_mitra)) {
				$id_mitra = $this->input->post('mitra_temp');
			}
			$this->OrderModel->delete_detail_order($id_po);
			$dataOrder = [
				'id_mitra'=> $id_mitra,
				'tanggal_po'=> $this->input->post('tgl_order', true),
				'no_po'=> $this->input->post('no_po', true),
				'tujuan'=> $this->input->post('tujuan', true),
				'lead_time'=> $this->input->post('tgl_loading', true),
				'tanggal_pengiriman'=> $this->input->post('tgl_pengiriman', true),
				'catatan'=> $this->input->post('catatan', true),
				'subtotal'=> $this->input->post('subtotal', true),
				'jenis_pajak'=> $this->input->post('pilih_pajak', true),
				'pajak'=> $this->input->post('pajak', true),
				'total_harga'=> $this->input->post('total_keseluruhan', true),
				'status_po'=> 'Belum',
				'catatan_approve'=> ''
			];
			$this->OrderModel->update_order($id_po, $dataOrder);

			$id_produk= $this->input->post('id_produk', true);
			$kuantitas= $this->input->post('kuantitas', true);
			$satuan= $this->input->post('satuan', true);
			$mata_uang= $this->input->post('mata_uang', true);
			$harga= $this->input->post('harga', true);
			$kurs= $this->input->post('kurs', true);
			$jumlah= $this->input->post('jumlah', true);

			if ((empty($satuan)) || (empty($mata_uang))) {
				echo "<script language='javascript'>alert('Periksa satuan atau mata uang!');</script>";
				redirect("Order/detail/$id_po",'refresh');
			}else {
				foreach ($id_produk as $index => $value) {
				$dataDetailOrder = [
					'id_po'=> $id_po,
					'id_produk'=> $value,
					'kuantitas'=> $kuantitas[$index],
					'satuan'=> $satuan[$index],
					'mata_uang'=> $mata_uang[$index],
					'harga'=> $harga[$index],	
					'kurs'=> $kurs[$index],
					'jumlah'=> $jumlah[$index],
					'status'=> 'Belum'
				];	
				$this->OrderModel->simpan_detail_order($dataDetailOrder);
			}
			}
		}
		redirect("Order/index/$request",'refresh');
	}

	public function bahan_datang(){
		$request = $this->uri->segment(3);
		if (!empty($request)) {
			$array = array(
				'active' => $active_now = ($this->session->userdata('level') == 'direktur') ? 'dashboard' : 'order_datang' 
			);
			$this->session->set_userdata( $array );
			$result['list_po'] = $this->OrderModel->get_order_datang($request)->result();
			$this->load->view('order/order_datang', $result, FALSE);
		}else{
			redirect('dashboard/index','refresh');
		}
	}

	public function list_bahan($request = null){
		// $request = $this->uri->segment(3);
		if (!empty($request) && $request == 'Baku' || $request == 'Kemas' || $request == 'Teknik') {
			$data = $this->OrderModel->get_max_kode()->row();
			$result['kode'] = (!is_null($data)) ? $data->kode_kedatangan : '-';
			$result['kategori'] = $request;
			$result['detail_bahan'] = $this->OrderModel->get_list_bahan($request)->result();
			$this->load->view('order/list_bahan', $result, FALSE);
		}else{
			redirect('dashboard','refresh');
		}
	}

	public function bahan_gudang(){
		$id = $this->uri->segment(3);
		if (!empty($id)) {
			$array = array(
				'active' => 'order_datang'
			);
			$this->session->set_userdata( $array );
			$status = "";
			$no_po = $this->OrderModel->get_no_po($id)->row()->no_po;
			if (strpos($no_po, 'BHB') !== false) {
				$status = 'Baku';
			}
			$data = $this->OrderModel->get_max_kode()->row();
			$result['kode'] = (!is_null($data)) ? $data->kode_kedatangan : '-';
			$result['no_po'] = $no_po;
			$result['status'] = $status;
			$result['detail_bahan'] = $this->OrderModel->get_bahan_gudang($id)->result();
			$this->load->view('order/list_bahan_gudang', $result, FALSE);
		}else{
			redirect('dashboard','refresh');
		}
	}

	public function json_detail(){
		$id = $this->input->post('id');
		$result = $this->OrderModel->detail_by_id($id)->result();
		echo json_encode($result);
	}

	public function update_datang(){
		$id_po = $this->input->post('id_detail_po');
		$id_bahan_datang = "DTG-".date('Ymdhis');
		$id_detail = $this->input->post('id_detail_order');
		$jumlah_order = $this->input->post('kuantitas');
		$sudah_datang = $this->input->post('sudah_datang');
		$bahan_datang = $this->input->post('bahan_datang');
		$tgl_datang = $this->input->post('tanggal_datang');
		$keterangan = $this->input->post('keterangan_datang');
		$no_surat_jalan = $this->input->post('no_surat_jalan');
		$no_batch_datang = $this->input->post('no_batch_datang');
		$kode_kedatangan = $this->input->post('kode_kedatangan');
		$exp_date = $this->input->post('exp_date');
		$total_datang = $sudah_datang+$bahan_datang;
		$bahan_kurang = $jumlah_order-$total_datang;
		$status = ($total_datang == $jumlah_order) ? 'Sudah' : 'Partial';

		$data_datang = [
			'id_bahan_datang' => $id_bahan_datang,
			'id_detail_order' => $id_detail,
			'no_surat_jalan' => $no_surat_jalan,
			'no_urut_surat_jalan' => '',
			'keterangan_surat_jalan' => '',
			'tanggal_kedatangan' => $tgl_datang,
			'no_batch_kedatangan' => $no_batch_datang,
			'kode_kedatangan' => $kode_kedatangan,
			'jumlah_kedatangan' => $bahan_datang,
			'expired_date' => $exp_date,
			'keterangan_kedatangan' => $keterangan,
			'acc_qc' => 'Belum',
			'pindah_stok' => 'Belum'
		];

		$this->OrderModel->save_kedatangan($data_datang);

		$update_datang = [
			'datang' => $total_datang,
			'kurang' => $bahan_kurang,
			'status' => $status
		];

		$this->OrderModel->update_detail_datang($id_detail,$update_datang);

		$qty_kedatangan = $this->input->post('qty_datang');
		$unique_id = $this->input->post('unique_id');
		$isi_kedatangan = $this->input->post('isi_datang');
		$satuan_kedatangan = $this->input->post('satuan_datang');
		$kemasan_kedatangan = $this->input->post('kemasan_datang');
		$subtotal_kedatangan = $this->input->post('subtotal_datang');

		foreach ($qty_kedatangan as $key => $value) {
			$arr_detail_datang = [
				'id_bahan_datang' => $id_bahan_datang,
				'qty_kedatangan' => $value,
				'isi_kedatangan' => $isi_kedatangan[$key],
				'satuan_kedatangan' => $satuan_kedatangan[$key],
				'kemasan_kedatangan' => $kemasan_kedatangan[$key],
				'subtotal_kedatangan' => $subtotal_kedatangan[$key]
			];

			$id_detail_kedatangan = $this->OrderModel->save_detail_datang($arr_detail_datang);

			for ($i=0; $i < $value ; $i++) { 
				$id_qr = $unique_id[$key]."-".$i;
				$qr_kedatangan = [
					'id_detail_qr_kedatangan' => $id_qr,
					'id_detail_kedatangan' => $id_detail_kedatangan,
					'qr_kedatangan' => "https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=$id_qr",
					'isi_per_kemasan' => $isi_kedatangan[$key]
				];
				
				$this->OrderModel->save_qr_datang($qr_kedatangan);
			}
		}

		$mdata = $this->OrderModel->get_lead_time_verifikasi($id_detail, $tgl_datang)->num_rows();
		if ($mdata > 0) {
			$this->OrderModel->delete_lead_time_verifikasi($id_detail, $tgl_datang);
		}

		redirect("order/cetak_penerimaan/$id_bahan_datang",'refresh');
	}

	public function ubah_datang(){
		// echo json_encode($this->input->post());
		$id_detail = $this->input->post('id_detail_order');
		$id_bahan_datang = $this->input->post('id_kedatangan_edit');
		$jumlah_order = $this->input->post('kuantitas');
		$sudah_datang = $this->input->post('sudah_datang');
		$bahan_datang_lama = $this->input->post('bahan_datang_lama');
		$bahan_datang = $this->input->post('bahan_datang');
		$tgl_datang = $this->input->post('tanggal_datang');
		$keterangan = $this->input->post('keterangan_datang');
		$no_surat_jalan = $this->input->post('no_surat_jalan');
		$no_batch_datang = $this->input->post('no_batch_datang');
		$kode_kedatangan = $this->input->post('kode_kedatangan');
		$exp_date = $this->input->post('exp_date');
		$total_datang = $sudah_datang-$bahan_datang_lama+$bahan_datang;
		$bahan_kurang = $jumlah_order-$total_datang;
		$status = ($total_datang == $jumlah_order) ? 'Sudah' : 'Partial';

		$data_datang = [
			'no_surat_jalan' => $no_surat_jalan,
			'tanggal_kedatangan' => $tgl_datang,
			'no_batch_kedatangan' => $no_batch_datang,
			'kode_kedatangan' => $kode_kedatangan,
			'jumlah_kedatangan' => $bahan_datang,
			'expired_date' => $exp_date,
			'keterangan_kedatangan' => $keterangan
		];

		$this->OrderModel->update_bahan_datang($id_bahan_datang,$data_datang);

		$update_datang = [
			'datang' => $total_datang,
			'kurang' => $bahan_kurang,
			'status' => $status
		];

		$this->OrderModel->update_detail_datang($id_detail,$update_datang);
		
		$this->OrderModel->delete_detail_datang($id_bahan_datang);

		$qty_kedatangan = $this->input->post('qty_datang');
		$unique_id = $this->input->post('unique_id');
		$isi_kedatangan = $this->input->post('isi_datang');
		$satuan_kedatangan = $this->input->post('satuan_datang');
		$kemasan_kedatangan = $this->input->post('kemasan_datang');
		$subtotal_kedatangan = $this->input->post('subtotal_datang');

		foreach ($qty_kedatangan as $key => $value) {

			$arr_detail_datang = [
				'id_bahan_datang' => $id_bahan_datang,
				'qty_kedatangan' => $value,
				'isi_kedatangan' => $isi_kedatangan[$key],
				'satuan_kedatangan' => $satuan_kedatangan[$key],
				'kemasan_kedatangan' => $kemasan_kedatangan[$key],
				'subtotal_kedatangan' => $subtotal_kedatangan[$key]
			];

			$id_detail_kedatangan = $this->OrderModel->save_detail_datang($arr_detail_datang);

			for ($i=0; $i < $value ; $i++) { 
				$id_qr = $unique_id[$key]."-".$i;
				$qr_kedatangan = [
					'id_detail_qr_kedatangan' => $id_qr,
					'id_detail_kedatangan' => $id_detail_kedatangan,
					'qr_kedatangan' => "https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=$id_qr",
					'isi_per_kemasan' => $isi_kedatangan[$key]
				];
				
				$this->OrderModel->save_qr_datang($qr_kedatangan);
			}
		}

		redirect("order/cetak_penerimaan/$id_bahan_datang",'refresh');
	}

	public function order_pilih(){
		$request = $this->uri->segment(3);
		$tipe = $this->session->userdata('kategori');
		if (!empty($request)) {
			$result['list_po'] = $this->OrderModel->get_order_by_status($request,$tipe)->result();
			$this->load->view('order/po_status', $result, FALSE);
		}else{
			redirect('dashboard/index','refresh');
		}
	}

	public function cetak(){
		$id = $this->uri->segment(3);
		if (!empty($id)) {
			$tipe = $this->OrderModel->get_tipe_order($id)->row();
			$row_po = $this->OrderModel->get_detail_order($id)->row();
			$nomor_po = $row_po->no_po;
			$output_file = str_replace('/', '', $nomor_po);

			$result['detail_po'] = $this->OrderModel->get_detail_order($id)->row();
			$result['detail_bahan'] = $this->OrderModel->get_bahan_detail($id)->result();
			$result['tipe'] = $tipe->tipe_mitra;
			$result['colspan'] = ($tipe->tipe_mitra == 'Kemas') ? '7' : '6';
			$this->pdf->setPaper('A4','potrait');
			$this->pdf->filename = "$output_file";
			$this->pdf->load_view('order/po_pdf',$result);
			// echo json_encode($result);
		}else{
			redirect('dashboard/index','refresh');
		}
	}

	public function datang(){
		$request = $this->uri->segment(3);
		$tipe = $this->session->userdata('kategori');
		if (!empty($request)) {
			$array = array(
				'active' => $active_now = ($this->session->userdata('level') == 'direktur' || $this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier' || $this->session->userdata('level') == 'spv_purchasing') ? 'dashboard' : 'order' 
			);
			$this->session->set_userdata( $array );
			$result['detail_bahan'] = $this->OrderModel->get_kedatangan($request,$tipe)->result();
			$this->load->view('order/request_datang', $result, FALSE);
		}else{
			redirect('Dashboard/index','refresh');
		}
	}

	public function bahan_order(){
		$request = $this->session->userdata('kategori');
		$result['detail_bahan'] = $this->OrderModel->get_bahan_order($request)->result();
		$this->load->view('order/bahan_order', $result, FALSE);
	}

	public function get_json_kategori(){
		$request = $this->input->post('kategori');
		$array = array('kategori' => $request);
		$this->session->set_userdata( $array );
		echo json_encode($request);
	}

	public function get_json_nopo(){
		$id = $this->input->post('id');
		$result = $this->OrderModel->get_no_po_by_detail($id)->result();
		echo json_encode($result);
	}

	public function update_surat_jalan(){
		$id_bahan_datang = $this->input->post('id_bahan_datang');
		$id_detail_order = $this->input->post('id_detail_datang');
		$acc_qc = $this->input->post('acc_qc_datang');
		$id_produk = $this->input->post('id_produk_datang');
		$no_urut_surat = $this->input->post('no_urut_surat_jalan');
		$ket_surat_jalan = $this->input->post('ket_surat_jalan');

		$arr_surat = [
			'no_urut_surat_jalan' => $no_urut_surat,
			'keterangan_surat_jalan' => $ket_surat_jalan
		];

		$this->OrderModel->update_bahan_datang($id_bahan_datang,$arr_surat);

		// if ($acc_qc == 'Release') {
		// 	$arr_datang = $this->OrderModel->get_detail_kedatangan($id_bahan_datang)->row();
		// 	$pindah_stok = $arr_datang->pindah_stok;
		// 	if ($pindah_stok == 'Belum') {
		// 		$jumlah_datang = $arr_datang->jumlah_kedatangan;
		// 		$stok_produk = $this->ProdukModel->get_produk_id($id_produk)->row()->stok;
		// 		$total_stok = $jumlah_datang+$stok_produk;

		// 		$arr_new_stok = ['stok' => $total_stok];
		// 		$arr_status_pindah = ['pindah_stok' => 'Sudah'];
		// 		$arr_log_produk = [
		// 			'id_produk' => $id_produk,
		// 			'tanggal_log' => date('Y-m-d H:i:s'),
		// 			'shift_log' => '1',
		// 			'deskripsi_log' => $ket_surat_jalan,
		// 			'in_log' => $jumlah_datang,
		// 			'out_log' => 0,
		// 			'balance_log' => $total_stok
		// 		];
		// 		$this->ProdukModel->update_stok($id_produk,$arr_new_stok);
		// 		$this->OrderModel->update_bahan_datang($id_bahan_datang,$arr_status_pindah);
		// 		$this->LogModel->save_log_produk($arr_log_produk);
		// 	}
		// }

		redirect("order/riwayat_datang/$id_detail_order",'refresh');
	}

	public function update_sj_dashboard(){
		// echo json_encode($this->input->post());
		$id_bahan_datang = $this->input->post('id_bahan_datang');
		$id_detail_order = $this->input->post('id_detail_datang');
		$acc_qc = $this->input->post('acc_qc_datang');
		$id_produk = $this->input->post('id_produk_datang');
		$no_urut_surat = $this->input->post('no_urut_surat_jalan');
		$ket_surat_jalan = $this->input->post('ket_surat_jalan');

		$arr_surat = [
			'no_urut_surat_jalan' => $no_urut_surat,
			'keterangan_surat_jalan' => $ket_surat_jalan
		];

		$this->OrderModel->update_bahan_datang($id_bahan_datang,$arr_surat);

		// if ($acc_qc == 'Release') {
		// 	$arr_datang = $this->OrderModel->get_detail_kedatangan($id_bahan_datang)->row();
		// 	$pindah_stok = $arr_datang->pindah_stok;
		// 	if ($pindah_stok == 'Belum') {
		// 		$jumlah_datang = $arr_datang->jumlah_kedatangan;
		// 		$stok_produk = $this->ProdukModel->get_produk_id($id_produk)->row()->stok;
		// 		$total_stok = $jumlah_datang+$stok_produk;

		// 		$arr_new_stok = ['stok' => $total_stok];
		// 		$arr_status_pindah = ['pindah_stok' => 'Sudah'];
		// 		$arr_log_produk = [
		// 			'id_produk' => $id_produk,
		// 			'tanggal_log' => date('Y-m-d H:i:s'),
		// 			'shift_log' => '1',
		// 			'deskripsi_log' => $ket_surat_jalan,
		// 			'in_log' => $jumlah_datang,
		// 			'out_log' => 0,
		// 			'balance_log' => $total_stok
		// 		];
		// 		$this->ProdukModel->update_stok($id_produk,$arr_new_stok);
		// 		$this->OrderModel->update_bahan_datang($id_bahan_datang,$arr_status_pindah);
		// 		$this->LogModel->save_log_produk($arr_log_produk);
		// 	}
		// }
		redirect("order/validate/purchasing",'refresh');
	}

	public function acc_stok($id){
		$data_temp = $this->OrderModel->get_detail_kedatangan($id)->row();
		$id_produk = $data_temp->id_produk;
		$arr_release = [ 
						'id_user' => $this->session->userdata('id_user'), 
						'acc_qc' => 'Release' , 
						'tanggal_acc_qc' => date('Y-m-d'), 
						'catatan_acc_qc' => '-'
		];

		$this->OrderModel->update_bahan_datang($id,$arr_release);


		$pindah_stok = $data_temp->pindah_stok;
		if ($pindah_stok == 'Belum') {
			$jumlah_datang = $data_temp->jumlah_kedatangan;
			$stok_produk = $this->ProdukModel->get_produk_id($id_produk)->row()->stok;
			$total_stok = $jumlah_datang+$stok_produk;

			$arr_new_stok = ['stok' => $total_stok];
			$arr_status_pindah = ['pindah_stok' => 'Sudah'];
			$arr_log_produk = [
				'id_produk' => $id_produk,
				'tanggal_log' => date('Y-m-d H:i:s'),
				'shift_log' => '1',
				'deskripsi_log' => $data_temp->keterangan_kedatangan,
				'in_log' => $jumlah_datang,
				'out_log' => 0,
				'balance_log' => $total_stok
			];
			$this->ProdukModel->update_stok($id_produk,$arr_new_stok);
			$this->OrderModel->update_bahan_datang($id,$arr_status_pindah);
			$this->LogModel->save_log_produk($arr_log_produk);
		}

		redirect("order/cetak_validasi/$id",'refresh');
	}

	public function reject_stok(){		
		$id = $this->input->post('id');
		$catatan = $this->input->post('catatan');
		$arr_reject = 	[ 
							'id_user' => $this->session->userdata('id_user'), 
							'acc_qc' => 'Reject' , 
							'tanggal_acc_qc' => date('Y-m-d'), 
							'catatan_acc_qc' => $catatan
						];
		$update = $this->OrderModel->update_bahan_datang($id,$arr_reject);
		if ($update) {
			$num_month = $this->OrderModel->get_komplain_by_month()->num_rows()+1;
			if ($num_month <= 10) {
				$kode_bulan = "00$num_month";
			}else if ($num_month > 10 && $num_month <= 99) {
				$kode_bulan = "0$num_month";
			}else if ($num_month > 99 && $num_month <= 1000) {
				$kode_bulan = "$num_month";
			}

			$num_year = $this->OrderModel->get_komplain_by_year()->num_rows()+1;
			if ($num_year <= 10) {
				$kode_tahun = "00$num_year";
			}else if ($num_year > 10 && $num_year <= 99) {
				$kode_tahun = "0$num_year";
			}else if ($num_year > 99 && $num_year <= 1000) {
				$kode_tahun = "$num_year";
			}

			$bulan = $this->month_formatter(date('m'));
			$format = $kode_tahun."/".$bulan."/".$kode_bulan."/".date('Y');
			$arr_komplain = [
				'id_bahan_datang' => $id,
				'tanggal_komplain' => date('Y-m-d'),
				'no_komplain' => $format
			];
			$this->OrderModel->save_komplain($arr_komplain);
			$response['status'] = 'success';
			$response['url'] = base_url()."order/komplain/$id";
		}else{
			$response['status'] = 'failed';
			// $response['status'] = base_url().'dashboard';
		}
		echo json_encode($response);
	}

	private function month_formatter($month){
		$my_month = "A";
		if($month == '01'){
			$my_month = "A";
		}else if ($month == '02') {
			$my_month = "B";
		}else if ($month == '03') {
			$my_month = "C";
		}else if ($month == '04') {
			$my_month = "D";
		}else if ($month == '05') {
			$my_month = "E";
		}else if ($month == '06') {
			$my_month = "F";
		}else if ($month == '07') {
			$my_month = "G";
		}else if ($month == '08') {
			$my_month = "H";
		}else if ($month == '09') {
			$my_month = "I";
		}else if ($month == '10') {
			$my_month = "J";
		}else if ($month == '11') {
			$my_month = "K";
		}else if ($month == '12') {
			$my_month = "L";
		}
		return $my_month;
	}

	private function kode_formatter($kategori){
		if ($kategori == 'Baku') {
			$kode = 'BHB';
		}else if ($kategori == 'Kemas') {
			$kode = 'KMS';
		}else if ($kategori == 'Teknik') {
			$kode = 'TKP';
		}
		return $kode;
	}

	public function komplain($id){
		if (!empty($id)) {
			$result['data'] = $this->OrderModel->get_komplain_produk($id)->row();
			$this->pdf->setPaper('A4','potrait');
			$this->pdf->filename = "FORM KOMPLAIN BAHAN";
			$this->pdf->load_view('qc/validasi/form_komplain',$result);
		}
	}

	public function json_send_komplain(){
		$id = $this->input->post('id');
		$result = $this->OrderModel->get_komplain_produk($id)->row();
		if (!empty($result) && !is_null($result)) {
			$response['status'] = '1'; 
		}else{
			$response['status'] = '0'; 
		}
		echo json_encode($response);
	}

	public function retur($id){
		if (!empty($id)) {
			$kategori = $this->OrderModel->get_kedatangan_by_id($id)->row()->kategori_produk;
			$num_retur = $this->OrderModel->get_retur()->num_rows()+1;
			if ($num_retur <= 10) {
				$kode = "00$num_retur";
			}else if ($num_retur > 10 && $num_retur <= 99) {
				$kode = "0$num_retur";
			}else if ($num_retur > 99 && $num_retur <= 1000) {
				$kode = "$num_retur";
			}
			$arr_retur = [
				'id_bahan_datang' => $id,
				'tanggal_retur' => date('Y-m-d'),
				'no_retur' => $kode."/".$this->kode_formatter($kategori)."/".$this->numberToRomanRepresentation(date('m'))."/".date('Y')
			];
			$this->OrderModel->save_retur($arr_retur);
			$result['data'] = $this->OrderModel->get_komplain_produk($id)->row();
			$result['retur'] = $this->OrderModel->get_retur_by_kedatangan($id)->row();
			$this->pdf->setPaper('A4','potrait');
			$this->pdf->set_option('isHtml5ParserEnabled', true);
			$this->pdf->set_option('isRemoteEnabled', true);
			$this->pdf->filename = "FORM RETUR BAHAN";
			$this->pdf->load_view('qc/validasi/form_retur',$result);
			// echo json_encode($arr_retur);
		}
	}

	private function numberToRomanRepresentation($number) {
		$map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
		$returnValue = '';
		while ($number > 0) {
			foreach ($map as $roman => $int) {
				if($number >= $int) {
					$number -= $int;
					$returnValue .= $roman;
					break;
				}
			}
		}
		return $returnValue;
	}

	public function karantina_stok(){
		$id = $this->input->post('id');
		$catatan = $this->input->post('catatan');
		$arr_karantina = [ 'acc_qc' => 'Karantina' , 'catatan_acc_qc' => $catatan];
		$this->OrderModel->update_bahan_datang($id,$arr_karantina);
		$response['status'] = 'success';
		echo json_encode($response);
	}

	public function cetak_proses(){
		$id_detail = $this->input->post('id_detail');
		$id_po = $this->input->post('id_po');
		$no_surat_jalan = $this->input->post('no_surat_jalan_proses');
		$arr_detail = array();

		foreach ($id_detail as $key => $value) {
			$data_detail = $this->OrderModel->get_proses_id($value)->row();
			array_push($arr_detail, $data_detail);
		}

		$num_cetak = $this->OrderModel->get_cetak_proses()->num_rows();
		if ($num_cetak < 10) {
			$no_urut = "00$num_cetak";
		}elseif ($num_cetak >= 10) {
			$no_urut = "0$num_cetak";
		}elseif ($num_cetak >= 100) {
			$no_urut = $num_cetak;
		}

		$result['data_po'] = $this->OrderModel->get_detail_order($id_po)->row();
		$result['data_detail'] = $arr_detail;
		$result['no_surat_jalan'] = $no_surat_jalan;
		$result['no_urut'] = $no_urut;
		$nomor_po = $this->OrderModel->get_detail_order($id_po)->row()->no_po;
		$output_file = str_replace('/', '', $nomor_po);
		$this->pdf->setPaper('A4','potrait');
		$this->pdf->filename = "$output_file";
		$this->pdf->load_view('gudang/cetak/proses_pdf',$result);
	}

	public function cetak_penerimaan($id){
		if (!empty($id)) {
			$kemasan = "";
			$jumlah = "";
			$result['data_bahan'] = $this->OrderModel->get_penerimaan_produk($id)->row();
			$data_qc = $this->OrderModel->get_user_penerimaan($id)->row();
			if(!empty($data_qc)){
				if ($data_qc->acc_qc == 'Belum') {
					$result['status'] = '';
				}else{
					$result['status'] = $data_qc->acc_qc." oleh ".$data_qc->nama_user." tanggal ".date('d/m/Y', strtotime($data_qc->tanggal_acc_qc));
				}
			}else{
				$result['status'] = '';
			}
			$detail_penerimaan = $this->OrderModel->get_detail_penerimaan($id)->result();
			foreach ($detail_penerimaan as $value) {
				$kemasan .= $value->kemasan_kedatangan.';';
				$jumlah .= $value->qty_kedatangan.'@'.$value->isi_kedatangan.$value->satuan_kedatangan.';';
			}
			$kemasan_trim = rtrim($kemasan,';');
			$jumlah_trim = rtrim($jumlah,';');
			$result['kemasan'] = $kemasan_trim;
			$result['jumlah'] = $jumlah_trim;
			$output_file = $result['data_bahan']->kode_produk;
			$this->pdf->setPaper('A4','potrait');
			$this->pdf->filename = "$output_file";
			$this->pdf->load_view('gudang/cetak/penerimaan_pdf',$result);
			echo json_encode($result);
		}else{
			redirect('dashboard','refresh');
		}
	}

	public function riwayat_datang($id){
		$array = array(
			'active' => $active_now = ($this->session->userdata('level') == 'direktur') ? 'dashboard' : 'order_datang' 
		);
		$this->session->set_userdata( $array );
		$result['nama_bahan'] = $this->OrderModel->get_proses_id($id)->row()->nama_produk;
		$result['list_history'] = $this->OrderModel->get_riwayat_datang($id)->result();
		$this->load->view('order/riwayat_datang', $result, FALSE);
	}

	public function json_kedatangan(){
		$id_bahan_datang = $this->input->post('id');
		$result = $this->OrderModel->get_detail_kedatangan($id_bahan_datang)->row();
		echo json_encode($result);
	}

	public function simpan_urut_cetak(){
		$id_po = $this->input->post('id');
		$arr_cetak = [
			'id_po' => $id_po,
			'kode_cetak' => date('d/m/Y'),
			'tanggal_cetak' => date('Y-m-d')
		];
		$this->OrderModel->save_cetak_proses($arr_cetak);
		$result = ['status' => '1'];
		echo json_encode($result);
	}

	public function history_kedatangan($request){
		if (!empty($request) && $request == 'Baku' || $request == 'Kemas' || $request == 'Teknik') {
			$array = array(
				'active' => 'riwayat_datang'
			);
			$this->session->set_userdata( $array );
			$result['kategori'] = $request;
			$tanggal = date('Y-m-d', strtotime("-1 days"));
			if ($this->session->userdata('level') == 'purchasing') {
				$result['list_kedatangan'] = $this->OrderModel->get_history_kedatangan($request, $tanggal)->result();
			}else{
				$result['list_kedatangan'] = $this->OrderModel->get_history_kedatangan_gudang($request, $tanggal)->result();
			}
			$result['status'] = $request;
			$this->load->view('gudang/riwayat/data_riwayat', $result, FALSE);
		}else{
			redirect('dashboard','refresh');
		}
	}

	public function cari_history(){
		$array = array(
			'active' => 'riwayat_datang'
		);
		$this->session->set_userdata( $array );

		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$kategori = $this->input->post('kategori');

		$result['list_kedatangan'] = $this->OrderModel->get_history_range($start_date, $end_date, $kategori)->result();  
		$result['start'] = $start_date;
		$result['end'] = $end_date;
		$result['kategori'] = $kategori;  
		$result['status'] = $kategori;
		$this->load->view('gudang/riwayat/cari_riwayat', $result, FALSE);
	}

	public function json_detail_kedatangan(){
		$id_bahan_datang = $this->input->post('id');
		$result['data_kedatangan'] = $this->OrderModel->get_kedatangan_by_id($id_bahan_datang)->row();
		$result['detail_kedatangan'] = $this->OrderModel->get_detail_penerimaan($id_bahan_datang)->result();
		echo json_encode($result);
	}

	public function hapus_riwayat($id){
		$result_kedatangan = $this->OrderModel->get_kedatangan_by_id($id)->row();
		$id_detail_order = $result_kedatangan->id_detail_order;
		$kategori = $result_kedatangan->kategori_produk;
		$jumlah_order = $result_kedatangan->kuantitas;
		$bahan_datang = $result_kedatangan->jumlah_kedatangan;
		$sudah_datang = $result_kedatangan->datang;

		$jumlah_datang = $sudah_datang-$bahan_datang;
		$kurang_datang = $jumlah_order-$jumlah_datang;
		$status = ($jumlah_datang == $jumlah_order) ? 'Sudah' : 'Partial';
		$arr_jumlah = ['datang' => $jumlah_datang, 'kurang' => $kurang_datang, 'status' => $status];

		$this->OrderModel->update_detail_datang($id_detail_order,$arr_jumlah);
		$this->OrderModel->delete_bahan_datang($id);
		redirect("order/history_kedatangan/$kategori",'refresh');
	}

	public function validasi($request){
		if (!empty($request) && $request == 'Baku' || $request == 'Kemas' || $request == 'Selesai') {
			$array = array(
				'active' => 'order_datang'
			);
			$this->session->set_userdata( $array );
			$result['kategori'] = $request;
			$result['validasi'] = $this->OrderModel->get_validasi_status($request)->result();
			$this->load->view('gudang/validasi/validasi_status', $result, FALSE);
		}else{
			redirect('dashboard','refresh');
		}
	}

	public function validate($request){
		if (!empty($request) && $request == 'purchasing' || $request == 'qc') {
			$array = array(
				'active' => 'dashboard'
			);
			$this->session->set_userdata( $array );
			$result['departemen'] = $request;
			$result['kategori'] = $this->session->userdata('kategori');
			$result['validasi'] = $this->OrderModel->get_validasi_departemen($request, $result['kategori'])->result();
			$this->load->view('gudang/validasi/validasi_status', $result, FALSE);
		}else{
			redirect('dashboard','refresh');
		}
	}

	public function history_validasi($request){
		if (!empty($request) && $request == 'Baku' || $request == 'Kemas') {
			$array = array(
				'active' => 'history_qc'
			);
			$this->session->set_userdata( $array );
			$result['kategori'] = $request;
			$result['satuan_bahan'] = ($request == 'Baku') ? 'Kg' : 'Pieces';
			$result['release'] = $this->OrderModel->get_history_validasi('Release',$request)->result();
			$result['reject'] = $this->OrderModel->get_history_validasi('Reject',$request)->result();
			$this->load->view('qc/validasi/history_validasi', $result, FALSE);
		}else{
			redirect('dashboard','refresh');
		}
	}

	public function list_karantina($request){
		if (!empty($request) && $request == 'Baku' || $request == 'Kemas') {
			$array = array(
				'active' => ($this->session->userdata('level') == 'qc' || $this->session->userdata('level') == 'direktur') ? 'karantina_qc' : 'dashboard'
			);
			$this->session->set_userdata( $array );
			$result['kategori'] = $request;
			$result['satuan_bahan'] = ($request == 'Baku') ? 'Kg' : 'Pieces';
			$result['karantina'] = $this->OrderModel->get_history_validasi('Karantina',$request)->result();
			$this->load->view('qc/validasi/list_karantina', $result, FALSE);
		}else{
			redirect('dashboard','refresh');
		}
	}

	public function qr_datang(){
		$kategori = $this->session->userdata('kategori');
	}

	public function json_ekspor_riwayat(){
		$kategori = $this->input->post('kategori');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$result = $this->OrderModel->get_history_ekspor($bulan,$tahun,$kategori)->result();
		echo json_encode($result);
	}

	public function validasi_status($request){
		if (!empty($request) && $request == 'Reject' || $request == 'Release' || $request == 'Belum') {
			$array = array(
				'active' => 'dashboard'
			);
			$this->session->set_userdata( $array );
			$kategori = $this->session->userdata('kategori');
			$result['status'] = $request;
			$result['kategori'] = $kategori;
			$result['satuan'] = ($kategori == 'Baku') ? 'Kg' : 'Pieces';
			$result['list_validasi'] = $this->OrderModel->get_history_validasi($request,$kategori)->result();
			$this->load->view('qc/validasi/validasi_status', $result, FALSE);
		}else{
			redirect('dashboard','refresh');
		}
	}

	public function cetak_validasi($id){
		// $customPaper = array(0,0,567.00,283.80);
		// $customPaper = array(0,0,177.7,316.7);
		$customPaper = array(0,0,300,650);
		$result['kedatangan'] = $this->OrderModel->get_penerimaan_produk($id)->row();
		$result['detail_kedatangan'] = $this->OrderModel->get_detail_qr_release($id)->result();
		$result['data'] = 9;
		if (!empty($result['detail_kedatangan']) && !empty($result['detail_kedatangan'])) {
			$this->pdf->setPaper($customPaper,'landscape');
			$this->pdf->set_option('isHtml5ParserEnabled', true);
			$this->pdf->set_option('isRemoteEnabled', true);
			$this->pdf->filename = "DOKUMEN VALIDASI";
			$this->pdf->load_view('qc/validasi/new_validasi_pdf',$result);
		}
		// echo json_encode($result);
	}

	public function json_cetak_release(){
		$id = $this->input->post('id');
		$result = $this->OrderModel->get_detail_qr_release($id)->result();
		if (!empty($result) && !is_null($result)) {
			$response['status'] = '1';
		}else{
			$response['status'] = '0';
		}
		echo json_encode($response);
	}

	public function json_chart(){
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$status = $this->input->post('status');

		$num_baku = "";
		$num_kemas = "";
		$num_teknik = "";

		if ($status == 'Belum') {
			$num_baku = $this->OrderModel->get_acc_by_date($bulan,$tahun,'Baku')->num_rows();
			$num_kemas = $this->OrderModel->get_acc_by_date($bulan,$tahun,'Kemas')->num_rows();
			$num_teknik = $this->OrderModel->get_acc_by_date($bulan,$tahun,'Teknik')->num_rows();
		}elseif ($status == 'Reminder') {
			$num_baku = $this->OrderModel->get_reminder_by_date($bulan,$tahun,'Baku')->num_rows();
			$num_kemas = $this->OrderModel->get_reminder_by_date($bulan,$tahun,'Kemas')->num_rows();
			$num_teknik = $this->OrderModel->get_reminder_by_date($bulan,$tahun,'Teknik')->num_rows();
		}elseif ($status == 'Terlambat') {
			$num_baku = $this->OrderModel->get_late_by_date($bulan,$tahun,'Baku')->num_rows();
			$num_kemas = $this->OrderModel->get_late_by_date($bulan,$tahun,'Kemas')->num_rows();
			$num_teknik = $this->OrderModel->get_late_by_date($bulan,$tahun,'Teknik')->num_rows();
		}

		$arr['num_baku'] = $num_baku;
		$arr['num_kemas'] = $num_kemas;
		$arr['num_teknik'] = $num_teknik;

		
		echo json_encode($arr);
	}

	public function json_validasi_daily(){
		$status = $this->input->post('status');
		$kategori = $this->input->post('kategori');
		$list = array();
		$month = date('m');
		$year = date('Y');
		$num_day = cal_days_in_month(CAL_GREGORIAN,$month,$year);

		for($d=1; $d<= $num_day; $d++)
		{
		    $time=mktime(12, 0, 0, $month, $d, $year);          
		    if (date('m', $time) == $month)       
		    	$mlist = array(
		    		'tanggal' => date('l d/m/Y', $time),
		    		'value' =>  $this->OrderModel->get_daily_validasi(date('Y-m-d', $time), $kategori, $status)->row()->jumlah
		    	);
		    array_push($list, $mlist);
		}

		echo json_encode($list);	
	}

	public function json_validasi_daily_range(){
		$start = $this->input->post('start');
		$end = $this->input->post('end');
		$kategori = $this->input->post('kategori');
		$status = $this->input->post('status');
		$mresult = array();

		$new_end = new DateTime($end);
		$new_end->modify('+1 day');

		$period = new DatePeriod(
		     new DateTime($start),
		     new DateInterval('P1D'),
		    $new_end
		);

		foreach ($period as $key => $value) {
		    $mlist = array(
	    		'tanggal' => $value->format('l d/m/Y'),
	    		'value' =>  $this->OrderModel->get_daily_validasi($value->format('Y-m-d'), $kategori, $status)->row()->jumlah
	    	);
	    	array_push($mresult, $mlist);
		}

		echo json_encode($mresult);
	}

	public function json_validasi_weekly(){
		$kategori = $this->input->post('kategori');
		$status = $this->input->post('status');

		$data_week_1 = $this->OrderModel->get_weekly_validasi('1', $kategori, $status)->row();
		$data_week_2 = $this->OrderModel->get_weekly_validasi('2', $kategori, $status)->row();
		$data_week_3 = $this->OrderModel->get_weekly_validasi('3', $kategori, $status)->row();
		$data_week_4 = $this->OrderModel->get_weekly_validasi('4', $kategori, $status)->row();

		$pertama = (empty($data_week_1->value)) ? '0' : $data_week_1->value;
		$kedua = (empty($data_week_2->value)) ? '0' : $data_week_2->value;
		$ketiga = (empty($data_week_3->value)) ? '0' : $data_week_3->value;
		$keempat = (empty($data_week_4->value)) ? '0' : $data_week_4->value;

		$result['week_1'] = $pertama;
		$result['week_2'] = $kedua;
		$result['week_3'] = $ketiga;
		$result['week_4'] = $keempat;

		echo json_encode($result);	
	}

	public function json_validasi_weekly_range(){
		$kategori = $this->input->post('kategori');
		$status = $this->input->post('status');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');

		$data_week_1 = $this->OrderModel->get_weekly_validasi_range('1', $kategori, $status, $bulan, $tahun)->row();
		$data_week_2 = $this->OrderModel->get_weekly_validasi_range('2', $kategori, $status, $bulan, $tahun)->row();
		$data_week_3 = $this->OrderModel->get_weekly_validasi_range('3', $kategori, $status, $bulan, $tahun)->row();
		$data_week_4 = $this->OrderModel->get_weekly_validasi_range('4', $kategori, $status, $bulan, $tahun)->row();

		$pertama = (empty($data_week_1->value)) ? '0' : $data_week_1->value;
		$kedua = (empty($data_week_2->value)) ? '0' : $data_week_2->value;
		$ketiga = (empty($data_week_3->value)) ? '0' : $data_week_3->value;
		$keempat = (empty($data_week_4->value)) ? '0' : $data_week_4->value;

		$result['week_1'] = $pertama;
		$result['week_2'] = $kedua;
		$result['week_3'] = $ketiga;
		$result['week_4'] = $keempat;

		echo json_encode($result);	
	}

	public function json_validasi_monthly(){
		$kategori = $this->input->post('kategori');
		$status = $this->input->post('status');

		for ($i=1; $i < 13; $i++) { 
			$response["month_$i"] = $this->OrderModel->get_monthly_validasi("0$i",$kategori, $status)->row()->jumlah;
		}

		echo json_encode($response);
	}

	public function json_validasi_monthly_range(){
		$kategori = $this->input->post('kategori');
		$status = $this->input->post('status');
		$tahun = $this->input->post('tahun');

		for ($i=1; $i < 13; $i++) { 
			$response["month_$i"] = $this->OrderModel->get_monthly_validasi_range("0$i",$kategori, $status, $tahun)->row()->jumlah;
		}

		echo json_encode($response);
	}

	public function json_lead_daily(){
		$kategori = $this->input->post('kategori');
		$list = array();
		$month = date('m');
		$year = date('Y');
		$num_day = cal_days_in_month(CAL_GREGORIAN,$month,$year);

		for($d=1; $d<= $num_day; $d++)
		{
		    $time=mktime(12, 0, 0, $month, $d, $year);          
		    if (date('m', $time) == $month)       
		    	$mlist = array(
		    		'tanggal' => date('l d/m/Y', $time),
		    		'value' =>  $this->OrderModel->get_daily_lead(date('Y-m-d', $time), $kategori)->row()->jumlah
		    	);
		    array_push($list, $mlist);
		}

		echo json_encode($list);	
	}

	public function json_lead_daily_range(){
		$start = $this->input->post('start');
		$end = $this->input->post('end');
		$kategori = $this->input->post('kategori');
		$mresult = array();

		$new_end = new DateTime($end);
		$new_end->modify('+1 day');

		$period = new DatePeriod(
		     new DateTime($start),
		     new DateInterval('P1D'),
		    $new_end
		);

		foreach ($period as $key => $value) {
		    $mlist = array(
	    		'tanggal' => $value->format('l d/m/Y'),
	    		'value' =>  $this->OrderModel->get_daily_lead($value->format('Y-m-d'), $kategori)->row()->jumlah
	    	);
	    	array_push($mresult, $mlist);
		}

		echo json_encode($mresult);
	}

	public function json_lead_weekly(){
		$kategori = $this->input->post('kategori');

		$data_week_1 = $this->OrderModel->get_weekly_lead('1', $kategori)->row();
		$data_week_2 = $this->OrderModel->get_weekly_lead('2', $kategori)->row();
		$data_week_3 = $this->OrderModel->get_weekly_lead('3', $kategori)->row();
		$data_week_4 = $this->OrderModel->get_weekly_lead('4', $kategori)->row();

		$pertama = (empty($data_week_1->value)) ? '0' : $data_week_1->value;
		$kedua = (empty($data_week_2->value)) ? '0' : $data_week_2->value;
		$ketiga = (empty($data_week_3->value)) ? '0' : $data_week_3->value;
		$keempat = (empty($data_week_4->value)) ? '0' : $data_week_4->value;

		$result['week_1'] = $pertama;
		$result['week_2'] = $kedua;
		$result['week_3'] = $ketiga;
		$result['week_4'] = $keempat;

		echo json_encode($result);	
	}

	public function json_lead_weekly_range(){
		$kategori = $this->input->post('kategori');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');

		$data_week_1 = $this->OrderModel->get_weekly_lead_range('1', $kategori, $bulan, $tahun)->row();
		$data_week_2 = $this->OrderModel->get_weekly_lead_range('2', $kategori, $bulan, $tahun)->row();
		$data_week_3 = $this->OrderModel->get_weekly_lead_range('3', $kategori, $bulan, $tahun)->row();
		$data_week_4 = $this->OrderModel->get_weekly_lead_range('4', $kategori, $bulan, $tahun)->row();

		$pertama = (empty($data_week_1->value)) ? '0' : $data_week_1->value;
		$kedua = (empty($data_week_2->value)) ? '0' : $data_week_2->value;
		$ketiga = (empty($data_week_3->value)) ? '0' : $data_week_3->value;
		$keempat = (empty($data_week_4->value)) ? '0' : $data_week_4->value;

		$result['week_1'] = $pertama;
		$result['week_2'] = $kedua;
		$result['week_3'] = $ketiga;
		$result['week_4'] = $keempat;

		echo json_encode($result);	
	}

	public function json_lead_monthly(){
		$kategori = $this->input->post('kategori');

		for ($i=1; $i < 13; $i++) { 
			$response["month_$i"] = $this->OrderModel->get_monthly_lead("0$i",$kategori)->row()->jumlah;
		}

		echo json_encode($response);
	}

	public function json_lead_monthly_range(){
		$kategori = $this->input->post('kategori');
		$tahun = $this->input->post('tahun');

		for ($i=1; $i < 13; $i++) { 
			$response["month_$i"] = $this->OrderModel->get_monthly_lead_range("0$i",$kategori, $tahun)->row()->jumlah;
		}

		echo json_encode($response);
	}

	public function lead_time($id){
		if (!empty($id)) {
			$array = array(
				'active' => 'order_datang' 
			);
			$this->session->set_userdata( $array );
			$result['nama_bahan'] = $this->OrderModel->get_proses_id($id)->row()->nama_produk;
			$result['lead_time'] = $this->OrderModel->get_lead_time($id)->result();
			$result['id'] = $id;
			$this->load->view('order/lead_time', $result, FALSE);
		}
	}

	public function simpan_lead(){
		$id_detail_order = $this->input->post('id_detail_order');
		$tanggal =$this->input->post('tanggal_lead');
		$jumlah =$this->input->post('jumlah_kedatangan');
		$satuan =$this->input->post('satuan_kedatangan');
		$aksi =$this->input->post('aksi');

		$arr_lead_time = [
			'id_detail_order' => $id_detail_order,
			'tgl_lead_time' => $tanggal,
			'jumlah_kedatangan' => $jumlah,
			'satuan_lead_time' => $satuan
		];

		if ($aksi == 'tambah') {
			$this->OrderModel->save_lead_time($arr_lead_time);
		}elseif ($aksi == 'edit') {
			$id_lead = $this->input->post('id_lead_time');
			$this->OrderModel->update_lead_time($id_lead, $arr_lead_time);
		}
		
		redirect("order/lead_time/$id_detail_order",'refresh');
		
	}

	public function hapus_lead($id){
		if (!empty($id)) {
			$id_detail = $this->OrderModel->get_lead_time_id($id)->row()->id_detail_order;
			$this->OrderModel->delete_lead_time($id);
			redirect("order/lead_time/$id_detail",'refresh');
		}
	}

	public function json_lead_time(){
		$id = $this->input->post('id');
		$result = $this->OrderModel->get_lead_time_id($id)->row();
		echo json_encode($result);
	}

	public function json_cek_kode_kedatangan(){
		$kode = $this->input->post('kode');
		$num_kode = $this->OrderModel->get_kedatangan_by_kode($kode)->num_rows();
		echo json_encode($num_kode);
	}

	public function json_cek_komplain(){
		$id = $this->input->post('id');
		$num_komplain = $this->OrderModel->get_komplain_produk($id)->num_rows();
		echo json_encode($num_komplain);
	}

	public function json_detail_qr_mutasi(){
		$id = $this->input->post('id');
		$keterangan = $this->input->post('keterangan');
		$response = array();

		$data = $this->OrderModel->get_qr_datang_mutasi($id)->row();
		if (!is_null($data)) {
			$kategori = $data->kategori_produk;
			$response['kategori'] = $kategori;
			$arr = explode("-", $data->id_detail_qr_kedatangan, 2);
			$first = $arr[0];
			$second = $arr[1];
			$html = "<tr id='id$data->id_detail_qr_kedatangan'>";
			$html .= "<td><input type='checkbox' name='record' class='form-control form-control-sm'><input type='hidden' name='id_qr[]' value='".$data->id_detail_qr_kedatangan."'><input type='hidden' name='id_produk[]' value='".$data->id_produk."'><input type='hidden' name='id_bahan_datang[]' value='".$data->id_bahan_datang."'></td>";
			$html .= "<td><input type='text' name='nama_produk[]' placeholder='Nama Bahan Baku' required='' class='form-control' value='".$data->nama_produk."' readonly=''></td>";
			$html .= "<td><input type='text' name='analisa_mutasi_lain[]' placeholder='No. Analisa' required='' class='form-control' value='".$data->kode_kedatangan."' readonly></td>";
			$html .= "<td><input type='number' onkeyup='cek_stok($first,$second)' step='.001' name='diserahkan[]' placeholder='Diserahkan' required='' class='form-control' value='".$data->isi_per_kemasan."' readonly></td>";
			$html .= "<td><select class='form-control' name='satuan_diserahkan[]' onchange='cek_stok($first,$second)' required readonly><option value='KG'>KG</option><option value='Gram'>Gram</option><option value='Pieces'>Pcs</option><option value='Roll'>Roll</option></select></td>";
			$html .= "<td><input type='number' step='.001' name='dikembalikan[]' placeholder='Dikembalikan' class='form-control' value='' readonly></td>";
			$html .= "<td><select class='form-control' name='satuan_dikembalikan[]' readonly><option value='KG'>KG</option><option value='Gram'>Gram</option><option value='Pieces'>Pcs</option><option value='Roll'>Roll</option></select></td><td><input type='number' step='.001' name='reject[]' placeholder='Reject' class='form-control' value='' readonly></td>";
			$html .= "<td><select class='form-control' name='satuan_reject[]' readonly><option value='KG'>KG</option><option value='Gram'>Gram</option><option value='Pieces'>Pcs</option><option value='Roll'>Roll</option></select><input type='hidden' name='qty_kemasan[]' value='".$data->isi_per_kemasan."'></td></tr>";
			if ($keterangan == 'PENYERAHAN') {
				if ($data->isi_per_kemasan != 0.000) {
					$response['status'] = '1';
					$response['message'] = $html;
				}else{
					$response['status'] = '0';
					$response['message'] = "Isi kemasan $data->id_detail_qr_kedatangan dengan nama produk $data->nama_produk adalah $data->isi_per_kemasan, tidak dapat melakukan penyerahan !";
				}
			}elseif ($keterangan == 'PENGEMBALIAN') {
				if ($kategori == 'Baku') {
					if ($data->isi_per_kemasan == 0.000) {
						$response['status'] = '1';
						$response['message'] = $html;
					}else{
						$response['status'] = '0';
						$response['message'] = "Isi kemasan $data->id_detail_qr_kedatangan dengan nama produk $data->nama_produk adalah $data->isi_per_kemasan, tidak dapat melakukan pengembalian !";
					}
				}else{
					$response['status'] = '1';
					$response['message'] = $html;
				}
			}
		}else{
			$response['status'] = '0';
			$response['message'] = 'Invalid QR Code';
		}
		echo json_encode($response);	
	}

	public function json_detail_qr_penjualan(){
		$id = $this->input->post('id');

		$data = $this->OrderModel->get_qr_datang_mutasi($id)->row();
		if (!is_null($data)) {
			$kategori = $data->kategori_produk;
			$response['kategori'] = $kategori;
			$arr = explode("-", $data->id_detail_qr_kedatangan, 2);
			$first = $arr[0];
			$second = $arr[1];
			$html = "<tr id='id$data->id_detail_qr_kedatangan'>";
			$html .= "<td><input type='checkbox' name='record' class='form-control form-control-sm'><input type='hidden' name='id_qr[]' value='".$data->id_detail_qr_kedatangan."'><input type='hidden' name='id_produk[]' value='".$data->id_produk."'><input type='hidden' name='id_bahan_datang[]' value='".$data->id_bahan_datang."'></td>";
			$html .= "<td><input type='text' name='nama_produk[]' placeholder='Nama Bahan Baku' required='' class='form-control' value='".$data->nama_produk."' readonly=''></td>";
			$html .= "<td><input type='text' name='analisa_mutasi_lain[]' placeholder='No. Analisa' required='' class='form-control' value='".$data->kode_kedatangan."' readonly></td>";
			$html .= "<td><input type='number' step='.001' name='diserahkan[]' placeholder='Diserahkan' required='' class='form-control' value='".$data->isi_per_kemasan."' readonly onkeyup='cek_stok($first,$second)'><input type='hidden' name='qty_kemasan[]' value='".$data->isi_per_kemasan."'></td>";
			$html .= "<td><select class='form-control' name='satuan_diserahkan[]' onchange='cek_stok($first,$second)' required><option value='KG'>KG</option><option value='Gram'>Gram</option><option value='Pieces'>Pcs</option><option value='Roll'>Roll</option></select></td>";
			$html .= "</tr>";
			if ($data->isi_per_kemasan != 0.000) {
				$response['status'] = '1';
				$response['message'] = $html;
			}else{
				$response['status'] = '0';
				$response['message'] = "Isi kemasan $data->id_detail_qr_kedatangan dengan nama produk $data->nama_produk adalah $data->isi_per_kemasan, tidak dapat melakukan penyerahan !";
			}
		}else{
			$response['status'] = '0';
			$response['message'] = 'Invalid QR Code';
		}
		echo json_encode($response);	
	}

	public function list_validasi(){
		$result['validasi_baku'] = $this->OrderModel->get_bahan_validasi('Baku')->result();
		$result['validasi_kemas'] = $this->OrderModel->get_bahan_validasi('Kemas')->result();
		$this->load->view('qc/validasi/data_validasi', $result, FALSE);
	}

}

/* End of file Order.php */
/* Location: ./application/controllers/Order.php */