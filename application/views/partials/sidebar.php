 <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url().'Dashboard/index' ?>">
            <div class="sidebar-brand-text mx-3">PURCHASING<sup></sup></div>
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
        <li class="nav-item <?php if($this->session->userdata('active') == 'mitra'){echo 'active';} ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-group"></i>
                <span>Supplier</span>
            </a>
            <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Pilih tipe order:</h6>
                    <a class="collapse-item" href="<?php echo base_url().'mitra/index/Baku' ?>">Supplier Bahan Baku</a>
                    <a class="collapse-item" href="<?php echo base_url().'mitra/index/Kemas' ?>">Supplier Kemas</a>
                    <a class="collapse-item" href="<?php echo base_url().'mitra/index/Teknik' ?>">Supplier Teknik</a>
                </div>
            </div>
        </li>

         <!-- Nav Item - Pages Collapse Menu -->
        <!-- <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="far fa-file-alt"></i>
                <span>Invoice</span>
            </a>
            <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Pilih tipe invoice:</h6>
                    <a class="collapse-item" href="<?php echo base_url().'Invoice/index' ?>">Invoice Pembelian</a>
                </div>
            </div>
        </li> -->

         <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item <?php if($this->session->userdata('active') == 'order'){echo 'active';} ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-shopping-cart"></i>
                <span>Purchase Order</span>
            </a>
            <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Pilih tipe order:</h6>
                    <a class="collapse-item" href="<?php echo base_url().'Order/index/Baku' ?>">PO Bahan Baku</a>
                    <a class="collapse-item" href="<?php echo base_url().'Order/index/Kemas' ?>">PO Kemas</a>
                    <a class="collapse-item" href="<?php echo base_url().'Order/index/Teknik' ?>">PO Teknik</a>
                </div>
            </div>
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
                    <a class="collapse-item" href="<?php echo base_url().'produk/index/Kemas' ?>">Kemas</a>
                    <a class="collapse-item" href="<?php echo base_url().'produk/index/Teknik' ?>">Teknik</a>
                   <!--  <a class="collapse-item" href="<?php echo base_url().'produk/index' ?>">Bahan Baku</a> -->
                   <!--  <a class="collapse-item" href="<?php echo base_url().'kategori/index' ?>">Kategori Bahan Baku</a> -->
                </div>
            </div>
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

        <!-- Nav Item - Dashboard -->
       <!--  <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url().'Biaya/index' ?>">
                <i class="far fa-file"></i>
                <span>Biaya</span></a>
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
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-gift"></i>
            <span>Barang Datang</span>
            </a>
            <div id="collapseSix" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Pilih tipe barang:</h6>
                    <a class="collapse-item" href="<?php echo base_url().'Order/list_bahan/Baku' ?>">Bahan Baku</a>
                    <a class="collapse-item" href="<?php echo base_url().'Order/list_bahan/Kemas' ?>">Kemas</a>
                    <a class="collapse-item" href="<?php echo base_url().'Order/list_bahan/Teknik' ?>">Teknik</a>
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

        <!-- Nav Item - Barang Datang -->
        <li class="nav-item <?php if($this->session->userdata('active') == 'grafik'){echo 'active';} ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNine"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-bar-chart"></i>
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

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item <?php if($this->session->userdata('active') == 'glow'){echo 'active';} ?>">
            <a class="nav-link" href="<?php echo base_url().'glow/permintaan'; ?>">
                <i class="fa fa-fw fa-paper-plane"></i>
                <span>Product Request</span>
            </a>
        </li>

        <!-- Nav Item - Master Kategori -->
       <!--  <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url().'Order/bahan_datang' ?>">
                <i class="fas fa-gift"></i>
                <span>Master</span></a>
        </li> -->

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->