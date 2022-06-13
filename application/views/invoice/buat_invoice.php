<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Invoice</title>

    <?php $this->load->view('partials/head', FALSE); ?>
    
    <script src="https://cdn.ckeditor.com/4.16.0/basic/ckeditor.js"></script>

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
    $(document).ready(function(){
        $(".add-row").click(function(){
            var markup = "<tr><td><input type='checkbox' name='record' class='form-control'></td><td><input type='text' name='nama_produk' placeholder='Nama Produk' required='' class='form-control'></td><td><input type='text' name='deskripsi_produk' placeholder='Deskripsi Produk' required='' class='form-control'></td><td><input type='number' name='kuantitas' placeholder='Jumlah' required='' class='form-control' value='0'></td><td><input type='number' name='harga' placeholder='Harga' required='' class='form-control' value='0'></td><td><input type='text' name='diskon' placeholder='' required='' class='form-control' value='0%'></td><td><select name='pajak' class='form-control'><option value='PPH 23 Non NPWP'>PPH 23 Non NPWP</option><option value='PPH 23 NPWP 2%'>PPH 23 NPWP 2%</option><option value='PPH 23 NPWP 2%'>PPN 10% EXCLUSIVE</option><option value='PPH 23 NPWP 2%'>PPN 10% INCLUSIVE</option></select></td><td><input type='number' name='jumlah' placeholder='Jumlah' required='' class='form-control' value='0'></td></tr>";
            $("#dataTable").append(markup);
        });
        
        // Find and remove selected table rows
        $(".delete-row").click(function(){
            $("#dataTable").find('input[name="record"]').each(function(){
                if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                }
            });
        });
    });    
</script>
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
                    <h1 class="h4 mb-2 text-gray-800">Buat Invoice Pembelian</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                            <div class="row">
                                <div class="col-9">
                                    <label for="logo" class="text-primary"><b>Unggah Logo</b></label>
                                    <input type="file" name="logo" value="" placeholder="" class="form-control-file">
                                </div>
                                <div class="col-3">
                                    <h1 class="h4 mb-2 text-primary float-right">Invoice Pembelian</h1>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-6">
                                    <p class="text-primary"><b>Mata Uang</b></p>
                                    <p class="text-gray">Rupiah(Rp)</p>
                                </div>
                                <div class="col-6">
                                    <label for="tgl_invoice" class="text-primary"><b>Tgl. Invoice</b></label>
                                    <input type="date" name="tgl_invoice" required="" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="no_invoice" class="text-primary"><b>No. Invoice</b></label>
                                    <input type="text" name="no_invoice" required="" class="form-control" value="EXP/2021/0003">
                                </div>
                                <div class="col-6">
                                    <label for="tgl_jatuh_tempo" class="text-primary"><b>Tgl. Jatuh Tempo</b></label>
                                    <input type="date" name="tgl_jatuh_tempo" required="" class="form-control">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-6">&nbsp;</div>
                                <div class="col-6">
                                    <label for="mitra" class="text-primary"><b>Pemasok</b></label>
                                    <select name="mitra" required="" class="form-control" id="mitra">
                                        <option value="" disabled selected>Pilih mitra</option>
                                        <?php foreach ($mitra as $key) {
                                        ?>
                                        <option value="<?php echo $key->id_mitra ?>"><?php echo $key->nama_mitra ?></option>
                                        <?php
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-10">&nbsp;</div>
                                <div class="col-2">
                                    <a href="<?php echo base_url().'Mitra/tambah_mitra' ?>" class="btn btn-sm btn-primary float-right">Buat Mitra Baru</a>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-6">
                                    <h1 class="h5 mb-2 text-primary">Info Perusahaan</h1><hr>
                                    <h1 class="h5 mb-2 text-primary">Kosmetika Global</h1>
                                    <p class="text-gray"><?php echo $this->session->userdata('email_user'); ?></p>
                                </div>
                                <div class="col-6">
                                    <h1 class="h5 mb-2 text-primary">Info Pemasok</h1><hr>
                                    <h1 class="h5 mb-2 text-primary" id="nama_mitra">&nbsp;</h1>
                                    <p class="text-gray" id="telp_mitra"></p>
                                    <p class="text-gray" id="email_mitra"></p>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Pilih</th>
                                            <th>Produk</th>
                                            <th>Deskripsi</th>
                                            <th>Kuantitas</th>
                                            <th>Harga</th>
                                            <th>Diskon</th>
                                            <th>Pajak</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="checkbox" name="record" class="form-control"></td>
                                            <td><input type="text" name="nama_produk" placeholder="Nama Produk" required="" class="form-control"></td>
                                             <td><input type="text" name="deskripsi_produk" placeholder="Deskripsi Produk" required="" class="form-control"></td>
                                             <td><input type="number" name="kuantitas" placeholder="Jumlah" required="" class="form-control" value="0" id="kuantitas"></td>
                                             <td><input type="number" name="harga" placeholder="Harga" required="" class="form-control" value="0"></td>
                                             <td><input type="text" name="diskon" placeholder="" required="" class="form-control" value="0%"></td>
                                             <td>
                                                <select name="pajak" class="form-control">
                                                    <option value="PPH 23 Non NPWP">PPH 23 Non NPWP</option>
                                                    <option value="PPH 23 NPWP 2%">PPH 23 NPWP 2%</option>
                                                    <option value="PPH 23 NPWP 2%">PPN 10% EXCLUSIVE</option>
                                                    <option value="PPH 23 NPWP 2%">PPN 10% INCLUSIVE</option>
                                                </select>
                                             </td>
                                             <td><input type="number" name="jumlah" placeholder="Jumlah" required="" class="form-control" value="0"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <button class="btn btn-sm btn-success add-row">Tambah Baris</button>
                                <button class="btn btn-sm btn-danger delete-row">Hapus Baris</button>
                                <a class="btn btn-sm btn-primary ml-0" href="#" data-toggle="modal" data-target="#produkModal">Masukkan Produk ke Invoice</a>
                            </div>
                            <div class="row">
                                <div class="col-6">&nbsp;</div>
                                <div class="col-6">
                                    <table class="table">
                                        <tr>
                                            <td><b>Subtotal</b></td>
                                            <td id="subtotal">0.00</td>
                                        </tr>
                                        <tr>
                                            <td><b>Total Diskon</b></td>
                                            <td id="total_diskon">0.00</td>
                                        </tr>
                                        <tr>
                                            <td><b>Diskon Tambahan</b></td>
                                            <td id="diskon_tambahan">(0)</td>
                                        </tr>
                                        <tr>
                                            <td><b>Pajak</b></td>
                                            <td id="pajak">0.00</td>
                                        </tr>
                                        <tr>
                                            <td><b>Total:</b></td>
                                            <td id="total">0.00</td>
                                        </tr>
                                    </table>
                                </div>
                            </div><br>
                            <div class="row ml-0">
                                    <div class="col-6">
                                        <label for="catatan" class="text-primary"><b>Catatan</b></label>
                                        <!-- <textarea name="catatan" id="ckeditor" class="ckeditor"></textarea> -->
                                        <textarea name="catatan" rows="4" class="form-control" placeholder="Tambahkan catatan..."></textarea><br>
                                        <!-- <script>
                                                CKEDITOR.replace( 'catatan' );
                                        </script> -->
                                        <label for="syarat" class="text-primary"><b>Syarat & Ketentuan</b></label>
                                        <!-- <textarea name="catatan" id="ckeditor" class="ckeditor"></textarea> -->
                                        <textarea name="syarat" class="form-control" rows="4" placeholder="Termin pembayaran,garansi,dll."></textarea>
                                        <!-- <script>
                                                CKEDITOR.replace( 'syarat' );
                                        </script> -->
                                    </div>
                                    <div class="col-6">
                                        <label for="ttd" class="text-primary"><b>Tanda Tangan dan Materai (Optional)</b></label>
                                        <input type="text" name="tanggal_ttd" required="" class="form-control" value="<?php 
                                            $monthNum = date('m');
                                            $monthName = date('F',mktime(0,0,0,$monthNum,10));

                                            echo date('d').'/'.$monthName.'/'.date('Y');
                                            // echo date('d/m/Y');
                                         ?>"><hr><br><br><br>

                                         <!-- Unggah TTD Invoice -->
                                          <label for="img_ttd" class="text-primary"><b>Unggah Tanda Tangan</b></label>
                                          <input type="file" name="img_ttd" class="form-control-file"><br><br><br><br>
                                          <input type="text" name="finance" value="Finance" required="" class="form-control">
                                          <hr>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-6">&nbsp;</div>
                                <div class="col-6">
                                     <a href="<?php echo base_url().'Invoice/index' ?>" class="btn btn-sm btn-danger float-right"> Batal</a>
                                    <div class="dropdown show">
                                      <a class="btn btn-sm btn-primary dropdown-toggle float-right mr-1" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Simpan Invoice Pembelian
                                      </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a href="#" class="dropdown-item"><i class="far fa-check-circle"></i> Simpan dan Konfirmasi</a>
                                        <a href="#!" class="dropdown-item"><i class="far fa-folder"></i> Simpan Draft</a>
                                    </div>
                                    </div>
                                </div>
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

<script>
    $(document).ready(function() {
        
        $('#mitra').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?php echo base_url('mitra/get_json_mitra'); ?>",
                method: 'POST',
                dataType: 'json',
                data: {id: id},
                async: true,
                success: function(data){
                    $.each(data, function(i, data) {
                        $('#nama_mitra').html(data.nama_mitra);
                        $('#telp_mitra').html(data.telp_mitra);
                        $('#email_mitra').html(data.email_mitra);
                    });
                }
            });
            return false;
        });

    });

    // $('#kuantitas').bind('', eventData, function(event) {
    //     /* Act on the event */
    // });

    $(function() {
        $(document).on('click', '.simpan-temp', function() {
            // event.preventDefault();
            /* Act on the event */
            // var getSelectedRows = $('.temp-produk input:checked').parents('td').clone().appendTo($('#dataTable tbody').add(getSelectedRows));
            var values = new Array();
            $.each($("input[name='pilih[]']:checked").closest("td").siblings("td"),
                  function () {
                       values.push($(this).text());
                  });
        
            console.log(values);

        });
    });

</script>

</body>
</html>