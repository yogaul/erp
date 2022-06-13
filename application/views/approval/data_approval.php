<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Order</title>

    <?php $this->load->view('partials/head', FALSE);?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
            if ($this->session->userdata('level') == 'direktur' || $this->session->userdata('level') == 'spv_purchasing') {
                $this->load->view('partials/sidebar_direktur', FALSE);
            }else{
                $this->load->view('partials/sidebar', FALSE);
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
                    <h1 class="h4 mb-2 text-gray-800">PO Bahan <?php echo ucwords($kode); ?> Belum Acc</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                            <?php 
                                if (!empty($list_po)) {
                            ?>
                            <div class="card-header py-3">
                                <a href="#!" class="btn btn-sm btn-warning float-right" onclick="show_acc('<?php echo $kode; ?>')"><i class="fa fa-check"></i> Approve Semua Order</a>
                            </div>
                            <?php
                                }
                             ?>
                        <div class="card-body">
                            <form action="<?php echo base_url().'approval/acc_selected'?>" method="post" accept-charset="utf-8">
                               <div class="table-responsive">
                                <input type="hidden" name="kategori" value="<?php echo $kode; ?>">
                                <table class="table table-bordered" id="tableApprove" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Pilih</th>
                                            <th>Supplier</th>
                                            <th>No. PO</th>
                                            <th>Status Approve</th>
                                            <th>Tgl. Order</th>
                                            <th>Total Harga</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            foreach ($list_po as $value) {
                                        ?>
                                        <tr>
                                            <td><input type="checkbox" name="id_po[]" value="<?php echo $value->id_po; ?>" class="form-control"></td>
                                            <td><?php echo $value->nama_mitra; ?></td>
                                            <td><?php echo $value->no_po; ?></td>
                                            <td><?php echo $value->status_po; ?></td>
                                            <td><?php echo date('d/m/Y',strtotime($value->tanggal_po)); ?></td>
                                            <td>Rp. <?php echo number_format($value->total_harga,0,',','.'); ?></td>
                                            <td width="85">
                                                <a href="<?php echo base_url().'Approval/tolak/'.$value->id_po ?>" class="btn btn-sm btn-success"><i class="fas fa-eye"></i> Detail</a>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                         ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php 
                                if (!empty($list_po)) {
                            ?>
                                <button type="submit" class="btn btn-sm btn-primary mt-3"><i class="fa fa-check"></i> Approve PO Terpilih</button>
                                <a onclick="kirim_tolak()" class="btn btn-sm btn-danger mt-3"><i class="fa fa-times"></i> Tolak PO Terpilih</a>
                            <?php
                                }
                             ?>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php $this->load->view('partials/footer', FALSE); ?>

            <!-- Update Confirmation-->
            <div class="modal fade" id="accModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form action="<?php echo base_url().'approval/acc_all'; ?>" method="POST">
                     <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        PO yang sudah disetujui tidak akan bisa diubah
                        <input type="hidden" name="kategori" id="kategori_acc_all">
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-check"></i> Approve</a>
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

    <!-- load js -->
    <?php $this->load->view('partials/js', FALSE);?>

<script>
    function show_acc(kategori){
        $('.modal-body #kategori_acc_all').val(kategori);
        $('#accModal').modal();
    }

    function kirim_tolak(){
        var values = new Array();
          $("input[name='id_po[]']:checked").each(function() {
            values.push(this.value);
          });
          if (values.length == 0) {
            alert('Anda belum memilih PO !');
          }else{
            $.ajax({
              url: "<?php echo base_url('approval/get_json_tolak') ?>",
              type: 'POST',
              dataType: 'JSON',
              data: {id_po: values},
              success : function(res){
                  console.log(res)
              }
            }).then(function () {
                  location.reload();
            })
          }
    }

    $(document).ready(function() {
        $('#tableApprove').DataTable( {
            stateSave: true
        } );
    } );
</script>

</body>
</html>