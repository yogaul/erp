<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Panelis</title>

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
                    <h1 class="h4 mb-2 text-gray-800">Panelis Product Request : <b><?= $mrequest->usulan_nama_produk ?></b></h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <?php
                            if ($this->session->userdata('level') == 'direktur' || $this->session->userdata('level') == 'rnd' || $this->session->userdata('level') == 'ms_glow' || $this->session->userdata('level') == 'kci' || $this->session->userdata('level') == 'marketing') {
                        ?>
                        <div class="card-header py-3">
                            <a href="#!" class="btn btn-sm btn-primary" onclick="show_modal('tambah','<?= $id_request ?>')"><i class="fas fa-plus"></i> Tambah</a>
                            <?php
                                if ($mrequest->start_panelis != '0000-00-00 00:00:00' && $mrequest->end_panelis == '0000-00-00 00:00:00') {
                            ?>
                                <a href="#!" class="btn btn-sm btn-danger" onclick="endConfirm('<?= base_url().'glow/end_panelis/'.$id ?>')"><i class="fas fa-power-off"></i> End Task</a>
                            <?php     
                                }
                            ?>
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
                                            <th>Panelis By</th>
                                            <th>Deskripsi</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach ($panelis as $key) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?>.</td>
                                            <td><?php echo date('d/m/Y H:i:s',strtotime($key->tanggal_panelis_msglow)); ?></td>
                                            <td><?php echo $key->panelis_by; ?></td>
                                            <td><?php echo $key->deskripsi_file_panelis; ?></td>
                                            <td>
                                                <a target="_blank" href="<?php echo $key->file_panelis_msglow; ?>" class="btn btn-sm btn-primary"><i class="fa fa-file-pdf"></i> File</a> 
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
            <div class="modal fade" id="tambahPanelisModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                    <form method="post" action="<?php echo base_url().'glow/simpan_panelis'; ?>" id="form-add-panelis" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary" id="exampleModalLabel">Tambah Panelis</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="dokumen_panelis" class="text-primary"><b>Dokumen Panelis</b></label>
                                <input type="hidden" name="id_formula" value="<?= $id ?>">
                                <input type="hidden" name="id_request" value="<?= $id_request ?>">
                                <input type="hidden" name="aksi" id="aksi">
                                <input type="file" class="form-control-file" name="file_panelis" required="" id="file-panelis">
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_panelis" class="text-primary"><b>Deskripsi</b></label>
                                <textarea name="deskripsi_panelis" class="form-control" placeholder="Deskripsi panelis..." rows="5" required></textarea>
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

            <!-- End Task Confirmation-->
            <div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin telah selesai?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Data yang diubah tidak akan bisa dikembalikan.</div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Cancel</button>
                    <a id="btn-end" class="btn btn-sm btn-danger" href="#"><i class="fas fa-power-off"></i> End Task</a>
                </div>
                </div>
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

    function endConfirm(url){
        $('#btn-end').attr('href', url);
        $('#taskModal').modal();
    }

    function show_modal(aksi,id){
        $('.modal-header .modal-title').css('font-weight', 'bold');
        $('#tambahPanelisModal .modal-title').text('Tambah Panelis');

        $.ajax({
            type: "POST",
            url: "<?= base_url().'glow/json_request' ?>",
            data: {id: id},
            dataType: "json",
            success: function (response) {
                if (response.tahun_start_panelis != 0 && response.tahun_end_panelis != 0) {
                    let mconfirm = confirm("Pengerjaan product ini sudah diakhiri,  apakah anda yakin akan memulai ulang ?");
                    if (mconfirm == true) {
                        $('#tambahPanelisModal #aksi').val('reset');
                    $('#tambahPanelisModal').modal({backdrop: 'static', keyboard: false});
                    }
                }else if (response.tahun_start_panelis != 0 && response.tahun_end_panelis == 0) {
                    $('#tambahPanelisModal #aksi').val('lanjut');
                    $('#tambahPanelisModal').modal({backdrop: 'static', keyboard: false});
                }else{
                    $('#tambahPanelisModal #aksi').val('mulai');
                    $('#tambahPanelisModal').modal({backdrop: 'static', keyboard: false});
                }
            }
        });
    }
</script>

</body>
</html>