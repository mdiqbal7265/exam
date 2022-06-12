        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index.php" class="brand-link">
                <img src="../assets/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Amuse Exam</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../assets/img/man.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= $admin_data['name']; ?></a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="dashboard.php" class="nav-link <?= $help->menu_active('dashboard.php'); ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="user.php" class="nav-link <?= $help->menu_active('user.php'); ?>">
                                <i class="nav-icon fas fa-user-alt"></i>
                                <p>Student</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="category.php" class="nav-link <?= $help->menu_active('category.php'); ?>">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="enroll.php" class="nav-link <?= $help->menu_active('enroll.php'); ?>">
                                <i class="nav-icon fas fa-money-check-alt"></i>
                                <p>Enroll</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="exam.php" class="nav-link <?= $help->menu_active('exam.php'); ?>">
                                <i class="nav-icon fas fa-desktop"></i>
                                <p>Exam</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="free-exam.php" class="nav-link <?= $help->menu_active('free-exam.php'); ?>">      
                                <i class="nav-icon fas fa-user-alt-slash"></i>
                                <p>Free Exam</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" id="logout" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>