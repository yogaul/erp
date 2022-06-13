<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Scanner</title>

    <?php $this->load->view('partials/head', FALSE);?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view('partials/sidebar_gudang', FALSE);?>
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
                <h1 class="h4 mb-2 text-gray-800">Scan QR Code Bahan</h1><hr>
                <div class="card shadow">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama_produk" class="text-primary"><b>QR Code</b> *(Scan atau ketik manual)</label>
                            <input type="text" name="qr_code" class="form-control qr_code" placeholder="QR Code">    
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

            <!--Danger theme Modal -->
            <div class="modal fade text-left" id="info-scanner" tabindex="-1"
                role="dialog" aria-labelledby="myModalLabel120"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                    role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary" id="exampleModalLabel"><b>Detail Bahan</b></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="kode_kedatangan" class="text-primary"><b>Kode Kedatangan</b></label><br>
                                <label class="text-kode-kedatangan">-</label>
                            </div>
                            <div class="form-group">
                                <label for="kode_bahan" class="text-primary"><b>Kode Bahan</b></label><br>
                                <label class="text-kode-bahan">-</label>
                            </div>
                            <div class="form-group">
                                <label for="nama_bahan" class="text-primary"><b>Nama Bahan</b></label><br>
                                <label class="text-nama-bahan">-</label>
                            </div>
                            <div class="form-group">
                                <label for="isi_bahan" class="text-primary"><b>Isi</b></label><br>
                                <label class="text-isi-bahan">-</label>
                            </div>
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

    <script type="text/javascript">

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

        $(document).ready(function () {
           $('.qr_code').keydown(function (event){ 
                let id = $(this).val();
                if (id != "") {
                    if (event.keyCode === 13) {
                        $.ajax({
                        type: "POST",
                        url: "<?= base_url().'scan/json_scan_bahan' ?>",
                        data: {id: id},
                        dataType: "json",
                        success: function (response) {
                            if (response == null) {
                                alert('Invalid QC Code!');
                            }else{
                                $('#info-scanner .text-kode-kedatangan').html(response.kode_kedatangan);
                                $('#info-scanner .text-kode-bahan').html(response.kode_produk);
                                $('#info-scanner .text-nama-bahan').html(response.nama_produk);
                                $('#info-scanner .text-isi-bahan').html(kurensi_teks(response.isi_per_kemasan)+" "+response.satuan_kedatangan);
                                $('#info-scanner').modal({backdrop: 'static', keyboard: false});
                            }
                        }
                        }).then(function(){
                            $('.qr_code').val("");
                        });
                    }
                }
           });

        $(document).keypress(
        function(event){
            if (event.which == '13') {
                event.preventDefault();
            }
        });

       });
    </script>

</body>
</html>