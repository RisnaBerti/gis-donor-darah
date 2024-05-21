 <!-- Topbar -->
 <nav class="navbar navbar-expand-lg navbar-dark bg-theme topbar mb-4 static-top shadow">
    <a class="navbar-brand" href="/">Donor Darah <sup>GIS</sup></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="{{ route('dashboard') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('order.index') }}">Permintaan Donor</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('pendonors.index') }}">Pendonor</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('pencaris.index') }}">Pencari Donor</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('stokdarah.index') }}">Stok Darah</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
            Setting
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('users.index') }}">User</a>
            <a class="dropdown-item" href="{{ route('roles.index') }}">User Roles</a>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Keluar</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
<!-- End of Topbar -->