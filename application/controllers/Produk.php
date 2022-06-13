<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (empty($this->session->userdata('login'))) {
			redirect('Login/index','refresh');
		}
		$this->load->library('form_validation');
		$array = array(
			'active' => 'produk'
		);
		$this->session->set_userdata( $array );
	}

	public function index(){
		$request = $this->uri->segment(3);
		if (!empty($request) && $request == 'Baku' || $request == 'Kemas' || $request == 'Teknik') {
			$result['data_produk'] = $this->ProdukModel->get_produk($request)->result();
			$this->load->view('produk/data_produk', $result, FALSE);
		}elseif (!empty($request) && $request == 'Limit') {
			$result['data_produk'] = $this->ProdukModel->get_produk_limit()->result();
			$this->load->view('produk/data_produk', $result, FALSE);
		}else{
			redirect('dashboard','refresh');
		}
	}

	public function tambah_produk(){
		error_reporting(0);
		$request = $this->uri->segment(3);
		if (!empty($request) && $request == 'Baku' || $request == 'Kemas' || $request =='Teknik') {
			$no_produk = $this->ProdukModel->get_nomor($request)->result();
			if (empty($no_produk)) {
				if ($request == 'Baku') {
					$kode = 'B1A0001';
				}elseif ($request == 'Kemas') {
					$kode = 'B2-D-0001';
				}elseif ($request == 'Teknik') {
					$kode = 'TKP0001';
				}
			}else{
				foreach ($no_produk as $value) {
					$kode_sub = substr($value->kode_produk,3,4);
					$kodeawal = $kode_sub+1;
					if($kodeawal<10){
					  	$kode = substr($value->kode_produk, 0, -1).$kodeawal;
					}elseif($kodeawal > 9 && $kodeawal <= 99){
						$kode = substr($value->kode_produk, 0, -2).$kodeawal;
					}else{
						$kode = substr($value->kode_produk, 0, -2).$kodeawal;
					}
				}
			}
			// $result['kategori'] = $this->KategoriModel->get_kategori()->result();
			$result['supplier'] = $this->MitraModel->get_mitra($request)->result();
			$result['kode'] = $kode;
			$this->load->view('produk/tambah_produk',$result,FALSE);
		}else{
			redirect('Dashboard/index','refresh');
		}
	}

	public function simpan_produk(){
		$request = $this->uri->segment(3);
		if (!empty($request)) {
			$produk = $this->ProdukModel;
	        $validation = $this->form_validation;
	        $validation->set_rules($produk->rules());

	        if ($validation->run()) {
	            $produk->insert();
	        }
	        redirect("Produk/index/$request",'refresh');
		}else{
			redirect('Dashboard/index','refresh');
		}	
	}

	public function edit_produk($id){
		$cek_produk = $this->ProdukModel->get_produk_id($id)->row();
		if (!empty($id) && !empty($cek_produk)) {
			$supp_produk = $this->ProdukModel->get_produk_id($id)->row();
			$request_supplier = $supp_produk->kategori_produk;
			$result['supplier'] = $this->MitraModel->get_mitra($request_supplier)->result();
			$result['produk'] = $this->ProdukModel->get_produk_id($id)->result();
			$this->load->view('produk/edit_produk', $result, FALSE);
		}else{
			redirect('Produk/index','refresh');
		}
	}

	public function update_produk(){
		$id = $this->input->post('id_produk');
		$supp_produk = $this->ProdukModel->get_produk_id($id)->row();
		$request_supplier = $supp_produk->kategori_produk;
		$produk = $this->ProdukModel;
        $validation = $this->form_validation;
        $validation->set_rules($produk->rules());

        if ($validation->run()) {
            $produk->update();
        }

        redirect("Produk/index/$request_supplier",'refresh');
	}

	public function hapus_produk(){
		$id = $this->uri->segment(3);
		$supp_produk = $this->ProdukModel->get_produk_id($id)->row();
		$request_supplier = $supp_produk->kategori_produk;
		if (!empty($id)) {
			$do_delete = $this->ProdukModel->delete($id);
			if ($do_delete == TRUE) {
				redirect("Produk/index/$request_supplier",'refresh');
			}else{
				echo 'gagal menghapus produk';
			}
		}else{
			redirect("Produk/index/$request_supplier",'refresh');
		}
	}

	function get_produk(){
		$idProduk = $this->input->post('id_produk');
		$html = "";
		$data = $this->ProdukModel->get_produk_id($idProduk)->row();
		$html .= "<tr id='id$data->id_produk'>";
		$html .= "<td><input type='checkbox' name='record' class='form-control form-control-sm'><input type='hidden' name='id_produk[]' value='".$data->id_produk."'></td>";
		$html .= "<td><input type='text' name='nama_produk[]' placeholder='Nama Bahan Baku' required='' class='form-control' value='".$data->nama_produk."' readonly=''></td>";
		$html .= "<td><input type='number' step='.01' onkeyup='hitung($data->id_produk)' name='kuantitas[]' placeholder='Jumlah' required='' class='form-control' value='0'></td>";
		$html .= "<td><input type='text' name='satuan[]' class='form-control' list='satuan' required=''><datalist id='satuan'><option value='KG'>KG</option><option value='Gram'>Gram</option><option value='Ton'>Ton</option><option value='Pieces'>Pieces</option><option value='Set'>Set</option><option value='Unit'>Unit</option><option value='Drum'>Drum</option><option value='Roll'>Roll</option><option value='Box'>Box</option><option value='Bulan'>Bulan</option></datalist></td>";
		$html .= "<td><select onChange='status_matauang($data->id_produk)' name='mata_uang[]' class='form-control'required><option disabled selected>Pilih</option><option value='Rupiah'>Rupiah</option><option value='Dollar' disabled>Dollar (disabled)</option><option value='RMB' disabled>RMB (disabled)</option></select></td>";
		$html .= "<td><input type='text' onkeyup='hitung($data->id_produk)' name='harga_text[]' placeholder='Harga' required='' class='form-control'><input type='hidden' onkeyup='hitung($data->id_produk)' name='harga[]'></td><td><input type='text' step='.01' onkeyup='hitung($data->id_produk)' name='kurs_text[]' placeholder='Kurs' class='form-control' readonly=''><input type='hidden' onkeyup='hitung($data->id_produk)' name='kurs[]' value='0'></td>";
		$html .= "<td><input type='hidden' name='jumlah[]' placeholder='Jumlah' readonly='' class='total form-control' value='0'><input type='text' name='jumlah_text[]' placeholder='Jumlah' readonly='' class='form-control'></td></tr>";
		echo json_encode($html);
	}

	public function get_json_produk(){
		$id = $this->input->post('id');
		$result = $this->ProdukModel->get_produk_id($id)->row();
		echo json_encode($result);
	}

	public function simpan_stok(){
		$id_produk = $this->input->post('id_produk');
		$data_produk = $this->ProdukModel->get_produk_id($id_produk)->row();
		$kategori = $data_produk->kategori_produk;
		$stok_terbaru = $this->input->post('stok_produk_terbaru');
		$data_update = array(
			'stok' => $stok_terbaru
		);
		$this->ProdukModel->update_stok($id_produk,$data_update);
		redirect("produk/index/$kategori",'refresh');
	}

	public function get_produk_mutasi(){
		$idProduk = $this->input->post('id_produk');
		$html = "";
		$data = $this->ProdukModel->get_produk_id($idProduk)->row();
		$html .= "<tr id='id$data->id_produk'>";
		$html .= "<td><input type='checkbox' name='record' class='form-control form-control-sm'><input type='hidden' name='id_produk[]' value='".$data->id_produk."'></td>";
		$html .= "<td><input type='text' name='nama_produk[]' placeholder='Nama Bahan Baku' required='' class='form-control' value='".$data->nama_produk."' readonly=''></td>";
		$html .= "<td><input type='text' name='analisa_mutasi_lain[]' placeholder='No. Analisa' required='' class='form-control'></td>";
		$html .= "<td><input type='number' onkeyup='cek_stok($data->id_produk)' step='.001' name='diserahkan[]' placeholder='Diserahkan' required='' class='form-control' value=''></td>";
		$html .= "<td><select class='form-control' name='satuan_diserahkan[]' onchange='cek_stok($data->id_produk)' required><option value='KG'>KG</option><option value='Gram'>Gram</option><option value='Pieces'>Pcs</option><option value='Roll'>Roll</option></select></td>";
		$html .= "<td><input type='number' step='.001' name='dikembalikan[]' placeholder='Dikembalikan' class='form-control' value=''></td>";
		$html .= "<td><select class='form-control' name='satuan_dikembalikan[]'><option value='KG'>KG</option><option value='Gram'>Gram</option><option value='Pieces'>Pcs</option><option value='Roll'>Roll</option></select></td><td><input type='number' step='.001' name='reject[]' placeholder='Reject' class='form-control' value=''></td>";
		$html .= "<td><select class='form-control' name='satuan_reject[]'><option value='KG'>KG</option><option value='Gram'>Gram</option><option value='Pieces'>Pcs</option><option value='Roll'>Roll</option></select><input type='hidden' name='stok[]' value='$data->stok'></td></tr>";
		echo json_encode($html);
	}

	public function get_produk_kalkulator(){
		$idProduk = $this->input->post('id_produk');
		$html = "";
		$data = $this->ProdukModel->get_produk_id($idProduk)->row();
		$html .= "<tr id='id$data->id_produk'>";
		$html .= "<td><input type='checkbox' name='record' class='form-control form-control-sm'><input type='hidden' name='id_produk[]' value='".$data->id_produk."'></td>";
		$html .= "<td><input type='text' name='nama_produk[]' placeholder='Nama Bahan Baku' required='' class='form-control' value='".$data->nama_produk."' readonly=''></td>";
		$html .= "<td><input type='text' name='stok_text[]' readonly class='form-control' value='".number_format($data->stok,3,',','.')."' readonly=''><input type='hidden' name='stok[]' value='$data->stok'></td>";
		$html .= "<td><input type='text' name='persentase_text[]' placeholder='Persentase' class='form-control' required onkeyup='hitung_persen($data->id_produk)'><input type='hidden' name='persentase[]' class='persen'></td>";
		$html .= "<td><input type='text' name='jumlah_kebutuhan_text[]' placeholder='Kebutuhan' class='form-control' readonly><input type='hidden' name='jumlah_kebutuhan[]'></td>";
		$html .= "<td><input type='text' name='jumlah_kekurangan_text[]' placeholder='Kurang' class='form-control' readonly><input type='hidden' name='jumlah_kekurangan[]'></td></tr>";
		echo json_encode($html);
	}

	public function get_produk_bom(){
		$idProduk = $this->input->post('id_produk');
		$html = "";
		$data = $this->ProdukModel->get_produk_id($idProduk)->row();
		$html .= "<tr id='id$data->id_produk'>";
		$html .= "<td><input type='checkbox' name='record' class='form-control form-control-sm'><input type='hidden' name='id_produk[]' value='".$data->id_produk."'></td>";
		$html .= "<td><input type='text' name='nama_produk[]' placeholder='Nama Bahan Baku' required='' class='form-control' value='".$data->nama_produk."' readonly=''></td>";
		$html .= "<td><input type='text' name='persentase_text[]' placeholder='Persentase' class='form-control' required onkeyup='hitung_persen($data->id_produk)'><input type='hidden' name='persentase[]' class='persen'></td>";
		$html .= "<td><input type='text' name='jumlah_komposisi_text[]' placeholder='Komposisi/Pcs' class='form-control' readonly><input type='hidden' name='jumlah_komposisi[]'></td>";
		$html .= "</tr>";
		echo json_encode($html);
	}

	public function update_limit(){
		$id_produk = $this->input->post('id_produk');
		$data_produk = $this->ProdukModel->get_produk_id($id_produk)->row();
		$kategori = $data_produk->kategori_produk;
		$limit_stok = $this->input->post('limit_stok');
		$data_limit = ['limit_stok' => $limit_stok];
		$this->ProdukModel->update_stok($id_produk,$data_limit);
		redirect("produk/index/$kategori",'refresh');
	}

	public function set_halal($id){
		if (!empty($id)) {
			$kategori = $this->ProdukModel->get_produk_id($id)->row()->kategori_produk;
			$arr_halal = ['label_halal' => 'Sudah'];
			$this->ProdukModel->update_stok($id, $arr_halal);
			redirect("produk/index/$kategori",'refresh');
		}
	}

	public function pembelian($id){
		if (!empty($id)) {
			$data = $this->ProdukModel->get_produk_id($id)->row();
			$result['kode_produk'] = $data->kode_produk;	
			$result['nama_produk'] = $data->nama_produk;
			$result['pembelian'] = $this->OrderModel->get_history_pembelian($id)->result();
			$this->load->view('produk/pembelian_produk', $result, FALSE);
		}
	}

	public function json_kode_produk(){
		$kode = $this->input->post('kode');
		$result = $this->ProdukModel->get_produk_by_kode($kode)->num_rows();
		echo json_encode($result);
	}

	public function log_mutasi($id){
		$data = $this->ProdukModel->get_produk_id($id)->row();
		$result['id_produk'] = $data->id_produk;	
		$result['kode_produk'] = $data->kode_produk;	
		$result['nama_produk'] = $data->nama_produk;
		$result['data_log'] = $this->LogModel->get_log_produk_id($id)->result();
		$this->load->view('produk/log_mutasi', $result, FALSE);
	}

	public function exp(){
		$result['exp'] = $this->ProdukModel->get_produk_exp()->result();
		$this->load->view('produk/produk_exp', $result, FALSE);
	}

	public function json_expired_monthly(){

		$response = $this->ProdukModel->get_produk_exp()->result();

		echo json_encode($response);
	}

}

/* End of file Produk.php */
/* Location: ./application/controllers/Produk.php */