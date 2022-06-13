<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - SJP</title>

    <?php $this->load->view('partials/head', FALSE);?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php  
            if ($this->session->userdata('level') == 'marketing') {
                $this->load->view('partials/sidebar_marketing', FALSE);
            }elseif ($this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier') {
                $this->load->view('partials/sidebar_gudang', FALSE);
            }elseif ($this->session->userdata('level') == 'ppic'){
                $this->load->view('partials/sidebar_ppic', FALSE);
            }elseif ($this->session->userdata('level') == 'direktur'){
                $this->load->view('partials/sidebar_direktur', FALSE);
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
                    <h1 class="h4 mb-2 text-gray-800">Daftar SJP Ms Glow !</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <?php
                                if ($this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier') {
                            ?>
                            <a href="#!" onclick="choose()" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah</a>
                            <?php
                                }
                            ?>
                            <a href="#" onclick="coming()" class="btn btn-sm btn-success"><i class="fas fa-file-export"></i> Export Excel</a>
                         </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tableHistory" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>No. Surat Jalan</th>
                                            <th>No. Telepon</th>
                                            <th>Alamat Pengiriman</th>
                                            <th width="70">Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($list_sjp as $key) {
                                    ?>
                                        <tr>
                                            <td><?php echo date('d/m/Y',strtotime($key->tanggal_sjp)); ?></td>
                                            <td><?php echo $key->nomor_sjp; ?></td>
                                            <td><?php echo $key->telp_sjp; ?></td>
                                            <td><?php echo $key->alamat_sjp; ?></td>
                                            <td>
                                                <div class="dropdown show">
                                                  <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Tindakan
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a href="<?php echo base_url().'sjp/cetak_glow/'.$key->id_sjp; ?>" class="dropdown-item"><i class="fa fa-file-pdf"></i> Cetak SJP</a>
                                                    <a onclick="show_detail('<?= $key->id_sjp; ?>')" href="#!" class="dropdown-item"><i class="fa fa-eye"></i> Detail</a>
                                                    <?php 
                                                        if ($this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier') {
                                                    ?>
                                                    <!-- <a href="<?php echo base_url().'sjp/refresh/'.$key->id_sjp; ?>" class="dropdown-item"><i class="fa fa-refresh"></i> Refresh</a> -->
                                                    <?php      
                                                        }
                                                    ?>
                                                    <!-- <?php
                                                        if ($this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier') {
                                                    ?>
                                                    <a onclick="deleteConfirm('<?php echo base_url().'sjp/hapus_glow/'.$key->id_sjp; ?>')" href="#!" class="dropdown-item"><i class="fa fa-trash"></i> Hapus</a>
                                                    <?php
                                                        }
                                                    ?> -->
                                                  </div>
                                                </div>
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

            <!--Danger theme Modal -->
            <div class="modal fade text-left" id="chooseModal" tabindex="-1"
                role="dialog" aria-labelledby="myModalLabel120"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                    role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title text-primary" id="myModalLabel120">
                                <b>Pilih Metode</b>
                            </h4>
                            <button type="button" class="close"
                                data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                         <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <a href="<?= base_url().'sjp/glow' ?>" class="btn btn-sm btn-primary"><i class="fas fa-mouse-pointer"></i> Manual</a>
                                    <a href="<?= base_url().'sjp/qr' ?>" class="btn btn-sm btn-primary"><i class="fa fa-qrcode"></i> QR Code</a>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Batal</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Produk Modal -->
            <div class="modal fade" id="serialisasiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title text-primary" id="exampleModalLabel"><b>Detail SJP</b></h4>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="text-primary"><b>Nomor SJP</b></label><br>
                                            <label id="text-nomor-sjp"></label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group float-right">
                                            <label class="text-primary"><b>Tanggal</b></label><br>
                                            <label id="text-tanggal-sjp"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0" id="table_serialisasi">
                                    <thead align="center">
                                        <tr>
                                            <th rowspan="2" style="vertical-align: middle;">Serialisasi</th>
                                            <th rowspan="2" style="vertical-align: middle;">Status</th>
                                            <th colspan="2">KOSME</th>
                                            <th colspan="2">MS GLOW</th>
                                        </tr>
                                        <tr>
                                            <th>Karton</th>
                                            <th>Pieces</th>
                                            <th>Karton</th>
                                            <th>Pieces</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data_serialisasi">
                                        
                                    </tbody>
                                    <tfoot class="font-weight-bold">
                                        <tr>
                                            <td colspan="2" align="center">Total</td>
                                            <td id="karton_kosme">&nbsp;</td>
                                            <td id="pcs_kosme">&nbsp;</td>
                                            <td id="karton_gcp">&nbsp;</td>
                                            <td id="pcs_gcp">&nbsp;</td>
                                        </tr>
                                    </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                            </div>
                        </div>
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

    function choose(){
        $('#chooseModal').modal({backdrop: 'static', keyboard: false});
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

    function date_teks(tanggal){
       var jsDate = tanggal.replace(/-/g, '/');
        return jsDate;
    }

    function show_detail(id){
        $('#serialisasiModal #table_serialisasi').dataTable().fnClearTable();
        $('#serialisasiModal #table_serialisasi').dataTable().fnDestroy();
        $('#serialisasiModal #text-nomor-sjp').html("-");
        $('#serialisasiModal #text-tanggal-sjp').html("-");
        $('#karton_kosme').html('');
        $('#pcs_kosme').html('');
        $('#karton_gcp').html('');
        $('#pcs_gcp').html('');

        $.ajax({
            type: "POST",
            url: "<?= base_url().'sjp/json_serialisasi' ?>",
            data: {id: id},
            dataType: "json"
        }).done(function(data){
            var subtotal = 0;
            var qty = 0;
            var karton_gcp = 0;
            var pcs_gcp = 0;

            if (data.total.total_subtotal !== null) {
                subtotal = data.total.total_subtotal;
            }

            if (data.total.total_qty !== null) {
                qty = data.total.total_qty;
            }

            if (data.total_gcp.karton !== null) {
                karton_gcp = data.total_gcp.karton;
            }

            if (data.total_gcp.pcs !== null) {
                pcs_gcp = data.total_gcp.pcs;
            }

            $('#serialisasiModal #text-nomor-sjp').html(data.sjp.nomor_sjp);
            $('#serialisasiModal #text-tanggal-sjp').html(date_teks(data.sjp.tanggal_sjp));
            $('#serialisasiModal #table_serialisasi').DataTable( {
                "fnRowCallback": function(nRow, aaData, iDisplayIndex, iDisplayIndexFull) {
                    if (aaData.temp_total_karton != aaData.temp_karton_gcp || aaData.temp_total_pcs != aaData.temp_pcs_gcp) {
                        $('td', nRow).css({'background-color' : 'Grey', 'color' : 'White'});
                    }
                },
                "aaData": data.serialisasi, 
                "columns": [
                    { "data": "serialisasi" },
                    { "data": "status_simpan" },
                    { "data": "temp_total_karton" },
                    { "data": "temp_total_pcs" },
                    { "data": "temp_karton_gcp" },
                    { "data": "temp_pcs_gcp" }
                ]
            });
            $('#karton_kosme').html(kurensi_teks(qty));
            $('#pcs_kosme').html(kurensi_teks(subtotal));
            $('#karton_gcp').html(kurensi_teks(karton_gcp));
            $('#pcs_gcp').html(kurensi_teks(pcs_gcp));
        })
        $('#serialisasiModal').modal({backdrop: 'static', keyboard: false});
    }

    $(document).ready(function () {
        $('#tableHistory').DataTable({
            stateSave: true
        });
    });
</script>

</body>
</html>