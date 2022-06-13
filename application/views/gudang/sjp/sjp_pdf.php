<!DOCTYPE html>
<html>
<head>
	<title>PT. KOSME - SJP</title>

	<style type="text/css">
		body{
			font-size: 12px;
		}
	</style>
</head>
<body>
	<table border="1" width="100%" cellpadding="5" cellspacing="0">
		<tr>
			<td colspan="4" width="50%">
				<img src="./assets/img/logo.jpg" width="200px"><br>
				<b style="font-size: 14px;">PT. KOSMETIKA GLOBAL INDONESIA</b><br>
				Jl. Rungkut Industri III No.9, Kutisari Kecamatan Tenggilis Mejuyo, Kota Surabaya.<br>
				Telp  : 0341-495603, FAX : 0341-4378850<br>
				Email : kosmetikaglobal.id@gmail.com<br>
				NPWP  : -
			</td>
			<td colspan="2" width="50%">
				<center><b style="font-size: 16px;vertical-align: text-top;">SURAT JALAN</b></center><br>
				No : <?php echo $sjp->nomor_sjp; ?><br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date('H:i'); ?><br><br><br><br><br><br>
			</td>
		</tr>
		<tr>
			<td colspan="4">
				Pembeli <br>
				Nama Toko : <?php echo $spp->nama_customer; ?><br>
				Alamat    : <?php echo $spp->alamat_perusahaan_kirim; ?>
			</td>
			<td colspan="2">
				No. PO       : <br>
				Alamat Kirim : <?php echo $sjp->alamat_sjp; ?>
			</td>
		</tr>
		<tr>
			<td align="center">No.</td>
			<td align="center" colspan="2">Nama Barang</td>
			<td align="center">Jumlah</td>
			<td align="center">Satuan</td>
			<td align="center">Keterangan</td>
		</tr>
		<?php 
			if (isset($detail_sjp) && is_array($detail_sjp)) {
				$no = 1;
				$subtotal = 0;
				$kontols = "";
				foreach ($detail_sjp as $kontol) {
					if($no == 1 ){
						$kontols = $kontol->nama_produk_acc;
					}
					if($kontols !== $kontol->nama_produk_acc){
						?>
							<tr>
								<td></td>
								<td colspan="2" align="center">Total</td>
								<td align="center"><?= $subtotal ?></td>
								<td align="center">Pcs</td>
								<td align="left"> Karton</td>
							</tr>
						<?php
						$kontols = $kontol->nama_produk_acc;
						$subtotal = 0;
					}

					$subtotal += $kontol->subtotal_qty_sjp;
					?>
						<tr>
							<td align="center"><?= $no++ ?></td>
							<td colspan="2"><?= $kontol->nama_produk_acc ?></td>
							<td align="center"><?= $kontol->subtotal_qty_sjp ?> </td>
							<td align="center">Pcs</td>
							<td>No. Batch :
								<ul style="margin-top: 0;margin-bottom: 0;">
								<?php 
									if (isset($kontol->kontol)) {
										foreach ($kontol->kontol as $tetek) {
											?>
											<li><?= $tetek->no_batch_sjp?></li>
											<?php
										}
									}
								?>
								</ul> 
								ED : <br>
								Qty: <?= $kontol->qty_produk_sjp?>
							</td>
						</tr>
					<?php
				}
			}
		?>
		<tr>
			<td></td>
			<td colspan="2" align="center">Total</td>
			<td align="center"><?= (isset($subtotal))?$subtotal:0?></td>
			<td align="center">Pcs</td>
			<td align="left"> Karton</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td align="center">
				Tanda Tangan Penerima <br><br><br><br><br>
				(....................)
			</td>
			<td align="center">
				Security <br><br><br><br><br><br>
				(....................)
			</td>
			<td align="center" colspan="2">
				SPV Gudang <br><br><br><br><br><br>
				(....................)
			</td>
			<td align="right">
				Mengetahui <br> Surabaya, <?php echo date('d/m/Y'); ?> <br><br><br><br><br><br>
				(....................)
			</td>
		</tr>
	</table>
</body>
</html>