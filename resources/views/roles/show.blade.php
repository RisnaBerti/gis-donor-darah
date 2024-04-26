@extends('layouts.admin')

@section('main-content')
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Role Details</h5>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}" readonly>
            </div>
            <div class="form-group">
                <label for="permissions">Permissions</label>
                <ul>
                    @foreach($role->permissions as $permission)
                        <li>{{ $permission->name }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="form-group">
                <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
@endsection
