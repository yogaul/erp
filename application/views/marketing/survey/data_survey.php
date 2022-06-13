<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Survey</title>

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
            }elseif ($this->session->userdata('level') == 'direktur') {
                $this->load->view('partials/sidebar_direktur', FALSE);
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
                    <h1 class="h4 mb-2 text-gray-800">Hasil Survey Maklon</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="<?php echo base_url().'export/eks_survey' ?>" class="btn btn-sm btn-success"><i class="fas fa-file-export"></i> Export Excel</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal</th>
                                            <th>Email</th>
                                            <th>Nama Cust</th>
                                            <th>Telp</th>
                                            <th>Alamat</th>
                                            <th>Produk Order</th>
                                            <th>Status</th>
                                            <th>Brand</th>
                                            <th>Estimasi Launching</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 1;
                                            foreach ($data as $value) {
                                        ?>
                                        <tr>
                                            <td><?php echo $no++; ?>.</td>
                                            <td><?= (!is_null($value->tanggal_survey)) ? date('d/m/Y H:i:s', strtotime($value->tanggal_survey)) : '-' ?></td>
                                            <td><?php echo $value->email_cust_survey; ?></td>
                                            <td><?php echo $value->nama_cust_survey; ?></td>
                                            <td><?php echo $value->telp_cust_survey; ?></td>
                                            <td><?php echo $value->alamat_cust_survey; ?></td>
                                            <td><?php echo $value->order_cust_survey; ?></td>
                                            <td><?php echo $value->status_cust_survey; ?></td>
                                            <td><?php echo $value->brand_cust_survey; ?></td>
                                            <td>
                                                <?php
                                                    if ($value->estimasi_launch_survey == '0000-00-00') {
                                                        echo '-';
                                                    }else{
                                                        echo date('d/m/Y',strtotime($value->estimasi_launch_survey)); 
                                                    }
                                                ?>
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

    <!-- load js -->
    <?php $this->load->view('partials/js', FALSE);?>

<script>
    function deleteConfirm(url){
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }
</script>

</body>
</html>