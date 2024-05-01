@extends('layouts.admin')

@section('main-content')
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Edit Pencari Donor</h5>
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
            <form method="POST" action="{{ route('pencaris.update', $user->id) }}">
                @csrf
                @method('PUT')

                <!-- Edit user information -->
                <div class="form-group">
                    <label for="nik">NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik" value="{{ $user->nik }}">
                </div>
            
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                </div>

                <!-- Edit profile information -->        
                <div class="row">
                  <div class="col-md-6 mb-4">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $user->profile->nama ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="tempatlahir">Tempat Lahir</label>
                        <input type="text" class="form-control" id="tempatlahir" name="tempatlahir" value="{{ old('tempatlahir', $user->profile->tempatlahir ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="tanggallahir">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tanggallahir" name="tanggallahir" value="{{ old('tanggallahir', $user->profile->tanggallahir ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="jeniskelamin">Jenis Kelamin</label>
                        <select class="form-control" id="jeniskelamin" name="jeniskelamin">
                            <option value="Laki-laki" @if($user->profile->jeniskelamin == 'Laki-laki') selected @endif>Laki-laki</option>
                            <option value="Perempuan" @if($user->profile->jeniskelamin == 'Perempuan') selected @endif>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="golongan_darah">Golongan Darah</label>
                        <select id="golongan_darah" class="form-control" name="golongan_darah">
                            <option value="A" {{ old('golongan_darah', $user->profile->golongan_darah ?? '') == 'A' ? 'selected' : '' }}>A</option>
                            <option value="B" {{ old('golongan_darah', $user->profile->golongan_darah ?? '') == 'B' ? 'selected' : '' }}>B</option>
                            <option value="AB" {{ old('golongan_darah', $user->profile->golongan_darah ?? '') == 'AB' ? 'selected' : '' }}>AB</option>
                            <option value="O" {{ old('golongan_darah', $user->profile->golongan_darah ?? '') == 'O' ? 'selected' : '' }}>O</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-control-label" for="rhesus">Rhesus</label>
                        <select id="rhesus" class="form-control" name="rhesus">
                            <option value="+" {{ old('rhesus', $user->profile->rhesus ?? '') == '+' ? 'selected' : '' }}>+</option>
                            <option value="-" {{ old('rhesus', $user->profile->rhesus ?? '') == '-' ? 'selected' : '' }}>-</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-control-label" for="pekerjaan">Pekerjaan</label>
                        <input type="text" id="pekerjaan" class="form-control" name="pekerjaan" placeholder="Pekerjaan" value="{{ old('pekerjaan', $user->profile->pekerjaan ?? '') }}">
                    </div>
                 </div>

                 <div class="col-md-6 mb-4">
                    <div class="form-group">
                        <label class="form-control-label" for="alamat">Alamat</label>
                        <input type="text" id="alamat" class="form-control" name="alamat" placeholder="Alamat" value="{{ old('alamat', $user->profile->alamat ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="desa">Desa</label>
                        <input type="text" id="desa" class="form-control" name="desa" placeholder="Desa" value="{{ old('desa', $user->profile->desa ?? '') }}">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-control-label" for="kecamatan">Kecamatan</label>
                        <input type="text" id="kecamatan" class="form-control" name="kecamatan" placeholder="Kecamatan" value="{{ old('kecamatan', $user->profile->kecamatan ?? '') }}">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-control-label" for="kabupaten">Kabupaten</label>
                        <input type="text" id="kabupaten" class="form-control" name="kabupaten" placeholder="Kabupaten" value="{{ old('kabupaten', $user->profile->kabupaten ?? '') }}">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-control-label" for="provinsi">Provinsi</label>
                        <input type="text" id="provinsi" class="form-control" name="provinsi" placeholder="Provinsi" value="{{ old('provinsi', $user->profile->provinsi ?? '') }}">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-control-label" for="kodepos">Kode Pos</label>
                        <input type="text" id="kodepos" class="form-control" name="kodepos" placeholder="Kode Pos" value="{{ old('kodepos', $user->profile->kodepos ?? '') }}">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-control-label" for="lat">Latitude</label>
                        <input type="text" id="lat" class="form-control" name="lat" placeholder="Latitude" value="{{ old('lat', $user->profile->lat ?? '') }}">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-control-label" for="long">Longitude</label>
                        <input type="text" id="long" class="form-control" name="long" placeholder="Longitude" value="{{ old('long', $user->profile->long ?? '') }}">
                    </div>                    
                  </div>
                </div>
             
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('pencaris.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
