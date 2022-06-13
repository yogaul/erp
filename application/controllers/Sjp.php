<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sjp extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (empty($this->session->userdata('login'))) {
			redirect('Login/index','refresh');
		}
		$array = array(
			'active' => 'sjp'
		);
		$this->session->set_userdata( $array );
	}

	public function index($id){
		if (!empty($id)) {
			$result['id_spp'] = $id;
			$result['data_spp'] = $this->SppModel->get_spp_id($id)->row();
			$result['list_sjp'] = $this->SjpModel->get_sjp($id)->result();
			$this->load->view('gudang/sjp/data_sjp', $result, FALSE);
		}else{
			redirect('dashboard','refresh');
		}
	}

	public function buat($id){
		if (!empty($id)) {
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
			$result['id_spp'] = $id;
			$result['nomor_sjp'] = $nomor_sjp;
			$result['data_spp'] = $this->SppModel->get_spp_id($id)->row();
			$result['data_produk'] = $this->SampleAwalModel->get_acc_design_by_brand($result['data_spp']->id_brand_produk)->result();
			$this->load->view('gudang/sjp/buat_sjp', $result, FALSE);
		}else{
			redirect('dashboard','refresh');
		}
	}

	public function glow(){
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
		$result['metode'] = "Manual";
		$result['telepon'] = "0341-3022614";
		$result['alamat'] = "Jln. Komud Abdurrahman Saleh Rt. 05 Rw. 06 Asrikaton Pakis - Kab. Malang";
		$result['produk_glow'] = $this->MsglowModel->get_msglow()->result();
		$this->load->view('gudang/sjp/buat_sjp_glow', $result, FALSE);
	}

	public function qr(){
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
		$result['metode'] = "Scan";
		$result['telepon'] = "0341-3022614";
		$result['alamat'] = "Jln. Komud Abdurrahman Saleh Rt. 05 Rw. 06 Asrikaton Pakis - Kab. Malang";
		$this->load->view('gudang/sjp/buat_sjp_qr', $result, FALSE);
	}

	public function spp(){
		if ($this->session->userdata('level') == 'ppic') {
			
			$array = array(
				'active' => 'dashboard'
			);
			
			$this->session->set_userdata( $array );
			
		}
		$result['list_spp'] = $this->SppModel->get_spp()->result();
		$this->load->view('marketing/spp/data_spp', $result, FALSE);
	}

	public function ms(){
		$result['list_sjp'] = $this->SjpModel->get_sjp_glow()->result();
		$this->load->view('gudang/sjp/data_sjp_glow', $result, FALSE);
	}

	public function simpan(){
		$id_sjp = 'SJP-'.date('Ymdhis');
		$id_spp = $this->input->post('id_spp');
		$tanggal_sjp = $this->input->post('tanggal_sjp');
		$nomor_sjp = $this->input->post('nomor_sjp');
		$telp_sjp = $this->input->post('telp_sjp');
		$alamat_sjp = $this->input->post('alamat_sjp');

		$arr_sjp = [
			'id_sjp' => $id_sjp,
			'id_spp' => $id_spp,
			'tanggal_sjp' => $tanggal_sjp,
			'nomor_sjp' => $nomor_sjp,
			'telp_sjp' => $telp_sjp,
			'alamat_sjp' => $alamat_sjp
		];

		$this->SjpModel->save_sjp($arr_sjp);

		foreach ($this->input->post('unique_id') as $unique_id) {
			$id_sample_acc = $this->input->post('id_produk_'.$unique_id);
			$qty_produk_sjp = $this->input->post('quantity_value_'.$unique_id);
			$no_batch_sjp = $this->input->post('nomor_batch_'.$unique_id);
			$qty_karton_sjp = $this->input->post('quantity_karton_value_'.$unique_id);
			$expired_date_sjp = $this->input->post('expired_date_sjp_'.$unique_id);
			$subtotal_sjp = $this->input->post('subtotal_sjp_'.$unique_id);

			$arr_detail_sjp = [
				'id_sjp' => $id_sjp,
				'id_sample_acc' => $id_sample_acc[0],
				'qty_produk_sjp' => $qty_produk_sjp[0],
				'subtotal_qty_sjp' => $subtotal_sjp[0],
			];
			$detail = $this->SjpModel->save_detail_sjp($arr_detail_sjp);

			foreach ($no_batch_sjp as $index => $value) {
				$arr_detail_batch = [
					'id_detail_sjp' => $detail,
					'no_batch_sjp' => $value,
					'qty_karton_sjp' => $qty_karton_sjp[$index],
					'expired_date_sjp' => $expired_date_sjp[$index]
				];
				$this->SjpModel->save_detail_batch($arr_detail_batch);
			}
		}
		redirect("sjp/index/$id_spp",'refresh');
	}

	public function simpan_glow(){
		$id_sjp = 'SJP-'.date('Ymdhis');
		$tanggal_sjp = $this->input->post('tanggal_sjp');
		$nomor_sjp = $this->input->post('nomor_sjp');
		$telp_sjp = $this->input->post('telp_sjp');
		$alamat_sjp = $this->input->post('alamat_sjp');
		$metode = $this->input->post('metode');

		$arr_sjp = [
			'id_sjp' => $id_sjp,
			'id_spp' => NULL,
			'tanggal_sjp' => $tanggal_sjp,
			'metode' => $metode,
			'nomor_sjp' => $nomor_sjp,
			'qr_sjp' => "https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=$nomor_sjp",
			'telp_sjp' => $telp_sjp,
			'alamat_sjp' => $alamat_sjp
		];

		$this->SjpModel->save_sjp($arr_sjp);

		foreach ($this->input->post('unique_id') as $unique_id) {
			$id_produk = $this->input->post('id_produk_'.$unique_id);
			$qty_produk_sjp = $this->input->post('quantity_value_'.$unique_id);
			$no_batch_sjp = $this->input->post('nomor_batch_'.$unique_id);
			$qty_karton_sjp = $this->input->post('quantity_karton_value_'.$unique_id);
			$expired_date_sjp = $this->input->post('expired_date_sjp_'.$unique_id);
			$subtotal_sjp = $this->input->post('subtotal_sjp_'.$unique_id);

			$arr_detail_sjp_glow = [
				'id_sjp' => $id_sjp,
				'id_produk_msglow' => $id_produk[0],
				'qty_produk_glow' => $qty_produk_sjp[0],
				'subtotal_produk_glow' => $subtotal_sjp[0],
			];

			$detail = $this->SjpModel->save_detail_sjp_glow($arr_detail_sjp_glow);

			foreach ($no_batch_sjp as $index => $value) {
				$arr_detail_batch_glow = [
					'id_detail_sjp_glow' => $detail,
					'no_batch_sjp_glow' => $value,
					'qty_karton_sjp_glow' => $qty_karton_sjp[$index],
					'expired_date_sjp_glow' => $expired_date_sjp[$index]
				];
				$this->SjpModel->save_detail_batch_glow($arr_detail_batch_glow);
			}

			$stok = $this->MsglowModel->get_msglow_id($id_produk[0])->row()->stok_produk_msglow;
			$subtotal = $this->SjpModel->get_sum_subtotal_glow($id_sjp, $id_produk[0])->row()->total_subtotal_sjp;
			$calc_total = $stok-$subtotal;

			$arr_stok_glow = [
				'stok_produk_msglow' => $calc_total
			];

			$this->MsglowModel->update_msglow($id_produk[0], $arr_stok_glow);

			$arr_log_msglow = [
				'id_produk_msglow' => $id_produk[0],
				'tanggal_log_msglow' => $tanggal_sjp,
				'deskripsi_log_msglow' => "Pengiriman",
				'in_log_msglow' => 0,
				'out_log_msglow' => $subtotal,
				'balance_log_msglow' => $calc_total
			];

			$this->LogModel->save_log_msglow($arr_log_msglow);

		}
		redirect("sjp/ms",'refresh');
	}

	public function simpan_qr(){
		$id_sjp = 'SJP-'.date('Ymdhis');
		$tanggal_sjp = $this->input->post('tanggal_sjp');
		$nomor_sjp = $this->input->post('nomor_sjp');
		$telp_sjp = $this->input->post('telp_sjp');
		$alamat_sjp = $this->input->post('alamat_sjp');
		$metode = $this->input->post('metode');

		$arr_sjp = [
			'id_sjp' => $id_sjp,
			'id_spp' => NULL,
			'tanggal_sjp' => $tanggal_sjp,
			'metode' => $metode,
			'nomor_sjp' => $nomor_sjp,
			'qr_sjp' => "https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=$nomor_sjp",
			'telp_sjp' => $telp_sjp,
			'alamat_sjp' => $alamat_sjp
		];

		$this->SjpModel->save_sjp($arr_sjp);
		redirect("sjp/ms",'refresh');
	}

	public function refresh($id = null){
		if (!is_null($id)) {
			$temp_qr = $this->OrderModel->get_qr_temp_failed($id)->result();
			if (!empty($temp_qr)) {
				foreach ($temp_qr as $value) {
					$url = "http://track.kosme.co.id/api/sjp?barcode=".$value->temp_qr_code;

					$ch = curl_init($url);
					curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true);
					curl_setopt( $ch, CURLOPT_HEADER, false);
					curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
					$responseku = curl_exec( $ch );
					$response_data = json_decode($responseku);

					if (is_array($response_data)) {
						$arr_detail_sjp_glow = [
							'id_sjp' => $id,
							'id_produk_msglow' 		=> $response_data[0]->product,
							'qty_produk_glow' 		=> $response_data[0]->qty_karton,
							'subtotal_produk_glow' 	=> $response_data[0]->total_pieces,
							'serialisasi' 			=> $value->temp_qr_code
						];

						$detail = $this->SjpModel->save_detail_sjp_glow($arr_detail_sjp_glow);

						foreach ($response_data as $key) {
							$arr_detail_batch_glow = [
								'id_detail_sjp_glow' 	=> $detail,
								'no_batch_sjp_glow' 	=> $key->batch,
								'qty_karton_sjp_glow' 	=> $key->qty_per_karton,
								'expired_date_sjp_glow' => $key->expired_date
							];

							$this->SjpModel->save_detail_batch_glow($arr_detail_batch_glow);
						}

						$arr_temp = [
							'temp_total_karton' => $response_data[0]->qty_karton,
							'temp_total_pcs' 	=> $response_data[0]->total_pieces,
							'status_simpan' 	=> '1'
						];

						$this->OrderModel->update_qr_temp($value->id_temp_qr_sjp,$arr_temp);


						$api_sjp = "http://track.kosme.co.id/api/sjp/done?id=$id";
						$result_sjp = file_get_contents($api_sjp);
						$response_sjp = json_decode($result_sjp);
					}
				}
			}
		}
		redirect('sjp/ms','refresh');
	}

	public function ubah($id){
		if (!empty($id)) {
			$datas = [];
			$datas['sjp'] = $this->SjpModel->get_sjp_by_id($id)->row();
			$datas['id_sjp'] = $id;
			$datas['nomor_sjp'] = $datas['sjp']->nomor_sjp;
			$datas['data_spp'] = $this->SppModel->get_spp_id($datas['sjp']->id_spp)->row();
			$datas['data_produk'] = $this->SampleAwalModel->get_acc_design_by_brand($datas['data_spp']->id_brand_produk)->result();
			$datas['spp'] = $this->SppModel->get_spp_id($datas['sjp']->id_spp)->row();
			foreach ($this->SjpModel->get_detail_sjp($id)->result() as $index => $value) {
				$datas['detail_sjp'][$index] = $value;
				$temp = $this->SjpModel->get_detail_batch($value->id_detail_sjp)->result();
				foreach ($temp as $key => $values) {
					$datas['detail_sjp'][$index]->kontol[$key] = $values;
				}
			}
			$this->load->view('gudang/sjp/ubah_sjp', $datas, FALSE);
		}
	}

	public function ubah_glow($id){
		if (!empty($id)) {
			$datas = [];
			$datas['produk_glow'] = $this->MsglowModel->get_msglow()->result();
			$datas['sjp'] = $this->SjpModel->get_sjp_by_id($id)->row();
			foreach ($this->SjpModel->get_detail_sjp_glow($id)->result() as $index => $value) {
				$datas['detail_sjp'][$index] = $value;
				$temp = $this->SjpModel->get_detail_batch_glow($value->id_detail_sjp_glow)->result();
				foreach ($temp as $key => $values) {
					$datas['detail_sjp'][$index]->kontol[$key] = $values;
				}
			}
			$this->load->view('gudang/sjp/ubah_sjp_glow', $datas, FALSE);
		}
	}

	public function detail_glow($id){
		if (!empty($id)) {
			$datas = [];
			$datas['total_akhir'] = $this->SjpModel->get_final_sum($id)->row()->total_subtotal;
			// $datas['total_qty'] = $this->SjpModel->get_sum_qty($id)->result();
			$datas['sjp'] = $this->SjpModel->get_sjp_by_id($id)->row();
			foreach ($this->SjpModel->get_detail_sjp_glow($id)->result() as $index => $value) {
				$datas['detail_sjp'][$index] = $value;
				$temp = $this->SjpModel->get_detail_batch_glow($value->id_detail_sjp_glow)->result();
				foreach ($temp as $key => $values) {
					$datas['detail_sjp'][$index]->kontol[$key] = $values;
				}
			}
			$this->load->view('gudang/sjp/detail_sjp_glow', $datas, FALSE);
		}
	}

	public function hapus($id){
		if (!empty($id)) {
			$data = $this->SjpModel->get_sjp_by_id($id)->row();
			$id_spp = $data->id_spp;
			$this->SjpModel->delete_sjp($id);
			redirect("sjp/index/$id_spp",'refresh');
		}
	}

	public function hapus_glow($id){
		if (!empty($id)) {
			$sjp = $this->SjpModel->get_sjp_by_id($id)->row();
            $tanggal_sjp = date('d/m/Y', strtotime($sjp->tanggal_sjp));
            $detail_sjp = $this->SjpModel->get_detail_group_glow($id)->result();
            foreach ($detail_sjp as $value) {
                $stok_akhir = $value->stok_produk_msglow + $value->total_subtotal_keluar;
                $arr_stok = [ 'stok_produk_msglow' => $stok_akhir ];

                $this->MsglowModel->update_msglow($value->id_produk_msglow, $arr_stok);

                $arr_log = [
                    'id_produk_msglow' => $value->id_produk_msglow,
                    'tanggal_log_msglow' => date('Y-m-d'),
                    'deskripsi_log_msglow' => "Pengembalian stok penghapusan data SJP tanggal $tanggal_sjp",
                    'in_log_msglow' => $value->total_subtotal_keluar,
                    'out_log_msglow' => 0,
                    'balance_log_msglow' => $stok_akhir
                ];

                $this->LogModel->save_log_msglow($arr_log);
            }
			$this->SjpModel->delete_sjp($id);
			redirect("sjp/ms",'refresh');
		}
	}

	public function cetak($id){
		if (!empty($id)) {
			$datas = [];
			$datas['sjp'] = $this->SjpModel->get_sjp_by_id($id)->row();
			$datas['spp'] = $this->SppModel->get_spp_id($datas['sjp']->id_spp)->row();
			foreach ($this->SjpModel->get_detail_sjp($id)->result() as $index => $value) {
				$datas['detail_sjp'][$index] = $value;
				$temp = $this->SjpModel->get_detail_batch($value->id_detail_sjp)->result();
				foreach ($temp as $key => $values) {
					$datas['detail_sjp'][$index]->kontol[$key] = $values;
				}
			}
			$output_file = str_replace('/', '', $datas['sjp']->nomor_sjp);
			$this->pdf->setPaper('Letter','potrait');
			$this->pdf->set_option('isHtml5ParserEnabled', true);
			$this->pdf->set_option('isRemoteEnabled', true);
			$this->pdf->filename = "$output_file";
			$this->pdf->load_view('gudang/sjp/sjp_pdf',$datas);
		}
	}

	public function cetak_glow($id){
		if (!empty($id)) {
			$datas = [];
			$datas['total_akhir'] = $this->SjpModel->get_final_sum($id)->row()->total_subtotal;
			$datas['total_qty'] = $this->SjpModel->get_sum_qty($id)->row()->total_qty_karton;
			$datas['sjp'] = $this->SjpModel->get_sjp_by_id($id)->row();
			foreach ($this->SjpModel->get_detail_sjp_glow($id)->result() as $index => $value) {
				$datas['detail_sjp'][$index] = $value;
				$temp = $this->SjpModel->get_detail_batch_glow($value->id_detail_sjp_glow)->result();
				foreach ($temp as $key => $values) {
					$datas['detail_sjp'][$index]->kontol[$key] = $values;
				}
			}
			$output_file = str_replace('/', '', $datas['sjp']->nomor_sjp);
			$this->pdf->setPaper('Letter','potrait');
			$this->pdf->set_option('isHtml5ParserEnabled', true);
			$this->pdf->set_option('isRemoteEnabled', true);
			$this->pdf->filename = "$output_file";
			$this->pdf->load_view('gudang/sjp/sjp_pdf_glow',$datas);
		}
	}

	public function json_serialisasi(){
		if ($this->input->post()) {
			$id = $this->input->post('id');
			$mserialisasi =  $this->OrderModel->get_serialisasi_qr($id)->result();

			if (!empty($mserialisasi)) {
				foreach ($mserialisasi as $value) {
					$mgcp = $this->SjpModel->get_sjp_gcp($value->serialisasi)->row();
					$arr_gcp = [
						'temp_karton_gcp'	=> (!empty($mgcp)) ? $mgcp->box : 0,
						'temp_pcs_gcp'		=> (!empty($mgcp)) ? $mgcp->bottle: 0
					];
	
					$this->OrderModel->update_qr_temp($value->id_temp_qr_sjp, $arr_gcp);	
				}	
			}

			$result['total'] = $this->SjpModel->get_final_sum($id)->row();
			$result['sjp'] = $this->SjpModel->get_sjp_by_id($id)->row();
			$result['serialisasi'] = $this->OrderModel->get_serialisasi_qr($id)->result();

			$karton_gcp = array_column($result['serialisasi'],'temp_karton_gcp');	
			$pcs_gcp = array_column($result['serialisasi'],'temp_pcs_gcp');	

			$result['total_gcp'] = array(
				'karton'	=> array_sum($karton_gcp),
				'pcs'		=> array_sum($pcs_gcp)
			);

			echo json_encode($result);
		}
	}

	public function asuxku(){
		$temp_qr = $this->OrderModel->get_all_qr_temp()->result();
		if (!empty($temp_qr)) {
			foreach ($temp_qr as $value) {
				$url = "http://track.kosme.co.id/api/sjp?barcode=".$value->temp_qr_code;

				$ch = curl_init($url);
				curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt( $ch, CURLOPT_HEADER, false);
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
				$responseku = curl_exec( $ch );
				$response_data = json_decode($responseku);

				if (is_array($response_data)) {
				

					$arr_temp = [
						'temp_total_karton' => $response_data[0]->qty_karton,
						'temp_total_pcs' 	=> $response_data[0]->total_pieces
					];

					$this->OrderModel->update_qr_temp($value->id_temp_qr_sjp,$arr_temp);

				}
			}
		}
		$sisa = $this->OrderModel->get_all_qr_temp()->num_rows();
		echo "wes mari cak, sisae : $sisa";
	}

	private function olah($id = null){
		if (!is_null($id)) {
			$temp_qr = $this->OrderModel->get_qr_temp_failed($id)->result();
			if (!empty($temp_qr)) {
				foreach ($temp_qr as $value) {
					$url = "http://track.kosme.co.id/api/sjp?barcode=".$value->temp_qr_code;

					$ch = curl_init($url);
					curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true);
					curl_setopt( $ch, CURLOPT_HEADER, false);
					curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
					$responseku = curl_exec( $ch );
					$response_data = json_decode($responseku);

					if (is_array($response_data)) {
						$arr_detail_sjp_glow = [
							'id_sjp' => $id,
							'id_produk_msglow' 		=> $response_data[0]->product,
							'qty_produk_glow' 		=> $response_data[0]->qty_karton,
							'subtotal_produk_glow' 	=> $response_data[0]->total_pieces,
							'serialisasi' 			=> $value->temp_qr_code
						];

						$detail = $this->SjpModel->save_detail_sjp_glow($arr_detail_sjp_glow);

						foreach ($response_data as $key) {
							$arr_detail_batch_glow = [
								'id_detail_sjp_glow' 	=> $detail,
								'no_batch_sjp_glow' 	=> $key->batch,
								'qty_karton_sjp_glow' 	=> $key->qty_per_karton,
								'expired_date_sjp_glow' => $key->expired_date
							];

							$this->SjpModel->save_detail_batch_glow($arr_detail_batch_glow);
						}

						$arr_temp = [
							'temp_total_karton' => $response_data[0]->qty_karton,
							'temp_total_pcs' 	=> $response_data[0]->total_pieces,
							'status_simpan' 	=> '1'
						];

						$this->OrderModel->update_qr_temp($value->id_temp_qr_sjp,$arr_temp);
					}
				}
			}
		}

	}

	public function raimu(){
		$result = $this->SjpModel->get_sjp_refresh()->result();
		foreach ($result as $value) {
			$this->olah($value->id_sjp);
		}
		$sisa = $this->SjpModel->get_barcode_failed()->num_rows();
		echo "wes mari cak, sisae : $sisa";
	}

}

/* End of file Sjp.php */
/* Location: ./application/controllers/Sjp.php */