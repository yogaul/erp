<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - BOM</title>

    <?php $this->load->view('partials/head', FALSE); ?>
    
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php 
            if ($this->session->userdata('level') == 'direktur') {
                $this->load->view('partials/sidebar_direktur', FALSE);
            }elseif ($this->session->userdata('level') == 'rnd') {
                $this->load->view('partials/sidebar_rnd', FALSE);
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
                    <h1 class="h4 mb-2 text-gray-800">Detail BOM Produk</h1>

                    <!-- DataTales Example -->
                    <form action="<?php echo base_url().'kalkulator/simpan' ?>" method="post" id="form-kalkulator">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="tgl_kalkulator" class="text-primary"><b>Tanggal</b></label><br>
                                            <label><?= date('d/m/Y', strtotime($bom->tanggal_formula_msglow)) ?></label>
                                        </div>
                                        <div class="form-group">
                                            <label for="produk" class="text-primary"><b>Nama Produk</b></label><br>
                                            <label><?= $mrequest->usulan_nama_produk ?></label>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        &nbsp;
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group"> 
                                            <label for="volume_produk" class="text-primary"><b>Kode Formula</b></label><br>
                                            <label><?= $bom->kode_formula_msglow ?></label>
                                        </div>
                                        <div class="form-group"> 
                                            <label for="jumlah_produksi" class="text-primary"><b>Volume</b> (Kg/pcs)</label><br>
                                            <label><?= number_format($mrequest->spesifikasi_volume/1000,2,',','.') ?> Kg</label>
                                        </div>
                                    </div>
                                </div>
                                <hr>    
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tableBarangMps" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th>Kode Bahan</th>
                                                <th>Nama Bahan</th>
                                                <th>Persentase (%)</th>
                                                <th>Komposisi/Pcs</th>
                                            </tr>
                                        </thead>
                                        <tbody id="data_order">
                                            <?php
                                                $no = 1;
                                                foreach ($detail as $value) {
                                            ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?>.</td>
                                                <td><?= $value->kode_produk ?></td>
                                                <td><?= $value->nama_produk ?></td>
                                                <td><?= number_format($value->persentase,3,',','.') ?></td>
                                                <td><?= number_format($value->komposisi_per_unit,3,',','.') ?> Kg</td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div><hr>
                                <div class="row ml-0">
                                        <div class="col-6">
                                            <label for="catatan_kalkulator" class="text-primary"><b>Catatan</b></label><br>
                                            <label><?= $bom->deskripsi_formula_msglow ?></label>
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
    });
</script>

</body>
</html>