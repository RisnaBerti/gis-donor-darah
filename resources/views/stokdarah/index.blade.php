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
                        <tr>
                            <th>No</th>
                            <th>Golongan Darah</th>
                            <th>Kategori</th>
                            <th>Masa Kadaluarsa</th>  
                            <th>Suhu Simpan</th>       
                            <th>Keterangan</th>
                            <th colspan="2">Jumlah</th>
                            <th>Aksi</th>
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
                                <td>{{ $stok->jumlah  }}</td><td><button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#confirmModal"><i class="fas fa-pen"></i></button></td>
                                <td>
                                    <a href="{{ route('stokdarah.show', $stok->id) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('stokdarah.edit', $stok->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('stokdarah.destroy', $stok->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this stock?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


     <!-- Modal Konfirmasi -->
     <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Form Perubahan Jumlah Stok</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('stokdarah.updatestok', $stok->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PUT') <!-- Menggunakan method PUT untuk update -->
                
                    <div class="modal-body">
                        <p>Update Stock Darah?</p>
                        <input type="number" class="form-control" id="modalJumlah" name="jumlah">
                    </div>
                    <div class="modal-footer">
                     
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
               
            </div>
        </div>
    </div>

@endsection


