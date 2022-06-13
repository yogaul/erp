<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mutasi extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (empty($this->session->userdata('login'))) {
			redirect('Login/index','refresh');
		}
		$this->load->library('form_validation');
		$array = array(
			'active' => 'mutasi'
		);
		$this->session->set_userdata( $array );
	}

	public function index($request = null){
		if (!empty($request)) {
			if ($request == 'Baku' || $request == 'Kemas') {
				$result['data_mutasi'] = $this->MutasiModel->get_mutasi($request)->result();
				$this->load->view('gudang/mutasi/data_mutasi', $result, FALSE);
			}elseif ($request == 'lain') {
				$result['data_mutasi'] = $this->MutasiModel->get_mutasi_lain()->result();
				$this->load->view('gudang/mutasi_lain/data_mutasi_lain', $result, FALSE);
			}elseif ($request == 'penjualan') {
				$result['penjualan'] = $this->MutasiModel->get_mutasi_penjualan()->result();
				$this->load->view('gudang/mutasi_penjualan/data_penjualan', $result, FALSE);
			}else{
				redirect('dashboard','refresh');
			}
		}else{
			redirect('dashboard','refresh');
		}
	}

	public function tambah($request = null){
		if (!empty($request)) {
			if ($request == 'Baku' || $request == 'Kemas') {
				$result['produk'] = $this->ProdukModel->get_produk($request)->result();
				$this->load->view('gudang/mutasi/buat_mutasi', $result, FALSE);
			}elseif ($request == 'lain') {
				$result['produk'] = $this->ProdukModel->get_all_produk()->result();
				$this->load->view('gudang/mutasi_lain/buat_mutasi_lain', $result, FALSE);
			}elseif ($request == 'penjualan') {
				$row_sjp = $this->SjpModel->get_all_sjp()->num_rows();
				$jumlah_sjp = $row_sjp+1;
				
				if ($jumlah_sjp < 10) {
					$num_sjp = "00$jumlah_sjp";
				}elseif ($jumlah_sjp >= 10 && $jumlah_sjp <= 99) {
					$num_sjp = "0$jumlah_sjp";
				}elseif ($jumlah_sjp >= 100) {
					$num_sjp = $jumlah_sjp;
				}

				$tahun_sjp = substr(date('Y'), -2);
				$bulan_sjp = date('m');

				if ($bulan_sjp == '01') {
					$romawi = "I";
				}elseif ($bulan_sjp == '02') {
					$romawi = "II";
				}elseif ($bulan_sjp == '03') {
					$romawi = "III";
				}elseif ($bulan_sjp == '04') {
					$romawi = "IV";
				}elseif ($bulan_sjp == '05') {
					$romawi = "V";
				}elseif ($bulan_sjp == '06') {
					$romawi = "VI";
				}elseif ($bulan_sjp == '07') {
					$romawi = "VII";
				}elseif ($bulan_sjp == '08') {
					$romawi = "VIII";
				}elseif ($bulan_sjp == '09') {
					$romawi = "IX";
				}elseif ($bulan_sjp == '10') {
					$romawi = "X";
				}elseif ($bulan_sjp == '11') {
					$romawi = "XI";
				}elseif ($bulan_sjp == '12') {
					$romawi = "XII";
				}

				$nomor_sjp = $num_sjp."/SJ.KGI/".$tahun_sjp."/".$romawi."/SBY";
				$result['nomor_sjp'] = $nomor_sjp;
				$result['tujuan'] = $this->TujuanModel->get_tujuan()->result();
				$this->load->view('gudang/mutasi_penjualan/buat_mutasi_penjualan', $result, FALSE);
			}else{
				redirect('dashboard','refresh');
			}
		}
	}

	public function simpan_qr(){
		$keterangan = $this->input->post('keterangan_mutasi_lain');
		$shift = $this->input->post('shift');
		$data_mutasi = [
			'tanggal_mutasi_lain' => $this->input->post('tgl_mutasi'),
			'shift_mutasi_lain' => $shift,
			'department' => $this->input->post('department'),
			'keterangan_mutasi_lain' => $keterangan,
			'catatan_mutasi_lain' => $this->input->post('catatan_mutasi_lain')
		];
		
		$id_mutasi = $this->MutasiModel->save('mutasi_lain',$data_mutasi);

		$id_detail_qr = $this->input->post('id_qr');
		$id_produk = $this->input->post('id_produk');
		$id_bahan_datang = $this->input->post('id_bahan_datang');
		$diserahkan = $this->input->post('diserahkan');
		$satuan_diserahkan = $this->input->post('satuan_diserahkan');
		$dikembalikan = $this->input->post('dikembalikan');
		$satuan_dikembalikan = $this->input->post('satuan_dikembalikan');
		$reject = $this->input->post('reject');
		$satuan_reject = $this->input->post('satuan_reject');
		$qty_kemasan = $this->input->post('qty_kemasan');

		foreach ($id_detail_qr as $index => $value) {

			if ($keterangan == 'PENYERAHAN') {

				if ($satuan_diserahkan[$index] == 'Gram') {
					$calc_diserahkan = $diserahkan[$index]/1000;
				}else{
					$calc_diserahkan = $diserahkan[$index];
				}
	
				$update_isi = $qty_kemasan[$index]-$calc_diserahkan;
	
				$arr_qty_drum = [
					'isi_per_kemasan' => $update_isi
				]; 
	
				$this->OrderModel->update_qr_datang($value, $arr_qty_drum);

				$data_kedatangan = $this->OrderModel->get_kedatangan_by_id($id_bahan_datang[$index])->row();
				$calc_kedatangan = $data_kedatangan->jumlah_kedatangan-$calc_diserahkan;

				$arr_kedatangan = [
					'tanggal_habis' => $habis = ($calc_kedatangan == 0) ? date('Y-m-d') : NULL,
					'sisa_stok_kedatangan' => $calc_kedatangan
				];

				$this->OrderModel->update_bahan_datang($id_bahan_datang[$index], $arr_kedatangan);

				$data_produk = $this->ProdukModel->get_produk_id($id_produk[$index])->row();
				$hitung_stok = $data_produk->stok-$calc_diserahkan;
	
				$data_stok = [
					'stok' => $hitung_stok
				];
	
				$dataDetailMutasi = [
					'id_mutasi_lain' => $id_mutasi,
					'id_detail_qr_kedatangan' => $value,
					'diserahkan' => $diserahkan[$index],
					'satuan_diserahkan' => $satuan_diserahkan[$index],
					'dikembalikan' => $dikembalikan[$index],
					'satuan_dikembalikan' => $satuan_dikembalikan[$index],
					'reject' => $reject[$index],
					'satuan_reject' => $satuan_reject[$index]
				];
	
				$arr_log_produk = [
					'id_produk' => $id_produk[$index],
					'tanggal_log' => date('Y-m-d'),
					'shift_log' => $shift,
					'deskripsi_log' => $keterangan,
					'in_log' => $dikembalikan[$index],
					'out_log' => $diserahkan[$index],
					'balance_log' => $hitung_stok
				];
				
				$this->ProdukModel->update_stok($id_produk[$index],$data_stok);
				$this->MutasiModel->save('detail_mutasi_lain',$dataDetailMutasi);
				$this->LogModel->save_log_produk($arr_log_produk);
				
			}elseif ($keterangan == 'PENGEMBALIAN') {

				$mdikembalikan = (empty($dikembalikan[$index])) ? 0 : $dikembalikan[$index];

				if ($satuan_dikembalikan[$index] == 'Gram') {
					$calc_dikembalikan = $mdikembalikan/1000;
				}else{
					$calc_dikembalikan = $mdikembalikan;
				}

				$mreject = (empty($reject[$index])) ? 0 : $reject[$index];

				if ($satuan_reject[$index] == 'Gram') {
					$calc_reject = $mreject/1000;
				}else{
					$calc_reject = $mreject;
				}

				$update_isi = $qty_kemasan[$index]+$calc_dikembalikan-$calc_reject;

				$arr_qty_drum = [
					'isi_per_kemasan' => $update_isi
				]; 
	
				$this->OrderModel->update_qr_datang($value, $arr_qty_drum);

				$data_kedatangan = $this->OrderModel->get_kedatangan_by_id($id_bahan_datang[$index])->row();
				$calc_kedatangan = $data_kedatangan->jumlah_kedatangan+$calc_dikembalikan-$calc_reject;

				$arr_kedatangan = [
					'tanggal_habis' => $habis = ($calc_kedatangan == 0) ? date('Y-m-d') : NULL,
					'sisa_stok_kedatangan' => $calc_kedatangan
				];

				$this->OrderModel->update_bahan_datang($id_bahan_datang[$index], $arr_kedatangan);

				$data_produk = $this->ProdukModel->get_produk_id($id_produk[$index])->row();
				$hitung_stok = $data_produk->stok+$calc_dikembalikan-$calc_reject;
	
				$data_stok = [
					'stok' => $hitung_stok
				];
	
				$dataDetailMutasi = [
					'id_mutasi_lain' => $id_mutasi,
					'id_detail_qr_kedatangan' => $value,
					'diserahkan' => $diserahkan[$index],
					'satuan_diserahkan' => $satuan_diserahkan[$index],
					'dikembalikan' => $mdikembalikan,
					'satuan_dikembalikan' => $satuan_dikembalikan[$index],
					'reject' => $mreject,
					'satuan_reject' => $satuan_reject[$index]
				];
	
				$arr_log_produk = [
					'id_produk' => $id_produk[$index],
					'tanggal_log' => date('Y-m-d'),
					'shift_log' => $shift,
					'deskripsi_log' => $keterangan,
					'in_log' => $mdikembalikan,
					'out_log' => $diserahkan[$index],
					'balance_log' => $hitung_stok
				];
				
				$this->ProdukModel->update_stok($id_produk[$index],$data_stok);
				$this->MutasiModel->save('detail_mutasi_lain',$dataDetailMutasi);
				$this->LogModel->save_log_produk($arr_log_produk);
			}

		}
		redirect("mutasi/cetak/$id_mutasi",'refresh');
	}

	public function simpan_penjualan(){
		$tanggal = $this->input->post('tgl_mutasi');
		$no_sjp = $this->input->post('no_sjp_penjualan');
		$tujuan = $this->input->post('tujuan_pengiriman');
		$catatan = $this->input->post('catatan_mutasi_penjualan');
		$data_mutasi = [
			'id_tujuan_pengiriman' => $tujuan,
			'tanggal_mutasi_penjualan' => $tanggal,
			'no_sjp_penjualan' => $no_sjp,
			'catatan_mutasi_penjualan' => $catatan
		];
		
		$id_mutasi = $this->MutasiModel->save('mutasi_penjualan',$data_mutasi);

		$id_detail_qr = $this->input->post('id_qr');
		$id_produk = $this->input->post('id_produk');
		$id_bahan_datang = $this->input->post('id_bahan_datang');
		$diserahkan = $this->input->post('diserahkan');
		$satuan_diserahkan = $this->input->post('satuan_diserahkan');
		$qty_kemasan = $this->input->post('qty_kemasan');

		foreach ($id_detail_qr as $index => $value) {

			if ($satuan_diserahkan[$index] == 'Gram') {
				$calc_diserahkan = $diserahkan[$index]/1000;
			}else{
				$calc_diserahkan = $diserahkan[$index];
			}

			$update_isi = $qty_kemasan[$index]-$calc_diserahkan;

			$arr_qty_drum = [
				'isi_per_kemasan' => $update_isi
			]; 

			$this->OrderModel->update_qr_datang($value, $arr_qty_drum);

			$data_kedatangan = $this->OrderModel->get_kedatangan_by_id($id_bahan_datang[$index])->row();
			$calc_kedatangan = $data_kedatangan->jumlah_kedatangan-$calc_diserahkan;

			$arr_kedatangan = [
				'tanggal_habis' => $habis = ($calc_kedatangan == 0) ? date('Y-m-d') : NULL,
				'sisa_stok_kedatangan' => $calc_kedatangan
			];

			$this->OrderModel->update_bahan_datang($id_bahan_datang[$index], $arr_kedatangan);

			$data_produk = $this->ProdukModel->get_produk_id($id_produk[$index])->row();
			$hitung_stok = $data_produk->stok-$calc_diserahkan;

			$data_stok = [
				'stok' => $hitung_stok
			];

			$dataDetailMutasi = [
				'id_mutasi_penjualan' => $id_mutasi,
				'id_detail_qr_kedatangan' => $value,
				'diserahkan_penjualan' => $diserahkan[$index],
				'satuan_diserahkan_penjualan' => $satuan_diserahkan[$index]
			];

			$arr_log_produk = [
				'id_produk' => $id_produk[$index],
				'tanggal_log' => date('Y-m-d'),
				'shift_log' => '1',
				'deskripsi_log' => $catatan,
				'in_log' => 0,
				'out_log' => $diserahkan[$index],
				'balance_log' => $hitung_stok
			];
			
			$this->ProdukModel->update_stok($id_produk[$index],$data_stok);
			$this->MutasiModel->save('detail_mutasi_penjualan',$dataDetailMutasi);
			$this->LogModel->save_log_produk($arr_log_produk);

		}
		redirect("mutasi/cetak_penjualan/$id_mutasi",'refresh');
	}

	public function edit(){
		$id = $this->uri->segment(3);
		if (!empty($id)) {
			$db_tipe = $this->MutasiModel->get_tipe_mutasi($id)->row();
			$tipe_mutasi = $db_tipe->kategori_produk;
			$result['data_mutasi'] = $this->MutasiModel->get_mutasi_id($id)->result();
			$result['data_batch'] = $this->MutasiModel->get_batch_mutasi($id)->result();
			$result['data_detail'] = $this->MutasiModel->get_detail_mutasi($id)->result();
			$result['tipe_mutasi'] = $tipe_mutasi;
			$result['data_bahan'] = $this->ProdukModel->get_produk($tipe_mutasi)->result();
			$result['request'] = $tipe_mutasi;
			$this->load->view('gudang/mutasi/edit_mutasi', $result, FALSE);
 		}else{
			redirect('dashboard/index','refresh');
		}
	}

	public function edit_lain(){
		$id = $this->uri->segment(3);
		if (!empty($id)) {
			$result['data_mutasi'] = $this->MutasiModel->get_mutasi_lain_id($id)->result();
			$result['data_detail'] = $this->MutasiModel->get_detail_mutasi_lain($id)->result();
			$result['data_bahan'] = $this->ProdukModel->get_all_produk()->result();
			$this->load->view('gudang/mutasi_lain/edit_mutasi_lain', $result, FALSE);
 		}else{
			redirect('dashboard/index','refresh');
		}
	}

	
	public function hapus(){
		$id = $this->uri->segment(3);
		if (!empty($id)) {
			$db_tipe = $this->MutasiModel->get_tipe_mutasi($id)->row();
			$tipe_mutasi = $db_tipe->kategori_produk;
			$this->MutasiModel->delete_mutasi($id);
			redirect("mutasi/index/$tipe_mutasi",'refresh');
		}else{
			redirect('dashboard','refresh');
		}
	}

	public function hapus_lain(){
		$id = $this->uri->segment(3);
		if (!empty($id)) {
			$detail_lain = $this->MutasiModel->get_detail_mutasi_lain($id)->result();
			$mutasi_lain = $this->MutasiModel->get_mutasi_lain_id($id)->row();
			if (strpos($mutasi_lain->keterangan_mutasi_lain,'PENYERAHAN') == TRUE || strpos($mutasi_lain->keterangan_mutasi_lain,'ERAH') == TRUE || 
				strpos($mutasi_lain->keterangan_mutasi_lain,'PENGIRIMAN') == TRUE || strpos($mutasi_lain->keterangan_mutasi_lain,'IRIM') == TRUE || 
				strpos($mutasi_lain->keterangan_mutasi_lain,'REWORK') == TRUE) {
				foreach ($detail_lain as $key => $value) {
					$calc_stok = $value->stok + $value->diserahkan;
					$arr_stok = [ 'stok' => $calc_stok ];
					$this->ProdukModel->update_stok($value->id_produk, $arr_stok);
				}
			}elseif (strpos($mutasi_lain->keterangan_mutasi_lain,'PENGEMBALIAN') == TRUE || strpos($mutasi_lain->keterangan_mutasi_lain,'MBAL') == TRUE || 
					strpos($mutasi_lain->keterangan_mutasi_lain,'MBALI') == TRUE) {
				foreach ($detail_lain as $key => $value) {
					$calc_stok = $value->stok - $value->dikembalikan;
					$arr_stok = [ 'stok' => $calc_stok ];
					$this->ProdukModel->update_stok($value->id_produk, $arr_stok);
				}
			}
			$this->MutasiModel->delete_mutasi_lain($id);
			redirect("mutasi/index/Lain",'refresh');
		}else{
			redirect('dashboard','refresh');
		}
	}

	public function cetak($id = null){
		if (!empty($id)) {
			$result['mutasi_lain'] = $this->MutasiModel->get_mutasi_lain_id($id)->row(); 
			$result['detail_mutasi_lain'] = $this->MutasiModel->get_detail_mutasi_cetak($id)->result(); 
			$result['kategori'] = $this->MutasiModel->get_detail_mutasi_cetak($id)->row()->kategori_produk; 
			$this->pdf->setPaper('A4','potrait');
			$this->pdf->set_option('isHtml5ParserEnabled', true);
			$this->pdf->filename = "FORM MUTASI BAHAN";
			$this->pdf->load_view('gudang/cetak/mutasi_pdf',$result);
		}else{
			redirect('dashboard','refresh');
		}
	}

	public function cetak_penjualan($id = null){
		if (!empty($id)) {
			$result['mutasi_penjualan'] = $this->MutasiModel->get_mutasi_penjualan_id($id)->row(); 
			$result['detail_mutasi_penjualan'] = $this->MutasiModel->get_detail_mutasi_penjualan($id)->result(); 
			$this->pdf->setPaper('A4','potrait');
			$this->pdf->set_option('isHtml5ParserEnabled', true);
			$this->pdf->filename = "FORM MUTASI PENJUALAN";
			$this->pdf->load_view('gudang/cetak/mutasi_penjualan',$result);
		}else{
			redirect('dashboard','refresh');
		}
	}

	public function status(){
		$request = $this->uri->segment(3);
		if (!empty($request) && $request == 'progress' || $request == 'selesai') {
			if ($request == 'progress') {
				$status = 'On Progress';
			}else{
				$status = 'Selesai';
			}
			$result['status'] = $status;
			// $result['mutasi_baku'] = $this->MutasiModel->get_mutasi_bahan_status('Baku',$status)->result();
			// $result['mutasi_kemas'] = $this->MutasiModel->get_mutasi_bahan_status('Kemas',$status)->result();
			$result['mutasi_lain'] = $this->MutasiModel->get_mutasi_lain_status($status)->result();
			$this->load->view('gudang/mutasi/mutasi_status', $result, FALSE);
		}else{
			redirect('dashboard','refresh');
		}
	}

	public function json_daily_chart(){
		if (!empty($this->session->userdata('login'))) {
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
			    		'value' =>  $this->MutasiModel->get_data_daily(date('Y-m-d', $time))->row()->jumlah
			    	);
			    array_push($list, $mlist);
			}

			echo json_encode($list);	
		}
	}

	public function json_daily_range(){
		if (!empty($this->session->userdata('login'))) {
			$start = $this->input->post('start');
			$end = $this->input->post('end');
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
		    		'value' =>  $this->MutasiModel->get_data_daily($value->format('Y-m-d'))->row()->jumlah
		    	);
		    	array_push($mresult, $mlist);
			}

			echo json_encode($mresult);
		}
	}

	public function json_weekly_chart(){
		if (!empty($this->session->userdata('login'))) {
			$data_week_1 = $this->MutasiModel->get_data_weekly('1')->row();
			$data_week_2 = $this->MutasiModel->get_data_weekly('2')->row();
			$data_week_3 = $this->MutasiModel->get_data_weekly('3')->row();
			$data_week_4 = $this->MutasiModel->get_data_weekly('4')->row();

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
	}

	public function json_weekly_range(){
		if (!empty($this->session->userdata('login'))) {
			$bulan = $this->input->post('bulan');
			$tahun = $this->input->post('tahun');

			$data_week_1 = $this->MutasiModel->get_weekly_range('1', $bulan, $tahun)->row();
			$data_week_2 = $this->MutasiModel->get_weekly_range('2', $bulan, $tahun)->row();
			$data_week_3 = $this->MutasiModel->get_weekly_range('3', $bulan, $tahun)->row();
			$data_week_4 = $this->MutasiModel->get_weekly_range('4', $bulan, $tahun)->row();

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
	}

	public function json_monthly_chart(){
		if (!empty($this->session->userdata('login'))) {
			for ($i=1; $i < 13; $i++) { 
				$response["month_$i"] = $this->MutasiModel->get_monthly_chart("0$i")->row()->jumlah;
			}

			echo json_encode($response);
		}
	}

	public function json_monthly_range(){
		if (!empty($this->session->userdata('login'))) {
			$tahun = $this->input->post('tahun');

			for ($i=1; $i < 13; $i++) { 
				$response["month_$i"] = $this->MutasiModel->get_monthly_range("0$i",$tahun)->row()->jumlah;
			}

			echo json_encode($response);	
		}
	}

	public function cari(){
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		
		$result['data_mutasi'] = $this->MutasiModel->get_mutasi_lain_range($start_date, $end_date)->result();  
		$result['start'] = date('d/m/Y', strtotime($start_date));  
		$result['end'] = date('d/m/Y', strtotime($end_date));  

		$this->load->view('gudang/mutasi_lain/cari_mutasi_lain', $result, FALSE);
	}

	public function cari_penjualan(){
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		
		$result['data_mutasi'] = $this->MutasiModel->get_mutasi_penjualan_range($start_date, $end_date)->result();  
		$result['start'] = date('d/m/Y', strtotime($start_date));  
		$result['end'] = date('d/m/Y', strtotime($end_date));  

		$this->load->view('gudang/mutasi_penjualan/cari_mutasi_penjualan', $result, FALSE);
	}

}

/* End of file Mutasi.php */
/* Location: ./application/controllers/Mutasi.php */