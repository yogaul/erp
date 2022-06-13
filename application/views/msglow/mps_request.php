<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - MPS</title>

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
            }elseif ($this->session->userdata('level') == 'ppic') {
                $this->load->view('partials/sidebar_ppic', FALSE);
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
                    <h1 class="h4 mb-2 text-gray-800">MPS Product Request : <b><?= $mrequest->usulan_nama_produk ?></b></h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <?php
                            if ($this->session->userdata('level') == 'ppic') {
                        ?>
                        <div class="card-header py-3">
                            <a href="#!" class="btn btn-sm btn-primary" onclick="show_modal('<?= $id ?>')"><i class="fas fa-plus"></i> Tambah</a>
                            <?php
                                if ($mrequest->start_mps != '0000-00-00 00:00:00' && $mrequest->end_mps == '0000-00-00 00:00:00') {
                            ?>
                                <a href="#!" class="btn btn-sm btn-danger" onclick="endConfirm('<?= base_url().'glow/end_mps/'.$id ?>')"><i class="fas fa-power-off"></i> End Task</a>
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
                                            <th>User</th>
                                            <th>Keterangan</th>
                                            <?php
                                                if ($this->session->userdata('level') == 'ppic' || $this->session->userdata('level') == 'rnd' || $this->session->userdata('level') == 'direktur') {
                                            ?>
                                            <th>Tindakan</th>
                                            <?php
                                                }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach ($mps as $key) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?>.</td>
                                            <td><?php echo date('d/m/Y',strtotime($key->tanggal_mps_msglow)); ?></td>
                                            <td><?php echo $key->user_mps_msglow; ?></td>
                                            <td><?php echo $key->keterangan_mps_msglow; ?></td>
                                            <?php
                                                if ($this->session->userdata('level') == 'ppic' || $this->session->userdata('level') == 'rnd' || $this->session->userdata('level') == 'direktur') {
                                            ?>
                                            <td>
                                                <a href="<?= base_url().'glow/detail_mps/'.$key->id_mps_msglow; ?>" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Detail</a> 
                                            </td>
                                            <?php
                                                }
                                            ?>
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
            <div class="modal fade" id="tambahMpsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                    <form method="post" action="<?php echo base_url().'glow/simpan_mps'; ?>" id="form-add-bpom" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title text-primary" id="exampleModalLabel">Tambah</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="dokumen_mps" class="text-primary"><b>Dokumen </b></label>
                                <input type="hidden" name="id_request" value="<?= $id ?>">
                                <input type="hidden" name="aksi" id="aksi">
                                <input type="file" class="form-control-file" name="file_mps" required="" id="file-mps">
                            </div>
                            <div class="form-group">
                                <label for="deskripsi mps" class="text-primary"><b>Deskripsi</b></label>
                                <textarea name="deskripsi_mps" class="form-control" placeholder="Deskripsi dokumen..." rows="5" required></textarea>
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

    function show_modal(id){
        $.ajax({
            type: "POST",
            url: "<?= base_url().'glow/json_request' ?>",
            data: {id: id},
            dataType: "json",
            success: function (response) {
                if (response.tahun_start_mps != 0 && response.tahun_end_mps != 0) {
                    let mconfirm = confirm("Pengerjaan MPS product ini sudah diakhiri,  apakah anda yakin akan memulai ulang ?");
                    if (mconfirm == true) {
                        window.location.href = "<?= base_url().'glow/tambah_mps/' ?>"+id;
                    }
                }else{
                    window.location.href = "<?= base_url().'glow/tambah_mps/' ?>"+id;
                }
            }
        });
    }
</script>
</body>
</html>