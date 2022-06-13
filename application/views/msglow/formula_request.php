<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Product</title>

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
                    <h1 class="h4 mb-2 text-gray-800">Product Request : <b><?= $mrequest->usulan_nama_produk ?></b></h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <?php
                            if ($this->session->userdata('level') == 'rnd' || $this->session->userdata('level') == 'direktur') {
                        ?>
                          <div class="card-header py-3">
                            <a href="javascript:void(0)" onclick="show_modal('<?= $id ?>')" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah</a>
                            <?php
                                if ($mrequest->start_formula != '0000-00-00 00:00:00' && $mrequest->end_formula == '0000-00-00 00:00:00') {
                            ?>
                                <a href="#!" class="btn btn-sm btn-danger" onclick="endConfirm('<?= base_url().'glow/end_formula/'.$id ?>')"><i class="fas fa-power-off"></i> End Task</a>
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
                                            <th width="20">No.</th>
                                            <th>Tanggal</th>
                                            <th>Kode</th>
                                            <th>Deskripsi</th>
                                            <th>Acc KGI</th>
                                            <!-- <th>Tanggal Acc</th> -->
                                            <th>Keterangan</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach ($formula as $key) {
                                            if ($key->acc_formula_msglow == 'Belum') {
                                                $color_kgi = "badge badge-secondary";
                                            }elseif ($key->acc_formula_msglow == 'Ditolak') {
                                                $color_kgi = "badge badge-danger";
                                            }elseif ($key->acc_formula_msglow == 'Sudah') {
                                                $color_kgi = "badge badge-success";
                                            }
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?>.</td>
                                            <td><?php echo date('d/m/Y H:i:s',strtotime($key->tanggal_formula_msglow)); ?></td>
                                            <td><?php echo $key->kode_formula_msglow; ?></td>
                                            <td><?php echo $key->deskripsi_formula_msglow; ?></td>
                                            <td><span class="<?= $color_kgi ?>"><?= $key->acc_formula_msglow ?></span></td>
                                            <!-- <td><?= $date = ($key->tanggal_acc_formula_msglow == '0000-00-00') ? '-' : date('d/m/Y',strtotime($key->tanggal_acc_formula_msglow)); ?></td> -->
                                            <td><?php echo $key->keterangan_acc_formula_msglow; ?></td>
                                            <td>
                                                <div class="dropdown show float-left mr-1">
                                                  <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-cog"></i>
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <?php
                                                        if ($key->acc_formula_msglow == 'Sudah') {
                                                    ?>
                                                    <a href="<?= base_url().'glow/review/'.$key->id_formula_msglow ?>" class="dropdown-item"><i class="fa fa-comment"></i> Comment</a> 
                                                    <a href="<?= base_url().'glow/panelis/'.$key->id_formula_msglow ?>" class="dropdown-item"><i class="fa fa-users"></i> Panelis</a> 
                                                    <a href="<?= base_url().'glow/sample/'.$key->id_formula_msglow ?>" class="dropdown-item"><i class="fa fa-file"></i> Sample</a> 
                                                    <a href="<?= base_url().'glow/scale/'.$key->id_formula_msglow ?>" class="dropdown-item"><i class="fa fa-search"></i> Scale Up</a> 
                                                    <?php
                                                        }
                                                    ?>
                                                    <?php
                                                        if ($this->session->userdata('level') == 'direktur' || $this->session->userdata('level') == 'rnd') {
                                                    ?>
                                                        <a target="_blank" href="<?php echo $key->file_formula_msglow; ?>" class="dropdown-item"><i class="fa fa-file-pdf"></i> File</a> 
                                                        <a href="<?= base_url().'glow/detail_formula/'.$key->id_formula_msglow; ?>" class="dropdown-item"><i class="fa fa-eye"></i> Detail</a> 
                                                    <?php
                                                        }
                                                    ?>
                                                  </div>
                                                </div>
                                                <?php
                                                    if ($this->session->userdata('level') == 'direktur' && $key->acc_formula_msglow == 'Belum') {
                                                ?>
                                                <a href="javascript:void(0)" onclick="accConfirm('<?= base_url().'glow/acc_formula/'.$key->id_formula_msglow ?>')" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Acc</a> 
                                                <a href="javascript:void(0)" onclick="show_reject('<?= $key->id_formula_msglow ?>')" class="btm btn-sm btn-danger"><i class="fa fa-ban"></i> Reject</a> 
                                                <?php
                                                    }
                                                ?>
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
            <div class="modal fade" id="tambahFormulaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                    <form method="post" action="<?php echo base_url().'glow/simpan_formula'; ?>" id="form-add-formula" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary" id="exampleModalLabel">Buat Product</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="kode_formula" class="text-primary"><b>Kode Product</b></label>
                                <input type="hidden" name="id_request" value="<?= $id ?>">
                                <input type="hidden" name="aksi" id="aksi">
                                <input type="text" name="kode_formula" id="kode_formula_modal"  class="form-control" placeholder="Kode..." required>
                            </div>
                            <div class="form-group">
                                <label for="jabatan_customer" class="text-primary"><b>Dokumen</b></label>
                                <input type="file" class="form-control-file" name="dokumen_formula" required="" id="file-formula">
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_formula" class="text-primary"><b>Deskripsi</b></label>
                                <textarea name="deskripsi_formula" class="form-control" placeholder="Deskripsi..." rows="5" required></textarea>
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

            <!-- Acc Confirmation-->
            <div class="modal fade" id="accModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Data yang disetujui tidak akan bisa dikembalikan.</div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                    <a id="btn-acc" class="btn btn-sm btn-primary" href="#"><i class="fas fa-check"></i> Acc</a>
                </div>
                </div>
            </div>
            </div>

            <!-- Reject Modal -->
            <div class="modal fade" id="rejectFormulaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                    <form method="post" action="<?php echo base_url().'glow/reject_formula'; ?>" id="form-reject-formula">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary" id="exampleModalLabel">Reject Product</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="kode_formula" class="text-primary"><b>Kode Product</b></label>
                                <input type="hidden" name="id_formula" value="" id="id_formula_modal">
                                <input type="text" name="kode_formula" id="kode_formula_modal"  class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="keterangan_reject" class="text-primary"><b>Keterangan Reject</b></label>
                                <textarea name="keterangan_reject" class="form-control" placeholder="Keterangan reject..." rows="5" required></textarea>
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

    function accConfirm(url){
        $('#btn-acc').attr('href', url);
        $('#accModal').modal();
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
                if (response.tahun_start_formula != 0 && response.tahun_end_formula != 0) {
                    let mconfirm = confirm("Pengerjaan product ini sudah diakhiri,  apakah anda yakin akan memulai ulang ?");
                    if (mconfirm == true) {
                        window.location.href = "<?= base_url().'glow/tambah_formula/' ?>"+id;
                    }
                }else{
                    window.location.href = "<?= base_url().'glow/tambah_formula/' ?>"+id;
                }
            }
        });
    }

    function show_reject(id){
        $('.modal-header .modal-title').css('font-weight', 'bold');
        $.ajax({
            type: "POST",
            url: "<?= base_url().'glow/json_formula' ?>",
            data: {id: id},
            dataType: "json",
            success: function (response) {
                $('.modal-body #id_formula_modal').val(id);
                $('.modal-body #kode_formula_modal').val(response.kode_formula_msglow);
                $('#rejectFormulaModal').modal({backdrop: 'static', keyboard: false});
            }
        });
    }
</script>

</body>
</html>