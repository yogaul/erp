<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - History Validasi</title>

    <?php $this->load->view('partials/head', FALSE);?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php  
            if ($this->session->userdata('level') == 'spv_qc' || $this->session->userdata('level') == 'qc') {
                $this->load->view('partials/sidebar_qc', FALSE); 
            }elseif ($this->session->userdata('level') == 'gudang') {
                $this->load->view('partials/sidebar_gudang', FALSE); 
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
                    <h1 class="h4 mb-2 text-gray-800">History Validasi Bahan <?php echo $kategori; ?></h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="tab1" data-toggle="tab" href="#releasePanel" role="tab">Release</a>
                          <li>
                          <li class="nav-item">
                            <a class="nav-link" id="tab2" data-toggle="tab" href="#rejectPanel" role="tab">Reject</a>
                          <li>
                        </ul>
                        <div class="card-body">
                            <div class="tab-content mt-1">
                            <div class="tab-pane fade show active" id="releasePanel" role="tabpanel">
                                <a href="<?= base_url().'export/validasi_history/'.$kategori.'/'.'release' ?>" class="btn btn-sm btn-success mb-4"><i class="fas fa-file-export"></i> Export Excel</a>
                                <div class="table-responsive">
                                <table class="table table-bordered" id="tableRelease" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <!-- <th>ID</th> -->
                                            <th>Tgl. Datang</th>
                                            <th>Tgl. Validasi</th>
                                            <th>No. PO</th>
                                            <th>No. Batch</th>
                                            <th>Nomor Analisa</th>
                                            <th>Kode Bahan</th>
                                            <th>Nama Bahan</th>
                                            <th>Supplier</th>
                                            <th>Jumlah Datang</th>
                                            <th>Detail</th>
                                            <?php 
                                                if ($this->session->userdata('level') == 'spv_qc' || $this->session->userdata('level') == 'gudang') {
                                            ?>
                                            <th width="150">Tindakan</th>
                                            <?php
                                                }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($release as $value) {
                                    ?>
                                        <tr>
                                            <!-- <td><?php echo substr($value->id_bahan_datang,4); ?></td> -->
                                            <td><?php echo date('d/m/Y',strtotime($value->tanggal_kedatangan)); ?></td>
                                            <td><?php echo date('d/m/Y',strtotime($value->tanggal_acc_qc)); ?></td>
                                            <td><?php echo $value->no_po; ?></td>
                                            <td><?php echo $value->no_batch_kedatangan; ?></td>
                                            <td><?php echo $value->kode_kedatangan; ?></td>
                                            <td><?php echo $value->kode_produk; ?></td>
                                            <td><?php echo $value->nama_produk; ?></td>
                                            <td><?php echo $value->nama_mitra; ?></td>
                                            <td><?php echo number_format($value->jumlah_kedatangan,3,',','.')." ".$satuan_bahan; ?></td>
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
                                                if ($this->session->userdata('level') == 'spv_qc' || $this->session->userdata('level') == 'gudang') {
                                            ?>
                                            <td width="100">
                                                <a href="javascript:void(0)" onclick="print_label('<?= base_url().'order/cetak_validasi/'.$value->id_bahan_datang; ?>', '<?= $value->id_bahan_datang; ?>')"class="btn btn-sm btn-success"><i class="fas fa-file-pdf"></i> Cetak label</a>
                                                <!-- <a onclick="coming()" class="btn btn-sm btn-success"><i class="fas fa-file-pdf"></i> Cetak label</a> -->
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
                            <div class="tab-pane fade" id="rejectPanel" role="tabpanel">
                                <a href="<?= base_url().'export/validasi_history/'.$kategori.'/'.'reject' ?>" class="btn btn-sm btn-success mb-4"><i class="fas fa-file-export"></i> Export Excel</a>
                                <div class="table-responsive">
                                <table class="table table-bordered" id="tableReject" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <!-- <th>ID</th> -->
                                            <th>Tgl. Datang</th>
                                            <th>Tgl. Validasi</th>
                                            <th>No. PO</th>
                                            <th>No. Batch</th>
                                            <th>Nomor Analisa</th>
                                            <th>Kode Bahan</th>
                                            <th>Nama Bahan</th>
                                            <th>Supplier</th>
                                            <th>Jumlah Datang</th>
                                            <th>Keterangan</th>
                                            <th>Detail</th>
                                            <?php 
                                                if ($this->session->userdata('level') == 'spv_qc' || $this->session->userdata('level') == 'qc') {
                                            ?>
                                            <th width="150">Tindakan</th>
                                            <?php
                                                }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($reject as $value) {
                                    ?>
                                        <tr>
                                            <!-- <td><?php echo substr($value->id_bahan_datang,4); ?></td> -->
                                            <td><?php echo date('d/m/Y',strtotime($value->tanggal_kedatangan)); ?></td>
                                            <td><?php echo date('d/m/Y',strtotime($value->tanggal_acc_qc)); ?></td>
                                            <td><?php echo $value->no_po; ?></td>
                                            <td><?php echo $value->no_batch_kedatangan; ?></td>
                                            <td><?php echo $value->kode_kedatangan; ?></td>
                                            <td><?php echo $value->kode_produk; ?></td>
                                            <td><?php echo $value->nama_produk; ?></td>
                                            <td><?php echo $value->nama_mitra; ?></td>
                                            <td><?php echo number_format($value->jumlah_kedatangan,3,',','.')." ".$satuan_bahan; ?></td>
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
                                            <td><?php echo $value->catatan_acc_qc; ?></td>
                                            <?php 
                                                if ($this->session->userdata('level') == 'spv_qc' || $this->session->userdata('level') == 'qc') {
                                            ?>
                                            <td>
                                                <a href="javascript:void(0)" class="btn btn-sm btn-success" onclick="print_komplain('<?= base_url().'order/komplain/'.$value->id_bahan_datang; ?>', '<?= $value->id_bahan_datang; ?>')">
                                                    <i class="fas fa-file-pdf"></i> Cetak Form Komplain
                                                </a>
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
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php $this->load->view('partials/footer', FALSE); ?>
            <!-- End of Footer -->

            <!-- Tambah Modal -->
            <div class="modal fade" id="updateStokModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                    <form method="post" action="<?php echo base_url().'produk/simpan_stok' ?>" accept-charset="utf-8" id="form-stok_modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary" id="exampleModalLabel"><b>Update Stok</b></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="kode_produk" class="text-primary"><b>Kode Bahan <?php echo $this->uri->segment(3); ?></b></label>
                                <input type="hidden" id="id_produk_stok" name="id_produk" value="">
                                <input class="form-control" type="text" id="kode_produk_stok" name="kode_produk" readonly="">
                            </div>
                            <div class="form-group">
                                <label for="nama_produk" class="text-primary"><b>Nama Bahan <?php echo $this->uri->segment(3); ?></b></label>
                                <input class="form-control" id="nama_produk_stok" type="text" name="nama_produk" readonly="">
                            </div>
                            <div class="form-group">
                                <label for="stok_saat_ini" class="text-primary"><b>Stok Saat Ini</b></label>
                                <input type="text" class="form-control" id="stok_saat_ini" name="stok_saat_ini" placeholder="Stok bahan saat ini..." readonly="">
                            </div>
                            <div class="form-group">
                                <label for="stok_produk_terbaru" class="text-primary"><b>Stok Terbaru</b></label>
                                <input type="text" onkeyup="number_stok()" class="form-control" id="stok_produk_terbaru_modal" placeholder="Stok bahan terbaru..." required="">
                                <input type="hidden" id="stok_produk_terbaru" name="stok_produk_terbaru" value="">
                            </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Simpan</button>
                            <a class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Batal</a>
                        </div>
                            </div>
                    </form>
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

<script>
    function save_tab(){
        var hash = window.location.hash;
        $('#myTab a[href="' + hash + '"]').tab('show');
    }

    function print_komplain(url, id){
        $.ajax({
            type: "POST",
            url: "<?= base_url().'order/json_send_komplain' ?>",
            data: {id: id},
            dataType: "json",
            success: function (response) {
                if (response.status == '1') {
                    window.location.href = url;
                }else{
                    alert('Tidak ada data yang ditemukan, tidak dapat mencetak form komplain !');
                }
            }
        });
    }

    function print_label(url, id){
        $.ajax({
            type: "POST",
            url: "<?= base_url().'order/json_cetak_release' ?>",
            data: {id: id},
            dataType: "json",
            success: function (response) {
                if (response.status == '1') {
                    window.location.href = url;
                }else{
                    alert('Tidak ada data QR code yang ditemukan, tidak dapat mencetak label lulus !');
                }
            }
        });
    }

    $(document).ready(function() {
        $('#tableRelease').DataTable( {
            stateSave: true,
            order: [[ 1, "desc" ]],
            columnDefs : [{"targets":1}]
        });

        $('#tableReject').DataTable( {
            stateSave: true,
            order: [[ 1, "desc" ]],
            columnDefs : [{"targets":1}]
        });

        $('#myTab a').click(function(e) {
          e.preventDefault();
          $(this).tab('show');
        });

        $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
          var id = $(e.target).attr("href").substr(1);
          window.location.hash = id;
        });

        save_tab();
    });
</script>

</body>
</html>