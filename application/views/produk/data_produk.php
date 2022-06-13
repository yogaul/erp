<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Bahan</title>

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
            }elseif ($this->session->userdata('level') == 'ppic') {
                $this->load->view('partials/sidebar_ppic', FALSE);
            }else if($this->session->userdata('level') == 'purchasing'){
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
                    <h1 class="h4 mb-2 text-gray-800">Daftar Kategori : <?php echo $tipe = ($this->uri->segment(3) == 'Baku') ? 'Bahan Baku' : $this->uri->segment(3) ; ?></h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <?php 
                                    if ($this->session->userdata('level') == 'purchasing' || $this->session->userdata('level') == 'spv_purchasing') {
                            ?>
                                    <a href="<?php echo base_url().'produk/tambah_produk/'.$this->uri->segment(3); ?>" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah Bahan <?php echo $this->uri->segment(3); ?></a>
                                    <a href="<?php echo base_url().'export/eks_bahan/'.$this->uri->segment(3); ?>" class="btn btn-sm btn-success"><i class="fas fa-file-export"></i> Export Excel</a>
                            <?php
                                    }else{
                            ?>
                                    <a href="javascript:void(0)" onclick="show_export()" class="btn btn-sm btn-success"><i class="fas fa-file-export"></i> Export Excel</a>
                            <?php
                                    }
                            ?>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tableProduk" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <?php 
                                                if ($this->session->userdata('level') == 'gudang') {
                                                    if ($this->uri->segment(3) == 'Limit') {
                                            ?>
                                            <th>Kategori</th>
                                            <?php
                                                    }else{
                                                        echo '';
                                                    }
                                                }else{
                                            ?>
                                            <?php
                                                if ($this->session->userdata('level') == 'purchasing' || $this->session->userdata('level') == 'spv_purchasing' || $this->session->userdata('level') == 'direktur') {
                                            ?>
                                            <th>Harga</th>
                                            <th>MOQ</th>
                                            <?php
                                                  }  
                                            ?>
                                            <?php
                                                }
                                             ?>
                                            <th>Kode Supplier</th>
                                            <th>Nama Supplier</th>
                                            <?php   
                                                if ($this->session->userdata('level') == 'qc' || $this->session->userdata('level') == 'direktur') {
                                            ?>
                                            <th>Label Halal</th>
                                            <?php
                                                }else{
                                            ?>
                                            <th>Deskripsi</th>
                                            <th>Foto</th>
                                            <?php
                                                }
                                            ?>
                                            <?php 
                                                if ($this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier' 
                                                    || $this->session->userdata('level') == 'ppic' || $this->session->userdata('level') == 'direktur') {
                                            ?>
                                            <th>Stok</th>
                                            <th>Limit Stok</th>
                                            <?php
                                                }
                                            ?>
                                            <?php
                                                if (($this->session->userdata('level') != 'purchasing') && ($this->session->userdata('level') != 'gudang') 
                                                    && ($this->session->userdata('level') != 'qc') && ($this->session->userdata('level') != 'ppic') && ($this->session->userdata('level') != 'direktur')) {
                                                   echo "";
                                                }else{
                                            ?>
                                            <th>Tindakan</th>
                                            <?php
                                                }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($data_produk as $key) {
                                    ?>
                                        <tr>
                                            <td><?php echo $key->kode_produk; ?></td>
                                            <td><?php echo $key->nama_produk; ?></td>
                                            <?php 
                                                if ($this->session->userdata('level') == 'gudang') {
                                                    if ($this->uri->segment(3) == 'Limit') {
                                            ?>
                                            <td><?php echo "Bahan ".$key->kategori_produk; ?></td>
                                            <?php
                                                    }else{
                                                        echo '';
                                                    }
                                                }else{
                                            ?>
                                            <?php 
                                                if ($this->session->userdata('level') == 'purchasing' || $this->session->userdata('level') == 'spv_purchasing' || $this->session->userdata('level') == 'direktur') {
                                            ?>
                                            <td><?php echo $uang = ($key->jenis_harga == 'Rupiah') ? 'Rp.' : (($key->jenis_harga == 'Dollar') ? '$' : 'RMB '); echo number_format($key->harga_bahan,2,',','.'); ?></td>
                                            <td><?php echo number_format($key->moq_bahan,0,'.','.'); ?></td>
                                            <?php
                                                }
                                            ?>
                                            <?php
                                                }
                                            ?>
                                            <td><?php echo $key->no_mitra; ?></td>
                                            <td><?php echo $key->nama_mitra; ?></td>
                                             <?php   
                                                if ($this->session->userdata('level') == 'qc' || $this->session->userdata('level') == 'direktur') {
                                            ?>
                                            <td><?php echo $key->label_halal; ?></td>
                                            <?php
                                                }else{
                                            ?>
                                            <td><?php echo $key->deskripsi_produk; ?></td>
                                            <td><center><img src="<?php echo $key->foto_produk ?>" alt="foto" width="20%" onclick="coming()"></center></td>
                                            <?php
                                                }
                                            ?>
                                            <?php 
                                                if ($this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier' 
                                                    || $this->session->userdata('level') == 'ppic' || $this->session->userdata('level') == 'direktur') {
                                            ?>
                                            <td><?php echo number_format($key->stok,3,',','.'); ?></td>
                                            <td><?php echo number_format($key->limit_stok,3,',','.'); ?></td>
                                            <?php
                                                }
                                            ?>
                                            <?php
                                                if (($this->session->userdata('level') != 'purchasing') && ($this->session->userdata('level') != 'gudang') 
                                                    && ($this->session->userdata('level') != 'qc') && ($this->session->userdata('level') != 'ppic') && ($this->session->userdata('level') != 'direktur')) {
                                                   echo "";
                                                }else{
                                            ?>
                                            <td>
                                                <div class="dropdown show">
                                                  <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Tindakan
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <?php 
                                                        if ($this->session->userdata('level') == 'purchasing') {
                                                    ?>
                                                    <a href="<?php echo base_url().'produk/edit_produk/'.$key->id_produk ?>" class="dropdown-item"><i class="fa fa-pencil"></i> Ubah</a>
                                                    <a href="<?php echo base_url().'produk/pembelian/'.$key->id_produk ?>" class="dropdown-item"><i class="fa fa-history"></i> Riwayat Pembelian</a>
                                                    <a href="<?php echo base_url().'produk/log_mutasi/'.$key->id_produk ?>" class="dropdown-item"><i class="fas fa-dolly"></i> Log Mutasi</a>
                                                    <?php
                                                        }elseif ($this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'ppic' || $this->session->userdata('level') == 'direktur') {
                                                    ?>
                                                         <a href="<?php echo base_url().'produk/log_mutasi/'.$key->id_produk ?>" class="dropdown-item"><i class="fas fa-dolly"></i> Log Mutasi</a>
                                                    <?php
                                                        }elseif ($this->session->userdata('level') == 'qc') {
                                                    ?>
                                                         <a href="<?php echo base_url().'produk/set_halal/'.$key->id_produk; ?>" class="dropdown-item"><i class="fa fa-check"></i> Set Halal</a>
                                                    <?php
                                                        }
                                                     ?>
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
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php $this->load->view('partials/footer', FALSE); ?>
            <!-- End of Footer -->

             <!--Danger theme Modal -->
            <div class="modal fade text-left" id="inputTanggalExportModal" tabindex="-1"
                role="dialog" aria-labelledby="myModalLabel120"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                    role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary" id="myModalLabel120">
                                <b>Export Data Bahan <?= ucwords($this->uri->segment(3)) ?></b>
                            </h5>
                            <button type="button" class="close"
                                data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                         <div class="modal-body">
                            <form action="<?= base_url().'export/eks_bahan_gudang'; ?>" method="POST" id="form-pilih-export">
                            <div class="row">
                                <div class="col-6">
                                     <div class="form-group">
                                        <input type="hidden" name="kategori_ekspor" value="<?= $this->uri->segment(3) ?>" id="kategori_ekspor_modal">
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
                                        <option value="2022">2022</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-sm btn-primary" type="submit"><i class="fas fa-file-export"></i> Export</button>
                            <a class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Batal</a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

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
    $(document).ready(function() {
        $('#tableProduk').DataTable( {
            stateSave: true
        } );
    } );

    function deleteConfirm(url){
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }

    function show_modal(id){
        $.ajax({
            url: "<?php echo base_url().'produk/get_json_produk'; ?>",
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            success: function(data){
                $('.modal-body #id_produk_stok').val(id);
                $('.modal-body #kode_produk_stok').val(data.kode_produk);
                $('.modal-body #nama_produk_stok').val(data.nama_produk);
                $('.modal-body #stok_saat_ini').val(data.stok);
                $('#updateStokModal').modal({backdrop: 'static', keyboard: false});
            }
        })
    }

    function show_export(){
        $('#inputTanggalExportModal').modal({backdrop: 'static', keyboard: false});
    }

    function number_stok(){
        var stok_produk_text = $('.modal-body #stok_produk_terbaru_modal').val().replace(/[^0-9\.]/g,'').toString(); 
        $('.modal-body #stok_produk_terbaru_modal').val(stok_produk_text.replace(/[^0-9\.]/g,'').toString());
        $('.modal-body #stok_produk_terbaru').val(stok_produk_text);
    }

    function show_limit(id){
        $.ajax({
            url: "<?php echo base_url().'produk/get_json_produk'; ?>",
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            success: function(data){
                console.log(data);
                $('.modal-body #id_produk_limit').val(id);
                $('.modal-body #kode_produk_limit').val(data.kode_produk);
                $('.modal-body #nama_produk_limit').val(data.nama_produk);
                $('#updateLimitModal').modal({backdrop: 'static', keyboard: false});
            }
        })
    }
</script>

</body>
</html>