<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Export extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (empty($this->session->userdata('login'))) {
			redirect('Login/index','refresh');
		}
	}

	public function index(){
    $request = $this->uri->segment(3);
    $nama_file = "PO-Bahan-$request";
		$result = $this->OrderModel->get_order_ekspor($request)->result();
		$spreadsheet = new Spreadsheet();
		$spreadsheet->setActiveSheetIndex(0)
                  ->setCellValue('A1', 'NO')
                  ->setCellValue('B1', 'KODE BAHAN')
                  ->setCellValue('C1', 'NAMA BAHAN')
                  ->setCellValue('D1', 'PO NUMBER')
                  ->setCellValue('E1', 'TANGGAL ORDER')
                  ->setCellValue('F1', 'SUPPLIER')
                  ->setCellValue('G1', 'AMOUNT OF QUANTITY')
                  ->setCellValue('H1', 'SATUAN')
                  ->setCellValue('I1', 'MATA UANG')
                  ->setCellValue('J1', 'HARGA')
                  ->setCellValue('K1', 'KURS')
                  ->setCellValue('L1', 'UNIT PRICE')
                  ->setCellValue('M1', 'UNIT PRICE / KG+PPN 10%')
                  ->setCellValue('N1', 'AMOUNT')
                  ->setCellValue('O1', 'JENIS PAJAK')
                  ->setCellValue('P1', 'JUMLAH PAJAK')
                  ->setCellValue('Q1', 'SUBTOTAL')
                  ->setCellValue('R1', 'LEAD TIME')
                  ->setCellValue('S1', 'JUMLAH KEDATANGAN')
                  ->setCellValue('T1', 'KURANG')
                  ->setCellValue('U1', 'STATUS')
                  ->setCellValue('V1', 'STATUS ACC PO')
                  ->setCellValue('W1', 'TANGGAL APPROVE')
                  ->setCellValue('X1', 'TANGGAL KEDATANGAN')
                  ->setCellValue('Y1', 'KET SURAT JALAN')
                  ->setCellValue('Z1', 'NO URUT SURAT JALAN')
                  ->setCellValue('AA1', 'NO SURAT JALAN')
                  ->setCellValue('AB1', 'PIC');
        $kolom = 2;
        $nomor = 1;
        foreach ($result as $value) {
          $data = $this->OrderModel->get_riwayat_datang($value->id_detail_order)->result();
          $tanggal_datang = "";
          $ket_surat_jalan = "";
          $no_urut = "";
          $no_surat = "";
          foreach ($data as $key) {
              $tanggal_datang .= (is_null($key->tanggal_kedatangan) || $key->tanggal_kedatangan == '0000-00-00') ? '-' : date('d/m/Y', strtotime($key->tanggal_kedatangan)).",";
              $ket_surat_jalan .= $key->keterangan_surat_jalan.',';
              $no_urut .= $key->no_urut_surat_jalan.',';
              $no_surat .= $key->no_surat_jalan.',';
          }
          $tanggal_rtrim = rtrim($tanggal_datang,',');
          $ket_rtrim = rtrim($ket_surat_jalan,',');
          $urut_rtrim = rtrim($no_urut,',');
          $surat_rtrim = rtrim($no_surat,',');

        	$spreadsheet->setActiveSheetIndex(0)
                  ->setCellValue('A'.$kolom, $nomor)
                  ->setCellValue('B'.$kolom, $value->kode_produk)
                  ->setCellValue('C'.$kolom, $value->nama_produk)
                  ->setCellValue('D'.$kolom, $value->no_po)
                  ->setCellValue('E'.$kolom, date('d/m/Y',strtotime($value->tanggal_po)))
                  ->setCellValue('F'.$kolom, $value->nama_mitra)
                  ->setCellValue('G'.$kolom, $value->kuantitas)
                  ->setCellValue('H'.$kolom, $value->satuan)
                  ->setCellValue('I'.$kolom, $value->mata_uang)
                  ->setCellValue('J'.$kolom, $harga = (strpos($value->harga, '.') !== false) ? number_format($value->harga,2,',','.') : $value->harga)
                  ->setCellValue('K'.$kolom, number_format($value->kurs,2,',','.'))
                  ->setCellValue('L'.$kolom, $price = ($value->mata_uang == 'Rupiah') ? number_format($value->harga,2,',','.') : number_format($value->harga*$value->kurs,2,',','.'))
                  ->setCellValue('M'.$kolom, $ppn = ($value->mata_uang == 'Rupiah') ? number_format($value->harga+($value->harga*$value->jenis_pajak/100),2,',','.') : number_format($value->harga*$value->kurs+($value->harga*$value->kurs*$value->jenis_pajak/100),2,',','.'))
                  ->setCellValue('N'.$kolom, $amount = ($value->mata_uang == 'Rupiah') ? number_format($value->harga,2,',','.') : number_format($value->harga*$value->kurs,2,',','.'))
                  ->setCellValue('O'.$kolom, $value->jenis_pajak.'%')
                  ->setCellValue('P'.$kolom, $pajak = ($value->mata_uang == 'Rupiah') ? number_format($value->harga*$value->jenis_pajak/100,2,',','.') : number_format($value->harga*$value->kurs*$value->jenis_pajak/100,2,',','.'))
                  ->setCellValue('Q'.$kolom, number_format($value->jumlah + ($value->jumlah*$value->jenis_pajak/100),2,',','.'))
                  ->setCellValue('R'.$kolom, date('d/m/Y',strtotime($value->lead_time)))
                  ->setCellValue('S'.$kolom, $value->datang)
                  ->setCellValue('T'.$kolom, $value->kurang)
                  ->setCellValue('U'.$kolom, $value->status)
                  ->setCellValue('V'.$kolom, $value->status_po)
                  ->setCellValue('W'.$kolom, $acc = ($value->tanggal_approve == '0000-00-00') ? '' : date('d/m/Y',strtotime($value->tanggal_approve)))
                  ->setCellValue('X'.$kolom, $tanggal_rtrim)
                  ->setCellValue('Y'.$kolom, $ket_rtrim)
                  ->setCellValue('Z'.$kolom, $urut_rtrim)
                  ->setCellValue('AA'.$kolom,$surat_rtrim)
                  ->setCellValue('AB'.$kolom,$value->nama_user);
            $kolom++;
            $nomor++;
        }

		$writer = new Xlsx($spreadsheet);

    header('Content-Type: application/vnd.ms-excel');
		header("Content-Disposition: attachment;filename=$nama_file.xlsx");
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

  public function file_datang(){
    $request = $this->uri->segment(3);
    $kategori = $this->session->userdata('kategori');
    if (!empty($request)) {
      $result_datang = $this->OrderModel->get_kedatangan($request,$kategori)->result();
      $spreadsheet = new Spreadsheet();
      $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'NO')
                    ->setCellValue('B1', 'PO NUMBER')
                    ->setCellValue('C1', 'SUPPLIER')
                    ->setCellValue('D1', 'KODE BARANG')
                    ->setCellValue('E1', 'NAMA BARANG')
                    ->setCellValue('F1', 'KATEGORI')
                    ->setCellValue('G1', 'KUANTITAS')
                    ->setCellValue('H1', 'SATUAN');
      $kolom = 2;
      $nomor = 1;
        foreach ($result_datang as $value) {
            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A'.$kolom, $nomor)
                        ->setCellValue('B'.$kolom, $value->no_po)
                        ->setCellValue('C'.$kolom, $value->nama_mitra)
                        ->setCellValue('D'.$kolom, $value->kode_produk)
                        ->setCellValue('E'.$kolom, $value->nama_produk)
                        ->setCellValue('F'.$kolom, $value->kategori_produk)
                        ->setCellValue('G'.$kolom, $value->kuantitas)
                        ->setCellValue('H'.$kolom, $value->satuan);
              $kolom++;
              $nomor++;
        }
      $writer = new Xlsx($spreadsheet);
     
      header('Content-Type: application/vnd.ms-excel');
      header("Content-Disposition: attachment;filename=Bahan_$kategori.xlsx");
      header('Cache-Control: max-age=0');

      $writer->save('php://output');

    }else{
      redirect('dashboard/index','refresh');
    }
  }

  public function eks_bahan($request){
    $data_bahan = $this->ProdukModel->get_bahan_ekspor($request)->result();
    $spreadsheet = new Spreadsheet();
    if ($this->session->userdata('level') == 'purchasing') {
      $spreadsheet->setActiveSheetIndex(0)
                  ->setCellValue('A1', 'NO')
                  ->setCellValue('B1', 'KODE BARANG')
                  ->setCellValue('C1', 'NAMA BARANG')
                  ->setCellValue('D1', 'DESKRIPSI BARANG')
                  ->setCellValue('E1', 'KODE SUPPLIER')
                  ->setCellValue('F1', 'NAMA SUPPLIER')
                  ->setCellValue('G1', 'MATA UANG')
                  ->setCellValue('H1', 'HARGA')
                  ->setCellValue('I1', 'MOQ');
      $kolom = 2;
      $nomor = 1;
       foreach ($data_bahan as $value) {
            $spreadsheet->setActiveSheetIndex(0)
                          ->setCellValue('A'.$kolom, $nomor)
                          ->setCellValue('B'.$kolom, $value->kode_produk)
                          ->setCellValue('C'.$kolom, $value->nama_produk)
                          ->setCellValue('D'.$kolom, $value->deskripsi_produk)
                          ->setCellValue('E'.$kolom, $value->no_mitra)
                          ->setCellValue('F'.$kolom, $value->nama_mitra)
                          ->setCellValue('G'.$kolom, $value->jenis_harga)
                          ->setCellValue('H'.$kolom, number_format($value->harga_bahan,2,',','.'))
                          ->setCellValue('I'.$kolom, number_format($value->moq_bahan));
            $kolom++;
            $nomor++;
        }
    }else{
      $spreadsheet->setActiveSheetIndex(0)
                  ->setCellValue('A1', 'NO')
                  ->setCellValue('B1', 'KODE BARANG')
                  ->setCellValue('C1', 'NAMA BARANG')
                  ->setCellValue('D1', 'NAMA SUPPLIER')
                  ->setCellValue('E1', 'STOK');
      $kolom = 2;
      $nomor = 1;
       foreach ($data_bahan as $value) {
            $spreadsheet->setActiveSheetIndex(0)
                          ->setCellValue('A'.$kolom, $nomor)
                          ->setCellValue('B'.$kolom, $value->kode_produk)
                          ->setCellValue('C'.$kolom, $value->nama_produk)
                          ->setCellValue('D'.$kolom, $value->nama_mitra)
                          ->setCellValue('E'.$kolom, number_format($value->stok,3,',','.'));
            $kolom++;
            $nomor++;
        }
    }
   
      $writer = new Xlsx($spreadsheet);
     
      header('Content-Type: application/vnd.ms-excel');
      header("Content-Disposition: attachment;filename=$request.xlsx");
      header('Cache-Control: max-age=0');

      $writer->save('php://output');
  }

  public function eks_mutasi(){
    $request = $this->uri->segment(3);
    if (!empty($request) && $request == 'Baku' || $request == 'Kemas') {
      $nama_file = "Mutasi-Bahan-$request";
      $data_mutasi = $this->MutasiModel->get_mutasi_ekspor($request)->result();
      $spreadsheet = new Spreadsheet();
      $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'NO')
                    ->setCellValue('B1', 'TANGGAL MUTASI')
                    ->setCellValue('C1', 'SHIFT')
                    ->setCellValue('D1', 'NAMA PRODUK')
                    ->setCellValue('E1', 'JUMLAH BATCH')
                    ->setCellValue('F1', 'NOMOR BATCH')
                    ->setCellValue('G1', 'KODE BAHAN')
                    ->setCellValue('H1', 'NAMA BAHAN')
                    ->setCellValue('I1', 'DISERAHKAN')
                    ->setCellValue('J1', 'SATUAN DISERAHKAN')
                    ->setCellValue('K1', 'DIKEMBALIKAN')
                    ->setCellValue('L1', 'SATUAN DIKEMBALIKAN')
                    ->setCellValue('M1', 'REJECT')
                    ->setCellValue('N1', 'SATUAN REJECT')
                    ->setCellValue('O1', 'STOK')
                    ->setCellValue('P1', 'STATUS MUTASI')
                    ->setCellValue('Q1', 'CATATAN MUTASI');
      $kolom = 2;
      $nomor = 1;
      foreach ($data_mutasi as $value) {
          $nomor_batch = "";
          $data_batch = $this->MutasiModel->get_batch_by_id($value->id_mutasi)->result();
          foreach ($data_batch as $key) {
            $nomor_batch .= $key->no_batch.",";
          }
          $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A'.$kolom, $nomor)
                        ->setCellValue('B'.$kolom, date('d/m/Y',strtotime($value->tanggal_mutasi)))
                        ->setCellValue('C'.$kolom, $value->shift)
                        ->setCellValue('D'.$kolom, $value->nama_produk_jadi)
                        ->setCellValue('E'.$kolom, $value->jumlah_batch)
                        ->setCellValue('F'.$kolom, rtrim($nomor_batch,','))
                        ->setCellValue('G'.$kolom, $value->kode_produk)
                        ->setCellValue('H'.$kolom, $value->nama_produk)
                        ->setCellValue('I'.$kolom, number_format($value->diserahkan,3,',','.'))
                        ->setCellValue('J'.$kolom, $value->satuan_diserahkan)
                        ->setCellValue('K'.$kolom, number_format($value->dikembalikan,3,',','.'))
                        ->setCellValue('L'.$kolom, $value->satuan_dikembalikan)
                        ->setCellValue('M'.$kolom, number_format($value->reject,3,',','.'))
                        ->setCellValue('N'.$kolom, $value->satuan_reject)
                        ->setCellValue('O'.$kolom, number_format($value->stok,3,',','.'))
                        ->setCellValue('P'.$kolom, $value->status_mutasi)
                        ->setCellValue('Q'.$kolom, $value->catatan_mutasi);
          $kolom++;
          $nomor++;
      }
      $writer = new Xlsx($spreadsheet);
     
      header('Content-Type: application/vnd.ms-excel');
      header("Content-Disposition: attachment;filename=$nama_file.xlsx");
      header('Cache-Control: max-age=0');

      $writer->save('php://output');
    }else{
      echo 'Error : Bad Params!';
    }
  }

  public function eks_bahan_gudang(){
    $request = $this->input->post('kategori_ekspor');
    $bulan = $this->input->post('bulan_ekspor');
    $tahun = $this->input->post('tahun_ekspor');
    $mbulan = (strlen($bulan) == 1) ? "0$bulan" : $bulan;
    $nama =  "BAHAN $request $mbulan-$tahun";
    
    $data_bahan = $this->ProdukModel->get_bahan_ekspor($request)->result();
    $spreadsheet = new Spreadsheet();
    $spreadsheet->setActiveSheetIndex(0)
                  ->setCellValue('A1', 'NO')
                  ->setCellValue('B1', 'KODE BARANG')
                  ->setCellValue('C1', 'NAMA BARANG')
                  ->setCellValue('D1', 'NAMA SUPPLIER')
                  ->setCellValue('E1', 'STOK AWAL')
                  ->setCellValue('F1', 'KEDATANGAN SUPPLIER')
                  ->setCellValue('G1', 'IN')
                  ->setCellValue('H1', 'OUT')
                  ->setCellValue('I1', 'STOK AKHIR');
      $kolom = 2;
      $nomor = 1;
       foreach ($data_bahan as $value) {
            $stok = $value->stok;
            $in = $this->ProdukModel->get_in_produk($value->id_produk,$mbulan,$tahun)->row()->jumlah_masuk;
            $datang = $this->ProdukModel->get_datang_produk($value->id_produk,$mbulan,$tahun)->row()->jumlah_datang;
            $out = $this->ProdukModel->get_out_produk($value->id_produk,$mbulan,$tahun)->row()->jumlah_keluar;
            $stok_awal = $stok-$datang-$in+$out;
            $stok_akhir = $stok_awal+$datang+$in-$out;
            $spreadsheet->setActiveSheetIndex(0)
                          ->setCellValue('A'.$kolom, $nomor)
                          ->setCellValue('B'.$kolom, $value->kode_produk)
                          ->setCellValue('C'.$kolom, $value->nama_produk)
                          ->setCellValue('D'.$kolom, $value->nama_mitra)
                          ->setCellValue('E'.$kolom, number_format($stok_awal,3,',','.'))
                          ->setCellValue('F'.$kolom, number_format($datang,3,',','.'))
                          ->setCellValue('G'.$kolom, number_format($in,3,',','.'))
                          ->setCellValue('H'.$kolom, number_format($out,3,',','.'))
                          ->setCellValue('I'.$kolom, number_format($stok_akhir,3,',','.'));
            $kolom++;
            $nomor++;
        }
   
      $writer = new Xlsx($spreadsheet);
     
      header('Content-Type: application/vnd.ms-excel');
      header("Content-Disposition: attachment;filename=$nama.xlsx");
      header('Cache-Control: max-age=0');

      $writer->save('php://output');
  }

  public function eks_mutasi_lain(){
      $nama_file = "Mutasi-Departmen";
      $data_mutasi_lain = $this->MutasiModel->get_mutasi_lain_ekspor()->result();
      $spreadsheet = new Spreadsheet();
      $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'NO')
                    ->setCellValue('B1', 'TANGGAL MUTASI')
                    ->setCellValue('C1', 'SHIFT')
                    ->setCellValue('D1', 'DEPARTMENT')
                    ->setCellValue('E1', 'KETERANGAN')
                    ->setCellValue('F1', 'QR CODE')
                    ->setCellValue('G1', 'KODE BAHAN')
                    ->setCellValue('H1', 'NAMA BAHAN')
                    ->setCellValue('I1', 'DISERAHKAN')
                    ->setCellValue('J1', 'SATUAN DISERAHKAN')
                    ->setCellValue('K1', 'DIKEMBALIKAN')
                    ->setCellValue('L1', 'SATUAN DIKEMBALIKAN')
                    ->setCellValue('M1', 'REJECT')
                    ->setCellValue('N1', 'SATUAN REJECT')
                    ->setCellValue('O1', 'CATATAN MUTASI');
      $kolom = 2;
      $nomor = 1;
      foreach ($data_mutasi_lain as $value) {
          $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A'.$kolom, $nomor)
                        ->setCellValue('B'.$kolom, date('d/m/Y',strtotime($value->tanggal_mutasi_lain)))
                        ->setCellValue('C'.$kolom, $value->shift_mutasi_lain)
                        ->setCellValue('D'.$kolom, $value->department)
                        ->setCellValue('E'.$kolom, $value->keterangan_mutasi_lain)
                        ->setCellValue('F'.$kolom, $value->id_detail_qr_kedatangan)
                        ->setCellValue('G'.$kolom, $value->kode_produk)
                        ->setCellValue('H'.$kolom, $value->nama_produk)
                        ->setCellValue('I'.$kolom, (empty($value->diserahkan)) ? 0.000 : number_format($value->diserahkan,3,',','.'))
                        ->setCellValue('J'.$kolom, $value->satuan_diserahkan)
                        ->setCellValue('K'.$kolom, (empty($value->dikembalikan)) ? 0.000 : number_format($value->dikembalikan,3,',','.'))
                        ->setCellValue('L'.$kolom, $value->satuan_dikembalikan)
                        ->setCellValue('M'.$kolom, (empty($value->reject)) ? 0.000 : number_format($value->reject,3,',','.'))
                        ->setCellValue('N'.$kolom, $value->satuan_reject)
                        ->setCellValue('O'.$kolom, $value->catatan_mutasi_lain);
          $kolom++;
          $nomor++;
      }
      $writer = new Xlsx($spreadsheet);
      // ob_end_clean();
      header('Content-Type: application/vnd.ms-excel');
      header("Content-Disposition: attachment;filename=$nama_file.xlsx");
      header('Cache-Control: max-age=0');

      $writer->save('php://output');
  }

  public function eks_mutasi_penjualan(){
    $nama_file = "Mutasi-Penjualan";
    $data_mutasi_lain = $this->MutasiModel->get_mutasi_penjualan_ekspor()->result();
    $spreadsheet = new Spreadsheet();
    $spreadsheet->setActiveSheetIndex(0)
                  ->setCellValue('A1', 'NO')
                  ->setCellValue('B1', 'TANGGAL MUTASI')
                  ->setCellValue('C1', 'TUJUAN')
                  ->setCellValue('D1', 'TELP')
                  ->setCellValue('E1', 'ALAMAT')
                  ->setCellValue('F1', 'QR CODE')
                  ->setCellValue('G1', 'KODE BAHAN')
                  ->setCellValue('H1', 'NAMA BAHAN')
                  ->setCellValue('I1', 'DISERAHKAN')
                  ->setCellValue('J1', 'SATUAN DISERAHKAN')
                  ->setCellValue('K1', 'CATATAN MUTASI');
    $kolom = 2;
    $nomor = 1;
    foreach ($data_mutasi_lain as $value) {
        $spreadsheet->setActiveSheetIndex(0)
                      ->setCellValue('A'.$kolom, $nomor)
                      ->setCellValue('B'.$kolom, date('d/m/Y',strtotime($value->tanggal_mutasi_penjualan)))
                      ->setCellValue('C'.$kolom, $value->nama_tujuan_pengiriman)
                      ->setCellValue('D'.$kolom, $value->no_telp_pengiriman)
                      ->setCellValue('E'.$kolom, $value->alamat_pengiriman)
                      ->setCellValue('F'.$kolom, $value->id_detail_qr_kedatangan)
                      ->setCellValue('G'.$kolom, $value->kode_produk)
                      ->setCellValue('H'.$kolom, $value->nama_produk)
                      ->setCellValue('I'.$kolom, (empty($value->diserahkan_penjualan)) ? 0.000 : number_format($value->diserahkan_penjualan,3,',','.'))
                      ->setCellValue('J'.$kolom, $value->satuan_diserahkan_penjualan)
                      ->setCellValue('K'.$kolom, $value->catatan_mutasi_penjualan);
        $kolom++;
        $nomor++;
    }
    $writer = new Xlsx($spreadsheet);
    ob_end_clean();
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment;filename=$nama_file.xlsx");
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
}

  public function eks_survey(){
    $data_survey = $this->SurveyModel->get()->result();
    $spreadsheet = new Spreadsheet();
    $spreadsheet->setActiveSheetIndex(0)
                  ->setCellValue('A1', 'NO')
                  ->setCellValue('B1', 'EMAIL')
                  ->setCellValue('C1', 'NAMA CUSTOMER')
                  ->setCellValue('D1', 'TELP')
                  ->setCellValue('E1', 'ALAMAT')
                  ->setCellValue('F1', 'PRODUK YANG INGIN DIPESAN')
                  ->setCellValue('G1', 'STATUS CUSTOMER')
                  ->setCellValue('H1', 'BRAND')
                  ->setCellValue('I1', 'ESTIMASI LAUNCHING');
    $kolom = 2;
    $nomor = 1;
        foreach ($data_survey as $value) {
           $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A'.$kolom, $value->id_survey)
                        ->setCellValue('B'.$kolom, $value->email_cust_survey)
                        ->setCellValue('C'.$kolom, $value->nama_cust_survey)
                        ->setCellValue('D'.$kolom, $value->telp_cust_survey)
                        ->setCellValue('E'.$kolom, $value->alamat_cust_survey)
                        ->setCellValue('F'.$kolom, $value->order_cust_survey)
                        ->setCellValue('G'.$kolom, $value->status_cust_survey)
                        ->setCellValue('H'.$kolom, $value->brand_cust_survey)
                        ->setCellValue('I'.$kolom, date('d/m/Y',strtotime($value->estimasi_launch_survey)));
          $kolom++;
          $nomor++;
        }
      $writer = new Xlsx($spreadsheet);
     
      header('Content-Type: application/vnd.ms-excel');
      header("Content-Disposition: attachment;filename=Survey.xlsx");
      header('Cache-Control: max-age=0');

      $writer->save('php://output');
  }

  public function status(){
    $request = $this->uri->segment(3);
    if (!empty($request) & $request == 'Belum' || $request == 'Reminder' || $request == 'Terlambat') {
      $kategori = $this->session->userdata('kategori');
      $nama_file = "PO-Bahan-$kategori-$request";
      $result = $this->OrderModel->get_ekspor_by_status($request,$kategori)->result();
      $spreadsheet = new Spreadsheet();
      $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'NO')
                    ->setCellValue('B1', 'KODE BAHAN')
                    ->setCellValue('C1', 'NAMA BAHAN')
                    ->setCellValue('D1', 'PO NUMBER')
                    ->setCellValue('E1', 'TANGGAL ORDER')
                    ->setCellValue('F1', 'SUPPLIER')
                    ->setCellValue('G1', 'AMOUNT OF QUANTITY')
                    ->setCellValue('H1', 'SATUAN')
                    ->setCellValue('I1', 'MATA UANG')
                    ->setCellValue('J1', 'HARGA')
                    ->setCellValue('K1', 'KURS')
                    ->setCellValue('L1', 'UNIT PRICE')
                    ->setCellValue('M1', 'UNIT PRICE / KG+PPN 10%')
                    ->setCellValue('N1', 'AMOUNT')
                    ->setCellValue('O1', 'JENIS PAJAK')
                    ->setCellValue('P1', 'JUMLAH PAJAK')
                    ->setCellValue('Q1', 'SUBTOTAL')
                    ->setCellValue('R1', 'LEAD TIME')
                    ->setCellValue('S1', 'JUMLAH KEDATANGAN')
                    ->setCellValue('T1', 'KURANG')
                    ->setCellValue('U1', 'STATUS')
                    ->setCellValue('V1', 'STATUS ACC PO')
                    ->setCellValue('W1', 'PIC');
          $kolom = 2;
          $nomor = 1;
          foreach ($result as $value) {
            $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A'.$kolom, $nomor)
                    ->setCellValue('B'.$kolom, $value->kode_produk)
                    ->setCellValue('C'.$kolom, $value->nama_produk)
                    ->setCellValue('D'.$kolom, $value->no_po)
                    ->setCellValue('E'.$kolom, date('d/m/Y',strtotime($value->tanggal_po)))
                    ->setCellValue('F'.$kolom, $value->nama_mitra)
                    ->setCellValue('G'.$kolom, $value->kuantitas)
                    ->setCellValue('H'.$kolom, $value->satuan)
                    ->setCellValue('I'.$kolom, $value->mata_uang)
                    ->setCellValue('J'.$kolom, $harga = ($value->mata_uang == 'Rupiah') ? number_format($value->harga) : $value->harga)
                    ->setCellValue('K'.$kolom, number_format($value->kurs))
                    ->setCellValue('L'.$kolom, $price = ($value->mata_uang == 'Rupiah') ? number_format($value->harga) : number_format($value->harga*$value->kurs))
                    ->setCellValue('M'.$kolom, $ppn = ($value->mata_uang == 'Rupiah') ? number_format($value->harga+($value->harga*$value->jenis_pajak/100)) : number_format($value->harga*$value->kurs+($value->harga*$value->kurs*$value->jenis_pajak/100)))
                    ->setCellValue('N'.$kolom, $amount = ($value->mata_uang == 'Rupiah') ? number_format($value->harga) : number_format($value->harga*$value->kurs))
                    ->setCellValue('O'.$kolom, $value->jenis_pajak.'%')
                    ->setCellValue('P'.$kolom, $pajak = ($value->mata_uang == 'Rupiah') ? number_format($value->harga*$value->jenis_pajak/100) : number_format($value->harga*$value->kurs*$value->jenis_pajak/100))
                    ->setCellValue('Q'.$kolom, number_format($value->jumlah + ($value->jumlah*$value->jenis_pajak/100)))
                    ->setCellValue('R'.$kolom, date('d/m/Y',strtotime($value->lead_time)))
                    ->setCellValue('S'.$kolom, $value->datang)
                    ->setCellValue('T'.$kolom, $value->kurang)
                    ->setCellValue('U'.$kolom, $value->status)
                    ->setCellValue('V'.$kolom, $value->status_po)
                    ->setCellValue('W'.$kolom, $value->nama_user);
              $kolom++;
              $nomor++;
          }

      $writer = new Xlsx($spreadsheet);

      header('Content-Type: application/vnd.ms-excel');
      header("Content-Disposition: attachment;filename=$nama_file.xlsx");
      header('Cache-Control: max-age=0');

      $writer->save('php://output');
    }else{
      echo "Bad Params Detected !";
    }
  }

  public function eks_history_gudang(){
      $kategori = $this->input->post('kategori_ekspor');
		  $satuan = ($kategori == 'Baku') ? 'Kg' : 'Pcs';
      $bulan = $this->input->post('bulan_ekspor');
      $tahun = $this->input->post('tahun_ekspor');

      $result = $this->OrderModel->get_history_ekspor($bulan,$tahun,$kategori)->result();
      $spreadsheet = new Spreadsheet();
      $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Tanggal')
                    ->setCellValue('C1', 'Kode Kedatangan')
                    ->setCellValue('D1', 'Jenis Bahan')
                    ->setCellValue('E1', 'Nama Bahan')
                    ->setCellValue('F1', 'BATCH')
                    ->setCellValue('G1', 'No. Purchase Order')
                    ->setCellValue('H1', 'No. Surat Jalan')
                    ->setCellValue('I1', 'Supplier')
                    ->setCellValue('J1', 'Actual')
                    ->setCellValue('K1', 'Satuan')
                    ->setCellValue('L1', 'Expired Date')
                    ->setCellValue('M1', 'KETERANGAN');
      $kolom = 2;
      $nomor = 1;
          foreach ($result as $value) {
             $spreadsheet->setActiveSheetIndex(0)
                          ->setCellValue('A'.$kolom, $nomor)
                          ->setCellValue('B'.$kolom, date('d/m/Y',strtotime($value->tanggal_kedatangan)))
                          ->setCellValue('C'.$kolom, $value->kode_kedatangan)
                          ->setCellValue('D'.$kolom, $value->kategori_produk)
                          ->setCellValue('E'.$kolom, $value->nama_produk)
                          ->setCellValue('F'.$kolom, $value->no_batch_kedatangan)
                          ->setCellValue('G'.$kolom, $value->no_po)
                          ->setCellValue('H'.$kolom, $value->no_surat_jalan)
                          ->setCellValue('I'.$kolom, $value->nama_mitra)
                          ->setCellValue('J'.$kolom, number_format($value->jumlah_kedatangan,2,',','.'))
                          ->setCellValue('K'.$kolom, $satuan)
                          ->setCellValue('L'.$kolom, date('d/m/Y',strtotime($value->expired_date)))
                          ->setCellValue('M'.$kolom, $value->keterangan_kedatangan);
            $kolom++;
            $nomor++;
          }
        $writer = new Xlsx($spreadsheet);
       
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=Riwayat Kedatangan Bahan $kategori.xlsx");
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
  }

  public function search_history(){
    $kategori = $this->input->post('kategori');
    $satuan = ($kategori == 'Baku') ? 'Kg' : 'Pcs';
    $start = $this->input->post('start');
    $end = $this->input->post('end');

    $result = $this->OrderModel->get_history_range($start, $end, $kategori)->result();
    $spreadsheet = new Spreadsheet();
    $spreadsheet->setActiveSheetIndex(0)
                  ->setCellValue('A1', 'No')
                  ->setCellValue('B1', 'Tanggal')
                  ->setCellValue('C1', 'Kode Kedatangan')
                  ->setCellValue('D1', 'Jenis Bahan')
                  ->setCellValue('E1', 'Nama Bahan')
                  ->setCellValue('F1', 'BATCH')
                  ->setCellValue('G1', 'No. Purchase Order')
                  ->setCellValue('H1', 'No. Surat Jalan')
                  ->setCellValue('I1', 'Supplier')
                  ->setCellValue('J1', 'Actual')
                  ->setCellValue('K1', 'Satuan')
                  ->setCellValue('L1', 'Expired Date')
                  ->setCellValue('M1', 'KETERANGAN');
    $kolom = 2;
    $nomor = 1;
        foreach ($result as $value) {
           $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A'.$kolom, $nomor)
                        ->setCellValue('B'.$kolom, date('d/m/Y',strtotime($value->tanggal_kedatangan)))
                        ->setCellValue('C'.$kolom, $value->kode_kedatangan)
                        ->setCellValue('D'.$kolom, $value->kategori_produk)
                        ->setCellValue('E'.$kolom, $value->nama_produk)
                        ->setCellValue('F'.$kolom, $value->no_batch_kedatangan)
                        ->setCellValue('G'.$kolom, $value->no_po)
                        ->setCellValue('H'.$kolom, $value->no_surat_jalan)
                        ->setCellValue('I'.$kolom, $value->nama_mitra)
                        ->setCellValue('J'.$kolom, number_format($value->jumlah_kedatangan,2,',','.'))
                        ->setCellValue('K'.$kolom, $satuan)
                        ->setCellValue('L'.$kolom, date('d/m/Y',strtotime($value->expired_date)))
                        ->setCellValue('M'.$kolom, $value->keterangan_kedatangan);
          $kolom++;
          $nomor++;
        }
      $writer = new Xlsx($spreadsheet);
     
      header('Content-Type: application/vnd.ms-excel');
      header("Content-Disposition: attachment;filename=Riwayat Kedatangan Bahan $kategori.xlsx");
      header('Cache-Control: max-age=0');

      $writer->save('php://output');
  }

  public function mitra($request){
      $result = $this->MitraModel->get_mitra($request)->result();
      $spreadsheet = new Spreadsheet();
      $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Kode')
                    ->setCellValue('C1', 'Nama')
                    ->setCellValue('D1', 'Email')
                    ->setCellValue('E1', 'Badan Usaha')
                    ->setCellValue('F1', 'Kategori Supplier')
                    ->setCellValue('G1', 'Telepon')
                    ->setCellValue('H1', 'Negara')
                    ->setCellValue('I1', 'Alamat');
      $kolom = 2;
      $nomor = 1;
          foreach ($result as $value) {
             $spreadsheet->setActiveSheetIndex(0)
                          ->setCellValue('A'.$kolom, $nomor)
                          ->setCellValue('B'.$kolom, $value->no_mitra)
                          ->setCellValue('C'.$kolom, $value->nama_mitra)
                          ->setCellValue('D'.$kolom, $value->email_mitra)
                          ->setCellValue('E'.$kolom, $value->badan_usaha)
                          ->setCellValue('F'.$kolom, $value->tipe_mitra)
                          ->setCellValue('G'.$kolom, $value->telp_mitra)
                          ->setCellValue('H'.$kolom, $value->negara_mitra)
                          ->setCellValue('I'.$kolom, $value->alamat_baris_1);
            $kolom++;
            $nomor++;
          }
        $writer = new Xlsx($spreadsheet);
       
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=Supplier Bahan $request.xlsx");
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
  }

  public function komplain(){
      $filename = "CUSTOMER RESPONSE ".date('d/m/Y');
      $result = $this->KomplainModel->get_komplain()->result();
      $spreadsheet = new Spreadsheet();
      $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Tanggal')
                    ->setCellValue('C1', 'Nama Konsumen')
                    ->setCellValue('D1', 'Usia')
                    ->setCellValue('E1', 'Produk')
                    ->setCellValue('F1', 'Keterangan')
                    ->setCellValue('G1', 'Nomor Batch Produk')
                    ->setCellValue('H1', 'Tgl. Expired Produk')
                    ->setCellValue('I1', 'Jumlah Produk')
                    ->setCellValue('J1', 'Frekuensi Pemakaian')
                    ->setCellValue('K1', 'Lama Pemakaian')
                    ->setCellValue('L1', 'Tgl. Pembelian')
                    ->setCellValue('M1', 'Foto/Video Produk');
      $kolom = 2;
      $nomor = 1;
          foreach ($result as $value) {
             $spreadsheet->setActiveSheetIndex(0)
                          ->setCellValue('A'.$kolom, $nomor)
                          ->setCellValue('B'.$kolom, date('d/m/Y H:i:s', strtotime($value->tanggal_komplain)))
                          ->setCellValue('C'.$kolom, $value->nama_konsumen)
                          ->setCellValue('D'.$kolom, $value->usia_konsumen)
                          ->setCellValue('E'.$kolom, $value->produk_komplain)
                          ->setCellValue('F'.$kolom, $value->keterangan_komplain)
                          ->setCellValue('G'.$kolom, $value->batch_number_produk)
                          ->setCellValue('H'.$kolom, date('d/m/Y', strtotime($value->tanggal_expired_produk)))
                          ->setCellValue('I'.$kolom, $value->jumlah_produk_komplain)
                          ->setCellValue('J'.$kolom, $value->frekuensi_pemakaian)
                          ->setCellValue('K'.$kolom, $value->lama_pemakaian)
                          ->setCellValue('L'.$kolom, date('d/m/Y', strtotime($value->tanggal_pembelian_produk)))
                          ->setCellValue('M'.$kolom, $value->foto_video_produk);
            $kolom++;
            $nomor++;
          }
      $writer = new Xlsx($spreadsheet);
       
      header('Content-Type: application/vnd.ms-excel');
      header("Content-Disposition: attachment;filename=$filename.xlsx");
      header('Cache-Control: max-age=0');

      $writer->save('php://output');
  }

  public function validasi_status($status){
    $filename = "Validasi  $status - ".date('d/m/Y');
		$kategori = $this->session->userdata('kategori');
		$satuan = ($kategori == 'Baku') ? 'Kg' : 'Pieces';
    $result = $this->OrderModel->get_history_validasi($status,$kategori)->result();
    $jumlah = "";
    $spreadsheet = new Spreadsheet();
    $spreadsheet->setActiveSheetIndex(0)
                  ->setCellValue('A1', 'No')
                  ->setCellValue('B1', 'Tanggal Kedatangan')
                  ->setCellValue('C1', 'Nomor Analisa')
                  ->setCellValue('D1', 'Kode Bahan')
                  ->setCellValue('E1', 'Nama Bahan')
                  ->setCellValue('F1', 'Supplier')
                  ->setCellValue('G1', 'Jumlah Datang')
                  ->setCellValue('H1', 'Detail');
    $kolom = 2;
    $nomor = 1;
        foreach ($result as $value) {
         
          $detail_penerimaan = $this->OrderModel->get_detail_penerimaan($value->id_bahan_datang)->result();
          foreach ($detail_penerimaan as $key) {
              $satuan = (is_null($key->satuan_kedatangan)) ? 'Pieces' : $key->satuan_kedatangan;
              $jumlah .= $key->qty_kedatangan.' '.$key->kemasan_kedatangan.'@'.$key->isi_kedatangan.''.$satuan.';';
          }
          $jumlah_trim = rtrim($jumlah,';');
        
           $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A'.$kolom, $nomor)
                        ->setCellValue('B'.$kolom, date('d/m/Y', strtotime($value->tanggal_kedatangan)))
                        ->setCellValue('C'.$kolom, $value->kode_kedatangan)
                        ->setCellValue('D'.$kolom, $value->kode_produk)
                        ->setCellValue('E'.$kolom, $value->nama_produk)
                        ->setCellValue('F'.$kolom, $value->nama_mitra)
                        ->setCellValue('G'.$kolom, number_format($value->jumlah_kedatangan,3,',','.')." ".$satuan)
                        ->setCellValue('H'.$kolom, $jumlah_trim);
          $kolom++;
          $nomor++;
        }
    $writer = new Xlsx($spreadsheet);
     
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment;filename=$filename.xlsx");
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
}

public function validasi_belum($kategori){
    $filename = "Validasi Belum - ".date('d/m/Y');
    $satuan = ($kategori == 'baku') ? 'Kg' : 'Pieces';
    $result = $this->OrderModel->get_history_validasi('Belum',$kategori)->result();
    $jumlah = "";
    $spreadsheet = new Spreadsheet();
    $spreadsheet->setActiveSheetIndex(0)
                  ->setCellValue('A1', 'No')
                  ->setCellValue('B1', 'Tanggal Kedatangan')
                  ->setCellValue('C1', 'Nomor Analisa')
                  ->setCellValue('D1', 'Kode Bahan')
                  ->setCellValue('E1', 'Nama Bahan')
                  ->setCellValue('F1', 'Supplier')
                  ->setCellValue('G1', 'Jumlah Datang')
                  ->setCellValue('H1', 'Detail');
    $kolom = 2;
    $nomor = 1;
        foreach ($result as $value) {
        
          $detail_penerimaan = $this->OrderModel->get_detail_penerimaan($value->id_bahan_datang)->result();
          foreach ($detail_penerimaan as $key) {
              $satuan = (is_null($key->satuan_kedatangan)) ? 'Pieces' : $key->satuan_kedatangan;
              $jumlah .= $key->qty_kedatangan.' '.$key->kemasan_kedatangan.'@'.$key->isi_kedatangan.''.$satuan.';';
          }
          $jumlah_trim = rtrim($jumlah,';');
        
          $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A'.$kolom, $nomor)
                        ->setCellValue('B'.$kolom, date('d/m/Y', strtotime($value->tanggal_kedatangan)))
                        ->setCellValue('C'.$kolom, $value->kode_kedatangan)
                        ->setCellValue('D'.$kolom, $value->kode_produk)
                        ->setCellValue('E'.$kolom, $value->nama_produk)
                        ->setCellValue('F'.$kolom, $value->nama_mitra)
                        ->setCellValue('G'.$kolom, number_format($value->jumlah_kedatangan,3,',','.')." ".$satuan)
                        ->setCellValue('H'.$kolom, $jumlah_trim);
          $kolom++;
          $nomor++;
        }
    $writer = new Xlsx($spreadsheet);
    
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment;filename=$filename.xlsx");
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
}

public function validasi_history(){
  $kategori = $this->uri->segment(3);
  $status = $this->uri->segment(4);
  $filename = "Validasi $status - ".date('d/m/Y');
  $satuan = ($kategori == 'baku') ? 'Kg' : 'Pieces';
  $result = $this->OrderModel->get_history_validasi($status,$kategori)->result();
  $jumlah = "";
  $spreadsheet = new Spreadsheet();
  $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A1', 'No')
                ->setCellValue('B1', 'Tanggal Kedatangan')
                ->setCellValue('C1', 'Nomor Analisa')
                ->setCellValue('D1', 'Kode Bahan')
                ->setCellValue('E1', 'Nama Bahan')
                ->setCellValue('F1', 'Supplier')
                ->setCellValue('G1', 'Jumlah Datang')
                ->setCellValue('H1', 'Detail');
  $kolom = 2;
  $nomor = 1;
      foreach ($result as $value) {
      
        $detail_penerimaan = $this->OrderModel->get_detail_penerimaan($value->id_bahan_datang)->result();
        foreach ($detail_penerimaan as $key) {
            $satuan = (is_null($key->satuan_kedatangan)) ? 'Pieces' : $key->satuan_kedatangan;
            $jumlah .= $key->qty_kedatangan.' '.$key->kemasan_kedatangan.'@'.$key->isi_kedatangan.''.$satuan.';';
        }
        $jumlah_trim = rtrim($jumlah,';');
      
        $spreadsheet->setActiveSheetIndex(0)
                      ->setCellValue('A'.$kolom, $nomor)
                      ->setCellValue('B'.$kolom, date('d/m/Y', strtotime($value->tanggal_kedatangan)))
                      ->setCellValue('C'.$kolom, $value->kode_kedatangan)
                      ->setCellValue('D'.$kolom, $value->kode_produk)
                      ->setCellValue('E'.$kolom, $value->nama_produk)
                      ->setCellValue('F'.$kolom, $value->nama_mitra)
                      ->setCellValue('G'.$kolom, number_format($value->jumlah_kedatangan,3,',','.')." ".$satuan)
                      ->setCellValue('H'.$kolom, $jumlah_trim);
        $kolom++;
        $nomor++;
      }
  $writer = new Xlsx($spreadsheet);
  
  header('Content-Type: application/vnd.ms-excel');
  header("Content-Disposition: attachment;filename=$filename.xlsx");
  header('Cache-Control: max-age=0');

  $writer->save('php://output');
}

public function sample_awal(){
  $filename = "SAMPLE AWAL - ".date('d/m/Y');
  $result = $this->SampleAwalModel->get_detail_sample_awal()->result();
  $spreadsheet = new Spreadsheet();
  $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A1', 'No')
                ->setCellValue('B1', 'Tanggal Permintaan')
                ->setCellValue('C1', 'Nama Customer')
                ->setCellValue('D1', 'Nama Perusahaan')
                ->setCellValue('E1', 'Jabatan')
                ->setCellValue('F1', 'Alamat Pengiriman')
                ->setCellValue('G1', 'Telp. Customer')
                ->setCellValue('H1', 'Telp. Perusahaan')
                ->setCellValue('I1', 'Marketing')
                ->setCellValue('J1', 'Permintaan Sample')
                ->setCellValue('K1', 'Target Harga')
                ->setCellValue('L1', 'Volume')
                ->setCellValue('M1', 'Spesifikasi')
                ->setCellValue('N1', 'Contoh Foto')
                ->setCellValue('O1', 'Request Ke RnD')
                ->setCellValue('P1', 'Deadline RnD')
                ->setCellValue('Q1', 'Kode')
                ->setCellValue('R1', 'Tanggal Pengiriman')
                ->setCellValue('S1', 'Status');
  $kolom = 2;
  $nomor = 1;
      foreach ($result as $value) {
         $spreadsheet->setActiveSheetIndex(0)
                      ->setCellValue('A'.$kolom, $nomor)
                      ->setCellValue('B'.$kolom, date('d/m/Y H:i:s', strtotime($value->tanggal_request_awal)))
                      ->setCellValue('C'.$kolom, $value->nama_customer)
                      ->setCellValue('D'.$kolom, $value->nama_perusahaan_customer)
                      ->setCellValue('E'.$kolom, $value->jabatan_customer)
                      ->setCellValue('F'.$kolom, $value->alamat_perusahaan_kirim)
                      ->setCellValue('G'.$kolom, $value->telp_customer)
                      ->setCellValue('H'.$kolom, $value->telp_perusahaan_customer)
                      ->setCellValue('I'.$kolom, $value->nama_user)
                      ->setCellValue('J'.$kolom, $value->permintaan_sample_awal)
                      ->setCellValue('K'.$kolom, 'Rp.'.number_format($value->target_harga_awal,0,',','.'))
                      ->setCellValue('L'.$kolom, $value->volume_sample_awal)
                      ->setCellValue('M'.$kolom, $value->spesifikasi_sample_awal)
                      ->setCellValue('N'.$kolom, $value->foto_sample_awal)
                      ->setCellValue('O'.$kolom, $mrequest = (is_null($value->tanggal_request_rnd)) ? '' : date('d/m/Y H:i:s', strtotime($value->tanggal_request_rnd)))
                      ->setCellValue('P'.$kolom, $mdeadline = (is_null($value->deadline_sample_awal)) ? '' : date('d/m/Y', strtotime($value->deadline_sample_awal)))
                      ->setCellValue('Q'.$kolom, $value->kode_sample_awal)
                      ->setCellValue('R'.$kolom, $mkirim = (is_null($value->tanggal_kirim_sample)) ? '' : date('d/m/Y H:i:s', strtotime($value->tanggal_kirim_sample)))
                      ->setCellValue('S'.$kolom, $value->status_sample_awal);
        $kolom++;
        $nomor++;
      }
  $writer = new Xlsx($spreadsheet);
   
  header('Content-Type: application/vnd.ms-excel');
  header("Content-Disposition: attachment;filename=$filename.xlsx");
  header('Cache-Control: max-age=0');

  $writer->save('php://output');
}

public function estimasi($kategori){
    $filename = "Estimasi Bahan $kategori ";
    $start = date('Y-m-d');
		$end = date( "Y-m-d", strtotime( "$start +7 day" ) );
		$result = $this->OrderModel->get_estimasi_all($start, $end, $kategori)->result();
    $spreadsheet = new Spreadsheet();
    $spreadsheet->setActiveSheetIndex(0)
                  ->setCellValue('A1', 'No')
                  ->setCellValue('B1', 'Nomor PO')
                  ->setCellValue('C1', 'Supplier')
                  ->setCellValue('D1', 'Nama Barang')
                  ->setCellValue('E1', 'Estimasi Datang')
                  ->setCellValue('F1', 'Jumlah Kedatangan');
    $kolom = 2;
    $nomor = 1;
        foreach ($result as $value) {
          $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A'.$kolom, $nomor)
                        ->setCellValue('B'.$kolom, $value->no_po)
                        ->setCellValue('C'.$kolom, $value->nama_mitra)
                        ->setCellValue('D'.$kolom, $value->nama_produk)
                        ->setCellValue('E'.$kolom, date('d/m/Y', strtotime($value->tgl_lead_time)))
                        ->setCellValue('F'.$kolom, number_format($value->jumlah_kedatangan,3,',','.'));
          $kolom++;
          $nomor++;
        }
    $writer = new Xlsx($spreadsheet);
    
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment;filename=$filename.xlsx");
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
}

public function estimasi_range(){
  $kategori = $this->input->post('kategori');
  $start = $this->input->post('start');
  $end = $this->input->post('end');
  
  $filename = "Estimasi Bahan $kategori ";
  $result = $this->OrderModel->get_estimasi_all($start, $end, $kategori)->result();
  $spreadsheet = new Spreadsheet();
  $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A1', 'No')
                ->setCellValue('B1', 'Nomor PO')
                ->setCellValue('C1', 'Supplier')
                ->setCellValue('D1', 'Nama Barang')
                ->setCellValue('E1', 'Estimasi Datang')
                ->setCellValue('F1', 'Jumlah Kedatangan');
  $kolom = 2;
  $nomor = 1;
      foreach ($result as $value) {
        $spreadsheet->setActiveSheetIndex(0)
                      ->setCellValue('A'.$kolom, $nomor)
                      ->setCellValue('B'.$kolom, $value->no_po)
                      ->setCellValue('C'.$kolom, $value->nama_mitra)
                      ->setCellValue('D'.$kolom, $value->nama_produk)
                      ->setCellValue('E'.$kolom, date('d/m/Y', strtotime($value->tgl_lead_time)))
                      ->setCellValue('F'.$kolom, number_format($value->jumlah_kedatangan,3,',','.'));
        $kolom++;
        $nomor++;
      }
  $writer = new Xlsx($spreadsheet);
  
  header('Content-Type: application/vnd.ms-excel');
  header("Content-Disposition: attachment;filename=$filename.xlsx");
  header('Cache-Control: max-age=0');

  $writer->save('php://output');
}

}

/* End of file Export.php */
/* Location: ./application/controllers/Export.php */