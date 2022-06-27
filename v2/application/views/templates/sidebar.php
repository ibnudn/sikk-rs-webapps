<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url() ?>">
            <div class="sidebar-brand-icon">
                <img src="<?= base_url('assets/') ?>sikk-rs_icon.ico" width="40">
            </div>
            <div class="sidebar-brand-text mx-3">SIKKRS</div>
        </a>

        <div class="sidebar-heading ">
            MENU
        </div>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <?php foreach ($menu as $m) :?>
            <?php if($m['nama_menu']." - SIKK RS" === $title) :?>
                <li class="nav-item active">
            <?php else : ?>
                <li class="nav-item">
            <?php endif; ?>
                    <a class="nav-link" href="<?= base_url($m['url']) ?>">
                        <i class="<?= $m['icon'] ?>"></i>
                        <span><?= $m['nama_menu'] ?></span></a>
                </li>
        <?php endforeach; ?>

        <!-- <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin/c_admin') ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li> -->

        <!-- Divider -->
        <!-- <hr class="sidebar-divider"> -->

        <!-- Heading -->
        <!-- <div class="sidebar-heading">
            Menu
        </div> -->

        <!-- Nav Item - Pages Collapse Menu -->
        <!-- <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin/c_users') ?>">
                <i class="fas fa-fw fa-cog"></i>
                <span>User</span></a>
        </li> -->

        <!-- Nav Item - Pages Collapse Menu -->
        <!-- <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFaskes"
                aria-expanded="true" aria-controls="collapseFaskes">
                <i class="fas fa-fw fa-hospital-alt"></i>
                <span>Faskes</span>
            </a>
            <div id="collapseFaskes" class="collapse" aria-labelledby="headingFaskes"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Menu Faskes:</h6>
                    <a class="collapse-item" href="<?= base_url('admin/c_faskes') ?>">Data Faskes</a>
                    <a class="collapse-item" href="<?= base_url('admin/c_kapasitas') ?>">Kapasitas Faskes</a>
                    <a class="collapse-item" href="<?= base_url('admin/c_ketersediaan') ?>">Ketersediaan</a>
                </div>
            </div>
        </li> -->

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->