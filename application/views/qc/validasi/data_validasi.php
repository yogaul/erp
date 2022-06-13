<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Validasi</title>

    <?php $this->load->view('partials/head', FALSE); ?>

    <style type="text/css">
        a:hover{
            text-decoration-line: none;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

       <?php
            $this->load->view('partials/sidebar_qc', FALSE);
        ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php $this->load->view('partials/navbar', FALSE); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                <h1 class="h4 mb-2 text-gray-800">Daftar Kedatangan Bahan</h1>

                   <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="tab1" data-toggle="tab" href="#bakuPanel" role="tab">Bahan Baku</a>
                          <li>
                          <li class="nav-item">
                            <a class="nav-link" id="tab2" data-toggle="tab" href="#kemasPanel" role="tab">Bahan Kemas</a>
                          <li>
                        </ul>
                        <div class="card-body">
                            <div class="tab-content mt-1">
                            <div class="tab-pane fade show active" id="bakuPanel" role="tabpanel">
                                <a href="<?= base_url().'export/validasi_belum/baku' ?>" class="btn btn-sm btn-success mb-4"><i class="fas fa-file-export"></i> Export Excel</a>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tableValidasiBaku" width="100%">
                                        <thead>
                                            <tr>
                                                <!-- <th>ID</th> -->
                                                <th>Tgl. Datang</th>
                                                <th>No. PO</th>
                                                <th>No. Batch</th>
                                                <th>Nomor Analisa</th>
                                                <th>Kode Bahan</th>
                                                <th>Nama Bahan</th>
                                                <th>Supplier</th>
                                                <th>Jumlah Datang</th>
                                                <th>Detail</th>
                                                <th width="250">Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                foreach ($validasi_baku as $value) {
                                            ?>
                                            <tr>
                                                <!-- <td><?php echo substr($value->id_bahan_datang,4); ?></td> -->
                                                <td><?php echo date('Y/m/d',strtotime($value->tanggal_kedatangan)); ?></td>
                                                <td><?php echo $value->no_po; ?></td>
                                                <td><?php echo $value->no_batch_kedatangan; ?></td>
                                                <td><?php echo $value->kode_kedatangan; ?></td>
                                                <td><?php echo $value->kode_produk; ?></td>
                                                <td><?php echo $value->nama_produk; ?></td>
                                                <td><?php echo $value->nama_mitra; ?></td>
                                                <td><?php echo number_format($value->jumlah_kedatangan,3,',','.')." Kg"; ?></td>
                                                <td>
                                                    <?php 
                                                        $jumlah = "";
                                                        $detail_penerimaan = $this->OrderModel->get_detail_penerimaan($value->id_bahan_datang)->result();
                                                        foreach ($detail_penerimaan as $key) {
                                                            $satuan = (is_null($key->satuan_kedatangan)) ? 'Pieces' : $key->satuan_kedatangan;
                                                           $jumlah .= $key->qty_kedatangan.' '.$key->kemasan_kedatangan.'@'.$key->isi_kedatangan.' '.$satuan.';';
                                                        }
                                                        $jumlah_trim = rtrim($jumlah,';');
                                                        echo $jumlah_trim;
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" onclick="show_reject('<?php echo $value->id_bahan_datang; ?>','reject')" class="btn btn-sm btn-danger"><i class="fas fa-times"></i> Reject</a>
                                                    <!-- <a onclick="send_release('<?php echo $value->id_bahan_datang; ?>')" class="btn btn-sm btn-success"><i class="fas fa-check"></i> Release</a> -->
                                                    <a href="<?php echo base_url().'order/acc_stok/'.$value->id_bahan_datang; ?>" class="btn btn-sm btn-success"><i class="fas fa-check"></i> Release</a>
                                                    <a href="javascript:void(0)" onclick="show_reject('<?php echo $value->id_bahan_datang; ?>','karantina')" class="btn btn-sm btn-warning"><i class="fas fa-lock"></i> Karantina</a>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                             ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="kemasPanel" role="tabpanel">
                                <a href="<?= base_url().'export/validasi_belum/kemas' ?>" class="btn btn-sm btn-success mb-4"><i class="fas fa-file-export"></i> Export Excel</a>
                                 <div class="table-responsive">
                                    <table class="table table-bordered" id="tableValidasiKemas" width="100%">
                                        <thead>
                                            <tr>
                                                <!-- <th>ID</th> -->
                                                <th>Tgl. Datang</th>
                                                <th>No. PO</th>
                                                <th>No. Batch</th>
                                                <th>Nomor Analisa</th>
                                                <th>Kode Bahan</th>
                                                <th>Nama Bahan</th>
                                                <th>Supplier</th>
                                                <th>Jumlah Datang</th>
                                                <th>Detail</th>
                                                <th width="250">Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                foreach ($validasi_kemas as $value) {
                                            ?>
                                            <tr>
                                                <!-- <td><?php echo substr($value->id_bahan_datang,4); ?></td> -->
                                                <td><?php echo date('Y/m/d',strtotime($value->tanggal_kedatangan)); ?></td>
                                                <td><?php echo $value->no_po; ?></td>
                                                <td><?php echo $value->no_batch_kedatangan; ?></td>
                                                <td><?php echo $value->kode_kedatangan; ?></td>
                                                <td><?php echo $value->kode_produk; ?></td>
                                                <td><?php echo $value->nama_produk; ?></td>
                                                <td><?php echo $value->nama_mitra; ?></td>
                                                <td><?php echo number_format($value->jumlah_kedatangan,3,',','.')." Pieces"; ?></td>
                                                <td>
                                                    <?php 
                                                        $jumlah = "";
                                                        $detail_penerimaan = $this->OrderModel->get_detail_penerimaan($value->id_bahan_datang)->result();
                                                        foreach ($detail_penerimaan as $key) {
                                                            $satuan = (is_null($key->satuan_kedatangan)) ? 'Pieces' : $key->satuan_kedatangan;
                                                           $jumlah .= $key->qty_kedatangan.' '.$key->kemasan_kedatangan.'@'.$key->isi_kedatangan.' '.$satuan.';';
                                                        }
                                                        $jumlah_trim = rtrim($jumlah,';');
                                                        echo $jumlah_trim;
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" onclick="show_reject('<?php echo $value->id_bahan_datang; ?>','reject')" class="btn btn-sm btn-danger"><i class="fas fa-times"></i> Reject</a>
                                                    <!-- <a onclick="send_release('<?php echo $value->id_bahan_datang; ?>')" class="btn btn-sm btn-success"><i class="fas fa-check"></i> Release</a> -->
                                                    <a href="<?php echo base_url().'order/acc_stok/'.$value->id_bahan_datang; ?>" class="btn btn-sm btn-success"><i class="fas fa-check"></i> Release</a>
                                                    <a href="javascript:void(0)" onclick="show_reject('<?php echo $value->id_bahan_datang; ?>','karantina')" class="btn btn-sm btn-warning"><i class="fas fa-lock"></i> Karantina</a>
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
                    </div>

                </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php $this->load->view('partials/footer', FALSE); ?>

            <!-- Reject Stok Modal -->
            <div class="modal fade" id="rejectStokModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="post" id="form-reject-datang">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary font-weight-bold title-reject-modal" id="exampleModalLabel">Reject Kedatangan</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kode_produk_reject" class="text-primary"><b>Kode Bahan <?php echo $this->uri->segment(3); ?></b></label>
                            <input type="hidden" id="id_datang_reject" name="id_bahan_datang" value="">
                            <input type="hidden" name="aksi" class="aksi_reject_modal">
                            <input class="form-control" type="text" id="kode_produk_reject" name="kode_produk" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="nama_produk_reject" class="text-primary"><b>Nama Bahan <?php echo $this->uri->segment(3); ?></b></label>
                            <input class="form-control" id="nama_produk_reject" type="text" name="nama_produk" readonly="">
                        </div>
                         <div class="form-group">
                            <label for="nama_produk_reject" class="text-primary"><b>Kode Kedatangan</b></label>
                            <input class="form-control" id="kode_datang_reject" type="text" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="limit_stok" class="text-primary"><b>Catatan</b></label>
                            <textarea class="form-control" name="catatan_reject" placeholder="Tambahkan catatan..." required="" rows="4" id="catatan_reject"></textarea>
                        </div>
                    <div class="modal-footer">
                        <a class="btn btn-sm btn-primary btn-send-reject"><i class="fas fa-save"></i> Simpan</a>
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

   <?php $this->load->view('partials/js', FALSE); ?>

    <!-- Page level plugins -->
    <script src="<?php echo base_url().'assets/vendor/chart.js/Chart.min.js'?>"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo base_url().'assets/js/demo/chart-area-demo.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/demo/chart-pie-demo.js'?>"></script>

    <script type="text/javascript">

        function show_reject(id,aksi){
            if (aksi == 'reject') {
                $('.modal-header .title-reject-modal').html('Reject Kedatangan');
                $('.modal-body .aksi_reject_modal').val('reject');
            }else if(aksi == 'karantina'){
                $('.modal-header .title-reject-modal').html('Karantina Kedatangan');
                $('.modal-body .aksi_reject_modal').val('karantina');
            }
            $.ajax({
                url: "<?php echo base_url().'order/json_detail_kedatangan'; ?>",
                type: 'POST',
                dataType: 'json',
                data: {id: id},
                success: function(data){
                    $('.modal-body #id_datang_reject').val(data.data_kedatangan.id_bahan_datang);
                    $('.modal-body #kode_produk_reject').val(data.data_kedatangan.kode_produk);
                    $('.modal-body #nama_produk_reject').val(data.data_kedatangan.nama_produk);
                    $('.modal-body #kode_datang_reject').val(data.data_kedatangan.kode_kedatangan);
                }
            });
            $('#rejectStokModal').modal({backdrop: 'static', keyboard: false});
        }

        function save_tab(){
            var hash = window.location.hash;
            $('#myTab a[href="' + hash + '"]').tab('show');
        }

        $(document).ready(function() {
            $('#tableValidasiBaku').DataTable( {
                stateSave: true,
                order: [[ 0, "desc" ]],
                columnDefs : [{"targets":0}]
            });

            $('#tableValidasiKemas').DataTable( {
                stateSave: true,
                order: [[ 0, "desc" ]],
                columnDefs : [{"targets":0}]
            });

            $('.btn-send-reject').click(function(event) {
                let id = $('.modal-body #id_datang_reject').val();
                let catatan = $('.modal-body #catatan_reject').val(); 
                let aksi = $('.modal-body .aksi_reject_modal').val();
                var my_url = "";

                if (aksi == 'reject') {
                    my_url = "<?php echo base_url().'order/reject_stok'; ?>";
                }else if(aksi == 'karantina'){
                    my_url = "<?php echo base_url().'order/karantina_stok'; ?>";
                } 

                $.ajax({
                    url: my_url,
                    type: 'POST',
                    dataType: 'json',
                    data: {id: id, catatan: catatan},
                    success: function(data){
                        if (data.status == "success") {
                            window.location.href = data.url;
                        }else{
                            window.location.reload();
                        }
                    }
                });
            });

            $('#myTab a').click(function(e) {
              e.preventDefault();
              $(this).tab('show');
            });

            $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
              var id = $(e.target).attr("href").substr(1);
              window.location.hash = id;
            });

            save_tab();

        });
    </script>

</body>

</html>