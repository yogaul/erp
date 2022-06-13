<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Customer</title>

    <?php $this->load->view('partials/head', FALSE);?>

    <style type="text/css">
            a:hover{
            text-decoration-line: none;
        }

        .bg-kosme{
            background-color: #f48081;
            color: white;
        }

        .cbp_tmtimeline {
            margin: 0;
            padding: 0;
            list-style: none;
            position: relative
        }

        .cbp_tmtimeline:before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            width: 3px;
            background: #eee;
            left: 20%;
            margin-left: -6px
        }

        .cbp_tmtimeline>li {
            position: relative
        }

        .cbp_tmtimeline>li:first-child .cbp_tmtime span.large {
            color: #444;
            font-size: 17px !important;
            font-weight: 700
        }

        .cbp_tmtimeline>li:first-child .cbp_tmicon {
            background: #fff;
            color: #666
        }

        .cbp_tmtimeline>li:nth-child(odd) .cbp_tmtime span:last-child {
            color: #444;
            font-size: 13px
        }

        .cbp_tmtimeline>li:nth-child(odd) .cbp_tmlabel {
            background: #f0f1f3
        }

        .cbp_tmtimeline>li:nth-child(odd) .cbp_tmlabel:after {
            border-right-color: #f0f1f3
        }

        .cbp_tmtimeline>li .empty span {
            color: #777
        }

        .cbp_tmtimeline>li .cbp_tmtime {
            display: block;
            width: 23%;
            padding-right: 70px;
            position: absolute
        }

        .cbp_tmtimeline>li .cbp_tmtime span {
            display: block;
            text-align: right
        }

        .cbp_tmtimeline>li .cbp_tmtime span:first-child {
            font-size: 15px;
            color: #3d4c5a;
            font-weight: 700
        }

        .cbp_tmtimeline>li .cbp_tmtime span:last-child {
            font-size: 14px;
            color: #444
        }

        .cbp_tmtimeline>li .cbp_tmlabel {
            margin: 0 0 15px 25%;
            background: #f0f1f3;
            padding: 1.2em;
            position: relative;
            border-radius: 5px
        }

        .cbp_tmtimeline>li .cbp_tmlabel:after {
            right: 100%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
            border-right-color: #f0f1f3;
            border-width: 10px;
            top: 10px
        }

        .cbp_tmtimeline>li .cbp_tmlabel blockquote {
            font-size: 16px
        }

        .cbp_tmtimeline>li .cbp_tmlabel .map-checkin {
            border: 5px solid rgba(235, 235, 235, 0.2);
            -moz-box-shadow: 0px 0px 0px 1px #ebebeb;
            -webkit-box-shadow: 0px 0px 0px 1px #ebebeb;
            box-shadow: 0px 0px 0px 1px #ebebeb;
            background: #fff !important
        }

        .cbp_tmtimeline>li .cbp_tmlabel h2 {
            margin: 0px;
            padding: 0 0 10px 0;
            line-height: 26px;
            font-size: 16px;
            font-weight: normal
        }

        .cbp_tmtimeline>li .cbp_tmlabel h2 a {
            font-size: 15px
        }

        .cbp_tmtimeline>li .cbp_tmlabel h2 a:hover {
            text-decoration: none
        }

        .cbp_tmtimeline>li .cbp_tmlabel h2 span {
            font-size: 15px
        }

        .cbp_tmtimeline>li .cbp_tmlabel p {
            color: #444
        }

        .cbp_tmtimeline>li .cbp_tmicon {
            width: 40px;
            height: 40px;
            speak: none;
            font-style: normal;
            font-weight: normal;
            font-variant: normal;
            text-transform: none;
            font-size: 1.4em;
            line-height: 40px;
            -webkit-font-smoothing: antialiased;
            position: absolute;
            color: #fff;
            background: #46a4da;
            border-radius: 50%;
            box-shadow: 0 0 0 5px #f5f5f6;
            text-align: center;
            left: 20%;
            top: 0;
            margin: 0 0 0 -25px
        }

        @media screen and (max-width: 992px) and (min-width: 768px) {
            .cbp_tmtimeline>li .cbp_tmtime {
                padding-right: 60px
            }
        }

        @media screen and (max-width: 65.375em) {
            .cbp_tmtimeline>li .cbp_tmtime span:last-child {
                font-size: 12px
            }
        }

        @media screen and (max-width: 47.2em) {
            .cbp_tmtimeline:before {
                display: none
            }
            .cbp_tmtimeline>li .cbp_tmtime {
                width: 100%;
                position: relative;
                padding: 0 0 20px 0
            }
            .cbp_tmtimeline>li .cbp_tmtime span {
                text-align: left
            }
            .cbp_tmtimeline>li .cbp_tmlabel {
                margin: 0 0 30px 0;
                padding: 1em;
                font-weight: 400;
                font-size: 95%
            }
            .cbp_tmtimeline>li .cbp_tmlabel:after {
                right: auto;
                left: 20px;
                border-right-color: transparent;
                border-bottom-color: #f5f5f6;
                top: -20px
            }
            .cbp_tmtimeline>li .cbp_tmicon {
                position: relative;
                float: right;
                left: auto;
                margin: -64px 5px 0 0px
            }
            .cbp_tmtimeline>li:nth-child(odd) .cbp_tmlabel:after {
                border-right-color: transparent;
                border-bottom-color: #f5f5f6
            }
        }

        .bg-green {
            background-color: #50d38a !important;
            color: #fff;
        }

        .bg-blush {
            background-color: #ff758e !important;
            color: #fff;
        }

        .bg-orange {
            background-color: #ffc323 !important;
            color: #fff;
        }

        .bg-info {
            background-color: #2CA8FF !important;
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
                    <h1 class="h4 mb-2 text-gray-800">Daftar Customer Anda !</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                       <!--  <div class="card-header py-3">
                            <a href="#!" class="btn btn-sm btn-primary" onclick="show_modal('tambah','1')"><i class="fas fa-plus"></i> Tambah Customer</a>
                        </div> -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tableCustomer" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama Customer</th>
                                            <th>Nama Perusahaan</th>
                                            <th>Jabatan</th>
                                            <th>Alamat Perusahaan</th>
                                            <th>Telp. Customer</th>
                                            <th>Telp. Perusahaan</th>
                                            <th>Verifikasi</th>
                                            <?php
                                                if ($this->session->userdata('level') == 'marketing' || $this->session->userdata('level') == 'tim_marketing') {
                                            ?>
                                            <th>Tindakan</th>
                                            <?php
                                                }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        foreach ($customer as $key) {
                                            if ($key->verifikasi == 'valid') {
                                                $color = 'success';
                                            }elseif ($key->verifikasi == 'invalid') {
                                                $color = 'danger';
                                            }else{
                                                $color = 'warning';
                                            }
                                    ?>
                                        <tr>
                                            <td><?php echo $key->nama_customer; ?></td>
                                            <td><?php echo $key->nama_perusahaan_customer; ?></td>
                                            <td><?php echo $key->jabatan_customer; ?></td>
                                            <td><?php echo $key->alamat_perusahaan_kirim; ?></td>
                                            <td><?php echo $key->telp_customer; ?></td>
                                            <td><?php echo $key->telp_perusahaan_customer; ?></td> 
                                            <td><span class="badge badge-<?= $color ?>"><?= ($key->verifikasi != 'valid' && $key->verifikasi != 'invalid') ? 'Unverified' : ucwords($key->verifikasi) ?></span></td> 
                                            <?php
                                                if ($this->session->userdata('level') == 'marketing' || $this->session->userdata('level') == 'tim_marketing') {
                                            ?>
                                            <td width="100">
                                                <div class="dropdown show">
                                                  <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Tindakan
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a onclick="show_modal('edit','<?php echo $key->id_customer; ?>')" class="dropdown-item"><i class="fa fa-pencil"></i> Ubah</a>
                                                    <a onclick="show_modal('log','<?php echo $key->id_customer; ?>')" class="dropdown-item"><i class="fa fa-history"></i> Log</a>
                                                    <?php
                                                        if ($key->verifikasi != 'valid') {
                                                    ?>
                                                    <a href="<?= base_url().'customer/verifikasi/'.$key->id_customer ?>" class="dropdown-item"><i class="fa fa-check"></i> Verifikasi</a>
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

            <!-- Track Modal-->
            <div class="modal fade" id="trackModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary font-weight-bold" id="exampleModalLabel">Log Customer</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"></div>
                </div>
            </div>
            </div>

            <!-- Tambah Modal -->
            <div class="modal fade" id="tambahCustomerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                    <form method="post" action="<?php echo base_url().'customer/ubah_simpan' ?>" accept-charset="utf-8" id="form-crud-customer">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary" id="exampleModalLabel">Tambah Customer</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama_customer" class="text-primary"><b>Nama Customer</b></label>
                                <input type="hidden" id="id_customer_edit" name="id_customer" value="">
                                <input type="hidden" id="aksi_customer_modal" name="aksi" value="">
                                <input class="form-control" type="text" id="nama_customer_modal" name="nama_customer" required="" placeholder="Nama customer baru...">
                            </div>
                            <div class="form-group">
                                <label for="nama_perusahaan" class="text-primary"><b>Nama Perusahaan</b></label>
                                <input class="form-control" type="text" id="nama_perusahaan_modal" name="nama_perusahaan" required="" placeholder="Nama perusahaan...">
                            </div>
                            <div class="form-group">
                                <label for="jabatan_customer" class="text-primary"><b>Jabatan Customer</b></label>
                                <input class="form-control" type="text" id="jabatan_customer_modal" name="jabatan_customer" required="" placeholder="Jabatan customer...">
                            </div>
                            <div class="form-group">
                                <label for="alamat_perusahaan" class="text-primary"><b>Alamat Perusahaan</b></label>
                                <input class="form-control" type="text" id="alamat_perusahaan_modal" name="alamat_perusahaan" required="" placeholder="Alamat perusahaan...">
                            </div>
                            <div class="form-group">
                                <label for="telp_customer" class="text-primary"><b>Telp Customer</b></label>
                                <input class="form-control" type="text" id="telp_customer_modal" name="telp_customer" required="" placeholder="Telp customer baru...">
                            </div>
                            <div class="form-group">
                                <label for="telp_perusahaan" class="text-primary"><b>Telp Perusahaan</b></label>
                                <input class="form-control" type="text" id="telp_perusahaan_modal" name="telp_perusahaan" required="" placeholder="Telp perusahaan customer...">
                            </div>
                            <div class="form-group">
                                <label for="alamat_perusahaan" class="text-primary"><b>Alamat Pengiriman Sample</b></label>
                                <textarea class="form-control" rows="4" id="alamat_pengiriman_modal" name="alamat_pengiriman" required="" placeholder="Alamat pengiriman..."></textarea>
                            </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Simpan</button>
                            <a class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Batal</a>
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

    function show_modal(aksi,id){
        $('.modal-header .modal-title').css('font-weight', 'bold');
        if (aksi == 'tambah') {

            $('.modal-header .modal-title').text('Tambah Customer');
            $('.modal-body #id_customer_edit').attr('disabled', 'true');
            $('.modal-body #aksi_customer_modal').val('tambah');
            $.ajax({
                url: "<?php echo base_url().'customer/get_json_kode' ?>",
                type: 'GET',
                dataType: 'json',
                data: {param1: 'value1'},
                success: function(data){
                    $('.modal-body #kode_customer_modal').val(data);
                }
            });
            $('.modal-body #nama_customer_modal').val('');
            $('.modal-body #nama_perusahaan_modal').val('');
            $('.modal-body #jabatan_customer_modal').val('');
            $('.modal-body #alamat_perusahaan_modal').val('');
            $('.modal-body #telp_customer_modal').val('');
            $('.modal-body #telp_perusahaan_modal').val('');
            $('#tambahCustomerModal').modal({backdrop: 'static', keyboard: false});

        }else if(aksi == 'edit'){

            $('.modal-header .modal-title').text('Ubah Customer');
            $('.modal-body #id_customer_edit').removeAttr('disabled');
            $('.modal-body #aksi_customer_modal').val('edit');
            $.ajax({
            url: "<?php echo base_url().'customer/get_json_customer' ?>",
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            success : function(data){
                $.each(data, function(index, data) {
                    $('.modal-body #id_customer_edit').val(id);
		            $('.modal-body #kode_customer_modal').val(data.kode_customer);
		            $('.modal-body #nama_customer_modal').val(data.nama_customer);
                    $('.modal-body #nama_perusahaan_modal').val(data.nama_perusahaan_customer);
                    $('.modal-body #jabatan_customer_modal').val(data.jabatan_customer);
                    $('.modal-body #alamat_perusahaan_modal').val(data.alamat_perusahaan_kirim);
                    $('.modal-body #alamat_pengiriman_modal').val(data.alamat_cust);
		            $('.modal-body #telp_customer_modal').val(data.telp_customer);
                    $('.modal-body #telp_perusahaan_modal').val(data.telp_perusahaan_customer);
                });
                    $('#tambahCustomerModal').modal({backdrop: 'static', keyboard: false});
                }
            });

        }else if(aksi == 'log'){
            log_detail(id);
        }
    }

    function log_detail(id){
        $('#trackModal .modal-body').html('');        
        var html = "";
        $.ajax({
            url: "<?= base_url('customer/json_log_customer'); ?>",
            method: 'POST',
            dataType: 'json',
            data: {id: id},
            success: function(data){
                if (data.length == 0) {
                    html += "<div class='row'>";
                    html += "<div class='col-12'>";
                    html += "<p class='text-center'>Tidak ada data untuk ditampilkan.</p>";
                    html += "</div>";
                    html += "</div>";
                }else{
                    $.each(data, function (indexInArray, valueOfElement) { 
                        html += "<div class='row'>";
                        html += "<div class='col-md-10'>";
                        html += "<ul class='cbp_tmtimeline'>";
                        html += "<li>";
                        html += "<time class='cbp_tmtime' datetime='2017-11-04T03:45'><span class='tanggal-jam'>"+valueOfElement.tanggal_log_customer+"</span><span class='hari'></span></time>";
                        html += "<div class='cbp_tmicon bg-primary'><i class='fas fa-cog text-white'></i></div>";
                        html += "<div class='cbp_tmlabel'>";
                        html += "<h2><a href='javascript:void(0);' class='user'>"+valueOfElement.user_log_customer+"</a></h2>";
                        html += "<p class='deskripsi'>"+valueOfElement.deskripsi_log_customer+"</p>"; 
                        html += "</div>"; 
                        html += "</li>"; 
                        html += "</ul>"; 
                        html += "</div>"; 
                        html += "</div>"; 
                    });
                }
                $('#trackModal .modal-body').html(html);        
            }
        })
        $('#trackModal').modal({backdrop: 'static', keyboard: false});
    }

    $(document).ready(function() {
        $('#tableCustomer').DataTable({
            stateSave: true
        });
    });
</script>

</body>
</html>