<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Success</title>
	
	<?php $this->load->view('partials/head', FALSE); ?>

</head>
<body>
	<div class="jumbotron text-center">
	  <h1 class="display-3">Terima kasih!</h1>
	  <p class="lead"><strong>Data anda telah disimpan :) </strong>proses selanjutnya harap hubungi admin.</p>
	  <hr>
	  <!-- <p>
	    Having trouble? <a href="">Contact us</a>
	  </p> -->
	  <p class="lead">
	    <a class="btn btn-primary btn-sm" href="<?php echo base_url().'komplain'; ?>" role="button"><i class="fas fa-arrow-left"></i> Kembali ke form</a>
	  </p>
	</div>
</body>
</html>