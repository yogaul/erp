 <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url().'Dashboard/index' ?>">
            <div class="sidebar-brand-text mx-3">RnD<sup></sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item <?php if($this->session->userdata('active') == 'dashboard'){echo 'active';} ?>">
            <a class="nav-link" href="<?php echo base_url().'dashboard/index' ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

         <!-- Nav Item - Dashboard -->
         <li class="nav-item <?php if($this->session->userdata('active') == 'glow'){echo 'active';} ?>">
            <a class="nav-link" href="<?php echo base_url().'glow' ?>">
                <i class="fas fa-fw fa-gift"></i>
                <span>Produk Jadi</span></a>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item <?php if($this->session->userdata('active') == 'sample_awal'){echo 'active';} ?>">
            <a class="nav-link" href="<?php echo base_url().'sample/awal'; ?>">
                <i class="fas fa-fw fa-flag"></i>
                <span>Sample Awal</span>
            </a>
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