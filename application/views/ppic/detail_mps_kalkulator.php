<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

<title>PT. KOSME - MPS Kalkulator</title>

    <?php $this->load->view('partials/head', FALSE); ?>
    
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view('partials/sidebar_ppic', FALSE); ?>
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
                    <h1 class="h4 mb-2 text-gray-800">Detail MPS Kalkulator</h1>

                    <!-- DataTales Example -->
                    <form action="<?php echo base_url().'kalkulator/simpan' ?>" method="post" id="form-kalkulator">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="tgl_kalkulator" class="text-primary"><b>Tanggal</b></label><br>
                                            <label><?= date('d/m/Y', strtotime($mps->tanggal_mps_kalkulator)) ?></label>
                                        </div>
                                        <div class="form-group"> 
                                            <label for="volume_produk" class="text-primary"><b>Kode Formula </b></label><br>
                                            <label><?= $mps->kode_formula_produk ?></label>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        &nbsp;
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="produk" class="text-primary"><b>Produk</b></label><br>
                                            <label><?= $mps->nama_produk_msglow.' ('.number_format($mps->volume_produk_msglow,2,',','.').' Kg)' ?></label>
                                        </div>
                                        <div class="form-group"> 
                                            <label for="jumlah_produksi" class="text-primary"><b>Jumlah Produksi</b> (Pcs)</label><br>
                                            <label><?= number_format($mps->jumlah_produksi,0,',','.') ?> pcs</label>
                                        </div>
                                    </div>
                                </div>
                                <hr>    
                                <div class="row">
                                    <div class="col-6">
                                        <label for="formula" class="text-primary"><b>Formula Produk</b></label><br>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="tableBarangFormula" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No.</th>
                                                        <th>Nama Bahan</th>
                                                        <th>Kode Bahan</th>
                                                        <th>Persentase (%)</th>
                                                        <th>Komposisi/Pcs</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="data_order">
                                                    <?php
                                                        $no = 1;
                                                        foreach ($bom as $value) {
                                                    ?>
                                                    <tr>
                                                        <td class="text-center"><?= $no++ ?>.</td>
                                                        <td><?= $value->nama_produk ?></td>
                                                        <td><?= $value->kode_produk ?></td>
                                                        <td><?= number_format($value->persentase,3,',','.') ?></td>
                                                        <td><?= number_format($value->komposisi_per_unit,3,',','.') ?> kg</td>
                                                    </tr>
                                                    <?php
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="perhitungan" class="text-primary"><b>Perhitungan MPS</b></label><br>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="tableBarangMps" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No.</th>
                                                        <!-- <th>Kode Bahan</th>
                                                        <th>Nama Bahan</th> -->
                                                        <th>Stok</th>
                                                        <th>Jumlah Kebutuhan</th>
                                                        <th>Jumlah Kekurangan</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="data_order">
                                                    <?php
                                                        $no = 1;
                                                        foreach ($detail as $value) {
                                                    ?>
                                                    <tr>
                                                        <td class="text-center"><?= $no++ ?>.</td>
                                                        <!-- <td><?= $value->nama_produk ?></td>
                                                        <td><?= $value->kode_produk ?></td> -->
                                                        <td><?= number_format($value->stok_booked,3,',','.') ?> Kg</td>
                                                        <td><?= number_format($value->jumlah_kebutuhan,3,',','.') ?> Kg</td>
                                                        <td><?= number_format($value->jumlah_kekurangan,3,',','.') ?> Kg</td>
                                                    </tr>
                                                    <?php
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row ml-0">
                                        <div class="col-6">
                                            <label for="catatan_kalkulator" class="text-primary"><b>Catatan</b></label><br>
                                            <label><?= $mps->keterangan_mps_kalkulator ?></label>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </form>


                </div>
                <!-- /.container-fluid -->

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

<script>
    $(document).ready(function() {
        $('#tableBarangMps').DataTable({
            stateSave: true
        });

        $('#tableBarangFormula').DataTable({
            stateSave: true
        });
    });
</script>

</body>
</html>