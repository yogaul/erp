<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Lead Time</title>

    <?php $this->load->view('partials/head', FALSE);?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php 
            if ($this->session->userdata('level') == 'purchasing') {
               $this->load->view('partials/sidebar', FALSE);
            }else{
               $this->load->view('partials/sidebar_gudang', FALSE);
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
                <h1 class="h4 mb-2 text-gray-800">Lead Time Kedatangan : <u><?php echo $nama_bahan; ?></u></h1>
            
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="#!" onclick="show_modal('1','tambah')" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah</a>
                            <a href="#!" onclick="show_info()" class="btn btn-sm btn-success"><i class="fas fa-question-circle"></i> Info</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tableListBahan" width="100%">
                                    <thead>
                                        <tr align="center">
                                            <th width="70">No.</th>
                                            <th width="70">ID</th>
                                            <th>Lead Time</th>
                                            <th>Jumlah Kedatangan</th>
                                            <?php 
                                                if ($this->session->userdata('level') == 'purchasing') {
                                            ?>
                                            <th>Tindakan</th>
                                            <?php
                                                }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 1;
                                            $class = NULL;
                                            foreach ($lead_time as $value) {
                                                $lead_date = date_create($value->tgl_lead_time);
                                                $now = date_create(date('Y-m-d'));
                                                $diff = date_diff($lead_date,$now);
                                                $range =  $diff->format("%a days");
                                                if ($range == 0) {
                                                    $class = "text-danger font-weight-bold";
                                                }elseif ($range <= 3) {
                                                    $class = "text-warning font-weight-bold";
                                                }elseif ($range >= 3 && $lead_date > $now ) {
                                                    $class = "text-success font-weight-bold";
                                                }elseif ($range >= 3 && $lead_date < $now ) {
                                                    $class = "text-dark font-weight-bold";
                                                }
                                        ?>
                                        <tr class="<?= $class ?>">
                                            <td align="center"><?php echo $no++; ?>.</td>
                                            <td align="center"><?php echo $value->id_lead_time_datang; ?></td>
                                            <td><?php echo date('d/m/Y',strtotime($value->tgl_lead_time)); ?></td>
                                            <td><?php echo number_format($value->jumlah_kedatangan,3,',','.').' '.$value->satuan_lead_time; ?></td>
                                            <?php 
                                                if ($this->session->userdata('level') == 'purchasing') {
                                            ?>
                                            <td width="20">
                                                <div class="dropdown show">
                                                  <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Tindakan
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                     <a onclick="show_modal('<?php echo $value->id_lead_time_datang; ?>', 'edit')" class="dropdown-item" data-toggle="modal" data-target="#editModal" data-backdrop="static" data-keyboard="false" disabled><i class="fas fa-edit"></i> Edit</a>
                                                     <a onclick="deleteConfirm('<?php echo base_url().'order/hapus_lead/'.$value->id_lead_time_datang; ?>')" href="#!" class="dropdown-item"><i class="fa fa-trash"></i> Hapus</a>
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

             <!-- Edit Modal -->
            <div class="modal fade" id="leadTimeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="<?php echo base_url().'order/simpan_lead'; ?>" method="post" accept-charset="utf-8">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary font-weight-bold" id="exampleModalLabel">Tambah Lead Time Kedatangan</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="tanggal_lead" class="text-primary"><b>Tanggal Lead Time</b></label>
                            <input type="hidden" id="id_lead_edit" name="id_lead_time">
                            <input type="hidden" id="id_detail_modal" name="id_detail_order" value="<?php echo $id; ?>">
                            <input type="hidden" id="aksi_lead_modal" name="aksi">
                            <input class="form-control" type="date" id="tgl_lead_time_modal" name="tanggal_lead" required>
                        </div>
                        <div class="form-group">
                             <label for="jumlah_kedatangan" class="text-primary"><b>Jumlah Kedatangan</b></label>
                             <input class="form-control" type="text" id="jumlah_datang_modal" name="jumlah_kedatangan_text" required="" placeholder="Jumlah kedatangan..." onkeyup="jumlah()">
                             <input type="hidden" name="jumlah_kedatangan" id="jumlah_kedatangan">
                        </div>
                        <div class="form-group">
                             <label for="satuan_kedatangan" class="text-primary"><b>Satuan</b></label>
                             <select name="satuan_kedatangan" id="satuan_kedatangan_modal" required class="form-control">
                                 <option value="Kg">Kg</option>
                                 <option value="Gram">Gram</option>
                                 <option value="Roll">Roll</option>
                                 <option value="Pcs">Pcs</option>
                             </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        <a class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Batal</a>
                    </div>
                </div>
                </form>
            </div>
            </div>

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
                                <li>Text dengan warna <span class="text-dark font-weight-bold">hitam</span>, menandakan tanggal lead time sudah lewat.</li>
                                <li>Text dengan warna <span class="text-warning font-weight-bold">kuning</span>, menandakan tanggal lead time sudah mendekati H-3.</li>
                                <li>Text dengan warna <span class="text-danger font-weight-bold">merah</span>, menandakan tanggal lead time pada hari ini.</li>
                                <li>Text dengan warna <span class="text-success font-weight-bold">hijau</span>, menandakan jarak tanggal lead time dari hari ini lebih dari 3 hari.</li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
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
    function deleteConfirm(url){
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    } 

    function jumlah(){
        var jml = $('.modal-body #jumlah_datang_modal').val().replace(/\./g,'').replace(/,/g, '.').toString();
        var jml_text = $('.modal-body #jumlah_datang_modal').val();     
        
        $('.modal-body #jumlah_datang_modal').val(kurensi_rupiah(jml_text));
        $('.modal-body #jumlah_kedatangan').val(jml);
    }
    
    function kurensi_rupiah(bilangan){
        var number_string = bilangan.replace(/[^,\d]/g, '').toString(),
        split   = number_string.split(','),
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

    function show_modal(id, aksi){
        if (aksi == 'tambah') {
            $('#leadTimeModal .modal-title').html('Tambah Lead Time Kedatangan');
            $('.modal-body #id_lead_edit').attr('disabled','true');
            $('.modal-body #aksi_lead_modal').val('tambah');
            $('.modal-body #tgl_lead_time_modal').val('');
            $('.modal-body #jumlah_datang_modal').val('');
            $('.modal-body #satuan_kedatangan_modal').val('Kg');
            $('#leadTimeModal').modal({backdrop: 'static', keyboard: false});
        }else if (aksi == 'edit') {
            $('#leadTimeModal .modal-title').html('Ubah Lead Time Kedatangan');
            $('.modal-body #id_lead_edit').removeAttr('disabled');
            $('.modal-body #aksi_lead_modal').val('edit');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url().'order/json_lead_time'; ?>",
                data: {id: id},
                dataType: "json",
                success: function (response) {
                    $('.modal-body #id_lead_edit').val(id);
                    $('.modal-body #tgl_lead_time_modal').val(response.tgl_lead_time);
                    $('.modal-body #jumlah_datang_modal').val(kurensi_teks(response.jumlah_kedatangan));
                    $('.modal-body #jumlah_kedatangan').val(response.jumlah_kedatangan);
                    $('.modal-body #satuan_kedatangan_modal').val(response.satuan_lead_time);
                    $('#leadTimeModal').modal({backdrop: 'static', keyboard: false});
                }
            });
        }
    }

    function show_info(){
        $('#infoModal').modal({backdrop: 'static', keyboard: false});
    }

    $(document).ready(function() {
        $('#tableListBahan').DataTable( {
            stateSave: true,
            order: [[ 1, "desc" ]],
            columnDefs : [{"targets":1, "type":"date-eu"}]
        });

        $('.modal-body #jumlah_datang_modal').keyup(function (e) { 
            var jumlah = $(this).val().replace(/\./g,'').replace(/,/g, '.').toString();
            var jumlah_text = $(this).val();
            $(this).val(kurensi_rupiah(jumlah_text));
            $('.modal-body #jumlah_kedatangan').val(jumlah);
        });
    });
</script>

</body>
</html>