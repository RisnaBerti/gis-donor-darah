@extends('layouts.user')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Profile ') }}</h1>


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

    @if (session('warning'))
        <div class="alert alert-warning border-left-warning" role="alert">
            {{ session('warning') }}
        </div>
    @endif
  
    @if ($errors->any())
        <div class="alert alert-danger border-left-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">                
                <div class="card-body">
                    <form method="POST" action="{{ route('panel.updateProfile') }}" autocomplete="off">
                        @csrf
                        @method('PUT')

                        <h6 class="heading-small text-muted mb-4">Informasi Akun</h6>
                       
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="nama">Nama<span class="small text-danger">*</span></label>
                                        <input type="text" id="nama" class="form-control" name="nama" placeholder="Nama" value="{{ old('nama', $profile->nama ?? '') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="pl-lg-4">

                                    <div class="form-group">
                                        <label class="form-control-label" for="tempatlahir">Tempat Lahir</label>
                                        <input type="text" id="tempatlahir" class="form-control" name="tempatlahir" placeholder="Tempat Lahir" value="{{ old('tempatlahir', $profile->tempatlahir ?? '') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-control-label" for="tanggallahir">Tanggal Lahir</label>
                                        <input type="date" id="tanggallahir" class="form-control" name="tanggallahir" value="{{ old('tanggallahir', $profile->tanggallahir ?? '') }}" required>
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
                                        <input type="text" id="pekerjaan" class="form-control" name="pekerjaan" placeholder="Pekerjaan" value="{{ old('pekerjaan', $profile->pekerjaan ?? '') }}" required>
                                    </div>
                                    
                                  
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="pl-lg-4">                                    
                                    <div class="form-group">
                                        <label class="form-control-label" for="alamat">Alamat</label>
                                        <input type="text" id="alamat" class="form-control" name="alamat" placeholder="Alamat" value="{{ old('alamat', $profile->alamat ?? '') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="desa">Desa</label>
                                        <input type="text" id="desa" class="form-control" name="desa" placeholder="Desa" value="{{ old('desa', $profile->desa ?? '') }}" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-control-label" for="kecamatan">Kecamatan</label>
                                        <input type="text" id="kecamatan" class="form-control" name="kecamatan" placeholder="Kecamatan" value="{{ old('kecamatan', $profile->kecamatan ?? '') }}" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-control-label" for="kabupaten">Kabupaten</label>
                                        <input type="text" id="kabupaten" class="form-control" name="kabupaten" placeholder="Kabupaten" value="{{ old('kabupaten', $profile->kabupaten ?? '') }}" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-control-label" for="provinsi">Provinsi</label>
                                        <input type="text" id="provinsi" class="form-control" name="provinsi" placeholder="Provinsi" value="{{ old('provinsi', $profile->provinsi ?? '') }}" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-control-label" for="kodepos">Kode Pos</label>
                                        <input type="text" id="kodepos" class="form-control" name="kodepos" placeholder="Kode Pos" value="{{ old('kodepos', $profile->kodepos ?? '') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
              
                                @include('form.maps')
            
                                <input type="hidden" id="hidden-lat" name="lat" value="{{ old('lat', $user->profile->lat ?? '') }}" required>
                                <input type="hidden" id="hidden-long" name="long" value="{{ old('long', $user->profile->long ?? '') }}" required>
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