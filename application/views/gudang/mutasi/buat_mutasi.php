<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Mutasi</title>

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
                    <h1 class="h4 mb-2 text-gray-800">Buat Mutasi Bahan <?php echo $this->uri->segment(3); ?></h1>

                    <!-- DataTales Example -->
                    <form action="<?php echo base_url().'mutasi/simpan/'.$this->uri->segment(3) ?>" method="post" accept-charset="utf-8">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="tgl_mutasi" class="text-primary"><b>Tanggal</b> (bulan/hari/tahun)</label>
                                            <input type="date" name="tgl_mutasi" required="" class="form-control" id="datepicker" value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="shift" class="text-primary"><b>Shift</b></label>
                                            <select name="shift" class="form-control" required="">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_produk_jadi" class="text-primary"><b>Nama Produk</b></label>
                                            <input type="text" class="form-control" name="nama_produk_jadi" value="" placeholder="Masukkan nama produk..." required="">
                                        </div>
                                        <div class="form-group"> 
                                            <label for="mitra" class="text-primary"><b>Pilih Bahan</b></label>
                                            <select name="mitra" required="" class="form-control" id="barang" required="">
                                                <?php foreach ($produk as $key) {
                                                ?>
                                                <option value="<?php echo $key->id_produk ?>"><?php echo $key->kode_produk." - ".$key->nama_produk; ?></option>
                                                <?php
                                                } ?>
                                            </select>
                                            <a href="#!" class="btn btn-sm btn-primary float-right mt-1" id="simpan-pilih">Masukkan Bahan <i class="fa fa-arrow-down"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="jumlah_batch" class="text-primary"><b>Jumlah Batch</b></label>
                                            <input type="text" id="jumlah_batch_text" class="form-control" required="" class="form-control" placeholder="Masukkan jumlah batch..." onkeyup="format_batch()">
                                            <input type="hidden" name="jumlah_batch" id="jumlah_batch" value="">
                                            <a href="#!" onclick="show_no_batch()" class="btn btn-sm btn-primary mt-1"><i class="fas fa-edit"></i> Input Nomor Batch</a>
                                        </div>
                                        <div class="form-group" id="div-nomor-batch">
                                            <label for="no_batch" class="text-primary"><b>Nomor Batch</b></label>
                                            <div class="contain"></div>
                                        </div>
                                    </div>
                                </div>
                                <br>    
                                <div class="table-responsive">
                                    <table class="table" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Pilih</th>
                                                <th>Nama Bahan</th>
                                                <th>Diserahkan</th>
                                                <th width="80">Satuan</th>
                                                <th>Dikembalikan</th>
                                                <th width="80">Satuan</th>
                                                <th>Reject</th>
                                                <th width="80">Satuan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="data_order">
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    <a class="btn btn-sm btn-danger delete-row">Hapus Baris</a>
                                </div><br>
                                <div class="row ml-0">
                                        <div class="col-6">
                                            <label for="catatan_mutasi" class="text-primary"><b>Catatan</b></label>
                                            <!-- <textarea name="catatan" id="ckeditor" class="ckeditor"></textarea> -->
                                            <textarea name="catatan_mutasi" rows="6" class="form-control" placeholder="Tambahkan catatan..."></textarea><br>
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
    CKEDITOR.replace('catatan_mutasi');

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
       if ($('#dataTable tr td').hasClass('dataTables_empty')) {
            $('.delete-row').attr('hidden', 'true');
       }else{
            $('.delete-row').removeAttr('hidden');

       }
    }
     $(document).ready(function() {
        $('#div-nomor-batch').attr('hidden', 'true');
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
            });
            status_table();
        });
    });

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

    function format_batch(){
        var jml_batch_text = $('#jumlah_batch_text').val().replace(/[^0-9]/g, '').toString();
        $('#jumlah_batch_text').val(jml_batch_text.replace(/[^0-9]/g, '').toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
        $('#jumlah_batch').val(jml_batch_text);
    }

    function show_no_batch(){
        var angka = 1;
        var jumlah_batch = $('#jumlah_batch').val();
        $('.contain').html('');

        if (jumlah_batch === '') {
            alert('Harap masukkan jumlah batch terlebih dahulu!');
        }else{
            $('#div-nomor-batch').removeAttr('hidden');
            for (var i = 0; i < jumlah_batch; i++) {
                $('.contain').append("<input type='text' class='form-control mb-1' name='no_batch[]' value='' placeholder='Masukkan nomor batch ke-"+angka+"...' required>");
                angka++;
            }
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

    $(function() {
        $(document).on('click', '#simpan-pilih', function() {
            var values = $('#barang').val();
              $.ajax({
                  url: "<?php echo base_url('produk/get_produk_mutasi') ?>",
                  type: 'POST',
                  dataType: 'JSON',
                  data: {id_produk: values},
                  success : function(res){
                    if ($('#dataTable tr td').hasClass('dataTables_empty')) {
                         $("#data_order").html(res);
                   }else{
                         $("#data_order").append(res);
                    }
                  }
              }).then(function () {
                status_table();
                // status_matauang(values);
                // clear_total();
                $("#barang option[value='"+values+"']").attr('disabled', 'true');
              })
        });
    });
</script>

</body>
</html>