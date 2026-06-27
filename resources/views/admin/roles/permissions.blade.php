@extends('admin.layouts.app')

@section('title','Assign Permissions')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Assign Permissions to: {{ $role->name }}
        </h3>

        <a href="{{ route('admin.roles.index') }}"
           class="btn btn-secondary btn-sm float-right">
            Back
        </a>
    </div>

    <form action="{{ route('admin.roles.permissions.sync', $role) }}"
          method="POST">
        @csrf

        <div class="card-body">
            <div class="row">

                @forelse($permissions as $permission)

                    <div class="col-md-3 mb-2">
                        <div class="form-check">
                            <input type="checkbox"
                                   name="permissions[]"
                                   value="{{ $permission->name }}"
                                   class="form-check-input"
                                   id="permission_{{ $permission->id }}"
                                   @checked(in_array($permission->name, $rolePermissions))>

                            <label class="form-check-label"
                                   for="permission_{{ $permission->id }}">
                                {{ $permission->name }}
                            </label>
                        </div>
                    </div>

                @empty

                    <div class="col-md-12">
                        <p>No permissions found.</p>
                    </div>

                @endforelse

            </div>
        </div>

        <div class="card-footer">
            <button class="btn btn-primary">
                Save Permissions
            </button>
        </div>
    </form>
</div>

@endsection