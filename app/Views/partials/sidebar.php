<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">sVentas</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    <?php
                        if ((int)$_SESSION['role_id'] === 1) {
                            echo 'Administrador';
                        }

                        if ((int)$_SESSION['role_id'] === 2) {
                            echo 'Vendedor';
                        }
                    ?>
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/products" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Productos
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                    </a>
                </li>
                <?php if ((int)$_SESSION['role_id'] === 2) { ?>
                    <li class="nav-item">
                        <a href="/customer" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Clientes
                                <!-- <span class="right badge badge-danger">New</span> -->
                            </p>
                        </a>
                    </li>
                <?php } ?>
                <?php if ((int)$_SESSION['role_id'] === 1) { ?>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Nomina
                                <i class="fas fa-angle-left right"></i>
                                <!-- <span class="badge badge-info right">6</span> -->
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/employees" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Empleados</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/providers" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Proveedores</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/customers" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Clientes</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Ventas
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/sale" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Venta Directa</p>
                            </a>
                            <a href="/sales" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Facturas</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="/shopping" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Compras</p>
                            </a>
                        </li> -->
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            Servicios
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/UI/general.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Reportes</p>
                            </a>
                        </li>
                        <?php if ($_SESSION['role_id'] === 1) { ?>
                            <li class="nav-item">
                                <a href="pages/UI/icons.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Auditoria</p>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
