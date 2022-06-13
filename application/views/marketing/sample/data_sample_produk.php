<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Sample</title>

    <?php $this->load->view('partials/head', FALSE);?>

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
                    <h1 class="h4 mb-2 text-gray-800">Daftar Sample Acc</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <?php
                                if ($this->session->userdata('level') == 'marketing' || $this->session->userdata('level') == 'tim_marketing') {
                            ?>
                            <a href="#!" class="btn btn-sm btn-primary" onclick="show_modal('tambah','1')"><i class="fas fa-plus"></i> Tambah Sample Acc</a>
                            <?php
                                }
                            ?>
                            <a href="#!" onclick="coming()" class="btn btn-sm btn-success"><i class="fas fa-file-export"></i> Export Excel</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama Customer</th>
                                            <th>Nama Merk</th>
                                            <th>Nama Produk</th>
                                            <th>Volume</th>
                                            <th>Target Launching</th>
                                            <th>Marketing</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($sample as $key) {
                                    ?>
                                        <tr>
                                            <td><?php echo $key->nama_customer; ?></td>
                                            <td><?php echo $key->nama_brand_produk; ?></td>
                                            <td><?php echo $key->nama_produk_acc; ?></td>
                                            <td><?php echo $key->volume_produk_acc; ?></td>
                                            <td><?php echo date('d/m/Y',strtotime($key->target_launching_acc)); ?></td>
                                            <td><?php echo $key->nama_user; ?></td>
                                            <td width="100">
                                                <div class="dropdown show">
                                                  <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Tindakan
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a href="<?php echo base_url().'sample/cetak_acc/'.$key->id_sample_acc; ?>" target="blank" class="dropdown-item"><i class="fa fa-print"></i> Cetak PDF</a>
                                                    <?php
                                                        if ($this->session->userdata('level') == 'marketing' || $this->session->userdata('level') == 'tim_marketing') {
                                                    ?>
                                                    <a onclick="deleteConfirm('<?php echo base_url().'sample/hapus_acc/'.$key->id_sample_acc; ?>')"
                                                        href="#!" class="dropdown-item"><i class="fa fa-trash"></i> Hapus</a>
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
            <div id="sampleModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <form action="<?php echo base_url().'sample/simpan_acc' ?>" method="post" accept-charset="utf-8">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title text-primary" id="wizard-title">Form Sample Acc</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
               
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="tab1" data-toggle="tab" href="#infoPanel" role="tab">Customer</a>
                      <li>
                      <li class="nav-item">
                        <a class="nav-link" id="tab2" data-toggle="tab" href="#deskripsiPanel" role="tab">Deskripsi Permintaan Produk</a>
                      <li>
                      <li class="nav-item">
                        <a class="nav-link" id="tab3" data-toggle="tab" href="#ads" role="tab">Detail Deskripsi Produk</a>
                      <li>
                    </ul>
                    <div class="tab-content mt-2">
                      <div class="tab-pane fade show active" id="infoPanel" role="tabpanel">
                        <div class="form-group">
                          <label for="customer" class="text-primary"><b>Nama Customer</b></label><br>
                          <select name="customer" required="" class="form-control" id="select_customer">
                            <option value="-" disabled="" selected="">Pilih customer</option>
                            <?php foreach ($customer as $value) {
                            ?>
                            <option value="<?php echo $value->id_customer; ?>"><?php echo $value->nama_customer.' - '.$value->nama_perusahaan_customer; ?></option>
                            <?php
                            } ?>
                          </select>
                        </div>
                        <a class="btn btn-sm btn-success" id="infoContinue">Continue <i class="fas fa-arrow-right"></i></a>
                      </div>
                      <div class="tab-pane" id="deskripsiPanel" role="tabpanel">
                        <div class="form-group">
                          <label for="nama_produk" class="text-primary"><b>Nama Produk</b></label><br>
                          <input type="text" name="nama_produk" class="form-control form-control-sm" placeholder="Nama produk..." required="">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi_logo" class="text-primary"><b>Deskripsi Logo</b></label>
                            <input type="text" class="form-control form-control-sm" name="deskripsi_logo" placeholder="Deskripsi logo...">
                        </div>
                        <div class="form-group">
                            <label for="nama_merk" class="text-primary"><b>Nama Brand (Merk)</b></label>
                            <select name="nama_merk" class="form-control form-control-sm" id="pilih_merk">
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="merk_haki" class="text-primary"><b>Merk Terdaftar HAKI ?</b></label><br>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="merk_haki" value="Ya" id="merk_haki1">
                                    <label for="merk_haki1" class="form-check-label">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="merk_haki" value="Tidak" id="merk_haki2">
                                    <label for="merk_haki2" class="form-check-label">Tidak</label>
                                </div>
                            </div>
                            <div class="col-6" id="div_daftar_haki">
                                <label for="daftar_haki" class="text-primary"><b>Daftar Oleh KOSME ?</b></label><br>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="daftar_haki" value="Ya" id="daftar_haki1">
                                    <label for="daftar_haki1" class="form-check-label">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="daftar_haki" value="Tidak" id="daftar_haki2">
                                    <label for="daftar_haki2" class="form-check-label">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2 mb-2">
                            <div class="col-6">
                                <label for="daftar_halal" class="text-primary"><b>Produk Daftar Halal ?</b></label><br>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="daftar_halal" value="Ya" id="daftar_halal1">
                                    <label for="daftar_halal1" class="form-check-label">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="daftar_halal" value="Tidak" id="daftar_halal2">
                                    <label for="daftar_halal2" class="form-check-label">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jenis_kemasan" class="text-primary"><b>Jenis Kemasan</b></label>
                            <input type="text" class="form-control form-control-sm" name="jenis_kemasan" placeholder="Jenis kemasan...">
                        </div>
                        <div class="form-group">
                            <label for="warna_kemasan" class="text-primary"><b>Warna Kemasan Primer</b></label>
                            <input type="text" class="form-control form-control-sm" name="warna_kemasan" placeholder="Warna kemasan primer...">
                        </div>
                        <div class="form-group">
                            <label for="volume" class="text-primary"><b>Volume/berat</b></label>
                            <input type="text" class="form-control form-control-sm" name="volume" placeholder="Volume...">
                        </div>
                        <div class="form-group">
                            <label for="tema_kemasan" class="text-primary"><b>Tema Kemasan</b></label>
                            <input type="text" class="form-control form-control-sm" name="tema_kemasan" placeholder="Tema kemasan...">
                        </div>
                        <div class="form-group">
                            <label for="target_launching" class="text-primary"><b>Target Launching</b> (bulan/hari/tahun)</label>
                            <input type="date" class="form-control form-control-sm" name="target_launching" placeholder="Target launching...">
                        </div>
                        <a class="btn btn-sm btn-success" id="deskripsiContinue">Continue <i class="fas fa-arrow-right"></i></a>
                      </div>
                      <div class="tab-pane fade" id="ads" role="tabpanel">
                        <div class="form-group">
                            <label for="target_harga" class="text-primary"><b>Target Harga</b></label>
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                              </div>
                              <input type="text" class="form-control form-control-sm" id="target_harga_modal" placeholder="Target harga..." onkeyup="kurensi('harga_avg_produk_modal')">
                              <input type="hidden" id="target_harga" name="target_harga" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jenis_bentuk" class="text-primary"><b>Jenis & Bentuk Sediaan</b></label>
                            <input type="text" class="form-control form-control-sm" name="jenis_bentuk" placeholder="Jenis & bentuk...">
                        </div>
                        <div class="form-group">
                            <label for="bahan_aktif" class="text-primary"><b>Bahan Aktif</b></label>
                            <input type="text" class="form-control form-control-sm" name="bahan_aktif" placeholder="Bahan aktif...">
                        </div>
                        <div class="form-group">
                            <label for="tekstur" class="text-primary"><b>Tekstur</b></label>
                            <input type="text" class="form-control form-control-sm" name="tekstur" placeholder="Tekstur...">
                        </div>
                        <div class="form-group">
                            <label for="warna" class="text-primary"><b>Warna</b></label>
                            <input type="text" class="form-control form-control-sm" name="warna" placeholder="Warna...">
                        </div>
                        <div class="form-group">
                            <label for="aroma" class="text-primary"><b>Aroma</b></label>
                            <input type="text" class="form-control form-control-sm" name="aroma" placeholder="Aroma...">
                        </div>
                        <div class="form-group">
                            <label for="info_tambahan" class="text-primary"><b>Info Tambahan</b></label>
                            <textarea class="form-control form-control-sm" name="info_tambahan" id="info_tambahan_modal" placeholder="Info tambahan..." rows="4"></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="progress mt-5">
                      <div class="progress-bar" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">Step 1 of 3</div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <a class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-close"></i> Cancel</a>
                    <button type="submit" name="btn_simpan_acc" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Simpan</button>
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

    function show_modal(aksi,id){
        $('.modal-header .modal-title').css('font-weight', 'bold');
        if (aksi == 'tambah') {

            $('#sampleModal').modal({backdrop: 'static', keyboard: false});

        }else if(aksi == 'edit'){
            $('#sampleModal').modal({backdrop: 'static', keyboard: false});
        }
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

    $(document).ready(function() {
        $('#div_daftar_haki').hide();
        
        $('#select_customer').select2({
            theme: "bootstrap",
            placeholder: "Pilih Customer",
            width: 'auto',
            dropdownAutoWidth: true,
            allowClear: true,
        });

        $('#infoContinue').click(function (e) {
            e.preventDefault();
            $('.progress-bar').css('width', '60%');
            $('.progress-bar').html('Step 2 of 3');
            $('#myTab a[href="#deskripsiPanel"]').tab('show');
        });

        $('#deskripsiContinue').click(function(event) {
            $('.progress-bar').css('width', '100%');
            $('.progress-bar').html('Step 3 of 3');
            $('#myTab a[href="#ads"]').tab('show');
        });

        $('#tab1').click(function(event) {
            $('.progress-bar').css('width', '30%');
            $('.progress-bar').html('Step 1 of 2');
        });

        $('#tab2').click(function(event) {
            $('.progress-bar').css('width', '60%');
            $('.progress-bar').html('Step 2 of 3');
        });

        $('#tab3').click(function(event) {
            $('.progress-bar').css('width', '100%');
            $('.progress-bar').html('Step 3 of 3');
        });

        $('input:radio[name=merk_haki]').change(function(event) {
            if (this.value == 'Ya') {
                $('#div_daftar_haki').hide();
            }else{
                $('#div_daftar_haki').show();
            }
        });

        $(document).on('change', '.modal-body #select_customer', function(event) {
            // event.preventDefault();
            var id = $(this).val();
            $.ajax({
                url: "<?php echo base_url().'brand/get_json_brand_customer'; ?>",
                type: 'POST',
                dataType: 'json',
                data: {id: id},
                success: function(data){
                    if (data.length == 0) {
                        // alert('Customer yang anda pilih belum memiliki brand produk. Harap tambahkan brand terlebih dahulu.');
                        $('#pilih_merk').html('');
                    }else{
                        $.each(data, function(index, val) {
                            $('#pilih_merk').html($("<option />").val(val.id_brand_produk).text(val.nama_brand_produk));
                        });
                    }
                }
            }); 
        });
    });
</script>

</body>
</html>