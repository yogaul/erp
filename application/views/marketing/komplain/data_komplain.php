<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Komplain</title>

    <?php $this->load->view('partials/head', FALSE);?>

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
                    <h1 class="h4 mb-2 text-gray-800">Daftar Customer Response !</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <?php 
                            if (!empty($komplain)) {
                        ?>
                        <div class="card-header py-3">
                            <a href="<?php echo base_url().'export/komplain'; ?>" class="btn btn-sm btn-success"><i class="fas fa-file-export"></i> Export Excel</a>
                        </div>
                        <?php
                            }
                        ?>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tableKomplain" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nama Konsumen</th>
                                            <th>Usia</th>
                                            <th>Produk</th>
                                            <th>Keterangan</th>
                                            <th>Nomor Batch</th>
                                            <th>Tgl. Expired</th>
                                            <th>Jumlah Produk</th>
                                            <th>Frekuensi Pemakaian</th>
                                            <th>Lama Pemakaian</th>
                                            <th>Tgl. Pembelian</th>
                                            <th>Foto/Video</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($komplain as $key) {
                                    ?>
                                        <tr>
                                            <td><?php echo date('d/m/Y H:i:s',strtotime($key->tanggal_komplain)); ?></td>
                                            <td><?php echo $key->nama_konsumen; ?></td>
                                            <td><?php echo $key->usia_konsumen; ?></td>
                                            <td><?php echo $key->produk_komplain; ?></td>
                                            <td><?php echo $key->keterangan_komplain; ?></td>
                                            <td><?php echo $key->batch_number_produk; ?></td>
                                            <td><?php echo date('d/m/Y',strtotime($key->tanggal_expired_produk)); ?></td>
                                            <td><?php echo $key->jumlah_produk_komplain; ?></td>
                                            <td><?php echo $key->frekuensi_pemakaian; ?></td>
                                            <td><?php echo $key->lama_pemakaian; ?></td>
                                            <td><?php echo date('d/m/Y',strtotime($key->tanggal_pembelian_produk)); ?></td>
                                            <td>
                                                <a href="<?php echo $key->foto_video_produk; ?>" target="_blank">
                                                <?php
                                                    $file_parts = pathinfo($key->foto_video_produk);
                                                    $file = $file_parts['basename'];
                                                    echo $file;
                                                ?>
                                                </a>
                                            </td>
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
    $(document).ready(function() {
        $('#tableKomplain').DataTable({
            stateSave: true
        })
    });
</script>

</body>
</html>