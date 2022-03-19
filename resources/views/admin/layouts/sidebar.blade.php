<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
    <img src="{{ asset('template/admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">{{ ENV('APP_NAME') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            <img src="{{ asset('template/admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->name }} <small>({{ implode(",", Auth::user()->getRoleNames()->toArray()) }})</small></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active':'' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('user.index', 'role.index', 'permission.index') ? 'menu-open':'' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('user.index', 'role.index', 'permission.index') ? 'active':'' }}">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Master Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('read user', User::class)
                            <li class="nav-item">
                                <a href="{{ route('user.index') }}" class="nav-link {{ request()->routeIs('user.index') ? 'active':'' }}">
                                    <i class="fas fa-user nav-icon"></i>
                                    <p>User</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                    <ul class="nav nav-treeview">
                        @can('read role', Role::class)
                            <li class="nav-item">
                                <a href="{{ route('role.index') }}" class="nav-link {{ request()->routeIs('role.index') ? 'active':'' }}">
                                    <i class="fas fa-user-cog nav-icon"></i>
                                    <p>Role</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                    <ul class="nav nav-treeview">
                        @can('read permission', Permission::class)
                            <li class="nav-item">
                                <a href="{{ route('permission.index') }}" class="nav-link {{ request()->routeIs('permission.index') ? 'active':'' }}">
                                    <i class="fas fa-unlock nav-icon"></i>
                                    <p>Permission</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                <li class="nav-header"></li>
                <li class="nav-item">
                <a href="#" class="nav-link bg-danger" data-toggle="modal" data-target="#modal-logout" data-backdrop="static" data-keyboard="false">
                    <i class="fas fa-lock nav-icon"></i>
                    <p>KELUAR</p>
                </a>
                </li>
                <li class="nav-header"></li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>