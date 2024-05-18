@php
use Carbon\Carbon;
@endphp

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
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col">Jenis Darah</th>
                                <th scope="col" colspan="2">A</th>
                                <th scope="col" colspan="2">B</th>
                                <th scope="col" colspan="2">AB</th>
                                <th scope="col" colspan="2">O</th>
                                <th scope="col">Sub Total</th>
                            </tr>
                            </thead>
                            <tbody>                          
                                @foreach ($stoks as $stock)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>                                    
                                        <td>{{ $stock->jenis_produk }}</td>
                                        <td class="text-center">{{ json_decode($stock->A)->jumlah }} </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-primary" 
                                                {{ (is_null(json_decode($stock->A)->jumlah) || json_decode($stock->A)->jumlah == 0) ? 'disabled' : '' }} 
                                                data-toggle="modal" 
                                                data-target="#requestModal" 
                                                data-id="{{ json_decode($stock->A)->id }}" 
                                                data-max="{{ json_decode($stock->A)->jumlah }}">
                                                Request
                                            </button>
                                            </td>                                  
                                        <td class="text-center">{{ json_decode($stock->B)->jumlah }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-primary" 
                                                {{ (is_null(json_decode($stock->B)->jumlah) || json_decode($stock->B)->jumlah == 0) ? 'disabled' : '' }} 
                                                data-toggle="modal" 
                                                data-target="#requestModal" 
                                                data-id="{{ json_decode($stock->B)->id }}" 
                                                data-max="{{ json_decode($stock->B)->jumlah }}">
                                                Request
                                            </button>
                                            </td>   
                                        <td class="text-center">{{ json_decode($stock->AB)->jumlah }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-primary" 
                                                {{ (is_null(json_decode($stock->AB)->jumlah) || json_decode($stock->AB)->jumlah == 0) ? 'disabled' : '' }} 
                                                data-toggle="modal" 
                                                data-target="#requestModal" 
                                                data-id="{{ json_decode($stock->AB)->id }}" 
                                                data-max="{{ json_decode($stock->AB)->jumlah }}">
                                                Request
                                            </button>
                                            </td>   
                                        <td class="text-center">{{ json_decode($stock->O)->jumlah }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-primary" 
                                                {{ (is_null(json_decode($stock->O)->jumlah) || json_decode($stock->O)->jumlah == 0) ? 'disabled' : '' }} 
                                                data-toggle="modal" 
                                                data-target="#requestModal" 
                                                data-id="{{ json_decode($stock->O)->id }}" 
                                                data-max="{{ json_decode($stock->O)->jumlah }}">
                                                Request
                                            </button>
                                            </td>   
                                        <td class="text-center">{{ $stock->Subtotal }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> 
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
                                <th scope="col" width="15%">Golongan Darah</th>
                                <th scope="col" width="15%">Jumlah</th> 
                                <th scope="col" width="30%">Keterangan</th>                            
                                <th scope="col" width="15%">Status</th>                      
                            </tr>
                            </thead>
                            <tbody>

                                @if ($history->isNotEmpty())
                                    @foreach ($history as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            @php setlocale(LC_TIME, 'id_ID.utf8') @endphp
                                            <td>{{ Carbon::parse($item->created_at)->translatedFormat('l, d F Y  H:i') }} WIB</td>                                                                       
                                            <td class="text-center">{{ $item->goldar }} {{ $item->rhesus }}</td>
                                            <td class="text-center">{{ $item->jumlah }}</td>
                                            <td class="text-center">{{ json_decode($item->keterangan)->kategori }}</td>
                                            <td class="text-center">
                                                @if ($item->status === 'Pending')
                                                <span class="badge bg-light text-info">Pending</span>        
                                                @elseif (($item->status === 'Approved'))
                                                    <span class="badge bg-light text-success">Approved</span>                                               
                                                @else
                                                    <span class="badge bg-light text-danger">Rejected</span>
                                                @endif</td>
                                        </tr>
                                    @endforeach                             
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak Ada Data</td>
                                    </tr>
                                @endif
                            
                            </tbody>
                        </table>
                    </div> 
                </div>            
            </div>
        </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="requestModal" tabindex="-1" aria-labelledby="requestModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="requestModalLabel">Request Stok Darah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="requestForm" method="POST" action="{{ route('stok.request') }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="stok_id" id="stok_id">
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" class="form-control" name="jumlah" id="jumlah" max="0" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Request</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#requestModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var stokId = button.data('id'); // Extract info from data-* attributes
            var maxJumlah = button.data('max');

            var modal = $(this);
            modal.find('.modal-body #stok_id').val(stokId);
            modal.find('.modal-body #jumlah').attr('max', maxJumlah);
        });
    });
</script>

    
@endsection