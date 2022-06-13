<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - SJP</title>

    <?php $this->load->view('partials/head', FALSE);?>

    <style type="text/css">
        th{
            text-align: center;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
           if (($this->session->userdata('level') == 'gudang') || ($this->session->userdata('level') == 'admin_gudang_sier')) {
               $this->load->view('partials/sidebar_gudang', FALSE);
           }elseif ($this->session->userdata('level') == 'ms_glow') {
               $this->load->view('partials/sidebar_msglow', FALSE);
           }
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php $this->load->view('partials/navbar', FALSE);?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h4 mb-2 text-gray-800">Detail Surat Jalan Pengiriman (SJP)</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table width="100%" cellpadding="5" cellspacing="0" class="table table-bordered">
                                        <tr>
                                            <td colspan="4" width="50%">
                                                <img src="<?= base_url().'assets/img/logo.jpg'; ?>" width="200px"><br>
                                                <b style="font-size: 14px;">PT. KOSMETIKA GLOBAL INDONESIA</b><br>
                                                Jl. Rungkut Industri III No.9, Kutisari Kecamatan Tenggilis Mejoyo, Kota Surabaya.<br>
                                                Telp  : 0341-495603, FAX : 0341-4378850<br>
                                                Email : kosmetikaglobal.id@gmail.com<br>
                                                NPWP  : -
                                            </td>
                                            <td colspan="2" width="50%">
                                                <center><b style="font-size: 16px;vertical-align: text-top;">SURAT JALAN</b></center><br>
                                                No : <?php echo $sjp->nomor_sjp; ?><br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date('H:i'); ?><br><br><br><br><br><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                Pembeli <br>
                                                Nama Toko : <?php echo 'MS Glow'; ?><br>
                                                Alamat    : <?php echo ''; ?>
                                            </td>
                                            <td colspan="2">
                                                No. PO       : <br>
                                                Alamat Kirim : <?php echo $sjp->alamat_sjp; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th align="center">No.</th>
                                            <th align="center" colspan="2">Nama Barang</th>
                                            <th align="center">Jumlah</th>
                                            <th align="center">Satuan</th>
                                            <th align="center">Keterangan</th>
                                        </tr>
                                        <?php 
                                            if (isset($detail_sjp) && is_array($detail_sjp)) {
                                                $no = 1;
                                                $subtotal = 0;
                                                $kontols = "";

                                                foreach ($detail_sjp as $kontol) {
                                                    if($no == 1 ){
                                                        $kontols = $kontol->nama_produk_msglow;
                                                    }
                                                    if($kontols !== $kontol->nama_produk_msglow){
                                                        ?>
                                                            <tr>
                                                                <td></td>
                                                                <td colspan="2" align="center">Total</td>
                                                                <td align="center"><?= $subtotal ?></td>
                                                                <td align="center">Pcs</td>
                                                                <td align="left">Karton</td>
                                                            </tr>
                                                        <?php
                                                        $kontols = $kontol->nama_produk_msglow;
                                                        $subtotal = 0;
                                                    }

                                                    $subtotal += $kontol->subtotal_produk_glow;
                                                    ?>
                                                        <tr>
                                                            <td align="center"><?= $no++ ?>.</td>
                                                            <td colspan="2"><?= $kontol->nama_produk_msglow ?></td>
                                                            <td align="center"><?= $kontol->subtotal_produk_glow ?> </td>
                                                            <td align="center">Pcs</td>
                                                            <td>No. Batch :
                                                                <ul style="margin-top: 0;margin-bottom: 0;">
                                                                <?php 	
                                                                    $exp_date = "";
                                                                    if (isset($kontol->kontol)) {
                                                                        foreach ($kontol->kontol as $tetek) {
                                                                            $exp_date = $tetek->expired_date_sjp_glow;
                                                                            ?>
                                                                            <li><?= $tetek->no_batch_sjp_glow?> - <?php echo $tetek->qty_karton_sjp_glow; ?></li>
                                                                            <?php
                                                                        }
                                                                    }
                                                                ?>
                                                                </ul> 
                                                                ED : <?= $exp_date ?><br>
                                                                Qty: <?= $kontol->qty_produk_glow?> Karton
                                                            </td>
                                                        </tr>
                                                    <?php
                                                }
                                            }
                                        ?>
                                        <tr>
                                            <td></td>
                                            <td colspan="2" align="center">Total</td>
                                            <td align="center"><?= (isset($subtotal))?$subtotal:0?></td>
                                            <td align="center">Pcs</td>
                                            <td align="left">Karton</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="2" align="center">Total Keseluruhan</td>
                                            <td align="center"><?= $total_akhir ?></td>
                                            <td align="center">Pcs</td>
                                            <td align="left">Karton</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td align="center">
                                                Tanda Tangan Penerima <br><br><br><br><br><br><br>
                                                (................................................)
                                            </td>
                                            <td align="center">
                                                Security <br><br><br><br><br><br><br>
                                                (................................................)
                                            </td>
                                            <td align="center" colspan="2">
                                                SPV Gudang <br><br><br><br><br><br><br>
                                                (................................................)
                                            </td>
                                            <td align="right">
                                                Mengetahui <br> Surabaya, <?php echo date('d/m/Y'); ?> <br><br><br><br><br><br>
                                                (................................................)
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-6">&nbsp;</div>
                                    <div class="col-6">
                                        <a onclick="kembali()" class="btn btn-sm btn-secondary float-right"><i class="fas fa-times"></i> Batal</a>
                                        <button type="submit" name="btn_simpan_keluar" class="btn btn-sm btn-primary float-right mr-1 btn-simpan"><i class="fas fa-save"></i> Simpan</button>
                                    </div>
                                </div> -->
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
        </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php $this->load->view('partials/footer', FALSE); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php $this->load->view('partials/logout_modal', FALSE); ?>

    <?php $this->load->view('partials/js', FALSE);?>

</body>
</html>