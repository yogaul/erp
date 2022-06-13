 <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url().'Dashboard/index' ?>">
            <div class="sidebar-brand-text mx-3">QC KOSME<sup></sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item <?php if($this->session->userdata('active') == 'dashboard'){echo 'active';} ?>">
            <a class="nav-link" href="<?php echo base_url().'dashboard'; ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item <?php if($this->session->userdata('active') == 'order'){echo 'active';} ?>">
            <a class="nav-link" href="<?php echo base_url().'order/data-validasi'; ?>">
                <i class="fas fa-fw fa-check"></i>
                <span>Validasi</span>
            </a>
        </li>

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

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item <?php if($this->session->userdata('active') == 'karantina_qc'){echo 'active';} ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                aria-expanded="true" aria-controls="collapseThree">
                <i class="fas fa-lock"></i>
                <span>Bahan Karantina</span>
            </a>
            <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Pilih :</h6>
                    <a class="collapse-item" href="<?php echo base_url().'order/list_karantina/Baku' ?>">Bahan Baku</a>
                    <a class="collapse-item" href="<?php echo base_url().'order/list_karantina/Kemas' ?>">Kemas</a>
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
                    <!-- <a class="collapse-item" href="<?php echo base_url().'produk/index/Teknik' ?>">Teknik</a> -->
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

         <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item <?php if($this->session->userdata('active') == 'grafik'){echo 'active';} ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa fa-bar-chart"></i>
                <span>Grafik</span>
            </a>
            <div id="collapseSix" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Pilih item :</h6>
                    <a class="collapse-item" href="<?php echo base_url().'grafik/qc/baku' ?>">Bahan Baku</a>
                    <a class="collapse-item" href="<?php echo base_url().'grafik/qc/kemas' ?>">Kemas</a>
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