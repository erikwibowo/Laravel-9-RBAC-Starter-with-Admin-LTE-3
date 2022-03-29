<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
    <img src="{{ asset(Setting::getValue('app_logo')) }}" alt="{{ Setting::getName('app_name') }}" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">{{ Setting::getValue('app_short_name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            <img src="{{ asset('template/admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->name }} <small></small></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-legacy nav-compact" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active':'' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>@php $i = 1; @endphp
                @foreach ($modulemenus as $menus)
                    @if ($menus['menu_count'] == 1)
                        @foreach ($menus['menus'] as $menu)
                            @if ($i == 1)
                                @php
                                    $perm[] = $menu['permission'];
                                @endphp
                                @canany($perm)
                                    <li class="nav-header ml-2">MASTER DATA</li>
                                @endcanany
                            @endif
                            @can($menu['permission'])
                                <li class="nav-item">
                                    <a href="{{ route($menu['route']) }}" class="nav-link {{ request()->routeIs($menu['route']) == strtolower($menu['name']) ? 'active':'' }}">
                                        <i class="nav-icon {{ $menu['icon'] }}"></i>
                                        <p>{{ $menu['name'] }}</p>
                                    </a>
                                </li>
                            @endcan
                            @php $i++; @endphp
                        @endforeach
                    @endif
                @endforeach
                @foreach ($modulemenus as $menus)
                    @if ($menus['menu_count'] > 1)
                        @foreach ($menus['menus'] as $menu)
                            @if (count($menus['menus']) > 1)
                                @if ($loop->iteration == 1)
                                    @php
                                        $perm[] = $menu['permission'];
                                    @endphp
                                    @canany($perm)
                                        <li class="nav-header ml-2">{{ strtoupper($menus['module']) }}</li>
                                    @endcanany
                                @endif
                                @can($menu['permission'])
                                    <li class="nav-item">
                                        <a href="{{ route($menu['route']) }}" class="nav-link {{ request()->routeIs($menu['route']) == strtolower($menu['name']) ? 'active':'' }}">
                                            <i class="nav-icon {{ $menu['icon'] }}"></i>
                                            <p>{{ $menu['name'] }}</p>
                                        </a>
                                    </li>
                                @endcan
                            @endif
                        @endforeach
                    @endif
                @endforeach
                @canany(['read user', 'read role', 'read permission'])
                    <li class="nav-header ml-2">ACCESS</li>
                @endcanany
                @can('read user')
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}" class="nav-link {{ request()->routeIs('user.index') ? 'active':'' }}">
                            <i class="fas fa-user nav-icon"></i>
                            <p>User</p>
                        </a>
                    </li>
                @endcan
                @can('read role')
                    <li class="nav-item">
                        <a href="{{ route('role.index') }}" class="nav-link {{ request()->routeIs('role.index') ? 'active':'' }}">
                            <i class="fas fa-user-cog nav-icon"></i>
                            <p>Role</p>
                        </a>
                    </li>
                @endcan
                @can('read permission')
                    <li class="nav-item">
                        <a href="{{ route('permission.index') }}" class="nav-link {{ request()->routeIs('permission.index') ? 'active':'' }}">
                            <i class="fas fa-unlock nav-icon"></i>
                            <p>Permission</p>
                        </a>
                    </li>
                @endcan
                <li class="nav-header ml-2">SETTINGS</li>
                @can('read setting')
                    <li class="nav-item">
                        <a href="{{ route('setting.index') }}" class="nav-link {{ request()->routeIs('setting.index') ? 'active':'' }}">
                            <i class="fas fa-cog nav-icon"></i>
                            <p>Setting</p>
                        </a>
                    </li>
                @endcan
                @can('filemanager')
                    <li class="nav-item">
                        <a href="{{ route('filemanager') }}" class="nav-link {{ request()->routeIs('filemanager') ? 'active':'' }}">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>File Manager</p>
                        </a>
                    </li>
                @endcan
                @can('read module')
                    <li class="nav-item">
                        <a href="{{ route('module.index') }}" class="nav-link {{ request()->routeIs('module.index') ? 'active':'' }}">
                            <i class="fas fa-network-wired nav-icon"></i>
                            <p>Module</p>
                        </a>
                    </li>
                @endcan
                <li class="nav-header"></li>
                <li class="nav-item">
                <a href="#" class="nav-link bg-danger" data-toggle="modal" data-target="#modal-logout" data-backdrop="static" data-keyboard="false">
                    <i class="fas fa-sign-out-alt nav-icon"></i>
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