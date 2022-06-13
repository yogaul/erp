<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

	<title>Cetak PO</title>
    
</head>
<body style="border-color: black;border-width: 3px;border-style: inset; padding: 5px;">
	<table class="table table-sm table-borderless" width="100%" cellspacing="0" cellpadding="3">
		<tr>
			<th><b>&nbsp;</b></th>
			<th style="color: black; font-size: 15px;" colspan="2"><b>PURCHASE ORDER</b></th>
		</tr>
		<tr>
			<td width="400px"><img src="./assets/img/logo.jpg" height="60px"></td>
			<td style="color: black; font-size: 12px;"><b>Nomor PO<br>Tanggal PO<br>Perihal</b></td>
			<td style="color: black; font-size: 12px;"><b><?php echo $detail_po->no_po."<br>".date('d/m/Y',strtotime($detail_po->tanggal_po))."<br> PO ".strtoupper($tipe); ?>
		</tr>
		<tr>
			<td style="color: black; font-size: 12px;"><b>Info Perusahaan</b><hr></td>
			<td style="color: black; font-size: 12px;" colspan="2"><b>Order Ke</b><hr></td>
		</tr>
		<tr>
			<td style="color: black; font-size: 12px;"><b>PT.KOSMETIKA GLOBAL INDONESIA</b></td>
			<td style="color: black; font-size: 12px;" colspan="2"><b><?php echo $detail_po->nama_mitra; ?></b></td>
		</tr>
		<tr>
			<td style="color: black; font-size: 12px;">
					Jl. Rungkut Industri III No.9, Kutisari, Kec. Tenggilis Mejoyo, Kota SBY, Jawa Timur 60291
            </td>
			<td style="color: black; font-size: 12px;" colspan="2">
				<?php
                    echo $detail_po->alamat_baris_1.' '.$detail_po->telp_mitra;
                ?>
			</td>
		</tr>
		<tr>
			<td colspan="3" style="color: black; font-size: 12px;">
				Dengan hormat,<br>Berdasarkan penawaran yang telah diberikan, kami berkeinginan memesan produk dengan perincian sebagai berikut :
			</td>
		</tr>
	</table>
	<table class="table table-sm table-bordered" width="100%" border="1" cellspacing="0" celllpadding="3" style="color: black; font-size: 12px;">
            <thead>
                <tr>
                    <th style="background-color: #F29C9C;">No.</th>
                    <?php
                        if ($tipe == 'Kemas') {
                    ?>
                    <th style="background-color: #F29C9C;">Kode Kemas</th>
                    <?php
                         } 
                    ?>
                    <th style="background-color: #F29C9C;">Nama Produk</th>
                    <th style="background-color: #F29C9C;">Quantity</th>
                    <th style="background-color: #F29C9C;">Satuan</th>
                    <th style="background-color: #F29C9C;">Mata Uang</th>
                    <th style="background-color: #F29C9C;">Harga</th>
                    <th style="background-color: #F29C9C;">Kurs</th>
                    <th style="background-color: #F29C9C;">Harga Penawaran</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $i=1;
                    foreach ($detail_bahan as $value) {
                ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <?php
                            if ($tipe == 'Kemas') {
                        ?>
                        <td><?php echo $value->kode_produk; ?></td>
                        <?php
                             } 
                        ?>
                        <td><?php echo $value->nama_produk."<br>".$value->deskripsi_produk; ?></td>
                        <td><?php 
                            $str_qtty = strval($value->kuantitas);
                            if (strpos($str_qtty, '.') == TRUE) {
                                echo $value->kuantitas;
                            }else{
                                echo number_format($value->kuantitas,0,',','.');
                            }
                        ?></td>
                        <td><?php echo $value->satuan; ?></td>
                        <td><?php echo $value->mata_uang; ?></td>
                        <td><?php 
                                if($value->mata_uang == 'Rupiah'){
                                    if (strpos($value->harga, '.') !== false) {
                                       echo 'Rp.'.number_format($value->harga,2,',','.');
                                    }else{
                                        echo 'Rp.'.number_format($value->harga,0,',','.');
                                    }
                                }elseif ($value->mata_uang == 'Dollar') {
                                    if (strpos($value->harga, '.') !== false) {
                                       echo '$'.number_format($value->harga,2,',','.');
                                    }else{
                                        echo '$'.number_format($value->harga,0,',','.');
                                    }
                                }elseif ($value->mata_uang == 'RMB') {
                                    if (strpos($value->harga, '.') !== false) {
                                       echo 'RMB'.number_format($value->harga,2,',','.');
                                    }else{
                                        echo 'RMB'.number_format($value->harga,0,',','.');
                                    }
                                }else{
                                    echo '';
                                }
                            ?>    
                        </td>
                        <td><?php echo 'Rp.'.number_format($value->kurs,0,',','.'); ?></td>
                        <td>Rp.<?php echo number_format($value->jumlah,0,',','.'); ?></td>
                    </tr>
                <?php
                    }
                 ?>
                 <tr>
                 	<td colspan="<?php echo $colspan; ?>">&nbsp;</td>
                 	<td><b>Subtotal</b></td>
                 	<td>Rp. <?php echo number_format($detail_po->subtotal,0,',','.'); ?></td>
                 </tr>
                 <tr>
                 	<td colspan="<?php echo $colspan; ?>">&nbsp;</td>
                 	<td><b>Pajak(<?php echo $detail_po->jenis_pajak; ?>%)</b></td>
                 	<td>Rp. <?php echo number_format($detail_po->pajak,0,',','.'); ?></td>
                 </tr>
                 <tr>
                 	<td colspan="<?php echo $colspan; ?>">&nbsp;</td>
                 	<td><b>Total</b></td>
                 	<td>Rp. <?php echo number_format($detail_po->total_harga,0,',','.'); ?></td>
                 </tr>
            </tbody>
        </table>
        <table class="table table-sm table-borderless" style="color: black;font-size: 12px;" width="100%" cellspacing="0" cellpadding="3">
        	<tr>
        		<td>
        			Kami sangat berharap supaya bisa menerima produk tersebut sesuai dengan waktu yang telah ditentukan dan sesuai dengan spesifikasi yang Bapak/Ibu tawarkan.<br>Terima kasih atas Perhatian Bapak/Ibu.
        		</td>
        	</tr>
            <tr>
                <td><b>Catatan : </b><br><?php echo $catatan = (empty($detail_po->catatan)) ? '-' : $detail_po->catatan; ?></td>
            </tr>
        	<tr>
        		<td>
        			<b>Surabaya, <?php echo date('d/m/Y',strtotime($detail_po->tanggal_po))."<br>" ?>Hormat Kami</b>
                    <br>
                    <img src="./assets/img/ipin.JPG" width="80px"><br>
                    <b><u><?php echo $detail_po->nama_user; ?></u><br><i>Purchasing Departement</i></b>
        		</td>
        	</tr>
        </table>
</body>
</html>