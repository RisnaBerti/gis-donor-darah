@extends('layouts.admin')

@section('main-content')
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Pencari Management</h5>
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
            <a href="{{ route('pencaris.create') }}" class="btn btn-primary mb-3">Add User</a>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Golongan Darah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pencaris as $user)
                            <tr>
                                <td>{{ $user->nik }}</td>
                                <td>
                                    @if ($user->profile)
                                        {{ $user->profile->nama }}
                                    @endif
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->profile)
                                        {{ $user->profile->golongan_darah }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('pencaris.show', $user->id) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('pencaris.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('pencaris.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


