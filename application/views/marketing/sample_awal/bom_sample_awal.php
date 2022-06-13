<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - BOM Sample</title>

    <?php $this->load->view('partials/head', FALSE);?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php 
            if ($this->session->userdata('level') == 'marketing') {
                $this->load->view('partials/sidebar_marketing', FALSE);
            }elseif ($this->session->userdata('level') == 'tim_marketing') {
                $this->load->view('partials/sidebar_tim_marketing', FALSE);
            }elseif ($this->session->userdata('level') == 'rnd') {
                $this->load->view('partials/sidebar_rnd', FALSE);
            }elseif ($this->session->userdata('level') == 'direktur') {
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
                    <h1 class="h4 mb-2 text-gray-800">Permintaan : <b><?php echo $sample->permintaan_sample_awal; ?></b></h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <?php
                            if ($this->session->userdata('level') == 'rnd') {
                        ?>
                         <div class="card-header py-3">
                            <a href="<?= base_url().'sample/tambah_bom/'.$id ?>" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah </a>
                        </div>
                        <?php
                            }
                        ?>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="20">No.</th>
                                            <th>Tanggal</th>
                                            <th>Kode</th>
                                            <th>Keterangan</th>
                                            <th>Status</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                      $no = 1;
                                      foreach ($bom as $key) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?>.</td>
                                            <td><?php echo date('d/m/Y',strtotime($key->tanggal_bom_sample)); ?></td>
                                            <td><?php echo $key->kode_bom_sample; ?></td>
                                            <td><?php echo $key->ket_bom_sample; ?></td>
                                            <td><span class="badge badge-<?= ($key->status_bom_sample == '1') ? 'success' : 'secondary' ?>"><?= ($key->status_bom_sample == '1') ? 'Aktif' : 'Non Aktif' ?></span></td>
                                            <td>
                                                <div class="dropdown show">
                                                  <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-cog"></i>
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                      <a href="javascript:void(0)" onclick="pilih('<?= $key->id_bom_sample ?>')" class="dropdown-item"><i class="fa fa-check"></i> Pilih</a> 
                                                      <a href="<?= (!empty($key->file_bom_sample)) ? $key->file_bom_sample : '#!'; ?>" class="dropdown-item"><i class="fa fa-file-pdf"></i> File</a> 
                                                      <a href="<?= base_url().'sample/detail_bom/'.$key->id_bom_sample; ?>" class="dropdown-item"><i class="fa fa-eye"></i> Detail</a> 
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

    function pilih(id){
        $.ajax({
            url: "<?php echo base_url().'sample/pilih_bom'; ?>",
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            success: function(data){
                if (data.status == '1') {
                  window.location.reload();
                }
            }
        });
    }
</script>

</body>
</html>