<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Sample Awal</title>

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
                    <h1 class="h4 mb-2 text-gray-800">Permintaan Sample Awal</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="tab1" data-toggle="tab" href="#creativePanel" role="tab">Creative Briefing Logo</a>
                          <li>
                          <li class="nav-item">
                            <a class="nav-link" id="tab2" data-toggle="tab" href="#awalPanel" role="tab">Sample Awal</a>
                          <li>
                        </ul>
                        <div class="card-body">
                        <div class="tab-content mt-1">
                        <div class="tab-pane fade show active" id="creativePanel" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="creativeTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tanggal Briefing</th>
                                            <th>Nama Customer</th>
                                            <th>Nama Brand</th>
                                            <th>Gambar Logo</th>
                                            <th>Model Logo</th>
                                            <th>Selera Brand</th>
                                            <th>Font</th>
                                            <th>Warna</th>
                                            <th>Target Marketing</th>
                                            <th>Referensi Logo</th>
                                            <?php
                                                if ($this->session->userdata('level') == 'marketing') {
                                            ?>
                                            <th>Tindakan</th>
                                            <?php
                                                }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($briefing as $key) {
                                    ?>
                                        <tr>
                                            <td><?php echo date('d/m/Y', strtotime($key->tanggal_briefing_logo)); ?></td>
                                            <td><?php echo $key->nama_customer; ?></td>
                                            <td><?php echo $key->nama_brand_briefing; ?></td>
                                            <td><?php echo $key->gambar_logo_briefing; ?></td>
                                            <td><?php echo $key->model_logo_briefing; ?></td>
                                            <td><?php echo $key->selera_brand_briefing; ?></td>
                                            <td><?php echo $key->font_briefing; ?></td>
                                            <td><?php echo $key->warna_briefing; ?></td>
                                            <td><?php echo $key->target_marketing_briefing; ?></td>
                                            <td><a href="<?php echo $key->referensi_logo_briefing; ?>" target="blank"><?php echo $key->referensi_logo_briefing; ?></a></td>
                                            <?php
                                                if ($this->session->userdata('level') == 'marketing') {
                                            ?>
                                            <td width="100">
                                                <div class="dropdown show">
                                                  <a class="btn btn-sm btn-primary dropdown-toggle" href="javascript:void(0)" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Tindakan
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a href="javascript:void(0)" onclick="deleteConfirm('<?php echo base_url().'sample/hapus_briefing/'.$key->id_briefing_logo; ?>')" class="dropdown-item"><i class="fa fa-trash"></i> Hapus</a>
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
                        <div class="tab-pane fade" id="awalPanel" role="tabpanel">
                            <div class="row">
                                <div class="col-6">
                                    <?php
                                        if ($this->session->userdata('level') == 'marketing') {
                                    ?>
                                     <a href="javascript:void(0)" onclick="show_import()" class="btn btn-sm btn-primary"><i class="fas fa-file-upload"></i> Import Excel</a>
                                    <?php
                                         } 
                                    ?>
                                    <?php 
                                        if (empty($sample_awal)) {
                                            echo "";
                                        }else{
                                    ?>
                                    <a href="<?= base_url().'export/sample_awal' ?>" class="btn btn-sm btn-success"><i class="fas fa-file-export"></i> Export Excel</a>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div><br>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="awalTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tanggal Request</th>
                                            <th>Nama Customer</th>
                                            <th>Nama Perusahaan</th>
                                            <th>Jabatan</th>
                                            <th>Alamat Pengiriman</th>
                                            <th>Telp. Customer</th>
                                            <th>Telp. Perusahaan</th>
                                            <th>Marketing</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($sample_awal as $key) {
                                    ?>
                                        <tr>
                                            <td><?php echo date('d/m/Y', strtotime($key->tanggal_request_awal)); ?></td>
                                            <td><?php echo $key->nama_customer; ?></td>
                                            <td><?php echo $key->nama_perusahaan_customer; ?></td>
                                            <td><?php echo $key->jabatan_customer; ?></td>
                                            <td><?php echo $key->alamat_cust; ?></td>
                                            <td><?php echo $key->telp_customer; ?></td>
                                            <td><?php echo $key->telp_perusahaan_customer; ?></td>
                                            <td><?php echo $marketing = (is_null($key->id_user)) ? '-' : $key->nama_user; ?></td>
                                            <td width="100">
                                                <div class="dropdown show">
                                                  <a class="btn btn-sm btn-primary dropdown-toggle" href="javascript:void(0)" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Tindakan
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a href="<?php echo base_url().'sample/list_request/'.$key->id_customer; ?>" class="dropdown-item"><i class="fa fa-eye"></i> List Permintaan</a>
                                                    <?php 
                                                    if ($this->session->userdata('level') == 'marketing') {
                                                    ?>
                                                     <a href="javascript:void(0)" onclick="show_marketing('<?php echo $key->id_customer; ?>')" class="dropdown-item"><i class="fa fa-pencil"></i> Pilih Marketing</a>
                                                     <a href="javascript:void(0)" onclick="deleteConfirm('<?php echo base_url().'sample/hapus_awal/'.$key->id_customer; ?>')" class="dropdown-item"><i class="fa fa-trash"></i> Hapus</a>
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
             </div>
            </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php $this->load->view('partials/footer', FALSE); ?>

            <!-- Pilih Modal -->
            <div id="pilihMarketingModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <form method="post">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-primary font-weight-bold" id="wizard-title">Pilih Marketing</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                            <div class="form-group">
                                <label class="text-primary font-weight-bold">Nama Marketing</label>
                                <input type="hidden" name="id_customer" value="" id="id_customer_modal">
                                <select class="form-control" name="marketing" id="marketing_modal"></select>
                            </div>
                      </div>
                      <div class="modal-footer">
                        <a type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-close"></i> Tutup</a>
                        <a href="javascript:void(0)" type="button" class="btn btn-sm btn-primary" name="btn-simpan-marketing" onclick="set_marketing()"><i class="fas fa-save"></i> Simpan</a>
                      </div>
                </form>
                </div>
              </div>
            </div>

             <!-- Pilih Modal -->
            <div id="importModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <form method="post" action="<?php echo base_url().'sample/import_file'; ?>" enctype="multipart/form-data">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-primary font-weight-bold" id="wizard-title">Import Excel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                            <div class="form-group">
                                <label class="text-primary"><b>Pilih File</b> (.xls / .xlsx)</label>
                                <input type="file" class="form-control-file" name="file_import">
                            </div>
                      </div>
                      <div class="modal-footer">
                        <a type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-close"></i> Tutup</a>
                        <button type="submit" class="btn btn-sm btn-primary" name="btn-simpan-marketing"><i class="fas fa-file-upload"></i> Import</button>
                      </div>
                </form>
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

    function show_marketing(id){
        $('.modal-body #id_customer_modal').val(id);
        $.ajax({
            url: "<?php echo base_url().'marketing/get_json_marketing_all'; ?>",
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            success: function(data){
                $.each(data, function(i, data) {
                    $('.modal-body #marketing_modal').append($("<option />").val(data.id_user).text(data.nama_user));
                });
            }
        }).then(function(){
            $('#pilihMarketingModal').modal({backdrop: 'static', keyboard: false});
        }); 
    }

    function set_marketing(){
        let id = $('.modal-body #marketing_modal').val();
        let customer = $('.modal-body #id_customer_modal').val();

         $.ajax({
            url: "<?php echo base_url().'sample/set_marketing'; ?>",
            type: 'POST',
            dataType: 'json',
            data: {id_customer: customer, marketing: id},
            success: function(data){
               window.location.reload();
            }
        });
    }

    function show_import(){
        $('#importModal').modal({backdrop: 'static', keyboard: false});
    }

    $(document).ready(function() {
        $('#awalTable').DataTable({
            stateSave: true,
            order: [[ 0, "desc" ]],
            columnDefs : [{"targets":0, "type":"date-eu"}]
        });

        $('#creativeTable').DataTable({
            stateSave: true,
            order: [[ 0, "desc" ]],
            columnDefs : [{"targets":0, "type":"date-eu"}]
        });

        $('#myTab a').click(function(e) {
          e.preventDefault();
          $(this).tab('show');
        });

        $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
          var id = $(e.target).attr("href").substr(1);
          window.location.hash = id;
        });

        var hash = window.location.hash;
        $('#myTab a[href="' + hash + '"]').tab('show');
    });
</script>

</body>
</html>