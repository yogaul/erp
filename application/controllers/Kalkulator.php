<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Kalkulator extends CI_Controller {

    public function __construct(){
		parent::__construct();
		if (empty($this->session->userdata('login'))) {
			redirect('login','refresh');
		}
		$array = array(
			'active' => 'kalkulator'
		);
		$this->session->set_userdata( $array );
	}

    public function index(){
        $result['produk'] = $this->KalkulatorModel->get_kalkulator()->result();
        $this->load->view('ppic/mps_kalkulator', $result, FALSE);
    }

	public function tambah(){
		$result['baku'] = $this->ProdukModel->get_produk('Baku')->result();
		$result['produk'] = $this->MsglowModel->get_msglow()->result();
        $this->load->view('ppic/tambah_mps', $result, FALSE);
	}

	public function simpan(){
		if ($this->input->post()) {
			$tanggal = $this->input->post('tgl_kalkulator');
			$kode_formula = $this->input->post('kode_formula');
			$jumlah_produksi = $this->input->post('jumlah_produksi');
			$catatan_kalkulator = $this->input->post('catatan_kalkulator');

			$arr_mps = [
				'tanggal_mps_kalkulator'	=> $tanggal,
				'id_bom_produk_jadi'		=> $kode_formula,
				'jumlah_produksi'			=> $jumlah_produksi,
				'keterangan_mps_kalkulator'	=> $catatan_kalkulator
			];

			$id_mps = $this->KalkulatorModel->save_kalkulator($arr_mps);

			$id_bahan = $this->input->post('id_bahan');
			$stok = $this->input->post('stok');
			$jumlah_kebutuhan = $this->input->post('jumlah_kebutuhan');
			$jumlah_kekurangan = $this->input->post('jumlah_kekurangan');

			foreach ($id_bahan as $key => $value) {
				$arr_detail = [
					'id_mps_kalkulator'	=> $id_mps,
					'id_produk'			=> $value,
					'stok_booked'		=> $stok[$key],
					'jumlah_kebutuhan'	=> $jumlah_kebutuhan[$key],
					'jumlah_kekurangan'	=> $jumlah_kekurangan[$key]
				];

				$this->KalkulatorModel->save_detail_kalkulator($arr_detail);
			}

			redirect("kalkulator",'refresh');
		}
	}

	public function detail($id = null){
		if (!is_null($id)) {
			$result['mps'] = $this->KalkulatorModel->get_kalkulator_id($id)->row();
			$result['bom'] = $this->MsglowModel->get_detail_bom_msglow($result['mps']->id_bom_produk_jadi)->result();
			$result['detail'] = $this->KalkulatorModel->get_detail_mps_id($id)->result();
			$this->load->view('ppic/detail_mps_kalkulator', $result, FALSE);
		}
	}

	public function edit($id = null){
		if (!is_null($id)) {
			$result['baku'] = $this->ProdukModel->get_produk('Baku')->result();
			$result['produk'] = $this->MsglowModel->get_msglow()->result();
			$result['mps'] = $this->KalkulatorModel->get_kalkulator_id($id)->row();
			$result['detail'] = $this->KalkulatorModel->get_detail_mps_id($id)->result();
			$this->load->view('ppic/edit_mps', $result, FALSE);
		}
	}

	public function hapus($id = null){
		if (!is_null($id)) {
			$this->KalkulatorModel->delete_kalkulator($id);
			redirect('kalkulator','refresh');
		}
	}

}

/* End of file Kalkulator.php */
