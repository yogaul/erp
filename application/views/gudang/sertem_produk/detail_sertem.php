<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - MS Glow</title>

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
                    <h1 class="h4 mb-2 text-gray-800">Detail Serah Terima MS Glow</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <label for="sertem_dari" class="text-primary"><b>Serah Terima Dari</b></label>
                                    <p><?= $sertem->terima_barang_masuk ?></p>
                                </div>
                                <div class="col-3"></div>
                                <div class="col-3"></div>
                                <div class="col-3">
                                    <label for="tanggal_sertem" class="text-primary"><b>Tanggal</b></label>
                                    <p><?= date('d/m/Y', strtotime($sertem->tanggal_barang_masuk)) ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <label for="shift_sertem" class="text-primary"><b>Shift</b></label>
                                    <p><?= $sertem->shift_barang_masuk ?></p>
                                </div>
                            </div>
                            <hr> 
                            <div class="table-responsive">
                                <table width="100%" cellpadding="5" cellspacing="0" class="table table-bordered">
                                    <tr>
                                        <th align="center" width="10">No.</th>
                                        <th align="center" colspan="2">Nama Barang</th>
                                        <th align="center">Jumlah</th>
                                        <th align="center">Satuan</th>
                                        <th align="center">Keterangan</th>
                                    </tr>
                                    <?php 
                                        if (isset($detail_sertem) && is_array($detail_sertem)) {
                                            $no = 1;
                                            $subtotal = 0;
                                            $total = 0;
                                            $kontols = "";

                                            foreach ($detail_sertem as $kontol) {
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
                                                            <td align="left"><?= $total ?> Karton</td>
                                                        </tr>
                                                    <?php
                                                    $kontols = $kontol->nama_produk_msglow;
                                                    $subtotal = 0;
                                                    $total = 0;
                                                }
                                                $total += $kontol->qty_masuk_msglow;
                                                $subtotal += $kontol->subtotal_qty_masuk_msglow;
                                                ?>
                                                    <tr>
                                                        <td align="center"><?= $no++ ?>.</td>
                                                        <td colspan="2"><?= $kontol->nama_produk_msglow ?></td>
                                                        <td align="center"><?= $kontol->subtotal_qty_masuk_msglow ?> </td>
                                                        <td align="center">Pcs</td>
                                                        <td>No. Batch :
                                                            <ul style="margin-top: 0;margin-bottom: 0;">
                                                            <?php 	
                                                                $no_pallet = "";
                                                                if (isset($kontol->kontol)) {
                                                                    foreach ($kontol->kontol as $tetek) {
                                                                        $no_pallet = $tetek->no_pallet_barang_masuk_msglow;
                                                                        ?>
                                                                        <li><?= $tetek->no_batch_barang_masuk_msglow?> - <?php echo $tetek->qty_pcs_barang_masuk_msglow; ?> Pcs</li>
                                                                        <?php
                                                                    }
                                                                }
                                                            ?>
                                                            </ul> 
                                                            No.Pallet : <?= $no_pallet ?><br>
                                                            Qty: <?= $kontol->qty_masuk_msglow?> Karton
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
                                        <td align="left"><?= $total_qty ?> Karton</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="2" align="center">Total Keseluruhan</td>
                                        <td align="center"><?= $total_akhir ?></td>
                                        <td align="center">Pcs</td>
                                        <td align="left">Karton</td>
                                    </tr>
                                </table>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <label for="keterangan_sertem" class="text-primary"><b>Keterangan</b></label>
                                    <p><?= $sertem->keterangan_barang_masuk ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">&nbsp;</div>
                                <div class="col-6">
                                    <a onclick="kembali()" class="btn btn-sm btn-secondary float-right"><i class="fas fa-times"></i> Batal</a>
                                    <a onclick="coming()" class="btn btn-sm btn-primary float-right mr-1 btn-simpan"><i class="fas fa-file-pdf"></i> Cetak PDF</a>
                                </div>
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

    <script type="text/javascript">
        
        function kembali(){
            window.history.back();
        }

    </script>

</body>
</html>