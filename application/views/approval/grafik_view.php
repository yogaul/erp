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
            if ($this->session->userdata('level') == 'direktur' || $this->session->userdata('level') == 'spv_purchasing') {
                $this->load->view('partials/sidebar_direktur', FALSE);
            }else{
                $this->load->view('partials/sidebar', FALSE);
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
                    <h1 class="h4 mb-2 text-gray-800">Grafik Purchase Order</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <!-- write your code here -->
                            <div class="row">
                                <div class="col-2">
                                    <label class="text-gray font-weight-bold">Bulan</label>
                                      <select name="pilih_bulan" class="form-control pilih-bulan">
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
                                    <label class="text-gray font-weight-bold">Tahun</label>
                                      <select name="pilih_tahun" class="form-control pilih-tahun">
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <label class="text-gray font-weight-bold">Status</label>
                                      <select name="pilih_status" class="form-control pilih-status">
                                        <option value="Belum">Pending</option>
                                        <option value="Reminder">Reminder</option>
                                        <option value="Terlambat">Terlambat</option>
                                    </select>
                                </div>
                                <div class="col-3 d-flex">
                                    <button type="button" class="btn btn-sm btn-primary btn-search-chart mt-auto"><i class="fas fa-search"></i> Cari</button>
                                    <button type="button" class="btn btn-sm btn-primary btn-refresh-chart mt-auto ml-1"><i class="fas fa-refresh"></i> Refresh</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                           <div class="row">
                            <div class="col-12">
                                <canvas id="myChart" width="400" height="120"></canvas>   
                            </div>
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

    <!-- chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.esm.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.esm.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/helpers.esm.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/helpers.esm.min.js"></script>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart_awal = "";
    var data_awal = [<?php echo $baku; ?>,<?php echo $kemas; ?>,<?php echo $teknik; ?>];

    function set_chart(data){
        chart_awal = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Bahan Baku', 'Bahan Kemas', 'Bahan Teknik'],
                datasets: [{
                    label: 'Total',
                    data: [data[0],data[1],data[2]],
                    backgroundColor: [
                        'rgba(78, 115, 223, 0.2)',
                        'rgba(78, 115, 223, 0.2)',
                        'rgba(78, 115, 223, 0.2)'
                    ],
                    borderColor: [
                        'rgba(78, 115, 223, 1)',
                        'rgba(78, 115, 223, 1)',
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

    function reset_chart(){
        chart_awal.destroy();
        set_chart(data_awal);
    }
    $(document).ready(function() {
        set_chart(data_awal);


        $('.btn-search-chart').click(function(event) {
            /* Act on the event */
            let bulan = $('.pilih-bulan').val();
            let tahun = $('.pilih-tahun').val();
            let status = $('.pilih-status').val();
            var data_new = '';

            $.ajax({
                url: "<?php echo base_url().'order/json_chart'; ?>",
                type: 'POST',
                dataType: 'json',
                data: {bulan: bulan, tahun: tahun, status: status},
                success: function(data){
                    if ((data.num_baku == '') && (data.num_kemas == '') && (data.num_teknik == '')) {
                        alert('Tidak ada data untuk ditampilkan');
                    }else{
                        data_new = [data.num_baku, data.num_kemas, data.num_teknik];
                        chart_awal.destroy();
                        set_chart(data_new);
                    }
                }
            });
        });

        $('.btn-refresh-chart').click(function(event) {
            /* Act on the event */
            reset_chart();
        });
    });
</script>

</body>
</html>