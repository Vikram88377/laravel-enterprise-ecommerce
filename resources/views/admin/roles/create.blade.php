@extends('admin.layouts.app')

@section('title','Create Role')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Create Role</h3>

        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary btn-sm float-right">
            Back
        </a>
    </div>

    <form action="{{ route('admin.roles.store') }}" method="POST">
        @csrf

        <div class="card-body">
            <div class="form-group">
                <label>Role Name</label>
                <input type="text"
                       name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}"
                       placeholder="admin">

                @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="card-footer">
            <button class="btn btn-primary">Save Role</button>
        </div>
    </form>
</div>

@endsection