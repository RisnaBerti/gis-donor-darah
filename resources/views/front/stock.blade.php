@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Stok Kantong Darah') }}</h1>


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

                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Jenis Darah</th>
                            <th scope="col">A</th>
                            <th scope="col">B</th>
                            <th scope="col">AB</th>
                            <th scope="col">O</th>
                            <th scope="col">Sub Total</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($stoks as $stock)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $stock->jenis_produk }}</td>
                                    <td>{{ $stock->A }}</td>
                                    <td>{{ $stock->B }}</td>
                                    <td>{{ $stock->AB }}</td>
                                    <td>{{ $stock->O }}</td>
                                    <td>{{ $stock->Subtotal }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>

                </div>            
            </div>
        </div>
    </div>

    
@endsection