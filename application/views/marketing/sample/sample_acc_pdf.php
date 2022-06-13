<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

	<title>Cetak Sample Acc</title> 

    <style type="text/css">
        body{
            font-size: 12px;
        }
    </style>
</head>
<body>
	<table border="1" cellspacing="0" cellpadding="3" width="100%">
     <tr>
         <td rowspan="2" width="200px" align="center"><img src="./assets/img/logo.jpg" alt="logo" width="150px"></td>
         <td align="center" rowspan="2" colspan="2" style="font-weight: bold;" width="400px">FORMULIR PENERIMAAN ORDER PRODUK</td>
         <td style="font-weight: bold;">Halaman 1</td>
     </tr>   
     <tr>
         <td>*Diisi oleh marketing</td>
     </tr>
     <tr>
         <td colspan="4" align="center"><b>A.IDENTITAS CUSTOMER</b></td>
     </tr>
     <tr>
         <td>Nama marketing</td>
         <td colspan="3">: <?php echo $sample->nama_user; ?></td>
     </tr>
      <tr>
         <td>Nama customer</td>
         <td colspan="3">: <?php echo $sample->nama_customer; ?></td>
     </tr>
      <tr>
         <td>Nama perusahaan</td>
         <td colspan="3">: <?php echo $sample->nama_perusahaan_customer; ?></td>
     </tr>
      <tr>
         <td>Jabatan customer</td>
         <td colspan="3">: <?php echo $sample->jabatan_customer; ?></td>
     </tr>
      <tr>
         <td>Alamat perusahaan dan kirim</td>
         <td colspan="3">: <?php echo $sample->alamat_perusahaan_kirim; ?></td>
     </tr>
      <tr>
         <td>Nomor telp customer</td>
         <td colspan="3">: <?php echo $sample->telp_customer; ?></td>
     </tr>
      <tr>
         <td>Nomor telp perusahaan</td>
         <td colspan="3">: <?php echo $sample->telp_perusahaan_customer; ?></td>
     </tr>
     <tr>
         <td rowspan="13" align="center">Deskripsi permintaan produk</td>
         <td>Nama produk</td>
         <td colspan="2">: <?php echo $sample->nama_produk_acc; ?></td>
     </tr>
     <tr>
         <td>Deskripsi logo</td>
         <td colspan="2">: <?php echo $sample->deskripsi_logo_acc; ?></td>
     </tr>
     <tr>
         <td>Desain logo</td>
         <td colspan="2">: <?php echo "-"; ?></td>
     </tr>
     <tr>
         <td>Nama merk</td>
         <td colspan="2">: <?php echo $sample->nama_brand_produk; ?></td>
     </tr>
     <tr>
         <td>Merk terdaftar HAKI</td>
         <td colspan="2">: <?php echo $sample->merk_daftar_haki_acc; ?></td>
     </tr>
     <tr>
         <td>Daftar HAKI oleh KOSME</td>
         <td colspan="2">: <?php echo $sample->daftar_haki_kosme_acc; ?></td>
     </tr>
     <tr>
         <td>Produk daftar halal</td>
         <td colspan="2">: <?php echo $sample->produk_daftar_halal_acc; ?></td>
     </tr>
     <tr>
         <td>Desain kemasan</td>
         <td colspan="2">: <?php echo "-"; ?></td>
     </tr>
     <tr>
         <td>Jenis kemasan</td>
         <td colspan="2">: <?php echo $sample->jenis_kemasan_acc; ?></td>
     </tr>
     <tr>
         <td>Warna kemasan primer</td>
         <td colspan="2">: <?php echo $sample->warna_kemasan_primer_acc; ?></td>
     </tr>
     <tr>
         <td>Volume/berat</td>
         <td colspan="2">: <?php echo $sample->volume_produk_acc; ?></td>
     </tr>
     <tr>
         <td>Tema kemasan</td>
         <td colspan="2">: <?php echo $sample->tema_kemasan_acc; ?></td>
     </tr>
     <tr>
         <td>Target launching</td>
         <td colspan="2">: <?php echo date('d/m/Y',strtotime($sample->target_launching_acc)); ?></td>
     </tr>
    </table><br><br><br>
    <table width="100%" border="0" cellspacing="0">
        <tr>
            <td>Dibuat Oleh <br><br><br><br> Marketing</td>
            <td width="200px">&nbsp;</td>
            <td>Paraf Customer <br><br><br><br> Customer</td>
        </tr>
    </table><br>
    <table border="1" cellspacing="0" cellpadding="3" width="100%">
        <tr>
             <td rowspan="2" width="200px" align="center"><img src="./assets/img/logo.jpg" alt="logo" width="150px"></td>
             <td align="center" rowspan="2" style="font-weight: bold;" width="400px">FORMULIR PENERIMAAN ORDER PRODUK</td>
             <td style="font-weight: bold;">Halaman 1</td>
        </tr>   
        <tr>
             <td>*Diisi oleh marketing</td>
        </tr>
        <tr>
             <td colspan="3" align="center"><b>B.DESKRIPSI DETAIL PRODUK</b></td>
        </tr>
        <tr>
             <td>Deskripsi Permintaan Sample</td>
             <td colspan="2">: <?php echo "-"; ?></td>
        </tr>
        <tr>
             <td>Target harga</td>
             <td colspan="2">: <?php echo "Rp.".number_format($sample->target_harga_acc,0,'.','.'); ?></td>
        </tr>
        <tr>
             <td>Jenis dan bentuk sediaan</td>
             <td colspan="2">: <?php echo $sample->jenis_bentuk_acc; ?></td>
        </tr>
        <tr>
             <td>Bahan aktif</td>
             <td colspan="2">: <?php echo $sample->bahan_aktif_acc; ?></td>
        </tr>
        <tr>
             <td>Spesifikasi</td>
             <td colspan="2">: <?php echo "-"; ?></td>
        </tr>
        <tr>
             <td>Info tambahan</td>
             <td colspan="2">: <?php echo $sample->info_tambahan_acc; ?></td>
        </tr>
    </table><br><br><br>
    <table width="100%" border="0" cellspacing="0">
        <tr>
            <td>Dibuat Oleh <br><br><br><br> Marketing</td>
            <td width="200px">&nbsp;</td>
            <td>Paraf Customer <br><br><br><br> Customer</td>
        </tr>
    </table>
</body>
</html>