<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LABEL</title>
    <style type="text/css">
        table{
            /* width: 7.5cm;
            height: 3.5cm; */
			/* border:1px black solid; */
            font-size: 18px;
            font-family: sans-serif;
        }
        .tes{
            text-align: center;
            vertical-align: bottom;
            transform: rotate(90deg);
            width: 200px;
        } 
    </style>
</head>
<body>
    <?php
        foreach ($detail_kedatangan as $value) {
    ?>
    <table width="100%" border="0">
        <tr>
            <td align="left" width="10"><img src="./assets/img/new-logo.jpg" class="logo-vertical" width="70px"></td>
            <td width="270">
                LB-QC1-003-00<br>
                <?= $kedatangan->kode_produk ?><br>
                <?= $kedatangan->nama_produk ?><br>
                <?= $kedatangan->kode_kedatangan ?><br>
                <?= $kedatangan->nama_mitra ?><br>
                <?php 
                    if ($kedatangan->label_halal == 'Sudah') {
                ?>
                <br>
                <img src="./assets/img/halalku.jpg" width="100px">
                <?php
                    }else{
                ?>
                <br><br><br><br><br><br>
                <?php
                    }
                ?>
            </td>
            <td align="center">
                <?php
                    if ($kedatangan->kategori_produk == 'Baku') {
                ?>
                <?= date('d/m/Y', strtotime($kedatangan->expired_date)) ?><br>
                <?php
                    }
                ?>
                <img src="<?= $value->qr_kedatangan ?>" alt="" width="230px"><br>
                <?= number_format($value->isi_per_kemasan,2,',','.')." ".$value->satuan_kedatangan ?> <br>
            </td>
            <td class="tes">
                 <p><?= $value->id_detail_qr_kedatangan ?></p>
            </td>
        </tr>
    </table>
    <br>
    <?php
        }
    ?>
</body>
</html>