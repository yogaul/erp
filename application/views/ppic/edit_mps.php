<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

<title>PT. KOSME - MPS Kalkulator</title>

    <?php $this->load->view('partials/head', FALSE); ?>
    
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view('partials/sidebar_ppic', FALSE); ?>
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
                    <h1 class="h4 mb-2 text-gray-800">Ubah MPS Kalkulator</h1>

                    <!-- DataTales Example -->
                    <form action="<?php echo base_url().'kalkulator/simpan' ?>" method="post" id="form-kalkulator">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="tgl_kalkulator" class="text-primary"><b>Tanggal</b> (bulan/hari/tahun)</label>
                                            <input type="date" name="tgl_kalkulator" required="" class="form-control" id="datepicker" value="<?= $mps->tanggal_mps_kalkulator ?>">
                                        </div>
                                        <div class="form-group"> 
                                            <label for="volume_produk" class="text-primary"><b>Volume </b> (ml/pcs)</label>
                                            <input type="text" class="form-control" required placeholder="Volume produk pcs..." id="volume-text" onkeyup="hitung_total()" value="<?= number_format($mps->volume_pcs_produksi,0,',','.') ?>">
                                            <input type="hidden" name="volume" id="volume" value="<?= $mps->volume_pcs_produksi ?>">
                                        </div>
                                        <div class="form-group"> 
                                            <label for="bahan_baku_pilih" class="text-primary"><b>Bahan Baku</b></label>
                                            <select name="bahan_baku_pilih" class="form-control mselect" required="" id="bahan-baku">
                                                <?php
                                                    foreach ($baku as $value) {
                                                ?>
                                                <option value="<?= $value->id_produk ?>"><?= $value->nama_produk ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <a href="#!" class="btn btn-sm btn-primary float-right" id="simpan-pilih">Masukkan Bahan <i class="fa fa-arrow-down"></i></a>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="produk" class="text-primary"><b>Produk</b></label>
                                            <select name="produk" class="form-control mselect" required="">
                                                <?php
                                                    foreach ($produk as $value) {
                                                ?>
                                                <option value="<?= $value->id_produk_msglow ?>" <?= ($mps->id_produk_msglow == $value->id_produk_msglow) ? 'selected' : '' ?>><?= $value->nama_produk_msglow ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group"> 
                                            <label for="jumlah_produksi" class="text-primary"><b>Jumlah Produksi</b> (Pcs)</label>
                                            <input type="text" class="form-control" required placeholder="jumlah produksi..." id="jumlah-produksi-text" onkeyup="hitung_total()" value="<?= number_format($mps->jumlah_produksi,0,',','.') ?>">
                                            <input type="hidden" name="jumlah_produksi" id="jumlah_produksi" value="<?= $mps->jumlah_produksi ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="total_kebutuhan" class="text-primary"><b>Total Kebutuhan</b></label>
                                            <input type="text" class="form-control" required placeholder="Total kebutuhan..." readonly id="total-kebutuhan-text" value="<?= number_format($mps->total_volume_produksi,0,',','.') ?>">
                                            <input type="hidden" name="total_kebutuhan" id="total_kebutuhan" value="<?= $mps->total_volume_produksi ?>">
                                        </div>
                                    </div>
                                </div>
                                <br>    
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tableBarangMutasi" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Pilih</th>
                                                <th>Nama Bahan</th>
                                                <th>Stok</th>
                                                <th>Persentase (%)</th>
                                                <th>Jumlah Kebutuhan</th>
                                                <th>Jumlah Kekurangan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="data_order">
                                            <tr>
                                                <td colspan="6" align="center" class="dataTables_empty">Tidak ada barang yang dipilih</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    <a class="btn btn-sm btn-danger delete-row">Hapus Baris</a>
                                </div><br>
                                <div class="row ml-0">
                                        <div class="col-6">
                                            <label for="catatan_kalkulator" class="text-primary"><b>Catatan</b></label>
                                            <textarea name="catatan_kalkulator" rows="6" class="form-control" placeholder="Tambahkan catatan..."></textarea><br>
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">&nbsp;</div>
                                    <div class="col-6">
                                        <a onclick="kembali()" class="btn btn-sm btn-secondary float-right"><i class="fas fa-times"></i> Batal</a>
                                        <a class="btn btn-sm btn-primary float-right mr-1 btn-simpan"><i class="fas fa-save"></i> Simpan</a>
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
                        <div class="modal-header">
                            <h5 class="modal-title text-primary" id="myModalLabel120">
                                <b>Peringatan !</b>
                            </h5>
                            <button type="button" class="close"
                                data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <div class="modal-body" id="teks-peringatan">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
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

    var kode_produk = [];

    CKEDITOR.replace('catatan_kalkulator');

    function kembali(){
        window.history.back();
    }

    $(function(){
        $('.mselect').select2({
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

    function hitung_total(){
        let volume_text = $('#volume-text').val();
        let volume = $('#volume-text').val().replace(/\./g,'').replace(/,/g, '.').toString();
        let produksi_text = $('#jumlah-produksi-text').val();
        let produksi = $('#jumlah-produksi-text').val().replace(/\./g,'').replace(/,/g, '.').toString();
        var total = 0;

        $('#volume-text').val(kurensi_rupiah(volume_text));
        $('#volume').val(volume);
        $('#jumlah-produksi-text').val(kurensi_rupiah(produksi_text));
        $('#jumlah_produksi').val(produksi);

        total = volume*produksi;
        if (!isNaN(total)) {
            $('#total-kebutuhan-text').val(kurensi_teks(total));
            $('#total_kebutuhan').val(total);
        }else{
            $('#total-kebutuhan-text').val(0);
            $('#total_kebutuhan').val(0);
        }

        if (kode_produk.length != 0) {
            kode_produk.forEach(function(value){
                hitung_persen(value);
            });
        }
    
    }

    function hitung_persen(id){
        let total_produksi = $('#total_kebutuhan').val();
        let stok = $('tr#id'+id).find("input[name='stok[]']").val();    
        let persen_text = $('tr#id'+id).find("input[name='persentase_text[]']").val();    
        let persen = $('tr#id'+id).find("input[name='persentase_text[]']").val().replace(/\./g,'').replace(/,/g, '.').toString(); 
        var total_kebutuhan = 0;
        var total_kurang = 0;

        if (persen > 100) {
            alert('Maksimal persentase adalah 100% !');
            $('tr#id'+id).find("input[name='persentase_text[]']").val(0);
            $('tr#id'+id).find("input[name='persentase[]']").val(0);
            $('tr#id'+id).find("input[name='jumlah_kebutuhan_text[]']").val(0);  
            $('tr#id'+id).find("input[name='jumlah_kebutuhan[]']").val(0);  
            $('tr#id'+id).find("input[name='jumlah_kekurangan_text[]']").val(0);  
            $('tr#id'+id).find("input[name='jumlah_kekurangan[]']").val(0);  
        }else{
            $('tr#id'+id).find("input[name='persentase_text[]']").val(kurensi_rupiah(persen_text));
            $('tr#id'+id).find("input[name='persentase[]']").val(persen);

            total_kebutuhan = persen*total_produksi/100;
            if (!isNaN(total_kebutuhan)) {
                $('tr#id'+id).find("input[name='jumlah_kebutuhan_text[]']").val(kurensi_teks(total_kebutuhan));  
                $('tr#id'+id).find("input[name='jumlah_kebutuhan[]']").val(total_kebutuhan);  
            }else{
                $('tr#id'+id).find("input[name='jumlah_kebutuhan_text[]']").val(0);  
                $('tr#id'+id).find("input[name='jumlah_kebutuhan[]']").val(0);  
            }

            total_kurang = total_kebutuhan-stok;
            if (!isNaN(total_kurang) && total_kurang > 0) {
                $('tr#id'+id).find("input[name='jumlah_kekurangan_text[]']").val(kurensi_teks(total_kurang));  
                $('tr#id'+id).find("input[name='jumlah_kekurangan[]']").val(total_kurang);  
            }else{
                $('tr#id'+id).find("input[name='jumlah_kekurangan_text[]']").val(0);  
                $('tr#id'+id).find("input[name='jumlah_kekurangan[]']").val(0);  
            }
        }
    }

    function count_persen(){
        var total_persen = 0;
        var mpersen = 0;
        $(".persen").each(function(){
            if ($(this).val() == '') {  
                mpersen = 0;
            }else{
                mpersen = parseInt($(this).val());
            }
            total_persen += mpersen;
        });
        return total_persen;
    }

    $(document).ready(function() {

        kode_produk = [];
        status_table();
    
        $(".delete-row").click(function(){
            let cek_barang = $('input[name="record"]:checked').length;

            if (cek_barang == 0) {
                alert('Anda belum memilih barang yang akan dihapus.');
            }else{
                $('input[name="record"]:checked').each(function() {   
                    var row = $(this).closest('tr');
                    kode_produk.splice(kode_produk.indexOf(row.find("td input[name='id_produk[]']").val()), 1);
                    $(this).parents("tr").remove();
                    if($('#data_order').html() == ""){
                        $("#data_order").html('<tr><td colspan="6" align="center" class="dataTables_empty">Tidak ada barang yang di pilih</td></tr>');
                        $('.delete-row').attr('hidden', 'true');
                    }
                });
                status_table();
            }
        });

        $('#simpan-pilih').click(function (e) { 
            let id = $('#bahan-baku').val();

            if (kode_produk.includes(id)) {
                alert('Bahan baku tersebut sudah ditambahkan !');
            }else{
                $.ajax({
                    type: "POST",
                    url: "<?= base_url().'produk/get_produk_kalkulator' ?>",
                    data: {id_produk: id},
                    dataType: "json",
                    success: function (response) {
                        kode_produk.push(id);
                        if ($('#tableBarangMutasi tr td').hasClass('dataTables_empty')) {
                            $("#data_order").html(response);
                        }else{
                            $("#data_order").append(response);
                        }
                    }
                }).then(function(){
                    status_table();
                })
            }
        });
        
        $('.btn-simpan').click(function (e) { 
            let persentase =  count_persen();
            console.log(persentase);
            if (persentase > 100) {
                $('#teks-peringatan').html('Maksimal persentase adalah 100% !');
                $('#danger').modal('show');
            }else{
                $('#form-kalkulator').submit();
            }
        });
    });
</script>

</body>
</html>