<!DOCTYPE html>
<html>
<head>
	<title>PT. KOSME - Penerimaan Bahan</title>
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
			<td colspan="2" align="center" style="font-weight: bold;">CATATAN PENERIMAAN BAHAN<br>AWAL DAN BAHAN KEMAS</td>
			<td>Halaman 1 dari 1</td>
		</tr>
		<tr>
			<td align="center" style="font-weight: bold;">Departemen<br>Warehouse</td>
			<td align="center" style="font-weight: bold;">Bagian<br>Supply Chain</td>
			<td>
				Nomor:<br>
				FR-WH-001-00<br>
				Tanggal Berlaku:<br>
				01-02-2020
			</td>
		</tr>
	</table><br>
	<table border="1" align="center" width="95%" cellpadding="3" cellspacing="0">
		<tr>
			<td width="180px">Nama Bahan</td>
			<td><?php echo $data_bahan->nama_produk; ?></td>
		</tr>
		<tr>
			<td>Kode Bahan</td>
			<td><?php echo $data_bahan->kode_produk; ?></td>
		</tr>
		<tr>
			<td>No. Surat Jalan</td>
			<td><?php echo $data_bahan->no_surat_jalan; ?></td>
		</tr>
		<tr>
			<td>No. Bets</td>
			<td><?php echo $data_bahan->no_batch_kedatangan; ?></td>
		</tr>
		<tr>
			<td>No. PO</td>
			<td><?php echo $data_bahan->no_po; ?></td>
		</tr>
		<tr>
			<td>Supplier</td>
			<td><?php echo $data_bahan->nama_mitra; ?></td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td><?php echo date('d/m/Y',strtotime($data_bahan->tanggal_kedatangan)); ?></td>
		</tr>
		<tr>
			<td>Kemasan</td>
			<td><?php echo $kemasan; ?></td>
		</tr>
		<tr>
			<td>Nomor Kode Kedatangan</td>
			<td><?php echo $data_bahan->kode_kedatangan; ?></td>
		</tr>
		<tr>
			<td>Jumlah</td>
			<td><?php echo $jumlah.' = '.number_format($data_bahan->jumlah_kedatangan,2,',','.'); ?> <?= ($data_bahan->kategori_produk == 'Baku') ? 'Kg' : 'Pcs' ?></td>
		</tr>
		<tr>
			<td>Expired Date</td>
			<td><?php echo $exp = (!is_null($data_bahan->expired_date) && $data_bahan->expired_date != '0000-00-00') ? date('d/m/Y',strtotime($data_bahan->expired_date)) : '-'; ?></td>
		</tr>
	</table><br>
	<table border="1" align="center" width="95%" cellpadding="3" cellspacing="0">
		<tr>
			<td align="center" style="font-weight: bold;">Pemeriksaan</td>
			<td align="center" style="font-weight: bold;" width="50px">Ya</td>
			<td align="center" style="font-weight: bold;" width="50px">Tidak</td>
			<td align="center" style="font-weight: bold;">Keterangan</td>
		</tr>
		<tr>
			<td>Ada surat jalan?</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Ada sertifikat analisa?</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Segel/kemasan utuh?</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Ada sertifikat Halal?</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Wadah bersih?</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Faktur?</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Ada kebocoran?</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Ada kerusakan?</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Label identitas ada?</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Label identitas benar?</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="4"><i>Beri tanda centang pada kolom yang sesuai</i></td>
		</tr>
		<tr>
			<td colspan="4">Kesimpulan: diterima/ditolak</td>
		</tr>
		<tr>
			<td colspan="2" align="center" height="60px" style="vertical-align: top;">(penerima)</td>
			<td colspan="2" align="center" height="50px" style="vertical-align: top;">(pengawas)</td>
		</tr>
	</table><br>
	<table border="1" align="center" width="95%" cellpadding="3" cellspacing="0">
		<tr>
			<td style="vertical-align: top;text-align: justify;" height="80px;"><b>Catatan :</b><br>
				<?php echo $data_bahan->keterangan_kedatangan; ?>
			</td>
		</tr>
	</table>
	<table border="0" align="center" width="95%" cellpadding="3" cellspacing="0">
		<tr>
			<td align="right"><?= $status ?></td>
		</tr>
	</table><br>
</body>
</html>