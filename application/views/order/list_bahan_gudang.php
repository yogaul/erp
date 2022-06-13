<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Bahan</title>

    <?php $this->load->view('partials/head', FALSE);?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php 
            if ($this->session->userdata('level') == 'purchasing') {
                $this->load->view('partials/sidebar', FALSE);
            }elseif ($this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier') {
                $this->load->view('partials/sidebar_gudang', FALSE);
            }elseif ($this->session->userdata('level') == 'ppic') {
                $this->load->view('partials/sidebar_ppic', FALSE);
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
                <h1 class="h4 mb-2 text-gray-800">Nomor PO :
                    <?php echo $no_po;?>
                </h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <form method="POST" action="<?php echo base_url().'order/cetak_proses'; ?>" id="form-pilihan-proses">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tableListBahan" width="100%">
                                    <thead>
                                        <tr>
                                            <?php
                                                if ($this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier') {
                                            ?>
                                            <th>Pilih</th>
                                            <?php
                                                }
                                            ?>
                                            <th>Supplier</th>
                                            <th>Kode Produk</th>
                                            <th>Nama</th>
                                            <th>Jumlah Order</th>
                                            <th>Satuan</th>
                                            <th>Jumlah Datang</th>
                                            <th>Kurang/Lebih</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            foreach ($detail_bahan as $value) {
                                        ?>
                                        <tr>
                                            <?php
                                                if ($this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier') {
                                            ?>
                                            <td>
                                                <input type="hidden" name="id_po" value="<?php echo $this->uri->segment(3); ?>">
                                                <input type="hidden" name="no_surat_jalan_proses" id="no_surat_jalan_proses">
                                                <input type="checkbox" name="id_detail[]" value="<?php echo $value->id_detail_order; ?>" class="form-control form-control-sm cek">
                                            </td>
                                            <?php
                                                }
                                            ?>
                                            <td><?php echo $value->nama_mitra; ?></td>
                                            <td><?php echo $value->kode_produk; ?></td>
                                            <td><?php echo $value->nama_produk; ?></td>
                                            <td><?php 
                                                $str_qtty = strval($value->kuantitas);
                                                if (strpos($str_qtty, '.') == TRUE) {
                                                    echo $value->kuantitas;
                                                }else{
                                                    echo number_format($value->kuantitas,0,',','.');
                                                }
                                            ?></td>
                                            <td><?php echo $value->satuan; ?></td>
                                            <td><?php 
                                                $str_datang = strval($value->datang);
                                                if (strpos($str_datang, '.') == TRUE) {
                                                    echo $value->datang;
                                                }else{
                                                    echo number_format($value->datang,0,',','.');
                                                }
                                            ?></td>
                                            <td><?php 
                                                 $str_kurang = strval($value->kurang);
                                                 echo $num = (strpos($str_kurang, '-') !== false) ? "+".number_format(str_replace('-','',$str_kurang),3,',','.') : number_format($str_kurang,3,',','.');
                                            ?></td>
                                            <td width="20">
                                                <div class="dropdown show">
                                                  <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Tindakan
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <?php 
                                                        if ($this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier') {
                                                    ?>
                                                    <a onclick="show_detail('<?php echo $value->id_detail_order; ?>')" class="dropdown-item" data-toggle="modal" data-target="#editModal" data-backdrop="static" data-keyboard="false" disabled><i class="fas fa-edit"></i> Input Kedatangan</a>
                                                    <?php
                                                        }
                                                    ?>
                                                    <a href="<?php echo base_url().'order/riwayat_datang/'.$value->id_detail_order; ?>" class="dropdown-item"><i class="fas fa-history"></i> Riwayat Kedatangan</a>
                                                  </div>
                                                </div>  
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                         ?>
                                    </tbody>
                                </table>
                                <?php 
                                    if ($this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier') {
                                ?>
                                <a onclick="cek_pilihan()" id="btn-cetak-pilih" class="btn btn-sm btn-primary mt-2 mb-2" disabled="true"><i class="fas fa-file-pdf"></i> Cetak Proses Penerimaan</a>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php $this->load->view('partials/footer', FALSE); ?>
            <!-- End of Footer -->

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                    <form action="<?php echo base_url().'Order/update_datang' ?>" method="post" id="form-bahan-datang">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary" id="exampleModalLabel"><b>Bahan Datang</b></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="kode_produk" class="text-primary"><b>Kode Produk</b></label>
                                        <input type="hidden" name="id_detail_po" id="id_po_modal">
                                        <input type="hidden" name="id_detail_order" id="id_detail_modal">
                                        <input type="hidden" name="kategori" id="kategori_modal">
                                        <input class="form-control" type="text" id="kode_produk_modal" name="kode_produk" readonly="">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_produk" class="text-primary"><b>Nama Produk</b></label>
                                        <input class="form-control" type="text" id="nama_produk_modal" name="nama_produk" readonly="">
                                    </div>
                                    <div class="form-group">
                                        <label for="kuantitas" class="text-primary"><b>Jumlah Order</b></label>
                                        <input class="form-control" id="kuantitas_modal" type="text" name="kuantitas" readonly="">
                                    </div>
                                    <div class="form-group" id="sudah_datang">
                                        <label for="sudah_datang" class="text-primary"><b>Yang Sudah Datang</b></label>
                                        <input class="form-control" id="sudah_datang_modal" type="number" step=".01" name="sudah_datang" required="" placeholder="Jumlah bahan yang sudah datang" readonly="">
                                    </div>
                                    <div class="form-group">
                                        <label for="nomor_surat_jalan" class="text-primary"><b>No. Surat Jalan</b></label>
                                        <input class="form-control" id="no_surat_jalan_modal" type="text" name="no_surat_jalan" required="" placeholder="Nomor surat jalan...">
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal_datang" class="text-primary"><b>Tanggal Kedatangan</b> (bulan/hari/tahun)</label>
                                        <input type="date" id="tgl_datang_modal" name="tanggal_datang" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="no_batch_datang" class="text-primary"><b>No. Batch/LOT</b></label>
                                        <input class="form-control" type="text" id="no_batch_modal" name="no_batch_datang" required="" placeholder="Nomor batch...">
                                    </div>
                                    <div class="form-group">
                                        <label for="kode_kedatangan" class="text-primary"><b>Kode Kedatangan</b> (<?php echo $kode; ?>)</label>
                                        <input class="form-control" type="text" id="kode_datang_modal" name="kode_kedatangan" required="" placeholder="Kode kedatangan...">
                                    </div>
                                    <div class="row ml-0" id="div_container_row">
                                        <div class="row mr-0 item1" id="div_contain_item">
                                        <div class="col-1">
                                            <div class="form-group">
                                                <label for="pilih" class="text-primary"><b>Pilih</b></label>
                                                <input type="checkbox" class="form-control" disabled="">
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label for="qty_datang" class="text-primary"><b>Qty</b></label>
                                                <input class="form-control" type="text" id="qty_datang_modal1" name="qty_datang_text" required="" placeholder="Qty..." onkeyup="hitung(1)">
                                                <input type="hidden" name="qty_datang[]" id="qty_datang1" onkeyup="hitung(1)">
                                                <input type="hidden" name="unique_id[]" id="unique_id1">
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label for="isi_datang" class="text-primary"><b>Isi</b></label>
                                                <input type="number" id="isi_datang1" name="isi_datang[]" step="0.01" onkeyup="hitung(1)" class="form-control" required="" placeholder="Isi...">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="satuan_datang" class="text-primary"><b>Satuan</b></label>
                                                <select name="satuan_datang[]" id="satuan_datang_modal1" class="form-control" required="" onchange="hitung(1)">
                                                    <option value="Kg" <?= $pilih = ($status == 'Baku') ? 'selected' : '' ?>>Kg</option>
                                                    <?php
                                                        if ($status == 'Baku') {
                                                    ?>
                                                    <option value="Gram">Gram</option>
                                                    <option value="Lembar">Lembar</option>
                                                    <?php
                                                        }else{
                                                    ?>
                                                    <option value="Pcs" selected>Pcs</option>
                                                    <option value="Roll">Roll</option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="kemasan_datang" class="text-primary"><b>Kemasan</b></label>
                                                <input class="form-control" type="text" id="kemasan_datang_modal" name="kemasan_datang[]" required="" placeholder="Kemasan...">
                                                <input type="hidden" name="subtotal_datang[]" class="subtotal_datang">
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-6">
                                            <a class="btn btn-sm btn-primary" id="tambah_row_datang" onclick="tambah('<?php echo $status; ?>')"><i class="fas fa-plus"></i> Tambah</a>
                                            <a class="btn btn-sm btn-danger" id="hapus_row_datang"><i class="fas fa-minus"></i> Hapus</a>
                                        </div>
                                    </div><hr>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="bahan_datang" class="text-primary"><b>Jumlah Bahan Datang</b></label>
                                                <input class="form-control" id="datang_baru_modal" type="text" name="bahan_datang_text" placeholder="Jumlah bahan datang..." readonly="">
                                                <input type="hidden" name="bahan_datang" id="bahan_datang">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exp_date" class="text-primary"><b>Expired Date</b> (bulan/hari/tahun)</label>
                                                <input type="date" name="exp_date" placeholder="" class="form-control" required="" id="expired_date_modal" <?= ($status != 'Baku') ? 'readonly' : '' ?>>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan_datang" class="text-primary"><b>Keterangan</b></label>
                                        <textarea class="form-control" id="keterangan_datang_modal" name="keterangan_datang" rows="4" placeholder="Keterangan..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button"  class="btn btn-sm btn-primary" onclick="simpan('<?= $status ?>')"><i class="fas fa-save"></i> Simpan & Cetak</button>
                            <a class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Batal</a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

            <!--Danger theme Modal -->
            <div class="modal fade text-left" id="inputCetakJalanModal" tabindex="-1"
                role="dialog" aria-labelledby="myModalLabel120"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                    role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary" id="myModalLabel120">
                                <b>Input Nomor Surat Jalan</b>
                            </h5>
                            <button type="button" class="close"
                                data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                       <div class="modal-body">
                            <div class="form-group">
                                <label for="no_surat_jalan_cetak" class="text-primary"><b>Nomor Surat Jalan</b></label>
                                <input type="text" class="form-control" name="no_surat_jalan_cetak" id="no_surat_jalan_cetak" placeholder="Nomor surat jalan..." required="" onkeyup="set_surat_jalan()">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-sm btn-primary" onclick="kirim_cetak()"><i class="fas fa-print"></i> Simpan & Cetak</a>
                            <a class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Batal</a>
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

    <!-- load js -->
    <?php $this->load->view('partials/js', FALSE);?>

<script>
    function deleteConfirm(url){
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }

    function cek_pilihan(){
        if($('input[name="id_detail[]"]:checked').length == 0){
            alert('Anda belum memilih item produk.');
        }else{
            $('#inputCetakJalanModal').modal({backdrop: 'static', keyboard: false});
        }
    }

    function set_surat_jalan(){
        var surat_jalan_cetak = $('.modal-body #no_surat_jalan_cetak').val();
        $('#no_surat_jalan_proses').val(surat_jalan_cetak);
    }

    function kirim_cetak(){
        var surat_jalan_cetak = $('.modal-body #no_surat_jalan_cetak').val();
        if (surat_jalan_cetak == '') {
            alert('Harap isi nomor surat jalan !');
        }else{
            $.ajax({
                url: "<?php echo base_url().'order/simpan_urut_cetak'; ?>",
                type: 'POST',
                dataType: 'json',
                data: {id: "<?php echo $this->uri->segment(3); ?>"},
                success: function(data){
                    $('#form-pilihan-proses').submit();
                    $('.modal-body #no_surat_jalan_cetak').val('');
                }
            });
        }
    }

    function show_detail(id){
        let unique_id = new Date().getTime();
        $('.modal-body #unique_id1').val(unique_id);

        $.ajax({
            url: "<?php echo base_url().'Order/json_detail' ?>",
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            success : function(data){
                // console.log(data)
                $.each(data, function(index, data) {
                     $('.modal-body #id_po_modal').val(data.id_po);
                     $('.modal-body #id_detail_modal').val(data.id_detail_order);
                     $('.modal-body #kategori_modal').val(data.kategori_produk);
                     $('.modal-body #kode_produk_modal').val(data.kode_produk);
                     $('.modal-body #nama_produk_modal').val(data.nama_produk);
                     $('.modal-body #kuantitas_modal').val(data.kuantitas);
                     $('.modal-body #sudah_datang_modal').val(data.datang);
                });
                $('#editModal').modal({backdrop: 'static', keyboard: false});
            }
        })
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

    function tambah(status){
        var html = "";
        var count_row = $('.modal-body #div_contain_item').length;
        var id = count_row+1;
        var unik = new Date().getTime();

        if (status == 'Baku') {
            html += "<div id='div_contain_item' class='row mr-0 item"+id+"'><div class='col-1'>";
            html += "<div class='form-group'><input type='checkbox' name='pilih' class='form-control'></div></div>";
            html += "<div class='col-2'><div class='form-group'><input class='form-control' type='text' id='qty_datang_modal"+id+"' name='qty_datang_text' required='' placeholder='Qty...' onkeyup='hitung("+id+")'><input type='hidden' name='qty_datang[]' id='qty_datang"+id+"' onkeyup='hitung("+id+")'><input type='hidden' name='unique_id[]' id='unique_id"+id+"' value='"+unik+"'></div></div>";
            html += "<div class='col-2'><div class='form-group'><input type='number' name='isi_datang[]' step='0.01' onkeyup='hitung("+id+")' id='isi_datang"+id+"' class='form-control' required='' placeholder='Isi...'></div></div>";
            html += "<div class='col-3'><div class='form-group'><select name='satuan_datang[]' id='satuan_datang_modal"+id+"' class='form-control' required='' onchange='hitung("+id+")'><option value='Kg' selected>Kg</option><option value='Gram'>Gram</option><option value='Lembar'>Lembar</option></select></div></div>";
            html += "<div class='col-4'><div class='form-group'><input class='form-control' type='text' id='kemasan_datang_modal' name='kemasan_datang[]' required='' placeholder='Kemasan...'><input type='hidden' name='subtotal_datang[]' class='subtotal_datang'></div></div></div>";
        }else{
            html += "<div id='div_contain_item' class='row mr-0 item"+id+"'><div class='col-1'>";
            html += "<div class='form-group'><input type='checkbox' name='pilih' class='form-control'></div></div>";
            html += "<div class='col-2'><div class='form-group'><input class='form-control' type='text' id='qty_datang_modal"+id+"' name='qty_datang_text' required='' placeholder='Qty...' onkeyup='hitung("+id+")'><input type='hidden' name='qty_datang[]' id='qty_datang"+id+"' onkeyup='hitung("+id+")'><input type='hidden' name='unique_id[]' id='unique_id"+id+"' value='"+unik+"'></div></div>";
            html += "<div class='col-2'><div class='form-group'><input type='number' name='isi_datang[]' step='0.01' onkeyup='hitung("+id+")' id='isi_datang"+id+"' class='form-control' required='' placeholder='Isi...'></div></div>";
            html += "<div class='col-3'><div class='form-group'><select name='satuan_datang[]' id='satuan_datang_modal"+id+"' class='form-control' required=''><option value='Kg'>Kg</option><option value='Pcs' selected>Pcs</option><option value='Roll'>Roll</option></select></div></div>";
            html += "<div class='col-4'><div class='form-group'><input class='form-control' type='text' id='kemasan_datang_modal' name='kemasan_datang[]' required='' placeholder='Kemasan...'><input type='hidden' name='subtotal_datang[]' class='subtotal_datang'></div></div></div>";
        }
        $('.modal-body #div_container_row').append(html);
    }
    
    function simpan(status){
        var kode = $('.modal-body #kode_datang_modal').val();
        var no_sj = $('.modal-body #no_surat_jalan_modal').val();
        var tgl_datang = $('.modal-body #tgl_datang_modal').val();
        var no_batch = $('.modal-body #no_batch_modal').val();
        var kode_datang = $('.modal-body #kode_datang_modal').val();
        var expired = $('.modal-body #expired_date_modal').val();

        if (status == 'Baku') {
            if (no_sj == "") {
                alert('Nomor surat jalan tidak boleh kosong !');
            }else if(tgl_datang == ""){
                alert('Tanggal kedatangan harap diisi !');
            }else if(no_batch == ""){
                alert('Nomor batch/LOT harap diisi !');
            }else if(kode_datang == ""){
                alert('Kode kedatangan harap diisi !');
            }else if(expired == ""){
                alert('Tanggal expired date harap diisi !');
            }else{
                $.ajax({
                    type: "POST",
                    url: "<?= base_url().'order/json_cek_kode_kedatangan'; ?>",
                    data: {kode: kode},
                    dataType: "json",
                    success: function (response) {
                        if (response > 0) {
                            alert('Kode kedatangan / No. analisa sudah pernah diinput !');
                        }else{
                            $('#form-bahan-datang').submit();
                        }
                    }
                });
            }
        }else{
            if (no_sj == "") {
                alert('Nomor surat jalan tidak boleh kosong !');
            }else if(tgl_datang == ""){
                alert('Tanggal kedatangan harap diisi !');
            }else if(no_batch == ""){
                alert('Nomor batch/LOT harap diisi !');
            }else if(kode_datang == ""){
                alert('Kode kedatangan harap diisi !');
            }else{
                $.ajax({
                    type: "POST",
                    url: "<?= base_url().'order/json_cek_kode_kedatangan'; ?>",
                    data: {kode: kode},
                    dataType: "json",
                    success: function (response) {
                        if (response > 0) {
                            alert('Kode kedatangan / No. analisa sudah pernah diinput !');
                        }else{
                            $('#form-bahan-datang').submit();
                        }
                    }
                });
            }
        }
    }

    $(document).ready(function() {
        $('#tableListBahan').DataTable( {
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