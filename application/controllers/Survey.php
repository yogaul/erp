<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey extends CI_Controller {

	public function index(){
		$this->load->view('marketing/survey/survey', FALSE);
	}

	public function data(){
		$array = array(
			'active' => 'survey'
		);
		$this->session->set_userdata( $array );
		$result['data'] = $this->SurveyModel->get()->result();
		$this->load->view('marketing/survey/data_survey', $result, FALSE);
	}

	public function simpan(){
		$email = $this->input->post('email_cust');
		$nama = $this->input->post('nama_cust');
		$telp = $this->input->post('telp_cust');
		$alamat = $this->input->post('alamat_cust');
		$post_decor = $this->input->post('produk_decor');
		$post_body = $this->input->post('produk_body');
		$post_skin = $this->input->post('produk_skin');
		$post_men = $this->input->post('produk_men');
		$post_hair = $this->input->post('produk_hair');
		$pernah = $this->input->post('pernah');
		$brand = $this->input->post('nama_brand');
		$estimasi = $this->input->post('estimasi');

		$str_decor = (is_null($post_decor)) ? '' : implode(',', $post_decor).',';
		$str_body = (is_null($post_body)) ? '' : implode(',', $post_body).',';
		$str_skin = (is_null($post_skin)) ? '' : implode(',', $post_skin).',';
		$str_men = (is_null($post_men)) ? '' : implode(',', $post_men).',';
		$str_hair = (is_null($post_hair)) ? '' : implode(',', $post_hair).',';
		$produk_trim = rtrim($str_decor.$str_body.$str_skin.$str_men.$str_hair,',');

		$data_survey = [
			'tanggal_survey' => date('Y-m-d H:i:s'),
			'email_cust_survey' => $email,
			'nama_cust_survey' => $nama,
			'telp_cust_survey' => $telp,
			'alamat_cust_survey' => $alamat,
			'order_cust_survey' => $produk_trim,
			'status_cust_survey' => $pernah,
			'brand_cust_survey' => $brand,
			'estimasi_launch_survey' => $estimasi
		];

		$insert = $this->SurveyModel->save($data_survey);
		if ($insert == TRUE) {
			echo "<script type='text/javascript'>alert('Jawaban berhasil disimpan.');</script>";
			redirect('survey','refresh');
		}else{
			echo 'Jawaban gagal disimpan.';
		}
	}
}

/* End of file Survey.php */
/* Location: ./application/controllers/Survey.php */