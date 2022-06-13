<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function list_sjp()
	{
		$start = date('Y-m-d', strtotime('-2 days', strtotime(date('Y-m-d'))));
		$result = $this->SjpModel->get_sjp_api($start, date('Y-m-d'))->result();
		echo json_encode($result);
	}

	public function add_sjp()
	{

		$id = $this->uri->segment(3);
		$qr = $this->uri->segment(4);
		$response = array();

		if (strpos($qr, 'replace') !== false) {
			$mqr = str_replace('replace', '/', $qr);
		} else {
			$mqr = $qr;
		}

		if (strpos($mqr, '&') !== false) {
			$lqr = str_replace('&', '%26', $mqr);
		} else {
			$lqr = $mqr;
		}

		if (strpos($lqr, 'koma') !== false) {
			$xqr = str_replace('koma', ',', $lqr);
		} else {
			$xqr = $lqr;
		}


		$url = "http://track.kosme.co.id/api/sjp?barcode=$xqr";

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
				'serialisasi' 			=> $xqr
			];
		
			$detail = $this->SjpModel->save_detail_sjp_glow($arr_detail_sjp_glow);
	
			foreach ($response_data as  $value) {
				$arr_detail_batch_glow = [
					'id_detail_sjp_glow' 	=> $detail,
					'no_batch_sjp_glow' 	=> $value->batch,
					'qty_karton_sjp_glow' 	=> $value->qty_subtotal,
					'expired_date_sjp_glow' => $value->expired_date
				];
	
				$this->SjpModel->save_detail_batch_glow($arr_detail_batch_glow);
				
			}

			$arr_temp = [
				'id_sjp' 			=> $id,
				'temp_qr_code' 		=> $xqr,
				'temp_total_karton' => $response_data[0]->qty_karton,
				'temp_total_pcs' 	=> $response_data[0]->total_pieces,
				'status_simpan' 	=> '1'
			];

			$this->OrderModel->save_qr_temp($arr_temp);


			$api_sjp = "http://track.kosme.co.id/api/sjp/done?id=$id";
			$result_sjp = file_get_contents($api_sjp);
			$response_sjp = json_decode($result_sjp);

			$response['message'] = 'Berhasil menyimpan data !';
		}else{
			$arr_temp = [
				'id_sjp' 		=> $id,
				'temp_qr_code' 	=> $xqr,
				'status_simpan' => '0'
			];

			$this->OrderModel->save_qr_temp($arr_temp);
		
			$response['message'] = 'Gagal menyimpan data !';
		}
		echo json_encode($response);

	}

	public function json_chart_id()
	{
		$model = $this->RequestGlowModel;
		$id = $this->input->post('id');
		$result = $model->get_request_msglow_id($id)->row();
		echo json_encode($result);
	}
}

/* End of file Api.php */
