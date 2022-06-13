<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Supplier</title>

    <?php $this->load->view('partials/head', FALSE);?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
            if ($this->session->userdata('level') == 'direktur' || $this->session->userdata('level') == 'spv_purchasing') {
                $this->load->view('partials/sidebar_direktur', FALSE);
            }else{
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
                    <h1 class="h4 mb-2 text-gray-800">Daftar Supplier : <?php echo $tipe = ($this->uri->segment(3) == 'Baku') ? 'Bahan Baku' : $this->uri->segment(3) ; ?></h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <?php
                                if ($this->session->userdata('level') == 'direktur' || $this->session->userdata('level') == 'spv_purchasing') {
                                    echo "";
                                }else{
                            ?>
                            <a href="<?php echo base_url().'Mitra/tambah_mitra/'.$this->uri->segment(3); ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Supplier <?php echo $tipe = ($this->uri->segment(3) == 'Baku') ? 'Bahan Baku' : $this->uri->segment(3) ; ?></a>
                            <?php
                                }
                            ?>
                            <a href="<?php echo base_url().'export/mitra/'.$this->uri->segment(3); ?>" class="btn btn-sm btn-success"><i class="fas fa-file-export"></i> Export Supplier <?php echo $tipe = ($this->uri->segment(3) == 'Baku') ? 'Bahan Baku' : $this->uri->segment(3) ; ?></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>E-mail</th>
                                            <th>Badan Usaha</th>
                                            <th>Tipe Supplier</th>
                                            <th>Telepon</th>
                                            <th>Negara</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($data_mitra as $key) {
                                    ?>
                                        <tr>
                                            <td><?php echo $key->no_mitra; ?></td>
                                            <td><?php echo $key->nama_mitra; ?></td>
                                            <td><?php echo $key->email_mitra; ?></td>
                                            <td><?php echo $key->badan_usaha; ?></td>
                                            <td><?php echo $key->tipe_mitra; ?></td>
                                            <td><?php echo $key->telp_mitra; ?></td>
                                            <td><?php echo $key->negara_mitra; ?></td>
                                            <td width="100">
                                                <div class="dropdown show">
                                                  <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Tindakan
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a href="<?php echo base_url().'mitra/detail_mitra/'.$key->id_mitra ?>" class="dropdown-item"><i class="fa fa-eye"></i> Detail
                                                    </a>
                                                    <?php
                                                        if ($this->session->userdata('level') == 'direktur' || $this->session->userdata('level') == 'spv_purchasing') {
                                                            echo "";
                                                        }else{
                                                    ?>
                                                    <a href="<?php echo base_url().'mitra/edit_info_mitra/'.$key->id_mitra ?>" class="dropdown-item"><i class="fa fa-pencil"></i> Ubah</a>
                                                    <a onclick="deleteConfirm('<?php echo base_url().'mitra/hapus_mitra/'.$key->id_mitra ?>')"
                                                        href="#!" class="dropdown-item"><i class="fa fa-trash"></i> Hapus</a>
                                                    <?php
                                                        }
                                                    ?>
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
</script>

</body>
</html>