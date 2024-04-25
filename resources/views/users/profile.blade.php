@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Profil') }}</h1>

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

    <div class="row">
        <div class="col-lg-12 order-lg-1">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Akun Saya</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}" autocomplete="off">
                        @csrf
                        @method('PUT')

                        <h6 class="heading-small text-muted mb-4">Informasi Pengguna</h6>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="nama">Nama<span class="small text-danger">*</span></label>
                                        <input type="text" id="nama" class="form-control" name="nama" placeholder="Nama" value="{{ old('nama', $profile->nama ?? '') }}">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-control-label" for="tempatlahir">Tempat Lahir</label>
                                        <input type="text" id="tempatlahir" class="form-control" name="tempatlahir" placeholder="Tempat Lahir" value="{{ old('tempatlahir', $profile->tempatlahir ?? '') }}">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-control-label" for="tanggallahir">Tanggal Lahir</label>
                                        <input type="date" id="tanggallahir" class="form-control" name="tanggallahir" value="{{ old('tanggallahir', $profile->tanggallahir ?? '') }}">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-control-label" for="jeniskelamin">Jenis Kelamin</label>
                                        <select id="jeniskelamin" class="form-control" name="jeniskelamin">
                                            <option value="Laki-laki" {{ old('jeniskelamin', $profile->jeniskelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ old('jeniskelamin', $profile->jeniskelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label class="form-control-label" for="golongan_darah">Golongan Darah</label>
                                        <select id="golongan_darah" class="form-control" name="golongan_darah">
                                            <option value="A" {{ old('golongan_darah', $profile->golongan_darah ?? '') == 'A' ? 'selected' : '' }}>A</option>
                                            <option value="B" {{ old('golongan_darah', $profile->golongan_darah ?? '') == 'B' ? 'selected' : '' }}>B</option>
                                            <option value="AB" {{ old('golongan_darah', $profile->golongan_darah ?? '') == 'AB' ? 'selected' : '' }}>AB</option>
                                            <option value="O" {{ old('golongan_darah', $profile->golongan_darah ?? '') == 'O' ? 'selected' : '' }}>O</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-control-label" for="rhesus">Rhesus</label>
                                        <select id="rhesus" class="form-control" name="rhesus">
                                            <option value="+" {{ old('rhesus', $profile->rhesus ?? '') == '+' ? 'selected' : '' }}>+</option>
                                            <option value="-" {{ old('rhesus', $profile->rhesus ?? '') == '-' ? 'selected' : '' }}>-</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-control-label" for="pekerjaan">Pekerjaan</label>
                                        <input type="text" id="pekerjaan" class="form-control" name="pekerjaan" placeholder="Pekerjaan" value="{{ old('pekerjaan', $profile->pekerjaan ?? '') }}">
                                    </div>
                                    
                                  
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="pl-lg-4">                                    
                                    <div class="form-group">
                                        <label class="form-control-label" for="alamat">Alamat</label>
                                        <input type="text" id="alamat" class="form-control" name="alamat" placeholder="Alamat" value="{{ old('alamat', $profile->alamat ?? '') }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="desa">Desa</label>
                                        <input type="text" id="desa" class="form-control" name="desa" placeholder="Desa" value="{{ old('desa', $profile->desa ?? '') }}">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-control-label" for="kecamatan">Kecamatan</label>
                                        <input type="text" id="kecamatan" class="form-control" name="kecamatan" placeholder="Kecamatan" value="{{ old('kecamatan', $profile->kecamatan ?? '') }}">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-control-label" for="kabupaten">Kabupaten</label>
                                        <input type="text" id="kabupaten" class="form-control" name="kabupaten" placeholder="Kabupaten" value="{{ old('kabupaten', $profile->kabupaten ?? '') }}">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-control-label" for="provinsi">Provinsi</label>
                                        <input type="text" id="provinsi" class="form-control" name="provinsi" placeholder="Provinsi" value="{{ old('provinsi', $profile->provinsi ?? '') }}">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-control-label" for="kodepos">Kode Pos</label>
                                        <input type="text" id="kodepos" class="form-control" name="kodepos" placeholder="Kode Pos" value="{{ old('kodepos', $profile->kodepos ?? '') }}">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-control-label" for="lat">Latitude</label>
                                        <input type="text" id="lat" class="form-control" name="lat" placeholder="Latitude" value="{{ old('lat', $profile->lat ?? '') }}">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-control-label" for="long">Longitude</label>
                                        <input type="text" id="long" class="form-control" name="long" placeholder="Longitude" value="{{ old('long', $profile->long ?? '') }}">
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                          <!-- Button -->
                          <div class="row">
                            <div class="col text-center">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
