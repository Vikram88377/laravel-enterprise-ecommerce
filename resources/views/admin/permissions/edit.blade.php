@extends('admin.layouts.app')

@section('title','Edit Permission')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Permission</h3>

        <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary btn-sm float-right">
            Back
        </a>
    </div>

    <form action="{{ route('admin.permissions.update', $permission) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card-body">
            <div class="form-group">
                <label>Permission Name</label>
                <input type="text"
                       name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $permission->name) }}">

                @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="card-footer">
            <button class="btn btn-primary">Update Permission</button>
        </div>
    </form>
</div>

@endsection