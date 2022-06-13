<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Komplain extends CI_Controller {

	public function index(){
		$this->load->view('marketing/komplain/form_komplain', FALSE);
	}

	public function simpan(){
		$id_komplain = "KMPLN-".date('Ymdhis');
		$nama_konsumen = $this->input->post('nama_konsumen');
		$usia_konsumen = $this->input->post('usia_konsumen');
		$produk_komplain = $this->input->post('produk_komplain');
		$keterangan_komplain = $this->input->post('keterangan_komplain');
		$no_batch_produk = $this->input->post('no_batch_produk');
		$expired_date_komplain = $this->input->post('expired_date_komplain');
		$jumlah_produk_komplain = $this->input->post('jumlah_produk_komplain');
		$frekuensi_pemakaian = $this->input->post('frekuensi_pemakaian');
		$lama_pemakaian_produk = $this->input->post('lama_pemakaian_produk');
		$tanggal_pembelian_produk = $this->input->post('tanggal_pembelian_produk');

		$arr_komplain = [
			'id_customer_response' => $id_komplain,
			'tanggal_komplain' => date('Y-m-d H:i:s'),
			'nama_konsumen' => $nama_konsumen,
			'usia_konsumen' => $usia_konsumen,
			'produk_komplain' => $produk_komplain,
			'keterangan_komplain' => $keterangan_komplain,
			'batch_number_produk' => $no_batch_produk,
			'tanggal_expired_produk' => $expired_date_komplain,
			'jumlah_produk_komplain' => $jumlah_produk_komplain,
			'frekuensi_pemakaian' => $frekuensi_pemakaian,
			'lama_pemakaian' => $lama_pemakaian_produk,
			'tanggal_pembelian_produk' => $tanggal_pembelian_produk,
			'foto_video_produk' => $this->upload_image($id_komplain)
		];

		$this->KomplainModel->save_komplain($arr_komplain);
		$this->load->view('marketing/komplain/success_komplain', FALSE);
	}

	private function upload_image($filename){
		$config['upload_path']          = './uploads/komplain/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg|pdf|mp4|webm|ogv';
		$config['file_name']            = $filename;
		$config['overwrite']			= true;
		$config['max_size']             = 5000; 

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$image_path = base_url().'uploads/komplain/';

		if ($this->upload->do_upload('file_komplain')) {
			$upload_data = $this->upload->data("file_name");
			return $image_path.$upload_data;
		}else{
			return $image_path."default.jpg";
		}	
	}

	public function data(){
		if (empty($this->session->userdata('login'))) {
			redirect('login/logout','refresh');
		}else{
			$array = array(
				'active' => 'komplain'
			);
			
			$this->session->set_userdata( $array );
			$result['komplain'] = $this->KomplainModel->get_komplain()->result();
			$this->load->view('marketing/komplain/data_komplain', $result, FALSE);
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
			    		'value' =>  $this->KomplainModel->get_data_daily(date('Y-m-d', $time))->row()->jumlah
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
		    		'value' =>  $this->KomplainModel->get_data_daily($value->format('Y-m-d'))->row()->jumlah
		    	);
		    	array_push($mresult, $mlist);
			}

			echo json_encode($mresult);
		}
	}

	public function json_weekly_chart(){
		if (!empty($this->session->userdata('login'))) {
			$data_week_1 = $this->KomplainModel->get_data_weekly('1')->row();
			$data_week_2 = $this->KomplainModel->get_data_weekly('2')->row();
			$data_week_3 = $this->KomplainModel->get_data_weekly('3')->row();
			$data_week_4 = $this->KomplainModel->get_data_weekly('4')->row();

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

			$data_week_1 = $this->KomplainModel->get_weekly_range('1', $bulan, $tahun)->row();
			$data_week_2 = $this->KomplainModel->get_weekly_range('2', $bulan, $tahun)->row();
			$data_week_3 = $this->KomplainModel->get_weekly_range('3', $bulan, $tahun)->row();
			$data_week_4 = $this->KomplainModel->get_weekly_range('4', $bulan, $tahun)->row();

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
				$response["month_$i"] = $this->KomplainModel->get_monthly_chart("0$i")->row()->jumlah;
			}

			echo json_encode($response);
		}
	}

	public function json_monthly_range(){
		if (!empty($this->session->userdata('login'))) {
			$tahun = $this->input->post('tahun');

			for ($i=1; $i < 13; $i++) { 
				$response["month_$i"] = $this->KomplainModel->get_monthly_range("0$i",$tahun)->row()->jumlah;
			}

			echo json_encode($response);	
		}
	}

}

/* End of file Komplain.php */
/* Location: ./application/controllers/Komplain.php */