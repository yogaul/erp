<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - SPP</title>

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
            if ($this->session->userdata('level') == 'marketing') {
                $this->load->view('partials/sidebar_marketing', FALSE);
            }elseif ($this->session->userdata('level') == 'tim_marketing') {
                $this->load->view('partials/sidebar_tim_marketing', FALSE);
            }elseif ($this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier') {
                $this->load->view('partials/sidebar_gudang', FALSE);
            }elseif ($this->session->userdata('level') == 'ppic'){
                $this->load->view('partials/sidebar_ppic', FALSE);
            }elseif ($this->session->userdata('level') == 'direktur') {
                $this->load->view('partials/sidebar_direktur', FALSE);
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
                    <h1 class="h4 mb-2 text-gray-800">Detail Surat Perintah Pengiriman (SPP)</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                        <img src="<?php echo base_url().'assets/img/logo.jpg'; ?>" alt="logo" width="200px">
                                    </div>
                                    <div class="col-3">
                                        <label for="no_spp" class="text-primary"><b>Nomor SPP</b></label>
                                        <p><?php echo $data_spp->nomor_spp; ?></p>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="brand_so" class="text-primary"><b>Customer</b></label>
                                        <p><?php echo $data_spp->nama_customer." - ".$data_spp->nama_perusahaan_customer; ?></p>
                                    </div>
                                    <div class="col-3"></div>
                                    <div class="col-3"></div>
                                    <div class="col-3">
                                        <label for="brand_so" class="text-primary"><b>Brand (Merk)</b></label>
                                        <p><?php echo $data_spp->nama_brand_produk; ?></p>
                                    </div>
                                </div><hr>    
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table-produk" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama Produk</th>
                                                <th>Volume</th>
                                                <th>Quantity</th>
                                                <th>Tanggal Pengiriman</th>
                                            </tr>
                                        </thead>
                                        <tbody id="data_produk">
                                            <?php
                                            $no = 1;
                                            foreach ($detail_spp as  $value) {
                                            ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $value->nama_produk_acc; ?></td>
                                                <td><?php echo $value->volume_produk_acc; ?></td>
                                                <td><?php echo number_format($value->quantity_spp,0,'.','.'); ?></td>
                                                <td><?php echo date('d/m/Y', strtotime($value->tanggal_kirim_spp)); ?></td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div><hr>
                                <div class="row">
                                    <div class="col-9">
                                        <label for="no_telp_spp" class="text-primary"><b>No. Telp</b></label>
                                        <p><?php echo $data_spp->no_telp_spp; ?></p>
                                    </div>
                                    <div class="col-3">
                                        <label for="alamat_kirim_spp" class="text-primary"><b>Alamat Pengiriman</b></label>
                                        <p><?php echo $data_spp->alamat_pengiriman_spp; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="catatan_so" class="text-primary"><b>Catatan SPP</b></label>
                                        <p><?php echo $catatan = (empty($data_spp->catatan_spp)) ? "-" : $data_spp->catatan_spp; ?></p>
                                    </div>
                                </div><br>
                                <a href="<?php echo base_url().'spp/cetak/'.$id; ?>" class="btn btn-sm btn-primary float-right"><i class="fas fa-file-pdf"></i> Cetak PDF</a>
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
<script type="text/javascript">
    $("#table-produk").DataTable({
        stateSave : true
    });
</script>
</html>