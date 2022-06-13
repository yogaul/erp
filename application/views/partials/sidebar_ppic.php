 <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url().'Dashboard/index' ?>">
            <div class="sidebar-brand-text mx-3">PPIC<sup></sup></div>
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
                </div>
            </div>
        </li>

         <!-- Nav Item - Dashboard -->
         <li class="nav-item <?php if($this->session->userdata('active') == 'glow'){echo 'active';} ?>">
            <a class="nav-link" href="<?php echo base_url().'glow' ?>">
                <i class="fas fa-fw fa-gift"></i>
                <span>Produk Jadi</span></a>
        </li>

         <!-- Nav Item - Dashboard -->
         <li class="nav-item <?php if($this->session->userdata('active') == 'kalkulator'){echo 'active';} ?>">
            <a class="nav-link" href="<?php echo base_url().'kalkulator' ?>">
                <i class="fas fa-fw fa-calculator"></i>
                <span>MPS Calculator</span></a>
        </li>

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
        <li class="nav-item <?php if($this->session->userdata('active') == 'request'){echo 'active';} ?>">
            <a class="nav-link" href="<?php echo base_url().'glow/permintaan'; ?>">
                <i class="fa fa-fw fa-paper-plane"></i>
                <span>Product Request</span>
            </a>
        </li>
        
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->