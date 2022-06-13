<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORM RETUR BAHAN</title>
    <style type="text/css">
        body{
            font-size: 12px;
            font-family: sans-serif;
        }
    </style>
</head>
<body>
    <table border="0" width="100%" cellspacing="0" cellpadding="3">
        <tr>
            <td align="center" colspan="5"><img src="./assets/img/kosme-retur.jpg" width="200px"></td>
        </tr>
        <tr>
            <td align="center" colspan="5"><h1>GOODS RETURN FORM</h3></td>
        </tr>
        <tr>
            <td width="80">No.</td>
            <td width="5" align="center">:</td>
            <td colspan="3"><?= $retur->no_retur ?></td>
        </tr>
        <tr>
            <td width="5">No. Keluhan QC</td>
            <td width="5" align="center">:</td>
            <td colspan="3"><?= $data->no_komplain ?></td>
        </tr>
        <tr>
            <td width="5">Nama Supplier</td>
            <td width="5" align="center">:</td>
            <td colspan="3"><?= $data->nama_mitra ?></td>
        </tr>
        <tr>
            <td width="5">Alamat Supplier</td>
            <td width="5" align="center">:</td>
            <td colspan="3"><?= $data->alamat_baris_1 ?></td>
        </tr>
    </table>
    <br>
    <table border="1" width="100%" cellspacing="0" cellpadding="3">
        <tr>
            <th>NO. PO</th>
            <th>TANGGAL KEDATANGAN</th>
            <!-- <th>KODE BAHAN</th> -->
            <th>NAMA BAHAN</th>
            <th>TOTAL QTY</th>
            <th>NO. BATCH</th>
            <th>STATUS</th>
            <th>TANGGAL REJECT</th>
            <th>ALASAN REJECT</th>
        </tr>
        <tr>
            <td><?= $data->no_po ?></td>
            <td><?= date('d/m/Y', strtotime($data->tanggal_kedatangan)) ?></td>
            <!-- <td><?= $data->kode_produk ?></td> -->
            <td><?= $data->nama_produk ?></td>
            <td><?= number_format($data->jumlah_kedatangan, 3,',','.') ?></td>
            <td><?= $data->no_batch_kedatangan ?></td>
            <td><?= $data->acc_qc ?></td>
            <td><?= date('d/m/Y', strtotime($data->tanggal_acc_qc)) ?></td>
            <td><?= $data->catatan_acc_qc ?></td>
        </tr>
    </table>
    <br>
    <table border="0" width="100%" cellspacing="0" cellpadding="3">
        <tr>
            <td align="justify" colspan="3" style="border: solid 1px; vertical-align: top;">Note: <br><br><br><br> &nbsp;</td>
        </tr>
        <tr>
            <td align="justify" colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td align="justify" colspan="3">Surabaya, <?= date('d/m/Y') ?></td>
        </tr>
        <tr>
            <td align="justify">
                Disetujui
                <br><br><br><br><br><br><br>
                Dept. Purchasing
            </td>
            <td align="justify">
                Mengetahui
                <br><br><br><br><br><br><br>
                Dept. Warehouse
            </td>
            <td align="justify">
                Mengetahui
                <br><br><br><br><br><br><br>
                Supplier
            </td>
            <!-- <td align="justify">
                Dikirim Oleh
                <br><br><br><br><br><br><br>
                Driver
            </td> -->
        </tr>
        <tr>
            <td align="justify" colspan="3">&nbsp;</td>
        </tr>
    </table>
    <br>
</body>
</html>