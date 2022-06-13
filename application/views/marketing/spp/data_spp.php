<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - SPP</title>

    <?php $this->load->view('partials/head', FALSE);?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
            if ($this->session->userdata('level') == 'marketing') {
                $this->load->view('partials/sidebar_marketing', FALSE);
            }elseif ($this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier') {
                $this->load->view('partials/sidebar_gudang', FALSE);
            }elseif ($this->session->userdata('level') == 'ppic'){
                $this->load->view('partials/sidebar_ppic', FALSE);
            }elseif ($this->session->userdata('level') == 'direktur'){
                $this->load->view('partials/sidebar_direktur', FALSE);
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
                    <h1 class="h4 mb-2 text-gray-800">Daftar Surat Perintah Pengiriman (SPP)</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <?php
                        if ($this->session->userdata('level') == 'marketing') {
                        ?>
                        <div class="card-header py-3">
                            <a href="<?php echo base_url().'spp/buat_spp'; ?>" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Buat SPP</a>
                        </div>
                        <?php
                         }
                        ?>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tanggal SPP</th>
                                            <th>Nomor SPP</th>
                                            <th>Nama Customer</th>
                                            <th>Nama Brand</th>
                                            <th>No.Telp</th>
                                            <th>Alamat Pengiriman</th>
                                            <th>Catatan</th>
                                            <th width="100px">Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($list_spp as $key) {
                                    ?>
                                        <tr>
                                            <td><?php echo date('d/m/Y H:i:s',strtotime($key->tanggal_spp)); ?></td>
                                            <td><?php echo $key->nomor_spp; ?></td>
                                            <td><?php echo $key->nama_customer; ?></td>
                                            <td><?php echo $key->nama_brand_produk; ?></td>
                                            <td><?php echo $key->no_telp_spp; ?></td>
                                            <td><?php echo $key->alamat_pengiriman_spp; ?></td>
                                            <td><?php echo $key->catatan_spp; ?></td>
                                            <td width="100">
                                                <div class="dropdown show">
                                                  <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Tindakan
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a href="<?php echo base_url().'spp/detail/'.$key->id_spp; ?>" class="dropdown-item"><i class="fa fa-eye"></i> Detail SPP</a>
                                                    <?php 
                                                        if ($this->session->userdata('level') == 'marketing') {
                                                    ?>
                                                    <a href="<?php echo base_url().'spp/ubah/'.$key->id_spp; ?>" class="dropdown-item"><i class="fa fa-pencil"></i> Ubah</a>
                                                    <a onclick="deleteConfirm('<?php echo base_url().'spp/hapus/'.$key->id_spp; ?>')" href="#!" class="dropdown-item"><i class="fa fa-trash"></i> Hapus</a>
                                                    <?php
                                                        }elseif ($this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier') {
                                                    ?>
                                                    <a href="<?php echo base_url().'sjp/index/'.$key->id_spp; ?>" class="dropdown-item"><i class="fa fa-list"></i> List SJP</a>
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