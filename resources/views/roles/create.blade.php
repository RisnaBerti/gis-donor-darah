@extends('layouts.admin')

@section('main-content')
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Add Role</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="permissions">Permissions</label>
                    <div class="row">
                        @foreach($permissions->groupBy(function ($item) {
                            $parts = explode('_', $item->name);
                            return ucwords($parts[1]);
                        }) as $group => $accesses)
                            <div class="col-md-2">
                                <div class="card border">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <h4 class="card-title">{{ ucwords($group) }}</h4>
                                            @foreach($accesses as $access)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="{{ Str::slug($access->name) }}"
                                                        name="permissions[]" value="{{ $access->name }}"
                                                        {{ isset($role) && $role->hasPermissionTo($access->name) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="{{ Str::slug($access->name) }}">
                                                        {{ ucwords(__($access->name)) }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    
                    @error('permissions')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection
