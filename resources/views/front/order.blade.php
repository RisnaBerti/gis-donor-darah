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
                    <h6 class="m-0 font-weight-bold text-primary">Pencarian Pendonor Darah</h6>
                </div>
                <div class="card-body">
                    <ul>
                        @foreach($donors as $donor)
                           <li>{{ $donor->nik }} / {{ $donor->profile->nama }} ==== {{ number_format($donor->distance, 2, ',', ' ') }} KM</li>
                        @endforeach
                    </ul>
                </div>            
            </div>
            
        </div>        
    </div>

    
@endsection
