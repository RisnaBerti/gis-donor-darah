@extends('layouts.admin')

@section('main-content')
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Request Pencarian</h5>
        </div>
        @if (session('success'))
            <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger border-left-danger" role="alert">
                <ul class="pl-4 my-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card-body">
            <div class="table-responsive">
             
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th width="5%">No</th>
                            <th width="15%">Pencari</th>
                            <th width="12%">Golongan Darah</th>
                            <th width="15%">Jumlah</th>
                            <th width="15%">Sumber</th>
                            <th width="20%">Tanggal</th>
                            <th width="18%">Aksi</th>                          
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td><a href="{{ route('pencaris.show', ['user' => $order->pencari->id]) }}">{{$order->pencari->profile->nama}}</a></td>
                                <td class="text-center">{{$order->goldar}} {{$order->rhesus}}</td>
                                <td class="text-center">{{$order->jumlah}}</td>
                                <td>
                                    @if ($order->pendonor)
                                        <a href="{{ route('pendonors.show', ['user' => $order->pendonor->id]) }}">{{$order->pendonor->profile->nama}}</a>
                                    @else
                                        Stok Darah <br> {{ json_decode($order->keterangan)->kategori }}
                                    @endif                                    
                                </td>
                                <td>{{ strftime("%A, %d %B %Y %H:%M", strtotime($order->created_at)) }}</td>
                                <td class="text-center">
                                    @if ($order->status === 'Pending')
                                    <span class="d-none">Pending</span>

                                    <form action="{{ route('order.approve', $order->id) }}" method="post" class="d-inline"
                                        onsubmit="return confirm('Permintaan Donor disetujui?')">
                                        @csrf
                                        @method('POST')
                            
                                        <button type="submit" class="btn btn-success">Setujui</button>
                                    </form>

                                    <form action="{{ route('order.reject', $order->id) }}" method="post" class="d-inline"
                                        onsubmit="return confirm('Permintaan Donor ditolak?')">
                                        @csrf
                                        @method('POST')
                            
                                        <button type="submit" class="btn btn-danger">Tolak</button>
                                    </form>
                                     
                                    @elseif (($order->status === 'Approved'))
                                        <span class="badge bg-light text-success">Approved</span>
                                    @else
                                        <span class="badge bg-light text-danger">Rejected</span>
                                    @endif
                                </td>                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

