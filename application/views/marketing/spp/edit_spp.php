<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - SPP</title>

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
            if ($this->session->userdata('level') == 'marketing') {
                $this->load->view('partials/sidebar_marketing', FALSE);
            }elseif ($this->session->userdata('level') == 'tim_marketing') {
                $this->load->view('partials/sidebar_tim_marketing', FALSE);
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
                    <h1 class="h4 mb-2 text-gray-800">Ubah Surat Perintah Pengiriman (SPP)</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <form action="<?php echo base_url().'spp/ubah_spp' ?>" method="POST">
                        <div class="card-body">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                         <div class="form-group">
                                            <label for="no_spp" class="text-primary"><b>No.SPP</b></label>
                                            <input type="hidden" name="id_spp" value="<?php echo $data_spp->id_spp; ?>">
                                            <input type="hidden" name="brand_spp_temp" value="<?php echo $data_spp->id_brand_produk; ?>">
                                            <input type="text" class="form-control form-control-sm" name="no_spp" placeholder="No. SPP..." value="<?php echo $data_spp->nomor_spp; ?>" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="brand_so" class="text-primary"><b>Brand (Merk)</b></label>
                                        <select name="brand_so" required="" class="form-control" id="brand">
                                            <option value="-">Pilih merk</option>
                                            <?php foreach ($brand as $key) {
                                            ?>
                                            <option value="<?php echo $key->id_brand_produk; ?>" <?php echo $pilihan = ($data_spp->id_brand_produk == $key->id_brand_produk) ? 'selected' : ''; ?>><?php echo $key->nama_brand_produk." - ".$key->nama_customer; ?></option>
                                            <?php
                                            } 
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="produk_so" class="text-primary" id="produk"><b>Produk</b></label>
                                        <select name="produk_so" class="form-control form-control-sm" id="produk_so">
                                            <!-- <option value="-" disabled="" selected="">Pilih produk</option> -->
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-1"> 
                                    <div class="col-6">&nbsp;</div>
                                    <div class="col-6"> 
                                        <a href="#!" class="btn btn-sm btn-primary float-right" id="simpan-pilih">Masukkan Produk <i class="fa fa-arrow-down"></i></a>
                                    </div>
                                </div>
                                <br>    
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table-produk" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="100px">Pilih (Hapus Baris)</th>
                                                <th>Nama Produk</th>
                                                <th>Volume</th>
                                                <th>Quantity</th>
                                                <th>Tanggal Pengiriman</th>
                                            </tr>
                                        </thead>
                                        <tbody id="data_produk">
                                            <?php 
                                                foreach ($detail_spp as $value) {
                                            ?>
                                            <tr id="id<?php echo $value->id_sample_acc; ?>">
                                                <td>
                                                    <input type="checkbox" name="record[]" class="form-control form-control-sm">
                                                    <input type="hidden" name="id_produk[]" value="<?php echo $value->id_sample_acc; ?>">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm" name="nama_produk" value="<?php echo $value->nama_produk_acc; ?>" readonly="">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm" name="volume_produk" value="<?php echo $value->volume_produk_acc; ?>" readonly="">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm" name="quantity_text[]" placeholder="Quantity" onkeyup="kurensi_kuantitas('<?php echo $value->id_sample_acc; ?>')" value="<?php echo number_format($value->quantity_spp,0,'.','.'); ?>" required>
                                                    <input type="hidden" name="quantity[]" value="<?php echo $value->quantity_spp; ?>" onkeyup="kurensi_kuantitas('<?php echo $value->id_sample_acc; ?>')">
                                                </td>
                                                <td>
                                                    <input type="date" name="tanggal_kirim_spp[]"  class="form-control form-control-sm" value="<?php echo $value->tanggal_kirim_spp; ?>" required="">
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    <a class="btn btn-sm btn-danger delete-row">Hapus Baris</a>
                                </div><hr>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="no_telp_pengiriman" class="text-primary"><b>No.Telp</b></label>
                                            <input type="text" id="no_telp_kirim_spp" class="form-control form-control-sm" name="no_telp_pengiriman" placeholder="No. Telp..." value="<?php echo $data_spp->no_telp_spp; ?>" required="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                         <div class="form-group">
                                            <label for="alamat_pengiriman" class="text-primary"><b>Alamat Pengiriman</b></label>
                                            <input type="text" id="alamat_kirim_spp" class="form-control form-control-sm" name="alamat_pengiriman" placeholder="Alamat Pengiriman..." value="<?php echo $data_spp->alamat_pengiriman_spp; ?>" required="">
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="catatan_spp" class="text-primary"><b>Catatan SPP</b></label>
                                        <textarea name="catatan_spp" class="form-control" placeholder="Catatan surat perintah pengiriman..." rows="4"><?php echo $data_spp->catatan_spp; ?></textarea>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-6">&nbsp;</div>
                                    <div class="col-6">
                                        <a onclick="kembali()" class="btn btn-sm btn-secondary float-right"><i class="fas fa-times"></i> Batal</a>
                                        <button type="submit" name="btn_simpan_keluar" class="btn btn-sm btn-primary float-right mr-1 btn-simpan"><i class="fas fa-save"></i> Simpan</button>
                                    </div>
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
    CKEDITOR.replace('catatan_spp');

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

    function kurensi_kuantitas(id){
        var kuantitas = $('tr#id'+id).find("input[name='quantity_text[]']").val().replace(/[^0-9]/g, '').toString(); 
        $('tr#id'+id).find("input[name='quantity_text[]']").val(kuantitas.replace(/[^0-9]/g, '').toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
        $('tr#id'+id).find("input[name='quantity[]']").val(kuantitas);
    }

    $(document).ready(function() {
        status_table();

        $('#brand').select2({
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
                if($('#table-produk tbody').children().length == 0){
                    $("#data_produk").html('<tr><td colspan="5" align="center" class="dataTables_empty">Tidak ada produk yang di pilih</td></tr>');
                    $('.delete-row').attr('hidden', 'true');
                }
            });
            // status_table();
        });

        $("#simpan-pilih").click(function(event) {
            var values = $("#produk_so").val();
            if (values == null) {
                alert('Produk tidak ditemukan, mungkin produk yang mau anda pilih sudah ada di tabel atau anda belum memilih merk :)');
            }else{
                $.ajax({
                  url: "<?php echo base_url('sample/json_row_spp'); ?>",
                  type: 'POST',
                  dataType: 'JSON',
                  data: {id: values},
                  success : function(res){
                    if ($('#table-produk tr td').hasClass('dataTables_empty')) {
                         $("#data_produk").html(res);
                    }else{
                         $("#data_produk").append(res);
                    }
                  }
                }).then(function () {
                    status_table();
                    $("#produk_so option[value='"+values+"']").attr('disabled', 'true');
                })
            }
        });

        $('#brand').change(function(event) {
            $('#produk_so').html('');
            var id = $(this).val();
            if (id == '-') {
                alert('harap pilih brand atau merk !');
                $('#no_telp_kirim_spp').val('');
                $('#alamat_kirim_spp').val('');
            }else{
                $.ajax({
                    url: "<?php echo base_url().'sample/json_acc_customer'; ?>",
                    type: 'POST',
                    dataType: 'json',
                    data: {id: id},
                    success: function(data){
                        $.each(data, function(i, val) {
                            $('#produk_so').append($("<option />").val(val.id_sample_acc).text(val.nama_produk_acc+" "+val.volume_produk_acc));
                        });
                    }
                });
                $.ajax({
                    url: "<?php echo base_url().'customer/json_customer_brand'; ?>",
                    type: 'POST',
                    dataType: 'json',
                    data: {id: id},
                    success: function(data){
                       $('#no_telp_kirim_spp').val(data.telp_customer);
                       $('#alamat_kirim_spp').val(data.alamat_perusahaan_kirim);
                    }
                });
            }
        });
    });
</script>

</body>
</html>