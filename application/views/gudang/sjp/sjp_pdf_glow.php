<!DOCTYPE html>
<html>
<head>
	<title>PT. KOSME - SJP MS Glow</title>

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
				Jl. Rungkut Industri III No.9, Kutisari Kecamatan Tenggilis Mejoyo, Kota Surabaya.<br>
				Telp  : 0341-495603, FAX : 0341-4378850<br>
				Email : kosmetikaglobal.id@gmail.com<br>
				NPWP  : -
			</td>
			<td colspan="2" width="50%">
				<center><b style="font-size: 16px;vertical-align: text-top;">SURAT JALAN</b></center><br>
				No : <?php echo $sjp->nomor_sjp; ?><br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date('H:i'); ?><br>
				<img src="<?= $sjp->qr_sjp ?>" width="100px">
			</td>
		</tr>
		<tr>
			<td colspan="4">
				Pembeli <br>
				Nama Toko : <?php echo 'MS Glow'; ?><br>
				Alamat    : <?php echo ''; ?>
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
			// $total = 0;
			if (isset($detail_sjp) && is_array($detail_sjp)) {
				$no = 1;
				$subtotal = 0;
				$total = 0;
				$kontols = "";
				foreach ($detail_sjp as $kontol) {
					if($no == 1 ){
						$kontols = $kontol->nama_produk_msglow;
					}
					if($kontols !== $kontol->nama_produk_msglow){
						?>
							<tr>
								<td></td>
								<td colspan="2" align="center">Total</td>
								<td align="center"><?= $subtotal ?></td>
								<td align="center">Pcs</td>
								<td align="left"> <?= $total ?> Karton</td>
							</tr>
						<?php
						$kontols = $kontol->nama_produk_msglow;
						$subtotal = 0;
                        $total = 0;
					}
                    $total += $kontol->qty_produk_glow;

					$subtotal += $kontol->subtotal_produk_glow;
					?>
						<tr>
							<td align="center"><?= $no++ ?></td>
							<td colspan="2">
								<?= $kontol->nama_produk_msglow; ?><br>
								<?= (!empty($kontol->kode_produk_msglow)) ? "($kontol->kode_produk_msglow)" : "" ?><br>
								<?= (!is_null($kontol->serialisasi) && !empty($kontol->serialisasi)) ? " - (".substr($kontol->serialisasi,-12).")" : "" ?>
							</td>
							<td align="center"><?= $kontol->subtotal_produk_glow ?> </td>
							<td align="center">Pcs</td>
							<td>No. Batch :
								<ul style="margin-top: 0;margin-bottom: 0;">
								<?php 
									$exp_date = "";
									if (isset($kontol->kontol)) {
										foreach ($kontol->kontol as $tetek) {
											$exp_date = $tetek->expired_date_sjp_glow;
											?>
											<li>
												<?= $tetek->no_batch_sjp_glow ?> <?= (substr($tetek->no_batch_sjp_glow,-1) == 'Y') ? '- (RW QR)' : '' ?> - <?= $tetek->qty_karton_sjp_glow; ?>
											</li>
											<?php
										}
									}
								?>
								</ul> 
								ED : <?= $exp_date ?><br>
								Qty: <?= $kontol->qty_produk_glow?> Karton
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
			<td align="left"><?= $totalku = (isset($total)) ? $total : 0 ?> Karton</td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2" align="center">Total Keseluruhan</td>
			<td align="center"><?= $total_akhir ?></td>
			<td align="center">Pcs</td>
			<td align="left"><?= $total_qty ?> Karton</td>
		</tr>
		<tr>
			<td align="center" colspan="2">
				Tanda Tangan Penerima <br><br><br><br><br><br><br>
				(....................)
			</td>
			<td align="center" colspan="2">
				Security <br><br><br><br><br><br><br>
				(....................)
			</td>
			<td align="center">
				SPV Gudang <br><br><br><br><br><br><br>
				(....................)
			</td>
			<td align="right">
				Mengetahui <br> Surabaya, <?php echo date('d/m/Y', strtotime($sjp->tanggal_sjp)); ?> <br><br><br><br><br><br>
				(....................)
			</td>
		</tr>
	</table><br>
	<table border="0" width="100%" cellpadding="5" cellspacing="0">
		<tr>
			<td align="right">Print : <?= date('d/m/Y H:i:s'); ?></td>
		</tr>
	</table>
</body>
</html>