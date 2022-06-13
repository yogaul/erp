<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

	<title>Cetak SPP</title>

    <style type="text/css">
        body{
            font-size: 12px;
        }
    </style>
    
</head>
<body>
	<img src="./assets/img/logo.jpg" alt="logo" width="250px"><br><br>
    <table width="100%" cellpadding="3" cellspacing="0" border="0">
        <tr>
            <td align="center" colspan="2" style="font-size: 14px;"><b>SURAT PERINTAH PENGIRIMAN</b></td>
        </tr>
         <tr>
            <td align="center" colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td width="250px"><b>Nomor</b></td>
            <td>: <?php echo $data_spp->nomor_spp; ?></td>
        </tr>
        <tr>
            <td width="250px"><b>Nama Customer</b></td>
            <td>: <?php echo $data_spp->nama_customer; ?></td>
        </tr>
        <tr>
            <td width="250px"><b>Brand</b></td>
            <td>: <?php echo $data_spp->nama_brand_produk; ?></td>
        </tr>
        <tr>
            <td width="250px"><b>No.Telp</b></td>
            <td>: <?php echo $data_spp->no_telp_spp; ?></td>
        </tr>
        <tr>
            <td width="250px"><b>Alamat Pengiriman</b></td>
            <td>: <?php echo $data_spp->alamat_pengiriman_spp; ?></td>
        </tr>
    </table><br>
    <table width="100%" cellpadding="3" cellspacing="0" border="1">
        <tr>
            <th style="background-color: #F29C9C;" align="center">No.</th>
            <th style="background-color: #F29C9C;" align="center">Produk</th>
            <th style="background-color: #F29C9C;" align="center">Volume</th>
            <th style="background-color: #F29C9C;" align="center">Qty</th>
            <th style="background-color: #F29C9C;" align="center">Tanggal Pengiriman</th>
        </tr>
        <?php 
        $no = 1;
        foreach ($detail_spp as $value) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $value->nama_produk_acc; ?></td>
            <td><?php echo $value->volume_produk_acc; ?></td>
            <td><?php echo number_format($value->quantity_spp,0,'.','.'); ?></td>
            <td><?php echo date('d/m/Y',strtotime($value->tanggal_kirim_spp)); ?></td>
        </tr>
        <?php
        }
        ?>
    </table><br>
    <table width="100%" cellpadding="3" cellspacing="0" border="1">
        <tr>
            <td><b>Note :</b><br><?php echo $data_spp->catatan_spp; ?></td>
        </tr>
    </table><br>
    <table width="100%" cellpadding="3" cellspacing="0" border="0">
        <tr>
            <td width="300px"><b>Marketing</b></td>
            <td width="300px"><b>PPIC</b></td>
            <td width="300px"><b>Warehouse</b></td>
        </tr>
    </table>
</body>
</html>