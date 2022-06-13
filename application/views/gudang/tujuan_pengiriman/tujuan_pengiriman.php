<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Tujuan Pengiriman</title>

    <?php $this->load->view('partials/head', FALSE);?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
            $this->load->view('partials/sidebar_gudang', FALSE);
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
                    <h1 class="h4 mb-2 text-gray-800">Daftar Tujuan Pengiriman Barang !</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <?php
                            if ($this->session->userdata('level') == 'gudang') {
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
                                        <tr align="center">
                                            <th width="100" align="center">No</th>
                                            <th>Nama</th>
                                            <th>Telp</th>
                                            <th>Alamat</th>
                                            <?php
                                                if ($this->session->userdata('level') == 'gudang') {
                                            ?>
                                            <th width="100">Tindakan</th>
                                            <?php
                                                }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $no = 1;
                                    foreach ($tujuan as $key) {
                                    ?>
                                        <tr>
                                            <td align="center"><?php echo $no++; ?>.</td>
                                            <td><?php echo $key->nama_tujuan_pengiriman; ?></td>
                                            <td><?php echo $key->no_telp_pengiriman; ?></td>
                                            <td><?php echo $key->alamat_pengiriman; ?></td>
                                            <?php
                                                if ($this->session->userdata('level') == 'gudang') {
                                            ?>
                                            <td width="100">
                                                <div class="dropdown show">
                                                  <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Tindakan
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a onclick="show_modal('edit','<?php echo $key->id_tujuan_pengiriman; ?>')" class="dropdown-item"><i class="fa fa-pencil"></i> Ubah</a>
                                                    <a onclick="deleteConfirm('<?php echo base_url().'tujuan/hapus/'.$key->id_tujuan_pengiriman; ?>')"
                                                        href="#!" class="dropdown-item"><i class="fa fa-trash"></i> Hapus</a>
                                                  </div>
                                                </div>
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
            <div class="modal fade" id="tambahTujuanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                    <form method="post" action="<?php echo base_url().'tujuan/simpan'; ?>" accept-charset="utf-8" id="form-crud-tujuan">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary" id="exampleModalLabel">Buat Tujuan Pengiriman</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama_tujuan" class="text-primary"><b>Nama</b></label>
                                <input class="form-control" type="text" id="nama_tujuan_modal" name="nama_tujuan" required="" placeholder="Nama tujuan pengiriman"> 
                                <input type="hidden" id="id_tujuan_edit" name="id_tujuan" value="">
                                <input type="hidden" id="aksi_tujuan_modal" name="aksi" value="">
                            </div>
                            <div class="form-group">
                                <label for="telp_tujuan" class="text-primary"><b>Telp</b></label>
                                <input class="form-control" type="text" id="telp_tujuan_modal" placeholder="Telp tujuan pengiriman" required name="telp_tujuan">
                            </div>
                            <div class="form-group">
                                <label for="alamat_tujuan" class="text-primary"><b>Alamat</b></label>
                                <textarea name="alamat_tujuan" rows="4" class="form-control" id="alamat_tujuan_modal" placeholder="Alamat tujuan pengiriman" required></textarea>
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

            $('.modal-header .modal-title').text('Buat Tujuan Pengiriman');
            $('.modal-body #id_tujuan_edit').attr('disabled', 'true');
            $('.modal-body #aksi_tujuan_modal').val('tambah');
            $('.modal-body #nama_tujuan_modal').val(''); 
            $('.modal-body #telp_tujuan_modal').val(''); 
            $('.modal-body #alamat_tujuan_modal').val(''); 
            $('#tambahTujuanModal').modal({backdrop: 'static', keyboard: false});

        }else if(aksi == 'edit'){

            $('.modal-header .modal-title').text('Ubah Tujuan Pengiriman');
            $('.modal-body #id_tujuan_edit').removeAttr('disabled');
            $('.modal-body #aksi_tujuan_modal').val('edit');
            $.ajax({
            url: "<?php echo base_url().'tujuan/json_tujuan_pengiriman'; ?>",
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            success : function(data){
                    $('.modal-body #id_tujuan_edit').val(id);
                    $('.modal-body #nama_tujuan_modal').val(data.nama_tujuan_pengiriman); 
                    $('.modal-body #telp_tujuan_modal').val(data.no_telp_pengiriman); 
                    $('.modal-body #alamat_tujuan_modal').val(data.alamat_pengiriman); 
                    $('#tambahTujuanModal').modal({backdrop: 'static', keyboard: false});
                }
            });

        }
    }
</script>

</body>
</html>