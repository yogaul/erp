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
                    <h1 class="h4 mb-2 text-gray-800">Buat MPS Kalkulator</h1>

                    <!-- DataTales Example -->
                    <form action="<?php echo base_url().'kalkulator/simpan' ?>" method="post" id="form-kalkulator">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="tgl_kalkulator" class="text-primary"><b>Tanggal</b> (bulan/hari/tahun)</label>
                                            <input type="date" name="tgl_kalkulator" required="" class="form-control" id="datepicker" value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                        <div class="form-group"> 
                                            <label for="kode_formula" class="text-primary"><b>Kode Formula</b></label>
                                            <select name="kode_formula" class="form-control mselect" required="" id="kode-formula">
                                            </select>
                                        </div>
                                        <a href="#!" class="btn btn-sm btn-primary float-right" id="simpan-pilih">Masukkan <i class="fa fa-arrow-down"></i></a>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="produk" class="text-primary"><b>Produk</b></label>
                                            <select name="produk" class="form-control mselect" required="" id="produk-jadi-msglow">
                                                <option value="" disabled selected>Pilih produk</option>
                                                <?php
                                                    foreach ($produk as $value) {
                                                ?>
                                                <option value="<?= $value->id_produk_msglow ?>"><?= $value->nama_produk_msglow ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group"> 
                                            <label for="jumlah_produksi" class="text-primary"><b>Jumlah Produksi</b> (Pcs)</label>
                                            <input type="text" class="form-control" required placeholder="jumlah produksi..." id="jumlah-produksi-text" onkeyup="hitung_total()">
                                            <input type="hidden" name="jumlah_produksi" id="jumlah_produksi">
                                        </div>
                                    </div>
                                </div>
                                <br>    
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tableBarangMutasi" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nama Bahan</th>
                                                <th>Stok</th>
                                                <th>Persentase (%)</th>
                                                <th>Komposisi/Pcs</th>
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
                                <br>
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
                                        <button type="submit" class="btn btn-sm btn-primary float-right mr-1"><i class="fas fa-save"></i> Simpan</button>
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

    var kode_formula = [];
    var id_detail = [];

    CKEDITOR.replace('catatan_kalkulator');

    function kembali(){
        window.history.back();
    }

    $(function(){
        $('.mselect').select2({
            theme: 'bootstrap'
        });
    });

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
        let produksi_text = $('#jumlah-produksi-text').val();
        let produksi = $('#jumlah-produksi-text').val().replace(/\./g,'').replace(/,/g, '.').toString();
        var total = 0;

        $('#jumlah-produksi-text').val(kurensi_rupiah(produksi_text));
        $('#jumlah_produksi').val(produksi);

        if (id_detail.length != 0) {
            id_detail.forEach(function(value){
                hitung_persen(value);
            });
        }
    
    }

    function hitung_persen(id){
        let stok = $('tr#id'+id).find("input[name='stok[]']").val();    
        let komposisi = $('tr#id'+id).find("input[name='komposisi_text[]']").val().replace(/\./g,'').replace(/,/g, '.').toString(); 
        let produksi = $('#jumlah-produksi-text').val().replace(/\./g,'').replace(/,/g, '.').toString();
        var total_kebutuhan = 0;
        var total_kurang = 0;

        total_kebutuhan = komposisi*produksi;
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

    $(document).ready(function() {

        kode_formula = [];
        id_detail = [];
    
        $('#simpan-pilih').click(function (e) { 
            let id = $('#kode-formula').val();
            var mrow = "";
            kode_formula = [];
            id_detail = [];

            $.ajax({
                type: "POST",
                url: "<?= base_url().'glow/json_detail_bom' ?>",
                data: {id_bom: id},
                dataType: "json",
                success: function (response) {
                    if (response.length == 0) {
                        alert('Data tidak ditemukan !');
                    }else{
                        kode_formula.push(id);
                        $.each(response, function (indexInArray, valueOfElement) { 
                            id_detail.push(valueOfElement.id_detail_bom_produk);
                            mrow += "<tr id='id"+valueOfElement.id_detail_bom_produk+"'>";
                            mrow += "<td><input type='hidden' name='id_bahan[]' value='"+valueOfElement.id_produk+"'><input type='text' name='nama_produk[]' placeholder='Nama Bahan Baku' required='' class='form-control' value='"+valueOfElement.nama_produk+"' readonly=''></td>";
                            mrow += "<td><input type='text' name='stok_text[]' readonly class='form-control' value='"+kurensi_teks(valueOfElement.stok)+"' readonly=''><input type='hidden' name='stok[]' value='"+valueOfElement.stok+"'></td>";
                            mrow += "<td><input type='text' name='persentase_text[]' placeholder='Persentase' class='form-control' value='"+kurensi_teks(valueOfElement.persentase)+"' readonly><input type='hidden' name='persentase[]' class='persen' value='"+valueOfElement.persentase+"'></td>";
                            mrow += "<td><input type='text' name='komposisi_text[]' placeholder='Komposisi' class='form-control' value='"+kurensi_teks(valueOfElement.komposisi_per_unit)+"' readonly><input type='hidden' name='komposisi[]' class='komposisi' value='"+valueOfElement.komposisi_per_unit+"'></td>";
                            mrow += "<td><input type='text' name='jumlah_kebutuhan_text[]' placeholder='Kebutuhan' class='form-control' readonly><input type='hidden' name='jumlah_kebutuhan[]'></td>";
                            mrow += "<td><input type='text' name='jumlah_kekurangan_text[]' placeholder='Kurang' class='form-control' readonly><input type='hidden' name='jumlah_kekurangan[]'></td></tr>";
                        });

                        $("#data_order").html(mrow);

                        id_detail.forEach(function(value){
                            hitung_persen(value);
                        });
                    }
                }
            })
        });
        
        $('#produk-jadi-msglow').change(function (e) { 
            // e.preventDefault();
            $('#kode-formula').html('');
            let id = $(this).val();
            var mbom = "";
            
            $.ajax({
                type: "POST",
                url: "<?= base_url().'glow/json_bom_produk' ?>",
                data: {id_produk: id},
                dataType: "json",
                success: function (response) {
                    if (response.length == 0) {
                        alert('Data tidak ditemukan !');
                    }else{
                        mbom += "<option disabled selected>Pilih formula</option>";
                        $.each(response, function (indexInArray, valueOfElement) { 
                            mbom += "<option value="+valueOfElement.id_bom_produk_jadi+">"+valueOfElement.kode_formula_produk+"</option>";
                        });
                        $('#kode-formula').html(mbom);
                    }
                }
            });
        });
    });
</script>

</body>
</html>