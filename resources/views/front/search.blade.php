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
                    <form action="{{ route('cari.donor') }}" method="GET">
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
                            <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan jumlah kantong darah">
                        </div>
                        <button type="submit" class="btn btn-primary">Cari Donor</button>
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
                            <th scope="col">#</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Golongan Darah</th>
                            <th scope="col">Jumlah</th>                            
                            <th scope="col">Status</th>                      
                          </tr>
                        </thead>
                        <tbody>

                            @if ($history->isNotEmpty())
                                @foreach ($history as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->create_at }}</td>
                                        <td>{{ $item->goldar }} {{ $item->rhesus }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                        <td>{{ $item->status }}</td>
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

    
@endsection