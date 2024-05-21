@extends('layouts.admin')

@section('main-content')
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Stok Darah</h5>
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
            <a href="{{ route('stokdarah.create') }}" class="btn btn-primary mb-3">Tambah Jenis Darah</a>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th width="5%">No</th>
                            <th width="8%">Golongan Darah</th>
                            <th width="23%">Kategori</th>
                            <th width="7%">Masa Kadaluarsa</th>  
                            <th width="7%">Suhu Simpan</th>       
                            <th width="30%">Keterangan</th>
                            <th colspan="2" width="10%">Jumlah</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stoks as $stok)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $stok->jenisDarah->goldar }} {{ $stok->jenisDarah->rhesus }}</td>
                                <td>{{ $stok->jenisDarah->kategori }}</td>
                                <td>{{ $stok->jenisDarah->masa_kadaluarsa }}</td>
                                <td>{{ $stok->jenisDarah->suhu_simpan }}</td>
                                <td>{{ $stok->jenisDarah->keterangan }}</td>
                                <td>{{ $stok->jumlah }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#confirmModal{{ $stok->id }}"><i class="fas fa-pen"></i></button>
                                </td>
                                <td>
                                    <a href="{{ route('stokdarah.show', $stok->id) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('stokdarah.edit', $stok->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                </td>
                            </tr>
                            <!-- Modal Konfirmasi -->
                            <div class="modal fade" id="confirmModal{{ $stok->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel{{ $stok->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmModalLabel{{ $stok->id }}">Form Perubahan Jumlah Stok</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('stokdarah.updatestok', $stok->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT') <!-- Menggunakan method PUT untuk update -->
                                        
                                            <div class="modal-body">
                                                <p>Update Stock Darah?</p>
                                                <input type="number" class="form-control" id="modalJumlah{{ $stok->id }}" name="jumlah" value="{{ $stok->jumlah }}">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
