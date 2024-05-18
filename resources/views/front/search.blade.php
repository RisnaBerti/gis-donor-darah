@php
use Carbon\Carbon;
@endphp

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
                        <button type="button" class="btn btn-primary" onclick="validateFormAndSubmit()">Cari Donor</button>
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
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr class="text-center">
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
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            @php setlocale(LC_TIME, 'id_ID.utf8') @endphp
                                            <td>{{ Carbon::parse($item->created_at)->translatedFormat('l, d F Y  H:i') }} WIB</td>    
                                            <td>{{ $item->pendonor->profile->nama }}</td>                                    
                                            <td class="text-center">{{ $item->goldar }} {{ $item->rhesus }}</td>
                                            <td class="text-center">{{ $item->jumlah }}</td>
                                            <td class="text-center">
                                                @if ($item->status === 'Pending')
                                                <span class="badge bg-light text-info">Pending</span>        
                                                @elseif (($item->status === 'Approved'))
                                                    <span class="badge bg-light text-success">Approved</span>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop{{ $loop->iteration }}">
                                                        Lihat Detail
                                                    </button>
                                                @else
                                                    <span class="badge bg-light text-danger">Rejected</span>
                                                @endif</td>
                                        </tr>

                                        <!-- Modal -->
                                        <div class="modal fade" id="staticBackdrop{{ $loop->iteration }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Riwayat Donor Darah</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="p-1 py-2">   
                                                        <div class="text-center mt-3">
                                                            <h5 class="mt-2 mb-0">{{ $item->pendonor->profile->nama }}</h5>
                                                            <span>{{ $item->pendonor->mobile }}</span>
                                                            
                                                            <div class="px-4 mt-1">
                                                                <p>{{ $item->pendonor->profile->alamat }}</p>
                                                                <p>{{ Carbon::parse($item->pendonor->profile->tanggallahir)->age }} Tahun</p>
                                                            </div>                                                        
                                                        </div>
                                                    </div>
                                                    
                                                    <hr>

                                                    <div class="row" id="heading"> 
                                                        <div class="col-4 text-center">Tanggal Donor</div> 
                                                        <div class="col-2 text-center">Donor Ke</div> 
                                                        <div class="col-2 text-center">Berat Badan</div> 
                                                        <div class="col-4 text-center">Keterangan</div> 
                                                    </div> 
                                                
                                                    @foreach ($item->pendonor->riwayat as $riwayat)
                                                        <div class="row"> 
                                                            <div class="col-4 text-center">{{ Carbon::parse($riwayat->tanggal_donor)->translatedFormat('l, d F Y  H:i') }} WIB</div> 
                                                            <div class="col-2 text-center">{{ $riwayat->donor_ke }}</div> 
                                                            <div class="col-2 text-center">{{ $riwayat->berat_badan }} KG</div> 
                                                            <div class="col-4 text-center">{{ $riwayat->keterangan }}</div> 
                                                        </div>                                           
                                                    @endforeach
                                                
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>                                            
                                                </div>
                                            </div>
                                            </div>
                                        </div>

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
    </div>

 
    <script>
        function validateFormAndSubmit() {
            // Get the jumlah input value
            var jumlah = document.getElementById('jumlah').value;

            // Check if jumlah is filled
            if (!jumlah) {
                alert("Jumlah kantong darah harus diisi.");
                return;
            }

            // Get location and submit the form if jumlah is filled
            getLocationAndSubmit();
        }

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
