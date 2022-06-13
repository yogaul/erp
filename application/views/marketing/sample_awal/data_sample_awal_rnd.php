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
            $this->load->view('partials/sidebar_rnd', FALSE);
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
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="awalTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tanggal Request</th>
                                            <th>Nama Customer</th>
                                            <th>Nama Perusahaan</th>
                                            <th>Jabatan</th>
                                            <th>Alamat Perusahaan (Pengiriman)</th>
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
                                            <td><?php echo date('d/m/Y H:i:s', strtotime($key->tanggal_request_awal)); ?></td>
                                            <td><?php echo $key->nama_customer; ?></td>
                                            <td><?php echo $key->nama_perusahaan_customer; ?></td>
                                            <td><?php echo $key->jabatan_customer; ?></td>
                                            <td><?php echo $key->alamat_cust; ?></td>
                                            <td><?php echo $key->telp_customer; ?></td>
                                            <td><?php echo $key->telp_perusahaan_customer; ?></td>
                                            <td><?php echo $marketing = (is_null($key->id_user)) ? '-' : $key->nama_user; ?></td>
                                            <td width="100">
                                                <div class="dropdown show">
                                                  <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Tindakan
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a href="<?php echo base_url().'sample/list_request/'.$key->id_customer; ?>" class="dropdown-item"><i class="fa fa-eye"></i> List Permintaan</a>
                                                    <?php 
                                                    if ($this->session->userdata('level') == 'marketing') {
                                                    ?>
                                                     <a onclick="show_marketing('<?php echo $key->id_customer; ?>')" class="dropdown-item"><i class="fa fa-pencil"></i> Pilih Marketing</a>
                                                    <?php
                                                    }else{
                                                        echo "";
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

            <!-- Pilih Modal -->
            <div id="pilihMarketingModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <form action="<?php echo base_url().'sample/set_marketing'; ?>" method="post" accept-charset="utf-8">
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
                    <button type="submit" class="btn btn-sm btn-primary" name="btn-simpan-marketing">Simpan</button>
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

    $(document).ready(function() {
        $('#awalTable').DataTable({
            stateSave: true
        });

        $('#creativeTable').DataTable({
            stateSave: true
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