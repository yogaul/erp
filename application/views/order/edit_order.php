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
                    <h1 class="h5 mb-2 text-gray-800">Info Approval Purchase Order</h1>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <table class="table" width="100%">
                                <?php foreach ($detail_po as $value) {
                                ?>
                                <tr>
                                    <td class="text-primary"><b>Status Approval</b></td>
                                </tr>
                                <tr>
                                    <td class="text-gray"><?php echo $value->status_po; ?></td>
                                </tr>
                                 <tr>
                                    <td class="text-primary"><b>Catatan Approval</b></td>
                                </tr>
                                <tr>
                                    <td class="text-gray"><?php if(empty($value->catatan_approve)){
                                        echo '-';
                                    }else{echo $value->catatan_approve;}?></td>
                                </tr>
                                <?php
                                } ?>
                            </table>
                        </div>
                    </div>

                    <!-- Page Heading -->
                    <h1 class="h5 mb-2 text-gray-800">Ubah Purchase Order</h1>
                    <!-- DataTales Example -->
                    <?php 
                        foreach ($detail_po as $value) {
                            if($value->status_po == 'Sudah'){
                                $this->load->view('partials/view_order', FALSE);
                            }else{
                    ?>
                    <form action="<?php echo base_url('Order/update') ?>" method="post" accept-charset="utf-8">
                        <?php foreach ($detail_po as $value) {
                        ?>
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                        <img src="<?php echo base_url().'assets/img/logo.jpg' ?>" alt="" width="20%">
                                    </div>
                                    <div class="col-3">
                                        <h5 class="h5 mb-2 text-primary float-right">Purchase Order</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6"></div>
                                    <div class="col-6">
                                        <label for="tgl_order" class="text-primary"><b>Tanggal</b> (bulan/hari/tahun)</label>
                                        <input type="date" name="tgl_order" required="" class="form-control" value="<?php echo $value->tanggal_po; ?>" readonly="">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="tujuan" class="text-primary"><b>Diterima di</b></label>
                                        <select name="tujuan" class="form-control" required="">
                                            <option value="Sier" <?php if($value->tujuan == 'Sier'){echo 'selected';} ?>>Sier</option>
                                            <option value="Singosari" <?php if($value->tujuan == 'Cikarang'){echo 'selected';} ?>>Cikarang</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="no_po" class="text-primary"><b>No. Purchase Order</b></label>
                                        <input type="hidden" name="id_po" value="<?php echo $value->id_po; ?>">
                                        <input type="text" name="no_po" value="<?php echo $value->no_po; ?>" placeholder="Masukkan nomor PO..." class="form-control" required="">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="tgl_loading" class="text-primary"><b>Lead Time</b> (bulan/hari/tahun)</label>
                                        <input type="date" name="tgl_loading" value="<?php echo $value->lead_time; ?>" required="" class="form-control">
                                    </div>
                                    <div class="col-6">
                                        <label for="tgl_pengiriman" class="text-primary"><b>Tgl. Pengiriman</b> (bulan/hari/tahun)</label>
                                        <input type="date" name="tgl_pengiriman" value="<?php echo $value->tanggal_pengiriman; ?>" required="" class="form-control">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-6"> 
                                        <label for="produk" class="text-primary"><b>Pilih Barang</b></label>
                                        <select name="produk" class="form-control" id="barang">
                                            <option value="" disabled selected>Pilih Barang</option>
                                            <?php foreach ($produk as $key) {
                                            ?>
                                            <option value="<?php echo $key->id_produk ?>"><?php echo $key->kode_produk." - ".$key->nama_produk." - ".$key->nama_mitra; ?></option>
                                            <?php
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="mitra" class="text-primary"><b>Supplier</b></label>
                                        <select name="mitra" class="form-control" id="mitra">
                                            <!-- <option value="" disabled selected>Pilih Supplier</option>
                                            <?php foreach ($mitra as $key) {
                                            ?>
                                            <option value="<?php echo $key->id_mitra ?>"><?php echo $key->nama_mitra ?></option>
                                            <?php
                                            } ?> -->
                                        </select>
                                        <input type="hidden" name="mitra_temp" value="<?php echo $value->id_mitra; ?>">
                                        <input type="hidden" name="request" value="<?php echo $request; ?>">
                                    </div>
                                </div> 
                                <div class="row"> 
                                    <div class="col-6"> 
                                        <a href="#!" class="btn btn-sm btn-primary float-right" id="simpan-pilih">Masukkan Barang</a>
                                    </div>
                                </div>
                                <br>   
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tablePilihan" width="100%" cellspacing="0">
                                        <thead align="center">
                                            <tr>
                                                <th align="center">Pilih</th>
                                                <th align="center">Nama Barang</th>
                                                <th align="center" width="200px">Kuantitas</th>
                                                <th align="center" width="120px">Satuan</th>
                                                <th align="center" width="125px">Mata Uang</th>
                                                <th align="center">Harga</th>
                                                <th align="center" width="150px">Kurs</th>
                                                <th align="center">Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody id="data_order">
                                            <?php 
                                            $id_produk_tersedia = [];
                                            foreach ($detail_bahan as $value) {
                                                $id_produk_tersedia[]= $value->id_produk;
                                            ?>
                                            <tr id="id<?php echo $value->id_produk ?>">
                                                    <td>
                                                        <input type="checkbox" name="record" class="form-control form-control-sm">
                                                        <input type='hidden' name='id_produk[]' value="<?php echo $value->id_produk; ?>">
                                                    </td>
                                                    <td>
                                                        <input type='text' name='nama_produk[]' placeholder='Nama Bahan Baku' required='' class='form-control' value="<?php echo $value->nama_produk; ?>" readonly="">
                                                    </td>
                                                    <td>
                                                        <input type='number' step=".01" onkeyup='hitung(<?php echo $value->id_produk ?>)' name='kuantitas[]' placeholder='Jumlah' required='' class='form-control' value='<?php echo $value->kuantitas; ?>'>
                                                    </td>
                                                    <td>
                                                        <input type='text' name='satuan[]' class='form-control' list='satuan' value="<?php echo $value->satuan; ?>" required=''>
                                                        <datalist id="satuan">
                                                            <option value='KG'>KG</option>
                                                            <option value='Gram'>Gram</option>
                                                            <option value='Ton'>Ton</option>
                                                            <option value='Pieces'>Pieces</option>
                                                            <option value='Set'>Set</option>
                                                            <option value='Unit'>Unit</option>
                                                            <option value='Drum'>Drum</option>
                                                            <option value='Roll'>Roll</option>
                                                            <option value='Box'>Box</option>
                                                            <option value='Bulan'>Bulan</option>
                                                        </datalist>
                                                    </td>
                                                    <td>
                                                        <select onchange="status_matauang(<?php echo $value->id_produk; ?>)" name='mata_uang[]' class='form-control'required=''>
                                                            <option disabled selected>Pilih</option>
                                                            <option value='Rupiah' <?php if($value->mata_uang == 'Rupiah'){echo 'selected';} ?>>Rupiah</option>
                                                            <option value='Dollar' <?php if($value->mata_uang == 'Dollar'){echo 'selected';} ?>>Dollar</option>
                                                            <option value='RMB' <?php if($value->mata_uang == 'RMB'){echo 'selected';} ?>>RMB</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type='text' onkeyup='hitung(<?php echo $value->id_produk ?>)' name='harga_text[]' placeholder='Harga' required='' class='form-control' value="<?php echo $if_harga = ($value->mata_uang == 'Rupiah') ? number_format($value->harga,0,'.','.') : $value->harga; ?>">
                                                        <input type='hidden'  onkeyup='hitung(<?php echo $value->id_produk ?>)' name='harga[]' placeholder='Harga' required='' class='form-control' value="<?php echo $value->harga; ?>">
                                                    </td>
                                                    <td>
                                                        <input type="text" step=".01" onkeyup="hitung(<?php echo $value->id_produk ?>)" name="kurs_text[]" placeholder="Kurs" class="form-control" required="" value="<?php echo $if_kurs = ($value->kurs == 0) ? '' : number_format($value->kurs,0,',','.'); ?>" <?php if($value->mata_uang == 'Rupiah'){echo 'readonly';} ?>>
                                                        <input type="hidden" step=".01" onkeyup="hitung(<?php echo $value->id_produk ?>)" name="kurs[]" value="<?php echo $value->kurs; ?>">
                                                    </td>
                                                    <td>
                                                        <input type='hidden' name='jumlah[]' placeholder='Jumlah' class="total form-control" value='<?php echo $value->jumlah; ?>'>
                                                        <input type='text' name='jumlah_text[]' placeholder='Jumlah' readonly="" class='form-control' value='<?php echo number_format($value->jumlah,0,'.','.'); ?>'>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    <!--  <button class="btn btn-sm btn-success add-row">Tambah Baris</button> -->
                                    <a class="btn btn-sm btn-danger delete-row">Hapus Baris</a>
                                   <!--  <a class="btn btn-sm btn-primary ml-0" data-toggle="modal" data-target="#produkModal">Pilih Bahan Baku</a> -->
                                </div>
                                <div class="row">
                                    <div class="col-6">&nbsp;</div>
                                    <div class="col-6">
                                        <table class="table">
                                            <tr>
                                                <td class="align-middle"><b>Subtotal</b></td>
                                                <td>
                                                    <div class="input-group">
                                                     <span class="input-group-text">Rp</span>
                                                      <input id="subtotal_text" type="text" name="subtotal_text" readonly class="form-control" value="<?php echo number_format($value->subtotal,0,',','.'); ?>">
                                                       <input id="subtotal" type="hidden" name="subtotal" value="<?php echo $value->subtotal; ?>">
                                                    </div>

                                                </td>
                                            </tr>  
                                            <tr>
                                                <td class="align-middle"><b>Pilih Pajak</b></td>
                                                <td>
                                                    <div class="input-group">
                                                      <select name="pilih_pajak" class="form-control" id="pilih_pajak" onchange="calc_pajak()">
                                                          <option value="10" <?php if($value->jenis_pajak == '10'){echo 'selected';} ?>>Pajak (10%)</option>
                                                          <option value="11" <?php if($value->jenis_pajak == '11'){echo 'selected';} ?>>Pajak (11%)</option>
                                                          <option value="0" <?php if($value->jenis_pajak == '0'){echo 'selected';} ?>>Non Pajak</option>
                                                      </select>
                                                    </div>
                                                </td>
                                            </tr> 
                                            <tr>
                                                <td class="align-middle"><b>Jumlah Pajak</b></td>
                                                <td>
                                                    <div class="input-group">
                                                    <span class="input-group-text">Rp.</span>
                                                      <input id="pajak_text" type="text" name="pajak_text" readonly class="form-control" value="<?php echo number_format($value->pajak,0,',','.'); ?>">
                                                      <input id="pajak" type="hidden" name="pajak" value="<?php echo $value->pajak; ?>">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle"><b>Total:</b></td>
                                                <td>
                                                    <div class="input-group">
                                                     <span class="input-group-text">Rp</span>
                                                      <input id="total_text" type="text" name="total_keseluruhan_text" readonly class="form-control" value="<?php echo number_format($value->total_harga,0,',','.'); ?>">
                                                       <input id="total" type="hidden" name="total_keseluruhan" value="<?php echo $value->total_harga; ?>">
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div><br>
                                <div class="row ml-0">
                                        <div class="col-6">
                                            <label for="catatan" class="text-primary"><b>Catatan</b></label>
                                            <!-- <textarea name="catatan" id="ckeditor" class="ckeditor"></textarea> -->
                                            <textarea name="catatan" rows="6" class="form-control" placeholder="Tambahkan catatan..."><?php echo $value->catatan; ?></textarea><br>
                                        </div>
                                        <div class="col-6">
                                            <label for="ttd" class="text-primary"><b>Tanda Tangan</b></label>
                                            <input type="text" name="tanggal_ttd" required="" style="text-align:center;" class="form-control" value="<?php 
                                                foreach($detail_po as $value){
                                                    echo date('d/m/Y',strtotime($value->tanggal_po)); 
                                                }
                                            ?>" readonly><hr><br><br><br>

                                             <!-- Unggah TTD Invoice -->
                                              <img src="<?php echo base_url().'assets/img/ipin.JPG' ?>" alt="" class="align-justify-content" style="display: block;margin: auto; width: 20%">
                                              <!-- <input type="file" name="img_ttd" class="form-control-file"> --><br><br><br><br>
                                              <!-- <input type="text" name="finance" value="Finance" required="" class="form-control"> -->
                                              <p class="text text-gray text-center mx-auto">Purchasing Dept.</p>
                                              <hr>
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">&nbsp;</div>
                                    <div class="col-6">
                                        <a onclick="kembali()" class="btn btn-sm btn-secondary float-right"><i class="fas fa-times"></i> Batal</a>
                                        <button type="submit" class="btn btn-sm btn-primary float-right mr-1"><i class="fas fa-save"></i> Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                        } ?>        
                    </form>
                    <?php
                            }
                        }
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
                    <table class="table temp-produk" width="100%">
                      <thead>
                        <tr>
                          <th>Pilih</th>
                          <th>Kode Produk (SKU)</th>
                          <th>Nama Produk</th>
                          <th>Satuan</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        foreach ($produk as $value) {
                           $status = "";
                            if (in_array($value->id_produk, $id_produk_tersedia)) {
                                $status = 'disabled';
                            }
                        ?>
                        <tr class="item-produk">
                          <td><input type="checkbox" name="pilih[]" <?php echo $status ?> class="form-control" value="<?php echo $value->id_produk ?>"></td>
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
    CKEDITOR.replace('catatan');

    function kembali(){
        window.history.back();
    }

    $(function(){
        $('#barang').select2({
            theme: 'bootstrap'
        });
    });

    $(function(){
        $('.temp-produk').DataTable();
    });
     
     function status_table(){
       // var status_table = $('#dataTable tr td').length;
       if ($('#tablePilihan tr td').hasClass('dataTables_empty')) {
            $('.delete-row').attr('hidden', 'true');
       }else{
            $('.delete-row').removeAttr('hidden');

       }
    }
    
    $(document).ready(function() {
        status_table();
    
        // Find and remove selected table rows
        $(".delete-row").click(function(){
            var values = new Array();
            var id_produk = new Array();
            var total = 0;
            $('input[name="record"]:checked').each(function() {   
                var row = $(this).closest('tr');
                values.push(parseInt(row.find("td input[name='jumlah[]']").val()));
                id_produk.push(parseInt(row.find("td input[name='id_produk[]']").val()));
                $(this).parents("tr").remove();
                // console.log($('#tablePilihan tr').length);
                if($('#tablePilihan tbody tr').length == 0){
                    $("#data_order").html('<tr><td colspan="8" align="center" class="dataTables_empty">Tidak ada produk yang di pilih</td></tr>');
                    $('.delete-row').attr('hidden', 'true');
                }
            });
            function myFunc(total, num) {
                return total + num;
            }
            total = values.reduce(myFunc);
            var total_akhir = $('#subtotal').val()-total;
            $('#subtotal_text').val(kurensi_teks(total_akhir));
            $('#subtotal').val(total_akhir);
            $('#total_text').val(kurensi_teks(total_akhir));
            $('#total').val(total_akhir);
            if($('#tablePilihan tr td').hasClass('dataTables_empty')){
                clear_total();
            }else{
                calc_pajak();
            }
            status_table();
        });

        $('#barang').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?php echo base_url('mitra/get_json_mitra'); ?>",
                method: 'POST',
                dataType: 'json',
                data: {id: id},
                async: true,
                success: function(data){
                    $.each(data, function(i, data) {
                        $('#mitra').html($("<option />").val(data.id_mitra).text(data.nama_mitra));
                    });
                }
            });
            return false;
        });

    });

    function hitung(data) {
        var kuantitas = $('tr#id'+data).find("input[name='kuantitas[]']").val();        
        var harga = $('tr#id'+data).find("input[name='harga_text[]']").val().replace(/\./g,'').replace(/,/g, '.').toString();
        var harga_text = $('tr#id'+data).find("input[name='harga_text[]']").val();        
        var mata_uang = $('tr#id'+data).find("select[name='mata_uang[]'] option:selected").val();        
        var kurs_text = $('tr#id'+data).find("input[name='kurs_text[]']").val().replace(/[^0-9]/g, '').toString();
        var total = 0;
        var jumlah = $('tr#id'+data).find("input[name='jumlah[]']").val();              
        var total_beli = 0;
        var harga_dolar = 0;
        var harga_rupiah = 0;

        $('tr#id'+data).find("input[name='kurs_text[]']").val(kurs_text.replace(/[^0-9]/g, '').toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
        $('tr#id'+data).find("input[name='kurs[]']").val(kurs_text);

        if (mata_uang != "Rupiah") {
            $('tr#id'+data).find("input[name='harga_text[]']").val(kurensi_rupiah(harga_text));
            $('tr#id'+data).find("input[name='harga[]']").val(harga);
            total = kurs_text*harga*kuantitas;
        }else{
            $('tr#id'+data).find("input[name='harga_text[]']").val(kurensi_rupiah(harga_text));
            $('tr#id'+data).find("input[name='harga[]']").val(harga);

            total = harga*kuantitas;
        }  
        
        var rupiah = kurensi_teks(total);
        $('tr#id'+data).find("input[name='jumlah[]']").val(total);     
        $('tr#id'+data).find("input[name='jumlah_text[]']").val(rupiah);   

        calc_total();
        calc_pajak();  
    }

    function get_currency(text){
        var number_string = text.toString(),
            sisa    = number_string.length % 3,
            rupiah  = number_string.substr(0, sisa),
            ribuan  = number_string.substr(sisa).match(/\d{3}/g);
                
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        return rupiah;
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

    function kurensi_teks(bilangan){
        var number_string = bilangan.toString(),
            split   = number_string.split('.'),
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

    function calc_total(){
      var sum = 0;
      $(".total").each(function(){
        sum += parseFloat($(this).val());
      });
      $('#subtotal_text').val(kurensi_teks(Math.round(sum)));
      $('#subtotal').val(Math.round(sum));
      $('#total_text').val(kurensi_teks(Math.round(sum)));
      $('#total').val(Math.round(sum));
    }

    function calc_pajak(){
      var pajak = 0;
      var jumlah_pajak = 0;
      var subtotal = 0;
      var total_harga = 0;

        if ($('#tablePilihan tr td').hasClass('dataTables_empty')) {
            // alert('Anda belum memilih barang !');
        }else{
            $("#pilih_pajak").each(function(){
                pajak += parseFloat($(this).val());
            });
            subtotal += parseInt($('#subtotal').val().replace(/[^0-9]/g, '').toString());
            jumlah_pajak = subtotal*pajak/100;
            total_harga = subtotal+jumlah_pajak;
            if (isNaN(jumlah_pajak)) {
                $('#pajak_text').val('0');
            }else{
                $('#pajak_text').val(kurensi_teks(Math.round(jumlah_pajak)));
                $('#pajak').val(Math.round(jumlah_pajak));
            }

            if (isNaN(total_harga)) {
                $('#total').val('0');
            }else{
                $('#total_text').val(kurensi_teks(Math.round(total_harga)));
                $('#total').val(Math.round(total_harga));
            }
            
        }
    }

    function clear_total(){
        $('#subtotal_text').val('');
        $('#subtotal').val('');
        $('#pajak_text').val('');
        $('#pajak').val('');
        $('#total_text').val('');
        $('#total').val('');
    }

    function status_matauang(data) {  
        var mata_uang = $('tr#id'+data).find("select[name='mata_uang[]'] option:selected").val();            
        if (mata_uang == "Rupiah") {
            $('tr#id'+data).find("input[name='kurs_text[]']").attr('readonly', 'true');
        }else{
            $('tr#id'+data).find("input[name='kurs_text[]']").removeAttr('readonly');
        }
    }

    $(function() {
        $(document).on('click', '#simpan-pilih', function() {
            var values = $('#barang').val();
              $.ajax({
                  url: "<?php echo base_url('produk/get_produk') ?>",
                  type: 'POST',
                  dataType: 'JSON',
                  data: {id_produk: values},
                  success : function(res){
                    if ($('#tablePilihan tr td').hasClass('dataTables_empty')) {
                         $("#data_order").html(res);
                   }else{
                         $("#data_order").append(res);
                    }
                  }
              }).then(function () {
                status_table();
                status_matauang(values);
                clear_total();
                $("#barang option[value='"+values+"']").attr('disabled', 'true');
              })
        });
    });
</script>

</body>
</html>