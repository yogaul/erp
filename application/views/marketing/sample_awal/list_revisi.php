<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Revisi</title>

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
                    <h1 class="h4 mb-2 text-gray-800">Daftar Revisi Sample Awal : <?php echo $sample; ?></h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <?php 
                            if ($this->session->userdata('level') == 'marketing' || $this->session->userdata('level') == 'tim_marketing') {
                        ?>
                        <div class="card-header py-3">
                            <a class="btn btn-sm btn-primary" onclick="show_modal('tambah','1')"><i class="fas fa-plus"></i> Tambah Revisi</a>
                        </div>
                        <?php
                            }elseif ($this->session->userdata('level') == 'rnd') {
                                echo "";
                            }
                        ?>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="200">Tanggal Revisi</th>
                                            <th>Detail Revisi</th>
                                            <?php 
                                                if ($this->session->userdata('level') == 'marketing' || $this->session->userdata('level') == 'tim_marketing') {
                                            ?>
                                            <th width="100">Tindakan</th>
                                            <?php
                                                }elseif ($this->session->userdata('level') == 'rnd') {
                                                    echo "";
                                                }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($revisi as $key) {
                                    ?>
                                        <tr>
                                            <td><?php echo date('d/m/Y H:i:s',strtotime($key->tanggal_revisi)); ?></td>
                                            <td><?php echo $key->detail_revisi; ?></td>
                                            <?php 
                                                if ($this->session->userdata('level') == 'marketing' || $this->session->userdata('level') == 'tim_marketing') {
                                            ?>
                                            <td width="100">
                                                <div class="dropdown show">
                                                  <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Tindakan
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a onclick="show_modal('edit','<?php echo $key->id_revisi_sample_awal; ?>')" class="dropdown-item"><i class="fa fa-pencil"></i> Ubah</a>
                                                    <a onclick="deleteConfirm('<?php echo base_url().'sample/hapus_revisi/'.$key->id_revisi_sample_awal; ?>')"
                                                        href="#!" class="dropdown-item"><i class="fa fa-trash"></i> Hapus</a>
                                                  </div>
                                                </div>
                                            </td>
                                            <?php
                                                }elseif ($this->session->userdata('level') == 'rnd') {
                                                    echo "";
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
            <div class="modal fade" id="tambahRevisiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                    <form method="post" action="<?php echo base_url().'sample/simpan_revisi' ?>" accept-charset="utf-8" id="form-crud-customer">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary" id="exampleModalLabel">Tambah Revisi</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        	 <div class="form-group">
                                <label for="kode_customer" class="text-primary"><b>Tanggal Revisi</b></label>
                                <input type="hidden" id="id_revisi_edit" name="id_revisi" value="">
                                <input type="hidden" name="id_sample" value="<?php echo $this->uri->segment(3); ?>">
                                <input type="hidden" id="aksi_revisi_modal" name="aksi" value="">
                                <input type="text" name="tanggal_revisi" id="tanggal_revisi_modal" class="form-control" value="<?php echo date('d/m/Y') ?>" placeholder="" readonly="">
                            </div>
                            <div class="form-group">
                                <label for="detail_revisi" class="text-primary"><b>Detail Revisi</b></label>
                                <textarea class="form-control" id="detail_revisi_modal" name="detail_revisi" required="" placeholder="Detail revisi..." rows="5"></textarea>
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
    // CKEDITOR.replace('detail_revisi');

    function deleteConfirm(url){
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }

    function show_modal(aksi,id){
        $('.modal-header .modal-title').css('font-weight', 'bold');
        if (aksi == 'tambah') {

            $('.modal-header .modal-title').text('Tambah Revisi');
            $('.modal-body #id_revisi_edit').attr('disabled', 'true');
            $('.modal-body #aksi_revisi_modal').val('tambah');
            $('.modal-body #detail_revisi_modal').val('');
            $('#tambahRevisiModal').modal({backdrop: 'static', keyboard: false});

        }else if(aksi == 'edit'){

            $('.modal-body #tanggal_revisi_modal').val('');
            $('.modal-header .modal-title').text('Ubah Revisi');
            $('.modal-body #id_revisi_edit').removeAttr('disabled');
            $('.modal-body #aksi_revisi_modal').val('edit');
            $.ajax({
            url: "<?php echo base_url().'sample/get_json_revisi' ?>",
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            success : function(data){
                    console.log(data);
                    $('.modal-body #id_revisi_edit').val(id);
		            $('.modal-body #tanggal_revisi_modal').val(data.tanggal_revisi);
		            $('.modal-body #detail_revisi_modal').val(data.detail_revisi);
                    $('#tambahRevisiModal').modal({backdrop: 'static', keyboard: false});
                }
            });

        }
    }
</script>

</body>
</html>