<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Produk</title>

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
                <h1 class="h4 mb-2 text-gray-800">Ubah <?php foreach ($produk as $value) {
                    echo $value->kategori_produk;
                } ?></h1><hr>
                <div class="card shadow">
                    <div class="card-body">
                        <form action="<?php echo base_url().'produk/update_produk' ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                            <?php foreach ($produk as $key) {
                            ?>
                            <input type="hidden" name="id_produk" value="<?php echo $key->id_produk; ?>">
                            <div class="form-group">
                                <label for="kode_produk" class="text-primary"><b>Kode Bahan <?php echo $key->kategori_produk; ?></b></label>
                                <input type="text" name="kode_produk" class="form-control" placeholder="Masukkan kode produk..." value="<?php echo $key->kode_produk; ?>" required="">    
                            </div>
                            <div class="form-group">
                                <label for="nama_produk" class="text-primary"><b>Nama Bahan <?php echo $key->kategori_produk; ?></b></label>
                                <input type="text" name="nama_produk" class="form-control" placeholder="Masukkan nama produk..." value="<?php echo $key->nama_produk; ?>">    
                            </div>
                            <div class="form-group">
                                <label for="supplier" class="text-primary"><b>Supplier</b></label>
                                <select name="supplier" class="form-control" required="" id="selectMitra">
                                    <?php  foreach ($supplier as $value) {
                                    ?>
                                    <option value="<?php echo $value->id_mitra; ?>" <?php if($key->id_mitra == $value->id_mitra){echo 'selected';} ?>>
                                        <?php echo $value->nama_mitra; ?></option>
                                    <?php
                                    }?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jenis_harga" class="text-primary"><b>Mata Uang (Harga)</b></label>
                                <select name="jenis_harga" id="jenis_harga" class="form-control" onchange="ubah_jenis()" required>
                                    <option value="Rupiah" <?php if($key->jenis_harga == 'Rupiah'){echo 'selected';} ?>>Rupiah</option>
                                    <option value="Dollar" <?php if($key->jenis_harga == 'Dollar'){echo 'selected';} ?>>Dollar</option>
                                    <option value="RMB" <?php if($key->jenis_harga == 'RMB'){echo 'selected';} ?>>RMB</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="harga_bahan" class="text-primary"><b>Harga Bahan <?php echo $key->kategori_produk; ?></b></label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text">Rp</div>
                                    </div>
                                    <input type="text" class="form-control" id="harga_bahan_modal" placeholder="Harga bahan..." onkeyup="cek_uang()" value="<?php echo $key->harga_bahan; ?>">
                                    <input type="hidden" name="harga_bahan" id="harga_bahan" value="<?php echo $key->harga_bahan; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="moq_bahan_modal" class="text-primary"><b>MOQ (Minimum Order Quantity)</b></label>
                                <input type="text" class="form-control" id="moq_bahan_modal" placeholder="Minimum order bahan..." onkeyup="number_moq()" value="<?php echo number_format($key->moq_bahan,0,'.','.'); ?>">
                                <input type="hidden" id="moq_bahan" name="moq_bahan" value="<?php echo $key->moq_bahan; ?>">
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_produk" class="text-primary"><b>Deskripsi Produk</b></label>
                                <textarea class="form-control" name="deskripsi_produk" rows="4" placeholder="Tambahkan deskripsi barang..."><?php echo $key->deskripsi_produk; ?></textarea>
                            </div>
                            <!-- <div class="form-group">
                                <label for="kategori_produk">Kategori Produk</label>
                                <select name="kategori_produk" class="form-control">
                                    <?php 
                                        if ($key->id_kategori == '1') {
                                    ?>
                                            <option value="1" <?php echo 'selected'; ?>>Tidak ada kategori</option>
                                    <?php
                                        }else{
                                            foreach ($produk as $key_kategori) {
                                    ?>
                                             <option value="<?php echo $key_kategori->id_kategori;?>" 
                                                <?php if($key->nama_kategori == $key_kategori->nama_kategori){
                                                    echo 'selected';
                                                } ?>><?php echo $key->nama_kategori ?>    
                                                </option>
                                    <?php
                                            }
                                        }
                                     ?>
                                </select>
                            </div> -->
                            <!-- <div class="form-group">
                                <label for="unit">Satuan</label>
                                <select name="unit" class="form-control" required="">
                                    <option disabled selected>Pilih</option>
                                    <option value="KG" <?php if($key->unit == 'KG'){echo 'selected';} ?>>KG</option>
                                    <option value="Gram" <?php if($key->unit == 'Gram'){echo 'selected';} ?>>Gram</option>
                                    <option value="Ton" <?php if($key->unit == 'Ton'){echo 'selected';} ?>>Ton</option>
                                    <option value="Pieces" <?php if($key->unit == 'Pieces'){echo 'selected';} ?>>Pieces</option>
                                    <option value="Set" <?php if($key->unit == 'Set'){echo 'selected';} ?>>Set</option>
                                    <option value="Unit" <?php if($key->unit == 'Unit'){echo 'selected';} ?>>Unit</option>
                                    <option value="Drum" <?php if($key->unit == 'Drum'){echo 'selected';} ?>>Drum</option>
                                    <option value="Roll" <?php if($key->unit == 'Roll'){echo 'selected';} ?>>Roll</option>
                                    <option value="Box" <?php if($key->unit == 'Box'){echo 'selected';} ?>>Box</option>
                                </select>
                            </div> -->
                            <!-- <div class="form-group">
                                <label for="harga_beli">Harga Beli</label>
                                <input type="number" name="harga_beli" class="form-control" required="" placeholder="Masukkan harga beli..." value="<?php echo $key->harga_beli; ?>">    
                            </div>
                            <div class="form-group">
                                <label for="harga_jual">Harga Jual</label>
                                <input type="number" name="harga_jual" class="form-control" required="" placeholder="Masukkan harga jual..." value="<?php echo $key->harga_jual; ?>">    
                            </div> -->
                            <!-- <div class="form-group">
                                <label for="track_stok">Track Stok</label>
                                <select class="form-control" name="track_stok">
                                    <option value="on" <?php if($key->track_stok == 'on'){echo 'selected';} ?>>On</option>
                                    <option value="off" <?php if($key->track_stok == 'off'){echo 'selected';} ?>>Off</option>
                                </select>
                            </div> -->
                            <div class="form-group">
                                <label for="foto_produk" class="text-primary"><b>Foto Produk</b></label>
                                <input type="file" name="foto_produk" class="form-control-file">
                                <input type="hidden" name="old_image" value="<?php echo $key->foto_produk ?>">
                            </div>
                            <?php
                            } ?>
                            <div class="form-group">
                                <button class="btn btn-sm btn-primary" type="submit"><i class="fas fa-save"></i> Simpan</button>
                                <a class="btn btn-sm btn-secondary" onclick="kembali()"><i class="fas fa-times"></i> Batal</a>
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

        function number_moq(){
            var moq_bahan_text = $('#moq_bahan_modal').val().replace(/[^0-9]/g, '').toString(); 
            $('#moq_bahan_modal').val(moq_bahan_text.replace(/[^0-9]/g, '').toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
            $('#moq_bahan').val(moq_bahan_text);
        }
    </script>

</body>

</html>