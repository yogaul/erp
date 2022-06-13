<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Estimasi</title>

    <?php $this->load->view('partials/head', FALSE);?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
            if ($this->session->userdata('level') == 'direktur') {
                $this->load->view('partials/sidebar_direktur', FALSE);
            }elseif ($this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier') {
                $this->load->view('partials/sidebar_gudang', FALSE);
            }elseif ($this->session->userdata('level') == 'qc') {
                $this->load->view('partials/sidebar_qc', FALSE);
            }elseif($this->session->userdata('level') == 'purchasing'){
                $this->load->view('partials/sidebar', FALSE);
            }elseif ($this->session->userdata('level') == 'ppic') {
                $this->load->view('partials/sidebar_ppic', FALSE);
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
                    <h1 class="h4 mb-2 text-gray-800">Estimasi Kedatangan Bahan <?php echo $kategori; ?></h1>
                    <h1 class="h6 text-gray-800">Tanggal <?php echo $start.' - '.$end; ?></h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <form action="<?= base_url().'export/estimasi_range' ?>" method="post">
                                <a href="<?php echo base_url().'estimasi/index/'.lcfirst($kategori); ?>" class="btn btn-sm btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
                                <input type="hidden" name="start" id="start-search" value="<?= $mulai ?>">
                                <input type="hidden" name="end" id="end-search" value="<?= $akhir ?>">
                                <input type="hidden" name="kategori" id="kategori-search" value="<?= $kategori ?>">
                                <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-file-export"></i> Export Excel</button>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tableProduk" width="100%" cellspacing="0">
                                    <thead>
                                        <tr align="center">
                                            <th>No.</th>
                                            <th>Nomor PO</th>
                                            <th>Nama Barang</th>
                                            <th>Estimasi Datang</th>
                                            <th>Jumlah Kedatangan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data_estimasi">
                                        <?php 
                                            $no = 1;
                                            foreach ($data as $value) {
                                        ?>
                                        <tr>
                                            <td align="center"><?php echo $no++; ?>.</td>
                                            <td><?php echo $value->no_po; ?></td>
                                            <td><?php echo $value->nama_produk; ?></td>
                                            <td><?php echo date('d/m/Y', strtotime($value->tgl_lead_time)); ?></td>
                                            <td><?php echo number_format($value->jumlah_kedatangan,3,',','.') ?></td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

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

    $(document).ready(function() {
        $('#tableProduk').DataTable( {
            stateSave: true
        });
    });

</script>

</body>
</html>