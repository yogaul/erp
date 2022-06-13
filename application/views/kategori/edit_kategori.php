<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Kategori</title>

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
                <h1 class="h4 mb-2 text-gray-800">Ubah Kategori</h1><hr>
                <form action="<?php echo base_url().'kategori/ubah' ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    <?php foreach ($kategori as $key) {
                    ?>
                    <input type="hidden" name="id_kategori" value="<?php echo $key->id_kategori; ?>">
                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control" required="" placeholder="Masukkan nama kategori..." value="<?php echo $key->nama_kategori; ?>">    
                    </div>
                    <div class="form-group">
                        <label for="kategori_induk">Kategori Induk</label>
                        <select name="kategori_induk" class="form-control">
                            <option value="" disabled selected>Pilih kategori induk</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi_kategori">Deskripsi Kategori</label>
                        <input type="text" name="deskripsi_kategori" class="form-control" required="" placeholder="Masukkan deskripsi kategori..." value="<?php echo $key->deskripsi_kategori; ?>">    
                    </div>
                    <?php
                    } ?>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Simpan</button>
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