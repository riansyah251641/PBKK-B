<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url()   ?>">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-book"></i>
                </div>
                <div class="sidebar-brand-text mx-3">PBKK-B Book-Store</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?= base_url() ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                KATEGORI BUKU
            </div>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(''); ?>">
                    <i class="fas fa-fw fa-book-open"></i>
                    <span>Semua Kategori</span></a>
            </li>
            <?php foreach ($kat as $k) { ?>
                <!-- Nav Item - Tables -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('index/');
                                                echo $k->id ?>">
                        <i class="fas fa-fw fa-book"></i>
                        <span><?= $k->nama_kategori ?></span></a>
                </li>
            <?php } ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <?php if (!empty($this->session->userdata('id_konsumen'))) { ?>
                <div class="sidebar-heading">
                    User Menu
                </div>

                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('dashboard/menuu') ?>">
                        <i class="fas fa-fw fa-file"></i>
                        <span>Riwayat Pembelian</span></a>
                </li>


                <hr class="sidebar-divider d-none d-md-block">

            <?php } ?>
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>



        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <?php if (!empty($this->session->userdata('id_konsumen'))) { ?>
                            <div class="navbar">
                                <ul class="nav navbar-nav navbar-right">
                                    <li>
                                        <?php $keranjang = '<i class="fa fa-shopping-cart"></i> : ' . count($this->cart->contents()) .
                                            ' items' ?>
                                        <?php echo anchor('dashboard/detail_keranjang', $keranjang)  ?>
                                    </li>
                                </ul>
                            </div>


                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Selamat Datang , <?= $this->session->userdata('username'); ?></span>
                                    <?php foreach ($us as $u) { ?>
                                        <img class="img-profile rounded-circle" src="<?= base_url('upload/member/');
                                                                                        echo $u->foto ?>">
                                    <?php } ?>
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Settings
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Activity Log
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?= base_url('login/logout') ?>">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>
                        <?php } else { ?>



                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#login">
                                    <i class="fa fa-sign-in-alt"></i> Login
                                </a>
                                <!-- Dropdown - User Information -->

                            </li>
                        <?php } ?>
                    </ul>

                </nav>
                <!-- End of Topbar -->