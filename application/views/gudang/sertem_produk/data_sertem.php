<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Serah Terima</title>

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
                    <h1 class="h4 mb-2 text-gray-800">Daftar Serah Terima Produk <?= $kategori ?> !</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                             <a href="<?php echo base_url().'sertem/buat/'.$jenis; ?>" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah</a>
                        <?php 
                            if (empty($list_sjp)) {
                                echo "";
                            }else{
                        ?>
                             <a href="#" onclick="coming()" class="btn btn-sm btn-success"><i class="fas fa-file-export"></i> Export Excel</a>
                        <?php
                            }
                         ?>
                         </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tableSertem" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Shift</th>
                                            <th>Serah Terima Dari</th>
                                            <th>Keterangan</th>
                                            <th width="70">Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($sertem as $key) {
                                    ?>
                                        <tr>
                                            <td><?php echo date('d/m/Y',strtotime($key->tanggal_barang_masuk)); ?></td>
                                            <td><?php echo $key->shift_barang_masuk; ?></td>
                                            <td><?php echo $key->terima_barang_masuk; ?></td>
                                            <td><?php echo $key->keterangan_barang_masuk; ?></td>
                                            <td>
                                                <div class="dropdown show">
                                                  <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Tindakan
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <!-- <a href="<?php echo base_url().'sjp/cetak_glow/'.$key->id_barang_masuk; ?>" class="dropdown-item"><i class="fa fa-file-pdf"></i> Cetak SJP</a> -->
                                                    <a href="<?php echo base_url().'sertem/detail_'.$jenis.'/'.$key->id_barang_masuk; ?>" class="dropdown-item"><i class="fa fa-eye"></i> Detail</a>
                                                    <a onclick="deleteConfirm('<?php echo base_url().'sertem/hapus_'.$jenis.'/'.$key->id_barang_masuk; ?>')" href="#!" class="dropdown-item"><i class="fa fa-trash"></i> Hapus</a>
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

    $(document).ready(function () {
        $('#tableSertem').DataTable({
            stateSave: true
        });
    });
</script>

</body>
</html>