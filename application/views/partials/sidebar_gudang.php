 <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url().'Dashboard/index' ?>">
            <div class="sidebar-brand-text mx-3">WAREHOUSE<sup></sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item <?php if($this->session->userdata('active') == 'dashboard'){echo 'active';} ?>">
            <a class="nav-link" href="<?php echo base_url().'dashboard/index' ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item <?php if($this->session->userdata('active') == 'produk'){echo 'active';} ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa fa-list-alt"></i>
                <span>Kategori Barang</span>
            </a>
            <div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Pilih item kategori:</h6>
                    <a class="collapse-item" href="<?php echo base_url().'produk/index/Baku' ?>">Bahan Baku</a>
                    <a class="collapse-item" href="<?php echo base_url().'produk/index/Kemas' ?>">Bahan Kemas</a>
                </div>
            </div>
        </li>

         <!-- Nav Item - Dashboard -->
         <li class="nav-item <?php if($this->session->userdata('active') == 'glow'){echo 'active';} ?>">
            <a class="nav-link" href="<?php echo base_url().'glow' ?>">
                <i class="fas fa-fw fa-gift"></i>
                <span>Produk Jadi</span></a>
        </li>

        <!-- Nav Item - Barang Datang -->
        <li class="nav-item <?php if($this->session->userdata('active') == 'sertem'){echo 'active';} ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMasuk"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-balance-scale"></i>
            <span>Serah Terima</span>
            </a>
            <div id="collapseMasuk" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Pilih tipe produk:</h6>
                    <a class="collapse-item" href="<?php echo base_url().'sertem/data/glow' ?>">MS Glow</a>
                    <a class="collapse-item" onclick="coming()">OEM</a>
                </div>
            </div>
        </li>

         <!-- Nav Item - Mutasi -->
         <li class="nav-item <?php if($this->session->userdata('active') == 'mutasi'){echo 'active';} ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMutasi"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-dolly"></i>
            <span>Mutasi Barang</span>
            </a>
            <div id="collapseMutasi" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Pilih kategori:</h6>
                    <a class="collapse-item" href="<?php echo base_url().'mutasi/index/lain' ?>">Departemen</a>
                    <a class="collapse-item" href="<?php echo base_url().'mutasi/index/penjualan' ?>">Penjualan</a>
                </div>
            </div>
        </li>

         <!-- Nav Item - Dashboard -->
         <li class="nav-item <?php if($this->session->userdata('active') == 'scan'){echo 'active';} ?>">
            <a class="nav-link" href="<?php echo base_url().'scan' ?>">
                <i class="fas fa-fw fa-qrcode"></i>
                <span>Scan Barang</span></a>
        </li>

         <!-- Nav Item - Pages Collapse Menu -->
         <!-- <li class="nav-item <?php if($this->session->userdata('active') == 'log'){echo 'active';} ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLog"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa fa-book"></i>
                <span>Log Mutasi Barang</span>
            </a>
            <div id="collapseLog" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Pilih item :</h6>
                    <a class="collapse-item" href="<?php echo base_url().'mlog/index/baku'; ?>">Bahan Baku</a>
                    <a class="collapse-item" href="<?php echo base_url().'mlog/index/kemas'; ?>">Kemas</a>
                    <a class="collapse-item" href="<?php echo base_url().'mlog/index/teknik'; ?>">Teknik</a>
                </div>
            </div>
        </li> -->


         <!-- Nav Item - Pages Collapse Menu -->
        <!-- <li class="nav-item <?php if($this->session->userdata('active') == 'mutasi'){echo 'active';} ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-dolly"></i>
                <span>Mutasi Barang</span>
            </a>
            <div id="collapseSix" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Pilih tipe barang :</h6>
                    <a class="collapse-item" href="<?php echo base_url().'mutasi/index/Baku' ?>">Bahan Baku</a>
                    <a class="collapse-item" href="<?php echo base_url().'mutasi/index/Kemas' ?>">Kemas</a>
                    <a class="collapse-item" href="<?php echo base_url().'mutasi/index/Lain' ?>">Lain-lain</a>
                </div>
            </div>
        </li> -->

         <!-- Nav Item - Barang Datang -->
         <li class="nav-item <?php if($this->session->userdata('active') == 'estimasi'){echo 'active';} ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEstimasi"
            aria-expanded="true" aria-controls="collapseEstimasi">
            <i class="fas fa-clock"></i>
            <span>Estimasi Barang Datang</span>
            </a>
            <div id="collapseEstimasi" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Pilih tipe barang:</h6>
                    <a class="collapse-item" href="<?php echo base_url().'estimasi/index/Baku'; ?>">Bahan Baku</a>
                    <a class="collapse-item" href="<?php echo base_url().'estimasi/index/Kemas'; ?>">Kemas</a>
                    <a class="collapse-item" href="<?php echo base_url().'estimasi/index/Teknik'; ?>">Teknik</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Barang Datang -->
        <li class="nav-item <?php if($this->session->userdata('active') == 'order_datang'){echo 'active';} ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSeven"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-gift"></i>
            <span>Barang Datang</span>
            </a>
            <div id="collapseSeven" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Pilih tipe barang:</h6>
                    <a class="collapse-item" href="<?php echo base_url().'Order/bahan_datang/Baku' ?>">Bahan Baku</a>
                    <a class="collapse-item" href="<?php echo base_url().'Order/bahan_datang/Kemas' ?>">Bahan Kemas</a>
                </div>
            </div>
        </li>

         <!-- Nav Item - Barang Datang -->
        <li class="nav-item <?php if($this->session->userdata('active') == 'riwayat_datang'){echo 'active';} ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEight"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-history"></i>
            <span>Riwayat Kedatangan</span>
            </a>
            <div id="collapseEight" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Pilih tipe barang:</h6>
                    <a class="collapse-item" href="<?php echo base_url().'Order/history_kedatangan/Baku' ?>">Bahan Baku</a>
                    <a class="collapse-item" href="<?php echo base_url().'Order/history_kedatangan/Kemas' ?>">Kemas</a>
                    <a class="collapse-item" href="<?php echo base_url().'Order/history_kedatangan/Teknik' ?>">Teknik</a>
                </div>
            </div>
        </li>

        <?php
            if ($this->session->userdata('level') == 'gudang') {
        ?>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item <?php if($this->session->userdata('active') == 'history_qc'){echo 'active';} ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-history"></i>
                <span>History Validasi</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Pilih tipe history:</h6>
                    <a class="collapse-item" href="<?php echo base_url().'order/history_validasi/Baku' ?>">Bahan Baku</a>
                    <a class="collapse-item" href="<?php echo base_url().'order/history_validasi/Kemas' ?>">Kemas</a>
                </div>
            </div>
        </li>
        <?php
            }
        ?>

        <!-- Nav Item - Barang Datang -->
        <li class="nav-item <?php if($this->session->userdata('active') == 'sjp'){echo 'active';} ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTen"
        aria-expanded="true" aria-controls="collapseTen">
        <i class="fas fa-fw fa-file"></i>
        <span>Surat Jalan Pengiriman</span>
        </a>
        <div id="collapseTen" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pilih tipe:</h6>
                <a class="collapse-item" href="<?php echo base_url().'sjp/spp'; ?>">Marketing</a>
                <a class="collapse-item" href="<?php echo base_url().'sjp/ms'; ?>">Ms Glow</a>
            </div>
        </div>
        </li>

         <!-- Nav Item - Dashboard -->
         <li class="nav-item <?php if($this->session->userdata('active') == 'tujuan'){echo 'active';} ?>">
            <a class="nav-link" href="<?php echo base_url().'tujuan' ?>">
                <i class="fas fa-fw fa-truck"></i>
                <span>Tujuan Pengiriman</span></a>
        </li>

         <!-- Nav Item - Pages Collapse Menu -->
         <li class="nav-item <?php if($this->session->userdata('active') == 'request'){echo 'active';} ?>">
            <a class="nav-link" href="<?php echo base_url().'glow/permintaan'; ?>">
                <i class="fa fa-fw fa-paper-plane"></i>
                <span>Product Request</span>
            </a>
        </li>

        <!-- Nav Item - Barang Datang -->
        <li class="nav-item <?php if($this->session->userdata('active') == 'grafik'){echo 'active';} ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNine"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-bar-chart"></i>
            <span>Grafik</span>
            </a>
            <div id="collapseNine" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Pilih tipe:</h6>
                    <a class="collapse-item" href="<?php echo base_url().'grafik/lead/baku'; ?>">Bahan Baku</a>
                    <a class="collapse-item" href="<?php echo base_url().'grafik/lead/kemas'; ?>">Kemas</a>
                    <a class="collapse-item" href="<?php echo base_url().'grafik/lead/teknik'; ?>">Teknik</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->