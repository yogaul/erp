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

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <?php 
                            if (empty($data_log)) {
                                echo "";
                            }else{
                        ?>
                        <div class="card-header py-3">
                             <a onclick="coming()" class="btn btn-sm btn-success"><i class="fas fa-file-export"></i> Export Excel</a>
                        </div>
                        <?php
                            }
                         ?>
                        <div class="card-body">
                            <form method="POST" action="<?php echo base_url().'mlog/cari_msglow'; ?>" id="form-search-log">
                            <div class="row">
                                <div class="col-2">
                                    <input type="date" name="start_date" id="start_date" class="form-control form-control-sm" placeholder="start date">
                                    <input type="hidden" name="id_produk" value="<?= $id ?>">
                                </div>
                                <div class="col-2">
                                    <input type="date" name="end_date" id="end_date" class="form-control form-control-sm" placeholder="end date">
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-sm btn-primary btn-search-log"><i class="fas fa-search"></i> Cari</button>
                                </div>
                            </div>
                            </form>
                            <br>
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
       
        $('#tableHistory').DataTable( {
            stateSave: true,    
            order: [[ 0, "desc" ]],
            columnDefs : [{"targets":0, "type":"date-eu"}]
        });

        $('.btn-search-log').click(function (e) { 
            // e.preventDefault();
            let start = $('#start_date').val();
            let end = $('#end_date').val();

            if (start == '') {
                alert('Anda harus memilih tanggal awal !');
            }else if(end == ''){
                alert('Anda harus memilih tanggal akhir !');
            }else{
                $('#form-search-log').submit();
            }
            
        });

    });
</script>

</body>
</html>