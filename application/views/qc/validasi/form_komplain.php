<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SURAT KOMPLAIN BAHAN</title>
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
            <td align="center" colspan="5"><img src="./assets/img/logo.jpg" width="150px"></td>
        </tr>
        <tr>
            <td align="center" colspan="5">&nbsp;</td>
        </tr>
        <tr>
            <td width="5">No.</td>
            <td width="5" align="center">:</td>
            <td colspan="3"><?= $data->no_komplain ?></td>
        </tr>
        <tr>
            <td width="5">Hal</td>
            <td width="5" align="center">:</td>
            <td colspan="3">Keluhan/komplain bahan <?= strtolower($data->kategori_produk) ?></td>
        </tr>
        <tr>
            <td width="5">Lamp.</td>
            <td width="5" align="center">:</td>
            <td colspan="3">1 lembar</td>
        </tr>
        <tr>
            <td align="center" colspan="5">&nbsp;</td>
        </tr>
        <tr>
            <td align="justify" colspan="5">Kepada Yth,</td>
        </tr>
        <tr>
            <td align="justify" colspan="5"><?= $data->nama_mitra ?></td>
        </tr>
        <tr>
            <td align="center" colspan="5">&nbsp;</td>
        </tr>
        <tr>
            <td align="justify" colspan="5">Dengan hormat,</td>
        </tr>
        <tr>
            <td align="justify" colspan="5">Dengan ini kami mengajukan keluhan mengenai bahan kemas yang dipasok ke PT Kosmetika Global Indonesia sebagai berikut :</td>
        </tr>
    </table>
    <br>
    <table border="0" width="90%" align="center" cellspacing="0" cellpadding="3">
        <tr>
            <td width="90">Nama Bahan</td>
            <td width="5" align="center">:</td>
            <td colspan="3"><?= $data->nama_produk ?></td>
        </tr>
        <tr>
            <td>Kode Bahan</td>
            <td width="5" align="center">:</td>
            <td colspan="3"><?= $data->kode_produk ?></td>
        </tr>
        <tr>
            <td>No. PO</td>
            <td width="5" align="center">:</td>
            <td colspan="3"><?= $data->no_po ?></td>
        </tr>
        <tr>
            <td>Supplier</td>
            <td width="5" align="center">:</td>
            <td colspan="3"><?= $data->nama_mitra ?></td>
        </tr>
        <tr>
            <td>Jumlah Kedatangan</td>
            <td width="5" align="center">:</td>
            <td colspan="3"><?= number_format($data->jumlah_kedatangan,3,',','.') ?></td>
        </tr>
        <tr>
            <td>Tanggal Kedatangan</td>
            <td width="5" align="center">:</td>
            <td colspan="3"><?= date('d/m/Y', strtotime($data->tanggal_kedatangan)) ?></td>
        </tr>
        <tr>
            <td>Keluhan</td>
            <td width="5" align="center">:</td>
            <td colspan="3"><?= $data->catatan_acc_qc ?></td>
        </tr>
    </table>
    <br>
    <table border="0" width="100%" cellspacing="0" cellpadding="3">
        <tr>
            <td align="justify" colspan="3">Bahan <?= strtolower($data->kategori_produk) ?> tersebut tidak lolos spesifikasi Quality Control dari PT.Kosmetika Global Indonesia, sehingga kami me-reject/menolak bahan tesebut dengan tindak lanjut di return/tukar guling/sortir/dll </td>
        </tr>
        <tr>
            <td align="justify" colspan="3">Atas perhatianya kami ucapkan terima kasih, dan mohon kerjasamanya. </td>
        </tr>
        <tr>
            <td align="justify" colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td align="justify" colspan="3">Surabaya, <?= date('d/m/Y') ?></td>
        </tr>
        <tr>
            <td align="justify">
                Diuji Oleh
                <br><br><br><br><br><br>
                (Analyst) <br>
                Quality Incoming
            </td>
            <td align="justify">
                Diperiksa Oleh
                <br><br><br><br><br><br>
                Noni Erlila<br>
                Quality Supervisor
            </td>
            <td align="justify">
                Disetujui Oleh
                <br>
                <img src="./assets/img/stampel.png" width="60"><br>
                R. Edy Purwanto <br>
                Quality Manager
            </td>
        </tr>
        <tr>
            <td align="justify" colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td align="justify" colspan="3">NB : Jenis/Bentuk defect tertera pada lampiran</td>
        </tr>
    </table>
    <br>
</body>
</html>