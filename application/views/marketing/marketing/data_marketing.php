<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Marketing</title>

    <?php $this->load->view('partials/head', FALSE);?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view('partials/sidebar_marketing', FALSE);?>
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
                    <h1 class="h4 mb-2 text-gray-800">Daftar Tim Marketing Anda !</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="#!" class="btn btn-sm btn-primary" onclick="show_modal('tambah','1')"><i class="fas fa-plus"></i> Tambah Anggota</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tableTimMarketing" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>Telp</th>
                                            <th>Email</th>
                                            <th>Tindakan</th>   
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $no = 1;
                                    foreach ($marketing as $key) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $key->nama_user; ?></td>
                                            <td><?php echo $key->telp_user; ?></td>
                                            <td><?php echo $key->email_user; ?></td>
                                            <td width="100">
                                                <div class="dropdown show">
                                                  <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Tindakan
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a onclick="show_modal('edit','<?php echo $key->id_user; ?>')" class="dropdown-item"><i class="fa fa-pencil"></i> Ubah</a>
                                                    <a onclick="deleteConfirm('<?php echo base_url().'marketing/hapus/'.$key->id_user; ?>')"
                                                        href="#!" class="dropdown-item"><i class="fa fa-trash"></i> Hapus</a>
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

            <!-- Tambah Modal -->
            <div class="modal fade" id="tambahMarketingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                    <form method="post" action="<?php echo base_url().'marketing/ubah_simpan' ?>" accept-charset="utf-8" id="form-crud-customer">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary" id="exampleModalLabel">Tambah Anggota</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        	 <div class="form-group">
                                <label for="nama_marketing" class="text-primary"><b>Nama</b></label>
                                <input type="hidden" id="id_marketing_edit" name="id_marketing" value="">
                                <input type="hidden" id="aksi_marketing_modal" name="aksi" value="">
                                <input class="form-control" type="text" id="nama_marketing_modal" name="nama_marketing" required="" placeholder="Nama anggota baru...">
                            </div>
                            <div class="form-group">
                                <label for="telp_marketing" class="text-primary"><b>Nomor Telp</b></label>
                                <input class="form-control" type="text" id="telp_marketing_modal" name="telp_marketing" required="" placeholder="Nomor telepon...">
                            </div>
                            <div class="form-group">
                                <label for="email_marketing" class="text-primary"><b>E-Mail</b></label>
                                <input class="form-control" type="text" id="email_marketing_modal" name="email_marketing" required="" placeholder="Alamat email...">
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

            $('.modal-header .modal-title').text('Tambah Anggota');
            $('.modal-body #id_marketing_edit').attr('disabled', 'true');
            $('.modal-body #aksi_marketing_modal').val('tambah');
            $('.modal-body #nama_marketing_modal').val('');
            $('.modal-body #telp_marketing_modal').val('');
            $('.modal-body #email_marketing_modal').val('');
            $('.modal-body #alamat_marketing_modal').val('');
            $('#tambahMarketingModal').modal({backdrop: 'static', keyboard: false});

        }else if(aksi == 'edit'){

            $('.modal-header .modal-title').text('Ubah Anggota');
            $('.modal-body #id_marketing_edit').removeAttr('disabled');
            $('.modal-body #aksi_marketing_modal').val('edit');
            $.ajax({
            url: "<?php echo base_url().'marketing/get_json_marketing' ?>",
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            success : function(data){
                // $.each(data, function(index, data) {
                    $('.modal-body #id_marketing_edit').val(id);
		            $('.modal-body #nama_marketing_modal').val(data.nama_user);
		            $('.modal-body #telp_marketing_modal').val(data.telp_user);
                    $('.modal-body #email_marketing_modal').val(data.email_user);
		            $('.modal-body #alamat_marketing_modal').val(data.alamat_user);
                // });
                    $('#tambahMarketingModal').modal({backdrop: 'static', keyboard: false});
                }
            });

        }
    }

    $(document).ready(function() {
        $('#tableTimMarketing').DataTable( {
            stateSave: true
        } );
    });
</script>

</body>
</html>