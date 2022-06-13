<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Biaya</title>

    <?php $this->load->view('partials/head', FALSE);?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view('partials/sidebar', FALSE);?>
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
                <h1 class="h4 mb-2 text-gray-800">Tambah Lampiran Biaya</h1><hr>
                <form action="<?php echo base_url().'lampiran/simpan' ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    <input type="hidden" name="id_biaya" value="<?php echo $this->uri->segment(3); ?>">
                    <div class="form-group">
                        <label for="no_lampiran">No. Lampiran</label>
                        <input type="text" name="no_lampiran" placeholder="Masukkan nomor lampiran..." required="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="keterangan_lampiran">Keterangan</label>
                        <input type="text" name="keterangan_lampiran" placeholder="Masukkan keterangan lampiran..." required="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="file">File Lampiran</label>
                        <input type="file" name="file" value="" placeholder="" class="form-control-file" required="">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Upload</button>
                    </div>
                </form>
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