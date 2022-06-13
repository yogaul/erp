<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Brand</title>

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
                    <h1 class="h4 mb-2 text-gray-800">Daftar Brand Customer !</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <?php
                            if ($this->session->userdata('level') == 'marketing' || $this->session->userdata('level') == 'tim_marketing') {
                        ?>
                        <div class="card-header py-3">
                            <a href="#!" class="btn btn-sm btn-primary" onclick="show_modal('tambah','1')"><i class="fas fa-plus"></i> Tambah Brand</a>
                        </div>
                        <?php
                            }
                        ?>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama Brand</th>
                                            <th>Nama Customer</th>
                                            <?php
                                                if ($this->session->userdata('level') == 'marketing' || $this->session->userdata('level') == 'tim_marketing') {
                                            ?>
                                            <th width="100px">Tindakan</th>
                                            <?php
                                                }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($brand as $key) {
                                    ?>
                                        <tr>
                                            <td><?php echo $key->nama_brand_produk; ?></td>
                                            <td><?php echo $key->nama_customer; ?></td>
                                            <?php
                                                if ($this->session->userdata('level') == 'marketing' || $this->session->userdata('level') == 'tim_marketing') {
                                            ?>
                                            <td width="100">
                                                <div class="dropdown show">
                                                  <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Tindakan
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a onclick="show_modal('edit','<?php echo $key->id_brand_produk; ?>')" class="dropdown-item"><i class="fa fa-pencil"></i> Ubah</a>
                                                    <a onclick="deleteConfirm('<?php echo base_url().'brand/hapus/'.$key->id_brand_produk; ?>')"
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
            <div class="modal fade" id="tambahBrandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                    <form method="post" action="<?php echo base_url().'brand/simpan' ?>" accept-charset="utf-8" id="form-crud-brand">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary" id="exampleModalLabel">Buat Brand</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama_brand" class="text-primary"><b>Nama Brand</b><br>*bila belum memiliki brand, silahkan diisi dengan simbol (-)</label>
                                <input class="form-control form-control-sm" type="text" id="nama_brand_modal" name="nama_brand" required="" placeholder="Nama brand customer...">
                                <input type="hidden" id="id_brand_edit" name="id_brand" value="">
                                <input type="hidden" id="aksi_brand_modal" name="aksi" value="">
                            </div>
                            <div class="form-group">
                                <label for="customer" class="text-primary"><b>Customer</b></label>
                                <select name="customer" class="form-control" id="pilih_customer_brand">
                                <option value="-" disabled="true" selected="true">Pilih customer</option>
                                <?php 
                                    foreach ($customer as $value) {
                                ?>
                                <option value="<?php echo $value->id_customer; ?>"><?php echo $value->nama_customer." - ".$value->nama_perusahaan_customer; ?></option>
                                <?php
                                    }
                                ?>
                                </select>
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

            $('.modal-header .modal-title').text('Buat Brand');
            $('.modal-body #id_brand_edit').attr('disabled', 'true');
            $('.modal-body #aksi_brand_modal').val('tambah');
            $('.modal-body #nama_brand_modal').val(''); 
            $('.modal-body #pilih_customer_brand').val("-");
            $('#tambahBrandModal').modal({backdrop: 'static', keyboard: false});

        }else if(aksi == 'edit'){

            $('.modal-header .modal-title').text('Ubah Brand');
            $('.modal-body #id_brand_edit').removeAttr('disabled');
            $('.modal-body #aksi_brand_modal').val('edit');
            $.ajax({
            url: "<?php echo base_url().'brand/get_json_brand' ?>",
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            success : function(data){
                    $('.modal-body #id_brand_edit').val(id);
		            $('.modal-body #nama_brand_modal').val(data.nama_brand_produk);
                    $('.modal-body #pilih_customer_brand').val(data.id_customer);
                    $('#tambahBrandModal').modal({backdrop: 'static', keyboard: false});
                }
            });

        }
    }

    $(document).ready(function() {
        $('#pilih_customer_brand').select2({
            theme: "bootstrap",
            placeholder: "Pilih Customer",
            width: 'auto',
            dropdownAutoWidth: true,
            allowClear: true,
        });
    });
</script>

</body>
</html>