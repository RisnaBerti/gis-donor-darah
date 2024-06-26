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
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('Home') }}</span></a>
    </li>


    @auth
        @if(auth()->user()->hasRole('pencaridonor'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cari') }}">
                    <i class="fas fa-hand-holding-water"></i>
                    <span>{{ __('Cari Donor Darah') }}</span>
                </a>
            </li>
        @elseif(auth()->user()->hasRole('pendonor'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('permintaan.index') }}">
                    <i class="fas fa-hand-holding-water"></i>
                    <span>{{ __('Permintaan Donor') }}</span>
                </a>
            </li>
        @endif
    @endauth

    
    <li class="nav-item">
        <a class="nav-link" href="{{ route('stokdarah') }}">
            <i class="fas fa-syringe"></i>
            <span>{{ __('Stock Darah') }}</span></a>
    </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <li class="nav-item">
        <a class="nav-link" href="{{ route('panel.profile') }}">
            <i class="fas fa-user-cog"></i>
            <span>{{ __('Profile') }}</span></a>
    </li>

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