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
                    <h1 class="h4 mb-2 text-gray-800">Buat Mutasi Barang</h1>

                    <!-- DataTales Example -->
                    <form action="<?php echo base_url().'mutasi/simpan_qr/' ?>" method="post" id="form-mutasi-qr">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="tgl_mutasi" class="text-primary"><b>Tanggal</b> (bulan/hari/tahun)</label>
                                            <input type="hidden" name="kategori" id="kategori_mutasi_lain">
                                            <input type="date" name="tgl_mutasi" required="" class="form-control" id="datepicker" value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="department" class="text-primary"><b>Department</b></label>
                                            <select id="list-department" name="department" class="form-control" required="">
                                                <option value="Production">Production</option>
                                                <option value="RnD">RnD</option>
                                                <option value="Quality Control">Quality Control</option>
                                                <option value="Purchasing">Purchasing</option>
                                                <option value="Marketing">Marketing</option>
                                                <option value="Warehouse">Warehouse</option>
                                            </select>
                                        </div>
                                        <div class="form-group"> 
                                            <label for="mitra" class="text-primary"><b>QR Code</b> *(Scan atau ketik manual)</label>
                                            <input type="text" name="id_qr" id="id_qr_scan" class="form-control" required placeholder="QR code">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="shift" class="text-primary"><b>Shift</b></label>
                                            <select name="shift" class="form-control" required="">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan_mutasi_lain" class="text-primary"><b>Keterangan</b> <u>(PENYERAHAN / PENGEMBALIAN)</u></label>
                                            <select name="keterangan_mutasi_lain" required class="form-control" id="keterangan_mutasi_lain">
                                                <option value="PENYERAHAN">PENYERAHAN</option>
                                                <option value="PENGEMBALIAN">PENGEMBALIAN</option>
                                            </select>
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
                                            <tr>
                                                <td colspan="9" align="center" class="dataTables_empty">Tidak ada produk yang dipilih</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    <a class="btn btn-sm btn-danger delete-row">Hapus Baris</a>
                                </div><br>
                                <div class="row ml-0">
                                        <div class="col-6">
                                            <label for="catatan_mutasi_lain" class="text-primary"><b>Catatan</b></label>
                                            <!-- <textarea name="catatan" id="ckeditor" class="ckeditor"></textarea> -->
                                            <textarea name="catatan_mutasi_lain" rows="6" class="form-control" placeholder="Tambahkan catatan..."></textarea><br>
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">&nbsp;</div>
                                    <div class="col-6">
                                        <a onclick="kembali()" class="btn btn-sm btn-secondary float-right"><i class="fas fa-times"></i> Batal</a>
                                        <a class="btn btn-sm btn-primary float-right mr-1 btn-simpan"><i class="fas fa-save"></i> Simpan & Cetak</a>
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

    var qr_code = [];
    var pilihan = "";

    CKEDITOR.replace('catatan_mutasi_lain');

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

    function status_keterangan(){
        let keterangan = $('#keterangan_mutasi_lain').val();
        let kategori = $('#kategori_mutasi_lain').val();

        if (keterangan == 'PENYERAHAN') {
            if (kategori == 'Baku') {
                $("input[name='diserahkan[]']").attr('readonly', 'readonly');
                $("select[name='satuan_diserahkan[]']").attr('readonly', 'readonly');
            }else{
                $("input[name='diserahkan[]']").removeAttr('readonly');
                $("select[name='satuan_diserahkan[]']").removeAttr('readonly');
            }
            $("input[name='dikembalikan[]']").attr('readonly', 'readonly');
            $("select[name='satuan_dikembalikan[]']").attr('readonly', 'readonly');
            $("input[name='reject[]']").attr('readonly', 'readonly');
            $("select[name='satuan_reject[]']").attr('readonly', 'readonly');
        }else if(keterangan == 'PENGEMBALIAN'){
            $("select[name='satuan_diserahkan[]']").attr('readonly', 'readonly');
            $("input[name='dikembalikan[]']").removeAttr('readonly');
            $("select[name='satuan_dikembalikan[]']").removeAttr('readonly');
            $("input[name='reject[]']").removeAttr('readonly');
            $("select[name='satuan_reject[]']").removeAttr('readonly');
        }
    }

    function cek_stok(first,second){
        let data = first+'-'+second;
        var nama_bahan = $('tr#id'+data).find("input[name='nama_produk[]']").val();  
        var qty_kemasan = parseFloat($('tr#id'+data).find("input[name='qty_kemasan[]']").val());    
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

        if (calc_diserahkan > qty_kemasan) {
            var teks = "Quantity bahan dengan nama <b>"+nama_bahan+"</b> tidak cukup ! <br> Quantity bahan saat ini : "+qty_kemasan+" <br> Yang akan anda serahkan : "+calc_diserahkan+" "+satuan_gram;
            $('#teks-peringatan').html(teks);
            $('#danger').modal({backdrop: 'static', keyboard: false});
            $('tr#id'+data).find("input[name='diserahkan[]']").val(qty_kemasan); 
        }
    }

    $(document).ready(function() {

        qr_code = [];

        status_table();
        
        // Find and remove selected table rows
        $(".delete-row").click(function(){
            let cek_barang = $('input[name="record"]:checked').length;

            if (cek_barang == 0) {
                alert('Anda belum memilih barang yang akan dihapus.');
            }else{
                $('input[name="record"]:checked').each(function() {   
                    var row = $(this).closest('tr');
                    qr_code.splice(qr_code.indexOf(row.find("td input[name='id_qr[]']").val()), 1);
                    $(this).parents("tr").remove();
                    if($('#data_order').html() == ""){
                        $("#data_order").html('<tr><td colspan="9" align="center" class="dataTables_empty">Tidak ada barang yang di pilih</td></tr>');
                        $('.delete-row').attr('hidden', 'true');
                    }
                });
                status_table();
            }
        });

        $('#id_qr_scan').keydown(function (event) { 
            // e.preventDefault();

            var kode = $('#id_qr_scan').val();
            var status = $('#keterangan_mutasi_lain').val();
         
            if (status == null) {
                alert('Anda belum memilih keterangan mutasi !');
            }else{
                if (kode == '') {
                // alert('QR code kosong !');
                }else{
                    if (qr_code.includes(kode)) {
                        alert('Qr code sudah ada pada tabel bahan !');
                    }else{
                        if (event.keyCode === 13) {
                            $.ajax({
                                url: "<?php echo base_url('order/json_detail_qr_mutasi') ?>",
                                type: 'POST',
                                dataType: 'JSON',
                                data: {
                                    id: kode, 
                                    keterangan: status
                                },
                                success : function(res){
                                    if(res.status == '1'){
                                        let mkategori = $('#kategori_mutasi_lain').val();
                                        if (mkategori !== '') {
                                            if (mkategori !== res.kategori) {
                                                let konfirmasi = confirm('Kategori bahan tidak sama, jika anda melanjutkan maka data pada tabel akan dihapus.');
                                                if (konfirmasi == true) {
                                                    qr_code = [];
                                                    qr_code.push(kode);
                                                    $('#kategori_mutasi_lain').val(res.kategori);
                                                    $("#data_order").html(res.message);
                                                }
                                            }else{
                                                qr_code.push(kode);
                                                $('#kategori_mutasi_lain').val(res.kategori);
                                                if ($('#tableBarangMutasi tr td').hasClass('dataTables_empty')) {
                                                    $("#data_order").html(res.message);
                                                }else{
                                                    $("#data_order").append(res.message);
                                                }
                                            }
                                        }else{
                                            qr_code.push(kode);
                                            $('#kategori_mutasi_lain').val(res.kategori);
                                            if ($('#tableBarangMutasi tr td').hasClass('dataTables_empty')) {
                                                $("#data_order").html(res.message);
                                            }else{
                                                $("#data_order").append(res.message);
                                            }
                                        } 
                                    }else{
                                        alert(res.message);
                                    }
                                }
                                }).then(function(){
                                    $('#id_qr_scan').val('');
                                    status_keterangan();
                                    status_table();
                            })
                        }
                    }
                    
                }
            }

        });

        $(document).keypress(
        function(event){
            if (event.which == '13') {
                event.preventDefault();
            }
        });

       $('.btn-simpan').click(function (e) { 
        //    e.preventDefault();
            if (qr_code.length == 0) {
                alert('Tabel barang kosong, harap scan minimal 1 barang !');
            }else{
                $('#form-mutasi-qr').submit();
            }
       });

       $('#keterangan_mutasi_lain').focus(function (e) { 
        //    e.preventDefault();
        pilihan = $(this).val();

       }).change(function(){
        if(qr_code.length > 0){
            var konfirmasi = confirm('Apa anda yakin akan mengganti keterangan ? data pada tabel akan dihapus dan anda harus mulai dari awal.');

            if(konfirmasi == true){
                qr_code = [];
                $("#data_order").html('<tr><td colspan="9" align="center" class="dataTables_empty">Tidak ada barang yang di pilih</td></tr>');
                status_table();
            }else{
                $('#keterangan_mutasi_lain').val(pilihan);
            }

        }
       });

       $('#kategori_mutasi_lain').focus(function (e) { 
        //    e.preventDefault();
        pilihan = $(this).val();

       }).change(function(){
        if(qr_code.length > 0){
            var konfirmasi = confirm('Apa anda yakin akan mengganti kategori ? data pada tabel akan dihapus dan anda harus mulai dari awal.');

            if(konfirmasi == true){
                qr_code = [];
                $("#data_order").html('<tr><td colspan="9" align="center" class="dataTables_empty">Tidak ada barang yang di pilih</td></tr>');
                status_table();
            }else{
                $('#kategori_mutasi_lain').val(pilihan);
            }

        }
       });

    });
</script>

</body>
</html>