@extends('admin.layouts.app')

@section('title','Edit Role')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Role</h3>

        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary btn-sm float-right">
            Back
        </a>
    </div>

    <form action="{{ route('admin.roles.update', $role) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card-body">
            <div class="form-group">
                <label>Role Name</label>
                <input type="text"
                       name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $role->name) }}">

                @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="card-footer">
            <button class="btn btn-primary">Update Role</button>
        </div>
    </form>
</div>

@endsection