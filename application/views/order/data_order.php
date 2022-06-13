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
            }else if ($this->session->userdata('level') == 'purchasing') {
                $this->load->view('partials/sidebar', FALSE);
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
                    <h1 class="h4 mb-2 text-gray-800">Daftar PO : <?php echo $tipe = ($this->uri->segment(3) == 'Baku') ? 'Bahan Baku' : $this->uri->segment(3) ; ?></h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <?php
                                if ($this->session->userdata('level') == 'direktur' || $this->session->userdata('level') == 'spv_purchasing') {
                                    echo "";
                                }else if($this->session->userdata('level') == 'purchasing'){
                            ?>
                                <a href="<?php echo base_url().'order/buat/'.$this->uri->segment(3) ?>" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Buat PO <?php echo $tipe = ($this->uri->segment(3) == 'Baku') ? 'Bahan Baku' : $this->uri->segment(3) ; ?></a>
                            <?php
                                }
                            ?>
                            <?php 
                                if (!empty($list_po)) {
                            ?>
                            <a href="<?php echo base_url().'export/index/'.$this->uri->segment(3) ?>" class="btn btn-sm btn-success"><i class="fas fa-file-export"></i> Export Excel</a>
                            <?php
                                }else{
                                    echo '';
                                }
                             ?>
                            <a href="#!" onclick="show_info()" class="btn btn-sm btn-secondary"><i class="fas fa-question-circle"></i> Info</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tableOrder" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Supplier</th>
                                            <th>No. PO</th>
                                            <th>Status Approve</th>
                                            <th>Tgl. Approve</th>
                                            <th>Tgl. Order</th>
                                            <th>Lead Time</th>
                                            <th>Tanggal Kirim</th>
                                            <th>Total Harga</th>
                                            <th>PIC</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            foreach ($list_po as $value) {
                                        ?>
                                        <tr>
                                            <td><?php echo $value->nama_mitra; ?></td>
                                            <td><?php echo $value->no_po; ?></td>
                                            <td>
                                                <?php 
                                                    if (($value->status_po == 'Belum') && ($value->acc_spv == 'Belum')) {
                                                        echo "<span class='badge badge-danger'>status</span>";
                                                    }elseif (($value->status_po == 'Sudah') && ($value->acc_spv == 'Belum')) {
                                                        echo "<span class='badge badge-warning'>status</span>";
                                                    }elseif (($value->status_po == 'Sudah') && ($value->acc_spv == 'Sudah')) {
                                                        echo "<span class='badge badge-success'>status</span>";
                                                    }
                                                ?>
                                            </td>
                                            <td><?php 
                                                if ($value->tanggal_approve == '0000-00-00' || $value->status_po == 'Belum') {
                                                    echo '';
                                                }else{
                                                    echo date('d/m/Y',strtotime($value->tanggal_approve)); 
                                                }
                                            ?></td>
                                            <td><?php echo date('d/m/Y',strtotime($value->tanggal_po)); ?></td>
                                            <td><?php echo date('d/m/Y',strtotime($value->lead_time)); ?></td>
                                            <td><?php echo date('d/m/Y',strtotime($value->tanggal_pengiriman)); ?></td>
                                            <td>Rp. <?php echo number_format($value->total_harga,0,',','.'); ?></td>
                                            <td><?php echo $value->nama_user; ?></td>
                                            <td width="100">
                                                <div class="dropdown show">
                                                  <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Tindakan
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <?php 
                                                        if (($value->status_po == 'Belum') || ($value->status_po == 'Ditolak')) {
                                                    ?>
                                                    <?php
                                                        if ($this->session->userdata('level') == 'direktur') {
                                                            echo "";
                                                    ?>
                                                    <?php
                                                        }else if($this->session->userdata('level') == 'purchasing'){
                                                    ?>
                                                        <a href="<?php echo base_url().'order/edit/'.$value->id_po ?>" class="dropdown-item"><i class="fa fa-pencil"></i> Edit PO</a>
                                                    <?php
                                                        }
                                                    ?>
                                                    <?php
                                                        }else{
                                                    ?>  
                                                            <a href="<?php echo base_url().'order/cetak/'.$value->id_po?>" target="_blank" class="dropdown-item"><i class="fa fa-print"></i> Cetak PDF</a>
                                                    <?php
                                                        }
                                                     ?>
                                                     <a href="<?php echo base_url().'order/detail/'.$value->id_po ?>" class="dropdown-item"><i class="fa fa-eye"></i> Detail PO</a>
                                                    <?php
                                                        if ($this->session->userdata('level') == 'direktur' || $this->session->userdata('level') == 'spv_purchasing') {
                                                            echo "";
                                                        }else if($this->session->userdata('level') == 'purchasing'){
                                                    ?>
                                                        <a onclick="deleteConfirm('<?php echo base_url().'order/hapus/'.$value->id_po ?>')"
                                                        href="#!" class="dropdown-item"><i class="fa fa-trash"></i> Batal</a>
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

             <!--Danger theme Modal -->
             <div class="modal fade" id="infoModal" tabindex="-1"
                role="dialog" aria-labelledby="myModalLabel120"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                    role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary font-weight-bold" id="exampleModalLabel">Info <i class="fas fa-question-circle"></i></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <ul class="text-dark">
                                <li>Text dengan warna <span class="text-danger font-weight-bold">merah</span>, menandakan dokumen PO belum di approve.</li>
                                <li>Text dengan warna <span class="text-warning font-weight-bold">kuning</span>, menandakan dokumen PO belum di approve direktur.</li>
                                <li>Text dengan warna <span class="text-success font-weight-bold">hijau</span>, menandakan dokumen PO sudah di approve.</li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
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

    <!-- load js -->
    <?php $this->load->view('partials/js', FALSE);?>

<script>
    function deleteConfirm(url){
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }

    function show_info(){
        $('#infoModal').modal({backdrop: 'static', keyboard: false});
    }

    $(document).ready(function() {
        $('#tableOrder').DataTable( {
            stateSave: true
        } );
    } );
</script>

</body>
</html>