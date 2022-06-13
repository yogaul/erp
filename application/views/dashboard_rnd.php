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
            $this->load->view('partials/sidebar_rnd', FALSE);
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

                    <div class="row mb-3">
                        <div class="col-6">
                            <p class="h4 mb-0 text-gray-800">Dashboard</p>
                        </div>
                    </div>

                    <div class="row">

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                <a href="<?php echo base_url().'glow/filter/kgi' ?>" class="h6 font-weight-bold text-info text-uppercase mb-1">Approval KGI</a>
                                            </div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?php echo number_format($acc_kgi,0,',','.'); ?></div>
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
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?php echo number_format($acc_kci,0,',','.'); ?></div>
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
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?php echo number_format($approved,0,',','.'); ?></div>
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
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?php echo number_format($canceled,0,',','.'); ?></div>
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
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?php echo number_format($sending,0,',','.'); ?></div>
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
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?php echo number_format($received,0,',','.'); ?></div>
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
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?php echo number_format($progress,0,',','.'); ?></div>
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
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?php echo number_format($development,0,',','.'); ?></div>
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
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?php echo number_format($perubahan,0,',','.'); ?></div>
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