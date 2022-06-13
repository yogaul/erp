<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

	<title>Cetak PO</title>
    
 	<?php $this->load->view('partials/head', FALSE); ?>
</head>
<body style="border-color: black;border-width: 3px;border-style: inset;">
	<table class="table table-sm table-borderless" width="100%" cellspacing="0" cellpadding="0">
		<tr>
			<th><b>&nbsp;</b></th>
			<th style="color: black; font-size: 15px;" colspan="2"><b>PURCHASE ORDER</b></th>
		</tr>
		<?php 
			foreach ($detail_po as $value) {
		?>
		<tr>
			<td width="400px"><img src="./assets/img/logo.jpg" height="150px"></td>
			<td style="color: black; font-size: 12px;"><b>Nomor PO<br>Tanggal PO<br>Perihal</b></td>
			<td style="color: black; font-size: 12px;"><b><?php echo $value->no_po."<br>".date('d/m/Y',strtotime($value->tanggal_po))."<br>";?><p style="margin-top: -1px;"><b>PO <?php echo strtoupper($tipe); ?></b></p></b>
			</td>
		</tr>
		<tr>
			<td style="color: black; font-size: 12px;"><b>Info Perusahaan</b><hr></td>
			<td style="color: black; font-size: 12px;" colspan="2"><b>Order Ke</b><hr></td>
		</tr>
		<tr>
			<td style="color: black; font-size: 12px;"><b>PT.KOSMETIKA GLOBAL INDONESIA</b></td>
			<td style="color: black; font-size: 12px;" colspan="2"><b><?php echo $value->nama_mitra; ?></b></td>
		</tr>
		<tr>
			<td style="color: black; font-size: 12px;">
					Jl. Perusahaan Komplek Pergudangan KL-BIZHUB 
                    No.D1 Banjararum , Singosari - Kab. Malang 65153
                    Telepon 0341 - 495603 Phone. 085231313460 www.kosme.co.id
            </td>
			<td style="color: black; font-size: 12px;" colspan="2">
				<?php
                    echo $value->alamat_baris_1;
                ?>
			</td>
		</tr>
		<tr>
			<td colspan="3" style="color: black; font-size: 12px;">
				Dengan hormat,<br>Berdasarkan penawaran yang telah diberikan, kami berkeinginan memesan produk dengan perincian sebagai berikut :
			</td>
		</tr>
		<?php
			}
		 ?>
	</table>
	<table class="table table-sm table-bordered" width="100%" cellspacing="0" celllpadding="0" style="color: black; font-size: 12px;">
            <thead>
                <tr>
                    <th style="background-color: #F29C9C;">No.</th>
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
                        <td><?php echo $value->nama_produk; ?></td>
                        <td><?php echo $value->kuantitas; ?></td>
                        <td><?php echo $value->satuan; ?></td>
                        <td><?php echo $value->mata_uang; ?></td>
                        <td><?php 
                                if($value->mata_uang == 'Rupiah'){
                                    echo 'Rp.'.number_format($value->harga);
                                }else{
                                    echo '$'.number_format($value->harga);
                                }
                            ?>    
                        </td>
                        <td><?php echo 'Rp.'.number_format($value->kurs); ?></td>
                        <td>Rp.<?php echo number_format($value->jumlah); ?></td>
                    </tr>
                <?php
                    }
                 ?>
                 <tr>
                 	<td colspan="6">&nbsp;</td>
                 	<td><b>Subtotal</b></td>
                 	<td>Rp. <?php echo number_format($value->subtotal); ?></td>
                 </tr>
                 <tr>
                 	<td colspan="6">&nbsp;</td>
                 	<td><b>Pajak(<?php echo $value->jenis_pajak; ?>%)</b></td>
                 	<td>Rp. <?php echo number_format($value->pajak); ?></td>
                 </tr>
                 <tr>
                 	<td colspan="6">&nbsp;</td>
                 	<td><b>Total</b></td>
                 	<td>Rp. <?php echo number_format($value->total_harga); ?></td>
                 </tr>
            </tbody>
        </table>
        <table class="table table-sm table-borderless" style="color: black;font-size: 12px;" width="100%" cellspacing="0" cellpadding="0">
        	<tr>
        		<td>
        			Kami sangat berharap supaya bisa menerima produk tersebut sesuai dengan waktu yangtelah ditentukan dan sesuai dengan spesifikasi yang Bapak/Ibu tawarkan.<br>Terima kasih atas Perhatian Bapak/Ibu.
        		</td>
        	</tr>
        	<tr>
        		<td>
        			<?php
        				foreach ($detail_po as $value) {
        			?>
        				<b>Malang, <?php echo date('d/m/Y',strtotime($value->tanggal_po))."<br>" ?>Hormat Kami</b>
        			<?php
        				 } 
        			?>
                    <br>
                    <img src="./assets/img/ipin.JPG" width="90px"><br>
                    <b><u>Nurul Arifin</u><br><i>Purchasing Departement</i></b>
        		</td>
        	</tr>
        </table>
</body>
</html>