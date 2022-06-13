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

                    <!-- Page Heading -->
                    <h1 class="h4 mb-2 text-gray-800">PO <?php echo $tipe = ($this->uri->segment(3) == 'Baku') ? 'Bahan Baku' : $this->uri->segment(3) ; ?></h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <?php 
                            if ($this->session->userdata('level') == 'purchasing') {
                        ?>
                        <div class="card-header py-3">
                            <a href="<?php echo base_url().'order/buat/'.$this->uri->segment(3) ?>" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Buat PO <?php echo $tipe = ($this->uri->segment(3) == 'Baku') ? 'Bahan Baku' : $this->uri->segment(3) ; ?></a>
                        </div>
                        <?php
                            }else{
                                echo '';
                            }
                         ?>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tableOrderDatang" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No. PO</th>
                                            <th>Supplier</th>
                                            <th>Tgl. Order</th>
                                            <th>Lead Time</th>
                                            <th>Tanggal Kirim</th>
                                            <?php 
                                                if ($this->session->userdata('level') == 'purchasing') {
                                            ?>
                                            <th>Total Harga</th>
                                            <?php
                                                }else{
                                                   echo '';
                                                }
                                             ?>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            foreach ($list_po as $value) {
                                        ?>
                                        <tr>
                                            <td><?php echo $value->no_po; ?></td>
                                            <td><?php echo $value->nama_mitra; ?></td>
                                            <td><?php echo date('d/m/Y',strtotime($value->tanggal_po)); ?></td>
                                            <td><?php echo date('d/m/Y',strtotime($value->lead_time)); ?></td>
                                            <td><?php echo date('d/m/Y',strtotime($value->tanggal_pengiriman)); ?></td>
                                            <?php 
                                                if ($this->session->userdata('level') == 'purchasing') {
                                            ?>
                                            <td>Rp. <?php echo number_format($value->total_harga,0,',','.'); ?></td>
                                            <?php
                                                }else{
                                                   echo '';
                                                }
                                             ?>
                                            <td width="60">
                                                <a href="<?php echo base_url().'Order/bahan_gudang/'.$value->id_po; ?>" class="btn btn-sm btn-primary"><i class="fas fa-check"></i> Pilih</a>
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

    <!-- Edit Modal -->
    <!-- <div class="modal fade" id="suratJalanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <input type="hidden" id="id_po_jalan" name="id_po" value="">
                        <input class="form-control" type="text" id="no_po_jalan" name="nomor_po" readonly="">
                    </div>
                    <div class="form-group">
                        <label for="nomor_surat_jalan" class="text-primary"><b>No. Surat Jalan</b></label>
                        <input class="form-control" type="text" name="no_surat_jalan" required="" placeholder="Nomor surat jalan...">
                    </div>
                    <div class="form-group">
                        <label for="no_urut_surat_jalan" class="text-primary"><b>No. Urut Surat Jalan</b></label>
                        <input type="text" class="form-control" name="no_urut_surat_jalan" value="" placeholder="Nomor urut surat jalan..." required="">
                    </div>
                     <div class="form-group">
                        <label for="ket_surat_jalan" class="text-primary"><b>Keterangan Surat Jalan</b></label>
                        <textarea class="form-control" name="ket_surat_jalan" rows="3" placeholder="Keterangan surat jalan..."></textarea>
                    </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    <a class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Batal</a>
                </div>
            </div>
            </form>
        </div>
    </div> -->

    <!-- load js -->
    <?php $this->load->view('partials/js', FALSE);?>

<script>
    function deleteConfirm(url){
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }

    $(document).ready(function() {
        $('#tableOrderDatang').DataTable( {
            stateSave: true
        } );
    } );

    // function show_detail(id){
    //     $.ajax({
    //         url: "<?php echo base_url().'Order/get_json_nopo' ?>",
    //         type: 'POST',
    //         dataType: 'json',
    //         data: {id: id},
    //         success : function(data){
    //             $.each(data, function(index, data) {
    //                  $('.modal-body #id_po_jalan').val(id);
    //                  $('.modal-body #no_po_jalan').val(data.no_po);
    //             });
    //             $('#suratJalanModal').modal({backdrop: 'static', keyboard: false});
    //         }
    //     })
    // }
</script>

</body>
</html>