<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - BOM</title>

    <?php $this->load->view('partials/head', FALSE);?>

    <style type="text/css">
        th{
            text-align: center;
        }
    </style>

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
                    <h1 class="h4 mb-2 text-gray-800">Detail Bill Of Materials (BOM)!</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="brand_so" class="text-primary"><b>Nomor PO BOM</b></label>
                                        <p><?php echo $data_bom->no_po_bom; ?></p>
                                    </div>
                                    <div class="col-3"></div>
                                    <div class="col-3"></div>
                                    <div class="col-3">
                                        <label for="brand_so" class="text-primary"><b>Brand (Merk)</b></label>
                                        <p><?php echo $data_bom->nama_customer." - ".$data_bom->nama_perusahaan_customer; ?></p>
                                    </div>
                                </div><hr>    
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table-produk" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama Produk</th>
                                                <th>Shrink</th>
                                                <th>Inner Box</th>
                                                <th>Label</th>
                                                <th>Karton</th>
                                                <th>Lain-lain</th>
                                                <th>Coding</th>
                                                <th>Status</th>
                                                <th>Foto Desain</th>
                                            </tr>
                                        </thead>
                                        <tbody id="data_produk">
                                            <?php
                                            $no = 1;
                                            foreach ($detail_bom as  $value) {
                                            ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $value->nama_produk_acc." ".$value->volume_produk_acc; ?></td>
                                                <td><?php echo $value->shrink_bom; ?></td>
                                                <td align="center"><?php echo $data = ($value->inner_box_bom == 'Tidak') ? "-" : "<i class='fas fa-check'></i>"; ?></td>
                                                <td><?php echo $value->label_bom; ?></td>
                                                <td><?php echo $value->karton_bom; ?></td>
                                                <td><?php echo $value->lain_lain_bom; ?></td>
                                                <td align="center"><?php echo $coding = ($value->coding_bom == 'Tidak') ? "-" : "<i class='fas fa-check'></i>"; ?></td>
                                                <td><?php echo $value->ro_bom; ?></td>
                                                <td><img src="<?php echo $value->foto_desain_bom; ?>" width="50px" onclick="show_modal('<?php echo $value->id_detail_bom; ?>')"></td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div><hr>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="catatan_bom" class="text-primary"><b>Catatan BOM</b></label>
                                        <p><?php echo $catatan = (empty($data_bom->catatan_bom)) ? "-" : $data_bom->catatan_bom; ?></p>
                                    </div>
                                </div><br>
                                <a href="<?php echo base_url().'bom/cetak_bom/'.$id; ?>" class="btn btn-sm btn-primary float-right"><i class="fas fa-file-pdf"></i> Cetak PDF</a>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
        </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php $this->load->view('partials/footer', FALSE); ?>
            <!-- End of Footer -->

             <!-- View Image Modal -->
            <div id="viewImageModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title text-primary font-weight-bold" id="wizard-title">Foto Desain</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <center><img width="300px" id="foto_desain_modal"></center>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-close"></i> Tutup</button>
                  </div>
                </div>
              </div>
            </div>

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
</body>
<script type="text/javascript">
    $("#table-produk").DataTable({
        stateSave : true
    });

    function show_modal(id){
        $.ajax({
            url: "<?php echo base_url().'bom/get_json_img'; ?>",
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            success: function(data){
                $('.modal-body #foto_desain_modal').attr('src', data);
                $('#viewImageModal').modal({backdrop: 'static', keyboard: false});
            }
        });
    }
</script>
</html>