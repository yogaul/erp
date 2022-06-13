<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Grafik</title>

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
                    <h1 class="h4 mb-2 text-gray-800">Grafik Sample Acc</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                            <!-- DataTales Example -->
                            <div class="card">
                                <div class="card-header py-3">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                      <li class="nav-item">
                                        <a class="nav-link active" id="tab1" data-toggle="tab" href="#dailyPanel" role="tab">Daily</a>
                                      <li>
                                      <li class="nav-item">
                                        <a class="nav-link" id="tab2" data-toggle="tab" href="#weeklyPanel" role="tab">Weekly</a>
                                      <li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="tab3" data-toggle="tab" href="#monthlyPanel" role="tab">Monthly</a>
                                        <li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                <div class="tab-content mt-1">
                                <div class="tab-pane fade show active" id="dailyPanel" role="tabpanel">
                                    <div class="row">
                                        <div class="col-2">
                                            <label class="text-primary font-weight-bold">Start</label>
                                            <input type="date" class="form-control form-control-sm start-daily-date">
                                        </div>
                                        <div class="col-2">
                                            <label class="text-primary font-weight-bold">End</label>
                                            <input type="date" class="form-control form-control-sm end-daily-date">
                                        </div>
                                        <div class="col-5 d-flex">
                                            <button class="btn btn-sm btn-primary mt-auto btn-search-daily"><i class="fas fa-search"></i> Cari</button>
                                            <button class="btn btn-sm btn-primary mt-auto ml-1 btn-refresh-daily"><i class="fas fa-refresh"></i> Refresh</button>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-12">
                                            <canvas id="chartDaily" width="400" height="120"></canvas>   
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="weeklyPanel" role="tabpanel"> 
                                    <div class="row">
                                        <div class="col-2">
                                            <label class="text-primary font-weight-bold">Bulan</label>
                                            <select name="pilih_bulan" class="form-control form-control-sm pilih-bulan-weekly">
                                                <option value="01">Januari</option>
                                                <option value="02">Februari</option>
                                                <option value="03">Maret</option>
                                                <option value="04">April</option>
                                                <option value="05">Mei</option>
                                                <option value="06">Juni</option>
                                                <option value="07">Juli</option>
                                                <option value="08">Agustus</option>
                                                <option value="09">September</option>
                                                <option value="10">Oktober</option>
                                                <option value="11">November</option>
                                                <option value="12">Desember</option>
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            <label class="text-primary font-weight-bold">Tahun</label>
                                            <select name="pilih_tahun" class="form-control form-control-sm pilih-tahun-weekly">
                                                <option value="2021">2021</option>
                                                <option value="2022">2022</option>
                                            </select>
                                        </div>
                                        <div class="col-5 d-flex">
                                            <button class="btn btn-sm btn-primary mt-auto btn-search-weekly"><i class="fas fa-search"></i> Cari</button>
                                            <button class="btn btn-sm btn-primary mt-auto ml-1 btn-refresh-weekly"><i class="fas fa-refresh"></i> Refresh</button>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-12">
                                            <canvas id="chartWeekly" width="400" height="120"></canvas>   
                                        </div>
                                    </div>
                                </div>
                                 <div class="tab-pane fade" id="monthlyPanel" role="tabpanel"> 
                                    <div class="row">
                                        <div class="col-2">
                                            <label class="text-primary font-weight-bold">Tahun</label>
                                            <select name="pilih_tahun" class="form-control form-control-sm pilih-tahun-monthly">
                                                <option value="2021">2021</option>
                                                <option value="2022">2022</option>
                                            </select>
                                        </div>
                                        <div class="col-5 d-flex">
                                            <button class="btn btn-sm btn-primary mt-auto btn-search-monthly"><i class="fas fa-search"></i> Cari</button>
                                            <button class="btn btn-sm btn-primary mt-auto ml-1 btn-refresh-monthly"><i class="fas fa-refresh"></i> Refresh</button>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-12">
                                            <canvas id="chartMonthly" width="400" height="120"></canvas>   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

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

    <?php $this->load->view('partials/js', FALSE);?>

    <!-- chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.esm.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.esm.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/helpers.esm.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/helpers.esm.min.js"></script>

<script>
    var ctx_daily = document.getElementById('chartDaily').getContext('2d');
    var ctx_weekly = document.getElementById('chartWeekly').getContext('2d');
    var ctx_monthly = document.getElementById('chartMonthly').getContext('2d');

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
            url: "<?php echo base_url().'sample/json_daily_chart_acc'; ?>",
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
            url: "<?php echo base_url().'sample/json_weekly_chart_acc'; ?>",
            type: 'GET',
            dataType: 'json',
            data: {param1: 'value1'},
            success: function(data){
                // console.log(data);
                var weekly = [data.week_1, data.week_2, data.week_3, data.week_4];
                set_chart_weekly(weekly);
            }
        });
    }

    function load_chart_monthly(){
        $.ajax({
            url: "<?php echo base_url().'sample/json_monthly_chart_acc'; ?>",
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


        $('#myTab a').click(function(e) {
          e.preventDefault();
          $(this).tab('show');
        });

        $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
          var id = $(e.target).attr("href").substr(1);
          window.location.hash = id;
        });

        var hash = window.location.hash;
        $('#myTab a[href="' + hash + '"]').tab('show');


        $('.btn-search-daily').click(function(event) {
            /* Act on the event */
            let date_start = $('.start-daily-date').val();
            let date_end = $('.end-daily-date').val();
            var data_new = '';

            $.ajax({
                url: "<?php echo base_url().'sample/json_daily_range_acc'; ?>",
                type: 'POST',
                dataType: 'json',
                data: {start: date_start, end: date_end},
                success: function(data){
                    if (data.length > 30) {
                        alert('Maksimal range satu bulan !');
                        $('.start-daily-date').val('');
                        $('.end-daily-date').val('');
                        reset_chart_daily();
                    }else{
                        chart_awal_daily.destroy();
                        set_chart_daily(data);
                        // console.log(data);
                    }
                }
            });
        });

        $('.btn-search-weekly').click(function(event) {
            /* Act on the event */
            let bulan = $('.pilih-bulan-weekly').val();
            let tahun = $('.pilih-tahun-weekly').val();
            var data_new = '';

            $.ajax({
                url: "<?php echo base_url().'sample/json_weekly_range_acc'; ?>",
                type: 'POST',
                dataType: 'json',
                data: {bulan: bulan, tahun: tahun},
                success: function(data){
                    if ((data.week_1 == 0) && (data.week_2 == 0) && (data.week_3 == 0) && (data.week_4 == 0)) {
                        alert('Tidak ada data untuk ditampilkan');
                    }else{
                        data_new = [data.week_1, data.week_2, data.week_3, data.week_4];
                        chart_awal_weekly.destroy();
                        set_chart_weekly(data_new);
                    }
                }
            });
        });

        $('.btn-search-monthly').click(function(event) {
            /* Act on the event */
            let tahun = $('.pilih-tahun-monthly').val();
            var data_new = '';

            $.ajax({
                url: "<?php echo base_url().'sample/json_monthly_range_acc'; ?>",
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
                    chart_awal_monthly.destroy();
                    set_chart_monthly(mdata);
                }
            });
        });

        $('.btn-refresh-daily').click(function(event) {
            /* Act on the event */
            reset_chart_daily();
        });

        $('.btn-refresh-weekly').click(function(event) {
            /* Act on the event */
            reset_chart_weekly();
        });

         $('.btn-refresh-monthly').click(function(event) {
            /* Act on the event */
            reset_chart_monthly();
        });
    });
</script>

</body>
</html>