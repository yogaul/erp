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

        .bg-kosme{
            background-color: #f48081;
            color: white;
        }

        .cbp_tmtimeline {
            margin: 0;
            padding: 0;
            list-style: none;
            position: relative
        }

        .cbp_tmtimeline:before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            width: 3px;
            background: #eee;
            left: 20%;
            margin-left: -6px
        }

        .cbp_tmtimeline>li {
            position: relative
        }

        .cbp_tmtimeline>li:first-child .cbp_tmtime span.large {
            color: #444;
            font-size: 17px !important;
            font-weight: 700
        }

        .cbp_tmtimeline>li:first-child .cbp_tmicon {
            background: #fff;
            color: #666
        }

        .cbp_tmtimeline>li:nth-child(odd) .cbp_tmtime span:last-child {
            color: #444;
            font-size: 13px
        }

        .cbp_tmtimeline>li:nth-child(odd) .cbp_tmlabel {
            background: #f0f1f3
        }

        .cbp_tmtimeline>li:nth-child(odd) .cbp_tmlabel:after {
            border-right-color: #f0f1f3
        }

        .cbp_tmtimeline>li .empty span {
            color: #777
        }

        .cbp_tmtimeline>li .cbp_tmtime {
            display: block;
            width: 23%;
            padding-right: 70px;
            position: absolute
        }

        .cbp_tmtimeline>li .cbp_tmtime span {
            display: block;
            text-align: right
        }

        .cbp_tmtimeline>li .cbp_tmtime span:first-child {
            font-size: 15px;
            color: #3d4c5a;
            font-weight: 700
        }

        .cbp_tmtimeline>li .cbp_tmtime span:last-child {
            font-size: 14px;
            color: #444
        }

        .cbp_tmtimeline>li .cbp_tmlabel {
            margin: 0 0 15px 25%;
            background: #f0f1f3;
            padding: 1.2em;
            position: relative;
            border-radius: 5px
        }

        .cbp_tmtimeline>li .cbp_tmlabel:after {
            right: 100%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
            border-right-color: #f0f1f3;
            border-width: 10px;
            top: 10px
        }

        .cbp_tmtimeline>li .cbp_tmlabel blockquote {
            font-size: 16px
        }

        .cbp_tmtimeline>li .cbp_tmlabel .map-checkin {
            border: 5px solid rgba(235, 235, 235, 0.2);
            -moz-box-shadow: 0px 0px 0px 1px #ebebeb;
            -webkit-box-shadow: 0px 0px 0px 1px #ebebeb;
            box-shadow: 0px 0px 0px 1px #ebebeb;
            background: #fff !important
        }

        .cbp_tmtimeline>li .cbp_tmlabel h2 {
            margin: 0px;
            padding: 0 0 10px 0;
            line-height: 26px;
            font-size: 16px;
            font-weight: normal
        }

        .cbp_tmtimeline>li .cbp_tmlabel h2 a {
            font-size: 15px
        }

        .cbp_tmtimeline>li .cbp_tmlabel h2 a:hover {
            text-decoration: none
        }

        .cbp_tmtimeline>li .cbp_tmlabel h2 span {
            font-size: 15px
        }

        .cbp_tmtimeline>li .cbp_tmlabel p {
            color: #444
        }

        .cbp_tmtimeline>li .cbp_tmicon {
            width: 40px;
            height: 40px;
            speak: none;
            font-style: normal;
            font-weight: normal;
            font-variant: normal;
            text-transform: none;
            font-size: 1.4em;
            line-height: 40px;
            -webkit-font-smoothing: antialiased;
            position: absolute;
            color: #fff;
            background: #46a4da;
            border-radius: 50%;
            box-shadow: 0 0 0 5px #f5f5f6;
            text-align: center;
            left: 20%;
            top: 0;
            margin: 0 0 0 -25px
        }

        @media screen and (max-width: 992px) and (min-width: 768px) {
            .cbp_tmtimeline>li .cbp_tmtime {
                padding-right: 60px
            }
        }

        @media screen and (max-width: 65.375em) {
            .cbp_tmtimeline>li .cbp_tmtime span:last-child {
                font-size: 12px
            }
        }

        @media screen and (max-width: 47.2em) {
            .cbp_tmtimeline:before {
                display: none
            }
            .cbp_tmtimeline>li .cbp_tmtime {
                width: 100%;
                position: relative;
                padding: 0 0 20px 0
            }
            .cbp_tmtimeline>li .cbp_tmtime span {
                text-align: left
            }
            .cbp_tmtimeline>li .cbp_tmlabel {
                margin: 0 0 30px 0;
                padding: 1em;
                font-weight: 400;
                font-size: 95%
            }
            .cbp_tmtimeline>li .cbp_tmlabel:after {
                right: auto;
                left: 20px;
                border-right-color: transparent;
                border-bottom-color: #f5f5f6;
                top: -20px
            }
            .cbp_tmtimeline>li .cbp_tmicon {
                position: relative;
                float: right;
                left: auto;
                margin: -64px 5px 0 0px
            }
            .cbp_tmtimeline>li:nth-child(odd) .cbp_tmlabel:after {
                border-right-color: transparent;
                border-bottom-color: #f5f5f6
            }
        }

        .bg-green {
            background-color: #50d38a !important;
            color: #fff;
        }

        .bg-blush {
            background-color: #ff758e !important;
            color: #fff;
        }

        .bg-orange {
            background-color: #ffc323 !important;
            color: #fff;
        }

        .bg-info {
            background-color: #2CA8FF !important;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php
            if ($this->session->userdata('level') == 'marketing') {
                $this->load->view('partials/sidebar_marketing', FALSE);
            }elseif ($this->session->userdata('level') == 'tim_marketing') {
                $this->load->view('partials/sidebar_tim_marketing', FALSE);
            }elseif ($this->session->userdata('level') == 'rnd') {
                $this->load->view('partials/sidebar_rnd', FALSE);
            }elseif ($this->session->userdata('level') == 'ms_glow' || $this->session->userdata('level') == 'kci') {
                $this->load->view('partials/sidebar_msglow', FALSE);
            }elseif ($this->session->userdata('level') == 'direktur') {
                $this->load->view('partials/sidebar_direktur', FALSE);
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
                    
                    <!-- <div class="row"> 
                        <div class="card col-12">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="product_request" class="h5 text-gray-800">Dashboard</label>
                                    <select name="product_request" class="form-control" id="product_request">
                                        <option value="-"disabled selected>Pilih produk</option>
                                        <?php
                                            foreach ($request as $value) {
                                        ?>
                                        <option value="<?= $value->id_msglow_request ?>">
                                            <?= $value->usulan_nama_produk ?>
                                        </option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div><br> -->

                    <!-- Content Row -->
                    <div class="row card mb-4" <?= $tes = (!isset($log)) ? 'hidden' : '' ?>>
                        <div class="card-header">
                            <span><b>Nama Produk : </b><?= $tes = (isset($produk)) ? $produk->usulan_nama_produk : '-' ?></span>
                            <a href="javascript:void(0)" onclick="tutup()" class="btn btn-sm btn-secondary float-right"><i class="fas fa-times"></i> Tutup</a>
                        </div>
                        <div class="col-12 table-responsive">
                        <!-- <div class="Timeline ml-3">
                        <svg height="5" width="200">
                        <line x1="0" y1="0" x2="200" y2="0" style="stroke:#4e73df;stroke-width:5" />
                        Sorry, your browser does not support inline SVG.
                        </svg> -->

                        <?php
                            if (isset($log)) {
                                // $i = 1;
                                foreach ($log as $value) {
                        ?>
                         <!-- <div class="event<?= $num = ($i % 2 != 0) ? '1' : '2' ?>">
                        
                        <div class="event<?= $num = ($i % 2 != 0) ? '1' : '2' ?>Bubble">
                            <div class="eventTime">
                            <div class="DayDigit"><?= date('d', strtotime($value->tanggal_log_msglow)) ?></div>
                            <div class="Day">
                                <?= date('D', strtotime($value->tanggal_log_msglow)) ?>
                                <div class="MonthYear"><?= date('M/Y', strtotime($value->tanggal_log_msglow)) ?></div>
                            </div>
                            </div>
                            <div class="eventTitle"><?= $value->aksi_log_msglow ?></div>
                        </div>
                        <div class="event<?= $num = ($i % 2 != 0) ? '' : '2' ?>Author">by <?= $value->user_log_msglow ?></div>
                        <svg height="20" width="20">
                            <circle cx="10" cy="11" r="5" fill="#4e73df" />
                        </svg>
                        <div class="time"><?= date('H:i', strtotime($value->tanggal_log_msglow)) ?></div>
                        
                        </div>
                        <svg height="5" width="300">
                        <line x1="0" y1="0" x2="300" y2="0" style="stroke:#4e73df;stroke-width:5" />
                            Sorry, your browser does not support inline SVG.
                        </svg> -->
                        <div class="row mt-4 mb-4">
                            <div class="col-md-10">
                                <ul class="cbp_tmtimeline">
                                    <li>
                                        <time class="cbp_tmtime" datetime="2017-11-04T03:45"><span><?= date('d M Y H:i', strtotime($value->tanggal_log_msglow)) ?></span><span><?= date('l', strtotime($value->tanggal_log_msglow)) ?></span></time>
                                        <div class="cbp_tmicon bg-primary"><i class="fas fa-check text-white"></i></div>
                                        <div class="cbp_tmlabel">
                                            <h2><a href="javascript:void(0);"><?= $value->user_log_msglow ?></a> <span class="badge badge-primary float-right"><?= $value->aksi_log_msglow ?></span></h2>
                                            <p><?= $value->deskripsi_log_msglow ?></p>
                                        </div>
                                    </li>
                                </ul>  
                            </div>
                        </div>
                        <?php
                                // $i++;
                                }
                            }
                        ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h1 class="h4 mb-2 text-gray-800">Dashboard</h1>
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <div id="chart_product" style="height: <?= ($this->session->userdata('level') == 'ms_glow' || $this->session->userdata('level') == 'kci') ? '300' : '600' ?>px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h1 class="h4 mb-2 text-gray-800">Tracking Product</h1>
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="table-responsive">
                                    <table class="table table-bordered" id="tableku" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th>Nama Produk</th>
                                                <th class="text-center">Kategori</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Progress</th>
                                                <th class="text-center">Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $no = 1;
                                                foreach ($request as $key) {
                                                    $persen = 0;
                                                    if($key->status_request_msglow == 'NPD REQUEST'){
                                                        $persen = round(1/13*100);
                                                    }else if($key->status_request_msglow == 'NPD APPROVED'){
                                                        $persen = round(2/13*100);
                                                    }else if($key->status_request_msglow == 'Design Kemasan'){
                                                        $persen = round(3/13*100);
                                                    }else if($key->status_request_msglow == 'FORMULA ON PROGRESS'){
                                                        $persen = round(3.5/13*100);
                                                    }else if($key->status_request_msglow == 'Development Formula'){
                                                        $persen = round(4/13*100);
                                                    }else if($key->status_request_msglow == 'Panelis Review'){
                                                        $persen = round(5/13*100);
                                                    }else if($key->status_request_msglow == 'Review Sample'){
                                                        $persen = round(6/13*100);
                                                    }else if($key->status_request_msglow == 'Sending Sample'){
                                                        $persen = round(7/13*100);
                                                    }else if($key->status_request_msglow == 'Sample Received'){
                                                        $persen = round(8/13*100);
                                                    }else if($key->status_request_msglow == 'Purchase Request'){
                                                        $persen = round(9/13*100);
                                                    }else if($key->status_request_msglow == 'Purchase Order'){
                                                        $persen = round(10/13*100);
                                                    }else if($key->status_request_msglow == 'Proses BPOM'){
                                                        $persen = round(11/13*100);
                                                    }else if($key->status_request_msglow == 'Manufacture KGI'){
                                                        $persen = round(12/13*100);
                                                    }else if($key->status_request_msglow == 'Delivery Process'){
                                                        $persen = round(13/13*100);
                                                    }else if($key->status_request_msglow == 'Perubahan Spesifikasi'){
                                                        $persen = round(3/13*100);
                                                    }
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $no++; ?>.</td>
                                                    <td><?php echo $key->usulan_nama_produk; ?></td>
                                                    <td class="text-center"><span class="badge <?= ($key->kategori_request == 'MS Glow') ? 'badge-warning text-dark' : 'bg-kosme'  ?>"><?php echo $key->kategori_request; ?></span></td>
                                                    <td class="text-center"><a href="<?= base_url().'glow/log_request/'.$key->id_msglow_request ?>" class="badge badge-info"><?= $key->status_request_msglow ?></a></td>
                                                    <td style="vertical-align: middle;">
                                                        <div class="progress mt">
                                                            <div class="progress-bar" role="progressbar" style="width: <?= $persen ?>%;" aria-valuenow="<?= $persen ?>" aria-valuemin="0" aria-valuemax="100"><?= $persen ?>%</div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="javascript:void(0)" onclick="detail('<?= $key->id_msglow_request ?>')" class="btn btn-sm btn-primary"><i class="fas fa-search"></i> Tracking</a>
                                                        <a href="javascript:void(0)" onclick="mtask('<?= $key->id_msglow_request ?>')"  class="btn btn-sm btn-secondary"><i class="fas fa-tasks"></i> Timeline</a>
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
                    </div>
                </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php $this->load->view('partials/footer', FALSE); ?>
            <!-- End of Footer -->

            <!-- Track Modal-->
            <div class="modal fade" id="trackModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary font-weight-bold" id="exampleModalLabel">Tracking Product</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"></div>
                </div>
            </div>
            </div>

            <!-- Gant Modal-->
            <div class="modal fade" id="grantModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary font-weight-bold" id="exampleModalLabel">Timeline Product</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_request" id="id_request">
                    <div id="chart_div" style="height: 520px;"></div>
                </div>
                </div>
            </div>
            </div>

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

    <!-- google chart -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">

        google.charts.load('current', {'packages':['timeline']});
        google.charts.setOnLoadCallback(drawChart);

        function tutup(){
            $.ajax({
                url: "<?= base_url('glow/json_unset_request'); ?>",
                method: 'POST',
                dataType: 'json',
                data: {id: null},
                success: function(data){
                    if (data.message = '1') {
                        window.location.reload();
                    }
                }
            })
        }

        function mtask(id){
            $('#grantModal #id_request').val(id);
            $('#grantModal').modal('show');
        }

        function load_product(){
            google.charts.load('current', {'packages':['timeline']});
            google.charts.setOnLoadCallback(drawProduct);
        }

        function drawChart() {
            var container = document.getElementById('chart_div');
            var chart = new google.visualization.Timeline(container);
            var data = new google.visualization.DataTable();
            let id =  $('#grantModal #id_request').val();
            var mprogress = [];
            var start_project = "";
            var start_plan_formula = "";
            var end_plan_formula = "";
            var start_actual_formula = "";
            var end_actual_formula = "";
            var start_plan_panelis = "";
            var end_plan_panelis = "";
            var start_actual_panelis = "";
            var end_actual_panelis = "";
            var start_plan_scale = "";
            var end_plan_scale = "";
            var start_actual_scale = "";
            var end_actual_scale = "";
            var start_plan_kemasan = "";
            var end_plan_kemasan = "";
            var start_actual_kemasan = "";
            var end_actual_kemasan = "";
            var start_plan_bpom = "";
            var end_plan_bpom = "";
            var start_actual_bpom = "";
            var end_actual_bpom = "";
            var start_plan_mps = "";
            var end_plan_mps = "";
            var start_actual_mps = "";
            var end_actual_mps = "";
            var start_plan_po = "";
            var end_plan_po = "";
            var start_actual_po = "";
            var end_actual_po = "";
            var start_plan_inbound = "";
            var end_plan_inbound = "";
            var start_actual_inbound = "";
            var end_actual_inbound = "";
            var start_plan_produksi = "";
            var end_plan_produksi = "";
            var start_actual_produksi = "";
            var end_actual_produksi = "";
            var start_plan_wh = "";
            var end_plan_wh = "";
            var start_actual_wh = "";
            var end_actual_wh = "";

            data.addColumn({ type: 'string', id: 'Nama' });
            data.addColumn({ type: 'string', id: 'Kategori' });
            data.addColumn({ type: 'date', id: 'Start' });
            data.addColumn({ type: 'date', id: 'End' });

            $.ajax({
                type: "POST",
                url: "<?= base_url().'glow/json_chart_id' ?>",
                data: {id: id},
                dataType: "json",
                success: function (response) {
                    start_project =  new Date(response.tahun_request, response.bulan_request-1, response.hari_request);

                    let produk = [
                        response.kategori_request, 
                        response.usulan_nama_produk+" - Target",
                        new Date(response.tahun_request, response.bulan_request-1, response.hari_request), 
                        new Date(response.tahun_launching, response.bulan_launching-1, response.hari_launching)
                    ];

                    mprogress.push(produk);
                    
                    start_plan_formula = new Date(response.tahun_request, response.bulan_request-1, response.hari_request); 
                    end_plan_formula =  new Date(response.tahun_request, response.bulan_request-1, response.hari_request); 
                    end_plan_formula.setDate(end_plan_formula.getDate()+3);
                    let arr_target_formula = [
                        'Formula (3D) - RND (Plan)', 
                        'Plan',
                        start_plan_formula, 
                        end_plan_formula
                    ];

                    mprogress.push(arr_target_formula);

                    if (response.tahun_start_formula != 0) {
                        start_actual_formula = new Date(response.tahun_start_formula, response.bulan_start_formula-1, response.hari_start_formula); 
                        if (response.tahun_end_formula != 0) {
                            end_actual_formula = new Date(response.tahun_end_formula, response.bulan_end_formula-1, response.hari_end_formula);
                        }else{
                            end_actual_formula = new Date();
                        }
                        let arr_end_formula = [
                            'Formula (3D) - RND (Actual)', 
                            'Actual',
                            start_actual_formula, 
                            end_actual_formula
                        ];
                        mprogress.push(arr_end_formula);
                    }

                    end_plan_panelis = new Date(end_plan_formula); 
                    end_plan_panelis.setDate(end_plan_panelis.getDate()+10);
                    let arr_target_panelis = [
                        'Panelis (10D) - User (Plan)', 
                        'Plan',
                        end_plan_formula, 
                        end_plan_panelis
                    ];

                    mprogress.push(arr_target_panelis);

                    if (response.tahun_start_panelis != 0) {
                        start_actual_panelis = new Date(response.tahun_start_panelis, response.bulan_start_panelis-1, response.hari_start_panelis); 
                        if (response.tahun_end_panelis != 0) {
                            end_actual_panelis = new Date(response.tahun_end_panelis, response.bulan_end_panelis-1, response.hari_end_panelis);
                        }else{
                            end_actual_panelis = new Date();
                        }
                        let arr_end_panelis = [
                            'Panelis (10D) - User (Actual)', 
                            'Actual',
                            start_actual_panelis, 
                            end_actual_panelis
                        ];
                        mprogress.push(arr_end_panelis);
                    }

                    end_plan_scale = new Date(end_plan_formula); 
                    end_plan_scale.setDate(end_plan_scale.getDate()+14);
                    let arr_target_scale = [
                        'Scale Up (2W) - User (Plan)', 
                        'Plan',
                        end_plan_formula, 
                        end_plan_scale
                    ];

                    mprogress.push(arr_target_scale);

                    if (response.tahun_start_scale != 0) {
                        start_actual_scale = new Date(response.tahun_start_scale, response.bulan_start_scale-1, response.hari_start_scale); 
                        if (response.tahun_end_scale != 0) {
                            end_actual_scale = new Date(response.tahun_end_scale, response.bulan_end_scale-1, response.hari_end_scale);
                        }else{
                            end_actual_scale = new Date();
                        }
                        let arr_end_scale = [
                            'Scale Up (2W) - User (Actual)', 
                            'Actual',
                            start_actual_scale, 
                            end_actual_scale
                        ];
                        mprogress.push(arr_end_scale);
                    }

                    end_plan_kemasan = new Date(start_project); 
                    end_plan_kemasan.setDate(end_plan_kemasan.getDate()+14);
                    let arr_target_kemasan = [
                        'Design Kemasan (2W) - User (Plan)', 
                        'Plan',
                        start_project, 
                        end_plan_kemasan
                    ];

                    mprogress.push(arr_target_kemasan);

                    if (response.tahun_start_kemasan != 0) {
                        start_actual_kemasan = new Date(response.tahun_start_kemasan, response.bulan_start_kemasan-1, response.hari_start_kemasan); 
                        if (response.tahun_end_kemasan != 0) {
                            end_actual_kemasan = new Date(response.tahun_end_kemasan, response.bulan_end_kemasan-1, response.hari_end_kemasan);
                        }else{
                            end_actual_kemasan = new Date();
                        }
                        let arr_end_kemasan = [
                            'Design Kemasan (2W) - User (Actual)', 
                            'Actual',
                            start_actual_kemasan, 
                            end_actual_kemasan
                        ];
                        mprogress.push(arr_end_kemasan);
                    }

                    end_plan_bpom = new Date(end_plan_kemasan); 
                    end_plan_bpom.setDate(end_plan_bpom.getDate()+60);
                    let arr_target_bpom = [
                        'BPOM (2M) - RND (Plan)', 
                        'Plan',
                        end_plan_kemasan, 
                        end_plan_bpom
                    ];

                    mprogress.push(arr_target_bpom);

                    if (response.tahun_start_bpom != 0) {
                        start_actual_bpom = new Date(response.tahun_start_bpom, response.bulan_start_bpom-1, response.hari_start_bpom); 
                        if (response.tahun_end_bpom != 0) {
                            end_actual_bpom = new Date(response.tahun_end_bpom, response.bulan_end_bpom-1, response.hari_end_bpom);
                        }else{
                            end_actual_bpom = new Date();
                        }
                        let arr_end_bpom = [
                            'BPOM (2M) - RND (Actual)', 
                            'Actual',
                            start_actual_bpom, 
                            end_actual_bpom
                        ];
                        mprogress.push(arr_end_bpom);
                    }

                    start_plan_mps = new Date(start_project);
                    start_plan_mps.setDate(start_plan_mps.getDate()+28);

                    end_plan_mps = new Date(start_plan_mps); 
                    end_plan_mps.setDate(end_plan_mps.getDate()+7);
                    let arr_target_mps = [
                        'MPS (1W) - PPIC (Plan)', 
                        'Plan',
                        start_plan_mps, 
                        end_plan_mps
                    ];

                    mprogress.push(arr_target_mps);
                    
                    if (response.tahun_start_mps != 0) {
                        start_actual_mps = new Date(response.tahun_start_mps, response.bulan_start_mps-1, response.hari_start_mps); 
                        if (response.tahun_end_mps != 0) {
                            end_actual_mps = new Date(response.tahun_end_mps, response.bulan_end_mps-1, response.hari_end_mps);
                        }else{
                            end_actual_mps = new Date();
                        }
                        let arr_end_mps = [
                            'MPS (1W) - PPIC (Actual)', 
                            'Actual',
                            start_actual_mps, 
                            end_actual_mps
                        ];
                        mprogress.push(arr_end_mps);
                    }

                    end_plan_po = new Date(start_plan_mps); 
                    end_plan_po.setDate(end_plan_po.getDate()+30);
                    let arr_target_po = [
                        'PO (1M) - Purchasing (Plan)', 
                        'Plan',
                        start_plan_mps, 
                        end_plan_po
                    ];

                    mprogress.push(arr_target_po);

                    if (response.tahun_start_po != 0) {
                        start_actual_po = new Date(response.tahun_start_po, response.bulan_start_po-1, response.hari_start_po); 
                        if (response.tahun_end_po != 0) {
                            end_actual_po = new Date(response.tahun_end_po, response.bulan_end_po-1, response.hari_end_po);
                        }else{
                            end_actual_po = new Date();
                        }
                        let arr_end_po = [
                            'PO (1M) - Purchasing (Actual)', 
                            'Actual',
                            start_actual_po, 
                            end_actual_po
                        ];
                        mprogress.push(arr_end_po);
                    }
                    
                    end_plan_inbound = new Date(end_plan_po); 
                    end_plan_inbound.setDate(end_plan_inbound.getDate()+30);
                    let arr_target_inbound = [
                        'Inbound (1M) - QC (Plan)', 
                        'Plan',
                        end_plan_po, 
                        end_plan_inbound
                    ];

                    mprogress.push(arr_target_inbound);

                    if (response.tahun_start_inbound != 0) {
                        start_actual_inbound = new Date(response.tahun_start_inbound, response.bulan_start_inbound-1, response.hari_start_inbound); 
                        if (response.tahun_end_inbound != 0) {
                            end_actual_inbound = new Date(response.tahun_end_inbound, response.bulan_end_inbound-1, response.hari_end_inbound);
                        }else{
                            end_actual_inbound = new Date();
                        }
                        let arr_end_inbound = [
                            'Inbound (1M) - QC (Actual)', 
                            'Actual',
                            start_actual_inbound, 
                            end_actual_inbound
                        ];
                        mprogress.push(arr_end_inbound);
                    }
                   
                    start_plan_produksi = new Date(start_project);
                    start_plan_produksi.setDate(start_plan_produksi.getDate()+77);

                    end_plan_produksi = new Date(start_plan_produksi); 
                    end_plan_produksi.setDate(end_plan_produksi.getDate()+14);
                    let arr_target_produksi = [
                        'Produksi (2W) - Produksi (Plan)', 
                        'Plan',
                        start_plan_produksi, 
                        end_plan_produksi
                    ];

                    mprogress.push(arr_target_produksi);

                    if (response.tahun_start_produksi != 0) {
                        start_actual_produksi = new Date(response.tahun_start_produksi, response.bulan_start_produksi-1, response.hari_start_produksi); 
                        if (response.tahun_end_produksi != 0) {
                            end_actual_produksi = new Date(response.tahun_end_produksi, response.bulan_end_produksi-1, response.hari_end_produksi);
                        }else{
                            end_actual_produksi = new Date();
                        }
                        let arr_end_produksi = [
                            'Produksi (2W) - Produksi (Actual)', 
                            'Actual',
                            start_actual_produksi, 
                            end_actual_produksi
                        ];
                        mprogress.push(arr_end_produksi);
                    }

                    end_plan_wh = new Date(end_plan_produksi); 
                    end_plan_wh.setDate(end_plan_wh.getDate()+7);
                    let arr_target_wh = [
                        'Warehouse (1W) - Warehouse (Plan)', 
                        'Plan',
                        end_plan_produksi, 
                        end_plan_wh
                    ];

                    mprogress.push(arr_target_wh);

                    if (response.tahun_start_wh != 0) {
                        start_actual_wh = new Date(response.tahun_start_wh, response.bulan_start_wh-1, response.hari_start_wh); 
                        if (response.tahun_end_wh != 0) {
                            end_actual_wh = new Date(response.tahun_end_wh, response.bulan_end_wh-1, response.hari_end_wh);
                        }else{
                            end_actual_wh = new Date();
                        }
                        let arr_end_wh = [
                            'Warehouse (1W) - Warehouse (Actual)', 
                            'Actual',
                            start_actual_wh, 
                            end_actual_wh
                        ];
                        mprogress.push(arr_end_wh);
                    }

                    data.addRows(mprogress);

                    var options = {
                        colors: ['#FF4500', '#FF4500', '#007500']
                    };

                    chart.draw(data, options);
                }
            });
        }

        function drawProduct() {
            var container = document.getElementById('chart_product');
            var chart = new google.visualization.Timeline(container);
            var data = new google.visualization.DataTable();
            var temp_data = [];
            data.addColumn({ type: 'string', id: 'ID' });
            data.addColumn({ type: 'string', id: 'Kategori' });
            data.addColumn({ type: 'date', id: 'Start' });
            data.addColumn({ type: 'date', id: 'End' });

            $.ajax({
                type: "GET",
                url: "<?= base_url().'glow/json_all_request' ?>",
                dataType: "json",
                success: function (res) {
                    $.each(res, function (indexInArray, valueOfElement) { 
                        temp_data.push([
                                valueOfElement.id_msglow_request, 
                                valueOfElement.kategori_request+' - '+valueOfElement.usulan_nama_produk,
                                new Date(valueOfElement.tahun_request, valueOfElement.bulan_request-1, valueOfElement.hari_request), 
                                new Date(valueOfElement.tahun_launching, valueOfElement.bulan_launching-1, valueOfElement.hari_launching)
                        ]);
                    });

                    data.addRows(temp_data);

                    var options = {
                        timeline: { singleColor: '#4e73df' },
                        'tooltip' : {
                            trigger: 'none'
                        }
                    };

                    google.visualization.events.addListener(chart, 'select', function () {
                        var selection = chart.getSelection();
                        if (selection.length > 0) {
                            mtask(data.getValue(selection[0].row, 0));
                        }
                    });

                    chart.draw(data, options);
                }
                
            });
        }

        function detail(id){
            $('#trackModal .modal-body').html('');        
            var html = "";
            $.ajax({
                url: "<?= base_url('glow/json_log_request'); ?>",
                method: 'POST',
                dataType: 'json',
                data: {id: id},
                success: function(data){
                    if (data.length == 0) {
                        html += "<div class='row'>";
                        html += "<div class='col-12'>";
                        html += "<p class='text-center'>Tidak ada data untuk ditampilkan.</p>";
                        html += "</div>";
                        html += "</div>";
                    }else{
                        $.each(data, function (indexInArray, valueOfElement) { 
                            html += "<div class='row'>";
                            html += "<div class='col-md-10'>";
                            html += "<ul class='cbp_tmtimeline'>";
                            html += "<li>";
                            html += "<time class='cbp_tmtime' datetime='2017-11-04T03:45'><span class='tanggal-jam'>"+valueOfElement.tanggal_log_msglow+"</span><span class='hari'></span></time>";
                            html += "<div class='cbp_tmicon bg-primary'><i class='fas fa-check text-white'></i></div>";
                            html += "<div class='cbp_tmlabel'>";
                            html += "<h2><a href='javascript:void(0);' class='user'>"+valueOfElement.user_log_msglow+"</a> <span class='badge badge-primary float-right aksi'>"+valueOfElement.aksi_log_msglow+"</span></h2>";
                            html += "<p class='deskripsi'>"+valueOfElement.deskripsi_log_msglow+"</p>"; 
                            html += "</div>"; 
                            html += "</li>"; 
                            html += "</ul>"; 
                            html += "</div>"; 
                            html += "</div>"; 
                        });
                    }
                   $('#trackModal .modal-body').html(html);        
                }
            })
            $('#trackModal').modal({backdrop: 'static', keyboard: false});
        }

        $(document).ready(function() {

            load_product();

            $( "#grantModal" ).on('shown.bs.modal', function(){
                drawChart();
            });

            $('#product_request').change(function() {
                var id = $(this).val();
                $.ajax({
                    url: "<?php echo base_url('glow/json_set_request'); ?>",
                    method: 'POST',
                    dataType: 'json',
                    data: {id: id},
                    success: function(data){
                        if (data.message = '1') {
                            window.location.reload();
                        }
                    }
                })
            });

            $('#tableku').DataTable({
                stateSave: true
            });
        });
    </script>

</body>

</html>