
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title." - ".ENV('APP_NAME') }}</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/admin/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <!-- Preloader -->
            <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__shake" src="{{ asset('template/admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
            </div>

            <!-- Navbar -->
            @include('admin.layouts.navbar')
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            @include('admin.layouts.sidebar')

            <!-- Content Wrapper. Contains page content -->
            @yield('content')
            <!-- /.content-wrapper -->
            @yield('modal')
            @include('admin.layouts.modal')
            @include('sweetalert::alert')
            @include('admin.layouts.footer')
        </div>
        <!-- ./wrapper -->
        <!-- jQuery -->
        <script src="{{ asset('template/admin/plugins/jquery/jquery.min.js') }}"></script>
        @yield('js')
        @include('admin.layouts.script')
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset('template/admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <!-- DataTables  & Plugins -->
        <script src="{{ asset('template/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('template/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('template/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- overlayScrollbars -->
        <script src="{{ asset('template/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('template/admin/dist/js/adminlte.js') }}"></script>
    </body>
</html>