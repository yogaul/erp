<!DOCTYPE html>
<html>
<head>
	<title>PT. KOSME - Mutasi Bahan</title>
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
			<td colspan="2" align="center" style="font-weight: bold;">CATATAN SERAH TERIMA <br> BAHAN <?= strtoupper($kategori) ?></td>
			<td>Halaman 1 dari 1</td>
		</tr>
		<tr>
			<td align="center" style="font-weight: bold;">Departemen<br>Warehouse</td>
			<td align="center" style="font-weight: bold;">Bagian<br>Supply Chain</td>
			<td>
				Nomor:<br>
				FR-WH-00<?= ($kategori == 'Baku') ? '8' : '4' ?>-00<br>
				Tanggal Berlaku:<br>
				01-02-2018
			</td>
		</tr>
	</table><br>
    <table border="1" align="center" width="95%" cellpadding="3" cellspacing="0">
        <tr>
            <td width="100"><b>HARI/TANGGAL</b></td>
            <td><?= date('d/m/Y', strtotime($mutasi_lain->tanggal_mutasi_lain)) ?></td>
            <td  width="100"><b>TIM/SHIFT</b></td>
            <td><?= $mutasi_lain->shift_mutasi_lain ?></td>
        </tr>
    </table><br>
    <table border="0" align="center" width="95%" cellpadding="3" cellspacing="0">
        <tr>
            <td><b><?= strtoupper($mutasi_lain->keterangan_mutasi_lain) ?></td>
        </tr>
    </table><br>
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
            foreach ($detail_mutasi_lain as $value) {
        ?>
        <tr>
            <td align="center"><?= $value->kode_produk ?></td>
            <td><?= $value->nama_produk ?></td>
            <td><?= $value->kode_kedatangan ?></td>
            <td><?= $value->nama_mitra ?></td>
            <td align="center">
                <?php 
                    if (strpos($mutasi_lain->keterangan_mutasi_lain,'PENYERAHAN') == TRUE || strpos($mutasi_lain->keterangan_mutasi_lain,'ERAH') == TRUE || 
                                strpos($mutasi_lain->keterangan_mutasi_lain,'PENGIRIMAN') == TRUE || 
                                strpos($mutasi_lain->keterangan_mutasi_lain,'IRIM') == TRUE || strpos($mutasi_lain->keterangan_mutasi_lain,'REWORK') == TRUE) {
                        if (strpos($value->diserahkan,'.') == TRUE) {
                            echo number_format($value->diserahkan,3,',','.');
                        }else{
                            echo number_format($value->diserahkan,0,',','.');
                        }
                    }elseif (strpos($mutasi_lain->keterangan_mutasi_lain,'PENGEMBALIAN') == TRUE || strpos($mutasi_lain->keterangan_mutasi_lain,'MBAL') == TRUE || 
                                strpos($mutasi_lain->keterangan_mutasi_lain,'MBALI') == TRUE) {
                        if (strpos($value->dikembalikan,'.') == TRUE) {
                            echo number_format($value->dikembalikan,3,',','.');
                        }else{
                            echo number_format($value->dikembalikan,0,',','.');
                        }
                    }
                ?>
             </td>
             <td></td>
        </tr>
        <?php   
            }
        ?>
	</table><br>
	<table border="1" align="center" width="95%" cellpadding="3" cellspacing="0">
		<tr>
			<td style="vertical-align: top;text-align: center;"><b>PIC Bahan Baku</b></td>
			<td style="vertical-align: top;text-align: center;"><b>Checker Bahan Baku</b></td>
			<td style="vertical-align: top;text-align: center;"><b>Produksi/Supplyman</b></td>
			<td style="vertical-align: top;text-align: center;"><b>Admin Gudang</b></td>
			<td style="vertical-align: top;text-align: center;"><b>Leader Bahan Baku</b></td>
		</tr>
        <tr>
			<td style="height: 80px;">&nbsp;</td>
			<td style="height: 80px;">&nbsp;</td>
			<td style="height: 80px;">&nbsp;</td>
			<td style="height: 80px;">&nbsp;</td>
			<td style="height: 80px;">&nbsp;</td>
		</tr>
	</table><br>
	<table border="0" align="center" width="95%" cellpadding="3" cellspacing="0">
        <tr>
            <td align="left"><b>ID</b> : <?= $mutasi_lain->id_mutasi_lain ?></td>
            <td align="right"><b>Print</b> : <?= date('d/m/Y H:i:s') ?></td>
        </tr>
	</table><br>
</body>
</html>