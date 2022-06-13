<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Sample extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!empty($this->session->userdata('login'))) {
			$array = array(
				'active' => 'sample'
			);
			$this->session->set_userdata( $array );
		}
	}

	public function timeline_product($id = null){
		if (!is_null($id)) {
			$model = $this->RequestGlowModel;
			$temp = $model->get_request_msglow_id($id)->row();
			if (!is_null($temp)) {
				$data['id'] = $id;
				$data['produk'] = $model->get_request_msglow_id($id)->row();
				$this->load->view('msglow/timeline_pdf', $data, FALSE);
			}else{
				echo "<h2>Produk tidak ditemukan.</h2>";
			}
		}
	}

	public function acc(){
		if (empty($this->session->userdata('login'))) {
			redirect('login','refresh');
		}else{
			$level = $this->session->userdata('level');
			if ($level == 'marketing' || $level == 'direktur') {
				$result['sample'] = $this->SampleAwalModel->get_sample_acc()->result();
				$result['customer'] = $this->CustomerModel->get_customer()->result();
			}elseif ($level == 'tim_marketing') {
				$id = $this->session->userdata('id_user');
				$result['sample'] = $this->SampleAwalModel->get_sample_acc_tim($id)->result();
				$result['customer'] = $this->CustomerModel->get_customer_tim($id)->result();
			}
			$this->load->view('marketing/sample/data_sample_produk', $result, FALSE);
		}
	}

	public function form_request(){
		$this->load->view('marketing/sample_awal/form_sample', FALSE);
	}

	public function simpan_request(){
		if (!is_null($this->input->post('simpan_request'))) {
			$id_customer = "CST-".date('Ymdhis');
			$nama_customer = $this->input->post('nama_cust');
			$perusahaan = $this->input->post('nama_perusahaan');
			$jabatan = $this->input->post('jabatan_customer');
			$alamat_perusahaan = $this->input->post('alamat_perusahaan');
			$alamat_kirim = $this->input->post('alamat_cust');
			$telp = $this->input->post('telp_cust');
			$telp_perusahaan = $this->input->post('telp_perusahaan');

			$validasi = $this->validasi($telp);

			$arr_customer = [
				'id_customer' 				=> $id_customer,
				'nama_customer' 			=> $nama_customer,
				'nama_perusahaan_customer' 	=> $perusahaan,
				'jabatan_customer' 			=> $jabatan,
				'alamat_cust' 				=> $alamat_kirim,
				'alamat_perusahaan_kirim' 	=> $alamat_perusahaan,
				'telp_customer' 			=> $telp,
				'telp_perusahaan_customer' 	=> $telp_perusahaan,
				'verifikasi' 				=> $validasi
			];

			$this->CustomerModel->insert_customer($arr_customer);

			$nama_brand_briefing = $this->input->post('nama_brand_briefing');
			$gambar_logo_briefing = $this->input->post('gambar_logo_briefing');
			$model_logo_briefing = $this->input->post('model_logo_briefing');
			$selera_brand_briefing = $this->input->post('selera_brand_briefing');
			$font_briefing = $this->input->post('font_brand_briefing');
			$warna_briefing = $this->input->post('warna_brand_briefing');
			$target_marketing_briefing = $this->input->post('target_marketing_briefing');
			$referensi_logo_briefing = $this->input->post('referensi_logo_briefing');

			$arr_briefing = [
				'id_customer' => $id_customer,
				'tanggal_briefing_logo' => date('Y-m-d'),
				'nama_brand_briefing' => $nama_brand_briefing,
				'gambar_logo_briefing' => $gambar_logo_briefing,
				'model_logo_briefing' => $model_logo_briefing,
				'selera_brand_briefing' => $selera_brand_briefing,
				'font_briefing' => $font_briefing,
				'warna_briefing' => $warna_briefing,
				'target_marketing_briefing' => $target_marketing_briefing,
				'referensi_logo_briefing' => $referensi_logo_briefing
			];

			$this->SampleAwalModel->save_briefing($arr_briefing);

			$id_sample_awal = $this->input->post('id_sample');
			$tanggal_request_awal = date('Y-m-d H:i:s');
			$permintaan_sample_awal = $this->input->post('permintaan_sample');
			$spesifikasi_sample_awal = $this->input->post('spesifikasi');
			$target_harga_awal = $this->input->post('target_harga');
			$volume_sample_awal = $this->input->post('volume');

			foreach ($id_sample_awal as $key => $value) {
				$arr_sample = [
					'id_sample_awal' => $value,
					'id_customer' => $id_customer,
					'tanggal_request_awal' => $tanggal_request_awal,
					'permintaan_sample_awal' => $permintaan_sample_awal[$key],
					'spesifikasi_sample_awal' => $spesifikasi_sample_awal[$key],
					'target_harga_awal' => $target_harga_awal[$key],
					'volume_sample_awal' => $volume_sample_awal[$key],
					'foto_sample_awal' => $this->upload_image($value, $key)
				];
				$this->SampleAwalModel->save($arr_sample);
			}
			$this->load->view('marketing/sample_awal/success_request', FALSE);
		}else{
			echo "<h1><b>Error !</b></h1><br><h2>You dont have permission to access this file</h2>";
		}
	}

	private function upload_image($filename, $index){
		$files = $_FILES;
		$image_path = base_url().'uploads/sample_awal/';

	    if($_FILES['foto_sample_awal']['name'][$index] != ""){
			$_FILES['foto_sample_awal']['name']= $files['foto_sample_awal']['name'][$index];
	        $_FILES['foto_sample_awal']['type']= $files['foto_sample_awal']['type'][$index];
	        $_FILES['foto_sample_awal']['tmp_name']= $files['foto_sample_awal']['tmp_name'][$index];
	        $_FILES['foto_sample_awal']['error']= $files['foto_sample_awal']['error'][$index];
	        $_FILES['foto_sample_awal']['size']= $files['foto_sample_awal']['size'][$index];

	        $config['upload_path']          = './uploads/sample_awal/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['file_name']            = $filename;
			$config['overwrite']			= true;
			$config['max_size']             = 3000; // 3MB

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload("foto_sample_awal")) {
				$upload_data = $this->upload->data("file_name");
				return $image_path.$upload_data;
			}else{
				return $image_path."default.jpg";
			}
	    }else{
	    	return $image_path."default.jpg";
	    }
	}

	public function awal(){
		if (empty($this->session->userdata('login'))) {
			redirect('login','refresh');
		}else{
			$array = array(
				'active' => 'sample_awal'
			);
			$this->session->set_userdata($array);
			$level = $this->session->userdata('level');
			if ($level == 'marketing' || $level == 'direktur') {
				$result['briefing'] = $this->SampleAwalModel->get_briefing_logo()->result();
				$result['marketing'] = $this->UserModel->get_marketing()->result();
				$result['sample_awal'] = $this->SampleAwalModel->get_sample_awal()->result();
				$this->load->view('marketing/sample_awal/data_sample_awal', $result, FALSE);
			}elseif ($level == 'tim_marketing') {
				$id = $this->session->userdata('id_user');
				$result['briefing'] = $this->SampleAwalModel->get_briefing_logo_tim($id)->result();
				$result['sample_awal'] = $this->SampleAwalModel->get_sample_awal_tim($id)->result();
				$this->load->view('marketing/sample_awal/data_sample_awal', $result, FALSE);
			}elseif ($level == 'rnd') {
				$result['sample_awal'] = $this->SampleAwalModel->get_sample_awal_rnd()->result();
				$this->load->view('marketing/sample_awal/data_sample_awal_rnd', $result, FALSE);
			}
		}
	}

	public function hapus_awal($id){
		if (!empty($id)) {
			$this->delete_image($id);
			$this->SampleAwalModel->delete_awal($id);
			redirect('sample/awal','refresh');
		}	
	}

	private function delete_image($id){
		$detail_sample = $this->SampleAwalModel->get_sample_by_customer($id)->result();
		foreach ($detail_sample as $value) {
			$foto_parts = pathinfo($value->foto_sample_awal);
	    	$foto = $foto_parts['basename'];
	    	if ($foto != "default.jpg") {
			    $filename = explode(".", $foto)[0];
				return array_map('unlink', glob(FCPATH."uploads/sample_awal/$filename.*"));
		    }
		}
	}

	public function hapus_briefing($id = null){
		if (!is_null($id)) {
			$this->SampleAwalModel->delete_briefing($id);
			redirect('sample/awal','refresh');
		}	
	}

	public function list_request($id = null){
		if (empty($this->session->userdata('login'))) {
			redirect('login','refresh');
		}else{

			$array = array(	
				'active' => 'sample_awal'
			);

			$this->session->set_userdata($array);

			$level = $this->session->userdata('level');

			if (!is_null($id)) {
				$result['customer'] = $this->CustomerModel->get_customer_by_id($id)->row()->nama_customer;
				if ($level == 'marketing' || $level == 'tim_marketing' || $level == 'direktur') {
					$result['sample'] = $this->SampleAwalModel->get_list_request($id)->result();
				}elseif ($level == 'rnd') {
					$result['sample'] = $this->SampleAwalModel->get_list_request_rnd($id)->result();
				}

				foreach ($result['sample'] as $value) {
					$bom = $this->SampleAwalModel->get_bom_sample_active($value->id_sample_awal)->row();
					$value->kode = (!is_null($bom)) ? $bom->kode_bom_sample : '-';
				}

				$this->load->view('marketing/sample_awal/list_request', $result, FALSE);
				
			}else{
				redirect('dashboard','refresh');
			}
		}
	}

	public function list_revisi(){
		if (empty($this->session->userdata('login'))) {
			redirect('login','refresh');
		}else{
			$array = array(
				'active' => 'sample_awal'
			);
			$this->session->set_userdata($array);
			$id = $this->uri->segment(3);
			if (!empty($id)) {
				$data_sample = $this->SampleAwalModel->get_sample_awal_id($id)->row()->permintaan_sample_awal;
				if (is_null($data_sample)) {
					redirect('dashboard','refresh');
				}else{
					$result['sample'] = $data_sample;
					$result['revisi'] = $this->SampleAwalModel->get_list_revisi($id)->result();
					$this->load->view('marketing/sample_awal/list_revisi', $result, FALSE);
				}
			}else{
				redirect('dashboard','refresh');
			}
		}
	}

	public function bom($id = null){
		if (empty($this->session->userdata('login'))) {
			redirect('login','refresh');
		}else{
			if (!is_null($id)) {
				$array = array(
					'active' => 'sample_awal'
				);
	
				$this->session->set_userdata($array);

				$result['id'] = $id;
				$result['sample'] = $this->SampleAwalModel->get_sample_awal_id($id)->row();
				$result['bom'] = $this->SampleAwalModel->get_bom_sample($id)->result();
				$this->load->view('marketing/sample_awal/bom_sample_awal', $result, FALSE);
			}else{
				redirect('dashboard','refresh');
			}

		}
	}

	public function tambah_bom($id = null){
		if (empty($this->session->userdata('login'))) {
			redirect('login','refresh');
		}else{
			if (!is_null($id)) {
				$array = array(
					'active' => 'sample_awal'
				);
	
				$this->session->set_userdata($array);

				$result['id'] = $id;
				$result['data'] = $this->SampleAwalModel->get_sample_awal_id($id)->row();
				$result['produk'] = $this->ProdukModel->get_all_produk()->result();
				$this->load->view('marketing/sample_awal/tambah_bom_awal', $result, FALSE);
			}else{
				redirect('dashboard','refresh');
			}

		}
	}

	public function detail_bom($id = null){
		if (empty($this->session->userdata('login'))) {
			redirect('login','refresh');
		}else{
			if (!is_null($id)) {
				$array = array(
					'active' => 'sample_awal'
				);
	
				$this->session->set_userdata($array);

				$result['id'] = $id;
				$result['bom'] = $this->SampleAwalModel->get_bom_sample_id($id)->row();
				$result['detail'] = $this->SampleAwalModel->get_detail_bom_awal($id)->result();
				$this->load->view('marketing/sample_awal/detail_bom_awal', $result, FALSE);
			}else{
				redirect('dashboard','refresh');
			}

		}
	}

	public function simpan_bom(){
		if (empty($this->session->userdata('login'))) {
			redirect('login','refresh');
		}else{
			if ($this->input->post()) {
				$id = $this->input->post('id_sample');
				$kode = $this->input->post('kode_formula');
				$deskripsi = $this->input->post('deskripsi_formula');
				$filename = date('Ymdhis');

				$arr = [
					'id_sample_awal'	 			=> $id,
					'tanggal_bom_sample' 			=> date('Y-m-d H:i:s'),
					'kode_bom_sample' 				=> $kode,
					'file_bom_sample' 				=> $this->upload_berkas('uploads/sample_awal/formula_awal/',"$filename",'dokumen_formula'),
					'ket_bom_sample' 				=> $deskripsi,
					'status_bom_sample' 			=> '0'
				];
				
				$id_bom = $this->SampleAwalModel->save_bom_awal($arr);

				$id_produk = $this->input->post('id_produk');
				$persentase = $this->input->post('persentase');
				$jumlah_komposisi = $this->input->post('jumlah_komposisi');
	
				foreach ($id_produk as $key => $value) {
					$arr_detail = [
						'id_bom_sample'			=> $id_bom,
						'id_produk'				=> $value,
						'persentase'			=> $persentase[$key],
						'komposisi_per_unit'	=> $jumlah_komposisi[$key]
					];
	
					$this->SampleAwalModel->save_detail_bom_awal($arr_detail);
				}
				redirect("sample/bom/$id", 'refresh');
			}
		}
	}

	public function pilih_bom(){
		if (empty($this->session->userdata('login'))) {
			redirect('login','refresh');
		}else{
			if ($this->input->post()) {
				$id = $this->input->post('id');
				
				$arr_first = [
					'status_bom_sample' => '0'
				];

				$this->SampleAwalModel->update_active_bom_sample('1', $arr_first);

				$arr_active = [
					'status_bom_sample' => '1'
				];

				$this->SampleAwalModel->update_bom_sample($id, $arr_active);

				$response['status'] = '1';
				echo json_encode($response);
			}
		}
	}

	private function upload_berkas($path, $filename, $input){
		$config['upload_path']          = "./$path";
		$config['allowed_types']        = '*';
		$config['file_name']            = $filename;
		$config['overwrite']			= true;
		$config['max_size']             = 3000; 

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$image_path = base_url().$path;

		if ($this->upload->do_upload($input)) {
			$upload_data = $this->upload->data("file_name");
			return $image_path.$upload_data;
		}else{
			return '';
		}	
	}

	public function simpan_revisi(){
		$id_sample = $this->input->post('id_sample');
		$id_revisi = $this->input->post('id_revisi');
		$tanggal_revisi = $this->input->post('tanggal_revisi');
		$detail_revisi = $this->input->post('detail_revisi');
		$aksi = $this->input->post('aksi');

		if ($aksi == 'tambah') {
			$arr_revisi = [
				'id_sample_awal' => $id_sample,
				'tanggal_revisi' => date('Y-m-d H:i:s'),
				'detail_revisi' => $detail_revisi
			];
			$this->SampleAwalModel->save_revisi($arr_revisi);
		}elseif ($aksi == 'edit') {
			$arr_revisi = [
				'detail_revisi' => $detail_revisi
			];
			$this->SampleAwalModel->update_revisi($id_revisi,$arr_revisi);
		}else{
			echo 'Aksi salah !';
		}
		redirect("sample/list_revisi/$id_sample",'refresh');
	}

	public function hapus_revisi(){
		$id = $this->uri->segment(3);
		if (!empty($id)) {
			$id_sample = $this->SampleAwalModel->get_sample_by_revisi($id)->row()->id_sample_awal;
			$this->SampleAwalModel->delete_revisi($id);
			redirect("sample/list_revisi/$id_sample",'refresh');
		}else{
			redirect('dashboard','refresh');
		}
	}

	public function get_json_revisi(){
		$id = $this->input->post('id');
		$data_revisi = $this->SampleAwalModel->get_revisi_id($id)->row();
		echo json_encode($data_revisi);
	}

	public function send_rnd(){
		if (empty($this->session->userdata('login'))) {
			echo "<h1><b>Error !</b></h1><br><h2>You dont have permission to access this file</h2>";
		}else{
			$id = $this->uri->segment(3);
			$id_customer = $this->SampleAwalModel->get_sample_awal_id($id)->row()->id_customer;
			if (!empty($id)) {
				$arr_tgl = [
					'tanggal_request_rnd' => date('Y-m-d H:i:s')
				];
				$this->SampleAwalModel->update_sample_awal($id, $arr_tgl);
				redirect("sample/list_request/$id_customer",'refresh');
			}else{
				redirect('dashboard','refresh');
			}
		}
	}

	public function get_json_img(){
		if (empty($this->session->userdata('login'))) {
			echo "Access Forbidden !";
		}else{
			$id = $this->input->post('id');
			$data_img = $this->SampleAwalModel->get_sample_awal_id($id)->row()->foto_sample_awal;
			echo json_encode($data_img);
		}
	}

	public function set_marketing(){
		if (empty($this->session->userdata('login'))) {
			echo "Access Forbidden !";
		}else{
			$id_customer = $this->input->post('id_customer');
			$id_marketing = $this->input->post('marketing');
			$nomor_marketing = $this->UserModel->get_marketing_by_id($id_marketing);
			$nomor_customer = $this->UserModel->get_marketing_by_id($id_customer);

			$arr_marketing = ['id_user' => $id_marketing];

			$data_request = $this->SampleAwalModel->get_list_request($id_customer)->result();
			foreach ($data_request as $value) {
				$this->SampleAwalModel->update_sample_awal($value->id_sample_awal,$arr_marketing);
			}

			$this->bagi($nomor_marketing, $nomor_customer);
			$response['status'] = '1';
			echo json_encode($response);
		}
	}

	public function simpan_acc(){
		if (!is_null($this->input->post('btn_simpan_acc'))) {
			$id_marketing = $this->session->userdata('id_user');
			$nama_produk = $this->input->post('nama_produk');
			$deskripsi_logo = $this->input->post('deskripsi_logo');
			$id_merk = $this->input->post('nama_merk');
			$merk_haki = $this->input->post('merk_haki');
			$daftar_haki = (is_null($this->input->post('daftar_haki'))) ? 'Tidak' : $this->input->post('daftar_haki');
			$daftar_halal = $this->input->post('daftar_halal');
			$jenis_kemasan = $this->input->post('jenis_kemasan');
			$warna_kemasan = $this->input->post('warna_kemasan');
			$volume = $this->input->post('volume');
			$tema_kemasan = $this->input->post('tema_kemasan');
			$target_launching = $this->input->post('target_launching');
			$target_harga = $this->input->post('target_harga');
			$jenis_bentuk = $this->input->post('jenis_bentuk');
			$bahan_aktif = $this->input->post('bahan_aktif');
			$tekstur = $this->input->post('tekstur');
			$warna = $this->input->post('warna');
			$aroma = $this->input->post('aroma');
			$info_tambahan = $this->input->post('info_tambahan');

			$arr_sample_acc = [
				'id_brand_produk' => $id_merk,
				'id_user' => $id_marketing,
				'tanggal_sample_acc' => date('Y-m-d'),
				'nama_produk_acc' => $nama_produk,
				'deskripsi_logo_acc' => $deskripsi_logo,
				'merk_daftar_haki_acc' => $merk_haki,
				'daftar_haki_kosme_acc' => $daftar_haki,
				'produk_daftar_halal_acc' => $daftar_halal,
				'jenis_kemasan_acc' => $jenis_kemasan,
				'warna_kemasan_primer_acc' => $warna_kemasan,
				'volume_produk_acc' => $volume,
				'tema_kemasan_acc' => $tema_kemasan,
				'target_launching_acc' => $target_launching,
				'target_harga_acc' => $target_harga,
				'jenis_bentuk_acc' => $jenis_bentuk,
				'bahan_aktif_acc' => $bahan_aktif,
				'tekstur_acc' => $tekstur,
				'warna_acc' => $warna,
				'aroma_acc' => $aroma,
				'info_tambahan_acc' => $info_tambahan,
			];

			$this->SampleAwalModel->save_acc($arr_sample_acc);
			redirect('sample/acc','refresh');
		}else{
			echo "<h1><b>Error !</b></h1><br><h2>You dont have permission to access this file</h2>";
		}
	}

	public function cetak_acc(){
		if (empty($this->session->userdata('login'))) {
			echo "Access Forbidden !";
		}else{
			$id = $this->uri->segment(3);
			if (!empty($id)) {
				$result['sample'] = $this->SampleAwalModel->get_detail_sample_acc($id)->row();
				$nama_produk = $this->SampleAwalModel->get_detail_sample_acc($id)->row()->nama_produk_acc;
				$nama_customer = $this->SampleAwalModel->get_detail_sample_acc($id)->row()->nama_customer;
				$this->pdf->setPaper('A4','potrait');
				$this->pdf->filename = "$nama_customer-$nama_produk";
				$this->pdf->load_view('marketing/sample/sample_acc_pdf',$result);
			}
		}
	}

	public function hapus_acc($id){
		$this->SampleAwalModel->delete_sample_acc($id);
		redirect('sample/acc','refresh');
	}

	public function json_acc_customer(){
		if (empty($this->session->userdata('login'))) {
			echo "Access Forbidden !";
		}else{
			$id = $this->input->post('id');
			$result = $this->SampleAwalModel->get_acc_by_brand($id)->result();
			echo json_encode($result);
		}
	}

	public function json_acc_design(){
		if (empty($this->session->userdata('login'))) {
			echo "Access Forbidden !";
		}else{
			$id = $this->input->post('id');
			$result = $this->SampleAwalModel->get_acc_design_by_brand($id)->result();
			echo json_encode($result);
		}
	}

	public function json_row_acc(){
		if (empty($this->session->userdata('login'))) {
			echo "Access Forbidden !";
		}else{
			$id = $this->input->post('id');
			$result = $this->SampleAwalModel->get_acc_by_id($id)->row();
			$html = "<tr id='id$result->id_sample_acc'>";
			$html .= "<td><input type='checkbox' name='record[]' class='form-control form-control-sm'><input type='hidden' name='id_produk[]' value='$result->id_sample_acc'></td>";
			$html .= "<td><input type='text' class='form-control form-control-sm' name='nama_produk' value='$result->nama_produk_acc $result->volume_produk_acc' readonly=''></td>";
			$html .= "<td><input type='text' class='form-control form-control-sm' name='quantity_text[]' placeholder='Quantity' onkeyup='kurensi_kuantitas($result->id_sample_acc)'><input type='hidden' name='quantity[]' value='' onkeyup='kurensi_kuantitas($result->id_sample_acc)'></td>";
			$html .= "<td><input type='text' class='form-control form-control-sm' name='status_bpom[]' placeholder='Pilih status' list='list_status_bpom'><datalist id='list_status_bpom'><option value='Done'>Done</option><option value='Belum'>Belum</option></datalist></td>";
			$html .= "<td><input type='text' class='form-control form-control-sm' name='retur_text[]' placeholder='Jumlah retur' onkeyup='kurensi_retur($result->id_sample_acc)'><input type='hidden' name='retur[]' value='' onkeyup='kurensi_retur($result->id_sample_acc)'></td>";
			$html .= "<td><input type='text' class='form-control form-control-sm' name='terkirim_text[]' placeholder='Jumlah terkirim' onkeyup='kurensi_terkirim($result->id_sample_acc)'><input type='hidden' name='terkirim[]' value='' onkeyup='kurensi_terkirim($result->id_sample_acc)'></td>";
			$html .= "<td><input type='date' class='form-control form-control-sm' name='estimasi[]' value='' placeholder='Pilih estimasi'></td><td><input type='text' class='form-control form-control-sm' name='status_so[]' placeholder='Status SO'></td>";
			$html .= "<td><input type='file' class='form-control-file form-control-sm' name='kode_kemas_so[]'></td>";
			$html .= "<td><input type='text' class='form-control form-control-sm' name='harga_so_text[]' onkeyup='kurensi_harga_so($result->id_sample_acc)' placeholder='Harga...'><input type='hidden' name='harga_so[]' value='' onkeyup='kurensi_harga_so($result->id_sample_acc)'></td>";
			$html .= "</tr>";
			echo json_encode($html);
		}
	}

	public function json_row_bom(){
		if (empty($this->session->userdata('login'))) {
			echo "Access Forbidden !";
		}else{
			$id = $this->input->post('id');
			$result = $this->SampleAwalModel->get_acc_by_id($id)->row();
			$html = "";
			$html .= "<tr id='id$result->id_sample_acc'>";
			$html .= "<td><input type='checkbox' name='record[]' class='form-control form-control-sm'/><input type='hidden' name='id_produk[]' value='$result->id_sample_acc'/></td>";
			$html .= "<td><input type='text' class='form-control form-control-sm' name='nama_produk' value='$result->nama_produk_acc $result->volume_produk_acc' readonly=''/></td>";
			$html .= "<td><select name='shrink[]' class='form-control form-control-sm'><option value='Kemasan Primer'>Primer</option><option value='Inner Box'>Inner Box</option></select></td>";
			$html .= "<td><select name='inner_box[]' class='form-control form-control-sm'><option value='Iya'>Iya</option><option value='Tidak'>Tidak</option></select></td>";
			$html .= "<td><select name='label[]' class='form-control form-control-sm'><option value='Printing'>Printing</option><option value='Sticker'>Sticker</option></select></td>";
			$html .= "<td><select name='karton[]' class='form-control form-control-sm'><option value='Kosme'>Kosme</option><option value='Polos'>Polos</option></select></td>";
			$html .= "<td><input type='text' name='lain[]' value='' placeholder='Lain-lain' class='form-control form-control-sm'></td>";
			$html .= "<td><select name='coding[]' class='form-control form-control-sm'><option value='Iya'>Iya</option><option value='Tidak'>Tidak</option></select></td>";
			$html .= "<td><input type='text' name='ro1[]' value='' placeholder='Status' class='form-control form-control-sm'></td>";
			$html .= "<td><input type='file' name='foto_desain[]' placeholder='' class='form-control-file form-control-sm'></td>";
			$html .= "</tr>";

			echo json_encode($html);
		}
	}

	public function json_row_spp(){
		if (empty($this->session->userdata('login'))) {
			echo "Access Forbidden !";
		}else{
			$id = $this->input->post('id');
			$result = $this->SampleAwalModel->get_acc_by_id($id)->row();
			$html = "<tr id='id$result->id_sample_acc'>";
			$html .= "<td><input type='checkbox' name='record[]' class='form-control form-control-sm'><input type='hidden' name='id_produk[]' value='$result->id_sample_acc'></td>";
			$html .= "<td><input type='text' class='form-control form-control-sm' name='nama_produk' value='$result->nama_produk_acc' readonly=''></td>";
			$html .= "<td><input type='text' class='form-control form-control-sm' name='volume_produk' value='$result->volume_produk_acc' readonly=''></td>";
			$html .= "<td><input type='text' class='form-control form-control-sm' name='quantity_text[]' placeholder='Quantity' onkeyup='kurensi_kuantitas($result->id_sample_acc)' required><input type='hidden' name='quantity[]' value='' onkeyup='kurensi_kuantitas($result->id_sample_acc)'></td>";
			$html .= "<td><input type='date' name='tanggal_kirim_spp[]'  class='form-control form-control-sm' required=''></td>";
			$html .= "</tr>";
			echo json_encode($html);
		}
	}

	public function json_row_sjp(){
		if (empty($this->session->userdata('login'))) {
			echo "Access Forbidden !";
		}else{
			$id = $this->input->post('id');
			$result = $this->SampleAwalModel->get_acc_by_id($id)->row();
			$unique_id = date('Ymdhis');
			$html = "<tr id='id$unique_id'>";
			$html .= "<td><input type='hidden' value='".$unique_id."' name='unique_id[]'><input type='checkbox' name='record[]' class='form-control form-control-sm'><input type='hidden' name='id_produk_".$unique_id."[]' value='$result->id_sample_acc'></td>";
			$html .= "<td><input type='text' class='form-control form-control-sm' name='nama_produk' value='$result->nama_produk_acc' readonly=''></td>";
			$html .= "<td><input type='text' class='form-control form-control-sm currency-format' name='quantity_text[]' placeholder='Quantity...'required><input type='hidden' data-id='$unique_id' class='kontol' name='quantity_value_".$unique_id."[]'></td>";
			$html .= "<td><input type='text' class='form-control form-control-sm' name='nomor_batch_".$unique_id."[]' placeholder='Nomor batch...' required></td>";
			$html .= "<td><input type='text' class='form-control form-control-sm currency-format' name='quantity_karton_text[]' placeholder='Quantity/karton...' required><input class='kontol' data-id='$unique_id' type='hidden' name='quantity_karton_value_".$unique_id."[]'></td>";
			$html .= "<td><input type='month' name='expired_date_sjp_".$unique_id."[]'  class='form-control form-control-sm' required=''></td>";
			$html .= "<td><a class='btn btn-sm btn-primary tambah-produk' data-id='$unique_id'><i class='fas fa-plus'></i> Tambah</a><input type='hidden' id='$unique_id' name='subtotal_sjp_".$unique_id."[]'></td>";
			$html .= "</tr>";
			echo json_encode($html);
		}
	}

	public function json_nama_acc(){
		if (empty($this->session->userdata('login'))) {
			echo "Access Forbidden !";
		}else{
			$id = $this->input->post('id');
			$result = $this->SampleAwalModel->get_sample_awal_id($id)->row();
			echo json_encode($result);
		}
	}

	public function set_deadline(){
		if (empty($this->session->userdata('login'))) {
			echo "Access Forbidden !";
		}else{
			$id = $this->input->post('id_sample_awal');
			$id_customer = $this->SampleAwalModel->get_sample_awal_id($id)->row()->id_customer;
			$tgl_deadline = $this->input->post('tanggal_deadline_awal');

			$arr_deadline = ['deadline_sample_awal' => $tgl_deadline];
			$this->SampleAwalModel->update_sample_awal($id,$arr_deadline);
			redirect("sample/list_request/$id_customer",'refresh');
		}
	}

	public function set_tanggal_kirim(){
		if (empty($this->session->userdata('login'))) {
			echo "Access Forbidden !";
		}else{
			$id = $this->input->post('id_sample_awal');
			$id_customer = $this->SampleAwalModel->get_sample_awal_id($id)->row()->id_customer;
			$tanggal_kirim_sample = $this->input->post('tanggal_kirim_sample_awal');

			$arr_tgl_kirim = ['tanggal_kirim_sample' => $tanggal_kirim_sample];
			$this->SampleAwalModel->update_sample_awal($id,$arr_tgl_kirim);
			redirect("sample/list_request/$id_customer",'refresh');
		}
	}

	public function import_file(){
		if (empty($this->session->userdata('login'))) {
			echo "Access Forbidden !";
		}else{
			$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    
		    if(isset($_FILES['file_import']['name']) && in_array($_FILES['file_import']['type'], $file_mimes)) {
		        $arr_file = explode('.', $_FILES['file_import']['name']);
		        $extension = end($arr_file);
		        if('csv' == $extension){
		            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		        }elseif('xls' == $extension){
		            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		        }else {
		            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		        }
		        $spreadsheet = $reader->load($_FILES['file_import']['tmp_name']);
		        $sheetData = $spreadsheet->getActiveSheet()->toArray();
		        if (!empty($sheetData)) {
		            for ($i=1; $i<count($sheetData); $i++) {
		                $nama_customer = $sheetData[$i][1];
		                $nama_perusahaan = $sheetData[$i][2];
		                $jabatan_customer = $sheetData[$i][3];
		                $alamat_perusahaan = $sheetData[$i][4];
		                $telp_perusahaan = $sheetData[$i][5];
		                $telp_customer = $sheetData[$i][6];
		                $alamat_pengiriman = $sheetData[$i][7];

		                $id_customer = "CST-".date('Ymdhis').$i;

		                $arr_customer = [
		                	'id_customer' => $id_customer,
		                	'nama_customer' => $nama_customer,
		                	'nama_perusahaan_customer' => $nama_perusahaan,
		                	'jabatan_customer' => $jabatan_customer,
		                	'alamat_cust' => $alamat_pengiriman,
		                	'alamat_perusahaan_kirim' => $alamat_perusahaan,
		                	'telp_customer' => $telp_customer,
		                	'telp_perusahaan_customer' => $telp_perusahaan
		                ];

		                $this->CustomerModel->insert_customer($arr_customer);

		                $nama_brand_briefing = $sheetData[$i][8];
		                $gambar_logo_briefing = $sheetData[$i][9];
		                $font_briefing = $sheetData[$i][10];
		                $warna_briefing = $sheetData[$i][11];
		                $target_marketing_briefing = $sheetData[$i][12];
		                $referensi_logo_briefing = $sheetData[$i][13];
		                $selera_brand_briefing = $sheetData[$i][14];
		                $model_logo_briefing = $sheetData[$i][15];
		                $tanggal_request_awal = date('Y-m-d',strtotime($sheetData[$i][16]));

		                $arr_briefing = [
		                	'id_customer' => $id_customer,
		                	'tanggal_briefing_logo' => $tanggal_request_awal,
		                	'nama_brand_briefing' => $nama_brand_briefing,
		                	'gambar_logo_briefing' => $gambar_logo_briefing,
		                	'model_logo_briefing' => $model_logo_briefing,
		                	'selera_brand_briefing' => $selera_brand_briefing,
		                	'font_briefing' => $font_briefing,
		                	'warna_briefing' => $warna_briefing,
		                	'target_marketing_briefing' => $target_marketing_briefing,
		                	'referensi_logo_briefing' => $referensi_logo_briefing
		                ];

		                $this->SampleAwalModel->save_briefing($arr_briefing);

		                $permintaan_sample_awal = $sheetData[$i][17];
		                $target_harga_awal = $sheetData[$i][18];
		                $spesifikasi_sample_awal = $sheetData[$i][19];

		                $arr_sample_awal = [
		                	'id_sample_awal' => date('Ymdhis').$i,
		                	'id_customer' => $id_customer, 
		                	'id_user' => NULL, 
		                	'tanggal_request_awal' => $tanggal_request_awal, 
		                	'permintaan_sample_awal' => $permintaan_sample_awal, 
		                	'spesifikasi_sample_awal' => $spesifikasi_sample_awal, 
		                	'target_harga_awal' => $target_harga_awal, 
		                	'volume_sample_awal' => '', 
		                	'foto_sample_awal' => 'http://kosmeproduct.com/kosme/uploads/sample_awal/default.jpg'
		                ];
		               
		                $this->SampleAwalModel->save($arr_sample_awal);
		            }
		            
		            $arr_log = [
		            	'tanggal_log' => date('Y-m-d H:i:s'),
		            	'nama_pengguna' => $this->session->userdata('nama_user'),
		            	'aksi_log' => 'Import file sample awal '.$_FILES['file_import']['name']
		            ];
		            $this->SampleAwalModel->save_log($arr_log);

		            redirect('sample/awal','refresh');
		        }
		        
		    }
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
			    		'value' =>  $this->SampleAwalModel->get_data_daily(date('Y-m-d', $time))->row()->jumlah
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
		    		'value' =>  $this->SampleAwalModel->get_data_daily($value->format('Y-m-d'))->row()->jumlah
		    	);
		    	array_push($mresult, $mlist);
			}

			echo json_encode($mresult);
		}
	}

	public function json_weekly_chart(){
		if (!empty($this->session->userdata('login'))) {
			$data_week_1 = $this->SampleAwalModel->get_data_weekly('1')->row();
			$data_week_2 = $this->SampleAwalModel->get_data_weekly('2')->row();
			$data_week_3 = $this->SampleAwalModel->get_data_weekly('3')->row();
			$data_week_4 = $this->SampleAwalModel->get_data_weekly('4')->row();

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

			$data_week_1 = $this->SampleAwalModel->get_weekly_range('1', $bulan, $tahun)->row();
			$data_week_2 = $this->SampleAwalModel->get_weekly_range('2', $bulan, $tahun)->row();
			$data_week_3 = $this->SampleAwalModel->get_weekly_range('3', $bulan, $tahun)->row();
			$data_week_4 = $this->SampleAwalModel->get_weekly_range('4', $bulan, $tahun)->row();

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
				$response["month_$i"] = $this->SampleAwalModel->get_monthly_chart("0$i")->row()->jumlah;
			}

			echo json_encode($response);
		}
	}

	public function json_monthly_range(){
		if (!empty($this->session->userdata('login'))) {
			$tahun = $this->input->post('tahun');

			for ($i=1; $i < 13; $i++) { 
				$response["month_$i"] = $this->SampleAwalModel->get_monthly_range("0$i",$tahun)->row()->jumlah;
			}

			echo json_encode($response);	
		}
	}

	public function json_daily_chart_acc(){
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
			    		'value' =>  $this->SampleAwalModel->get_data_daily_acc(date('Y-m-d', $time))->row()->jumlah
			    	);
			    array_push($list, $mlist);
			}

			echo json_encode($list);	
		}
	}

	public function json_daily_range_acc(){
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
		    		'value' =>  $this->SampleAwalModel->get_data_daily_acc($value->format('Y-m-d'))->row()->jumlah
		    	);
		    	array_push($mresult, $mlist);
			}

			echo json_encode($mresult);
		}
	}

	public function json_weekly_chart_acc(){
		if (!empty($this->session->userdata('login'))) {
			$data_week_1 = $this->SampleAwalModel->get_data_weekly_acc('1')->row();
			$data_week_2 = $this->SampleAwalModel->get_data_weekly_acc('2')->row();
			$data_week_3 = $this->SampleAwalModel->get_data_weekly_acc('3')->row();
			$data_week_4 = $this->SampleAwalModel->get_data_weekly_acc('4')->row();

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

	public function json_weekly_range_acc(){
		if (!empty($this->session->userdata('login'))) {
			$bulan = $this->input->post('bulan');
			$tahun = $this->input->post('tahun');

			$data_week_1 = $this->SampleAwalModel->get_weekly_range_acc('1', $bulan, $tahun)->row();
			$data_week_2 = $this->SampleAwalModel->get_weekly_range_acc('2', $bulan, $tahun)->row();
			$data_week_3 = $this->SampleAwalModel->get_weekly_range_acc('3', $bulan, $tahun)->row();
			$data_week_4 = $this->SampleAwalModel->get_weekly_range_acc('4', $bulan, $tahun)->row();

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

	public function json_monthly_chart_acc(){
		if (!empty($this->session->userdata('login'))) {
			for ($i=1; $i < 13; $i++) { 
				$response["month_$i"] = $this->SampleAwalModel->get_monthly_chart_acc("0$i")->row()->jumlah;
			}

			echo json_encode($response);
		}
	}

	public function json_monthly_range_acc(){
		if (!empty($this->session->userdata('login'))) {
			$tahun = $this->input->post('tahun');

			for ($i=1; $i < 13; $i++) { 
				$response["month_$i"] = $this->SampleAwalModel->get_monthly_range_acc("0$i",$tahun)->row()->jumlah;
			}

			echo json_encode($response);
		}
	}

	public function json_status_sample(){
		if (empty($this->session->userdata('login'))) {
			echo "Access Forbidden !";
		}else{
			$id = $this->input->post('id');
			$result = $this->SampleAwalModel->get_sample_awal_id($id)->row();
			echo json_encode($result);
		}
	}

	public function json_update_status(){
		if (empty($this->session->userdata('login'))) {
			echo "Access Forbidden !";
		}else{
			$id = $this->input->post('id');
			$status = $this->input->post('status');

			$arr_status = ['status_sample_awal' => $status];

			$update = $this->SampleAwalModel->update_sample_awal($id, $arr_status);
			if($update == TRUE){
				$response['status'] = '1';
				$response['pesan'] = 'Berhasil mengubah status sample awal.';
			}else{
				$response['status'] = '0';
				$response['pesan'] = 'Gagal mengubah status sample awal.';
			}
			echo json_encode($response);
		}
	}

	private function validasi($nomor){
		$data = array(
			'number' 	=> $nomor,
			'message' 	=> 'Terimakasih telah mengisi form permintaan sample Silahkan klik link dibawah ini untuk meninjau survey anda https://kosme.co.id'
		);

		$headers = [
			'Content-Type: application/json'
		];
		
	
		$url = "http://167.99.76.22:3200/validate";

		$ch = curl_init( $url );
		curl_setopt( $ch, CURLOPT_POST, true);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt( $ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
	
		$response = curl_exec( $ch );
		return $response;
	}

	private function bagi($marketing, $customer){
	
		$data = array(
			'type' 		=> 'text',
			'content' 	=> 'Halo, namaku maman greget',
			'marketing' => $marketing,
			'customer' 	=> $customer
		);

		$headers = [
			'Content-Type: application/json'
		];
		
	
		$url = "http://167.99.76.22:3200/chat/switch";

		$ch = curl_init( $url );
		curl_setopt( $ch, CURLOPT_POST, true);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt( $ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
	
		$response = curl_exec( $ch );
		return $response;
	}

}

/* End of file Sample.php */
/* Location: ./application/controllers/Sample.php */