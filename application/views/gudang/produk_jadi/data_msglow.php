<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - MS Glow</title>

    <?php $this->load->view('partials/head', FALSE);?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
            if ($this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier') {
                $this->load->view('partials/sidebar_gudang', FALSE);
            }elseif ($this->session->userdata('level') == 'ppic') {
                $this->load->view('partials/sidebar_ppic', FALSE);
            }elseif ($this->session->userdata('level') == 'rnd') {
                $this->load->view('partials/sidebar_rnd', FALSE);
            }elseif ($this->session->userdata('level') == 'marketing') {
                $this->load->view('partials/sidebar_marketing', FALSE);
            }elseif ($this->session->userdata('level') == 'tim_marketing') {
                $this->load->view('partials/sidebar_tim_marketing', FALSE);
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
                    <h1 class="h4 mb-2 text-gray-800">Daftar Produk Jadi !</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="#!" class="btn btn-sm btn-primary" onclick="show_modal('tambah','1')"><i class="fas fa-plus"></i> Tambah Produk</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tabel-produk" width="100%" cellspacing="0">
                                    <thead>
                                        <tr align="center">
                                            <th width="100" align="center">No</th>
                                            <th>Nama Produk</th>
                                            <th>Kode</th>
                                            <th>Volume</th>
                                            <th>Stok</th>
                                            <th>Keterangan</th>
                                            <th width="100">Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $no = 1;
                                    foreach ($produk as $key) {
                                    ?>
                                        <tr>
                                            <td align="center"><?php echo $no++; ?>.</td>
                                            <td><?php echo $key->nama_produk_msglow; ?></td>
                                            <td><?php echo $key->kode_produk_msglow; ?></td>
                                            <td><?php echo $key->volume_produk_msglow; ?></td>
                                            <td><?php echo number_format($key->stok_produk_msglow,0,',','.'); ?></td>
                                            <td><?php echo $data =  (empty($key->keterangan_produk_msglow)) ? '-' : $key->keterangan_produk_msglow; ?></td>
                                            <td width="100">
                                                <div class="dropdown show">
                                                  <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Tindakan
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <?php
                                                        if ($this->session->userdata('level') == 'rnd') {
                                                    ?>
                                                    <a href="<?= base_url().'glow/bom/'.$key->id_produk_msglow ?>" class="dropdown-item"><i class="fa fa-file"></i> BOM</a>
                                                    <?php
                                                        }
                                                    ?>
                                                    <a onclick="show_modal('edit','<?php echo $key->id_produk_msglow; ?>')" class="dropdown-item"><i class="fa fa-pencil"></i> Ubah</a>
                                                    <!-- <a onclick="deleteConfirm('<?php echo base_url().'glow/hapus/'.$key->id_produk_msglow; ?>')"
                                                        href="#!" class="dropdown-item"><i class="fa fa-trash"></i> Hapus</a> -->
                                                    <a href="<?php echo base_url().'glow/log_glow/'.$key->id_produk_msglow ?>" class="dropdown-item"><i class="fas fa-dolly"></i> Log Barang</a>
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
            <div class="modal fade" id="tambahMsglowModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                    <form method="post" action="<?php echo base_url().'glow/simpan'; ?>" accept-charset="utf-8" id="form-crud-glow">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary" id="exampleModalLabel">Buat Produk MS Glow</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama_produk" class="text-primary"><b>Nama Produk</b></label>
                                <input class="form-control" type="text" id="nama_msglow_modal" name="nama_produk" required="" placeholder="Nama produk...">
                                <input type="hidden" id="id_msglow_edit" name="id_msglow" value="">
                                <input type="hidden" id="aksi_msglow_modal" name="aksi" value="">
                            </div>
                            <div class="form-group">
                                <label for="kode_produk" class="text-primary"><b>Kode Produk</b></label>
                                <input class="form-control" type="text" id="kode_msglow_modal" name="kode_produk" required="" placeholder="Kode produk...">
                            </div>
                            <div class="form-group">
                                <label for="volume_produk" class="text-primary"><b>Volume Produk</b> (Kg)</label>
                                <input class="form-control" type="number" step=".01" id="volume_msglow_modal" name="volume_produk" required="" placeholder="Volume produk...">
                            </div>
                            <div class="form-group">
                                <label for="stok_produk" class="text-primary"><b>Stok</b></label>
                                <input class="form-control" type="text" id="stok_msglow_modal" placeholder="Stok produk Ms Glow..." onkeyup="number_stok()">
                                <input class="form-control" type="hidden" id="stok_msglow" name="stok_produk">
                                <input class="form-control" type="hidden" id="temp_stok_msglow" name="temp_stok">
                            </div>
                            <div class="form-group">
                                <label for="keterangan_produk" class="text-primary"><b>Keterangan</b></label>
                                <textarea name="keterangan_produk" rows="4" class="form-control" id="keterangan_produk_modal" placeholder="Keterangan produk..."></textarea>
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

            $('.modal-header .modal-title').text('Buat Produk Ms Glow');
            $('.modal-body #id_msglow_edit').attr('disabled', 'true');
            $('.modal-body #temp_stok_msglow').attr('disabled', 'true');
            $('.modal-body #aksi_msglow_modal').val('tambah');
            $('.modal-body #nama_msglow_modal').val(''); 
            $('.modal-body #kode_msglow_modal').val(''); 
            $('.modal-body #volume_msglow_modal').val(''); 
            $('.modal-body #stok_msglow_modal').val(''); 
            $('.modal-body #stok_msglow').val(''); 
            $('.modal-body #temp_stok_msglow').val(''); 
            $('.modal-body #keterangan_produk_modal').val(''); 
            $('#tambahMsglowModal').modal({backdrop: 'static', keyboard: false});

        }else if(aksi == 'edit'){

            $('.modal-header .modal-title').text('Ubah Produk Ms Glow');
            $('.modal-body #id_msglow_edit').removeAttr('disabled');
            $('.modal-body #temp_stok_msglow').removeAttr('disabled');
            $('.modal-body #aksi_msglow_modal').val('edit');
            $.ajax({
            url: "<?php echo base_url().'glow/json_msglow'; ?>",
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            success : function(data){
                    $('.modal-body #id_msglow_edit').val(id);
                    $('.modal-body #nama_msglow_modal').val(data.nama_produk_msglow); 
                    $('.modal-body #kode_msglow_modal').val(data.kode_produk_msglow); 
                    $('.modal-body #volume_msglow_modal').val(data.volume_produk_msglow); 
                    $('.modal-body #stok_msglow_modal').val(kurensi_teks(data.stok_produk_msglow));
                    $('.modal-body #stok_msglow').val(data.stok_produk_msglow); 
                    $('.modal-body #temp_stok_msglow').val(data.stok_produk_msglow); 
                    $('.modal-body #keterangan_produk_modal').val(data.keterangan_produk_msglow); 
                    $('#tambahMsglowModal').modal({backdrop: 'static', keyboard: false});
                }
            });

        }
    }

    function number_stok(){
        let stok_text = $('.modal-body #stok_msglow_modal').val().replace(/[^0-9]/g, '').toString(); 
        $('.modal-body #stok_msglow_modal').val(stok_text.replace(/[^0-9]/g, '').toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
        $('.modal-body #stok_msglow').val(stok_text);
    }

    function kurensi_teks(bilangan){
        var number_string = bilangan.toString(),
            split   = number_string.split('.'),
            sisa    = split[0].length % 3,
            rupiah  = split[0].substr(0, sisa),
            ribuan  = split[0].substr(sisa).match(/\d{1,3}/gi);
                
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return rupiah;
    }

    $(document).ready(function () {
        $('#tabel-produk').DataTable({
            stateSave: true
        });
    });
</script>

</body>
</html>