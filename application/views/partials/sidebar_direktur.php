 <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url().'Dashboard/index' ?>">
            <div class="sidebar-brand-text mx-3"><?php echo $akses = ($this->session->userdata('level') == 'direktur') ? 'DIREKTUR' : 'SPV PURCHASING'; ?><sup></sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <?php
            if ($this->session->userdata('level') == 'direktur') {
        ?>
         <!-- Nav Item - Pages Collapse Menu -->
         <li class="nav-item <?php if($this->session->userdata('active') == 'dashboard'){echo 'active';} ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?php echo base_url().'dashboard'; ?>">KOSME</a>
                    <a class="collapse-item" href="<?php echo base_url().'dashboard/ms'; ?>">NPD</a>
                </div>
            </div>
        </li>
        <?php
            }else{
        ?>
         <!-- Nav Item - Dashboard -->
         <li class="nav-item <?php if($this->session->userdata('active') == 'dashboard'){echo 'active';} ?>">
            <a class="nav-link" href="<?php echo base_url().'dashboard/index' ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <?php
            }
        ?>

        <!-- Nav Item - Pages Collapse Menu -->
       <li class="nav-item <?php if($this->session->userdata('active') == 'approval'){echo 'active';} ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-check"></i>
                <span>Approval</span>
            </a>
            <div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?php echo base_url().'approval/index/baku'; ?>">Bahan Baku</a>
                    <a class="collapse-item" href="<?php echo base_url().'approval/index/kemas'; ?>">Kemas</a>
                    <a class="collapse-item" href="<?php echo base_url().'approval/index/teknik'; ?>">Teknik</a>
                </div>
            </div>
        </li>

        <?php 
            if ($this->session->userdata('level') == 'direktur') {
        ?>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item <?php if($this->session->userdata('active') == 'acc'){echo 'active';} ?>">
            <a class="nav-link" href="<?php echo base_url().'acc'; ?>">
                <i class="fa fa-fw fa-search"></i>
                <span>Approval NPD</span>
            </a>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item <?php if($this->session->userdata('active') == 'glow'){echo 'active';} ?>">
            <a class="nav-link" href="<?php echo base_url().'glow/permintaan'; ?>">
                <i class="fa fa-fw fa-paper-plane"></i>
                <span>Product Request</span>
            </a>
        </li>

         <!-- Nav Item - Pages Collapse Menu -->
         <li class="nav-item <?= ($this->session->userdata('active') == 'customer' || $this->session->userdata('active') == 'brand'
                                || $this->session->userdata('active') == 'sample_awal' || $this->session->userdata('active') == 'sample'
                                || $this->session->userdata('active') == 'design' || $this->session->userdata('active') == 'sales_order'
                                || $this->session->userdata('active') == 'bom' || $this->session->userdata('active') == 'spp'
                                || $this->session->userdata('active') == 'survey' || $this->session->userdata('active') == 'komplain') ? 'active' : '' ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEight"
                aria-expanded="true" aria-controls="collapseEight">
                <i class="fas fa-fw fa-bar-chart"></i>
                <span>Marketing</span>
            </a>
            <div id="collapseEight" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Pilih Menu :</h6>
                    <a class="collapse-item" href="<?php echo base_url().'customer' ?>">Customer</a>
                    <a class="collapse-item" href="<?php echo base_url().'brand' ?>">Brand Customer</a>
                    <a class="collapse-item" href="<?php echo base_url().'sample/awal' ?>">Sample Awal</a>
                    <a class="collapse-item" href="<?php echo base_url().'sample/acc' ?>">Sample Acc</a>
                    <a class="collapse-item" href="<?php echo base_url().'design' ?>">Acc Design</a>
                    <a class="collapse-item" href="<?php echo base_url().'sales-order' ?>">Sales Order</a>
                    <a class="collapse-item" href="<?php echo base_url().'bom' ?>">Bill Of Material</a>
                    <a class="collapse-item" href="<?php echo base_url().'spp' ?>">SPP</a>
                    <a class="collapse-item" href="<?php echo base_url().'survey/data' ?>">Survey</a>
                    <a class="collapse-item" href="<?php echo base_url().'komplain/data' ?>">Customer Response</a>
            </div>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item <?= ($this->session->userdata('active') == 'mitra' || $this->session->userdata('active') == 'order' 
                                || $this->session->userdata('active') == 'estimasi' || $this->session->userdata('active') == 'order_datang' 
                                || $this->session->userdata('active') == 'riwayat_datang' ) ? 'active' : '' ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                aria-expanded="true" aria-controls="collapseThree">
                <i class="fas fa-fw fa-shopping-cart"></i>
                <span>Purchasing</span>
            </a>
            <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Supplier :</h6>
                    <a class="collapse-item" href="<?php echo base_url().'mitra/index/Baku'; ?>">Supplier Bahan Baku</a>
                    <a class="collapse-item" href="<?php echo base_url().'mitra/index/Kemas'; ?>">Supplier Bahan Kemas</a>
                    <a class="collapse-item" href="<?php echo base_url().'mitra/index/Teknik'; ?>">Supplier Teknik</a>
                    <h6 class="collapse-header">Purchase Order :</h6>
                    <a class="collapse-item" href="<?php echo base_url().'order/index/Baku'; ?>">PO Bahan Baku</a>
                    <a class="collapse-item" href="<?php echo base_url().'order/index/Kemas'; ?>">PO Bahan Kemas</a>
                    <a class="collapse-item" href="<?php echo base_url().'order/index/Teknik'; ?>">PO Teknik</a>
                    <h6 class="collapse-header">Estimasi Kedatangan :</h6>
                    <a class="collapse-item" href="<?php echo base_url().'estimasi/index/Baku'; ?>">Bahan Baku</a>
                    <a class="collapse-item" href="<?php echo base_url().'estimasi/index/Kemas'; ?>">Kemas</a>
                    <a class="collapse-item" href="<?php echo base_url().'estimasi/index/Teknik'; ?>">Teknik</a>
                    <h6 class="collapse-header">Kedatangan :</h6>
                    <a class="collapse-item" href="<?php echo base_url().'order/list_bahan/Baku'; ?>">Bahan Baku</a>
                    <a class="collapse-item" href="<?php echo base_url().'order/list_bahan/Kemas'; ?>">Kemas</a>
                    <a class="collapse-item" href="<?php echo base_url().'order/list_bahan/Teknik'; ?>">Teknik</a>
                    <h6 class="collapse-header">Riwayat Kedatangan :</h6>
                    <a class="collapse-item" href="<?php echo base_url().'order/history_kedatangan/Baku'; ?>">Bahan Baku</a>
                    <a class="collapse-item" href="<?php echo base_url().'order/history_kedatangan/Kemas'; ?>">Kemas</a>
                    <a class="collapse-item" href="<?php echo base_url().'order/history_kedatangan/Teknik'; ?>">Teknik</a>
            </div>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item <?= ($this->session->userdata('active') == 'history_qc' || $this->session->userdata('active') == 'karantina_qc') ? 'active' : '' ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSeven"
                aria-expanded="true" aria-controls="collapseSeven">
                <i class="fas fa-fw fa-lock"></i>
                <span>Quality Control</span>
            </a>
            <div id="collapseSeven" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">History Validasi :</h6>
                    <a class="collapse-item" href="<?php echo base_url().'order/history_validasi/Baku' ?>">Bahan Baku</a>
                    <a class="collapse-item" href="<?php echo base_url().'order/history_validasi/Kemas' ?>">Bahan Kemas</a>
                    <h6 class="collapse-header">Bahan Karantina :</h6>
                    <a class="collapse-item" href="<?php echo base_url().'order/list_karantina/Baku' ?>">Bahan Baku</a>
                    <a class="collapse-item" href="<?php echo base_url().'order/list_karantina/Kemas' ?>">Kemas</a>
            </div>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item <?= ($this->session->userdata('active') == 'produk' || $this->session->userdata('active') == 'mutasi' 
                            || $this->session->userdata('active') == 'sjp') ? 'active' : '' ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix"
                aria-expanded="true" aria-controls="collapseSix">
                <i class="fas fa-fw fa-truck"></i>
                <span>Warehouse</span>
            </a>
            <div id="collapseSix" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Kategori Bahan :</h6>
                    <a class="collapse-item" href="<?php echo base_url().'produk/index/Baku'; ?>">Bahan Baku</a>
                    <a class="collapse-item" href="<?php echo base_url().'produk/index/Kemas'; ?>">Bahan Kemas</a>
                    <a class="collapse-item" href="<?php echo base_url().'produk/index/Teknik'; ?>">Teknik</a>
                    <h6 class="collapse-header">Mutasi Bahan :</h6>
                    <a class="collapse-item" href="<?php echo base_url().'mutasi/index/lain' ?>">Departemen</a>
                    <a class="collapse-item" href="<?php echo base_url().'mutasi/index/penjualan' ?>">Penjualan</a>
                    <h6 class="collapse-header">Surat Jalan Pengiriman :</h6>
                    <a class="collapse-item" href="<?php echo base_url().'sjp/spp'; ?>">Marketing</a>
                    <a class="collapse-item" href="<?php echo base_url().'sjp/ms'; ?>">Ms Glow</a>
            </div>
        </li>

        <!-- Grafik -->
         <li class="nav-item <?php if($this->session->userdata('active') == 'grafik'){echo 'active';} ?>">
            <a class="nav-link" href="<?php echo base_url().'grafik'; ?>">
                <i class="fas fa-fw fa-bar-chart"></i>
                <span>Grafik</span></a>
        </li>
        <?php
            }
        ?>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->