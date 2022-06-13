<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Mutasi</title>

    <?php $this->load->view('partials/head', FALSE);?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php  $this->load->view('partials/sidebar_gudang', FALSE); ?>
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
                    <h1 class="h4 mb-2 text-gray-800">Daftar Mutasi Bahan <?php echo $this->uri->segment(3); ?></h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="<?php echo base_url().'mutasi/tambah/'.$this->uri->segment(3); ?>" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah</a>
                            <?php 
                                if (empty($data_mutasi)) {
                                    echo "";
                                }else{
                            ?>
                             <a href="<?php echo base_url().'export/eks_mutasi/'.$this->uri->segment(3); ?>" class="btn btn-sm btn-success"><i class="fas fa-file-export"></i> Export Excel</a>
                            <?php
                                }
                             ?>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tableProduk" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Shift</th>
                                            <th>Nama Produk</th>
                                            <th>Jumlah Batch</th>
                                            <th>Nomor Batch</th>
                                            <th>Status Mutasi</th>
                                            <th width="70">Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($data_mutasi as $key) {
                                    ?>
                                        <tr>
                                            <td><?php echo date('d/m/Y',strtotime($key->tanggal_mutasi)); ?></td>
                                            <td><?php echo $key->shift; ?></td>
                                            <td><?php echo $key->nama_produk_jadi; ?></td>
                                            <td><?php echo $key->jumlah_batch; ?></td>
                                            <td><ul>
                                                <?php 
                                                $arr_batch = $this->MutasiModel->get_batch_by_id($key->id_mutasi)->result();
                                                foreach ($arr_batch as $value) {
                                            ?>
                                                
                                                    <li><?php echo $value->no_batch; ?></li>
                                            <?php
                                                }
                                            ?></ul></td>
                                            <td><?php echo $key->status_mutasi; ?></td>
                                            <td>
                                                <div class="dropdown show">
                                                  <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Tindakan
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a href="<?php echo base_url().'mutasi/edit/'.$key->id_mutasi ?>" class="dropdown-item"><i class="fa fa-pencil"></i> Ubah</a>
                                                    <a onclick="deleteConfirm('<?php echo base_url().'mutasi/hapus/'.$key->id_mutasi ?>')"
                                                        href="#!" class="dropdown-item"><i class="fa fa-trash"></i> Hapus</a>
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
            <!-- End of Footer -->

            <!-- Tambah Modal -->
            <div class="modal fade" id="updateStokModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                    <form method="post" action="<?php echo base_url().'produk/simpan_stok' ?>" accept-charset="utf-8" id="form-stok_modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary" id="exampleModalLabel"><b>Update Stok</b></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="kode_produk" class="text-primary"><b>Kode Bahan <?php echo $this->uri->segment(3); ?></b></label>
                                <input type="hidden" id="id_produk_stok" name="id_produk" value="">
                                <input class="form-control" type="text" id="kode_produk_stok" name="kode_produk" readonly="">
                            </div>
                            <div class="form-group">
                                <label for="nama_produk" class="text-primary"><b>Nama Bahan <?php echo $this->uri->segment(3); ?></b></label>
                                <input class="form-control" id="nama_produk_stok" type="text" name="nama_produk" readonly="">
                            </div>
                            <div class="form-group">
                                <label for="stok_saat_ini" class="text-primary"><b>Stok Saat Ini</b></label>
                                <input type="text" class="form-control" id="stok_saat_ini" name="stok_saat_ini" placeholder="Stok bahan saat ini..." readonly="">
                            </div>
                            <div class="form-group">
                                <label for="stok_produk_terbaru" class="text-primary"><b>Stok Terbaru</b></label>
                                <input type="text" onkeyup="number_stok()" class="form-control" id="stok_produk_terbaru_modal" placeholder="Stok bahan terbaru..." required="">
                                <input type="hidden" id="stok_produk_terbaru" name="stok_produk_terbaru" value="">
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

    <?php $this->load->view('partials/js', FALSE);?>

<script>
    $(document).ready(function() {
        $('#tableProduk').DataTable( {
            stateSave: true
        } );
    } );

    function deleteConfirm(url){
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }

    function show_modal(id){
        $.ajax({
            url: "<?php echo base_url().'produk/get_json_produk'; ?>",
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            success: function(data){
                $('.modal-body #id_produk_stok').val(id);
                $('.modal-body #kode_produk_stok').val(data.kode_produk);
                $('.modal-body #nama_produk_stok').val(data.nama_produk);
                $('.modal-body #stok_saat_ini').val(data.stok);
                $('#updateStokModal').modal({backdrop: 'static', keyboard: false});
            }
        })
    }

    function number_stok(){
        var stok_produk_text = $('.modal-body #stok_produk_terbaru_modal').val().replace(/[^0-9\.]/g,'').toString(); 
        $('.modal-body #stok_produk_terbaru_modal').val(stok_produk_text.replace(/[^0-9\.]/g,'').toString());
        $('.modal-body #stok_produk_terbaru').val(stok_produk_text);
    }
</script>

</body>
</html>