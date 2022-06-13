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
                    <!-- <h1 class="h5 mb-2 text-gray-800">Tolak Purchase Order</h1> -->

                   <!--  <div class="card shadow mb-4">
                        <div class="card-body">
                            <form action="<?php echo base_url().'Approval/simpan_tolak' ?>" method="post" accept-charset="utf-8">
                                <table class="table" width="100%" cellspacing="0">
                                <?php foreach ($detail_po as $value) {
                                ?>
                                <tr>
                                    <input type="hidden" name="id_po" value="<?php echo $value->id_po; ?>">
                                    <td class="text-primary"><b>No. Purchase Order</b></td>
                                </tr>
                                <tr>
                                    <td class="text-gray"><?php echo $value->no_po; ?></td>
                                </tr>
                                <?php
                                } ?>
                                <tr>
                                    <td class="text-primary"><b>Tambahkan Keterangan Penolakan</b></td>
                                </tr>
                                <tr>
                                    <td><textarea name="keterangan" rows="4" class="form-control" placeholder="Masukkan keterangan penolakan..." required=""></textarea></td>
                                </tr>
                                <tr>
                                    <td> <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                    <a  href="<?php echo base_url().'Approval/index' ?>" class="btn btn-sm btn-secondary">Batal</a></td>
                                </tr>
                            </table>
                            </form>
                        </div>
                    </div> -->

                    <!-- Page Heading -->
                    <h1 class="h5 mb-2 text-gray-800">Detail Purchase Order</h1>
                    <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <!-- <label for="logo" class="text-primary"><b>Unggah Logo</b></label>
                                        <input type="file" name="logo" value="" placeholder="" class="form-control-file"> -->
                                        <img src="<?php echo base_url().'assets/img/logo.jpg' ?>" alt="" width="25%" class="">
                                    </div>
                                    <div class="col-4">
                                        <h5 class="h4 mb-2 text-primary align-left"><b>Purchase Order</b></h5>
                                        <div class="row">
                                            <div class="col-5">
                                                <p class="text-gray align-left"><b>Nomor PO<br>Tanggal PO<br>Perihal</b></p>
                                            </div>
                                            <div class="col-7">
                                                <p class="text-gray align-left">
                                                    <b>
                                                        <?php echo $detail_po->no_po; ?><br>
                                                        <?php echo date("d/m/Y",strtotime($detail_po->tanggal_po)); ?><br>
                                                        PO <?php echo strtoupper($tipe); ?>
                                                    </b>
                                                </p>
                                            </div>
                                        </div> 
                                    </div>
                                </div><br>
                                <div class="row">
                                <div class="col-6">
                                    <h1 class="h5 mb-2 text-primary"><b>Info Perusahaan</b></h1><hr>
                                    <h1 class="h5 mb-2 text-primary"><b>PT. KOSMETIKA GLOBAL INDONESIA</b></h1>
                                    <p class="text-gray align-center">
                                        Jl. Rungkut Industri III No.9, Kutisari, Kec. Tenggilis Mejoyo, Kota SBY, Jawa Timur 60291
                                    </p>
                                </div>
                                <div class="col-6">
                                    <h1 class="h5 mb-2 text-primary"><b>Order Ke</b></h1><hr>
                                    <h1 class="h5 mb-2 text-primary" id="nama_mitra"><b><?php echo $detail_po->nama_mitra; ?></b></h1>
                                    <p class="text-gray" id="telp_mitra">
                                        <?php
                                                echo $detail_po->alamat_baris_1;
                                        ?>
                                    </p>
                                    <p class="text-gray" id="email_mitra"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <p class="text-gray">Dengan hormat,<br>Berdasarkan penawaran yang telah diberikan, kami berkeinginan memesan produk dengan perincian sebagai berikut :</p>
                                </div>
                            </div>
                                
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama Produk</th>
                                                <th>Quantity</th>
                                                <th>Satuan</th>
                                                <th>Mata Uang</th>
                                                <th>Harga</th>
                                                <th>Kurs</th>
                                                <th>Harga Penawaran</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $i=1;
                                                foreach ($detail_bahan as $value) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $value->nama_produk."<br>".$value->deskripsi_produk; ?></td>
                                                    <td><?php 
                                                        $str_qtty = strval($value->kuantitas);
                                                        if (strpos($str_qtty, '.') == TRUE) {
                                                            echo $value->kuantitas;
                                                        }else{
                                                            echo number_format($value->kuantitas,0,',','.');
                                                        }
                                                    ?></td>
                                                    <td><?php echo $value->satuan; ?></td>
                                                    <td><?php echo $value->mata_uang; ?></td>
                                                    <td><?php 
                                                            if($value->mata_uang == 'Rupiah'){
                                                                echo 'Rp.'.number_format($value->harga,2,',','.');
                                                            }elseif ($value->mata_uang == 'Dollar') {
                                                                echo '$'.$value->harga;
                                                            }elseif ($value->mata_uang == 'RMB') {
                                                                echo 'RMB '.$value->harga;
                                                            }else{
                                                                echo '';
                                                            }
                                                        ?>    
                                                    </td>
                                                    <td><?php echo 'Rp.'.number_format($value->kurs,0,',','.'); ?></td>
                                                    <td>Rp.<?php echo number_format($value->jumlah,2,',','.'); ?></td>
                                                                    </tr>
                                            <?php
                                                }
                                             ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-6">&nbsp;</div>
                                    <div class="col-6">
                                        <table class="table table-sm">
                                            <tr>
                                                <td class="align-middle"><b>Subtotal</b></td>
                                                <td class="align-middle">
                                                   Rp.<?php echo number_format($detail_po->subtotal,0,',','.'); ?>
                                                </td>
                                            </tr>  
                                            <tr>
                                                <td class="align-middle"><b>Pajak(<?php echo $detail_po->jenis_pajak; ?>%)</b></td>
                                                <td class="align-middle">
                                                    Rp.<?php echo number_format($detail_po->pajak,0,',','.'); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle"><b>Total:</b></td>
                                                <td class="align-middle">
                                                    Rp.<?php echo number_format($detail_po->total_harga,0,',','.'); ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="row ml-0">
                                    <div class="col-12">
                                        <p class="text-gray">Kami sangat berharap supaya bisa menerima produk tersebut sesuai dengan waktu yangtelah ditentukan dan sesuai dengan spesifikasi yang Bapak/Ibu tawarkan.<br>Terima kasih atas Perhatian Bapak/Ibu.</p>
                                    </div>
                                </div>
                                <div class="row ml-0">
                                        <div class="col-6">
                                            <label for="catatan" class="text-primary"><b>Catatan</b></label>
                                            <!-- <textarea name="catatan" id="ckeditor" class="ckeditor"></textarea> -->
                                            <p class="text-gray"><?php echo $catatan = (empty($detail_po->catatan)) ? '-' : $detail_po->catatan; ?></p>

                                            <p class="text-gray"><b>
                                            Malang, <?php echo date("d/m/Y",strtotime($detail_po->tanggal_po));?><br>
                                            Hormat Kami,<br>
                                            </b></p>
                                            <img src="<?php echo base_url().'assets/img/ipin.JPG' ?>" width="20%" class="mb-3">
                                            <p class="text-gray">
                                                <b><u><?php echo $detail_po->nama_user; ?></u></b><br><i>Purchasing Departement</i>
                                            </p>
                                        </div>
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

    <!-- Produk Modal -->
<div class="modal fade" id="produkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Masukkan Produk</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="col-12">
                  <a href="<?php echo base_url().'Produk/tambah_produk' ?>" class="btn btn-primary btn-sm float-right mt-3">Buat Produk Baru</a>
                </div>
                <div class="modal-body">
                  <div class="table-responsive">
                    <table class="table temp-produk" id="dataTable" width="100%">
                      <thead>
                        <tr>
                          <th>Pilih</th>
                          <th>Kode Produk (SKU)</th>
                          <th>Nama Produk</th>
                          <th>Satuan</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($produk as $value) {
                        ?>
                        <tr class="item-produk">
                          <td><input type="checkbox" name="pilih[]" class="form-control" value="<?php echo $value->id_produk ?>"></td>
                          <td><?php echo $value->kode_produk; ?></td>
                          <td class="item-nama-produk"><?php echo $value->nama_produk; ?></td>
                          <td><?php echo $value->unit; ?></td>
                        </tr>
                        <?php
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary simpan-temp" type="button" data-dismiss="modal">Simpan</button>
                    <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
</div>

    <!-- Logout Modal-->
    <?php $this->load->view('partials/logout_modal', FALSE); ?>

    <?php $this->load->view('partials/js', FALSE);?>

<script>
     function status_table(){
               // var status_table = $('#dataTable tr td').length;
               if ($('#dataTable tr td').hasClass('dataTables_empty')) {
                    $('.delete-row').attr('hidden', 'true');
               }else{
                    $('.delete-row').removeAttr('hidden');

               }
    }
     $(document).ready(function() {
        status_table();

        // $(".add-row").click(function(){
        //     var markup = "<tr><td><input type='checkbox' name='record' class='form-control'></td><td><input type='text' name='kode_produk[]' placeholder='Kode Bahan Baku' required='' class='form-control'></td><td><input type='text' name='nama_produk[]' placeholder='Nama Bahan Baku' required='' class='form-control'></td><td><input type='number' name='kuantitas[]' placeholder='Jumlah' required='' class='form-control' value='0'></td><td><select name='satuan[]' class='form-control' required=''><option disabled selected>Pilih</option><option value='KG'>KG</option><option value='Gram'>Gram</option><option value='Ton'>Ton</option><option value='Pieces'>Pieces</option><option value='Set'>Set</option><option value='Unit'>Unit</option><option value='Drum'>Drum</option><option value='Roll'>Roll</option><option value='Box'>Box</option></select></td><td><select name='mata_uang[]' class='form-control'required><option disabled selected>Pilih</option><option value='Rupiah'>Rupiah (Rp)</option><option value='Dollar'>Dollar (US)</option></select></td><td><input type='number' name='harga[]' placeholder='Harga' required='' class='form-control' value=''></td><td><input type='number' name='kurs[]' placeholder='Kurs' class='form-control' required=''></td><td><select name='pajak[]' class='form-control'><option disabled selected>Pilih</option><option value='10'>Pajak(10%)</option><option value='0'>Non Pajak</option></select></td><td><input type='number' name='jumlah[]' placeholder='Jumlah' required='' class='form-control' value='0'></td></tr>";
        //     $("#data_order").html(markup);
        // });
        
        // Find and remove selected table rows
        $(".delete-row").click(function(){
            $("#dataTable").find('input[name="record"]').each(function(){
                if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                }
            });
            status_table();
        });

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

    function hitung(data) {
        var kuantitas = $('tr#id'+data).find("input[name='kuantitas[]']").val();        
        var harga = $('tr#id'+data).find("input[name='harga[]']").val();        
        var mata_uang = $('tr#id'+data).find("select[name='mata_uang[]'] option:selected").val();        
        var kurs = $('tr#id'+data).find("input[name='kurs[]']").val();
        var total = 0;
        var jumlah = $('tr#id'+data).find("input[name='jumlah[]']").val();              
        var total_beli = 0;
        
        if (mata_uang == "Dollar") {
            total = kurs*harga*kuantitas;
        }else{
            total = harga*kuantitas;
        }   
        $('tr#id'+data).find("input[name='jumlah[]']").val(total);     
        calc_total();
    }

    function calc_total(){
      var sum = 0;
      $(".total").each(function(){
        sum += parseFloat($(this).val());
      });
      $('#subtotal').val(sum);
      $('#total').val(sum);
    }

    function calc_pajak(){
      var pajak = 0;
      var jumlah_pajak = 0;
      var subtotal = 0;
      var total_harga = 0;
      $("#pilih_pajak").each(function(){
        pajak += parseFloat($(this).val());
      });
        subtotal += parseInt($('#subtotal').val());
        jumlah_pajak = subtotal*pajak/100;
        total_harga = subtotal+jumlah_pajak;
      $('#pajak').val(jumlah_pajak);
      $('#total').val(total_harga);
    }

    function clear_total(){
        $('#subtotal').val('');
        $('#pajak').val('');
        $('#total').val('');
    }

    function status_matauang(data) {  
        var mata_uang = $('tr#id'+data).find("select[name='mata_uang[]'] option:selected").val();            
        if (mata_uang == "Rupiah") {
            $('tr#id'+data).find("input[name='kurs[]']").attr('readonly', 'true');

        }else{
            $('tr#id'+data).find("input[name='kurs[]']").removeAttr('readonly');
        }        
    }

    $(function() {
        $(document).on('click', '.simpan-temp', function() {
            var values = new Array();
              $("input[name='pilih[]']:checked").each(function() {
                values.push(this.value);
                });
              $.ajax({
                  url: "<?php echo base_url('produk/get_produk') ?>",
                  type: 'POST',
                  dataType: 'JSON',
                  data: {id_produk: values},
                  success : function(res){
                        $("#data_order").html(res);
                  }
              }).then(function () {
                status_table();
                clear_total();
              })
        });
    });
</script>

</body>
</html>