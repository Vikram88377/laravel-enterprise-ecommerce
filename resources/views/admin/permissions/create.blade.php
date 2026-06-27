@extends('admin.layouts.app')

@section('title','Create Permission')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Create Permission</h3>

        <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary btn-sm float-right">
            Back
        </a>
    </div>

    <form action="{{ route('admin.permissions.store') }}" method="POST">
        @csrf

        <div class="card-body">
            <div class="form-group">
                <label>Permission Name</label>
                <input type="text"
                       name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}"
                       placeholder="product-create">

                @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="card-footer">
            <button class="btn btn-primary">Save Permission</button>
        </div>
    </form>
</div>

@endsection