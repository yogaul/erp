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

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

       <?php
            $this->load->view('partials/sidebar_qc', FALSE);
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

                    <!-- dashboard header -->
                    <h1 class="h4 mb-2 text-gray-800">Grafik Expired Date</h1>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-12 col-md-6">
                            <div class="card shadow py-2">
                                <div class="card-body">
                                    <canvas id="chartMonthly" width="400" height="120"></canvas>   
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

     <!-- chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.esm.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.esm.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/helpers.esm.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/helpers.esm.min.js"></script>

    <!-- google chart -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
       
        var ctx_monthly = document.getElementById('chartMonthly').getContext('2d');
        var chart_awal_monthly = "";


         function set_chart_monthly(mlabel, mdata){
            chart_awal_monthly = new Chart(ctx_monthly, {
                type: 'bar',
                data: {
                    labels: mlabel,
                    datasets: [{
                        label: 'Total (Kg)',
                        data: mdata,
                        backgroundColor: [
                            'rgba(78, 115, 223, 0.2)'
                        ],
                        borderColor: [
                            'rgba(78, 115, 223, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        function load_chart_monthly(){
            var mlabel = [];
            var mdata = [];

            $.ajax({
                url: "<?php echo base_url().'produk/json_expired_monthly'; ?>",
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    if (data.length != 0) {
                        $.each(data, function (indexInArray, valueOfElement) { 
                            mlabel.push(valueOfElement.kode_produk+' - '+valueOfElement.nama_produk);
                            mdata.push(valueOfElement.sisa_stok_kedatangan);  
                        });
                    }else{
                        mlabel = [];
                        mdata = [];
                    }
                    set_chart_monthly(mlabel, mdata);
                }
            });
        }

        $(document).ready(function() {
          
            load_chart_monthly();

        });
    </script>

</body>

</html>