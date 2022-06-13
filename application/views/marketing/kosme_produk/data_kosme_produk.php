<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. KOSME - Produk Kosme</title>

    <?php $this->load->view('partials/head', FALSE);?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view('partials/sidebar_marketing', FALSE);?>
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
                    <h1 class="h4 mb-2 text-gray-800">Daftar Produk Anda !</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="#!" class="btn btn-sm btn-primary" onclick="show_modal('tambah','1')"><i class="fas fa-plus"></i> Buat Produk Baru</a>
                            <a href="#!" class="btn btn-sm btn-success"><i class="fas fa-print"></i> Cetak PDF</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama Produk</th>
                                            <th>Kategori</th>
                                            <th>Volume/berat</th>
                                            <th>Harga Min</th>
                                            <th>Harga Avg</th>
                                            <th>Harga Max</th>
                                            <th>MOQ</th>
                                            <th>Harga</th>
                                            <th>MOQ</th>
                                            <th>Harga</th>
                                            <th>MOQ</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($produkkosme as $key) {
                                    ?>
                                        <tr>
                                            <td><?php echo $key->nama_produk_kosme; ?></td>
                                            <td><?php echo $key->nama_kategori_produk_kosme; ?></td>
                                            <td><?php echo $key->volume_produk_kosme." ".$key->satuan_produk_kosme; ?></td>
                                            <td>Rp.<?php echo number_format($key->harga_min,2,',','.'); ?></td>
                                            <td>Rp.<?php echo number_format($key->harga_avg,2,',','.'); ?></td>
                                            <td>Rp.<?php echo number_format($key->harga_max,2,',','.'); ?></td>
                                            <td><?php echo $key->moq_1; ?> pcs</td>
                                            <td>Rp.<?php echo number_format($key->harga_moq_1,2,',','.'); ?></td>
                                            <td><?php echo $key->moq_2; ?> pcs</td>
                                            <td>Rp.<?php echo number_format($key->harga_moq_2,2,',','.'); ?></td>
                                            <td><?php echo $key->moq_3; ?> pcs</td>
                                            <td width="100">
                                                <div class="dropdown show">
                                                  <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Tindakan
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a onclick="show_modal('edit','<?php echo $key->id_produk_kosme; ?>')" class="dropdown-item"><i class="fa fa-pencil"></i> Ubah</a>
                                                    <a onclick="deleteConfirm('<?php echo base_url().'kosmeproduk/hapus/'.$key->id_produk_kosme; ?>')"
                                                        href="#!" class="dropdown-item"><i class="fa fa-trash"></i> Hapus</a>
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
            <div class="modal fade" id="produkKosmeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <form method="post" action="<?php echo base_url().'kosmeproduk/ubah_simpan' ?>" accept-charset="utf-8" id="form-crud-customer">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary" id="exampleModalLabel">Buat Produk</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        	 <div class="form-group">
                                <label for="kode_customer" class="text-primary"><b>Kode Produk</b></label>
                                <input type="hidden" id="id_produk_kosme_edit" name="id_produk_kosme" value="">
                                <input type="hidden" id="aksi_produk_kosme_modal" name="aksi" value="">
                                <input class="form-control" type="text" id="kode_produk_kosme_modal" name="kode_produk_kosme" required="" placeholder="Kode produk baru...">
                            </div>
                            <div class="form-group">
                                <label for="nama_produk_kosme" class="text-primary"><b>Nama Produk</b></label>
                                <input class="form-control" type="text" id="nama_produk_kosme_modal" name="nama_produk_kosme" required="" placeholder="Nama produk baru...">
                            </div>
                            <div class="form-group">
                                <label for="kategori_produk_kosme" class="text-primary"><b>Kategori Produk</b></label>
                                <select name="kategori_produk_kosme" id="kategori_produk_kosme_modal" class="form-control" required="">
                                </select>
                            </div>
                            <div class="form-group">
                            	<div class="row">
                            		<div class="col-6">
                            			<label for="berat_produk_kosme" class="text-primary"><b>Volume/Berat Produk</b></label>
		                                <input class="form-control" type="number" id="volume_produk_kosme_modal" name="berat_produk_kosme" required="" placeholder="Volume produk baru...">
                            		</div>
                            		<div class="col-6">
                            			<label for="satuan_produk_kosme" class="text-primary"><b>Satuan Volume Produk</b></label>
                            			<input type="text" name="satuan_produk_kosme" value="" list="list-satuan" class="form-control" placeholder="Satuan produk baru..." id="satuan_produk_kosme_modal" required="">
                            			<datalist id="list-satuan">
                            				<option value="ml">ml</option>
                            				<option value="gr">gr</option>
                            			</datalist>
                            		</div>
                            	</div>
                            </div>
                            <div class="form-group">
                                <label for="harga_min" class="text-primary"><b>Harga Min</b></label>
                           		<div class="input-group">
								  <div class="input-group-prepend">
								    <span class="input-group-text">Rp.</span>
								  </div>
								  <input type="text" class="form-control" id="harga_min_produk_modal" placeholder="Harga min produk..." onkeyup="kurensi('harga_min_produk_modal')" required="">
								  <input type="hidden" id="harga_min" name="harga_min" value="">
								</div>
                            </div>
                            <div class="form-group">
                                <label for="harga_avg" class="text-primary"><b>Harga AVG</b></label>
                           		<div class="input-group">
								  <div class="input-group-prepend">
								    <span class="input-group-text">Rp.</span>
								  </div>
								  <input type="text" class="form-control" id="harga_avg_produk_modal" placeholder="harga avg produk..." onkeyup="kurensi('harga_avg_produk_modal')" required="">
								  <input type="hidden" id="harga_avg" name="harga_avg" value="">
								</div>
                            </div>
                            <div class="form-group">
                                <label for="harga_max" class="text-primary"><b>Harga Max</b></label>
                           		<div class="input-group">
								  <div class="input-group-prepend">
								    <span class="input-group-text">Rp.</span>
								  </div>
								  <input type="text" class="form-control" id="harga_max_produk_modal" placeholder="harga max produk..." onkeyup="kurensi('harga_max_produk_modal')" required="">
								  <input type="hidden" id="harga_max" name="harga_max" value="">
								</div>
                            </div>
                            <div class="form-group">
                            	<div class="row">
                            		<div class="col-6">
                            			<label for="moq_1" class="text-primary"><b>MOQ</b></label>
		                           		<div class="input-group">
										  <input type="text" class="form-control" name="moq_1" id="moq1_produk_modal" placeholder="Minimum order..." required="">
										  <div class="input-group-append">
										    <span class="input-group-text">pcs</span>
										  </div>
										</div>
                            		</div>
                            		<div class="col-6">
                            			<label for="harga_moq1" class="text-primary"><b>Harga</b></label>
		                           		<div class="input-group">
										  <div class="input-group-prepend">
										    <span class="input-group-text">Rp.</span>
										  </div>
										  <input type="text" class="form-control" id="harga_moq1_produk_modal" onkeyup="kurensi('harga_moq1_produk_modal')" placeholder="harga produk..." required="">
										  <input type="hidden" id="harga_moq1" name="harga_moq1" value="">
										</div>
                            		</div>
                            	</div>
                            </div>
                            <div class="form-group">
                            	<div class="row">
                            		<div class="col-6">
                            			<label for="moq_2" class="text-primary"><b>MOQ</b></label>
		                           		<div class="input-group">
										  <input type="text" class="form-control" name="moq_2" id="moq2_produk_modal" placeholder="Minimum order..." required="">
										  <div class="input-group-append">
										    <span class="input-group-text">pcs</span>
										  </div>
										</div>
                            		</div>
                            		<div class="col-6">
                            			<label for="harga_moq2" class="text-primary"><b>Harga</b></label>
		                           		<div class="input-group">
										  <div class="input-group-prepend">
										    <span class="input-group-text">Rp.</span>
										  </div>
										  <input type="text" class="form-control" id="harga_moq2_produk_modal" onkeyup="kurensi('harga_moq2_produk_modal')" placeholder="harga produk..." required="">
										  <input type="hidden" id="harga_moq2" name="harga_moq2" value="">
										</div>
                            		</div>
                            	</div>
                            </div>
                            <div class="form-group">
                            	<label for="moq_3" class="text-primary"><b>MOQ</b></label>
                           		<div class="input-group">
								  <input type="text" class="form-control" name="moq_3" id="moq3_produk_modal" placeholder="Minimum order..." required="">
								  <div class="input-group-append">
								    <span class="input-group-text">pcs</span>
								  </div>
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

    function kurensi(id){
    	if (id == 'harga_min_produk_modal') {

    		var harga_min_text = $('.modal-body #harga_min_produk_modal').val().replace(/[^0-9]/g, '').toString(); 
	    	$('.modal-body #harga_min_produk_modal').val(harga_min_text.replace(/[^0-9]/g, '').toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
	    	$('.modal-body #harga_min').val(harga_min_text);

    	}else if(id == 'harga_avg_produk_modal'){

    		var harga_avg_text = $('.modal-body #harga_avg_produk_modal').val().replace(/[^0-9]/g, '').toString(); 
	    	$('.modal-body #harga_avg_produk_modal').val(harga_avg_text.replace(/[^0-9]/g, '').toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
	    	$('.modal-body #harga_avg').val(harga_avg_text);

    	}else if(id == 'harga_max_produk_modal'){

    		var harga_max_text = $('.modal-body #harga_max_produk_modal').val().replace(/[^0-9]/g, '').toString(); 
	    	$('.modal-body #harga_max_produk_modal').val(harga_max_text.replace(/[^0-9]/g, '').toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
	    	$('.modal-body #harga_max').val(harga_max_text);

    	}else if(id == 'harga_moq1_produk_modal'){

    		var harga_moq1_text = $('.modal-body #harga_moq1_produk_modal').val().replace(/[^0-9]/g, '').toString(); 
	    	$('.modal-body #harga_moq1_produk_modal').val(harga_moq1_text.replace(/[^0-9]/g, '').toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
	    	$('.modal-body #harga_moq1').val(harga_moq1_text);

    	}else if(id == 'harga_moq2_produk_modal'){

    		var harga_moq2_text = $('.modal-body #harga_moq2_produk_modal').val().replace(/[^0-9]/g, '').toString(); 
	    	$('.modal-body #harga_moq2_produk_modal').val(harga_moq2_text.replace(/[^0-9]/g, '').toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
	    	$('.modal-body #harga_moq2').val(harga_moq2_text);

    	}else{
    		alert('id element kosong !');
    	}
    	
    }

    function show_modal(aksi,id){
        $('.modal-header .modal-title').css('font-weight', 'bold');
        $.ajax({
            url: "<?php echo base_url().'kategori/get_json' ?>",
            type: 'GET',
            dataType: 'json',
            data: {param1: '1'},
            success: function(data){
                $.each(data, function() {
                    $('.modal-body #kategori_produk_kosme_modal').append($("<option />").val(this.id_kategori_produk_kosme).text(this.nama_kategori_produk_kosme));
                });
            }
        });

        if (aksi == 'tambah') {

            $('.modal-body #kategori_produk_kosme_modal option').remove();
            $('.modal-header .modal-title').text('Buat Produk Baru');
            $('.modal-body #id_produk_kosme_edit').attr('disabled', 'true');
            $('.modal-body #aksi_produk_kosme_modal').val('tambah');
            $('.modal-body #kode_produk_kosme_modal').val('');
            $('.modal-body #nama_produk_kosme_modal').val('');
            $('.modal-body #volume_produk_kosme_modal').val('');
            $('.modal-body #satuan_produk_kosme_modal').val('');
            $('.modal-body #harga_min_produk_modal').val('');
            $('.modal-body #harga_avg_produk_modal').val('');
            $('.modal-body #harga_max_produk_modal').val('');
            $('.modal-body #moq1_produk_modal').val('');
            $('.modal-body #harga_moq1_produk_modal').val('');
            $('.modal-body #moq2_produk_modal').val('');
            $('.modal-body #harga_moq2_produk_modal').val('');
            $('.modal-body #moq3_produk_modal').val('');
            $('#produkKosmeModal').modal({backdrop: 'static', keyboard: false});

        }else if(aksi == 'edit'){

            $('.modal-body #kategori_produk_kosme_modal option').remove();
            $('.modal-header .modal-title').text('Ubah Produk');
            $('.modal-body #id_produk_kosme_edit').removeAttr('disabled');
            $('.modal-body #aksi_produk_kosme_modal').val('edit');
            $.ajax({
            url: "<?php echo base_url().'kosmeproduk/get_json_produk_kosme' ?>",
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            success : function(data){
                $.each(data, function(index, data) {
                    $('.modal-body #id_produk_kosme_edit').val(id);
                    $('.modal-body #kode_produk_kosme_modal').val(data.kode_produk_kosme);
                    $('.modal-body #nama_produk_kosme_modal').val(data.nama_produk_kosme);
                    $('.modal-body #kategori_produk_kosme_modal').val(data.id_kategori_produk_kosme);
                    $('.modal-body #volume_produk_kosme_modal').val(data.volume_produk_kosme);
                    $('.modal-body #satuan_produk_kosme_modal').val(data.satuan_produk_kosme);
                    $('.modal-body #harga_min_produk_modal').val(get_currency(data.harga_min));
                    $('.modal-body #harga_min').val(data.harga_min);
                    $('.modal-body #harga_avg_produk_modal').val(get_currency(data.harga_avg));
                    $('.modal-body #harga_avg').val(data.harga_avg);
                    $('.modal-body #harga_max_produk_modal').val(get_currency(data.harga_max));
                    $('.modal-body #harga_max').val(data.harga_max);
                    $('.modal-body #moq1_produk_modal').val(data.moq_1);
                    $('.modal-body #harga_moq1_produk_modal').val(get_currency(data.harga_moq_1));
                    $('.modal-body #harga_moq1').val(data.harga_moq_1);
                    $('.modal-body #moq2_produk_modal').val(data.moq_2);
                    $('.modal-body #harga_moq2_produk_modal').val(get_currency(data.harga_moq_2));
                    $('.modal-body #harga_moq2').val(data.harga_moq_2);
                    $('.modal-body #moq3_produk_modal').val(data.moq_3);
                });
                    $('#produkKosmeModal').modal({backdrop: 'static', keyboard: false});
            }

            });

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
</script>

</body>
</html>