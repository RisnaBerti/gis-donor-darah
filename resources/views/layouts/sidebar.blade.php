<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="rotate-n-15">
            <img src="{{ asset('img/blood-donor.png') }}" class="sidebar-brand-icon" alt="">
        </div>
        <div class="sidebar-brand-text mx-3">Donor <sup>GIS</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('Dashboard') }}</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('pendonors.index') }}">
            <i class="fas fa-user-md"></i>
            <span>{{ __('Pendonor') }}</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('pencaris.index') }}">
            <i class="fas fa-user-injured"></i>
            <span>{{ __('Pencari Donor') }}</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('stokdarah.index') }}">
            <i class="fas fa-syringe"></i>
            <span>{{ __('Stock Darah') }}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        {{ __('Admin Settings') }}
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-users"></i>
            <span>{{ __('User') }}</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('roles.index') }}">
            <i class="fas fa-user-shield"></i>
            <span>{{ __('Role') }}</span></a>
    </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt"></i>
            <span>{{ __('Logout') }}</span></a>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>