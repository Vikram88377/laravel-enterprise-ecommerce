@extends('admin.layouts.app')

@section('title','Permissions')

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Permission List</h3>

        <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary btn-sm float-right">
            Add Permission
        </a>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Permission Name</th>
                    <th>Guard</th>
                    <th width="180">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->guard_name }}</td>
                        <td>
                            <a href="{{ route('admin.permissions.edit', $permission) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>
                                    
                            <form action="{{ route('admin.permissions.destroy', $permission) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete permission?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>

@endsection