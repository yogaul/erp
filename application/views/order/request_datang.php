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
            if ($this->session->userdata('level') == 'direktur' || $this->session->userdata('level') == 'spv_purchasing') {
                $this->load->view('partials/sidebar_direktur', FALSE);
            }elseif ($this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier') {
                $this->load->view('partials/sidebar_gudang', FALSE);
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
                    <h1 class="h4 mb-2 text-gray-800">Status Kedatangan Bahan <?php echo $this->session->userdata('kategori')." : ".$this->uri->segment(3); ?></h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <?php
                        if (!empty($detail_bahan)) {
                        ?>
                        <div class="card-header py-3">
                            <a href="<?php echo base_url().'export/file_datang/'.$this->uri->segment(3); ?>" class="btn btn-sm btn-success"><i class="fas fa-file-export"></i> Export Excel</a>
                        </div>
                        <?php
                         }else{
                            echo '';
                         } 
                        ?>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No. PO</th>
                                            <th>Supplier</th>
                                            <th>Kode Produk</th>
                                            <th>Nama</th>
                                            <th>Jumlah Order</th>
                                            <th>Jumlah Datang</th>
                                            <th>Satuan</th>
                                            <th>Kurang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            foreach ($detail_bahan as $value) {
                                        ?>
                                        <tr>
                                            <td><a href="<?php echo base_url().'order/detail/'.$value->id_po; ?>" class="text text-secondary"><?php echo $value->no_po; ?></a></td>
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
                                            <td><?php 
                                                $str_datang = strval($value->datang);
                                                if (strpos($str_datang, '.') == TRUE) {
                                                    echo $value->datang;
                                                }else{
                                                    echo number_format($value->datang,0,',','.');
                                                }
                                            ?></td>
                                            <td><?php echo $value->satuan; ?></td>
                                            <td><?php 
                                                $str_kurang = strval($value->kurang);
                                                if (strpos($str_kurang, '.') == TRUE) {
                                                    echo $value->kurang;
                                                }else{
                                                    echo number_format($value->kurang,0,',','.');
                                                }
                                            ?></td>
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

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="<?php echo base_url().'Order/update_datang' ?>" method="post" accept-charset="utf-8">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary" id="exampleModalLabel"><b>Bahan Datang</b></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="kode_produk" class="text-primary"><b>Kode Produk</b></label>
                                <input type="hidden" name="id_detail_po" id="id_po_modal">
                                <input type="hidden" name="id_detail_order" id="id_detail_modal">
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
                                <input class="form-control" id="sudah_datang_modal" type="text" name="sudah_datang" required="">
                            </div>
                            <div class="form-group">
                                <label for="bahan_datang" class="text-primary"><b>Jumlah Bahan Datang Baru</b></label>
                                <input class="form-control" type="number" step=".01" name="bahan_datang" placeholder="Masukkan jumlah bahan...">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_datang" class="text-primary"><b>Tanggal Kedatangan</b> (bulan/hari/tahun)</label>
                                <input type="date" name="tanggal_datang" placeholder="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="bahan_datang" class="text-primary"><b>Keterangan</b></label>
                                <textarea id="keterangan_datang_modal" class="form-control" name="keterangan_datang" rows="3" placeholder="Keterangan..."></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                            <a class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

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

    <!-- load js -->
    <?php $this->load->view('partials/js', FALSE);?>

<script>
    function deleteConfirm(url){
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }

    function show_detail(id){
        $.ajax({
            url: "<?php echo base_url().'Order/json_detail' ?>",
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            success : function(data){
                $.each(data, function(index, data) {
                     $('.modal-body #id_po_modal').val(data.id_po);
                     $('.modal-body #id_detail_modal').val(data.id_detail_order);
                     $('.modal-body #kode_produk_modal').val(data.kode_produk);
                     $('.modal-body #nama_produk_modal').val(data.nama_produk);
                     $('.modal-body #kuantitas_modal').val(data.kuantitas);
                     $('.modal-body #sudah_datang_modal').val(data.datang);
                     $('.modal-body #keterangan_datang_modal').val(data.keterangan_datang);
                });
                $('#editModal').modal();
            }
        })
    }
</script>

</body>
</html>