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
                <h1 class="h4 mb-2 text-gray-800">Buat Biaya Baru</h1><hr>
                <form action="<?php echo base_url().'biaya/simpan' ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    <div class="form-group">
                        <label for="akun_keuangan">Akun Keuangan</label>
                        <select name="akun_keuangan" class="form-control" required="">
                            <option disabled selected>Tidak Ada Akun Beban yang dipilih</option>
                            <option value="-Bank">-Bank</option>
                            <option value="-Kas Kecil">-Kas Kecil</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_biaya">Nama Biaya</label>
                        <input type="text" name="nama_biaya" class="form-control" required="" placeholder="Masukkan nama biaya...">    
                    </div>
                    <div class="form-group">
                        <label for="vendor">Vendor</label>
                        <input type="text" name="vendor" class="form-control" required="" placeholder="Masukkan nama vendor...">    
                    </div>
                    <div class="form-group">
                        <label for="akun_beban">Akun Beban</label>
                        <select name="akun_beban" class="form-control" required="">
                            <option disabled selected>Tidak Ada Akun Beban yang dipilih</option>
                            <option value="6301-Beban Komisi Penjualan">6301-Beban Komisi Penjualan</option>
                            <option value="5101-Harga Pokok Penjualan">5101-Harga Pokok Penjualan</option>
                            <option value="5102-Beban Pengiriman">5102-Beban Pengiriman</option>
                            <option value="8120-Kerugian Selisih Kurs">8120-Kerugian Selisih Kurs</option>
                            <option value="6802-Beban Penyusutan Peralatan">6802-Beban Penyusutan Peralatan</option>
                            <option value="5103-Beban Pembelian">5103-Beban Pembelian</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" placeholder="Pilih tanggal" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <input type="text" name="kategori" class="form-control" required="" placeholder="Masukkan kategori biaya...">    
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" required="" placeholder="Masukkan isi nominal transaksi...">    
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" required="" placeholder="Masukkan keterangan biaya...">    
                    </div>
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