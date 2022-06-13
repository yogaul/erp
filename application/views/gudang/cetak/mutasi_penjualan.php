<!DOCTYPE html>
<html>
<head>
	<title>PT. KOSME - Mutasi Penjualan</title>
	<style type="text/css">
		body{
			font-size: 12px;
            font-family: sans-serif;
		}
	</style>
</head>
<body>
    <table border="1" width="100%" cellpadding="5" cellspacing="0">
            <tr>
                <td width="300">
                    <img src="./assets/img/logo.jpg" width="200px"><br>
                    <b style="font-size: 14px;">PT. KOSMETIKA GLOBAL INDONESIA</b><br>
                    Jl. Rungkut Industri III No.9, Kutisari Kecamatan Tenggilis Mejoyo, Kota Surabaya.<br>
                    Telp  : 0341-495603, FAX : 0341-4378850<br>
                    Email : kosmetikaglobal.id@gmail.com<br>
                    NPWP  : -
                </td>
                <td>
                    <center><b style="font-size: 16px;vertical-align: text-top;">SURAT JALAN</b></center><br>
                    No : <?php echo $mutasi_penjualan->no_sjp_penjualan; ?><br>
				    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date('H:i'); ?><br><br><br><br><br><br>
                </td>
            </tr>
            <tr>
                <td>
                    Pembeli <br>
                    Nama Toko : <?= $mutasi_penjualan->nama_tujuan_pengiriman ?><br>
                    Alamat    : <?php echo ''; ?>
                </td>
                <td>
                    No. PO       : <br>
                    Alamat Kirim : <?php echo $mutasi_penjualan->alamat_pengiriman; ?>
                </td>
            </tr>
    </table>
    <br>
	<table border="1" align="center" width="95%" cellpadding="3" cellspacing="0">
        <tr align="center">
            <th>Kode Bahan</th>
            <th>Nama Bahan</th>
            <th>No. Analisa</th>
            <th>Supplier</th>
            <th>Kuantiti (Kg)</th>
            <th>Sistem</th>
        </tr>
        <?php
            foreach ($detail_mutasi_penjualan as $value) {
        ?>
        <tr>
            <td align="center"><?= $value->kode_produk ?></td>
            <td><?= $value->nama_produk ?></td>
            <td><?= $value->kode_kedatangan ?></td>
            <td><?= $value->nama_mitra ?></td>
            <td align="center"><?= number_format($value->diserahkan_penjualan,3,',','.'); ?></td>
             <td></td>
        </tr>
        <?php   
            }
        ?>
	</table><br>
	<table border="1" align="center" width="95%" cellpadding="3" cellspacing="0">
            <td align="center">
				Tanda Tangan Penerima <br><br><br><br><br><br><br>
				(....................)
			</td>
			<td align="center">
				Security <br><br><br><br><br><br><br>
				(....................)
			</td>
			<td align="center" colspan="2">
				SPV Gudang <br><br><br><br><br><br><br>
				(....................)
			</td>
			<td align="right">
				Mengetahui <br> Surabaya, <?php echo date('d/m/Y'); ?> <br><br><br><br><br><br>
				(....................)
			</td>
	</table><br>
	<table border="0" align="center" width="95%" cellpadding="3" cellspacing="0">
        <tr>
            <td colspan="5" align="right"><b>Print</b> : <?= date('d/m/Y H:i:s') ?></td>
        </tr>
	</table><br>
</body>
</html>