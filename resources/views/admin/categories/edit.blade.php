@extends('admin.layouts.app')

@section('title', 'Edit Category')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Category</h3>

        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary btn-sm float-right">
            Back
        </a>
    </div>

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card-body">

            <div class="form-group">
                <label>Category Name</label>
                <input type="text"
                       name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $category->name) }}"
                       placeholder="Enter category name">

                @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description"
                          class="form-control"
                          rows="4"
                          placeholder="Enter description">{{ old('description', $category->description) }}</textarea>
            </div>

            <div class="form-check">
                <input type="checkbox"
                       name="status"
                       class="form-check-input"
                       id="status"
                       {{ $category->status ? 'checked' : '' }}>

                <label class="form-check-label" for="status">
                    Active
                </label>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                Update Category
            </button>
        </div>
    </form>
</div>

@endsection