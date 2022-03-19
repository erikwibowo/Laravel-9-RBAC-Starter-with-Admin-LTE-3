<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('dashboard') }}" class="nav-link">{{ strtoupper(ENV('APP_NAME')) }}</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" id="btntheme" role="button">
                <i id="icontheme" class="fas fa-sun"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('index') }}" target="_bkank" role="button">
                <i class="fas fa-globe"></i>
            </a>
        </li>
    </ul>
</nav>