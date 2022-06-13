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

                    <!-- dashboard header -->
                    <h1 class="h4 mb-2 text-gray-800">Dashboard</h1>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-<?php echo $col_size; ?> col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                <a href="<?php echo base_url().'sample/acc'; ?>" class="h6 font-weight-bold text-primary text-uppercase mb-1">Sales Order</a>
                                            </div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?php echo number_format($count_so,0,',','.'); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-shopping-cart fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                       <!-- Pending Requests Card Example -->
                        <div class="col-xl-<?php echo $col_size; ?> col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                <a href="<?php echo base_url().'sample/acc'; ?>" class="h6 font-weight-bold text-warning text-uppercase mb-1">Produk</a>
                                            </div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?php echo number_format($count_produk,0,',','.'); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-gift fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php 
                            if ($this->session->userdata('level') == 'marketing') {
                        ?>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                <a href="<?php echo base_url().'survey/data'; ?>" class="h6 font-weight-bold text-info text-uppercase mb-1">Survey Maklon</a>
                                            </div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?php echo number_format($count_survey,0,',','.'); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-poll fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                        
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-<?php echo $col_size; ?> col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                <a href="<?php echo base_url().'customer'; ?>" class="h6 font-weight-bold text-success text-uppercase mb-1">Customer</a>
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h3 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo number_format($count_customer,0,',','.'); ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-group fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <h1 class="h4 mb-2 text-gray-800">Timeline Product</h1>
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <div id="chart_product" style="height: 600px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
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
                                                        <div class="progress">
                                                            <div class="progress-bar" role="progressbar" style="width: <?= $persen ?>%;" aria-valuenow="<?= $persen ?>" aria-valuemin="0" aria-valuemax="100"><?= $persen ?>%</div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="javascript:void(0)" onclick="detail('<?= $key->id_msglow_request ?>')" class="btn btn-sm btn-primary"><i class="fas fa-search"></i> Tracking</a>
                                                        <a href="javascript:void(0)" onclick="mtask('<?= $key->id_msglow_request ?>')" class="btn btn-sm btn-secondary"><i class="fas fa-tasks"></i> Timeline</a>
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
                    <br>
                    <?php
                        if ($this->session->userdata('level') == 'marketing') {
                    ?>
                    <div class="row">
                        <div class="col-12">
                            <h1 class="h4 mb-2 text-gray-800">Grafik Permintaan Sample</h1>
                            <div class="card shadow mb-4">
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
                                            <input type="date" class="form-control form-control-sm start-daily-date" value="<?php echo $start_date; ?>">
                                        </div>
                                        <div class="col-2">
                                            <label class="text-primary font-weight-bold">End</label>
                                            <input type="date" class="form-control form-control-sm end-daily-date" value="<?php echo $last_date; ?>">
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
                                            <select name="pilih_tahun" class="form-control form-control-sm pilih-tahun-weekly">
                                                <option value="2021" <?php if(date('Y') == '2021'){echo 'selected';} ?>>2021</option>
                                                <option value="2022" <?php if(date('Y') == '2022'){echo 'selected';} ?>>2022</option>
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
                                                <option value="2021" <?php if(date('Y') == '2021'){echo 'selected';} ?>>2021</option>
                                                <option value="2022" <?php if(date('Y') == '2022'){echo 'selected';} ?>>2022</option>
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

                    <div class="row">
                        <div class="col-12">
                            <h1 class="h4 mb-2 text-gray-800">Grafik Sample Acc</h1>
                                 <div class="card shadow mb-4">
                                <!-- DataTales Example -->
                                <div class="card">
                                    <div class="card-header py-3">
                                        <ul class="nav nav-tabs" id="myTabAcc" role="tablist">
                                          <li class="nav-item">
                                            <a class="nav-link active" id="tab1Acc" data-toggle="tab" href="#dailyPanelAcc" role="tab">Daily</a>
                                          <li>
                                          <li class="nav-item">
                                            <a class="nav-link" id="tab2Acc" data-toggle="tab" href="#weeklyPanelAcc" role="tab">Weekly</a>
                                          <li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="tab3Acc" data-toggle="tab" href="#monthlyPanelAcc" role="tab">Monthly</a>
                                            <li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                    <div class="tab-content mt-1">
                                    <div class="tab-pane fade show active" id="dailyPanelAcc" role="tabpanel">
                                        <div class="row">
                                            <div class="col-2">
                                                <label class="text-primary font-weight-bold">Start</label>
                                                <input type="date" class="form-control form-control-sm start-daily-date-acc" value="<?php echo $start_date; ?>">
                                            </div>
                                            <div class="col-2">
                                                <label class="text-primary font-weight-bold">End</label>
                                                <input type="date" class="form-control form-control-sm end-daily-date-acc" value="<?php echo $last_date; ?>">
                                            </div>
                                            <div class="col-5 d-flex">
                                                <button class="btn btn-sm btn-primary mt-auto btn-search-daily-acc"><i class="fas fa-search"></i> Cari</button>
                                                <button class="btn btn-sm btn-primary mt-auto ml-1 btn-refresh-daily-acc"><i class="fas fa-refresh"></i> Refresh</button>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-12">
                                                <canvas id="chartDailyAcc" width="400" height="120"></canvas>   
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="weeklyPanelAcc" role="tabpanel"> 
                                        <div class="row">
                                            <div class="col-2">
                                                <label class="text-primary font-weight-bold">Bulan</label>
                                                <select name="pilih_bulan" class="form-control form-control-sm pilih-bulan-weekly-acc">
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
                                                <select name="pilih_tahun" class="form-control form-control-sm pilih-tahun-weekly-acc">
                                                    <option value="2021" <?php if(date('Y') == '2021'){echo 'selected';} ?>>2021</option>
                                                    <option value="2022" <?php if(date('Y') == '2022'){echo 'selected';} ?>>2022</option>
                                                </select>
                                            </div>
                                            <div class="col-5 d-flex">
                                                <button class="btn btn-sm btn-primary mt-auto btn-search-weekly-acc"><i class="fas fa-search"></i> Cari</button>
                                                <button class="btn btn-sm btn-primary mt-auto ml-1 btn-refresh-weekly-acc"><i class="fas fa-refresh"></i> Refresh</button>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-12">
                                                <canvas id="chartWeeklyAcc" width="400" height="120"></canvas>   
                                            </div>
                                        </div>
                                    </div>
                                     <div class="tab-pane fade" id="monthlyPanelAcc" role="tabpanel"> 
                                        <div class="row">
                                            <div class="col-2">
                                                <label class="text-primary font-weight-bold">Tahun</label>
                                                <select name="pilih_tahun" class="form-control form-control-sm pilih-tahun-monthly-acc">
                                                    <option value="2021" <?php if(date('Y') == '2021'){echo 'selected';} ?>>2021</option>
                                                    <option value="2022" <?php if(date('Y') == '2022'){echo 'selected';} ?>>2022</option>
                                                </select>
                                            </div>
                                            <div class="col-5 d-flex">
                                                <button class="btn btn-sm btn-primary mt-auto btn-search-monthly-acc"><i class="fas fa-search"></i> Cari</button>
                                                <button class="btn btn-sm btn-primary mt-auto ml-1 btn-refresh-monthly-acc"><i class="fas fa-refresh"></i> Refresh</button>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-12">
                                                <canvas id="chartMonthlyAcc" width="400" height="120"></canvas>   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-12">
                            <h1 class="h4 mb-2 text-gray-800">Grafik Customer Response</h1>
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
                    <?php
                         } 
                    ?>
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
                    <div id="chart_div" style="height: 500px;"></div>
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
        var ctx_daily = document.getElementById('chartDaily').getContext('2d');
        var ctx_weekly = document.getElementById('chartWeekly').getContext('2d');
        var ctx_monthly = document.getElementById('chartMonthly').getContext('2d');

        var ctx_daily_acc = document.getElementById('chartDailyAcc').getContext('2d');
        var ctx_weekly_acc = document.getElementById('chartWeeklyAcc').getContext('2d');
        var ctx_monthly_acc = document.getElementById('chartMonthlyAcc').getContext('2d');

        var ctx_daily_response = document.getElementById('chartDailyResponse').getContext('2d');
        var ctx_weekly_response = document.getElementById('chartWeeklyResponse').getContext('2d');
        var ctx_monthly_response = document.getElementById('chartMonthlyResponse').getContext('2d');

        var chart_awal_daily = "";
        var chart_awal_weekly = "";
        var chart_awal_monthly = "";

        var chart_awal_daily_acc = "";
        var chart_awal_weekly_acc = "";
        var chart_awal_monthly_acc = "";

        var chart_awal_daily_response = "";
        var chart_awal_weekly_response = "";
        var chart_awal_monthly_response = "";

        google.charts.load('current', {'packages':['timeline']});
        google.charts.setOnLoadCallback(drawChart);

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

        function set_chart_daily_acc(data){
            var label = [];
            var value = [];

            for(var i in data){
                label.push(data[i].tanggal);
                value.push(data[i].value);
            }
            chart_awal_daily_acc = new Chart(ctx_daily_acc, {
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

        function set_chart_weekly_acc(data){
            chart_awal_weekly_acc = new Chart(ctx_weekly_acc, {
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

         function set_chart_monthly_acc(data){
            chart_awal_monthly_acc = new Chart(ctx_monthly_acc, {
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

        function set_chart_daily_response(data){
            var label = [];
            var value = [];

            for(var i in data){
                label.push(data[i].tanggal);
                value.push(data[i].value);
            }
            chart_awal_daily_response = new Chart(ctx_daily_response, {
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

        function set_chart_weekly_response(data){
            chart_awal_weekly_response = new Chart(ctx_weekly_response, {
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

         function set_chart_monthly_response(data){
            chart_awal_monthly_response = new Chart(ctx_monthly_response, {
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
                url: "<?php echo base_url().'sample/json_daily_chart'; ?>",
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
                url: "<?php echo base_url().'sample/json_weekly_chart'; ?>",
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
                url: "<?php echo base_url().'sample/json_monthly_chart'; ?>",
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

        function load_chart_daily_acc(){
            $.ajax({
                url: "<?php echo base_url().'sample/json_daily_chart_acc'; ?>",
                type: 'GET',
                dataType: 'json',
                data: {param1: 'value1'},
                success: function(data){
                    set_chart_daily_acc(data);
                }
            });
        }

        function load_chart_weekly_acc(){
            $.ajax({
                url: "<?php echo base_url().'sample/json_weekly_chart_acc'; ?>",
                type: 'GET',
                dataType: 'json',
                data: {param1: 'value1'},
                success: function(data){
                    var weekly = [data.week_1, data.week_2, data.week_3, data.week_4];
                    set_chart_weekly_acc(weekly);
                }
            });
        }

        function load_chart_monthly_acc(){
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
                    set_chart_monthly_acc(mdata);
                }
            });
        }

        function load_chart_daily_response(){
            $.ajax({
                url: "<?php echo base_url().'komplain/json_daily_chart'; ?>",
                type: 'GET',
                dataType: 'json',
                data: {param1: 'value1'},
                success: function(data){
                    set_chart_daily_response(data);
                }
            });
        }

        function load_chart_weekly_response(){
            $.ajax({
                url: "<?php echo base_url().'komplain/json_weekly_chart'; ?>",
                type: 'GET',
                dataType: 'json',
                data: {param1: 'value1'},
                success: function(data){
                    // console.log(data);
                    var weekly = [data.week_1, data.week_2, data.week_3, data.week_4];
                    set_chart_weekly_response(weekly);
                }
            });
        }

        function load_chart_monthly_response(){
            $.ajax({
                url: "<?php echo base_url().'komplain/json_monthly_chart'; ?>",
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
                    set_chart_monthly_response(mdata);
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

        function reset_chart_daily_acc(){
            $('.start-daily-date-acc').val('');
            $('.end-daily-date-acc').val('');
            chart_awal_daily_acc.destroy();
            load_chart_daily_acc();
        }

        function reset_chart_weekly_acc(){
            $('.pilih-bulan-weekly-acc').val('01');
            chart_awal_weekly_acc.destroy();
            load_chart_weekly_acc();
        }

        function reset_chart_monthly_acc(){
            $('.pilih-tahun-monthly-acc').val('2021');
            chart_awal_monthly_acc.destroy();
            load_chart_monthly_acc();
        }

         function reset_chart_daily_response(){
            $('.start-daily-date-response').val('');
            $('.end-daily-date-response').val('');
            chart_awal_daily_response.destroy();
            load_chart_daily_response();
        }

        function reset_chart_weekly_response(){
            $('.pilih-bulan-weekly-response').val('01');
            chart_awal_weekly_response.destroy();
            load_chart_weekly_response();
        }

        function reset_chart_monthly_response(){
            $('.pilih-tahun-monthly-response').val('2021');
            chart_awal_monthly_response.destroy();
            load_chart_monthly_response();
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

        function load_product(){
            google.charts.load('current', {'packages':['timeline']});
            google.charts.setOnLoadCallback(drawProduct);
        }

        function mtask(id){
            $('#grantModal #id_request').val(id);
            $('#grantModal').modal('show');
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

        $(document).ready(function() {
            load_product();
            
            load_chart_daily();
            load_chart_weekly();
            load_chart_monthly();

            load_chart_daily_acc();
            load_chart_weekly_acc();
            load_chart_monthly_acc();

            load_chart_daily_response();
            load_chart_weekly_response();
            load_chart_monthly_response();


            $('#myTab a').click(function(e) {
              e.preventDefault();
              $(this).tab('show');
            });

            $('#tableku').DataTable({
                stateSave: true
            });

            $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
              var id = $(e.target).attr("href").substr(1);
              window.location.hash = id;
            });

            var hash = window.location.hash;
            $('#myTab a[href="' + hash + '"]').tab('show');

            $('#myTabAcc a').click(function(e) {
              e.preventDefault();
              $(this).tab('show');
            });

            $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
              var id = $(e.target).attr("href").substr(1);
              window.location.hash = id;
            });

            var hash = window.location.hash;
            $('#myTabAcc a[href="' + hash + '"]').tab('show');

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

            $( "#grantModal" ).on('shown.bs.modal', function(){
                drawChart();
            });

            $('.btn-search-daily').click(function(event) {
                /* Act on the event */
                let date_start = $('.start-daily-date').val();
                let date_end = $('.end-daily-date').val();
                var data_new = '';

                $.ajax({
                    url: "<?php echo base_url().'sample/json_daily_range'; ?>",
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
                    url: "<?php echo base_url().'sample/json_weekly_range'; ?>",
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
                    url: "<?php echo base_url().'sample/json_monthly_range'; ?>",
                    type: 'POST',
                    dataType: 'json',
                    data: {tahun: tahun},
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
                        chart_awal_monthly.destroy();
                        set_chart_monthly(mdata);
                    }
                });
            });

            $('.btn-search-daily-acc').click(function(event) {
            /* Act on the event */
            let date_start = $('.start-daily-date-acc').val();
            let date_end = $('.end-daily-date-acc').val();
            var data_new = '';

            $.ajax({
                url: "<?php echo base_url().'sample/json_daily_range_acc'; ?>",
                type: 'POST',
                dataType: 'json',
                data: {start: date_start, end: date_end},
                success: function(data){
                    if (data.length > 30) {
                        alert('Maksimal range satu bulan !');
                        $('.start-daily-date-acc').val('');
                        $('.end-daily-date-acc').val('');
                        reset_chart_daily_acc();
                    }else{
                        chart_awal_daily_acc.destroy();
                        set_chart_daily_acc(data);
                        // console.log(data);
                    }
                }
                });
            });

            $('.btn-search-weekly-acc').click(function(event) {
                /* Act on the event */
                let bulan = $('.pilih-bulan-weekly-acc').val();
                let tahun = $('.pilih-tahun-weekly-acc').val();
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
                            chart_awal_weekly_acc.destroy();
                            set_chart_weekly_acc(data_new);
                        }
                    }
                });
            });

            $('.btn-search-monthly-acc').click(function(event) {
                /* Act on the event */
                let tahun = $('.pilih-tahun-monthly-acc').val();
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
                        chart_awal_monthly_acc.destroy();
                        set_chart_monthly_acc(mdata);
                    }
                });
            });

            $('.btn-search-daily-response').click(function(event) {
            /* Act on the event */
            let date_start = $('.start-daily-date-response').val();
            let date_end = $('.end-daily-date-response').val();
            var data_new = '';

            $.ajax({
                url: "<?php echo base_url().'komplain/json_daily_range'; ?>",
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
                    url: "<?php echo base_url().'komplain/json_weekly_range'; ?>",
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
                    url: "<?php echo base_url().'komplain/json_monthly_range'; ?>",
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

            $('.btn-refresh-daily-acc').click(function(event) {
            /* Act on the event */
                reset_chart_daily_acc();
            });

            $('.btn-refresh-weekly-acc').click(function(event) {
                /* Act on the event */
                reset_chart_weekly_acc();
            });

            $('.btn-refresh-monthly-acc').click(function(event) {
                /* Act on the event */
                reset_chart_monthly_acc();
            });

            $('.btn-refresh-daily-response').click(function(event) {
            /* Act on the event */
                reset_chart_daily_response();
            });

            $('.btn-refresh-weekly-response').click(function(event) {
                /* Act on the event */
                reset_chart_weekly_response();
            });

            $('.btn-refresh-monthly-response').click(function(event) {
                /* Act on the event */
                reset_chart_monthly_response();
            });
        });
    </script>

</body>

</html>