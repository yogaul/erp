<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Cetak Validasi</title>
	<!-- <link rel="stylesheet" href="{{ asset('css/manual.css') }}" media="all" /> -->
	<style type="text/css">
		html{
			margin: 10;
		}
		.grid-container{
			display: inline-block;
		}
		body{
			font-size: 12px;
			font-family: sans-serif;
			margin: 0;
		}
		table{
			border:1px black solid;
		}
		a
	</style>
</head>
<body>
		<div class="grid-container">
			<table style="border-color: white;">
				<?php 
					$i = 0;
					foreach ($detail_kedatangan as $value) {
							if($i % 2 != 0){
				?>
					<td>
						<table width="100%">
							<tr class="atas">
								<td width="150px"><img src="./assets/img/logo.jpg" width="150px"></td>
								<td colspan="2">
									No. Dokumen : LB-QC1-003-00 <br>
									Tanggal Berlaku : 10-10-2018 <br>
									Label Pelulusan Bahan Awal dan Bahan Kemas
								</td>
							</tr>
							<tr>
								<td style="border-top: solid 1px; border-bottom: solid 1px;">
									<?php 
										if ($kedatangan->label_halal == 'Sudah') {
									?>
									<img src="./assets/img/halal.jpeg" width="50px">
									<?php
										}
									?>
								</td>
								<td style="border-top: solid 1px; border-bottom: solid 1px;" colspan="3">
									<b style="font-size: 20px;">LULUS</b>
								</td>
								<tr>
									<td>Nama Bahan</td>
									<td colspan="2">: <?php echo $kedatangan->nama_produk; ?></td>
								</tr>
								<tr>
									<td>Kode Bahan</td>
									<td colspan="2">: <?php echo $kedatangan->kode_produk; ?></td>
								</tr>
								<tr>
									<td>Jumlah</td>
									<td colspan="2">: <?php echo number_format($value->isi_kedatangan,2,',','.').' '.$value->satuan_kedatangan; ?></td>
								</tr>
								<tr>
									<td>Nomor Analisa</td>
									<td colspan="2">: <?php echo $kedatangan->kode_kedatangan; ?></td>
								</tr>
								<tr>
									<td>Tanggal Penerimaan</td>
									<td colspan="2">: <?php echo date('d/m/Y'); ?></td>
								</tr>
								<tr>
									<td>Tanggal Kadaluarsa</td>
									<td colspan="2">: <?php echo date('d/m/Y',strtotime($kedatangan->expired_date)); ?></td>
								</tr>
								<tr>
									<td>Supplier</td>
									<td colspan="2">: <?php echo $kedatangan->nama_mitra; ?></td>
								</tr>
								<tr>
									<td>Pemeriksa</td>
									<td colspan="2">:</td>
								</tr>
								<tr>
									<td>Tanggal Pelulusan</td>
									<td colspan="2">: <?php echo date('d/m/Y'); ?></td>
								</tr>
								<tr>
									<td>Tanggal Retest</td>
									<td colspan="2">:</td>
								</tr>
								<tr>
									<td colspan="3" align="right"><img src="<?= $value->qr_kedatangan ?>"></td>
								</tr>
							</tr>
						</table>
					</td>
				</tr>
			<?php
		}else{
			?>
				<tr>
					<td>
						<table width="100%">
							<tr class="atas">
								<td width="150px"><img src="./assets/img/logo.jpg" width="150px"></td>
								<td colspan="2">
									No. Dokumen : LB-QC1-003-00 <br>
									Tanggal Berlaku : 10-10-2018 <br>
									Label Pelulusan Bahan Awal dan Bahan Kemas
								</td>
							</tr>
							<tr>
								<td style="border-top: solid 1px; border-bottom: solid 1px;">
									<?php 
										if ($kedatangan->label_halal == 'Sudah') {
									?>
									<img src="./assets/img/halal.jpeg" width="50px">
									<?php
										}
									?>
								</td>
								<td style="border-top: solid 1px; border-bottom: solid 1px;" colspan="3">
									<b style="font-size: 20px;">LULUS</b>
								</td>
								<tr>
									<td>Nama Bahan</td>
									<td colspan="2">: <?php echo $kedatangan->nama_produk; ?></td>
								</tr>
								<tr>
									<td>Kode Bahan</td>
									<td colspan="2">: <?php echo $kedatangan->kode_produk; ?></td>
								</tr>
								<tr>
									<td>Jumlah</td>
									<td colspan="2">: <?php echo number_format($value->isi_kedatangan,2,',','.').' '.$value->satuan_kedatangan; ?></td>
								</tr>
								<tr>
									<td>Nomor Analisa</td>
									<td colspan="2">: <?php echo $kedatangan->kode_kedatangan; ?></td>
								</tr>
								<tr>
									<td>Tanggal Penerimaan</td>
									<td colspan="2">: <?php echo date('d/m/Y'); ?></td>
								</tr>
								<tr>
									<td>Tanggal Kadaluarsa</td>
									<td colspan="2">: <?php echo date('d/m/Y',strtotime($kedatangan->expired_date)); ?></td>
								</tr>
								<tr>
									<td>Supplier</td>
									<td colspan="2">: <?php echo $kedatangan->nama_mitra; ?></td>
								</tr>
								<tr>
									<td>Pemeriksa</td>
									<td colspan="2">:</td>
								</tr>
								<tr>
									<td>Tanggal Pelulusan</td>
									<td colspan="2">: <?php echo date('d/m/Y'); ?></td>
								</tr>
								<tr>
									<td>Tanggal Retest</td>
									<td colspan="2">:</td>
								</tr>
								<tr>
									<td colspan="3" align="right"><img src="<?= $value->qr_kedatangan ?>"></td>
								</tr>
							</tr>
						</table>
					</td>
								<?php
							}
							$i++;
						}
					?>
			</table>
		</div>
</body>
</html>