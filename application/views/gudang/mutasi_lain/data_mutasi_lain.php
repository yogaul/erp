<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Mutasi Barang</title>

    <?php $this->load->view('partials/head', FALSE);?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php  
            if ($this->session->userdata('level') == 'direktur') {
                $this->load->view('partials/sidebar_direktur', FALSE); 
            }else{
                $this->load->view('partials/sidebar_gudang', FALSE); 
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
                    <h1 class="h4 mb-2 text-gray-800">Daftar Mutasi Barang</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <?php
                                if ($this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier') {
                            ?>
                            <a href="<?php echo base_url().'mutasi/tambah/'.$this->uri->segment(3); ?>" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah</a>
                            <?php
                                }
                            ?>
                            <a href="<?php echo base_url().'export/eks_mutasi_lain'; ?>" class="btn btn-sm btn-success"><i class="fas fa-file-export"></i> Export Excel</a>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo base_url().'mutasi/cari'; ?>" method="POST">
                                <div class="row">
                                    <div class="col-2">
                                        <input type="date" name="start_date" id="start_mutasi" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-2">
                                        <input type="date" name="end_date" id="end_mutasi" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-2">
                                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-search"></i> Cari</button>
                                    </div>
                                </div>
                            </form>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tableProduk" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th align="center">No.</th>
                                            <th align="center">ID</th>
                                            <th>Tanggal</th>
                                            <th>Shift</th>
                                            <th>Department</th>
                                            <th>Keterangan</th>
                                            <th>Catatan</th>
                                            <th width="70">Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach ($data_mutasi as $key) {
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?>.</td>
                                            <td align="left"><?php echo number_format($key->id_mutasi_lain); ?></td>
                                            <td><?php echo date('d/m/Y',strtotime($key->tanggal_mutasi_lain)); ?></td>
                                            <td><?php echo $key->shift_mutasi_lain; ?></td>
                                            <td><?php echo $key->department; ?></td>
                                            <td><?php echo $key->keterangan_mutasi_lain; ?></td>
                                            <td><?php echo $catatan = (!empty($key->catatan_mutasi_lain)) ? $key->catatan_mutasi_lain : '-' ; ?></td>
                                            <td>
                                                <div class="dropdown show">
                                                  <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Tindakan
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a href="<?php echo base_url().'mutasi/cetak/'.$key->id_mutasi_lain ?>" class="dropdown-item"><i class="fa fa-file-pdf"></i> Cetak PDF</a>
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