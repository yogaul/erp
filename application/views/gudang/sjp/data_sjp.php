<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - SJP</title>

    <?php $this->load->view('partials/head', FALSE);?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php  $this->load->view('partials/sidebar_gudang', FALSE); ?>
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
                    <h1 class="h4 mb-2 text-gray-800">Daftar Surat Jalan Pengiriman (SJP)</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                             <a href="<?php echo base_url().'sjp/buat/'.$id_spp; ?>" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah</a>
                        <?php 
                            if (empty($list_sjp)) {
                                echo "";
                            }else{
                        ?>
                             <a href="#" onclick="coming()" class="btn btn-sm btn-success"><i class="fas fa-file-export"></i> Export Excel</a>
                        <?php
                            }
                         ?>
                         </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-9">
                                    <img src="<?php echo base_url().'assets/img/logo.jpg'; ?>" alt="logo" width="200px">
                                </div>
                                <div class="col-3">
                                    <label for="no_spp" class="text-primary"><b>Nomor SPP</b></label>
                                    <p><?php echo $data_spp->nomor_spp; ?></p>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-3">
                                    <label for="brand_so" class="text-primary"><b>Customer</b></label>
                                    <p><?php echo $data_spp->nama_customer." - ".$data_spp->nama_perusahaan_customer; ?></p>
                                </div>
                                <div class="col-3"></div>
                                <div class="col-3"></div>
                                <div class="col-3">
                                    <label for="brand_so" class="text-primary"><b>Brand (Merk)</b></label>
                                    <p><?php echo $data_spp->nama_brand_produk; ?></p>
                                </div>
                            </div><hr>    
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tableHistory" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>No. Surat Jalan</th>
                                            <th>No. Telepon</th>
                                            <th>Alamat Pengiriman</th>
                                            <th width="70">Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($list_sjp as $key) {
                                    ?>
                                        <tr>
                                            <td><?php echo date('d/m/Y',strtotime($key->tanggal_sjp)); ?></td>
                                            <td><?php echo $key->nomor_sjp; ?></td>
                                            <td><?php echo $key->telp_sjp; ?></td>
                                            <td><?php echo $key->alamat_sjp; ?></td>
                                            <td>
                                                <div class="dropdown show">
                                                  <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Tindakan
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a href="<?php echo base_url().'sjp/cetak/'.$key->id_sjp; ?>" class="dropdown-item"><i class="fa fa-file-pdf"></i> Cetak SJP</a>
                                                    <!-- <a href="<?php echo base_url().'sjp/ubah/'.$key->id_sjp; ?>" class="dropdown-item"><i class="fa fa-pencil"></i> Ubah</a> -->
                                                    <a onclick="deleteConfirm('<?php echo base_url().'sjp/hapus/'.$key->id_sjp; ?>')" href="#!" class="dropdown-item"><i class="fa fa-trash"></i> Hapus</a>
                                                  </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    } 
                                    ?>
                                    </tbody>
                                </table>
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

    <!-- Logout Modal-->
    <?php $this->load->view('partials/logout_modal', FALSE); ?>

    <?php $this->load->view('partials/js', FALSE);?>

<script>
    function deleteConfirm(url){
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }

     function show_detail(id,status){
        var html = "";
        var satuan_kg = "";
        var satuan_gram = "";

        $.ajax({
            url: "<?php echo base_url().'Order/json_detail_kedatangan' ?>",
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            success : function(data){
                 console.log(data);
                 $('.modal-body #id_detail_modal').val(data.id_detail_order);
                 $('.modal-body #id_datang_edit_modal').val(data.data_kedatangan.id_bahan_datang);
                 $('.modal-body #kode_produk_modal').val(data.data_kedatangan.kode_produk);
                 $('.modal-body #nama_produk_modal').val(data.data_kedatangan.nama_produk);
                 $('.modal-body #kuantitas_modal').val(data.data_kedatangan.kuantitas);
                 $('.modal-body #sudah_datang_modal').val(data.data_kedatangan.datang);
                 $('.modal-body #no_surat_jalan_modal').val(data.data_kedatangan.no_surat_jalan);
                 $('.modal-body #tgl_datang_modal').val(data.data_kedatangan.tanggal_kedatangan);
                 $('.modal-body #no_batch_modal').val(data.data_kedatangan.no_batch_kedatangan);
                 $('.modal-body #kode_datang_modal').val(data.data_kedatangan.kode_kedatangan);
                 $.each(data.detail_kedatangan, function(index, data) {
                    if (status == 'Baku') {
                        var satuan = data.satuan_kedatangan;
                        if (satuan == 'Kg') {
                            satuan_kg = 'selected';
                        }else if(satuan == 'Gram'){
                            satuan_gram = "selected";
                        }
                        html += "<div id='div_contain_item' class='row mr-0 item"+data.id_detail_kedatangan+"'><div class='col-1'>";
                        html += "<div class='form-group'><input type='checkbox' name='pilih' class='form-control'></div></div>";
                        html += "<div class='col-2'><div class='form-group'><input class='form-control' type='text' id='qty_datang_modal"+data.id_detail_kedatangan+"' name='qty_datang_text' required='' placeholder='Qty...' onkeyup='hitung("+data.id_detail_kedatangan+")' value='"+get_currency(data.qty_kedatangan)+"'><input type='hidden' name='qty_datang[]' id='qty_datang"+data.id_detail_kedatangan+"' onkeyup='hitung("+data.id_detail_kedatangan+")' value='"+data.qty_kedatangan+"'></div></div>";
                        html += "<div class='col-2'><div class='form-group'><input type='number' name='isi_datang[]' step='0.01' onkeyup='hitung("+data.id_detail_kedatangan+")' id='isi_datang"+data.id_detail_kedatangan+"' class='form-control' required='' placeholder='Isi...' value='"+data.isi_kedatangan+"'></div></div>";
                        html += "<div class='col-3'><div class='form-group'><select name='satuan_datang[]' id='satuan_datang_modal"+data.id_detail_kedatangan+"' class='form-control' required='' onchange='hitung("+data.id_detail_kedatangan+")'><option value='Kg' "+satuan_kg+">Kg</option><option value='Gram' "+satuan_gram+">Gram</option></select></div></div>";
                        html += "<div class='col-4'><div class='form-group'><input class='form-control' type='text' id='kemasan_datang_modal"+data.id_detail_kedatangan+"' name='kemasan_datang[]' required='' placeholder='Kemasan...' value='"+data.kemasan_kedatangan+"'><input type='hidden' name='subtotal_datang[]' class='subtotal_datang' value='"+data.subtotal_kedatangan+"'></div></div></div>";
                    }else{
                        html += "<div id='div_contain_item' class='row mr-0 item"+data.id_detail_kedatangan+"'><div class='col-1'>";
                        html += "<div class='form-group'><input type='checkbox' name='pilih' class='form-control'></div></div>";
                        html += "<div class='col-2'><div class='form-group'><input class='form-control' type='text' id='qty_datang_modal"+data.id_detail_kedatangan+"' name='qty_datang_text' required='' placeholder='Qty...' onkeyup='hitung("+data.id_detail_kedatangan+")'><input type='hidden' name='qty_datang[]' id='qty_datang"+data.id_detail_kedatangan+"' onkeyup='hitung("+data.id_detail_kedatangan+")'></div></div>";
                        html += "<div class='col-2'><div class='form-group'><input type='number' name='isi_datang[]' step='0.01' onkeyup='hitung("+data.id_detail_kedatangan+")' id='isi_datang"+data.id_detail_kedatangan+"' class='form-control' required='' placeholder='Isi...'></div></div>";
                        html += "<div class='col-3'><div class='form-group'><select name='satuan_datang[]' id='satuan_datang_modal"+data.id_detail_kedatangan+"' class='form-control' required='' onchange='hitung("+data.id_detail_kedatangan+")' disabled><option value='Kg'>Kg</option><option value='Gram'>Gram</option></select></div></div>";
                        html += "<div class='col-4'><div class='form-group'><input class='form-control' type='text' id='kemasan_datang_modal"+data.id_detail_kedatangan+"' name='kemasan_datang[]' required='' placeholder='Kemasan...'><input type='hidden' name='subtotal_datang[]' class='subtotal_datang'></div></div></div>";
                    }    
                 });

                 $('.modal-body #div_container_row').html(html);
                 $('.modal-body #datang_baru_modal').val(data.data_kedatangan.jumlah_kedatangan);
                 $('.modal-body #bahan_datang').val(data.data_kedatangan.jumlah_kedatangan);
                 $('.modal-body #bahan_datang_lama').val(data.data_kedatangan.jumlah_kedatangan);
                 $('.modal-body #expired_datang_modal').val(data.data_kedatangan.expired_date);
                 $('.modal-body #keterangan_datang_modal').val(data.data_kedatangan.keterangan_kedatangan);
                
                $('#editDatangModal').modal({backdrop: 'static', keyboard: false});
            }
        })
    }

    function tambah(status){
        var html = "";
        var count_row = $('.modal-body #div_contain_item').length;
        var id = count_row+1;

        if (status == 'Baku') {
            html += "<div id='div_contain_item' class='row mr-0 item"+id+"'><div class='col-1'>";
            html += "<div class='form-group'><input type='checkbox' name='pilih' class='form-control'></div></div>";
            html += "<div class='col-2'><div class='form-group'><input class='form-control' type='text' id='qty_datang_modal"+id+"' name='qty_datang_text' required='' placeholder='Qty...' onkeyup='hitung("+id+")'><input type='hidden' name='qty_datang[]' id='qty_datang"+id+"' onkeyup='hitung("+id+")'></div></div>";
            html += "<div class='col-2'><div class='form-group'><input type='number' name='isi_datang[]' step='0.01' onkeyup='hitung("+id+")' id='isi_datang"+id+"' class='form-control' required='' placeholder='Isi...'></div></div>";
            html += "<div class='col-3'><div class='form-group'><select name='satuan_datang[]' id='satuan_datang_modal"+id+"' class='form-control' required='' onchange='hitung("+id+")'><option value='Kg'>Kg</option><option value='Gram'>Gram</option></select></div></div>";
            html += "<div class='col-4'><div class='form-group'><input class='form-control' type='text' id='kemasan_datang_modal' name='kemasan_datang[]' required='' placeholder='Kemasan...'><input type='hidden' name='subtotal_datang[]' class='subtotal_datang'></div></div></div>";
        }else{
            html += "<div id='div_contain_item' class='row mr-0 item"+id+"'><div class='col-1'>";
            html += "<div class='form-group'><input type='checkbox' name='pilih' class='form-control'></div></div>";
            html += "<div class='col-2'><div class='form-group'><input class='form-control' type='text' id='qty_datang_modal"+id+"' name='qty_datang_text' required='' placeholder='Qty...' onkeyup='hitung("+id+")'><input type='hidden' name='qty_datang[]' id='qty_datang"+id+"' onkeyup='hitung("+id+")'></div></div>";
            html += "<div class='col-2'><div class='form-group'><input type='number' name='isi_datang[]' step='0.01' onkeyup='hitung("+id+")' id='isi_datang"+id+"' class='form-control' required='' placeholder='Isi...'></div></div>";
            html += "<div class='col-3'><div class='form-group'><select name='satuan_datang[]' id='satuan_datang_modal"+id+"' class='form-control' required='' disabled><option value='Kg'>Kg</option><option value='Gram'>Gram</option></select></div></div>";
            html += "<div class='col-4'><div class='form-group'><input class='form-control' type='text' id='kemasan_datang_modal' name='kemasan_datang[]' required='' placeholder='Kemasan...'><input type='hidden' name='subtotal_datang[]' class='subtotal_datang'></div></div></div>";
        }
        $('.modal-body #div_container_row').append(html);
    }

    function hitung(data){
        var quantity_text = $('#qty_datang_modal'+data).val().replace(/[^0-9]/g, '').toString(); 
        var isi = $('#isi_datang'+data).val(); 
        var subtotal = 0;
        var satuan = $('#satuan_datang_modal'+data).val();

        $('#qty_datang_modal'+data).val(quantity_text.replace(/[^0-9]/g, '').toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
        $('#qty_datang'+data).val(quantity_text);

        if (satuan == 'Gram') {
            subtotal = quantity_text*isi/1000;
        }else{
            subtotal = quantity_text*isi;
        }

        $('.modal-body .item'+data).find('.subtotal_datang').val(subtotal);
        calc_total();
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

    function calc_total(){
       var sum = 0;
       $(".modal-body .subtotal_datang").each(function(){
         sum += parseFloat($(this).val());
       });
       if(isNaN(sum)){
            $('.modal-body #datang_baru_modal').val(0);
            $('.modal-body #bahan_datang').val(0);
       }else{
            $('.modal-body #datang_baru_modal').val(sum.toFixed(3));
            $('.modal-body #bahan_datang').val(sum.toFixed(3));
       }
    }

    function cek_detail(status){
         var count_row = $('.modal-body #div_contain_item').length;
         if (count_row == 0) {
            alert('Anda harus menambahkan setidaknya satu detail kedatangan !');
            tambah(status);
         }else{
            $('#form-ubah-datang').submit();
         }
    }

    function show_export(){
        $('#inputTanggalExportModal').modal({backdrop: 'static', keyboard: false});
    }

    function kirim_export(){
        var kategori = $('.modal-body #kategori_ekspor_modal').val();
        var bulan = $('.modal-body #pilih_bulan_modal').val();
        var tahun = $('.modal-body #pilih_tahun_modal').val();

        $.ajax({
            url: "<?php echo base_url().'order/json_ekspor_riwayat'; ?>",
            type: 'POST',
            dataType: 'json',
            data: {kategori: kategori, bulan: bulan, tahun: tahun},
            success: function(data){
                if (data.length == 0) {
                    alert('Maaf data kedatangan bahan '+kategori+' untuk bulan '+bulan+' pada tahun '+tahun+' tidak ditemukan, silahkan pilih bulan dan tahun lain.');
                }else{
                    $('.modal-body #form-pilih-export').submit();
                }
            }
        })        
    }

     $(document).ready(function() {
        $('#tableHistory').DataTable( {
            stateSave: true
        });

        $('.modal-body #hapus_row_datang').click(function(event) {
            var numcheck = $('.modal-body input[name="pilih"]:checked').length;
            var bahan_datang = $('.modal-body #bahan_datang').val();
            var values = new Array();
            if (numcheck == 0) {
                alert('tidak ada baris yang dipilih.');
            }else{
                $('input[name="pilih"]:checked').each(function() {          
                    var row_item = $(this).closest("#div_contain_item");
                    values.push(parseFloat(row_item.find(".subtotal_datang").val()));
                    $(this).closest("#div_contain_item").remove();
                });
                function myFunc(total, num) {
                    return total + num;
                }
                total = values.reduce(myFunc);
                var total_akhir = bahan_datang-total;
                if(isNaN(total_akhir)){
                    $('.modal-body #datang_baru_modal').val(0);
                    $('.modal-body #bahan_datang').val(0);
                }else{
                    $('.modal-body #datang_baru_modal').val(total_akhir.toFixed(3));
                    $('.modal-body #bahan_datang').val(total_akhir.toFixed(3));
                }
            }  
        });
    });
</script>

</body>
</html>