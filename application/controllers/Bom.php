<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bom extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (empty($this->session->userdata('login'))) {
			redirect('Login/index','refresh');
		}
		$array = array(
			'active' => 'bom'
		);
		$this->session->set_userdata( $array );
	}

	public function index(){
		$level = $this->session->userdata('level');
		if ($level == 'marketing' || $level == 'direktur') {
			$result['list_bom'] = $this->BomModel->get_list_bom()->result();
		}elseif ($level == 'tim_marketing') {
			$id = $this->session->userdata('id_user');
			$result['list_bom'] = $this->BomModel->get_list_bom_tim($id)->result();
		}
		$this->load->view('marketing/bom/data_bom', $result, FALSE);
	}

	public function buat_bom(){
		$result['nomor_po'] = "PO - ".date('d/m/Y');
		$level = $this->session->userdata('level');
		if ($level == 'marketing') {
			$result['brand'] = $this->BrandModel->get_brand()->result();
		}elseif ($level == 'tim_marketing') {
			$id = $this->session->userdata('id_user');
			$result['brand'] = $this->BrandModel->get_brand_tim($id)->result();
		}
		$this->load->view('marketing/bom/buat_bom', $result, FALSE);
	}

	public function simpan_bom(){
		$id_bom = "BOM-".date('YmdHis');
		$id_brand = $this->input->post('brand_bom');
		$no_po_bom = $this->input->post('no_po_bom');
		$catatan_bom = $this->input->post('catatan_bom');

		$arr_bom = [
			'id_bom' => $id_bom,
			'id_brand_produk' => $id_brand,
			'tanggal_bom' => date('Y-m-d'),
			'no_po_bom' => $no_po_bom,
			'catatan_bom' => $catatan_bom
		];

		$this->BomModel->save_bom($arr_bom);
		
		$id_produk = $this->input->post('id_produk');
		$shrink = $this->input->post('shrink');
		$inner_box = $this->input->post('inner_box');
		$label = $this->input->post('label');
		$karton = $this->input->post('karton');
		$lain = $this->input->post('lain');
		$coding = $this->input->post('coding');
		$ro1 = $this->input->post('ro1');

		foreach ($id_produk as $key => $value) {
			$nama_file = $value."-".date('YmdHis');
			$arr_detail_bom = [
				'id_bom' => $id_bom,
				'id_sample_acc' => $value,
				'shrink_bom' => $shrink[$key],
				'inner_box_bom' => $inner_box[$key],
				'label_bom' => $label[$key],
				'karton_bom' => $karton[$key],
				'lain_lain_bom' => $lain[$key],
				'coding_bom' => $coding[$key],
				'ro_bom' => $ro1[$key],
				'foto_desain_bom' => $this->upload_image($nama_file, $key)
			];
			$this->BomModel->save_detail_bom($arr_detail_bom);
		}
		redirect('bom','refresh');
	}

	private function upload_image($filename, $index){
		$files = $_FILES;
		$image_path = base_url().'uploads/desain_bom/';

	    if($_FILES['foto_desain']['name'][$index] != ""){
			$_FILES['foto_desain']['name']= $files['foto_desain']['name'][$index];
	        $_FILES['foto_desain']['type']= $files['foto_desain']['type'][$index];
	        $_FILES['foto_desain']['tmp_name']= $files['foto_desain']['tmp_name'][$index];
	        $_FILES['foto_desain']['error']= $files['foto_desain']['error'][$index];
	        $_FILES['foto_desain']['size']= $files['foto_desain']['size'][$index];

	        $config['upload_path']          = './uploads/desain_bom/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['file_name']            = $filename;
			$config['overwrite']			= true;
			$config['max_size']             = 3000; // 3MB

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload("foto_desain")) {
				$upload_data = $this->upload->data("file_name");
				return $image_path.$upload_data;
			}else{
				return $image_path."default.jpg";
			}
	    }else{
	    	return $image_path."default.jpg";
	    }
	}

	public function detail(){
		$id = $this->uri->segment(3);
		if (!empty($id)) {
			$result['id'] = $id;
			$result['data_bom'] = $this->BomModel->get_bom_id($id)->row();
			$result['detail_bom'] = $this->BomModel->get_detail_bom($id)->result();
			$this->load->view('marketing/bom/detail_bom', $result, FALSE);
		}else{
			redirect('dashboard','refresh');
		}
	}

	public function get_json_img(){
		$id = $this->input->post('id');
		$foto_desain = $this->BomModel->get_img_detail($id)->row()->foto_desain_bom;
		echo json_encode($foto_desain);
	}

	// public function ubah(){
	// 	$id = $this->uri->segment(3);
	// 	if (!empty($id)) {
	// 		$result['data_bom'] = $this->BomModel->get_bom_id($id)->row();
	// 		$result['brand'] = $this->BrandModel->get_brand()->result();
	// 		$result['detail_bom'] = $this->BomModel->get_detail_bom($id)->result();
	// 		$this->load->view('marketing/bom/edit_bom', $result, FALSE);
	// 	}else{
	// 		redirect('dashboard','refresh');
	// 	}
	// }

	// public function ubah_bom(){
		// write your code here
	// }

	public function cetak_bom($id){
		if (!empty($id)) {
			$output_file = "BOM-".date('dmY');
			$result['data_bom'] = $this->BomModel->get_bom_id($id)->row();
			$result['detail_bom'] = $this->BomModel->get_detail_bom($id)->result();
			$result['num_produk'] = $this->BomModel->get_detail_bom($id)->num_rows();
			$this->pdf->setPaper('A4','landscape');
			$this->pdf->filename = "$output_file";
			$this->pdf->load_view('marketing/bom/bom_pdf',$result);
			// echo json_encode($result);
		}else{
			redirect('dashboard','refresh');
		}
	}

}

/* End of file Bom.php */
/* Location: ./application/controllers/Bom.php */