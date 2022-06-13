<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Bahan Karantina</title>

    <?php $this->load->view('partials/head', FALSE);?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php  
            if ($this->session->userdata('level') == 'direktur' || $this->session->userdata('level') == 'spv_purchasing') {
                $this->load->view('partials/sidebar_direktur', FALSE);
            }elseif ($this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier') {
                $this->load->view('partials/sidebar_gudang', FALSE);
            }elseif ($this->session->userdata('level') == 'qc') {
                $this->load->view('partials/sidebar_qc', FALSE);
            }elseif ($this->session->userdata('level') == 'purchasing'){
                $this->load->view('partials/sidebar', FALSE);
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
                    <h1 class="h4 mb-2 text-gray-800">Karantina Bahan <?php echo $kategori; ?></h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                           <a href="<?= base_url().'export/validasi_history/'.$kategori.'/'.'karantina' ?>" class="btn btn-sm btn-success mb-4"><i class="fas fa-file-export"></i> Export Excel</a>
                           <div class="table-responsive">
                                <table class="table table-bordered" id="tableKarantina" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tgl. Datang</th>
                                            <th>No. PO</th>
                                            <th>No. Batch</th>
                                            <th>Nomor Analisa</th>
                                            <th>Kode Bahan</th>
                                            <th>Nama Bahan</th>
                                            <th>Supplier</th>
                                            <th>Jumlah Datang</th>
                                            <th>Detail</th>
                                            <th>Keterangan</th>
                                            <?php  
                                                if ($this->session->userdata('level') == 'qc') {
                                            ?>
                                            <th width="150">Tindakan</th>
                                            <?php
                                                }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($karantina as $value) {
                                    ?>
                                        <tr>
                                            <td><?php echo date('d/m/Y',strtotime($value->tanggal_kedatangan)); ?></td>
                                            <td><?php echo $value->no_po; ?></td>
                                            <td><?php echo $value->no_batch_kedatangan; ?></td>
                                            <td><?php echo $value->kode_kedatangan; ?></td>
                                            <td><?php echo $value->kode_produk; ?></td>
                                            <td><?php echo $value->nama_produk; ?></td>
                                            <td><?php echo $value->nama_mitra; ?></td>
                                            <td><?php echo number_format($value->jumlah_kedatangan,3,',','.')." ".$satuan_bahan; ?></td>
                                            <td>
                                                <?php 
                                                    $jumlah = "";
                                                    $detail_penerimaan = $this->OrderModel->get_detail_penerimaan($value->id_bahan_datang)->result();
                                                    foreach ($detail_penerimaan as $key) {
                                                        $satuan = (is_null($key->satuan_kedatangan)) ? 'Pieces' : $key->satuan_kedatangan;
                                                        $jumlah .= $key->qty_kedatangan.' '.$key->kemasan_kedatangan.'@'.$key->isi_kedatangan.''.$satuan.';';
                                                    }
                                                    $jumlah_trim = rtrim($jumlah,';');
                                                    echo $jumlah_trim;
                                                ?>
                                            </td>
                                            <td><?php echo $value->catatan_acc_qc; ?></td>
                                            <?php  
                                                if ($this->session->userdata('level') == 'qc') {
                                            ?>
                                            <td width="100">
                                                <a href="javascript:void(0)" onclick="show_reject('<?php echo $value->id_bahan_datang; ?>')" class="btn btn-sm btn-danger"><i class="fas fa-times"></i> Reject</a>
                                                <a href="<?php echo base_url().'order/acc_stok/'.$value->id_bahan_datang; ?>" class="btn btn-sm btn-success"><i class="fas fa-check"></i> Release</a>
                                            </td>
                                            <?php
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

             <!-- Reject Stok Modal -->
            <div class="modal fade" id="rejectStokModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="post" action="<?php echo base_url().'order/reject_stok'; ?>" id="form-reject-datang">
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
    function save_tab(){
        var hash = window.location.hash;
        $('#myTab a[href="' + hash + '"]').tab('show');
    }

    function show_reject(id){
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

    $(document).ready(function() {
        $('#tableKarantina').DataTable( {
            stateSave: true
        });

        $('.btn-send-reject').click(function(event) {
            let id = $('.modal-body #id_datang_reject').val();
            let catatan = $('.modal-body #catatan_reject').val();

            $.ajax({
                url: "<?php echo base_url().'order/reject_stok'; ?>",
                type: 'POST',
                dataType: 'json',
                data: {id: id, catatan: catatan},
                success: function(data){
                    // save_tab();
                }
            }).then(function(){
                window.location.reload();
            })
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