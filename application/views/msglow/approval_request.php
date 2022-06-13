<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - NPD</title>

    <?php $this->load->view('partials/head', FALSE);?>

    <style type="text/css">
        .bg-kosme{
            background-color: #f48081;
            color: white;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
            if ($this->session->userdata('level') == 'direktur') {
                $this->load->view('partials/sidebar_direktur', FALSE);
            }else if($this->session->userdata('level') == 'kci'){
                $this->load->view('partials/sidebar_msglow', FALSE);
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
                    <h1 class="h4 mb-2 text-gray-800">Data Product Request</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                            <?php 
                                if (!empty($request)) {
                            ?>
                            <div class="card-header py-3">
                                <a href="#!" class="btn btn-sm btn-warning float-right" onclick="show_acc()"><i class="fa fa-check"></i> Approve Semua Request</a>
                            </div>
                            <?php
                                }
                             ?>
                        <div class="card-body">
                            <form action="<?php echo base_url().'acc/acc_selected'?>" method="post" accept-charset="utf-8" id="form-acc-selected">
                               <div class="table-responsive">
                                <table class="table table-bordered" id="tableApprove" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Pilih</th>
                                            <th>Tanggal</th>
                                            <th>Background</th>
                                            <th>Requester</th>
                                            <th>Nama Produk</th>
                                            <th>Target Harga</th>
                                            <th>Target Launching</th>
                                            <!-- <th>Acc <?= $x = ($this->session->userdata('level') == 'direktur') ? 'KCI' : 'KGI' ?></th> -->
                                            <th>Kategori</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            foreach ($request as $key) {
                                              if ($key->acc_kgi == 'Belum') {
                                                $color_kgi = "badge badge-secondary";
                                              }elseif ($key->acc_kgi == 'Ditolak') {
                                                  $color_kgi = "badge badge-danger";
                                              }elseif ($key->acc_kgi == 'Sudah') {
                                                  $color_kgi = "badge badge-success";
                                              }

                                              if ($key->acc_kci == 'Belum') {
                                                  $color_kci = "badge badge-secondary";
                                              }elseif ($key->acc_kci == 'Ditolak') {
                                                  $color_kci = "badge badge-danger";
                                              }elseif ($key->acc_kci == 'Sudah') {
                                                  $color_kci = "badge badge-success";
                                              }
                                        ?>
                                        <tr>
                                            <td><input type="checkbox" name="id_request[]" value="<?php echo $key->id_msglow_request; ?>" class="form-control"></td>
                                            <td><?php echo date('d/m/Y H:i:s',strtotime($key->tanggal_request)); ?></td>
                                            <td><?php echo $key->background; ?></td>
                                            <td><?php echo $key->requester_sponsor; ?></td>
                                            <td><?php echo $key->usulan_nama_produk; ?></td>
                                            <td>Rp. <?php echo number_format($key->target_harga,0,'.','.') ?></td>
                                            <td><?php echo date('d/m/Y',strtotime($key->target_launching)); ?></td>
                                            <td> <span class="badge <?= ($key->kategori_request == 'MS Glow') ? 'badge-warning text-dark' : 'bg-kosme'  ?>"><?php echo $key->kategori_request; ?></span></td>
                                            <td width="85">
                                                <a href="javascript:void(0)" onclick="show_detail('<?= $key->id_msglow_request ?>')" class="btn btn-sm btn-success"><i class="fas fa-eye"></i> Detail</a>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                         ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php 
                                if (!empty($request)) {
                            ?>
                                <a onclick="kirim_approve()" class="btn btn-sm btn-primary mt-3"><i class="fa fa-check"></i> Approve Pilihan</a>
                                <a onclick="kirim_tolak()" class="btn btn-sm btn-danger mt-3"><i class="fa fa-times"></i> Tolak Pilihan</a>
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
                <form action="<?php echo base_url().'acc/acc_all'; ?>" method="POST">
                     <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Request yang sudah disetujui tidak akan bisa diubah
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

            <!-- Detail Modal -->
             <div id="detailModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title text-primary" id="wizard-title"><b>Detail Permintaan</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
               
                    <ul class="nav nav-tabs" id="detailTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="tab-detail-1" data-toggle="tab" href="#generalPanel" role="tab">General</a>
                      <li>
                      <li class="nav-item">
                        <a class="nav-link" id="tab-detail-2" data-toggle="tab" href="#spesifikasiPanel" role="tab">Spesifikasi Produk</a>
                      <li>
                    </ul>
                    <div class="tab-content mt-2">
                      <div class="tab-pane fade show active" id="generalPanel" role="tabpanel">
                        <div class="form-group">
                          <label for="background" class="text-primary"><b>Background</b></label><br>
                          <label for="background" class="text-secondary" id="text-background-detail">-</label>
                        </div>
                        <div class="form-group">
                          <label for="requester" class="text-primary"><b>Requester Sponsor</b></label><br>
                          <label for="background" class="text-secondary" id="text-sponsor-detail">-</label>
                        </div>
                        <div class="form-group">
                          <label for="nama_produk" class="text-primary"><b>Nama Produk</b></label><br>
                          <label for="background" class="text-secondary" id="text-produk-detail">-</label>
                        </div>
                        <div class="form-group">
                            <label for="target_launching" class="text-primary"><b>Target Launching</b></label><br>
                            <label for="background" class="text-secondary" id="text-launching-detail">-</label>
                        </div>
                        <a class="btn btn-sm btn-success" id="generalContinue">Continue <i class="fas fa-arrow-right"></i></a>
                      </div>
                      <div class="tab-pane" id="spesifikasiPanel" role="tabpanel">
                        <div class="form-group">
                            <label for="jenis_bentuk" class="text-primary"><b>Jenis & Bentuk Sediaan</b></label><br>
                            <label for="background" class="text-secondary" id="text-sediaan-detail">-</label>
                        </div>
                        <div class="form-group">
                            <label for="bahan_aktif" class="text-primary"><b>Bahan Aktif</b></label><br>
                            <label for="background" class="text-secondary" id="text-bahan-detail">-</label>
                        </div>
                        <div class="form-group">
                            <label for="tekstur" class="text-primary"><b>Tekstur</b></label><br>
                            <label for="background" class="text-secondary" id="text-tekstur-detail">-</label>
                        </div>
                        <div class="form-group">
                            <label for="warna" class="text-primary"><b>Warna</b></label><br>
                            <label for="background" class="text-secondary" id="text-warna-detail">-</label>
                        </div>
                        <div class="form-group">
                            <label for="aroma" class="text-primary"><b>Aroma</b></label><br>
                            <label for="background" class="text-secondary" id="text-aroma-detail">-</label>
                        </div>
                        <div class="form-group">
                            <label for="volume" class="text-primary"><b>Volume</b></label><br>
                            <label for="background" class="text-secondary" id="text-volume-detail">-</label>
                        </div>
                        <div class="form-group">
                            <label for="bentuk_kemasan" class="text-primary"><b>Bentuk Kemasan</b></label><br>
                            <label for="background" class="text-secondary" id="text-kemasan-detail">-</label>
                        </div>
                        <div class="form-group">
                            <label for="claim_needs" class="text-primary"><b>Claim Needs</b></label><br>
                            <label for="background" class="text-secondary" id="text-claim-detail">-</label>
                        </div>
                        <div class="form-group">
                            <label for="target_harga" class="text-primary"><b>Target Harga</b></label><br>
                            <label for="background" class="text-secondary" id="text-harga-detail">-</label>
                        </div>
                      </div>
                    </div>
                    <div class="progress mt-5">
                      <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">Step 1 of 2</div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <a class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-close"></i> Close</a>
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

    <!-- load js -->
    <?php $this->load->view('partials/js', FALSE);?>

<script>
    function show_acc(){
        $('#accModal').modal();
    }

    function kirim_tolak(){
        var values = new Array();
          $("input[name='id_request[]']:checked").each(function() {
            values.push(this.value);
          });
          if (values.length == 0) {
            alert('Anda belum memilih data !');
          }else{
            $.ajax({
              url: "<?php echo base_url('acc/get_json_tolak') ?>",
              type: 'POST',
              dataType: 'JSON',
              data: {id: values},
              success : function(res){
                  if(res.status == '1'){
                    window.location.reload();
                  }
              }
            })
          }
    }

    function kirim_approve(){
        var values = new Array();
          $("input[name='id_request[]']:checked").each(function() {
            values.push(this.value);
          });
          if (values.length == 0) {
            alert('Anda belum memilih data !'); 
          }else{
            $('#form-acc-selected').submit();
          }
    }

    function show_detail(id){
        $.ajax({
            type: "POST",
            url: "<?= base_url().'glow/json_request' ?>",
            data: {id: id},
            dataType: "json",
            success: function (response) {
                $('.modal-body #text-background-detail').html(response.background); 
                $('.modal-body #text-sponsor-detail').html(response.requester_sponsor); 
                $('.modal-body #text-produk-detail').html(response.usulan_nama_produk); 
                $('.modal-body #text-sediaan-detail').html(response.spesifikasi_sediaan); 
                $('.modal-body #text-bahan-detail').html(response.spesifikasi_bahan); 
                $('.modal-body #text-tekstur-detail').html(response.spesifikasi_tekstur); 
                $('.modal-body #text-warna-detail').html(response.spesifikasi_warna); 
                $('.modal-body #text-aroma-detail').html(response.spesifikasi_aroma); 
                $('.modal-body #text-volume-detail').html(response.spesifikasi_volume+" ml"); 
                $('.modal-body #text-kemasan-detail').html(response.spesifikasi_kemasan); 
                $('.modal-body #text-claim-detail').html(response.spesifikasi_claim_needs); 
                $('.modal-body #text-harga-detail').html("Rp. "+kurensi_teks(response.target_harga)); 
                $('.modal-body #text-launching-detail').html(response.target_launching); 
            }
        });
        $('#detailModal').modal({backdrop: 'static', keyboard: false});
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

    $(document).ready(function() {
        $('#tableApprove').DataTable( {
            stateSave: true
        });

        $('#generalContinue').click(function (e) {
            e.preventDefault();
            $('.progress-bar').css('width', '100%');
            $('.progress-bar').html('Step 2 of 2');
            $('#detailTab a[href="#generalPanel"]').tab('show');
        });

        $('#tab-detail-1').click(function(event) {
            $('.progress-bar').css('width', '50%');
            $('.progress-bar').html('Step 1 of 2');
        });

        $('#tab-detail-2').click(function(event) {
            $('.progress-bar').css('width', '100%');
            $('.progress-bar').html('Step 2 of 2');
        });
    } );
</script>

</body>
</html>