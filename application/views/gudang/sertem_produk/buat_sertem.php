<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Serah Terima</title>

    <?php $this->load->view('partials/head', FALSE);?>

    <style type="text/css">
        th{
            text-align: center;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
            $this->load->view('partials/sidebar_gudang', FALSE);
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
                    <h1 class="h4 mb-2 text-gray-800">Buat Serah Terima Produk <?= $kategori ?></h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <form action="<?php echo base_url().'sertem/simpan'; ?>" method="POST">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="tanggal_sertem" class="text-primary"><b>Tanggal</b> (bulan/hari/tahun)</label>
                                        <input type="date" class="form-control" name="tanggal_sertem" required="">
                                        <input type="hidden" name="jenis" value="<?= $jenis ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="shift_sertem" class="text-primary"><b>Shift</b></label>
                                        <select name="shift_sertem" required="" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="produk_sertem" class="text-primary" id="produk"><b>Produk <?= $kategori ?></b></label>
                                        <select name="produk_sertem" required="" class="form-control" id="produk_so">
                                            <?php
                                                foreach ($produk as $value) {
                                                    if ($jenis == 'glow') {
                                            ?>
                                            <option value="<?php echo $value->id_produk_msglow; ?>"><?php echo $value->nama_produk_msglow; ?></option>
                                            <?php
                                                    }elseif ($jenis == 'oem') {
                                            ?>
                                            <option value="<?php echo $value->id_sample_acc; ?>"><?php echo $value->nama_produk_acc; ?></option>
                                            <?php
                                                    }
                                            ?>
                                            <?php
                                                } 
                                            ?>
                                        </select>
                                            <a href="#!" class="btn btn-sm btn-primary float-right mt-1" id="simpan-pilih">Masukkan Produk <i class="fa fa-arrow-down"></i></a>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="sertem_dari" class="text-primary"><b>Serah Terima Dari</b></label>
                                        <select name="sertem_dari" required="" class="form-control">
                                            <option value="Production">Production</option>
                                        </select>
                                    </div>
                                        <div class="form-group">
                                        <label for="keterangan_sertem" class="text-primary"><b>Keterangan</b></label>
                                        <textarea class="form-control" name="keterangan_sertem" placeholder="Keterangan..." required="" style="height: 120px;"></textarea>
                                    </div>
                                </div>
                            </div>
                            <br>    
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table-produk" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="100px">Pilih (Hapus Baris)</th>
                                            <th>Nama Produk</th>
                                            <th>Qty Karton</th>
                                            <th>Nomor Batch</th>
                                            <th>Qty Pcs</th>
                                            <th>No. Identitas Pallet</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data_produk">
                                        <tr>
                                            <td colspan="8" align="center" class="dataTables_empty">Tidak ada produk yang di pilih</td> 
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <a class="btn btn-sm btn-danger delete-row">Hapus Baris</a>
                            </div><hr>
                            <div class="row">
                                <div class="col-6">&nbsp;</div>
                                <div class="col-6">
                                    <a onclick="kembali()" class="btn btn-sm btn-secondary float-right"><i class="fas fa-times"></i> Batal</a>
                                    <button type="submit" name="btn_simpan_keluar" class="btn btn-sm btn-primary float-right mr-1 btn-simpan"><i class="fas fa-save"></i> Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
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
    // define var
    var kuantitas = [];
    var kuantitas_karton = [];
    var kuantitas_total = [];

    function kembali() {
        window.history.back();
    }

    function status_table(){
       if ($('#table-produk tr td').hasClass('dataTables_empty')) {
            $('.delete-row').attr('hidden', 'true');
       }else{
            $('.delete-row').removeAttr('hidden');

       }
    }

    function tambah(){
        if($('a.tambah-produk').length > 0){
            $('a.tambah-produk').unbind();
        }
        $('a.tambah-produk').on('click', function(){
            let id = $(this).attr('data-id');
            let str_html = "";
            
            str_html += "<tr id='"+id+"'>";
            str_html += "<td><input type='checkbox' name='record[]' class='form-control form-control-sm'></td>";
            str_html += "<td></td>";
            str_html += "<td></td>";
            str_html += "<td><input type='text' class='form-control form-control-sm' name='nomor_batch_"+id+"[]' placeholder='Nomor batch...' required></td>";
            str_html += "<td><input type='text' class='form-control form-control-sm currency-format' name='quantity_karton_text[]' placeholder='Quantity/karton...' required><input class='kontol' data-id="+id+" type='hidden' name='quantity_karton_value_"+id+"[]'></td>";
            str_html += "<td><input type='text' name='no_pallet_sertem_"+id+"[]'  class='form-control form-control-sm' required='' placeholder='No. Identitas Pallet...'></td>";
            str_html += "<td></td>";
            str_html += "</tr>";
            $($(this).closest("tr")).after(str_html);
            kurensi_kuantitas();
            input_kuantitas();
            currency_format();
        });
    }

    function currency_format(){
        if($('input.currency-format').length > 0){
            $('input.currency-format').unbind();
        }
        $('input.currency-format').on('input', function(){
            var number_string = $(this).val().replace(/[^,\d]/g, '').toString(),
            split   = number_string.split(','),
            sisa    = split[0].length % 3,
            rupiah  = split[0].substr(0, sisa),
            ribuan  = split[0].substr(sisa).match(/\d{1,3}/gi);
            
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;

            $(this).next('.kontol').val(number_string);
            $(this).val(rupiah);
            sum_kuantitas();
        });
    }

    function kurensi_kuantitas(){
        if($('input[name^=quantity_karton]').length > 0){
            $('input[name^=quantity_karton]').unbind();
        }
        $('input[name^=quantity_karton]').on('change', function(){
            sum_kuantitas();
        });
    }

    function input_kuantitas(){
        if($('input[name^=quantity]').length > 0){
            $('input[name^=quantity]').unbind();
        }
        $('input[name^=quantity]').on('change', function(){
            sum_kuantitas();
        });
    }

    function sum_kuantitas(){
        kuantitas = [];
        kuantitas_karton = [];
        kuantitas_total = [];

        $.each($('input[name^=quantity_karton_value]'), function(index, val) {
            let id      = $(this).attr('data-id');
            let values  = $(this).val();

            // fixed double first
            if(typeof kuantitas_karton[id] === 'undefined'){
                kuantitas_karton[id] = Number(values);
            }else{
                kuantitas_karton[id] += Number(values);
            }
        });

        $.each($('input[name^=quantity_value]'), function(index, val) {
            let id      = $(this).attr('data-id');
            let values  = $(this).val();

            if(typeof kuantitas[id] === 'undefined'){
                kuantitas[id] = Number(values);
            }

            kuantitas_total[id] = kuantitas[id] * kuantitas_karton[id];
            $('input[name^=subtotal_sertem]#'+id).val(kuantitas_total[id]);
        });
    }

    $(document).ready(function() {
        status_table();

        $('#produk_so').select2({
            theme: 'bootstrap',
            width: 'auto',
            dropdownAutoWidth: true,
            allowClear: true
        });
        
        // Find and remove selected table rows
        $(".delete-row").click(function(){
            var values = new Array();
            var id_user = new Array();
            $('input[name="record[]"]:checked').each(function() {   
                var row = $(this).closest('tr');
                $(this).parents("tr").remove();
                if($('#data_produk').html() == ""){
                    $("#data_produk").html('<tr><td colspan="7" align="center" class="dataTables_empty">Tidak ada produk yang di pilih</td></tr>');
                    $('.delete-row').attr('hidden', 'true');
                }
                sum_kuantitas();
            });
            // status_table();
        });

        $("#simpan-pilih").click(function(event) {
            var values = $("#produk_so").val();
            if (values == null) {
                alert('Produk tidak ditemukan, mungkin produk yang mau anda pilih sudah ada di tabel atau anda belum memilih merk :)');
            }else{
                $.ajax({
                  url: "<?php echo $url; ?>",
                  type: 'POST',
                  dataType: 'JSON',
                  data: {id: values},
                  success : function(res){
                    //   console.log(res);
                    if ($('#table-produk tr td').hasClass('dataTables_empty')) {
                         $("#data_produk").html(res);
                    }else{
                         $("#data_produk").append(res);
                    }
                  }
                }).then(function () {
                    status_table();
                    // $("#produk_so option[value='"+values+"']").attr('disabled', 'true');
                    tambah();
                    kurensi_kuantitas();
                    input_kuantitas();
                    currency_format();
                })
            }
        });
    });
</script>

</body>
</html>