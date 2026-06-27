@extends('admin.layouts.app')

@section('title','Roles')

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Role List</h3>

        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-sm float-right">
            Add Role
        </a>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Role Name</th>
                    <th>Guard</th>
                    <th width="180">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->guard_name }}</td>
                        <td>
                            <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>
                                    <a href="{{ route('admin.roles.permissions', $role) }}"
   class="btn btn-info btn-sm">
    Permissions
</a>
                                
                            <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete role?')">
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