<!DOCTYPE html>
<html>
<head>
	<title>PT.KOSME - Customer Response</title>

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
						<p class="h4 text-dark">Formulir Customer Response PT.KOSME</p>
						<p class="text-justify text-dark">Silahkan mengisi data dibawah ini untuk memulai customer response di PT Kosmetika Global Indonesia (KOSME). Kami memahami bahwa perlindungan privasi seperti informasi pribadi dan kerahasiaan identitas sangat penting sebagai bentuk komitmen kami untuk menghasilkan produk yang memiliki karakteristik unik dan khusus kepada klien-klien kami.</p>
						<p class="text-danger">* Wajib</p>
					</div>
				</div>
			</div>
		</div>
		<form action="<?php echo base_url().'komplain/simpan'; ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
			<div class="card shadow my-3">
				<div class="card-header bg-danger text-white font-weight-bold">Informasi Customer Response</div>
				<div class="card-body">
					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label class="text-dark required">Nama Konsumen</label>
								<input type="text" name="nama_konsumen" placeholder="Jawaban Anda" class="form-control" required="">
							</div>
							<div class="form-group">
								<label class="text-dark required">Usia Konsumen</label>
								<input type="text" name="usia_konsumen" placeholder="Jawaban Anda" class="form-control" required="">
							</div>
							<div class="form-group">
								<label class="text-dark required">Produk Yang Dikomplain</label>
								<input type="text" name="produk_komplain" placeholder="Jawaban Anda" class="form-control" required="">
							</div>
							<div class="form-group">
								<label class="text-dark required">Keterangan Komplain</label>
								<input type="text" name="keterangan_komplain" placeholder="Jawaban Anda" class="form-control">
							</div>
							<div class="form-group">
								<label class="text-dark required">Nomor Batch Produk</label>
								<input type="text" name="no_batch_produk" placeholder="Jawaban Anda" class="form-control" required="">
							</div>
							<div class="form-group">
								<label class="text-dark required">Tanggal Expired Produk</label>
								<input type="date" name="expired_date_komplain"  class="form-control" required="" placeholder="Jawaban Anda">
							</div>
							<div class="form-group">
								<label class="text-dark required">Jumlah Produk Yang Dikomplain</label>
								<input type="text" name="jumlah_produk_komplain"  class="form-control" required="" placeholder="Jawaban Anda">
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label class="text-dark required">Frekuesi Pemakaian</label>
								<input type="text" name="frekuensi_pemakaian"  class="form-control" required="" placeholder="Jawaban Anda">
							</div>
							<div class="form-group">
								<label class="text-dark required">Lama Pemakaian Produk</label>
								<input type="text" name="lama_pemakaian_produk"  class="form-control" required="" placeholder="Jawaban Anda">
							</div>
							<div class="form-group">
								<label class="text-dark required">Tanggal Pembelian Produk</label>
								<input type="date" name="tanggal_pembelian_produk"  class="form-control" required="" placeholder="Jawaban Anda">
							</div>
							<div class="form-group">
								<label class="text-dark required">Foto/Video Produk (Maks. 5 MB)</label>
								<input type="file" name="file_komplain"  class="form-control-file file-komplain" required="" accept="image/*, video/*">
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
		$(document).ready(function() {
			$(document).on('change', '.file-komplain', function(event) {
				// event.preventDefault();
				/* Act on the event */
				let msize = this.files[0].size;
				console.log(msize);
				if (msize > 5000000) {
					alert('Ukuran file tidak boleh lebih dari 5 MB !');
					$(this).val('');
				}
			});
		});
	</script>
</body>
</html>