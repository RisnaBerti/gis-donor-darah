@extends('layouts.user')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Pemetaan Pendonor Darah Tetap') }}</h1>


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
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">

                    @include('widget.map')

                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">A<img src="{{ asset('img/a.png') }}" class="icon-type" alt=""> B<img src="{{ asset('img/b.png') }}" alt=""> AB<img src="{{ asset('img/ab.png') }}" alt="">  O<img src="{{ asset('img/o.png') }}" alt=""></li>
                  </ul>
            </div>
        </div>
    </div>

    
@endsection