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
                    <h1 class="h6 text-gray-800">Tanggal <?php echo $start.' - '.$end; ?></h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="<?php echo base_url().'mutasi/index/lain'; ?>" class="btn btn-sm btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tableProduk" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>ID</th>
                                            <th>Tanggal</th>
                                            <th>Shift</th>
                                            <th>Department</th>
                                            <th>Keterangan</th>
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
                                            <td><?php echo date('Y/m/d',strtotime($key->tanggal_mutasi_lain)); ?></td>
                                            <td><?php echo $key->shift_mutasi_lain; ?></td>
                                            <td><?php echo $key->department; ?></td>
                                            <td><?php echo $key->keterangan_mutasi_lain; ?></td>
                                            <td>
                                                <div class="dropdown show">
                                                  <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Tindakan
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <!-- <a href="<?php echo base_url().'mutasi/edit_lain/'.$key->id_mutasi_lain ?>" class="dropdown-item"><i class="fa fa-pencil"></i> Ubah</a> -->
                                                    <!-- <a onclick="deleteConfirm('<?php echo base_url().'mutasi/hapus_lain/'.$key->id_mutasi_lain ?>')"
                                                        href="#!" class="dropdown-item"><i class="fa fa-trash"></i> Hapus</a> -->
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