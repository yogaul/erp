 <!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url().'Dashboard/index' ?>">
        <div class="sidebar-brand-text mx-3">MARKETING<sup></sup></div>
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

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php if($this->session->userdata('active') == 'customer'){echo 'active';} ?>">
        <a class="nav-link" href="<?php echo base_url().'customer/index' ?>">
            <i class="fas fa-fw fa-group"></i>
            <span>Customer</span></a>
    </li>

     <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?php if($this->session->userdata('active') == 'brand'){echo 'active';} ?>">
        <a class="nav-link" href="<?php echo base_url().'brand'; ?>">
            <i class="fa fa-fw fa-tag"></i>
            <span>Brand Customer</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?php if($this->session->userdata('active') == 'sample_awal'){echo 'active';} ?>">
        <a class="nav-link" href="<?php echo base_url().'sample/awal'; ?>">
            <i class="fa fa-fw fa-flag"></i>
            <span>Sample Awal</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?php if($this->session->userdata('active') == 'sample'){echo 'active';} ?>">
        <a class="nav-link" href="<?php echo base_url().'sample/acc'; ?>">
            <i class="fa fa-fw fa-paper-plane"></i>
            <span>Sample Acc</span>
        </a>
    </li>

       <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?php if($this->session->userdata('active') == 'design'){echo 'active';} ?>">
        <a class="nav-link" href="<?php echo base_url().'design'; ?>">
            <i class="fa fa-fw fa-pencil"></i>
            <span>Acc Design</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?php if($this->session->userdata('active') == 'sales_order'){echo 'active';} ?>">
        <a class="nav-link" href="<?php echo base_url().'sales-order'; ?>">
            <i class="fa fa-fw fa-file-text"></i>
            <span>Sales Order</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <!-- <li class="nav-item <?php if($this->session->userdata('active') == 'ingredients'){echo 'active';} ?>">
        <a class="nav-link" href="#!" onclick="coming()">
            <i class="fa fa-fw fa-flask"></i>
            <span>Acc Ingredients</span>
        </a>
    </li> -->

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?php if($this->session->userdata('active') == 'bom'){echo 'active';} ?>">
        <a class="nav-link" href="<?php echo base_url().'bom'; ?>">
            <i class="fa fa-fw fa-money"></i>
            <span>Bill Of Material</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <!-- <li class="nav-item <?php if($this->session->userdata('active') == 'kosmeproduk'){echo 'active';} ?>">
        <a class="nav-link" href="<?php echo base_url().'kosmeproduk/index'; ?>">
            <i class="fas fa-fw fa-gift"></i>
            <span>Produk</span>
        </a>
    </li> -->

     <!-- Nav Item - Pages Collapse Menu -->
   <!--  <li class="nav-item <?php if($this->session->userdata('active') == 'kategori_produk_kosme'){echo 'active';} ?>">
        <a class="nav-link" href="<?php echo base_url().'kategori/index' ?>">
            <i class="fas fa-fw fa-list"></i>
            <span>Kategori Produk</span>
        </a>
    </li> -->

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?php if($this->session->userdata('active') == 'survey'){echo 'active';} ?>">
        <a class="nav-link" href="<?php echo base_url().'survey/data'; ?>">
            <i class="fas fa-fw fa-poll"></i>
            <span>Survey</span>
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