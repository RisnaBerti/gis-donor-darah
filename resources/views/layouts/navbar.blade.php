<nav class="navbar navbar-expand-lg navbar-light bg-theme">
    <div class="container">
      <a class="navbar-brand" href="/">Donor Darah <sup>GIS</sup></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        @if(auth()->check())
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">Home</a>
            </li>
            @if(auth()->user()->hasRole('pencaridonor'))                  
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cari') }}">Mencari Pendonor</a>
                    </li>  
            @elseif(auth()->user()->hasRole('pendonor'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('permintaan.index') }}">Permintaan Donor</a>
                    </li>  
            @endif
                 
            <li class="nav-item">
                <a class="nav-link" href="{{ route('stokdarah') }}">Stok Darah</a>
            </li>  
            <li class="nav-item">
                <a class="nav-link" href="{{ route('panel.profile') }}">Profile</a>
            </li>  
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">Keluar</a>
            </li>  
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Daftar</a>
            </li>  
        @endif
        </ul>
      </div>
    </div>
  </nav>