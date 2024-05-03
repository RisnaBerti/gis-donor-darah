@extends('layouts.admin')

@section('main-content')
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Riwayat Donor {{ $user->nik }}</h5>
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
            <button type="button" class="btn btn-primary my-3" data-toggle="modal" data-target="#riwayatModal">Tambah Riwayat</button>
            <a href="{{ route('pendonors.index') }}" class="btn btn-secondary my-3">Kembali</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Donor Ke</th>
                            <th>Tanggal Donor</th>
                            <th>Berat Badan</th>
                            <th>Keterangan</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($riwayat as $history)
                            <td>{{ $history->user->profile->nama }}</td>
                            <td>{{ $history->donor_ke }}</td>
                            <td>{{ date("d M Y", strtotime($history->tanggal_donor)) }}</td>
                            <td>{{ $history->berat_badan }} KG</td>
                            <td>{{ $history->keterangan  }}</td>                           
                        @endforeach                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    
     <!-- Modal Konfirmasi -->
     <div class="modal fade" id="riwayatModal" tabindex="-1" role="dialog" aria-labelledby="riwayatModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="riwayatModalLabel">Tambah Riwayat Donor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pendonors.addRiwayat') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="tanggal_donor">Tanggal Donor</label>
                            <input type="date" class="form-control" id="tanggal_donor" name="tanggal_donor">
                        </div>
                        <div class="form-group">
                            <label for="berat_badan">Berat Badan</label>
                            <input type="number" step="0.01" class="form-control" id="berat_badan" name="berat_badan">
                        </div>
                        <div class="form-group">
                            <label for="donor_ke">Donor Ke Berapa?</label>
                            <input type="number" class="form-control" id="donor_ke" name="donor_ke">
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                        </div>
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <button type="submit" class="btn btn-primary">Tambah Riwayat</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


