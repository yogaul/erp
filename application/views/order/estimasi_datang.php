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

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-10">
                                    <form method="POST" action="<?php echo base_url().'estimasi/cari'; ?>">
                                    <div class="row">
                                        <div class="col-2">
                                            <input type="hidden" name="kategori" value="<?php echo $kategori; ?>">
                                            <input type="date" name="start_date" id="start_lead" class="form-control form-control-sm" placeholder="start date">
                                        </div>
                                        <div class="col-2">
                                            <input type="date" name="end_date" id="end_lead" class="form-control form-control-sm" placeholder="end date">
                                        </div>
                                        <div class="col-2">
                                            <button type="submit" class="btn btn-sm btn-primary btn-cari"><i class="fas fa-search"></i> Cari</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <div class="col-2">
                                    <a href="<?= base_url().'export/estimasi/'.$kategori ?>" class="btn btn-sm btn-success float-right"><i class="fas fa-file-export"></i> Export Excel</a>
                                </div>
                            </div>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tableProduk" width="100%" cellspacing="0">
                                    <thead>
                                        <tr align="center">
                                            <th>No.</th>
                                            <th>Nomor PO</th>
                                            <th>Supplier</th>
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
                                            <td><?php echo $value->nama_mitra; ?></td>
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