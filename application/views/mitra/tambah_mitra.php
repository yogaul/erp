<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Supplier</title>

    <?php $this->load->view('partials/head', FALSE);?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
            if ($this->session->userdata('level') == 'direktur') {
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
                <h1 class="h4 mb-2 text-gray-800">Buat Supplier Baru</h1>
                <form action="<?php echo base_url().'mitra/simpan_mitra' ?>" method="post" accept-charset="utf-8">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6"><h1 class="h5 text-primary"><b>Informasi Umum Supplier</b></h1></div>
                            </div><hr>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="tipe_mitra" class="text-primary"><b>Tipe Supplier</b></label>
                                        <!-- <select name="tipe_mitra" class="form-control" required="">
                                            <option value="Kemas">Kemas</option>
                                            <option value="Bahan Baku">Bahan Baku</option>
                                            <option value="Teknik">Teknik</option>
                                        </select>     -->
                                        <input type="text" name="tipe_mitra" readonly="" class="form-control" value="<?php echo $jenis = ($this->uri->segment(3) == 'Baku') ? 'Bahan Baku' : $this->uri->segment(3); ?>">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="no_mitra" class="text-primary"><b>Kode Supplier</b></label>
                                        <input type="text" name="no_mitra" class="form-control" readonly="" placeholder="Masukkan kode supplier..." value="<?php echo $kode; ?>">    
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="badan_usaha" class="text-primary"><b>Badan Usaha</b></label>
                                        <select name="badan_usaha" class="form-control" required="">
                                            <option value="PT">PT</option>
                                            <option value="CV">CV</option>
                                            <option value="Perorangan">Perorangan</option>
                                        </select>    
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nama_mitra" class="text-primary"><b>Nama Supplier</b></label>
                                        <input type="text" name="nama_mitra" class="form-control" required="" placeholder="Masukkan nama supplier..." required="">    
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email_mitra" class="text-primary"><b>E-Mail Supplier</b></label>
                                        <input type="email" name="email_mitra" class="form-control" placeholder="Masukkan alamat e-mail...">    
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="telp_mitra" class="text-primary"><b>Telepon</b></label>
                                        <input type="text" name="telp_mitra" class="form-control" placeholder="Masukkan nomor telepon...">    
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="telp_seluler" class="text-primary"><b>Telp. Seluler</b></label>
                                        <input type="text" name="telp_seluler" class="form-control" placeholder="Masukkan nomor telepon seluler...">    
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="web_mitra" class="text-primary"><b>Alamat Web</b></label>
                                        <input type="text" name="web_mitra" class="form-control" placeholder="Masukkan alamat website...">    
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="catatan_mitra" class="text-primary"><b>Catatan</b></label>
                                        <textarea name="catatan_mitra" placeholder="Masukkan catatan..." rows="4" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="kode_virtual" class="text-primary"><b>Kode Virtual</b></label>
                                        <input type="number" name="kode_virtual" class="form-control" placeholder="Masukkan kode virtual...">    
                                    </div>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-6"><h1 class="h5 text-primary"><b>Informasi Alamat Supplier</b></h1></div>
                            </div><hr>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="alamat_satu" class="text-primary"><b>Alamat Baris 1</b></label>
                                        <input type="text" name="alamat_satu" class="form-control" placeholder="Masukkan alamat...">    
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="alamat_dua" class="text-primary"><b>Alamat Baris 2 (Opsional)</b></label>
                                        <input type="text" name="alamat_dua" class="form-control" placeholder="Masukkan alamat...">    
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="kota_mitra" class="text-primary"><b>Kota/Kabupaten</b></label>
                                        <input type="text" name="kota_mitra" class="form-control" placeholder="Masukkan kota/kabupaten...">    
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="provinsi" class="text-primary"><b>Provinsi</b></label>
                                        <input type="text" name="provinsi" class="form-control" placeholder="Masukkan provinsi...">    
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="kode_pos" class="text-primary"><b>Kode Pos</b></label>
                                        <input type="number" name="kode_pos" class="form-control" placeholder="Masukkan kode pos...">    
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="negara" class="text-primary"><b>Negara</b></label>
                                        <input type="text" name="negara" class="form-control" placeholder="Masukkan negara...">    
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="kirim_info" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                <a class="btn btn-sm btn-secondary" onclick="kembali()"><i class="fa fa-times"></i> Batal</a>
                            </div>  
                        </div>
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

    <script type="text/javascript">
        function kembali() {
            window.history.back();
        }
    </script>

</body>

</html>