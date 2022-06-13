<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SalesOrder extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (empty($this->session->userdata('login'))) {
			redirect('Login/index','refresh');
		}
		$array = array(
			'active' => 'sales_order'
		);
		$this->session->set_userdata( $array );
	}

	public function index(){
		$level = $this->session->userdata('level');
		if ($level == 'marketing' || $level == 'direktur') {
			$result['list_so'] = $this->SalesOrderModel->get_list_so()->result();
		}elseif ($level == 'tim_marketing') {
			$id = $this->session->userdata('id_user');
			$result['list_so'] = $this->SalesOrderModel->get_list_so_tim($id)->result();
		}
		$this->load->view('marketing/sales_order/data_sales_order', $result, FALSE);
	}

	public function buat_so(){
		$level = $this->session->userdata('level');
		if ($level == 'marketing') {
			$result['brand'] = $this->BrandModel->get_brand()->result();
		}elseif ($level == 'tim_marketing') {
			$id = $this->session->userdata('id_user');
			$result['brand'] = $this->BrandModel->get_brand_tim($id)->result();
		}
		$this->load->view('marketing/sales_order/buat_sales_order', $result, FALSE);
	}

	public function simpan_so(){
		$id_so = "SO-".date('YmdHis');
		$tgl_so = date('Y-m-d');
		$id_brand = $this->input->post('brand_so');
		$catatan_so = $this->input->post('catatan_so');

		$arr_so = [
			'id_sales_order' => $id_so,
			'id_brand_produk' => $id_brand,
			'tanggal_sales_order' => $tgl_so,
			'catatan_sales_order' => $catatan_so
		];

		$this->SalesOrderModel->save_so($arr_so);

		$id_sample_acc = $this->input->post('id_produk');
		$quantity_so = $this->input->post('quantity');
		$status_bpom_so = $this->input->post('status_bpom');
		$retur_so = $this->input->post('retur');
		$terkirim_so = $this->input->post('terkirim');
		$estimasi_pengiriman_so = $this->input->post('estimasi');
		$status_so = $this->input->post('status_so');
		$harga_item_so = $this->input->post('harga_so');

		foreach ($id_sample_acc as $key => $value) {
			$nama_file = $value."-".date('YmdHis');
			$kurang_kirim_so = $quantity_so[$key] - $terkirim_so[$key] + $retur_so[$key];
			$arr_detail_so = [
				'id_sales_order' => $id_so,
				'id_sample_acc' => $value,
				'quantity_so' => $quantity_so[$key],
				'status_bpom_so' => $status_bpom_so[$key],
				'retur_so' => $retur_so[$key],
				'terkirim_so' => $terkirim_so[$key],
				'kurang_kirim_so' => $kurang_kirim_so,
				'estimasi_pengiriman_so' => $estimasi_pengiriman_so[$key],
				'status_so' => $status_so[$key],
				'kode_kemas_so' => $this->upload_image($nama_file, $key),
				'harga_item_so' => $harga_item_so[$key]
			];
			$this->SalesOrderModel->save_detail_so($arr_detail_so);
		}
		redirect('SalesOrder','refresh');
	}

	public function detail($id){
		if (!empty($id)) {
			$result['id'] = $id;
			$result['data_so'] = $this->SalesOrderModel->get_so_id($id)->row();
			$result['detail_so'] = $this->SalesOrderModel->get_detail_so_id($id)->result();
			$this->load->view('marketing/sales_order/detail_sales_order', $result, FALSE);
		}
	}

	public function ubah($id){
		if (!empty($id)) {
			$level = $this->session->userdata('level');
			if ($level == 'marketing') {
				$result['brand'] = $this->BrandModel->get_brand()->result();
			}elseif ($level == 'tim_marketing') {
				$id_user = $this->session->userdata('id_user');
				$result['brand'] = $this->BrandModel->get_brand_tim($id_user)->result();
			}
			$result['data_so'] = $this->SalesOrderModel->get_so_id($id)->row();
			$result['detail_so'] = $this->SalesOrderModel->get_detail_so_id($id)->result();
			$this->load->view('marketing/sales_order/edit_sales_order', $result, FALSE);
		}
	}

	public function ubah_so(){
		$id_so = $this->input->post('id_so');
		$id_brand_temp = $this->input->post('brand_so_temp');
		// $id_brand = $this->input->post('brand_so');
		// $brand_update = ($id_brand_temp == $id_brand) ? $id_brand : $id_brand_temp;
		$catatan_so = $this->input->post('catatan_so');

		$arr_so = [
			'id_brand_produk' => $id_brand_temp,
			'catatan_sales_order' => $catatan_so
		];

		$this->SalesOrderModel->update_so($id_so,$arr_so);
		// $this->SalesOrderModel->delete_detail_so($id_so);

		$id_detail_so = $this->input->post('id_detail_so');
		// $id_sample_acc = $this->input->post('id_produk');
		$quantity_so = $this->input->post('quantity');
		$status_bpom_so = $this->input->post('status_bpom');
		$retur_so = $this->input->post('retur');
		$terkirim_so = $this->input->post('terkirim');
		$estimasi_pengiriman_so = $this->input->post('estimasi');
		$status_so = $this->input->post('status_so');

		foreach ($id_detail_so as $key => $value) {
			$kurang_kirim_so = $quantity_so[$key] - $terkirim_so[$key] + $retur_so[$key];
			$arr_detail_so = [
				'quantity_so' => $quantity_so[$key],
				'status_bpom_so' => $status_bpom_so[$key],
				'retur_so' => $retur_so[$key],
				'terkirim_so' => $terkirim_so[$key],
				'kurang_kirim_so' => $kurang_kirim_so,
				'estimasi_pengiriman_so' => $estimasi_pengiriman_so[$key],
				'status_so' => $status_so[$key]
			];
			$this->SalesOrderModel->update_detail_so($value,$arr_detail_so);
		}
		redirect('SalesOrder','refresh');
	}

	private function upload_image($filename, $index){
		$files = $_FILES;
		$image_path = base_url().'uploads/sales_order/';

	    if($_FILES['kode_kemas_so']['name'][$index] != ""){
			$_FILES['kode_kemas_so']['name']= $files['kode_kemas_so']['name'][$index];
	        $_FILES['kode_kemas_so']['type']= $files['kode_kemas_so']['type'][$index];
	        $_FILES['kode_kemas_so']['tmp_name']= $files['kode_kemas_so']['tmp_name'][$index];
	        $_FILES['kode_kemas_so']['error']= $files['kode_kemas_so']['error'][$index];
	        $_FILES['kode_kemas_so']['size']= $files['kode_kemas_so']['size'][$index];

	        $config['upload_path']          = './uploads/sales_order/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['file_name']            = $filename;
			$config['overwrite']			= true;
			$config['max_size']             = 3000; // 3MB

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload("kode_kemas_so")) {
				$upload_data = $this->upload->data("file_name");
				return $image_path.$upload_data;
			}else{
				return $image_path."default.jpg";
			}
	    }else{
	    	return $image_path."default.jpg";
	    }
	}

	private function delete_image($id){
		$detail_so = $this->SalesOrderModel->get_detail_so_id($id)->result();
		foreach ($detail_so as $value) {
			$foto_parts = pathinfo($value->kode_kemas_so);
	    	$foto = $foto_parts['basename'];
	    	if ($foto != "default.jpg") {
			    $filename = explode(".", $foto)[0];
				return array_map('unlink', glob(FCPATH."uploads/sales_order/$filename.*"));
		    }
		}
	}

	public function hapus_so($id){
		$this->delete_image($id);
		$this->SalesOrderModel->delete_so($id);
		redirect('SalesOrder','refresh');
	}

	public function cetak_so($id){
		$file_name = "SO-".date('dmY');
		// $result['marketing'] = $this->SalesOrderModel->get_user_so_cetak($id)->row()->nama_user;
		$result['data_so'] = $this->SalesOrderModel->get_so_id($id)->row();
		$result['detail_so'] = $this->SalesOrderModel->get_detail_so_id($id)->result();
		$this->pdf->setPaper('A4','potrait');
		$this->pdf->filename = "$file_name";
		$this->pdf->load_view('marketing/sales_order/so_pdf',$result);
	}

}

/* End of file SalesOrder.php */
/* Location: ./application/controllers/SalesOrder.php */