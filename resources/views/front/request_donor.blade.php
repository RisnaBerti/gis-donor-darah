@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Permintaan Donor Darah') }}</h1>


    <div class="row"> 
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

                            @if ($requests->isNotEmpty())
                                @foreach ($requests as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        @php setlocale(LC_TIME, 'id_ID.utf8') @endphp
                                        <td>{{ strftime("%A, %d %B %Y %H:%M", strtotime($item->created_at)) }}</td>    
                                        <td>{{ $item->pencari->profile->nama }}</td>                                    
                                        <td>{{ $item->goldar }} {{ $item->rhesus }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                        <td>
                                            @if ($item->status === 'Pending')
                                            <span class="badge bg-light text-info">Pending</span>        
                                            @elseif (($item->status === 'Approved'))
                                                <span class="badge bg-light text-success">Approved</span>
                                                <br>
                                                No Hp : {{ $item->pencari->mobile }} <br>
                                                Alamat : {{ $item->pencari->profile->alamat }}
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

@endsection