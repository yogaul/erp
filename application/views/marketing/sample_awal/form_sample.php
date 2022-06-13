<!DOCTYPE html>
<html>
<head>
	<title>PT.KOSME - Form Sample</title>

	<?php $this->load->view('partials/head', FALSE); ?>

	<!-- icon -->
	<link rel="icon" href="<?php echo base_url().'assets/img/survey.png' ?>">

	<style type="text/css">
		.required:after{
			content:"*";
  			color: red;
		}

		label{
			font-weight: bold;
		}
	</style>
</head>
<body style="background-color: #ffdede;">

	<div class="container mb-3">
		<div class="card shadow my-3"> 
			<div class="card-body"> 
				<div class="row">
					<div class="col-12"><img src="<?php echo base_url().'assets/img/logo.jpg' ?>" alt="logo" width="250px"></div>
				</div><hr>
				<div class="row">
					<div class="col-12">
						<p class="h4 text-dark">Formulir Permintaan Sample PT.KOSME</p>
						<p class="text-justify text-dark">Silahkan mengisi data dibawah ini untuk memulai permintaan sample di PT Kosmetika Global Indonesia (KOSME). Kami memahami bahwa perlindungan privasi seperti informasi pribadi dan kerahasiaan identitas sangat penting sebagai bentuk komitmen kami untuk menghasilkan produk yang memiliki karakteristik unik dan khusus kepada klien-klien kami.</p>
						<p class="text-danger">* Wajib</p>
					</div>
				</div>
			</div>
		</div>
		<form action="<?php echo base_url().'sample/simpan_request'; ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
			<div class="card shadow my-3">
				<div class="card-header bg-danger text-white font-weight-bold">Informasi Customer</div>
				<div class="card-body">
					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label class="text-dark required">Nama Customer (Sesuai KTP)</label>
								<input type="text" name="nama_cust" placeholder="Jawaban Anda" class="form-control" required="">
							</div>
							<div class="form-group">
								<label class="text-dark">Jabatan Customer</label>
								<input type="text" name="jabatan_customer" placeholder="Jawaban Anda" class="form-control" required="">
							</div>
							<div class="form-group">
								<label class="text-dark required">Telepon Customer (WhatsApp)</label>
								<input type="text" name="telp_cust" placeholder="Jawaban Anda" class="form-control" required="">
							</div>
							<div class="form-group">
								<label class="text-dark">Telepon Perusahaan</label>
								<input type="text" name="telp_perusahaan" placeholder="Jawaban Anda" class="form-control">
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label class="text-dark">Nama Perusahaan</label>
								<input type="text" name="nama_perusahaan" placeholder="Jawaban Anda" class="form-control" required="">
							</div>
							<div class="form-group">
								<label class="text-dark">Alamat Perusahaan</label>
								<input type="text" name="alamat_perusahaan" placeholder="Jawaban Anda" class="form-control" required="">
							</div>
							<div class="form-group">
								<label class="text-dark required">Alamat Lengkap (Pengiriman Sample)</label>
								<textarea class="form-control" rows="4" required="" name="alamat_cust" placeholder="Jawaban Anda"></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="card shadow my-3">
				<div class="card-header bg-danger text-white font-weight-bold">Creative Briefing Logo</div>
				<div class="card-body">
					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label class="text-dark required">Apa Nama Brand Anda ?</label>
								<input type="text" name="nama_brand_briefing" placeholder="Jawaban Anda" class="form-control" required="">
							</div>
							<div class="form-group">
								<label class="text-dark">Apa Object/Gambar Yang Dipilih Pada Logo?</label>
								<input type="text" name="gambar_logo_briefing" placeholder="Jawaban Anda" class="form-control">
							</div>
							<div class="form-group">
								<label class="text-dark required">Apa Penggunaan Font? (bentuk,insial,huruf besar/kecil)</label>
								<input type="text" name="font_brand_briefing" placeholder="Jawaban Anda" class="form-control" required="">
							</div>
							<div class="form-group">
								<label class="text-dark required">Apa Warna Yang Diinginkan?</label>
								<input type="text" name="warna_brand_briefing" placeholder="Jawaban Anda" class="form-control" required="">
							</div>
							<div class="form-group">
								<label class="text-dark required">Siapa Target Marketing Produk Anda?</label>
								<input type="text" name="target_marketing_briefing" placeholder="Jawaban Anda" class="form-control" required="">
							</div>
							<div class="form-group">
								<label class="text-dark required">Apa Ada Referensi Logo? (capture/link)</label>
								<input type="text" name="referensi_logo_briefing" placeholder="Jawaban Anda" class="form-control" required="">
							</div>
							<div class="form-group">
								<label class="text-dark required">Apa Selera Brand? (luxury,elegant,feminine,maskulin,kids dll)</label>
								<input type="text" name="selera_brand_briefing" placeholder="Jawaban Anda" class="form-control" required="">
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label class="text-dark required">Apa Model Logo Yang Anda Pilih? (logo type,monogram,logo gram)</label>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-2">
										<input type="checkbox" name="model_logo_briefing" value="Logotype" class="form-control form-control-sm">
									</div>
									<div class="col-9">
										<label for="" class="text-dark text-center">Logotype</label><br>
										<img src="<?php echo base_url().'assets/img/logotype_fix.png' ?>" width="150px">
					                </div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-2">
										<input type="checkbox" name="model_logo_briefing" value="Logogram" class="form-control form-control-sm">
									</div>
									<div class="col-9">
										<label for="" class="text-dark text-center">Logogram</label><br>
										<img src="<?php echo base_url().'assets/img/logogram_fix.png' ?>" width="150px">
					                </div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-2">
										<input type="checkbox" name="model_logo_briefing" value="Monogram" class="form-control form-control-sm">
									</div>
									<div class="col-9">
										<label for="" class="text-dark text-center">Monogram</label><br>
										<img src="<?php echo base_url().'assets/img/monogram_fix.png' ?>" width="150px">
					                </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div id="div-container">
				<div class="card shadow my-3 card-form-sample">
				<div class="card-header bg-danger text-white font-weight-bold">Detail Informasi Sample <a class="float-right btn-danger" onclick="add_request()"><i class="fas fa-plus"></i></a></div>
				<div class="card-body">
					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label for="tanggal_request" class="text-dark required">Tanggal Request Sample</label>
								<input type="hidden" name="id_sample[]" value="" id="id_sample1">
								<input type="text" name="tanggal_request[]" class="form-control" value="<?php echo date('d/m/Y'); ?>" readonly="">
							</div>
							<div class="form-group">
								<label for="permintaan_sample" class="text-dark required">Permintaan Sample (Nama Produk)</label>
								<input type="text" name="permintaan_sample[]" placeholder="Jawaban Anda" class="form-control" required="">
							</div>
							<div class="row">
								<div class="col-8">
									<div class="form-group">
										<label for="target_harga" class="text-dark required">Target Harga Bahan (Exclude Kemasan)</label>
										<div class="input-group">
											<div class="input-group-prepend">
		                                       <div class="input-group-text">Rp</div>
		                                    </div>
		                                    <input type="text" class="form-control" id="target_harga_text1" placeholder="Jawaban Anda" onkeyup="cek_kurensi(1)" required="">
		                                    <input type="hidden" name="target_harga[]" id="target_harga1" value="">
										</div>
									</div>
								</div>
								<div class="col-4">
									<div class="form-group">
										<label for="volume" class="text-dark required">Volume (ml)</label>
										<input type="number" min="0" class="form-control" name="volume[]" placeholder="Jawaban Anda" required="">
									</div>
								</div>
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label for="spesifikasi" class="text-dark required">Spesifikasi (Tekstur, Warna, Aroma)</label>
								<textarea class="form-control" rows="5" required="" name="spesifikasi[]" placeholder="Jawaban Anda"></textarea>
							</div>
							<div class="form-group">
								<label for="foto_sample_awal" class="text-dark">Contoh Foto Produk (Dupe) (Maks. 1 MB)</label>
								<input type="file" name="foto_sample_awal[]" class="form-control-file">
							</div>
						</div>
					</div>
				</div>
			</div>
			</div>
			<a href="https://www.google.com/" class="btn bg-white text-danger mr-1"><i class="fas fa-times"></i> Batal</a>
			<button type="submit" class="btn btn-danger" name="simpan_request"><i class="fas fa-save"></i> Simpan</button>
		</form>
		
	</div>

	<?php  $this->load->view('partials/js', FALSE); ?>

	<script type="text/javascript">

		function cek_kurensi(data){
			var target_harga_text = $('#target_harga_text'+data).val().replace(/[^0-9]/g, '').toString(); 
            $('#target_harga_text'+data).val(target_harga_text.replace(/[^0-9]/g, '').toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
            $('#target_harga'+data).val(target_harga_text);
		}

		function add_request(){
			var angka = $('.card-form-sample').length;
			var id = angka+1;
			var html = "<div class='card shadow my-3 card-form-sample'><div class='card-header bg-danger text-white font-weight-bold'>Detail Informasi Sample <a class='float-right btn-danger ml-1' id='btn-remove'><i class='fas fa-minus'></i></a><a class='float-right btn-danger' onclick='add_request()'><i class='fas fa-plus'></i></a></div><div class='card-body'><div class='row'><div class='col-6'><div class='form-group'><label for='tanggal_request' class='text-dark required'>Tanggal Request Sample</label><input type='hidden' name='id_sample[]' value='' id='id_sample"+id+"'><input type='text' name='tanggal_request[]' class='form-control' value='<?php echo date('d/m/Y'); ?>' readonly=''></div><div class='form-group'><label for='permintaan_sample' class='text-dark required'>Permintaan Sample (Nama Produk)</label><input type='text' name='permintaan_sample[]' placeholder='Jawaban Anda' class='form-control' required=''></div><div class='row'><div class='col-8'><div class='form-group'><label for='target_harga' class='text-dark required'>Target Harga Bahan (Exclude Kemasan)</label><div class='input-group'><div class='input-group-prepend'><div class='input-group-text'>Rp</div></div><input type='text' class='form-control' id='target_harga_text"+id+"' placeholder='Jawaban Anda' onkeyup='cek_kurensi("+id+")' required=''><input type='hidden' name='target_harga[]' id='target_harga"+id+"' value=''></div></div></div><div class='col-4'><div class='form-group'><label for='volume' class='text-dark required'>Volume (ml)</label><input type='number' min='0' class='form-control' name='volume[]' placeholder='Jawaban Anda' required=''></div></div></div></div><div class='col-6'><div class='form-group'><label for='spesifikasi' class='text-dark required'>Spesifikasi (Tekstur, Warna, Aroma)</label><textarea class='form-control' rows='5' required='' name='spesifikasi[]' placeholder='Jawaban Anda'></textarea></div><div class='form-group'><label for='foto_sample_awal' class='text-dark'>Contoh Foto Produk (Dupe) (Maks. 1 MB)</label><input type='file' name='foto_sample_awal[]' class='form-control-file'></div></div></div></div></div>";

			$('#div-container').append(html);
			set_id(id);
		}

		function set_id(id){
			$('#id_sample'+id).val(new Date().getTime());
		}

		$(document).ready(function() {

			set_id(1);

			$(document).on('click', '#btn-remove', function(event) {
				event.preventDefault();
				$(this).closest('.card-form-sample').remove();
			});

			$("input:checkbox").on('click', function() {
			  var $box = $(this);
			  if ($box.is(":checked")) {
			    var group = "input:checkbox[name='" + $box.attr("name") + "']";
			    $(group).prop("checked", false);
			    $box.prop("checked", true);
			  } else {
			    $box.prop("checked", false);
			  }
			});
		});
	</script>
</body>
</html>