<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - MPS Kalkulator</title>

    <?php $this->load->view('partials/head', FALSE);?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php  $this->load->view('partials/sidebar_ppic', FALSE); ?>
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
                    <h1 class="h4 mb-2 text-gray-800">MPS Kalkulator</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="<?php echo base_url().'kalkulator/tambah' ?>" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tableProduk" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th align="center">No.</th>
                                            <th>Tanggal</th>
                                            <th>Nama Produk</th>
                                            <th>Kode Formula</th>
                                            <th>Jumlah Produksi</th>
                                            <th>Catatan</th>
                                            <th width="70">Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach ($produk as $key) {
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?>.</td>
                                            <td><?php echo date('d/m/Y',strtotime($key->tanggal_mps_kalkulator)); ?></td>
                                            <td><?php echo $key->nama_produk_msglow; ?></td>
                                            <td><?php echo $key->kode_formula_produk; ?></td>
                                            <td><?php echo number_format($key->jumlah_produksi,0,',','.'); ?> Pcs</td>
                                            <td><?php echo $catatan = (!empty($key->keterangan_mps_kalkulator)) ? $key->keterangan_mps_kalkulator : '-' ; ?></td>
                                            <td>
                                                <div class="dropdown show">
                                                  <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Tindakan
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a href="<?php echo base_url().'kalkulator/detail/'.$key->id_mps_kalkulator ?>" class="dropdown-item"><i class="fa fa-eye"></i> Detail</a>
                                                    <!-- <a href="<?php echo base_url().'kalkulator/edit/'.$key->id_mps_kalkulator ?>" class="dropdown-item"><i class="fa fa-edit"></i> Ubah</a> -->
                                                    <!-- <a onclick="deleteConfirm('<?php echo base_url().'kalkulator/hapus/'.$key->id_mps_kalkulator ?>')"
                                                        href="#!" class="dropdown-item"><i class="fa fa-trash"></i> Hapus</a> -->
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
  
    $(document).ready(function() {
        $('#tableProduk').DataTable( {
            stateSave: true,
            order: [[ 1, "desc" ]],
            columnDefs : [{"targets":1}]
        });
    } );

</script>

</body>
</html>