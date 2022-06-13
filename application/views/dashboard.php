<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Dashboard</title>

    <?php $this->load->view('partials/head', FALSE); ?>

    <style type="text/css">
        a:hover{
            text-decoration-line: none;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

       <?php
            if ($this->session->userdata('level') == 'direktur' || $this->session->userdata('level') == 'spv_purchasing') {
                $this->load->view('partials/sidebar_direktur', FALSE);
            }else{
                $this->load->view('partials/sidebar', FALSE);
            }
        ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php $this->load->view('partials/navbar', FALSE); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <label for="kategori" class="h4 mb-0 text-gray-800">Dashboard</label>
                            <select name="kategori" class="form-control mt-2" id="kategori">
                                <option value="Baku" <?php if($this->session->userdata('kategori') == 'Baku'){echo 'selected';} ?>>Bahan Baku</option>
                                <option value="Kemas" <?php if($this->session->userdata('kategori') == 'Kemas'){echo 'selected';} ?>>Kemas</option>
                                <option value="Teknik" <?php if($this->session->userdata('kategori') == 'Teknik'){echo 'selected';} ?>>Teknik</option>
                                <?php
                                    if ($this->session->userdata('level') == 'direktur') {
                                ?>
                                <option value="glow" <?php if($this->session->userdata('kategori') == 'glow'){echo 'selected';} ?>>MS Glow</option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div><br>

                    <!-- Content Row -->
                    <div class="row" <?= $status = ($this->session->userdata('kategori') == 'glow') ? 'hidden' : '' ?>>

                         <!-- Pending Requests Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                <a href="<?php echo base_url().'order/order_pilih/Belum' ?>" class="h6 font-weight-bold text-info text-uppercase mb-1">Belum Disetujui</a>
                                            </div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $acc = (isset($acc)) ? number_format($acc, 0, ',','.') : 0; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-spinner fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                <a href="<?php echo base_url().'order/order_pilih/Reminder' ?>" class="h6 font-weight-bold text-warning text-uppercase mb-1">Reminder</a>
                                            </div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $reminder = (isset($reminder)) ? number_format($reminder, 0, ',','.') : 0; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="far fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                <a href="<?php echo base_url().'order/order_pilih/Terlambat' ?>" class="h6 font-weight-bold text-danger text-uppercase mb-1">Terlambat</a>
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h3 mb-0 mr-3 font-weight-bold text-gray-800"><?= $terlambat = (isset($terlambat)) ? number_format($terlambat, 0, ',','.') : 0; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                <a href="<?php echo base_url().'order/datang/Belum' ?>" class="h6 font-weight-bold text-success text-uppercase mb-1">Belum Datang</a></div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $pending = (isset($pending)) ? number_format($pending, 0, ',','.') : 0; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-hourglass-half fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-secondary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                <a href="<?php echo base_url().'order/datang/Parsial' ?>" class="h6 font-weight-bold text-secondary text-uppercase mb-1">Parsial</a>
                                            </div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $parsial = (isset($parsial)) ? number_format($parsial, 0, ',','.') : 0; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-cubes fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <a href="<?php echo base_url().'order/datang/Sudah' ?>" class="h6 font-weight-bold text-primary text-uppercase mb-1">Sudah Datang</a>
                                            </div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $datang = (isset($datang)) ? number_format($datang, 0, ',','.') : 0; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-gift fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-secondary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <a href="<?php echo base_url().'order/index/'.$this->session->userdata('kategori'); ?>" class="h6 font-weight-bold text-secondary text-uppercase mb-1">Total PO</a>
                                            </div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $order = (isset($order)) ? number_format($order, 0, ',','.') : 0; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file-invoice fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <a href="<?php echo base_url().'mitra/index/'.$this->session->userdata('kategori'); ?>" class="h6 font-weight-bold text-primary text-uppercase mb-1">Supplier</a>
                                            </div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $supplier = (isset($supplier)) ? number_format($supplier, 0, ',','.') : 0; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-group fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                          <!-- Pending Requests Card Example -->
                          <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <a href="<?php echo base_url().'order/list_karantina/'.$this->session->userdata('kategori'); ?>" class="h6 font-weight-bold text-info text-uppercase mb-1">Bahan Karantina</a>
                                            </div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $karantina = (isset($karantina)) ? number_format($karantina, 0, ',','.') : 0; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-lock fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <a href="<?php echo base_url().'order/validasi_status/Reject'; ?>" class="h6 font-weight-bold text-danger text-uppercase mb-1">Validasi Reject</a>
                                            </div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $validasi_reject = (isset($validasi_reject)) ? number_format($validasi_reject, 0, ',','.') : 0; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-ban fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <a href="<?php echo base_url().'order/validasi_status/Release'; ?>" class="h6 font-weight-bold text-success text-uppercase mb-1">Validasi Release</a>
                                            </div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $validasi_release = (isset($validasi_release)) ? number_format($validasi_release, 0, ',','.') : 0; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-check fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <a href="<?php echo base_url().'order/validate/purchasing'; ?>" class="h6 font-weight-bold text-warning text-uppercase mb-1">Validasi Belum</a>
                                            </div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $validasi_belum = (isset($validasi_belum)) ? number_format($validasi_belum, 0, ',','.') : 0; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-spinner fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                      <!-- Content Row -->
                      <div class="row" <?= $status = ($this->session->userdata('kategori') != 'glow') ? 'hidden' : '' ?>>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                <a href="<?php echo base_url().'glow/filter/kgi' ?>" class="h6 font-weight-bold text-info text-uppercase mb-1">Approval KGI</a>
                                            </div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $acc_kgi = (isset($acc_kgi)) ? number_format($acc_kgi, 0, ',','.') : 0; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-hourglass-half fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <a href="<?php echo base_url().'glow/filter/kci' ?>" class="h6 font-weight-bold text-primary text-uppercase mb-1">Approval KCI</a>
                                            </div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $acc_kci = (isset($acc_kci)) ? number_format($acc_kci, 0, ',','.') : 0; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-hourglass-half fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                <a href="<?php echo base_url().'glow/filter/approved' ?>" class="h6 font-weight-bold text-success text-uppercase mb-1">Approved Request</a>
                                            </div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $approved = (isset($approved)) ? number_format($approved, 0, ',','.') : 0; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-check fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                <a href="<?php echo base_url().'glow/filter/canceled' ?>" class="h6 font-weight-bold text-danger text-uppercase mb-1">Canceled Request</a>
                                            </div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $canceled = (isset($canceled)) ? number_format($canceled, 0, ',','.') : 0; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-ban fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                <a href="<?php echo base_url().'glow/filter/sending' ?>" class="h6 font-weight-bold text-warning text-uppercase mb-1">Sending Sample</a>
                                            </div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $sending = (isset($sending)) ? number_format($sending, 0, ',','.') : 0; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-paper-plane fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <a href="<?php echo base_url().'glow/filter/received' ?>" class="h6 font-weight-bold text-primary text-uppercase mb-1">Received Sample</a>
                                            </div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $received = (isset($received)) ? number_format($received, 0, ',','.') : 0; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-gift fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-secondary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                                <a href="<?php echo base_url().'glow/filter/progress' ?>" class="h6 font-weight-bold text-secondary text-uppercase mb-1">Product on progress</a>
                                            </div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $progress = (isset($progress)) ? number_format($progress, 0, ',','.') : 0; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-clock fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                <a href="<?php echo base_url().'glow/filter/development' ?>" class="h6 font-weight-bold text-success text-uppercase mb-1">Development Product</a>
                                            </div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $development = (isset($development)) ? number_format($development, 0, ',','.') : 0; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-flask fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                <a href="<?php echo base_url().'glow/filter/perubahan' ?>" class="h6 font-weight-bold text-danger text-uppercase mb-1">Perubahan Spesifikasi</a>
                                            </div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $total = (isset($perubahan)) ? number_format($perubahan, 0, ',','.') : 0; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-cog fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        </div>

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

   <?php $this->load->view('partials/js', FALSE); ?>

    <!-- Page level plugins -->
    <script src="<?php echo base_url().'assets/vendor/chart.js/Chart.min.js'?>"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo base_url().'assets/js/demo/chart-area-demo.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/demo/chart-pie-demo.js'?>"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#kategori').change(function() {
                var request = $(this).val();
                $.ajax({
                    url: "<?php echo base_url('order/get_json_kategori'); ?>",
                    method: 'POST',
                    dataType: 'json',
                    data: {kategori: request},
                    async: true,
                    success: function(data){
                        console.log(data);
                    }
                }).then(function () {
                    location.reload();
                })
            });
        });
    </script>

</body>

</html>