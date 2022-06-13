<!DOCTYPE html>
<html>
<head>
	<title>PT.KOSME - Form Survey</title>

	<!-- Custom fonts for this template-->
	<link href="<?php echo base_url('assets/vendor/fontawesome-free/css/all.min.css')?>" rel="stylesheet" type="text/css">
	<link
	    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
	    rel="stylesheet">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- Custom styles for this page -->
	<link href="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css')?>" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="<?php echo base_url('assets/css/sb-admin-2.min.css')?>" rel="stylesheet">

	<!-- select2 -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">

	<!-- select -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

	<!-- icon -->
	<link rel="icon" href="<?php echo base_url().'assets/img/survey.png' ?>">

	<style type="text/css">
		.required:after{
			content:"*";
  			color: red;
		}
	</style>
</head>
<body style="background-color: #ffdede;">

	<div class="container mb-3">
		<div class="card border-danger shadow my-3"> 
			<div class="card-body"> 
				<div class="row">
					<div class="col-12"><img src="<?php echo base_url().'assets/img/logo.jpg' ?>" alt="logo" width="250px"></div>
				</div><hr>
				<div class="row">
					<div class="col-12">
						<p class="h4 text-dark">Survey Permintaan Maklon Produk</p>
						<p class="text-justify text-dark">Silahkan mengisi data dibawah ini untuk memulai pemesanan produk di PT Kosmetika Global Indonesia. Kami memahami bahwa perlindungan privasi seperti informasi pribadi dan kerahasiaan identitas sangat penting sebagai bentuk komitmen kami untuk menghasilkan produk yang memiliki karakteristik unik dan khusus kepada klien-klien kami.</p>
						<p class="text-danger">* Wajib</p>
					</div>
				</div>
			</div>
		</div>
		<form action="<?php echo base_url().'survey/simpan' ?>" method="post" accept-charset="utf-8">
			<div class="card shadow my-3">
				<div class="card-header bg-danger text-white">Informasi Customer</div>
				<div class="card-body">
					<div class="row">
						<div class="col-6">
							<label class="text-dark required">Email</label>
							<input type="email" name="email_cust" placeholder="Jawaban Anda" class="form-control" required="">
						</div>
						<div class="col-6">
							<label class="text-dark required">Nama Customer</label>
							<input type="text" name="nama_cust" placeholder="Jawaban Anda" class="form-control" required="">
						</div>
					</div><br>
					<div class="row">
						<div class="col-6">
							<label class="text-dark required">Nomor Telepon</label>
							<input type="text" name="telp_cust" placeholder="Jawaban Anda" class="form-control" required="">
						</div>
						<div class="col-6">
							<label class="text-dark required">Alamat Lengkap</label>
							<input type="text" name="alamat_cust" placeholder="Jawaban Anda" class="form-control" required="">
						</div>
					</div>
				</div>
			</div>

			<div class="card shadow my-3">
				<div class="card-header bg-danger text-white">Produk yang akan dipesan di PT Kosmetika Global Indonesia</div>
				<div class="card-body">
					<div class="row">
						<div class="col-6">
							<label for="produk_decor" class="text-dark">Decorative Product</label>
							<select id="produk_decor" name="produk_decor[]" class="form-control" multiple="multiple">
								<option value="Bedak Padat">Bedak Padat</option>
								<option value="Blush On">Blush On</option>
								<option value="Brow Gel">Brow Gel</option>
							</select>
						</div>
						<div class="col-6">
							<label for="produk_body" class="text-dark">Body Care Products</label>
							<select id="produk_body" name="produk_body[]" class="form-control" multiple="multiple">
								<option value="Bath Salt">Bath Salt</option>
								<option value="Body Butter">Body Butter</option>
								<option value="Body Cream">Body Cream</option>
							</select>
						</div>
					</div><br>
					<div class="row">
						<div class="col-6">
							<label for="produk_skin" class="text-dark">Skin Care Products</label>
							<select id="produk_skin" name="produk_skin[]" class="form-control" multiple="multiple">
								<option value="Essence">Essence</option>
								<option value="Facial Wash">Facial Wash</option>
								<option value="Face Cream">Face Cream</option>
							</select>
						</div>
						<div class="col-6">
							<label for="produk_men" class="text-dark">Men Care Products</label>
							<select id="produk_men" name="produk_men[]" class="form-control" multiple="multiple">
								<option value="Facial Wash">Facial Wash</option>
								<option value="Sunscreen">Sunscreen</option>
								<option value="Pomade">Pomade</option>
							</select>
						</div>
					</div><br>
					<div class="row">
						<div class="col-6">
							<label for="produk_hair" class="text-dark">Hair Care Products</label>
							<select id="produk_hair" name="produk_hair[]" class="form-control" multiple="multiple">
								<option value="Shampoo">Shampoo</option>
								<option value="Conditioner">Conditioner</option>
								<option value="Hair Treatment">Hair Treatment</option>
							</select>
						</div>
					</div>
				</div>
			</div>

			<div class="card shadow my-3">
				<div class="card-header bg-danger text-white">Customer's Brand</div>
				<div class="card-body">
					<div class="row">
						<div class="col-6">
							<label class="text-dark required">Sudah pernah maklon sebelumnya?</label>
							<div class="form-check">
							  <input class="form-check-input" type="radio" name="pernah" id="exampleRadios1" value="Pernah" required="">
							  <label class="form-check-label" for="exampleRadios1">
							    Pernah
							  </label>
							</div>
							<div class="form-check">
							  <input class="form-check-input" type="radio" name="pernah" id="exampleRadios2" value="Tidak Pernah" required="">
							  <label class="form-check-label" for="exampleRadios2">
							    Tidak Pernah
							  </label>
							</div>
						</div>
						<div class="col-6">
							<label for="nama_brand" class="text-dark">Nama Brand yang akan dibuat</label>
							<input type="text" name="nama_brand" placeholder="Jawaban Anda" class="form-control" required="">
						</div>
					</div><br>
					<div class="row">
						<div class="col-6">
							<label for="estimasi" class="text-dark">Estimasi tanggal launching produk</label>
							<input type="date" name="estimasi" class="form-control">
						</div>
					</div>
				</div>
			</div>
			<a href="https://www.google.com/" class="btn bg-white text-danger mr-1">Batal</a>
			<button type="submit" class="btn btn-danger">Simpan</button>
		</form>
		
	</div>

	<?php  $this->load->view('partials/js', FALSE); ?>

	<script type="text/javascript">
		$(document).ready(function() {

			$(document).on('click', '.btn-danger', function(event) {
				var decor_produk = $("#produk_decor option:selected").val();
			});

			$('select').select2({
			    tags: true
			})
		});
	</script>
</body>
</html>