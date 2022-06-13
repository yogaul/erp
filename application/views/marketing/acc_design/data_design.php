<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Design</title>

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
                    <h1 class="h4 mb-2 text-gray-800">Daftar Acc Design Produk</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <?php
                            if ($this->session->userdata('level') == 'marketing' || $this->session->userdata('level') == 'tim_marketing') {
                        ?>
                        <div class="card-header py-3">
                            <a href="#!" class="btn btn-sm btn-primary" onclick="show_modal('tambah','1')"><i class="fas fa-plus"></i> Buat Acc Design</a>
                        </div>
                        <?php
                            }
                        ?>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tanggal Acc</th>
                                            <th>Nama Customer</th>
                                            <th>Nama Brand</th>
                                            <th>Nama Produk</th>
                                            <th>Keterangan</th>
                                            <th width="100">Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($list_design as $key) {
                                    ?>
                                        <tr>
                                            <td><?php echo date('d/m/Y',strtotime($key->tanggal_acc_design)); ?></td>
                                            <td><?php echo $key->nama_customer; ?></td>
                                            <td><?php echo $key->nama_brand_produk; ?></td>
                                            <td><?php echo $key->nama_produk_acc." ".$key->volume_produk_acc; ?></td>
                                            <td><?php echo $key->keterangan_acc_design; ?></td>
                                            <td>
                                                <div class="dropdown show">
                                                  <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Tindakan
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a href="<?php echo $key->foto_acc_design; ?>" class="dropdown-item"><i class="fa fa-file-pdf"></i> Cetak Desain</a> 
                                                    <?php
                                                        if ($this->session->userdata('level') == 'marketing' || $this->session->userdata('level') == 'tim_marketing') {
                                                    ?>
                                                    <a onclick="deleteConfirm('<?php echo base_url().'design/hapus/'.$key->id_acc_design; ?>')"
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

            <!-- Tambah Modal -->
            <div class="modal fade" id="tambahAccModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                    <form method="post" action="<?php echo base_url().'design/simpan'; ?>" id="form-crud-customer" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary" id="exampleModalLabel">Buat Acc Design</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama_customer" class="text-primary"><b>Brand (Merk)</b></label>
                                <input type="hidden" id="id_acc_edit" name="id_acc_design" value="">
                                <input type="hidden" id="aksi_acc_modal" name="aksi" value="">
                                <select name="merk_acc_design" class="form-control" required="" id="merk_acc_design">
                                    <option value="-" disabled="" selected="">Pilih merk</option>
                                <?php 
                                    foreach ($brand as $value) {
                                ?>
                                    <option value="<?php echo $value->id_brand_produk; ?>"><?php echo $value->nama_brand_produk." - ".$value->nama_customer; ?></option>
                                <?php
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nama_perusahaan" class="text-primary"><b>Produk</b></label>
                                <select name="produk_acc_design" class="form-control form-control-sm" required="" id="produk_acc_design">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jabatan_customer" class="text-primary"><b>Dokumen Design</b> (PDF Maks. 3 MB)</label>
                                <input type="file" class="form-control-file form-control-file-sm" name="dokumen_design" required="">
                            </div>
                            <div class="form-group">
                                <label for="keterangan_acc_design" class="text-primary"><b>Keterangan Acc Design</b></label>
                                <textarea name="keterangan_acc_design" class="form-control" placeholder="Keterangan acc design..." rows="4"></textarea>
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

            $('.modal-header .modal-title').text('Buat Acc Design');
            $('.modal-body #id_acc_edit').attr('disabled', 'true');
            $('.modal-body #aksi_acc_modal').val('tambah');
            $('#tambahAccModal').modal({backdrop: 'static', keyboard: false});

        }else if(aksi == 'edit'){

            $('.modal-header .modal-title').text('Ubah Acc Design');
            $('.modal-body #id_acc_edit').removeAttr('disabled');
            $('.modal-body #aksi_acc_modal').val('edit');
            $.ajax({
            url: "<?php echo base_url().'design/get_json_acc_design' ?>",
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            success : function(data){
                // $.each(data, function(index, data) {
                //     $('.modal-body #id_ac_edit').val(id);
                // });
                    $('#tambahAccModal').modal({backdrop: 'static', keyboard: false});
                }
            });

        }
    }

    $(document).ready(function() {
        $('.modal-body #merk_acc_design').select2({
            theme : 'bootstrap'
        });

        $('#merk_acc_design').change(function(event) {
            $('#produk_acc_design').html('');
            var id = $(this).val();
            $.ajax({
                url: "<?php echo base_url().'sample/json_acc_customer'; ?>",
                type: 'POST',
                dataType: 'json',
                data: {id: id},
                success: function(data){
                    $.each(data, function(i, val) {
                        $('#produk_acc_design').append($("<option />").val(val.id_sample_acc).text(val.nama_produk_acc+" "+val.volume_produk_acc));
                    });
                }
            });
        });
    });
</script>

</body>
</html>