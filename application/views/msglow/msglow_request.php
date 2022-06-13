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
            if ($this->session->userdata('level') == 'marketing') {
                $this->load->view('partials/sidebar_marketing', FALSE);
            }elseif ($this->session->userdata('level') == 'tim_marketing') {
                $this->load->view('partials/sidebar_tim_marketing', FALSE);
            }elseif ($this->session->userdata('level') == 'rnd') {
                $this->load->view('partials/sidebar_rnd', FALSE);
            }elseif ($this->session->userdata('level') == 'ms_glow' || $this->session->userdata('level') == 'kci') {
                $this->load->view('partials/sidebar_msglow', FALSE);
            }elseif ($this->session->userdata('level') == 'direktur') {
                $this->load->view('partials/sidebar_direktur', FALSE);
            }elseif ($this->session->userdata('level') == 'purchasing') {
                $this->load->view('partials/sidebar', FALSE);
            }elseif ($this->session->userdata('level') == 'produksi') {
                $this->load->view('partials/sidebar_produksi', FALSE);
            }elseif ($this->session->userdata('level') == 'qc' || $this->session->userdata('level') == 'spv_qc') {
                $this->load->view('partials/sidebar_qc', FALSE);
            }elseif ($this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier') {
                $this->load->view('partials/sidebar_gudang', FALSE);
            }elseif ($this->session->userdata('level') == 'ppic') {
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
                    <h1 class="h4 mb-2 text-gray-800">Data Product Request</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <?php
                            if ($this->session->userdata('level') == 'ms_glow' || $this->session->userdata('level') == 'marketing' && $this->uri->segment(2) == 'permintaan') {
                        ?>
                        <div class="card-header py-3">
                            <a href="#!" class="btn btn-sm btn-primary" onclick="show_modal('tambah','1')"><i class="fas fa-plus"></i> Tambah</a>
                            <!-- <a href="#!" onclick="coming()" class="btn btn-sm btn-success"><i class="fas fa-file-export"></i> Export Excel</a> -->
                        </div>
                        <?php
                            }
                        ?>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal</th>
                                            <th>Background</th>
                                            <th>Requester</th>
                                            <th>Nama Produk</th>
                                            <th>Target Harga</th>
                                            <th>Target Launching</th>
                                            <th>Acc KGI</th>
                                            <th>Acc KCI</th>
                                            <th>Status</th>
                                            <th>Deadline</th>
                                            <th>Kategori</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $no = 1;
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
                                            <td align="center"><?php echo $no++; ?>.</td>
                                            <td><?php echo date('d/m/Y H:i:s',strtotime($key->tanggal_request)); ?></td>
                                            <td><?php echo $key->background; ?></td>
                                            <td><?php echo $key->requester_sponsor; ?></td>
                                            <td><?php echo $key->usulan_nama_produk; ?></td>
                                            <td>Rp. <?php echo number_format($key->target_harga,0,'.','.') ?></td>
                                            <td><?php echo date('d/m/Y',strtotime($key->target_launching)); ?></td>
                                            <td><span class="<?= $color_kgi ?>"><?= $key->acc_kgi ?></span></td>
                                            <td>
                                                <?php
                                                    if ($key->kategori_request == 'MS Glow') {
                                                ?>
                                                <span class="<?= $color_kci ?>"><?= $key->acc_kci ?></span>
                                                <?php
                                                    }else{
                                                        echo "-";
                                                    }
                                                ?>
                                            </td>
                                            <td><a href="<?= base_url().'glow/log_request/'.$key->id_msglow_request ?>" class="badge badge-info"><?= $key->status_request_msglow ?></a></td>
                                            <td>
                                                <?php 
                                                    if ($key->deadline_request_rnd == '0000-00-00') {
                                                ?>
                                                <span class="badge badge-secondary">Belum diatur</span>
                                                <?php
                                                    }else{
                                                ?>
                                                <a href="<?= base_url().'glow/deadline/'.$key->id_msglow_request ?>" class="badge badge-primary"><?= date('d/m/Y', strtotime($key->deadline_request_rnd)) ?></a>
                                                <?php
                                                    }
                                                ?>
                                            </td>
                                            <td> <span class="badge <?= ($key->kategori_request == 'MS Glow') ? 'badge-warning text-dark' : 'bg-kosme'  ?>"><?php echo $key->kategori_request; ?></span></td>
                                            <td width="100">
                                                <div class="dropdown show">
                                                  <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-cog"></i>
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a onclick="show_detail('<?php echo $key->id_msglow_request; ?>')" class="dropdown-item"><i class="fa fa-eye"></i> Detail</a>
                                                    <?php
                                                        if ($this->session->userdata('level') == 'ms_glow' || $this->session->userdata('level') == 'marketing' || $this->session->userdata('level') == 'tim_marketing') {
                                                    ?>
                                                    <a onclick="show_modal('edit','<?php echo $key->id_msglow_request; ?>')" class="dropdown-item"><i class="fa fa-pencil"></i> Ubah</a>
                                                    <a onclick="deleteConfirm('<?php echo base_url().'glow/hapus_request/'.$key->id_msglow_request; ?>')"
                                                        href="#!" class="dropdown-item"><i class="fa fa-trash"></i> Hapus</a>
                                                    <?php
                                                        }
                                                    ?>
                                                    <?php
                                                        if ($key->acc_kgi == 'Sudah' && $key->acc_kci == 'Sudah' && $this->session->userdata('level') == 'ms_glow' || $this->session->userdata('level') == 'marketing' 
                                                        || $this->session->userdata('level') == 'tim_marketing' || $this->session->userdata('level') == 'direktur' || $this->session->userdata('level') == 'kci') {
                                                    ?>
                                                    <a href="<?= base_url().'glow/kemasan/'.$key->id_msglow_request ?>" class="dropdown-item"><i class="fa fa-cube"></i> Design Kemasan</a>
                                                    <a href="<?= base_url().'glow/formula/'.$key->id_msglow_request ?>" class="dropdown-item"><i class="fa fa-gift"></i> Product</a>
                                                    <a href="<?= base_url().'glow/bpom/'.$key->id_msglow_request ?>" class="dropdown-item"><i class="fa fa-tags"></i> BPOM</a>
                                                    <a href="<?= base_url().'glow/pr/'.$key->id_msglow_request ?>" class="dropdown-item"><i class="fa fa-paper-plane"></i> Purchase Request (PR)</a>
                                                    <a href="<?= base_url().'glow/po/'.$key->id_msglow_request ?>" class="dropdown-item"><i class="fa fa-file"></i> Purchase Order (PO)</a>
                                                    <a href="<?= base_url().'glow/mps/'.$key->id_msglow_request ?>" class="dropdown-item"><i class="fa fa-calendar"></i> Jadwal Produksi (MPS)</a>
                                                    <a href="<?= base_url().'glow/kedatangan/'.$key->id_msglow_request ?>" class="dropdown-item"><i class="fa fa-cubes"></i> Kedatangan</a>
                                                    <a href="<?= base_url().'glow/batch/'.$key->id_msglow_request ?>" class="dropdown-item"><i class="fa fa-file"></i> Pembuatan Batch</a>
                                                    <a href="<?= base_url().'glow/produksi/'.$key->id_msglow_request ?>" class="dropdown-item"><i class="fa fa-gift"></i> Hasil Produksi</a>
                                                    <a href="<?= base_url().'glow/pengiriman/'.$key->id_msglow_request ?>" class="dropdown-item"><i class="fa fa-truck"></i> Pengiriman</a>
                                                    <a href="<?= base_url().'glow/lain/'.$key->id_msglow_request ?>" class="dropdown-item"><i class="fa fa-question-circle"></i> Others</a>
                                                    <?php
                                                        }
                                                    ?>
                                                    <?php
                                                        if ($key->acc_kgi == 'Sudah' && $key->acc_kci == 'Sudah' && $this->session->userdata('level') == 'rnd') {
                                                    ?>
                                                    <a onclick="show_deadline('<?= $key->id_msglow_request; ?>')" class="dropdown-item"><i class="fa fa-tasks"></i> Atur Deadline</a>
                                                    <a href="<?= base_url().'glow/kemasan/'.$key->id_msglow_request ?>" class="dropdown-item"><i class="fa fa-cube"></i> Design Kemasan</a>
                                                    <a href="<?= base_url().'glow/formula/'.$key->id_msglow_request ?>" class="dropdown-item"><i class="fa fa-gift"></i> Product</a>
                                                    <a href="<?= base_url().'glow/bpom/'.$key->id_msglow_request ?>" class="dropdown-item"><i class="fa fa-tags"></i> BPOM</a>
                                                    <a href="<?= base_url().'glow/pr/'.$key->id_msglow_request ?>" class="dropdown-item"><i class="fa fa-paper-plane"></i> Purchase Request (PR)</a>
                                                    <a href="<?= base_url().'glow/po/'.$key->id_msglow_request ?>" class="dropdown-item"><i class="fa fa-file"></i> Purchase Order (PO)</a>
                                                    <a href="<?= base_url().'glow/mps/'.$key->id_msglow_request ?>" class="dropdown-item"><i class="fa fa-calendar"></i> Jadwal Produksi (MPS)</a>
                                                    <a href="<?= base_url().'glow/kedatangan/'.$key->id_msglow_request ?>" class="dropdown-item"><i class="fa fa-cubes"></i> Kedatangan</a>
                                                    <a href="<?= base_url().'glow/batch/'.$key->id_msglow_request ?>" class="dropdown-item"><i class="fa fa-file"></i> Pembuatan Batch</a>
                                                    <a href="<?= base_url().'glow/produksi/'.$key->id_msglow_request ?>" class="dropdown-item"><i class="fa fa-gift"></i> Hasil Produksi</a>
                                                    <a href="<?= base_url().'glow/pengiriman/'.$key->id_msglow_request ?>" class="dropdown-item"><i class="fa fa-truck"></i> Pengiriman</a>
                                                    <a href="<?= base_url().'glow/lain/'.$key->id_msglow_request ?>" class="dropdown-item"><i class="fa fa-question-circle"></i> Others</a>
                                                    <?php
                                                        }
                                                    ?>
                                                    <?php
                                                        if ($key->acc_kgi == 'Sudah' && $key->acc_kci == 'Sudah' && $this->session->userdata('level') == 'purchasing') {
                                                    ?>
                                                    <a href="<?= base_url().'glow/pr/'.$key->id_msglow_request ?>" class="dropdown-item"><i class="fa fa-paper-plane"></i> Purchase Request (PR)</a>
                                                    <a href="<?= base_url().'glow/po/'.$key->id_msglow_request ?>" class="dropdown-item"><i class="fa fa-file"></i> Purchase Order (PO)</a>
                                                    <?php
                                                        }
                                                    ?>
                                                    <?php
                                                        if ($key->acc_kgi == 'Sudah' && $key->acc_kci == 'Sudah' && $this->session->userdata('level') == 'ppic') {
                                                    ?>
                                                    <a href="<?= base_url().'glow/mps/'.$key->id_msglow_request ?>" class="dropdown-item"><i class="fa fa-calendar"></i> Jadwal Produksi (MPS)</a>
                                                    <?php
                                                        }
                                                    ?>
                                                    <?php
                                                        if ($key->acc_kgi == 'Sudah' && $key->acc_kci == 'Sudah' && $this->session->userdata('level') == 'produksi') {
                                                    ?>
                                                    <a href="<?= base_url().'glow/produksi/'.$key->id_msglow_request ?>" class="dropdown-item"><i class="fa fa-gift"></i> Hasil Produksi</a>
                                                    <?php
                                                        }
                                                    ?>
                                                    <?php
                                                        if ($key->acc_kgi == 'Sudah' && $key->acc_kci == 'Sudah' && $this->session->userdata('level') == 'qc') {
                                                    ?>
                                                    <a href="<?= base_url().'glow/kedatangan/'.$key->id_msglow_request ?>" class="dropdown-item"><i class="fa fa-cubes"></i> Kedatangan</a>
                                                    <a href="<?= base_url().'glow/batch/'.$key->id_msglow_request ?>" class="dropdown-item"><i class="fa fa-file"></i> Pembuatan Batch</a>
                                                    <a href="<?= base_url().'glow/produksi/'.$key->id_msglow_request ?>" class="dropdown-item"><i class="fa fa-gift"></i> Hasil Produksi</a>
                                                    <?php
                                                        }
                                                    ?>
                                                    <?php
                                                        if ($key->acc_kgi == 'Sudah' && $key->acc_kci == 'Sudah' && $this->session->userdata('level') == 'gudang' || $this->session->userdata('level') == 'admin_gudang_sier') {
                                                    ?>
                                                    <a href="<?= base_url().'glow/pengiriman/'.$key->id_msglow_request ?>" class="dropdown-item"><i class="fa fa-truck"></i> Pengiriman</a>
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

            <!-- Tambah Modal -->
            <div id="sampleModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <form action="<?php echo base_url().'glow/simpan_request' ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title text-primary" id="wizard-title">Tambah Permintaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
               
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="tab1" data-toggle="tab" href="#infoPanel" role="tab">General</a>
                      <li>
                      <li class="nav-item">
                        <a class="nav-link" id="tab2" data-toggle="tab" href="#deskripsiPanel" role="tab">Spesifikasi Produk</a>
                      <li>
                    </ul>
                    <div class="tab-content mt-2">
                      <div class="tab-pane fade show active" id="infoPanel" role="tabpanel">
                        <div class="form-group">
                          <label for="background" class="text-primary"><b>Background</b></label><br>
                          <input type="hidden" id="id_request_edit" name="id_request" value="">
                          <input type="hidden" id="aksi_request_modal" name="aksi" value="">
                          <input type="text" name="background" class="form-control form-control-sm" placeholder="Background..." required="" id="background-modal">
                        </div>
                        <div class="form-group">
                          <label for="requester" class="text-primary"><b>Requester Sponsor</b></label><br>
                          <input type="text" name="requester" class="form-control form-control-sm" placeholder="Requester sponsor..." required="" id="requester-modal">
                        </div>
                        <div class="form-group">
                          <label for="nama_produk" class="text-primary"><b>Nama Produk</b></label><br>
                          <input type="text" name="nama_produk" class="form-control form-control-sm" placeholder="Nama produk..." required="" id="produk-modal">
                        </div>
                        <div class="form-group">
                            <label for="target_launching" class="text-primary"><b>Target Launching</b> (bulan/hari/tahun)</label>
                            <input type="date" class="form-control form-control-sm" name="target_launching" required="" id="launching-modal">
                        </div>
                        <a class="btn btn-sm btn-success" id="infoContinue">Continue <i class="fas fa-arrow-right"></i></a>
                      </div>
                      <div class="tab-pane" id="deskripsiPanel" role="tabpanel">
                        <div class="form-group">
                            <label for="jenis_bentuk" class="text-primary"><b>Jenis & Bentuk Sediaan</b></label>
                            <input type="text" class="form-control form-control-sm" name="jenis_bentuk" placeholder="Jenis & bentuk..." required="" id="sediaan-modal">
                        </div>
                        <div class="form-group">
                            <label for="bahan_aktif" class="text-primary"><b>Bahan Aktif</b></label>
                            <input type="text" class="form-control form-control-sm" name="bahan_aktif" placeholder="Bahan aktif..." required="" id="bahan-aktif-modal">
                        </div>
                        <div class="form-group">
                            <label for="tekstur" class="text-primary"><b>Tekstur</b></label>
                            <input type="text" class="form-control form-control-sm" name="tekstur" placeholder="Tekstur..." required="" id="tekstur-modal">
                        </div>
                        <div class="form-group">
                            <label for="warna" class="text-primary"><b>Warna</b></label>
                            <input type="text" class="form-control form-control-sm" name="warna" placeholder="Warna..." required="" id="warna-modal">
                        </div>
                        <div class="form-group">
                            <label for="aroma" class="text-primary"><b>Aroma</b></label>
                            <input type="text" class="form-control form-control-sm" name="aroma" placeholder="Aroma..." required="" id="aroma-modal">
                        </div>
                        <div class="form-group">
                            <label for="volume" class="text-primary"><b>Volume</b> (ml)</label>
                            <input type="number" step=".01" class="form-control form-control-sm" name="volume" placeholder="Volume..." required="" id="volume-modal">
                        </div>
                        <div class="form-group">
                            <label for="bentuk_kemasan" class="text-primary"><b>Bentuk Kemasan</b></label>
                            <input type="text" class="form-control form-control-sm" name="bentuk_kemasan" placeholder="Bentuk kemasan..." required="" id="bentuk-kemasan-modal">
                        </div>
                         <div class="form-group">
                            <label for="dupe_produk" class="text-primary"><b>Contoh Foto Produk (Dupe)</b></label>
                            <input type="file" class="form-control-file form-control-sm" name="dupe_produk" id="dupe_produk_modal">
                            <input type="hidden" name="temp_dupe_produk" id="dupe_produk">
                        </div>
                        <div class="form-group">
                            <label for="claim_needs" class="text-primary"><b>Claim Needs</b></label>
                            <input type="text" class="form-control form-control-sm" name="claim_needs" placeholder="Claim needs..." required="" id="claim-modal">
                        </div>
                        <div class="form-group">
                            <label for="target_harga" class="text-primary"><b>Target Harga</b></label>
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                              </div>
                              <input type="text" class="form-control form-control-sm" id="target_harga_modal" placeholder="Target harga..." onkeyup="kurensi('harga_avg_produk_modal')" required="">
                              <input type="hidden" id="target_harga" name="target_harga" value="">
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="progress mt-5">
                      <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">Step 1 of 2</div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <a class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-close"></i> Batal</a>
                    <button type="submit" name="btn_simpan_acc" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Simpan</button>
                  </div>
                </div>
                </form>
                
              </div>
            </div>

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
                            <label for="dupe_produk" class="text-primary"><b>Contoh Foto Produk (Dupe)</b></label><br>
                            <label for="dupe_produk" class="text-secondary" id="text-dupe-detail">-</label>
                            <a target="_blank" class="btn btn-sm btn-primary" id="url-dupe-detail"><i class="fas fa-file"></i> File</a>
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
                    <a class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-close"></i> Tutup</a>
                  </div>
                </div>
              </div>
            </div>

            
            <!-- Input Deadline Modal -->
            <div id="inputDeadlineModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <form  method="POST" action="<?php echo base_url().'glow/set_deadline'; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary font-weight-bold">Atur Deadline</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_produk" class="text-primary"><b>Nama Produk Request</b></label>
                            <input type="hidden" name="id_request" id="id_request_deadline">
                            <input type="text" name="nama_produk_deadline" class="form-control" id="nama_request_deadline" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_deadline_request" class="text-primary"><b>Tanggal Deadline</b></label>
                            <input type="date" name="tanggal_deadline_request" class="form-control" required="" id="tanggal_request_deadline">
                        </div>
                        <div class="form-group">
                            <label for="keterangan_deadline_request" class="text-primary"><b>Keterangan</b></label>
                            <textarea name="keterangan_deadline_request" id="keterangan_request_deadline" rows="4" class="form-control" required placeholder="Keterangan..."></textarea>
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

    function kurensi(){
        var target_harga_text = $('.modal-body #target_harga_modal').val().replace(/[^0-9]/g, '').toString(); 
        $('.modal-body #target_harga_modal').val(target_harga_text.replace(/[^0-9]/g, '').toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
        $('.modal-body #target_harga').val(target_harga_text);
    }

    function show_deadline(id){
        $.ajax({
            type: "POST",
            url: "<?= base_url().'glow/json_request' ?>",
            data: {id: id},
            dataType: "json",
            success: function (response) {
                $('.modal-body #id_request_deadline').val(id);
                $('.modal-body #nama_request_deadline').val(response.usulan_nama_produk);
                $('.modal-body #tanggal_request_deadline').val(response.deadline_request_rnd);
                $('.modal-body #keterangan_request_deadline').val(response.ket_deadline_rnd);
            }
        });
        $('#inputDeadlineModal').modal({backdrop: 'static', keyboard: false});
    }

    function show_modal(aksi,id){
        $('.modal-header .modal-title').css('font-weight', 'bold');
        if (aksi == 'tambah') {
            $('#sampleModal .modal-title').text('Tambah Permintaan');
            $('.modal-body #id_request_edit').attr('disabled', 'true');
            $('.modal-body #dupe_produk').attr('disabled', 'true');
            // $('.modal-body #dupe_produk_modal').attr('required', 'required');
            $('.modal-body #aksi_request_modal').val('tambah'); 
            $('.modal-body #background-modal').val(''); 
            $('.modal-body #requester-modal').val(''); 
            $('.modal-body #produk-modal').val(''); 
            $('.modal-body #sediaan-modal').val(''); 
            $('.modal-body #bahan-aktif-modal').val(''); 
            $('.modal-body #tekstur-modal').val(''); 
            $('.modal-body #warna-modal').val(''); 
            $('.modal-body #aroma-modal').val(''); 
            $('.modal-body #volume-modal').val(''); 
            $('.modal-body #bentuk-kemasan-modal').val(''); 
            $('.modal-body #claim-modal').val(''); 
            $('.modal-body #target_harga_modal').val(''); 
            $('.modal-body #target_harga').val(''); 
            $('.modal-body #dupe_produk').val(''); 
            $('.modal-body #launching-modal').val(''); 
            $('#sampleModal').modal({backdrop: 'static', keyboard: false});

        }else if(aksi == 'edit'){
            $('#sampleModal .modal-title').text('Ubah Permintaan');
            $('.modal-body #id_request_edit').removeAttr('disabled');
            $('.modal-body #aksi_request_modal').val('edit'); 
            $('.modal-body #dupe_produk').removeAttr('disabled');
            // $('.modal-body #dupe_produk_modal').removeAttr('required');
            $.ajax({
                type: "POST",
                url: "<?= base_url().'glow/json_request' ?>",
                data: {id: id},
                dataType: "json",
                success: function (response) {
                    $('.modal-body #id_request_edit').val(id);
                    $('.modal-body #background-modal').val(response.background); 
                    $('.modal-body #requester-modal').val(response.requester_sponsor); 
                    $('.modal-body #produk-modal').val(response.usulan_nama_produk); 
                    $('.modal-body #sediaan-modal').val(response.spesifikasi_sediaan); 
                    $('.modal-body #bahan-aktif-modal').val(response.spesifikasi_bahan); 
                    $('.modal-body #tekstur-modal').val(response.spesifikasi_tekstur); 
                    $('.modal-body #warna-modal').val(response.spesifikasi_warna); 
                    $('.modal-body #aroma-modal').val(response.spesifikasi_aroma); 
                    $('.modal-body #volume-modal').val(response.spesifikasi_volume); 
                    $('.modal-body #bentuk-kemasan-modal').val(response.spesifikasi_kemasan); 
                    $('.modal-body #claim-modal').val(response.spesifikasi_claim_needs); 
                    $('.modal-body #target_harga_modal').val(kurensi_teks(response.target_harga)); 
                    $('.modal-body #target_harga').val(response.target_harga); 
                    $('.modal-body #dupe_produk').val(response.foto_produk_dupe); 
                    $('.modal-body #launching-modal').val(response.target_launching); 
                }
            });
            $('#sampleModal').modal({backdrop: 'static', keyboard: false});

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
                if (response.foto_produk_dupe == '') {
                    $('.modal-body #url-dupe-detail').attr('hidden','hidden');
                }else{
                    $('.modal-body #text-dupe-detail').attr('hidden','hidden');
                    $('.modal-body #url-dupe-detail').attr('href',response.foto_produk_dupe);
                    $('.modal-body #url-dupe-detail').removeAttr('hidden','hidden');
                }
                $('.modal-body #text-claim-detail').html(response.spesifikasi_claim_needs); 
                $('.modal-body #text-harga-detail').html("Rp. "+kurensi_teks(response.target_harga)); 
                $('.modal-body #text-launching-detail').html(response.target_launching); 
            }
        });
        $('#detailModal').modal({backdrop: 'static', keyboard: false});
    }

    function get_currency(text){
        var number_string = text.toString(),
            sisa    = number_string.length % 3,
            rupiah  = number_string.substr(0, sisa),
            ribuan  = number_string.substr(sisa).match(/\d{3}/g);
                
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        return rupiah;
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

        $('#infoContinue').click(function (e) {
            e.preventDefault();
            $('.progress-bar').css('width', '100%');
            $('.progress-bar').html('Step 2 of 2');
            $('#myTab a[href="#deskripsiPanel"]').tab('show');
        });

        $('#tab1').click(function(event) {
            $('.progress-bar').css('width', '50%');
            $('.progress-bar').html('Step 1 of 2');
        });

        $('#tab2').click(function(event) {
            $('.progress-bar').css('width', '100%');
            $('.progress-bar').html('Step 2 of 2');
        });

        // detail tab view

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

    });
</script>

</body>
</html>