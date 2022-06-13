<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Order</title>

    <?php $this->load->view('partials/head', FALSE);?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php 
            if ($this->session->userdata('level') == 'purchasing') {
               $this->load->view('partials/sidebar', FALSE);
            }elseif ($this->session->userdata('level') == 'direktur') {
                $this->load->view('partials/sidebar_direktur', FALSE);
            }else{
               $this->load->view('partials/sidebar_gudang', FALSE);
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
                <h1 class="h4 mb-2 text-gray-800">Daftar Barang Datang (Bahan <?php echo $this->uri->segment(3); ?>)</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tableListBahan" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Nomor PO</th>
                                            <th>Supplier</th>
                                            <th>Kode Produk</th>
                                            <th>Nama</th>
                                            <th>Jumlah Order</th>
                                            <th>Satuan</th>
                                            <th>Jumlah Datang</th>
                                            <th>Kurang/Lebih</th>
                                            <?php 
                                                if ($this->session->userdata('level') == 'purchasing') {
                                            ?>
                                            <th>Tindakan</th>
                                            <?php
                                                }else{
                                                   echo '';
                                                }
                                             ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            foreach ($detail_bahan as $value) {
                                        ?>
                                        <tr>
                                            <td><?php echo $value->no_po; ?></td>
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
                                            <?php 
                                                if ($this->session->userdata('level') == 'purchasing') {
                                            ?>
                                            <td width="20">
                                                <div class="dropdown show">
                                                  <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Tindakan
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <?php
                                                        if ($kategori == 'Teknik') {
                                                    ?>
                                                    <a onclick="show_detail('<?php echo $value->id_detail_order; ?>')" class="dropdown-item" data-toggle="modal" data-target="#editModal" data-backdrop="static" data-keyboard="false" disabled><i class="fas fa-edit"></i> Input Kedatangan</a>
                                                    <?php
                                                        }
                                                    ?>
                                                    <a href="<?php echo base_url().'order/lead_time/'.$value->id_detail_order; ?>" class="dropdown-item"><i class="fas fa-calendar"></i> Lead Time Kedatangan</a>
                                                    <a href="<?php echo base_url().'order/riwayat_datang/'.$value->id_detail_order; ?>" class="dropdown-item"><i class="fas fa-history"></i> Riwayat Kedatangan</a>
                                                  </div>
                                                </div>  
                                            </td>
                                            <?php
                                                }else{
                                                   echo '';
                                                }
                                             ?>
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
                                    <div class="form-group" hidden>
                                        <label for="no_batch_datang" class="text-primary"><b>No. Batch/LOT</b></label>
                                        <input class="form-control" type="text" id="no_batch_modal" name="no_batch_datang" required="" placeholder="Nomor batch..." readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="kode_kedatangan" class="text-primary"><b>Kode Kedatangan</b> (<?php echo $kode; ?>)</label>
                                        <input class="form-control" type="text" id="kode_datang_modal" name="kode_kedatangan" required="" placeholder="Kode kedatangan..." readonly>
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
                                                    <option value="Pcs">Pcs</option>
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
                                            <a class="btn btn-sm btn-primary" id="tambah_row_datang" onclick="tambah()"><i class="fas fa-plus"></i> Tambah</a>
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
                                                <input type="date" name="exp_date" placeholder="" class="form-control" required="" id="expired_date_modal" readonly>
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
                            <button type="button"  class="btn btn-sm btn-primary btn-save-kedatangan"><i class="fas fa-save"></i> Simpan & Cetak</button>
                            <a class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Batal</a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="leadTimeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                    <form action="<?php echo base_url().'order/update_surat_jalan' ?>" method="post" accept-charset="utf-8">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary" id="exampleModalLabel"><b>Input Surat Jalan</b></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nomor_po" class="text-primary"><b>No. PO</b></label>
                                <input type="hidden" id="id_detail_jalan" name="id_detail" value="">
                                <input type="hidden" name="kategori_surat_jalan" id="kategori_jalan_modal">
                                <input class="form-control" type="text" id="no_po_jalan" name="nomor_po" readonly="">
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

    function tambah(){
        var html = "";
        var count_row = $('.modal-body #div_contain_item').length;
        var id = count_row+1;
        var unik = new Date().getTime();

        html += "<div id='div_contain_item' class='row mr-0 item"+id+"'><div class='col-1'>";
        html += "<div class='form-group'><input type='checkbox' name='pilih' class='form-control'></div></div>";
        html += "<div class='col-2'><div class='form-group'><input class='form-control' type='text' id='qty_datang_modal"+id+"' name='qty_datang_text' required='' placeholder='Qty...' onkeyup='hitung("+id+")'><input type='hidden' name='qty_datang[]' id='qty_datang"+id+"' onkeyup='hitung("+id+")'><input type='hidden' name='unique_id[]' id='unique_id"+id+"' value='"+unik+"'></div></div>";
        html += "<div class='col-2'><div class='form-group'><input type='number' name='isi_datang[]' step='0.01' onkeyup='hitung("+id+")' id='isi_datang"+id+"' class='form-control' required='' placeholder='Isi...'></div></div>";
        html += "<div class='col-3'><div class='form-group'><select name='satuan_datang[]' id='satuan_datang_modal"+id+"' class='form-control' required=''><option value='Pcs'>Pcs</option></select></div></div>";
        html += "<div class='col-4'><div class='form-group'><input class='form-control' type='text' id='kemasan_datang_modal' name='kemasan_datang[]' required='' placeholder='Kemasan...'><input type='hidden' name='subtotal_datang[]' class='subtotal_datang'></div></div></div>";
        $('.modal-body #div_container_row').append(html);
    }

    function show_lead_time(id){
        $.ajax({
            url: "<?php echo base_url().'Order/get_json_nopo' ?>",
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            success : function(data){
                $.each(data, function(index, data) {
                     $('.modal-body #id_detail_jalan').val(id);
                     $('.modal-body #kategori_jalan_modal').val(data.kategori_produk);
                     $('.modal-body #no_po_jalan').val(data.no_po);
                     $('.modal-body #no_urut_jalan_modal').val(data.no_urut_surat_jalan);
                     $('.modal-body #keterangan_jalan_modal').val(data.keterangan_surat_jalan);
                });
                $('#leadTimeModal').modal({backdrop: 'static', keyboard: false});
            }
        })
    }

    function show_lead_time(){
        $('#leadTimeModal').modal({backdrop: 'static', keyboard: false});
    }

    $(document).ready(function() {

        $('#tableListBahan').DataTable( {
            stateSave: true,
            "scrollX": true
        } );

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

        $('.btn-save-kedatangan').click(function (e) { 
            // e.preventDefault();
            var no_sj = $('.modal-body #no_surat_jalan_modal').val();
            var tgl_datang = $('.modal-body #tgl_datang_modal').val();

            if (no_sj == "") {
                alert('Nomor surat jalan tidak boleh kosong !');
            }else if(tgl_datang == ""){
                alert('Tanggal kedatangan harap diisi !');
            }else{
                $('#form-bahan-datang').submit();
            }
        });

    } );
</script>

</body>
</html>