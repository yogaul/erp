<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Validasi</title>

    <?php $this->load->view('partials/head', FALSE);?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
            if ($this->session->userdata('level') == 'direktur') {
                $this->load->view('partials/sidebar_direktur', FALSE);
            }elseif ($this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier') {
                $this->load->view('partials/sidebar_gudang', FALSE);
            }elseif ($this->session->userdata('level') == 'qc') {
                $this->load->view('partials/sidebar_qc', FALSE);
            }elseif ($this->session->userdata('level') == 'purchasing'){
                $this->load->view('partials/sidebar', FALSE);
            }elseif ($this->session->userdata('level') == 'ppic'){
                $this->load->view('partials/sidebar_ppic', FALSE);
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
                    <h1 class="h4 mb-2 text-gray-800">
                        Kedatangan Bahan <?php echo $kategori." : <u>".$status."</u>"; ?>
                    </h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="<?= base_url().'export/validasi_status/'.$status; ?>" class="btn btn-sm btn-success"><i class="fas fa-file-export"></i> Export Excel</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Tgl. Datang</th>
                                            <th>No. Batch</th>
                                            <th>Nomor Analisa</th>
                                            <th>Kode Bahan</th>
                                            <th>Nama Bahan</th>
                                            <th>Supplier</th>
                                            <th>Jumlah Datang</th>
                                            <th>Detail</th>
                                            <?php
                                                if ($this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier' || 
                                                    $this->session->userdata('level') == 'ppic' || ($this->session->userdata('level') == 'purchasing' && $status == 'Reject')) {
                                            ?> 
                                            <th>Tindakan</th>
                                            <?php
                                                }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            foreach ($list_validasi as $value) {
                                        ?>
                                        <tr>
                                            <td><?php echo date('d/m/Y',strtotime($value->tanggal_kedatangan)); ?></td>
                                            <td><?php echo $value->no_batch_kedatangan; ?></td>
                                            <td><?php echo $value->kode_kedatangan; ?></td>
                                            <td><?php echo $value->kode_produk; ?></td>
                                            <td><?php echo $value->nama_produk; ?></td>
                                            <td><?php echo $value->nama_mitra; ?></td>
                                            <td><?php echo number_format($value->jumlah_kedatangan,3,',','.')." ".$satuan; ?></td>
                                            <td>
                                                <?php 
                                                    $jumlah = "";
                                                    $detail_penerimaan = $this->OrderModel->get_detail_penerimaan($value->id_bahan_datang)->result();
                                                    foreach ($detail_penerimaan as $key) {
                                                        $satuan = (is_null($key->satuan_kedatangan)) ? 'Pieces' : $key->satuan_kedatangan;
                                                        $jumlah .= $key->qty_kedatangan.' '.$key->kemasan_kedatangan.'@'.$key->isi_kedatangan.''.$satuan.';';
                                                    }
                                                    $jumlah_trim = rtrim($jumlah,';');
                                                    echo $jumlah_trim;
                                                ?>
                                            </td>
                                            <?php
                                                if ($this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier' ||
                                                    $this->session->userdata('level') == 'ppic' || ($this->session->userdata('level') == 'purchasing' && $status == 'Reject')) {
                                            ?>
                                            <td>
                                                <?php
                                                    if ($this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier' || $this->session->userdata('level') == 'ppic') {
                                                ?>
                                                <a href="<?php echo base_url().'order/cetak_penerimaan/'.$value->id_bahan_datang; ?>" class="btn btn-sm btn-primary"><i class="fas fa-file-pdf"></i> Cetak Penerimaan</a>
                                                <?php
                                                    }elseif ($this->session->userdata('level') == 'purchasing' && $value->acc_qc == 'Reject') {
                                                ?>
                                                <a href="javascript:void(0)"  onclick="retur('<?= $value->id_bahan_datang ?>','<?php echo base_url().'order/retur/'.$value->id_bahan_datang; ?>')" class="btn btn-sm btn-primary"><i class="fas fa-file-pdf"></i> Cetak Form Retur</a>
                                                <?php
                                                    }
                                                ?>
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
    function deleteConfirm(url){
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }

    function retur(id,url){
       $.ajax({
           type: "POST",
           url: "<?= base_url().'order/json_cek_komplain' ?>",
           data: {id: id},
           dataType: "json",
           success: function (response) {
            //    console.log(response);
                if(response == 0){
                    alert('Belum ada form komplain yang diterbitkan oleh QC untuk kedatangan bahan ini, tidak dapat mencetak form retur ! harap hubungi QC.');
                }else{
                    window.location.href = url;
                }
           }
       });
    }
</script>

</body>
</html>