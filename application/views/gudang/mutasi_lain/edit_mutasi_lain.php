<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Mutasi Barang</title>

    <?php $this->load->view('partials/head', FALSE); ?>
    
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view('partials/sidebar_gudang', FALSE); ?>
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
                    <h1 class="h4 mb-2 text-gray-800">Ubah Mutasi Barang</h1>

                    <!-- DataTales Example -->
                    <form action="<?php echo base_url().'mutasi/update_lain' ?>" method="post" accept-charset="utf-8">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <?php 
                                            foreach ($data_mutasi as $value) {
                                        ?>
                                        <div class="form-group">
                                            <label for="tgl_mutasi" class="text-primary"><b>Tanggal</b> (bulan/hari/tahun)</label>
                                            <input type="date" name="tgl_mutasi" required="" class="form-control" id="datepicker" value="<?php echo $value->tanggal_mutasi_lain; ?>">
                                            <input type="hidden" name="id_mutasi_lain" value="<?php echo $value->id_mutasi_lain; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="shift" class="text-primary"><b>Shift</b></label>
                                            <select name="shift" class="form-control" required="">
                                                <option value="1" <?php if($value->shift_mutasi_lain == '1'){echo "selected";} ?>>1</option>
                                                <option value="2" <?php if($value->shift_mutasi_lain == '2'){echo "selected";} ?>>2</option>
                                                <option value="3" <?php if($value->shift_mutasi_lain == '3'){echo "selected";} ?>>3</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="department" class="text-primary"><b>Department</b></label>
                                            <input type="text" name="department" class="form-control" placeholder="Pilih department" list="list-department" value="<?php echo $value->department; ?>">
                                            <datalist id="list-department">
                                                <option value="Production">Production</option>
                                                <option value="RnD">RnD</option>
                                                <option value="Quality Control">Quality Control</option>
                                                <option value="Purchasing">Purchasing</option>
                                                <option value="Marketing">Marketing</option>
                                            </datalist>
                                        </div>
                                        <?php
                                            }
                                         ?>
                                        <div class="form-group"> 
                                            <label for="mitra" class="text-primary"><b>Pilih Bahan</b></label>
                                            <select name="mitra" required="" class="form-control" id="barang" required="">
                                                <?php foreach ($data_bahan as $key) {
                                                ?>
                                                <option value="<?php echo $key->id_produk ?>">
                                                    <?php echo $key->kode_produk." - ".$key->nama_produk.' - '.$key->nama_mitra.' ('.$key->no_mitra.')'; ?>
                                                </option>
                                                <?php
                                                } ?>
                                            </select>
                                            <a href="#!" class="btn btn-sm btn-primary float-right mt-1" id="simpan-pilih">Masukkan Bahan <i class="fa fa-arrow-down"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <?php 
                                            foreach ($data_mutasi as $value) {
                                        ?>
                                         <div class="form-group">
                                            <label for="keterangan_mutasi_lain" class="text-primary"><b>Keterangan</b> <u>(PENYERAHAN / PENGEMBALIAN)</u></label> 
                                            <textarea name="keterangan_mutasi_lain" class="form-control" placeholder="Tambahkan keterangan..." rows="4"><?php echo $value->keterangan_mutasi_lain; ?></textarea>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                                <br>    
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tableBarangMutasi" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Pilih</th>
                                                <th>Nama Bahan</th>
                                                <th>No. Analisa</th>
                                                <th>Diserahkan</th>
                                                <th width="100">Satuan</th>
                                                <th>Dikembalikan</th>
                                                <th width="100">Satuan</th>
                                                <th>Reject</th>
                                                <th width="100">Satuan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="data_order">
                                            <?php 
                                            foreach ($data_detail as $value) {
                                            ?>
                                            <tr id="id<?php echo $value->id_produk; ?>">
                                                <td>
                                                    <input type="checkbox" name="record" class="form-control form-control-sm">
                                                    <input type="hidden" name="id_produk[]" value="<?php echo $value->id_produk; ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="nama_produk[]" placeholder="Nama Bahan Baku" required="" class="form-control" value="<?php echo $value->nama_produk; ?>" readonly="">
                                                </td>
                                                <td>
                                                    <input type="text" name="analisa_mutasi_lain[]" placeholder="No. Analisa" required="" class="form-control" value="<?php echo $value->analisa_mutasi_lain; ?>">
                                                </td>
                                                <td>
                                                    <input type="number" onkeyup="cek_stok(<?php echo $value->id_produk; ?>)" step=".001" name="diserahkan[]" placeholder="Diserahkan" required="" class="form-control" value="<?php echo $value->diserahkan; ?>">
                                                    <input type="hidden" name="diserahkan_temp[]" value="<?php echo $value->diserahkan; ?>">
                                                </td>
                                                <td>
                                                    <select name="satuan_diserahkan[]" class="form-control" required="" onchange="cek_stok(<?php echo $value->id_produk; ?>)">
                                                    <option value="KG" <?php echo $status=($value->satuan_diserahkan == 'KG') ? 'selected' : ''; ?>>KG</option>
                                                    <option value="Gram" <?php echo $status=($value->satuan_diserahkan == 'Gram') ? 'selected' : ''; ?>>Gram</option>
                                                    <option value="Pieces" <?php echo $status=($value->satuan_diserahkan == 'Pieces') ? 'selected' : ''; ?>>Pcs</option>
                                                    <option value="Roll" <?php echo $status=($value->satuan_diserahkan == 'Pieces') ? 'selected' : ''; ?>>Roll</option>
                                                </select>
                                                </td>
                                                <td>
                                                    <input type='number' step='.001' name='dikembalikan[]' placeholder='Dikembalikan' class='form-control' value="<?php echo $value->dikembalikan; ?>">
                                                    <input type="hidden" name="dikembalikan_temp[]" value="<?php echo $value->dikembalikan; ?>">
                                                </td>
                                                <td>
                                                    <select name="satuan_dikembalikan[]" class="form-control" required="">
                                                        <option value="KG" <?php echo $status=($value->satuan_dikembalikan == 'KG') ? 'selected' : ''; ?>>KG</option>
                                                        <option value="Gram" <?php echo $status=($value->satuan_dikembalikan == 'Gram') ? 'selected' : ''; ?>>Gram</option>
                                                        <option value="Pieces" <?php echo $status=($value->satuan_dikembalikan == 'Pieces') ? 'selected' : ''; ?>>Pcs</option>
                                                        <option value="Roll" <?php echo $status=($value->satuan_dikembalikan == 'Pieces') ? 'selected' : ''; ?>>Roll</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type='number' step='.001' name='reject[]' placeholder='Reject' class='form-control' value='<?php echo $value->reject; ?>'>
                                                </td>
                                                <td>
                                                    <select name="satuan_reject[]" class="form-control">
                                                        <option value="KG" <?php echo $status=($value->satuan_reject == 'KG') ? 'selected' : ''; ?>>KG</option>
                                                        <option value="Gram" <?php echo $status=($value->satuan_reject == 'Gram') ? 'selected' : ''; ?>>Gram</option>
                                                        <option value="Pieces" <?php echo $status=($value->satuan_reject == 'Pieces') ? 'selected' : ''; ?>>Pcs</option>
                                                        <option value="Roll" <?php echo $status=($value->satuan_reject == 'Pieces') ? 'selected' : ''; ?>>Roll</option>
                                                    </select>
                                                    <input type='hidden' name='stok[]' value="<?php echo $value->stok; ?>">
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
                                <div class="row ml-0">
                                        <div class="col-6">
                                        <?php 
                                            foreach ($data_mutasi as $value) {
                                        ?>
                                        <label for="catatan_mutasi_lain" class="text-primary"><b>Catatan</b></label>
                                        <!-- <textarea name="catatan" id="ckeditor" class="ckeditor"></textarea> -->
                                        <textarea name="catatan_mutasi_lain" rows="6" class="form-control" placeholder="Tambahkan catatan..."><?php echo $value->catatan_mutasi_lain; ?></textarea><br>
                                        <?php
                                            }
                                         ?>    
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">&nbsp;</div>
                                    <div class="col-6">
                                        <a onclick="kembali()" class="btn btn-sm btn-secondary float-right"><i class="fas fa-times"></i> Batal</a>
                                        <button type="submit" class="btn btn-sm btn-primary float-right mr-1 btn-simpan"><i class="fas fa-save"></i> Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php $this->load->view('partials/footer', FALSE); ?>
            <!-- End of Footer -->

            <!--Danger theme Modal -->
            <div class="modal fade text-left" id="danger" tabindex="-1"
                role="dialog" aria-labelledby="myModalLabel120"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                    role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h5 class="modal-title text-white" id="myModalLabel120">
                                Peringatan !
                            </h5>
                            <button type="button" class="close"
                                data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <div class="modal-body" id="teks-peringatan">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">Oke <i class="fas fa-times"></i> </button>
                        </div>
                    </div>
                </div>
            </div>

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
    CKEDITOR.replace('catatan_mutasi_lain');
    CKEDITOR.replace('keterangan_mutasi_lain');

    function kembali(){
        window.history.back();
    }

    $(function(){
        $('#barang').select2({
            theme: 'bootstrap'
        });
    });

     function status_table(){
       if ($('#tableBarangMutasi tr td').hasClass('dataTables_empty')) {
            $('.delete-row').attr('hidden', 'true');
       }else{
            $('.delete-row').removeAttr('hidden');
       }
    }

    function cek_stok(data){
        var nama_bahan = $('tr#id'+data).find("input[name='nama_produk[]']").val();  
        var stok = parseFloat($('tr#id'+data).find("input[name='stok[]']").val());    
        var satuan = $('tr#id'+data).find("select[name='satuan_diserahkan[]'] option:selected").val();    
        var diserahkan = parseFloat($('tr#id'+data).find("input[name='diserahkan[]']").val());  
        var calc_diserahkan = 0;
        var satuan_gram = '';

        if (satuan == 'Gram') {
            calc_diserahkan = diserahkan/1000;
            satuan_gram = 'KG';
        }else{
            calc_diserahkan = diserahkan;
            satuan_gram = satuan;
        }

        if (calc_diserahkan > stok) {
            var teks = "Stok bahan dengan nama <b>"+nama_bahan+"</b> tidak cukup ! <br> Stok bahan saat ini : "+stok+" KG <br> Yang akan anda serahkan : "+calc_diserahkan+" "+satuan_gram;
            $('#teks-peringatan').html(teks);
            $('#danger').modal({backdrop: 'static', keyboard: false});
            $('tr#id'+data).find("input[name='diserahkan[]']").val(''); 
        }else{
            // console.log('tarik sis!');
        }
    }

    $(document).ready(function() {
        $('#delete-row').removeAttr('hidden');
        // status_table();
        
        // Find and remove selected table rows
        $(".delete-row").click(function(){
            var values = new Array();
            var id_produk = new Array();
            var total = 0;
            let cek_barang = $('input[name="record"]:checked').length;

            if (cek_barang == 0) {
                alert('Anda belum memilih barang yang akan dihapus.');
            }else{
                $('input[name="record"]:checked').each(function() {   
                    var row = $(this).closest('tr');
                    values.push(parseInt(row.find("td input[name='jumlah[]']").val()));
                    id_produk.push(parseInt(row.find("td input[name='id_produk[]']").val()));
                    $(this).parents("tr").remove();
                    if($('#tableBarangMutasi tbody tr').length == 0){
                        $("#data_order").html('<tr><td colspan="8" align="center" class="dataTables_empty">Tidak ada barang yang di pilih</td></tr>');
                        $('.delete-row').attr('hidden', 'true');
                    }
                });
                status_table();
            }
        });
    });

    $(function() {
        $(document).on('click', '#simpan-pilih', function() {
            var values = $('#barang').val();
              $.ajax({
                  url: "<?php echo base_url('produk/get_produk_mutasi') ?>",
                  type: 'POST',
                  dataType: 'JSON',
                  data: {id_produk: values},
                  success : function(res){
                    // $("#data_order").append(res);
                    if ($('#tableBarangMutasi tr td').hasClass('dataTables_empty')) {
                         $("#data_order").html(res);
                    }else{
                         $("#data_order").append(res);
                    }
                  }
              }).then(function () {
                status_table();
                $("#barang option[value='"+values+"']").attr('disabled', 'true');
              })
        });
    });
</script>

</body>
</html>