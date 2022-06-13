<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Sales Order</title>

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
                    <h1 class="h4 mb-2 text-gray-800">Ubah Sales Order</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <form action="<?php echo base_url().'SalesOrder/ubah_so' ?>" method="POST" accept-charset="utf-8">
                        <div class="card-body">
                            <div class="card-body">
                                 <div class="row">
                                    <div class="col-3">
                                        <label for="brand_so" class="text-primary"><b>Customer</b></label>
                                        <input type="hidden" name="id_so" value="<?php echo $data_so->id_sales_order; ?>">
                                        <input type="hidden" name="brand_so_temp" value="<?php echo $data_so->id_brand_produk; ?>">
                                        <p><?php echo $data_so->nama_customer." - ".$data_so->nama_perusahaan_customer; ?></p>
                                    </div>
                                    <div class="col-3"></div>
                                    <div class="col-3"></div>
                                    <div class="col-3">
                                        <label for="brand_so" class="text-primary"><b>Brand (Merk)</b></label>
                                        <p><?php echo $data_so->nama_brand_produk; ?></p>
                                    </div>
                                </div><hr>    
                               <!--  <div class="row">
                                    <div class="col-6">
                                        <label for="brand_so" class="text-primary"><b>Brand (Merk)</b></label>
                                        <input type="hidden" name="id_so" value="<?php echo $data_so->id_sales_order; ?>">
                                        <input type="hidden" name="brand_so_temp" value="<?php echo $data_so->id_brand_produk; ?>">
                                        <select name="brand_so" required="" class="form-control" id="brand">
                                            <option value="-">Pilih merk</option>
                                            <?php foreach ($brand as $key) {
                                            ?>
                                            <option value="<?php echo $key->id_brand_produk; ?>" <?php echo $pilihan = ($data_so->id_brand_produk == $key->id_brand_produk) ? 'selected' : ''; ?>><?php echo $key->nama_brand_produk." - ".$key->nama_customer; ?></option>
                                            <?php
                                            } 
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="produk_so" class="text-primary" id="produk"><b>Produk</b></label>
                                        <select name="produk_so" required="" class="form-control form-control-sm" id="produk_so">
                                            <option value="-" disabled="" selected="">Pilih produk</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-1"> 
                                    <div class="col-6">&nbsp;</div>
                                    <div class="col-6"> 
                                        <a href="#!" class="btn btn-sm btn-primary float-right" id="simpan-pilih">Masukkan Produk <i class="fa fa-arrow-down"></i></a>
                                    </div>
                                </div> -->
                                <!-- <br>     -->
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table-produk" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <!-- <th width="100px">Pilih (Hapus Baris)</th> -->
                                                <th>Nama Produk</th>
                                                <th>Quantity</th>
                                                <th>Status BPOM</th>
                                                <th>Retur</th>
                                                <th>Terkirim</th>
                                                <th>Estimasi Kirim</th>
                                                <th>Status</th>
                                                <th>Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody id="data_produk">
                                        <?php 
                                            foreach ($detail_so as $value) {
                                        ?>
                                        <tr id="id<?php echo $value->id_sample_acc; ?>">
                                           <!--  <td>
                                                <input type="checkbox" name="record[]" class="form-control form-control-sm"/>
                                                <input type="hidden" name="id_produk[]" value="<?php echo $value->id_sample_acc; ?>" />
                                            </td> -->
                                            <td>
                                                <input type="hidden" name="id_detail_so[]" value="<?php echo $value->id_detail_sales_order; ?>" />
                                                <input type="hidden" name="id_produk[]" value="<?php echo $value->id_sample_acc; ?>" />
                                                <input type="text" class="form-control form-control-sm" name="nama_produk" value="<?php echo $value->nama_produk_acc." ".$value->volume_produk_acc ?>" readonly=""/>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm" name="quantity_text[]" value="<?php echo number_format($value->quantity_so,0,'.','.'); ?>" placeholder="Quantity" onkeyup="kurensi_kuantitas(<?php echo $value->id_sample_acc; ?>)"/>
                                                <input type="hidden" name="quantity[]" value="<?php echo $value->quantity_so; ?>" onkeyup="kurensi_kuantitas(<?php echo $value->id_sample_acc; ?>)" />
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm" name="status_bpom[]" placeholder="Pilih status" list="list_status_bpom" value="<?php echo $value->status_bpom_so; ?>" />
                                                <datalist id="list_status_bpom">
                                                   <option value="Done">Done</option>
                                                   <option value="Belum">Belum</option>
                                                </datalist>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm" name="retur_text[]" value="<?php echo number_format($value->retur_so,0,'.','.'); ?>" placeholder="Jumlah retur" onkeyup="kurensi_retur(<?php echo $value->id_sample_acc; ?>)"/>
                                                <input type="hidden" name="retur[]" value="<?php echo $value->retur_so; ?>" onkeyup="kurensi_retur(<?php echo $value->id_sample_acc; ?>)"
                                              />
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm" name="terkirim_text[]" value="<?php echo number_format($value->terkirim_so,0,'.','.'); ?>" placeholder="Jumlah terkirim" onkeyup="kurensi_terkirim(<?php echo $value->id_sample_acc; ?>)"
                                                />
                                                <input type="hidden" name="terkirim[]" value="<?php echo $value->terkirim_so; ?>" onkeyup="kurensi_terkirim(<?php echo $value->id_sample_acc; ?>)"/>
                                            </td>
                                            <td>
                                                <input type="date" class="form-control form-control-sm" name="estimasi[]" value="<?php echo $estimasi = ($value->estimasi_pengiriman_so == '0000-00-00') ? '' : $value->estimasi_pengiriman_so; ?>" placeholder="Pilih estimasi"/>
                                            </td>
                                            <td>
                                                <input type="text" name="status_so[]" class="form-control form-control-sm" value="<?php echo $value->status_so; ?>" placeholder="Status SO">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm" name="harga_so_text[]" onkeyup="kurensi_harga_so(<?php echo $value->id_sample_acc; ?>)" placeholder="Harga..." value="<?php echo number_format($value->harga_item_so,0,'.','.'); ?>"><input type="hidden" name="harga_so[]" value="" onkeyup="kurensi_harga_so(<?php echo $value->id_sample_acc; ?>)" value="<?php echo $value->harga_item_so; ?>">
                                            </td>
                                            </tr>
                                        <?php
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                               <!--  <div>
                                    <a class="btn btn-sm btn-danger delete-row">Hapus Baris</a>
                                </div> -->
                                <br>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="catatan_so" class="text-primary"><b>Catatan Sales Order</b></label>
                                        <textarea name="catatan_so" class="form-control" placeholder="Catatan sales order..." rows="4"><?php echo $data_so->catatan_sales_order; ?></textarea>
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
    function kembali() {
        window.history.back();
    }

    // function status_table(){
    //    if ($('#table-produk tr td').hasClass('dataTables_empty')) {
    //         $('.delete-row').attr('hidden', 'true');
    //    }else{
    //         $('.delete-row').removeAttr('hidden');

    //    }
    // }

    function kurensi_kuantitas(id){
        var kuantitas = $('tr#id'+id).find("input[name='quantity_text[]']").val().replace(/[^0-9]/g, '').toString(); 
        $('tr#id'+id).find("input[name='quantity_text[]']").val(kuantitas.replace(/[^0-9]/g, '').toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
        $('tr#id'+id).find("input[name='quantity[]']").val(kuantitas);
    }

    function kurensi_retur(id){
        var retur = $('tr#id'+id).find("input[name='retur_text[]']").val().replace(/[^0-9]/g, '').toString();
        $('tr#id'+id).find("input[name='retur_text[]']").val(retur.replace(/[^0-9]/g, '').toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
        $('tr#id'+id).find("input[name='retur[]']").val(retur);
    }

    function kurensi_terkirim(id){
        var terkirim = $('tr#id'+id).find("input[name='terkirim_text[]']").val().replace(/[^0-9]/g, '').toString();
        $('tr#id'+id).find("input[name='terkirim_text[]']").val(terkirim.replace(/[^0-9]/g, '').toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
        $('tr#id'+id).find("input[name='terkirim[]']").val(terkirim);
    }

    $(document).ready(function() {
        // status_table();

        // $('#brand').select2({
        //     theme: 'bootstrap'
        // });

        // $('#produk_so').select2({
        //     theme: 'bootstrap'
        // });
        
        // Find and remove selected table rows
        // $(".delete-row").click(function(){
        //     var values = new Array();
        //     var id_user = new Array();
        //     $('input[name="record[]"]:checked').each(function() {   
        //         var row = $(this).closest('tr');
        //         $(this).parents("tr").remove();
        //         if($('#table-produk tbody').children().length == 0){
        //             $("#data_produk").html('<tr><td colspan="7" align="center" class="dataTables_empty">Tidak ada produk yang di pilih</td></tr>');
        //             $('.delete-row').attr('hidden', 'true');
        //         }
        //     });
            // status_table();
        // });

        // $("#simpan-pilih").click(function(event) {
        //     var values = $("#produk_so").val();
        //     if (values == null) {
        //         alert('Produk tidak ditemukan, mungkin produk yang mau anda pilih sudah ada di tabel atau anda belum memilih merk :)');
        //     }else{
        //         $.ajax({
        //           url: "<?php echo base_url('sample/json_row_acc'); ?>",
        //           type: 'POST',
        //           dataType: 'JSON',
        //           data: {id: values},
        //           success : function(res){
        //             if ($('#table-produk tr td').hasClass('dataTables_empty')) {
        //                  $("#data_produk").html(res);
        //             }else{
        //                  $("#data_produk").append(res);
        //             }
        //           }
        //         }).then(function () {
        //             status_table();
        //             $("#produk_so option[value='"+values+"']").attr('disabled', 'true');
        //         })
        //     }
        // });

        // $('#brand').change(function(event) {
        //     $('#produk_so').html('');
        //     var id = $(this).val();
        //     if (id == '-') {
        //         alert('harap pilih brand atau merk !');
        //     }else{
        //         $.ajax({
        //             url: "<?php echo base_url().'sample/json_acc_customer'; ?>",
        //             type: 'POST',
        //             dataType: 'json',
        //             data: {id: id},
        //             success: function(data){
        //                 // console.log(data);
        //                 $.each(data, function(i, val) {
        //                     $('#produk_so').append($("<option />").val(val.id_sample_acc).text(val.nama_produk_acc+" "+val.volume_produk_acc));
        //                 });
        //             }
        //         });
        //     }
        // });
    });
</script>

</body>
</html>