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
            if ($this->session->userdata('level') == 'ppic') {
                $this->load->view('partials/sidebar_ppic', FALSE);
            }else if ($this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier') {
                $this->load->view('partials/sidebar_gudang', FALSE);
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
                                <!-- <option value="Teknik" <?php if($this->session->userdata('kategori') == 'Teknik'){echo 'selected';} ?>>Teknik</option> -->
                            </select>
                        </div>
                    </div><br>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                <a href="<?php echo base_url().'order/datang/Belum' ?>" class="h6 font-weight-bold text-warning text-uppercase mb-1">Belum Datang</a></div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?php echo number_format($pending,0,',','.'); ?></div>
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
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?php echo number_format($parsial,0,',','.'); ?></div>
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
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <a href="<?php echo base_url().'order/datang/Sudah' ?>" class="h6 font-weight-bold text-success text-uppercase mb-1">Sudah Datang</a>
                                            </div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?php echo number_format($datang,0,',','.'); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-gift fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                         <!-- Earnings (Monthly) Card Example -->
                         <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                <a href="<?php echo base_url().'sjp/spp'; ?>" class="h6 font-weight-bold text-info text-uppercase mb-1"> SPP Marketing</a></div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?php echo number_format($spp,0,',','.'); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-file fa-2x text-gray-300"></i>
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
                                                <a href="<?php echo base_url().'order/validate/qc'; ?>" class="h6 font-weight-bold text-primary text-uppercase mb-1">Validasi Qc</a>
                                            </div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?php echo number_format($validasi_qc,0,',','.'); ?></div>
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
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <a href="<?php echo base_url().'order/validasi_status/Reject'; ?>" class="h6 font-weight-bold text-danger text-uppercase mb-1">Validasi Reject</a>
                                            </div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?php echo number_format($validasi_reject,0,',','.'); ?></div>
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
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?php echo number_format($validasi_release,0,',','.'); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-check fa-2x text-gray-300"></i>
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
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                <a href="<?php echo base_url().'order/list_karantina/'.$this->session->userdata('kategori'); ?>" class="h6 font-weight-bold text-danger text-uppercase mb-1"> Bahan Karantina</a></div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?php echo number_format($validasi_karantina,0,',','.'); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-lock fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php 
                            if ($this->session->userdata('kategori') == 'Baku') {
                        ?>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                <a href="<?php echo base_url().'produk/exp'; ?>" class="h6 font-weight-bold text-warning text-uppercase mb-1"> Bahan Expired Date</a></div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?php echo number_format($exp,0,',','.'); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            }else{
                        ?>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                <a href="<?php echo base_url().'produk/index/Limit'; ?>" class="h6 font-weight-bold text-warning text-uppercase mb-1"> Stok Hampir Habis</a></div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?php echo number_format($limit_stok,0,',','.'); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-exclamation-triangle fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h1 class="h4 mb-2 text-gray-800">Grafik Mutasi Barang</h1>
                                 <div class="card shadow mb-4">
                                <!-- DataTales Example -->
                                <div class="card">
                                    <div class="card-header py-3">
                                        <ul class="nav nav-tabs" id="myTabResponse" role="tablist">
                                          <li class="nav-item">
                                            <a class="nav-link active" id="tab1Response" data-toggle="tab" href="#dailyPanelResponse" role="tab">Daily</a>
                                          <li>
                                          <li class="nav-item">
                                            <a class="nav-link" id="tab2Response" data-toggle="tab" href="#weeklyPanelResponse" role="tab">Weekly</a>
                                          <li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="tab3Response" data-toggle="tab" href="#monthlyPanelResponse" role="tab">Monthly</a>
                                            <li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                    <div class="tab-content mt-1">
                                    <div class="tab-pane fade show active" id="dailyPanelResponse" role="tabpanel">
                                        <div class="row">
                                            <div class="col-2">
                                                <label class="text-primary font-weight-bold">Start</label>
                                                <input type="date" class="form-control form-control-sm start-daily-date-response" value="<?php echo $start_date; ?>">
                                            </div>
                                            <div class="col-2">
                                                <label class="text-primary font-weight-bold">End</label>
                                                <input type="date" class="form-control form-control-sm end-daily-date-response" value="<?php echo $last_date; ?>">
                                            </div>
                                            <div class="col-5 d-flex">
                                                <button class="btn btn-sm btn-primary mt-auto btn-search-daily-response"><i class="fas fa-search"></i> Cari</button>
                                                <button class="btn btn-sm btn-primary mt-auto ml-1 btn-refresh-daily-response"><i class="fas fa-refresh"></i> Refresh</button>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-12">
                                                <canvas id="chartDailyResponse" width="400" height="120"></canvas>   
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="weeklyPanelResponse" role="tabpanel"> 
                                        <div class="row">
                                            <div class="col-2">
                                                <label class="text-primary font-weight-bold">Bulan</label>
                                                <select name="pilih_bulan" class="form-control form-control-sm pilih-bulan-weekly-response">
                                                    <option value="01" <?php if(date('m') == '01'){echo 'selected';} ?>>Januari</option>
                                                    <option value="02" <?php if(date('m') == '02'){echo 'selected';} ?>>Februari</option>
                                                    <option value="03" <?php if(date('m') == '03'){echo 'selected';} ?>>Maret</option>
                                                    <option value="04" <?php if(date('m') == '04'){echo 'selected';} ?>>April</option>
                                                    <option value="05" <?php if(date('m') == '05'){echo 'selected';} ?>>Mei</option>
                                                    <option value="06" <?php if(date('m') == '06'){echo 'selected';} ?>>Juni</option>
                                                    <option value="07" <?php if(date('m') == '07'){echo 'selected';} ?>>Juli</option>
                                                    <option value="08" <?php if(date('m') == '08'){echo 'selected';} ?>>Agustus</option>
                                                    <option value="09" <?php if(date('m') == '09'){echo 'selected';} ?>>September</option>
                                                    <option value="10" <?php if(date('m') == '10'){echo 'selected';} ?>>Oktober</option>
                                                    <option value="11" <?php if(date('m') == '11'){echo 'selected';} ?>>November</option>
                                                    <option value="12" <?php if(date('m') == '12'){echo 'selected';} ?>>Desember</option>
                                                </select>
                                            </div>
                                            <div class="col-2">
                                                <label class="text-primary font-weight-bold">Tahun</label>
                                                <select name="pilih_tahun" class="form-control form-control-sm pilih-tahun-weekly-response">
                                                    <option value="2021" <?php if(date('Y') == '2021'){echo 'selected';} ?>>2021</option>
                                                    <option value="2022" <?php if(date('Y') == '2022'){echo 'selected';} ?>>2022</option>
                                                </select>
                                            </div>
                                            <div class="col-5 d-flex">
                                                <button class="btn btn-sm btn-primary mt-auto btn-search-weekly-response"><i class="fas fa-search"></i> Cari</button>
                                                <button class="btn btn-sm btn-primary mt-auto ml-1 btn-refresh-weekly-response"><i class="fas fa-refresh"></i> Refresh</button>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-12">
                                                <canvas id="chartWeeklyResponse" width="400" height="120"></canvas>   
                                            </div>
                                        </div>
                                    </div>
                                     <div class="tab-pane fade" id="monthlyPanelResponse" role="tabpanel"> 
                                        <div class="row">
                                            <div class="col-2">
                                                <label class="text-primary font-weight-bold">Tahun</label>
                                                <select name="pilih_tahun" class="form-control form-control-sm pilih-tahun-monthly-response">
                                                    <option value="2021" <?php if(date('Y') == '2021'){echo 'selected';} ?>>2021</option>
                                                    <option value="2022" <?php if(date('Y') == '2022'){echo 'selected';} ?>>2022</option>
                                                </select>
                                            </div>
                                            <div class="col-5 d-flex">
                                                <button class="btn btn-sm btn-primary mt-auto btn-search-monthly-response"><i class="fas fa-search"></i> Cari</button>
                                                <button class="btn btn-sm btn-primary mt-auto ml-1 btn-refresh-monthly-response"><i class="fas fa-refresh"></i> Refresh</button>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-12">
                                                <canvas id="chartMonthlyResponse" width="400" height="120"></canvas>   
                                            </div>
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

    <!-- chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.esm.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.esm.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/helpers.esm.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/helpers.esm.min.js"></script>

    <script type="text/javascript">
        var ctx_daily = document.getElementById('chartDailyResponse').getContext('2d');
        var ctx_weekly = document.getElementById('chartWeeklyResponse').getContext('2d');
        var ctx_monthly = document.getElementById('chartMonthlyResponse').getContext('2d');

        var chart_awal_daily = "";
        var chart_awal_weekly = "";
        var chart_awal_monthly = "";

        function set_chart_daily(data){
            var label = [];
            var value = [];

            for(var i in data){
                label.push(data[i].tanggal);
                value.push(data[i].value);
            }
            chart_awal_daily = new Chart(ctx_daily, {
                type: 'line',
                data: {
                    labels: label,
                    datasets: [{
                        label: 'Total',
                        data: value,
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

        function set_chart_weekly(data){
            chart_awal_weekly = new Chart(ctx_weekly, {
                type: 'line',
                data: {
                    labels: ['Minggu Ke-1', 'Minggu Ke-2', 'Minggu Ke-3', 'Minggu Ke-4'],
                    datasets: [{
                        label: 'Total',
                        data: [data[0], data[1], data[2], data[3]],
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

         function set_chart_monthly(data){
            chart_awal_monthly = new Chart(ctx_monthly, {
                type: 'line',
                data: {
                    labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                    datasets: [{
                        label: 'Total',
                        data: [data[0], data[1], data[2], data[3], data[4], data[5], data[6], data[7], data[8], data[9], data[10], data[11]],
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

        function load_chart_daily(){
            $.ajax({
                url: "<?php echo base_url().'mutasi/json_daily_chart'; ?>",
                type: 'GET',
                dataType: 'json',
                data: {param1: 'value1'},
                success: function(data){
                    set_chart_daily(data);
                }
            });
        }

        function load_chart_weekly(){
            $.ajax({
                url: "<?php echo base_url().'mutasi/json_weekly_chart'; ?>",
                type: 'GET',
                dataType: 'json',
                data: {param1: 'value1'},
                success: function(data){
                    var weekly = [data.week_1, data.week_2, data.week_3, data.week_4];
                    set_chart_weekly(weekly);
                }
            });
        }

        function load_chart_monthly(){
            $.ajax({
                url: "<?php echo base_url().'mutasi/json_monthly_chart'; ?>",
                type: 'GET',
                dataType: 'json',
                data: {param1: 'value1'},
                success: function(data){
                    var mdata = [
                        data.month_1,
                        data.month_2,
                        data.month_3,
                        data.month_4,
                        data.month_5,
                        data.month_6,
                        data.month_7,
                        data.month_8,
                        data.month_9,
                        data.month_10,
                        data.month_11,
                        data.month_12
                    ];
                    set_chart_monthly(mdata);
                }
            });
        }

        function reset_chart_daily(){
            $('.start-daily-date').val('');
            $('.end-daily-date').val('');
            chart_awal_daily.destroy();
            load_chart_daily();
        }

        function reset_chart_weekly(){
            $('.pilih-bulan-weekly').val('01');
            chart_awal_weekly.destroy();
            load_chart_weekly();
        }

        function reset_chart_monthly(){
            $('.pilih-bulan-monthly').val('2021');
            chart_awal_monthly.destroy();
            load_chart_monthly();
        }

        $(document).ready(function() {
            
            load_chart_daily();
            load_chart_weekly();
            load_chart_monthly();

            $('#myTabResponse a').click(function(e) {
              e.preventDefault();
              $(this).tab('show');
            });

            $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
              var id = $(e.target).attr("href").substr(1);
              window.location.hash = id;
            });

            var hash = window.location.hash;
            $('#myTabResponse a[href="' + hash + '"]').tab('show');

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

            $('.btn-search-daily-response').click(function(event) {
                /* Act on the event */
                let date_start = $('.start-daily-date-response').val();
                let date_end = $('.end-daily-date-response').val();
                var data_new = '';

                $.ajax({
                    url: "<?php echo base_url().'mutasi/json_daily_range'; ?>",
                    type: 'POST',
                    dataType: 'json',
                    data: {start: date_start, end: date_end},
                    success: function(data){
                        if (data.length > 30) {
                            alert('Maksimal range satu bulan !');
                            $('.start-daily-date-response').val('');
                            $('.end-daily-date-response').val('');
                            reset_chart_daily_response();
                        }else{
                            chart_awal_daily_response.destroy();
                            set_chart_daily_response(data);
                            // console.log(data);
                        }
                    }
                });
            });

            $('.btn-search-weekly-response').click(function(event) {
                /* Act on the event */
                let bulan = $('.pilih-bulan-weekly-response').val();
                let tahun = $('.pilih-tahun-weekly-response').val();
                var data_new = '';

                $.ajax({
                    url: "<?php echo base_url().'mutasi/json_weekly_range'; ?>",
                    type: 'POST',
                    dataType: 'json',
                    data: {bulan: bulan, tahun: tahun},
                    success: function(data){
                        if ((data.week_1 == 0) && (data.week_2 == 0) && (data.week_3 == 0) && (data.week_4 == 0)) {
                            alert('Tidak ada data untuk ditampilkan');
                        }else{
                            data_new = [data.week_1, data.week_2, data.week_3, data.week_4];
                            chart_awal_weekly_response.destroy();
                            set_chart_weekly_response(data_new);
                        }
                    }
                });
            });

            $('.btn-search-monthly-response').click(function(event) {
                /* Act on the event */
                let tahun = $('.pilih-tahun-monthly-response').val();
                var data_new = '';

                $.ajax({
                    url: "<?php echo base_url().'mutasi/json_monthly_range'; ?>",
                    type: 'POST',
                    dataType: 'json',
                    data: {tahun: tahun},
                    success: function(data){
                        // console.log(data);
                        var mdata = [
                            data.month_1,
                            data.month_2,
                            data.month_3,
                            data.month_4,
                            data.month_5,
                            data.month_6,
                            data.month_7,
                            data.month_8,
                            data.month_9,
                            data.month_10,
                            data.month_11,
                            data.month_12
                        ];
                        chart_awal_monthly_response.destroy();
                        set_chart_monthly_response(mdata);
                    }
                });
            });

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