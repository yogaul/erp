<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Supplier</title>

    <?php $this->load->view('partials/head', FALSE);?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
            if ($this->session->userdata('level') == 'direktur') {
                $this->load->view('partials/sidebar_direktur', FALSE);
            }else{
                $this->load->view('partials/sidebar', FALSE);
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
                    <h1 class="h4 mb-2 text-gray-800">Detail Informasi Supplier Anda !</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <?php foreach ($detail_mitra as $key) {
                        ?>
                        <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-primary"><?php echo $key->nama_mitra ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-no-border" width="100%" cellspacing="0">
                                    <tr>
                                        <td><b>No. Supplier</b></td>
                                        <td><?php echo $key->no_mitra; ?></td>
                                        <td><b>Telpon Seluler</b></td>
                                        <td><?php echo $key->seluler_mitra; ?></td>
                                        <td><b>Kode Pos</b></td>
                                        <td><?php echo $key->pos_mitra; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Email</b></td>
                                        <td><?php echo $key->email_mitra; ?></td>
                                        <td><b>Kota/Kabupaten</b></td>
                                        <td><?php echo $key->kota_mitra; ?></td>
                                        <td><b>Negara</b></td>
                                        <td><?php echo $key->negara_mitra; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Telp</b></td>
                                        <td><?php echo $key->telp_mitra; ?></td>
                                        <td><b>Provinsi</b></td>
                                        <td><?php echo $key->provinsi_mitra; ?></td>
                                        <td><b>No.Akun Virtual</b></td>
                                        <td><?php echo $key->virtual_mitra; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Alamat Baris 1</b></td>
                                        <td><?php echo $key->alamat_baris_1; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Alamat Baris 2</b></td>
                                        <td><?php echo $key->alamat_baris_2; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Website</b></td>
                                        <td><?php echo $key->web_mitra; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Catatan</b></td>
                                        <td><?php echo $key->catatan_mitra; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <?php
                        } ?>
                    </div>

                    <!-- <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-primary">Total Hutang : <b>Rp 0,00</b></h5>
                        </div>
                        <div class="card-body">
                        <p class="text-secondary">Jumlah Total Invoice - Pembayaran Masuk(Invoice Penjualan & Invoice Uang Muka) + Pembayaran Keluar(Invoice Pembelian)</p>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary">Invoice</h5>
                        </div>
                        <div class="card-body">
                        <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Invoice No.</th>
                                            <th>Status Invoice</th>
                                            <th>Jumlah</th>
                                            <th>Jumlah Terhutang</th>
                                            <th>Tgl.Invoice</th>
                                            <th>Tgl.Jatuh Tempo</th>
                                            <th>Terkirim</th>
                                            <th>Info</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                        </div>
                    </div>
 -->
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
    function deleteConfirm(url){
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }
</script>

</body>
</html>