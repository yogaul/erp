<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Order</title>

    <?php $this->load->view('partials/head', FALSE); ?>
    
    <script src="https://cdn.ckeditor.com/4.16.0/basic/ckeditor.js"></script>

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
            if ($this->session->userdata('level') == 'direktur' || $this->session->userdata('level') == 'spv_purchasing') {
                $this->load->view('partials/sidebar_direktur', FALSE);
            }elseif($this->session->userdata('level') == 'purchasing'){
                $this->load->view('partials/sidebar', FALSE);
            }elseif($this->session->userdata('level') == 'ppic'){
                $this->load->view('partials/sidebar_ppic', FALSE);
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
                    <h1 class="h5 mb-2 text-gray-800">Info Approval Purchase Order</h1>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <table class="table" width="100%">
                                <tr>
                                    <td class="text-primary"><b>Status Approval</b></td>
                                </tr>
                                <tr>
                                    <td class="text-gray"><?php echo $detail_po->status_po; ?></td>
                                </tr>
                                 <tr>
                                    <td class="text-primary"><b>Catatan Approval</b></td>
                                </tr>
                                <tr>
                                    <td class="text-gray"><?php if(empty($detail_po->catatan_approve)){
                                        echo '-';
                                    }else{echo $detail_po->catatan_approve;}?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Page Heading -->
                    <h1 class="h5 mb-2 text-gray-800">Detail Purchase Order</h1>
                    <!-- DataTales Example -->
                    <?php 
                        $this->load->view('partials/view_order', FALSE);
                    ?>
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
</body>
</html>