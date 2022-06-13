<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Log Mutasi</title>

    <?php $this->load->view('partials/head', FALSE);?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
            if (($this->session->userdata('level') == 'gudang') || ($this->session->userdata('level') == 'admin_gudang_sier')) {
                $this->load->view('partials/sidebar_gudang', FALSE);
            }elseif ($this->session->userdata('level') == 'purchasing') {
                $this->load->view('partials/sidebar', FALSE);
            }elseif ($this->session->userdata('level') == 'spv_purchasing') {
                $this->load->view('partials/sidebar_direktur', FALSE);
            }elseif ($this->session->userdata('level') == 'ppic') {
                $this->load->view('partials/sidebar_ppic', FALSE);
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
                    <h1 class="h4 mb-2 text-gray-800">Log Mutasi : <b><?php echo $nama_produk; ?> (<?php echo $kode_produk; ?>)</b></h1>
                    <h1 class="h6 text-gray-800">Tanggal <?php echo $start.' - '.$end; ?></h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="<?php echo base_url().'produk/log_mutasi/'.$id_produk; ?>" class="btn btn-sm btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tableHistory" width="100%" cellspacing="0">
                                    <thead>
                                        <tr align="center">
                                            <th>ID</th>
                                            <th>Tanggal</th>
                                            <th>Shift</th>
                                            <!-- <th>Nama Barang</th> -->
                                            <th>Deskripsi</th>
                                            <th>In</th>
                                            <th>Out</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($data_log as $key) {
                                    ?>
                                        <tr>
                                            <td align="center"><?php echo number_format($key->id_log_bahan); ?></td>
                                            <td align="center"><?php echo $tanggal = (is_null($key->tanggal_log)) ? '-' : date('d/m/Y',strtotime($key->tanggal_log)); ?></td>
                                            <td align="center"><?php echo $key->shift_log; ?></td>
                                            <!-- <td><?php echo $key->nama_produk; ?></td> -->
                                            <td><?php echo $key->deskripsi_log; ?></td>
                                            <td><?php echo number_format($key->in_log,3,',','.'); ?></td>
                                            <td><?php echo number_format($key->out_log,3,',','.'); ?></td>
                                            <td><?php echo number_format($key->balance_log,3,',','.'); ?></td>
                                        </tr>
                                    <?php
                                    } 
                                    ?>
                                        
                                    </tbody>
                                </table>
                            </div><br>
                            <table class="table table-bordered">
                                <tr align="center">
                                    <th colspan="2">Total</th>
                                </tr>
                                <tr align="center">
                                    <th>In</th>
                                    <td><?= number_format($in_log,3,',','.') ?> KG</td>
                                </tr>
                                <tr align="center">
                                    <th>Out</th>
                                    <td><?= number_format($out_log,3,',','.') ?> KG</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php $this->load->view('partials/footer', FALSE); ?>

            <!--Danger theme Modal -->
            <div class="modal fade text-left" id="inputTanggalExportModal" tabindex="-1"
                role="dialog" aria-labelledby="myModalLabel120"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                    role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary" id="myModalLabel120">
                                <b>Export Kedatangan Bahan <?php echo $kategori; ?></b>
                            </h5>
                            <button type="button" class="close"
                                data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                         <div class="modal-body">
                            <form action="<?php echo base_url().'export/eks_history_gudang'; ?>" method="POST" id="form-pilih-export">
                            <div class="row">
                                <div class="col-6">
                                     <div class="form-group">
                                        <input type="hidden" name="kategori_ekspor" value="<?php echo $kategori; ?>" id="kategori_ekspor_modal">
                                        <label for="bulan_ekspor" class="text-primary"><b>Pilih Bulan</b></label>
                                        <select class="form-control" name="bulan_ekspor" id="pilih_bulan_modal">
                                            <option value="1">Januari</option>
                                            <option value="2">Februari</option>
                                            <option value="3">Maret</option>
                                            <option value="4">April</option>
                                            <option value="5">Mei</option>
                                            <option value="6">Juni</option>
                                            <option value="7">Juli</option>
                                            <option value="8">Agustus</option>
                                            <option value="9">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="tahun_ekspor" class="text-primary"><b>Pilih Tahun</b></label>
                                    <select class="form-control" name="tahun_ekspor" id="pilih_tahun_modal">
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                    </select>
                                </div>
                            </div>
                           </form>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-sm btn-primary" onclick="kirim_export()"><i class="fas fa-file-export"></i> Export</a>
                            <a class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Batal</a>
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

    function show_export(){
        $('#inputTanggalExportModal').modal({backdrop: 'static', keyboard: false});
    }

    // function kirim_export(){
    //     var kategori = $('.modal-body #kategori_ekspor_modal').val();
    //     var bulan = $('.modal-body #pilih_bulan_modal').val();
    //     var tahun = $('.modal-body #pilih_tahun_modal').val();

    //     $.ajax({
    //         url: "<?php echo base_url().'order/json_ekspor_riwayat'; ?>",
    //         type: 'POST',
    //         dataType: 'json',
    //         data: {kategori: kategori, bulan: bulan, tahun: tahun},
    //         success: function(data){
    //             if (data.length == 0) {
    //                 alert('Maaf data kedatangan bahan '+kategori+' untuk bulan '+bulan+' pada tahun '+tahun+' tidak ditemukan, silahkan pilih bulan dan tahun lain.');
    //             }else{
    //                 $('.modal-body #form-pilih-export').submit();
    //             }
    //         }
    //     })        
    // }

     $(document).ready(function() {
       
        $('#tableHistory').DataTable( {
            stateSave: true,    
            order: [[ 0, "desc" ]]
            // columnDefs : [{"targets":0, "type":"date-eu"}]
        });

        // $('.btn-search-log').click(function (e) { 
        //     // e.preventDefault();
        //     let start = $('#start_date').val();
        //     let end = $('#end_date').val();

        //     if (start == '') {
        //         alert('Anda harus memilih tanggal awal !');
        //     }else if(end == ''){
        //         alert('Anda harus memilih tanggal akhir !');
        //     }else{
        //         $('#form-search-log').submit();
        //     }
            
        // });

    });
</script>

</body>
</html>