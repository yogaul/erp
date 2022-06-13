<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Sertem extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (empty($this->session->userdata('login'))) {
			redirect('login','refresh');
		}
		$array = array(
			'active' => 'sertem'
		);
		$this->session->set_userdata( $array );
	}

	public function data($request){
        if (!empty($request) || $request == 'oem' && $request == 'glow') {
            $result['jenis'] = $request;
            $result['kategori'] = ($request == 'glow') ? 'MS Glow' : 'OEM'; 
            if ($request == 'glow') {
                $result['sertem'] = $this->SertemModel->get_sertem_glow()->result();
            }elseif ($request == 'oem') {
                $result['sertem'] = array();
            }
            $this->load->view('gudang/sertem_produk/data_sertem', $result, FALSE);
        }else{
            redirect('dashboard','refresh');
        }
	}

    public function buat($request){
        if (!empty($request) || $request == 'oem' && $request == 'glow') {
            $result['jenis'] = $request;
            $result['kategori'] = ($request == 'glow') ? 'MS Glow' : 'OEM'; 
            $result['url'] = ($request == 'glow') ? base_url().'glow/json_row_sertem' : base_url().'sample/json_row_sertem'; 
            if ($request == 'glow') {
                $result['produk'] = $this->MsglowModel->get_msglow()->result();
            }elseif ($request == 'oem') {
                $result['produk'] = array();
            }
            $this->load->view('gudang/sertem_produk/buat_sertem', $result, FALSE);
        }else{
            // redirect('dashboard','refresh');
        }
    }

    public function simpan(){
        $tanggal_sertem = $this->input->post('tanggal_sertem');
        $jenis = $this->input->post('jenis');
        $shift_sertem = $this->input->post('shift_sertem');
        $sertem_dari = $this->input->post('sertem_dari');
        $keterangan_sertem = $this->input->post('keterangan_sertem');

        $arr_sertem = [
            'tanggal_barang_masuk' => $tanggal_sertem,
            'shift_barang_masuk' => $shift_sertem,
            'terima_barang_masuk' => $sertem_dari,
            'keterangan_barang_masuk' => $keterangan_sertem,
        ];

        $id_sertem = $this->SertemModel->save_sertem($arr_sertem);

        if ($jenis == 'glow') {
            // $temp_id_produk = NULL;
            foreach ($this->input->post('unique_id') as $unique_id) {
                $id_produk = $this->input->post('id_produk_'.$unique_id);
                $qty_produk_sertem = $this->input->post('quantity_value_'.$unique_id);
                $no_batch_sertem = $this->input->post('nomor_batch_'.$unique_id);
                $qty_karton_sertem = $this->input->post('quantity_karton_value_'.$unique_id);
                $no_pallet_sertem = $this->input->post('no_pallet_sertem_'.$unique_id);
                $subtotal_sertem = $this->input->post('subtotal_sertem_'.$unique_id);
    
                $arr_detail_sertem = [
                    'id_barang_masuk' => $id_sertem,
                    'id_produk_msglow' => $id_produk[0],
                    'qty_masuk_msglow' => $qty_produk_sertem[0],
                    'subtotal_qty_masuk_msglow' => $subtotal_sertem[0],
                ];
    
                $id_detail_sertem = $this->SertemModel->save_detail_sertem($arr_detail_sertem);
    
                foreach ($no_batch_sertem as $index => $value) {
                    $arr_detail_batch_sertem = [
                        'id_detail_barang_masuk_msglow' => $id_detail_sertem,
                        'no_batch_barang_masuk_msglow' => $value,
                        'qty_pcs_barang_masuk_msglow' => $qty_karton_sertem[$index],
                        'no_pallet_barang_masuk_msglow' => $no_pallet_sertem[$index]
                    ];
                    $this->SertemModel->save_batch_sertem($arr_detail_batch_sertem);
                }

                $stok = $this->MsglowModel->get_msglow_id($id_produk[0])->row()->stok_produk_msglow;
                $subtotal = $this->SertemModel->get_sum_subtotal_glow($id_sertem, $id_produk[0])->row()->total_subtotal_masuk;
                $calc_total = $stok+$subtotal;

                $arr_stok_glow = [
                    'stok_produk_msglow' => $calc_total
                ];

                $this->MsglowModel->update_msglow($id_produk[0], $arr_stok_glow);

                $arr_log_msglow = [
                    'id_produk_msglow' => $id_produk[0],
                    'tanggal_log_msglow' => $tanggal_sertem,
                    'deskripsi_log_msglow' => $keterangan_sertem,
                    'in_log_msglow' => $subtotal,
                    'out_log_msglow' => 0,
                    'balance_log_msglow' => $calc_total
                ];

                $this->LogModel->save_log_msglow($arr_log_msglow);
            }
            
            redirect('sertem/data/glow','refresh');
            
        }elseif ($jenis == 'oem') {
            # code...
        }
    }

    public function hapus_glow($id){
        if (!empty($id)) {
            $sertem = $this->SertemModel->get_sertem_id($id)->row();
            $tanggal_sertem = date('d/m/Y', strtotime($sertem->tanggal_barang_masuk));
            $detail_sertem = $this->SertemModel->get_detail_group_glow($id)->result();
            foreach ($detail_sertem as $value) {
                $stok_akhir = $value->stok_produk_msglow - $value->total_subtotal_masuk;
                $arr_stok = [ 'stok_produk_msglow' => $stok_akhir ];

                $this->MsglowModel->update_msglow($value->id_produk_msglow, $arr_stok);

                $arr_log = [
                    'id_produk_msglow' => $value->id_produk_msglow,
                    'tanggal_log_msglow' => date('Y-m-d'),
                    'deskripsi_log_msglow' => "Pengembalian stok penghapusan data serah terima tanggal $tanggal_sertem",
                    'in_log_msglow' => 0,
                    'out_log_msglow' => $value->total_subtotal_masuk,
                    'balance_log_msglow' => $stok_akhir
                ];

                $this->LogModel->save_log_msglow($arr_log);
            }
            $this->SertemModel->delete_sertem($id);
            redirect('sertem/data/glow','refresh');
        }
    }

    public function hapus_oem($id){
        if (!empty($id)) {
            $this->SertemModel->delete_sertem($id);
            redirect('sertem/data/oem','refresh');
        }
    }

    public function detail_glow($id){
        if (!empty($id)) {
            $datas = [];
			$datas['total_akhir'] = $this->SertemModel->get_final_sum($id)->row()->total_subtotal;
			$datas['total_qty'] = $this->SertemModel->get_sum_qty($id)->row()->total_qty_masuk;
			$datas['sertem'] = $this->SertemModel->get_sertem_id($id)->row();
			foreach ($this->SertemModel->get_detail_sertem_glow($id)->result() as $index => $value) {
				$datas['detail_sertem'][$index] = $value;
				$temp = $this->SertemModel->get_detail_batch_glow($value->id_detail_barang_masuk_msglow)->result();
				foreach ($temp as $key => $values) {
					$datas['detail_sertem'][$index]->kontol[$key] = $values;
				}
			}
			$this->load->view('gudang/sertem_produk/detail_sertem', $datas, FALSE);
            // echo json_encode($datas);
        }
    }

    public function detail_oem($id){
        if (!empty($id)) {
            
        }
    }

}

/* End of file Sertem.php */
