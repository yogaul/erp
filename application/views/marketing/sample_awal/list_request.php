<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Permintaan Sample</title>

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
                    <h1 class="h4 mb-2 text-gray-800">Nama Customer : <b><?php echo $customer; ?></b></h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="#!" class="btn btn-sm btn-success"><i class="fas fa-file-export"></i> Export Excel</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Permintaan Sample</th>
                                            <th>Target Harga</th>
                                            <th>Volume</th>
                                            <th>Spesifikasi</th>
                                            <th>Contoh Foto Produk (Dupe)</th>
                                            <th>Request ke RnD</th>
                                            <th>Deadline RnD</th>
                                            <th>Kode</th>
                                            <th>Tanggal Kirim</th>
                                            <th>Status</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($sample as $key) {
                                    ?>
                                        <tr>
                                            <td><?php echo $key->permintaan_sample_awal; ?></td>
                                            <td><?php echo "Rp.".number_format($key->target_harga_awal,0,'.','.'); ?></td>
                                            <td><?php echo $key->volume_sample_awal; ?></td>
                                            <td><?php echo $key->spesifikasi_sample_awal; ?></td>
                                            <td align="center"><img src="<?php echo $key->foto_sample_awal; ?>" width="50px" onclick="show_modal('<?php echo $key->id_sample_awal; ?>')"></td>
                                            <td><?php echo $status = ($key->tanggal_request_rnd == '0000-00-00 00:00:00' || is_null($key->tanggal_request_rnd)) ? '-' : date('d/m/Y H:i:s', strtotime($key->tanggal_request_rnd)); ?></td>
                                            <td><?php echo $deadline = ($key->deadline_sample_awal == '0000-00-00' || is_null($key->deadline_sample_awal)) ? '-' : date('d/m/Y', strtotime($key->deadline_sample_awal)); ?></td>
                                            <td><?php echo $key->kode; ?></td>
                                            <td><?php echo $tgl_kirim = ($key->tanggal_kirim_sample == '0000-00-00 00:00:00' || is_null($key->tanggal_kirim_sample)) ? '-' : date('d/m/Y H:i:s', strtotime($key->tanggal_kirim_sample)); ?></td>
                                            <td><?php echo $status = (empty($key->status_sample_awal) || is_null($key->status_sample_awal)) ? '-' : $key->status_sample_awal; ?></td>
                                            <td width="100">
                                                <div class="dropdown show">
                                                  <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Tindakan
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a onclick="show_modal('<?php echo $key->id_sample_awal; ?>')" class="dropdown-item"><i class="fa fa-eye"></i> Detail Permintaan</a>
                                                    <?php
                                                    if ($key->tanggal_request_rnd != NULL) {
                                                         echo "";
                                                     }else{
                                                        if ($this->session->userdata('level') == 'marketing') {
                                                    ?>
                                                    <a href="<?php echo base_url().'sample/send_rnd/'.$key->id_sample_awal; ?>" class="dropdown-item"><i class="fa fa-arrow-right"></i> Kirim ke RnD</a>
                                                    <?php
                                                        }else{
                                                            echo '';
                                                        }
                                                     }
                                                    ?>
                                                    <a href="<?php echo base_url().'sample/list_revisi/'.$key->id_sample_awal; ?>" class="dropdown-item"><i class="fa fa-cog"></i> Revisi Sample</a>
                                                    <?php 
                                                    if ($this->session->userdata('level') == 'rnd') {
                                                    ?>
                                                    <a href="<?= base_url().'sample/bom/'.$key->id_sample_awal ?>" class="dropdown-item"><i class="fa fa-file"></i> BOM</a>
                                                    <a onclick="show_input_deadline('<?php echo $key->id_sample_awal; ?>')" class="dropdown-item"><i class="fa fa-edit"></i> Input Deadline</a>
                                                    <a onclick="show_input_tanggal_kirim('<?php echo $key->id_sample_awal; ?>')" class="dropdown-item"><i class="fa fa-edit"></i> Input Tgl Kirim Sample</a>
                                                    <?php
                                                    }elseif ($this->session->userdata('level') == 'marketing' || $this->session->userdata('level') == 'tim_marketing') {
                                                    ?>
                                                   <a onclick="show_input_status('<?php echo $key->id_sample_awal; ?>')" class="dropdown-item"><i class="fa fa-edit"></i> Input Status</a>
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

            <!-- Detail Modal -->
            <div id="detailSampleModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title text-primary font-weight-bold">Contoh Foto Produk (Dupe)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <center><img width="300px" id="img_sample_modal"></center>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-close"></i> Tutup</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Input Deadline Modal -->
            <div id="inputDeadlineModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <form  method="POST" action="<?php echo base_url().'sample/set_deadline'; ?>">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title text-primary font-weight-bold">Input Deadline</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_produk" class="text-primary"><b>Nama Permintaan Produk</b></label>
                        <input type="hidden" name="id_sample_awal" id="id_awal_deadline">
                        <input type="text" name="nama_produk_deadline" class="form-control" id="nama_sample_awal_deadline" readonly="">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_deadline_awal" class="text-primary"><b>Tanggal Deadline</b></label>
                        <input type="date" name="tanggal_deadline_awal" class="form-control" required="">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    <a type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-close"></i> Tutup</a>
                  </div>
                </div>
              </div>
            </form>
            </div>

            <!-- Input Tanggal Kirim Modal -->
            <div id="inputTanggalKirimModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <form  method="POST" action="<?php echo base_url().'sample/set_tanggal_kirim'; ?>">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title text-primary font-weight-bold">Input Tanggal Pengiriman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_produk" class="text-primary"><b>Nama Permintaan Produk</b></label>
                        <input type="hidden" name="id_sample_awal" id="id_kirim_sample">
                        <input type="text" name="nama_produk_kirim_awal" class="form-control" id="nama_sample_awal_kirim" readonly="">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_kirim_sample_awal" class="text-primary"><b>Tanggal Kirim Sample</b></label>
                        <input type="datetime-local" name="tanggal_kirim_sample_awal" class="form-control" required="">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    <a type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-close"></i> Tutup</a>
                  </div>
                </div>
              </div>
            </form>
            </div>

            <!-- Input Status Modal -->
            <div id="inputStatusModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title text-primary font-weight-bold">Input Status Sample Awal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_produk" class="text-primary"><b>Nama Permintaan Produk</b></label>
                        <input type="hidden" name="id_sample_awal" class="id_sample_status_modal">
                        <input type="text" name="nama_produk_kirim_awal" class="form-control nama-sample-status-modal" readonly="">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_kirim_sample_awal" class="text-primary"><b>Status</b></label>
                        <select name="status_sample" class="form-control status_sample_modal" required="">
                            <option value="Sudah FU 1">Sudah FU 1</option>
                            <option value="Sudah FU 2">Sudah FU 2</option>
                            <option value="Sample 1">Sample 1</option>
                            <option value="Sample 2">Sample 2</option>
                            <option value="Sample 3">Sample 3</option>
                            <option value="Desain Kemasan">Desain Kemasan</option>
                        </select>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary btn-input-status"><i class="fas fa-save"></i> Simpan</button>
                    <a type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-close"></i> Tutup</a>
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

    function show_modal(id){
        $.ajax({
            url: "<?php echo base_url().'sample/get_json_img'; ?>",
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            success: function(data){
                $('.modal-body #img_sample_modal').attr('src', data);
                $('#detailSampleModal').modal({backdrop: 'static', keyboard: false});
            }
        });
    }

    function show_input_deadline(id){
         $.ajax({
            url: "<?php echo base_url().'sample/json_nama_acc'; ?>",
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            success: function(data){
                $('.modal-body #id_awal_deadline').val(data.id_sample_awal);
                $('.modal-body #nama_sample_awal_deadline').val(data.permintaan_sample_awal);
                $('#inputDeadlineModal').modal({backdrop: 'static', keyboard: false});
            }
        });
    }
    
    function show_input_tanggal_kirim(id){
         $.ajax({
            url: "<?php echo base_url().'sample/json_nama_acc'; ?>",
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            success: function(data){
                $('.modal-body #id_kirim_sample').val(data.id_sample_awal);
                $('.modal-body #nama_sample_awal_kirim').val(data.permintaan_sample_awal);
                $('#inputTanggalKirimModal').modal({backdrop: 'static', keyboard: false});
            }
        });
    }

    function show_input_status(id){
         $.ajax({
            url: "<?php echo base_url().'sample/json_status_sample'; ?>",
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            success: function(data){
                $('.modal-body .id_sample_status_modal').val(data.id_sample_awal);
                $('.modal-body .nama-sample-status-modal').val(data.permintaan_sample_awal);
                $('#inputStatusModal').modal({backdrop: 'static', keyboard: false});
            }
        });
    }

    $(document).ready(function() {
        $('.btn-input-status').click(function(event) {
            /* Act on the event */
            let id = $('.id_sample_status_modal').val();
            let status = $('.status_sample_modal').val();
            $.ajax({
                url: "<?php echo base_url().'sample/json_update_status'; ?>",
                type: 'POST',
                dataType: 'json',
                data: {id: id, status: status},
                success: function(data){
                    if (data.status == '1') {
                        window.location.reload();
                    }else{
                        alert(data.pesan);
                    }
                }
            });
        });
    });
</script>

</body>
</html>