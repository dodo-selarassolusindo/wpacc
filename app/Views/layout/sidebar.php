<!-- Main Sidebar Container -->
<!--<aside class="main-sidebar sidebar-bg-dark sidebar-color-primary shadow">-->
<aside class="main-sidebar sidebar-bg-dark sidebar-color-primary shadow">
    <div class="brand-container">
        <a href="javascript:;" class="brand-link">
            <img src="<?= base_url('asset/img/AdminLTELogo.png') ?>" alt="AdminLTE Logo" class="brand-image opacity-80 shadow">
            <span class="brand-text fw-light">Accounting v1.0</span>
        </a>
        <a class="pushmenu mx-1" data-lte-toggle="sidebar-mini" href="javascript:;" role="button"><i class="fas fa-angle-double-left"></i></a>
    </div>
    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <?php $request = \Config\Services::request(); ?>
            <!-- Sidebar Menu -->
            <ul class="nav nav-pills nav-sidebar flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="<?= site_url() ?>" class="nav-link <?= $request->uri->getSegment(1) == '' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item
                <?php
                switch ($request->uri->getSegment(1)) {
                    case 'grupakun':
                    case 'akun':
                        echo ' menu-open ';
                        break;
                }
                ?>
                ">
                    <a href="javascript:;" class="nav-link
                    <?php
                    switch ($request->uri->getSegment(1)) {
                        case 'grupakun':
                        case 'akun':
                            echo 'active';
                            break;
                    }
                    ?>
                    ">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            Master
                            <i class="end fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= site_url('grupakun') ?>" class="nav-link <?= $request->uri->getSegment(1) == 'grupakun' ? 'active' : '' ?>">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Grup Akun</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('akun') ?>" class="nav-link <?= $request->uri->getSegment(1) == 'akun' ? 'active' : '' ?>">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Akun</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>
