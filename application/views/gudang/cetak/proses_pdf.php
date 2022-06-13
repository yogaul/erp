<!DOCTYPE html>
<html>
<head>

	<title>PT. KOSME - Proses Bahan</title>

	<style type="text/css">
		body{
			font-size: 12px;
			font-family: sans-serif;
		}
	</style>

</head>
<body>
	<table border="1" cellpadding="3" cellspacing="0" width="100%">
		<tr>
			<td rowspan="2" align="center" width="130px"><img src="./assets/img/logo.jpg" width="150px"></td>
			<td colspan="2" align="center" style="font-weight: bold;">CATATAN PROSES PENERIMAAN<br>BAHAN AWAL DAN BAHAN KEMAS</td>
			<td>Halaman 1 dari 1</td>
		</tr>
		<tr>
			<td align="center" style="font-weight: bold;">Departemen<br>Warehouse</td>
			<td align="center" style="font-weight: bold;">Bagian<br>Supply Chain</td>
			<td>
				Nomor:<br>
				FR-WH-002-00<br>
				Tanggal Berlaku:<br>
				01-02-2020
			</td>
		</tr>
	</table><br>
	<table border="1" align="center" width="95%" cellpadding="3" cellspacing="0">
		<tr>
			<td width="180px" style="font-weight: bold;">No. Antrian</td>
			<td align="center" style="font-weight: bold;">U</td>
			<td align="center" style="font-weight: bold;">P</td>
			<td width="200px"><?php echo date('d/m/Y').' - '.$no_urut; ?></td>
			<td style="font-weight: bold;">Waktu</td>
			<td width="150px"><?php echo date('H:i'); ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Nama Supplier</td>
			<td colspan="5"><?php echo $data_po->nama_mitra; ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">No. Surat Jalan</td>
			<td colspan="5"><?php echo $no_surat_jalan; ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">No. Purchase Order (PO)</td>
			<td colspan="5"><?php echo $data_po->no_po; ?></td>
		</tr>
	</table><br>
	<table border="1" align="center" width="95%" cellpadding="3" cellspacing="0">
		<tr>
			<td align="center" style="font-weight: bold;">Qty</td>
			<td align="center" style="font-weight: bold;">Nama Bahan Sesuai PO Purchasing</td>
			<td align="center" style="font-weight: bold;">No. Batch</td>
			<td align="center" style="font-weight: bold;">Isi/Kemasan</td>
			<td align="center" style="font-weight: bold;">Total</td>
			<td align="center" style="font-weight: bold;">Expired Date</td>
			<td align="center" style="font-weight: bold;" width="80px">Status</td>
			<td align="center" style="font-weight: bold;">Paraf & Tanggal Lulus/Reject</td>
		</tr>
		<?php 
			foreach ($data_detail as $value) {
		?>
		<tr>
			<td>&nbsp;</td>
			<td><?php echo $value->nama_produk; ?></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td>
				<input type="checkbox" id="lulus" name="lulus" style="vertical-align: middle;">
				<label for="lulus" style="vertical-align: middle; font-weight: bold;">Lulus</label><br>
				<input type="checkbox" id="reject" name="reject" style="vertical-align: middle;">
				<label for="reject" style="vertical-align: middle; font-weight: bold;">Reject</label>
			</td>
			<td></td>
		</tr>
		<?php
			}
		?>
	</table><br>
	<table border="1" align="center" width="95%" cellpadding="3" cellspacing="0">
		<tr>
			<td style="vertical-align: top;text-align: left;" height="60px;"><b>Catatan :</b></td>
		</tr>
	</table><br>
	<table border="1" align="center" width="95%" cellpadding="3" cellspacing="0">
		<tr>
			<td align="center" style="font-weight: bold;" width="60px">Security</td>
			<td align="center" style="font-weight: bold;" width="60px">Picker/Checker</td>
			<td align="center" style="font-weight: bold;" width="60px">Admin Gudang</td>
			<td align="center" style="font-weight: bold;" width="60px">PIC Bahan Baku/Kemasan</td>
			<td align="center" style="font-weight: bold;" width="60px">Leader/Supervisor</td>
		</tr>
		<tr>
			<td height="60px">&nbsp;</td>
			<td height="60px">&nbsp;</td>
			<td height="60px">&nbsp;</td>
			<td height="60px">&nbsp;</td>
			<td height="60px">&nbsp;</td>
		</tr>
	</table>
	<table align="center" width="95%" cellpadding="3" cellspacing="0">
		<tr>
			<td align="right"><i>*admin gudang (putih); pic bahan baku/kemasan (merah); security (kuning)</i></td>
		</tr>
	</table>
</body>
</html>