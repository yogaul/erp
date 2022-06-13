<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Pembelian Bahan</title>

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
                    <h1 class="h4 mb-2 text-gray-800">Riwayat Pembelian Bahan :</h1>
                    <h1 class="h6 mb-2 text-gray-800"><b><?php echo $nama_produk.' ('.$kode_produk.')'; ?></b></h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="#!" onclick="coming()" class="btn btn-sm btn-success"><i class="fas fa-file-export"></i> Export Excel</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tableProduk" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tanggal Order</th>
                                            <th>Nomor PO</th>
                                            <th>Nama Supplier</th>
                                            <th>Mata Uang</th>
                                            <th>Harga</th>
                                            <th>Kurs</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($pembelian as $key) {
                                    ?>
                                        <tr>
                                            <td><?php echo date('d/m/Y', strtotime($key->tanggal_po)); ?></td>
                                            <td><?php echo $key->no_po; ?></td>
                                            <td><?php echo $key->nama_mitra; ?></td>
                                            <td><?php echo $key->mata_uang; ?></td>
                                            <td>
                                                <?php 
                                                    if($key->mata_uang == 'Rupiah'){
                                                      if (strpos($key->harga, ',') !== false) {
                                                         echo 'Rp.'.number_format($key->harga,2,',','.');
                                                      }else{
                                                          echo 'Rp.'.number_format($key->harga,0,',','.');
                                                      }
                                                    }elseif ($key->mata_uang == 'Dollar') {
                                                      if (strpos($key->harga, ',') !== false) {
                                                         echo '$'.number_format($key->harga,2,',','.');
                                                      }else{
                                                          echo '$'.number_format($key->harga,0,',','.');
                                                      }
                                                    }elseif ($key->mata_uang == 'RMB') {
                                                      if (strpos($key->harga, ',') !== false) {
                                                         echo 'RMB'.number_format($key->harga,2,',','.');
                                                      }else{
                                                          echo 'RMB'.number_format($key->harga,0,',','.');
                                                      }
                                                    }else{
                                                      echo '';
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $uang = ($key->mata_uang == 'Rupiah') ? '-' : 'Rp. '.number_format($key->kurs,0,',','.') ?></td>
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

    <?php $this->load->view('partials/js', FALSE);?>

<script>
    $(document).ready(function() {
        $('#tableProduk').DataTable( {
            stateSave: true,
            order: [[ 0, "desc" ]],
            columnDefs : [{"targets":0, "type":"date-eu"}]
        } );
    } );
</script>

</body>
</html>