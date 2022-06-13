<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Riwayat</title>

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
                <h1 class="h4 mb-2 text-gray-800">Nama Bahan : <u><?php echo $nama_bahan; ?></u></h1>
            
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <form method="POST" action="<?php echo base_url().'order/cetak_proses'; ?>">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tableListBahan" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Tanggal Datang</th>
                                            <th>No. Batch</th>
                                            <th>Expired Date</th>
                                            <th>Kode Kedatangan</th>
                                            <th>Jumlah Datang</th>
                                            <th>No. Surat Jalan</th>
                                            <th>No. Urut Surat Jalan</th>
                                            <th>Keterangan Surat Jalan</th>
                                            <th>Keterangan</th>
                                            <?php 
                                                if ($this->session->userdata('level') == 'purchasing') {
                                            ?>
                                            <th>Tindakan</th>
                                            <?php
                                                }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            foreach ($list_history as $value) {
                                        ?>
                                        <tr>
                                            <td><?php echo date('d/m/Y',strtotime($value->tanggal_kedatangan)); ?></td>
                                            <td><?php echo $value->no_batch_kedatangan; ?></td>
                                            <td><?= $dtg = ($value->expired_date != '0000-00-00' && $value->expired_date != '0001-01-01' && !is_null($value->expired_date)) ? date('d/m/Y',strtotime($value->expired_date)) : '-'; ?></td>
                                            <td><?php echo $value->kode_kedatangan; ?></td>
                                            <td><?php echo number_format($value->jumlah_kedatangan,3,',','.'); ?></td>
                                            <td><?php echo $value->no_surat_jalan; ?></td>
                                            <td><?php echo $value->no_urut_surat_jalan; ?></td>
                                            <td><?php echo $value->keterangan_surat_jalan; ?></td>
                                            <td><?php echo $value->keterangan_kedatangan; ?></td>
                                            <?php 
                                                if ($this->session->userdata('level') == 'purchasing') {
                                            ?>
                                            <td width="20">
                                                <div class="dropdown show">
                                                  <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Tindakan
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                     <a onclick="show_urut_surat('<?php echo $value->id_bahan_datang; ?>')" class="dropdown-item" data-toggle="modal" data-target="#editModal" data-backdrop="static" data-keyboard="false" disabled><i class="fas fa-edit"></i>Input No. Urut Surat Jalan</a>
                                                  </div>
                                                </div>  
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
            <div class="modal fade" id="urutJalanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="<?php echo base_url().'order/update_surat_jalan' ?>" method="post" accept-charset="utf-8">
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

    function show_detail(id){
       $.ajax({
            url: "<?php echo base_url().'Order/json_kedatangan'; ?>",
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            success : function(data){
                console.log(data);
                // $.each(data, function(index, data) {
                //      $('.modal-body #id_po_modal').val(data.id_po);
                //      $('.modal-body #id_detail_modal').val(data.id_detail_order);
                //      $('.modal-body #kategori_modal').val(data.kategori_produk);
                //      $('.modal-body #kode_produk_modal').val(data.kode_produk);
                //      $('.modal-body #nama_produk_modal').val(data.nama_produk);
                //      $('.modal-body #kuantitas_modal').val(data.kuantitas);
                //      $('.modal-body #sudah_datang_modal').val(data.datang);
                // });
                // $('#editModal').modal({backdrop: 'static', keyboard: false});
            }
        })
    }

    $(document).ready(function() {
        $('#tableListBahan').DataTable( {
            stateSave: true
        });
    });
</script>

</body>
</html>