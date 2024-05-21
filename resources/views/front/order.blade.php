@php
use Carbon\Carbon;
@endphp

@extends('layouts.user')

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

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    <div class="row">        
        <div class="col-xl-12 col-md-12 mb-4">
      
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pencarian Pendonor Golongan Darah {{ request('goldar') }}</h6>
                </div>
                <div class="card-body text-center">
                    <form method="POST" action="{{ route('store.order') }}">
                        @csrf
                        <table class="table">
                            <tr>
                                <th width="5%">No</th>
                                <th width="20%">Nama</th>
                                <th width="10%">Jarak</th>
                                <th width="30%">Alamat</th>
                                <th width="20%">Donor Terakhir</th>
                                <th width="15%">Status</th>
                            </tr>
                           
                            @foreach($donors as $donor)                            
                             <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $donor->profile->nama }}</td>
                                <td>{{ number_format($donor->distance, 2, ',', ' ') }} KM</td>
                                <td>{{ $donor->profile->alamat }}</td>
                                <td>
                                    @if ($latestDonor = $donor->riwayat->sortByDesc('tanggal_donor')->first())
                                        {{ Carbon::parse($latestDonor->tanggal_donor)->translatedFormat('l, d F Y') }} 
                                    @else
                                        Belum Pernah Donor
                                    @endif
                                <td>
                                    <div class="radio-tile-group">  
                                    
                                        <div class="input-container">
                                            <input class="radio-button" type="radio" name="pendonor_id" value="{{ $donor->id }}" id="donor_{{ $donor->id }}" required>  
                                            <div class="radio-tile">       
                                                <label for="donor_{{ $donor->id }}" class="radio-tile-label">Pilih</label>
                                            </div>
                                        </div>
                                    
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            <input type="hidden" name="goldar" value="{{ request('goldar') }}">
                            <input type="hidden" name="jumlah" value="{{ request('jumlah') }}">
                            <input type="hidden" name="pencari_id" value="{{ Auth::id(); }}">

                            <hr>
                        </table>
                        <button type="submit" class="btn btn-info">Kirim Request</button>
                    </form>
                </div>            
            </div>
            
        </div>    
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div id="map" style="height: 500px;"></div>

                    <script>
                        let map, activeInfoWindow, markers = [];

                           function initMap() {

                                var latnow = {{ $latnow }};
                                var longnow = {{ $longnow }};

                                map = new google.maps.Map(document.getElementById("map"), {
                                    center: {                        
                                        lat: -7.5250637,
                                        lng: 109.1148251,
                                    },
                                    zoom: 10
                                });

                                var bounds = new google.maps.LatLngBounds();

                                // Tambahkan lokasi pencari ke bounds
                                var currentLocation = new google.maps.LatLng(latnow, longnow);
                                bounds.extend(currentLocation);

                                map.addListener("click", function(event) {
                                    mapClicked(event);
                                });

                                const marker = new google.maps.Marker({
                                    position: { lat: latnow, lng: longnow },
                                    label: 'Lokasi Anda',
                                    map
                                });

                                initMarkers();
                            }

                            function initMarkers() {
                                const initialMarkers = <?php echo json_encode($markPendonor); ?>;

                                for (let index = 0; index < initialMarkers.length; index++) {

                                    const markerData = initialMarkers[index];
                                    const marker = new google.maps.Marker({
                                        position: markerData.position,
                                        label: markerData.label,
                                        draggable: markerData.draggable,
                                        icon:markerData.icon,
                                        map
                                    });
                                    markers.push(marker);

                                    const infowindow = new google.maps.InfoWindow({
                                        content: `<b>${markerData.title}</b>`,
                                    });
                                    marker.addListener("click", (event) => {
                                        if(activeInfoWindow) {
                                            activeInfoWindow.close();
                                        }
                                        infowindow.open({
                                            anchor: marker,
                                            shouldFocus: false,
                                            map
                                        });
                                        activeInfoWindow = infowindow;
                                        markerClicked(marker, index);
                                    });

                                    marker.addListener("dragend", (event) => {
                                        markerDragEnd(event, index);
                                    });
                                }

                                // Sesuaikan peta ke semua marker
                                 map.fitBounds(bounds);
                            }
                    </script>
                
                <script type = "text/javascript" src = "https://maps.google.com/maps/api/js?key={{ env('GMAPS_API_KEY') }}&callback=initMap" > </script>

                </div>                
            </div>
        </div>    
    </div>

    
@endsection
