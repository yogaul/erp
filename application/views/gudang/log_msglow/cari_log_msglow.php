<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Log MS Glow</title>

    <?php $this->load->view('partials/head', FALSE);?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
            if (($this->session->userdata('level') == 'gudang') || ($this->session->userdata('level') == 'admin_gudang_sier')) {
                $this->load->view('partials/sidebar_gudang', FALSE);
            }elseif ($this->session->userdata('level') == 'purchasing') {
                $this->load->view('partials/sidebar', FALSE);
            }elseif ($this->session->userdata('level') == 'spv_purchasing') {
                $this->load->view('partials/sidebar_direktur', FALSE);
            }elseif ($this->session->userdata('level') == 'ppic') {
                $this->load->view('partials/sidebar_ppic', FALSE);
            }elseif ($this->session->userdata('level') == 'rnd') {
                $this->load->view('partials/sidebar_rnd', FALSE);
            }elseif ($this->session->userdata('level') == 'marketing') {
                $this->load->view('partials/sidebar_marketing', FALSE);
            }elseif ($this->session->userdata('level') == 'tim_marketing') {
                $this->load->view('partials/sidebar_tim_marketing', FALSE);
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
                    <h1 class="h4 mb-2 text-gray-800">Log Produk : <b><u><?php echo $nama; ?></u></b></h1>
                    <h1 class="h6 text-gray-800">Tanggal <?php echo $start.' - '.$end; ?></h1>  

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                             <a href="<?php echo base_url().'glow/log_glow/'.$id_produk; ?>" class="btn btn-sm btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tableHistory" width="100%" cellspacing="0">
                                    <thead>
                                        <tr align="center">
                                            <th>Tanggal</th>
                                            <th>Nama Barang</th>
                                            <th>Deskripsi</th>
                                            <th>In</th>
                                            <th>Out</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($data_log as $key) {
                                    ?>
                                        <tr>
                                            <td align="center"><?php echo $tanggal = (is_null($key->tanggal_log_msglow)) ? '-' : date('d/m/Y',strtotime($key->tanggal_log_msglow)); ?></td>
                                            <td><?php echo $key->nama_produk_msglow; ?></td>
                                            <td><?php echo $key->deskripsi_log_msglow; ?></td>
                                            <td><?php echo number_format($key->in_log_msglow,0,',','.'); ?></td>
                                            <td><?php echo number_format($key->out_log_msglow,0,',','.'); ?></td>
                                            <td><?php echo number_format($key->balance_log_msglow,0,',','.'); ?></td>
                                        </tr>
                                    <?php
                                    } 
                                    ?>
                                    </tbody>
                                </table>
                            </div><br>
                            <table class="table table-bordered">
                                <tr align="center">
                                    <th colspan="2">Total</th>
                                </tr>
                                <tr align="center">
                                    <th>In</th>
                                    <td><?= number_format($in_log,0,',','.') ?> Pcs</td>
                                </tr>
                                <tr align="center">
                                    <th>Out</th>
                                    <td><?= number_format($out_log,0,',','.') ?> Pcs</td>
                                </tr>
                            </table>
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
       
        $('#tableHistory').DataTable( {
            stateSave: true,    
            order: [[ 0, "desc" ]],
            columnDefs : [{"targets":0, "type":"date-eu"}]
        });

    });
</script>

</body>
</html>