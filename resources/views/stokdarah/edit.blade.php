@extends('layouts.admin')

@section('main-content')
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Update Stok Darah</h5>
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
            <form action="{{ route('stokdarah.update', $stokdarah->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <!-- Update stok darah information -->
                <div class="form-group">
                    <label for="golongan_darah">Golongan Darah</label>
                    <select id="golongan_darah" class="form-control" name="golongan_darah">
                        <option value="">Pilih Golongan Darah</option>
                        <option value="A" {{ $stokdarah->jenisdarah->goldar == 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ $stokdarah->jenisdarah->goldar == 'B' ? 'selected' : '' }}>B</option>
                        <option value="AB" {{ $stokdarah->jenisdarah->goldar == 'AB' ? 'selected' : '' }}>AB</option>
                        <option value="O" {{ $stokdarah->jenisdarah->goldar == 'O' ? 'selected' : '' }}>O</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="rhesus">Rhesus</label>
                    <select id="rhesus" class="form-control" name="rhesus">
                        <option value="">Pilih Rhesus</option>
                        <option value="+" {{ $stokdarah->jenisdarah->rhesus == '+' ? 'selected' : '' }}>+</option>
                        <option value="-" {{ $stokdarah->jenisdarah->rhesus == '-' ? 'selected' : '' }}>-</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="kategori">Jenis Produk</label>
                    <input type="text" class="form-control" id="kategori" name="kategori" value="{{ $stokdarah->jenisdarah->kategori }}">
                </div>
                <div class="form-group">
                    <label for="masa_kadaluarsa">Masa Kadaluarsa</label>
                    <input type="text" class="form-control" id="masa_kadaluarsa" name="masa_kadaluarsa" value="{{ $stokdarah->jenisdarah->masa_kadaluarsa }}">
                </div>
                <div class="form-group">
                    <label for="jumlah">Stock Awal</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ $stokdarah->jumlah }}">
                </div>
                
                <div class="form-group">
                    <label for="suhu_simpan">Suhu Simpan</label>
                    <input type="text" class="form-control" id="suhu_simpan" name="suhu_simpan" value="{{ $stokdarah->jenisdarah->suhu_simpan }}">
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ $stokdarah->jenisdarah->keterangan }}">
                </div>
                
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('stokdarah.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
