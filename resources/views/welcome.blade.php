@extends('layouts.user')

@section('main-content')

<div class="row">
    <div class="col-lg-12 text-center py-5">
        <h2>SELAMAT DATANG</h2>
        <h4>DI SISTEM INFORMASI GEOGRAFIS PENDONOR DARAH TETAP DI KABUPATEN CILACAP</h4>
    </div>
    <div class="col-lg-4">
        <div class="features-icons py-5">
           <img src="{{ asset('img/logo.png') }}" alt="" srcset="">
        </div>
    </div>
    <div class="col-lg-8">
        <div class="form-login p-5">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Email input -->
                <div class="input-group m-4">
                    <span class="input-group-text">Email</span>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>                            
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            
                <!-- Password input -->
                <div class="input-group m-4">
                    <span class="input-group-text">Password</span>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
         
                <div class="input-group mx-4 my-2 justify-content-end">
                    <a href="{{ route('password.request') }}">Lupa Password?</a>
                </div>
                
                <div class="d-grid col-12 mx-4 my-2 justify-content-end">
                    <button type="submit" class="btn btn-primary mb-4">Masuk</button>                                
                </div>

                <label class="form-label  col-12 mx-4 justify-content-center">Belum punya akun?</label>
                <div class="d-grid col-12 mx-4 my-2">                                   
                    <a class="btn btn-primary" href="{{ route('register') }}">Daftar Sekarang</a>
                  </div>
            
                
            </form>
        </div>
    </div>
</div>

@endsection