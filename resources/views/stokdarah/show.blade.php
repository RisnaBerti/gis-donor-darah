@extends('layouts.admin')

@section('main-content')
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Stok Darah Detail</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">                    
                    <p><strong>Golongan Darah:</strong> {{ $stokdarah->jenisDarah->goldar }} {{ $stokdarah->jenisDarah->rhesus }}</p>                
                    <p><strong>Kategori:</strong> {{ $stokdarah->jenisDarah->kategori }}</p>
                    <p><strong>Masa Kadaluarsa:</strong> {{ $stokdarah->jenisDarah->masa_kadaluarsa }}</p>
                    <p><strong>Suhu Simpan:</strong> {{ $stokdarah->jenisDarah->suhu_simpan }}</p>
                    <p><strong>Keterangan:</strong> {{ $stokdarah->jenisDarah->keterangan }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Jumlah Stokdarah:</strong> {{ $stokdarah->jumlah }}</p>              
                </div>
            </div>
            <a href="{{ route('stokdarah.index') }}" class="btn btn-secondary mt-3">Back to Stok Darah List</a>
        </div>
    </div>
@endsection
