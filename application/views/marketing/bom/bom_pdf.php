<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

	<title>Cetak BOM</title>
    
</head>
<body>
	<img src="./assets/img/logo.jpg" alt="logo" width="300px" style="margin-bottom: 10px;">
    <table border="1" width="100%" cellspacing="0" cellpadding="3">
        <tr>
            <td align="center" colspan="14" style="background-color: #ffdede; color: black; font-weight: bold;">BOM (Bill Of Materials)</td>
        </tr>
        <tr style="font-weight: bold;">
            <td rowspan="2" align="center">No PO</td>
            <td rowspan="2" align="center">Nama Customer</td>
            <td rowspan="2" align="center">Nama Produk</td>
            <td colspan="2" align="center">Shrink</td>
            <td rowspan="2" align="center">Inner Box</td>
            <td colspan="2" align="center">Label</td>
            <td colspan="2" align="center">Karton</td>
            <td rowspan="2" align="center">Lain-lain</td>
            <td rowspan="2" align="center">Coding</td>
            <td rowspan="2" align="center">Status</td>
            <td rowspan="2" align="center">Foto Desain</td>
        </tr>
        <tr style="font-weight: bold;">
            <td align="center">Kemasan Primer</td>
            <td align="center">Inner Box</td>
            <td align="center">Printing</td>
            <td align="center">Sticker</td>
            <td align="center">Kosme</td>
            <td align="center">Polos</td>
        </tr>
        <?php
        $i = 0;
        foreach ($detail_bom as $value) {
        ?>
        <tr>
            <?php
                if($i == 0){
                    ?>
                        <td align="center" rowspan="<?php echo $num_produk; ?>"><?php echo $data_bom->no_po_bom; ?></td>
                        <td align="center" rowspan="<?php echo $num_produk; ?>"><?php echo $data_bom->nama_customer; ?></td>
                    <?php
                }
                $i++;
            ?>
            <td align="center"><?php echo $value->nama_produk_acc; ?></td>
            <td align="center"><?php echo $status_primer = ($value->shrink_bom == 'Kemasan Primer') ? 'v' : '-'; ?></td>
            <td align="center"><?php echo $status_primer_inner = ($value->shrink_bom == 'Inner Box') ? 'v' : '-'; ?></td>
            <td align="center"><?php echo $status_inner = ($value->inner_box_bom == 'Iya') ? 'v' : '-'; ?></td>
            <td align="center"><?php echo $status_sticker = ($value->label_bom == 'Printing') ? 'v' : '-'; ?></td>
            <td align="center"><?php echo $status_printing = ($value->label_bom == 'Sticker') ? 'v' : '-'; ?></td>
            <td align="center"><?php echo $status_kosme = ($value->karton_bom == 'Kosme') ? 'v' : '-'; ?></td>
            <td align="center"><?php echo $status_polos = ($value->karton_bom == 'Polos') ? 'v' : '-'; ?></td>
            <td align="center"><?php echo $value->lain_lain_bom; ?></td>
            <td align="center"><?php echo $status_coding = ($value->coding_bom == 'Iya') ? 'v' : '-'; ?></td>
            <td align="center"><?php echo $value->ro_bom; ?></td>
            <td align="center">
                <?php  
                    $foto_parts = pathinfo($value->foto_desain_bom);
                    $foto = $foto_parts['basename'];
                    echo "<img src='./uploads/desain_bom/$foto' width='50px'>";
                ?>
            </td>
        <?php
         } 
        ?>
    </table>
</body>
</html>