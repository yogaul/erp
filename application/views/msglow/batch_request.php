<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Batch</title>

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
            }elseif ($this->session->userdata('level') == 'ms_glow' || $this->session->userdata('level') == 'kci') {
                $this->load->view('partials/sidebar_msglow', FALSE);
            }elseif ($this->session->userdata('level') == 'direktur') {
                $this->load->view('partials/sidebar_direktur', FALSE);
            }elseif ($this->session->userdata('level') == 'purchasing') {
                $this->load->view('partials/sidebar', FALSE);
            }elseif ($this->session->userdata('level') == 'produksi') {
                $this->load->view('partials/sidebar_produksi', FALSE);
            }elseif ($this->session->userdata('level') == 'qc') {
                $this->load->view('partials/sidebar_qc', FALSE);
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
                    <h1 class="h4 mb-2 text-gray-800">Batch Product Request : <b><?= $mrequest->usulan_nama_produk ?></b></h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <?php
                            if ($this->session->userdata('level') == 'qc') {
                        ?>
                        <div class="card-header py-3">
                            <a href="#!" class="btn btn-sm btn-primary" onclick="show_modal('tambah','1')"><i class="fas fa-plus"></i> Tambah</a>
                        </div>
                        <?php
                            }
                        ?>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal</th>
                                            <th>User</th>
                                            <th>Keterangan</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach ($batch as $key) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?>.</td>
                                            <td><?php echo date('d/m/Y H:i:s',strtotime($key->tanggal_batch_msglow)); ?></td>
                                            <td><?php echo $key->user_batch_msglow; ?></td>
                                            <td><?php echo $key->keterangan_batch_msglow; ?></td>
                                            <td>
                                                <a target="_blank" href="<?php echo $key->dokumen_batch_msglow; ?>" class="btn btn-sm btn-primary"><i class="fa fa-file-pdf"></i> File</a> 
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

            <!-- Tambah Modal -->
            <div class="modal fade" id="tambahBatchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                    <form method="post" action="<?php echo base_url().'glow/simpan_batch'; ?>" id="form-add-bpom" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title text-primary" id="exampleModalLabel">Tambah</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">??</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="dokumen_batch" class="text-primary"><b>Dokumen </b></label>
                                <input type="hidden" name="id_request" value="<?= $id ?>">
                                <input type="file" class="form-control-file" name="file_batch" required="" id="file-batch">
                            </div>
                            <div class="form-group">
                                <label for="deskripsi batch" class="text-primary"><b>Deskripsi</b></label>
                                <textarea name="deskripsi_batch" class="form-control" placeholder="Deskripsi dokumen..." rows="5" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Simpan</button>
                            <a class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Batal</a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
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

    function show_modal(aksi,id){
        $('.modal-header .modal-title').css('font-weight', 'bold');
        if (aksi == 'tambah') {
            $('.modal-header .modal-title').text('Input Pembuatan Batch');
            $('#tambahBatchModal').modal({backdrop: 'static', keyboard: false});
        }
    }

    // $(document).ready(function() {
        // $(document).on('change', '#file-bpom', function(event) {
        //     event.preventDefault();
        //     Object.values(this.files).forEach(function(file) {
        //         if (file.type != 'application/pdf') {
        //             alert('file yang ada pilih harus PDF !');
        //             $('#file-bpom').val('');
        //         }
        //     });
        // });
    // });
</script>
</body>
</html>