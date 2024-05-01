@extends('layouts.admin')

@section('main-content')
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Pencari Details</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>NIK:</strong> {{ $user->nik }}</p>
                    
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Roles:</strong>
                        @foreach($user->roles as $role)
                            {{ $role->name }}
                            @if(!$loop->last),@endif
                        @endforeach
                    </p>
                </div>
                <div class="col-md-6">
                    @if($user->profile)
                        <p><strong>Profile Information:</strong></p>
                        <p><strong>Nama:</strong> {{ $user->profile->nama }}</p>
                        <p><strong>Tempat Lahir:</strong> {{ $user->profile->tempatlahir }}</p>
                        <p><strong>Tanggal Lahir:</strong> {{ $user->profile->tanggallahir }}</p>
                        <p><strong>Jenis Kelamin:</strong> {{ $user->profile->jeniskelamin }}</p>
                        <p><strong>Alamat:</strong> {{ $user->profile->alamat }}</p>
                       
                    @else
                        <p>No profile information available.</p>
                    @endif
                </div>
            </div>
            <a href="{{ route('pencaris.index') }}" class="btn btn-secondary mt-3">Back to User List</a>
        </div>
    </div>
@endsection
