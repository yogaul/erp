<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Glow extends CI_Controller {

    public function __construct(){
		parent::__construct();
		if (empty($this->session->userdata('login'))) {
			redirect('login','refresh');
		}
		$array = array(
			'active' => 'glow'
		);
		$this->session->set_userdata( $array );
	}

    public function index(){
		$data['produk'] = $this->MsglowModel->get_msglow()->result();
        $this->load->view('gudang/produk_jadi/data_msglow', $data, FALSE);	
    }

	public function simpan(){
		$nama_produk = $this->input->post('nama_produk');
		$kode_produk = $this->input->post('kode_produk');
		$volume_produk = $this->input->post('volume_produk');
		$stok_produk = $this->input->post('stok_produk');
		$keterangan_produk = $this->input->post('keterangan_produk');
		$aksi = $this->input->post('aksi');

		$arr_produk = [
			'nama_produk_msglow' => $nama_produk,
			'kode_produk_msglow' => $kode_produk,
			'volume_produk_msglow' => $volume_produk,
			'stok_produk_msglow' => $stok_produk,
			'keterangan_produk_msglow' => $keterangan_produk
		];

		if ($aksi == 'tambah') {
			$this->MsglowModel->save_msglow($arr_produk);
		}elseif($aksi == 'edit'){
			$id = $this->input->post('id_msglow');
			$this->MsglowModel->update_msglow($id, $arr_produk);
		}
		
		redirect('glow','refresh');
		
	}

	public function bom($id = null){
		if (!is_null($id)) {
			$result['id'] = $id;
			$result['bom'] = $this->MsglowModel->get_msglow_bom($id)->result();
			$this->load->view('ppic/bom_produk_jadi', $result, FALSE);
		}
	}

	public function buat_bom($id = null){
		if (!is_null($id)) {
			$result['id'] = $id;
			$result['data'] = $this->MsglowModel->get_msglow_id($id)->row();
			$result['produk'] = $this->ProdukModel->get_all_produk()->result();
			$this->load->view('ppic/tambah_bom_produk', $result, FALSE);
		}
	}

	public function hapus_bom($id = null){
		if (!is_null($id)) {
			$this->MsglowModel->delete_bom_msglow($id);
			redirect("glow/bom/$id",'refresh');
		}
	}

	public function simpan_bom(){
		if ($this->input->post()) {
			$id = $this->input->post('id_msglow');
			$tgl_bom = $this->input->post('tgl_bom');
			$kode_formula = $this->input->post('kode_formula');
			$catatan_bom = $this->input->post('catatan_bom');

			$arr_bom = [
				'id_produk_msglow'		=> $id,
				'tanggal_bom_produk'	=> $tgl_bom,
				'kode_formula_produk'	=> $kode_formula,
				'ket_bom_produk'		=> $catatan_bom
			];

			$id_bom = $this->MsglowModel->save_bom_msglow($arr_bom);

			$id_produk = $this->input->post('id_produk');
			$persentase = $this->input->post('persentase');
			$jumlah_komposisi = $this->input->post('jumlah_komposisi');

			foreach ($id_produk as $key => $value) {
				$arr_detail = [
					'id_bom_produk_jadi'	=> $id_bom,
					'id_produk'				=> $value,
					'persentase'			=> $persentase[$key],
					'komposisi_per_unit'	=> $jumlah_komposisi[$key]
				];

				$this->MsglowModel->save_detail_bom_msglow($arr_detail);
			}
			redirect("glow/bom/$id",'refresh');
		}
	}

	public function detail_bom($id = null){
		if (!is_null($id)) {
			$result['bom'] = $this->MsglowModel->get_msglow_bom_id($id)->row();
			$result['detail'] = $this->MsglowModel->get_detail_bom_msglow($id)->result();
			$this->load->view('ppic/detail_bom_produk', $result, FALSE);
		}
	}

	public function json_msglow(){
		$id = $this->input->post('id');
		$result = $this->MsglowModel->get_msglow_id($id)->row();
		echo json_encode($result);
	}

	public function hapus($id){
		$this->MsglowModel->delete_msglow($id);
		redirect('glow','refresh');
	}

	public function json_row_glow(){
		$id = $this->input->post('id');
		$result = $this->MsglowModel->get_msglow_id($id)->row();
		$unique_id = date('Ymdhis');
		$html = "<tr id='id$unique_id'>";
		$html .= "<td><input type='hidden' value='".$unique_id."' name='unique_id[]'><input type='checkbox' name='record[]' class='form-control form-control-sm'><input type='hidden' name='id_produk_".$unique_id."[]' value='$result->id_produk_msglow'></td>";
		$html .= "<td><input type='text' class='form-control form-control-sm' name='nama_produk' value='$result->nama_produk_msglow' readonly=''></td>";
		$html .= "<td><input type='text' class='form-control form-control-sm currency-format' name='quantity_text[]' placeholder='Quantity...'required><input type='hidden' data-id='$unique_id' class='kontol' name='quantity_value_".$unique_id."[]'></td>";
		$html .= "<td><input type='text' class='form-control form-control-sm' name='nomor_batch_".$unique_id."[]' placeholder='Nomor batch...' required></td>";
		$html .= "<td><input type='text' class='form-control form-control-sm currency-format' name='quantity_karton_text[]' placeholder='Quantity/karton...' required><input class='kontol' data-id='$unique_id' type='hidden' name='quantity_karton_value_".$unique_id."[]'></td>";
		$html .= "<td><input type='month' name='expired_date_sjp_".$unique_id."[]'  class='form-control form-control-sm' required=''></td>";
		$html .= "<td><a class='btn btn-sm btn-primary tambah-produk' data-id='$unique_id'><i class='fas fa-plus'></i> Tambah</a><input type='hidden' id='$unique_id' name='subtotal_sjp_".$unique_id."[]'></td>";
		$html .= "</tr>";
		echo json_encode($html);
		// var_dump($html);
	}

	public function json_row_sertem(){
		$id = $this->input->post('id');
		$result = $this->MsglowModel->get_msglow_id($id)->row();
		$unique_id = date('Ymdhis');
		$html = "<tr id='id$unique_id'>";
		$html .= "<td><input type='hidden' value='".$unique_id."' name='unique_id[]'><input type='checkbox' name='record[]' class='form-control form-control-sm'><input type='hidden' name='id_produk_".$unique_id."[]' value='$result->id_produk_msglow'></td>";
		$html .= "<td><input type='text' class='form-control form-control-sm' name='nama_produk' value='$result->nama_produk_msglow' readonly=''></td>";
		$html .= "<td><input type='text' class='form-control form-control-sm currency-format' name='quantity_text[]' placeholder='Quantity...'required><input type='hidden' data-id='$unique_id' class='kontol' name='quantity_value_".$unique_id."[]'></td>";
		$html .= "<td><input type='text' class='form-control form-control-sm' name='nomor_batch_".$unique_id."[]' placeholder='Nomor batch...' required></td>";
		$html .= "<td><input type='text' class='form-control form-control-sm currency-format' name='quantity_karton_text[]' placeholder='Quantity/karton...' required><input class='kontol' data-id='$unique_id' type='hidden' name='quantity_karton_value_".$unique_id."[]'></td>";
		$html .= "<td><input type='text' name='no_pallet_sertem_".$unique_id."[]'  class='form-control form-control-sm' required='' placeholder='No. Identitas Pallet...'></td>";
		$html .= "<td><a class='btn btn-sm btn-primary tambah-produk' data-id='$unique_id'><i class='fas fa-plus'></i> Tambah</a><input type='hidden' id='$unique_id' name='subtotal_sertem_".$unique_id."[]'></td>";
		$html .= "</tr>";
		echo json_encode($html);
	}

	public function json_detail_bom(){
		$id_bom = $this->input->post('id_bom');
		$data = $this->MsglowModel->get_detail_bom_msglow($id_bom)->result();
		echo json_encode($data);
	}

	public function json_detail_formula(){
		$model = $this->RequestGlowModel;

		$id_bom = $this->input->post('id_bom');
		$data = $model->get_detail_formula($id_bom)->result();
		echo json_encode($data);
	}

	public function json_bom_produk(){
		$id_produk = $this->input->post('id_produk');
		$data = $this->MsglowModel->get_msglow_bom($id_produk)->result();
		echo json_encode($data);
	}

	public function json_bom_request(){
		$model = $this->RequestGlowModel;

		$id_produk = $this->input->post('id_produk');
		$data = $model->get_formula($id_produk)->result();
		echo json_encode($data);
	}

	public function log_glow($id){
		if (!empty($id)) {
			$result['data']= $this->MsglowModel->get_msglow_id($id)->row();
			$result['nama'] = $result['data']->nama_produk_msglow;
			$result['id'] = $id;
			$id = $result['data']->id_produk_msglow;
			$result['data_log'] = $this->LogModel->get_log_msglow($id)->result();
			$this->load->view('gudang/log_msglow/data_log_msglow', $result, FALSE);
		}
	}

	public function permintaan(){
		if ($this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier' 
			||  $this->session->userdata('level') == 'ppic' ||  $this->session->userdata('level') == 'rnd' ||  $this->session->userdata('level') == 'marketing') {
			$array = array(
				'active' => 'request' 
			);
			$this->session->set_userdata( $array );
		}
		$model = $this->RequestGlowModel;
		if ($this->session->userdata('level') == 'ms_glow' || $this->session->userdata('level') == 'kci') {
			$data['request'] = $model->get_request_msglow()->result();
		}else{
			$data['request'] = $model->get_request_kosme()->result();
		}
		$this->load->view('msglow/msglow_request', $data, FALSE);
	}

	public function simpan_request(){
		$model = $this->RequestGlowModel;
	
		$aksi = $this->input->post('aksi');
		$background = $this->input->post('background');
		$requester = $this->input->post('requester');
		$nama_produk = $this->input->post('nama_produk');
		$jenis_bentuk = $this->input->post('jenis_bentuk');
		$bahan_aktif = $this->input->post('bahan_aktif');
		$tekstur = $this->input->post('tekstur');
		$warna = $this->input->post('warna');
		$aroma = $this->input->post('aroma');
		$volume = $this->input->post('volume');
		$bentuk_kemasan = $this->input->post('bentuk_kemasan');
		$claim_needs = $this->input->post('claim_needs');
		$target_harga = $this->input->post('target_harga');
		$target_launching = $this->input->post('target_launching');
		$kategori = ($this->session->userdata('level') == 'ms_glow') ? 'MS Glow' : 'KOSME';
		$filename = date('Ymdhis');

		if ($aksi == 'tambah') {
			$arr = [
				'tanggal_request' => date('Y-m-d H:i:s'),
				'background' => $background,
				'requester_sponsor' => $requester,
				'usulan_nama_produk' => $nama_produk,
				'spesifikasi_sediaan' => $jenis_bentuk,
				'spesifikasi_tekstur' => $tekstur,
				'spesifikasi_warna' => $warna,
				'spesifikasi_aroma' => $aroma,
				'spesifikasi_volume' => $volume,
				'spesifikasi_kemasan' => $bentuk_kemasan,
				'spesifikasi_bahan' => $bahan_aktif,
				'spesifikasi_claim_needs' => $claim_needs,
				'target_harga' => $target_harga,
				'target_launching' => $target_launching,
				'foto_produk_dupe' => $this->upload_berkas('uploads/msglow_request/dupe/',"$filename",'dupe_produk'),
				'kategori_request' => $kategori,
				'acc_kgi' => 'Belum',
				'tanggal_acc_kgi' => '0000-00-00 00:00:00',
				'acc_kci' => ($this->session->userdata('level') == 'ms_glow') ? 'Belum' : 'Sudah',
				'tanggal_acc_kci' => '0000-00-00 00:00:00',
				'status_request_msglow' => 'NPD REQUEST'
			];

			$id_request = $model->save_request_msglow($arr);
			$message = $this->generate_msg($id_request,$nama_produk,"Permintaan produk oleh $kategori");
			$this->simpan_log($id_request,'NPD REQUEST',"Permintaan produk oleh $kategori");
			$this->send_email('NPD REQUEST', $message);
			
		}elseif ($aksi == 'edit') {
			$id = $this->input->post('id_request');
			$temp_dupe = $this->input->post('temp_dupe_produk');
			$new_dupe = $_FILES['dupe_produk']['tmp_name'];

			$last_dupe = (!file_exists($new_dupe)) ? $temp_dupe : $this->upload_berkas('uploads/msglow_request/dupe/',"$filename",'dupe_produk');

			$data = $model->get_request_msglow_id($id)->row();
			$ubahan = "perubahan";

			if ($background != $data->background) {
				$ubahan .= " background $data->background menjadi $background,";
			}
			
			if ($requester != $data->requester_sponsor) {
				$ubahan .= " requester $data->requester_sponsor menjadi $requester,";
			}
			
			if ($nama_produk != $data->usulan_nama_produk) {
				$ubahan .= " usulan nama produk $data->usulan_nama_produk menjadi $nama_produk,";
			}
			
			if ($jenis_bentuk != $data->spesifikasi_sediaan) {
				$ubahan .= " sediaan $data->spesifikasi_sediaan menjadi $jenis_bentuk,";
			}
			
			if ($bahan_aktif != $data->spesifikasi_bahan) {
				$ubahan .= " bahan aktif $data->spesifikasi_bahan menjadi $bahan_aktif,";
			}
			
			if ($tekstur != $data->spesifikasi_tekstur) {
				$ubahan .= " tekstur $data->spesifikasi_tekstur menjadi $tekstur,";
			}
			
			if ($warna != $data->spesifikasi_warna) {
				$ubahan .= " warna $data->spesifikasi_warna menjadi $warna,";
			}
			
			if ($aroma != $data->spesifikasi_aroma) {
				$ubahan .= " aroma $data->spesifikasi_aroma menjadi $aroma,";
			}
			
			if ($volume != $data->spesifikasi_volume) {
				$ubahan .= " volume $data->spesifikasi_volume menjadi $volume,";
			}
			
			if ($bentuk_kemasan != $data->spesifikasi_kemasan) {
				$ubahan .= " bentuk kemasan $data->spesifikasi_kemasan menjadi $bentuk_kemasan,";
			}
			
			if ($claim_needs != $data->spesifikasi_claim_needs) {
				$ubahan .= " claim needs $data->spesifikasi_claim_needs menjadi $claim_needs,";
			}
			
			if ($target_harga != $data->target_harga) {
				$ubahan .= " target harga Rp.".number_format($data->target_harga,0,',','.')." menjadi Rp.".number_format($target_harga,0,',','.').",";
			}
			
			if ($target_launching != $data->target_launching) {
				$ubahan .= " target launching ".date('d/m/Y', strtotime($data->target_launching))." menjadi ".date('d/m/Y', strtotime($target_launching)).",";
			}

			if (file_exists($new_dupe)) {
			   	$ubahan .= " foto produk dupe dari <a class='btn btn-sm btn-primary' href='$data->foto_produk_dupe'><i class='fas fa-file'></i> File</a> menjadi <a class='btn btn-sm btn-primary' href='$last_dupe'><i class='fas fa-file'></i> File</a>";
			}
			
			$arr = [
				'background' => $background,
				'requester_sponsor' => $requester,
				'usulan_nama_produk' => $nama_produk,
				'spesifikasi_sediaan' => $jenis_bentuk,
				'spesifikasi_tekstur' => $tekstur,
				'spesifikasi_warna' => $warna,
				'spesifikasi_aroma' => $aroma,
				'spesifikasi_volume' => $volume,
				'spesifikasi_kemasan' => $bentuk_kemasan,
				'spesifikasi_bahan' => $bahan_aktif,
				'spesifikasi_claim_needs' => $claim_needs,
				'target_harga' => $target_harga,
				'target_launching' => $target_launching,
				'foto_produk_dupe' => $last_dupe,
				'status_request_msglow' => ($ubahan != "perubahan") ? 'Perubahan Spesifikasi' : $data->status_request_msglow
			];

			$model->update_request_msglow($id, $arr);

			if ($ubahan != "perubahan") {
				$message = $this->generate_msg($id,$nama_produk,rtrim($ubahan,','));
				$this->simpan_log($id, 'Perubahan Spesifikasi', rtrim($ubahan,','));
				$this->send_email('Perubahan Spesifikasi', $message);
			}
		}

		redirect('glow/permintaan','refresh');
	
	}

	public function formula($id = null){
		if (!is_null($id)) {
			if ($this->session->userdata('level') == 'rnd' || $this->session->userdata('level') == 'marketing' || $this->session->userdata('level') == 'tim_marketing') {
				
				$array = array(
					'active' => 'request'
				);
				
				$this->session->set_userdata( $array );
				
			}
			$model = $this->RequestGlowModel;
			$result['id'] = $id;
			$result['mrequest'] = $model->get_request_msglow_id($id)->row();
			$result['formula'] = $model->get_formula($id)->result();
			$this->load->view('msglow/formula_request', $result, FALSE);
		}
	}

	public function tambah_formula($id = null){
		if (!is_null($id)) {
			if ($this->session->userdata('level') == 'rnd') {
				
				$array = array(
					'active' => 'request'
				);
				
				$this->session->set_userdata( $array );
				
			}

			$model = $this->RequestGlowModel;
			$result['id'] = $id;
			$result['produk'] = $this->ProdukModel->get_all_produk()->result();
			$result['data'] = $model->get_request_msglow_id($id)->row();

			if ($result['data']->tahun_start_formula != 0 && $result['data']->tahun_end_formula != 0) {
				$status = 'reset';
			}else if ($result['data']->tahun_start_formula != 0 && $result['data']->tahun_end_formula == 0) {
				$status = 'lanjut';
			}else {
				$status = 'mulai';
			}

			$result['status'] = $status;

			$this->load->view('msglow/tambah_formula_request', $result, FALSE);
		}
	}

	public function detail_formula($id = null){
		if (!is_null($id)) {
			if ($this->session->userdata('level') == 'rnd') {
				
				$array = array(
					'active' => 'request'
				);
				
				$this->session->set_userdata( $array );
				
			}
			$model = $this->RequestGlowModel;
			$result['id'] = $id;
			$result['bom'] = $model->get_formula_id($id)->row();
			$result['mrequest'] = $model->get_request_msglow_id($result['bom']->id_msglow_request)->row();
			$result['detail'] = $model->get_detail_formula($id)->result();
			$this->load->view('msglow/detail_formula_request', $result, FALSE);
		}
	}

	public function end_formula($id = null){
		if (!is_null($id)) {
			$model = $this->RequestGlowModel;
			$arr = [
				'end_formula' => date('Y-m-d H:i:s')
			];
			$model->update_request_msglow($id, $arr);
			redirect("glow/formula/$id","refresh");
		}
	}

	public function simpan_formula(){
		if($this->input->post()){
			$model = $this->RequestGlowModel;
			$id = $this->input->post('id_request');
			$aksi = $this->input->post('aksi');
			$volume = $this->input->post('volume_produk');
			$kode = $this->input->post('kode_formula');
			$deskripsi = $this->input->post('deskripsi_formula');
			$filename = date('Ymdhis');
			
			$arr = [
				'id_msglow_request' 			=> $id,
				'tanggal_formula_msglow' 		=> date('Y-m-d H:i:s'),
				'kode_formula_msglow' 			=> $kode,
				'volume_msglow' 				=> $volume,
				'file_formula_msglow' 			=> $this->upload_berkas('uploads/msglow_request/formula/',"$filename",'dokumen_formula'),
				'deskripsi_formula_msglow' 		=> $deskripsi,
				'acc_formula_msglow' 			=> 'Belum',
				'tanggal_acc_formula_msglow'	=> '0000-00-00 00:00:00',
				'keterangan_acc_formula_msglow'	=> '-',
			];

			$id_formula = $model->save_formula($arr);

			$id_produk = $this->input->post('id_produk');
			$persentase = $this->input->post('persentase');
			$jumlah_komposisi = $this->input->post('jumlah_komposisi');

			foreach ($id_produk as $key => $value) {
				$arr_detail = [
					'id_formula_msglow'		=> $id_formula,
					'id_produk'				=> $value,
					'persentase'			=> $persentase[$key],
					'komposisi_per_unit'	=> $jumlah_komposisi[$key]
				];

				$model->save_detail_formula($arr_detail);
			}
			
			$this->simpan_log($id,'FORMULA ON PROGRESS', $deskripsi);

			if ($aksi == 'reset') {
				$arr_status = [
					'status_request_msglow' => 'FORMULA ON PROGRESS',
					'start_formula' => date('Y-m-d H:i:s'),
					'end_formula' => '0000-00-00 00:00:00'
				];
			}elseif ($aksi == 'lanjut') {
				$arr_status = [
					'status_request_msglow' => 'FORMULA ON PROGRESS'
				];
			}elseif ($aksi == 'mulai') {
				$arr_status = [
					'status_request_msglow' => 'FORMULA ON PROGRESS',
					'start_formula' => date('Y-m-d H:i:s'),
					'end_formula' => '0000-00-00 00:00:00'
				];
			}

			$model->update_request_msglow($id, $arr_status);
			$mrequest = $model->get_request_msglow_id($id)->row()->usulan_nama_produk;
			$message = $this->generate_msg($id,$mrequest,$deskripsi);
			$this->send_email('FORMULA ON PROGRESS', $message);

			redirect("glow/formula/$id", 'refresh');
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

	public function acc_formula($id = null){
		if (!is_null($id)) {
			$model = $this->RequestGlowModel;
			$request = $model->get_formula_id($id)->row()->id_msglow_request;
			$arr = [
				'acc_formula_msglow' => 'Sudah',
				'tanggal_acc_formula_msglow' => date('Y-m-d H:i:s'),
				'keterangan_acc_formula_msglow' => 'Disetujui'
			];
			$model->update_formula($id, $arr);
			$this->simpan_log($request,'Development Formula','Formula produk request disetujui KGI');

			$arr_status = [
				'status_request_msglow' => 'Development Formula'
			];
			$model->update_request_msglow($request, $arr_status);
			$mrequest = $model->get_request_msglow_id($request)->row()->usulan_nama_produk;
			$message = $this->generate_msg($request,$mrequest,'Formula produk request disetujui KGI');
			$this->send_email('Development Formula', $message);

			redirect("glow/formula/$request",'refresh');
		}else{
			redirect("dashboard",'refresh');
		}
	}

	public function reject_formula(){
		$model = $this->RequestGlowModel;
		$id = $this->input->post('id_formula');
		$keterangan = $this->input->post('keterangan_reject');
		$request = $model->get_formula_id($id)->row()->id_msglow_request;
		$arr = [
			'acc_formula_msglow' => 'Ditolak',
			'tanggal_acc_formula_msglow' => date('Y-m-d H:i:s'),
			'keterangan_acc_formula_msglow' => $keterangan
		];
		$model->update_formula($id, $arr);
		redirect("glow/formula/$request",'refresh');
	}

	public function panelis($id = null){
		if (!is_null($id)) {
			if ($this->session->userdata('level') == 'rnd' || $this->session->userdata('level') == 'marketing' || $this->session->userdata('level') == 'tim_marketing') {
				
				$array = array(
					'active' => 'request'
				);
				
				$this->session->set_userdata( $array );
				
			}
			$model = $this->RequestGlowModel;
			$id_msglow_request = $model->get_formula_id($id)->row()->id_msglow_request;
			$result['id'] = $id;
			$result['id_request'] = $id_msglow_request;
			$result['mrequest'] = $model->get_request_msglow_id($id_msglow_request)->row();
			$result['panelis'] = $model->get_panelis($id)->result();
			$this->load->view('msglow/panelis_formula', $result, FALSE);
		}
	}

	public function simpan_panelis(){
		if($this->input->post()){
			$model = $this->RequestGlowModel;
			$id = $this->input->post('id_formula');
			$id_request = $this->input->post('id_request');
			$aksi = $this->input->post('aksi');
			$deskripsi = $this->input->post('deskripsi_panelis');
			$filename = date('Ymdhis');

			if ($this->session->userdata('level') == 'direktur' || $this->session->userdata('level') == 'rnd') {
				$by = 'KGI';
			}else{
				$by = 'KCI';
			}
			
			$arr = [
				'id_formula_msglow' 			=> $id,
				'tanggal_panelis_msglow' 		=> date('Y-m-d H:i:s'),
				'panelis_by' 					=> $by,
				'file_panelis_msglow' 			=> $this->upload_berkas('uploads/msglow_request/panelis/',$filename,'file_panelis'),
				'deskripsi_file_panelis' 		=> $deskripsi
			];

			$model->save_panelis($arr);
			$this->simpan_log($id_request,'Panelis Review', $deskripsi);

			if ($aksi == 'reset') {
				$arr_status = [
					'status_request_msglow' => 'Panelis Review',
					'start_panelis' => date('Y-m-d H:i:s'),
					'end_panelis' => '0000-00-00 00:00:00'
				];
			}elseif ($aksi == 'lanjut') {
				$arr_status = [
					'status_request_msglow' => 'Panelis Review'
				];
			}elseif ($aksi == 'mulai') {
				$arr_status = [
					'status_request_msglow' => 'Panelis Review',
					'start_panelis' => date('Y-m-d H:i:s'),
					'end_panelis' => '0000-00-00 00:00:00'
				];
			}

			$model->update_request_msglow($id_request, $arr_status);
			$mrequest = $model->get_request_msglow_id($id_request)->row()->usulan_nama_produk;
			$message = $this->generate_msg($id_request,$mrequest,$deskripsi);
			$this->send_email('Panelis Review', $message);
			
			redirect("glow/panelis/$id", 'refresh');
		}
	}

	public function end_panelis($id = null){
		if (!is_null($id)) {
			$model = $this->RequestGlowModel;
			$id_request = $model->get_formula_id($id)->row()->id_msglow_request;
			$arr = [
				'end_panelis' => date('Y-m-d H:i:s')
			];
			$model->update_request_msglow($id_request, $arr);
			redirect("glow/panelis/$id","refresh");
		}
	}

	public function scale($id = null){
		if (!is_null($id)) {
			if ($this->session->userdata('level') == 'rnd' || $this->session->userdata('level') == 'marketing' || $this->session->userdata('level') == 'tim_marketing') {
				
				$array = array(
					'active' => 'request'
				);
				
				$this->session->set_userdata( $array );
				
			}
			$model = $this->RequestGlowModel;
			$id_msglow_request = $model->get_formula_id($id)->row()->id_msglow_request;
			$result['id'] = $id;
			$result['id_request'] = $id_msglow_request;
			$result['mrequest'] = $model->get_request_msglow_id($id_msglow_request)->row();
			$result['scale'] = $model->get_scale($id)->result();
			$this->load->view('msglow/scale_formula', $result, FALSE);
		}
	}

	public function simpan_scale(){
		if($this->input->post()){
			$model = $this->RequestGlowModel;
			$id = $this->input->post('id_formula');
			$id_request = $this->input->post('id_request');
			$aksi = $this->input->post('aksi');
			$deskripsi = $this->input->post('deskripsi_scale');
			$filename = date('Ymdhis');

			$arr = [
				'id_formula_msglow' 			=> $id,
				'tanggal_scale_msglow' 			=> date('Y-m-d H:i:s'),
				'user_scale_msglow' 			=> $this->session->userdata('nama_user'),
				'dokumen_scale_msglow' 			=> $this->upload_berkas('uploads/msglow_request/scale/',$filename,'file_scale'),
				'keterangan_scale_msglow' 		=> $deskripsi
			];

			$model->save_scale($arr);

			if ($aksi == 'reset') {
				$arr_status = [
					'start_scale' => date('Y-m-d H:i:s'),
					'end_scale' => '0000-00-00 00:00:00'
				];
			}elseif ($aksi == 'mulai') {
				$arr_status = [
					'start_scale' => date('Y-m-d H:i:s'),
					'end_scale' => '0000-00-00 00:00:00'
				];
			}

			$model->update_request_msglow($id_request, $arr_status);
			redirect("glow/scale/$id", 'refresh');
		}
	}

	public function end_scale($id = null){
		if (!is_null($id)) {
			$model = $this->RequestGlowModel;
			$id_request = $model->get_formula_id($id)->row()->id_msglow_request;
			$arr = [
				'end_scale' => date('Y-m-d H:i:s')
			];
			$model->update_request_msglow($id_request, $arr);
			redirect("glow/scale/$id","refresh");
		}
	}

	public function review($id = null){
		if (!is_null($id)) {
			if ($this->session->userdata('level') == 'rnd' || $this->session->userdata('level') == 'marketing' || $this->session->userdata('level') == 'tim_marketing') {
				
				$array = array(
					'active' => 'request'
				);
				
				$this->session->set_userdata( $array );
				
			}
			$model = $this->RequestGlowModel;
			$id_msglow_request = $model->get_formula_id($id)->row()->id_msglow_request;
			$result['id'] = $id;
			$result['id_request'] = $id_msglow_request;
			$result['mrequest'] = $model->get_request_msglow_id($id_msglow_request)->row();
			$result['review'] = $model->get_review($id)->result();
			$this->load->view('msglow/feedback_formula', $result, FALSE);
		}
	}

	public function simpan_review(){
		if($this->input->post()){
			$model = $this->RequestGlowModel;
			$id = $this->input->post('id_formula');
			$deskripsi = $this->input->post('deskripsi_review');
			$filename = date('Ymdhis');
			
			$arr = [
				'id_formula_msglow' 			=> $id,
				'tanggal_feedback_formula' 		=> date('Y-m-d H:i:s'),
				'nama_reviewer' 				=> $this->session->userdata('nama_user'),
				'file_feedback_formula' 		=> $this->upload_berkas('uploads/msglow_request/feedback/',$filename,'file_review'),
				'deskripsi_feedback_formula' 	=> $deskripsi
			];

			$model->save_review($arr);
			$request = $model->get_formula_id($id)->row()->id_msglow_request;
			$this->simpan_log($request,'Review Sample', $deskripsi);

			$arr_status = [
				'status_request_msglow' => 'Review Sample'
			];

			$model->update_request_msglow($request, $arr_status);
			$mrequest = $model->get_request_msglow_id($request)->row()->usulan_nama_produk;
			$message = $this->generate_msg($request,$mrequest,$deskripsi);
			
			$this->send_email('Review Sample', $message);
			redirect("glow/review/$id", 'refresh');
		}
	}

	public function sample($id = null){
		if (!is_null($id)) {
			if ($this->session->userdata('level') == 'rnd' || $this->session->userdata('level') == 'marketing' || $this->session->userdata('level') == 'tim_marketing') {
				
				$array = array(
					'active' => 'request'
				);
				
				$this->session->set_userdata( $array );
				
			}
			$model = $this->RequestGlowModel;
			$result['id'] = $id;
			$result['sample'] = $model->get_sample($id)->result();
			$this->load->view('msglow/sample_formula', $result, FALSE);
		}
	}

	public function simpan_sample(){
		if($this->input->post()){
			$model = $this->RequestGlowModel;
			$id = $this->input->post('id_formula');
			$kode = $this->input->post('kode_sample');
			$deskripsi = $this->input->post('deskripsi_sample');
			$filename = date('Ymdhis');
			
			$arr = [
				'id_formula_msglow' 			=> $id,
				'tanggal_sample_msglow' 		=> date('Y-m-d H:i:s'),
				'kode_sample_msglow' 			=> $kode,
				'file_sample_msglow' 			=> $this->upload_berkas('uploads/msglow_request/sample/',$filename,'file_sample'),
				'ket_sample_msglow' 			=> $deskripsi,
				'diterima_msglow'	 			=> 'Belum',
				'diterima_oleh_msglow'	 		=> '-',
				'tanggal_diterima_msglow'	 	=> '0000-00-00 00:00:00'
			];

			$model->save_sample($arr);

			$request = $model->get_formula_id($id)->row()->id_msglow_request;
			$this->simpan_log($request,'Sending Sample',$deskripsi);

			$arr_status = [
				'status_request_msglow' => 'Sending Sample'
			];
			$model->update_request_msglow($request, $arr_status);

			$mrequest = $model->get_request_msglow_id($request)->row()->usulan_nama_produk;
			$message = $this->generate_msg($request,$mrequest,$deskripsi);
			
			$this->send_email('Sending Sample', $message);
			redirect("glow/sample/$id", 'refresh');
		}
	}

	public function bpom($id = null){
		if (!is_null($id)) {
			if ($this->session->userdata('level') == 'rnd' || $this->session->userdata('level') == 'marketing' || $this->session->userdata('level') == 'tim_marketing') {
				
				$array = array(
					'active' => 'request'
				);
				
				$this->session->set_userdata( $array );
				
			}

			$model = $this->RequestGlowModel;
			$result['id'] = $id;
			$result['mrequest'] = $model->get_request_msglow_id($id)->row();
			$result['bpom'] = $model->get_bpom_request($id)->result();
			$this->load->view('msglow/bpom_request', $result, FALSE);
		}
	}

	public function end_bpom($id = null){
		if (!is_null($id)) {
			$model = $this->RequestGlowModel;
			$arr = [
				'end_bpom' => date('Y-m-d H:i:s')
			];
			$model->update_request_msglow($id, $arr);
			redirect("glow/bpom/$id","refresh");
		}
	}

	public function simpan_bpom(){
		if($this->input->post()){
			$model = $this->RequestGlowModel;
			$id = $this->input->post('id_request');
			$aksi = $this->input->post('aksi');
			$deskripsi = $this->input->post('deskripsi_bpom');
			$deadline = $this->input->post('tanggal_deadline_bpom');
			$keterangan = $this->input->post('keterangan_deadline_bpom');
			$filename = date('Ymdhis');
			
			$arr = [
				'id_msglow_request' 			=> $id,
				'tanggal_bpom_msglow'	 		=> date('Y-m-d H:i:s'),
				'file_bpom_msglow'		 		=> $this->upload_berkas('uploads/msglow_request/bpom/',$filename,'file_bpom'),
				'keterangan_bpom_msglow' 		=> $deskripsi,
				'deadline_bpom_msglow' 			=> $deadline,
				'ket_deadline_bpom_msglow' 		=> $keterangan
			];

			$id_bpom = $model->save_bpom($arr);

			$arr_log_bpom = [
				'id_bpom_msglow'			=> $id_bpom,
				'tanggal_log_bpom_msglow'	=> date('Y-m-d H:i:s'),
				'deadline_log_bpom_msglow'	=> $deadline,
				'ket_deadline_log_bpom'		=> $keterangan
			];

			$model->save_log_bpom($arr_log_bpom);

			$this->simpan_log($id,'Proses BPOM',$deskripsi);

			if ($aksi == 'reset') {
				$arr_status = [
					'status_request_msglow' => 'Proses BPOM',
					'start_bpom' => date('Y-m-d H:i:s'),
					'end_bpom' => '0000-00-00 00:00:00'
				];
			}elseif ($aksi == 'lanjut') {
				$arr_status = [
					'status_request_msglow' => 'Proses BPOM'
				];
			}elseif ($aksi == 'mulai') {
				$arr_status = [
					'status_request_msglow' => 'Proses BPOM',
					'start_bpom' => date('Y-m-d H:i:s'),
					'end_bpom' => '0000-00-00 00:00:00'
				];
			}

			$model->update_request_msglow($id, $arr_status);

			$mrequest = $model->get_request_msglow_id($id)->row()->usulan_nama_produk;
			$message = $this->generate_msg($id,$mrequest,$deskripsi);
			
			$this->send_email('Proses BPOM', $message);
			redirect("glow/bpom/$id", 'refresh');
		}
	}

	public function deadline_bpom(){
		if ($this->input->post()) {
			$model = $this->RequestGlowModel;
			$id = $this->input->post('id_bpom');
			$request = $this->input->post('id_request');
			$deadline = $this->input->post('tanggal_deadline_bpom');
			$keterangan = $this->input->post('keterangan_atur_deadline');

			$arr = [
				'deadline_bpom_msglow' 		=> $deadline,
				'ket_deadline_bpom_msglow' 	=> $keterangan
			];
			$model->update_bpom($id, $arr);

			$arr_log_bpom = [
				'id_bpom_msglow'			=> $id,
				'tanggal_log_bpom_msglow'	=> date('Y-m-d H:i:s'),
				'deadline_log_bpom_msglow'	=> $deadline,
				'ket_deadline_log_bpom'		=> $keterangan
			];
			$model->save_log_bpom($arr_log_bpom);

			redirect("glow/bpom/$request", 'refresh');
		}
	}

	public function terima_sample($id = null){
		if (!is_null($id)) {
			$model = $this->RequestGlowModel;
			$id_formula = $model->get_sample_id($id)->row()->id_formula_msglow;
			$arr = [
				'diterima_msglow' => 'Sudah',
				'diterima_oleh_msglow' => $this->session->userdata('nama_user'),
				'tanggal_diterima_msglow' => date('Y-m-d H:i:s')
				
			];
			$model->update_sample($id,$arr);

			$request = $model->get_formula_id($id_formula)->row()->id_msglow_request;
			$this->simpan_log($request,'Sample Received','Penerimaan sample produk request');

			$arr_status = [
				'status_request_msglow' => 'Sample Received'
			];

			$model->update_request_msglow($request, $arr_status);

			$mrequest = $model->get_request_msglow_id($request)->row()->usulan_nama_produk;
			$message = $this->generate_msg($request,$mrequest,'Penerimaan sample produk request');
			
			$this->send_email('Sample Received', $message);
			redirect("glow/sample/$id_formula", 'refresh');
		}
	}

	public function set_deadline(){
		if ($this->input->post()) {
			$model = $this->RequestGlowModel;
			$id = $this->input->post('id_request');
			$deadline = $this->input->post('tanggal_deadline_request');
			$keterangan = $this->input->post('keterangan_deadline_request');
			
			$arr = [
				'deadline_request_rnd' => $deadline,
				'ket_deadline_rnd' => $keterangan
			];

			$model->update_request_msglow($id, $arr);

			$arr_log = [
				'id_msglow_request' 		=> $id,
				'tgl_log_deadline_request' 	=> date('Y-m-d H:i:s'),
				'tgl_deadline_request' 		=> $deadline,
				'ket_log_deadline_request' 	=> $keterangan
			];

			$model->save_log_deadline($arr_log);
			redirect("glow/permintaan", "refresh");
		}
	}

	public function deadline($id = null){
		if (!is_null($id)) {
			if ($this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier') {
				$array = array(
					'active' => 'request'
				);
				$this->session->set_userdata( $array );
			}
			$model = $this->RequestGlowModel;
			$result['id'] = $id;
			$result['deadline'] = $model->get_log_deadline($id)->result();
			$this->load->view('msglow/log_deadline', $result, FALSE);
		}
	}

	public function pr($id = null){
		if (!is_null($id)) {
			if ($this->session->userdata('level') == 'rnd' || $this->session->userdata('level') == 'marketing' || $this->session->userdata('level') == 'tim_marketing') {
				
				$array = array(
					'active' => 'request'
				);
				
				$this->session->set_userdata( $array );
				
			}

			$model = $this->RequestGlowModel;
			$result['id'] = $id;
			$result['mrequest'] = $model->get_request_msglow_id($id)->row();
			$result['pr'] = $model->get_pr_request($id)->result();
			$this->load->view('msglow/pr_request', $result, FALSE);
		}
	}

	public function simpan_pr(){
		if($this->input->post()){
			$model = $this->RequestGlowModel;
			$id = $this->input->post('id_request');
			$deskripsi = $this->input->post('deskripsi_pr');
			$filename = date('Ymdhis');
			
			$arr = [
				'id_msglow_request' 			=> $id,
				'tanggal_pr_msglow'	 			=> date('Y-m-d H:i:s'),
				'user_pr_msglow'	 			=> $this->session->userdata('nama_user'),
				'dokumen_pr_msglow'		 		=> $this->upload_berkas('uploads/msglow_request/pr/',$filename,'file_pr'),
				'keterangan_pr_msglow' 		=> $deskripsi
			];

			$model->save_pr_request($arr);

			$this->simpan_log($id,'Purchase Request',$deskripsi);

			$arr_status = [
				'status_request_msglow' => 'Purchase Request'
			];

			$model->update_request_msglow($id, $arr_status);

			$mrequest = $model->get_request_msglow_id($id)->row()->usulan_nama_produk;
			$message = $this->generate_msg($id,$mrequest,$deskripsi);
			
			$this->send_email('Purchase Request', $message);
			redirect("glow/pr/$id", 'refresh');
		}
	}

	public function po($id = null){
		if (!is_null($id)) {
			if ($this->session->userdata('level') == 'rnd' || $this->session->userdata('level') == 'marketing' || $this->session->userdata('level') == 'tim_marketing') {
				
				$array = array(
					'active' => 'request'
				);
				
				$this->session->set_userdata( $array );
				
			}

			$model = $this->RequestGlowModel;
			$result['id'] = $id;
			$result['mrequest'] = $model->get_request_msglow_id($id)->row();
			$result['po'] = $model->get_po_request($id)->result();
			$this->load->view('msglow/po_request', $result, FALSE);
		}
	}

	public function end_po($id = null){
		if (!is_null($id)) {
			$model = $this->RequestGlowModel;
			$arr = [
				'end_po' => date('Y-m-d H:i:s')
			];
			$model->update_request_msglow($id, $arr);
			redirect("glow/po/$id","refresh");
		}
	}

	public function simpan_po(){
		if($this->input->post()){
			$model = $this->RequestGlowModel;
			$id = $this->input->post('id_request');
			$aksi = $this->input->post('aksi');
			$deskripsi = $this->input->post('deskripsi_po');
			$filename = date('Ymdhis');
			
			$arr = [
				'id_msglow_request' 			=> $id,
				'tanggal_po_msglow'	 			=> date('Y-m-d H:i:s'),
				'user_po_msglow'	 			=> $this->session->userdata('nama_user'),
				'dokumen_po_msglow'		 		=> $this->upload_berkas('uploads/msglow_request/po/',$filename,'file_po'),
				'keterangan_po_msglow' 			=> $deskripsi
			];

			$model->save_po_request($arr);

			$this->simpan_log($id,'Purchase Order',$deskripsi);

			if ($aksi == 'reset') {
				$arr_status = [
					'status_request_msglow' => 'Purchase Order',
					'start_po' => date('Y-m-d H:i:s'),
					'end_po' => '0000-00-00 00:00:00'
				];
			}elseif ($aksi == 'lanjut') {
				$arr_status = [
					'status_request_msglow' => 'Purchase Order'
				];
			}elseif ($aksi == 'mulai') {
				$arr_status = [
					'status_request_msglow' => 'Purchase Order',
					'start_po' => date('Y-m-d H:i:s'),
					'end_po' => '0000-00-00 00:00:00'
				];
			}

			$model->update_request_msglow($id, $arr_status);

			$mrequest = $model->get_request_msglow_id($id)->row()->usulan_nama_produk;
			$message = $this->generate_msg($id,$mrequest,$deskripsi);
			
			$this->send_email('Purchase Order', $message);
			redirect("glow/po/$id", 'refresh');
		}
	}

	public function mps($id = null){
		if (!is_null($id)) {
			if ($this->session->userdata('level') == 'ppic' || $this->session->userdata('level') == 'rnd' 
				|| $this->session->userdata('level') == 'marketing' || $this->session->userdata('level') == 'tim_marketing') {
				$array = array(
					'active' => 'request'
				);
				$this->session->set_userdata( $array );
			}

			$model = $this->RequestGlowModel;
			$result['id'] = $id;
			$result['mrequest'] = $model->get_request_msglow_id($id)->row();
			$result['mps'] = $model->get_mps_request($id)->result();
			$this->load->view('msglow/mps_request', $result, FALSE);
		}
	}

	public function detail_mps($id = null){
		if (!is_null($id)) {
			if ($this->session->userdata('level') == 'ppic') {
				$array = array(
					'active' => 'request'
				);
				$this->session->set_userdata( $array );
			}

			$model = $this->RequestGlowModel;
			$result['mps'] = $model->get_mps_request_id($id)->row();
			$result['bom'] = $model->get_detail_formula($result['mps']->id_formula_msglow)->result();
			$result['detail'] = $model->get_detail_mps_id($id)->result();
			$this->load->view('msglow/detail_mps_request', $result, FALSE);
		}
	}

	public function tambah_mps($id = null){
		if (!is_null($id)) {
			if ($this->session->userdata('level') == 'rnd' || $this->session->userdata('level') == 'ppic') {
				
				$array = array(
					'active' => 'request'
				);
				
				$this->session->set_userdata( $array );
				
			}

			$model = $this->RequestGlowModel;
			$result['id'] = $id;
			$result['produk'] = $model->get_request_rnd()->result();
			$result['data'] = $model->get_request_msglow_id($id)->row();

			if ($result['data']->tahun_start_mps != 0 && $result['data']->tahun_end_mps != 0) {
				$status = 'reset';
			}else if ($result['data']->tahun_start_mps != 0 && $result['data']->tahun_end_mps == 0) {
				$status = 'lanjut';
			}else {
				$status = 'mulai';
			}

			$result['status'] = $status;

			$this->load->view('msglow/tambah_mps_request', $result, FALSE);
		}
	}

	public function end_mps($id = null){
		if (!is_null($id)) {
			$model = $this->RequestGlowModel;
			$arr = [
				'end_mps' => date('Y-m-d H:i:s')
			];
			$model->update_request_msglow($id, $arr);
			redirect("glow/mps/$id","refresh");
		}
	}

	public function simpan_mps(){
		if($this->input->post()){
			$model = $this->RequestGlowModel;

			$id = $this->input->post('id_request');
			$aksi = $this->input->post('aksi');
			$tanggal = $this->input->post('tgl_kalkulator');
			$formula = $this->input->post('kode_formula');
			$produksi = $this->input->post('jumlah_produksi');
			$deskripsi = $this->input->post('catatan_kalkulator');
			
			$arr = [
				'id_formula_msglow' 			=> $formula,
				'tanggal_mps_msglow'	 		=> $tanggal,
				'user_mps_msglow'	 			=> $this->session->userdata('nama_user'),
				'jumlah_produksi_msglow' 		=> $produksi,
				'keterangan_mps_msglow' 		=> $deskripsi
			];

			$id_mps = $model->save_mps_request($arr);

			$id_bahan = $this->input->post('id_bahan');
			$stok = $this->input->post('stok');
			$jumlah_kebutuhan = $this->input->post('jumlah_kebutuhan');
			$jumlah_kekurangan = $this->input->post('jumlah_kekurangan');

			foreach ($id_bahan as $key => $value) {
				$arr_detail = [
					'id_mps_msglow'		=> $id_mps,
					'id_produk'			=> $value,
					'stok_booked'		=> $stok[$key],
					'jumlah_kebutuhan'	=> $jumlah_kebutuhan[$key],
					'jumlah_kekurangan'	=> $jumlah_kekurangan[$key]
				];

				$model->save_detail_mps($arr_detail);
			}

			if ($aksi == 'reset') {
				$arr_status = [
					'start_mps' => date('Y-m-d H:i:s'),
					'end_mps' => '0000-00-00 00:00:00'
				];
				$model->update_request_msglow($id, $arr_status);
			}elseif ($aksi == 'mulai') {
				$arr_status = [
					'start_mps' => date('Y-m-d H:i:s'),
					'end_mps' => '0000-00-00 00:00:00'
				];
				$model->update_request_msglow($id, $arr_status);
			}

			redirect("glow/mps/$id", 'refresh');
		}
	}

	public function kedatangan($id = null){
		if (!is_null($id)) {
			if ($this->session->userdata('level') == 'rnd' || $this->session->userdata('level') == 'marketing' || $this->session->userdata('level') == 'tim_marketing') {
				$array = array(
					'active' => 'request'
				);
				$this->session->set_userdata( $array );
			}

			$model = $this->RequestGlowModel;
			$result['id'] = $id;
			$result['mrequest'] = $model->get_request_msglow_id($id)->row();
			$result['kedatangan'] = $model->get_kedatangan_request($id)->result();
			$this->load->view('msglow/kedatangan_request', $result, FALSE);
		}
	}

	public function end_inbound($id = null){
		if (!is_null($id)) {
			$model = $this->RequestGlowModel;
			$arr = [
				'end_inbound' => date('Y-m-d H:i:s')
			];
			$model->update_request_msglow($id, $arr);
			redirect("glow/kedatangan/$id","refresh");
		}
	}

	public function simpan_kedatangan(){
		if($this->input->post()){
			$model = $this->RequestGlowModel;
			$id = $this->input->post('id_request');
			$aksi = $this->input->post('aksi');
			$tanggal = $this->input->post('tanggal_kedatangan');
			$deskripsi = $this->input->post('deskripsi_kedatangan');
			$filename = date('Ymdhis');
			
			$arr = [
				'id_msglow_request' 			=> $id,
				'tanggal_input_kedatangan'	 	=> date('Y-m-d H:i:s'),
				'tanggal_kedatangan_msglow'	 	=> $tanggal,
				'user_input_kedatangan'	 		=> $this->session->userdata('nama_user'),
				'dokumen_kedatangan_msglow'		=> $this->upload_berkas('uploads/msglow_request/kedatangan/',$filename,'file_kedatangan'),
				'keterangan_kedatangan_msglow' 	=> $deskripsi
			];

			$model->save_kedatangan_request($arr);

			if ($aksi == 'reset') {
				$arr_status = [
					'start_inbound' => date('Y-m-d H:i:s'),
					'end_inbound' => '0000-00-00 00:00:00'
				];
				$model->update_request_msglow($id, $arr_status);
			}elseif ($aksi == 'mulai') {
				$arr_status = [
					'start_inbound' => date('Y-m-d H:i:s'),
					'end_inbound' => '0000-00-00 00:00:00'
				];
				$model->update_request_msglow($id, $arr_status);
			}

			redirect("glow/kedatangan/$id", 'refresh');
		}
	}

	public function batch($id = null){
		if (!is_null($id)) {
			if ($this->session->userdata('level') == 'rnd' || $this->session->userdata('level') == 'marketing' || $this->session->userdata('level') == 'tim_marketing') {
				$array = array(
					'active' => 'request'
				);
				$this->session->set_userdata( $array );
			}

			$model = $this->RequestGlowModel;
			$result['id'] = $id;
			$result['mrequest'] = $model->get_request_msglow_id($id)->row();
			$result['batch'] = $model->get_batch_request($id)->result();
			$this->load->view('msglow/batch_request', $result, FALSE);
		}
	}

	public function simpan_batch(){
		if($this->input->post()){
			$model = $this->RequestGlowModel;
			$id = $this->input->post('id_request');
			$deskripsi = $this->input->post('deskripsi_batch');
			$filename = date('Ymdhis');
			
			$arr = [
				'id_msglow_request' 			=> $id,
				'tanggal_batch_msglow'	 		=> date('Y-m-d H:i:s'),
				'user_batch_msglow'	 			=> $this->session->userdata('nama_user'),
				'dokumen_batch_msglow'		 	=> $this->upload_berkas('uploads/msglow_request/batch/',$filename,'file_batch'),
				'keterangan_batch_msglow' 		=> $deskripsi
			];

			$model->save_batch_request($arr);

			redirect("glow/batch/$id", 'refresh');
		}
	}

	public function kemasan($id = null){
		if (!is_null($id)) {
			if ($this->session->userdata('level') == 'rnd' || $this->session->userdata('level') == 'marketing' || $this->session->userdata('level') == 'tim_marketing') {
				
				$array = array(
					'active' => 'request'
				);
				
				$this->session->set_userdata( $array );
				
			}

			$model = $this->RequestGlowModel;
			$result['id'] = $id;
			$result['mrequest'] = $model->get_request_msglow_id($id)->row();
			$result['kemasan'] = $model->get_kemasan_request($id)->result();
			$this->load->view('msglow/kemasan_request', $result, FALSE);
		}
	}

	public function end_kemasan($id = null){
		if (!is_null($id)) {
			$model = $this->RequestGlowModel;
			$arr = [
				'end_kemasan' => date('Y-m-d H:i:s')
			];
			$model->update_request_msglow($id, $arr);
			redirect("glow/kemasan/$id","refresh");
		}
	}


	public function simpan_kemasan(){
		if($this->input->post()){
			$model = $this->RequestGlowModel;
			$id = $this->input->post('id_request');
			$deskripsi = $this->input->post('deskripsi_kemasan');
			$aksi = $this->input->post('aksi');
			$filename = date('Ymdhis');
			
			$arr = [
				'id_msglow_request' 			=> $id,
				'tanggal_kemasan_msglow'	 	=> date('Y-m-d H:i:s'),
				'user_kemasan_msglow'	 		=> $this->session->userdata('nama_user'),
				'dokumen_kemasan_msglow'		=> $this->upload_berkas('uploads/msglow_request/',$filename,'file_kemasan'),
				'keterangan_kemasan_msglow' 	=> $deskripsi
			];

			$model->save_kemasan_request($arr);

			$this->simpan_log($id,'Design Kemasan',$deskripsi);
			
			if ($aksi == 'reset') {
				$arr_status = [
					'status_request_msglow' => 'Design Kemasan',
					'start_kemasan' => date('Y-m-d H:i:s'),
					'end_kemasan' => '0000-00-00 00:00:00'
				];
			}elseif ($aksi == 'lanjut') {
				$arr_status = [
					'status_request_msglow' => 'Design Kemasan'
				];
			}elseif ($aksi == 'mulai') {
				$arr_status = [
					'status_request_msglow' => 'Design Kemasan',
					'start_kemasan' => date('Y-m-d H:i:s'),
					'end_kemasan' => '0000-00-00 00:00:00'
				];
			}

			$model->update_request_msglow($id, $arr_status);

			$mrequest = $model->get_request_msglow_id($id)->row()->usulan_nama_produk;
			$message = $this->generate_msg($id,$mrequest,$deskripsi);
			
			$this->send_email('Design Kemasan', $message);
			redirect("glow/kemasan/$id", 'refresh');
		}
	}

	public function produksi($id = null){
		if (!is_null($id)) {
			if ($this->session->userdata('level') == 'rnd' || $this->session->userdata('level') == 'marketing' || $this->session->userdata('level') == 'tim_marketing') {
				$array = array(
					'active' => 'request'
				);
				$this->session->set_userdata( $array );
			}

			$model = $this->RequestGlowModel;
			$result['id'] = $id;
			$result['mrequest'] = $model->get_request_msglow_id($id)->row();
			$result['produksi'] = $model->get_produksi_request($id)->result();
			$this->load->view('msglow/produksi_request', $result, FALSE);
		}
	}

	public function end_produksi($id = null){
		if (!is_null($id)) {
			$model = $this->RequestGlowModel;
			$arr = [
				'end_produksi' => date('Y-m-d H:i:s')
			];
			$model->update_request_msglow($id, $arr);
			redirect("glow/produksi/$id","refresh");
		}
	}

	public function simpan_produksi(){
		if($this->input->post()){
			$model = $this->RequestGlowModel;
			$id = $this->input->post('id_request');
			$aksi = $this->input->post('aksi');
			$deskripsi = $this->input->post('deskripsi_produksi');
			$filename = date('Ymdhis');
			
			$arr = [
				'id_msglow_request' 			=> $id,
				'tanggal_produksi_msglow'	 	=> date('Y-m-d H:i:s'),
				'user_produksi_msglow'	 		=> $this->session->userdata('nama_user'),
				'dokumen_produksi_msglow'		=> $this->upload_berkas('uploads/msglow_request/produksi/',$filename,'file_produksi'),
				'keterangan_produksi_msglow' 	=> $deskripsi	
			];

			$model->save_produksi_request($arr);
			$this->simpan_log($id,'Manufacture KGI',$deskripsi);

			if ($aksi == 'reset') {
				$arr_status = [
					'status_request_msglow' => 'Manufacture KGI',
					'start_produksi' => date('Y-m-d H:i:s'),
					'end_produksi' => '0000-00-00 00:00:00'
				];
			}elseif ($aksi == 'lanjut') {
				$arr_status = [
					'status_request_msglow' => 'Manufacture KGI'
				];
			}elseif ($aksi == 'mulai') {
				$arr_status = [
					'status_request_msglow' => 'Manufacture KGI',
					'start_produksi' => date('Y-m-d H:i:s'),
					'end_produksi' => '0000-00-00 00:00:00'
				];
			}

			$model->update_request_msglow($id, $arr_status);

			$mrequest = $model->get_request_msglow_id($id)->row()->usulan_nama_produk;
			$message = $this->generate_msg($id,$mrequest,$deskripsi);
			
			$this->send_email('Manufacture KGI', $message);
			redirect("glow/produksi/$id", 'refresh');
		}
	}

	public function pengiriman($id = null){
		if (!is_null($id)) {
			if ($this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier' || $this->session->userdata('level') == 'rnd'
				|| $this->session->userdata('level') == 'marketing' || $this->session->userdata('level') == 'tim_marketing') {
				$array = array(
					'active' => 'request'
				);
				$this->session->set_userdata( $array );
			}
			$model = $this->RequestGlowModel;
			$result['id'] = $id;
			$result['mrequest'] = $model->get_request_msglow_id($id)->row();
			$result['pengiriman'] = $model->get_pengiriman_request($id)->result();
			$this->load->view('msglow/pengiriman_request', $result, FALSE);
		}
	}

	public function end_pengiriman($id = null){
		if (!is_null($id)) {
			$model = $this->RequestGlowModel;
			$arr = [
				'end_wh' => date('Y-m-d H:i:s')
			];
			$model->update_request_msglow($id, $arr);
			redirect("glow/pengiriman/$id","refresh");
		}
	}

	public function simpan_pengiriman(){
		if($this->input->post()){
			$model = $this->RequestGlowModel;
			$id = $this->input->post('id_request');
			$aksi = $this->input->post('aksi');
			$tanggal = $this->input->post('tanggal_pengiriman');
			$deskripsi = $this->input->post('deskripsi_pengiriman');
			$filename = date('Ymdhis');
			
			$arr = [
				'id_msglow_request' 			=> $id,
				'tanggal_input_pengiriman'	 	=> date('Y-m-d H:i:s'),
				'tanggal_pengiriman_msglow'	 	=> $tanggal,
				'user_pengiriman_msglow'	 	=> $this->session->userdata('nama_user'),
				'dokumen_pengiriman_msglow'		=> $this->upload_berkas('uploads/msglow_request/pengiriman/',$filename,'file_pengiriman'),
				'keterangan_pengiriman_msglow' 	=> $deskripsi
			];

			$model->save_pengiriman_request($arr);
			$this->simpan_log($id,'Delivery Process',$deskripsi);

			if ($aksi == 'reset') {
				$arr_status = [
					'status_request_msglow' => 'Delivery Process',
					'start_wh' => date('Y-m-d H:i:s'),
					'end_wh' => '0000-00-00 00:00:00'
				];
			}elseif ($aksi == 'lanjut') {
				$arr_status = [
					'status_request_msglow' => 'Delivery Process'
				];
			}elseif ($aksi == 'mulai') {
				$arr_status = [
					'status_request_msglow' => 'Delivery Process',
					'start_wh' => date('Y-m-d H:i:s'),
					'end_wh' => '0000-00-00 00:00:00'
				];
			}

			$model->update_request_msglow($id, $arr_status);

			$mrequest = $model->get_request_msglow_id($id)->row()->usulan_nama_produk;
			$message = $this->generate_msg($id,$mrequest,$deskripsi);
			
			$this->send_email('Delivery Process', $message);
			redirect("glow/pengiriman/$id", 'refresh');
		}
	}

	public function lain($id = null){
		if (!is_null($id)) {
			if ($this->session->userdata('level') == 'rnd' || $this->session->userdata('level') == 'marketing' || $this->session->userdata('level') == 'tim_marketing') {
				$array = array(
					'active' => 'request'
				);
				$this->session->set_userdata( $array );
			}
			
			$model = $this->RequestGlowModel;
			$result['id'] = $id;
			$result['mrequest'] = $model->get_request_msglow_id($id)->row();
			$result['lain'] = $model->get_lain_request($id)->result();
			$this->load->view('msglow/lain_request', $result, FALSE);
		}
	}

	public function simpan_lain(){
		if($this->input->post()){
			$model = $this->RequestGlowModel;
			$id = $this->input->post('id_request');
			$nama = $this->input->post('nama_lain');
			$tanggal = $this->input->post('tanggal_lain');
			$deskripsi = $this->input->post('deskripsi_lain');
			$filename = date('Ymdhis');
			
			$arr = [
				'id_msglow_request' 			=> $id,
				'tanggal_input_other'	 		=> date('Y-m-d H:i:s'),
				'tanggal_other_msglow'	 		=> $tanggal,
				'nama_other_msglow'	 			=> $nama,
				'user_other_msglow'	 			=> $this->session->userdata('nama_user'),
				'dokumen_other_msglow'			=> $this->upload_berkas('uploads/msglow_request/other/',$filename,'file_lain'),
				'keterangan_other_msglow' 		=> $deskripsi
			];

			$model->save_other_request($arr);
			redirect("glow/lain/$id", 'refresh');
		}
	}

	public function log_request($id = null){
		if (!is_null($id)) {
			if ($this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier') {
				$array = array(
					'active' => 'request'
				);
				$this->session->set_userdata( $array );
			}
			$model = $this->RequestGlowModel;
			$result['id'] = $id;
			$result['log'] = $model->get_log_request($id)->result();
			$this->load->view('msglow/log_request', $result, FALSE);
		}
	}

	public function log_bpom($id = null){
		if (!is_null($id)) {
			$model = $this->RequestGlowModel;
			$result['id'] = $id;
			$result['log'] = $model->get_log_bpom($id)->result();
			$this->load->view('msglow/log_bpom', $result, FALSE);
		}
	}

	public function filter($req = null){
		if (!is_null($req)) {
			$model = $this->RequestGlowModel;
	
			if ($req ==  'kci') {
				$result['request'] = $model->get_request_kci('Belum')->result();	
			}elseif ($req == 'kgi') {
				$result['request'] = $model->get_request_kgi('Belum')->result();
			}elseif ($req == 'approved') {
				$result['request'] = $model->get_request_rnd()->result();
			}elseif ($req == 'canceled') {
				$result['request'] = $model->get_request_msglow_status('NPD CANCELED')->result();
			}elseif ($req == 'sending') {
				$result['request'] = $model->get_request_msglow_status('Sample Sent to KCI')->result();
			}elseif ($req == 'received') {
				$result['request'] = $model->get_request_msglow_status('Sample Received by KCI')->result();
			}elseif ($req == 'progress') {
				$result['request'] = $model->get_request_msglow_status('FORMULA ON PROGRESS')->result();
			}elseif ($req == 'development') {
				$result['request'] = $model->get_request_msglow_status('Development Formula')->result();
			}elseif ($req == 'total') {
				$result['request'] = $model->get_request_msglow()->result();
			}elseif ($req == 'perubahan') {
				$result['request'] = $model->get_request_msglow_status('Perubahan Spesifikasi')->result();
			}else{
				$result['request'] = array();
			}
			
			$this->load->view('msglow/msglow_request', $result, FALSE);
		}
	}
	
	public function hapus_request($id){
		if (!empty($id)) {
			$model = $this->RequestGlowModel;
			$model->delete_request_msglow($id);
			redirect('glow/permintaan','refresh');
		}
	}

	public function json_request(){
		$model = $this->RequestGlowModel;
		$id = $this->input->post('id');
		$data = $model->get_request_msglow_id($id)->row();
		echo json_encode($data);
	}

	public function json_chart_id(){
		$model = $this->RequestGlowModel;
		$id = $this->input->post('id');
		$result = $model->get_request_msglow_id($id)->row();
		echo json_encode($result);
	}

	public function json_all_request(){
		$model = $this->RequestGlowModel;
		if ($this->session->userdata('level') == 'ms_glow' || $this->session->userdata('level') == 'kci') {
			$data = $model->get_request_msglow()->result();
		}else{
			$data = $model->get_request_kosme()->result();
		}
		echo json_encode($data);
	}

	public function json_bpom(){
		$model = $this->RequestGlowModel;
		$id = $this->input->post('id');
		$data = $model->get_bpom_id($id)->row();
		echo json_encode($data);
	}

	public function json_formula(){
		if (!empty($this->session->userdata('login'))) {
			$model = $this->RequestGlowModel;	
			$id = $this->input->post('id');
			$result = $model->get_formula_id($id)->row();
			echo json_encode($result);
		}
	}

	private function send_email($subject, $msg){
		$arr = [
			'danang.yuanto@j99corp.com',
			'bayu.wibowo@kosme.co.id',
			'titis.indah@kosme.co.id',
			'danang.yuanto@kosme.co.id',
			'wahyu.febrian@kosme.co.id',
			'sabdha@kosme.co.id',
			'sheilapangkey@msglowid.com',
			'ridamillati@msglowid.com',
			'vini@msglowid.com',
			'bahita.noorcahya@kosme.co.id',
			'yenny.wulansari@kosme.co.id',
			'wisnu.sakti@kosme.co.id',
			'chandramahardhika@msglowid.com',
			'farisagustian@msglowid.com',
			'dirgantaranusantara@j99corp.com',
			'rizhaldi.adhitya@msglowid.com',
			'rikosaputra@msglowformenid.com',
			'nulzainul673@gmail.com',
			'michael@kosme.co.id',
			'aris.anggara@kosme.co.id',
			'mirzahendrawan@j99corp.com',
			'chandramahardhika@msglowid.com'
		];

		$this->load->library('email');

		$config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'kosmetechno@gmail.com';
        $config['smtp_pass']    = 'xxrjrvjstbcbnnwh';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'text'; 
        $config['validation'] = TRUE; 

        $this->email->initialize($config);

	
		foreach ($arr as $value) {
			$this->email->clear();
			$this->email->from('kosmetechno@gmail.com', 'NPD SYSTEM INFO');
			$this->email->to($value);
			$this->email->subject($subject);
			$this->email->message($msg);
			$this->email->send();
		}
	
	}

	private function generate_msg($id, $product, $desc){
		$mlink = base_url().'timeline-product/'.$id;
		$message = "$product : \r\n $desc \r\n Klik link berikut untuk timeline produk: \r\n $mlink \r\n This email is auto generated from the NPD System. Please do not reply to this email. \r\n PT Kosmetika Global Indonesia";
		return $message;
	}

	private function simpan_log($id_request = null, $aksi = null, $desc = null){
		if (!is_null($id_request)) {
			$model = $this->RequestGlowModel;
			$arr_log = [
				'id_msglow_request' => $id_request,
				'tanggal_log_msglow' => date('Y-m-d H:i:s'),
				'user_log_msglow' => $this->session->userdata('nama_user'),
				'aksi_log_msglow' => $aksi,
				'deskripsi_log_msglow' => $desc
			];
			$model->save_log($arr_log);
		}
		
	}

	public function json_set_request(){
		if ($this->input->post()) {
			$id = $this->input->post('id');
			
			$array = array(
				'product' => $id
			);
			
			$this->session->set_userdata( $array );
			
			$result['message'] = "1";
			echo json_encode($result);
		}
	}

	public function json_unset_request(){
		if ($this->input->post()) {
			$this->session->unset_userdata('product');
			$result['message'] = "1";
			echo json_encode($result);
		}
	}

	public function json_log_request(){
		if ($this->input->post()) {
			$model = $this->RequestGlowModel;
			$id = $this->input->post('id');
			$result = $model->get_log_request($id)->result();
			echo json_encode($result);
		}
	}

}

/* End of file Glow.php */
