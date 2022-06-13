<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - BOM</title>

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
                    <h1 class="h4 mb-2 text-gray-800">Ubah Bill Of Materials (BOM)</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <form action="<?php echo base_url().'bom/ubah_bom' ?>" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="brand_so" class="text-primary"><b>Brand (Merk)</b></label>
                                        <input type="hidden" name="id_bom" value="<?php echo $data_bom->id_bom; ?>">
                                        <input type="hidden" name="brand_bom_temp" value="<?php echo $data_bom->id_brand_produk; ?>">
                                        <select name="brand_so" required="" class="form-control" id="brand">
                                            <option value="-" disabled="" selected="">Pilih merk</option>
                                            <?php foreach ($brand as $key) {
                                            ?>
                                            <option value="<?php echo $key->id_brand_produk; ?>" <?php echo $pilihan = ($data_bom->id_brand_produk == $key->id_brand_produk) ? 'selected' : ''; ?>><?php echo $key->nama_brand_produk." - ".$key->nama_customer; ?></option>
                                            <?php
                                            } 
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="produk_bom" class="text-primary" id="produk"><b>Produk</b></label>
                                        <select name="produk_bom" required="" class="form-control form-control-sm" id="produk_bom">
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
                                                <th width="100px">Pilih</th>
                                                <th>Nama Produk</th>
                                                <th>Shrink</th>
                                                <th>Inner Box</th>
                                                <th>Label</th>
                                                <th>Karton</th>
                                                <th>Lain-lain</th>
                                                <th>Coding</th>
                                                <th>Status</th>
                                                <th>Foto Desain</th>
                                            </tr>
                                        </thead>
                                        <tbody id="data_produk">
                                        <?php 
                                            foreach ($detail_bom as $value) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="record[]" class="form-control form-control-sm"/>
                                                    <input type="hidden" name="id_produk[]" value="$value->id_sample_acc" />
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm" name="nama_produk" value="<?php echo $value->nama_produk_acc." ".$value->volume_produk_acc; ?>" readonly=""/>
                                                 </td>
                                                <td>
                                                    <select name="shrink[]" class="form-control form-control-sm">
                                                     <option value="Kemasan Primer" <?php if($value->shrink_bom == 'Kemasan Primer'){echo 'selected';} ?>>Primer</option>
                                                     <option value="Inner Box" <?php if($value->shrink_bom == 'Inner Box'){echo 'selected';} ?>>Inner Box</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="inner_box[]" class="form-control form-control-sm" value="iya" <?php if($value->inner_box_bom == 'iya'){echo 'checked';} ?>/>
                                                </td>
                                                <td>
                                                    <select name="label[]" class="form-control form-control-sm">
                                                       <option value="Printing" <?php if($value->label_bom == 'Printing'){echo 'selected';} ?>>Printing</option>
                                                       <option value="Sticker" <?php if($value->label_bom == 'Sticker'){echo 'selected';} ?>>Sticker</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="karton[]" class="form-control form-control-sm">
                                                       <option value="Kosme" <?php if($value->karton_bom == 'Kosme'){echo 'selected';} ?>>Kosme</option>
                                                       <option value="Polos" <?php if($value->karton_bom == 'Polos'){echo 'selected';} ?>>Polos</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" name="lain[]" value="<?php echo $value->lain_lain_bom; ?>" placeholder="Lain-lain" class="form-control form-control-sm"/>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="coding[]" class="form-control form-control-sm" value="iya" <?php if($value->coding_bom == 'iya'){echo 'checked';} ?>/>
                                                </td>
                                                <td>
                                                    <input type="text" name="ro1[]" value="<?php echo $value->ro_bom; ?>" placeholder="ro1" class="form-control form-control-sm"/>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="temp_foto_desain[]" value="<?php echo $value->foto_desain_bom; ?>">
                                                    <input type="file" name="foto_desain[]" placeholder="" class="form-control-file form-control-sm"/>
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
                                </div><br>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="catatan_bom" class="text-primary"><b>Catatan BOM</b></label>
                                        <textarea name="catatan_bom" class="form-control" placeholder="Catatan BOM..." rows="4"><?php echo $data_bom->catatan_bom; ?></textarea>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-6">&nbsp;</div>
                                    <div class="col-6">
                                        <a onclick="kembali()" class="btn btn-sm btn-secondary float-right"><i class="fas fa-times"></i> Batal</a>
                                        <button type="submit" name="btn_simpan_keluar" class="btn btn-sm btn-primary float-right mr-1 btn-simpan" disabled=""><i class="fas fa-save"></i> Simpan</button>
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
    CKEDITOR.replace('catatan_bom');

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

    $(document).ready(function() {
        status_table();

        $('#brand').select2({
            theme: 'bootstrap'
        });

        // $('#produk_bom').select2({
        //     theme: 'bootstrap'
        // });
        
        // Find and remove selected table rows
        $(".delete-row").click(function(){
            var values = new Array();
            var id_user = new Array();
            $('input[name="record[]"]:checked').each(function() {   
                var row = $(this).closest('tr');
                $(this).parents("tr").remove();
                if($('#table-produk tbody').children().length == 0){
                    $("#data_produk").html('<tr><td colspan="10" align="center" class="dataTables_empty">Tidak ada produk yang di pilih</td></tr>');
                    $('.delete-row').attr('hidden', 'true');
                }
            });
            // status_table();
        });

        $("#simpan-pilih").click(function(event) {
            var values = $("#produk_bom").val();
            if (values == null) {
                alert('Produk tidak ditemukan, mungkin produk yang mau anda pilih sudah ada di tabel atau anda belum memilih merk :)');
            }else{
                $.ajax({
                  url: "<?php echo base_url('sample/json_row_bom'); ?>",
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
            $('#produk_bom').html('');
            var id = $(this).val();
            $.ajax({
                url: "<?php echo base_url().'sample/json_acc_customer'; ?>",
                type: 'POST',
                dataType: 'json',
                data: {id: id},
                success: function(data){
                    // console.log(data);
                    $.each(data, function(i, val) {
                        $('#produk_bom').append($("<option />").val(val.id_sample_acc).text(val.nama_produk_acc+" "+val.volume_produk_acc));
                    });
                }
            });
        });
    });
</script>

</body>
</html>