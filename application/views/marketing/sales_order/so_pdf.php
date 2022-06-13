<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

	<title>Cetak SO</title>

    <style type="text/css">
        body{
            font-size: 12px;
        }
    </style>
    
</head>
<body>
	<table border="1" cellspacing="0" cellpadding="3" width="100%">
        <tr>
            <td rowspan="2" align="center"><img src="./assets/img/logo.jpg" width="150px"></td>
            <td colspan="2" align="center" style="font-weight: bold;">CATATAN SALES ORDER PRODUK<br>MARKETING</td>
            <td align="center">Halaman 1 dari 1</td>
        </tr>
        <tr>
            <td align="center" style="font-weight: bold;">Departemen<br>Marketing</td>
            <td align="center" style="font-weight: bold;">Bagian<br>Marketing</td>
            <td>
                Nomor:<br>
                CT-MK1-001-00<br><br>
                Tanggal berlaku:<br>
                10-10-2018
            </td>
        </tr>
        <tr>
            <td>
                Disusun oleh:<br><br><br><br>
                Winona Darayani<br>
                Tanggal: 01-10-2018
            </td>
            <td>
                Diperiksa oleh:<br><br><br><br>
                Wahyu Febrian<br>
                Tanggal: 04-10-2018
            </td>
            <td>
                Disetujui oleh:<br><br><br><br>
                M. Arif Sadullah<br>
                Tanggal: 05-10-2018
            </td>
            <td>
                Mengganti nomor:<br>
                -<br><br><br>
                Tanggal:<br>
                -
            </td>
        </tr>
    </table><br>
    <table cellpadding="3" cellspacing="0" width="100%" style="margin-bottom: 5px;"> 
        <tr>
            <td>Nama Customer : <?php echo $data_so->nama_customer." - ".$data_so->nama_brand_produk ?></td>
        </tr>
    </table>
    <table border="1" cellpadding="3" cellspacing="0" width="100%">
        <tr>
            <td align="center">No.</td>
            <td align="center">Tanggal</td>
            <td align="center">Nama Produk</td>
            <td align="center">Kode Produk</td>
            <td align="center">Kode Kemasan</td>
            <td align="center">Jumlah</td>
            <td align="center">Volume</td>
        </tr>
        <?php
        $no=1;
        foreach ($detail_so as $value) {
        ?>
        <tr>
            <td align="center"><?php echo $no++; ?>.</td>
            <td><?php echo date('d/m/Y',strtotime($data_so->tanggal_sales_order)); ?></td>
            <td><?php echo $value->nama_produk_acc; ?></td>
            <td></td>
            <td align="center">
                <?php  
                    $foto_parts = pathinfo($value->kode_kemas_so);
                    $foto = $foto_parts['basename'];
                    echo "<img src='./uploads/sales_order/$foto' width='100px'>";
                ?>
            </td>
            <td><?php echo number_format($value->quantity_so,0,'.','.'); ?> pcs</td>
            <td><?php echo $value->volume_produk_acc; ?></td>
        </tr>
        <?php
         } 
        ?>
    </table><br><br>
    <table border="1" width="100%" cellspacing="0" cellpadding="3">
        <tr>
            <td align="center" colspan="2">Tanggal SO Kemasan</td>
            <td align="center" colspan="2">Tanggal Acc Desain</td>
            <td align="center" colspan="2">Tanggal Acc Formula</td>
            <td align="center">Tanggal BPOM Keluar</td>
        </tr>
         <tr>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="center" rowspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td align="center" colspan="2">Order Kemasan</td>
            <td align="center" colspan="2">Acc Desain</td>
            <td align="center" colspan="2">Acc Formula</td>
        </tr>
        <tr>
            <td align="center">Marketing</td>
            <td align="center">PPIC</td>
            <td align="center">Marketing</td>
            <td align="center">PPIC</td>
            <td align="center">Marketing</td>
            <td align="center">PPIC</td>
        </tr>
        <tr>
            <td align="center" height="50px"></td>
            <td align="center" height="50px"></td>
            <td align="center" height="50px"></td>
            <td align="center" height="50px"></td>
            <td align="center" height="50px"></td>
            <td align="center" height="50px"></td>
        </tr>
    </table>
</body>
</html>