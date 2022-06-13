<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Validasi</title>

    <?php $this->load->view('partials/head', FALSE);?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
            if ($this->session->userdata('level') == 'direktur') {
                $this->load->view('partials/sidebar_direktur', FALSE);
            }elseif ($this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier') {
                $this->load->view('partials/sidebar_gudang', FALSE);
            }elseif ($this->session->userdata('level') == 'qc') {
                $this->load->view('partials/sidebar_qc', FALSE);
            }elseif ($this->session->userdata('level') == 'purchasing'){
                $this->load->view('partials/sidebar', FALSE);
            }elseif ($this->session->userdata('level') == 'ppic'){
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

                    <!-- Page Heading -->
                    <h1 class="h4 mb-2 text-gray-800">Kedatangan Bahan <?= ucfirst($kategori) ?> (Menunggu Validasi <?= $departemen = ($departemen == 'qc') ? strtoupper($departemen) : ucfirst($departemen) ?>)</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tableHistory" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Kode Kedatangan</th>
                                            <th>No. PO</th>
                                            <th>Nama Bahan</th>
                                            <th>Supplier</th>
                                            <th>No. Surat Jalan</th>
                                            <th>No. Urut Surat Jalan</th>
                                            <th>Jumlah</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($validasi as $key) {
                                    ?>
                                        <tr>
                                            <td><?php echo date('d/m/Y',strtotime($key->tanggal_kedatangan)); ?></td>
                                            <td><?php echo $key->kode_kedatangan; ?></td>
                                            <td><?php echo $key->no_po; ?></td>
                                            <td><?php echo $key->nama_produk; ?></td>
                                            <td><?php echo $key->nama_mitra; ?></td>
                                            <td><?php echo $key->no_surat_jalan; ?></td>
                                            <td><?php echo $key->no_urut_surat_jalan; ?></td>
                                            <td><?php echo number_format($key->jumlah_kedatangan,3,',','.'); ?></td>
                                            <td>
                                                <?php
                                                    if ($this->session->userdata('level') == 'purchasing') {
                                                ?>
                                                    <a onclick="show_urut_surat('<?php echo $key->id_bahan_datang; ?>')" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editModal" data-backdrop="static" data-keyboard="false" disabled><i class="fas fa-edit"></i>Input No. Urut SJ</a>
                                                <?php
                                                    }elseif ($this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier') {
                                                ?>
                                                    <a href="<?php echo base_url().'order/cetak_penerimaan/'.$key->id_bahan_datang; ?>" class="btn btn-sm btn-primary"><i class="fas fa-file-pdf"></i> Cetak Penerimaan</a>
                                                <?php
                                                    }
                                                ?>
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

            <!-- Edit Modal -->
            <div class="modal fade" id="editDatangModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                    <form action="<?php echo base_url().'order/ubah_datang' ?>" method="post" id="form-ubah-datang">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary" id="exampleModalLabel"><b>Ubah Bahan Datang</b></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="kode_produk" class="text-primary"><b>Kode Produk</b></label>
                                        <input type="hidden" name="id_detail_order" id="id_detail_modal">
                                        <input type="hidden" name="id_kedatangan_edit" id="id_datang_edit_modal">
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
                                        <label for="kode_kedatangan" class="text-primary"><b>Kode Kedatangan</b></label>
                                        <input class="form-control" type="text" id="kode_datang_modal" name="kode_kedatangan" required="" placeholder="Kode kedatangan...">
                                    </div>
                                    <div class="row">
                                        <div class="col-1">
                                            <label for="pilih" class="text-primary"><b>Pilih</b></label>
                                        </div>
                                         <div class="col-2">
                                            <label for="pilih" class="text-primary"><b>Qty</b></label>
                                        </div>
                                         <div class="col-2">
                                            <label for="pilih" class="text-primary"><b>Isi</b></label>
                                        </div>
                                        <div class="col-3">
                                            <label for="pilih" class="text-primary"><b>Satuan</b></label>
                                        </div>
                                        <div class="col-4">
                                            <label for="pilih" class="text-primary"><b>Kemasan</b></label>
                                        </div>
                                    </div>
                                    <div class="row ml-0" id="div_container_row">
                                        
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
                                                <input type="hidden" name="bahan_datang_lama" id="bahan_datang_lama">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exp_date" class="text-primary"><b>Expired Date</b> (bulan/hari/tahun)</label>
                                                <input type="date" name="exp_date" placeholder="" id="expired_datang_modal" class="form-control" required="">
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
                            <a onclick="cek_detail('<?php echo $status; ?>')" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Simpan & Cetak</a>
                            <a class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Batal</a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

              <!-- Edit Modal -->
              <div class="modal fade" id="urutJalanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="<?php echo base_url().'order/update_sj_dashboard' ?>" method="post" accept-charset="utf-8">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary" id="exampleModalLabel"><b>Input Nomor Urut Surat Jalan</b></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nomor_po" class="text-primary"><b>No. PO</b></label>
                            <input type="hidden" id="id_datang_jalan" name="id_bahan_datang">
                            <input type="hidden" id="id_detail_jalan" name="id_detail_datang">
                            <input type="hidden" id="acc_qc_jalan" name="acc_qc_datang">
                            <input class="form-control" type="text" id="no_po_jalan" name="nomor_po" readonly="">
                        </div>
                        <div class="form-group">
                             <label for="kode_produk" class="text-primary"><b>Kode Bahan</b></label>
                             <input type="hidden" id="id_produk_jalan" name="id_produk_datang">
                             <input class="form-control" type="text" id="kode_bahan_jalan" name="kode_produk" readonly="">
                        </div>
                        <div class="form-group">
                             <label for="nama_produk" class="text-primary"><b>Nama Bahan</b></label>
                             <input class="form-control" type="text" id="nama_bahan_jalan" name="nama_produk" readonly="">
                        </div>
                        <div class="form-group">
                             <label for="tanggal_kedatangan" class="text-primary"><b>Tanggal Kedatangan</b></label>
                             <input class="form-control" type="text" id="tanggal_datang_jalan" name="tanggal_kedatangan" readonly="">
                        </div>
                        <div class="form-group">
                             <label for="no_surat_jalan_datang" class="text-primary"><b>No. Surat Jalan</b></label>
                             <input class="form-control" type="text" id="surat_datang_jalan" name="no_surat_jalan_datang" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="no_urut_surat_jalan" class="text-primary"><b>No. Urut Surat Jalan</b></label>
                            <input type="text" class="form-control" id="no_urut_jalan_modal" name="no_urut_surat_jalan" value="" placeholder="Nomor urut surat jalan..." required="">
                        </div>
                         <div class="form-group">
                            <label for="ket_surat_jalan" class="text-primary"><b>Keterangan Surat Jalan</b></label>
                            <textarea class="form-control" id="keterangan_jalan_modal" name="ket_surat_jalan" rows="3" placeholder="Keterangan surat jalan..."></textarea>
                        </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        <a class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Batal</a>
                    </div>
                </div>
                </form>
            </div>
            </div>
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

    function show_urut_surat(id){
        $.ajax({
            url: "<?php echo base_url().'Order/json_kedatangan'; ?>",
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            success : function(data){
                console.log(data)
                $('.modal-body #id_datang_jalan').val(id);
                $('.modal-body #id_detail_jalan').val(data.id_detail_order);
                $('.modal-body #acc_qc_jalan').val(data.acc_qc);
                $('.modal-body #no_po_jalan').val(data.no_po);
                $('.modal-body #id_produk_jalan').val(data.id_produk);
                $('.modal-body #kode_bahan_jalan').val(data.kode_produk);
                $('.modal-body #nama_bahan_jalan').val(data.nama_produk);
                $('.modal-body #tanggal_datang_jalan').val(data.tanggal_kedatangan);
                $('.modal-body #surat_datang_jalan').val(data.no_surat_jalan);
                $('.modal-body #no_urut_jalan_modal').val(data.no_urut_surat_jalan);
                $('.modal-body #keterangan_jalan_modal').val(data.keterangan_surat_jalan);
                $('#urutJalanModal').modal({backdrop: 'static', keyboard: false});
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