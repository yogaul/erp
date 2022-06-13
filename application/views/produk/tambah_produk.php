<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Bahan Baku</title>

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
                <h1 class="h4 mb-2 text-gray-800">Buat Bahan <?php echo $this->uri->segment(3); ?></h1><hr>
                <div class="card shadow">
                    <div class="card-body">
                        <form action="<?php echo base_url().'produk/simpan_produk/'.$this->uri->segment(3) ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8" id="form-tambah-barang">
                            <div class="form-group">
                                <label for="kode_produk" class="text-primary"><b>Kode Bahan <?php echo $this->uri->segment(3); ?></b></label>
                                <input type="text" name="kode_produk" class="form-control kode-bahan" placeholder="Masukkan kode..." value="<?php echo $kode; ?>" required="">    
                            </div>
                            <div class="form-group">
                                <label for="nama_produk" class="text-primary"><b>Nama Bahan <?php echo $this->uri->segment(3); ?></b></label>
                                <input type="text" name="nama_produk" class="form-control nama-bahan" placeholder="Masukkan nama bahan">    
                            </div>
                            <div class="form-group">
                                <label for="supplier" class="text-primary"><b>Supplier</b></label>
                                <select name="supplier" class="form-control" required="" id="selectMitra">
                                    <option value="" disabled selected>Pilih supplier</option>
                                    <?php  foreach ($supplier as $value) {
                                    ?>
                                    <option value="<?php echo $value->id_mitra; ?>"><?php echo $value->nama_mitra; ?></option>
                                    <?php
                                    }?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jenis_harga" class="text-primary"><b>Mata Uang (Harga)</b></label>
                                <select name="jenis_harga" id="jenis_harga" class="form-control" onchange="ubah_jenis()" required>
                                    <option value="Rupiah">Rupiah</option>
                                    <option value="Dollar" disabled>Dollar (disabled)</option>
                                    <option value="RMB" disabled>RMB (disabled)</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="harga_bahan" class="text-primary"><b>Harga Bahan <?php echo $this->uri->segment(3); ?></b></label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text">Rp</div>
                                    </div>
                                    <input type="text" class="form-control" id="harga_bahan_modal" placeholder="Harga bahan..." onkeyup="cek_uang()">
                                    <input type="hidden" name="harga_bahan" id="harga_bahan" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="moq_bahan_modal" class="text-primary"><b>MOQ (Minimum Order Quantity)</b></label>
                                <input type="text" class="form-control" id="moq_bahan_modal" value="" placeholder="Minimum order bahan..." onkeyup="number_moq()">
                                <input type="hidden" id="moq_bahan" name="moq_bahan" value="">
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_produk" class="text-primary"><b>Deskripsi Bahan <?php echo $this->uri->segment(3); ?></b></label>
                                <textarea class="form-control deskripsi-bahan" name="deskripsi_produk" rows="4" placeholder="Deskripsi barang..."></textarea>
                            </div>
                            <div class="form-group">
                                <label for="foto_produk" class="text-primary"><b>Foto Bahan <?php echo $this->uri->segment(3); ?></b></label>
                                <input type="file" name="foto_produk" class="form-control-file">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-sm btn-primary" type="submit"><i class="fas fa-save"></i> Simpan</button>
                                <a onclick="kembali()" class="btn btn-sm btn-secondary"><i class="fas fa-times"></i> Batal</a>
                            </div>
                        </form>
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

    <script type="text/javascript">
        $(function(){
            $('#selectMitra').select2({
                theme: 'bootstrap'
            });
        });

        function kembali(){
            window.history.back();
        }

        CKEDITOR.replace('deskripsi_produk');

        function ubah_jenis(){
            var jenis_harga = $('#jenis_harga').val();
            if (jenis_harga == 'Rupiah') {
                $('.input-group-text').html('Rp');
            }else if(jenis_harga == 'Dollar'){
                $('.input-group-text').html('$');
            }else{
                $('.input-group-text').html('RMB');
            }
        }

        function cek_uang(){
            var harga_bahan_text = $('#harga_bahan_modal').val();
            var harga_bahan = $('#harga_bahan_modal').val().replace(/\./g,'').replace(/,/g, '.').toString();
            $('#harga_bahan_modal').val(kurensi_rupiah(harga_bahan_text));
            $('#harga_bahan').val(harga_bahan);
        }

        function number_moq(){
            var moq_bahan_text = $('#moq_bahan_modal').val().replace(/[^0-9]/g, '').toString(); 
            $('#moq_bahan_modal').val(moq_bahan_text.replace(/[^0-9]/g, '').toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
            $('#moq_bahan').val(moq_bahan_text);
        }

        function kurensi_rupiah(bilangan){
            var number_string = bilangan.replace(/[^,\d]/g, '').toString(),
            split   = number_string.split(','),
            sisa    = split[0].length % 3,
            rupiah  = split[0].substr(0, sisa),
            ribuan  = split[0].substr(sisa).match(/\d{1,3}/gi);
            
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return rupiah;
        }


        $(document).ready(function () {
            // $('.btn-simpan-produk').click(function (e) { 
            //     // e.preventDefault();
            //     let kode = $('.kode-bahan').val();
            //     let nama = $('.nama-bahan').val();
            //     let harga = $('#harga_bahan_modal').val();
            //     let moq = $('#moq_bahan_modal').val();
            
            //     if (kode == '') {
            //         alert('Kode bahan tidak boleh kosong !');
            //     }else if (nama == '') {
            //         alert('Nama bahan tidak boleh kosong !');
            //     }else if (harga == '') {
            //         alert('Harga bahan tidak boleh kosong !');
            //     }else if (moq == '') {
            //         alert('Moq bahan tidak boleh kosong !');
            //     }else{
            //         $.ajax({
            //             type: "POST",
            //             url: "<?php echo base_url().'produk/json_kode_produk'; ?>",
            //             data: {kode: kode},
            //             dataType: "json",
            //             success: function (response) {
            //                if (response > 0) {
            //                    alert('Kode bahan : '+kode+' sudah ada, mohon gunakan kode bahan lain !');
            //                    $('.kode-bahan').val("<?= $kode; ?>");
            //                }else{
            //                    $('#form-tambah-barang').submit();
            //                }
            //             }
            //         });
            //     }


            // });
        });
    </script>

</body>
</html>