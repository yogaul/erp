<div class="card shadow mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <!-- <label for="logo" class="text-primary"><b>Unggah Logo</b></label>
                <input type="file" name="logo" value="" placeholder="" class="form-control-file"> -->
                <img src="<?php echo base_url().'assets/img/logo.jpg' ?>" alt="" width="25%" class="">
            </div>
            <div class="col-4">
                <h5 class="h4 mb-2 text-primary align-left"><b>Purchase Order</b></h5>
                <div class="row">
                    <div class="col-5">
                        <p class="text-gray align-left"><b>Nomor PO<br>Tanggal PO<br>Perihal</b></p>
                    </div>
                    <div class="col-7">
                        <p class="text-gray align-left">
                            <b>
                                <?php echo $detail_po->no_po; ?><br>
                                <?php echo date("d/m/Y",strtotime($detail_po->tanggal_po)); ?><br>
                                PO <?php echo strtoupper($tipe); ?>
                            </b>
                        </p>
                    </div>
                </div> 
            </div>
        </div><br>
        <div class="row">
        <div class="col-6">
            <h1 class="h5 mb-2 text-primary"><b>Info Perusahaan</b></h1><hr>
            <h1 class="h5 mb-2 text-primary"><b>PT. KOSMETIKA GLOBAL INDONESIA</b></h1>
            <p class="text-gray align-center">Jl. Rungkut Industri III No.9, Kutisari, Kec. Tenggilis Mejoyo, Kota SBY, Jawa Timur 60291
            </p>
        </div>
        <div class="col-6">
            <h1 class="h5 mb-2 text-primary"><b>Order Ke</b></h1><hr>
            <h1 class="h5 mb-2 text-primary" id="nama_mitra"><b><?php echo $detail_po->nama_mitra; ?></b></h1>
            <p class="text-gray" id="telp_mitra">
                <?php
                        echo $detail_po->alamat_baris_1.'<br>'.$detail_po->telp_mitra;
                ?>
            </p>
            <p class="text-gray" id="email_mitra"></p>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p class="text-gray">Dengan hormat,<br>Berdasarkan penawaran yang telah diberikan, kami berkeinginan memesan produk dengan perincian sebagai berikut :</p>
        </div>
    </div>
        
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0" id="dataTable">
                <thead>
                    <tr>
                        <th>No.</th>
                        <?php 
                            if ($tipe == 'Kemas') {
                        ?>
                        <th>Kode Kemas</th>
                        <?php 
                            }
                        ?>
                        <th>Nama Produk</th>
                        <th>Quantity</th>
                        <th>Satuan</th>
                        <th>Mata Uang</th>
                        <th>Harga</th>
                        <th>Kurs</th>
                        <th>Harga Penawaran</th>
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
                </tbody>
            </table>
        </div><br>
        <div class="row">
            <div class="col-6">&nbsp;</div>
            <div class="col-6">
                <table class="table">
                    <tr>
                        <td class="align-middle"><b>Subtotal</b></td>
                        <td class="align-middle">
                        Rp.<?php echo number_format($detail_po->subtotal,0,',','.'); ?>
                        </td>
                    </tr>  
                    <tr>
                        <td class="align-middle"><b>Pajak(<?php echo $detail_po->jenis_pajak; ?>%)</b></td>
                        <td class="align-middle">
                            Rp.<?php echo number_format($detail_po->pajak,0,',','.'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle"><b>Total:</b></td>
                        <td class="align-middle">
                            Rp.<?php echo number_format($detail_po->total_harga,0,',','.'); ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row ml-0">
            <div class="col-12">
                <p class="text-gray">Kami sangat berharap supaya bisa menerima produk tersebut sesuai dengan waktu yang telah ditentukan dan sesuai dengan spesifikasi yang Bapak/Ibu tawarkan.<br>Terima kasih atas Perhatian Bapak/Ibu.</p>
            </div>
        </div>
        <div class="row ml-0">
                <div class="col-6">
                    <label for="catatan" class="text-primary"><b>Catatan</b></label>
                    <!-- <textarea name="catatan" id="ckeditor" class="ckeditor"></textarea> -->
                    <p class="text-gray"><?php echo $catatan = (empty($detail_po->catatan)) ? '-' : $detail_po->catatan ; ?></p>

                    <p class="text-gray"><b>
                        Malang, <?php echo date("d/m/Y",strtotime($detail_po->tanggal_po));?><br>
                        Hormat Kami,<br>
                    </b></p>
                    <img src="<?php echo base_url().'assets/img/ipin.JPG' ?>" width="20%" class="mb-3">
                    <p class="text-gray">
                        <b><u><?php echo $detail_po->nama_user; ?></u></b><br><i>Purchasing Departement</i>
                    </p>
                </div>
        </div>
    </div>
</div>