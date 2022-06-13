<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline</title>
    <?php $this->load->view('partials/head', FALSE); ?>
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <!-- Topbar Navbar -->
                <img src="<?= base_url().'assets/img/logo.jpg' ?>" alt="logo" width="150px">
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                <div class="row">
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <label><b>Nama Produk :</b> <?= $produk->usulan_nama_produk ?></label>
                                    <label class="float-right"><b>Target Launching :</b> <?= date('d/m/Y', strtotime($produk->target_launching)) ?></label>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <div id="chart_div" style="height: 520px;"></div>
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
             <!-- End Footer -->
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

   <?php $this->load->view('partials/js', FALSE); ?>

    <!-- google chart -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">

        google.charts.load('current', {'packages':['timeline']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var container = document.getElementById('chart_div');
            var chart = new google.visualization.Timeline(container);
            var data = new google.visualization.DataTable();
            let id =  "<?= $id ?>";
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
                url: "<?= base_url().'product/detail' ?>",
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

        $(document).ready(function() {
            drawChart();
        });
    </script>

</body>
</html>