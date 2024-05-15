@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Cari Pendonor Darah') }}</h1>


    @if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4">
           
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Permintaan Donor Darah</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('cari.donor') }}" method="GET" id="searchForm">
                        @csrf
                        <div class="form-group">
                            <label for="goldar">Golongan Darah</label>
                            <select class="form-control" id="goldar" name="goldar">
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="O">O</option>
                                <option value="AB">AB</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah Kantong Darah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan jumlah kantong darah" required>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="getLocationAndSubmit()">Cari Donor</button>
                        <input type="hidden" name="lat" id="lat" value="">
                        <input type="hidden" name="long" id="long" value="">
                    </form>
                </div>            
            </div>
            
        </div>
        <div class="col-xl-12 col-md-12 mb-4">
           
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Histori Permintaan</h6>
                </div>
                <div class="card-body">

                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col" width="5%">#</th>
                            <th scope="col" width="20%">Tanggal</th>
                            <th scope="col" width="20%">Pendonor</th>                            
                            <th scope="col" width="15%">Golongan Darah</th>
                            <th scope="col" width="15%">Jumlah</th>                            
                            <th scope="col" width="25%">Status</th>                      
                          </tr>
                        </thead>
                        <tbody>

                            @if ($history->isNotEmpty())
                                @foreach ($history as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        @php setlocale(LC_TIME, 'id_ID.utf8') @endphp
                                        <td>{{ strftime("%A, %d %B %Y %H:%M", strtotime($item->created_at)) }}</td>    
                                        <td>{{ $item->pendonor->profile->nama }}</td>                                    
                                        <td>{{ $item->goldar }} {{ $item->rhesus }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                        <td>
                                            @if ($item->status === 'Pending')
                                            <span class="badge bg-light text-info">Pending</span>        
                                            @elseif (($item->status === 'Approved'))
                                                <span class="badge bg-light text-success">Approved</span>
                                                <br>
                                                No Hp : {{ $item->pendonor->mobile }} <br>
                                                Alamat : {{ $item->pendonor->profile->alamat }}
                                            @else
                                                <span class="badge bg-light text-danger">Rejected</span>
                                            @endif</td>
                                    </tr>
                                @endforeach                             
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">Tidak Ada Data</td>
                                </tr>
                            @endif
                        
                        </tbody>
                      </table>

                </div>            
            </div>
        </div>
    </div>

    <script>
        function getLocationAndSubmit() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(sendLocation, handleError);
            } else {
                alert("Pakai Browser yang support lokasi.");
            }
        }

        function sendLocation(position) {
            let lat = position.coords.latitude;
            let long = position.coords.longitude;

            // Isi nilai lokasi ke input hidden pada form
            document.getElementById('lat').value = lat;
            document.getElementById('long').value = long;

            // Submit form setelah mendapatkan lokasi
            document.getElementById('searchForm').submit();
        }

        function handleError(error) {
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    alert("Anda telah memblokir izin untuk mendapatkan lokasi.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Informasi lokasi tidak tersedia.");
                    break;
                case error.TIMEOUT:
                    alert("Permintaan lokasi melebihi waktu yang diizinkan.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("Terjadi kesalahan tidak diketahui.");
                    break;
            }
        }
    </script>
    
@endsection